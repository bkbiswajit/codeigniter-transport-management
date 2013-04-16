<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<?php $title = (!isset($title)) ? '' : $title; ?><title><?php $settings = $this->settings->get_all('main'); echo $settings->nome; ?></title>
		<link rel="shortcut icon" href="<?php echo $this->config->item('base_url').''; ?>images/favicon/tractorunitblack.ico" type="image/x-icon" />
		<link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('base_url').''; ?>css/reset.css" media="screen" />
		<link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('base_url').''; ?>css/text.css" media="screen" />
		<link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('base_url').''; ?>css/grid.css" media="screen" />
		<link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('base_url').''; ?>css/nav.css" media="screen" />
		<link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('base_url').''; ?>css/layout.css" media="screen" />
		<link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('base_url').''; ?>css/fb-buttons/fb-buttons.css" media="screen" />
		<!--[if IE 6]><link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('base_url').''; ?>css/ie6.css" media="screen" /><![endif]-->
		<!--[if IE 7]><link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('base_url').''; ?>css/ie.css" media="screen" /><![endif]-->
		<script src="<?php echo $this->config->item('base_url').''; ?>js/jquery-1.3.2.min.js" type="text/javascript"></script>
		<script>
			$(function() {
				// setTimeout() function will be fired after page is loaded
				// it will wait for 5 sec. and then will fire
				// $("#myAlert").hide() function
				setTimeout(function() {
					$("#myAlert").hide();
				}, 4000);
			});
		</script>
	</head>
	<body>
		<div class="container_16">
			<div class="grid_16">
				<h2 id="branding">
					<a href=""><?php $settings = $this->settings->get_all('main'); ?></a>
					<?php echo anchor('painel', $settings->nome); ?>
				</h2>
			</div>
			<div class="clear"></div><br />
			<div class="grid_16">
			<?php if($this->auth->logged_in()){?>
				<ul class="nav main">
					<li>
						<?php if($this->auth->check('painel', TRUE)){ echo anchor('painel','Painél') ;} ?>
					</li>
					<li>
						<?php if($this->auth->check('painel', TRUE)){ echo anchor('contabilidade/','Cadastros') ;} ?>
						<ul>
							<?php if($this->auth->check('painel', TRUE)){ echo '<li>'.anchor('contabilidade/clientes','Clientes').'</li>' ;} ?>
							<?php if($this->auth->check('painel', TRUE)){ echo '<li>'.anchor('contabilidade/clientes/adicionar','+ Clientes').'</li>' ;} ?>
							<?php if($this->auth->check('painel', TRUE)){ echo '<li>'.anchor('contabilidade/transportadoras','Transportadoras').'</li>' ;} ?>
							<?php if($this->auth->check('painel', TRUE)){ echo '<li>'.anchor('contabilidade/transportadoras/adicionar','+ Transportadora').'</li>' ;} ?>
							<?php if($this->auth->check('painel', TRUE)){ echo '<li>'.anchor('contabilidade/frotas','Frotas').'</li>' ;} ?>
							<?php if($this->auth->check('painel', TRUE)){ echo '<li>'.anchor('contabilidade/frotas/adicionar','+ Frotas').'</li>' ;} ?>
							<?php if($this->auth->check('painel', TRUE)){ echo '<li>'.anchor('contabilidade/motoristas','Motoristas').'</li>' ;} ?>
							<?php if($this->auth->check('painel', TRUE)){ echo '<li>'.anchor('contabilidade/motoristas/adicionar','+ Motoristas').'</li>' ;} ?>
							<?php if($this->auth->check('painel', TRUE)){ echo '<li>'.anchor('contabilidade/postos','Postos').'</li>' ;} ?>
							<?php if($this->auth->check('painel', TRUE)){ echo '<li>'.anchor('contabilidade/postos/adicionar','+ Postos').'</li>' ;} ?>
							<?php if($this->auth->check('painel', TRUE)){ echo '<li>'.anchor('contabilidade/controle_de_viagem_despesas_tipos','CV Despesas Tipos').'</li>' ;} ?>
							<?php if($this->auth->check('painel', TRUE)){ echo '<li>'.anchor('contabilidade/controle_de_viagem_despesas_tipos/adicionar','+ CV Despesas Tipos').'</li>' ;} ?>
							<?php if($this->auth->check('painel', TRUE)){ echo '<li>'.anchor('contabilidade/controle_de_viagem_origem_destino','CV Origem/Destino').'</li>' ;} ?>
							<?php if($this->auth->check('painel', TRUE)){ echo '<li>'.anchor('contabilidade/controle_de_viagem_origem_destino/adicionar','+ CV Origem/Destino').'</li>' ;} ?>
							
							
						</ul>
					</li>
					<li>
						<?php if($this->auth->check('painel', TRUE)){ echo anchor('contabilidade/controle_de_viagem_agenda','Agenda de Viagem') ;} ?>
						<ul>
							<?php if($this->auth->check('painel', TRUE)){ echo '<li>'.anchor('contabilidade/controle_de_viagem_agenda','Agenda de Viagem').'</li>' ;} ?>
							<?php if($this->auth->check('painel', TRUE)){ echo '<li>'.anchor('contabilidade/controle_de_viagem_agenda/adicionar','+ Agenda de Viagem').'</li>' ;} ?>
						</ul>
					</li>
					<li>
						<?php if($this->auth->check('painel', TRUE)){ echo anchor('contabilidade/controle_de_viagem','Controle de Viagem') ;} ?>
						<ul>
							<?php if($this->auth->check('painel', TRUE)){ echo '<li>'.anchor('contabilidade/controle_de_viagem','Controle de Viagem').'</li>' ;} ?>
							<?php if($this->auth->check('painel', TRUE)){ echo '<li>'.anchor('contabilidade/controle_de_viagem/adicionar','+ Controle de Viagem').'</li>' ;} ?>
						</ul>
					</li>
					<li>
						<?php if($this->auth->check('painel', TRUE)){ echo anchor('contabilidade/relatorios','Relatórios') ;} ?>
					</li>
					<li>
						<?php if($this->auth->check('painel', TRUE)){ echo anchor('contabilidade/recebimentos','Recebimentos&nbsp;') ;} ?>
						<ul>
							<?php if($this->auth->check('painel', TRUE)){ echo anchor('contabilidade/recebimentos/adicionar','+ Recebimento') ;} ?>
						</ul>
					</li>

					<li class="secondary_red">
						<?php if($this->auth->logged_in()){ echo anchor('sistema/conta/sair', 'Sair');} ?>
					</li>
					<li class="secondary">
						<?php if($this->auth->check('sistema', TRUE)){ echo anchor('sistema/geral','Configurações') ;} ?>
						<ul>
							<?php if($this->auth->check('sistema.geral', TRUE)){ echo '<li>'.anchor('sistema/geral','Geral').'</li>' ;} ?>
							<?php if($this->auth->check('usuarios', TRUE)){ echo '<li>'.anchor('sistema/usuarios','Usuários').'</li>' ;} ?>
							<?php if($this->auth->check('grupos', TRUE)){ echo '<li>'.anchor('sistema/grupos','Grupos').'</li>' ;} ?>
							<?php if($this->auth->check('sistema.permissoes', TRUE)){ echo '<li>'.anchor('sistema/permissoes','Permissões').'</li>' ;} ?>
							<?php if($this->auth->check('usuarios.rastrear', TRUE)){ echo '<li>'.anchor('sistema/rastreador','Rastreador').'</li>' ;} ?>
						</ul>
					</li>
					<li class="secondary">
						<?php if($this->auth->logged_in()){ echo anchor('sistema/conta', $this->session->userdata('nome_ou_cpf')) ;} ?>
						<ul>
							<?php if($this->auth->check('conta', TRUE)){ echo '<li>'.anchor('sistema/conta/editar','Editar Conta').'</li>' ;} ?>
							<?php if($this->auth->check('conta', TRUE)){ echo '<li>'.anchor('sistema/rastreador/usuario/'.$this->session->userdata('usuario_id'),'Rastrear Atividade').'</li>' ;} ?>
						</ul>
					</li>
					<!--
					<li class="secondary">
						<?php if($this->auth->logged_in()){ $now = now(); $now = timestamp2datetime($now); echo '<a href="#">'.mysqlhuman($now).'</a>';} ?>
					</li>
					-->
				</ul>
			</div>
			<?php } ?>
			<div class="clear"></div>

			<div class="grid_16"><p></p></div>

			<div class="clear"></div>
			
			<div id="myAlert">
				<?php echo (isset($alert)) ? $alert : $this->session->flashdata('flash'); ?>
			</div>
			
			<?php $msg = NULL; ?>
			<?php if($msg != NULL){echo '<div id="msg" class="box_info grid_16" style="padding:0;"><h2 style="margin:0; text-align: center "><strong>'.$msg.'</strong></h2></div>';} ?>

			<div class="clear"></div>

			<?php echo (isset($body)) ? $body : '<div class="grid_16"><div class="box"><a><h1 align="center">EM CONSTRUÇÃO</h1></a></div></div>'; ?>

			<div class="clear"></div>
			<div class="grid_16" id="site_info">
				<div class="box">
					<p>Tempo total de execução: <a href="#"><?php echo $this->benchmark->elapsed_time() ?></a> segundos. Uso da Memória: <a href="#"><?php echo $this->benchmark->memory_usage() ?></a>.</p>
					<?php echo $settings->endereco . '<br />'; ?>
					<?php echo safe_mailto($settings->email) . '<br />'; ?>
					<?php echo $settings->telefone . '<br />'; ?>
					<?php echo $settings->cnpj . '<br />'; ?>
					<?php //echo $settings->incricao_estadual . '<br />'; ?>
				</div>
			</div>
			<div class="clear"></div>
	</body>
</html>