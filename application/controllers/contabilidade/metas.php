<?php 
class metas extends Controller {

	var $tpl;

	function metas(){
		parent::Controller();
		$this->load->model('metas/metas_model', 'metas_model');
		$this->load->helper('text');
		$this->tpl = $this->config->item('template');
		$this->output->enable_profiler($this->config->item('profiler'));
		if($this->auth->logged_in() == TRUE AND $this->config->item('tracker') == TRUE){ $this->rastreador_model->add_visit(); }
	}

	function index(){
		//$this->auth->check('metas');
		$body['metas'] = $this->metas_model->get_metas();
		$tpl['body'] = $this->load->view('contabilidade/metas/index.php', $body, TRUE);
		$tpl['title'] = 'metas';
		$tpl['pagetitle'] = 'Gerenciar metas';
		$this->load->view($this->tpl, $tpl);
	}

	function relatorio(){
		//$this->auth->check('metas');
		$body['metas'] = $this->my_metas();

		if ($body['metas'] == FALSE) {
			$body['metas'] = 0;
		}

		$tpl['body'] = $this->load->view('contabilidade/metas/metas.php', $body, TRUE);

		//print_r($body);

		// echo "<pre>";
		// var_dump($body);
		// echo "</pre>";

		$tpl['title'] = 'metas';
		$tpl['pagetitle'] = 'Gerenciar metas';
		$this->load->view($this->tpl, $tpl);
	}

	function adicionar(){
		//$this->auth->check('metas.adicionar');
		$body['metas'] = NULL;
		$body['metas_id'] = NULL;

		$this->load->model('controle_de_viagem_regioes/controle_de_viagem_regioes_model');
		$body['regioes'] = $this->controle_de_viagem_regioes_model->get_controle_de_viagem_regioes_dropdown();
		$this->load->model('bonificacao/bonificacao_model');
		$body['mes'] = $this->bonificacao_model->get_bonificacao_dropdown();
		
		$tpl['title'] = 'Adicionar metas';
		$tpl['pagetitle'] = 'Adicionar novo metas';
		$tpl['body'] = $this->load->view('contabilidade/metas/addedit.php', $body, TRUE);
		$this->load->view($this->tpl, $tpl);
	}
	
	function editar($metas_id){
		//$this->auth->check('metas.editar');
		$body['metas'] = $this->metas_model->get_metas($metas_id);
		$body['metas_id'] = $metas_id;
		$this->load->model('controle_de_viagem_regioes/controle_de_viagem_regioes_model');
		$body['regioes'] = $this->controle_de_viagem_regioes_model->get_controle_de_viagem_regioes_dropdown();
		$this->load->model('bonificacao/bonificacao_model');
		$body['mes'] = $this->bonificacao_model->get_bonificacao_dropdown();
		$tpl['title'] = 'Editar metas';
		if($body['metas'] != FALSE){
			$tpl['pagetitle'] = 'Editar metas ' . $body['metas']->metas_id. '';
			$tpl['body'] = $this->load->view('contabilidade/metas/addedit.php', $body, TRUE);
		} else {
			$tpl['pagetitle'] = 'Error getting metas';
			$tpl['body'] = $this->msg->err('Could not load the specified metas. Please check the ID and try again.');
		}
		
		$this->load->view($this->tpl, $tpl);
	}

	function salvar(){
		
		$metas_id = $this->input->post('metas_id');
		$this->form_validation->set_rules('metas_mes_id', 'Mês', 'required|trim|xss_clean');
		$this->form_validation->set_rules('metas_regiao_id', 'Regiao', 'required|trim|xss_clean');
		$this->form_validation->set_rules('metas_valor', 'Valor', 'required|trim|xss_clean');
		$this->form_validation->set_error_delimiters('<li>', '</li>');
		if ($this->form_validation->run() == FALSE) {
			($metas_id == NULL) ? $this->adicionar() : $this->editar($metas_id);
		} else {
			$data['metas_mes_id']		= $this->input->post('metas_mes_id');
			$data['metas_regiao_id']	= $this->input->post('metas_regiao_id');
			$data['metas_valor']		= $this->input->post('metas_valor');
			if($metas_id == NULL){
			
				$adicionar = $this->metas_model->add_metas($data);
				
				if($adicionar == TRUE){
					$this->msg->adicionar('info', sprintf($this->lang->line('SECURITY_TURMA_ADD_OK'), 'OK'));
				} else {
					$this->msg->adicionar('err', $this->metas_model->lasterr, 'ERRO!');
				}
			
			} else {
				$editar = $this->metas_model->edit_metas($metas_id, $data);
				if($editar == TRUE){
					$this->msg->adicionar('info', sprintf($this->lang->line('SECURITY_TURMA_EDIT_OK'), 'OK'));
				} else {
					$this->msg->adicionar('err', sprintf($this->lang->line('SECURITY_TURMA_EDIT_FAIL', $this->metas_model->lasterr)));
				}
			}
			
			if($this->input->post('btn_submit') == 'Adicionar' || $this->input->post('btn_submit') == 'Salvar'){
				redirect('contabilidade/metas');
			}else{
				redirect('contabilidade/metas/adicionar');
			}
		}
		
	}

