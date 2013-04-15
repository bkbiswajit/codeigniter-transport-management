<?php 
class recebimentos extends Controller {

	var $tpl;

	function recebimentos(){
		parent::Controller();
		$this->load->model('recebimentos/recebimentos_model', 'recebimentos_model');
		$this->load->helper('text');
		$this->tpl = $this->config->item('template');
		$this->output->enable_profiler($this->config->item('profiler'));
		if($this->auth->logged_in() == TRUE AND $this->config->item('tracker') == TRUE){ $this->rastreador_model->add_visit(); }
	}

	function index(){
		//$this->auth->check('recebimentos');
		
		$links[] = array('contabilidade/recebimentos/adicionar', 'Adicionar novo recebimentos');
		$tpl['links'] = $this->load->view('parts/linkbar', $links, TRUE);
		
		$body['series'] = $this->recebimentos_model->get_recebimentos_serie();
		
		// Get list of usuarios
		$body['recebimentos'] = $this->recebimentos_model->get_recebimentos();
		
			$tpl['body'] = $this->load->view('contabilidade/recebimentos/index.php', $body, TRUE);
			
		$tpl['title'] = 'recebimentos';
		$tpl['pagetitle'] = 'Gerenciar recebimentos';
		
		$this->load->view($this->tpl, $tpl);
	}

	function por_serie($recebimentos_serie = NULL){
		//$this->auth->check('recebimentos');
		
		$links[] = array('contabilidade/recebimentos/adicionar', 'Adicionar novo recebimentos');
		$tpl['links'] = $this->load->view('parts/linkbar', $links, TRUE);
		
		// Get list of usuarios
		$body['series'] = $this->recebimentos_model->get_recebimentos_serie();
		$body['recebimentos'] = $this->recebimentos_model->get_recebimentos(NULL, $recebimentos_serie);
		
			$tpl['body'] = $this->load->view('contabilidade/recebimentos/index.php', $body, TRUE);
			
		$tpl['title'] = 'recebimentos';
		$tpl['pagetitle'] = 'Gerenciar recebimentos';
		
		$this->load->view($this->tpl, $tpl);
	}

	function adicionar(){
		//$this->auth->check('recebimentos.adicionar');
		$body['recebimentos'] = NULL;
		$body['recebimentos_id'] = NULL;

		$this->load->model('clientes/clientes_model');

		$body['clientes'] = $this->clientes_model->get_clientes_dropdown();
		
		$tpl['title'] = 'Adicionar recebimentos';
		$tpl['pagetitle'] = 'Adicionar novo recebimentos';
		$tpl['body'] = $this->load->view('contabilidade/recebimentos/addedit.php', $body, TRUE);
		$this->load->view($this->tpl, $tpl);
	}
	
	function editar($recebimentos_id){
		//$this->auth->check('recebimentos.editar');
		$body['recebimentos'] = $this->recebimentos_model->get_recebimentos($recebimentos_id);
		$body['recebimentos_id'] = $recebimentos_id;

		$this->load->model('clientes/clientes_model');
		$body['clientes'] = $this->clientes_model->get_clientes_dropdown();

		$tpl['title'] = 'Editar recebimentos';
		
		if($body['recebimentos'] != FALSE){
			$tpl['pagetitle'] = 'Editar recebimentos ' . $body['recebimentos']->recebimentos_descricao . '';
			$tpl['body'] = $this->load->view('contabilidade/recebimentos/addedit.php', $body, TRUE);
		} else {
			$tpl['pagetitle'] = 'Error getting recebimentos';
			$tpl['body'] = $this->msg->err('Could not load the specified recebimentos. Please check the ID and try again.');
		}
		
		$this->load->view($this->tpl, $tpl);
	}

