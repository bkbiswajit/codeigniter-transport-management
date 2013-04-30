<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	function mysqlhuman($d, $f = "d/m/Y, H:i:s", $n = 'NUNCA'){

		if($d == '0000-00-00 00:00:00'){
		
			$r = $n;
		
		} elseif($d == NULL){
		
			$r = $n;
		
		}else{
		
			$r = date($f, strtotime($d));
		
		}

		return $r;
	}

	function mysqlhumantime($d, $f = "H:i:s", $n = 'NUNCA'){

		if($d == '0000-00-00 00:00:00'){
			$r = $n;
		} elseif($d == NULL){
			$r = $n;
		}else{
			$r = date($f, strtotime($d));
		}

		return $r;
	}

	function mysql2human($d, $f = "d/m/Y", $n = ''){
		
		if ($d == NULL){
			$r = $n;
			return $r;
		}
		
		if($d == '0000-00-00'){
			
			$r = $n;
			
		}else{

			$r = date($f, strtotime($d));
		}

		return $r;
	}

	function human2mysql($d){
		if($d==null){
			return date('Y-m-d');
		}
		else{
			list($var_d, $var_m, $var_y) = explode("/",$d);
			$d= $var_y."-".$var_m."-".$var_d;
			return $d;
		}
	}

	function time2seconds($time='00:00:00'){

		list($hr,$m,$s) = explode(':', $time);
		return ( (int)$hr*3600 ) + ( (int)$m*60 ) + (int)$s;

	}

	function datetime2timestamp($datetime){

		$val = explode(" ",$datetime);
		$date = explode("-",$val[0]);
		$time = explode(":",$val[1]);

		return mktime($time[0],$time[1],$time[2],$date[1],$date[2],$date[0]);

	}

	function timestamp2datetime($timestamp){

		$datetime = date("Y-m-d H:i:s", $timestamp);
		return $datetime;

	}

	function dateandtime2timestamp($ymd, $hms){

		$datearr = explode('-', $ymd);
		$timearr = explode(':', $hms);
		return mktime($timearr[0], $timearr[1], $timearr[2], $datearr[1], $datearr[2], $datearr[0]);

	}

	function date2timestamp($ymd){

		$datearr = explode('-', $ymd);

		return mktime(0, 0, 0, $datearr[1], $datearr[2], $datearr[0]);

	}

	function todate($ymd){

		$datearr = explode('-', $ymd);

		return mktime(0, 0, 0, $datearr[1], $datearr[2], $datearr[0]);

	}

	function datetime(){

		return $today = date("Y-m-d H:i:s"); ;
	}

	function today(){

		return $today = date("Y-n-j"); ;

	}

	function formata_data($data)
	{
		//exemplo de data (seria o valor do campo data que vem do banco)
		//aqui utilizo a função date do php para pegar a data atual e simular um valor data
		//$data = '16/08/2010';
		//recebe o parâmetro e armazena em um array separado por -
		$data = explode('/', $data);
		//armazena na variavel data os valores do vetor data e concatena /
		$data = $data[2].'-'.$data[1].'-'.$data[0];

		//retorna a string da ordem correta, formatada
		return $data;
	}

	function minutes2seconds($minutes)
	{
		$seconds = $minutes * 60;

		return $seconds;
	}

	function escreve_data_simples($d, $f = "d/m/Y", $n = ''){

		if($d == '0000-00-00'){

			$r = $n;
		}else{

			$r = date($f, strtotime($d));
		}

		$data = $r;
	    $dataPorExtenso = "";
	    $meses = array( '01','janeiro',
					    '02' => 'fevereiro',
					    '03' => 'março',
					    '04' => 'abril',
					    '05' => 'maio',
					    '06' => 'junho',
					    '07' => 'julho',
					    '08' => 'agosto',
					    '09' => 'setembro',
					    '10' => 'outubro',
					    '11' => 'novembro',
					    '12' => 'dezembro');

	    if (strstr($data, "/")){
		    $A = explode ("/", $data);
		    $ano = $A[2];
		    $mes = $A[1];
		    $dia = $A[0];
	    }
	    else{
		    $A = explode ("-", $data);
		    $ano = $A[0];
		    $mes = $A[1];
		    $dia = $A[2];
	    }
	    return str_pad($dia, 2, '0', STR_PAD_LEFT) . ' de ' . $meses[$mes] . ' de ' . $ano;
    }
	
	function valid_date( $fecha )
	{
		// VALID FORMAT = yyyy-mm-dd
		if (ereg ("([0-9]{4})-([0-9]{2})-([0-9]{2})", $fecha, $fecha_array))
		{
			// VALID DATE IN CALENDAR
			return ( checkdate($fecha_array[2],$fecha_array[3],$fecha_array[1]) )
				? true
				: false ;
		}

		return false;
	}
	
	function validdate($str){
	if ( ereg("([0-9]{1,2})/([0-9]{1,2})/([0-9]{4})", $str) ) {
	   $arr = split("-",$str);// splitting the array
	   $yy = $arr[0];         //first element of the array is year
	   $mm = $arr[1];         //second element is month
	   $dd = $arr[2];         //third element is days
	   if( checkdate($mm, $dd, $yy) ); {
		  return true;
	   }
	   }else {
		   $this->form_validation->set_message('validdate', 'Check format of %s field.');
		   return FALSE;
	   }
	}

	function comma2dot($number){
		return str_replace(',', '.', $number);
	}

	function number2decimal($number){
		$number = str_replace(',', '.', $number);
		return number_format($number, 2, ".", "");
	}