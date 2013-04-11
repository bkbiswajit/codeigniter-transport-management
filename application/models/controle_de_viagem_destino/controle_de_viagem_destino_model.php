<?php
class controle_de_viagem_destino_model extends Model{

	var $lasterr;
	
	function controle_de_viagem_destino_model(){
		parent::Model();
	}
	
	function get_controle_de_viagem_destino($controle_de_viagem_destino_id = NULL, $page = NULL){
		if ($controle_de_viagem_destino_id == NULL) {
		
			// Getting all controle_de_viagem_destino and number of usuarios in it
			$this->db->select('controle_de_viagem_destino.*');
			$this->db->from('controle_de_viagem_destino');
			$this->db->orderby('controle_de_viagem_destino.controle_de_viagem_destino_descricao ASC');
			
			if (isset($page) && is_array($page)) {
				$this->db->limit($page[0], $page[1]);
			}
			
			$query = $this->db->get();
			if ($query->num_rows() > 0){
				return $query->result();
			} else {
				$this->lasterr = 'No controle_de_viagem_destino available.';
				return 0;
			}
			
		} else {
			
			if (!is_numeric($controle_de_viagem_destino_id)) {
				return FALSE;
			}
			
			// Getting one controle_de_viagem_destino
			$sql = 'SELECT * FROM controle_de_viagem_destino WHERE controle_de_viagem_destino_id = ? LIMIT 1';
			$query = $this->db->query($sql, array($controle_de_viagem_destino_id));
			
			if($query->num_rows() == 1){
				
				// Got the controle_de_viagem_destino!
				$controle_de_viagem_destino = $query->row();
				return $controle_de_viagem_destino;
				
			} else {
				
				return FALSE;
				
			}
			
		}
		
	}
	
	/**
	 * Adicionar a controle_de_viagem_destino to the database
	 *
	 * @param	array	data	Array of controle_de_viagem_destino data to insert
	 * @return	bool
	 */
	function add_controle_de_viagem_destino($data){
		// Adicionar created date to the array to be inserted into the DB
		//$data['criado'] = date("Y-m-d");
		// Adicionar the user and get the ID
		/*
		$exists = $this->controle_de_viagem_destino_exists($data['controle_de_viagem_destino_descricao'], $data['curso_id']);
		if($exists == TRUE){
			$this->lasterr = 'Turma já existe no sistema.';
			return FALSE;
		}
		*/
		$adicionar = $this->db->insert('controle_de_viagem_destino', $data);
		$controle_de_viagem_destino_id = $this->db->insert_id();
		return $controle_de_viagem_destino_id;
	}

	/**
	 * Update data for a controle_de_viagem_destino
	 *
	 * @param	int		controle_de_viagem_destino_id	Group ID
	 * @param	array	data		Data
	 */
	function edit_controle_de_viagem_destino($controle_de_viagem_destino_id = NULL, $data){
		// Gotta have an ID
		if($controle_de_viagem_destino_id == NULL){
			$this->lasterr = 'Cannot update a controle_de_viagem_destino without their ID.';
			return FALSE;
		}
		/*
		$exists = $this->controle_de_viagem_destino_exists($data['controle_de_viagem_destino_descricao'], $data['curso_id']);
		if($exists == TRUE){
			$this->lasterr = 'Turma já existe no sistema.';
			return FALSE;
		}
		*/
		// Update controle_de_viagem_destino main details
		$this->db->where('controle_de_viagem_destino_id', $controle_de_viagem_destino_id);
		$editar = $this->db->update('controle_de_viagem_destino', $data);
		
		return $editar;
	}
	
	function controle_de_viagem_destino_exists($controle_de_viagem_destino_descricao, $curso_id){
		$sql = 'SELECT * FROM controle_de_viagem_destino WHERE controle_de_viagem_destino_descricao = ? AND curso_id = ? LIMIT 1';
		$query = $this->db->query($sql, array($controle_de_viagem_destino_descricao, $curso_id));
		return ($query->num_rows() == 1) ? TRUE : FALSE;
	}	

