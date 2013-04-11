<?php
class controle_de_viagem_agenda_model extends Model{

	var $lasterr;
	
	function controle_de_viagem_agenda_model(){
		parent::Model();
	}
	
	function get_controle_de_viagem_agenda($controle_de_viagem_agenda_id = NULL, $page = NULL){
		if ($controle_de_viagem_agenda_id == NULL) {
		
			// Getting all controle_de_viagem_agenda and number of usuarios in it
			$this->db->select('controle_de_viagem_agenda.*');
			$this->db->from('controle_de_viagem_agenda');
			$this->db->orderby('controle_de_viagem_agenda.controle_de_viagem_agenda_id ASC');
			
			if (isset($page) && is_array($page)) {
				$this->db->limit($page[0], $page[1]);
			}
			
			$query = $this->db->get();
			if ($query->num_rows() > 0){
				return $query->result();
			} else {
				$this->lasterr = 'Nenhum controle_de_viagem_agenda disponíveis.';
				return 0;
			}
			
		} else {
			
			if (!is_numeric($controle_de_viagem_agenda_id)) {
				return FALSE;
			}
			
			// Getting one controle_de_viagem_agenda
			$sql = 'SELECT * FROM controle_de_viagem_agenda WHERE controle_de_viagem_agenda_id = ? LIMIT 1';
			$query = $this->db->query($sql, array($controle_de_viagem_agenda_id));
			
			if($query->num_rows() == 1){
				
				// Got the controle_de_viagem_agenda!
				$controle_de_viagem_agenda = $query->row();
				return $controle_de_viagem_agenda;
				
			} else {
				
				return FALSE;
				
			}
			
		}
		
	}
	
	function get_controle_de_viagem_agenda_caminhoes_liberados($controle_de_viagem_agenda_id = NULL, $page = NULL){
		if ($controle_de_viagem_agenda_id == NULL) {
		
			$sql = 
			'
			select *
			from frotas
			where frotas.caminhoes_controle_de_viagem_agenda_liberado=0
			order by frotas.caminhoes_descricao asc
			';
			
			$query = $this->db->query($sql);
			if ($query->num_rows() > 0){
				return $query->result();
			} else {
				$this->lasterr = 'Nenhum controle_de_viagem_agenda disponíveis.';
				return 0;
			}
			
		} else {
			
			if (!is_numeric($controle_de_viagem_agenda_id)) {
				return FALSE;
			}
			
			// Getting one controle_de_viagem_agenda
			$sql = 'SELECT * FROM controle_de_viagem_agenda WHERE controle_de_viagem_agenda_id = ? LIMIT 1';
			$query = $this->db->query($sql, array($controle_de_viagem_agenda_id));
			
			if($query->num_rows() == 1){
				
				// Got the controle_de_viagem_agenda!
				$controle_de_viagem_agenda = $query->row();
				return $controle_de_viagem_agenda;
				
			} else {
				
				return FALSE;
				
			}
			
		}
		
	}
	
	
	function get_controle_de_viagem_agenda_especifica($controle_de_viagem_agenda_id = NULL, $page = NULL){
		if ($controle_de_viagem_agenda_id == NULL) {
		
			$sql = 
			'
			select *
            from controle_de_viagem_agenda, transportadoras, motoristas, frotas, controle_de_viagem_origem, controle_de_viagem_destino
            where controle_de_viagem_agenda.controle_de_viagem_agenda_transportadoras_id=transportadoras.transportadoras_id
            and controle_de_viagem_agenda.controle_de_viagem_agenda_motorista_id=motoristas.motoristas_id
            and controle_de_viagem_agenda.controle_de_viagem_agenda_caminhao_id=frotas.caminhoes_id
            and controle_de_viagem_agenda.controle_de_viagem_agenda_origem_id=controle_de_viagem_origem.controle_de_viagem_origem_id
            and controle_de_viagem_agenda.controle_de_viagem_agenda_destino_id=controle_de_viagem_destino.controle_de_viagem_destino_id
            and frotas.caminhoes_id=controle_de_viagem_agenda.controle_de_viagem_agenda_caminhao_id
            and controle_de_viagem_agenda.controle_de_viagem_agenda_caminhao_liberado=1
            and frotas.caminhoes_controle_de_viagem_agenda_liberado=1
			';
			
			$query = $this->db->query($sql);
			if ($query->num_rows() > 0){
				return $query->result();
			} else {
				$this->lasterr = 'Nenhum controle_de_viagem_agenda disponíveis.';
				return 0;
			}
			
		} else {
			
			if (!is_numeric($controle_de_viagem_agenda_id)) {
				return FALSE;
			}
			
			// Getting one controle_de_viagem_agenda
			$sql = 'SELECT * FROM controle_de_viagem_agenda WHERE controle_de_viagem_agenda_id = ? LIMIT 1';
			$query = $this->db->query($sql, array($controle_de_viagem_agenda_id));
			
			if($query->num_rows() == 1){
				
				// Got the controle_de_viagem_agenda!
				$controle_de_viagem_agenda = $query->row();
				return $controle_de_viagem_agenda;
				
			} else {
				
				return FALSE;
				
			}
			
		}
		
	}
	
