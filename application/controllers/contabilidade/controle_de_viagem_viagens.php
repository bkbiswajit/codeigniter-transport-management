<?php 
class controle_de_viagem_viagens extends Controller {

	var $tpl;

	function controle_de_viagem_viagens(){
		parent::Controller();
		$this->load->model('controle_de_viagem_viagens/controle_de_viagem_viagens_model', 'controle_de_viagem_viagens_model');
		$this->load->helper('text');
		$this->tpl = $this->config->item('template');
		$this->output->enable_profiler($this->config->item('profiler'));
		if($this->auth->logged_in() == TRUE AND $this->config->item('tracker') == TRUE){ $this->rastreador_model->add_visit(); }
	}

	function index(){
		//$this->auth->check('controle_de_viagem_viagens');

		redirect('contabilidade/controle_de_viagem');
		
		// Get list of usuarios
		// $body['controle_de_viagem_viagens'] = $this->controle_de_viagem_viagens_model->get_controle_de_viagem_viagens_mes_atual();
		
		// $tpl['body'] = $this->load->view('contabilidade/controle_de_viagem_viagens/index.php', $body, TRUE);
			
		// $tpl['title'] = 'controle_de_viagem_viagens';
		// $tpl['pagetitle'] = 'Gerenciar controle_de_viagem_viagens';
		
		// $this->load->view($this->tpl, $tpl);
	}

	function adicionar(){
		//$this->auth->check('controle_de_viagem_viagens.adicionar');
		$body['pre_os_id'] = NULL;
		$body['controle_de_viagem_viagens'] = NULL;
		$body['controle_de_viagem_viagens_id'] = NULL;
		
		$this->load->model('despesas_tipos/despesas_tipos_model');
		$body['despesas_tipos'] = $this->despesas_tipos_model->get_despesas_tipos_dropdown();
		
		$tpl['title'] = 'Adicionar controle_de_viagem_viagens';
		$tpl['pagetitle'] = 'Adicionar novo controle_de_viagem_viagens';
		$tpl['body'] = $this->load->view('contabilidade/controle_de_viagem_viagens/addedit.php', $body, TRUE);
		$this->load->view($this->tpl, $tpl);
	}
	
	function editar($controle_de_viagem_viagens_id){
		//$this->auth->check('controle_de_viagem_viagens.editar');
		$body['controle_de_viagem_viagens'] = $this->controle_de_viagem_viagens_model->get_controle_de_viagem_viagens($controle_de_viagem_viagens_id);
		$body['controle_de_viagem_viagens_id'] = $controle_de_viagem_viagens_id;
	
		$this->load->model('despesas_tipos/controle_de_viagem_viagens_model');
		$body['despesas_tipos'] = $this->controle_de_viagem_viagens_model->get_despesas_tipos_dropdown();
		
		//
		$tpl['title'] = 'Editar controle_de_viagem_viagens';
		
		if($body['controle_de_viagem_viagens'] != FALSE){
			$tpl['pagetitle'] = 'Editar controle_de_viagem_viagens ' . $body['controle_de_viagem_viagens']->controle_de_viagem_viagens_id . '';
			$tpl['body'] = $this->load->view('contabilidade/controle_de_viagem_viagens/addedit.php', $body, TRUE);
		} else {
			$tpl['pagetitle'] = 'Error getting controle_de_viagem_viagens';
			$tpl['body'] = $this->msg->err('Could not load the specified controle_de_viagem_viagens. Please check the ID and try again.');
		}
		
		$this->load->view($this->tpl, $tpl);
	}

