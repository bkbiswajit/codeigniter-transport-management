<?php
class controle_de_viagem_despesas_model extends Model{

	var $lasterr;
	
	function controle_de_viagem_despesas_model(){
		parent::Model();
	}
	
	function get_controle_de_viagem_despesas($controle_de_viagem_despesas_id = NULL, $page = NULL){
		if ($controle_de_viagem_despesas_id == NULL) {
		
			// Getting all controle_de_viagem_despesas and number of usuarios in it
			$this->db->select('controle_de_viagem_despesas.*');
			$this->db->from('controle_de_viagem_despesas');
			$this->db->orderby('controle_de_viagem_despesas.controle_de_viagem_despesas_id ASC');
			
			if (isset($page) && is_array($page)) {
				$this->db->limit($page[0], $page[1]);
			}
			
			$query = $this->db->get();
			if ($query->num_rows() > 0){
				return $query->result();
			} else {
				$this->lasterr = 'Nenhum controle_de_viagem_despesas disponíveis.';
				return 0;
			}
			
		} else {
			
			if (!is_numeric($controle_de_viagem_despesas_id)) {
				return FALSE;
			}
			
			// Getting one controle_de_viagem_despesas
			$sql = 'SELECT * FROM controle_de_viagem_despesas WHERE controle_de_viagem_despesas_id = ? LIMIT 1';
			$query = $this->db->query($sql, array($controle_de_viagem_despesas_id));
			
			if($query->num_rows() == 1){
				
				// Got the controle_de_viagem_despesas!
				$controle_de_viagem_despesas = $query->row();
				return $controle_de_viagem_despesas;
				
			} else {
				
				return FALSE;
				
			}
			
		}
		
	}
	
	/**
	 * Adicionar a controle_de_viagem_despesas to the database
	 *
	 * @param	array	data	Array of controle_de_viagem_despesas data to insert
	 * @return	bool
	 */
	function add_controle_de_viagem_despesas($data){
		// Adicionar created date to the array to be inserted into the DB
		//$data['controle_de_viagem_despesas_data'] = date("Y-m-d");
		// Adicionar the user and get the ID
		/*
		$exists = $this->controle_de_viagem_despesas_exists($data['controle_de_viagem_despesas_descricao'], $data['curso_id']);
		if($exists == TRUE){
			$this->lasterr = 'Turma já existe no sistema.';
			return FALSE;
		}
		*/
		$adicionar = $this->db->insert('controle_de_viagem_despesas', $data);
		$controle_de_viagem_despesas_id = $this->db->insert_id();
		return $controle_de_viagem_despesas_id;
	}

	/**
	 * Update data for a controle_de_viagem_despesas
	 *
	 * @param	int		controle_de_viagem_despesas_id	Group ID
	 * @param	array	data		Data
	 */
	function edit_controle_de_viagem_despesas($controle_de_viagem_despesas_id = NULL, $data){
		// Gotta have an ID
		if($controle_de_viagem_despesas_id == NULL){
			$this->lasterr = 'Cannot update a controle_de_viagem_despesas without their ID.';
			return FALSE;
		}
		/*
		$exists = $this->controle_de_viagem_despesas_exists($data['controle_de_viagem_despesas_descricao'], $data['curso_id']);
		if($exists == TRUE){
			$this->lasterr = 'Turma já existe no sistema.';
			return FALSE;
		}
		*/
		// Update controle_de_viagem_despesas main details
		$this->db->where('controle_de_viagem_despesas_id', $controle_de_viagem_despesas_id);
		$editar = $this->db->update('controle_de_viagem_despesas', $data);
		
		return $editar;
	}
	
	function controle_de_viagem_despesas_exists($controle_de_viagem_despesas_descricao, $curso_id){
		$sql = 'SELECT * FROM controle_de_viagem_despesas WHERE controle_de_viagem_despesas_descricao = ? AND curso_id = ? LIMIT 1';
		$query = $this->db->query($sql, array($controle_de_viagem_despesas_descricao, $curso_id));
		return ($query->num_rows() == 1) ? TRUE : FALSE;
	}	

	function delete_controle_de_viagem_despesas($controle_de_viagem_despesas_id){
		/*
		if($this->check_if_controle_de_viagem_despesas_has_matricula($controle_de_viagem_despesas_id) == FALSE){
			$this->lasterr = 'Não foi possível excluir a itens selecionada. Há matriculas pertencentes à esta itens.<br />Primeiro exclua as controle_de_viagem_despesas que utilizam este itens.';
			return FALSE;
		}		
		*/
		$sql = 'DELETE FROM controle_de_viagem_despesas WHERE controle_de_viagem_despesas_id = ? LIMIT 1';
		$query = $this->db->query($sql, array($controle_de_viagem_despesas_id));
		
		if($query == FALSE){
			
			$this->lasterr = 'Could not excluir controle_de_viagem_despesas. Do they exist?';
			return FALSE;
			
		} else {
			return TRUE;
		}
		
	}
	
	function check_if_controle_de_viagem_despesas_has_matricula($controle_de_viagem_despesas_id){
		$sql = 'SELECT controle_de_viagem_despesas_id FROM matriculas WHERE controle_de_viagem_despesas_id = ?';
		$query = $this->db->query($sql, array($controle_de_viagem_despesas_id));
		if($query->num_rows() == 0){
			return TRUE;
		} else {
			return FALSE;
		}
	}		

