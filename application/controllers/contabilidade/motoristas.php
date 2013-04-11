<?php 
class motoristas extends Controller {

	var $tpl;

	function motoristas(){
		parent::Controller();
		$this->load->model('motoristas/motoristas_model', 'motoristas_model');
		$this->load->helper('text');
		$this->tpl = $this->config->item('template');
		$this->output->enable_profiler($this->config->item('profiler'));
		if($this->auth->logged_in() == TRUE AND $this->config->item('tracker') == TRUE){ $this->rastreador_model->add_visit(); }
	}

	function index(){
		//$this->auth->check('motoristas');
		
		$links[] = array('contabilidade/motoristas/adicionar', 'Adicionar novo motoristas');
		$tpl['links'] = $this->load->view('parts/linkbar', $links, TRUE);
		
		// Get list of usuarios
		$body['motoristas'] = $this->motoristas_model->get_motoristas();
		
			$tpl['body'] = $this->load->view('contabilidade/motoristas/index.php', $body, TRUE);
			
		$tpl['title'] = 'motoristas';
		$tpl['pagetitle'] = 'Gerenciar motoristas';
		
		$this->load->view($this->tpl, $tpl);
	}

	function adicionar(){
		//$this->auth->check('motoristas.adicionar');
		$body['motoristas'] = NULL;
		$body['motoristas_id'] = NULL;
		
		$tpl['title'] = 'Adicionar motoristas';
		$tpl['pagetitle'] = 'Adicionar novo motoristas';
		$tpl['body'] = $this->load->view('contabilidade/motoristas/addedit.php', $body, TRUE);
		$this->load->view($this->tpl, $tpl);
	}
	
	function editar($motoristas_id){
		//$this->auth->check('motoristas.editar');
		$body['motoristas'] = $this->motoristas_model->get_motoristas($motoristas_id);
		$body['motoristas_id'] = $motoristas_id;
		
		//
		$tpl['title'] = 'Editar motoristas';
		
		if($body['motoristas'] != FALSE){
			$tpl['pagetitle'] = 'Editar motoristas ' . $body['motoristas']->motoristas_descricao . '';
			$tpl['body'] = $this->load->view('contabilidade/motoristas/addedit.php', $body, TRUE);
		} else {
			$tpl['pagetitle'] = 'Error getting motoristas';
			$tpl['body'] = $this->msg->err('Could not load the specified motoristas. Please check the ID and try again.');
		}
		
		$this->load->view($this->tpl, $tpl);
	}

