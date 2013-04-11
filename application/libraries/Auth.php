<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');
class Auth
{
	var $ci;
	var $dbuser;
	var $lasterr;
	var $cookiesalt;
	var $levels;
	var $settings;
	var $errpage;

	function Auth()
	{
		// Load original ci object to global ci variable
		$this->ci = &get_instance();
		// Load helpers/models required by the library
		$this->ci->load->helper('cookie');
		$this->ci->load->model('sistema/sistema_model');
		$this->ci->load->library('user_agent');
		$this->ci->load->library('msg');
		#$this->ci->config->set_item('cookie_prefix', $_SERVER['SERVER_NAME']);
		// Cookie salt for hash - can be any text string
		$this->cookiesalt = '1234567890';
	}

	/**
	 * Auth check function to see if a user has the appropriate privileges
	 *
	 * @param action The action the user is wanting to perform
	 * @param return TRUE: Just return the boolean answer. FALSE: Redirect/show error page/stop execution
	 */
	function check($action, $return = false)
	{
		log_message('debug', 'Auth: Checking if user can do ' . $action . '.');
		// Get group ID
		$grupo_id = $this->ci->session->userdata('grupo_id');
		// If no group, then guest group (always 0)
		$grupo_id = (int)($grupo_id === false) ? 0:$grupo_id;
		// Hopefully speed up access by putting the group permissoes into the session
		// instead of additional DB lookups each time we run the check() function.
		if(!$this->ci->session->userdata('group_permissions'))
		{
			// Get the group permissoes for the user's group
			$group_permissions = $this->ci->sistema_model->get_group_permissions($grupo_id);
			$this->ci->session->set_userdata('group_permissions', $group_permissions);
		}
		else
		{
			$group_permissions = $this->ci->session->userdata('group_permissions');
		}
		// See if this action is in the permissoes array for the user
		if(is_array($group_permissions))
		{
			$check = in_array($action, $group_permissions);
		}
		else
		{
			$check = false;
		}
		// Return true/false if we only want the return value
		if($return == true)
		{
			return ($check == false) ? false:true;
		}
		// Otherwise, error if failed check ...
		if($check == false)
		{
			// User is not allowed for that action - do stuff
			// Get the URI string they requested so can redirect to it after successful acessar
			$this->ci->session->set_userdata('uri', $this->ci->uri->uri_string());
			$this->ci->load->library('user_agent');
			// User logged in? If not then they must at least acessar.
			// If yes, then they just don't have the necessary privileges.
			if($this->logged_in() == false)
			{
				$this->lasterr = $this->ci->lang->line('AUTH_MUST_LOGIN');
				$this->lasterr2 = anchor('/', 'Clique aqui para logar.');
			}
			else
			{
				$this->lasterr = $this->ci->lang->line('AUTH_NO_PRIVS');
				$this->lasterr2 = anchor($this->ci->agent->referrer(), 'Clique aqui para voltar.');
			}
			$error = &load_class('Exceptions');
			echo $error->show_error($this->lasterr, $this->lasterr2);
			exit;
		}
	}

	/**
	 * Login user via a cookie
	 *
	 * Cookie key is stored in DB against a user and is selected to retrieve the user info.
	 * It is then passed to the acessar() function
	 *
	 * @param	string	key		Cookie key which should be a SHA1 hash
	 * @return	bool
	 */
	function cookielogin($key = null)
	{
		// Check to see if key was supplied
		if($key == null)
		{
			// No cookie key supplied, fatal!
			$this->lasterr = $this->ci->load->view('msg/err', 'Error with acessar cookie.', true);
			$ret = false;
		}
		else
		{
			// Got a key, now to see if it is correct format.
			if(strlen($key) != 40)
			{
				// Is not valid key
				$this->lasterr = $this->ci->msg->err('Cookie is not the correct length.');
				$ret = false;
			}
			else
			{
				// Got cookie key! hopefully should be in the DB
				$sql = 'SELECT usuario_id, cpf, ultimavisita 
						FROM usuarios 
						WHERE cookiekey = ? 
						LIMIT 1';
				// Run query
				$query = $this->ci->db->query($sql, array($key));
				// Check to see how many rows we got from selecting via the cookie key
				if($query->num_rows() == 1)
				{
					// Ok, got user!
					$user = $query->row();
					// Generate original cookie key hash (what we *expect* it to be, if valid) to compare to
					$cookiekey = sha1(implode("", array($this->cookiesalt, $user->usuario_id, $user->cpf,
						$user->ultimavisita, $this->ci->agent->agent_string(), )));
					// Compare hash
					if($cookiekey == $key)
					{
						// Matched! We can now log the user in and set the remember-me option again
						//$acessar = $this->acessar($userinfo->cpf, $userinfo->password, TRUE);
						$acessar = $this->session_create($user->cpf, true);
						$ret = $acessar;
					}
					else
					{
						// Did not match!
						$this->lasterr = $this->ci->msg->err("Invalid cookie (did not match database entry). Did you log in from another computer?"); //<br />Compare $cookiekey to $key.");
						$ret = false;
					}
				}
				else
				{
					// No rows returned from the DB with that cookie key
					$this->lasterr = $this->ci->msg->err('Could not find your cookie in the database. Did you log in from another computer?');
					$ret = false;
				} // End of num_rows() check
			} // End of strlen() check on cookie key
		} // End of key == NULL check
		// Check the return value
		if($ret == false)
		{
			// Remove cookies - they're useless now
			// If we kept them, CRBS would keep using them to acessar and we would be in an endless loop...
			delete_cookie("crbs_key");
			delete_cookie("crbs_user_id");
			// This code has now been moved to the Msg library
			/* $error =& load_class('Exceptions');
			* echo $error->show_error("Cannot acessar via cookie", $this->lasterr);
			* exit; */
			// Generate and show error with link to acessar page
			$this->lasterr .= '<br />' . anchor('conta/acessar',
				'Clique aqui para logar using your cpf and password.');
			$this->ci->msg->fail('Cannot acessar via cookie', $this->lasterr);
		}
		else
		{
			return $ret;
		}
	}

