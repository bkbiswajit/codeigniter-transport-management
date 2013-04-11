<?php
	/**
	* Função para validar CNPJ (Cadastro Nacional da Pessoa Jurídica)
	*
	* @author     Paulo Freitas <paulofreitas.web@gmail.com>
	* @version    20100404
	* @copyright  2005-2010 Paulo Freitas
	* @license    http://creativecommons.org/licenses/by-sa/3.0
	* @param     string $cnpj CNPJ que deseja validar
	* @return    bool true caso seje válido, false caso não seje válido
	*/

	function checkCNPJ($cnpj)
	{
		$cnpj = str_pad(ereg_replace('[^0-9]', '', $cnpj), 14, '0', STR_PAD_LEFT);

		if (strlen($cnpj) != 14) {
			return false;
		} else {
			for ($t = 12; $t < 14; $t++) {
				for ($d = 0, $p = $t - 7, $c = 0; $c < $t; $c++) {
					$d += $cnpj{$c} * $p;
					$p   = ($p < 3) ? 9 : --$p;
				}

				$d = ((10 * $d) % 11) % 10;

				if ($cnpj{$c} != $d) {
					return false;
				}
			}

			return true;
		}
	}
	
	function validarCNPJ($cnpj)
	{
		$cnpj = str_pad(str_replace(array(
			'.',
			'-',
			'/'), '', $cnpj), 14, '0', STR_PAD_LEFT);
		if (strlen($cnpj) != 14)
		{
			return false;
		}
		else
		{
			for ($t = 12; $t < 14; $t++)
			{
				for ($d = 0, $p = $t - 7, $c = 0; $c < $t; $c++)
				{
					$d += $cnpj{$c} * $p;
					$p = ($p < 3)?9:--$p;
				}
				$d = ((10 * $d) % 11) % 10;
				if ($cnpj{$c} != $d)
				{
					return false;
				}
			}
			return true;
		}
	}
	
	function validarCPF($cpf)
	{
		$cpf = str_pad(str_replace(array(
			'.',
			'-',
			'/'), '', $cpf), 11, '0', STR_PAD_LEFT);
		$invalidos = array(
			'00000000000',
			'11111111111',
			'22222222222',
			'33333333333',
			'44444444444',
			'55555555555',
			'66666666666',
			'77777777777',
			'88888888888',
			'99999999999');
		if (strlen($cpf) != 11 || in_array($cpf, $invalidos))
		{
			return false;
		}
		else
		{ // Calcula os números para verificar se o CPF é verdadeiro
			for ($t = 9; $t < 11; $t++)
			{
				for ($d = 0, $c = 0; $c < $t; $c++)
				{
					$d += $cpf{$c} * (($t + 1) - $c);
				}
				$d = ((10 * $d) % 11) % 10;
				if ($cpf{$c} != $d)
				{
					return false;
				}
			}
			return true;
		}
	}
