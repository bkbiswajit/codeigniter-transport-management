<?php
class frotas_despesas_tipos_model extends Model{

	var $lasterr;
	
	function frotas_despesas_tipos_model(){
		parent::Model();
	}
	
	function get_frotas_despesas_tipos($frotas_despesas_tipos_id = NULL, $page = NULL){
		if ($frotas_despesas_tipos_id == NULL) {
		
			// Getting all frotas_despesas_tipos and number of usuarios in it
			$this->db->select('frotas_despesas_tipos.*');
			$this->db->from('frotas_despesas_tipos');
			$this->db->orderby('frotas_despesas_tipos.frotas_despesas_tipos_descricao ASC');
			
			if (isset($page) && is_array($page)) {
				$this->db->limit($page[0], $page[1]);
			}
			
			$query = $this->db->get();
			if ($query->num_rows() > 0){
				return $query->result();
			} else {
				$this->lasterr = 'No frotas_despesas_tipos available.';
				return 0;
			}
			
		} else {
			
			if (!is_numeric($frotas_despesas_tipos_id)) {
				return FALSE;
			}
			
			// Getting one frotas_despesas_tipos
			$sql = 'SELECT * FROM frotas_despesas_tipos WHERE frotas_despesas_tipos_id = ? LIMIT 1';
			$query = $this->db->query($sql, array($frotas_despesas_tipos_id));
			
			if($query->num_rows() == 1){
				
				// Got the frotas_despesas_tipos!
				$frotas_despesas_tipos = $query->row();
				return $frotas_despesas_tipos;
				
			} else {
				
				return FALSE;
				
			}
			
		}
		
	}
	
	/**
	 * Adicionar a frotas_despesas_tipos to the database
	 *
	 * @param	array	data	Array of frotas_despesas_tipos data to insert
	 * @return	bool
	 */
	function add_frotas_despesas_tipos($data){
		// Adicionar created date to the array to be inserted into the DB
		//$data['criado'] = date("Y-m-d");
		// Adicionar the user and get the ID
		/*
		$exists = $this->frotas_despesas_tipos_exists($data['frotas_despesas_tipos_descricao'], $data['curso_id']);
		if($exists == TRUE){
			$this->lasterr = 'Turma já existe no sistema.';
			return FALSE;
		}
		*/
		$adicionar = $this->db->insert('frotas_despesas_tipos', $data);
		$frotas_despesas_tipos_id = $this->db->insert_id();
		return $frotas_despesas_tipos_id;
	}

	/**
	 * Update data for a frotas_despesas_tipos
	 *
	 * @param	int		frotas_despesas_tipos_id	Group ID
	 * @param	array	data		Data
	 */
	function edit_frotas_despesas_tipos($frotas_despesas_tipos_id = NULL, $data){
		// Gotta have an ID
		if($frotas_despesas_tipos_id == NULL){
			$this->lasterr = 'Cannot update a frotas_despesas_tipos without their ID.';
			return FALSE;
		}
		/*
		$exists = $this->frotas_despesas_tipos_exists($data['frotas_despesas_tipos_descricao'], $data['curso_id']);
		if($exists == TRUE){
			$this->lasterr = 'Turma já existe no sistema.';
			return FALSE;
		}
		*/
		// Update frotas_despesas_tipos main details
		$this->db->where('frotas_despesas_tipos_id', $frotas_despesas_tipos_id);
		$editar = $this->db->update('frotas_despesas_tipos', $data);
		
		return $editar;
	}
	
	function frotas_despesas_tipos_exists($frotas_despesas_tipos_descricao, $curso_id){
		$sql = 'SELECT * FROM frotas_despesas_tipos WHERE frotas_despesas_tipos_descricao = ? AND curso_id = ? LIMIT 1';
		$query = $this->db->query($sql, array($frotas_despesas_tipos_descricao, $curso_id));
		return ($query->num_rows() == 1) ? TRUE : FALSE;
	}	

	function delete_frotas_despesas_tipos($frotas_despesas_tipos_id){
		
		if($this->check_if_frotas_despesas_tipos_has_controle_de_viagem($frotas_despesas_tipos_id) == FALSE){
			$this->lasterr = 'MODEL ERRO: 3';
			return FALSE;
		}
		
		$sql = 'DELETE FROM frotas_despesas_tipos WHERE frotas_despesas_tipos_id = ? LIMIT 1';
		$query = $this->db->query($sql, array($frotas_despesas_tipos_id));
		
		if($query == FALSE){
			
			$this->lasterr = 'Could not excluir frotas_despesas_tipos. Do they exist?';
			return FALSE;
			
		} else {
			return TRUE;
		}
		
	}
	
