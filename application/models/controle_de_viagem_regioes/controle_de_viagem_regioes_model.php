<?php
class controle_de_viagem_regioes_model extends Model{

	var $lasterr;
	
	function controle_de_viagem_regioes_model(){
		parent::Model();
	}
	
	function get_controle_de_viagem_regioes($controle_de_viagem_regioes_id = NULL, $page = NULL){
		if ($controle_de_viagem_regioes_id == NULL) {
		
			// Getting all controle_de_viagem_regioes and number of usuarios in it
			$this->db->select('controle_de_viagem_regioes.*');
			$this->db->from('controle_de_viagem_regioes');
			$this->db->orderby('controle_de_viagem_regioes.controle_de_viagem_regioes_descricao ASC');
			
			if (isset($page) && is_array($page)) {
				$this->db->limit($page[0], $page[1]);
			}
			
			$query = $this->db->get();
			if ($query->num_rows() > 0){
				return $query->result();
			} else {
				$this->lasterr = 'No controle_de_viagem_regioes available.';
				return 0;
			}
			
		} else {
			
			if (!is_numeric($controle_de_viagem_regioes_id)) {
				return FALSE;
			}
			
			// Getting one controle_de_viagem_regioes
			$sql = 'SELECT * FROM controle_de_viagem_regioes WHERE controle_de_viagem_regioes_id = ? LIMIT 1';
			$query = $this->db->query($sql, array($controle_de_viagem_regioes_id));
			
			if($query->num_rows() == 1){
				
				// Got the controle_de_viagem_regioes!
				$controle_de_viagem_regioes = $query->row();
				return $controle_de_viagem_regioes;
				
			} else {
				
				return FALSE;
				
			}
			
		}
		
	}
	
	/**
	 * Adicionar a controle_de_viagem_regioes to the database
	 *
	 * @param	array	data	Array of controle_de_viagem_regioes data to insert
	 * @return	bool
	 */
	function add_controle_de_viagem_regioes($data){
		// Adicionar created date to the array to be inserted into the DB
		//$data['criado'] = date("Y-m-d");
		// Adicionar the user and get the ID
		/*
		$exists = $this->controle_de_viagem_regioes_exists($data['controle_de_viagem_regioes_descricao'], $data['curso_id']);
		if($exists == TRUE){
			$this->lasterr = 'Turma já existe no sistema.';
			return FALSE;
		}
		*/
		$adicionar = $this->db->insert('controle_de_viagem_regioes', $data);
		$controle_de_viagem_regioes_id = $this->db->insert_id();
		return $controle_de_viagem_regioes_id;
	}

	/**
	 * Update data for a controle_de_viagem_regioes
	 *
	 * @param	int		controle_de_viagem_regioes_id	Group ID
	 * @param	array	data		Data
	 */
	function edit_controle_de_viagem_regioes($controle_de_viagem_regioes_id = NULL, $data){
		// Gotta have an ID
		if($controle_de_viagem_regioes_id == NULL){
			$this->lasterr = 'Cannot update a controle_de_viagem_regioes without their ID.';
			return FALSE;
		}
		/*
		$exists = $this->controle_de_viagem_regioes_exists($data['controle_de_viagem_regioes_descricao'], $data['curso_id']);
		if($exists == TRUE){
			$this->lasterr = 'Turma já existe no sistema.';
			return FALSE;
		}
		*/
		// Update controle_de_viagem_regioes main details
		$this->db->where('controle_de_viagem_regioes_id', $controle_de_viagem_regioes_id);
		$editar = $this->db->update('controle_de_viagem_regioes', $data);
		
		return $editar;
	}
	
	function controle_de_viagem_regioes_exists($controle_de_viagem_regioes_descricao, $curso_id){
		$sql = 'SELECT * FROM controle_de_viagem_regioes WHERE controle_de_viagem_regioes_descricao = ? AND curso_id = ? LIMIT 1';
		$query = $this->db->query($sql, array($controle_de_viagem_regioes_descricao, $curso_id));
		return ($query->num_rows() == 1) ? TRUE : FALSE;
	}	