	/**
	 * Adicionar a controle_de_viagem_agenda to the database
	 *
	 * @param	array	data	Array of controle_de_viagem_agenda data to insert
	 * @return	bool
	 */
	function add_controle_de_viagem_agenda($data){
		// Adicionar created date to the array to be inserted into the DB
		//$data['controle_de_viagem_agenda_data'] = date("Y-m-d");
		// Adicionar the user and get the ID
		/*
		$exists = $this->controle_de_viagem_agenda_exists($data['controle_de_viagem_agenda_descricao'], $data['curso_id']);
		if($exists == TRUE){
			$this->lasterr = 'Turma já existe no sistema.';
			return FALSE;
		}
		*/
		$adicionar = $this->db->insert('controle_de_viagem_agenda', $data);
		return $this->db->insert_id();
	}

	/**
	 * Update data for a controle_de_viagem_agenda
	 *
	 * @param	int		controle_de_viagem_agenda_id	Group ID
	 * @param	array	data		Data
	 */
	function edit_controle_de_viagem_agenda($controle_de_viagem_agenda_id = NULL, $data){
		// Gotta have an ID
		if($controle_de_viagem_agenda_id == NULL){
			$this->lasterr = 'Cannot update a controle_de_viagem_agenda without their ID.';
			return FALSE;
		}
		/*
		$exists = $this->controle_de_viagem_agenda_exists($data['controle_de_viagem_agenda_descricao'], $data['curso_id']);
		if($exists == TRUE){
			$this->lasterr = 'Turma já existe no sistema.';
			return FALSE;
		}
		*/
		// Update controle_de_viagem_agenda main details
		$this->db->where('controle_de_viagem_agenda_id', $controle_de_viagem_agenda_id);
		$editar = $this->db->update('controle_de_viagem_agenda', $data);
		
		return $editar;
	}
	/**
	 * Update data for a controle_de_viagem_agenda
	 *
	 * @param	int		controle_de_viagem_agenda_id	Group ID
	 * @param	array	data		Data
	 */
	function controle_de_viagem_agenda_liberar_caminhao($controle_de_viagem_agenda_id = NULL){
		// Gotta have an ID
		if($controle_de_viagem_agenda_id == NULL){
			$this->lasterr = 'Cannot update a controle_de_viagem_agenda without their ID.';
			return FALSE;
		}
		
		$data['caminhoes_controle_de_viagem_agenda_liberado'] = 1;
		
		// Update controle_de_viagem_agenda main details
		$this->db->where('caminhoes_id', $controle_de_viagem_agenda_id);
		$editar = $this->db->update('frotas', $data);
		
		return $editar;
	}
	
	function controle_de_viagem_agenda_exists($controle_de_viagem_agenda_descricao, $curso_id){
		$sql = 'SELECT * FROM controle_de_viagem_agenda WHERE controle_de_viagem_agenda_descricao = ? AND curso_id = ? LIMIT 1';
		$query = $this->db->query($sql, array($controle_de_viagem_agenda_descricao, $curso_id));
		return ($query->num_rows() == 1) ? TRUE : FALSE;
	}	

	function delete_controle_de_viagem_agenda($controle_de_viagem_agenda_id){
		/*
		if($this->check_if_controle_de_viagem_agenda_has_matricula($controle_de_viagem_agenda_id) == FALSE){
			$this->lasterr = 'Não foi possível excluir a turma selecionada. Há matriculas pertencentes à esta turma.<br />Primeiro exclua as controle_de_viagem_agenda que utilizam este turma.';
			return FALSE;
		}		
		*/
		$sql = 'DELETE FROM controle_de_viagem_agenda WHERE controle_de_viagem_agenda_id = ? LIMIT 1';
		$query = $this->db->query($sql, array($controle_de_viagem_agenda_id));
		
		if($query == FALSE){
			
			$this->lasterr = 'Could not excluir controle_de_viagem_agenda. Do they exist?';
			return FALSE;
			
		} else {
			return TRUE;
		}
		
	}
	
