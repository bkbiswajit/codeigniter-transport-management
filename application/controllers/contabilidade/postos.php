<?php 
class postos extends Controller {

	var $tpl;

	function postos(){
		parent::Controller();
		$this->load->model('postos/postos_model', 'postos_model');
		$this->load->helper('text');
		$this->tpl = $this->config->item('template');
		$this->output->enable_profiler($this->config->item('profiler'));
		if($this->auth->logged_in() == TRUE AND $this->config->item('tracker') == TRUE){ $this->rastreador_model->add_visit(); }
	}

	function index(){
		//$this->auth->check('postos');
		
		$links[] = array('contabilidade/postos/adicionar', 'Adicionar novo postos');
		$tpl['links'] = $this->load->view('parts/linkbar', $links, TRUE);
		
		// Get list of usuarios
		$body['postos'] = $this->postos_model->get_postos();
		
			$tpl['body'] = $this->load->view('contabilidade/postos/index.php', $body, TRUE);
			
		$tpl['title'] = 'postos';
		$tpl['pagetitle'] = 'Gerenciar postos';
		
		$this->load->view($this->tpl, $tpl);
	}

	function adicionar(){
		//$this->auth->check('postos.adicionar');
		$body['postos'] = NULL;
		$body['postos_id'] = NULL;
		
		$tpl['title'] = 'Adicionar postos';
		$tpl['pagetitle'] = 'Adicionar novo postos';
		$tpl['body'] = $this->load->view('contabilidade/postos/addedit.php', $body, TRUE);
		$this->load->view($this->tpl, $tpl);
	}
	
	function editar($postos_id){
		//$this->auth->check('postos.editar');
		$body['postos'] = $this->postos_model->get_postos($postos_id);
		$body['postos_id'] = $postos_id;
		
		//
		$tpl['title'] = 'Editar postos';
		
		if($body['postos'] != FALSE){
			$tpl['pagetitle'] = 'Editar postos ' . $body['postos']->postos_descricao . '';
			$tpl['body'] = $this->load->view('contabilidade/postos/addedit.php', $body, TRUE);
		} else {
			$tpl['pagetitle'] = 'Error getting postos';
			$tpl['body'] = $this->msg->err('Could not load the specified postos. Please check the ID and try again.');
		}
		
		$this->load->view($this->tpl, $tpl);
	}

