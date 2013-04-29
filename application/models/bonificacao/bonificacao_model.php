<?php
class bonificacao_model extends Model{

	var $lasterr;
	
	function bonificacao_model(){
		parent::Model();
	}
	
	function get_bonificacao($bonificacao_id = NULL, $page = NULL){
		if ($bonificacao_id == NULL) {
		
			// Getting all bonificacao and number of usuarios in it
			$this->db->select('bonificacao.*');
			$this->db->from('bonificacao');
			$this->db->orderby('bonificacao.bonificacao_id ASC');
			
			if (isset($page) && is_array($page)) {
				$this->db->limit($page[0], $page[1]);
			}
			
			$query = $this->db->get();
			if ($query->num_rows() > 0){
				return $query->result();
			} else {
				$this->lasterr = 'No bonificacao available.';
				return 0;
			}
			
		} else {
			
			if (!is_numeric($bonificacao_id)) {
				return FALSE;
			}
			
			// Getting one bonificacao
			$sql = 'SELECT * FROM bonificacao WHERE bonificacao_id = ? LIMIT 1';
			$query = $this->db->query($sql, array($bonificacao_id));
			
			if($query->num_rows() == 1){
				
				// Got the bonificacao!
				$bonificacao = $query->row();
				return $bonificacao;
				
			} else {
				
				return FALSE;
				
			}
			
		}
		
	}
	
	/**
	 * Adicionar a bonificacao to the database
	 *
	 * @param	array	data	Array of bonificacao data to insert
	 * @return	bool
	 */
	function add_bonificacao($data){
		// Adicionar created date to the array to be inserted into the DB
		//$data['criado'] = date("Y-m-d");
		// Adicionar the user and get the ID
		/*
		$exists = $this->bonificacao_exists($data['bonificacao_descricao'], $data['curso_id']);
		if($exists == TRUE){
			$this->lasterr = 'Turma já existe no sistema.';
			return FALSE;
		}
		*/
		$adicionar = $this->db->insert('bonificacao', $data);
		$bonificacao_id = $this->db->insert_id();
		return $bonificacao_id;
	}

	/**
	 * Update data for a bonificacao
	 *
	 * @param	int		bonificacao_id	Group ID
	 * @param	array	data		Data
	 */
	function edit_bonificacao($bonificacao_id = NULL, $data){
		// Gotta have an ID
		if($bonificacao_id == NULL){
			$this->lasterr = 'Cannot update a bonificacao without their ID.';
			return FALSE;
		}
		/*
		$exists = $this->bonificacao_exists($data['bonificacao_descricao'], $data['curso_id']);
		if($exists == TRUE){
			$this->lasterr = 'Turma já existe no sistema.';
			return FALSE;
		}
		*/
		// Update bonificacao main details
		$this->db->where('bonificacao_id', $bonificacao_id);
		$editar = $this->db->update('bonificacao', $data);
		
		return $editar;
	}
	
	function bonificacao_exists($bonificacao_descricao, $curso_id){
		$sql = 'SELECT * FROM bonificacao WHERE bonificacao_descricao = ? AND curso_id = ? LIMIT 1';
		$query = $this->db->query($sql, array($bonificacao_descricao, $curso_id));
		return ($query->num_rows() == 1) ? TRUE : FALSE;
	}	

	function delete_bonificacao($bonificacao_id){
	
		if($this->check_if_bonificacao_has_controle_de_viagem_bonificacao($bonificacao_id) == FALSE){
			$this->lasterr = 'MODEL ERRO: 3';
			return FALSE;
		}
		
		$sql = 'DELETE FROM bonificacao WHERE bonificacao_id = ? LIMIT 1';
		$query = $this->db->query($sql, array($bonificacao_id));
		
		if($query == FALSE){
			
			$this->lasterr = 'Could not excluir bonificacao. Do they exist?';
			return FALSE;
			
		} else {
			return TRUE;
		}
		
	}
	
	function check_if_bonificacao_has_controle_de_viagem_bonificacao($bonificacao_id){
		$sql = 'SELECT controle_de_viagem_bonificacao_bonificacao_id FROM controle_de_viagem_bonificacao WHERE controle_de_viagem_bonificacao_bonificacao_id = ?';
		$query = $this->db->query($sql, array($bonificacao_id));
		if($query->num_rows() == 0){
			return TRUE;
		} else {
			return FALSE;
		}
	}
	
	function check_if_bonificacao_has_bonificacao_descontos($bonificacao_id){
		$sql = 'SELECT bonificacao_descontos.bonificacao_descontos_id FROM bonificacao_descontos WHERE bonificacao_descontos.bonificacao_descontos_bonificacao_id = ?';
		$query = $this->db->query($sql, array($bonificacao_id));
		if($query->num_rows() == 0){
			return TRUE;
		} else {
			return FALSE;
		}
	}


	function get_bonificacao_dropdown(){
		$sql = 'SELECT bonificacao_id, bonificacao_descricao FROM bonificacao ORDER BY bonificacao_descricao ASC';
		$query = $this->db->query($sql);
		if($query->num_rows() > 0){
			$result = $query->result();
			$bonificacao = array();
			foreach($result as $funcionario){
				$bonificacao[$funcionario->bonificacao_id] = $funcionario->bonificacao_descricao;
			}
			return $bonificacao;
		} else {
			$this->lasterr = 'No bonificacao found';
			return FALSE;
		}
	}

	function get_bonificacao_name($bonificacao_id){
		if($bonificacao_id == NULL || !is_numeric($bonificacao_id)){
			$this->lasterr = 'No bonificacao_id given or invalid data type.';
			return FALSE;
		}
		
		$sql = 'SELECT bonificacao_descricao FROM bonificacao WHERE bonificacao_id = ? LIMIT 1';
		$query = $this->db->query($sql, array($bonificacao_id));
		
		if($query->num_rows() == 1){
			$row = $query->row();
			return $row->bonificacao_descricao;
		} else {
			$this->lasterr = sprintf('The bonificacao supplied (ID: %d) does not exist.', $bonificacao_id);
			return FALSE;
		}
	}
	
	function get_bonificacao_tipo_sala(){
	
		$sql = 'SELECT bonificacao.bonificacao_id, bonificacao.bonificacao_descricao, bonificacao.bonificacao_autor, bonificacao.bonificacao_horario_incio, bonificacao.bonificacao_horario_fim, bonificacao.bonificacao_ativo, bonificacao_tipos.bonificacao_tipo_id, bonificacao_tipos.bonificacao_tipo_nome, bonificacao_salas.bonificacao_sala_id, bonificacao_salas.bonificacao_sala_nome
				FROM bonificacao, bonificacao_tipos, bonificacao_salas
				WHERE bonificacao_tipos.bonificacao_tipo_id = bonificacao.bonificacao_tipo_id
				AND bonificacao_salas.bonificacao_sala_id = bonificacao.bonificacao_sala_id
				ORDER BY bonificacao.bonificacao_id';
				
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