<?php 
class controle_de_viagem_despesas extends Controller {

	var $tpl;

	function controle_de_viagem_despesas(){
		parent::Controller();
		$this->load->model('controle_de_viagem_despesas/controle_de_viagem_despesas_model', 'controle_de_viagem_despesas_model');
		$this->load->helper('text');
		$this->tpl = $this->config->item('template');
		$this->output->enable_profiler($this->config->item('profiler'));
		if($this->auth->logged_in() == TRUE AND $this->config->item('tracker') == TRUE){ $this->rastreador_model->add_visit(); }
	}

	function index(){
		//$this->auth->check('controle_de_viagem_despesas');

		redirect('contabilidade/controle_de_viagem');
		
		// Get list of usuarios
		$body['controle_de_viagem_despesas'] = $this->controle_de_viagem_despesas_model->get_controle_de_viagem_despesas();
		
		$tpl['body'] = $this->load->view('contabilidade/controle_de_viagem_despesas/index.php', $body, TRUE);
			
		$tpl['title'] = 'controle_de_viagem_despesas';
		$tpl['pagetitle'] = 'Gerenciar controle_de_viagem_despesas';
		
		$this->load->view($this->tpl, $tpl);
	}

	function adicionar(){
		//$this->auth->check('controle_de_viagem_despesas.adicionar');
		$body['pre_os_id'] = NULL;
		$body['controle_de_viagem_despesas'] = NULL;
		$body['controle_de_viagem_despesas_id'] = NULL;
		
		$this->load->model('controle_de_viagem_despesas_tipos/controle_de_viagem_despesas_tipos_model');
		$body['despesas_tipos'] = $this->controle_de_viagem_despesas_tipos_model->get_controle_de_viagem_despesas_tipos_dropdown();
		
		$tpl['title'] = 'Adicionar controle_de_viagem_despesas';
		$tpl['pagetitle'] = 'Adicionar novo controle_de_viagem_despesas';
		$tpl['body'] = $this->load->view('contabilidade/controle_de_viagem_despesas/addedit.php', $body, TRUE);
		$this->load->view($this->tpl, $tpl);
	}
	
	function editar($controle_de_viagem_despesas_id){
		//$this->auth->check('controle_de_viagem_despesas.editar');
		$body['controle_de_viagem_despesas'] = $this->controle_de_viagem_despesas_model->get_controle_de_viagem_despesas($controle_de_viagem_despesas_id);
		$body['controle_de_viagem_despesas_id'] = $controle_de_viagem_despesas_id;
	
		$this->load->model('despesas_tipos/controle_de_viagem_despesas_model');
		$body['despesas_tipos'] = $this->controle_de_viagem_despesas_model->get_despesas_tipos_dropdown();
		
		//
		$tpl['title'] = 'Editar controle_de_viagem_despesas';
		
		if($body['controle_de_viagem_despesas'] != FALSE){
			$tpl['pagetitle'] = 'Editar controle_de_viagem_despesas ' . $body['controle_de_viagem_despesas']->controle_de_viagem_despesas_id . '';
			$tpl['body'] = $this->load->view('contabilidade/controle_de_viagem_despesas/addedit.php', $body, TRUE);
		} else {
			$tpl['pagetitle'] = 'Error getting controle_de_viagem_despesas';
			$tpl['body'] = $this->msg->err('Could not load the specified controle_de_viagem_despesas. Please check the ID and try again.');
		}
		
		$this->load->view($this->tpl, $tpl);
	}

