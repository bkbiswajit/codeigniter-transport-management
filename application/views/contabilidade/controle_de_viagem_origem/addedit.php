<script src="<?php echo $this->config->item('base_url').''; ?>js/jquery-1.3.2.min.js" type="text/javascript"></script>
<script src="<?php echo $this->config->item('base_url').''; ?>js/jquery_ui_datepicker/jquery_ui_datepicker.js" type="text/javascript"></script>
<script src="<?php echo $this->config->item('base_url').''; ?>js/jquery_ui_datepicker/i18n/ui.datepicker-pt-BR.js" type="text/javascript"></script>
<script src="<?php echo $this->config->item('base_url').''; ?>js/jquery_ui_datepicker/timepicker_plug/timepicker.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('base_url').''; ?>js/jquery_ui_datepicker/timepicker_plug/css/style.css">
<link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('base_url').''; ?>js/jquery_ui_datepicker/smothness/jquery_ui_datepicker.css">
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
	$errors = validation_errors(); 
	if($errors){
		echo '<div class="grid_12"><div class="box_error"><h2>' . $errors . '</h2></div></div>';
	}
?>

<div class="grid_12">
	<div class="box">
		<h2>
			<a href="#" id="toggle-forms">editar origem</a>
		</h2>
		<div class="block" id="forms">
			<?php echo form_open('contabilidade/controle_de_viagem_origem_destino/salvar', NULL, array('controle_de_viagem_origem_id' => $controle_de_viagem_origem_id)); $t = 1; ?>

			<?php if($controle_de_viagem_origem_id == NULL){ ?><?php } ?>

				<table cellpadding="6" cellspacing="0" border="0" width="100%">
					
					<tr>
						<td class="caption">
							<label for="controle_de_viagem_origem_regiao_id">Região</label>
						</td>
						<td class="field">
							<?php
							echo form_dropdown('controle_de_viagem_origem_regiao_id', $regioes, set_value('controle_de_viagem_origem_regiao_id', (isset($controle_de_viagem_origem->controle_de_viagem_origem_regiao_id) ? $controle_de_viagem_origem->controle_de_viagem_origem_regiao_id : 0)), 'tabindex="'.$t.'"');
							$t++;
							?>
							
						</td>
					</tr>
					
					<tr>
						<td class="caption">
							<label for="controle_de_viagem_origem_descricao">Nome</label>
							
						</td>
						<td class="field">
							<?php
							unset($input);
							$input['accesskey'] = 'N';
							$input['name'] = 'controle_de_viagem_origem_descricao';
							$input['id'] = 'controle_de_viagem_origem_descricao';
							$input['size'] = '60';
							//$input['maxlength'] = '255';
							$input['tabindex'] = $t;
							$input['autocomplete'] = 'off';
							$input['value'] = @set_value('controle_de_viagem_origem_descricao', $controle_de_viagem_origem->controle_de_viagem_origem_descricao);
							echo form_input($input);
							$t++;
							?>
						</td>
					</tr>
					
					<tr>
						<td class="caption">
							<label for="controle_de_viagem_origem_ativo" accesskey="E">Ativo</label>
						</td>
						<td class="field">
							<label for="controle_de_viagem_origem_ativo" class="check">
							<?php
							unset($check);
							$check['name'] = 'controle_de_viagem_origem_ativo';
							$check['id'] = 'controle_de_viagem_origem_ativo';
							$check['value'] = '1';
							$check['checked'] = @set_checkbox($check['name'], $check['value'], ($controle_de_viagem_origem->controle_de_viagem_origem_ativo == 1));
							$check['tabindex'] = $t;
							echo form_checkbox($check);
							$t++;
							?>
							</label>

						</td>
					</tr>
					
					<?php
					if($controle_de_viagem_origem_id == NULL){
						$submittext = 'Adicionar';
					} else {
						$submittext = 'Salvar';
					}
					unset($buttons);
					$buttons[] = array('submit', 'uibutton', $submittext, 'disk1.gif', $t);
					$buttons[] = array('submit', 'uibutton', 'Salvar e adicionar outra', 'disk1.gif', $t+1);
					$buttons[] = array('cancel', 'uibutton icon prev', 'Cancelar', 'arr-left.gif', $t+2, site_url('contabilidade/controle_de_viagem_origem_destino'));
					$this->load->view('parts/buttons', array('buttons' => $buttons));
					?>

				</table>
			</form>
		</div>
	</div>
</div>