	/**
	 * Function to authenticate a user in the database
	 * Also sets session data and cookie if required
	 *
	 * @param	string	cpf	Username
	 * @param	string	password	Password in either sha1 or plaintext
	 * @param	bool	remember	Whether or not to set the remember cookie (default is false)
	 * @param	bool	is_sha1		Is password already sha1
	 * @return	bool
	 */
	function acessar($cpf, $password, $remember = false, $is_sha1 = false)
	{
		if($cpf != null && $password != null)
		{
			// Check if we need to SHA1 the supplied password
			$password = ($is_sha1 == false) ? sha1($password):$password;
			$sql = 'SELECT usuario_id, cpf
					FROM usuarios
					WHERE cpf = ?
					AND password = ?
					AND ativo = 1
					LIMIT 1';
			$query = $this->ci->db->query($sql, array($cpf, $password));
			if($query->num_rows() == 1)
			{
				return $this->session_create($cpf, $remember);
			}
			else
			{
				$this->lasterr = (isset($this->lasterr)) ? $this->lasterr: 'cpf e/ou senha incorretos';
			}
		}
		else
		{
			// No cpf and password supplied
			$this->lasterr = "No cpf and/or password supplied to Auth library.";
			return false;
		}
	}

	/**
	 * Create acessar session
	 *
	 * This function should only be called once the user has been validated via ldap/local/preauth.
	 * The user MUST exist.
	 *
	 * @param string cpf
	 * @return bool
	 */
	function session_create($cpf, $remember = false)
	{
		$sql = 'SELECT u.usuario_id, u.grupo_id, u.cpf, u.nome, IFNULL( u.nome, u.cpf ) AS nome_ou_cpf, g.ativo
				FROM usuarios as u, grupos as g
				WHERE u.cpf = ? 
				AND u.ativo =1
				AND u.grupo_id = g.grupo_id
				AND g.ativo =1
				LIMIT 1
				';
		$query = $this->ci->db->query($sql, array($cpf));
		if($query->num_rows() == 1)
		{
			// Cool, got the user we wanted
			$user = $query->row();
			// Update the DB's last acessar time (now)..
			$timestamp = mdate('%Y-%m-%d %H:%i:%s');
			$sql = 'UPDATE usuarios 
					SET ultimavisita = ? 
					WHERE usuario_id = ?';
			$this->ci->db->query($sql, array($timestamp, $user->usuario_id));
			// Create session data array
			$sessdata['usuario_id'] = $user->usuario_id;
			$sessdata['grupo_id'] = $user->grupo_id;
			$sessdata['cpf'] = $user->cpf;
			$sessdata['nome_ou_cpf'] = $user->nome_ou_cpf;
			/*
			$sql_ano = 'SELECT AnoBase FROM ano_base WHERE ativo = 1';
			$q = $this->ci->db->query($sql_ano);
			$ano_base = $q->row();
			$sessdata['ano_base'] = $ano_base->AnoBase;
			*/
			// Set session data
			$this->ci->session->set_userdata($sessdata);
			// Now set remember-me cookie if requested
			if($remember == true)
			{
				// Generate hash using details we just retrieved
				$cookiekey = sha1(implode("", array($this->cookiesalt, $user->usuario_id, $user->cpf,
					$timestamp, $this->ci->agent->agent_string(), )));
				// Set cookie data
				$cookie['expire'] = 60 * 60 * 24 * 14; // 14 days
				$cookie['name'] = 'crbs_key';
				$cookie['value'] = $cookiekey;
				set_cookie($cookie);
				$cookie['name'] = 'crbs_user_id';
				$cookie['value'] = $user->usuario_id;
				set_cookie($cookie);
				// Update DB table with the hash that we will later check on return visit
				$sql = 'UPDATE usuarios 
						SET cookiekey = ? 
						WHERE usuario_id = ?';
				$query = $this->ci->db->query($sql, array($cookiekey, $user->usuario_id));
			}
			// Excluir some cookies that might have been left over that we don't want
			delete_cookie("cal_month");
			delete_cookie("cal_year");
			// Done all we needed to do.
			// TODO: Should we check the session data has actually been set before returning success?
			return true;
		}
		else
		{
			$this->lasterr = 'Logon failed - could not find details to initialise session.';
			return false;
		}
	}

