<?php 
class controle_de_viagem_agenda extends Controller {

	var $tpl;

	function controle_de_viagem_agenda(){
		parent::Controller();
		$this->load->model('controle_de_viagem_agenda/controle_de_viagem_agenda_model', 'controle_de_viagem_agenda_model');
		$this->load->helper('text');
		$this->tpl = $this->config->item('template');
		$this->output->enable_profiler($this->config->item('profiler'));
		if($this->auth->logged_in() == TRUE AND $this->config->item('tracker') == TRUE){ $this->rastreador_model->add_visit(); }
	}

	function index(){
		//$this->auth->check('controle_de_viagem_agenda');
		
		// Get list of usuarios
		$body['frotas'] = $this->controle_de_viagem_agenda_model->get_controle_de_viagem_agenda_caminhoes_liberados();
		
		$body['controle_de_viagem_agenda'] = $this->controle_de_viagem_agenda_model->get_controle_de_viagem_agenda_especifica();
		
		$tpl['body'] = $this->load->view('contabilidade/controle_de_viagem_agenda/index.php', $body, TRUE);
			
		$tpl['title'] = 'controle_de_viagem_agenda';
		$tpl['pagetitle'] = 'Gerenciar controle_de_viagem_agenda';
		
		$this->load->view($this->tpl, $tpl);
	}

	function adicionar($controle_de_viagem_agenda_cliente_id = NULL, $controle_de_viagem_agenda_id = NULL){
		//$this->auth->check('controle_de_viagem_agenda.adicionar');
		$controle_de_viagem_agenda = new stdClass;
		$controle_de_viagem_agenda->controle_de_viagem_agenda_cliente_id = $controle_de_viagem_agenda_cliente_id;
		$controle_de_viagem_agenda->controle_de_viagem_agenda_id = $controle_de_viagem_agenda_id;

		$body['controle_de_viagem_agenda'] = $controle_de_viagem_agenda;
		$body['controle_de_viagem_agenda_id'] = NULL;
		
		$body['controle_de_viagem_agenda_viagens'] = NULL;
		
		$this->load->model('transportadoras/transportadoras_model');
		$this->load->model('frotas/frotas_model');
		$this->load->model('motoristas/motoristas_model');
		$this->load->model('controle_de_viagem_origem/controle_de_viagem_origem_model');
		$this->load->model('controle_de_viagem_viagens/controle_de_viagem_viagens_model');
		$this->load->model('controle_de_viagem_postos/controle_de_viagem_postos_model');
		$this->load->model('postos/postos_model');
		$this->load->model('clientes/clientes_model');
		$this->load->model('controle_de_viagem_despesas_tipos/controle_de_viagem_despesas_tipos_model');
		
		$body['controle_de_viagem_agenda_viagens'] = NULL;
		$body['controle_de_viagem_agenda_postos'] = NULL;
		$body['controle_de_viagem_agenda_despesas'] = NULL;
		
		$body['transportadoras']	= $this->transportadoras_model->get_transportadoras_dropdown();
		$body['motoristas'] 		= $this->motoristas_model->get_motoristas_dropdown();
		$body['frotas'] 			= $this->frotas_model->get_caminhoes_controle_de_viagem_agenda_liberado_dropdown();
		$body['origens'] 			= $this->controle_de_viagem_origem_model->get_controle_de_viagem_origem_dropdown();
		$body['destinos'] 			= $this->controle_de_viagem_origem_model->get_controle_de_viagem_origem_dropdown();
		$body['postos'] 			= $this->postos_model->get_postos_dropdown();
		$body['clientes'] 			= $this->clientes_model->get_clientes_dropdown();
		$body['despesas_tipos'] 	= $this->controle_de_viagem_despesas_tipos_model->get_controle_de_viagem_despesas_tipos_dropdown();
		
		$body['controle_de_viagem_agenda_viagens_total'] = NULL;
		$body['controle_de_viagem_agenda_postos_litros_total'] = NULL;
		
		$tpl['title'] = 'Adicionar controle_de_viagem_agenda';
		$tpl['pagetitle'] = 'Adicionar novo controle_de_viagem_agenda';
		$tpl['body'] = $this->load->view('contabilidade/controle_de_viagem_agenda/addedit.php', $body, TRUE);
		$this->load->view($this->tpl, $tpl);
	}
	
