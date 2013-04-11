<?php
function brl($real)
{
	if($real == NULL){
		return NULL;
	}else{
		return 'R$ ' . number_format($real, 2, ',', '.');
	}
}
?>