<?php
class Painel extends Controller {
	
	var $tpl;
	
	function Painel(){
		parent::Controller();
		$this->tpl = $this->config->item('template');
		$this->output->enable_profiler($this->config->item('profiler'));
		if($this->auth->logged_in() == TRUE AND $this->config->item('tracker') == TRUE){ $this->rastreador_model->add_visit(); }
	}
	
	function index(){
		
		$tpl['title'] = 'Painel';
		$tpl['pagetitle'] = $tpl['title'];
		
		/*
		//box adicionar producao
		$body['producao'] = NULL;
		$body['produto_id'] = NULL;
		
		$this->load->model('producao/producao_model');
		$this->load->model('produtos/produtos_model');
		$this->load->model('clientes/clientes_model');
		$this->load->model('despesas/despesas_model');
		$this->load->model('despesas_tipos/despesas_tipos_model');
		
		$body['produtos'] = $this->produtos_model->get_produtos_dropdown();
		$body['clientes'] = $this->clientes_model->get_clientes_dropdown();
		$body['despesas_tipos'] = $this->despesas_tipos_model->get_despesas_tipos_dropdown();

		$body['faturamento_producao_mes_atual'] = $this->producao_model->get_faturamento_producao_mes_atual();
		$body['faturamento_despesas_mes_atual'] = $this->despesas_model->get_faturamento_despesas_mes_atual();
		*/
		
		if($this->auth->logged_in() == TRUE){
			$body['active_users'] = $this->auth->active_users();
			$tpl['body'] = $this->load->view('painel/index', $body, TRUE);
			$this->load->view($this->tpl, $tpl);
		} else {
			$body['#'] = '';
			$this->load->view('sistema/conta/acessar', $body);
		}
	}
}
?>