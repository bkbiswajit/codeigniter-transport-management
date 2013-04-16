<?php
class recebimentos_model extends Model{

	var $lasterr;
	
	function recebimentos_model(){
		parent::Model();
	}
	
	function get_recebimentos($recebimentos_id = NULL, $recebimentos_serie = NULL, $recebimentos_recebido = NULL, $page = NULL){
		if ($recebimentos_id == NULL) {
		
			// Getting all recebimentos and number of usuarios in it
			$this->db->select('*');
			$this->db->from('recebimentos');

			if ($recebimentos_serie != NULL) {
				$this->db->where('recebimentos_serie', $recebimentos_serie);
			}

			if ($recebimentos_recebido != NULL) {
				$this->db->where('recebimentos_recebido', $recebimentos_recebido);
			}

			$this->db->join('clientes', 'recebimentos.recebimentos_clientes_id = clientes.clientes_id', 'inner');
			
			$this->db->orderby('recebimentos.recebimentos_data DESC');

			if (isset($page) && is_array($page)) {
				$this->db->limit($page[0], $page[1]);
			}
			
			$query = $this->db->get();
			if ($query->num_rows() > 0){
				return $query->result();
			} else {
				$this->lasterr = 'No recebimentos available.';
				return 0;
			}
			
		} else {
			
			if (!is_numeric($recebimentos_id)) {
				return FALSE;
			}
			
			// Getting one recebimentos
			$sql = 'SELECT * FROM recebimentos WHERE recebimentos_id = ? LIMIT 1';
			$query = $this->db->query($sql, array($recebimentos_id));
			
			if($query->num_rows() == 1){
				
				// Got the recebimentos!
				$recebimentos = $query->row();
				return $recebimentos;
				
			} else {
				
				return FALSE;
				
			}
			
		}
		
	}
	
	/**
	 * Adicionar a recebimentos to the database
	 *
	 * @param	array	data	Array of recebimentos data to insert
	 * @return	bool
	 */
	function add_recebimentos($data){
		// Adicionar created date to the array to be inserted into the DB
		//$data['criado'] = date("Y-m-d");
		// Adicionar the user and get the ID
		/*
		$exists = $this->recebimentos_exists($data['recebimentos_descricao'], $data['curso_id']);
		if($exists == TRUE){
			$this->lasterr = 'Turma já existe no sistema.';
			return FALSE;
		}
		*/
		$adicionar = $this->db->insert('recebimentos', $data);
		$recebimentos_id = $this->db->insert_id();
		return $recebimentos_id;
	}

	/**
	 * Update data for a recebimentos
	 *
	 * @param	int		recebimentos_id	Group ID
	 * @param	array	data		Data
	 */
	function edit_recebimentos($recebimentos_id = NULL, $data){
		// Gotta have an ID
		if($recebimentos_id == NULL){
			$this->lasterr = 'Cannot update a recebimentos without their ID.';
			return FALSE;
		}
		/*
		$exists = $this->recebimentos_exists($data['recebimentos_descricao'], $data['curso_id']);
		if($exists == TRUE){
			$this->lasterr = 'Turma já existe no sistema.';
			return FALSE;
		}
		*/
		// Update recebimentos main details
		$this->db->where('recebimentos_id', $recebimentos_id);
		$editar = $this->db->update('recebimentos', $data);
		
		return $editar;
	}
	
	function recebimentos_exists($recebimentos_descricao, $curso_id){
		$sql = 'SELECT * FROM recebimentos WHERE recebimentos_descricao = ? AND curso_id = ? LIMIT 1';
		$query = $this->db->query($sql, array($recebimentos_descricao, $curso_id));
		return ($query->num_rows() == 1) ? TRUE : FALSE;
	}	

	function delete_recebimentos($recebimentos_id){
		/*
		if($this->check_if_recebimentos_has_recebimentos_horas($recebimentos_id) == FALSE){
			$this->lasterr = 'Não foi possível excluir a turma selecionada. Há recebimentos_horas pertencentes à esta turma.<br />Primeiro exclua as recebimentos que utilizam este turma.';
			return FALSE;
		}
		
		if($this->check_if_recebimentos_has_recebimentos_descontos($recebimentos_id) == FALSE){
			$this->lasterr = 'Não foi possível excluir o funcionario selecionado. Há recebimentos_descontos pertencentes à este funcionario.<br />Primeiro exclua as recebimentos que utilizam este funcionario.';
			return FALSE;
		}
		*/
		$sql = 'DELETE FROM recebimentos WHERE recebimentos_id = ? LIMIT 1';
		$query = $this->db->query($sql, array($recebimentos_id));
		
		if($query == FALSE){
			
			$this->lasterr = 'Could not excluir recebimentos. Do they exist?';
			return FALSE;
			
		} else {
			return TRUE;
		}
		
	}
	
