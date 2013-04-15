<?php 
class controle_de_viagem extends Controller {

	var $tpl;

	function controle_de_viagem(){
		parent::Controller();
		$this->load->model('controle_de_viagem/controle_de_viagem_model', 'controle_de_viagem_model');
		$this->load->helper('text');
		$this->tpl = $this->config->item('template');
		$this->output->enable_profiler($this->config->item('profiler'));
		if($this->auth->logged_in() == TRUE AND $this->config->item('tracker') == TRUE){ $this->rastreador_model->add_visit(); }
	}

	function index(){
		//$this->auth->check('controle_de_viagem');
		
		$links[] = array('contabilidade/controle_de_viagem/adicionar', 'Adicionar novo controle_de_viagem');
		$tpl['links'] = $this->load->view('parts/linkbar', $links, TRUE);
		
		// Get list of usuarios
		$body['controle_de_viagem'] = $this->controle_de_viagem_model->get_controle_de_viagem_();
		
		/*
		$body['controle_de_viagem_mes_atual'] = $this->controle_de_viagem_model->get_controle_de_viagem_mes_atual();
		$body['faturamento_controle_de_viagem_mes_atual'] = $this->controle_de_viagem_model->get_faturamento_controle_de_viagem_mes_atual();
		
		$body['produto'] = $this->controle_de_viagem_model->get_controle_de_viagem_produto();
		*/
		
		$tpl['body'] = $this->load->view('contabilidade/controle_de_viagem/index.php', $body, TRUE);
			
		$tpl['title'] = 'controle_de_viagem';
		$tpl['pagetitle'] = 'Gerenciar controle_de_viagem';
		
		$this->load->view($this->tpl, $tpl);
	}

	function adicionar($controle_de_viagem_cliente_id = NULL, $controle_de_viagem_id = NULL){
		//$this->auth->check('controle_de_viagem.adicionar');
		$controle_de_viagem = new stdClass;
		$controle_de_viagem->controle_de_viagem_cliente_id = $controle_de_viagem_cliente_id;
		$controle_de_viagem->controle_de_viagem_id = $controle_de_viagem_id;

		$body['controle_de_viagem'] = $controle_de_viagem;
		$body['controle_de_viagem_id'] = NULL;
		
		$body['controle_de_viagem_viagens'] = NULL;
		
		$this->load->model('transportadoras/transportadoras_model');
		$this->load->model('frotas/frotas_model');
		$this->load->model('motoristas/motoristas_model');
		$this->load->model('controle_de_viagem_origem/controle_de_viagem_origem_model');
		$this->load->model('controle_de_viagem_viagens/controle_de_viagem_viagens_model');
		$this->load->model('controle_de_viagem_postos/controle_de_viagem_postos_model');
		$this->load->model('postos/postos_model');
		$this->load->model('controle_de_viagem_despesas_tipos/controle_de_viagem_despesas_tipos_model');
		
		$body['controle_de_viagem_viagens'] = NULL;
		$body['controle_de_viagem_postos'] = NULL;
		$body['controle_de_viagem_despesas'] = NULL;
		
		$body['transportadoras']= $this->transportadoras_model->get_transportadoras_dropdown();
		$body['motoristas'] 	= $this->motoristas_model->get_motoristas_dropdown();
		$body['frotas'] 		= $this->frotas_model->get_caminhoes_dropdown();
		$body['origens'] 		= $this->controle_de_viagem_origem_model->get_controle_de_viagem_origem_dropdown();
		$body['destinos'] 		= $this->controle_de_viagem_origem_model->get_controle_de_viagem_origem_dropdown();
		$body['postos'] 		= $this->postos_model->get_postos_dropdown();
		$body['despesas_tipos'] = $this->controle_de_viagem_despesas_tipos_model->get_controle_de_viagem_despesas_tipos_dropdown();
		
		$body['controle_de_viagem_viagens_total'] = NULL;
		$body['controle_de_viagem_postos_litros_total'] = NULL;
		
		$tpl['title'] = 'Adicionar controle_de_viagem';
		$tpl['pagetitle'] = 'Adicionar novo controle_de_viagem';
		$tpl['body'] = $this->load->view('contabilidade/controle_de_viagem/addedit.php', $body, TRUE);
		$this->load->view($this->tpl, $tpl);
	}
	
