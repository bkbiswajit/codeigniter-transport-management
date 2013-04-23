<?php
class Geral extends Controller {
	
	var $tpl;
	
	function Geral(){
		parent::Controller();
		$this->load->model('sistema_model');
		$this->tpl = $this->config->item('template');
		$this->output->enable_profiler($this->config->item('profiler'));
		if($this->auth->logged_in() == TRUE AND $this->config->item('tracker') == TRUE){ $this->rastreador_model->add_visit(); }
	}

	function index(){
		//$this->auth->check('sistema');
		$body['main'] = $this->settings->get_all('main');
		$tpl['title'] = 'Geral';
		$tpl['pagetitle'] = 'Gerenciar Configurações Gerais';
		$tpl['body'] = $this->load->view('sistema/geral/geral.php', $body, TRUE);
		$this->load->view($this->tpl, $tpl);
	}
	
	function salvar(){
		
		$this->form_validation->set_rules('nome', 'Nome', 'required|max_length[100]|trim');
		//$this->form_validation->set_rules('url', 'URL', 'required|max_length[255]|prep_url|trim');
		$this->form_validation->set_error_delimiters('<li>', '</li>');
		
		if($this->form_validation->run() == FALSE){
			$this->index();
		} else {
			$data['nome']							= $this->input->post('nome');
			$data['subnome']						= $this->input->post('subnome');
			$data['cnpj']							= $this->input->post('cnpj');
			$data['incricao_estadual']				= $this->input->post('incricao_estadual');
			$data['url']							= $this->input->post('url');
			$data['email']							= $this->input->post('email');
			$data['telefone']						= $this->input->post('telefone');
			$data['endereco']						= $this->input->post('endereco');

			$data['painel']							= $this->input->post('painel');

			$this->settings->salvar($data);
			$this->session->set_flashdata('flash', $this->msg->info($this->lang->line('CONF_MAIN_SAVE_OK')));
			redirect('sistema/geral');
		}
	}
	
	function _d($message, $br = TRUE){
		echo $message;
		echo ($br == TRUE) ? '<br /><br />' : '';
		@ob_flush();
	}	
}

/* End of file app/controllers/sistema/geral.php */
