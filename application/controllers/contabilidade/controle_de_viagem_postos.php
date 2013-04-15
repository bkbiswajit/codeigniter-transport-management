<?php 
class controle_de_viagem_postos extends Controller {

	var $tpl;

	function controle_de_viagem_postos(){
		parent::Controller();
		$this->load->model('controle_de_viagem_postos/controle_de_viagem_postos_model', 'controle_de_viagem_postos_model');
		$this->load->helper('text');
		$this->tpl = $this->config->item('template');
		$this->output->enable_profiler($this->config->item('profiler'));
		if($this->auth->logged_in() == TRUE AND $this->config->item('tracker') == TRUE){ $this->rastreador_model->add_visit(); }
	}

	function index(){
		//$this->auth->check('controle_de_viagem_postos');

		redirect('contabilidade/controle_de_viagem');
		
		// Get list of usuarios
		$body['controle_de_viagem_postos'] = $this->controle_de_viagem_postos_model->get_controle_de_viagem_postos();
		
			$tpl['body'] = $this->load->view('contabilidade/controle_de_viagem_postos/index.php', $body, TRUE);
			
		$tpl['title'] = 'controle_de_viagem_postos';
		$tpl['pagetitle'] = 'Gerenciar controle_de_viagem_postos';
		
		$this->load->view($this->tpl, $tpl);
	}

	function adicionar(){
		//$this->auth->check('controle_de_viagem_postos.adicionar');
		$body['controle_de_viagem_postos'] = NULL;
		$body['controle_de_viagem_postos_id'] = NULL;
		
		$this->load->model('postos/postos_model');
		$body['postos'] = $this->postos_model->get_postos_dropdown();
		
		$tpl['title'] = 'Adicionar controle_de_viagem_postos';
		$tpl['pagetitle'] = 'Adicionar novo controle_de_viagem_postos';
		$tpl['body'] = $this->load->view('contabilidade/controle_de_viagem_postos/addedit.php', $body, TRUE);
		$this->load->view($this->tpl, $tpl);
	}
	
	function editar($controle_de_viagem_postos_id){
		//$this->auth->check('controle_de_viagem_postos.editar');
		$body['controle_de_viagem_postos'] = $this->controle_de_viagem_postos_model->get_controle_de_viagem_postos($controle_de_viagem_postos_id);
		$body['controle_de_viagem_postos_id'] = $controle_de_viagem_postos_id;
		
		$this->load->model('postos/postos_model');
		$body['postos'] = $this->postos_model->get_postos_dropdown();
		
		$tpl['title'] = 'Editar controle_de_viagem_postos';
		
		if($body['controle_de_viagem_postos'] != FALSE){
			$tpl['pagetitle'] = 'Editar controle_de_viagem_postos ' . $body['controle_de_viagem_postos']->controle_de_viagem_postos_litros . '';
			$tpl['body'] = $this->load->view('contabilidade/controle_de_viagem_postos/addedit.php', $body, TRUE);
		} else {
			$tpl['pagetitle'] = 'Error getting controle_de_viagem_postos';
			$tpl['body'] = $this->msg->err('Could not load the specified controle_de_viagem_postos. Please check the ID and try again.');
		}
		
		$this->load->view($this->tpl, $tpl);
	}

	function salvar(){
		
		$controle_de_viagem_postos_id = $this->input->post('controle_de_viagem_postos_id');
		
		$this->form_validation->set_rules('controle_de_viagem_postos_id', 'controle_de_viagem_postos_id');
		$this->form_validation->set_rules('controle_de_viagem_postos_controle_de_viagem_viagens_id', 'controle_de_viagem_postos_controle_de_viagem_viagens_id', 'required|trim');
		$this->form_validation->set_rules('controle_de_viagem_postos_data', 'controle_de_viagem_postos_data', 'required|trim');
		$this->form_validation->set_rules('controle_de_viagem_postos_postos_id', 'controle_de_viagem_postos_postos_id', 'required|trim');
		$this->form_validation->set_rules('controle_de_viagem_postos_litros', 'controle_de_viagem_postos_litros', 'required|trim');
		$this->form_validation->set_rules('controle_de_viagem_postos_valor_litro', 'controle_de_viagem_postos_valor_litro', 'required|trim');
		$this->form_validation->set_error_delimiters('<li>', '</li>');
		
		
		if($this->form_validation->run() == FALSE){
			
			// Validation failed - load required action depending on the state of usuario_id
			//($controle_de_viagem_postos_id == NULL) ? $this->adicionar() : $this->editar($controle_de_viagem_postos_id);
			die('ERRO');			
		} else {
		
			// Validation OK
			$data['controle_de_viagem_postos_controle_de_viagem_viagens_id']		=	$this->input->post('controle_de_viagem_postos_controle_de_viagem_viagens_id');
			$data['controle_de_viagem_postos_data']									=	human2mysql($this->input->post('controle_de_viagem_postos_data'));
			$data['controle_de_viagem_postos_postos_id']							=	$this->input->post('controle_de_viagem_postos_postos_id');
			$data['controle_de_viagem_postos_litros']								=	comma2dot($this->input->post('controle_de_viagem_postos_litros'));
			$data['controle_de_viagem_postos_valor_litro']							=	comma2dot($this->input->post('controle_de_viagem_postos_valor_litro'));
			
			if($controle_de_viagem_postos_id == NULL){
			
				$adicionar = $this->controle_de_viagem_postos_model->add_controle_de_viagem_postos($data);
				
				if($adicionar == TRUE){
					$this->msg->adicionar('info', sprintf($this->lang->line('SECURITY_TURMA_ADD_OK'), $data['controle_de_viagem_postos_litros']));
				} else {
					//$this->msg->adicionar('err', sprintf($this->lang->line('SECURITY_TURMA_ADD_FAIL', $this->controle_de_viagem_postos_model->lasterr)));
					$this->msg->adicionar('err', $this->controle_de_viagem_postos_model->lasterr, 'ERRO!');
				}
			
			} else {
			
				// Updating existing controle_de_viagem_postos
				$editar = $this->controle_de_viagem_postos_model->edit_controle_de_viagem_postos($controle_de_viagem_postos_id, $data);
				if($editar == TRUE){
					$this->msg->adicionar('info', sprintf($this->lang->line('SECURITY_TURMA_EDIT_OK'), $data['controle_de_viagem_postos_litros']));
				} else {
					$this->msg->adicionar('err', sprintf($this->lang->line('SECURITY_TURMA_EDIT_FAIL', $this->controle_de_viagem_postos_model->lasterr)));
				}
				
			}
			
			
			$body['controle_de_viagem_postos'] 					= $this->controle_de_viagem_postos_model->get_controle_de_viagem_postos_cv($this->input->post('controle_de_viagem_postos_controle_de_viagem_viagens_id'));
			$body['controle_de_viagem_postos_litros_total'] 	= $this->controle_de_viagem_postos_model->get_controle_de_viagem_postos_litros_total($this->input->post('controle_de_viagem_postos_controle_de_viagem_viagens_id'))->total;
			$this->load->view('contabilidade/controle_de_viagem_postos/index_ajax.php', $body);
			
			/*
			if($this->input->post('btn_submit') == 'Adicionar' || $this->input->post('btn_submit') == 'Salvar'){
				redirect('contabilidade/controle_de_viagem_postos');
			}else{
				redirect('contabilidade/controle_de_viagem_postos/adicionar');
			}*/			
		}
		
	}
	