	function salvar(){
		
		$controle_de_viagem_viagens_id = $this->input->post('controle_de_viagem_viagens_id');
		$this->form_validation->set_rules('controle_de_viagem_viagens_controle_de_viagem_viagens_id', 'controle_de_viagem_viagens_controle_de_viagem_viagens_id', 'required');
		$this->form_validation->set_rules('controle_de_viagem_viagens_data', 'controle_de_viagem_viagens_data', 'required');
		$this->form_validation->set_rules('controle_de_viagem_viagens_clientes_id', 'controle_de_viagem_viagens_clientes_id', 'required');
		$this->form_validation->set_rules('controle_de_viagem_viagens_origem_id', 'controle_de_viagem_viagens_origem_id', 'required');
		$this->form_validation->set_rules('controle_de_viagem_viagens_destino_id', 'controle_de_viagem_viagens_destino_id', 'required');
		$this->form_validation->set_rules('controle_de_viagem_viagens_valor_frete', 'controle_de_viagem_viagens_valor_frete', 'required');
		$this->form_validation->set_error_delimiters('<li>', '</li>');
		
		/*
		print('<pre>');
		print_r($_POST);
		print('</pre>');
		*/
		
		if($this->form_validation->run() == FALSE){
			
			// Validation failed - load required action depending on the state of usuario_id
			//($controle_de_viagem_viagens_id == NULL) ? $this->adicionar() : $this->editar($controle_de_viagem_viagens_id);
			
			die('ERRO');
			
		} else {
		
			// Validation OK
			$data['controle_de_viagem_viagens_id']								=	$controle_de_viagem_viagens_id;
			$data['controle_de_viagem_viagens_controle_de_viagem_viagens_id']	=	$this->input->post('controle_de_viagem_viagens_controle_de_viagem_viagens_id');
			$data['controle_de_viagem_viagens_data']							=	human2mysql($this->input->post('controle_de_viagem_viagens_data'));
			$data['controle_de_viagem_viagens_clientes_id']						=	$this->input->post('controle_de_viagem_viagens_clientes_id');
			$data['controle_de_viagem_viagens_origem_id']						=	$this->input->post('controle_de_viagem_viagens_origem_id');
			$data['controle_de_viagem_viagens_destino_id']						=	$this->input->post('controle_de_viagem_viagens_destino_id');
			$data['controle_de_viagem_viagens_valor_frete']						=	comma2dot($this->input->post('controle_de_viagem_viagens_valor_frete'));
			$data['controle_de_viagem_viagens_bonus']							=	comma2dot($this->input->post('controle_de_viagem_viagens_bonus'));
			
			// if($this->input->post('controle_de_viagem_viagens_bonus')){
			// 	$data['controle_de_viagem_viagens_bonus'] = $this->input->post('controle_de_viagem_viagens_bonus');
			// }else{
			// 	$data['controle_de_viagem_viagens_bonus'] = 0;
			// }
			
			// print_r($data); die();
			
			if($controle_de_viagem_viagens_id == NULL){
			
				$adicionar = $this->controle_de_viagem_viagens_model->add_controle_de_viagem_viagens($data);
				
				if($adicionar == TRUE){
					//$this->msg->adicionar('info', sprintf($this->lang->line('SECURITY_TURMA_ADD_OK'), $data['controle_de_viagem_viagens_id']));
					$this->msg->adicionar('info', 'SUCESSO');
				} else {
					//$this->msg->adicionar('err', sprintf($this->lang->line('SECURITY_TURMA_ADD_FAIL', $this->controle_de_viagem_viagens_model->lasterr)));
					$this->msg->adicionar('err', $this->controle_de_viagem_viagens_model->lasterr, 'ERRO!');
				}
			
			} else {
			
				// Updating existing controle_de_viagem_viagens
				$editar = $this->controle_de_viagem_viagens_model->edit_controle_de_viagem_viagens($controle_de_viagem_viagens_id, $data);
				if($editar == TRUE){
					$this->msg->adicionar('info', sprintf($this->lang->line('SECURITY_TURMA_EDIT_OK'), $data['controle_de_viagem_viagens_id']));
				} else {
					$this->msg->adicionar('err', sprintf($this->lang->line('SECURITY_TURMA_EDIT_FAIL', $this->controle_de_viagem_viagens_model->lasterr)));
				}
				
			}
			
			$this->load->model('controle_de_viagem/controle_de_viagem_model', 'controle_de_viagem_model');
			$this->load->model('motoristas/motoristas_model');
			$controle_de_viagem							= $this->controle_de_viagem_model->get_controle_de_viagem($this->input->post('controle_de_viagem_viagens_controle_de_viagem_viagens_id'));
			$motoristas_id 								= $controle_de_viagem->controle_de_viagem_motorista_id;
			$body['motoristas_comissao'] 				= $this->motoristas_model->get_motoristas_comissao($motoristas_id);
			$body['controle_de_viagem_viagens'] 		= $this->controle_de_viagem_viagens_model->get_controle_de_viagem_viagens_cv($this->input->post('controle_de_viagem_viagens_controle_de_viagem_viagens_id'));
			$body['controle_de_viagem_viagens_total'] 	= $this->controle_de_viagem_viagens_model->get_controle_de_viagem_viagens_total($this->input->post('controle_de_viagem_viagens_controle_de_viagem_viagens_id'))->total;
			/*
			print('<pre>');
			print_r($body);
			print('</pre>');
			die();
			*/
			$this->load->view('contabilidade/controle_de_viagem_viagens/index_ajax.php', $body);
			
			//echo 1;
			
			/*
			if($this->input->post('btn_submit') == 'Adicionar' || $this->input->post('btn_submit') == 'Salvar'){
				redirect('contabilidade/controle_de_viagem_viagens');
			}else{
				redirect('contabilidade/controle_de_viagem_viagens/adicionar_para_os/'.$this->input->post('pre_os_id'));
			}
			*/
			
		}
	}

