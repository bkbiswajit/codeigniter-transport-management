<?php
class metas_model extends Model{

	var $lasterr;
	
	function metas_model(){
		parent::Model();
	}
	
	function get_metas($metas_id = NULL, $page = NULL){
		if ($metas_id == NULL) {
		
			// Getting all metas and number of usuarios in it
			$this->db->select('*');
			$this->db->from('metas');
			$this->db->join('bonificacao', 'bonificacao.bonificacao_id = metas.metas_mes_id', 'inner');
			$this->db->join('controle_de_viagem_regioes', 'controle_de_viagem_regioes.controle_de_viagem_regioes_id = metas.metas_regiao_id', 'inner');
			$this->db->orderby('metas_mes_id ASC');
			
			if (isset($page) && is_array($page)) {
				$this->db->limit($page[0], $page[1]);
			}
			
			$query = $this->db->get();
			if ($query->num_rows() > 0){
				return $query->result();
			} else {
				$this->lasterr = 'No metas available.';
				return 0;
			}
			
		} else {
			
			if (!is_numeric($metas_id)) {
				return FALSE;
			}
			
			// Getting one metas
			$sql = 'SELECT * FROM metas WHERE metas_id = ? LIMIT 1';
			$query = $this->db->query($sql, array($metas_id));
			
			if($query->num_rows() == 1){
				
				// Got the metas!
				$metas = $query->row();
				return $metas;
				
			} else {
				
				return FALSE;
				
			}
			
		}
		
	}
	
	/**
	 * Adicionar a metas to the database
	 *
	 * @param	array	data	Array of metas data to insert
	 * @return	bool
	 */
	function add_metas($data){
		// Adicionar created date to the array to be inserted into the DB
		//$data['criado'] = date("Y-m-d");
		// Adicionar the user and get the ID
		/*
		$exists = $this->metas_exists($data['metas_descricao'], $data['curso_id']);
		if($exists == TRUE){
			$this->lasterr = 'Turma já existe no sistema.';
			return FALSE;
		}
		*/
		$adicionar = $this->db->insert('metas', $data);
		$metas_id = $this->db->insert_id();
		return $metas_id;
	}

	/**
	 * Update data for a metas
	 *
	 * @param	int		metas_id	Group ID
	 * @param	array	data		Data
	 */
	function edit_metas($metas_id = NULL, $data){
		// Gotta have an ID
		if($metas_id == NULL){
			$this->lasterr = 'Cannot update a metas without their ID.';
			return FALSE;
		}
		/*
		$exists = $this->metas_exists($data['metas_descricao'], $data['curso_id']);
		if($exists == TRUE){
			$this->lasterr = 'Turma já existe no sistema.';
			return FALSE;
		}
		*/
		// Update metas main details
		$this->db->where('metas_id', $metas_id);
		$editar = $this->db->update('metas', $data);
		
		return $editar;
	}
	
	function metas_exists($metas_descricao, $curso_id){
		$sql = 'SELECT * FROM metas WHERE metas_descricao = ? AND curso_id = ? LIMIT 1';
		$query = $this->db->query($sql, array($metas_descricao, $curso_id));
		return ($query->num_rows() == 1) ? TRUE : FALSE;
	}	

	function delete_metas($metas_id){
	
		if($this->check_if_metas_has_controle_de_viagem_metas($metas_id) == FALSE){
			$this->lasterr = 'MODEL ERRO: 3';
			return FALSE;
		}
		
		$sql = 'DELETE FROM metas WHERE metas_id = ? LIMIT 1';
		$query = $this->db->query($sql, array($metas_id));
		
		if($query == FALSE){
			
			$this->lasterr = 'Could not excluir metas. Do they exist?';
			return FALSE;
			
		} else {
			return TRUE;
		}
		
	}
	
	function check_if_metas_has_controle_de_viagem_metas($metas_id){
		$sql = 'SELECT controle_de_viagem_metas_metas_id FROM controle_de_viagem_metas WHERE controle_de_viagem_metas_metas_id = ?';
		$query = $this->db->query($sql, array($metas_id));
		if($query->num_rows() == 0){
			return TRUE;
		} else {
			return FALSE;
		}
	}
	
