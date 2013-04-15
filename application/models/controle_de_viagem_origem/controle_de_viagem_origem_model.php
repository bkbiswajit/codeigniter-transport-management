<?php
class controle_de_viagem_origem_model extends Model{

	var $lasterr;
	
	function controle_de_viagem_origem_model(){
		parent::Model();
	}
	
	function get_controle_de_viagem_origem($controle_de_viagem_origem_id = NULL, $page = NULL){
		if ($controle_de_viagem_origem_id == NULL) {
			
			$this->db->select('controle_de_viagem_origem.*');
			$this->db->from('controle_de_viagem_origem');
			$this->db->orderby('controle_de_viagem_origem.controle_de_viagem_origem_descricao ASC');
			
			// $this->db->select('*');
			// $this->db->from('tb_cidade');
			// $this->db->join('tb_estado', 'tb_cidade.fk_cod_estado = tb_estado.cod_estado', 'inner');
			// $this->db->orderby('tb_cidade.cidade_descricao ASC');

			if (isset($page) && is_array($page)) {
				$this->db->limit($page[0], $page[1]);
			}
			
			$query = $this->db->get();
			if ($query->num_rows() > 0){
				return $query->result();
			} else {
				$this->lasterr = 'No controle_de_viagem_origem available.';
				return 0;
			}
			
		} else {
			
			if (!is_numeric($controle_de_viagem_origem_id)) {
				return FALSE;
			}
			
			// Getting one controle_de_viagem_origem
			$sql = 'SELECT * FROM controle_de_viagem_origem WHERE controle_de_viagem_origem_id = ? LIMIT 1';
			$query = $this->db->query($sql, array($controle_de_viagem_origem_id));
			
			if($query->num_rows() == 1){
				
				// Got the controle_de_viagem_origem!
				$controle_de_viagem_origem = $query->row();
				return $controle_de_viagem_origem;
				
			} else {
				
				return FALSE;
				
			}
			
		}
		
	}
	
	/**
	 * Adicionar a controle_de_viagem_origem to the database
	 *
	 * @param	array	data	Array of controle_de_viagem_origem data to insert
	 * @return	bool
	 */
	function add_controle_de_viagem_origem($data){
		// Adicionar created date to the array to be inserted into the DB
		//$data['criado'] = date("Y-m-d");
		// Adicionar the user and get the ID
		/*
		$exists = $this->controle_de_viagem_origem_exists($data['controle_de_viagem_origem_descricao'], $data['curso_id']);
		if($exists == TRUE){
			$this->lasterr = 'Turma já existe no sistema.';
			return FALSE;
		}
		*/
		$adicionar = $this->db->insert('controle_de_viagem_origem', $data);
		$controle_de_viagem_origem_id = $this->db->insert_id();
		return $controle_de_viagem_origem_id;
	}

	/**
	 * Update data for a controle_de_viagem_origem
	 *
	 * @param	int		controle_de_viagem_origem_id	Group ID
	 * @param	array	data		Data
	 */
	function edit_controle_de_viagem_origem($controle_de_viagem_origem_id = NULL, $data){
		// Gotta have an ID
		if($controle_de_viagem_origem_id == NULL){
			$this->lasterr = 'Cannot update a controle_de_viagem_origem without their ID.';
			return FALSE;
		}
		/*
		$exists = $this->controle_de_viagem_origem_exists($data['controle_de_viagem_origem_descricao'], $data['curso_id']);
		if($exists == TRUE){
			$this->lasterr = 'Turma já existe no sistema.';
			return FALSE;
		}
		*/
		// Update controle_de_viagem_origem main details
		$this->db->where('controle_de_viagem_origem_id', $controle_de_viagem_origem_id);
		$editar = $this->db->update('controle_de_viagem_origem', $data);
		
		return $editar;
	}
	
	function controle_de_viagem_origem_exists($controle_de_viagem_origem_descricao, $curso_id){
		$sql = 'SELECT * FROM controle_de_viagem_origem WHERE controle_de_viagem_origem_descricao = ? AND curso_id = ? LIMIT 1';
		$query = $this->db->query($sql, array($controle_de_viagem_origem_descricao, $curso_id));
		return ($query->num_rows() == 1) ? TRUE : FALSE;
	}	

