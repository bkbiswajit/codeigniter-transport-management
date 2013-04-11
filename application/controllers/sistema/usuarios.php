<?php class Usuarios extends Controller
{
	var $tpl;
	var $lasterr;
	function Usuarios()
	{
		parent::Controller();
		$this->load->model('sistema_model');
		$this->tpl = $this->config->item('template');
		$this->output->enable_profiler($this->config->item('profiler'));
		if ($this->auth->logged_in() == TRUE AND $this->config->item('tracker') == TRUE)
		{
			$this->rastreador_model->add_visit();
		}
	}
	/**
	 * Page function for main usuarios listing page. Is also used by nogrupo() and p()
	 */
	function index()
	{
		if ($this->uri->segment(3) == 'nogrupo')
		{
			$grupo_id = (int)$this->uri->segment(4);
		}
		else
		{
			$grupo_id = NULL;
		}
		// Check authorisation
		//$this->auth->check('usuarios');
		$this->load->library('pagination');
		$tpl['subnav'] = $this->sistema_model->subnav();
		$tpl['title'] = 'Usuarios';
		// Links just for this page
		$links[] = array('sistema/usuarios/adicionar', 'Adicionar novo usuário');
		$tpl['links'] = $this->load->view('parts/linkbar', $links, TRUE);
		// Pagination setting (others are defined in /app/config/pagination.php)
		$config['per_page'] = '15';
		if ($grupo_id == NULL)
		{
			// ALL USERS
			if ($this->uri->segment(3) == 'p')
			{
				$pages = array($config['per_page'], $this->uri->segment(4, 0));
				$config['uri_segment'] = 4;
			}
			else
			{
				$pages = array($config['per_page'], 0);
			}
			$body['usuarios'] = $this->sistema_model->get_user(NULL, NULL, $pages);
			$tpl['pagetitle'] = 'Gerenciar Usuários';
			$config['base_url'] = site_url('sistema/usuarios/p');
			$config['total_rows'] = $this->sistema_model->total_users();
		}
		else
		{
			// Usuarios in one group
			$groupname = $this->sistema_model->get_group_name($grupo_id);
			$body['usuarios'] = $this->sistema_model->get_user(NULL, $grupo_id);
			$tpl['pagetitle'] = sprintf('Gerenciar usuarios in the %s group', $groupname);
			$config['base_url'] = site_url('sistema/usuarios/nogrupo/' . $grupo_id);
			$config['total_rows'] = count($body['usuarios']);
		}
		$this->pagination->initialize($config);
		// Get list of usuarios
		if ($body['usuarios'] == FALSE)
		{
			$tpl['body'] = $this->msg->err($this->sistema_model->lasterr);
		}
		else
		{
			$tpl['body'] = $this->load->view('sistema/usuarios/usuarios.index.php', $body, TRUE);
		}
		$this->load->view($this->tpl, $tpl);
	}
	/**
	 * Page function to show only usuarios in a particular group
	 */
	function nogrupo($grupo_id)
	{
		$this->index($grupo_id);
	}
	/**
	 * Page function for paginated list of usuarios (index() picks up page offset via URI)
	 */
	function p($offset = 0)
	{
		$this->index();
	}
	/**
	 * Page function: adicionar a user
	 */
	function adicionar()
	{
		//$this->auth->check('usuarios.adicionar');
		$body['user'] = NULL;
		$body['usuario_id'] = NULL;
		$body['grupos'] = $this->sistema_model->get_groups_dropdown();
		$tpl['sidebar'] = $this->load->view('sistema/usuarios/usuarios.addedit.side.php', NULL, TRUE);
		$tpl['subnav'] = $this->sistema_model->subnav();
		$tpl['title'] = 'Adicionar user';
		$tpl['pagetitle'] = 'Adicionar a new user';
		$tpl['body'] = $this->load->view('sistema/usuarios/usuarios.addedit.php', $body, TRUE);
		$this->load->view($this->tpl, $tpl);
	}
	/**
	 * Page function: editar a user
	 */
	function editar($usuario_id)
	{
		//$this->auth->check('usuarios.editar');
		$body['user'] = $this->sistema_model->get_user($usuario_id);
		$body['usuario_id'] = $usuario_id;
		$body['grupos'] = $this->sistema_model->get_groups_dropdown();
		$tpl['title'] = 'Editar user';
		$tpl['subnav'] = $this->sistema_model->subnav();
		if ($body['user'])
		{
			$tpl['pagetitle'] = ($body['user']->nomecompleto == FALSE) ? 'Editar ' . $body['user']->cpf : 'Editar ' . $body['user']->nomecompleto;
			$tpl['pagetitle'] = 'Editar ' . $body['user']->nomecompleto;
			$tpl['body'] = $this->load->view('sistema/usuarios/usuarios.addedit.php', $body, TRUE);
		}
		else
		{
			$tpl['pagetitle'] = 'Error loading user';
			$tpl['body'] = $this->sistema_model->lasterr;
		}
		$this->load->view($this->tpl, $tpl);
	}
	/**
	 * Destination for form submission for adicionar and editar pages
	 */
	function salvar()
	{
		$usuario_id = $this->input->post('usuario_id');
		$this->form_validation->set_rules('usuario_id', 'User ID');
		$this->form_validation->set_rules('cpf', 'Username', 'required|min_length[1]|max_length[64]|trim');
		if (!$usuario_id)
		{
			$this->form_validation->set_rules('password1', 'Password', 'max_length[104]|required');
			$this->form_validation->set_rules('password2', 'Password (confirmation)', 'max_length[104]|required|matches[password1]');
		}
		$this->form_validation->set_rules('grupo_id', 'Group', 'required|integer');
		$this->form_validation->set_rules('ativo', 'Enabled', 'exact_length[1]');
		$this->form_validation->set_rules('email', 'Email address', 'max_length[256]|valid_email|trim');
		$this->form_validation->set_rules('nomecompleto', 'Display name', 'max_length[64]|trim');
		//$this->form_validation->set_rules('department_id', 'Department', 'integer');
		$this->form_validation->set_error_delimiters('<li>', '</li>');
		if ($this->form_validation->run() == FALSE)
		{
			// Validation failed - load required action depending on the state of usuario_id
			($usuario_id == NULL) ? $this->adicionar() : $this->editar($usuario_id);
		}
		else
		{
			// Validation OK
			$data['cpf'] = $this->input->post('cpf');
			$data['number_id'] = $this->input->post('cpf');
			$data['nome'] = $this->input->post('nomecompleto');
			$data['email'] = $this->input->post('email');
			$data['grupo_id'] = $this->input->post('grupo_id');
			$data['ativo'] = ($this->input->post('ativo') == '1') ? 1 : 0;
			// Only set password if supplied.
			if ($this->input->post('password1'))
			{
				$data['password'] = sha1($this->input->post('password1'));
			}
			#die(print_r($data));
			if ($usuario_id == NULL)
			{
				// Adding user
				#die(var_export($data, true));
				$adicionar = $this->sistema_model->add_user($data);
				if ($adicionar == TRUE)
				{
					$message = ($data['ativo'] == 1) ? 'SECURITY_USER_ADD_OK_ENABLED' : 'SECURITY_USER_ADD_OK_DISABLED';
					$this->msg->adicionar('info', $this->lang->line($message));
				}
				else
				{
					$this->msg->adicionar('err', sprintf($this->lang->line('SECURITY_USER_ADD_FAIL', $this->sistema_model->lasterr)));
				}
			}
			else
			{
				// Updating existing user
				$editar = $this->sistema_model->edit_user($usuario_id, $data);
				if ($editar == TRUE)
				{
					$message = ($data['ativo'] == 1) ? 'SECURITY_USER_EDIT_OK_ENABLED' : 'SECURITY_USER_EDIT_OK_DISABLED';
					$this->msg->adicionar('info', $this->lang->line($message));
				}
				else
				{
					$this->msg->adicionar('err', sprintf($this->lang->line('SECURITY_USER_EDIT_FAIL', $this->sistema_model->lasterr)));
				}
			}
			// Set quota
			if ($this->input->post('quota'))
			{
				$usuario_id = (is_numeric($adicionar)) ? $adicionar : $data['usuario_id'];
				$this->quota->set_quota_u($usuario_id, (int)$this->input->post('quota'));
			}
			// All done, redirect!
			redirect('sistema/usuarios');
		}
	}
	/**
	 * Page function: Deleting a user
	 */
	function excluir($usuario_id = NULL)
	{
		//$this->auth->check('usuarios.excluir');
		// Check if a form has been submitted; if not - show it to ask user confirmation
		if ($this->input->post('id'))
		{
			// Form has been submitted (so the POST value exists)
			// Call model function to excluir user
			$excluir = $this->sistema_model->delete_user($this->input->post('id'));
			if ($excluir == FALSE)
			{
				$this->msg->adicionar('err', $this->sistema_model->lasterr, 'An error occured');
			}
			else
			{
				$this->msg->adicionar('info', 'The user has been deleted.');
			}
			// Redirect
			redirect('sistema/usuarios');
		}
		else
		{
			// Are we trying to excluir ourself?
			if (($this->session->userdata('usuario_id')) && ($usuario_id == $this->session->userdata('usuario_id')))
			{
				$this->msg->adicionar('warn', base64_decode('WW91IGNhbm5vdCBkZWxldGUgeW91cnNlbGYsIHRoZSB1bml2ZXJzZSB3aWxsIGltcGxvZGUu'), base64_decode('RXJyb3IgSUQjMTBU'));
				redirect('sistema/usuarios');
			}
			if ($usuario_id == NULL)
			{
				$tpl['title'] = 'Excluir user';
				$tpl['pagetitle'] = $tpl['title'];
				$tpl['body'] = $this->msg->err('Cannot find the user or no user ID given.');
			}
			else
			{
				// Get user info so we can present the confirmation page with a dsplayname/cpf
				$user = $this->sistema_model->get_user($usuario_id);
				if ($user == FALSE)
				{
					$tpl['title'] = 'Excluir user';
					$tpl['pagetitle'] = $tpl['title'];
					$tpl['body'] = $this->msg->err('Could not find that user or no user ID given.');
				}
				else
				{
					// Initialise page
					$body['action'] = 'sistema/usuarios/excluir';
					$body['id'] = $usuario_id;
					$body['cancel'] = 'sistema/usuarios';
					$body['text'] = 'If you excluir this user, all of their bookings and room owenership information will also be deleted.';
					$tpl['title'] = 'Excluir user';
					$tpl['pagetitle'] = 'Excluir ' . $user->nomecompleto;
					$tpl['body'] = $this->load->view('parts/deleteconfirm', $body, TRUE);
				}
			}
			$tpl['subnav'] = $this->sistema_model->subnav();
			$this->load->view($this->tpl, $tpl);
		}
	}
}
/* End of file app/controllers/sistema/usuarios.php */
