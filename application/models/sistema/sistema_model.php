<?php 

class Sistema_model extends Model{

	var $lasterr;
	
	function Sistema_model(){
		parent::Model();
	}
	
	/**
	 * Link definitions of pages in this section
	 */
	function subnav(){
		$subnav = array();
		// Other pages in this parent section (uri, title, permission nome)
		$subnav[] = array('sistema/geral', 'Geral', 'sistema.geral');
		$subnav[] = array('sistema/usuarios', 'Usuarios', 'usuarios');
		$subnav[] = array('sistema/grupos', 'Grupos', 'grupos');
		$subnav[] = array('sistema/permissoes', 'Permissoes', 'sistema.permissoes');
		$subnav[] = array('sistema/rastrear', 'Rastrear', 'usuarios');
		return $subnav;
	}

	/**
	 * get one or more usuarios (optionally by group)
	 *
	 * @param int usuario_id
	 * @param int grupo_id
	 * @param arr pagination limit,start
	 * @return mixed (object on success, false on failure)
	 *
	 * Example - get one user
	 *   get_user(42);
	 *
	 * Example - get all usuarios
	 *   get_user();
	 *
	 * Example - get all usuarios in a group
	 *  get_user(NULL, 4);
	 */
	function get_user($usuario_id = NULL, $grupo_id = NULL, $page = NULL){
		
		if ($usuario_id == NULL) {
		
			// Getting all usuarios
			$this->db->select('usuarios.*, grupos.nome AS groupnome', FALSE);
			$this->db->from('usuarios');
			$this->db->join('grupos', 'usuarios.grupo_id = grupos.grupo_id', 'left');
			
			// Filter to group if necessary
			if ($grupo_id != NULL && is_numeric($grupo_id)) {
				$this->db->where('usuarios.grupo_id', $grupo_id);
			}
			
			$this->db->orderby('usuarios.cpf ASC');
			
			if (isset($page) && is_array($page)) {
				$this->db->limit($page[0], $page[1]);
			}
			
			$query = $this->db->get();
			if ($query->num_rows() > 0){
				return $query->result();
			} else {
				$this->lasterr = 'This group is empty!';
				return 0;
			}
			
		} else {
			
			if (!is_numeric($usuario_id)) {
				return FALSE;
			}
			
			// Getting one user
			$sql = 'SELECT 
						usuarios.usuario_id, 
						usuarios.grupo_id,
						usuarios.ativo,
						usuarios.cpf,
						usuarios.nome,
						usuarios.email,
						usuarios.retrato,
						IFNULL(usuarios.nome, usuarios.cpf) AS displaynome,
						usuarios.ultimavisita,
						usuarios.ultimaatividade,
						usuarios.criado
					FROM usuarios
					LEFT JOIN grupos ON usuarios.grupo_id = grupos.grupo_id
					WHERE usuarios.usuario_id = ?
					GROUP BY usuarios.usuario_id
					LIMIT 1';
			$query = $this->db->query($sql, array($usuario_id));
			
			if($query->num_rows() == 1){
				$user = $query->row();
				$user->nomecompleto = ($user->nome) ? $user->nome : $user->cpf;
				return $user;
			} else {
				return FALSE;
			}
			
		}
		
	}
	
	function get_user_id_by_cpf($cpf)
	{
		$sql = 'SELECT usuarios.usuario_id, usuarios.cpf FROM usuarios WHERE usuarios.cpf = ? LIMIT 1';
		$query = $this->db->query($sql, array($cpf));

		if($query->num_rows() == 1){
			$user = $query->row();
			return $user;
		} else {
			return FALSE;
		}			
	}	
	
	function get_user_id_by_email($email)
	{
		$sql = 'SELECT usuarios.usuario_id, usuarios.email FROM usuarios WHERE usuarios.email = ? LIMIT 1';
		$query = $this->db->query($sql, array($email));

		if($query->num_rows() == 1)
		{
			$user = $query->row();
			return $user;
		}
		else 
		{
			return FALSE;
		}			
	}