	/**
	 * Sair function that clears all the session data and destroys it
	 *
	 * @return	bool
	 */
	function sair()
	{
		$usuario_id = $this->ci->session->userdata('usuario_id');
		$sql = 'DELETE FROM usuarios_ativos WHERE usuario_id = ?';
		$query = $this->ci->db->query($sql, array($usuario_id));
		// Set session data to NULL (include all fields!)
		$sessdata['usuario_id'] = null;
		$sessdata['grupo_id'] = null;
		$sessdata['cpf'] = null;
		$sessdata['nome_ou_cpf'] = null;
		$sessdata['group_permissions'] = null;
		// Set empty session data
		$this->ci->session->unset_userdata($sessdata);
		// Destroy session
		@$this->ci->session->sess_destroy();
		// Remove cookies too
		delete_cookie("crbs_key");
		delete_cookie("crbs_user_id");
		delete_cookie("crbsb.room_id");
		delete_cookie("tab.bookings");
		// NULLify the cookie key in the DB
		$sql = 'UPDATE usuarios SET cookiekey = NULL WHERE usuario_id = ?';
		$query = $this->ci->db->query($sql, array($usuario_id));
		// Verify session has been destroyed by retrieving info
		return ($this->ci->session->userdata('usuario_id') == false) ? true:false;
	}
	
	function generate_random_string($length = 10, $letters = '1234567890qwertyuiopasdfghjklzxcvbnm')
	{
		$s = '';
		$lettersLength = strlen($letters)-1;

		for($i = 0 ; $i < $length ; $i++)
		{
		$s .= $letters[rand(0,$lettersLength)];
		}

		return $s;
	} 
	
	/**
	 * forgotten password feature
	 *
	 * @return void
	 * @author Mathew
	 **/
	public function forgotten_password($cpf, $email)
	{
		
		$exists = $this->userexists($cpf);
		if($exists == TRUE)
		{
			// Get user information.
			$profile = $this->ci->sistema_model->get_user_id_by_email($email);
			
			//print_r($profile); die();
			
			$usuario_id	=	$profile->usuario_id;
			$rand	=	$this->generate_random_string(6);
			$senha	=	sha1($rand);
			//echo $senha;
			//die();
			
			$data = array('password'		=> $senha,
    			          'password_raw'	=> $rand
						  );
						  
			$senha = $this->ci->sistema_model->edit_user($usuario_id, $data);
			//print_r($data); die();
			
			$data['email'] = $profile->email;
			$data['senha'] = $rand;
			
			$message = $this->ci->load->view('conta/email/forgotten_password', $data, true);
			
			$this->ci->load->library('email');
			$this->ci->email->clear();
			$this->ci->email->set_newline("\r\n");
			$this->ci->email->from('sistema_model@pget.ufsc.br', 'Sistema PGET');
			$this->ci->email->to($profile->email);
			$this->ci->email->subject('Sistema PGET - Solicitação de Senha');
			$this->ci->email->message($message);
			return $this->ci->email->send();

			//echo $this->ci->email->print_debugger();die();
		}
		else
		{
			$this->ci->msg->fail('cpf nao existe');
			return false;
		}
	}
	
	/**
	 * Check if a user exists
	 *
	 * @param string Username to check
	 * @return bool
	 */
	function userexists($cpf)
	{
		$sql = 'SELECT usuario_id FROM usuarios WHERE cpf = ? LIMIT 1';
		$query = $this->ci->db->query($sql, array($cpf));
		return ($query->num_rows() == 1) ? true:false;
	}

	/**
	 * Check if an email address is already used in the DB for any user
	 *
	 * @param string Email address to look up
	 * @return bool
	 */
	function emailexists($email)
	{
		$sql = 'SELECT uid FROM userinfo WHERE email = ? LIMIT 1';
		$query = $this->dbuser->query($sql, array($email));
		return ($query->num_rows() == 1) ? true:false;
	}

	/**
	 * Return if user is logged in or not
	 */
	function logged_in()
	{
		return ($this->ci->session->userdata('usuario_id') && $this->ci->session->userdata('cpf'));
	}

	function active_users()
	{
		$sql = 'SELECT usuarios.usuario_id, usuarios.cpf, usuarios.nome, usuarios_ativos.timestamp
				FROM usuarios
				RIGHT JOIN usuarios_ativos ON usuarios.usuario_id = usuarios_ativos.usuario_id';
		$query = $this->ci->db->query($sql);
		$result = $query->result();
		$activeusers = array();
		foreach ($result as $user)
		{
			$nome_ou_cpf = ($user->nome != '' or $user->nome != null) ? $user->nome:$user->cpf;
			//array_push($activeusers, $nome_ou_cpf);
			$activeusers[$user->usuario_id] = $nome_ou_cpf;
		}
		return $activeusers;
	}
}
/* End of file app/libraries/Auth.php */