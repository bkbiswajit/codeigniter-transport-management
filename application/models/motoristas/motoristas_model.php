<?php
class motoristas_model extends Model{

	var $lasterr;
	
	function motoristas_model(){
		parent::Model();
	}
	
	function get_motoristas($motoristas_id = NULL, $page = NULL){
		if ($motoristas_id == NULL) {
		
			// Getting all motoristas and number of usuarios in it
			$this->db->select('motoristas.*');
			$this->db->from('motoristas');
			$this->db->orderby('motoristas.motoristas_descricao ASC');
			
			if (isset($page) && is_array($page)) {
				$this->db->limit($page[0], $page[1]);
			}
			
			$query = $this->db->get();
			if ($query->num_rows() > 0){
				return $query->result();
			} else {
				$this->lasterr = 'No motoristas available.';
				return 0;
			}
			
		} else {
			
			if (!is_numeric($motoristas_id)) {
				return FALSE;
			}
			
			// Getting one motoristas
			$sql = 'SELECT * FROM motoristas WHERE motoristas_id = ? LIMIT 1';
			$query = $this->db->query($sql, array($motoristas_id));
			
			if($query->num_rows() == 1){
				
				// Got the motoristas!
				$motoristas = $query->row();
				return $motoristas;
				
			} else {
				
				return FALSE;
				
			}
			
		}
		
	}
	
	/**
	 * Adicionar a motoristas to the database
	 *
	 * @param	array	data	Array of motoristas data to insert
	 * @return	bool
	 */
	function add_motoristas($data){
		// Adicionar created date to the array to be inserted into the DB
		//$data['criado'] = date("Y-m-d");
		// Adicionar the user and get the ID
		/*
		$exists = $this->motoristas_exists($data['motoristas_descricao'], $data['curso_id']);
		if($exists == TRUE){
			$this->lasterr = 'Turma já existe no sistema.';
			return FALSE;
		}
		*/
		$adicionar = $this->db->insert('motoristas', $data);
		$motoristas_id = $this->db->insert_id();
		return $motoristas_id;
	}

	/**
	 * Update data for a motoristas
	 *
	 * @param	int		motoristas_id	Group ID
	 * @param	array	data		Data
	 */
	function edit_motoristas($motoristas_id = NULL, $data){
		// Gotta have an ID
		if($motoristas_id == NULL){
			$this->lasterr = 'Cannot update a motoristas without their ID.';
			return FALSE;
		}
		/*
		$exists = $this->motoristas_exists($data['motoristas_descricao'], $data['curso_id']);
		if($exists == TRUE){
			$this->lasterr = 'Turma já existe no sistema.';
			return FALSE;
		}
		*/
		// Update motoristas main details
		$this->db->where('motoristas_id', $motoristas_id);
		$editar = $this->db->update('motoristas', $data);
		
		return $editar;
	}
	
	function motoristas_exists($motoristas_descricao, $curso_id){
		$sql = 'SELECT * FROM motoristas WHERE motoristas_descricao = ? AND curso_id = ? LIMIT 1';
		$query = $this->db->query($sql, array($motoristas_descricao, $curso_id));
		return ($query->num_rows() == 1) ? TRUE : FALSE;
	}	

	function delete_motoristas($motoristas_id){
		/*
		if($this->check_if_motoristas_has_motoristas_horas($motoristas_id) == FALSE){
			$this->lasterr = 'Não foi possível excluir a turma selecionada. Há motoristas_horas pertencentes à esta turma.<br />Primeiro exclua as motoristas que utilizam este turma.';
			return FALSE;
		}
		
		if($this->check_if_motoristas_has_motoristas_descontos($motoristas_id) == FALSE){
			$this->lasterr = 'Não foi possível excluir o funcionario selecionado. Há motoristas_descontos pertencentes à este funcionario.<br />Primeiro exclua as motoristas que utilizam este funcionario.';
			return FALSE;
		}
		*/
		$sql = 'DELETE FROM motoristas WHERE motoristas_id = ? LIMIT 1';
		$query = $this->db->query($sql, array($motoristas_id));
		
		if($query == FALSE){
			
			$this->lasterr = 'Could not excluir motoristas. Do they exist?';
			return FALSE;
			
		} else {
			return TRUE;
		}
		
	}
	