	function salvar(){
		
		$motoristas_id = $this->input->post('motoristas_id');
		
		$this->form_validation->set_rules('motoristas_id', 'motoristas_id');
		$this->form_validation->set_rules('motoristas_descricao', 'Nome ', 'required|trim|xss_clean');
		$this->form_validation->set_rules('motoristas_nome', 'Nome Completo ', 'required|trim|xss_clean');
		$this->form_validation->set_rules('motoristas_data_nascimento', 'Data Nascimento ', 'required|trim|xss_clean');
		$this->form_validation->set_rules('motoristas_endereco', 'Endereço ', 'required|trim|xss_clean');
		$this->form_validation->set_rules('motoristas_telefone', 'Telefone ', 'required|trim|xss_clean');
		$this->form_validation->set_rules('motoristas_celular', 'Celular ', 'trim|xss_clean');
		$this->form_validation->set_rules('motoristas_celular_operadora', 'Celular Operadora ', 'trim|xss_clean');
		$this->form_validation->set_rules('motoristas_email', 'E-mail ', 'trim|valid_email|xss_clean');
		$this->form_validation->set_rules('motoristas_setor', 'Setor ', 'required|trim|xss_clean');
		$this->form_validation->set_rules('motoristas_cargo', 'Cargo ', 'required|trim|xss_clean');
		$this->form_validation->set_rules('motoristas_matricula', 'Matrícula ', 'required|trim|xss_clean');
		$this->form_validation->set_rules('motoristas_cpf', 'CPF ', 'required|trim|xss_clean');
		$this->form_validation->set_rules('motoristas_pis', 'PIS ', 'required|trim|xss_clean');
		$this->form_validation->set_rules('motoristas_ctps_numero', 'CTPS Número ', 'required|trim|xss_clean');
		$this->form_validation->set_rules('motoristas_ctps_serie', 'CTPS Série ', 'required|trim|xss_clean');
		$this->form_validation->set_rules('motoristas_ctps_uf', 'CTPS UF ', 'required|trim|xss_clean');
		$this->form_validation->set_rules('motoristas_data_admissao', 'Data Admissão ', 'required|trim|xss_clean');
		$this->form_validation->set_rules('motoristas_data_demissao', 'Data Demissão ', 'trim|xss_clean');
		$this->form_validation->set_rules('motoristas_comissao', 'Salário Percentual ', 'required|trim|xss_clean');
		$this->form_validation->set_rules('motoristas_ativo', 'Ativo ', 'trim|xss_clean');
		$this->form_validation->set_error_delimiters('<li>', '</li>');
		if ($this->form_validation->run() == FALSE) {
			($motoristas_id == NULL) ? $this->adicionar() : $this->editar($motoristas_id);
		} else {
			$data['motoristas_descricao']			= str2uppercase($this->input->post('motoristas_descricao'));
			$data['motoristas_nome']				= str2uppercase($this->input->post('motoristas_nome'));
			$data['motoristas_data_nascimento']		= human2mysql($this->input->post('motoristas_data_nascimento'));
			$data['motoristas_endereco']			= $this->input->post('motoristas_endereco');
			$data['motoristas_telefone']			= $this->input->post('motoristas_telefone');
			$data['motoristas_celular']				= $this->input->post('motoristas_celular');
			$data['motoristas_celular_operadora']	= $this->input->post('motoristas_celular_operadora');
			$data['motoristas_email']				= $this->input->post('motoristas_email');
			$data['motoristas_setor']				= $this->input->post('motoristas_setor');
			$data['motoristas_cargo']				= $this->input->post('motoristas_cargo');
			$data['motoristas_matricula']			= $this->input->post('motoristas_matricula');
			$data['motoristas_cpf']					= $this->input->post('motoristas_cpf');
			$data['motoristas_pis']					= $this->input->post('motoristas_pis');
			$data['motoristas_ctps_numero']			= $this->input->post('motoristas_ctps_numero');
			$data['motoristas_ctps_serie']			= $this->input->post('motoristas_ctps_serie');
			$data['motoristas_ctps_uf']				= $this->input->post('motoristas_ctps_uf');
			$data['motoristas_data_admissao']		= human2mysql($this->input->post('motoristas_data_admissao'));
			$data['motoristas_data_demissao']		= human2mysql($this->input->post('motoristas_data_demissao'));
			$data['motoristas_comissao']			= $this->input->post('motoristas_comissao');
			$data['motoristas_ativo']      			= ($this->input->post('motoristas_ativo') == '1') ? 1 : 0;
			
			if($motoristas_id == NULL){
			
				$adicionar = $this->motoristas_model->add_motoristas($data);
				
				if($adicionar == TRUE){
					$this->msg->adicionar('info', sprintf($this->lang->line('SECURITY_TURMA_ADD_OK'), $data['motoristas_descricao']));
				} else {
					//$this->msg->adicionar('err', sprintf($this->lang->line('SECURITY_TURMA_ADD_FAIL', $this->motoristas_model->lasterr)));
					$this->msg->adicionar('err', $this->motoristas_model->lasterr, 'ERRO!');
				}
			
			} else {
			
				// Updating existing motoristas
				$editar = $this->motoristas_model->edit_motoristas($motoristas_id, $data);
				if($editar == TRUE){
					$this->msg->adicionar('info', sprintf($this->lang->line('SECURITY_TURMA_EDIT_OK'), $data['motoristas_descricao']));
				} else {
					$this->msg->adicionar('err', sprintf($this->lang->line('SECURITY_TURMA_EDIT_FAIL', $this->motoristas_model->lasterr)));
				}
				
			}
			
			if($this->input->post('btn_submit') == 'Adicionar' || $this->input->post('btn_submit') == 'Salvar'){
				redirect('contabilidade/motoristas');
			}else{
				redirect('contabilidade/motoristas/adicionar');
			}
		}
		
	}

	function excluir($motoristas_id = NULL){
		//$this->auth->check('motoristas.excluir');
		
		// Check if a form has been submitted; if not - show it to ask motoristas confirmation
		if($this->input->post('id')){
		
			// Form has been submitted (so the POST value exists)
			// Call model function to excluir motoristas
			$excluir = $this->motoristas_model->delete_motoristas($this->input->post('id'));
			if($excluir == FALSE){
				$this->msg->adicionar('err', $this->motoristas_model->lasterr, 'Ocorreu um erro!');
			} else {
				$this->msg->adicionar('info', 'The motoristas has been deleted.');
			}
			// Redirect
			redirect('contabilidade/motoristas');
			
		} else {
			if($motoristas_id == NULL){
				
				$tpl['title'] = 'Excluir motoristas';
				$tpl['pagetitle'] = $tpl['title'];
				$tpl['body'] = $this->msg->err('Cannot find the motoristas or no motoristas ID given.');
				
			} else {
				
				// Get motoristas info so we can present the confirmation page
				$motoristas = $this->motoristas_model->get_motoristas($motoristas_id);
				
				if($motoristas == FALSE){
				
					$tpl['title'] = 'Excluir motoristas';
					$tpl['pagetitle'] = $tpl['title'];
					$tpl['body'] = $this->msg->err('Could not find that motoristas or no motoristas ID given.');
					
				} else {					
					// Initialise page
					$body['action'] = 'contabilidade/motoristas/excluir';
					$body['id'] = $motoristas_id;
					$body['cancel'] = 'contabilidade/motoristas';
					$body['text'] = 'Se houverem matriculas cadastradas para esta motoristas, não será possível excluí-la.';
					$tpl['title'] = 'Excluir motoristas';
					$tpl['pagetitle'] = 'Excluir ' . $motoristas->motoristas_descricao;
					$tpl['body'] = $this->load->view('parts/deleteconfirm', $body, TRUE);
					
				}
				
			}
			
			$this->load->view($this->tpl, $tpl);
			
		}
		
	}

}

/* End of file controllers/contabilidade/motoristas/motoristas.php */