	function salvar(){
		
		$recebimentos_id = $this->input->post('recebimentos_id');
		
		$this->form_validation->set_rules('recebimentos_id', 'recebimentos_id');
		$this->form_validation->set_rules('recebimentos_descricao', 'Número ', 'required|trim|xss_clean');
		$this->form_validation->set_rules('recebimentos_serie', 'Série ', 'required|trim|xss_clean');
		$this->form_validation->set_rules('recebimentos_data', 'Data ', 'required|trim|xss_clean');
		$this->form_validation->set_rules('recebimentos_valor', 'Valor ', 'required|trim|xss_clean');
		$this->form_validation->set_error_delimiters('<li>', '</li>');
		if ($this->form_validation->run() == FALSE) {
			($recebimentos_id == NULL) ? $this->adicionar() : $this->editar($recebimentos_id);
		} else {
			$data['recebimentos_clientes_id']		= str2uppercase($this->input->post('recebimentos_clientes_id'));
			$data['recebimentos_descricao']			= str2uppercase($this->input->post('recebimentos_descricao'));
			$data['recebimentos_serie']				= str2uppercase($this->input->post('recebimentos_serie'));
			$data['recebimentos_data']				= human2mysql($this->input->post('recebimentos_data'));
			$data['recebimentos_valor']				= comma2dot($this->input->post('recebimentos_valor'));
			$data['recebimentos_comentario']		= $this->input->post('recebimentos_comentario');
			
			if ($this->input->post('recebimentos_data_recebido')) {
				$data['recebimentos_data_recebido']		= human2mysql($this->input->post('recebimentos_data_recebido'));
			}
			
			$data['recebimentos_recebido']      	= ($this->input->post('recebimentos_recebido') == '1') ? 1 : 0;
			
			if($recebimentos_id == NULL){
			
				$adicionar = $this->recebimentos_model->add_recebimentos($data);
				
				if($adicionar == TRUE){
					$this->msg->adicionar('info', sprintf($this->lang->line('SECURITY_TURMA_ADD_OK'), $data['recebimentos_descricao']));
				} else {
					//$this->msg->adicionar('err', sprintf($this->lang->line('SECURITY_TURMA_ADD_FAIL', $this->recebimentos_model->lasterr)));
					$this->msg->adicionar('err', $this->recebimentos_model->lasterr, 'ERRO!');
				}
			
			} else {
			
				// Updating existing recebimentos
				$editar = $this->recebimentos_model->edit_recebimentos($recebimentos_id, $data);
				if($editar == TRUE){
					$this->msg->adicionar('info', sprintf($this->lang->line('SECURITY_TURMA_EDIT_OK'), $data['recebimentos_descricao']));
				} else {
					$this->msg->adicionar('err', sprintf($this->lang->line('SECURITY_TURMA_EDIT_FAIL', $this->recebimentos_model->lasterr)));
				}
				
			}
			
			if($this->input->post('btn_submit') == 'Adicionar' || $this->input->post('btn_submit') == 'Salvar'){
				redirect('contabilidade/recebimentos');
			}else{
				redirect('contabilidade/recebimentos/adicionar');
			}
		}
		
	}

	function excluir($recebimentos_id = NULL){
		//$this->auth->check('recebimentos.excluir');
		
		// Check if a form has been submitted; if not - show it to ask recebimentos confirmation
		if($this->input->post('id')){
		
			// Form has been submitted (so the POST value exists)
			// Call model function to excluir recebimentos
			$excluir = $this->recebimentos_model->delete_recebimentos($this->input->post('id'));
			if($excluir == FALSE){
				$this->msg->adicionar('err', $this->recebimentos_model->lasterr, 'Ocorreu um erro!');
			} else {
				$this->msg->adicionar('info', 'The recebimentos has been deleted.');
			}
			// Redirect
			redirect('contabilidade/recebimentos');
			
		} else {
			if($recebimentos_id == NULL){
				
				$tpl['title'] = 'Excluir recebimentos';
				$tpl['pagetitle'] = $tpl['title'];
				$tpl['body'] = $this->msg->err('Cannot find the recebimentos or no recebimentos ID given.');
				
			} else {
				
				// Get recebimentos info so we can present the confirmation page
				$recebimentos = $this->recebimentos_model->get_recebimentos($recebimentos_id);
				
				if($recebimentos == FALSE){
				
					$tpl['title'] = 'Excluir recebimentos';
					$tpl['pagetitle'] = $tpl['title'];
					$tpl['body'] = $this->msg->err('Could not find that recebimentos or no recebimentos ID given.');
					
				} else {					
					// Initialise page
					$body['action'] = 'contabilidade/recebimentos/excluir';
					$body['id'] = $recebimentos_id;
					$body['cancel'] = 'contabilidade/recebimentos';
					$body['text'] = 'Se houverem matriculas cadastradas para esta recebimentos, não será possível excluí-la.';
					$tpl['title'] = 'Excluir recebimentos';
					$tpl['pagetitle'] = 'Excluir ' . $recebimentos->recebimentos_descricao;
					$tpl['body'] = $this->load->view('parts/deleteconfirm', $body, TRUE);
					
				}
				
			}
			
			$this->load->view($this->tpl, $tpl);
			
		}
		
	}

}

/* End of file controllers/contabilidade/recebimentos/recebimentos.php */