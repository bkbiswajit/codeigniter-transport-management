<div class="grid_4">
	<div class="box"> 
		<h2> 
			<a id="toggle-infologin">Informações</a> 
		</h2>
		<p align="center">
			<br />
			<?php
				$gravatar = get_gravatar($usuario->email, '100');
				echo img($gravatar);
				
			?>
		</p>
	</div>
</div>
<?php 
	$errors = validation_errors(); 
	if($errors){
		echo '<div class="grid_12"><div class="box_error"><a><h2>' . $errors . '<h2></a></div></div>';
	}
?>
<div class="grid_8">
	<div class="box">
		<h2>
			<a href="#" id="toggle-forms"><?php echo $pagetitle; ?></a>
		</h2>
		<div class="block" id="forms">
			<?php echo form_open('sistema/conta/editar_salvar', NULL); $t = 1; ?>
				<fieldset class="login">
					<legend>Editar Usuário</legend>
					<table class="form" cellpadding="6" cellspacing="0" border="0" width="100%">
						<tr>
							<td class="caption">
								<label for="nomecompleto" accesskey="D"><u>N</u>ome Completo: </label>
							</td>
							<td class="field">
								<?php
								unset($input);
								$input['accesskey'] = 'D';
								$input['name'] = 'nomecompleto';
								$input['id'] = 'nomecompleto';
								$input['size'] = '50';
								$input['maxlength'] = '255';
								$input['tabindex'] = $t;
								$input['value'] = @set_value('nomecompleto', $usuario->nomecompleto);
								echo form_input($input);
								$t++;
								?>
							</td>
						</tr>
						<tr>
							<td class="caption">
								<label for="email" accesskey="E"><u>E</u>-mail: </label>
							</td>
							<td class="field">
								<?php
								unset($input);
								$input['accesskey'] = 'E';
								$input['name'] = 'email';
								$input['id'] = 'email';
								$input['size'] = '50';
								$input['maxlength'] = '100';
								$input['tabindex'] = $t;
								$input['value'] = @set_value('email', $usuario->email);
								echo form_input($input);
								$t++;
								?>
							</td>
						</tr>
						<?php
						if($usuario_id == NULL){
							$submittext = 'Adicionar usuario';
						} else {
							$submittext = 'Salvar usuario';
						}
						unset($buttons);
						$buttons[] = array('submit', 'positive', $submittext, 'disk1.gif', $t);
						$this->load->view('parts/buttons', array('buttons' =>$buttons));
						?>
					</table>
				</fieldset>
			<?php echo form_close();?>
		</div>
	</div>
</div>
<div class="grid_4">
	<div class="box">
		<h2>
			<a id="toggle-infocadastro">Informações</a>
		</h2>
		<div class="block" id="infocadastro">
			<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
			<p>Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</p>
		</div>
	</div>
</div>

<?php
/**
 * Get either a Gravatar URL or complete image tag for a specified email address.
 *
 * @param string $email The email address
 * @param string $s Size in pixels, defaults to 80px [ 1 - 2048 ]
 * @param string $d Default imageset to use [ 404 | mm | identicon | monsterid | wavatar ]
 * @param string $r Maximum rating (inclusive) [ g | pg | r | x ]
 * @param boole $img True to return a complete IMG tag False for just the URL
 * @param array $atts Optional, additional key/value attributes to include in the IMG tag
 * @return String containing either just a URL or a complete image tag
 * @source http://gravatar.com/site/implement/images/php/
 */
function get_gravatar( $email, $s = 80, $d = 'mm', $r = 'g', $img = false, $atts = array() ) {
	$url = 'http://www.gravatar.com/avatar/';
	$url .= md5( strtolower( trim( $email ) ) );
	$url .= "?s=$s&d=$d&r=$r";
	if ( $img ) {
		$url = '<img src="' . $url . '"';
		foreach ( $atts as $key => $val )
			$url .= ' ' . $key . '="' . $val . '"';
		$url .= ' />';
	}
	return $url;
}
?>