<?php
class controle_de_viagem_viagens_model extends Model{

	var $lasterr;
	
	function controle_de_viagem_viagens_model(){
		parent::Model();
	}
	
	function get_controle_de_viagem_viagens($controle_de_viagem_viagens_id = NULL, $page = NULL){
		if ($controle_de_viagem_viagens_id == NULL) {
		
			// Getting all controle_de_viagem_viagens and number of usuarios in it
			$this->db->select('controle_de_viagem_viagens.*');
			$this->db->from('controle_de_viagem_viagens');
			$this->db->orderby('controle_de_viagem_viagens.controle_de_viagem_viagens_id ASC');
			
			if (isset($page) && is_array($page)) {
				$this->db->limit($page[0], $page[1]);
			}
			
			$query = $this->db->get();
			if ($query->num_rows() > 0){
				return $query->result();
			} else {
				$this->lasterr = 'Nenhum controle_de_viagem_viagens disponíveis.';
				return 0;
			}
			
		} else {
			
			if (!is_numeric($controle_de_viagem_viagens_id)) {
				return FALSE;
			}
			
			// Getting one controle_de_viagem_viagens
			$sql = 'SELECT * FROM controle_de_viagem_viagens WHERE controle_de_viagem_viagens_id = ? LIMIT 1';
			$query = $this->db->query($sql, array($controle_de_viagem_viagens_id));
			
			if($query->num_rows() == 1){
				
				// Got the controle_de_viagem_viagens!
				$controle_de_viagem_viagens = $query->row();
				return $controle_de_viagem_viagens;
				
			} else {
				
				return FALSE;
				
			}
			
		}
		
	}
	
	/**
	 * Adicionar a controle_de_viagem_viagens to the database
	 *
	 * @param	array	data	Array of controle_de_viagem_viagens data to insert
	 * @return	bool
	 */
	function add_controle_de_viagem_viagens($data){
		// Adicionar created date to the array to be inserted into the DB
		//$data['controle_de_viagem_viagens_data'] = date("Y-m-d");
		// Adicionar the user and get the ID
		/*
		$exists = $this->controle_de_viagem_viagens_exists($data['controle_de_viagem_viagens_descricao'], $data['curso_id']);
		if($exists == TRUE){
			$this->lasterr = 'Turma já existe no sistema.';
			return FALSE;
		}
		*/
		$adicionar = $this->db->insert('controle_de_viagem_viagens', $data);
		$controle_de_viagem_viagens_id = $this->db->insert_id();
		return $controle_de_viagem_viagens_id;
	}

	/**
	 * Update data for a controle_de_viagem_viagens
	 *
	 * @param	int		controle_de_viagem_viagens_id	Group ID
	 * @param	array	data		Data
	 */
	function edit_controle_de_viagem_viagens($controle_de_viagem_viagens_id = NULL, $data){
		// Gotta have an ID
		if($controle_de_viagem_viagens_id == NULL){
			$this->lasterr = 'Cannot update a controle_de_viagem_viagens without their ID.';
			return FALSE;
		}
		/*
		$exists = $this->controle_de_viagem_viagens_exists($data['controle_de_viagem_viagens_descricao'], $data['curso_id']);
		if($exists == TRUE){
			$this->lasterr = 'Turma já existe no sistema.';
			return FALSE;
		}
		*/
		// Update controle_de_viagem_viagens main details
		$this->db->where('controle_de_viagem_viagens_id', $controle_de_viagem_viagens_id);
		$editar = $this->db->update('controle_de_viagem_viagens', $data);
		
		return $editar;
	}
	
	function controle_de_viagem_viagens_exists($controle_de_viagem_viagens_descricao, $curso_id){
		$sql = 'SELECT * FROM controle_de_viagem_viagens WHERE controle_de_viagem_viagens_descricao = ? AND curso_id = ? LIMIT 1';
		$query = $this->db->query($sql, array($controle_de_viagem_viagens_descricao, $curso_id));
		return ($query->num_rows() == 1) ? TRUE : FALSE;
	}	

	function delete_controle_de_viagem_viagens($controle_de_viagem_viagens_id){
		/*
		if($this->check_if_controle_de_viagem_viagens_has_matricula($controle_de_viagem_viagens_id) == FALSE){
			$this->lasterr = 'Não foi possível excluir a itens selecionada. Há matriculas pertencentes à esta itens.<br />Primeiro exclua as controle_de_viagem_viagens que utilizam este itens.';
			return FALSE;
		}		
		*/
		$sql = 'DELETE FROM controle_de_viagem_viagens WHERE controle_de_viagem_viagens_id = ? LIMIT 1';
		$query = $this->db->query($sql, array($controle_de_viagem_viagens_id));
		
		if($query == FALSE){
			
			$this->lasterr = 'Could not excluir controle_de_viagem_viagens. Do they exist?';
			return FALSE;
			
		} else {
			return TRUE;
		}
		
	}
	
	function check_if_controle_de_viagem_viagens_has_matricula($controle_de_viagem_viagens_id){
		$sql = 'SELECT controle_de_viagem_viagens_id FROM matriculas WHERE controle_de_viagem_viagens_id = ?';
		$query = $this->db->query($sql, array($controle_de_viagem_viagens_id));
		if($query->num_rows() == 0){
			return TRUE;
		} else {
			return FALSE;
		}
	}		

