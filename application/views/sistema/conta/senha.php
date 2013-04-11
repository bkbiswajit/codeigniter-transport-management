<div class="grid_4"> 
	<div class="box"> 
		<h2> 
			<a id="toggle-infologin">Informações</a> 
		</h2> 
		<div class="block" id="infologin"> 
			<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p> 
			<p>Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</p> 
		</div> 
	</div>
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
			<?php echo form_open('conta/salvar_editar', NULL); $t = 1; ?>
				<fieldset class="login">
					<legend>Editar Usuário</legend>
						<table class="form" cellpadding="6" cellspacing="0" border="0" width="100%">
							<tr>
								<td class="caption">
									<label for="password1" class="r" accesskey="P"><u>S</u>enha</label>
								</td>
								<td class="field">
									<?php
									unset($input);
									$input['accesskey'] = 'P';
									$input['name'] = 'password1';
									$input['id'] = 'password1';
									$input['size'] = '30';
									$input['maxlength'] = '104';
									$input['tabindex'] = $t;
									$input['autocomplete'] = 'off';
									echo form_password($input);
									$t++;
									?>
								</td>
							</tr>
							<tr>
								<td class="caption">
									<label for="password2" class="r" accesskey="W">Repetir <u>S</u>enha</label>
								</td>
								<td class="field">
									<?php
									unset($input);
									$input['accesskey'] = 'W';
									$input['name'] = 'password2';
									$input['id'] = 'password2';
									$input['size'] = '30';
									$input['maxlength'] = '104';
									$input['tabindex'] = $t;
									$input['autocomplete'] = 'off';
									echo form_password($input);
									$t++;
									?>
								</td>
							</tr>
							<tr>
								<td class="caption">
									<label for="email" accesskey="E"><u>E</u>-mail </label>
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
							<tr>
								<td class="caption">
									<label for="nomecompleto" accesskey="D"><u>N</u>ome Completo</label>
								</td>
								<td class="field">
									<?php
									unset($input);
									$input['accesskey'] = 'D';
									$input['name'] = 'nomecompleto';
									$input['id'] = 'nomecompleto';
									$input['size'] = '30';
									$input['maxlength'] = '64';
									$input['tabindex'] = $t;
									$input['value'] = @set_value('nomecompleto', $usuario->nomecompleto);
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
							#$buttons[] = array('submit', '', 'Salvar and adicionar another', 'adicionar.gif', $t+1);
							#$buttons[] = array('cancel', 'negative', 'Cancelar', 'arr-left.gif', $t+2, site_url('sistema/usuarios'));
							$this->load->view('parts/buttons', array('buttons' => $buttons));
							?>
						</table>
					</fieldset>
			</form>
		</div>
	</div>
</div>