	/**
	 * Get usuarios in format for a dropdown box (id => nome)
	 *
	 * @param	bool	none	Include a "(None)" option with a value of -1
	 * @return	Array	Array: usuario_id => Display nome
	 */
	function get_users_dropdown($none = FALSE){
		$sql = 'SELECT usuario_id, usernome, displaynome, IFNULL(displaynome, usernome) AS nome_ou_cpf
				FROM usuarios
				ORDER BY nome_ou_cpf ASC';
		$query = $this->db->query($sql);
		if($query->num_rows() > 0){
			$result = $query->result();
			$usuarios = array();
			if($none == TRUE){
				$usuarios[-1] = '(None)';
			}
			foreach($result as $user){
				$usuarios[$user->usuario_id] = $user->nome_ou_cpf;
			}
			return $usuarios;
		} else {
			$this->lasterr = 'No usuarios found';
			return FALSE;
		}
	}

	/**
	 * Adicionar a user to the database
	 */
	function add_user($data){
		
		// Check if user exists - can't adicionar if already in DB
		$exists = $this->auth->userexists($data['cpf']);
		if($exists == TRUE){
			$this->lasterr = 'Username already exists.';
			return FALSE;
		}
		
		$data['criado'] = date("Y-m-d");
		
		$adicionar = $this->db->insert('usuarios', $data);
		$usuario_id = $this->db->insert_id();
		
		//$this->update_user_departments($usuario_id, $departments);
		
		// Return new ID
		if($adicionar == TRUE){
			return $usuario_id;
		} else {
			return FALSE;
		}
		
	}

	/**
	 * Update user details
	 */
	function edit_user($usuario_id = NULL, $data){
		if($usuario_id == NULL){
			$this->lasterr = 'Cannot update a user without their ID.';
			return FALSE;
		}
		
		$this->db->where('usuario_id', $usuario_id);
		$editar = $this->db->update('usuarios', $data);
		
		return $editar;
	}

	/**
	 * Count the total number of usuarios
	 *
	 * @return	int		Number of usuarios in the DB
	 */
	function total_users(){
		$sql = 'SELECT usuario_id FROM usuarios';
		$query = $this->db->query($sql);
		return $query->num_rows();
	}

	/**
	 * Re-assign usuarios to departments
	 *
	 * @param	int		usuario_id			User ID
	 * @param	array	departments		Array of department IDs to associate with user
	 */
	function update_user_departments($usuario_id, $departments = array()){
		// Remove LDAP department assignments (don't panic; will re-insert if they are specified)
		$sql = 'DELETE FROM users2departments WHERE usuario_id = ?';
		$query = $this->db->query($sql, array($usuario_id));
		
		#print_r($departments);
		#echo var_dump(count($departments));
		
		// If LDAP grupos were assigned then insert into DB
		if(!empty($departments)){
			$sql = 'INSERT INTO users2departments (usuario_id, department_id) VALUES ';
			foreach($departments as $department_id){
				$sql .= sprintf("(%d,%d),", $usuario_id, $department_id);
			}
			// Remove last comma
			$sql = preg_replace('/,$/', '', $sql);
			$query = $this->db->query($sql);
			if($query == FALSE){
				$this->lasterr = 'Could not assign departments to user.';
				return FALSE;
			} else {
				return TRUE;
			}
		}
	}

	/**
	 * Excluir a user from the DB
	 *
	 * @param	int		usuario_id		User ID
	 * @return	bool	True on successful deletion
	 */
	function delete_user($usuario_id){
		
		$sql = 'DELETE FROM usuarios WHERE usuario_id = ? LIMIT 1';
		$query = $this->db->query($sql, array($usuario_id));
		
		if($query == FALSE){
			
			$this->lasterr = 'Could not excluir user. Do they exist?';
			return FALSE;
			
		} else {			
			return TRUE;
			
		}
		
	}

