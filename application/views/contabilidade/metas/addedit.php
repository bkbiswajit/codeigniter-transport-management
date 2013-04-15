<?php echo datepicker(); ?>
<script type="text/javascript">
	/* <![CDATA[ */
		$(function() {
				$('#metas_mes_inicio').datepicker({
					userLang	: 'pt-BR',
					americanMode: false,
				});
				$('#metas_mes_final').datepicker({
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
			<?php echo form_open('contabilidade/metas/salvar', NULL, array('metas_id' => $metas_id)); $t = 1; ?>

			<?php if($metas_id == NULL){ ?><?php } ?>

				<table class="form" cellpadding="6" cellspacing="0" border="0" width="100%">
				
					<tr>
						<td class="caption">
							<label for="metas_mes_id" class="r" accesskey="G"><u>M</u>ês</label>
						</td>
						<td class="field">
							<?php
							echo form_dropdown('metas_mes_id', $mes, set_value('metas_mes_id', (isset($metas->metas_mes_id) ? $metas->metas_mes_id : 0)), 'tabindex="'.$t.'"');
							$t++;
							echo form_error('metas_mes_id');
							?>
						</td>
					</tr>

					<tr>
						<td class="caption">
							<label for="metas_regiao_id" class="r" accesskey="G"><u>R</u>egião</label>
						</td>
						<td class="field">
							<?php
							echo form_dropdown('metas_regiao_id', $regioes, set_value('metas_regiao_id', (isset($metas->metas_regiao_id) ? $metas->metas_regiao_id : 0)), 'tabindex="'.$t.'"');
							$t++;
							echo form_error('metas_regiao_id');
							?>
						</td>
					</tr>
					
					<tr>
						<td class="caption">
							<label for="metas_metas_descricao" class="r" accesskey="U">Valor</label>
							<span class="required">*</span>
						</td>
						<td class="field">
							<?php
							unset($input);
							$input['accesskey'] = 'U';
							$input['name'] = 'metas_valor';
							$input['id'] = 'metas_valor';
							$input['size'] = '50';
							$input['maxlength'] = '255';
							$input['tabindex'] = $t;
							$input['autocomplete'] = 'off';
							$input['value'] = @set_value('metas_valor', $metas->metas_valor);
							echo form_input($input);
							echo form_error('metas_valor');
							$t++;
							?>
						</td>
					</tr>
					
					<?php
					if($metas_id == NULL){
						$submittext = 'Adicionar';
					} else {
						$submittext = 'Salvar';
					}
					unset($buttons);
					$buttons[] = array('submit', 'uibutton', $submittext, 'disk1.gif', $t);
					$buttons[] = array('submit', 'uibutton icon add', 'Salvar e adicionar outro', 'disk1.gif', $t+1);
					$buttons[] = array('cancel', 'uibutton icon prev', 'Cancelar', 'arr-left.gif', $t+2, site_url('contabilidade/metas'));
					$this->load->view('parts/buttons', array('buttons' => $buttons));
					?>

				</table>
			</form>
		</div>
	</div>
</div>