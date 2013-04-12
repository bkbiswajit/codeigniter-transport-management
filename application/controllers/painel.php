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
		
		/*$data = array();
		if (!$this->agent->is_mobile()) {
		$this->load->view('template/mobile/test_view',$data);
		}
		elseif ($this->agent->is_mobile('iPad')) {
		$this->load->view('template/mobile/test_view_ipad', $data);
		}
		else {
		$this->load->view('template/mobile/test_view_mobile', $data);
		}*/

		$tpl['title'] = 'Painel';
		$tpl['pagetitle'] = $tpl['title'];
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