	function get_controle_de_viagem_despesas_dropdown(){
		$sql = 'SELECT controle_de_viagem_despesas_id, controle_de_viagem_despesas_descricao FROM controle_de_viagem_despesas ORDER BY controle_de_viagem_despesas_descricao ASC';
		$query = $this->db->query($sql);
		if($query->num_rows() > 0){
			$result = $query->result();
			$controle_de_viagem_despesas = array();
			foreach($result as $controle_de_viagem_despesas){
				$controle_de_viagem_despesas[$itens->controle_de_viagem_despesas_id] = $itens->controle_de_viagem_despesas_descricao;
			}
			return $controle_de_viagem_despesas;
		} else {
			$this->lasterr = 'Nenhum controle_de_viagem_despesas found';
			return FALSE;
		}
	}

	function get_controle_de_viagem_despesas_name($controle_de_viagem_despesas_id){
		if($controle_de_viagem_despesas_id == NULL || !is_numeric($controle_de_viagem_despesas_id)){
			$this->lasterr = 'Nenhum controle_de_viagem_despesas_id given or invalid data type.';
			return FALSE;
		}
		
		$sql = 'SELECT controle_de_viagem_despesas_descricao FROM controle_de_viagem_despesas WHERE controle_de_viagem_despesas_id = ? LIMIT 1';
		$query = $this->db->query($sql, array($controle_de_viagem_despesas_id));
		
		if($query->num_rows() == 1){
			$row = $query->row();
			return $row->controle_de_viagem_despesas_descricao;
		} else {
			$this->lasterr = sprintf('The controle_de_viagem_despesas supplied (ID: %d) does not exist.', $controle_de_viagem_despesas_id);
			return FALSE;
		}
	}
	
	function get_controle_de_viagem_despesas_mes_atual(){
	
		/*
		$mes_base = $this->settings->get_mes_base_ativo();
		$ano_base = $this->settings->get_ano_base_ativo();
		AND controle_de_viagem_despesas.controle_de_viagem_despesas_ano_base_id = ' . $ano_base->ano_base_id . '
		AND controle_de_viagem_despesas.controle_de_viagem_despesas_mes_base_id = ' . $mes_base->mes_base_id . '
		*/ 
		
		$inicio_mes_atual	=	date("Y-m") . '-01';
		$final_mes_atual 	=	date("Y-m") . '-31';
		
		$sql = "SELECT controle_de_viagem_despesas.*,  pre_os.*,despesas_tipos.* 
                FROM controle_de_viagem_despesas,  pre_os,despesas_tipos 
                WHERE controle_de_viagem_despesas.despesas_tipos_id= despesas_tipos.despesas_tipos_id
				AND controle_de_viagem_despesas.pre_cv_id = pre_os.pre_cv_id";
				
				/*AND controle_de_viagem_despesas.controle_de_viagem_despesas_data BETWEEN '$inicio_mes_atual' AND '$final_mes_atual'*/
				
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
				return $query->result();
		} else {
			$this->lasterr = 'Nenhum cursos disponíveis.';
			return 0;
		}
	}
	
	function get_controle_de_viagem_despesas_mes($controle_de_viagem_despesas_mes_id){
	
		$inicio_mes_atual	=	date("Y") . '-'. $controle_de_viagem_despesas_mes_id . '-01';
		$final_mes_atual 	=	date("Y") . '-'. $controle_de_viagem_despesas_mes_id . '-31';
		
		$sql = "SELECT controle_de_viagem_despesas.*, despesas_tipos.*
				FROM controle_de_viagem_despesas, despesas_tipos
				WHERE controle_de_viagem_despesas.despesas_tipos_id= despesas_tipos.despesas_tipos_id
				AND controle_de_viagem_despesas.controle_de_viagem_despesas_data BETWEEN '$inicio_mes_atual' AND '$final_mes_atual'
				ORDER BY controle_de_viagem_despesas.controle_de_viagem_despesas_id";
				
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
				return $query->result();
		} else {
			$this->lasterr = 'Nenhum cursos disponíveis.';
			return 0;
		}
	}
	
	function get_controle_de_viagem_despesas_total($cv_id){
		
		$sql = 'SELECT SUM( controle_de_viagem_despesas.controle_de_viagem_despesas_valor ) AS total FROM controle_de_viagem_despesas WHERE controle_de_viagem_despesas.controle_de_viagem_despesas_controle_de_viagem_viagens_id='.$cv_id.'';
		
		$query = $this->db->query($sql);

			if($query->num_rows() == 1){
				$controle_de_viagem_despesas_total = $query->row();
				return $controle_de_viagem_despesas_total;
			} else {
				return FALSE;
			}		
	}
	
	function get_controle_de_viagem_despesas_cv($cv_id){
		
		$sql = 
			'SELECT *
from controle_de_viagem, controle_de_viagem_despesas, controle_de_viagem_despesas_tipos
where controle_de_viagem_despesas.controle_de_viagem_despesas_controle_de_viagem_viagens_id=controle_de_viagem.controle_de_viagem_id
and controle_de_viagem_despesas.controle_de_viagem_despesas_controle_de_viagem_despesas_tipos_id=controle_de_viagem_despesas_tipos.controle_de_viagem_despesas_tipos_id
and controle_de_viagem.controle_de_viagem_id='.$cv_id.'';
				
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
			return $query->result();
		} else {
			$this->lasterr = 'Nenhum despesas_tipos disponíveis.';
			return 0;
		}
	}

	
}

/* End of file: app/models/sistema.php */