<?php 
class controle_de_viagem_origem_destino extends Controller {

	var $tpl;

	function controle_de_viagem_origem_destino(){
		parent::Controller();
		$this->load->model('controle_de_viagem_origem/controle_de_viagem_origem_model', 'controle_de_viagem_origem_model');
		$this->load->model('controle_de_viagem_destino/controle_de_viagem_destino_model', 'controle_de_viagem_destino_model');
		$this->load->helper('text');
		$this->tpl = $this->config->item('template');
		$this->output->enable_profiler($this->config->item('profiler'));
		if($this->auth->logged_in() == TRUE AND $this->config->item('tracker') == TRUE){ $this->rastreador_model->add_visit(); }
	}

	function index(){
		//$this->auth->check('controle_de_viagem_origem');
		
		$links[] = array('contabilidade/controle_de_viagem_origem/adicionar', 'Adicionar novo controle_de_viagem_origem');
		$tpl['links'] = $this->load->view('parts/linkbar', $links, TRUE);
		
		// Get list of usuarios
		$body['controle_de_viagem_origem'] = $this->controle_de_viagem_origem_model->get_controle_de_viagem_origem();
		
			$tpl['body'] = $this->load->view('contabilidade/controle_de_viagem_origem/index.php', $body, TRUE);
			
		$tpl['title'] = 'controle_de_viagem_origem';
		$tpl['pagetitle'] = 'Gerenciar controle_de_viagem_origem';
		
		$this->load->view($this->tpl, $tpl);
	}

	function adicionar(){
		//$this->auth->check('controle_de_viagem_origem.adicionar');
		$body['controle_de_viagem_origem'] = NULL;
		$body['controle_de_viagem_origem_id'] = NULL;
		
		
		$this->load->model('controle_de_viagem_regioes/controle_de_viagem_regioes_model');
		
		$body['regioes'] = $this->controle_de_viagem_regioes_model->get_controle_de_viagem_regioes_dropdown();
		
		
		$tpl['title'] = 'Adicionar controle_de_viagem_origem';
		$tpl['pagetitle'] = 'Adicionar novo controle_de_viagem_origem';
		$tpl['body'] = $this->load->view('contabilidade/controle_de_viagem_origem/addedit.php', $body, TRUE);
		$this->load->view($this->tpl, $tpl);
	}
	
	function editar($controle_de_viagem_origem_id){
		//$this->auth->check('controle_de_viagem_origem.editar');
		$body['controle_de_viagem_origem'] = $this->controle_de_viagem_origem_model->get_controle_de_viagem_origem($controle_de_viagem_origem_id);
		$body['controle_de_viagem_origem_id'] = $controle_de_viagem_origem_id;
		
		$this->load->model('controle_de_viagem_regioes/controle_de_viagem_regioes_model');
		
		$body['regioes'] = $this->controle_de_viagem_regioes_model->get_controle_de_viagem_regioes_dropdown();
		
		$tpl['title'] = 'Editar controle_de_viagem_origem';
		
		if($body['controle_de_viagem_origem'] != FALSE){
			$tpl['pagetitle'] = 'Editar controle_de_viagem_origem ' . $body['controle_de_viagem_origem']->controle_de_viagem_origem_descricao . '';
			$tpl['body'] = $this->load->view('contabilidade/controle_de_viagem_origem/addedit.php', $body, TRUE);
		} else {
			$tpl['pagetitle'] = 'Error getting controle_de_viagem_origem';
			$tpl['body'] = $this->msg->err('Could not load the specified controle_de_viagem_origem. Please check the ID and try again.');
		}
		
		$this->load->view($this->tpl, $tpl);
	}

