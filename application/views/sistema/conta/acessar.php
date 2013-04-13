<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<?php $title = (!isset($title)) ? '' : $title; ?><title><?php $settings = $this->settings->get_all('main'); echo $settings->nome; ?></title>
		<link rel="shortcut icon" href="<?php echo $this->config->item('base_url').''; ?>/images/favicon/statistics.ico" type="image/x-icon" />
		<link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('base_url').''; ?>css/reset.css" media="screen" />
		<link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('base_url').''; ?>css/text.css" media="screen" />
		<link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('base_url').''; ?>css/grid.css" media="screen" />
		<link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('base_url').''; ?>css/nav.css" media="screen" />
		<link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('base_url').''; ?>css/layout.css" media="screen" />
		<link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('base_url').''; ?>css/fb-buttons/fb-buttons.css" media="screen" />
		<!--[if IE 6]><link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('base_url').''; ?>css/ie6.css" media="screen" /><![endif]-->
		<!--[if IE 7]><link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('base_url').''; ?>css/ie.css" media="screen" /><![endif]-->
		<script src="<?php echo $this->config->item('base_url').''; ?>js/jquery-1.3.2.min.js" type="text/javascript"></script>
	</head>
	
	<body>
		<div class="container_16">
			<div class="clear"></div><br />
			
			<div class="grid_6"><div>&nbsp;</div></div>

			<?php  $t = 1; ?>

			<div class="grid_4">
				<div class="box">
					<h2 align="center"> 
						<a href="#" id="toggle-login-forms"><?php echo $settings->nome;?></a>
					</h2> 
					<div class="block" id="login-forms">
						<?php echo form_open('sistema/conta/acessando', array('id' => 'acessar'), array('uri' => $this->session->userdata('uri'))); ?>
						<div class="block" id="infologin" <?php if(!validation_errors()){ echo 'style="display:none;color:#B90000"';} ?> style="color:#B90000;">
							<?php if(validation_errors()){ echo $this->msg->val_err('<ul>' . validation_errors() . '</ul>');}?>
						</div>
							<fieldset class="login"> 
								<legend>Entrar</legend>
								<p> 
									<label>CPF:</label>
									<?php
										unset($input);
										$input['accesskey'] = 'U';
										$input['name'] = 'cpf';
										$input['id'] = 'cpf';
										$input['size'] = '30';
										$input['maxlength'] = '104';
										$input['tabindex'] = $t;
										$input['value'] = @set_value('cpf');
										echo form_input($input);
										$t++;
									?>
								</p> 
								<p> 
									<label>Senha:</label>
									<?php
										unset($input);
										$input['accesskey'] = 'P';
										$input['name'] = 'password';
										$input['id'] = 'password';
										$input['size'] = '30';
										$input['maxlength'] = '104';
										$input['tabindex'] = $t;
										echo form_password($input);
										$t++;
									?>
								</p> 
								<input class="button uibutton" type="submit" value="Entrar" tabindex="<?php echo $t++ ?>" />
							</fieldset>
						</form>
					</div>
				</div>
			</div>
		<div class="grid_6"><div>&nbsp;</div></div>
		<div class="clear"></div>
	</body>
</html>