	function ajax_excluir($controle_de_viagem_viagens_id = NULL, $controle_de_viagem_id){
		//$this->auth->check('controle_de_viagem_viagens.excluir');

		$excluir = $this->controle_de_viagem_viagens_model->delete_controle_de_viagem_viagens($controle_de_viagem_viagens_id);
		if($excluir == FALSE){
			$this->msg->adicionar('err', $this->controle_de_viagem_viagens_model->lasterr, 'ERRO AO EXCLUIR');
		} else {
			$this->msg->adicionar('info', 'EXCLUIDO COM SUCESSO');
		}
		// Redirect
		redirect('contabilidade/controle_de_viagem/editar/' . $controle_de_viagem_id . '#viagens');
	} 

	function excluir($controle_de_viagem_viagens_id = NULL){
		//$this->auth->check('controle_de_viagem_viagens.excluir');
		
		// Check if a form has been submitted; if not - show it to ask controle_de_viagem_viagens confirmation
		if($this->input->post('id')){
		
			// Form has been submitted (so the POST value exists)
			// Call model function to excluir controle_de_viagem_viagens
			$excluir = $this->controle_de_viagem_viagens_model->delete_controle_de_viagem_viagens($this->input->post('id'));
			if($excluir == FALSE){
				$this->msg->adicionar('err', $this->controle_de_viagem_viagens_model->lasterr, 'Ocorreu um erro!');
			} else {
				$this->msg->adicionar('info', 'The controle_de_viagem_viagens has been deleted.');
			}
			// Redirect
			redirect('contabilidade/controle_de_viagem');
			
		} else {
			if($controle_de_viagem_viagens_id == NULL){
				
				$tpl['title'] = 'Excluir controle_de_viagem_viagens';
				$tpl['pagetitle'] = $tpl['title'];
				$tpl['body'] = $this->msg->err('Cannot find the controle_de_viagem_viagens or no controle_de_viagem_viagens ID given.');
				
			} else {
				
				// Get controle_de_viagem_viagens info so we can present the confirmation page
				$controle_de_viagem_viagens = $this->controle_de_viagem_viagens_model->get_controle_de_viagem_viagens($controle_de_viagem_viagens_id);
				
				if($controle_de_viagem_viagens == FALSE){
				
					$tpl['title'] = 'Excluir controle_de_viagem_viagens';
					$tpl['pagetitle'] = $tpl['title'];
					$tpl['body'] = $this->msg->err('Could not find that controle_de_viagem_viagens or no controle_de_viagem_viagens ID given.');
					
				} else {					
					// Initialise page
					$body['action'] = 'contabilidade/controle_de_viagem_viagens/excluir';
					$body['id'] = $controle_de_viagem_viagens_id;
					$body['cancel'] = 'contabilidade/controle_de_viagem_viagens';
					$body['text'] = 'Se houverem matriculas cadastradas para esta controle_de_viagem_viagens, não será possível excluí-la.';
					$tpl['title'] = 'Excluir controle_de_viagem_viagens';
					$tpl['pagetitle'] = 'Excluir ' . $controle_de_viagem_viagens->controle_de_viagem_viagens_id;
					$tpl['body'] = $this->load->view('parts/deleteconfirm', $body, TRUE);
					
				}
				
			}
			
			$this->load->view($this->tpl, $tpl);
			
		}
		
	}	

}

/* End of file controllers/contabilidade/controle_de_viagem_viagens/controle_de_viagem_viagens.php */