	function check_if_metas_has_metas_descontos($metas_id){
		$sql = 'SELECT metas_descontos.metas_descontos_id FROM metas_descontos WHERE metas_descontos.metas_descontos_metas_id = ?';
		$query = $this->db->query($sql, array($metas_id));
		if($query->num_rows() == 0){
			return TRUE;
		} else {
			return FALSE;
		}
	}


	function get_metas_dropdown(){
		$sql = 'SELECT metas_id, metas_descricao FROM metas ORDER BY metas_descricao ASC';
		$query = $this->db->query($sql);
		if($query->num_rows() > 0){
			$result = $query->result();
			$metas = array();
			foreach($result as $funcionario){
				$metas[$funcionario->metas_id] = $funcionario->metas_descricao;
			}
			return $metas;
		} else {
			$this->lasterr = 'No metas found';
			return FALSE;
		}
	}

	function get_metas_name($metas_id){
		if($metas_id == NULL || !is_numeric($metas_id)){
			$this->lasterr = 'No metas_id given or invalid data type.';
			return FALSE;
		}
		
		$sql = 'SELECT metas_descricao FROM metas WHERE metas_id = ? LIMIT 1';
		$query = $this->db->query($sql, array($metas_id));
		
		if($query->num_rows() == 1){
			$row = $query->row();
			return $row->metas_descricao;
		} else {
			$this->lasterr = sprintf('The metas supplied (ID: %d) does not exist.', $metas_id);
			return FALSE;
		}
	}
	
	function get_metas_tipo_sala(){
	
		$sql = 'SELECT metas.metas_id, metas.metas_descricao, metas.metas_autor, metas.metas_horario_incio, metas.metas_horario_fim, metas.metas_ativo, metas_tipos.metas_tipo_id, metas_tipos.metas_tipo_nome, metas_salas.metas_sala_id, metas_salas.metas_sala_nome
				FROM metas, metas_tipos, metas_salas
				WHERE metas_tipos.metas_tipo_id = metas.metas_tipo_id
				AND metas_salas.metas_sala_id = metas.metas_sala_id
				ORDER BY metas.metas_id';
				
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
				return $query->result();
		} else {
			$this->lasterr = 'No cursos available.';
			return 0;
		}
	}


	function get_metas_total($controle_de_viagem_regioes_id, $bonificacao_mes_inicio , $bonificacao_mes_final){
		if($metas_id == NULL || !is_numeric($controle_de_viagem_regioes_id)){
			$this->lasterr = 'No metas_id given or invalid data type.';
			return FALSE;
		}
		
		$sql = "SELECT COUNT(controle_de_viagem_viagens.controle_de_viagem_viagens_id) AS total
FROM controle_de_viagem, controle_de_viagem_viagens, controle_de_viagem_regioes, controle_de_viagem_origem,controle_de_viagem_destino, transportadoras, frotas, motoristas, clientes
WHERE controle_de_viagem.controle_de_viagem_id=controle_de_viagem_viagens.controle_de_viagem_viagens_controle_de_viagem_viagens_id
AND controle_de_viagem.controle_de_viagem_motorista_id=motoristas.motoristas_id
AND controle_de_viagem.controle_de_viagem_caminhao_id=frotas.caminhoes_id
AND controle_de_viagem.controle_de_viagem_transportadoras_id=transportadoras.transportadoras_id
AND controle_de_viagem_destino.controle_de_viagem_destino_regiao_id=controle_de_viagem_regioes.controle_de_viagem_regioes_id
AND controle_de_viagem_viagens.controle_de_viagem_viagens_origem_id=controle_de_viagem_origem.controle_de_viagem_origem_id
AND controle_de_viagem_viagens.controle_de_viagem_viagens_destino_id=controle_de_viagem_destino.controle_de_viagem_destino_id 
AND controle_de_viagem_viagens.controle_de_viagem_viagens_clientes_id=clientes.clientes_id
AND  controle_de_viagem_regioes.controle_de_viagem_regioes_id = '$controle_de_viagem_regioes_id' AND controle_de_viagem_viagens.controle_de_viagem_viagens_data BETWEEN '$bonificacao_mes_inicio' AND '$bonificacao_mes_final'";;
		$query = $this->db->query($sql);
		
		if($query->num_rows() == 1){
			$row = $query->row();
			return $row->total;
		} else {
			$this->lasterr = sprintf('The metas supplied (ID: %d) does not exist.', $metas_id);
			return FALSE;
		}
	}
}

/* End of file: app/models/sistema.php */