	/**
	 * Get one or more grupos
	 *
	 * @param	int		grupo_id	Specify if wanting one group. NULL to return all grupos.
	 * @param	array	page		Pagination array (start,limit)
	 * @return	array
	 */
	function get_group($grupo_id = NULL, $page = NULL){
		if ($grupo_id == NULL) {
		
			// Getting all grupos and number of usuarios in it
			$this->db->select('
				grupos.*,
				(
					SELECT COUNT(usuario_id)
					FROM usuarios
					WHERE grupos.grupo_id = usuarios.grupo_id
					LIMIT 1
				) AS usercount',
				FALSE
			);
			$this->db->from('grupos');
						
			$this->db->orderby('grupos.nome ASC');
			
			if (isset($page) && is_array($page)) {
				$this->db->limit($page[0], $page[1]);
			}
			
			$query = $this->db->get();
			if ($query->num_rows() > 0){
				return $query->result();
			} else {
				$this->lasterr = 'No grupos available.';
				return 0;
			}
			
		} else {
			
			if (!is_numeric($grupo_id)) {
				return FALSE;
			}
			
			// Getting one group
			$sql = 'SELECT * FROM grupos WHERE grupo_id = ? LIMIT 1';
			$query = $this->db->query($sql, array($grupo_id));
			
			if($query->num_rows() == 1){
				
				// Got the group!
				$group = $query->row();
				return $group;
				
			} else {
				
				return FALSE;
				
			}
			
		}
		
	}
	
	/**
	 * Adicionar a group to the database
	 *
	 * @param	array	data	Array of group data to insert
	 * @return	bool
	 */
	function add_group($data){
		// Adicionar created date to the array to be inserted into the DB
		$data['criado'] = date("Y-m-d");
		// Adicionar the user and get the ID
		$adicionar = $this->db->insert('grupos', $data);
		$grupo_id = $this->db->insert_id();
		return $grupo_id;
		
	}

	/**
	 * Update data for a group
	 *
	 * @param	int		grupo_id	Group ID
	 * @param	array	data		Data
	 */
	function edit_group($grupo_id = NULL, $data){
		// Gotta have an ID
		if($grupo_id == NULL){
			$this->lasterr = 'Cannot update a group without their ID.';
			return FALSE;
		}
		// Update group main details
		$this->db->where('grupo_id', $grupo_id);
		$editar = $this->db->update('grupos', $data);
		
		return $editar;
	}

	function delete_group($grupo_id){
	
		if($grupo_id == 0 OR $grupo_id == 1){
			$this->lasterr = 'Cannot excluir that default group.';
			return FALSE;
		}
		
		if($this->check_if_group_has_user($grupo_id) == FALSE){
			$this->lasterr = 'You cannot delete this group because it has users that belongs to. First you need to delete users of this this group.';
			return FALSE;
		}
		
		$sql = 'DELETE FROM grupos WHERE grupo_id = ? LIMIT 1';
		$query = $this->db->query($sql, array($grupo_id));
		
		if($query == FALSE){
			
			$this->lasterr = 'Could not excluir group. Do they exist?';
			return FALSE;
			
		} else {
			// Remove usuarios in this group and put them into Guests
			$sql = 'UPDATE usuarios SET grupo_id = 0 WHERE grupo_id = ?';
			$query = $this->db->query($sql, array($grupo_id));
			if($query == FALSE){
				$failed['usuarios'] = 'Failed to re-assign usuarios in the group you deleted to the default Guests group';
			}
			
			// Check if our sub-actions failed
			if(isset($failed)){
				$this->lasterr = 'The group was deleted successfully, but other errors occured: <ul>';
				foreach($failed as $k => $v){
					$this->lasterr .= sprintf('<li>%s</li>', $v);
				}
				$this->lasterr .= '</ul>';
				return FALSE;
			}
			
			return TRUE;
			
		}
		
	}
	
	function check_if_group_has_user($grupo_id){
		$sql = 'SELECT grupo_id FROM usuarios WHERE grupo_id = ?';
		$query = $this->db->query($sql, array($grupo_id));
		if($query->num_rows() == 0){
			return TRUE;
		} else {
			return FALSE;
		}
	}

