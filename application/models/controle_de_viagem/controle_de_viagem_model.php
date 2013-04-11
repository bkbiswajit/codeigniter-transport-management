<?php
class controle_de_viagem_model extends Model{

	var $lasterr;
	
	function controle_de_viagem_model(){
		parent::Model();
	}
	
	function get_controle_de_viagem($controle_de_viagem_id = NULL, $page = NULL){
		if ($controle_de_viagem_id == NULL) {
		
			// Getting all controle_de_viagem and number of usuarios in it
			$this->db->select('controle_de_viagem.*');
			$this->db->from('controle_de_viagem');
			$this->db->orderby('controle_de_viagem.controle_de_viagem_id ASC');
			
			if (isset($page) && is_array($page)) {
				$this->db->limit($page[0], $page[1]);
			}
			
			$query = $this->db->get();
			if ($query->num_rows() > 0){
				return $query->result();
			} else {
				$this->lasterr = 'Nenhum controle_de_viagem disponíveis.';
				return 0;
			}
			
		} else {
			
			if (!is_numeric($controle_de_viagem_id)) {
				return FALSE;
			}
			
			// Getting one controle_de_viagem
			$sql = 'SELECT * FROM controle_de_viagem WHERE controle_de_viagem_id = ? LIMIT 1';
			$query = $this->db->query($sql, array($controle_de_viagem_id));
			
			if($query->num_rows() == 1){
				
				// Got the controle_de_viagem!
				$controle_de_viagem = $query->row();
				return $controle_de_viagem;
				
			} else {
				
				return FALSE;
				
			}
			
		}
		
	}
	
	function get_controle_de_viagem_($controle_de_viagem_id = NULL, $page = NULL){
		if ($controle_de_viagem_id == NULL) {
		
			$sql = 
			'
			select *
			from controle_de_viagem, transportadoras, motoristas, frotas
			where controle_de_viagem.controle_de_viagem_transportadoras_id=transportadoras.transportadoras_id
			and	controle_de_viagem.controle_de_viagem_motorista_id=motoristas.motoristas_id
			and controle_de_viagem.controle_de_viagem_caminhao_id=frotas.caminhoes_id
			';
			
			$query = $this->db->query($sql);
			if ($query->num_rows() > 0){
				return $query->result();
			} else {
				$this->lasterr = 'Nenhum controle_de_viagem disponíveis.';
				return 0;
			}
			
		} else {
			
			if (!is_numeric($controle_de_viagem_id)) {
				return FALSE;
			}
			
			// Getting one controle_de_viagem
			$sql = 'SELECT * FROM controle_de_viagem WHERE controle_de_viagem_id = ? LIMIT 1';
			$query = $this->db->query($sql, array($controle_de_viagem_id));
			
			if($query->num_rows() == 1){
				
				// Got the controle_de_viagem!
				$controle_de_viagem = $query->row();
				return $controle_de_viagem;
				
			} else {
				
				return FALSE;
				
			}
			
		}
		
	}
	
	/**
	 * Adicionar a controle_de_viagem to the database
	 *
	 * @param	array	data	Array of controle_de_viagem data to insert
	 * @return	bool
	 */
	function add_controle_de_viagem($data){
		// Adicionar created date to the array to be inserted into the DB
		//$data['controle_de_viagem_data'] = date("Y-m-d");
		// Adicionar the user and get the ID
		/*
		$exists = $this->controle_de_viagem_exists($data['controle_de_viagem_descricao'], $data['curso_id']);
		if($exists == TRUE){
			$this->lasterr = 'Turma já existe no sistema.';
			return FALSE;
		}
		*/
		$adicionar = $this->db->insert('controle_de_viagem', $data);
		return $this->db->insert_id();
	}

	/**
	 * Update data for a controle_de_viagem
	 *
	 * @param	int		controle_de_viagem_id	Group ID
	 * @param	array	data		Data
	 */
	function edit_controle_de_viagem($controle_de_viagem_id = NULL, $data){
		// Gotta have an ID
		if($controle_de_viagem_id == NULL){
			$this->lasterr = 'Cannot update a controle_de_viagem without their ID.';
			return FALSE;
		}
		/*
		$exists = $this->controle_de_viagem_exists($data['controle_de_viagem_descricao'], $data['curso_id']);
		if($exists == TRUE){
			$this->lasterr = 'Turma já existe no sistema.';
			return FALSE;
		}
		*/
		// Update controle_de_viagem main details
		$this->db->where('controle_de_viagem_id', $controle_de_viagem_id);
		$editar = $this->db->update('controle_de_viagem', $data);
		
		return $editar;
	}
	
