<?php 
class Percentagem extends Controller {

	var $tpl;

	function Percentagem(){
		parent::Controller();
		$this->load->helper('text');
		$this->tpl = $this->config->item('template');
		$this->output->enable_profiler($this->config->item('profiler'));
		if($this->auth->logged_in() == TRUE AND $this->config->item('tracker') == TRUE){ $this->rastreador_model->add_visit(); }
	}

	function index(){
		//$this->auth->check('percentagem');
		
		$links[] = array('#', '#');
		$tpl['links'] = $this->load->view('parts/linkbar', $links, TRUE);
		
		$body['#'] = NULL;
		$tpl['body'] = $this->load->view('contabilidade/percentagem/index.php', $body, TRUE);
			
		$tpl['title'] = 'percentagem';
		$tpl['pagetitle'] = 'Gerenciar percentagem';
		
		$this->load->view($this->tpl, $tpl);
	}
}

/* End of file controllers/contabilidade/percentagem/percentagem.php */