	function salvar(){
		
		$controle_de_viagem_origem_id = $this->input->post('controle_de_viagem_origem_id');
		
		$this->form_validation->set_rules('controle_de_viagem_origem_id', 'controle_de_viagem_origem_id');
		$this->form_validation->set_rules('controle_de_viagem_origem_regiao_id', 'controle_de_viagem_origem_regiao_id', 'required|trim');
		$this->form_validation->set_rules('controle_de_viagem_origem_descricao', 'controle_de_viagem_origem_descricao', 'required|trim');
		$this->form_validation->set_error_delimiters('<li>', '</li>');

		if($this->form_validation->run() == FALSE){
			
			// Validation failed - load required action depending on the state of usuario_id
			($controle_de_viagem_origem_id == NULL) ? $this->adicionar() : $this->editar($controle_de_viagem_origem_id);
			
		} else {
		
			// Validation OK
			$data['controle_de_viagem_origem_regiao_id']		=	$this->input->post('controle_de_viagem_origem_regiao_id');
			$data['controle_de_viagem_origem_descricao']		=	str2uppercase($this->input->post('controle_de_viagem_origem_descricao'));
			$data['controle_de_viagem_origem_ativo']			=	($this->input->post('controle_de_viagem_origem_ativo') == '1') ? 1 : 0;
			
			
			$data2['controle_de_viagem_destino_regiao_id']		=	$this->input->post('controle_de_viagem_origem_regiao_id');
			$data2['controle_de_viagem_destino_descricao']		=	str2uppercase($this->input->post('controle_de_viagem_origem_descricao'));
			$data2['controle_de_viagem_destino_ativo']			=	($this->input->post('controle_de_viagem_origem_ativo') == '1') ? 1 : 0;
			if($controle_de_viagem_origem_id == NULL){
			
				$adicionar = $this->controle_de_viagem_origem_model->add_controle_de_viagem_origem($data);
				$adicionar2 = $this->controle_de_viagem_destino_model->add_controle_de_viagem_destino($data2);
				
				if($adicionar AND $adicionar2 == TRUE){
					$this->msg->adicionar('info', sprintf($this->lang->line('SECURITY_TURMA_ADD_OK'), $data['controle_de_viagem_origem_descricao']));
				} else {
					//$this->msg->adicionar('err', sprintf($this->lang->line('SECURITY_TURMA_ADD_FAIL', $this->controle_de_viagem_origem_model->lasterr)));
					$this->msg->adicionar('err', $this->controle_de_viagem_origem_model->lasterr, 'ERRO!');
				}
			
			} else {
			
				// Updating existing controle_de_viagem_origem
				$editar = $this->controle_de_viagem_origem_model->edit_controle_de_viagem_origem($controle_de_viagem_origem_id, $data);
				$editar2 = $this->controle_de_viagem_destino_model->edit_controle_de_viagem_destino($controle_de_viagem_origem_id, $data2);
				if($editar == TRUE){
					$this->msg->adicionar('info', sprintf($this->lang->line('SECURITY_TURMA_EDIT_OK'), $data['controle_de_viagem_origem_descricao']));
				} else {
					$this->msg->adicionar('err', sprintf($this->lang->line('SECURITY_TURMA_EDIT_FAIL', $this->controle_de_viagem_origem_model->lasterr)));
				}
				
			}
			
			if($this->input->post('btn_submit') == 'Adicionar' || $this->input->post('btn_submit') == 'Salvar'){
				redirect('contabilidade/controle_de_viagem_origem_destino');
			}else{
				redirect('contabilidade/controle_de_viagem_origem_destino/adicionar');
			}			
		}
		
	}

	function excluir($controle_de_viagem_origem_id = NULL){
		//$this->auth->check('controle_de_viagem_origem.excluir');
		
		// Check if a form has been submitted; if not - show it to ask controle_de_viagem_origem confirmation
		if($this->input->post('id')){
		
			// Form has been submitted (so the POST value exists)
			// Call model function to excluir controle_de_viagem_origem
			$excluir = $this->controle_de_viagem_origem_model->delete_controle_de_viagem_origem($this->input->post('id'));
			if($excluir == FALSE){
				$this->msg->adicionar('err', $this->controle_de_viagem_origem_model->lasterr, 'Ocorreu um erro!');
			} else {
				$this->msg->adicionar('info', 'The controle_de_viagem_origem has been deleted.');
			}
			// Redirect
			redirect('contabilidade/controle_de_viagem_origem_destino');
			
		} else {
			if($controle_de_viagem_origem_id == NULL){
				
				$tpl['title'] = 'Excluir controle_de_viagem_origem';
				$tpl['pagetitle'] = $tpl['title'];
				$tpl['body'] = $this->msg->err('Cannot find the controle_de_viagem_origem or no controle_de_viagem_origem ID given.');
				
			} else {
				
				// Get controle_de_viagem_origem info so we can present the confirmation page
				$controle_de_viagem_origem = $this->controle_de_viagem_origem_model->get_controle_de_viagem_origem($controle_de_viagem_origem_id);
				
				if($controle_de_viagem_origem == FALSE){
				
					$tpl['title'] = 'Excluir controle_de_viagem_origem';
					$tpl['pagetitle'] = $tpl['title'];
					$tpl['body'] = $this->msg->err('Could not find that controle_de_viagem_origem or no controle_de_viagem_origem ID given.');
					
				} else {					
					// Initialise page
					$body['action'] = 'contabilidade/controle_de_viagem_origem_destino/excluir';
					$body['id'] = $controle_de_viagem_origem_id;
					$body['cancel'] = 'contabilidade/controle_de_viagem_origem_destino';
					$body['text'] = 'Se houverem despesas cadastradas para este tipo de  despesa, não será possível excluí-la.';
					$tpl['title'] = 'Excluir controle_de_viagem_origem_destino';
					$tpl['pagetitle'] = 'Excluir ' . $controle_de_viagem_origem->controle_de_viagem_origem_descricao;
					$tpl['body'] = $this->load->view('parts/deleteconfirm', $body, TRUE);
					
				}
				
			}
			
			$this->load->view($this->tpl, $tpl);
			
		}
		
	}

}

/* End of file controllers/contabilidade/controle_de_viagem_origem/controle_de_viagem_origem.php */