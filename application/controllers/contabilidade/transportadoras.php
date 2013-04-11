<?php 
class transportadoras extends Controller {

	var $tpl;

	function transportadoras(){
		parent::Controller();
		$this->load->model('transportadoras/transportadoras_model', 'transportadoras_model');
		$this->load->helper('text');
		$this->tpl = $this->config->item('template');
		$this->output->enable_profiler($this->config->item('profiler'));
		if($this->auth->logged_in() == TRUE AND $this->config->item('tracker') == TRUE){ $this->rastreador_model->add_visit(); }
	}

	function index(){
		//$this->auth->check('transportadoras');
		
		$links[] = array('contabilidade/transportadoras/adicionar', 'Adicionar novo transportadoras');
		$tpl['links'] = $this->load->view('parts/linkbar', $links, TRUE);
		
		// Get list of usuarios
		$body['transportadoras'] = $this->transportadoras_model->get_transportadoras();
		
			$tpl['body'] = $this->load->view('contabilidade/transportadoras/index.php', $body, TRUE);
			
		$tpl['title'] = 'transportadoras';
		$tpl['pagetitle'] = 'Gerenciar transportadoras';
		
		$this->load->view($this->tpl, $tpl);
	}

	function adicionar(){
		//$this->auth->check('transportadoras.adicionar');
		$body['transportadoras'] = NULL;
		$body['transportadoras_id'] = NULL;
		
		$tpl['title'] = 'Adicionar transportadoras';
		$tpl['pagetitle'] = 'Adicionar novo transportadoras';
		$tpl['body'] = $this->load->view('contabilidade/transportadoras/addedit.php', $body, TRUE);
		$this->load->view($this->tpl, $tpl);
	}
	
	function editar($transportadoras_id){
		//$this->auth->check('transportadoras.editar');
		$body['transportadoras'] = $this->transportadoras_model->get_transportadoras($transportadoras_id);
		$body['transportadoras_id'] = $transportadoras_id;
		
		//
		$tpl['title'] = 'Editar transportadoras';
		
		if($body['transportadoras'] != FALSE){
			$tpl['pagetitle'] = 'Editar transportadoras ' . $body['transportadoras']->transportadoras_descricao . '';
			$tpl['body'] = $this->load->view('contabilidade/transportadoras/addedit.php', $body, TRUE);
		} else {
			$tpl['pagetitle'] = 'Error getting transportadoras';
			$tpl['body'] = $this->msg->err('Não foi possível carregar o cliente especificado. Por favor, verifique o ID e tente novamente.');
		}
		
		$this->load->view($this->tpl, $tpl);
	}

	function salvar(){
		
		$transportadoras_id = $this->input->post('transportadoras_id');
		
		//echo $this->input->post('btn_submit'); exit;
		
		$this->form_validation->set_rules('transportadoras_id', 'transportadoras_id');
		$this->form_validation->set_rules('transportadoras_descricao', 'transportadoras_descricao', 'required|trim');
		$this->form_validation->set_error_delimiters('<li>', '</li>');

		if($this->form_validation->run() == FALSE){
			
			// Validation failed - load required action depending on the state of usuario_id
			($transportadoras_id == NULL) ? $this->adicionar() : $this->editar($transportadoras_id);
			
		} else {
		
			// Validation OK
			$data['transportadoras_descricao']		=	str2uppercase($this->input->post('transportadoras_descricao'));
			$data['transportadoras_ativo']			=	($this->input->post('transportadoras_ativo') == '1') ? 1 : 0;
			
			if($transportadoras_id == NULL){
			
				$adicionar = $this->transportadoras_model->add_transportadoras($data);
				
				if($adicionar == TRUE){
					$this->msg->adicionar('info', sprintf($this->lang->line('SECURITY_TURMA_ADD_OK'), $data['transportadoras_descricao']));
				} else {
					//$this->msg->adicionar('err', sprintf($this->lang->line('SECURITY_TURMA_ADD_FAIL', $this->transportadoras_model->lasterr)));
					$this->msg->adicionar('err', $this->transportadoras_model->lasterr, 'ERRO!');
				}
			
			} else {
			
				// Updating existing transportadoras
				$editar = $this->transportadoras_model->edit_transportadoras($transportadoras_id, $data);
				if($editar == TRUE){
					$this->msg->adicionar('info', sprintf($this->lang->line('SECURITY_TURMA_EDIT_OK'), $data['transportadoras_descricao']));
				} else {
					$this->msg->adicionar('err', sprintf($this->lang->line('SECURITY_TURMA_EDIT_FAIL', $this->transportadoras_model->lasterr)));
				}
				
			}
			
			if($this->input->post('btn_submit') == 'Adicionar' || $this->input->post('btn_submit') == 'Salvar'){
				redirect('contabilidade/transportadoras');
			}else{
				redirect('contabilidade/transportadoras/adicionar');
			}
			
		}
		
	}

	function excluir($transportadoras_id = NULL){
		//$this->auth->check('transportadoras.excluir');
		
		// Check if a form has been submitted; if not - show it to ask transportadoras confirmation
		if($this->input->post('id')){
		
			// Form has been submitted (so the POST value exists)
			// Call model function to excluir transportadoras
			$excluir = $this->transportadoras_model->delete_transportadoras($this->input->post('id'));
			if($excluir == FALSE){
				$this->msg->adicionar('err', $this->transportadoras_model->lasterr, 'Erro ao excluir o cliente.');
			} else {
				$this->msg->adicionar('info', 'O cliente foi excluído com sucesso.');
			}
			// Redirect
			redirect('contabilidade/transportadoras');
			
		} else {
			if($transportadoras_id == NULL){
				
				$tpl['title'] = 'Excluir transportadoras';
				$tpl['pagetitle'] = $tpl['title'];
				$tpl['body'] = $this->msg->err('Não foi possível encontrar o cliente com o ID especificado.');
				
			} else {
				
				// Get transportadoras info so we can present the confirmation page
				$transportadoras = $this->transportadoras_model->get_transportadoras($transportadoras_id);
				
				if($transportadoras == FALSE){
				
					$tpl['title'] = 'Excluir transportadoras';
					$tpl['pagetitle'] = $tpl['title'];
					$tpl['body'] = $this->msg->err('Não foi possível encontrar o cliente com o ID especificado.');
					
				} else {					
					// Initialise page
					$body['action'] = 'contabilidade/transportadoras/excluir';
					$body['id'] = $transportadoras_id;
					$body['cancel'] = 'contabilidade/transportadoras';
					$body['text'] = 'Se existirem itens cadastrados para este cliente, não será possível excluí-lo.';
					$tpl['title'] = 'Excluir transportadoras';
					$tpl['pagetitle'] = 'Excluir ' . $transportadoras->transportadoras_descricao;
					$tpl['body'] = $this->load->view('parts/deleteconfirm', $body, TRUE);
					
				}
				
			}
			
			$this->load->view($this->tpl, $tpl);
			
		}
		
	}

}

/* End of file controllers/contabilidade/transportadoras/transportadoras.php */