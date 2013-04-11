<?php echo datepicker(); ?>
<script type="text/javascript">
	/* <![CDATA[ */
		$(function() {
				$('#motoristas_data_nascimento').datepicker({
					userLang	: 'pt-BR',
					americanMode: false,
				});
				$('#motoristas_data_admissao').datepicker({
					userLang	: 'pt-BR',
					americanMode: false,
				});		
				$('#motoristas_data_demissao').datepicker({
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
			<a href="#" id="toggle-forms">Editar motorista</a>
		</h2>
		<div class="block" id="forms">
			<?php echo form_open('contabilidade/motoristas/salvar', NULL, array('motoristas_id' => $motoristas_id)); $t = 1; ?>

			<?php if($motoristas_id == NULL){ ?><?php } ?>

				<table class="form" cellpadding="6" cellspacing="0" border="0" width="100%">
					
					<tr>
						<td class="caption">
							<label for="motoristas_motoristas_descricao" class="r" accesskey="U">Nome</label>
							<span class="required">*</span>
						</td>
						<td class="field">
							<?php
							unset($input);
							$input['accesskey'] = 'U';
							$input['name'] = 'motoristas_descricao';
							$input['id'] = 'motoristas_descricao';
							$input['size'] = '50';
							$input['maxlength'] = '255';
							$input['tabindex'] = $t;
							$input['autocomplete'] = 'off';
							$input['value'] = @set_value('motoristas_descricao', $motoristas->motoristas_descricao);
							echo form_input($input);
							echo form_error('motoristas_descricao');
							$t++;
							?>
						</td>
					</tr>

					<tr>
						<td class="caption">
							<label for="motoristas_motoristas_nome" class="r" accesskey="U">Nome Completo</label>
							<span class="required">*</span>
						</td>
						<td class="field">
							<?php
							unset($input);
							$input['accesskey'] = 'U';
							$input['name'] = 'motoristas_nome';
							$input['id'] = 'motoristas_nome';
							$input['size'] = '50';
							$input['maxlength'] = '255';
							$input['tabindex'] = $t;
							$input['autocomplete'] = 'off';
							$input['value'] = @set_value('motoristas_nome', $motoristas->motoristas_nome);
							echo form_input($input);
							echo form_error('motoristas_nome');
							$t++;
							?>
						</td>
					</tr>

					<tr>
						<td class="caption">
							<label for="motoristas_motoristas_data_nascimento" class="r" accesskey="U">Data Nascimento</label>
							<span class="required">*</span>
						</td>
						<td class="field">
							<?php
							unset($input);
							$input['accesskey'] = 'U';
							$input['name'] = 'motoristas_data_nascimento';
							$input['id'] = 'motoristas_data_nascimento';
							$input['size'] = '50';
							$input['maxlength'] = '255';
							$input['tabindex'] = $t;
							$input['autocomplete'] = 'off';
							$input['value'] = @set_value('motoristas_data_nascimento', mysql2human($motoristas->motoristas_data_nascimento));
							echo form_input($input);
							echo form_error('motoristas_data_nascimento');
							$t++;
							?>
						</td>
					</tr>

					<tr>
						<td class="caption">
							<label for="motoristas_motoristas_endereco" class="r" accesskey="U">Endereço</label>
							<span class="required">*</span>
						</td>
						<td class="field">
							<?php
							unset($input);
							$input['accesskey'] = 'U';
							$input['name'] = 'motoristas_endereco';
							$input['id'] = 'motoristas_endereco';
							$input['size'] = '50';
							$input['maxlength'] = '255';
							$input['tabindex'] = $t;
							$input['autocomplete'] = 'off';
							$input['value'] = @set_value('motoristas_endereco', $motoristas->motoristas_endereco);
							echo form_input($input);
							echo form_error('motoristas_endereco');
							$t++;
							?>
						</td>
					</tr>

					<tr>
						<td class="caption">
							<label for="motoristas_motoristas_telefone" class="r" accesskey="U">Telefone</label>
							<span class="required">*</span>
						</td>
						<td class="field">
							<?php
							unset($input);
							$input['accesskey'] = 'U';
							$input['name'] = 'motoristas_telefone';
							$input['id'] = 'motoristas_telefone';
							$input['size'] = '50';
							$input['maxlength'] = '255';
							$input['tabindex'] = $t;
							$input['autocomplete'] = 'off';
							$input['value'] = @set_value('motoristas_telefone', $motoristas->motoristas_telefone);
							echo form_input($input);
							echo form_error('motoristas_telefone');
							$t++;
							?>
						</td>
					</tr>

					<tr>
						<td class="caption">
							<label for="motoristas_motoristas_celular" class="r" accesskey="U">Celular</label>
							
						</td>
						<td class="field">
							<?php
							unset($input);
							$input['accesskey'] = 'U';
							$input['name'] = 'motoristas_celular';
							$input['id'] = 'motoristas_celular';
							$input['size'] = '50';
							$input['maxlength'] = '255';
							$input['tabindex'] = $t;
							$input['autocomplete'] = 'off';
							$input['value'] = @set_value('motoristas_celular', $motoristas->motoristas_celular);
							echo form_input($input);
							echo form_error('motoristas_celular');
							$t++;
							?>
						</td>
					</tr>

					<tr>
						<td class="caption">
							<label for="motoristas_motoristas_celular_operadora" class="r" accesskey="U">Celular Operadora</label>
							
						</td>
						<td class="field">
							<?php
							unset($input);
							$input['accesskey'] = 'U';
							$input['name'] = 'motoristas_celular_operadora';
							$input['id'] = 'motoristas_celular_operadora';
							$input['size'] = '50';
							$input['maxlength'] = '255';
							$input['tabindex'] = $t;
							$input['autocomplete'] = 'off';
							$input['value'] = @set_value('motoristas_celular_operadora', $motoristas->motoristas_celular_operadora);
							echo form_input($input);
							echo form_error('motoristas_celular_operadora');
							$t++;
							?>
						</td>
					</tr>

					<tr>
						<td class="caption">
							<label for="motoristas_motoristas_email" class="r" accesskey="U">E-mail</label>
							
						</td>
						<td class="field">
							<?php
							unset($input);
							$input['accesskey'] = 'U';
							$input['name'] = 'motoristas_email';
							$input['id'] = 'motoristas_email';
							$input['size'] = '50';
							$input['maxlength'] = '255';
							$input['tabindex'] = $t;
							$input['autocomplete'] = 'off';
							$input['value'] = @set_value('motoristas_email', $motoristas->motoristas_email);
							echo form_input($input);
							echo form_error('motoristas_email');
							$t++;
							?>
						</td>
					</tr>

					<tr>
						<td class="caption">
							<label for="motoristas_motoristas_setor" class="r" accesskey="U">Setor</label>
							<span class="required">*</span>
						</td>
						<td class="field">
							<?php
							unset($input);
							$input['accesskey'] = 'U';
							$input['name'] = 'motoristas_setor';
							$input['id'] = 'motoristas_setor';
							$input['size'] = '50';
							$input['maxlength'] = '255';
							$input['tabindex'] = $t;
							$input['autocomplete'] = 'off';
							$input['value'] = @set_value('motoristas_setor', $motoristas->motoristas_setor);
							echo form_input($input);
							echo form_error('motoristas_setor');
							$t++;
							?>
						</td>
					</tr>

					<tr>
						<td class="caption">
							<label for="motoristas_motoristas_cargo" class="r" accesskey="U">Cargo</label>
							<span class="required">*</span>
						</td>
						<td class="field">
							<?php
							unset($input);
							$input['accesskey'] = 'U';
							$input['name'] = 'motoristas_cargo';
							$input['id'] = 'motoristas_cargo';
							$input['size'] = '50';
							$input['maxlength'] = '255';
							$input['tabindex'] = $t;
							$input['autocomplete'] = 'off';
							$input['value'] = @set_value('motoristas_cargo', $motoristas->motoristas_cargo);
							echo form_input($input);
							echo form_error('motoristas_cargo');
							$t++;
							?>
						</td>
					</tr>

					<tr>
						<td class="caption">
							<label for="motoristas_motoristas_matricula" class="r" accesskey="U">Matrícula</label>
							<span class="required">*</span>
						</td>
						<td class="field">
							<?php
							unset($input);
							$input['accesskey'] = 'U';
							$input['name'] = 'motoristas_matricula';
							$input['id'] = 'motoristas_matricula';
							$input['size'] = '50';
							$input['maxlength'] = '255';
							$input['tabindex'] = $t;
							$input['autocomplete'] = 'off';
							$input['value'] = @set_value('motoristas_matricula', $motoristas->motoristas_matricula);
							echo form_input($input);
							echo form_error('motoristas_matricula');
							$t++;
							?>
						</td>
					</tr>

					<tr>
						<td class="caption">
							<label for="motoristas_motoristas_cpf" class="r" accesskey="U">CPF</label>
							<span class="required">*</span>
						</td>
						<td class="field">
							<?php
							unset($input);
							$input['accesskey'] = 'U';
							$input['name'] = 'motoristas_cpf';
							$input['id'] = 'motoristas_cpf';
							$input['size'] = '50';
							$input['maxlength'] = '255';
							$input['tabindex'] = $t;
							$input['autocomplete'] = 'off';
							$input['value'] = @set_value('motoristas_cpf', $motoristas->motoristas_cpf);
							echo form_input($input);
							echo form_error('motoristas_cpf');
							$t++;
							?>
						</td>
					</tr>

					<tr>
						<td class="caption">
							<label for="motoristas_motoristas_pis" class="r" accesskey="U">PIS</label>
							<span class="required">*</span>
						</td>
						<td class="field">
							<?php
							unset($input);
							$input['accesskey'] = 'U';
							$input['name'] = 'motoristas_pis';
							$input['id'] = 'motoristas_pis';
							$input['size'] = '50';
							$input['maxlength'] = '255';
							$input['tabindex'] = $t;
							$input['autocomplete'] = 'off';
							$input['value'] = @set_value('motoristas_pis', $motoristas->motoristas_pis);
							echo form_input($input);
							echo form_error('motoristas_pis');
							$t++;
							?>
						</td>
					</tr>

					<tr>
						<td class="caption">
							<label for="motoristas_motoristas_ctps_numero" class="r" accesskey="U">CTPS Número</label>
							<span class="required">*</span>
						</td>
						<td class="field">
							<?php
							unset($input);
							$input['accesskey'] = 'U';
							$input['name'] = 'motoristas_ctps_numero';
							$input['id'] = 'motoristas_ctps_numero';
							$input['size'] = '50';
							$input['maxlength'] = '255';
							$input['tabindex'] = $t;
							$input['autocomplete'] = 'off';
							$input['value'] = @set_value('motoristas_ctps_numero', $motoristas->motoristas_ctps_numero);
							echo form_input($input);
							echo form_error('motoristas_ctps_numero');
							$t++;
							?>
						</td>
					</tr>

					<tr>
						<td class="caption">
							<label for="motoristas_motoristas_ctps_serie" class="r" accesskey="U">CTPS Série</label>
							<span class="required">*</span>
						</td>
						<td class="field">
							<?php
							unset($input);
							$input['accesskey'] = 'U';
							$input['name'] = 'motoristas_ctps_serie';
							$input['id'] = 'motoristas_ctps_serie';
							$input['size'] = '50';
							$input['maxlength'] = '255';
							$input['tabindex'] = $t;
							$input['autocomplete'] = 'off';
							$input['value'] = @set_value('motoristas_ctps_serie', $motoristas->motoristas_ctps_serie);
							echo form_input($input);
							echo form_error('motoristas_ctps_serie');
							$t++;
							?>
						</td>
					</tr>

					<tr>
						<td class="caption">
							<label for="motoristas_motoristas_ctps_uf" class="r" accesskey="U">CTPS UF</label>
							<span class="required">*</span>
						</td>
						<td class="field">
							<?php
							unset($input);
							$input['accesskey'] = 'U';
							$input['name'] = 'motoristas_ctps_uf';
							$input['id'] = 'motoristas_ctps_uf';
							$input['size'] = '50';
							$input['maxlength'] = '255';
							$input['tabindex'] = $t;
							$input['autocomplete'] = 'off';
							$input['value'] = @set_value('motoristas_ctps_uf', $motoristas->motoristas_ctps_uf);
							echo form_input($input);
							echo form_error('motoristas_ctps_uf');
							$t++;
							?>
						</td>
					</tr>

					<tr>
						<td class="caption">
							<label for="motoristas_motoristas_data_admissao" class="r" accesskey="U">Data Admissão</label>
							<span class="required">*</span>
						</td>
						<td class="field">
							<?php
							unset($input);
							$input['accesskey'] = 'U';
							$input['name'] = 'motoristas_data_admissao';
							$input['id'] = 'motoristas_data_admissao';
							$input['size'] = '50';
							$input['maxlength'] = '255';
							$input['tabindex'] = $t;
							$input['autocomplete'] = 'off';
							$input['value'] = @set_value('motoristas_data_admissao', mysql2human($motoristas->motoristas_data_admissao));
							echo form_input($input);
							echo form_error('motoristas_data_admissao');
							$t++;
							?>
						</td>
					</tr>

					<tr>
						<td class="caption">
							<label for="motoristas_motoristas_data_demissao" class="r" accesskey="U">Data Demissão</label>
							
						</td>
						<td class="field">
							<?php
							unset($input);
							$input['accesskey'] = 'U';
							$input['name'] = 'motoristas_data_demissao';
							$input['id'] = 'motoristas_data_demissao';
							$input['size'] = '50';
							$input['maxlength'] = '255';
							$input['tabindex'] = $t;
							$input['autocomplete'] = 'off';
							$input['value'] = @set_value('motoristas_data_demissao', mysql2human($motoristas->motoristas_data_demissao));
							echo form_input($input);
							echo form_error('motoristas_data_demissao');
							$t++;
							?>
						</td>
					</tr>

					<tr>
						<td class="caption">
							<label for="motoristas_motoristas_percentagem" class="r" accesskey="U">Comissão Percentual</label>
							<span class="required">*</span>
						</td>
						<td class="field">
							<?php
							unset($input);
							$input['accesskey'] = 'U';
							$input['name'] = 'motoristas_comissao';
							$input['id'] = 'motoristas_comissao';
							$input['size'] = '50';
							$input['maxlength'] = '255';
							$input['tabindex'] = $t;
							$input['autocomplete'] = 'off';
							$input['value'] = @set_value('motoristas_comissao', $motoristas->motoristas_comissao);
							echo form_input($input);
							echo form_error('motoristas_comissao');
							$t++;
							?>
						</td>
					</tr>

					<tr>
					<td class="caption">
					<label for="motoristas_ativo" accesskey="E"><u>A</u>tivo</label>
					</td>
					<td class="field">
					<label for="motoristas_ativo" class="check">
					<?php
					unset($check);
					$check['name'] = 'motoristas_ativo';
					$check['id'] = 'motoristas_ativo';
					$check['value'] = '1';
					$check['checked'] = @set_checkbox($check['name'], $check['value'], ($motoristas->motoristas_ativo == 1));
					$check['tabindex'] = $t;
					echo form_checkbox($check);
					$t++;
					?>
					</label>

					</td>
					</tr>
					
					<?php
					if($motoristas_id == NULL){
						$submittext = 'Adicionar';
					} else {
						$submittext = 'Salvar';
					}
					unset($buttons);
					$buttons[] = array('submit', 'uibutton', $submittext, 'disk1.gif', $t);
					$buttons[] = array('submit', 'uibutton icon add', 'Salvar e adicionar outro', 'disk1.gif', $t+1);
					$buttons[] = array('cancel', 'uibutton icon prev', 'Cancelar', 'arr-left.gif', $t+2, site_url('contabilidade/motoristas'));
					$this->load->view('parts/buttons', array('buttons' => $buttons));
					?>

				</table>
			</form>
		</div>
	</div>
</div>