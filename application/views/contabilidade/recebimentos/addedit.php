<?php echo datepicker(); ?>
<script type="text/javascript">
	/* <![CDATA[ */
		$(function() {
				$('#recebimentos_data').datepicker({
					userLang	: 'pt-BR',
					americanMode: false,
				});
				$('#recebimentos_data_recebido').datepicker({
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
			<a href="#" id="toggle-forms">Editar recebimento</a>
		</h2>
		<div class="block" id="forms">
			<?php echo form_open('contabilidade/recebimentos/salvar', NULL, array('recebimentos_id' => $recebimentos_id)); $t = 1; ?>

			<?php if($recebimentos_id == NULL){ ?><?php } ?>

				<table class="form" cellpadding="6" cellspacing="0" border="0" width="100%">

					<tr>
						<td class="caption">
							<label for="recebimentos_clientes_id" class="r" accesskey="G"><u>C</u>liente</label>
						</td>
						<td class="field">
							<?php
							echo form_dropdown('recebimentos_clientes_id', $clientes, set_value('recebimentos_clientes_id', (isset($recebimentos->recebimentos_clientes_id) ? $recebimentos->recebimentos_clientes_id : 0)), 'tabindex="'.$t.'"');
							$t++;
							?>
						</td>
					</tr>
					
					<tr>
						<td class="caption">
							<label for="recebimentos_recebimentos_descricao" class="r" accesskey="U">Número</label>
							<span class="required">*</span>
						</td>
						<td class="field">
							<?php
							unset($input);
							$input['accesskey'] = 'U';
							$input['name'] = 'recebimentos_descricao';
							$input['id'] = 'recebimentos_descricao';
							$input['size'] = '50';
							$input['maxlength'] = '255';
							$input['tabindex'] = $t;
							$input['autocomplete'] = 'off';
							$input['value'] = @set_value('recebimentos_descricao', $recebimentos->recebimentos_descricao);
							echo form_input($input);
							echo form_error('recebimentos_descricao');
							$t++;
							?>
						</td>
					</tr>

					<tr>
						<td class="caption">
							<label for="recebimentos_recebimentos_descricao" class="r" accesskey="U">Série</label>
							<span class="required">*</span>
						</td>
						<td class="field">
							<?php
							unset($input);
							$input['accesskey'] = 'U';
							$input['name'] = 'recebimentos_serie';
							$input['id'] = 'recebimentos_serie';
							$input['size'] = '50';
							$input['maxlength'] = '255';
							$input['tabindex'] = $t;
							$input['autocomplete'] = 'off';
							$input['value'] = @set_value('recebimentos_serie', $recebimentos->recebimentos_serie);
							echo form_input($input);
							echo form_error('recebimentos_serie');
							$t++;
							?>
						</td>
					</tr>
					
					<tr>
						<td class="caption">
							<label for="recebimentos_recebimentos_data" class="r" accesskey="U">Data</label>
							<span class="required">*</span>
						</td>
						<td class="field">
							<?php
							unset($input);
							$input['accesskey'] = 'U';
							$input['name'] = 'recebimentos_data';
							$input['id'] = 'recebimentos_data';
							$input['size'] = '50';
							$input['maxlength'] = '255';
							$input['tabindex'] = $t;
							$input['autocomplete'] = 'off';
							$input['value'] = @set_value('recebimentos_data', mysql2human($recebimentos->recebimentos_data));
							echo form_input($input);
							echo form_error('recebimentos_data');
							$t++;
							?>
						</td>
					</tr>
					
					<tr>
						<td class="caption">
							<label for="recebimentos_recebimentos_data_recebido" class="r" accesskey="U">Data Recebimento</label>
						</td>
						<td class="field">
							<?php
							unset($input);
							$input['accesskey'] = 'U';
							$input['name'] = 'recebimentos_data_recebido';
							$input['id'] = 'recebimentos_data_recebido';
							$input['size'] = '50';
							$input['maxlength'] = '255';
							$input['tabindex'] = $t;
							$input['autocomplete'] = 'off';
							$input['value'] = @set_value('recebimentos_data_recebido', mysql2human($recebimentos->recebimentos_data_recebido));
							echo form_input($input);
							echo form_error('recebimentos_data_recebido');
							$t++;
							?>
						</td>
					</tr>
					
					<tr>
						<td class="caption">
							<label for="recebimentos_recebimentos_descricao" class="r" accesskey="U">Valor R$</label>
							<span class="required">*</span>
						</td>
						<td class="field">
							<?php
							unset($input);
							$input['accesskey'] = 'U';
							$input['name'] = 'recebimentos_valor';
							$input['id'] = 'recebimentos_valor';
							$input['size'] = '50';
							$input['maxlength'] = '255';
							$input['tabindex'] = $t;
							$input['autocomplete'] = 'off';
							$input['value'] = @set_value('recebimentos_valor', $recebimentos->recebimentos_valor);
							echo form_input($input);
							echo form_error('recebimentos_valor');
							$t++;
							?>
						</td>
					</tr>

					<tr>
						<td class="caption">
							<label for="recebimentos_recebimentos_descricao" class="r" accesskey="U">Comentário R$</label>
						</td>
						<td class="field">
							<?php
							unset($input);
							$input['accesskey'] = 'U';
							$input['name'] = 'recebimentos_comentario';
							$input['id'] = 'recebimentos_comentario';
							$input['cols'] = '80';
							//$input['maxlength'] = '255';
							$input['tabindex'] = $t;
							$input['autocomplete'] = 'off';
							$input['value'] = @set_value('recebimentos_comentario', $recebimentos->recebimentos_comentario);
							echo form_textarea($input);
							echo form_error('recebimentos_comentario');
							$t++;
							?>
						</td>
					</tr>
					
					<tr>
						<td class="caption">
								<label for="recebimentos_recebido" accesskey="E"><u>R</u>ecebido</label>
						</td>
						<td class="field">
							<label for="recebimentos_recebido" class="check">
							<?php
							unset($check);
							$check['name'] = 'recebimentos_recebido';
							$check['id'] = 'recebimentos_recebido';
							$check['value'] = '1';
							$check['checked'] = @set_checkbox($check['name'], $check['value'], ($recebimentos->recebimentos_recebido == 1));
							$check['tabindex'] = $t;
							echo form_checkbox($check);
							$t++;
							?>
							</label>
						</td>
					</tr>
					
					<?php
					if($recebimentos_id == NULL){
						$submittext = 'Adicionar';
					} else {
						$submittext = 'Salvar';
					}
					unset($buttons);
					$buttons[] = array('submit', 'uibutton', $submittext, 'disk1.gif', $t);
					$buttons[] = array('submit', 'uibutton icon add', 'Salvar e adicionar outro', 'disk1.gif', $t+1);
					$buttons[] = array('cancel', 'uibutton icon prev', 'Cancelar', 'arr-left.gif', $t+2, site_url('contabilidade/recebimentos'));
					$this->load->view('parts/buttons', array('buttons' => $buttons));
					?>

				</table>
			</form>
		</div>
	</div>
</div>