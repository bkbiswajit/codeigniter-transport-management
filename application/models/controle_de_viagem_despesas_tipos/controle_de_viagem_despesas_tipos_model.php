<?php
class controle_de_viagem_despesas_tipos_model extends Model{

	var $lasterr;
	
	function controle_de_viagem_despesas_tipos_model(){
		parent::Model();
	}
	
	function get_controle_de_viagem_despesas_tipos($controle_de_viagem_despesas_tipos_id = NULL, $page = NULL){
		if ($controle_de_viagem_despesas_tipos_id == NULL) {
		
			// Getting all controle_de_viagem_despesas_tipos and number of usuarios in it
			$this->db->select('controle_de_viagem_despesas_tipos.*');
			$this->db->from('controle_de_viagem_despesas_tipos');
			$this->db->orderby('controle_de_viagem_despesas_tipos.controle_de_viagem_despesas_tipos_descricao ASC');
			
			if (isset($page) && is_array($page)) {
				$this->db->limit($page[0], $page[1]);
			}
			
			$query = $this->db->get();
			if ($query->num_rows() > 0){
				return $query->result();
			} else {
				$this->lasterr = 'No controle_de_viagem_despesas_tipos available.';
				return 0;
			}
			
		} else {
			
			if (!is_numeric($controle_de_viagem_despesas_tipos_id)) {
				return FALSE;
			}
			
			// Getting one controle_de_viagem_despesas_tipos
			$sql = 'SELECT * FROM controle_de_viagem_despesas_tipos WHERE controle_de_viagem_despesas_tipos_id = ? LIMIT 1';
			$query = $this->db->query($sql, array($controle_de_viagem_despesas_tipos_id));
			
			if($query->num_rows() == 1){
				
				// Got the controle_de_viagem_despesas_tipos!
				$controle_de_viagem_despesas_tipos = $query->row();
				return $controle_de_viagem_despesas_tipos;
				
			} else {
				
				return FALSE;
				
			}
			
		}
		
	}
	
	/**
	 * Adicionar a controle_de_viagem_despesas_tipos to the database
	 *
	 * @param	array	data	Array of controle_de_viagem_despesas_tipos data to insert
	 * @return	bool
	 */
	function add_controle_de_viagem_despesas_tipos($data){
		// Adicionar created date to the array to be inserted into the DB
		//$data['criado'] = date("Y-m-d");
		// Adicionar the user and get the ID
		/*
		$exists = $this->controle_de_viagem_despesas_tipos_exists($data['controle_de_viagem_despesas_tipos_descricao'], $data['curso_id']);
		if($exists == TRUE){
			$this->lasterr = 'Turma já existe no sistema.';
			return FALSE;
		}
		*/
		$adicionar = $this->db->insert('controle_de_viagem_despesas_tipos', $data);
		$controle_de_viagem_despesas_tipos_id = $this->db->insert_id();
		return $controle_de_viagem_despesas_tipos_id;
	}

	/**
	 * Update data for a controle_de_viagem_despesas_tipos
	 *
	 * @param	int		controle_de_viagem_despesas_tipos_id	Group ID
	 * @param	array	data		Data
	 */
	function edit_controle_de_viagem_despesas_tipos($controle_de_viagem_despesas_tipos_id = NULL, $data){
		// Gotta have an ID
		if($controle_de_viagem_despesas_tipos_id == NULL){
			$this->lasterr = 'Cannot update a controle_de_viagem_despesas_tipos without their ID.';
			return FALSE;
		}
		/*
		$exists = $this->controle_de_viagem_despesas_tipos_exists($data['controle_de_viagem_despesas_tipos_descricao'], $data['curso_id']);
		if($exists == TRUE){
			$this->lasterr = 'Turma já existe no sistema.';
			return FALSE;
		}
		*/
		// Update controle_de_viagem_despesas_tipos main details
		$this->db->where('controle_de_viagem_despesas_tipos_id', $controle_de_viagem_despesas_tipos_id);
		$editar = $this->db->update('controle_de_viagem_despesas_tipos', $data);
		
		return $editar;
	}
	
	function controle_de_viagem_despesas_tipos_exists($controle_de_viagem_despesas_tipos_descricao, $curso_id){
		$sql = 'SELECT * FROM controle_de_viagem_despesas_tipos WHERE controle_de_viagem_despesas_tipos_descricao = ? AND curso_id = ? LIMIT 1';
		$query = $this->db->query($sql, array($controle_de_viagem_despesas_tipos_descricao, $curso_id));
		return ($query->num_rows() == 1) ? TRUE : FALSE;
	}	