	function delete_controle_de_viagem_origem($controle_de_viagem_origem_id){
		
		if($this->check_if_controle_de_viagem_origem_has_controle_de_viagem_viagens($controle_de_viagem_origem_id) == FALSE){
			$this->lasterr = 'MODEL ERRO: 3';
			return FALSE;
		}
		
		$sql = 'DELETE FROM controle_de_viagem_origem WHERE controle_de_viagem_origem_id = ? LIMIT 1';
		$query = $this->db->query($sql, array($controle_de_viagem_origem_id));
		
		if($query == FALSE){
			
			$this->lasterr = 'Could not excluir controle_de_viagem_origem. Do they exist?';
			return FALSE;
			
		} else {
			return TRUE;
		}
		
	}
	
	function check_if_controle_de_viagem_origem_has_controle_de_viagem_viagens($controle_de_viagem_origem_id){
		$sql = 'SELECT controle_de_viagem_viagens_origem_id FROM controle_de_viagem_viagens WHERE controle_de_viagem_viagens_origem_id = ?';
		$query = $this->db->query($sql, array($controle_de_viagem_origem_id));
		if($query->num_rows() == 0){
			return TRUE;
		} else {
			return FALSE;
		}
	}		

	function get_controle_de_viagem_origem_dropdown(){
		$sql = 'SELECT controle_de_viagem_origem_id, controle_de_viagem_origem_descricao FROM controle_de_viagem_origem ORDER BY controle_de_viagem_origem_descricao ASC';
		$query = $this->db->query($sql);
		if($query->num_rows() > 0){
			$result = $query->result();
			$controle_de_viagem_origem = array(''=>'SELECIONE');
			foreach($result as $controle_de_viagem_viagens_tipo){
				$controle_de_viagem_origem[$controle_de_viagem_viagens_tipo->controle_de_viagem_origem_id] = $controle_de_viagem_viagens_tipo->controle_de_viagem_origem_descricao;
			}
			return $controle_de_viagem_origem;
		} else {
			$this->lasterr = 'No controle_de_viagem_origem found';
			return FALSE;
		}
	}

	function get_controle_de_viagem_origem_name($controle_de_viagem_origem_id){
		if($controle_de_viagem_origem_id == NULL || !is_numeric($controle_de_viagem_origem_id)){
			$this->lasterr = 'No controle_de_viagem_origem_id given or invalid data type.';
			return FALSE;
		}
		
		$sql = 'SELECT controle_de_viagem_origem_descricao FROM controle_de_viagem_origem WHERE controle_de_viagem_origem_id = ? LIMIT 1';
		$query = $this->db->query($sql, array($controle_de_viagem_origem_id));
		
		if($query->num_rows() == 1){
			$row = $query->row();
			return $row->controle_de_viagem_origem_descricao;
		} else {
			$this->lasterr = sprintf('The controle_de_viagem_origem supplied (ID: %d) does not exist.', $controle_de_viagem_origem_id);
			return FALSE;
		}
	}
	
	function get_controle_de_viagem_origem_tipo_sala(){
	
		$sql = 'SELECT controle_de_viagem_origem.controle_de_viagem_origem_id, controle_de_viagem_origem.controle_de_viagem_origem_descricao, controle_de_viagem_origem.controle_de_viagem_origem_autor, controle_de_viagem_origem.controle_de_viagem_origem_horario_incio, controle_de_viagem_origem.controle_de_viagem_origem_horario_fim, controle_de_viagem_origem.controle_de_viagem_origem_ativo, controle_de_viagem_origem_tipos.controle_de_viagem_origem_tipo_id, controle_de_viagem_origem_tipos.controle_de_viagem_origem_tipo_nome, controle_de_viagem_origem_salas.controle_de_viagem_origem_sala_id, controle_de_viagem_origem_salas.controle_de_viagem_origem_sala_nome
				FROM controle_de_viagem_origem, controle_de_viagem_origem_tipos, controle_de_viagem_origem_salas
				WHERE controle_de_viagem_origem_tipos.controle_de_viagem_origem_tipo_id = controle_de_viagem_origem.controle_de_viagem_origem_tipo_id
				AND controle_de_viagem_origem_salas.controle_de_viagem_origem_sala_id = controle_de_viagem_origem.controle_de_viagem_origem_sala_id
				ORDER BY controle_de_viagem_origem.controle_de_viagem_origem_id';
				
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