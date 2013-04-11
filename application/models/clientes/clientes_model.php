<?php
class Clientes_model extends Model{

	var $lasterr;
	
	function Clientes_model(){
		parent::Model();
	}
	
	function get_clientes($clientes_id = NULL, $page = NULL){
		
		if ($clientes_id == NULL) {
			$this->db->select('clientes.*');
			$this->db->from('clientes');
			$this->db->orderby('clientes.clientes_descricao ASC');
			
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
			
			if (!is_numeric($clientes_id)) {
				return FALSE;
			}
			
			$sql = 'SELECT * FROM clientes WHERE clientes_id = ? LIMIT 1';
			
			$query = $this->db->query($sql, array($clientes_id));
			
			if($query->num_rows() == 1){
			
				$clientes = $query->row();
			
				return $clientes;
				
			} else {
				
				return FALSE;
				
			}
			
		}
		
	}
	
	function add_clientes($data){
	
		$adicionar = $this->db->insert('clientes', $data);
		
		$clientes_id = $this->db->insert_id();
		
		return $clientes_id;
		
	}
	
	function edit_clientes($clientes_id = NULL, $data){
	
		if($clientes_id == NULL){
			$this->lasterr = 'MODEL ERRO: 2';
			return FALSE;
		}
		
		$this->db->where('clientes_id', $clientes_id);
		
		$editar = $this->db->update('clientes', $data);
		
		return $editar;
		
	}
	
	function clientes_exists($clientes_descricao, $curso_id){
	
		$sql = 'SELECT * FROM clientes WHERE clientes_descricao = ? AND curso_id = ? LIMIT 1';
		
		$query = $this->db->query($sql, array($clientes_descricao, $curso_id));
		
		return ($query->num_rows() == 1) ? TRUE : FALSE;
		
	}	

	function delete_clientes($clientes_id){
		/*
		if($this->check_if_clientes_has_producao($clientes_id) == FALSE){
			$this->lasterr = 'MODEL ERRO: 3';
			return FALSE;
		}
		*/
		$sql = 'DELETE FROM clientes WHERE clientes_id = ? LIMIT 1';
		
		$query = $this->db->query($sql, array($clientes_id));
		
		if($query == FALSE){
			
			$this->lasterr = 'MODEL ERRO: 4';
			return FALSE;
			
		} else {
			return TRUE;
		}
		
	}
	
	function check_if_clientes_has_producao($clientes_id){
	
		$sql = 'SELECT producao_cliente_id FROM producao WHERE producao_cliente_id = ?';
		
		$query = $this->db->query($sql, array($clientes_id));
		
		if($query->num_rows() == 0){
			return TRUE;
		} else {
			return FALSE;
		}
		
	}		

	function get_clientes_dropdown(){
	
		$sql = 'SELECT clientes_id, clientes_descricao FROM clientes ORDER BY clientes_descricao ASC';
		
		$query = $this->db->query($sql);
		
		if($query->num_rows() > 0){
			$result = $query->result();
			$clientes = array(''=>'SELECIONE');
			foreach($result as $cliente){
				$clientes[$cliente->clientes_id] = $cliente->clientes_descricao;
			}
			return $clientes;
		} else {
			$this->lasterr = 'MODEL ERRO: 5';
			return FALSE;
		}
		
	}

	function get_clientes_name($clientes_id){
	
		if($clientes_id == NULL || !is_numeric($clientes_id)){
			$this->lasterr = 'MODEL ERRO: 6';
			return FALSE;
		}
		
		$sql = 'SELECT clientes_descricao FROM clientes WHERE clientes_id = ? LIMIT 1';
		
		$query = $this->db->query($sql, array($clientes_id));
		
		if($query->num_rows() == 1){
			$row = $query->row();
			return $row->clientes_descricao;
		} else {
			$this->lasterr = 'MODEL ERRO: 7';
			return FALSE;
		}
	}

}

/* End of file: app/models/sistema.php */