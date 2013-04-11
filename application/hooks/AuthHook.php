<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');class AuthHook{
	
	var $CI;
    
	function AuthHook(){
		// Load original CI object to global CI variable
		$this->CI =& get_instance();
		
		// Load cookie helper as required by this library
		$this->CI->load->helper('cookie');
		
		#$this->CI->config->set_item('cookie_prefix', $_SERVER['SERVER_NAME']);
		
		// Timeout in minutes of an 'active' logged in user.
		$this->timeout = 1;
		
    }
	
	/**
	 * Check for a cookie - if so, acessar with it
	 */
	function cookiecheck(){
		$this->CI->load->helper('cookie');
		$cookie['crbs_key'] = get_cookie('crbs_key');
		$cookie['usuario_id'] = get_cookie('crbs_user_id');
		if($cookie['crbs_key'] != FALSE && !$this->CI->session->userdata('usuario_id')){
			$this->CI->auth->cookielogin($cookie['crbs_key']);
		}
	}
	
	/**
	 * Update timestamp for user activity.
	 * Remove expired usuarios
	 */
	function activeuser(){
		
		if($this->CI->auth->logged_in() == TRUE){
			
			// Get the logged in user ID and current time
			$usuario_id = (int)$this->CI->session->userdata('usuario_id');
			$now = time();
			
			// Update the current user in the usuarios_ativos table
			$sql = 'REPLACE INTO usuarios_ativos VALUES(?, ?)';
			$query = $this->CI->db->query($sql, array($usuario_id, $now));
			
			// Update 'last activity' time in the usuarios table
			$sql = 'UPDATE usuarios SET ultimaatividade = NOW() WHERE usuario_id = ?';
			$query = $this->CI->db->query($sql, array($usuario_id));
			
			// Remove dead entries
			$expiretime = strtotime("-{$this->timeout} minutes");
			$sql = 'DELETE FROM usuarios_ativos WHERE timestamp < ?';
			$query = $this->CI->db->query($sql, array($expiretime));		
		}	
	}
}
/* End of file app/hooks/AuthHook.php */