	function check_if_controle_de_viagem_agenda_has_matricula($controle_de_viagem_agenda_id){
		$sql = 'SELECT controle_de_viagem_agenda_id FROM matriculas WHERE controle_de_viagem_agenda_id = ?';
		$query = $this->db->query($sql, array($controle_de_viagem_agenda_id));
		if($query->num_rows() == 0){
			return TRUE;
		} else {
			return FALSE;
		}
	}		

	function get_controle_de_viagem_agenda_dropdown(){
		$sql = 'SELECT controle_de_viagem_agenda_id, controle_de_viagem_agenda_descricao FROM controle_de_viagem_agenda ORDER BY controle_de_viagem_agenda_descricao ASC';
		$query = $this->db->query($sql);
		if($query->num_rows() > 0){
			$result = $query->result();
			$controle_de_viagem_agenda = array();
			foreach($result as $controle_de_viagem_agenda){
				$controle_de_viagem_agenda[$turma->controle_de_viagem_agenda_id] = $turma->controle_de_viagem_agenda_descricao;
			}
			return $controle_de_viagem_agenda;
		} else {
			$this->lasterr = 'Nenhum controle_de_viagem_agenda found';
			return FALSE;
		}
	}

	function get_controle_de_viagem_agenda_name($controle_de_viagem_agenda_id){
		if($controle_de_viagem_agenda_id == NULL || !is_numeric($controle_de_viagem_agenda_id)){
			$this->lasterr = 'Nenhum controle_de_viagem_agenda_id given or invalid data type.';
			return FALSE;
		}
		
		$sql = 'SELECT controle_de_viagem_agenda_descricao FROM controle_de_viagem_agenda WHERE controle_de_viagem_agenda_id = ? LIMIT 1';
		$query = $this->db->query($sql, array($controle_de_viagem_agenda_id));
		
		if($query->num_rows() == 1){
			$row = $query->row();
			return $row->controle_de_viagem_agenda_descricao;
		} else {
			$this->lasterr = sprintf('The controle_de_viagem_agenda supplied (ID: %d) does not exist.', $controle_de_viagem_agenda_id);
			return FALSE;
		}
	}
	
