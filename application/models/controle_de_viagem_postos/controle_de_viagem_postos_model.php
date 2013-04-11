<?php
class controle_de_viagem_postos_model extends Model{

	var $lasterr;
	
	function controle_de_viagem_postos_model(){
		parent::Model();
	}
	
	function get_controle_de_viagem_postos($controle_de_viagem_postos_id = NULL, $page = NULL){
		if ($controle_de_viagem_postos_id == NULL) {
		
			// Getting all controle_de_viagem_postos and number of usuarios in it
			$this->db->select('controle_de_viagem_postos.*');
			$this->db->from('controle_de_viagem_postos');
			$this->db->orderby('controle_de_viagem_postos.controle_de_viagem_postos_id ASC');
			
			if (isset($page) && is_array($page)) {
				$this->db->limit($page[0], $page[1]);
			}
			
			$query = $this->db->get();
			if ($query->num_rows() > 0){
				return $query->result();
			} else {
				$this->lasterr = 'Nenhum controle_de_viagem_postos disponíveis.';
				return 0;
			}
			
		} else {
			
			if (!is_numeric($controle_de_viagem_postos_id)) {
				return FALSE;
			}
			
			// Getting one controle_de_viagem_postos
			$sql = 'SELECT * FROM controle_de_viagem_postos WHERE controle_de_viagem_postos_id = ? LIMIT 1';
			$query = $this->db->query($sql, array($controle_de_viagem_postos_id));
			
			if($query->num_rows() == 1){
				
				// Got the controle_de_viagem_postos!
				$controle_de_viagem_postos = $query->row();
				return $controle_de_viagem_postos;
				
			} else {
				
				return FALSE;
				
			}
			
		}
		
	}
	
	/**
	 * Adicionar a controle_de_viagem_postos to the database
	 *
	 * @param	array	data	Array of controle_de_viagem_postos data to insert
	 * @return	bool
	 */
	function add_controle_de_viagem_postos($data){
		// Adicionar created date to the array to be inserted into the DB
		//$data['controle_de_viagem_postos_data'] = date("Y-m-d");
		// Adicionar the user and get the ID
		/*
		$exists = $this->controle_de_viagem_postos_exists($data['controle_de_viagem_postos_descricao'], $data['curso_id']);
		if($exists == TRUE){
			$this->lasterr = 'Turma já existe no sistema.';
			return FALSE;
		}
		*/
		$adicionar = $this->db->insert('controle_de_viagem_postos', $data);
		$controle_de_viagem_postos_id = $this->db->insert_id();
		return $controle_de_viagem_postos_id;
	}

	/**
	 * Update data for a controle_de_viagem_postos
	 *
	 * @param	int		controle_de_viagem_postos_id	Group ID
	 * @param	array	data		Data
	 */
	function edit_controle_de_viagem_postos($controle_de_viagem_postos_id = NULL, $data){
		// Gotta have an ID
		if($controle_de_viagem_postos_id == NULL){
			$this->lasterr = 'Cannot update a controle_de_viagem_postos without their ID.';
			return FALSE;
		}
		/*
		$exists = $this->controle_de_viagem_postos_exists($data['controle_de_viagem_postos_descricao'], $data['curso_id']);
		if($exists == TRUE){
			$this->lasterr = 'Turma já existe no sistema.';
			return FALSE;
		}
		*/
		// Update controle_de_viagem_postos main details
		$this->db->where('controle_de_viagem_postos_id', $controle_de_viagem_postos_id);
		$editar = $this->db->update('controle_de_viagem_postos', $data);
		
		return $editar;
	}
	
	function controle_de_viagem_postos_exists($controle_de_viagem_postos_descricao, $curso_id){
		$sql = 'SELECT * FROM controle_de_viagem_postos WHERE controle_de_viagem_postos_descricao = ? AND curso_id = ? LIMIT 1';
		$query = $this->db->query($sql, array($controle_de_viagem_postos_descricao, $curso_id));
		return ($query->num_rows() == 1) ? TRUE : FALSE;
	}	

	function delete_controle_de_viagem_postos($controle_de_viagem_postos_id){
		/*
		if($this->check_if_controle_de_viagem_postos_has_matricula($controle_de_viagem_postos_id) == FALSE){
			$this->lasterr = 'Não foi possível excluir a itens selecionada. Há matriculas pertencentes à esta itens.<br />Primeiro exclua as controle_de_viagem_postos que utilizam este itens.';
			return FALSE;
		}		
		*/
		$sql = 'DELETE FROM controle_de_viagem_postos WHERE controle_de_viagem_postos_id = ? LIMIT 1';
		$query = $this->db->query($sql, array($controle_de_viagem_postos_id));
		
		if($query == FALSE){
			
			$this->lasterr = 'Could not excluir controle_de_viagem_postos. Do they exist?';
			return FALSE;
			
		} else {
			return TRUE;
		}
		
	}
	
	function check_if_controle_de_viagem_postos_has_matricula($controle_de_viagem_postos_id){
		$sql = 'SELECT controle_de_viagem_postos_id FROM matriculas WHERE controle_de_viagem_postos_id = ?';
		$query = $this->db->query($sql, array($controle_de_viagem_postos_id));
		if($query->num_rows() == 0){
			return TRUE;
		} else {
			return FALSE;
		}
	}		