	function editar($controle_de_viagem_agenda_id){
		//$this->auth->check('controle_de_viagem_agenda.editar');
		$body['controle_de_viagem_agenda'] = $this->controle_de_viagem_agenda_model->get_controle_de_viagem_agenda($controle_de_viagem_agenda_id);
		$body['controle_de_viagem_agenda_id'] = $controle_de_viagem_agenda_id;
		
		
		$this->load->model('transportadoras/transportadoras_model');
		$this->load->model('frotas/frotas_model');
		$this->load->model('motoristas/motoristas_model');
		$this->load->model('controle_de_viagem_origem/controle_de_viagem_origem_model');
		$this->load->model('controle_de_viagem_viagens/controle_de_viagem_viagens_model');
		$this->load->model('controle_de_viagem_postos/controle_de_viagem_postos_model');
		$this->load->model('postos/postos_model');
		$this->load->model('clientes/clientes_model');
		$this->load->model('controle_de_viagem_despesas_tipos/controle_de_viagem_despesas_tipos_model');
		$this->load->model('controle_de_viagem_despesas/controle_de_viagem_despesas_model');
		
		$body['controle_de_viagem_agenda_viagens'] = $this->controle_de_viagem_viagens_model->get_controle_de_viagem_viagens_cv($controle_de_viagem_agenda_id);
		$body['controle_de_viagem_agenda_postos'] = $this->controle_de_viagem_postos_model->get_controle_de_viagem_postos_cv($controle_de_viagem_agenda_id);
		$body['controle_de_viagem_agenda_despesas'] = $this->controle_de_viagem_despesas_model->get_controle_de_viagem_despesas_cv($controle_de_viagem_agenda_id);
		
		$body['transportadoras'] 	= $this->transportadoras_model->get_transportadoras_dropdown();
		$body['motoristas'] 		= $this->motoristas_model->get_motoristas_dropdown();
		$body['frotas'] 			= $this->frotas_model->get_caminhoes_dropdown();
		$body['clientes'] 			= $this->clientes_model->get_clientes_dropdown();
		$body['origens'] 			= $this->controle_de_viagem_origem_model->get_controle_de_viagem_origem_dropdown();
		$body['destinos'] 			= $this->controle_de_viagem_origem_model->get_controle_de_viagem_origem_dropdown();
		$body['postos'] 			= $this->postos_model->get_postos_dropdown();
		$body['despesas_tipos'] 	= $this->controle_de_viagem_despesas_tipos_model->get_controle_de_viagem_despesas_tipos_dropdown();
		

		$motoristas_id 					= $body['controle_de_viagem_agenda']->controle_de_viagem_agenda_motorista_id;
		$body['motoristas_comissao'] 	= $this->motoristas_model->get_motoristas_comissao($motoristas_id);
		
		/*
		print('<pre>');
		print_r($body);
		print('</pre>');
		die();
		*/
		
		$tpl['title'] = 'Editar controle_de_viagem_agenda';
		
		if($body['controle_de_viagem_agenda'] != FALSE){
			$tpl['pagetitle'] = 'Editar controle_de_viagem_agenda ' . $body['controle_de_viagem_agenda']->controle_de_viagem_agenda_id . '';
			$tpl['body'] = $this->load->view('contabilidade/controle_de_viagem_agenda/addedit.php', $body, TRUE);
		} else {
			$tpl['pagetitle'] = 'Error getting controle_de_viagem_agenda';
			$tpl['body'] = $this->msg->err('Could not load the specified controle_de_viagem_agenda. Please check the ID and try again.');
		}
		
		//print_r($body);die();
		$this->load->view($this->tpl, $tpl);
	}
	
