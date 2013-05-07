<?php 
class frotas_despesas extends Controller {

	var $tpl;

	function frotas_despesas(){
		parent::Controller();
		$this->load->model('frotas_despesas/frotas_despesas_model', 'frotas_despesas_model');
		$this->load->helper('text');
		$this->tpl = $this->config->item('template');
		$this->output->enable_profiler($this->config->item('profiler'));
		if($this->auth->logged_in() == TRUE AND $this->config->item('tracker') == TRUE){ $this->rastreador_model->add_visit(); }
	}

	function index(){
		//$this->auth->check('frotas_despesas');
		
		$links[] = array('contabilidade/frotas_despesas/adicionar', 'Adicionar novo frotas_despesas');
		$tpl['links'] = $this->load->view('parts/linkbar', $links, TRUE);
		
		// Get list of usuarios
		$body['frotas_despesas'] = $this->frotas_despesas_model->get_caminhoes();
		
			$tpl['body'] = $this->load->view('contabilidade/frotas_despesas/index.php', $body, TRUE);
			
		$tpl['title'] = 'frotas_despesas';
		$tpl['pagetitle'] = 'Gerenciar frotas_despesas';
		
		$this->load->view($this->tpl, $tpl);
	}

	function adicionar(){
		//$this->auth->check('frotas_despesas.adicionar');
		$body['frotas_despesas'] = NULL;
		$body['frotas_despesas_id'] = NULL;
		
		$this->load->model('frotas/frotas_model');
		$body['frotas'] = $this->frotas_model->get_caminhoes_dropdown();
		
		$this->load->model('frotas_despesas_tipos/frotas_despesas_tipos_model');
		$body['frotas_despesas_tipos'] = $this->frotas_despesas_tipos_model->get_frotas_despesas_tipos_dropdown();
		
		
		$tpl['title'] = 'Adicionar frotas_despesas';
		$tpl['pagetitle'] = 'Adicionar novo frotas_despesas';
		$tpl['body'] = $this->load->view('contabilidade/frotas_despesas/addedit.php', $body, TRUE);
		$this->load->view($this->tpl, $tpl);
	}
	
	function editar($frotas_despesas_id){
		//$this->auth->check('frotas_despesas.editar');
		$body['frotas_despesas'] = $this->frotas_despesas_model->get_caminhoes($frotas_despesas_id);
		$body['frotas_despesas_id'] = $frotas_despesas_id;
		
		$this->load->model('frotas/frotas_model');
		$body['frotas'] = $this->frotas_model->get_caminhoes_dropdown();
		
		$this->load->model('frotas_despesas_tipos/frotas_despesas_tipos_model');
		$body['frotas_despesas_tipos'] = $this->frotas_despesas_tipos_model->get_frotas_despesas_tipos_dropdown();
		
		//
		$tpl['title'] = 'Editar frotas_despesas';
		
		if($body['frotas_despesas'] != FALSE){
			$tpl['pagetitle'] = 'Editar frotas_despesas ' . $body['frotas_despesas']->frotas_despesas_descricao . '';
			$tpl['body'] = $this->load->view('contabilidade/frotas_despesas/addedit.php', $body, TRUE);
		} else {
			$tpl['pagetitle'] = 'Error getting frotas_despesas';
			$tpl['body'] = $this->msg->err('Could not load the specified frotas_despesas. Please check the ID and try again.');
		}
		
		$this->load->view($this->tpl, $tpl);
	}

