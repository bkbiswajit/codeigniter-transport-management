<?php echo datepicker(); ?>
<script type="text/javascript">
	/* <![CDATA[ */
		$(function() {
				$('#caminhoes_data_nascimento').datepicker({
					userLang	: 'pt-BR',
					americanMode: false,
				});
				$('#caminhoes_data_admissao').datepicker({
					userLang	: 'pt-BR',
					americanMode: false,
				});		
				$('#caminhoes_data_demissao').datepicker({
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
			<a href="#" id="toggle-forms">Editar Frota</a>
		</h2>
		<div class="block" id="forms">
			<?php echo form_open('contabilidade/frotas/salvar', NULL, array('caminhoes_id' => $caminhoes_id)); $t = 1; ?>

			<?php if($caminhoes_id == NULL){ ?><?php } ?>

				<table class="form" cellpadding="6" cellspacing="0" border="0" width="100%">
					
					<tr>
						<td class="caption">
							<label for="caminhoes_caminhoes_descricao" class="r" accesskey="U">Frota</label>
							<span class="required">*</span>
						</td>
						<td class="field">
							<?php
							unset($input);
							$input['accesskey'] = 'U';
							$input['name'] = 'caminhoes_descricao';
							$input['id'] = 'caminhoes_descricao';
							$input['size'] = '50';
							$input['maxlength'] = '255';
							$input['tabindex'] = $t;
							$input['autocomplete'] = 'off';
							$input['value'] = @set_value('caminhoes_descricao', $frotas->caminhoes_descricao);
							echo form_input($input);
							echo form_error('caminhoes_descricao');
							$t++;
							?>
						</td>
					</tr>
					<tr>
						<td class="caption">
							<label for="caminhoes_caminhoes_nome" class="r" accesskey="U">Cavalo</label>
							<span class="required">*</span>
						</td>
						<td class="field">
							<?php
							unset($input);
							$input['accesskey'] = 'U';
							$input['name'] = 'caminhoes_cavalo';
							$input['id'] = 'caminhoes_cavalo';
							$input['size'] = '50';
							$input['maxlength'] = '255';
							$input['tabindex'] = $t;
							$input['autocomplete'] = 'off';
							$input['value'] = @set_value('caminhoes_cavalo', $frotas->caminhoes_cavalo);
							echo form_input($input);
							echo form_error('caminhoes_cavalo');
							$t++;
							?>
						</td>
					</tr>
					<tr>
						<td class="caption">
							<label for="caminhoes_caminhoes_nome" class="r" accesskey="U">Carreta</label>
							<span class="required">*</span>
						</td>
						<td class="field">
							<?php
							unset($input);
							$input['accesskey'] = 'U';
							$input['name'] = 'caminhoes_carreta';
							$input['id'] = 'caminhoes_carreta';
							$input['size'] = '50';
							$input['maxlength'] = '255';
							$input['tabindex'] = $t;
							$input['autocomplete'] = 'off';
							$input['value'] = @set_value('caminhoes_carreta', $frotas->caminhoes_carreta);
							echo form_input($input);
							echo form_error('caminhoes_carreta');
							$t++;
							?>
						</td>
					</tr>
					<!--
					<tr>
						<td class="caption">
							<label for="caminhoes_caminhoes_nome" class="r" accesskey="U">Nome Completo</label>
							<span class="required">*</span>
						</td>
						<td class="field">
							<?php
							unset($input);
							$input['accesskey'] = 'U';
							$input['name'] = 'caminhoes_nome';
							$input['id'] = 'caminhoes_nome';
							$input['size'] = '50';
							$input['maxlength'] = '255';
							$input['tabindex'] = $t;
							$input['autocomplete'] = 'off';
							$input['value'] = @set_value('caminhoes_nome', $frotas->caminhoes_nome);
							echo form_input($input);
							echo form_error('caminhoes_nome');
							$t++;
							?>
						</td>
					</tr>

					<tr>
						<td class="caption">
							<label for="caminhoes_caminhoes_data_nascimento" class="r" accesskey="U">Data Nascimento</label>
							<span class="required">*</span>
						</td>
						<td class="field">
							<?php
							unset($input);
							$input['accesskey'] = 'U';
							$input['name'] = 'caminhoes_data_nascimento';
							$input['id'] = 'caminhoes_data_nascimento';
							$input['size'] = '50';
							$input['maxlength'] = '255';
							$input['tabindex'] = $t;
							$input['autocomplete'] = 'off';
							$input['value'] = @set_value('caminhoes_data_nascimento', mysql2human($frotas->caminhoes_data_nascimento));
							echo form_input($input);
							echo form_error('caminhoes_data_nascimento');
							$t++;
							?>
						</td>
					</tr>

					<tr>
						<td class="caption">
							<label for="caminhoes_caminhoes_endereco" class="r" accesskey="U">Endereço</label>
							<span class="required">*</span>
						</td>
						<td class="field">
							<?php
							unset($input);
							$input['accesskey'] = 'U';
							$input['name'] = 'caminhoes_endereco';
							$input['id'] = 'caminhoes_endereco';
							$input['size'] = '50';
							$input['maxlength'] = '255';
							$input['tabindex'] = $t;
							$input['autocomplete'] = 'off';
							$input['value'] = @set_value('caminhoes_endereco', $frotas->caminhoes_endereco);
							echo form_input($input);
							echo form_error('caminhoes_endereco');
							$t++;
							?>
						</td>
					</tr>

					<tr>
						<td class="caption">
							<label for="caminhoes_caminhoes_telefone" class="r" accesskey="U">Telefone</label>
							<span class="required">*</span>
						</td>
						<td class="field">
							<?php
							unset($input);
							$input['accesskey'] = 'U';
							$input['name'] = 'caminhoes_telefone';
							$input['id'] = 'caminhoes_telefone';
							$input['size'] = '50';
							$input['maxlength'] = '255';
							$input['tabindex'] = $t;
							$input['autocomplete'] = 'off';
							$input['value'] = @set_value('caminhoes_telefone', $frotas->caminhoes_telefone);
							echo form_input($input);
							echo form_error('caminhoes_telefone');
							$t++;
							?>
						</td>
					</tr>

					<tr>
						<td class="caption">
							<label for="caminhoes_caminhoes_celular" class="r" accesskey="U">Celular</label>
							
						</td>
						<td class="field">
							<?php
							unset($input);
							$input['accesskey'] = 'U';
							$input['name'] = 'caminhoes_celular';
							$input['id'] = 'caminhoes_celular';
							$input['size'] = '50';
							$input['maxlength'] = '255';
							$input['tabindex'] = $t;
							$input['autocomplete'] = 'off';
							$input['value'] = @set_value('caminhoes_celular', $frotas->caminhoes_celular);
							echo form_input($input);
							echo form_error('caminhoes_celular');
							$t++;
							?>
						</td>
					</tr>

					<tr>
						<td class="caption">
							<label for="caminhoes_caminhoes_celular_operadora" class="r" accesskey="U">Celular Operadora</label>
							
						</td>
						<td class="field">
							<?php
							unset($input);
							$input['accesskey'] = 'U';
							$input['name'] = 'caminhoes_celular_operadora';
							$input['id'] = 'caminhoes_celular_operadora';
							$input['size'] = '50';
							$input['maxlength'] = '255';
							$input['tabindex'] = $t;
							$input['autocomplete'] = 'off';
							$input['value'] = @set_value('caminhoes_celular_operadora', $frotas->caminhoes_celular_operadora);
							echo form_input($input);
							echo form_error('caminhoes_celular_operadora');
							$t++;
							?>
						</td>
					</tr>

					<tr>
						<td class="caption">
							<label for="caminhoes_caminhoes_email" class="r" accesskey="U">E-mail</label>
							
						</td>
						<td class="field">
							<?php
							unset($input);
							$input['accesskey'] = 'U';
							$input['name'] = 'caminhoes_email';
							$input['id'] = 'caminhoes_email';
							$input['size'] = '50';
							$input['maxlength'] = '255';
							$input['tabindex'] = $t;
							$input['autocomplete'] = 'off';
							$input['value'] = @set_value('caminhoes_email', $frotas->caminhoes_email);
							echo form_input($input);
							echo form_error('caminhoes_email');
							$t++;
							?>
						</td>
					</tr>

					<tr>
						<td class="caption">
							<label for="caminhoes_caminhoes_setor" class="r" accesskey="U">Setor</label>
							<span class="required">*</span>
						</td>
						<td class="field">
							<?php
							unset($input);
							$input['accesskey'] = 'U';
							$input['name'] = 'caminhoes_setor';
							$input['id'] = 'caminhoes_setor';
							$input['size'] = '50';
							$input['maxlength'] = '255';
							$input['tabindex'] = $t;
							$input['autocomplete'] = 'off';
							$input['value'] = @set_value('caminhoes_setor', $frotas->caminhoes_setor);
							echo form_input($input);
							echo form_error('caminhoes_setor');
							$t++;
							?>
						</td>
					</tr>

					<tr>
						<td class="caption">
							<label for="caminhoes_caminhoes_cargo" class="r" accesskey="U">Cargo</label>
							<span class="required">*</span>
						</td>
						<td class="field">
							<?php
							unset($input);
							$input['accesskey'] = 'U';
							$input['name'] = 'caminhoes_cargo';
							$input['id'] = 'caminhoes_cargo';
							$input['size'] = '50';
							$input['maxlength'] = '255';
							$input['tabindex'] = $t;
							$input['autocomplete'] = 'off';
							$input['value'] = @set_value('caminhoes_cargo', $frotas->caminhoes_cargo);
							echo form_input($input);
							echo form_error('caminhoes_cargo');
							$t++;
							?>
						</td>
					</tr>

					<tr>
						<td class="caption">
							<label for="caminhoes_caminhoes_matricula" class="r" accesskey="U">Matrícula</label>
							<span class="required">*</span>
						</td>
						<td class="field">
							<?php
							unset($input);
							$input['accesskey'] = 'U';
							$input['name'] = 'caminhoes_matricula';
							$input['id'] = 'caminhoes_matricula';
							$input['size'] = '50';
							$input['maxlength'] = '255';
							$input['tabindex'] = $t;
							$input['autocomplete'] = 'off';
							$input['value'] = @set_value('caminhoes_matricula', $frotas->caminhoes_matricula);
							echo form_input($input);
							echo form_error('caminhoes_matricula');
							$t++;
							?>
						</td>
					</tr>

					<tr>
						<td class="caption">
							<label for="caminhoes_caminhoes_cpf" class="r" accesskey="U">CPF</label>
							<span class="required">*</span>
						</td>
						<td class="field">
							<?php
							unset($input);
							$input['accesskey'] = 'U';
							$input['name'] = 'caminhoes_cpf';
							$input['id'] = 'caminhoes_cpf';
							$input['size'] = '50';
							$input['maxlength'] = '255';
							$input['tabindex'] = $t;
							$input['autocomplete'] = 'off';
							$input['value'] = @set_value('caminhoes_cpf', $frotas->caminhoes_cpf);
							echo form_input($input);
							echo form_error('caminhoes_cpf');
							$t++;
							?>
						</td>
					</tr>

					<tr>
						<td class="caption">
							<label for="caminhoes_caminhoes_pis" class="r" accesskey="U">PIS</label>
							<span class="required">*</span>
						</td>
						<td class="field">
							<?php
							unset($input);
							$input['accesskey'] = 'U';
							$input['name'] = 'caminhoes_pis';
							$input['id'] = 'caminhoes_pis';
							$input['size'] = '50';
							$input['maxlength'] = '255';
							$input['tabindex'] = $t;
							$input['autocomplete'] = 'off';
							$input['value'] = @set_value('caminhoes_pis', $frotas->caminhoes_pis);
							echo form_input($input);
							echo form_error('caminhoes_pis');
							$t++;
							?>
						</td>
					</tr>

					<tr>
						<td class="caption">
							<label for="caminhoes_caminhoes_ctps_numero" class="r" accesskey="U">CTPS Número</label>
							<span class="required">*</span>
						</td>
						<td class="field">
							<?php
							unset($input);
							$input['accesskey'] = 'U';
							$input['name'] = 'caminhoes_ctps_numero';
							$input['id'] = 'caminhoes_ctps_numero';
							$input['size'] = '50';
							$input['maxlength'] = '255';
							$input['tabindex'] = $t;
							$input['autocomplete'] = 'off';
							$input['value'] = @set_value('caminhoes_ctps_numero', $frotas->caminhoes_ctps_numero);
							echo form_input($input);
							echo form_error('caminhoes_ctps_numero');
							$t++;
							?>
						</td>
					</tr>

					<tr>
						<td class="caption">
							<label for="caminhoes_caminhoes_ctps_serie" class="r" accesskey="U">CTPS Série</label>
							<span class="required">*</span>
						</td>
						<td class="field">
							<?php
							unset($input);
							$input['accesskey'] = 'U';
							$input['name'] = 'caminhoes_ctps_serie';
							$input['id'] = 'caminhoes_ctps_serie';
							$input['size'] = '50';
							$input['maxlength'] = '255';
							$input['tabindex'] = $t;
							$input['autocomplete'] = 'off';
							$input['value'] = @set_value('caminhoes_ctps_serie', $frotas->caminhoes_ctps_serie);
							echo form_input($input);
							echo form_error('caminhoes_ctps_serie');
							$t++;
							?>
						</td>
					</tr>

					<tr>
						<td class="caption">
							<label for="caminhoes_caminhoes_ctps_uf" class="r" accesskey="U">CTPS UF</label>
							<span class="required">*</span>
						</td>
						<td class="field">
							<?php
							unset($input);
							$input['accesskey'] = 'U';
							$input['name'] = 'caminhoes_ctps_uf';
							$input['id'] = 'caminhoes_ctps_uf';
							$input['size'] = '50';
							$input['maxlength'] = '255';
							$input['tabindex'] = $t;
							$input['autocomplete'] = 'off';
							$input['value'] = @set_value('caminhoes_ctps_uf', $frotas->caminhoes_ctps_uf);
							echo form_input($input);
							echo form_error('caminhoes_ctps_uf');
							$t++;
							?>
						</td>
					</tr>

					<tr>
						<td class="caption">
							<label for="caminhoes_caminhoes_data_admissao" class="r" accesskey="U">Data Admissão</label>
							<span class="required">*</span>
						</td>
						<td class="field">
							<?php
							unset($input);
							$input['accesskey'] = 'U';
							$input['name'] = 'caminhoes_data_admissao';
							$input['id'] = 'caminhoes_data_admissao';
							$input['size'] = '50';
							$input['maxlength'] = '255';
							$input['tabindex'] = $t;
							$input['autocomplete'] = 'off';
							$input['value'] = @set_value('caminhoes_data_admissao', mysql2human($frotas->caminhoes_data_admissao));
							echo form_input($input);
							echo form_error('caminhoes_data_admissao');
							$t++;
							?>
						</td>
					</tr>

					<tr>
						<td class="caption">
							<label for="caminhoes_caminhoes_data_demissao" class="r" accesskey="U">Data Demissão</label>
							
						</td>
						<td class="field">
							<?php
							unset($input);
							$input['accesskey'] = 'U';
							$input['name'] = 'caminhoes_data_demissao';
							$input['id'] = 'caminhoes_data_demissao';
							$input['size'] = '50';
							$input['maxlength'] = '255';
							$input['tabindex'] = $t;
							$input['autocomplete'] = 'off';
							$input['value'] = @set_value('caminhoes_data_demissao', mysql2human($frotas->caminhoes_data_demissao));
							echo form_input($input);
							echo form_error('caminhoes_data_demissao');
							$t++;
							?>
						</td>
					</tr>

					<tr>
						<td class="caption">
							<label for="caminhoes_caminhoes_percentagem" class="r" accesskey="U">Salário Percentual</label>
							<span class="required">*</span>
						</td>
						<td class="field">
							<?php
							unset($input);
							$input['accesskey'] = 'U';
							$input['name'] = 'caminhoes_percentagem';
							$input['id'] = 'caminhoes_percentagem';
							$input['size'] = '50';
							$input['maxlength'] = '255';
							$input['tabindex'] = $t;
							$input['autocomplete'] = 'off';
							$input['value'] = @set_value('caminhoes_percentagem', $frotas->caminhoes_percentagem);
							echo form_input($input);
							echo form_error('caminhoes_percentagem');
							$t++;
							?>
						</td>
					</tr>
					-->
					<tr>
						<td class="caption">
						<label for="caminhoes_ativo" accesskey="E"><u>A</u>tivo</label>
						</td>
						<td class="field">
						<label for="caminhoes_ativo" class="check">
						<?php
						unset($check);
						$check['name'] = 'caminhoes_ativo';
						$check['id'] = 'caminhoes_ativo';
						$check['value'] = '1';
						$check['checked'] = @set_checkbox($check['name'], $check['value'], ($frotas->caminhoes_ativo == 1));
						$check['tabindex'] = $t;
						echo form_checkbox($check);
						$t++;
						?>
						</label>

						</td>
					</tr>
					<?php
					if($caminhoes_id == NULL){
						$submittext = 'Adicionar';
					} else {
						$submittext = 'Salvar';
					}
					unset($buttons);
					$buttons[] = array('submit', 'uibutton', $submittext, 'disk1.gif', $t);
					$buttons[] = array('submit', 'uibutton icon add', 'Salvar e adicionar outro', 'disk1.gif', $t+1);
					$buttons[] = array('cancel', 'uibutton icon prev', 'Cancelar', 'arr-left.gif', $t+2, site_url('contabilidade/frotas'));
					$this->load->view('parts/buttons', array('buttons' => $buttons));
					?>

				</table>
			</form>
		</div>
	</div>
</div>