<?php 
class frotas_despesas_tipos extends Controller {

	var $tpl;

	function frotas_despesas_tipos(){
		parent::Controller();
		$this->load->model('frotas_despesas_tipos/frotas_despesas_tipos_model', 'frotas_despesas_tipos_model');
		$this->load->helper('text');
		$this->tpl = $this->config->item('template');
		$this->output->enable_profiler($this->config->item('profiler'));
		if($this->auth->logged_in() == TRUE AND $this->config->item('tracker') == TRUE){ $this->rastreador_model->add_visit(); }
	}

	function index(){
		//$this->auth->check('frotas_despesas_tipos');
		
		$links[] = array('contabilidade/frotas_despesas_tipos/adicionar', 'Adicionar novo frotas_despesas_tipos');
		$tpl['links'] = $this->load->view('parts/linkbar', $links, TRUE);
		
		// Get list of usuarios
		$body['frotas_despesas_tipos'] = $this->frotas_despesas_tipos_model->get_frotas_despesas_tipos();
		
			$tpl['body'] = $this->load->view('contabilidade/frotas_despesas_tipos/index.php', $body, TRUE);
			
		$tpl['title'] = 'frotas_despesas_tipos';
		$tpl['pagetitle'] = 'Gerenciar frotas_despesas_tipos';
		
		$this->load->view($this->tpl, $tpl);
	}

	function adicionar(){
		//$this->auth->check('frotas_despesas_tipos.adicionar');
		$body['frotas_despesas_tipos'] = NULL;
		$body['frotas_despesas_tipos_id'] = NULL;
		
		$tpl['title'] = 'Adicionar frotas_despesas_tipos';
		$tpl['pagetitle'] = 'Adicionar novo frotas_despesas_tipos';
		$tpl['body'] = $this->load->view('contabilidade/frotas_despesas_tipos/addedit.php', $body, TRUE);
		$this->load->view($this->tpl, $tpl);
	}
	
	function editar($frotas_despesas_tipos_id){
		//$this->auth->check('frotas_despesas_tipos.editar');
		$body['frotas_despesas_tipos'] = $this->frotas_despesas_tipos_model->get_frotas_despesas_tipos($frotas_despesas_tipos_id);
		$body['frotas_despesas_tipos_id'] = $frotas_despesas_tipos_id;
		
		//
		$tpl['title'] = 'Editar frotas_despesas_tipos';
		
		if($body['frotas_despesas_tipos'] != FALSE){
			$tpl['pagetitle'] = 'Editar frotas_despesas_tipos ' . $body['frotas_despesas_tipos']->frotas_despesas_tipos_descricao . '';
			$tpl['body'] = $this->load->view('contabilidade/frotas_despesas_tipos/addedit.php', $body, TRUE);
		} else {
			$tpl['pagetitle'] = 'Error getting frotas_despesas_tipos';
			$tpl['body'] = $this->msg->err('Could not load the specified frotas_despesas_tipos. Please check the ID and try again.');
		}
		
		$this->load->view($this->tpl, $tpl);
	}

