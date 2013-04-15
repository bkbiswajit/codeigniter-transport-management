<?php 
class bonificacao extends Controller {

	var $tpl;

	function bonificacao(){
		parent::Controller();
		$this->load->model('bonificacao/bonificacao_model', 'bonificacao_model');
		$this->load->helper('text');
		$this->tpl = $this->config->item('template');
		$this->output->enable_profiler($this->config->item('profiler'));
		if($this->auth->logged_in() == TRUE AND $this->config->item('tracker') == TRUE){ $this->rastreador_model->add_visit(); }
	}

	function index(){
		//$this->auth->check('bonificacao');
		
		$links[] = array('contabilidade/bonificacao/adicionar', 'Adicionar novo bonificacao');
		$tpl['links'] = $this->load->view('parts/linkbar', $links, TRUE);
		
		// Get list of usuarios
		$body['bonificacao'] = $this->bonificacao_model->get_bonificacao();
		
			$tpl['body'] = $this->load->view('contabilidade/bonificacao/index.php', $body, TRUE);
			
		$tpl['title'] = 'bonificacao';
		$tpl['pagetitle'] = 'Gerenciar bonificacao';
		
		$this->load->view($this->tpl, $tpl);
	}

	function adicionar(){
		//$this->auth->check('bonificacao.adicionar');
		$body['bonificacao'] = NULL;
		$body['bonificacao_id'] = NULL;
		
		$tpl['title'] = 'Adicionar bonificacao';
		$tpl['pagetitle'] = 'Adicionar novo bonificacao';
		$tpl['body'] = $this->load->view('contabilidade/bonificacao/addedit.php', $body, TRUE);
		$this->load->view($this->tpl, $tpl);
	}
	
	function editar($bonificacao_id){
		//$this->auth->check('bonificacao.editar');
		$body['bonificacao'] = $this->bonificacao_model->get_bonificacao($bonificacao_id);
		$body['bonificacao_id'] = $bonificacao_id;
		
		//
		$tpl['title'] = 'Editar bonificacao';
		
		if($body['bonificacao'] != FALSE){
			$tpl['pagetitle'] = 'Editar bonificacao ' . $body['bonificacao']->bonificacao_descricao . '';
			$tpl['body'] = $this->load->view('contabilidade/bonificacao/addedit.php', $body, TRUE);
		} else {
			$tpl['pagetitle'] = 'Error getting bonificacao';
			$tpl['body'] = $this->msg->err('Could not load the specified bonificacao. Please check the ID and try again.');
		}
		
		$this->load->view($this->tpl, $tpl);
	}

	function salvar(){
		
		$bonificacao_id = $this->input->post('bonificacao_id');
		
		$this->form_validation->set_rules('bonificacao_id', 'bonificacao_id');
		$this->form_validation->set_rules('bonificacao_descricao', 'Mês', 'required|trim|xss_clean');
		$this->form_validation->set_rules('bonificacao_mes_inicio', 'Mês Início', 'required|trim|xss_clean');
		$this->form_validation->set_rules('bonificacao_mes_final', 'Mês Final', 'required|trim|xss_clean');
		$this->form_validation->set_error_delimiters('<li>', '</li>');
		if ($this->form_validation->run() == FALSE) {
			($bonificacao_id == NULL) ? $this->adicionar() : $this->editar($bonificacao_id);
		} else {
			$data['bonificacao_descricao']	= str2uppercase($this->input->post('bonificacao_descricao'));
			$data['bonificacao_mes_inicio']	= human2mysql($this->input->post('bonificacao_mes_inicio'));
			$data['bonificacao_mes_final']	= human2mysql($this->input->post('bonificacao_mes_final'));
			if($bonificacao_id == NULL){
			
				$adicionar = $this->bonificacao_model->add_bonificacao($data);
				
				if($adicionar == TRUE){
					$this->msg->adicionar('info', sprintf($this->lang->line('SECURITY_TURMA_ADD_OK'), $data['bonificacao_descricao']));
				} else {
					//$this->msg->adicionar('err', sprintf($this->lang->line('SECURITY_TURMA_ADD_FAIL', $this->bonificacao_model->lasterr)));
					$this->msg->adicionar('err', $this->bonificacao_model->lasterr, 'ERRO!');
				}
			
			} else {
			
				// Updating existing bonificacao
				$editar = $this->bonificacao_model->edit_bonificacao($bonificacao_id, $data);
				if($editar == TRUE){
					$this->msg->adicionar('info', sprintf($this->lang->line('SECURITY_TURMA_EDIT_OK'), $data['bonificacao_descricao']));
				} else {
					$this->msg->adicionar('err', sprintf($this->lang->line('SECURITY_TURMA_EDIT_FAIL', $this->bonificacao_model->lasterr)));
				}
				
			}
			
			if($this->input->post('btn_submit') == 'Adicionar' || $this->input->post('btn_submit') == 'Salvar'){
				redirect('contabilidade/bonificacao');
			}else{
				redirect('contabilidade/bonificacao/adicionar');
			}
		}
		
	}

	function excluir($bonificacao_id = NULL){
		//$this->auth->check('bonificacao.excluir');
		
		// Check if a form has been submitted; if not - show it to ask bonificacao confirmation
		if($this->input->post('id')){
		
			// Form has been submitted (so the POST value exists)
			// Call model function to excluir bonificacao
			$excluir = $this->bonificacao_model->delete_bonificacao($this->input->post('id'));
			if($excluir == FALSE){
				$this->msg->adicionar('err', $this->bonificacao_model->lasterr, 'Ocorreu um erro!');
			} else {
				$this->msg->adicionar('info', 'The bonificacao has been deleted.');
			}
			// Redirect
			redirect('contabilidade/bonificacao');
			
		} else {
			if($bonificacao_id == NULL){
				
				$tpl['title'] = 'Excluir bonificacao';
				$tpl['pagetitle'] = $tpl['title'];
				$tpl['body'] = $this->msg->err('Cannot find the bonificacao or no bonificacao ID given.');
				
			} else {
				
				// Get bonificacao info so we can present the confirmation page
				$bonificacao = $this->bonificacao_model->get_bonificacao($bonificacao_id);
				
				if($bonificacao == FALSE){
				
					$tpl['title'] = 'Excluir bonificacao';
					$tpl['pagetitle'] = $tpl['title'];
					$tpl['body'] = $this->msg->err('Could not find that bonificacao or no bonificacao ID given.');
					
				} else {					
					// Initialise page
					$body['action'] = 'contabilidade/bonificacao/excluir';
					$body['id'] = $bonificacao_id;
					$body['cancel'] = 'contabilidade/bonificacao';
					$body['text'] = 'Se houverem matriculas cadastradas para esta bonificacao, não será possível excluí-la.';
					$tpl['title'] = 'Excluir bonificacao';
					$tpl['pagetitle'] = 'Excluir ' . $bonificacao->bonificacao_descricao;
					$tpl['body'] = $this->load->view('parts/deleteconfirm', $body, TRUE);
					
				}
				
			}
			
			$this->load->view($this->tpl, $tpl);
			
		}
		
	}

}

/* End of file controllers/contabilidade/bonificacao/bonificacao.php */