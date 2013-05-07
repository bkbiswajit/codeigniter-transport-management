<?php
class frotas_despesas_model extends Model{

	var $lasterr;
	
	function frotas_despesas_model(){
		parent::Model();
	}
	
	function get_caminhoes($frotas_despesas_id = NULL, $page = NULL){
		if ($frotas_despesas_id == NULL) {
		
			// Getting all frotas_despesas and number of usuarios in it
			$this->db->select('*');
			$this->db->from('frotas_despesas');
			
			$this->db->join('frotas', 'frotas_despesas.frotas_despesas_frotas_id = frotas.caminhoes_id', 'inner');
			
			$this->db->join('frotas_despesas_tipos', 'frotas_despesas.frotas_despesas_tipos_id = frotas_despesas_tipos.frotas_despesas_tipos_id', 'inner');
			
			$this->db->orderby('frotas_despesas.frotas_despesas_descricao ASC');
			
			if (isset($page) && is_array($page)) {
				$this->db->limit($page[0], $page[1]);
			}
			
			$query = $this->db->get();
			if ($query->num_rows() > 0){
				return $query->result();
			} else {
				$this->lasterr = 'No frotas_despesas available.';
				return 0;
			}
			
		} else {
			
			if (!is_numeric($frotas_despesas_id)) {
				return FALSE;
			}
			
			// Getting one frotas_despesas
			$sql = 'SELECT * FROM frotas_despesas WHERE frotas_despesas_id = ? LIMIT 1';
			$query = $this->db->query($sql, array($frotas_despesas_id));
			
			if($query->num_rows() == 1){
				
				// Got the frotas_despesas!
				$frotas_despesas = $query->row();
				return $frotas_despesas;
				
			} else {
				
				return FALSE;
				
			}
			
		}
		
	}
	
	/**
	 * Adicionar a frotas_despesas to the database
	 *
	 * @param	array	data	Array of frotas_despesas data to insert
	 * @return	bool
	 */
	function add_caminhoes($data){
		// Adicionar created date to the array to be inserted into the DB
		//$data['criado'] = date("Y-m-d");
		// Adicionar the user and get the ID
		/*
		$exists = $this->caminhoes_exists($data['frotas_despesas_descricao'], $data['curso_id']);
		if($exists == TRUE){
			$this->lasterr = 'Turma já existe no sistema.';
			return FALSE;
		}
		*/
		$adicionar = $this->db->insert('frotas_despesas', $data);
		$frotas_despesas_id = $this->db->insert_id();
		return $frotas_despesas_id;
	}

	/**
	 * Update data for a frotas_despesas
	 *
	 * @param	int		frotas_despesas_id	Group ID
	 * @param	array	data		Data
	 */
	function edit_caminhoes($frotas_despesas_id = NULL, $data){
		// Gotta have an ID
		if($frotas_despesas_id == NULL){
			$this->lasterr = 'Cannot update a frotas_despesas without their ID.';
			return FALSE;
		}
		/*
		$exists = $this->caminhoes_exists($data['frotas_despesas_descricao'], $data['curso_id']);
		if($exists == TRUE){
			$this->lasterr = 'Turma já existe no sistema.';
			return FALSE;
		}
		*/
		// Update frotas_despesas main details
		$this->db->where('frotas_despesas_id', $frotas_despesas_id);
		$editar = $this->db->update('frotas_despesas', $data);
		
		return $editar;
	}
	
	function caminhoes_exists($frotas_despesas_descricao, $curso_id){
		$sql = 'SELECT * FROM frotas_despesas WHERE frotas_despesas_descricao = ? AND curso_id = ? LIMIT 1';
		$query = $this->db->query($sql, array($frotas_despesas_descricao, $curso_id));
		return ($query->num_rows() == 1) ? TRUE : FALSE;
	}	

