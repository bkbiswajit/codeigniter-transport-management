<?php
class transportadoras_model extends Model{

	var $lasterr;
	
	function transportadoras_model(){
		parent::Model();
	}
	
	function get_transportadoras($transportadoras_id = NULL, $page = NULL){
		
		if ($transportadoras_id == NULL) {
			$this->db->select('transportadoras.*');
			$this->db->from('transportadoras');
			$this->db->orderby('transportadoras.transportadoras_descricao ASC');
			
			if (isset($page) && is_array($page)) {
				$this->db->limit($page[0], $page[1]);
			}
			
			$query = $this->db->get();
			if ($query->num_rows() > 0){
				return $query->result();
			} else {
				$this->lasterr = 'MODEL ERRO: 1';
				return 0;
			}
			
		} else {
			
			if (!is_numeric($transportadoras_id)) {
				return FALSE;
			}
			
			$sql = 'SELECT * FROM transportadoras WHERE transportadoras_id = ? LIMIT 1';
			
			$query = $this->db->query($sql, array($transportadoras_id));
			
			if($query->num_rows() == 1){
			
				$transportadoras = $query->row();
			
				return $transportadoras;
				
			} else {
				
				return FALSE;
				
			}
			
		}
		
	}
	
	function add_transportadoras($data){
	
		$adicionar = $this->db->insert('transportadoras', $data);
		
		$transportadoras_id = $this->db->insert_id();
		
		return $transportadoras_id;
		
	}
	
	function edit_transportadoras($transportadoras_id = NULL, $data){
	
		if($transportadoras_id == NULL){
			$this->lasterr = 'MODEL ERRO: 2';
			return FALSE;
		}
		
		$this->db->where('transportadoras_id', $transportadoras_id);
		
		$editar = $this->db->update('transportadoras', $data);
		
		return $editar;
		
	}
	
	function transportadoras_exists($transportadoras_descricao, $curso_id){
	
		$sql = 'SELECT * FROM transportadoras WHERE transportadoras_descricao = ? AND curso_id = ? LIMIT 1';
		
		$query = $this->db->query($sql, array($transportadoras_descricao, $curso_id));
		
		return ($query->num_rows() == 1) ? TRUE : FALSE;
		
	}	

	function delete_transportadoras($transportadoras_id){
	
		if($this->check_if_transportadoras_has_controle_de_viagem($transportadoras_id) == FALSE){
			$this->lasterr = 'MODEL ERRO: 3';
			return FALSE;
		}

		$sql = 'DELETE FROM transportadoras WHERE transportadoras_id = ? LIMIT 1';
		
		$query = $this->db->query($sql, array($transportadoras_id));
		
		if($query == FALSE){
			
			$this->lasterr = 'MODEL ERRO: 4';
			return FALSE;
			
		} else {
			return TRUE;
		}
		
	}
	
	function check_if_transportadoras_has_controle_de_viagem($transportadoras_id){
	
		$sql = 'SELECT controle_de_viagem_transportadoras_id FROM controle_de_viagem WHERE controle_de_viagem_transportadoras_id = ?';
		
		$query = $this->db->query($sql, array($transportadoras_id));
		
		if($query->num_rows() == 0){
			return TRUE;
		} else {
			return FALSE;
		}
		
	}		

	function get_transportadoras_dropdown(){
	
		$sql = 'SELECT transportadoras_id, transportadoras_descricao FROM transportadoras ORDER BY transportadoras_descricao ASC';
		
		$query = $this->db->query($sql);
		
		if($query->num_rows() > 0){
			$result = $query->result();
			$transportadoras = array(''=>'SELECIONE');
			foreach($result as $cliente){
				$transportadoras[$cliente->transportadoras_id] = $cliente->transportadoras_descricao;
			}
			return $transportadoras;
		} else {
			$this->lasterr = 'MODEL ERRO: 5';
			return FALSE;
		}
		
	}

	function get_transportadoras_name($transportadoras_id){
	
		if($transportadoras_id == NULL || !is_numeric($transportadoras_id)){
			$this->lasterr = 'MODEL ERRO: 6';
			return FALSE;
		}
		
		$sql = 'SELECT transportadoras_descricao FROM transportadoras WHERE transportadoras_id = ? LIMIT 1';
		
		$query = $this->db->query($sql, array($transportadoras_id));
		
		if($query->num_rows() == 1){
			$row = $query->row();
			return $row->transportadoras_descricao;
		} else {
			$this->lasterr = 'MODEL ERRO: 7';
			return FALSE;
		}
	}

}

/* End of file: app/models/sistema.php */