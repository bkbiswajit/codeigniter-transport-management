<?php class Relatorios extends Controller
{
	var $tpl;

	function Relatorios()
	{
		parent::Controller();
		$this->load->model('relatorios/relatorios_model', 'relatorios_model');
		$this->load->model('transportadoras/transportadoras_model', 'transportadoras_model');
		$this->load->model('frotas/frotas_model', 'frotas_model');
		$this->load->model('motoristas/motoristas_model', 'motoristas_model');
		$this->load->model('clientes/clientes_model', 'clientes_model');
		$this->load->model('controle_de_viagem_regioes/controle_de_viagem_regioes_model', 'controle_de_viagem_regioes_model');
		$this->load->model('controle_de_viagem_regioes/controle_de_viagem_regioes_model');
		$this->tpl = $this->config->item('template');
		$this->output->enable_profiler($this->config->item('profiler'));
		if ($this->auth->logged_in() == TRUE AND $this->config->item('tracker') == TRUE)
		{
			$this->rastreador_model->add_visit();
		}
	}
	
	function index($ini = 0){
		
		$this->auth->check('relatorios');
		
		$transportadoras_id 			= $this->input->post('transportadoras_id');
		$caminhoes_id 					= $this->input->post('caminhoes_id');
		$motoristas_id 					= $this->input->post('motoristas_id');
		$clientes_id 					= $this->input->post('controle_de_viagem_viagens_clientes_id');
		$controle_de_viagem_regioes_id 	= $this->input->post('controle_de_viagem_regioes_id');
		$data_inicio				 	= human2mysql($this->input->post('data_inicio'));
		if($this->input->post('data_inicio') == NULL){
			$data_inicio = date('Y-m-d');
		}
		
		$data_fim					 	= human2mysql($this->input->post('data_fim'));
		if($this->input->post('data_fim') == NULL){
			$data_fim = date('Y-m-d');
		}
		
		$di 	= array('data_inicio' => $data_inicio);
		$df 	= array('data_fim' => $data_fim);
		$_POST	= array_merge($_POST, $di, $df);
		
		
		if($this->input->post('btn_submit')== 'Limpar'){
			$this->session->unset_userdata('query_index');
			$this->session->unset_userdata('post_index');
		}
		
		// se submeter o formulário		
		$where = '';
		if($_SERVER['REQUEST_METHOD'] == 'POST' AND $this->input->post('btn_submit')== 'Pesquisar'){
		
			$where.= $transportadoras_id == '' ? '' : " transportadoras.transportadoras_id = '". $transportadoras_id."' AND";
			$where.= $caminhoes_id == '' ? '' : " frotas.caminhoes_id = '". $caminhoes_id."' AND";
			$where.= $motoristas_id == '' ? '' : " motoristas.motoristas_id = '". $motoristas_id."' AND";
			$where.= $clientes_id == '' ? '' : " clientes.clientes_id = '". $clientes_id ."' AND";
			$where.= $controle_de_viagem_regioes_id == '' ? '' : " controle_de_viagem_regioes.controle_de_viagem_regioes_id = '". $controle_de_viagem_regioes_id."' AND";
			$where.= $data_inicio == '' ? '' : " controle_de_viagem_viagens.controle_de_viagem_viagens_data BETWEEN '". $data_inicio."' AND '". $data_fim."' AND";
			
			$where = strlen($where) > 1 ? '
			WHERE controle_de_viagem.controle_de_viagem_id=controle_de_viagem_viagens.controle_de_viagem_viagens_controle_de_viagem_viagens_id
			AND controle_de_viagem.controle_de_viagem_motorista_id=motoristas.motoristas_id
			AND controle_de_viagem.controle_de_viagem_caminhao_id=frotas.caminhoes_id
			AND controle_de_viagem.controle_de_viagem_transportadoras_id=transportadoras.transportadoras_id
			AND controle_de_viagem_destino.controle_de_viagem_destino_regiao_id=controle_de_viagem_regioes.controle_de_viagem_regioes_id
			AND controle_de_viagem_viagens.controle_de_viagem_viagens_origem_id=controle_de_viagem_origem.controle_de_viagem_origem_id
			AND controle_de_viagem_viagens.controle_de_viagem_viagens_destino_id=controle_de_viagem_destino.controle_de_viagem_destino_id 
			AND controle_de_viagem_viagens.controle_de_viagem_viagens_clientes_id=clientes.clientes_id
			AND '.$where : '';
			
			$where = substr($where, 0, - 3);
			
			$this->session->set_userdata(array('post_index'  => $_POST));
		}
		
		// se já tem filtros na sessão
		elseif(strlen($this->session->userdata('query_index')) > 5)
		{
			$where = $this->session->userdata('query_index'); 
		}
		
		// seta os posts
		if($this->session->userdata('post_index'))
		{
			$_POST = $this->session->userdata('post_index');
		}
		
		// se teve algum filtro
		if(strlen($where) > 5)
		{
			$this->session->set_userdata(array('query_index' => $where));

			//$sqlLimit = 'SELECT al.* FROM alunos al '.$where.' ORDER BY al.al_nome ASC LIMIT '.$ini.',15 ';
			$sqlLimit = '
			SELECT * 
			FROM controle_de_viagem, controle_de_viagem_viagens, controle_de_viagem_regioes, controle_de_viagem_origem,controle_de_viagem_destino, transportadoras, frotas, motoristas, clientes
			'.$where.'';
			$sqlTotal = '
			SELECT * 
			FROM controle_de_viagem, controle_de_viagem_viagens, controle_de_viagem_regioes, controle_de_viagem_origem,controle_de_viagem_destino, transportadoras, frotas, motoristas, clientes
			'.$where.'';
			
			$sqlSum = '
			SELECT SUM(controle_de_viagem_viagens_valor_frete) as sum
			FROM controle_de_viagem, controle_de_viagem_viagens, controle_de_viagem_regioes, controle_de_viagem_origem,controle_de_viagem_destino, transportadoras, frotas, motoristas, clientes
			'.$where.'';
			
			// limit
			$this->load->database();
			$q = $this->db->query($sqlLimit);
			$rows = $q->result_array();
			$cvs = $q->result();
				
			// total
			$this->load->database();
			$q = $this->db->query($sqlTotal);
			$num_rows = $q->num_rows();
			$total = $q->num_rows();
			
			// sum
			$this->load->database();
			$q			=	$this->db->query($sqlSum);
			$cvs_sum	=	$q->row();
			
			// paginação
			$this->load->library('pagination');
			$config['per_page'] = '15';
			$config['uri_segment'] = 3;
			$config['base_url'] = site_url('cvs/certificados/listar');
			$config['total_rows'] = $total;
	 		$this->pagination->initialize($config);

	 		$body['total'] = $total;
			$body['cvs'] = $cvs;
			$body['cvs2'] = $cvs;
			$body['cvs_sum'] = $cvs_sum;
			
			// se não econtrou nada
			if($total == 0)
			{
				$body['msg'] = '<div class="warning" >Nenhum resultado.</div>';
			}
		}
		// se não tem filtro
		else
		{
			$sqlLimit = '
			SELECT * 
			FROM controle_de_viagem, controle_de_viagem_viagens, controle_de_viagem_regioes, controle_de_viagem_origem,controle_de_viagem_destino, transportadoras, frotas, motoristas, clientes
			WHERE controle_de_viagem.controle_de_viagem_id=controle_de_viagem_viagens.controle_de_viagem_viagens_controle_de_viagem_viagens_id
			AND controle_de_viagem.controle_de_viagem_motorista_id=motoristas.motoristas_id
			AND controle_de_viagem.controle_de_viagem_caminhao_id=frotas.caminhoes_id
			AND controle_de_viagem.controle_de_viagem_transportadoras_id=transportadoras.transportadoras_id
			AND controle_de_viagem_viagens.controle_de_viagem_viagens_clientes_id=clientes.clientes_id
			AND controle_de_viagem_destino.controle_de_viagem_destino_regiao_id=controle_de_viagem_regioes.controle_de_viagem_regioes_id
			AND controle_de_viagem_viagens.controle_de_viagem_viagens_origem_id=controle_de_viagem_origem.controle_de_viagem_origem_id
			AND controle_de_viagem_viagens.controle_de_viagem_viagens_destino_id=controle_de_viagem_destino.controle_de_viagem_destino_id
						';
						
			$sqlTotal = '
			SELECT * 
			FROM controle_de_viagem, controle_de_viagem_viagens, controle_de_viagem_regioes, controle_de_viagem_origem,controle_de_viagem_destino, transportadoras, frotas, motoristas, clientes
			WHERE controle_de_viagem.controle_de_viagem_id=controle_de_viagem_viagens.controle_de_viagem_viagens_controle_de_viagem_viagens_id
			AND controle_de_viagem.controle_de_viagem_motorista_id=motoristas.motoristas_id
			AND controle_de_viagem.controle_de_viagem_caminhao_id=frotas.caminhoes_id
			AND controle_de_viagem.controle_de_viagem_transportadoras_id=transportadoras.transportadoras_id
			AND controle_de_viagem_viagens.controle_de_viagem_viagens_clientes_id=clientes.clientes_id
			AND controle_de_viagem_destino.controle_de_viagem_destino_regiao_id=controle_de_viagem_regioes.controle_de_viagem_regioes_id
			AND controle_de_viagem_viagens.controle_de_viagem_viagens_origem_id=controle_de_viagem_origem.controle_de_viagem_origem_id
			AND controle_de_viagem_viagens.controle_de_viagem_viagens_destino_id=controle_de_viagem_destino.controle_de_viagem_destino_id
						';
			$sqlSum = '
			SELECT SUM(controle_de_viagem_viagens_valor_frete) as sum
			FROM controle_de_viagem, controle_de_viagem_viagens, controle_de_viagem_regioes, controle_de_viagem_origem,controle_de_viagem_destino, transportadoras, frotas, motoristas, clientes
			WHERE controle_de_viagem.controle_de_viagem_id=controle_de_viagem_viagens.controle_de_viagem_viagens_controle_de_viagem_viagens_id
			AND controle_de_viagem.controle_de_viagem_motorista_id=motoristas.motoristas_id
			AND controle_de_viagem.controle_de_viagem_caminhao_id=frotas.caminhoes_id
			AND controle_de_viagem.controle_de_viagem_transportadoras_id=transportadoras.transportadoras_id
			AND controle_de_viagem_viagens.controle_de_viagem_viagens_clientes_id=clientes.clientes_id
			AND controle_de_viagem_destino.controle_de_viagem_destino_regiao_id=controle_de_viagem_regioes.controle_de_viagem_regioes_id
			AND controle_de_viagem_viagens.controle_de_viagem_viagens_origem_id=controle_de_viagem_origem.controle_de_viagem_origem_id
			AND controle_de_viagem_viagens.controle_de_viagem_viagens_destino_id=controle_de_viagem_destino.controle_de_viagem_destino_id
						';
			
			// limit
			$this->load->database();
			$q 		= $this->db->query($sqlLimit);
			$rows 	= $q->result_array();
			$q->result();
				
			// total
			$this->load->database();
			$q 		= $this->db->query($sqlTotal);
			$total	= $q->num_rows();
			$cvs	= $q->result();
			
			// sum
			$this->load->database();
			$q			=	$this->db->query($sqlSum);
			$cvs_sum	=	$q->row();
			
			// paginação
			$this->load->library('pagination');
			$config['per_page'] = '15';
			$config['uri_segment'] = 3;
			$config['base_url'] = site_url('contabilidade/relatorios/');
			$config['total_rows'] = $total;
	 		$this->pagination->initialize($config);

	 		$body['total'] = $total;
			$body['cvs'] = $cvs;
			$body['cvs2'] = $cvs;
			$body['cvs_sum'] = $cvs_sum;
			$this->session->unset_userdata('query_index');
		}
		
		$body['post_index']			= $this->session->userdata('post_index');
		$body['transportadoras'] 	= $this->transportadoras_model->get_transportadoras_dropdown();
		$body['frotas'] 			= $this->frotas_model->get_caminhoes_dropdown();
		$body['motoristas'] 		= $this->motoristas_model->get_motoristas_dropdown();
		$body['regioes'] 			= $this->controle_de_viagem_regioes_model->get_controle_de_viagem_regioes_dropdown();
		$body['clientes'] 			= $this->clientes_model->get_clientes_dropdown();
		
		$cvs_id='';
		foreach($cvs as $key => $value) {
			$cvs_id[]= $value->controle_de_viagem_id;
		}
		
		if($cvs_id != NULL){
			$cvs_id= implode(", ", $cvs_id);
		}else{
			$cvs_id=0;
		}
		
		$clientes_in_id='';
		foreach($cvs as $key => $value) {
			$clientes_in_id[]= $value->controle_de_viagem_viagens_clientes_id;
		}
		
		if($clientes_in_id != NULL){
			$clientes_in_id= implode(", ", $clientes_in_id);
		}else{
			$clientes_in_id=0;
		}
		
		
		$body['km'] 						= $this->relatorios_model->cv_km($cvs_id);
		$body['litros'] 					= $this->relatorios_model->cv_litros($cvs_id);
		$body['despesas'] 					= $this->relatorios_model->cv_despesas($cvs_id);
		$body['cvs_bonus'] 					= $this->relatorios_model->cv_bonus($cvs_id, $clientes_in_id);
		$body['cvs_comissao_motorista']		= $this->relatorios_model->cv_comissao_motorista($cvs_id, $clientes_in_id);
		$body['cvs_bonus_motorista']		= $this->relatorios_model->cv_bonus_motorista($cvs_id, $clientes_in_id);
		
		/*
		echo '<pre>';
		print_r($body);
		echo '</pre>';
		die();
		*/
		
		/*
		BONUS
		SELECT SUM(controle_de_viagem_viagens.controle_de_viagem_viagens_valor_frete * controle_de_viagem_viagens.controle_de_viagem_viagens_bonus) as total
		FROM controle_de_viagem_viagens
		WHERE controle_de_viagem_viagens.controle_de_viagem_viagens_id IN (1,2,3)
		*/
		
		/*
		echo '<pre>';
		print_r($_POST);
		echo '</pre>';
		die();
		*/
		
		$tpl['pagetitle']		=	'Gerenciar relatórios';
		$tpl['title']			=	'relatórios';
		$tpl['body']			=	$this->load->view('contabilidade/relatorios/index.php', $body, TRUE);		
		$this->load->view($this->tpl, $tpl);
	}
		
}