	function check_if_motoristas_has_motoristas_horas($motoristas_id){
		$sql = 'SELECT motoristas_horas.motoristas_horas_id FROM motoristas_horas WHERE motoristas_horas.motoristas_horas_motoristas_id = ?';
		$query = $this->db->query($sql, array($motoristas_id));
		if($query->num_rows() == 0){
			return TRUE;
		} else {
			return FALSE;
		}
	}
	
	function check_if_motoristas_has_motoristas_descontos($motoristas_id){
		$sql = 'SELECT motoristas_descontos.motoristas_descontos_id FROM motoristas_descontos WHERE motoristas_descontos.motoristas_descontos_motoristas_id = ?';
		$query = $this->db->query($sql, array($motoristas_id));
		if($query->num_rows() == 0){
			return TRUE;
		} else {
			return FALSE;
		}
	}


	function get_motoristas_dropdown(){
		$sql = 'SELECT motoristas_id, motoristas_descricao FROM motoristas ORDER BY motoristas_descricao ASC';
		$query = $this->db->query($sql);
		if($query->num_rows() > 0){
			$result = $query->result();
			$motoristas = array(''=>'SELECIONE');
			foreach($result as $funcionario){
				$motoristas[$funcionario->motoristas_id] = $funcionario->motoristas_descricao;
			}
			return $motoristas;
		} else {
			$this->lasterr = 'No motoristas found';
			return FALSE;
		}
	}

	function get_motoristas_name($motoristas_id){
		if($motoristas_id == NULL || !is_numeric($motoristas_id)){
			$this->lasterr = 'No motoristas_id given or invalid data type.';
			return FALSE;
		}
		
		$sql = 'SELECT motoristas_descricao FROM motoristas WHERE motoristas_id = ? LIMIT 1';
		$query = $this->db->query($sql, array($motoristas_id));
		
		if($query->num_rows() == 1){
			$row = $query->row();
			return $row->motoristas_descricao;
		} else {
			$this->lasterr = sprintf('The motoristas supplied (ID: %d) does not exist.', $motoristas_id);
			return FALSE;
		}
	}
	
	function get_motoristas_comissao($motoristas_id){
		if($motoristas_id == NULL || !is_numeric($motoristas_id)){
			$this->lasterr = 'No motoristas_id given or invalid data type.';
			return FALSE;
		}
		
		$sql = 'SELECT motoristas_comissao FROM motoristas WHERE motoristas_id = ? LIMIT 1';
		$query = $this->db->query($sql, array($motoristas_id));
		
		if($query->num_rows() == 1){
			$row = $query->row();
			return $row->motoristas_comissao;
		} else {
			$this->lasterr = sprintf('The motoristas supplied (ID: %d) does not exist.', $motoristas_id);
			return FALSE;
		}
	}
	
	function get_motoristas_tipo_sala(){
	
		$sql = 'SELECT motoristas.motoristas_id, motoristas.motoristas_descricao, motoristas.motoristas_autor, motoristas.motoristas_horario_incio, motoristas.motoristas_horario_fim, motoristas.motoristas_ativo, motoristas_tipos.motoristas_tipo_id, motoristas_tipos.motoristas_tipo_nome, motoristas_salas.motoristas_sala_id, motoristas_salas.motoristas_sala_nome
				FROM motoristas, motoristas_tipos, motoristas_salas
				WHERE motoristas_tipos.motoristas_tipo_id = motoristas.motoristas_tipo_id
				AND motoristas_salas.motoristas_sala_id = motoristas.motoristas_sala_id
				ORDER BY motoristas.motoristas_id';
				
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