	function delete_controle_de_viagem_despesas_tipos($controle_de_viagem_despesas_tipos_id){
		
		if($this->check_if_controle_de_viagem_despesas_tipos_has_despesas($controle_de_viagem_despesas_tipos_id) == FALSE){
			$this->lasterr = 'Não foi possível excluir a o tipo de despesa selecionado. Há despesas pertencentes à este tipo de despesa.<br />Primeiro exclua as despesas que utilizam este o tipo de despesa.';
			return FALSE;
		}
		
		$sql = 'DELETE FROM controle_de_viagem_despesas_tipos WHERE controle_de_viagem_despesas_tipos_id = ? LIMIT 1';
		$query = $this->db->query($sql, array($controle_de_viagem_despesas_tipos_id));
		
		if($query == FALSE){
			
			$this->lasterr = 'Could not excluir controle_de_viagem_despesas_tipos. Do they exist?';
			return FALSE;
			
		} else {
			return TRUE;
		}
		
	}
	
	function check_if_controle_de_viagem_despesas_tipos_has_despesas($controle_de_viagem_despesas_tipos_id){
		$sql = 'SELECT controle_de_viagem_despesas_tipos_id FROM despesas WHERE controle_de_viagem_despesas_tipos_id = ?';
		$query = $this->db->query($sql, array($controle_de_viagem_despesas_tipos_id));
		if($query->num_rows() == 0){
			return TRUE;
		} else {
			return FALSE;
		}
	}		

	function get_controle_de_viagem_despesas_tipos_dropdown(){
		$sql = 'SELECT controle_de_viagem_despesas_tipos_id, controle_de_viagem_despesas_tipos_descricao FROM controle_de_viagem_despesas_tipos ORDER BY controle_de_viagem_despesas_tipos_descricao ASC';
		$query = $this->db->query($sql);
		if($query->num_rows() > 0){
			$result = $query->result();
			$controle_de_viagem_despesas_tipos = array();
			foreach($result as $despesas_tipo){
				$controle_de_viagem_despesas_tipos[$despesas_tipo->controle_de_viagem_despesas_tipos_id] = $despesas_tipo->controle_de_viagem_despesas_tipos_descricao;
			}
			return $controle_de_viagem_despesas_tipos;
		} else {
			$this->lasterr = 'No controle_de_viagem_despesas_tipos found';
			return FALSE;
		}
	}

	function get_controle_de_viagem_despesas_tipos_name($controle_de_viagem_despesas_tipos_id){
		if($controle_de_viagem_despesas_tipos_id == NULL || !is_numeric($controle_de_viagem_despesas_tipos_id)){
			$this->lasterr = 'No controle_de_viagem_despesas_tipos_id given or invalid data type.';
			return FALSE;
		}
		
		$sql = 'SELECT controle_de_viagem_despesas_tipos_descricao FROM controle_de_viagem_despesas_tipos WHERE controle_de_viagem_despesas_tipos_id = ? LIMIT 1';
		$query = $this->db->query($sql, array($controle_de_viagem_despesas_tipos_id));
		
		if($query->num_rows() == 1){
			$row = $query->row();
			return $row->controle_de_viagem_despesas_tipos_descricao;
		} else {
			$this->lasterr = sprintf('The controle_de_viagem_despesas_tipos supplied (ID: %d) does not exist.', $controle_de_viagem_despesas_tipos_id);
			return FALSE;
		}
	}
	
	function get_controle_de_viagem_despesas_tipos_tipo_sala(){
	
		$sql = 'SELECT controle_de_viagem_despesas_tipos.controle_de_viagem_despesas_tipos_id, controle_de_viagem_despesas_tipos.controle_de_viagem_despesas_tipos_descricao, controle_de_viagem_despesas_tipos.controle_de_viagem_despesas_tipos_autor, controle_de_viagem_despesas_tipos.controle_de_viagem_despesas_tipos_horario_incio, controle_de_viagem_despesas_tipos.controle_de_viagem_despesas_tipos_horario_fim, controle_de_viagem_despesas_tipos.controle_de_viagem_despesas_tipos_ativo, controle_de_viagem_despesas_tipos_tipos.controle_de_viagem_despesas_tipos_tipo_id, controle_de_viagem_despesas_tipos_tipos.controle_de_viagem_despesas_tipos_tipo_nome, controle_de_viagem_despesas_tipos_salas.controle_de_viagem_despesas_tipos_sala_id, controle_de_viagem_despesas_tipos_salas.controle_de_viagem_despesas_tipos_sala_nome
				FROM controle_de_viagem_despesas_tipos, controle_de_viagem_despesas_tipos_tipos, controle_de_viagem_despesas_tipos_salas
				WHERE controle_de_viagem_despesas_tipos_tipos.controle_de_viagem_despesas_tipos_tipo_id = controle_de_viagem_despesas_tipos.controle_de_viagem_despesas_tipos_tipo_id
				AND controle_de_viagem_despesas_tipos_salas.controle_de_viagem_despesas_tipos_sala_id = controle_de_viagem_despesas_tipos.controle_de_viagem_despesas_tipos_sala_id
				ORDER BY controle_de_viagem_despesas_tipos.controle_de_viagem_despesas_tipos_id';
				
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