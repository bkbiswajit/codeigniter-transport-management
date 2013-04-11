<?php 
class Clientes extends Controller {

	var $tpl;

	function Clientes(){
		parent::Controller();
		$this->load->model('clientes/clientes_model', 'clientes_model');
		$this->load->helper('text');
		$this->tpl = $this->config->item('template');
		$this->output->enable_profiler($this->config->item('profiler'));
		if($this->auth->logged_in() == TRUE AND $this->config->item('tracker') == TRUE){ $this->rastreador_model->add_visit(); }
	}

	function index(){
		//$this->auth->check('clientes');
		
		$links[] = array('contabilidade/clientes/adicionar', 'Adicionar novo clientes');
		$tpl['links'] = $this->load->view('parts/linkbar', $links, TRUE);
		
		// Get list of usuarios
		$body['clientes'] = $this->clientes_model->get_clientes();
		
			$tpl['body'] = $this->load->view('contabilidade/clientes/index.php', $body, TRUE);
			
		$tpl['title'] = 'clientes';
		$tpl['pagetitle'] = 'Gerenciar clientes';
		
		$this->load->view($this->tpl, $tpl);
	}

	function adicionar(){
		//$this->auth->check('clientes.adicionar');
		$body['clientes'] = NULL;
		$body['clientes_id'] = NULL;
		
		$tpl['title'] = 'Adicionar clientes';
		$tpl['pagetitle'] = 'Adicionar novo clientes';
		$tpl['body'] = $this->load->view('contabilidade/clientes/addedit.php', $body, TRUE);
		$this->load->view($this->tpl, $tpl);
	}
	
	function editar($clientes_id){
		//$this->auth->check('clientes.editar');
		$body['clientes'] = $this->clientes_model->get_clientes($clientes_id);
		$body['clientes_id'] = $clientes_id;
		
		//
		$tpl['title'] = 'Editar clientes';
		
		if($body['clientes'] != FALSE){
			$tpl['pagetitle'] = 'Editar clientes ' . $body['clientes']->clientes_descricao . '';
			$tpl['body'] = $this->load->view('contabilidade/clientes/addedit.php', $body, TRUE);
		} else {
			$tpl['pagetitle'] = 'Error getting clientes';
			$tpl['body'] = $this->msg->err('Não foi possível carregar o cliente especificado. Por favor, verifique o ID e tente novamente.');
		}
		
		$this->load->view($this->tpl, $tpl);
	}

	function salvar(){
		
		$clientes_id = $this->input->post('clientes_id');
		
		//echo $this->input->post('btn_submit'); exit;
		
		$this->form_validation->set_rules('clientes_id', 'clientes_id');
		$this->form_validation->set_rules('clientes_descricao', 'clientes_descricao', 'required|trim');
		$this->form_validation->set_error_delimiters('<li>', '</li>');

		if($this->form_validation->run() == FALSE){
			
			// Validation failed - load required action depending on the state of usuario_id
			($clientes_id == NULL) ? $this->adicionar() : $this->editar($clientes_id);
			
		} else {
		
			// Validation OK
			$data['clientes_descricao']		=	str2uppercase($this->input->post('clientes_descricao'));
			$data['clientes_ativo']			=	($this->input->post('clientes_ativo') == '1') ? 1 : 0;
			
			if($clientes_id == NULL){
			
				$adicionar = $this->clientes_model->add_clientes($data);
				
				if($adicionar == TRUE){
					$this->msg->adicionar('info', sprintf($this->lang->line('SECURITY_TURMA_ADD_OK'), $data['clientes_descricao']));
				} else {
					//$this->msg->adicionar('err', sprintf($this->lang->line('SECURITY_TURMA_ADD_FAIL', $this->clientes_model->lasterr)));
					$this->msg->adicionar('err', $this->clientes_model->lasterr, 'ERRO!');
				}
			
			} else {
			
				// Updating existing clientes
				$editar = $this->clientes_model->edit_clientes($clientes_id, $data);
				if($editar == TRUE){
					$this->msg->adicionar('info', sprintf($this->lang->line('SECURITY_TURMA_EDIT_OK'), $data['clientes_descricao']));
				} else {
					$this->msg->adicionar('err', sprintf($this->lang->line('SECURITY_TURMA_EDIT_FAIL', $this->clientes_model->lasterr)));
				}
				
			}
			
			if($this->input->post('btn_submit') == 'Adicionar' || $this->input->post('btn_submit') == 'Salvar'){
				redirect('contabilidade/clientes');
			}else{
				redirect('contabilidade/clientes/adicionar');
			}
			
		}
		
	}

	function excluir($clientes_id = NULL){
		//$this->auth->check('clientes.excluir');
		
		// Check if a form has been submitted; if not - show it to ask clientes confirmation
		if($this->input->post('id')){
		
			// Form has been submitted (so the POST value exists)
			// Call model function to excluir clientes
			$excluir = $this->clientes_model->delete_clientes($this->input->post('id'));
			if($excluir == FALSE){
				$this->msg->adicionar('err', $this->clientes_model->lasterr, 'Erro ao excluir o cliente.');
			} else {
				$this->msg->adicionar('info', 'O cliente foi excluído com sucesso.');
			}
			// Redirect
			redirect('contabilidade/clientes');
			
		} else {
			if($clientes_id == NULL){
				
				$tpl['title'] = 'Excluir clientes';
				$tpl['pagetitle'] = $tpl['title'];
				$tpl['body'] = $this->msg->err('Não foi possível encontrar o cliente com o ID especificado.');
				
			} else {
				
				// Get clientes info so we can present the confirmation page
				$clientes = $this->clientes_model->get_clientes($clientes_id);
				
				if($clientes == FALSE){
				
					$tpl['title'] = 'Excluir clientes';
					$tpl['pagetitle'] = $tpl['title'];
					$tpl['body'] = $this->msg->err('Não foi possível encontrar o cliente com o ID especificado.');
					
				} else {					
					// Initialise page
					$body['action'] = 'contabilidade/clientes/excluir';
					$body['id'] = $clientes_id;
					$body['cancel'] = 'contabilidade/clientes';
					$body['text'] = 'Se existirem itens cadastrados para este cliente, não será possível excluí-lo.';
					$tpl['title'] = 'Excluir clientes';
					$tpl['pagetitle'] = 'Excluir ' . $clientes->clientes_descricao;
					$tpl['body'] = $this->load->view('parts/deleteconfirm', $body, TRUE);
					
				}
				
			}
			
			$this->load->view($this->tpl, $tpl);
			
		}
		
	}

}

/* End of file controllers/contabilidade/clientes/clientes.php */