	function salvar(){
		
		$controle_de_viagem_despesas_id = $this->input->post('controle_de_viagem_despesas_id');
		$this->form_validation->set_rules('controle_de_viagem_despesas_controle_de_viagem_viagens_id', 'controle_de_viagem_despesas_controle_de_viagem_viagens_id', 'required');
		$this->form_validation->set_rules('controle_de_viagem_despesas_data', 'controle_de_viagem_despesas_data', 'required');
		$this->form_validation->set_rules('controle_de_viagem_despesas_controle_de_viagem_despesas_tipos_id', 'controle_de_viagem_despesas_controle_de_viagem_despesas_tipos_id', 'required');
		$this->form_validation->set_rules('controle_de_viagem_despesas_valor', 'controle_de_viagem_despesas_valor', 'required');
		$this->form_validation->set_error_delimiters('<li>', '</li>');

		/*
		print('<pre>');
		print_r($_POST);
		print('</pre>');
		*/
		
		if($this->form_validation->run() == FALSE){
			
			// Validation failed - load required action depending on the state of usuario_id
			//($controle_de_viagem_despesas_id == NULL) ? $this->adicionar() : $this->editar($controle_de_viagem_despesas_id);
			
			die('ERRO');
			
		} else {
		
			// Validation OK
			$data['controle_de_viagem_despesas_id']										=	$controle_de_viagem_despesas_id;
			$data['controle_de_viagem_despesas_controle_de_viagem_viagens_id']			=	$this->input->post('controle_de_viagem_despesas_controle_de_viagem_viagens_id');
			$data['controle_de_viagem_despesas_data']									=	human2mysql($this->input->post('controle_de_viagem_despesas_data'));
			$data['controle_de_viagem_despesas_controle_de_viagem_despesas_tipos_id']	=	$this->input->post('controle_de_viagem_despesas_controle_de_viagem_despesas_tipos_id');
			$data['controle_de_viagem_despesas_valor']									=	comma2dot($this->input->post('controle_de_viagem_despesas_valor'));
			
			//print_r($data); die();
			
			if($controle_de_viagem_despesas_id == NULL){
			
				$adicionar = $this->controle_de_viagem_despesas_model->add_controle_de_viagem_despesas($data);
				
				if($adicionar == TRUE){
					//$this->msg->adicionar('info', sprintf($this->lang->line('SECURITY_TURMA_ADD_OK'), $data['controle_de_viagem_despesas_id']));
					$this->msg->adicionar('info', 'SUCESSO');
				} else {
					//$this->msg->adicionar('err', sprintf($this->lang->line('SECURITY_TURMA_ADD_FAIL', $this->controle_de_viagem_despesas_model->lasterr)));
					$this->msg->adicionar('err', $this->controle_de_viagem_despesas_model->lasterr, 'ERRO!');
				}
			
			} else {
			
				// Updating existing controle_de_viagem_despesas
				$editar = $this->controle_de_viagem_despesas_model->edit_controle_de_viagem_despesas($controle_de_viagem_despesas_id, $data);
				if($editar == TRUE){
					$this->msg->adicionar('info', sprintf($this->lang->line('SECURITY_TURMA_EDIT_OK'), $data['controle_de_viagem_despesas_id']));
				} else {
					$this->msg->adicionar('err', sprintf($this->lang->line('SECURITY_TURMA_EDIT_FAIL', $this->controle_de_viagem_despesas_model->lasterr)));
				}
				
			}
			
			$body['controle_de_viagem_despesas'] = $this->controle_de_viagem_despesas_model->get_controle_de_viagem_despesas_cv($this->input->post('controle_de_viagem_despesas_controle_de_viagem_viagens_id'));
			$body['controle_de_viagem_despesas_total'] = $this->controle_de_viagem_despesas_model->get_controle_de_viagem_despesas_total($this->input->post('controle_de_viagem_despesas_controle_de_viagem_viagens_id'));
			$this->load->view('contabilidade/controle_de_viagem_despesas/index_ajax.php', $body);
			
			//echo 1;
			
			/*
			if($this->input->post('btn_submit') == 'Adicionar' || $this->input->post('btn_submit') == 'Salvar'){
				redirect('contabilidade/controle_de_viagem_despesas');
			}else{
				redirect('contabilidade/controle_de_viagem_despesas/adicionar_para_os/'.$this->input->post('pre_os_id'));
			}
			*/
		}
	}