	function salvar(){
		
		$frotas_despesas_tipos_id = $this->input->post('frotas_despesas_tipos_id');
		
		$this->form_validation->set_rules('frotas_despesas_tipos_id', 'frotas_despesas_tipos_id');
		$this->form_validation->set_rules('frotas_despesas_tipos_descricao', 'Tipo', 'required|trim|xss_clean');
		$this->form_validation->set_rules('frotas_despesas_tipos_ativo', 'Ativo ', 'trim|xss_clean');
		$this->form_validation->set_error_delimiters('<li>', '</li>');
		if ($this->form_validation->run() == FALSE) {
			($frotas_despesas_tipos_id == NULL) ? $this->adicionar() : $this->editar($frotas_despesas_tipos_id);
		} else {
			$data['frotas_despesas_tipos_descricao']			= str2uppercase($this->input->post('frotas_despesas_tipos_descricao'));
			$data['frotas_despesas_tipos_ativo']      			= ($this->input->post('frotas_despesas_tipos_ativo') == '1') ? 1 : 0;
			
			if($frotas_despesas_tipos_id == NULL){
			
				$adicionar = $this->frotas_despesas_tipos_model->add_frotas_despesas_tipos($data);
				
				if($adicionar == TRUE){
					$this->msg->adicionar('info', sprintf($this->lang->line('SECURITY_TURMA_ADD_OK'), $data['frotas_despesas_tipos_descricao']));
				} else {
					//$this->msg->adicionar('err', sprintf($this->lang->line('SECURITY_TURMA_ADD_FAIL', $this->frotas_despesas_tipos_model->lasterr)));
					$this->msg->adicionar('err', $this->frotas_despesas_tipos_model->lasterr, 'ERRO!');
				}
			
			} else {
			
				// Updating existing frotas_despesas_tipos
				$editar = $this->frotas_despesas_tipos_model->edit_frotas_despesas_tipos($frotas_despesas_tipos_id, $data);
				if($editar == TRUE){
					$this->msg->adicionar('info', sprintf($this->lang->line('SECURITY_TURMA_EDIT_OK'), $data['frotas_despesas_tipos_descricao']));
				} else {
					$this->msg->adicionar('err', sprintf($this->lang->line('SECURITY_TURMA_EDIT_FAIL', $this->frotas_despesas_tipos_model->lasterr)));
				}
				
			}
			
			if($this->input->post('btn_submit') == 'Adicionar' || $this->input->post('btn_submit') == 'Salvar'){
				redirect('contabilidade/frotas_despesas_tipos');
			}else{
				redirect('contabilidade/frotas_despesas_tipos/adicionar');
			}
		}
		
	}

	function excluir($frotas_despesas_tipos_id = NULL){
		//$this->auth->check('frotas_despesas_tipos.excluir');
		
		// Check if a form has been submitted; if not - show it to ask frotas_despesas_tipos confirmation
		if($this->input->post('id')){
		
			// Form has been submitted (so the POST value exists)
			// Call model function to excluir frotas_despesas_tipos
			$excluir = $this->frotas_despesas_tipos_model->delete_frotas($this->input->post('id'));
			if($excluir == FALSE){
				$this->msg->adicionar('err', $this->frotas_despesas_tipos_model->lasterr, 'Ocorreu um erro!');
			} else {
				$this->msg->adicionar('info', 'The frotas_despesas_tipos has been deleted.');
			}
			// Redirect
			redirect('contabilidade/frotas_despesas_tipos');
			
		} else {
			if($frotas_despesas_tipos_id == NULL){
				
				$tpl['title'] = 'Excluir frotas_despesas_tipos';
				$tpl['pagetitle'] = $tpl['title'];
				$tpl['body'] = $this->msg->err('Cannot find the frotas_despesas_tipos or no frotas_despesas_tipos ID given.');
				
			} else {
				
				// Get frotas_despesas_tipos info so we can present the confirmation page
				$frotas_despesas_tipos = $this->frotas_despesas_tipos_model->get_frotas_despesas_tipos($frotas_despesas_tipos_id);
				
				if($frotas_despesas_tipos == FALSE){
				
					$tpl['title'] = 'Excluir frotas_despesas_tipos';
					$tpl['pagetitle'] = $tpl['title'];
					$tpl['body'] = $this->msg->err('Could not find that frotas_despesas_tipos or no frotas_despesas_tipos ID given.');
					
				} else {					
					// Initialise page
					$body['action'] = 'contabilidade/frotas_despesas_tipos/excluir';
					$body['id'] = $frotas_despesas_tipos_id;
					$body['cancel'] = 'contabilidade/frotas_despesas_tipos';
					$body['text'] = 'Se houverem matriculas cadastradas para esta frotas_despesas_tipos, não será possível excluí-la.';
					$tpl['title'] = 'Excluir frotas_despesas_tipos';
					$tpl['pagetitle'] = 'Excluir ' . $frotas_despesas_tipos->frotas_despesas_tipos_descricao;
					$tpl['body'] = $this->load->view('parts/deleteconfirm', $body, TRUE);
					
				}
				
			}
			
			$this->load->view($this->tpl, $tpl);
			
		}
		
	}

}

/* End of file controllers/contabilidade/frotas_despesas_tipos/frotas_despesas_tipos.php */