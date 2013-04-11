<?php echo datepicker(); ?>
<script type="text/javascript">
	/* <![CDATA[ */
		$(function() {
				$('#postos_data_nascimento').datepicker({
					userLang	: 'pt-BR',
					americanMode: false,
				});
				$('#postos_data_admissao').datepicker({
					userLang	: 'pt-BR',
					americanMode: false,
				});		
				$('#postos_data_demissao').datepicker({
					userLang	: 'pt-BR',
					americanMode: false,
				});		
			});
	/* ]]&gt; */
</script>

<div class="grid_4">

	<div class="box"> 
		<h2> 
			<a id="toggle-infocadastro">Informações</a> 
		</h2> 
		<div class="block" id="infocadastro"> 
			<p></p>
		</div> 
	</div>
</div>

<?php 
	/*$errors = validation_errors(); 
	if($errors){
		echo '<div class="grid_12"><div class="box_error"><h2>' . $errors . '</h2></div></div>';
	}
	*/
?>

<div class="grid_12">
	<div class="box">
		<h2>
			<a href="#" id="toggle-forms">Editar posto</a>
		</h2>
		<div class="block" id="forms">
			<?php echo form_open('contabilidade/postos/salvar', NULL, array('postos_id' => $postos_id)); $t = 1; ?>

			<?php if($postos_id == NULL){ ?><?php } ?>

				<table class="form" cellpadding="6" cellspacing="0" border="0" width="100%">
					
					<tr>
						<td class="caption">
							<label for="postos_postos_cpf" class="r" accesskey="U">CNPJ</label>
							<span class="required">*</span>
						</td>
						<td class="field">
							<?php
							unset($input);
							$input['accesskey'] = 'U';
							$input['name'] = 'postos_cnpj';
							$input['id'] = 'postos_cnpj';
							$input['size'] = '50';
							$input['maxlength'] = '255';
							$input['tabindex'] = $t;
							$input['autocomplete'] = 'off';
							$input['value'] = @set_value('postos_cnpj', $postos->postos_cnpj);
							echo form_input($input);
							echo form_error('postos_cnpj');
							$t++;
							?>
						</td>
					</tr>
					
					<tr>
						<td class="caption">
							<label for="postos_postos_descricao" class="r" accesskey="U">Razão Social</label>
							<span class="required">*</span>
						</td>
						<td class="field">
							<?php
							unset($input);
							$input['accesskey'] = 'U';
							$input['name'] = 'postos_descricao';
							$input['id'] = 'postos_descricao';
							$input['size'] = '50';
							$input['maxlength'] = '255';
							$input['tabindex'] = $t;
							$input['autocomplete'] = 'off';
							$input['value'] = @set_value('postos_descricao', $postos->postos_descricao);
							echo form_input($input);
							echo form_error('postos_descricao');
							$t++;
							?>
						</td>
					</tr>

					<tr>
						<td class="caption">
							<label for="postos_postos_nome" class="r" accesskey="U">Nome Fantasia</label>
							<span class="required">*</span>
						</td>
						<td class="field">
							<?php
							unset($input);
							$input['accesskey'] = 'U';
							$input['name'] = 'postos_nome';
							$input['id'] = 'postos_nome';
							$input['size'] = '50';
							$input['maxlength'] = '255';
							$input['tabindex'] = $t;
							$input['autocomplete'] = 'off';
							$input['value'] = @set_value('postos_nome', $postos->postos_nome);
							echo form_input($input);
							echo form_error('postos_nome');
							$t++;
							?>
						</td>
					</tr>
					
					<tr>
						<td class="caption">
							<label for="postos_postos_endereco" class="r" accesskey="U">Endereço</label>
							<span class="required">*</span>
						</td>
						<td class="field">
							<?php
							unset($input);
							$input['accesskey'] = 'U';
							$input['name'] = 'postos_endereco';
							$input['id'] = 'postos_endereco';
							$input['size'] = '50';
							$input['maxlength'] = '255';
							$input['tabindex'] = $t;
							$input['autocomplete'] = 'off';
							$input['value'] = @set_value('postos_endereco', $postos->postos_endereco);
							echo form_input($input);
							echo form_error('postos_endereco');
							$t++;
							?>
						</td>
					</tr>

					<tr>
						<td class="caption">
							<label for="postos_postos_telefone" class="r" accesskey="U">Telefone</label>
							<span class="required">*</span>
						</td>
						<td class="field">
							<?php
							unset($input);
							$input['accesskey'] = 'U';
							$input['name'] = 'postos_telefone';
							$input['id'] = 'postos_telefone';
							$input['size'] = '50';
							$input['maxlength'] = '255';
							$input['tabindex'] = $t;
							$input['autocomplete'] = 'off';
							$input['value'] = @set_value('postos_telefone', $postos->postos_telefone);
							echo form_input($input);
							echo form_error('postos_telefone');
							$t++;
							?>
						</td>
					</tr>

					<tr>
						<td class="caption">
							<label for="postos_postos_celular" class="r" accesskey="U">Celular</label>
							
						</td>
						<td class="field">
							<?php
							unset($input);
							$input['accesskey'] = 'U';
							$input['name'] = 'postos_celular';
							$input['id'] = 'postos_celular';
							$input['size'] = '50';
							$input['maxlength'] = '255';
							$input['tabindex'] = $t;
							$input['autocomplete'] = 'off';
							$input['value'] = @set_value('postos_celular', $postos->postos_celular);
							echo form_input($input);
							echo form_error('postos_celular');
							$t++;
							?>
						</td>
					</tr>

					<tr>
						<td class="caption">
							<label for="postos_postos_celular_operadora" class="r" accesskey="U">Celular Operadora</label>
							
						</td>
						<td class="field">
							<?php
							unset($input);
							$input['accesskey'] = 'U';
							$input['name'] = 'postos_celular_operadora';
							$input['id'] = 'postos_celular_operadora';
							$input['size'] = '50';
							$input['maxlength'] = '255';
							$input['tabindex'] = $t;
							$input['autocomplete'] = 'off';
							$input['value'] = @set_value('postos_celular_operadora', $postos->postos_celular_operadora);
							echo form_input($input);
							echo form_error('postos_celular_operadora');
							$t++;
							?>
						</td>
					</tr>

					<tr>
						<td class="caption">
							<label for="postos_postos_email" class="r" accesskey="U">E-mail</label>
							
						</td>
						<td class="field">
							<?php
							unset($input);
							$input['accesskey'] = 'U';
							$input['name'] = 'postos_email';
							$input['id'] = 'postos_email';
							$input['size'] = '50';
							$input['maxlength'] = '255';
							$input['tabindex'] = $t;
							$input['autocomplete'] = 'off';
							$input['value'] = @set_value('postos_email', $postos->postos_email);
							echo form_input($input);
							echo form_error('postos_email');
							$t++;
							?>
						</td>
					</tr>

					<tr>
						<td class="caption">
							<label for="postos_postos_data_admissao" class="r" accesskey="U">Data Admissão</label>
							<span class="required">*</span>
						</td>
						<td class="field">
							<?php
							unset($input);
							$input['accesskey'] = 'U';
							$input['name'] = 'postos_data_admissao';
							$input['id'] = 'postos_data_admissao';
							$input['size'] = '50';
							$input['maxlength'] = '255';
							$input['tabindex'] = $t;
							$input['autocomplete'] = 'off';
							$input['value'] = @set_value('postos_data_admissao', mysql2human($postos->postos_data_admissao));
							echo form_input($input);
							echo form_error('postos_data_admissao');
							$t++;
							?>
						</td>
					</tr>
					
					<tr>
					<td class="caption">
					<label for="postos_ativo" accesskey="E"><u>A</u>tivo</label>
					</td>
					<td class="field">
					<label for="postos_ativo" class="check">
					<?php
					unset($check);
					$check['name'] = 'postos_ativo';
					$check['id'] = 'postos_ativo';
					$check['value'] = '1';
					$check['checked'] = @set_checkbox($check['name'], $check['value'], ($postos->postos_ativo == 1));
					$check['tabindex'] = $t;
					echo form_checkbox($check);
					$t++;
					?>
					</label>

					</td>
					</tr>
					
					<?php
					if($postos_id == NULL){
						$submittext = 'Adicionar';
					} else {
						$submittext = 'Salvar';
					}
					unset($buttons);
					$buttons[] = array('submit', 'uibutton', $submittext, 'disk1.gif', $t);
					$buttons[] = array('submit', 'uibutton icon add', 'Salvar e adicionar outro', 'disk1.gif', $t+1);
					$buttons[] = array('cancel', 'uibutton icon prev', 'Cancelar', 'arr-left.gif', $t+2, site_url('contabilidade/postos'));
					$this->load->view('parts/buttons', array('buttons' => $buttons));
					?>

				</table>
			</form>
		</div>
	</div>
</div>