	function ajax_excluir($controle_de_viagem_despesas_id = NULL, $controle_de_viagem_id){
		//$this->auth->check('controle_de_viagem_despesas.excluir');
		$excluir = $this->controle_de_viagem_despesas_model->delete_controle_de_viagem_despesas($controle_de_viagem_despesas_id);
		if($excluir == FALSE){
			$this->msg->adicionar('err', $this->controle_de_viagem_despesas_tipos_model->lasterr, 'ERRO AO EXCLUIR');
		} else {
			$this->msg->adicionar('info', 'EXCLUIDO COM SUCESSO');
		}
			redirect('contabilidade/controle_de_viagem/editar/' . $controle_de_viagem_id . '#despesas');

	} 	

	function excluir($controle_de_viagem_despesas_id = NULL){
		//$this->auth->check('controle_de_viagem_despesas.excluir');
		
		// Check if a form has been submitted; if not - show it to ask controle_de_viagem_despesas confirmation
		if($this->input->post('id')){
		
			// Form has been submitted (so the POST value exists)
			// Call model function to excluir controle_de_viagem_despesas
			$excluir = $this->controle_de_viagem_despesas_model->delete_controle_de_viagem_despesas($this->input->post('id'));
			if($excluir == FALSE){
				$this->msg->adicionar('err', $this->controle_de_viagem_despesas_model->lasterr, 'Ocorreu um erro!');
			} else {
				$this->msg->adicionar('info', 'The controle_de_viagem_despesas has been deleted.');
			}
			// Redirect
			redirect('contabilidade/controle_de_viagem_despesas');
			
		} else {
			if($controle_de_viagem_despesas_id == NULL){
				
				$tpl['title'] = 'Excluir controle_de_viagem_despesas';
				$tpl['pagetitle'] = $tpl['title'];
				$tpl['body'] = $this->msg->err('Cannot find the controle_de_viagem_despesas or no controle_de_viagem_despesas ID given.');
				
			} else {
				
				// Get controle_de_viagem_despesas info so we can present the confirmation page
				$controle_de_viagem_despesas = $this->controle_de_viagem_despesas_model->get_controle_de_viagem_despesas($controle_de_viagem_despesas_id);
				
				if($controle_de_viagem_despesas == FALSE){
				
					$tpl['title'] = 'Excluir controle_de_viagem_despesas';
					$tpl['pagetitle'] = $tpl['title'];
					$tpl['body'] = $this->msg->err('Could not find that controle_de_viagem_despesas or no controle_de_viagem_despesas ID given.');
					
				} else {					
					// Initialise page
					$body['action'] = 'contabilidade/controle_de_viagem_despesas/excluir';
					$body['id'] = $controle_de_viagem_despesas_id;
					$body['cancel'] = 'contabilidade/controle_de_viagem_despesas';
					$body['text'] = 'Se houverem matriculas cadastradas para esta controle_de_viagem_despesas, não será possível excluí-la.';
					$tpl['title'] = 'Excluir controle_de_viagem_despesas';
					$tpl['pagetitle'] = 'Excluir ' . $controle_de_viagem_despesas->controle_de_viagem_despesas_id;
					$tpl['body'] = $this->load->view('parts/deleteconfirm', $body, TRUE);
					
				}
				
			}
			
			$this->load->view($this->tpl, $tpl);
			
		}
		
	}
	
	function adicionar_para_os($pre_os_id){
		//$this->auth->check('controle_de_viagem_despesas.adicionar');
		$body['pre_os_id'] = $pre_os_id;
		
		$body['controle_de_viagem_despesas'] = NULL;
		$body['controle_de_viagem_despesas_id'] = NULL;
		
		$this->load->model('despesas_tipos/despesas_tipos_model');
		$body['despesas_tipos'] = $this->despesas_tipos_model->get_despesas_tipos_dropdown();
		
		$tpl['title'] = 'Adicionar controle_de_viagem_despesas';
		$tpl['pagetitle'] = 'Adicionar novo controle_de_viagem_despesas';
		$tpl['body'] = $this->load->view('contabilidade/controle_de_viagem_despesas/addedit.php', $body, TRUE);
		$this->load->view($this->tpl, $tpl);
	}
	
	

}

/* End of file controllers/contabilidade/controle_de_viagem_despesas/controle_de_viagem_despesas.php */