	function get_controle_de_viagem_viagens_dropdown(){
		$sql = 'SELECT controle_de_viagem_viagens_id, controle_de_viagem_viagens_descricao FROM controle_de_viagem_viagens ORDER BY controle_de_viagem_viagens_descricao ASC';
		$query = $this->db->query($sql);
		if($query->num_rows() > 0){
			$result = $query->result();
			$controle_de_viagem_viagens = array();
			foreach($result as $controle_de_viagem_viagens){
				$controle_de_viagem_viagens[$itens->controle_de_viagem_viagens_id] = $itens->controle_de_viagem_viagens_descricao;
			}
			return $controle_de_viagem_viagens;
		} else {
			$this->lasterr = 'Nenhum controle_de_viagem_viagens found';
			return FALSE;
		}
	}

	function get_controle_de_viagem_viagens_name($controle_de_viagem_viagens_id){
		if($controle_de_viagem_viagens_id == NULL || !is_numeric($controle_de_viagem_viagens_id)){
			$this->lasterr = 'Nenhum controle_de_viagem_viagens_id given or invalid data type.';
			return FALSE;
		}
		
		$sql = 'SELECT controle_de_viagem_viagens_descricao FROM controle_de_viagem_viagens WHERE controle_de_viagem_viagens_id = ? LIMIT 1';
		$query = $this->db->query($sql, array($controle_de_viagem_viagens_id));
		
		if($query->num_rows() == 1){
			$row = $query->row();
			return $row->controle_de_viagem_viagens_descricao;
		} else {
			$this->lasterr = sprintf('The controle_de_viagem_viagens supplied (ID: %d) does not exist.', $controle_de_viagem_viagens_id);
			return FALSE;
		}
	}
	
	function get_controle_de_viagem_viagens_mes_atual(){
	
		/*
		$mes_base = $this->settings->get_mes_base_ativo();
		$ano_base = $this->settings->get_ano_base_ativo();
		AND controle_de_viagem_viagens.controle_de_viagem_viagens_ano_base_id = ' . $ano_base->ano_base_id . '
		AND controle_de_viagem_viagens.controle_de_viagem_viagens_mes_base_id = ' . $mes_base->mes_base_id . '
		*/ 
		
		$inicio_mes_atual	=	date("Y-m") . '-01';
		$final_mes_atual 	=	date("Y-m") . '-31';
		
		$sql = "SELECT controle_de_viagem_viagens.*,  pre_os.*,pre_operacoes.* 
                FROM controle_de_viagem_viagens,  pre_os,pre_operacoes 
                WHERE controle_de_viagem_viagens.pre_operacoes_id= pre_operacoes.pre_operacoes_id
				AND controle_de_viagem_viagens.pre_cv_id = pre_os.pre_cv_id";
				
				/*AND controle_de_viagem_viagens.controle_de_viagem_viagens_data BETWEEN '$inicio_mes_atual' AND '$final_mes_atual'*/
				
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
				return $query->result();
		} else {
			$this->lasterr = 'Nenhum cursos disponíveis.';
			return 0;
		}
	}
	
	function get_controle_de_viagem_viagens_mes($controle_de_viagem_viagens_mes_id){
	
		$inicio_mes_atual	=	date("Y") . '-'. $controle_de_viagem_viagens_mes_id . '-01';
		$final_mes_atual 	=	date("Y") . '-'. $controle_de_viagem_viagens_mes_id . '-31';
		
		$sql = "SELECT controle_de_viagem_viagens.*, pre_operacoes.*
				FROM controle_de_viagem_viagens, pre_operacoes
				WHERE controle_de_viagem_viagens.pre_operacoes_id= pre_operacoes.pre_operacoes_id
				AND controle_de_viagem_viagens.controle_de_viagem_viagens_data BETWEEN '$inicio_mes_atual' AND '$final_mes_atual'
				ORDER BY controle_de_viagem_viagens.controle_de_viagem_viagens_id";
				
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
				return $query->result();
		} else {
			$this->lasterr = 'Nenhum cursos disponíveis.';
			return 0;
		}
	}
	
	function get_controle_de_viagem_viagens_total($cv_id){
		
		$sql = 'SELECT SUM( controle_de_viagem_viagens.controle_de_viagem_viagens_valor_frete ) AS total FROM controle_de_viagem_viagens WHERE controle_de_viagem_viagens.controle_de_viagem_viagens_controle_de_viagem_viagens_id='.$cv_id.'';
		
		$query = $this->db->query($sql);

			if($query->num_rows() == 1){
				$controle_de_viagem_viagens_total = $query->row();
				return $controle_de_viagem_viagens_total;
			} else {
				return FALSE;
			}		
	}
	
	function get_controle_de_viagem_viagens_cv($cv_id){
		
		$sql = 
			'select controle_de_viagem.*, controle_de_viagem_viagens.*, controle_de_viagem_origem.*, controle_de_viagem_destino.*, clientes.*
			from controle_de_viagem, controle_de_viagem_viagens, controle_de_viagem_origem, controle_de_viagem_destino, clientes
			where controle_de_viagem_viagens.controle_de_viagem_viagens_controle_de_viagem_viagens_id=controle_de_viagem.controle_de_viagem_id
			and controle_de_viagem_viagens.controle_de_viagem_viagens_origem_id=controle_de_viagem_origem.controle_de_viagem_origem_id
			and controle_de_viagem_viagens.controle_de_viagem_viagens_destino_id=controle_de_viagem_destino.controle_de_viagem_destino_id
			and controle_de_viagem_viagens.controle_de_viagem_viagens_clientes_id=clientes.clientes_id
			and controle_de_viagem.controle_de_viagem_id = '.$cv_id.'
			';
				
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
			return $query->result();
		} else {
			$this->lasterr = 'Nenhum pre_operacoes disponíveis.';
			return 0;
		}
	}

	
}

/* End of file: app/models/sistema.php */