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
		
		
		$body['series'] = $this->recebimentos_model->get_recebimentos_serie();

		$this->load->model('transportadoras/transportadoras_model');
		$this->load->model('frotas/frotas_model');
		$this->load->model('clientes/clientes_model');
		$body['transportadoras']	= $this->transportadoras_model->get_transportadoras_dropdown();
		$body['frotas'] 			= $this->frotas_model->get_caminhoes_controle_de_viagem_agenda_liberado_dropdown();
		$body['clientes'] = $this->clientes_model->get_clientes_dropdown();
		
		
		$body['recebimentos'] = $this->recebimentos_model->get_recebimentos();
		
			$tpl['body'] = $this->load->view('contabilidade/recebimentos/index.php', $body, TRUE);
			
		$tpl['title'] = 'recebimentos';
		$tpl['pagetitle'] = 'Gerenciar recebimentos';
		
		$this->load->view($this->tpl, $tpl);
	}

	function avancada(){
		//$this->auth->check('recebimentos');
		
		$this->load->model('transportadoras/transportadoras_model');
		$this->load->model('frotas/frotas_model');
		$this->load->model('clientes/clientes_model');
		$body['transportadoras']	= $this->transportadoras_model->get_transportadoras_dropdown();
		$body['frotas'] 			= $this->frotas_model->get_caminhoes_controle_de_viagem_agenda_liberado_dropdown();
		$body['clientes'] = $this->clientes_model->get_clientes_dropdown();
		$body['series'] = $this->recebimentos_model->get_recebimentos_serie();

		if ($this->input->post('recebimentos_transportadoras_id')) {
			$transportadoras = $this->input->post('recebimentos_transportadoras_id');
		} else {
			$transportadoras = NULL;
		}

		if ($this->input->post('recebimentos_clientes_id')) {
			$clientes = $this->input->post('recebimentos_clientes_id');
		} else {
			$clientes = NULL;
		}

		if ($this->input->post('recebimentos_descricao')) {
			$numero = $this->input->post('recebimentos_descricao');
		} else {
			$numero = NULL;
		}
		
		if ($this->input->post('recebimentos_serie')) {
			$serie = $this->input->post('recebimentos_serie');
		} else {
			$serie = NULL;
		}

		if ($this->input->post('recebimentos_caminhoes_id')) {
			$frota = $this->input->post('recebimentos_caminhoes_id');
		} else {
			$frota = NULL;
		}
		
		if ($this->input->post('recebimentos_data')) {
			$carregamento = human2mysql($this->input->post('recebimentos_data'));
		} else {
			$carregamento = NULL;
		}

		if ($this->input->post('recebimentos_data_recebido')) {
			$recebimento = human2mysql($this->input->post('recebimentos_data_recebido'));
		} else {
			$recebimento = NULL;
		}
		
		if ($this->input->post('recebimentos_valor')) {
			$valor = number2decimal($this->input->post('recebimentos_valor'));
		} else {
			$valor = NULL;
		}

		if ($this->input->post('recebimentos_confirmado')) {
			$confirmado = $this->input->post('recebimentos_confirmado');
		} else {
			$confirmado = FALSE;
		}

		if ($this->input->post('recebimentos_recebido')) {
			$recebido = $this->input->post('recebimentos_recebido');
		} else {
			$recebido = FALSE;
		}

		// echo '<p>' . $transportadoras . '</p>';
		// echo '<p>' . $clientes . '</p>';
		// echo '<p>' . $numero . '</p>';
		// echo '<p>' . $serie . '</p>';
		// echo '<p>' . $frota . '</p>';
		// echo '<p>' . $carregamento . '</p>';
		// echo '<p>' . $recebimento . '</p>';
		// echo '<p>' . $valor . '</p>';
		// echo '<p>' . $recebido . '</p>';

		$body['p'] = array(	'recebimentos_transportadoras_id' => $transportadoras,
							'recebimentos_clientes_id' => $clientes,
							'recebimentos_descricao' => $numero,
							'recebimentos_serie' => $serie,
							'recebimentos_caminhoes_id' => $frota,
							'recebimentos_data' => $carregamento,
							'recebimentos_data_recebido' => $recebimento,
							'recebimentos_valor' => $valor,
							'recebimentos_confirmado' => $confirmado,
							'recebimentos_recebido' => $recebido
							);

		$body['recebimentos'] = $this->recebimentos_model->get_recebimentos_advanced($transportadoras, $clientes, $numero, $serie, $frota, $carregamento, $recebimento, $valor, $confirmado, $recebido);

		// $body['recebimentos'] = $this->recebimentos_model->get_recebimentos();

		$tpl['body'] = $this->load->view('contabilidade/recebimentos/index.php', $body, TRUE);	
		$tpl['title'] = 'recebimentos';
		$tpl['pagetitle'] = 'Gerenciar recebimentos';
		
		$this->load->view($this->tpl, $tpl);
	}

	function adicionar(){
		//$this->auth->check('recebimentos.adicionar');
		$body['recebimentos'] = NULL;
		$body['recebimentos_id'] = NULL;

		$this->load->model('transportadoras/transportadoras_model');
		$this->load->model('frotas/frotas_model');
		$this->load->model('clientes/clientes_model');
		$body['transportadoras']	= $this->transportadoras_model->get_transportadoras_dropdown();
		$body['frotas'] 			= $this->frotas_model->get_caminhoes_controle_de_viagem_agenda_liberado_dropdown();
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

		$this->load->model('transportadoras/transportadoras_model');
		$this->load->model('frotas/frotas_model');

		$body['transportadoras']	= $this->transportadoras_model->get_transportadoras_dropdown();
		$body['frotas'] 			= $this->frotas_model->get_caminhoes_controle_de_viagem_agenda_liberado_dropdown();

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
		/*ALTER TABLE `recebimentos` ADD COLUMN `recebimentos_caminhoes_id` INT(11) NULL DEFAULT NULL AFTER `recebimentos_serie`;*/
		/*ALTER TABLE `recebimentos` CHANGE COLUMN `recebimentos_descricao` `recebimentos_descricao` VARCHAR(11) NULL DEFAULT NULL AFTER `recebimentos_clientes_id`;*/
		$recebimentos_id = $this->input->post('recebimentos_id');
		
		$this->form_validation->set_rules('recebimentos_id', 'recebimentos_id');

		$this->form_validation->set_rules('recebimentos_transportadoras_id', 'recebimentos_transportadoras_id ', 'required|trim|xss_clean');
		$this->form_validation->set_rules('recebimentos_clientes_id', 'recebimentos_clientes_id ', 'required|trim|xss_clean');
		// $this->form_validation->set_rules('recebimentos_descricao', 'Número ', 'required|trim|xss_clean');
		// $this->form_validation->set_rules('recebimentos_serie', 'Série ', 'required|trim|xss_clean');
		$this->form_validation->set_rules('recebimentos_caminhoes_id', 'Frota ', 'required|trim|xss_clean');
		$this->form_validation->set_rules('recebimentos_data', 'Data ', 'required|trim|xss_clean');
		// $this->form_validation->set_rules('recebimentos_valor', 'Valor ', 'required|trim|xss_clean');
		$this->form_validation->set_error_delimiters('<li>', '</li>');
		if ($this->form_validation->run() == FALSE) {
			($recebimentos_id == NULL) ? $this->adicionar() : $this->editar($recebimentos_id);
		} else {
			$data['recebimentos_transportadoras_id']		= str2uppercase($this->input->post('recebimentos_transportadoras_id'));
			$data['recebimentos_clientes_id']				= str2uppercase($this->input->post('recebimentos_clientes_id'));
			$data['recebimentos_descricao']					= str2uppercase($this->input->post('recebimentos_descricao'));
			$data['recebimentos_serie']						= str2uppercase($this->input->post('recebimentos_serie'));
			$data['recebimentos_caminhoes_id']				= str2uppercase($this->input->post('recebimentos_caminhoes_id'));
			$data['recebimentos_data']						= human2mysql($this->input->post('recebimentos_data'));
			$data['recebimentos_valor']						= comma2dot($this->input->post('recebimentos_valor'));
			$data['recebimentos_comentario']				= $this->input->post('recebimentos_comentario');
			
			if ($this->input->post('recebimentos_data_recebido')) {
				$data['recebimentos_data_recebido']		= human2mysql($this->input->post('recebimentos_data_recebido'));
			}
			
			$data['recebimentos_recebido']      	= ($this->input->post('recebimentos_recebido') == '1') ? 1 : 0;
			$data['recebimentos_confirmado']      	= ($this->input->post('recebimentos_confirmado') == '1') ? 1 : 0;
			
			if($recebimentos_id == NULL){
			
				$adicionar = $this->recebimentos_model->add_recebimentos($data);
				
				if($adicionar == TRUE){
					$this->msg->adicionar('info', sprintf($this->lang->line('SECURITY_TURMA_ADD_OK'), $data['recebimentos_descricao']));
				} else {
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

	function confirmar($recebimentos_id){

		if($recebimentos_id == NULL){
			$this->msg->adicionar('err', '', 'ERRO!');
		} else {
			$data['recebimentos_confirmado']      	= 1;
			$editar = $this->recebimentos_model->edit_recebimentos($recebimentos_id, $data);
			if($editar == TRUE){
				$this->msg->adicionar('info', sprintf($this->lang->line('SECURITY_TURMA_EDIT_OK'), $recebimentos_id));
			} else {
				$this->msg->adicionar('err', sprintf($this->lang->line('SECURITY_TURMA_EDIT_FAIL', $this->recebimentos_model->lasterr)));
			}
		}
		redirect('contabilidade/recebimentos');
	}

	function desconfirmar($recebimentos_id){

		if($recebimentos_id == NULL){
			$this->msg->adicionar('err', '', 'ERRO!');
		} else {
			$data['recebimentos_confirmado']      	= 0;
			$editar = $this->recebimentos_model->edit_recebimentos($recebimentos_id, $data);
			if($editar == TRUE){
				$this->msg->adicionar('info', sprintf($this->lang->line('SECURITY_TURMA_EDIT_OK'), $recebimentos_id));
			} else {
				$this->msg->adicionar('err', sprintf($this->lang->line('SECURITY_TURMA_EDIT_FAIL', $this->recebimentos_model->lasterr)));
			}
		}
		redirect('contabilidade/recebimentos');
	}

	function recebido($recebimentos_id){

		if($recebimentos_id == NULL){
			$this->msg->adicionar('err', '', 'ERRO!');
		} else {
			$data['recebimentos_recebido']      	= 1;
			$editar = $this->recebimentos_model->edit_recebimentos($recebimentos_id, $data);
			if($editar == TRUE){
				$this->msg->adicionar('info', sprintf($this->lang->line('SECURITY_TURMA_EDIT_OK'), $recebimentos_id));
			} else {
				$this->msg->adicionar('err', sprintf($this->lang->line('SECURITY_TURMA_EDIT_FAIL', $this->recebimentos_model->lasterr)));
			}
		}
		redirect('contabilidade/recebimentos');
	}

	function devolvido($recebimentos_id){

		if($recebimentos_id == NULL){
			$this->msg->adicionar('err', '', 'ERRO!');
		} else {
			$data['recebimentos_recebido'] = 0;
			$editar = $this->recebimentos_model->edit_recebimentos($recebimentos_id, $data);
			if($editar == TRUE){
				$this->msg->adicionar('info', sprintf($this->lang->line('SECURITY_TURMA_EDIT_OK'), $recebimentos_id));
			} else {
				$this->msg->adicionar('err', sprintf($this->lang->line('SECURITY_TURMA_EDIT_FAIL', $this->recebimentos_model->lasterr)));
			}
		}
		redirect('contabilidade/recebimentos');
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