<?php 
class Rastreador extends Controller {

	var $tpl;

	function Rastreador(){
		parent::Controller();
		$this->load->model('rastreador_model');
		$this->load->helper('text');
		$this->tpl = $this->config->item('template');
		$this->output->enable_profiler($this->config->item('profiler'));
		if($this->auth->logged_in() == TRUE AND $this->config->item('tracker') == TRUE){ $this->rastreador_model->add_visit(); }
	}

	function index(){
	
		$this->load->model('sistema_model');
		$tpl['subnav'] = $this->sistema_model->subnav();
		
		$sql = 'SELECT * FROM usuarios as u, visitante as ve, visita as v WHERE v.visit_visitor_id = ve.visitor_id AND ve.usuario_id = u.usuario_id  ORDER BY v.visit_visit_date DESC LIMIT 15';
		$query	= $this->db->query($sql);
		$track = $query->result();
		
		$body['tracker'] = $track;
		if ($body['tracker'] == FALSE) {
			//
		} else {
			$tpl['body'] = $this->load->view('sistema/rastreador/index.php', $body, TRUE);
		}
		
		$tpl['title'] = 'Rastreador';
		$tpl['pagetitle'] = 'Rastreador';
		
		$this->load->view($this->tpl, $tpl);
	}
	
	function usuario($usuario_id){
	
		$this->load->model('sistema_model');
		$tpl['subnav'] = $this->sistema_model->subnav();
		$sql = 'SELECT * FROM usuarios as u, visitante as ve, visita as v WHERE v.visit_visitor_id = ve.visitor_id AND ve.usuario_id = u.usuario_id AND u.usuario_id = ? ORDER BY v.visit_visit_date DESC ';//LIMIT 15
		$query = $this->db->query($sql, array($usuario_id));
		$track = $query->result();
		
		$body['tracker'] = $track;
		if ($body['tracker'] == FALSE) {
			//
		} else {
			$tpl['body'] = $this->load->view('sistema/rastreador/index.php', $body, TRUE);
		}
		
		$tpl['title'] = 'Rastreador';
		$tpl['pagetitle'] = 'Rastreador';
		
		$this->load->view($this->tpl, $tpl);
	}

	function date(){
	
		$this->load->model('sistema_model');
		$tpl['subnav'] = $this->sistema_model->subnav();
		$this->load->model('Tracker_model');
		$body['tracker'] = $this->rastreador_model->get_hits(date('Y-m-d'), date('Y-m-d'), TRUE);
		if ($body['tracker'] == FALSE) { } else {
			$tpl['body'] = $this->load->view('sistema/rastreador/index.php', $body, TRUE);
		}
		
		$tpl['title'] = 'Rastreador';
		$tpl['pagetitle'] = 'Rastreador';
		
		$this->load->view($this->tpl, $tpl);
	}

	function period(){
	
		$this->load->model('sistema_model');
		$tpl['subnav'] = $this->sistema_model->subnav();
		$this->load->model('Tracker_model');
		$body['tracker'] = $this->rastreador_model->get_hits('2010-01-01', '2010-12-31', FALSE);
		if ($body['tracker'] == FALSE) { } else {
			$tpl['body'] = $this->load->view('sistema/rastreador/index.php', $body, TRUE);
		}
		
		$tpl['title'] = 'Rastreador';
		$tpl['pagetitle'] = 'Rastreador';
		
		$this->load->view($this->tpl, $tpl);
	}
	
	function filter(){
		
		$this->load->model('sistema_model');
		$tpl['subnav'] = $this->sistema_model->subnav();
		$this->load->model('Tracker_model');
		$body['tracker'] = $this->rastreador_model->filter();
		if ($body['tracker'] == FALSE) { } else {
			$tpl['body'] = $this->load->view('sistema/rastreador/index.php', $body, TRUE);
		}
		
		$tpl['title'] = 'Rastreador';
		$tpl['pagetitle'] = 'Rastreador';
		
		$this->load->view($this->tpl, $tpl);
	}
	
}

/* End of file controllers/sitema/tracker.php */