<?php 
class controle_de_viagem_despesas_tipos extends Controller {

	var $tpl;

	function controle_de_viagem_despesas_tipos(){
		parent::Controller();
		$this->load->model('controle_de_viagem_despesas_tipos/controle_de_viagem_despesas_tipos_model', 'controle_de_viagem_despesas_tipos_model');
		$this->load->helper('text');
		$this->tpl = $this->config->item('template');
		$this->output->enable_profiler($this->config->item('profiler'));
		if($this->auth->logged_in() == TRUE AND $this->config->item('tracker') == TRUE){ $this->rastreador_model->add_visit(); }
	}

	function index(){
		//$this->auth->check('controle_de_viagem_despesas_tipos');
		
		$links[] = array('contabilidade/controle_de_viagem_despesas_tipos/adicionar', 'Adicionar novo controle_de_viagem_despesas_tipos');
		$tpl['links'] = $this->load->view('parts/linkbar', $links, TRUE);
		
		// Get list of usuarios
		$body['controle_de_viagem_despesas_tipos'] = $this->controle_de_viagem_despesas_tipos_model->get_controle_de_viagem_despesas_tipos();
		
			$tpl['body'] = $this->load->view('contabilidade/controle_de_viagem_despesas_tipos/index.php', $body, TRUE);
			
		$tpl['title'] = 'controle_de_viagem_despesas_tipos';
		$tpl['pagetitle'] = 'Gerenciar controle_de_viagem_despesas_tipos';
		
		$this->load->view($this->tpl, $tpl);
	}

	function adicionar(){
		//$this->auth->check('controle_de_viagem_despesas_tipos.adicionar');
		$body['controle_de_viagem_despesas_tipos'] = NULL;
		$body['controle_de_viagem_despesas_tipos_id'] = NULL;
		
		$tpl['title'] = 'Adicionar controle_de_viagem_despesas_tipos';
		$tpl['pagetitle'] = 'Adicionar novo controle_de_viagem_despesas_tipos';
		$tpl['body'] = $this->load->view('contabilidade/controle_de_viagem_despesas_tipos/addedit.php', $body, TRUE);
		$this->load->view($this->tpl, $tpl);
	}
	
	function editar($controle_de_viagem_despesas_tipos_id){
		//$this->auth->check('controle_de_viagem_despesas_tipos.editar');
		$body['controle_de_viagem_despesas_tipos'] = $this->controle_de_viagem_despesas_tipos_model->get_controle_de_viagem_despesas_tipos($controle_de_viagem_despesas_tipos_id);
		$body['controle_de_viagem_despesas_tipos_id'] = $controle_de_viagem_despesas_tipos_id;
		
		//
		$tpl['title'] = 'Editar controle_de_viagem_despesas_tipos';
		
		if($body['controle_de_viagem_despesas_tipos'] != FALSE){
			$tpl['pagetitle'] = 'Editar controle_de_viagem_despesas_tipos ' . $body['controle_de_viagem_despesas_tipos']->controle_de_viagem_despesas_tipos_descricao . '';
			$tpl['body'] = $this->load->view('contabilidade/controle_de_viagem_despesas_tipos/addedit.php', $body, TRUE);
		} else {
			$tpl['pagetitle'] = 'Error getting controle_de_viagem_despesas_tipos';
			$tpl['body'] = $this->msg->err('Could not load the specified controle_de_viagem_despesas_tipos. Please check the ID and try again.');
		}
		
		$this->load->view($this->tpl, $tpl);
	}

