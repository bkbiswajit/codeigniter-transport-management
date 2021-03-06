<?php 
class frotas extends Controller {

	var $tpl;

	function frotas(){
		parent::Controller();
		$this->load->model('frotas/frotas_model', 'frotas_model');
		$this->load->helper('text');
		$this->tpl = $this->config->item('template');
		$this->output->enable_profiler($this->config->item('profiler'));
		if($this->auth->logged_in() == TRUE AND $this->config->item('tracker') == TRUE){ $this->rastreador_model->add_visit(); }
	}

	function index(){
		//$this->auth->check('frotas');
		
		$links[] = array('contabilidade/frotas/adicionar', 'Adicionar novo frotas');
		$tpl['links'] = $this->load->view('parts/linkbar', $links, TRUE);
		
		// Get list of usuarios
		$body['frotas'] = $this->frotas_model->get_caminhoes();
		
			$tpl['body'] = $this->load->view('contabilidade/frotas/index.php', $body, TRUE);
			
		$tpl['title'] = 'frotas';
		$tpl['pagetitle'] = 'Gerenciar frotas';
		
		$this->load->view($this->tpl, $tpl);
	}

	function adicionar(){
		//$this->auth->check('frotas.adicionar');
		$body['frotas'] = NULL;
		$body['caminhoes_id'] = NULL;
		
		$tpl['title'] = 'Adicionar frotas';
		$tpl['pagetitle'] = 'Adicionar novo frotas';
		$tpl['body'] = $this->load->view('contabilidade/frotas/addedit.php', $body, TRUE);
		$this->load->view($this->tpl, $tpl);
	}
	
	function editar($caminhoes_id){
		//$this->auth->check('frotas.editar');
		$body['frotas'] = $this->frotas_model->get_caminhoes($caminhoes_id);
		$body['caminhoes_id'] = $caminhoes_id;
		
		//
		$tpl['title'] = 'Editar frotas';
		
		if($body['frotas'] != FALSE){
			$tpl['pagetitle'] = 'Editar frotas ' . $body['frotas']->caminhoes_descricao . '';
			$tpl['body'] = $this->load->view('contabilidade/frotas/addedit.php', $body, TRUE);
		} else {
			$tpl['pagetitle'] = 'Error getting frotas';
			$tpl['body'] = $this->msg->err('Could not load the specified frotas. Please check the ID and try again.');
		}
		
		$this->load->view($this->tpl, $tpl);
	}

	function salvar(){
		
		$caminhoes_id = $this->input->post('caminhoes_id');
		
		$this->form_validation->set_rules('caminhoes_id', 'caminhoes_id');
		$this->form_validation->set_rules('caminhoes_descricao', 'Frota ', 'required|trim|xss_clean');
		$this->form_validation->set_rules('caminhoes_cavalo', 'cavalo ', 'required|trim|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('caminhoes_cavalo_ano', 'cavalo_ano ', 'required|trim|numeric|exact_length[4]|xss_clean');
		$this->form_validation->set_rules('caminhoes_carreta', 'carreta ', 'required|trim|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('caminhoes_carreta_ano', 'carreta_ano ', 'required|trim|numeric|exact_length[4]|xss_clean');
		$this->form_validation->set_rules('caminhoes_ativo', 'Ativo ', 'trim|xss_clean');
		$this->form_validation->set_error_delimiters('<li>', '</li>');
		if ($this->form_validation->run() == FALSE) {
			($caminhoes_id == NULL) ? $this->adicionar() : $this->editar($caminhoes_id);
		} else {
			$data['caminhoes_descricao']			= str2uppercase($this->input->post('caminhoes_descricao'));
			$data['caminhoes_cavalo']				= str2uppercase($this->input->post('caminhoes_cavalo'));
			$data['caminhoes_cavalo_ano']			= str2uppercase($this->input->post('caminhoes_cavalo_ano'));
			$data['caminhoes_carreta']				= str2uppercase($this->input->post('caminhoes_carreta'));
			$data['caminhoes_carreta_ano']			= str2uppercase($this->input->post('caminhoes_carreta_ano'));
			$data['caminhoes_ativo']      			= ($this->input->post('caminhoes_ativo') == '1') ? 1 : 0;
			
			if($caminhoes_id == NULL){
			
				$adicionar = $this->frotas_model->add_caminhoes($data);
				
				if($adicionar == TRUE){
					$this->msg->adicionar('info', sprintf($this->lang->line('SECURITY_TURMA_ADD_OK'), $data['caminhoes_descricao']));
				} else {
					//$this->msg->adicionar('err', sprintf($this->lang->line('SECURITY_TURMA_ADD_FAIL', $this->frotas_model->lasterr)));
					$this->msg->adicionar('err', $this->frotas_model->lasterr, 'ERRO!');
				}
			
			} else {
			
				// Updating existing frotas
				$editar = $this->frotas_model->edit_caminhoes($caminhoes_id, $data);
				if($editar == TRUE){
					$this->msg->adicionar('info', sprintf($this->lang->line('SECURITY_TURMA_EDIT_OK'), $data['caminhoes_descricao']));
				} else {
					$this->msg->adicionar('err', sprintf($this->lang->line('SECURITY_TURMA_EDIT_FAIL', $this->frotas_model->lasterr)));
				}
				
			}
			
			if($this->input->post('btn_submit') == 'Adicionar' || $this->input->post('btn_submit') == 'Salvar'){
				redirect('contabilidade/frotas');
			}else{
				redirect('contabilidade/frotas/adicionar');
			}
		}
		
	}

	function excluir($caminhoes_id = NULL){
		//$this->auth->check('frotas.excluir');
		
		// Check if a form has been submitted; if not - show it to ask frotas confirmation
		if($this->input->post('id')){
		
			// Form has been submitted (so the POST value exists)
			// Call model function to excluir frotas
			$excluir = $this->frotas_model->delete_caminhoes($this->input->post('id'));
			if($excluir == FALSE){
				$this->msg->adicionar('err', $this->frotas_model->lasterr, 'Ocorreu um erro!');
			} else {
				$this->msg->adicionar('info', 'The frotas has been deleted.');
			}
			// Redirect
			redirect('contabilidade/frotas');
			
		} else {
			if($caminhoes_id == NULL){
				
				$tpl['title'] = 'Excluir frotas';
				$tpl['pagetitle'] = $tpl['title'];
				$tpl['body'] = $this->msg->err('Cannot find the frotas or no frotas ID given.');
				
			} else {
				
				// Get frotas info so we can present the confirmation page
				$frotas = $this->frotas_model->get_caminhoes($caminhoes_id);
				
				if($frotas == FALSE){
				
					$tpl['title'] = 'Excluir frotas';
					$tpl['pagetitle'] = $tpl['title'];
					$tpl['body'] = $this->msg->err('Could not find that frotas or no frotas ID given.');
					
				} else {					
					// Initialise page
					$body['action'] = 'contabilidade/frotas/excluir';
					$body['id'] = $caminhoes_id;
					$body['cancel'] = 'contabilidade/frotas';
					$body['text'] = 'Se houverem matriculas cadastradas para esta frotas, não será possível excluí-la.';
					$tpl['title'] = 'Excluir frotas';
					$tpl['pagetitle'] = 'Excluir ' . $frotas->caminhoes_descricao;
					$tpl['body'] = $this->load->view('parts/deleteconfirm', $body, TRUE);
					
				}
				
			}
			
			$this->load->view($this->tpl, $tpl);
			
		}
		
	}

}

/* End of file controllers/contabilidade/frotas/frotas.php */