<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	function conta_completo($usuario_id)
	{
		$CI =& get_instance();
		
		$sql = 'SELECT * FROM usuarios WHERE usuario_id = '.$usuario_id.'';
		$query	= $CI->db->query($sql);
		$rows	= $query->result_array();
		
		if(sizeof($rows) == 1)
		{
			if(empty( $rows[0]['nome']) || empty( $rows[0]['biodata']))
			{
				return TRUE;
			}
		}
		
		return FALSE;
	}
/* End of file sql_helper.php */
/* Location: ./system/helpers/formulario_helper.php */