	function salvar(){
		
		$frotas_despesas_id = $this->input->post('frotas_despesas_id');
		
		$this->form_validation->set_rules('frotas_despesas_id', 'frotas_despesas_id');
		// $this->form_validation->set_rules('frotas_despesas_descricao', 'Frota ', 'required|trim|xss_clean');
		$this->form_validation->set_rules('frotas_despesas_frotas_id', 'frotas_despesas_frotas_id', 'required|trim|xss_clean');
		$this->form_validation->set_rules('frotas_despesas_tipos_id', 'frotas_despesas_tipos_id', 'required|trim|xss_clean');
		$this->form_validation->set_rules('frotas_despesas_data_vencimento', 'frotas_despesas_data_vencimento', 'required|trim|xss_clean');
		$this->form_validation->set_rules('frotas_despesas_data_pagamento', 'frotas_despesas_data_pagamento', 'required|trim|xss_clean');
		$this->form_validation->set_rules('frotas_despesas_valor', 'frotas_despesas_valor', 'required|trim|xss_clean');
		$this->form_validation->set_rules('frotas_despesas_ativo', 'Ativo ', 'trim|xss_clean');
		$this->form_validation->set_error_delimiters('<li>', '</li>');
		if ($this->form_validation->run() == FALSE) {
			($frotas_despesas_id == NULL) ? $this->adicionar() : $this->editar($frotas_despesas_id);
		} else {


		$data['frotas_despesas_frotas_id'] 			= str2uppercase($this->input->post('frotas_despesas_frotas_id'));
		$data['frotas_despesas_tipos_id'] 			= str2uppercase($this->input->post('frotas_despesas_tipos_id'));
		$data['frotas_despesas_data_vencimento'] 	= human2mysql($this->input->post('frotas_despesas_data_vencimento'));
		$data['frotas_despesas_data_pagamento'] 	= human2mysql($this->input->post('frotas_despesas_data_pagamento'));
		$data['frotas_despesas_valor'] 				= str2uppercase($this->input->post('frotas_despesas_valor'));
		$data['frotas_despesas_descricao']			= str2uppercase($this->input->post('frotas_despesas_descricao'));
		$data['frotas_despesas_ativo']				= ($this->input->post('frotas_despesas_ativo') == '1') ? 1 : 0;
			
			if($frotas_despesas_id == NULL){
			
				$adicionar = $this->frotas_despesas_model->add_caminhoes($data);
				
				if($adicionar == TRUE){
					$this->msg->adicionar('info', sprintf($this->lang->line('SECURITY_TURMA_ADD_OK'), $data['frotas_despesas_descricao']));
				} else {
					//$this->msg->adicionar('err', sprintf($this->lang->line('SECURITY_TURMA_ADD_FAIL', $this->frotas_despesas_model->lasterr)));
					$this->msg->adicionar('err', $this->frotas_despesas_model->lasterr, 'ERRO!');
				}
			
			} else {
			
				// Updating existing frotas_despesas
				$editar = $this->frotas_despesas_model->edit_caminhoes($frotas_despesas_id, $data);
				if($editar == TRUE){
					$this->msg->adicionar('info', sprintf($this->lang->line('SECURITY_TURMA_EDIT_OK'), $data['frotas_despesas_descricao']));
				} else {
					$this->msg->adicionar('err', sprintf($this->lang->line('SECURITY_TURMA_EDIT_FAIL', $this->frotas_despesas_model->lasterr)));
				}
				
			}
			
			if($this->input->post('btn_submit') == 'Adicionar' || $this->input->post('btn_submit') == 'Salvar'){
				redirect('contabilidade/frotas_despesas');
			}else{
				redirect('contabilidade/frotas_despesas/adicionar');
			}
		}
		
	}

	function excluir($frotas_despesas_id = NULL){
		//$this->auth->check('frotas_despesas.excluir');
		
		// Check if a form has been submitted; if not - show it to ask frotas_despesas confirmation
		if($this->input->post('id')){
		
			// Form has been submitted (so the POST value exists)
			// Call model function to excluir frotas_despesas
			$excluir = $this->frotas_despesas_model->delete_caminhoes($this->input->post('id'));
			if($excluir == FALSE){
				$this->msg->adicionar('err', $this->frotas_despesas_model->lasterr, 'Ocorreu um erro!');
			} else {
				$this->msg->adicionar('info', 'The frotas_despesas has been deleted.');
			}
			// Redirect
			redirect('contabilidade/frotas_despesas');
			
		} else {
			if($frotas_despesas_id == NULL){
				
				$tpl['title'] = 'Excluir frotas_despesas';
				$tpl['pagetitle'] = $tpl['title'];
				$tpl['body'] = $this->msg->err('Cannot find the frotas_despesas or no frotas_despesas ID given.');
				
			} else {
				
				// Get frotas_despesas info so we can present the confirmation page
				$frotas_despesas = $this->frotas_despesas_model->get_caminhoes($frotas_despesas_id);
				
				if($frotas_despesas == FALSE){
				
					$tpl['title'] = 'Excluir frotas_despesas';
					$tpl['pagetitle'] = $tpl['title'];
					$tpl['body'] = $this->msg->err('Could not find that frotas_despesas or no frotas_despesas ID given.');
					
				} else {					
					// Initialise page
					$body['action'] = 'contabilidade/frotas_despesas/excluir';
					$body['id'] = $frotas_despesas_id;
					$body['cancel'] = 'contabilidade/frotas_despesas';
					$body['text'] = 'Se houverem matriculas cadastradas para esta frotas_despesas, não será possível excluí-la.';
					$tpl['title'] = 'Excluir frotas_despesas';
					$tpl['pagetitle'] = 'Excluir ' . $frotas_despesas->frotas_despesas_descricao;
					$tpl['body'] = $this->load->view('parts/deleteconfirm', $body, TRUE);
					
				}
				
			}
			
			$this->load->view($this->tpl, $tpl);
			
		}
		
	}

}

/* End of file controllers/contabilidade/frotas_despesas/frotas_despesas.php */