	function salvar(){
	
		
		$controle_de_viagem_agenda_id = $this->input->post('controle_de_viagem_agenda_id');
		
		$this->form_validation->set_rules('controle_de_viagem_agenda_transportadoras_id', 'transportadora', 'required');
		$this->form_validation->set_rules('controle_de_viagem_agenda_motorista_id', 'motorista', 'required');
		$this->form_validation->set_rules('controle_de_viagem_agenda_caminhoes_id', 'caminhao', 'required');
		$this->form_validation->set_rules('controle_de_viagem_agenda_clientes_id', 'cliente', 'required');
		$this->form_validation->set_rules('controle_de_viagem_agenda_origem_id', 'origem', 'required');
		$this->form_validation->set_rules('controle_de_viagem_agenda_destino_id', 'destino', 'required');
		$this->form_validation->set_rules('controle_de_viagem_agenda_data', 'data', 'required');
		$this->form_validation->set_error_delimiters('<li>', '</li>');

		if($this->form_validation->run() == FALSE){
			
			// Validation failed - load required action depending on the state of usuario_id
			($controle_de_viagem_agenda_id == NULL) ? $this->adicionar() : $this->editar($controle_de_viagem_agenda_id);
			
		} else {
		
			/*
			echo '<pre>';
			print_r($_POST);
			echo '</pre>';
			die();
			*/
			
			// Validation OK
			$data['controle_de_viagem_agenda_transportadoras_id']	= $this->input->post('controle_de_viagem_agenda_transportadoras_id');
			$data['controle_de_viagem_agenda_motorista_id']			= $this->input->post('controle_de_viagem_agenda_motorista_id');
			$data['controle_de_viagem_agenda_caminhao_id']			= $this->input->post('controle_de_viagem_agenda_caminhoes_id');
			$data['controle_de_viagem_agenda_clientes_id']			= $this->input->post('controle_de_viagem_agenda_clientes_id');
			$data['controle_de_viagem_agenda_origem_id']			= $this->input->post('controle_de_viagem_agenda_origem_id');
			$data['controle_de_viagem_agenda_destino_id']			= $this->input->post('controle_de_viagem_agenda_destino_id');
			$data['controle_de_viagem_agenda_caminhao_liberado']	= 1;
			
			if($this->input->post('controle_de_viagem_agenda_data') == NULL)
			{
				$data['controle_de_viagem_agenda_data'] = date('Y-m-d');
			}else
			{
				$data['controle_de_viagem_agenda_data'] = human2mysql($this->input->post('controle_de_viagem_agenda_data'));
			};
			
			//print_r($data); die();
			
			if($controle_de_viagem_agenda_id == NULL){
			
				$adicionar = $this->controle_de_viagem_agenda_model->add_controle_de_viagem_agenda($data);
				
				if($adicionar == TRUE){
					//$this->msg->adicionar('info', sprintf($this->lang->line('SECURITY_TURMA_ADD_OK'), $data['controle_de_viagem_agenda_id']));
					$this->msg->adicionar('info', 'SUCESSO');					
				} else {
					//$this->msg->adicionar('err', sprintf($this->lang->line('SECURITY_TURMA_ADD_FAIL', $this->controle_de_viagem_agenda_model->lasterr)));
					$this->msg->adicionar('err', $this->controle_de_viagem_agenda_model->lasterr, 'ERRO!');
				}
			} else {
			
				// Updating existing controle_de_viagem_agenda
				$editar = $this->controle_de_viagem_agenda_model->edit_controle_de_viagem_agenda($controle_de_viagem_agenda_id, $data);
				if($editar == TRUE){
					$this->msg->adicionar('info', sprintf($this->lang->line('SECURITY_TURMA_EDIT_OK'), $controle_de_viagem_agenda_id));

					$this->load->model('frotas/frotas_model');
					$data2['caminhoes_controle_de_viagem_agenda_liberado']	=	0;//1:agendado
					$caminhao_id		= $this->input->post('controle_de_viagem_agenda_caminhao_id_antigo');
					$agendar_caminhao	= $this->frotas_model->edit_caminhoes($caminhao_id, $data2);
				} else {
					$this->msg->adicionar('err', sprintf($this->lang->line('SECURITY_TURMA_EDIT_FAIL', $this->controle_de_viagem_agenda_model->lasterr)));
				}
			}
			
			$this->load->model('frotas/frotas_model');
			$data2['caminhoes_controle_de_viagem_agenda_liberado']	=	1;//1:agendado
			$caminhao_id		= $this->input->post('controle_de_viagem_agenda_caminhoes_id');
			$agendar_caminhao	= $this->frotas_model->edit_caminhoes($caminhao_id, $data2);
			
			if($this->input->post('btn_submit') == 'Adicionar' || $this->input->post('btn_submit') == 'Salvar'){
				redirect('contabilidade/controle_de_viagem_agenda');
			}else{
				redirect('contabilidade/controle_de_viagem_agenda/adicionar/');
			}
		}
		
	}

