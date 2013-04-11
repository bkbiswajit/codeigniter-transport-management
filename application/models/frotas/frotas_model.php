<?php
class frotas_model extends Model{

	var $lasterr;
	
	function frotas_model(){
		parent::Model();
	}
	
	function get_caminhoes($caminhoes_id = NULL, $page = NULL){
		if ($caminhoes_id == NULL) {
		
			// Getting all frotas and number of usuarios in it
			$this->db->select('frotas.*');
			$this->db->from('frotas');
			$this->db->orderby('frotas.caminhoes_descricao ASC');
			
			if (isset($page) && is_array($page)) {
				$this->db->limit($page[0], $page[1]);
			}
			
			$query = $this->db->get();
			if ($query->num_rows() > 0){
				return $query->result();
			} else {
				$this->lasterr = 'No frotas available.';
				return 0;
			}
			
		} else {
			
			if (!is_numeric($caminhoes_id)) {
				return FALSE;
			}
			
			// Getting one frotas
			$sql = 'SELECT * FROM frotas WHERE caminhoes_id = ? LIMIT 1';
			$query = $this->db->query($sql, array($caminhoes_id));
			
			if($query->num_rows() == 1){
				
				// Got the frotas!
				$frotas = $query->row();
				return $frotas;
				
			} else {
				
				return FALSE;
				
			}
			
		}
		
	}
	
	/**
	 * Adicionar a frotas to the database
	 *
	 * @param	array	data	Array of frotas data to insert
	 * @return	bool
	 */
	function add_caminhoes($data){
		// Adicionar created date to the array to be inserted into the DB
		//$data['criado'] = date("Y-m-d");
		// Adicionar the user and get the ID
		/*
		$exists = $this->caminhoes_exists($data['caminhoes_descricao'], $data['curso_id']);
		if($exists == TRUE){
			$this->lasterr = 'Turma já existe no sistema.';
			return FALSE;
		}
		*/
		$adicionar = $this->db->insert('frotas', $data);
		$caminhoes_id = $this->db->insert_id();
		return $caminhoes_id;
	}

	/**
	 * Update data for a frotas
	 *
	 * @param	int		caminhoes_id	Group ID
	 * @param	array	data		Data
	 */
	function edit_caminhoes($caminhoes_id = NULL, $data){
		// Gotta have an ID
		if($caminhoes_id == NULL){
			$this->lasterr = 'Cannot update a frotas without their ID.';
			return FALSE;
		}
		/*
		$exists = $this->caminhoes_exists($data['caminhoes_descricao'], $data['curso_id']);
		if($exists == TRUE){
			$this->lasterr = 'Turma já existe no sistema.';
			return FALSE;
		}
		*/
		// Update frotas main details
		$this->db->where('caminhoes_id', $caminhoes_id);
		$editar = $this->db->update('frotas', $data);
		
		return $editar;
	}
	
	function caminhoes_exists($caminhoes_descricao, $curso_id){
		$sql = 'SELECT * FROM frotas WHERE caminhoes_descricao = ? AND curso_id = ? LIMIT 1';
		$query = $this->db->query($sql, array($caminhoes_descricao, $curso_id));
		return ($query->num_rows() == 1) ? TRUE : FALSE;
	}	

	function delete_caminhoes($caminhoes_id){
		
		if($this->check_if_caminhoes_has_controle_de_viagem($caminhoes_id) == FALSE){
			$this->lasterr = 'MODEL ERRO: 3';
			return FALSE;
		}
		
		$sql = 'DELETE FROM frotas WHERE caminhoes_id = ? LIMIT 1';
		$query = $this->db->query($sql, array($caminhoes_id));
		
		if($query == FALSE){
			
			$this->lasterr = 'Could not excluir frotas. Do they exist?';
			return FALSE;
			
		} else {
			return TRUE;
		}
		
	}
	
	function check_if_caminhoes_has_controle_de_viagem($caminhoes_id){
		$sql = 'SELECT controle_de_viagem_caminhao_id FROM controle_de_viagem WHERE controle_de_viagem_caminhao_id= ?';
		$query = $this->db->query($sql, array($caminhoes_id));
		if($query->num_rows() == 0){
			return TRUE;
		} else {
			return FALSE;
		}
	}
	
	function get_caminhoes_dropdown(){
		$sql = 'SELECT caminhoes_id, caminhoes_descricao FROM frotas ORDER BY caminhoes_descricao ASC';
		$query = $this->db->query($sql);
		if($query->num_rows() > 0){
			$result = $query->result();
			$frotas = array(''=>'SELECIONE');
			foreach($result as $funcionario){
				$frotas[$funcionario->caminhoes_id] = $funcionario->caminhoes_descricao;
			}
			return $frotas;
		} else {
			$this->lasterr = 'No frotas found';
			return FALSE;
		}
	}
	
	function get_caminhoes_controle_de_viagem_agenda_liberado_dropdown(){
		$sql = 'SELECT caminhoes_id, caminhoes_descricao FROM frotas WHERE frotas.caminhoes_controle_de_viagem_agenda_liberado=0 ORDER BY caminhoes_descricao ASC';
		$query = $this->db->query($sql);
		if($query->num_rows() > 0){
			$result = $query->result();
			$frotas = array(''=>'SELECIONE');
			foreach($result as $funcionario){
				$frotas[$funcionario->caminhoes_id] = $funcionario->caminhoes_descricao;
			}
			return $frotas;
		} else {
			$this->lasterr = 'No frotas found';
			return FALSE;
		}
	}

	function get_caminhoes_name($caminhoes_id){
		if($caminhoes_id == NULL || !is_numeric($caminhoes_id)){
			$this->lasterr = 'No caminhoes_id given or invalid data type.';
			return FALSE;
		}
		
		$sql = 'SELECT caminhoes_descricao FROM frotas WHERE caminhoes_id = ? LIMIT 1';
		$query = $this->db->query($sql, array($caminhoes_id));
		
		if($query->num_rows() == 1){
			$row = $query->row();
			return $row->caminhoes_descricao;
		} else {
			$this->lasterr = sprintf('The frotas supplied (ID: %d) does not exist.', $caminhoes_id);
			return FALSE;
		}
	}
	
	function get_caminhoes_tipo_sala(){
	
		$sql = 'SELECT frotas.caminhoes_id, frotas.caminhoes_descricao, frotas.caminhoes_autor, frotas.caminhoes_horario_incio, frotas.caminhoes_horario_fim, frotas.caminhoes_ativo, caminhoes_tipos.caminhoes_tipo_id, caminhoes_tipos.caminhoes_tipo_nome, caminhoes_salas.caminhoes_sala_id, caminhoes_salas.caminhoes_sala_nome
				FROM frotas, caminhoes_tipos, caminhoes_salas
				WHERE caminhoes_tipos.caminhoes_tipo_id = frotas.caminhoes_tipo_id
				AND caminhoes_salas.caminhoes_sala_id = frotas.caminhoes_sala_id
				ORDER BY frotas.caminhoes_id';
				
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