	function check_if_frotas_despesas_tipos_has_controle_de_viagem($frotas_despesas_tipos_id){
		$sql = 'SELECT controle_de_viagem_caminhao_id FROM controle_de_viagem WHERE controle_de_viagem_caminhao_id= ?';
		$query = $this->db->query($sql, array($frotas_despesas_tipos_id));
		if($query->num_rows() == 0){
			return TRUE;
		} else {
			return FALSE;
		}
	}
	
	function get_frotas_despesas_tipos_dropdown(){
		$sql = 'SELECT frotas_despesas_tipos_id, frotas_despesas_tipos_descricao FROM frotas_despesas_tipos ORDER BY frotas_despesas_tipos_descricao ASC';
		$query = $this->db->query($sql);
		if($query->num_rows() > 0){
			$result = $query->result();
			$frotas_despesas_tipos = array(''=>'SELECIONE');
			foreach($result as $funcionario){
				$frotas_despesas_tipos[$funcionario->frotas_despesas_tipos_id] = $funcionario->frotas_despesas_tipos_descricao;
			}
			return $frotas_despesas_tipos;
		} else {
			$this->lasterr = 'No frotas_despesas_tipos found';
			return FALSE;
		}
	}
	
	function get_frotas_despesas_tipos_controle_de_viagem_agenda_liberado_dropdown(){
		$sql = 'SELECT frotas_despesas_tipos_id, frotas_despesas_tipos_descricao FROM frotas_despesas_tipos WHERE frotas_despesas_tipos.frotas_despesas_tipos_controle_de_viagem_agenda_liberado=0 ORDER BY frotas_despesas_tipos_descricao ASC';
		$query = $this->db->query($sql);
		if($query->num_rows() > 0){
			$result = $query->result();
			$frotas_despesas_tipos = array(''=>'SELECIONE');
			foreach($result as $funcionario){
				$frotas_despesas_tipos[$funcionario->frotas_despesas_tipos_id] = $funcionario->frotas_despesas_tipos_descricao;
			}
			return $frotas_despesas_tipos;
		} else {
			$this->lasterr = 'No frotas_despesas_tipos found';
			return FALSE;
		}
	}

	function get_frotas_despesas_tipos_name($frotas_despesas_tipos_id){
		if($frotas_despesas_tipos_id == NULL || !is_numeric($frotas_despesas_tipos_id)){
			$this->lasterr = 'No frotas_despesas_tipos_id given or invalid data type.';
			return FALSE;
		}
		
		$sql = 'SELECT frotas_despesas_tipos_descricao FROM frotas_despesas_tipos WHERE frotas_despesas_tipos_id = ? LIMIT 1';
		$query = $this->db->query($sql, array($frotas_despesas_tipos_id));
		
		if($query->num_rows() == 1){
			$row = $query->row();
			return $row->frotas_despesas_tipos_descricao;
		} else {
			$this->lasterr = sprintf('The frotas_despesas_tipos supplied (ID: %d) does not exist.', $frotas_despesas_tipos_id);
			return FALSE;
		}
	}
	
	function get_frotas_despesas_tipos_tipo_sala(){
	
		$sql = 'SELECT frotas_despesas_tipos.frotas_despesas_tipos_id, frotas_despesas_tipos.frotas_despesas_tipos_descricao, frotas_despesas_tipos.frotas_despesas_tipos_autor, frotas_despesas_tipos.frotas_despesas_tipos_horario_incio, frotas_despesas_tipos.frotas_despesas_tipos_horario_fim, frotas_despesas_tipos.frotas_despesas_tipos_ativo, frotas_despesas_tipos_tipos.frotas_despesas_tipos_tipo_id, frotas_despesas_tipos_tipos.frotas_despesas_tipos_tipo_nome, frotas_despesas_tipos_salas.frotas_despesas_tipos_sala_id, frotas_despesas_tipos_salas.frotas_despesas_tipos_sala_nome
				FROM frotas_despesas_tipos, frotas_despesas_tipos_tipos, frotas_despesas_tipos_salas
				WHERE frotas_despesas_tipos_tipos.frotas_despesas_tipos_tipo_id = frotas_despesas_tipos.frotas_despesas_tipos_tipo_id
				AND frotas_despesas_tipos_salas.frotas_despesas_tipos_sala_id = frotas_despesas_tipos.frotas_despesas_tipos_sala_id
				ORDER BY frotas_despesas_tipos.frotas_despesas_tipos_id';
				
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
				return $query->result();
		} else {
			$this->lasterr = 'No cursos available.';
			return 0;
		}
	}
}

/* End of file: app/models/sistema.php */