	function delete_caminhoes($frotas_despesas_id){
		
		if($this->check_if_caminhoes_has_controle_de_viagem($frotas_despesas_id) == FALSE){
			$this->lasterr = 'MODEL ERRO: 3';
			return FALSE;
		}
		
		$sql = 'DELETE FROM frotas_despesas WHERE frotas_despesas_id = ? LIMIT 1';
		$query = $this->db->query($sql, array($frotas_despesas_id));
		
		if($query == FALSE){
			
			$this->lasterr = 'Could not excluir frotas_despesas. Do they exist?';
			return FALSE;
			
		} else {
			return TRUE;
		}
		
	}
	
	function check_if_caminhoes_has_controle_de_viagem($frotas_despesas_id){
		$sql = 'SELECT controle_de_viagem_caminhao_id FROM controle_de_viagem WHERE controle_de_viagem_caminhao_id= ?';
		$query = $this->db->query($sql, array($frotas_despesas_id));
		if($query->num_rows() == 0){
			return TRUE;
		} else {
			return FALSE;
		}
	}
	
	function get_caminhoes_dropdown(){
		$sql = 'SELECT frotas_despesas_id, frotas_despesas_descricao FROM frotas_despesas ORDER BY frotas_despesas_descricao ASC';
		$query = $this->db->query($sql);
		if($query->num_rows() > 0){
			$result = $query->result();
			$frotas_despesas = array(''=>'SELECIONE');
			foreach($result as $funcionario){
				$frotas_despesas[$funcionario->frotas_despesas_id] = $funcionario->frotas_despesas_descricao;
			}
			return $frotas_despesas;
		} else {
			$this->lasterr = 'No frotas_despesas found';
			return FALSE;
		}
	}
	
	function get_caminhoes_controle_de_viagem_agenda_liberado_dropdown(){
		$sql = 'SELECT frotas_despesas_id, frotas_despesas_descricao FROM frotas_despesas WHERE frotas_despesas.caminhoes_controle_de_viagem_agenda_liberado=0 ORDER BY frotas_despesas_descricao ASC';
		$query = $this->db->query($sql);
		if($query->num_rows() > 0){
			$result = $query->result();
			$frotas_despesas = array(''=>'SELECIONE');
			foreach($result as $funcionario){
				$frotas_despesas[$funcionario->frotas_despesas_id] = $funcionario->frotas_despesas_descricao;
			}
			return $frotas_despesas;
		} else {
			$this->lasterr = 'No frotas_despesas found';
			return FALSE;
		}
	}

	function get_caminhoes_name($frotas_despesas_id){
		if($frotas_despesas_id == NULL || !is_numeric($frotas_despesas_id)){
			$this->lasterr = 'No frotas_despesas_id given or invalid data type.';
			return FALSE;
		}
		
		$sql = 'SELECT frotas_despesas_descricao FROM frotas_despesas WHERE frotas_despesas_id = ? LIMIT 1';
		$query = $this->db->query($sql, array($frotas_despesas_id));
		
		if($query->num_rows() == 1){
			$row = $query->row();
			return $row->frotas_despesas_descricao;
		} else {
			$this->lasterr = sprintf('The frotas_despesas supplied (ID: %d) does not exist.', $frotas_despesas_id);
			return FALSE;
		}
	}
	
	function get_caminhoes_tipo_sala(){
	
		$sql = 'SELECT frotas_despesas.frotas_despesas_id, frotas_despesas.frotas_despesas_descricao, frotas_despesas.caminhoes_autor, frotas_despesas.caminhoes_horario_incio, frotas_despesas.caminhoes_horario_fim, frotas_despesas.frotas_despesas_ativo, caminhoes_tipos.caminhoes_tipo_id, caminhoes_tipos.caminhoes_tipo_nome, caminhoes_salas.caminhoes_sala_id, caminhoes_salas.caminhoes_sala_nome
				FROM frotas_despesas, caminhoes_tipos, caminhoes_salas
				WHERE caminhoes_tipos.caminhoes_tipo_id = frotas_despesas.caminhoes_tipo_id
				AND caminhoes_salas.caminhoes_sala_id = frotas_despesas.caminhoes_sala_id
				ORDER BY frotas_despesas.frotas_despesas_id';
				
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