	function delete_controle_de_viagem_regioes($controle_de_viagem_regioes_id){
		
		if($this->check_if_controle_de_viagem_regioes_has_despesas($controle_de_viagem_regioes_id) == FALSE){
			$this->lasterr = 'Não foi possível excluir a o tipo de despesa selecionado. Há despesas pertencentes à este tipo de despesa.<br />Primeiro exclua as despesas que utilizam este o tipo de despesa.';
			return FALSE;
		}
		
		$sql = 'DELETE FROM controle_de_viagem_regioes WHERE controle_de_viagem_regioes_id = ? LIMIT 1';
		$query = $this->db->query($sql, array($controle_de_viagem_regioes_id));
		
		if($query == FALSE){
			
			$this->lasterr = 'Could not excluir controle_de_viagem_regioes. Do they exist?';
			return FALSE;
			
		} else {
			return TRUE;
		}
		
	}
	
	function check_if_controle_de_viagem_regioes_has_despesas($controle_de_viagem_regioes_id){
		$sql = 'SELECT controle_de_viagem_regioes_id FROM despesas WHERE controle_de_viagem_regioes_id = ?';
		$query = $this->db->query($sql, array($controle_de_viagem_regioes_id));
		if($query->num_rows() == 0){
			return TRUE;
		} else {
			return FALSE;
		}
	}		

	function get_controle_de_viagem_regioes_dropdown(){
		$sql = 'SELECT controle_de_viagem_regioes_id, controle_de_viagem_regioes_descricao FROM controle_de_viagem_regioes WHERE controle_de_viagem_regioes_ativo = 1  ORDER BY controle_de_viagem_regioes_descricao ASC';
		$query = $this->db->query($sql);
		if($query->num_rows() > 0){
			$result = $query->result();
			$controle_de_viagem_regioes = array(''=>'SELECIONE');
			foreach($result as $despesas_tipo){
				$controle_de_viagem_regioes[$despesas_tipo->controle_de_viagem_regioes_id] = $despesas_tipo->controle_de_viagem_regioes_descricao;
			}
			return $controle_de_viagem_regioes;
		} else {
			$this->lasterr = 'No controle_de_viagem_regioes found';
			return FALSE;
		}
	}

	function get_controle_de_viagem_regioes_name($controle_de_viagem_regioes_id){
		if($controle_de_viagem_regioes_id == NULL || !is_numeric($controle_de_viagem_regioes_id)){
			$this->lasterr = 'No controle_de_viagem_regioes_id given or invalid data type.';
			return FALSE;
		}
		
		$sql = 'SELECT controle_de_viagem_regioes_descricao FROM controle_de_viagem_regioes WHERE controle_de_viagem_regioes_id = ? LIMIT 1';
		$query = $this->db->query($sql, array($controle_de_viagem_regioes_id));
		
		if($query->num_rows() == 1){
			$row = $query->row();
			return $row->controle_de_viagem_regioes_descricao;
		} else {
			$this->lasterr = sprintf('The controle_de_viagem_regioes supplied (ID: %d) does not exist.', $controle_de_viagem_regioes_id);
			return FALSE;
		}
	}
	
	function get_controle_de_viagem_regioes_tipo_sala(){
	
		$sql = 'SELECT controle_de_viagem_regioes.controle_de_viagem_regioes_id, controle_de_viagem_regioes.controle_de_viagem_regioes_descricao, controle_de_viagem_regioes.controle_de_viagem_regioes_autor, controle_de_viagem_regioes.controle_de_viagem_regioes_horario_incio, controle_de_viagem_regioes.controle_de_viagem_regioes_horario_fim, controle_de_viagem_regioes.controle_de_viagem_regioes_ativo, controle_de_viagem_regioes_tipos.controle_de_viagem_regioes_tipo_id, controle_de_viagem_regioes_tipos.controle_de_viagem_regioes_tipo_nome, controle_de_viagem_regioes_salas.controle_de_viagem_regioes_sala_id, controle_de_viagem_regioes_salas.controle_de_viagem_regioes_sala_nome
				FROM controle_de_viagem_regioes, controle_de_viagem_regioes_tipos, controle_de_viagem_regioes_salas
				WHERE controle_de_viagem_regioes_tipos.controle_de_viagem_regioes_tipo_id = controle_de_viagem_regioes.controle_de_viagem_regioes_tipo_id
				AND controle_de_viagem_regioes_salas.controle_de_viagem_regioes_sala_id = controle_de_viagem_regioes.controle_de_viagem_regioes_sala_id
				ORDER BY controle_de_viagem_regioes.controle_de_viagem_regioes_id';
				
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