<?php echo datepicker(); ?>
<script type="text/javascript">
	/* <![CDATA[ */
		$(function() {
				$('#bonificacao_mes_inicio').datepicker({
					userLang	: 'pt-BR',
					americanMode: false,
				});
				$('#bonificacao_mes_final').datepicker({
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
			<?php echo form_open('contabilidade/bonificacao/salvar', NULL, array('bonificacao_id' => $bonificacao_id)); $t = 1; ?>

			<?php if($bonificacao_id == NULL){ ?><?php } ?>

				<table class="form" cellpadding="6" cellspacing="0" border="0" width="100%">
				
					<tr>
						<td class="caption">
							<label for="bonificacao_bonificacao_descricao" class="r" accesskey="U">Mês</label>
							<span class="required">*</span>
						</td>
						<td class="field">
							<?php
							unset($input);
							$input['accesskey'] = 'U';
							$input['name'] = 'bonificacao_descricao';
							$input['id'] = 'bonificacao_descricao';
							$input['size'] = '50';
							$input['maxlength'] = '255';
							$input['tabindex'] = $t;
							$input['autocomplete'] = 'off';
							$input['value'] = @set_value('bonificacao_descricao', $bonificacao->bonificacao_descricao);
							echo form_input($input);
							echo form_error('bonificacao_descricao');
							$t++;
							?>
						</td>
					</tr>

					<tr>
						<td class="caption">
							<label for="bonificacao_bonificacao_nome" class="r" accesskey="U">Mês Início</label>
							<span class="required">*</span>
						</td>
						<td class="field">
							<?php
							unset($input);
							$input['accesskey'] = 'U';
							$input['name'] = 'bonificacao_mes_inicio';
							$input['id'] = 'bonificacao_mes_inicio';
							$input['size'] = '50';
							$input['maxlength'] = '255';
							$input['tabindex'] = $t;
							$input['autocomplete'] = 'off';
							$input['value'] = @set_value('bonificacao_mes_inicio', mysql2human($bonificacao->bonificacao_mes_inicio));
							echo form_input($input);
							echo form_error('bonificacao_mes_inicio');
							$t++;
							?>
						</td>
					</tr>
					
					<tr>
						<td class="caption">
							<label for="bonificacao_bonificacao_endereco" class="r" accesskey="U">Mês Final</label>
							<span class="required">*</span>
						</td>
						<td class="field">
							<?php
							unset($input);
							$input['accesskey'] = 'U';
							$input['name'] = 'bonificacao_mes_final';
							$input['id'] = 'bonificacao_mes_final';
							$input['size'] = '50';
							$input['maxlength'] = '255';
							$input['tabindex'] = $t;
							$input['autocomplete'] = 'off';
							$input['value'] = @set_value('bonificacao_mes_final', mysql2human($bonificacao->bonificacao_mes_final));
							echo form_input($input);
							echo form_error('bonificacao_mes_final');
							$t++;
							?>
						</td>
					</tr>
					
					<?php
					if($bonificacao_id == NULL){
						$submittext = 'Adicionar';
					} else {
						$submittext = 'Salvar';
					}
					unset($buttons);
					$buttons[] = array('submit', 'uibutton', $submittext, 'disk1.gif', $t);
					$buttons[] = array('submit', 'uibutton icon add', 'Salvar e adicionar outro', 'disk1.gif', $t+1);
					$buttons[] = array('cancel', 'uibutton icon prev', 'Cancelar', 'arr-left.gif', $t+2, site_url('contabilidade/bonificacao'));
					$this->load->view('parts/buttons', array('buttons' => $buttons));
					?>

				</table>
			</form>
		</div>
	</div>
</div>