	function excluir($metas_id = NULL){
		//$this->auth->check('metas.excluir');
		
		// Check if a form has been submitted; if not - show it to ask metas confirmation
		if($this->input->post('id')){
		
			// Form has been submitted (so the POST value exists)
			// Call model function to excluir metas
			$excluir = $this->metas_model->delete_metas($this->input->post('id'));
			if($excluir == FALSE){
				$this->msg->adicionar('err', $this->metas_model->lasterr, 'Ocorreu um erro!');
			} else {
				$this->msg->adicionar('info', 'The metas has been deleted.');
			}
			// Redirect
			redirect('contabilidade/metas');
			
		} else {
			if($metas_id == NULL){
				
				$tpl['title'] = 'Excluir metas';
				$tpl['pagetitle'] = $tpl['title'];
				$tpl['body'] = $this->msg->err('Cannot find the metas or no metas ID given.');
				
			} else {
				
				// Get metas info so we can present the confirmation page
				$metas = $this->metas_model->get_metas($metas_id);
				
				if($metas == FALSE){
				
					$tpl['title'] = 'Excluir metas';
					$tpl['pagetitle'] = $tpl['title'];
					$tpl['body'] = $this->msg->err('Could not find that metas or no metas ID given.');
					
				} else {					
					// Initialise page
					$body['action'] = 'contabilidade/metas/excluir';
					$body['id'] = $metas_id;
					$body['cancel'] = 'contabilidade/metas';
					$body['text'] = 'Se houverem matriculas cadastradas para esta metas, não será possível excluí-la.';
					$tpl['title'] = 'Excluir metas';
					$tpl['pagetitle'] = 'Excluir ' . $metas->metas_descricao;
					$tpl['body'] = $this->load->view('parts/deleteconfirm', $body, TRUE);
					
				}
				
			}
			
			$this->load->view($this->tpl, $tpl);
			
		}
		
	}