	function get_groups_dropdown(){
		$sql = 'SELECT grupo_id, nome FROM grupos ORDER BY nome ASC';
		$query = $this->db->query($sql);
		if($query->num_rows() > 0){
			$result = $query->result();
			$grupos = array();
			foreach($result as $group){
				$grupos[$group->grupo_id] = $group->nome;
			}
			return $grupos;
		} else {
			$this->lasterr = 'No grupos found';
			return FALSE;
		}
	}

	function get_group_name($grupo_id){
		if($grupo_id == NULL || !is_numeric($grupo_id)){
			$this->lasterr = 'No grupo_id given or invalid data type.';
			return FALSE;
		}
		
		$sql = 'SELECT nome FROM grupos WHERE grupo_id = ? LIMIT 1';
		$query = $this->db->query($sql, array($grupo_id));
		
		if($query->num_rows() == 1){
			$row = $query->row();
			return $row->nome;
		} else {
			$this->lasterr = sprintf('The group supplied (ID: %d) does not exist.', $grupo_id);
			return FALSE;
		}
	}

	function get_group_permissions($grupo_id = NULL){
		
		if($grupo_id === NULL){
			
			// Getting permissoes for all grupos
			$sql = 'SELECT grupo_id, permissoes FROM grupos ORDER BY grupo_id ASC';
			$query = $this->db->query($sql);
			if($query->num_rows() > 0){
				$result = $query->result();
				$permissoes = array();
				foreach($result as $row){
					$permissoes[$row->grupo_id] = unserialize($row->permissoes);
				}
				return $permissoes;
			} else {
				$lasterr = 'No grupos to get permissoes from.';
				return FALSE;
			}
			
		} else {
			
			// Getting permissoes from one group
			$sql = 'SELECT permissoes FROM grupos WHERE grupo_id=?';
			$query = $this->db->query($sql, array($grupo_id));
			if($query->num_rows() == 1){
				$row = $query->row();
				return unserialize($row->permissoes);
			} else {
				$this->lasterr = 'No group to get permissoes from.';
				return FALSE;
			}
			
		}
		
	}

	function save_group_permissions($grupo_id, $permissoes){
		if($grupo_id === NULL || $grupo_id === FALSE || !is_numeric($grupo_id)){
			$this->lasterr = "Group ID ($grupo_id) was not valid.";
			return FALSE;
		}
		
		/*if(!is_array($permissoes) || ($permissoes != NULL)){
			$this->lasterr = 'Permissions was not supplied in valid format.';
			return FALSE;
		}*/
		
		$sql = 'UPDATE grupos SET permissoes = ? WHERE grupo_id = ? LIMIT 1';
		$query = $this->db->query($sql, array(serialize($permissoes), $grupo_id));
		
		return $query;
	}
	
	function get_user_permissions($usuario_id){
		if(!is_numeric($usuario_id)){
			$this->lasterr = 'User ID supplied was invalid.';
			return FALSE;
		}
		
		$sql = 'SELECT permissoes 
				FROM grupos 
				LEFT JOIN usuarios ON grupos.grupo_id = usuarios.grupo_id
				WHERE usuarios.usuario_id = ?
				LIMIT 1';
		$query = $this->db->query($sql, array($usuario_id));
		
		if($query->num_rows() == 1){
			$row = $query->row();
			$group_permissions = unserialize($row->permissoes);
			// Check if there are actually any permissoes configured for the group
			if(!is_array($group_permissions)){
				$this->lasterr = 'No permissoes configured for the group.';
				return FALSE;
			}
			//return $permissoes;
			$all_permissions = $this->config->item('permissoes');
			#print_r($all_permissions);
			$effective = array();
			foreach($all_permissions as $category){
				foreach($category as $items){
					#print_r($items);
					foreach($group_permissions as $p){
						#echo $items[0] . "\n\n";
						#echo $p . "\n\n";
						if($items[0] == $p){
							#echo var_export($items[0], TRUE) . "\n\n\n";
							$effective[] = $items;
						}
					}
				}	
			}
			
			#print_r($effective);
			return $effective;
		} else {
			$this->lasterr = 'Could not find permissoes';
			return FALSE;
		}
	}

}

/* End of file: app/models/sistema.php */