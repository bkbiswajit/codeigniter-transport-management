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

				<table cellpadding="6" cellspacing="0" border="0" width="100%">
					
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
							<label for="caminhoes_caminhoes_nome" class="r" accesskey="U">Cavalo Ano</label>
							<span class="required">*</span>
						</td>
						<td class="field">
							<?php
							unset($input);
							$input['accesskey'] = 'U';
							$input['name'] = 'caminhoes_cavalo_ano';
							$input['id'] = 'caminhoes_cavalo_ano';
							$input['size'] = '50';
							$input['maxlength'] = '255';
							$input['tabindex'] = $t;
							$input['autocomplete'] = 'off';
							$input['value'] = @set_value('caminhoes_cavalo_ano', $frotas->caminhoes_cavalo_ano);
							echo form_input($input);
							echo form_error('caminhoes_cavalo_ano');
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
					<tr>
						<td class="caption">
							<label for="caminhoes_caminhoes_nome" class="r" accesskey="U">Carreta Ano</label>
							<span class="required">*</span>
						</td>
						<td class="field">
							<?php
							unset($input);
							$input['accesskey'] = 'U';
							$input['name'] = 'caminhoes_carreta_ano';
							$input['id'] = 'caminhoes_carreta_ano';
							$input['size'] = '50';
							$input['maxlength'] = '255';
							$input['tabindex'] = $t;
							$input['autocomplete'] = 'off';
							$input['value'] = @set_value('caminhoes_carreta_ano', $frotas->caminhoes_carreta_ano);
							echo form_input($input);
							echo form_error('caminhoes_carreta_ano');
							$t++;
							?>
						</td>
					</tr>
					<tr>
						<td class="caption">
						<label for="caminhoes_ativo" accesskey="E">Ativo</label>
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