	function get_controle_de_viagem_postos_dropdown(){
		$sql = 'SELECT controle_de_viagem_postos_id, controle_de_viagem_postos_descricao FROM controle_de_viagem_postos ORDER BY controle_de_viagem_postos_descricao ASC';
		$query = $this->db->query($sql);
		if($query->num_rows() > 0){
			$result = $query->result();
			$controle_de_viagem_postos = array();
			foreach($result as $controle_de_viagem_postos){
				$controle_de_viagem_postos[$itens->controle_de_viagem_postos_id] = $itens->controle_de_viagem_postos_descricao;
			}
			return $controle_de_viagem_postos;
		} else {
			$this->lasterr = 'Nenhum controle_de_viagem_postos found';
			return FALSE;
		}
	}

	function get_controle_de_viagem_postos_name($controle_de_viagem_postos_id){
		if($controle_de_viagem_postos_id == NULL || !is_numeric($controle_de_viagem_postos_id)){
			$this->lasterr = 'Nenhum controle_de_viagem_postos_id given or invalid data type.';
			return FALSE;
		}
		
		$sql = 'SELECT controle_de_viagem_postos_descricao FROM controle_de_viagem_postos WHERE controle_de_viagem_postos_id = ? LIMIT 1';
		$query = $this->db->query($sql, array($controle_de_viagem_postos_id));
		
		if($query->num_rows() == 1){
			$row = $query->row();
			return $row->controle_de_viagem_postos_descricao;
		} else {
			$this->lasterr = sprintf('The controle_de_viagem_postos supplied (ID: %d) does not exist.', $controle_de_viagem_postos_id);
			return FALSE;
		}
	}
	
	function get_controle_de_viagem_postos_mes_atual(){
	
		/*
		$mes_base = $this->settings->get_mes_base_ativo();
		$ano_base = $this->settings->get_ano_base_ativo();
		AND controle_de_viagem_postos.controle_de_viagem_postos_ano_base_id = ' . $ano_base->ano_base_id . '
		AND controle_de_viagem_postos.controle_de_viagem_postos_mes_base_id = ' . $mes_base->mes_base_id . '
		*/ 
		
		$inicio_mes_atual	=	date("Y-m") . '-01';
		$final_mes_atual 	=	date("Y-m") . '-31';
		
		$sql = "SELECT controle_de_viagem_postos.*,  pre_os.*,pre_operacoes.* 
                FROM controle_de_viagem_postos,  pre_os,pre_operacoes 
                WHERE controle_de_viagem_postos.pre_operacoes_id= pre_operacoes.pre_operacoes_id
				AND controle_de_viagem_postos.pre_cv_id = pre_os.pre_cv_id";
				
				/*AND controle_de_viagem_postos.controle_de_viagem_postos_data BETWEEN '$inicio_mes_atual' AND '$final_mes_atual'*/
				
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
				return $query->result();
		} else {
			$this->lasterr = 'Nenhum cursos disponíveis.';
			return 0;
		}
	}
	
	function get_controle_de_viagem_postos_mes($controle_de_viagem_postos_mes_id){
	
		$inicio_mes_atual	=	date("Y") . '-'. $controle_de_viagem_postos_mes_id . '-01';
		$final_mes_atual 	=	date("Y") . '-'. $controle_de_viagem_postos_mes_id . '-31';
		
		$sql = "SELECT controle_de_viagem_postos.*, pre_operacoes.*
				FROM controle_de_viagem_postos, pre_operacoes
				WHERE controle_de_viagem_postos.pre_operacoes_id= pre_operacoes.pre_operacoes_id
				AND controle_de_viagem_postos.controle_de_viagem_postos_data BETWEEN '$inicio_mes_atual' AND '$final_mes_atual'
				ORDER BY controle_de_viagem_postos.controle_de_viagem_postos_id";
				
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
				return $query->result();
		} else {
			$this->lasterr = 'Nenhum cursos disponíveis.';
			return 0;
		}
	}
	
	function get_controle_de_viagem_postos_litros_total($cv_id){
		
		$sql = 'SELECT SUM( controle_de_viagem_postos.controle_de_viagem_postos_litros ) AS total FROM controle_de_viagem_postos WHERE controle_de_viagem_postos.controle_de_viagem_postos_controle_de_viagem_viagens_id='.$cv_id.'';
		
		$query = $this->db->query($sql);

			if($query->num_rows() == 1){
				$controle_de_viagem_postos_total = $query->row();
				return $controle_de_viagem_postos_total;
			} else {
				return FALSE;
			}		
	}
	
	function get_controle_de_viagem_postos_cv($cv_id){
		
		$sql = 
			'SELECT *
from controle_de_viagem, controle_de_viagem_postos, postos
where controle_de_viagem_postos.controle_de_viagem_postos_controle_de_viagem_viagens_id=controle_de_viagem.controle_de_viagem_id
and controle_de_viagem_postos.controle_de_viagem_postos_postos_id=postos.postos_id
and controle_de_viagem.controle_de_viagem_id = '.$cv_id.'';
				
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