	function editar($controle_de_viagem_id = FALSE){
		//$this->auth->check('controle_de_viagem.editar');

		if ($controle_de_viagem_id == FALSE) {
			redirect('contabilidade/controle_de_viagem');
		}

		$body['controle_de_viagem'] = $this->controle_de_viagem_model->get_controle_de_viagem($controle_de_viagem_id);
		$body['controle_de_viagem_id'] = $controle_de_viagem_id;
		
		
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
		
		$body['controle_de_viagem_viagens'] = $this->controle_de_viagem_viagens_model->get_controle_de_viagem_viagens_cv($controle_de_viagem_id);
		$body['controle_de_viagem_postos'] = $this->controle_de_viagem_postos_model->get_controle_de_viagem_postos_cv($controle_de_viagem_id);
		$body['controle_de_viagem_despesas'] = $this->controle_de_viagem_despesas_model->get_controle_de_viagem_despesas_cv($controle_de_viagem_id);
		
		$body['transportadoras'] 	= $this->transportadoras_model->get_transportadoras_dropdown();
		$body['motoristas'] 		= $this->motoristas_model->get_motoristas_dropdown();
		$body['frotas'] 			= $this->frotas_model->get_caminhoes_dropdown();
		$body['clientes'] 			= $this->clientes_model->get_clientes_dropdown();
		$body['origens'] 			= $this->controle_de_viagem_origem_model->get_controle_de_viagem_origem_dropdown();
		$body['destinos'] 			= $this->controle_de_viagem_origem_model->get_controle_de_viagem_origem_dropdown();
		$body['postos'] 			= $this->postos_model->get_postos_dropdown();
		$body['despesas_tipos'] 	= $this->controle_de_viagem_despesas_tipos_model->get_controle_de_viagem_despesas_tipos_dropdown();
		

		$motoristas_id 					= $body['controle_de_viagem']->controle_de_viagem_motorista_id;
		$body['motoristas_comissao'] 	= $this->motoristas_model->get_motoristas_comissao($motoristas_id);
		
		$body['controle_de_viagem_despesas_total'] = $this->controle_de_viagem_despesas_model->get_controle_de_viagem_despesas_total($controle_de_viagem_id)->total;
		$body['controle_de_viagem_viagens_total'] = $this->controle_de_viagem_viagens_model->get_controle_de_viagem_viagens_total($controle_de_viagem_id)->total;
		$body['controle_de_viagem_postos_litros_total'] = $this->controle_de_viagem_postos_model->get_controle_de_viagem_postos_litros_total($controle_de_viagem_id)->total;
		
		$tpl['title'] = 'Editar controle_de_viagem';
		
		if($body['controle_de_viagem'] != FALSE){
			$tpl['pagetitle'] = 'Editar controle_de_viagem ' . $body['controle_de_viagem']->controle_de_viagem_id . '';
			$tpl['body'] = $this->load->view('contabilidade/controle_de_viagem/addedit.php', $body, TRUE);
		} else {
			$tpl['pagetitle'] = 'Error getting controle_de_viagem';
			$tpl['body'] = $this->msg->err('Could not load the specified controle_de_viagem. Please check the ID and try again.');
		}

		$this->load->view($this->tpl, $tpl);
	}
	
