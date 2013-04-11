<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Settings
{

    var $CI;
    var $lasterr;

    function Settings()
    {
        // Load original CI object
        $this->CI = &get_instance();
    }

    function get_all()
    {

        $sql = 'SELECT * FROM `config` LIMIT 1';
        $query = $this->CI->db->query($sql);
        if ($query->num_rows() == 1)
        {
            return $query->row();
        } else
        {
            $this->lasterr = 'No results found!';
            return false;
        }
    }
	
	function salvar($data)
    {
	
		$table = 'config';
		return $this->CI->db->update($table, $data);
    
	}
	
	function salvar_bkp($type = null, $data = null)
    {
        if ($data == null || !is_array($data))
        {
            $this->lasterr = 'Salvar function was not called with a data array.';
            return false;
        }

        $table = 'config';

        return $this->CI->db->update($table, $data);
    }
	
}