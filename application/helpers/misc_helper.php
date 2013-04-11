<?php

	function str2camelcase($str) {
	  // Split string in words.
	  $words = explode(' ', strtolower($str));

	  $str = '';
	  foreach ($words as $word) {
		$str .= ucfirst($word.' ');
	  }

	  return $str;
	}
	/*
	function str2uppercase($str) {
		return strtoupper($str);
	}
	*/
	function datepicker(){
		$str = 
		'<script src="'.base_url().'js/jquery-ui-1.9.2.custom/js/jquery-1.8.3.js" type="text/javascript"></script>
<script src="'.base_url().'js/jquery-ui-1.9.2.custom/js/jquery-ui-1.9.2.custom.min.js" type="text/javascript"></script>
<script src="'.base_url().'js/jquery_ui_datepicker/i18n/ui.datepicker-pt-BR.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="'.base_url().'js/jquery-ui-1.9.2.custom/css/smoothness/jquery-ui-1.9.2.custom.min.css">
		';

		return $str;
	}
	
	function str2uppercase($term, $tp = 1) {
		return mb_strtoupper($term, 'UTF-8');
	}