	function salvar(){
		
		$postos_id = $this->input->post('postos_id');
		
		$this->form_validation->set_rules('postos_id', 'postos_id');
		$this->form_validation->set_rules('postos_descricao', 'Razão Social', 'required|trim|xss_clean');
		$this->form_validation->set_rules('postos_nome', 'Nome Fantasia ', 'required|trim|xss_clean');
		$this->form_validation->set_rules('postos_endereco', 'Endereço ', 'required|trim|xss_clean');
		$this->form_validation->set_rules('postos_telefone', 'Telefone ', 'required|trim|xss_clean');
		$this->form_validation->set_rules('postos_celular', 'Celular ', 'trim|xss_clean');
		$this->form_validation->set_rules('postos_celular_operadora', 'Celular Operadora ', 'trim|xss_clean');
		$this->form_validation->set_rules('postos_email', 'E-mail ', 'trim|valid_email|xss_clean');
		$this->form_validation->set_rules('postos_cnpj', 'CPF ', 'required|trim|xss_clean');
		$this->form_validation->set_rules('postos_data_admissao', 'Data Admissão ', 'required|trim|xss_clean');
		$this->form_validation->set_rules('postos_ativo', 'Ativo ', 'trim|xss_clean');
		$this->form_validation->set_error_delimiters('<li>', '</li>');
		if ($this->form_validation->run() == FALSE) {
			($postos_id == NULL) ? $this->adicionar() : $this->editar($postos_id);
		} else {
			$data['postos_cnpj']					= $this->input->post('postos_cnpj');
			$data['postos_descricao']				= str2uppercase($this->input->post('postos_descricao'));
			$data['postos_nome']					= str2uppercase($this->input->post('postos_nome'));
			$data['postos_endereco']				= str2uppercase($this->input->post('postos_endereco'));
			$data['postos_telefone']				= $this->input->post('postos_telefone');
			$data['postos_celular']					= $this->input->post('postos_celular');
			$data['postos_celular_operadora']		= str2uppercase($this->input->post('postos_celular_operadora'));
			$data['postos_email']					= $this->input->post('postos_email');
			$data['postos_data_admissao']			= human2mysql($this->input->post('postos_data_admissao'));
			$data['postos_ativo']      				= ($this->input->post('postos_ativo') == '1') ? 1 : 0;
			
			if($postos_id == NULL){
			
				$adicionar = $this->postos_model->add_postos($data);
				
				if($adicionar == TRUE){
					$this->msg->adicionar('info', sprintf($this->lang->line('SECURITY_TURMA_ADD_OK'), $data['postos_descricao']));
				} else {
					//$this->msg->adicionar('err', sprintf($this->lang->line('SECURITY_TURMA_ADD_FAIL', $this->postos_model->lasterr)));
					$this->msg->adicionar('err', $this->postos_model->lasterr, 'ERRO!');
				}
			
			} else {
			
				// Updating existing postos
				$editar = $this->postos_model->edit_postos($postos_id, $data);
				if($editar == TRUE){
					$this->msg->adicionar('info', sprintf($this->lang->line('SECURITY_TURMA_EDIT_OK'), $data['postos_descricao']));
				} else {
					$this->msg->adicionar('err', sprintf($this->lang->line('SECURITY_TURMA_EDIT_FAIL', $this->postos_model->lasterr)));
				}
				
			}
			
			if($this->input->post('btn_submit') == 'Adicionar' || $this->input->post('btn_submit') == 'Salvar'){
				redirect('contabilidade/postos');
			}else{
				redirect('contabilidade/postos/adicionar');
			}
		}
		
	}

	function excluir($postos_id = NULL){
		//$this->auth->check('postos.excluir');
		
		// Check if a form has been submitted; if not - show it to ask postos confirmation
		if($this->input->post('id')){
		
			// Form has been submitted (so the POST value exists)
			// Call model function to excluir postos
			$excluir = $this->postos_model->delete_postos($this->input->post('id'));
			if($excluir == FALSE){
				$this->msg->adicionar('err', $this->postos_model->lasterr, 'Ocorreu um erro!');
			} else {
				$this->msg->adicionar('info', 'The postos has been deleted.');
			}
			// Redirect
			redirect('contabilidade/postos');
			
		} else {
			if($postos_id == NULL){
				
				$tpl['title'] = 'Excluir postos';
				$tpl['pagetitle'] = $tpl['title'];
				$tpl['body'] = $this->msg->err('Cannot find the postos or no postos ID given.');
				
			} else {
				
				// Get postos info so we can present the confirmation page
				$postos = $this->postos_model->get_postos($postos_id);
				
				if($postos == FALSE){
				
					$tpl['title'] = 'Excluir postos';
					$tpl['pagetitle'] = $tpl['title'];
					$tpl['body'] = $this->msg->err('Could not find that postos or no postos ID given.');
					
				} else {					
					// Initialise page
					$body['action'] = 'contabilidade/postos/excluir';
					$body['id'] = $postos_id;
					$body['cancel'] = 'contabilidade/postos';
					$body['text'] = 'Se houverem matriculas cadastradas para esta postos, não será possível excluí-la.';
					$tpl['title'] = 'Excluir postos';
					$tpl['pagetitle'] = 'Excluir ' . $postos->postos_descricao;
					$tpl['body'] = $this->load->view('parts/deleteconfirm', $body, TRUE);
					
				}
				
			}
			
			$this->load->view($this->tpl, $tpl);
			
		}
		
	}

}

/* End of file controllers/contabilidade/postos/postos.php */