	function delete_controle_de_viagem_destino($controle_de_viagem_destino_id){
		
		if($this->check_if_controle_de_viagem_destino_has_controle_de_viagem_viagens($controle_de_viagem_destino_id) == FALSE){
			$this->lasterr = 'MODEL ERRO: 3';
			return FALSE;
		}
		
		$sql = 'DELETE FROM controle_de_viagem_destino WHERE controle_de_viagem_destino_id = ? LIMIT 1';
		$query = $this->db->query($sql, array($controle_de_viagem_destino_id));
		
		if($query == FALSE){
			
			$this->lasterr = 'Could not excluir controle_de_viagem_destino. Do they exist?';
			return FALSE;
			
		} else {
			return TRUE;
		}
		
	}
	
	function check_if_controle_de_viagem_destino_has_controle_de_viagem_viagens($controle_de_viagem_destino_id){
		$sql = 'SELECT controle_de_viagem_viagens_destino_id FROM controle_de_viagem_viagens WHERE controle_de_viagem_viagens_destino_id = ?';
		$query = $this->db->query($sql, array($controle_de_viagem_destino_id));
		if($query->num_rows() == 0){
			return TRUE;
		} else {
			return FALSE;
		}
	}		

	function get_controle_de_viagem_destino_dropdown(){
		$sql = 'SELECT controle_de_viagem_destino_id, controle_de_viagem_destino_descricao FROM controle_de_viagem_destino ORDER BY controle_de_viagem_destino_descricao ASC';
		$query = $this->db->query($sql);
		if($query->num_rows() > 0){
			$result = $query->result();
			$controle_de_viagem_destino = array();
			foreach($result as $controle_de_viagem_viagens_tipo){
				$controle_de_viagem_destino[$controle_de_viagem_viagens_tipo->controle_de_viagem_destino_id] = $controle_de_viagem_viagens_tipo->controle_de_viagem_destino_descricao;
			}
			return $controle_de_viagem_destino;
		} else {
			$this->lasterr = 'No controle_de_viagem_destino found';
			return FALSE;
		}
	}

	function get_controle_de_viagem_destino_name($controle_de_viagem_destino_id){
		if($controle_de_viagem_destino_id == NULL || !is_numeric($controle_de_viagem_destino_id)){
			$this->lasterr = 'No controle_de_viagem_destino_id given or invalid data type.';
			return FALSE;
		}
		
		$sql = 'SELECT controle_de_viagem_destino_descricao FROM controle_de_viagem_destino WHERE controle_de_viagem_destino_id = ? LIMIT 1';
		$query = $this->db->query($sql, array($controle_de_viagem_destino_id));
		
		if($query->num_rows() == 1){
			$row = $query->row();
			return $row->controle_de_viagem_destino_descricao;
		} else {
			$this->lasterr = sprintf('The controle_de_viagem_destino supplied (ID: %d) does not exist.', $controle_de_viagem_destino_id);
			return FALSE;
		}
	}
	
	function get_controle_de_viagem_destino_tipo_sala(){
	
		$sql = 'SELECT controle_de_viagem_destino.controle_de_viagem_destino_id, controle_de_viagem_destino.controle_de_viagem_destino_descricao, controle_de_viagem_destino.controle_de_viagem_destino_autor, controle_de_viagem_destino.controle_de_viagem_destino_horario_incio, controle_de_viagem_destino.controle_de_viagem_destino_horario_fim, controle_de_viagem_destino.controle_de_viagem_destino_ativo, controle_de_viagem_destino_tipos.controle_de_viagem_destino_tipo_id, controle_de_viagem_destino_tipos.controle_de_viagem_destino_tipo_nome, controle_de_viagem_destino_salas.controle_de_viagem_destino_sala_id, controle_de_viagem_destino_salas.controle_de_viagem_destino_sala_nome
				FROM controle_de_viagem_destino, controle_de_viagem_destino_tipos, controle_de_viagem_destino_salas
				WHERE controle_de_viagem_destino_tipos.controle_de_viagem_destino_tipo_id = controle_de_viagem_destino.controle_de_viagem_destino_tipo_id
				AND controle_de_viagem_destino_salas.controle_de_viagem_destino_sala_id = controle_de_viagem_destino.controle_de_viagem_destino_sala_id
				ORDER BY controle_de_viagem_destino.controle_de_viagem_destino_id';
				
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