	function get_controle_de_viagem_agenda_cliente_produto_mes_atual(){
	
		/*
		$mes_base = $this->settings->get_mes_base_ativo();
		$ano_base = $this->settings->get_ano_base_ativo();
		AND controle_de_viagem_agenda.controle_de_viagem_agenda_ano_base_id = ' . $ano_base->ano_base_id . '
		AND controle_de_viagem_agenda.controle_de_viagem_agenda_mes_base_id = ' . $mes_base->mes_base_id . '
		*/ 
		
		$inicio_mes_atual	=	date("Y-m") . '-01';
		$final_mes_atual 	=	date("Y-m") . '-31';
		
		$sql = "SELECT controle_de_viagem_agenda.*, clientes.*,produtos.*
				FROM controle_de_viagem_agenda, clientes, produtos
				WHERE controle_de_viagem_agenda.controle_de_viagem_agenda_cliente_id = clientes.clientes_id
				AND controle_de_viagem_agenda.controle_de_viagem_agenda_id= produtos.produtos_id
				AND controle_de_viagem_agenda.controle_de_viagem_agenda_data BETWEEN '$inicio_mes_atual' AND '$final_mes_atual'
				ORDER BY controle_de_viagem_agenda.controle_de_viagem_agenda_data";
				
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
				return $query->result();
		} else {
			$this->lasterr = 'Nenhum cursos disponíveis.';
			return 0;
		}
	}
	
	function get_controle_de_viagem_agenda_cliente_mes($cliente_id, $mes){
	
		/*
		$mes_base = $this->settings->get_mes_base_ativo();
		$ano_base = $this->settings->get_ano_base_ativo();
		AND controle_de_viagem_agenda.controle_de_viagem_agenda_ano_base_id = ' . $ano_base->ano_base_id . '
		AND controle_de_viagem_agenda.controle_de_viagem_agenda_mes_base_id = ' . $mes_base->mes_base_id . '
		*/ 
		$ano				=	date('Y');
		$inicio_mes_atual	=	$ano .'-' . $mes . '-01';
		$final_mes_atual 	=	$ano .'-' . $mes . '-31';
		
		$sql = "SELECT controle_de_viagem_agenda.*, clientes.*,produtos.*
				FROM controle_de_viagem_agenda, clientes, produtos
				WHERE controle_de_viagem_agenda.controle_de_viagem_agenda_cliente_id = clientes.clientes_id
				AND controle_de_viagem_agenda.controle_de_viagem_agenda_id= produtos.produtos_id
				AND controle_de_viagem_agenda.controle_de_viagem_agenda_data BETWEEN '$inicio_mes_atual' AND '$final_mes_atual'
				AND controle_de_viagem_agenda.controle_de_viagem_agenda_cliente_id = $cliente_id
				ORDER BY controle_de_viagem_agenda.controle_de_viagem_agenda_data";
				
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
				return $query->result();
		} else {
			$this->lasterr = 'Nenhum cursos disponíveis.';
			return 0;
		}
	}
	
	function get_controle_de_viagem_agenda_cliente_mes_total($cliente_id, $mes){
		$ano				=	date('Y');
		$inicio_mes_atual	=	$ano .'-' . $mes . '-01';
		$final_mes_atual 	=	$ano .'-' . $mes . '-31';
		
		$sql =	"SELECT SUM(controle_de_viagem_agenda.controle_de_viagem_agenda_quantidade*controle_de_viagem_agenda.controle_de_viagem_agenda_valor_frete ) as soma 
				FROM controle_de_viagem_agenda 
				WHERE controle_de_viagem_agenda.controle_de_viagem_agenda_cliente_id = $cliente_id 
				AND controle_de_viagem_agenda.controle_de_viagem_agenda_data BETWEEN '$inicio_mes_atual' AND '$final_mes_atual'";
				
		$query = $this->db->query($sql);

			if($query->num_rows() == 1){
				$controle_de_viagem_agenda = $query->row();
				return $controle_de_viagem_agenda;
			} else {
				return FALSE;
			}
	}
	
	function get_controle_de_viagem_agenda_quantidade_cliente_mes_total($cliente_id, $mes){
		$ano				=	date('Y');
		$inicio_mes_atual	=	$ano .'-' . $mes . '-01';
		$final_mes_atual 	=	$ano .'-' . $mes . '-31';
		
		$sql =	"SELECT SUM(controle_de_viagem_agenda.controle_de_viagem_agenda_quantidade) as soma 
				FROM controle_de_viagem_agenda 
				WHERE controle_de_viagem_agenda.controle_de_viagem_agenda_cliente_id = $cliente_id 
				AND controle_de_viagem_agenda.controle_de_viagem_agenda_data BETWEEN '$inicio_mes_atual' AND '$final_mes_atual'";
				
		$query = $this->db->query($sql);

			if($query->num_rows() == 1){
				$controle_de_viagem_agenda = $query->row();
				return $controle_de_viagem_agenda;
			} else {
				return FALSE;
			}
	}

	function get_controle_de_viagem_agenda_mes_atual(){
	
		$inicio_mes_atual	=	date("Y-m") . '-01';
		$final_mes_atual 	=	date("Y-m") . '-31';
		
		$sql = "SELECT SUM(controle_de_viagem_agenda.controle_de_viagem_agenda_quantidade) as soma FROM controle_de_viagem_agenda WHERE controle_de_viagem_agenda.controle_de_viagem_agenda_data BETWEEN '$inicio_mes_atual' AND '$final_mes_atual'";
		
		$query = $this->db->query($sql);

			if($query->num_rows() == 1){
				$controle_de_viagem_agenda = $query->row();
				return $controle_de_viagem_agenda;
			} else {
				return FALSE;
			}
	}
	
	function get_faturamento_controle_de_viagem_agenda_mes_atual(){
	
		$inicio_mes_atual	=	date("Y-m") . '-01';
		$final_mes_atual 	=	date("Y-m") . '-31';
		
		$sql = "SELECT SUM(controle_de_viagem_agenda.controle_de_viagem_agenda_quantidade*controle_de_viagem_agenda.controle_de_viagem_agenda_valor_frete ) as soma FROM controle_de_viagem_agenda WHERE controle_de_viagem_agenda.controle_de_viagem_agenda_data BETWEEN '$inicio_mes_atual' AND '$final_mes_atual'";
		
		$query = $this->db->query($sql);

			if($query->num_rows() == 1){
				$controle_de_viagem_agenda = $query->row();
				return $controle_de_viagem_agenda;
			} else {
				return FALSE;
			}
	}
	
	function get_controle_de_viagem_agenda_produto(){

		$sql = 'SELECT controle_de_viagem_agenda.controle_de_viagem_agenda_id, produtos.produtos_id, produtos.produtos_descricao FROM produtos, controle_de_viagem_agenda WHERE produtos.produtos_id = controle_de_viagem_agenda.controle_de_viagem_agenda_id';
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