	function check_if_recebimentos_has_recebimentos_horas($recebimentos_id){
		$sql = 'SELECT recebimentos_horas.recebimentos_horas_id FROM recebimentos_horas WHERE recebimentos_horas.recebimentos_horas_recebimentos_id = ?';
		$query = $this->db->query($sql, array($recebimentos_id));
		if($query->num_rows() == 0){
			return TRUE;
		} else {
			return FALSE;
		}
	}
	
	function check_if_recebimentos_has_recebimentos_descontos($recebimentos_id){
		$sql = 'SELECT recebimentos_descontos.recebimentos_descontos_id FROM recebimentos_descontos WHERE recebimentos_descontos.recebimentos_descontos_recebimentos_id = ?';
		$query = $this->db->query($sql, array($recebimentos_id));
		if($query->num_rows() == 0){
			return TRUE;
		} else {
			return FALSE;
		}
	}


	function get_recebimentos_dropdown(){
		$sql = 'SELECT recebimentos_id, recebimentos_descricao FROM recebimentos ORDER BY recebimentos_descricao ASC';
		$query = $this->db->query($sql);
		if($query->num_rows() > 0){
			$result = $query->result();
			$recebimentos = array(''=>'SELECIONE');
			foreach($result as $funcionario){
				$recebimentos[$funcionario->recebimentos_id] = $funcionario->recebimentos_descricao;
			}
			return $recebimentos;
		} else {
			$this->lasterr = 'No recebimentos found';
			return FALSE;
		}
	}

	function get_recebimentos_name($recebimentos_id){
		if($recebimentos_id == NULL || !is_numeric($recebimentos_id)){
			$this->lasterr = 'No recebimentos_id given or invalid data type.';
			return FALSE;
		}
		
		$sql = 'SELECT recebimentos_descricao FROM recebimentos WHERE recebimentos_id = ? LIMIT 1';
		$query = $this->db->query($sql, array($recebimentos_id));
		
		if($query->num_rows() == 1){
			$row = $query->row();
			return $row->recebimentos_descricao;
		} else {
			$this->lasterr = sprintf('The recebimentos supplied (ID: %d) does not exist.', $recebimentos_id);
			return FALSE;
		}
	}
	
	function get_recebimentos_comissao($recebimentos_id){
		if($recebimentos_id == NULL || !is_numeric($recebimentos_id)){
			$this->lasterr = 'No recebimentos_id given or invalid data type.';
			return FALSE;
		}
		
		$sql = 'SELECT recebimentos_comissao FROM recebimentos WHERE recebimentos_id = ? LIMIT 1';
		$query = $this->db->query($sql, array($recebimentos_id));
		
		if($query->num_rows() == 1){
			$row = $query->row();
			return $row->recebimentos_comissao;
		} else {
			$this->lasterr = sprintf('The recebimentos supplied (ID: %d) does not exist.', $recebimentos_id);
			return FALSE;
		}
	}
	
	function get_recebimentos_tipo_sala(){
	
		$sql = 'SELECT recebimentos.recebimentos_id, recebimentos.recebimentos_descricao, recebimentos.recebimentos_autor, recebimentos.recebimentos_horario_incio, recebimentos.recebimentos_horario_fim, recebimentos.recebimentos_recebido, recebimentos_tipos.recebimentos_tipo_id, recebimentos_tipos.recebimentos_tipo_nome, recebimentos_salas.recebimentos_sala_id, recebimentos_salas.recebimentos_sala_nome
				FROM recebimentos, recebimentos_tipos, recebimentos_salas
				WHERE recebimentos_tipos.recebimentos_tipo_id = recebimentos.recebimentos_tipo_id
				AND recebimentos_salas.recebimentos_sala_id = recebimentos.recebimentos_sala_id
				ORDER BY recebimentos.recebimentos_id';
				
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
				return $query->result();
		} else {
			$this->lasterr = 'No cursos available.';
			return 0;
		}
	}

	function get_recebimentos_serie(){
	
		$sql = 'SELECT  *
				FROM recebimentos
				GROUP BY recebimentos.recebimentos_serie
				ORDER BY recebimentos.recebimentos_serie ASC';
				
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
				return $query->result();
		} else {
			$this->lasterr = 'NENHUMA SÉRIE';
			return 0;
		}
	}
}

/* End of file: app/models/sistema.php */