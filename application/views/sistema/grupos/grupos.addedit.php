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
			<a href="#" id="toggle-forms">Editar Grupo</a>
		</h2>
		<div class="block" id="forms">
			<?php echo form_open('sistema/grupos/salvar', NULL, array('grupo_id' => $grupo_id)); $t = 1; ?>
			<?php if($grupo_id == NULL){ ?> <p>Please fill in the required fields below to adicionar a new group to the system.</p> <?php } ?>
				<table class="form" cellpadding="6" cellspacing="0" border="0" width="100%">
					<tr>
						<td class="caption">
							<label for="nome" class="r" accesskey="N"><u>N</u>ome: </label>
						</td>
						<td class="field">
							<?php
							unset($input);
							$input['accesskey'] = 'N';
							$input['name'] = 'nome';
							$input['id'] = 'nome';
							$input['size'] = '30';
							$input['maxlength'] = '20';
							$input['tabindex'] = $t;
							$input['autocomplete'] = 'off';
							$input['value'] = @set_value($input['nome'], $group->nome);
							echo form_input($input);
							$t++;
							?>
						</td>
					</tr>
					
					<tr>
						<td class="caption">
							<label for="description" class="r" accesskey="D"><u>D</u>escrição: </label>
						</td>
						<td class="field">
							<?php
							unset($input);
							$input['accesskey'] = 'D';
							$input['name'] = 'description';
							$input['id'] = 'description';
							$input['cols'] = '50';
							$input['rows'] = '4';
							$input['maxlength'] = '255';
							$input['tabindex'] = $t;
							$input['autocomplete'] = 'off';
							$input['value'] = @set_value($input['description'], $group->description);
							echo form_textarea($input);
							$t++;
							?>
						</td>
					</tr>
					
					<tr>
						<td class="caption">
							<label>Ativo: </label>
						</td>
						<td class="field">
							<label for="ativo" class="check">
							<?php
							unset($check);
							$check['name'] = 'ativo';
							$check['id'] = 'ativo';
							$check['value'] = '1';
							$check['checked'] = @set_checkbox($check['name'], $check['value'], ($group->ativo == 1));
							$check['tabindex'] = $t;
							echo form_checkbox($check);
							$t++;
							?>
							</label>
							
						</td>
					</tr>
					<?php
					if($grupo_id == NULL){
						$submittext = 'Adicionar group';
					} else {
						$submittext = 'Salvar group';
					}
					unset($buttons);
					$buttons[] = array('submit', 'positive', $submittext, '', $t);
					#$buttons[] = array('submit', '', 'Salvar and adicionar another', 'adicionar.gif', $t+1);
					$buttons[] = array('cancel', 'negative', 'Cancelar', '', $t+2, site_url('sistema/grupos'));
					$this->load->view('parts/buttons', array('buttons' => $buttons));
					?>

				</table>
			</form>
		</div>
	</div>
</div>