	function my_metas(){

		$mes = date('m');

		$this->load->model('bonificacao/bonificacao_model');

		$bonificacao = $this->bonificacao_model->get_bonificacao(4);
		$body['bonificacao'] = $bonificacao;

		if ($bonificacao == NULL) {
			return FALSE;
		}
		
		$m_sql = "SELECT * FROM metas WHERE metas.metas_mes_id = $mes AND metas.metas_regiao_id = 1";
		$m = $this->db->query($m_sql)->row();
		$body['meta_norte'] = $m;

		$m_sql = "SELECT * FROM metas WHERE metas.metas_mes_id = $mes AND metas.metas_regiao_id = 2";
		$m = $this->db->query($m_sql)->row();
		$body['meta_nordeste'] = $m;

		$m_sql = "SELECT * FROM metas WHERE metas.metas_mes_id = $mes AND metas.metas_regiao_id = 3";
		$m = $this->db->query($m_sql)->row();
		$body['meta_centro_oeste'] = $m;

		$m_sql = "SELECT * FROM metas WHERE metas.metas_mes_id = $mes AND metas.metas_regiao_id = 4";
		$m = $this->db->query($m_sql)->row();
		$body['meta_sudeste'] = $m;

		$m_sql = "SELECT * FROM metas WHERE metas.metas_mes_id = $mes AND metas.metas_regiao_id = 5";
		$m = $this->db->query($m_sql)->row();
		$body['meta_sul'] = $m;

		$body['mes'] = $mes;

		$sql_norte = "SELECT COUNT(*) AS total
FROM controle_de_viagem_agenda, transportadoras, motoristas, frotas, controle_de_viagem_origem, controle_de_viagem_destino, controle_de_viagem_regioes
WHERE controle_de_viagem_agenda.controle_de_viagem_agenda_transportadoras_id=transportadoras.transportadoras_id 
AND controle_de_viagem_agenda.controle_de_viagem_agenda_motorista_id=motoristas.motoristas_id 
AND controle_de_viagem_agenda.controle_de_viagem_agenda_caminhao_id=frotas.caminhoes_id 
AND controle_de_viagem_agenda.controle_de_viagem_agenda_origem_id=controle_de_viagem_origem.controle_de_viagem_origem_id 
AND controle_de_viagem_agenda.controle_de_viagem_agenda_destino_id=controle_de_viagem_destino.controle_de_viagem_destino_id 
AND frotas.caminhoes_id=controle_de_viagem_agenda.controle_de_viagem_agenda_caminhao_id
AND controle_de_viagem_destino.controle_de_viagem_destino_regiao_id=controle_de_viagem_regioes.controle_de_viagem_regioes_id
AND controle_de_viagem_regioes.controle_de_viagem_regioes_id = '1'
AND controle_de_viagem_agenda.controle_de_viagem_agenda_data BETWEEN '$bonificacao->bonificacao_mes_inicio' AND '$bonificacao->bonificacao_mes_final'";

		$sql_nordeste= "SELECT COUNT(*) AS total
FROM controle_de_viagem_agenda, transportadoras, motoristas, frotas, controle_de_viagem_origem, controle_de_viagem_destino, controle_de_viagem_regioes
WHERE controle_de_viagem_agenda.controle_de_viagem_agenda_transportadoras_id=transportadoras.transportadoras_id 
AND controle_de_viagem_agenda.controle_de_viagem_agenda_motorista_id=motoristas.motoristas_id 
AND controle_de_viagem_agenda.controle_de_viagem_agenda_caminhao_id=frotas.caminhoes_id 
AND controle_de_viagem_agenda.controle_de_viagem_agenda_origem_id=controle_de_viagem_origem.controle_de_viagem_origem_id 
AND controle_de_viagem_agenda.controle_de_viagem_agenda_destino_id=controle_de_viagem_destino.controle_de_viagem_destino_id 
AND frotas.caminhoes_id=controle_de_viagem_agenda.controle_de_viagem_agenda_caminhao_id
AND controle_de_viagem_destino.controle_de_viagem_destino_regiao_id=controle_de_viagem_regioes.controle_de_viagem_regioes_id
AND controle_de_viagem_regioes.controle_de_viagem_regioes_id = '2'
AND controle_de_viagem_agenda.controle_de_viagem_agenda_data BETWEEN '$bonificacao->bonificacao_mes_inicio' AND '$bonificacao->bonificacao_mes_final'";

		$sql_centro_oeste = "SELECT COUNT(*) AS total
FROM controle_de_viagem_agenda, transportadoras, motoristas, frotas, controle_de_viagem_origem, controle_de_viagem_destino, controle_de_viagem_regioes
WHERE controle_de_viagem_agenda.controle_de_viagem_agenda_transportadoras_id=transportadoras.transportadoras_id 
AND controle_de_viagem_agenda.controle_de_viagem_agenda_motorista_id=motoristas.motoristas_id 
AND controle_de_viagem_agenda.controle_de_viagem_agenda_caminhao_id=frotas.caminhoes_id 
AND controle_de_viagem_agenda.controle_de_viagem_agenda_origem_id=controle_de_viagem_origem.controle_de_viagem_origem_id 
AND controle_de_viagem_agenda.controle_de_viagem_agenda_destino_id=controle_de_viagem_destino.controle_de_viagem_destino_id 
AND frotas.caminhoes_id=controle_de_viagem_agenda.controle_de_viagem_agenda_caminhao_id
AND controle_de_viagem_destino.controle_de_viagem_destino_regiao_id=controle_de_viagem_regioes.controle_de_viagem_regioes_id
AND controle_de_viagem_regioes.controle_de_viagem_regioes_id = '3'
AND controle_de_viagem_agenda.controle_de_viagem_agenda_data BETWEEN '$bonificacao->bonificacao_mes_inicio' AND '$bonificacao->bonificacao_mes_final'";

		$sql_sudeste = "SELECT COUNT(*) AS total
FROM controle_de_viagem_agenda, transportadoras, motoristas, frotas, controle_de_viagem_origem, controle_de_viagem_destino, controle_de_viagem_regioes
WHERE controle_de_viagem_agenda.controle_de_viagem_agenda_transportadoras_id=transportadoras.transportadoras_id 
AND controle_de_viagem_agenda.controle_de_viagem_agenda_motorista_id=motoristas.motoristas_id 
AND controle_de_viagem_agenda.controle_de_viagem_agenda_caminhao_id=frotas.caminhoes_id 
AND controle_de_viagem_agenda.controle_de_viagem_agenda_origem_id=controle_de_viagem_origem.controle_de_viagem_origem_id 
AND controle_de_viagem_agenda.controle_de_viagem_agenda_destino_id=controle_de_viagem_destino.controle_de_viagem_destino_id 
AND frotas.caminhoes_id=controle_de_viagem_agenda.controle_de_viagem_agenda_caminhao_id
AND controle_de_viagem_destino.controle_de_viagem_destino_regiao_id=controle_de_viagem_regioes.controle_de_viagem_regioes_id
AND controle_de_viagem_regioes.controle_de_viagem_regioes_id = '4'
AND controle_de_viagem_agenda.controle_de_viagem_agenda_data BETWEEN '$bonificacao->bonificacao_mes_inicio' AND '$bonificacao->bonificacao_mes_final'";


// 		$sql_sul = "SELECT COUNT(controle_de_viagem_viagens.controle_de_viagem_viagens_id) AS total
// FROM controle_de_viagem, controle_de_viagem_viagens, controle_de_viagem_regioes, controle_de_viagem_origem,controle_de_viagem_destino, transportadoras, frotas, motoristas, clientes
// WHERE controle_de_viagem.controle_de_viagem_id=controle_de_viagem_viagens.controle_de_viagem_viagens_controle_de_viagem_viagens_id
// AND controle_de_viagem.controle_de_viagem_motorista_id=motoristas.motoristas_id
// AND controle_de_viagem.controle_de_viagem_caminhao_id=frotas.caminhoes_id
// AND controle_de_viagem.controle_de_viagem_transportadoras_id=transportadoras.transportadoras_id
// AND controle_de_viagem_destino.controle_de_viagem_destino_regiao_id=controle_de_viagem_regioes.controle_de_viagem_regioes_id
// AND controle_de_viagem_viagens.controle_de_viagem_viagens_origem_id=controle_de_viagem_origem.controle_de_viagem_origem_id
// AND controle_de_viagem_viagens.controle_de_viagem_viagens_destino_id=controle_de_viagem_destino.controle_de_viagem_destino_id 
// AND controle_de_viagem_viagens.controle_de_viagem_viagens_clientes_id=clientes.clientes_id
// AND  controle_de_viagem_regioes.controle_de_viagem_regioes_id = '5' AND controle_de_viagem_viagens.controle_de_viagem_viagens_data BETWEEN '$bonificacao->bonificacao_mes_inicio' AND '$bonificacao->bonificacao_mes_final'";

		$sql_sul = "SELECT COUNT(*) AS total
FROM controle_de_viagem_agenda, transportadoras, motoristas, frotas, controle_de_viagem_origem, controle_de_viagem_destino, controle_de_viagem_regioes
WHERE controle_de_viagem_agenda.controle_de_viagem_agenda_transportadoras_id=transportadoras.transportadoras_id 
AND controle_de_viagem_agenda.controle_de_viagem_agenda_motorista_id=motoristas.motoristas_id 
AND controle_de_viagem_agenda.controle_de_viagem_agenda_caminhao_id=frotas.caminhoes_id 
AND controle_de_viagem_agenda.controle_de_viagem_agenda_origem_id=controle_de_viagem_origem.controle_de_viagem_origem_id 
AND controle_de_viagem_agenda.controle_de_viagem_agenda_destino_id=controle_de_viagem_destino.controle_de_viagem_destino_id 
AND frotas.caminhoes_id=controle_de_viagem_agenda.controle_de_viagem_agenda_caminhao_id
AND controle_de_viagem_destino.controle_de_viagem_destino_regiao_id=controle_de_viagem_regioes.controle_de_viagem_regioes_id
AND controle_de_viagem_regioes.controle_de_viagem_regioes_id = '5'
AND controle_de_viagem_agenda.controle_de_viagem_agenda_data BETWEEN '$bonificacao->bonificacao_mes_inicio' AND '$bonificacao->bonificacao_mes_final'";

		$norte = $this->db->query($sql_norte)->row();
		$body['norte'] = $norte;

		$nordeste = $this->db->query($sql_nordeste)->row();
		$body['nordeste'] = $nordeste;

		$centro_oeste = $this->db->query($sql_centro_oeste)->row();
		$body['centro_oeste'] = $centro_oeste;

		$sudeste = $this->db->query($sql_sudeste)->row();
		$body['sudeste'] = $sudeste;

		$sul = $this->db->query($sql_sul)->row();
		$body['sul'] = $sul;
		
		// $body['sul'] = $this->metas_model->get_metas_total('5', $bonificacao->bonificacao_mes_inicio, $bonificacao->bonificacao_mes_final);

		// print_r($body);

		// $tpl['body'] = $this->load->view('contabilidade/metas/metas.php', $body, TRUE);
		// $this->load->view($this->tpl, $tpl);

		return $body;
	}

}
/* End of file controllers/contabilidade/metas/metas.php */