	function controle_de_viagem_exists($controle_de_viagem_descricao, $curso_id){
		$sql = 'SELECT * FROM controle_de_viagem WHERE controle_de_viagem_descricao = ? AND curso_id = ? LIMIT 1';
		$query = $this->db->query($sql, array($controle_de_viagem_descricao, $curso_id));
		return ($query->num_rows() == 1) ? TRUE : FALSE;
	}	

	function delete_controle_de_viagem($controle_de_viagem_id){
		/*
		if($this->check_if_controle_de_viagem_has_matricula($controle_de_viagem_id) == FALSE){
			$this->lasterr = 'Não foi possível excluir a turma selecionada. Há matriculas pertencentes à esta turma.<br />Primeiro exclua as controle_de_viagem que utilizam este turma.';
			return FALSE;
		}		
		*/
		$sql = 'DELETE FROM controle_de_viagem WHERE controle_de_viagem_id = ? LIMIT 1';
		$query = $this->db->query($sql, array($controle_de_viagem_id));
		
		if($query == FALSE){
			
			$this->lasterr = 'Could not excluir controle_de_viagem. Do they exist?';
			return FALSE;
			
		} else {
			return TRUE;
		}
		
	}
	
	function check_if_controle_de_viagem_has_matricula($controle_de_viagem_id){
		$sql = 'SELECT controle_de_viagem_id FROM matriculas WHERE controle_de_viagem_id = ?';
		$query = $this->db->query($sql, array($controle_de_viagem_id));
		if($query->num_rows() == 0){
			return TRUE;
		} else {
			return FALSE;
		}
	}		

	function get_controle_de_viagem_dropdown(){
		$sql = 'SELECT controle_de_viagem_id, controle_de_viagem_descricao FROM controle_de_viagem ORDER BY controle_de_viagem_descricao ASC';
		$query = $this->db->query($sql);
		if($query->num_rows() > 0){
			$result = $query->result();
			$controle_de_viagem = array();
			foreach($result as $controle_de_viagem){
				$controle_de_viagem[$turma->controle_de_viagem_id] = $turma->controle_de_viagem_descricao;
			}
			return $controle_de_viagem;
		} else {
			$this->lasterr = 'Nenhum controle_de_viagem found';
			return FALSE;
		}
	}

	function get_controle_de_viagem_name($controle_de_viagem_id){
		if($controle_de_viagem_id == NULL || !is_numeric($controle_de_viagem_id)){
			$this->lasterr = 'Nenhum controle_de_viagem_id given or invalid data type.';
			return FALSE;
		}
		
		$sql = 'SELECT controle_de_viagem_descricao FROM controle_de_viagem WHERE controle_de_viagem_id = ? LIMIT 1';
		$query = $this->db->query($sql, array($controle_de_viagem_id));
		
		if($query->num_rows() == 1){
			$row = $query->row();
			return $row->controle_de_viagem_descricao;
		} else {
			$this->lasterr = sprintf('The controle_de_viagem supplied (ID: %d) does not exist.', $controle_de_viagem_id);
			return FALSE;
		}
	}
	
