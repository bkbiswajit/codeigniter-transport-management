<?php class Relatorios_model extends Model
{
	var $lasterr;
	function Relatorios_model()
	{
		parent::Model();
	}
	
	function transportadora($transportadora_id)
	{
		$sql = "select * 
from controle_de_viagem, controle_de_viagem_viagens, controle_de_viagem_regioes, controle_de_viagem_origem,controle_de_viagem_destino, transportadoras, frotas, motoristas
where controle_de_viagem.controle_de_viagem_id=controle_de_viagem_viagens.controle_de_viagem_viagens_controle_de_viagem_viagens_id
and controle_de_viagem.controle_de_viagem_motorista_id=motoristas.motoristas_id
and controle_de_viagem.controle_de_viagem_caminhao_id=frotas.caminhoes_id
and controle_de_viagem.controle_de_viagem_transportadoras_id=transportadoras.transportadoras_id
and controle_de_viagem_destino.controle_de_viagem_destino_regiao_id=controle_de_viagem_regioes.controle_de_viagem_regioes_id
and controle_de_viagem_viagens.controle_de_viagem_viagens_origem_id=controle_de_viagem_origem.controle_de_viagem_origem_id
and controle_de_viagem_viagens.controle_de_viagem_viagens_destino_id=controle_de_viagem_destino.controle_de_viagem_destino_id
and controle_de_viagem.controle_de_viagem_transportadoras_id=$transportadora_id";
		
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			$this->lasterr = 'NO';
			return 0;
		}
	}
	
	function caminhao($caminhao_id)
	{
		$sql = "select * 
from controle_de_viagem, controle_de_viagem_viagens, controle_de_viagem_regioes, controle_de_viagem_origem,controle_de_viagem_destino, transportadoras, frotas, motoristas
where controle_de_viagem.controle_de_viagem_id=controle_de_viagem_viagens.controle_de_viagem_viagens_controle_de_viagem_viagens_id
and controle_de_viagem.controle_de_viagem_motorista_id=motoristas.motoristas_id
and controle_de_viagem.controle_de_viagem_caminhao_id=frotas.caminhoes_id
and controle_de_viagem.controle_de_viagem_transportadoras_id=transportadoras.transportadoras_id
and controle_de_viagem_destino.controle_de_viagem_destino_regiao_id=controle_de_viagem_regioes.controle_de_viagem_regioes_id
and controle_de_viagem_viagens.controle_de_viagem_viagens_origem_id=controle_de_viagem_origem.controle_de_viagem_origem_id
and controle_de_viagem_viagens.controle_de_viagem_viagens_destino_id=controle_de_viagem_destino.controle_de_viagem_destino_id
and controle_de_viagem.controle_de_viagem_caminhao_id=$caminhao_id";
		
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			$this->lasterr = 'NO';
			return 0;
		}
	}
	
	function motorista($motorista_id)
	{
		$sql = "select * 
from controle_de_viagem, controle_de_viagem_viagens, controle_de_viagem_regioes, controle_de_viagem_origem,controle_de_viagem_destino, transportadoras, frotas, motoristas
where controle_de_viagem.controle_de_viagem_id=controle_de_viagem_viagens.controle_de_viagem_viagens_controle_de_viagem_viagens_id
and controle_de_viagem.controle_de_viagem_motorista_id=motoristas.motoristas_id
and controle_de_viagem.controle_de_viagem_caminhao_id=frotas.caminhoes_id
and controle_de_viagem.controle_de_viagem_transportadoras_id=transportadoras.transportadoras_id
and controle_de_viagem_destino.controle_de_viagem_destino_regiao_id=controle_de_viagem_regioes.controle_de_viagem_regioes_id
and controle_de_viagem_viagens.controle_de_viagem_viagens_origem_id=controle_de_viagem_origem.controle_de_viagem_origem_id
and controle_de_viagem_viagens.controle_de_viagem_viagens_destino_id=controle_de_viagem_destino.controle_de_viagem_destino_id
and controle_de_viagem.controle_de_viagem_motorista_id=$motorista_id";
		
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			$this->lasterr = 'NO';
			return 0;
		}
	}
	
	function motorista_sum($motorista_id)
	{
		$sql = "select sum(controle_de_viagem_viagens.controle_de_viagem_viagens_valor_frete) as sum
from controle_de_viagem, controle_de_viagem_viagens, controle_de_viagem_regioes, controle_de_viagem_origem,controle_de_viagem_destino, transportadoras, frotas, motoristas
where controle_de_viagem.controle_de_viagem_id=controle_de_viagem_viagens.controle_de_viagem_viagens_controle_de_viagem_viagens_id
and controle_de_viagem.controle_de_viagem_motorista_id=motoristas.motoristas_id
and controle_de_viagem.controle_de_viagem_caminhao_id=frotas.caminhoes_id
and controle_de_viagem.controle_de_viagem_transportadoras_id=transportadoras.transportadoras_id
and controle_de_viagem_destino.controle_de_viagem_destino_regiao_id=controle_de_viagem_regioes.controle_de_viagem_regioes_id
and controle_de_viagem_viagens.controle_de_viagem_viagens_origem_id=controle_de_viagem_origem.controle_de_viagem_origem_id
and controle_de_viagem_viagens.controle_de_viagem_viagens_destino_id=controle_de_viagem_destino.controle_de_viagem_destino_id
and controle_de_viagem.controle_de_viagem_motorista_id=$motorista_id";
		
		$query = $this->db->query($sql);
		if ($query->num_rows() == 1)
		{
			$motorista_sum = $query->row();
			return $motorista_sum;
		}
		else
		{
			return FALSE;
		}
	}
	
	function regiao($regiao_id)
	{
		$sql = "select * 
from controle_de_viagem, controle_de_viagem_viagens, controle_de_viagem_regioes, controle_de_viagem_origem,controle_de_viagem_destino, transportadoras, frotas, motoristas
where controle_de_viagem.controle_de_viagem_id=controle_de_viagem_viagens.controle_de_viagem_viagens_controle_de_viagem_viagens_id
and controle_de_viagem.controle_de_viagem_motorista_id=motoristas.motoristas_id
and controle_de_viagem.controle_de_viagem_caminhao_id=frotas.caminhoes_id
and controle_de_viagem.controle_de_viagem_transportadoras_id=transportadoras.transportadoras_id
and controle_de_viagem_destino.controle_de_viagem_destino_regiao_id=controle_de_viagem_regioes.controle_de_viagem_regioes_id
and controle_de_viagem_viagens.controle_de_viagem_viagens_origem_id=controle_de_viagem_origem.controle_de_viagem_origem_id
and controle_de_viagem_viagens.controle_de_viagem_viagens_destino_id=controle_de_viagem_destino.controle_de_viagem_destino_id
and controle_de_viagem_destino.controle_de_viagem_destino_regiao_id=$regiao_id";
		
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			$this->lasterr = 'NO';
			return 0;
		}
	}
	
	function cv_km($cvs_id)
	{
		$sql = "
		SELECT SUM(controle_de_viagem.controle_de_viagem_km_final - controle_de_viagem.controle_de_viagem_km_inicial) AS soma
		FROM controle_de_viagem
		WHERE controle_de_viagem.controle_de_viagem_id IN ($cvs_id)";
		
		$query = $this->db->query($sql);

		if($query->num_rows() == 1){
			$controle_de_viagem = $query->row();
			return $controle_de_viagem;
		} else {
			return FALSE;
		}
		
	}
	
	function cv_litros($cvs_id)
	{
		$sql = "
		SELECT SUM(controle_de_viagem_postos.controle_de_viagem_postos_litros) AS soma
		FROM controle_de_viagem_postos
		WHERE controle_de_viagem_postos.controle_de_viagem_postos_controle_de_viagem_viagens_id IN ($cvs_id)";
		
		$query = $this->db->query($sql);

		if($query->num_rows() == 1){
			$controle_de_viagem = $query->row();
			return $controle_de_viagem;
		} else {
			return FALSE;
		}
		
	}
	
	function cv_despesas($cvs_id)
	{
		$sql = "
		SELECT SUM(controle_de_viagem_despesas.controle_de_viagem_despesas_valor) AS soma
		FROM controle_de_viagem_despesas
		WHERE controle_de_viagem_despesas.controle_de_viagem_despesas_controle_de_viagem_viagens_id IN ($cvs_id)";
		
		$query = $this->db->query($sql);

		if($query->num_rows() == 1){
			$controle_de_viagem = $query->row();
			return $controle_de_viagem;
		} else {
			return FALSE;
		}
		
	}
	
	function cv_bonus($cvs_id, $clientes_id = NULL)
	{
		if($clientes_id != NULL){
			$clientes = "AND controle_de_viagem_viagens.controle_de_viagem_viagens_clientes_id IN ($clientes_id)";
		}else{
			$clientes = NULL;
		}
		
		$sql = "
		SELECT SUM((controle_de_viagem_viagens.controle_de_viagem_viagens_valor_frete + controle_de_viagem_viagens.controle_de_viagem_viagens_valor_frete * controle_de_viagem_viagens.controle_de_viagem_viagens_bonus/100)) AS soma
        FROM controle_de_viagem_viagens
        WHERE controle_de_viagem_viagens.controle_de_viagem_viagens_controle_de_viagem_viagens_id IN($cvs_id)
		$clientes";
		
		$query = $this->db->query($sql);

		if($query->num_rows() == 1){
			$controle_de_viagem = $query->row();
			return $controle_de_viagem;
		} else {
			return FALSE;
		}
		
	}
	
	function cv_comissao_motorista($cvs_id, $clientes_id = NULL)
	{
		if($clientes_id != NULL){
			$clientes = "AND controle_de_viagem_viagens.controle_de_viagem_viagens_clientes_id IN ($clientes_id)";
		}else{
			$clientes = NULL;
		}
		
		$sql = "
		SELECT SUM(controle_de_viagem_viagens.controle_de_viagem_viagens_valor_frete * motoristas.motoristas_comissao/100) AS soma
		FROM controle_de_viagem,controle_de_viagem_viagens, motoristas
		WHERE controle_de_viagem.controle_de_viagem_id=controle_de_viagem_viagens.controle_de_viagem_viagens_controle_de_viagem_viagens_id
		AND controle_de_viagem.controle_de_viagem_motorista_id=motoristas.motoristas_id
		$clientes
		AND controle_de_viagem_viagens.controle_de_viagem_viagens_controle_de_viagem_viagens_id IN ($cvs_id)";
		
		$query = $this->db->query($sql);

		if($query->num_rows() == 1){
			$controle_de_viagem = $query->row();
			return $controle_de_viagem;
		} else {
			return FALSE;
		}
		
	}
	
	function cv_bonus_motorista($cvs_id, $clientes_id = NULL)
	{
		if($clientes_id != NULL){
			$clientes = "AND controle_de_viagem_viagens.controle_de_viagem_viagens_clientes_id IN ($clientes_id)";
		}else{
			$clientes = NULL;
		}
		
		$sql = "
		SELECT SUM((controle_de_viagem_viagens.controle_de_viagem_viagens_valor_frete * motoristas.motoristas_comissao/100 + (controle_de_viagem_viagens.controle_de_viagem_viagens_valor_frete * controle_de_viagem_viagens.controle_de_viagem_viagens_bonus/100)* controle_de_viagem_viagens.controle_de_viagem_viagens_bonus/100)) AS soma
		FROM controle_de_viagem,controle_de_viagem_viagens, motoristas
		WHERE controle_de_viagem.controle_de_viagem_id=controle_de_viagem_viagens.controle_de_viagem_viagens_controle_de_viagem_viagens_id
		$clientes
		AND controle_de_viagem.controle_de_viagem_motorista_id=motoristas.motoristas_id
		AND controle_de_viagem_viagens.controle_de_viagem_viagens_controle_de_viagem_viagens_id IN($cvs_id)";
		
		$query = $this->db->query($sql);

		if($query->num_rows() == 1){
			$controle_de_viagem = $query->row();
			return $controle_de_viagem;
		} else {
			return FALSE;
		}
		
	}
	
}