	function excluir($controle_de_viagem_agenda_id = NULL){
		//$this->auth->check('controle_de_viagem_agenda.excluir');
		
		// Check if a form has been submitted; if not - show it to ask controle_de_viagem_agenda confirmation
		if($this->input->post('id')){
		
			// Form has been submitted (so the POST value exists)
			// Call model function to excluir controle_de_viagem_agenda
			$excluir = $this->controle_de_viagem_agenda_model->delete_controle_de_viagem_agenda($this->input->post('id'));
			if($excluir == FALSE){
				$this->msg->adicionar('err', $this->controle_de_viagem_agenda_model->lasterr, 'Ocorreu um erro!');
			} else {
				$this->msg->adicionar('info', 'The controle_de_viagem_agenda has been deleted.');
			}
			// Redirect
			redirect('contabilidade/controle_de_viagem_agenda');
			
		} else {
			if($controle_de_viagem_agenda_id == NULL){
				
				$tpl['title'] = 'Excluir controle_de_viagem_agenda';
				$tpl['pagetitle'] = $tpl['title'];
				$tpl['body'] = $this->msg->err('Cannot find the controle_de_viagem_agenda or no controle_de_viagem_agenda ID given.');
				
			} else {
				
				// Get controle_de_viagem_agenda info so we can present the confirmation page
				$controle_de_viagem_agenda = $this->controle_de_viagem_agenda_model->get_controle_de_viagem_agenda($controle_de_viagem_agenda_id);
				
				if($controle_de_viagem_agenda == FALSE){
				
					$tpl['title'] = 'Excluir controle_de_viagem_agenda';
					$tpl['pagetitle'] = $tpl['title'];
					$tpl['body'] = $this->msg->err('Could not find that controle_de_viagem_agenda or no controle_de_viagem_agenda ID given.');
					
				} else {					
					// Initialise page
					$body['action'] = 'contabilidade/controle_de_viagem_agenda/excluir';
					$body['id'] = $controle_de_viagem_agenda_id;
					$body['cancel'] = 'contabilidade/controle_de_viagem_agenda';
					$body['text'] = 'Se houverem matriculas cadastradas para esta controle_de_viagem_agenda, não será possível excluí-la.';
					$tpl['title'] = 'Excluir controle_de_viagem_agenda';
					$tpl['pagetitle'] = 'Excluir ' . $controle_de_viagem_agenda->controle_de_viagem_agenda_id;
					$tpl['body'] = $this->load->view('parts/deleteconfirm', $body, TRUE);
					
				}
				
			}
			
			$this->load->view($this->tpl, $tpl);
			
		}
		
	}
	
	function controle_de_viagem_agenda_liberar_caminhao($controle_de_viagem_agenda_id, $caminhao_id){
	
		//echo $controle_de_viagem_agenda_id.$caminhao_id;
		
		if ($caminhao_id == NULL)
		{
			$this->msg->adicionar('err', '', 'ERRO!');
		}
		else
		{
			$data['controle_de_viagem_agenda_caminhao_liberado']	= 0;//0:liberado
			// Updating existing controle_de_viagem_agenda
			$editar = $this->controle_de_viagem_agenda_model->edit_controle_de_viagem_agenda($controle_de_viagem_agenda_id, $data);
		
			$this->load->model('frotas/frotas_model');
			$data2['caminhoes_controle_de_viagem_agenda_liberado']	=	0;//0:liberado
			$liberar_caminhao	= $this->frotas_model->edit_caminhoes($caminhao_id, $data2);
			
			if ($editar && $liberar_caminhao == TRUE)
			{
				$this->msg->adicionar('info', sprintf($this->lang->line('SECURITY_TURMA_EDIT_OK'), $caminhao_id));
			}
			else
			{
				$this->msg->adicionar('err', sprintf($this->lang->line('SECURITY_TURMA_EDIT_FAIL', $this->controle_de_viagem_agenda_model->lasterr)));
			}
		}
		redirect('contabilidade/controle_de_viagem_agenda');
	}

}

/* End of file controllers/contabilidade/controle_de_viagem_agenda/controle_de_viagem_agenda.php */