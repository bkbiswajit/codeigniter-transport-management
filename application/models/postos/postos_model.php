<?php
class postos_model extends Model{

	var $lasterr;
	
	function postos_model(){
		parent::Model();
	}
	
	function get_postos($postos_id = NULL, $page = NULL){
		if ($postos_id == NULL) {
		
			// Getting all postos and number of usuarios in it
			$this->db->select('postos.*');
			$this->db->from('postos');
			$this->db->orderby('postos.postos_descricao ASC');
			
			if (isset($page) && is_array($page)) {
				$this->db->limit($page[0], $page[1]);
			}
			
			$query = $this->db->get();
			if ($query->num_rows() > 0){
				return $query->result();
			} else {
				$this->lasterr = 'No postos available.';
				return 0;
			}
			
		} else {
			
			if (!is_numeric($postos_id)) {
				return FALSE;
			}
			
			// Getting one postos
			$sql = 'SELECT * FROM postos WHERE postos_id = ? LIMIT 1';
			$query = $this->db->query($sql, array($postos_id));
			
			if($query->num_rows() == 1){
				
				// Got the postos!
				$postos = $query->row();
				return $postos;
				
			} else {
				
				return FALSE;
				
			}
			
		}
		
	}
	
	/**
	 * Adicionar a postos to the database
	 *
	 * @param	array	data	Array of postos data to insert
	 * @return	bool
	 */
	function add_postos($data){
		// Adicionar created date to the array to be inserted into the DB
		//$data['criado'] = date("Y-m-d");
		// Adicionar the user and get the ID
		/*
		$exists = $this->postos_exists($data['postos_descricao'], $data['curso_id']);
		if($exists == TRUE){
			$this->lasterr = 'Turma já existe no sistema.';
			return FALSE;
		}
		*/
		$adicionar = $this->db->insert('postos', $data);
		$postos_id = $this->db->insert_id();
		return $postos_id;
	}

	/**
	 * Update data for a postos
	 *
	 * @param	int		postos_id	Group ID
	 * @param	array	data		Data
	 */
	function edit_postos($postos_id = NULL, $data){
		// Gotta have an ID
		if($postos_id == NULL){
			$this->lasterr = 'Cannot update a postos without their ID.';
			return FALSE;
		}
		/*
		$exists = $this->postos_exists($data['postos_descricao'], $data['curso_id']);
		if($exists == TRUE){
			$this->lasterr = 'Turma já existe no sistema.';
			return FALSE;
		}
		*/
		// Update postos main details
		$this->db->where('postos_id', $postos_id);
		$editar = $this->db->update('postos', $data);
		
		return $editar;
	}
	
	function postos_exists($postos_descricao, $curso_id){
		$sql = 'SELECT * FROM postos WHERE postos_descricao = ? AND curso_id = ? LIMIT 1';
		$query = $this->db->query($sql, array($postos_descricao, $curso_id));
		return ($query->num_rows() == 1) ? TRUE : FALSE;
	}	

	function delete_postos($postos_id){
	
		if($this->check_if_postos_has_controle_de_viagem_postos($postos_id) == FALSE){
			$this->lasterr = 'MODEL ERRO: 3';
			return FALSE;
		}
		
		$sql = 'DELETE FROM postos WHERE postos_id = ? LIMIT 1';
		$query = $this->db->query($sql, array($postos_id));
		
		if($query == FALSE){
			
			$this->lasterr = 'Could not excluir postos. Do they exist?';
			return FALSE;
			
		} else {
			return TRUE;
		}
		
	}
	
	function check_if_postos_has_controle_de_viagem_postos($postos_id){
		$sql = 'SELECT controle_de_viagem_postos_postos_id FROM controle_de_viagem_postos WHERE controle_de_viagem_postos_postos_id = ?';
		$query = $this->db->query($sql, array($postos_id));
		if($query->num_rows() == 0){
			return TRUE;
		} else {
			return FALSE;
		}
	}
	
	function check_if_postos_has_postos_descontos($postos_id){
		$sql = 'SELECT postos_descontos.postos_descontos_id FROM postos_descontos WHERE postos_descontos.postos_descontos_postos_id = ?';
		$query = $this->db->query($sql, array($postos_id));
		if($query->num_rows() == 0){
			return TRUE;
		} else {
			return FALSE;
		}
	}


	function get_postos_dropdown(){
		$sql = 'SELECT postos_id, postos_descricao FROM postos ORDER BY postos_descricao ASC';
		$query = $this->db->query($sql);
		if($query->num_rows() > 0){
			$result = $query->result();
			$postos = array();
			foreach($result as $funcionario){
				$postos[$funcionario->postos_id] = $funcionario->postos_descricao;
			}
			return $postos;
		} else {
			$this->lasterr = 'No postos found';
			return FALSE;
		}
	}

	function get_postos_name($postos_id){
		if($postos_id == NULL || !is_numeric($postos_id)){
			$this->lasterr = 'No postos_id given or invalid data type.';
			return FALSE;
		}
		
		$sql = 'SELECT postos_descricao FROM postos WHERE postos_id = ? LIMIT 1';
		$query = $this->db->query($sql, array($postos_id));
		
		if($query->num_rows() == 1){
			$row = $query->row();
			return $row->postos_descricao;
		} else {
			$this->lasterr = sprintf('The postos supplied (ID: %d) does not exist.', $postos_id);
			return FALSE;
		}
	}
	
	function get_postos_tipo_sala(){
	
		$sql = 'SELECT postos.postos_id, postos.postos_descricao, postos.postos_autor, postos.postos_horario_incio, postos.postos_horario_fim, postos.postos_ativo, postos_tipos.postos_tipo_id, postos_tipos.postos_tipo_nome, postos_salas.postos_sala_id, postos_salas.postos_sala_nome
				FROM postos, postos_tipos, postos_salas
				WHERE postos_tipos.postos_tipo_id = postos.postos_tipo_id
				AND postos_salas.postos_sala_id = postos.postos_sala_id
				ORDER BY postos.postos_id';
				
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