	function salvar(){
		
		$controle_de_viagem_despesas_tipos_id = $this->input->post('controle_de_viagem_despesas_tipos_id');
		
		$this->form_validation->set_rules('controle_de_viagem_despesas_tipos_id', 'controle_de_viagem_despesas_tipos_id');
		$this->form_validation->set_rules('controle_de_viagem_despesas_tipos_descricao', 'controle_de_viagem_despesas_tipos_descricao', 'required|trim');
		$this->form_validation->set_error_delimiters('<li>', '</li>');

		if($this->form_validation->run() == FALSE){
			
			// Validation failed - load required action depending on the state of usuario_id
			($controle_de_viagem_despesas_tipos_id == NULL) ? $this->adicionar() : $this->editar($controle_de_viagem_despesas_tipos_id);
			
		} else {
		
			// Validation OK
			$data['controle_de_viagem_despesas_tipos_descricao']		=	str2uppercase($this->input->post('controle_de_viagem_despesas_tipos_descricao'));
			$data['controle_de_viagem_despesas_tipos_ativo']			=	($this->input->post('controle_de_viagem_despesas_tipos_ativo') == '1') ? 1 : 0;
			if($controle_de_viagem_despesas_tipos_id == NULL){
			
				$adicionar = $this->controle_de_viagem_despesas_tipos_model->add_controle_de_viagem_despesas_tipos($data);
				
				if($adicionar == TRUE){
					$this->msg->adicionar('info', sprintf($this->lang->line('SECURITY_TURMA_ADD_OK'), $data['controle_de_viagem_despesas_tipos_descricao']));
				} else {
					//$this->msg->adicionar('err', sprintf($this->lang->line('SECURITY_TURMA_ADD_FAIL', $this->controle_de_viagem_despesas_tipos_model->lasterr)));
					$this->msg->adicionar('err', $this->controle_de_viagem_despesas_tipos_model->lasterr, 'ERRO!');
				}
			
			} else {
			
				// Updating existing controle_de_viagem_despesas_tipos
				$editar = $this->controle_de_viagem_despesas_tipos_model->edit_controle_de_viagem_despesas_tipos($controle_de_viagem_despesas_tipos_id, $data);
				if($editar == TRUE){
					$this->msg->adicionar('info', sprintf($this->lang->line('SECURITY_TURMA_EDIT_OK'), $data['controle_de_viagem_despesas_tipos_descricao']));
				} else {
					$this->msg->adicionar('err', sprintf($this->lang->line('SECURITY_TURMA_EDIT_FAIL', $this->controle_de_viagem_despesas_tipos_model->lasterr)));
				}
				
			}
			
			if($this->input->post('btn_submit') == 'Adicionar' || $this->input->post('btn_submit') == 'Salvar'){
				redirect('contabilidade/controle_de_viagem_despesas_tipos');
			}else{
				redirect('contabilidade/controle_de_viagem_despesas_tipos/adicionar');
			}			
		}
		
	}

	function excluir($controle_de_viagem_despesas_tipos_id = NULL){
		//$this->auth->check('controle_de_viagem_despesas_tipos.excluir');
		
		// Check if a form has been submitted; if not - show it to ask controle_de_viagem_despesas_tipos confirmation
		if($this->input->post('id')){
		
			// Form has been submitted (so the POST value exists)
			// Call model function to excluir controle_de_viagem_despesas_tipos
			$excluir = $this->controle_de_viagem_despesas_tipos_model->delete_controle_de_viagem_despesas_tipos($this->input->post('id'));
			if($excluir == FALSE){
				$this->msg->adicionar('err', $this->controle_de_viagem_despesas_tipos_model->lasterr, 'Ocorreu um erro!');
			} else {
				$this->msg->adicionar('info', 'The controle_de_viagem_despesas_tipos has been deleted.');
			}
			// Redirect
			redirect('contabilidade/controle_de_viagem_despesas_tipos');
			
		} else {
			if($controle_de_viagem_despesas_tipos_id == NULL){
				
				$tpl['title'] = 'Excluir controle_de_viagem_despesas_tipos';
				$tpl['pagetitle'] = $tpl['title'];
				$tpl['body'] = $this->msg->err('Cannot find the controle_de_viagem_despesas_tipos or no controle_de_viagem_despesas_tipos ID given.');
				
			} else {
				
				// Get controle_de_viagem_despesas_tipos info so we can present the confirmation page
				$controle_de_viagem_despesas_tipos = $this->controle_de_viagem_despesas_tipos_model->get_controle_de_viagem_despesas_tipos($controle_de_viagem_despesas_tipos_id);
				
				if($controle_de_viagem_despesas_tipos == FALSE){
				
					$tpl['title'] = 'Excluir controle_de_viagem_despesas_tipos';
					$tpl['pagetitle'] = $tpl['title'];
					$tpl['body'] = $this->msg->err('Could not find that controle_de_viagem_despesas_tipos or no controle_de_viagem_despesas_tipos ID given.');
					
				} else {					
					// Initialise page
					$body['action'] = 'contabilidade/controle_de_viagem_despesas_tipos/excluir';
					$body['id'] = $controle_de_viagem_despesas_tipos_id;
					$body['cancel'] = 'contabilidade/controle_de_viagem_despesas_tipos';
					$body['text'] = 'Se houverem despesas cadastradas para este tipo de  despesa, não será possível excluí-la.';
					$tpl['title'] = 'Excluir controle_de_viagem_despesas_tipos';
					$tpl['pagetitle'] = 'Excluir ' . $controle_de_viagem_despesas_tipos->controle_de_viagem_despesas_tipos_descricao;
					$tpl['body'] = $this->load->view('parts/deleteconfirm', $body, TRUE);
					
				}
				
			}
			
			$this->load->view($this->tpl, $tpl);
			
		}
		
	}

}

/* End of file controllers/contabilidade/controle_de_viagem_despesas_tipos/controle_de_viagem_despesas_tipos.php */