	function salvar(){
		$controle_de_viagem_id = $this->input->post('controle_de_viagem_id');
		$this->form_validation->set_rules('controle_de_viagem_transportadoras_id', 'transportadora', 'required');
		$this->form_validation->set_rules('controle_de_viagem_motorista_id', 'motorista', 'required');
		$this->form_validation->set_rules('controle_de_viagem_caminhoes_id', 'caminhao', 'required');
		$this->form_validation->set_rules('controle_de_viagem_km_inicial', 'km_inicial', 'required');
		$this->form_validation->set_rules('controle_de_viagem_km_final', 'km_final', 'required');
		$this->form_validation->set_error_delimiters('<li>', '</li>');
		if($this->form_validation->run() == FALSE){
			($controle_de_viagem_id == NULL) ? $this->adicionar() : $this->editar($controle_de_viagem_id);
		} else {
			$data['controle_de_viagem_transportadoras_id']	= $this->input->post('controle_de_viagem_transportadoras_id');
			$data['controle_de_viagem_motorista_id']	= $this->input->post('controle_de_viagem_motorista_id');
			$data['controle_de_viagem_caminhao_id']		= $this->input->post('controle_de_viagem_caminhoes_id');
			$data['controle_de_viagem_km_inicial']		= $this->input->post('controle_de_viagem_km_inicial');
			$data['controle_de_viagem_km_final']		= $this->input->post('controle_de_viagem_km_final');
			$data['controle_de_viagem_horimetro']		= $this->input->post('controle_de_viagem_horimetro');
			$data['controle_de_viagem_horimetro_litros']= $this->input->post('controle_de_viagem_horimetro_litros');
			$data['controle_de_viagem_valor_frete']		= comma2dot($this->input->post('controle_de_viagem_valor_frete'));
			if($controle_de_viagem_id == NULL){
				$adicionar = $this->controle_de_viagem_model->add_controle_de_viagem($data);
				if($adicionar == TRUE){
					$this->msg->adicionar('info', 'OK');
				} else {
					$this->msg->adicionar('err', $this->controle_de_viagem_model->lasterr, 'ERRO!');
				}
				$id = $this->db->insert_id();
				echo "<script>alert('NUMERO DO CONTROLE DE VIAGEM: $id'); window.location = './editar/$id';</script>";
				die();
			} else {
				$editar = $this->controle_de_viagem_model->edit_controle_de_viagem($controle_de_viagem_id, $data);
				if($editar == TRUE){
					$this->msg->adicionar('info', sprintf($this->lang->line('SECURITY_TURMA_EDIT_OK'), $controle_de_viagem_id));
				} else {
					$this->msg->adicionar('err', sprintf($this->lang->line('SECURITY_TURMA_EDIT_FAIL', $this->controle_de_viagem_model->lasterr)));
				}
				redirect('contabilidade/controle_de_viagem/editar/'.$controle_de_viagem_id);
			}
		}
	}

	function excluir($controle_de_viagem_id = NULL){
		//$this->auth->check('controle_de_viagem.excluir');
		if($this->input->post('id')){
			$excluir = $this->controle_de_viagem_model->delete_controle_de_viagem($this->input->post('id'));
			if($excluir == FALSE){
				$this->msg->adicionar('err', $this->controle_de_viagem_model->lasterr, 'Ocorreu um erro!');
			} else {
				$this->msg->adicionar('info', 'The controle_de_viagem has been deleted.');
			}
			redirect('contabilidade/controle_de_viagem');
		} else {
			if($controle_de_viagem_id == NULL){
				
				$tpl['title'] = 'Excluir controle_de_viagem';
				$tpl['pagetitle'] = $tpl['title'];
				$tpl['body'] = $this->msg->err('Cannot find the controle_de_viagem or no controle_de_viagem ID given.');
				
			} else {
				$controle_de_viagem = $this->controle_de_viagem_model->get_controle_de_viagem($controle_de_viagem_id);
				if($controle_de_viagem == FALSE){
					$tpl['title'] = 'Excluir controle_de_viagem';
					$tpl['pagetitle'] = $tpl['title'];
					$tpl['body'] = $this->msg->err('Could not find that controle_de_viagem or no controle_de_viagem ID given.');
				} else {					
					$body['action'] = 'contabilidade/controle_de_viagem/excluir';
					$body['id'] = $controle_de_viagem_id;
					$body['cancel'] = 'contabilidade/controle_de_viagem';
					$body['text'] = 'Se houverem matriculas cadastradas para esta controle_de_viagem, não será possível excluí-la.';
					$tpl['title'] = 'Excluir controle_de_viagem';
					$tpl['pagetitle'] = 'Excluir ' . $controle_de_viagem->controle_de_viagem_id;
					$tpl['body'] = $this->load->view('parts/deleteconfirm', $body, TRUE);
				}
			}
			$this->load->view($this->tpl, $tpl);
		}
	}
}

/* End of file controllers/contabilidade/controle_de_viagem/controle_de_viagem.php */