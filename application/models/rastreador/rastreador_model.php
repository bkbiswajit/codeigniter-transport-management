<?php
class Rastreador_model extends Model
{
	var $visit_table = 'visita';
	var $visitor_table = 'visitante';
	var $auto_add_visit = FALSE;
	function __construct()
	{
		parent::__construct();
		if($this->auto_add_visit)
		{
			$this->add_visit();
		}
	}

	function add_visit()
	{
		$usuario_id	= $this->session->userdata('usuario_id');

		if ($this->agent->is_browser())
		{
			$agent = $this->agent->browser().' '.$this->agent->version();
		}
		elseif ($this->agent->is_robot())
		{
			$agent = $this->agent->robot();
		}
		elseif ($this->agent->is_mobile())
		{
			$agent = $this->agent->mobile();
		}
		else
		{
			$agent = 'Unidentified User Agent';
		}
		$platform = $this->agent->platform();
		$user_agent = $this->agent->agent_string();
		$referrer = $this->agent->referrer();
		$ip_address = $this->input->ip_address();
		$is_mobile = $this->agent->is_mobile();
		$is_browser = $this->agent->is_browser();
		$is_robot = $this->agent->is_robot();
		$this->db->from($this->visitor_table);
		$this->db->where('usuario_id', $usuario_id);
		$this->db->where('visitor_agent', $agent);
		$this->db->where('visitor_platform', $platform);
		$this->db->where('visitor_user_agent_string', $user_agent);
		$this->db->where('visitor_ip_address', $ip_address);
		$this->db->where('visitor_is_mobile', $is_mobile);
		$this->db->where('visitor_is_browser', $is_browser);
		$this->db->where('visitor_is_robot', $is_robot);
		$this->db->order_by('visitor_id', 'desc');
		$this->db->limit(1);
		$result = $this->db->get();

		$new_visitor = FALSE;

		if($result->num_rows() == 1)
		{
			$visitor = $result->row_array();
			$visitor_id = $visitor['visitor_id'];
		}
		else
		{
			$this->db->set('usuario_id', $usuario_id);
			$this->db->set('visitor_agent', $agent);
			$this->db->set('visitor_platform', $platform);
			$this->db->set('visitor_user_agent_string', $user_agent);
			$this->db->set('visitor_ip_address', $ip_address);
			$this->db->set('visitor_is_mobile', $is_mobile);
			$this->db->set('visitor_is_browser', $is_browser);
			$this->db->set('visitor_is_robot', $is_robot);
			$this->db->insert($this->visitor_table);
			$visitor_id = $this->db->insert_id();

			$new_visitor = TRUE;
		}

		if($new_visitor)
		{
			$this->db->set('visit_entry_visit_id', '');
		}
		else
		{
			$this->db->from($this->visit_table);
			$this->db->where('visit_visitor_id', $visitor_id);
			$this->db->order_by('visit_visit_date', 'desc');
			$this->db->limit(1);
			$result = $this->db->get();
			if($result->num_rows() == 1)
			{
				$visit = $result->row_array();
				$this->db->set('visit_entry_visit_id', $visit['visit_id']);
			}
			else
			{
				$this->db->set('visit_entry_visit_id', '');
			}
		}

		$this->db->set('visit_visitor_id', $visitor_id);
		$this->db->set('visit_visit_date', 'NOW()', FALSE);
		$this->db->set('visit_uri', uri_string());
		$this->db->insert($this->visit_table);

		return TRUE;
	}
	
	function prepend_zero($value)
	{
		if(strlen($value) == 1)
		{
			return '0'.$value;
		}
		else
		{
			return $value;
		}
	}
	
	function filter($usuario_id = NULL, $grupo_id = NULL, $page = NULL, $from_date = NULL, $to_date = NULL){
		
		if ($usuario_id == NULL) {
			$this->db->select('*', FALSE);
			$this->db->from($this->visitor_table);
			$this->db->join($this->visit_table, 'visit_visitor_id = visitor_id');
			$this->db->join('usuarios', 'usuarios.usuario_id = visitor.usuario_id');
			
			// filter to user if necessary
			if ($usuario_id != NULL && is_numeric($grupo_id)) {
				$this->db->where('usuarios.usuario_id', $usuario_id);
			}
			
			// filter to group if necessary
			if ($grupo_id != NULL && is_numeric($grupo_id)) {
				$this->db->where('usuarios.grupo_id', $grupo_id);
			}

			// filter to from_date if necessary
			if ($from_date != NULL) {
				$this->db->where('visit_visit_date >= ', $from_date.' 00:00:00');
			}

			// filter to to_date if necessary
			if ($to_date != NULL) {
				$this->db->where('visit_visit_date <= ', $to_date.' 23:59:59');
			}
			
			$this->db->order_by('visit_visit_date', 'desc');
			
			if (isset($page) && is_array($page)) {
				$this->db->limit($page[0], $page[1]);
			}
			
			$query = $this->db->get();
			if ($query->num_rows() > 0){
				return $query->result();
			} else {
				$this->lasterr = 'None!';
				return FALSE;
			}
			
		} else {
			
			if (!is_numeric($usuario_id)) {
				return FALSE;
			}
			
			$this->db->select('*', FALSE);
			$this->db->from($this->visitor_table);
			$this->db->join($this->visit_table, 'visit_visitor_id = visitor_id');
			$this->db->join('usuarios', 'usuarios.usuario_id = visitor.usuario_id');
			$this->db->where('usuarios.usuario_id', $usuario_id);
			$this->db->limit(10);
			$this->db->order_by('visit_visit_date', 'desc');
			$query = $this->db->get();
			if($query->num_rows() != 0){
				return $query->result();
			} else {
				return FALSE;
			}
			
		}
		
	}
}