	function ajax_excluir($controle_de_viagem_postos_id = NULL, $controle_de_viagem_id){
		//$this->auth->check('controle_de_viagem_postos.excluir');
		$excluir = $this->controle_de_viagem_postos_model->delete_controle_de_viagem_postos($controle_de_viagem_postos_id);
		
		if($excluir == FALSE){
			$this->msg->adicionar('err', $this->controle_de_viagem_postos_model->lasterr, 'ERRO AO EXCLUIR');
		} else {
			$this->msg->adicionar('info', 'EXCLUIDO COM SUCESSO');
		}
			// Redirect
			redirect('contabilidade/controle_de_viagem/editar/' . $controle_de_viagem_id . '#postos');
			
		}

	function excluir($controle_de_viagem_postos_id = NULL){
		//$this->auth->check('controle_de_viagem_postos.excluir');
		
		// Check if a form has been submitted; if not - show it to ask controle_de_viagem_postos confirmation
		if($this->input->post('id')){
		
			// Form has been submitted (so the POST value exists)
			// Call model function to excluir controle_de_viagem_postos
			$excluir = $this->controle_de_viagem_postos_model->delete_controle_de_viagem_postos($this->input->post('id'));
			if($excluir == FALSE){
				$this->msg->adicionar('err', $this->controle_de_viagem_postos_model->lasterr, 'Ocorreu um erro!');
			} else {
				$this->msg->adicionar('info', 'The controle_de_viagem_postos has been deleted.');
			}
			// Redirect
			redirect('contabilidade/controle_de_viagem_postos');
			
		} else {
			if($controle_de_viagem_postos_id == NULL){
				
				$tpl['title'] = 'Excluir controle_de_viagem_postos';
				$tpl['pagetitle'] = $tpl['title'];
				$tpl['body'] = $this->msg->err('Cannot find the controle_de_viagem_postos or no controle_de_viagem_postos ID given.');
				
			} else {
				
				// Get controle_de_viagem_postos info so we can present the confirmation page
				$controle_de_viagem_postos = $this->controle_de_viagem_postos_model->get_controle_de_viagem_postos($controle_de_viagem_postos_id);
				
				if($controle_de_viagem_postos == FALSE){
				
					$tpl['title'] = 'Excluir controle_de_viagem_postos';
					$tpl['pagetitle'] = $tpl['title'];
					$tpl['body'] = $this->msg->err('Could not find that controle_de_viagem_postos or no controle_de_viagem_postos ID given.');
					
				} else {					
					// Initialise page
					$body['action'] = 'contabilidade/controle_de_viagem_postos/excluir';
					$body['id'] = $controle_de_viagem_postos_id;
					$body['cancel'] = 'contabilidade/controle_de_viagem_postos';
					$body['text'] = 'Se houverem despesas cadastradas para este tipo de  despesa, não será possível excluí-la.';
					$tpl['title'] = 'Excluir controle_de_viagem_postos';
					$tpl['pagetitle'] = 'Excluir ' . $controle_de_viagem_postos->controle_de_viagem_postos_litros;
					$tpl['body'] = $this->load->view('parts/deleteconfirm', $body, TRUE);
					
				}
				
			}
			
			$this->load->view($this->tpl, $tpl);
			
		}
		
	}

}

/* End of file controllers/contabilidade/controle_de_viagem_postos/controle_de_viagem_postos.php */