	function get_controle_de_viagem_cliente_produto_mes_atual(){
	
		/*
		$mes_base = $this->settings->get_mes_base_ativo();
		$ano_base = $this->settings->get_ano_base_ativo();
		AND controle_de_viagem.controle_de_viagem_ano_base_id = ' . $ano_base->ano_base_id . '
		AND controle_de_viagem.controle_de_viagem_mes_base_id = ' . $mes_base->mes_base_id . '
		*/ 
		
		$inicio_mes_atual	=	date("Y-m") . '-01';
		$final_mes_atual 	=	date("Y-m") . '-31';
		
		$sql = "SELECT controle_de_viagem.*, clientes.*,produtos.*
				FROM controle_de_viagem, clientes, produtos
				WHERE controle_de_viagem.controle_de_viagem_cliente_id = clientes.clientes_id
				AND controle_de_viagem.controle_de_viagem_id= produtos.produtos_id
				AND controle_de_viagem.controle_de_viagem_data BETWEEN '$inicio_mes_atual' AND '$final_mes_atual'
				ORDER BY controle_de_viagem.controle_de_viagem_data";
				
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
				return $query->result();
		} else {
			$this->lasterr = 'Nenhum cursos disponíveis.';
			return 0;
		}
	}
	
	function get_controle_de_viagem_cliente_mes($cliente_id, $mes){
	
		/*
		$mes_base = $this->settings->get_mes_base_ativo();
		$ano_base = $this->settings->get_ano_base_ativo();
		AND controle_de_viagem.controle_de_viagem_ano_base_id = ' . $ano_base->ano_base_id . '
		AND controle_de_viagem.controle_de_viagem_mes_base_id = ' . $mes_base->mes_base_id . '
		*/ 
		$ano				=	date('Y');
		$inicio_mes_atual	=	$ano .'-' . $mes . '-01';
		$final_mes_atual 	=	$ano .'-' . $mes . '-31';
		
		$sql = "SELECT controle_de_viagem.*, clientes.*,produtos.*
				FROM controle_de_viagem, clientes, produtos
				WHERE controle_de_viagem.controle_de_viagem_cliente_id = clientes.clientes_id
				AND controle_de_viagem.controle_de_viagem_id= produtos.produtos_id
				AND controle_de_viagem.controle_de_viagem_data BETWEEN '$inicio_mes_atual' AND '$final_mes_atual'
				AND controle_de_viagem.controle_de_viagem_cliente_id = $cliente_id
				ORDER BY controle_de_viagem.controle_de_viagem_data";
				
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
				return $query->result();
		} else {
			$this->lasterr = 'Nenhum cursos disponíveis.';
			return 0;
		}
	}
	
	function get_controle_de_viagem_cliente_mes_total($cliente_id, $mes){
		$ano				=	date('Y');
		$inicio_mes_atual	=	$ano .'-' . $mes . '-01';
		$final_mes_atual 	=	$ano .'-' . $mes . '-31';
		
		$sql =	"SELECT SUM(controle_de_viagem.controle_de_viagem_quantidade*controle_de_viagem.controle_de_viagem_valor_frete ) as soma 
				FROM controle_de_viagem 
				WHERE controle_de_viagem.controle_de_viagem_cliente_id = $cliente_id 
				AND controle_de_viagem.controle_de_viagem_data BETWEEN '$inicio_mes_atual' AND '$final_mes_atual'";
				
		$query = $this->db->query($sql);

			if($query->num_rows() == 1){
				$controle_de_viagem = $query->row();
				return $controle_de_viagem;
			} else {
				return FALSE;
			}
	}
	
	function get_controle_de_viagem_quantidade_cliente_mes_total($cliente_id, $mes){
		$ano				=	date('Y');
		$inicio_mes_atual	=	$ano .'-' . $mes . '-01';
		$final_mes_atual 	=	$ano .'-' . $mes . '-31';
		
		$sql =	"SELECT SUM(controle_de_viagem.controle_de_viagem_quantidade) as soma 
				FROM controle_de_viagem 
				WHERE controle_de_viagem.controle_de_viagem_cliente_id = $cliente_id 
				AND controle_de_viagem.controle_de_viagem_data BETWEEN '$inicio_mes_atual' AND '$final_mes_atual'";
				
		$query = $this->db->query($sql);

			if($query->num_rows() == 1){
				$controle_de_viagem = $query->row();
				return $controle_de_viagem;
			} else {
				return FALSE;
			}
	}

	function get_controle_de_viagem_mes_atual(){
	
		$inicio_mes_atual	=	date("Y-m") . '-01';
		$final_mes_atual 	=	date("Y-m") . '-31';
		
		$sql = "SELECT SUM(controle_de_viagem.controle_de_viagem_quantidade) as soma FROM controle_de_viagem WHERE controle_de_viagem.controle_de_viagem_data BETWEEN '$inicio_mes_atual' AND '$final_mes_atual'";
		
		$query = $this->db->query($sql);

			if($query->num_rows() == 1){
				$controle_de_viagem = $query->row();
				return $controle_de_viagem;
			} else {
				return FALSE;
			}
	}
	
	function get_faturamento_controle_de_viagem_mes_atual(){
	
		$inicio_mes_atual	=	date("Y-m") . '-01';
		$final_mes_atual 	=	date("Y-m") . '-31';
		
		$sql = "SELECT SUM(controle_de_viagem.controle_de_viagem_quantidade*controle_de_viagem.controle_de_viagem_valor_frete ) as soma FROM controle_de_viagem WHERE controle_de_viagem.controle_de_viagem_data BETWEEN '$inicio_mes_atual' AND '$final_mes_atual'";
		
		$query = $this->db->query($sql);

			if($query->num_rows() == 1){
				$controle_de_viagem = $query->row();
				return $controle_de_viagem;
			} else {
				return FALSE;
			}
	}
	
	function get_controle_de_viagem_produto(){

		$sql = 'SELECT controle_de_viagem.controle_de_viagem_id, produtos.produtos_id, produtos.produtos_descricao FROM produtos, controle_de_viagem WHERE produtos.produtos_id = controle_de_viagem.controle_de_viagem_id';
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
			return $query->result();
		} else {
			$this->lasterr = 'Nenhum produtos disponíveis.';
			return 0;
		}
	}

	
}

/* End of file: app/models/sistema.php */