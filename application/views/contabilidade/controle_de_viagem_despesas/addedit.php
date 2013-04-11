<script src="<?php echo $this->config->item('base_url').''; ?>js/jquery-1.3.2.min.js" type="text/javascript"></script>
<script src="<?php echo $this->config->item('base_url').''; ?>js/jquery_ui_datepicker/jquery_ui_datepicker.js" type="text/javascript"></script>
<script src="<?php echo $this->config->item('base_url').''; ?>js/jquery_ui_datepicker/i18n/ui.datepicker-pt-BR.js" type="text/javascript"></script>
<script src="<?php echo $this->config->item('base_url').''; ?>js/jquery_ui_datepicker/timepicker_plug/timepicker.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('base_url').''; ?>js/jquery_ui_datepicker/timepicker_plug/css/style.css">
<link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('base_url').''; ?>js/jquery_ui_datepicker/smothness/jquery_ui_datepicker.css">

<script type="text/javascript">
	/* <![CDATA[ */
		$(function() {
				$('#controle_de_viagem_despesas_data').datepicker({
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
	
	<div class="box"> 
		<h2> 
			<a id="toggle-infologin">Informações</a> 
		</h2> 
		<div class="block" id="infologin"> 
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
			<a href="#" id="toggle-forms">EDITAR DESPESAS</a>
		</h2>
		<div class="block" id="forms">
			<?php echo form_open('contabilidade/controle_de_viagem_despesas/salvar', NULL, array('controle_de_viagem_despesas_id' => $controle_de_viagem_despesas_id, 'controle_de_viagem_despesas_controle_de_viagem_viagens_id' => 1)); $t = 1; ?>

			<?php if($controle_de_viagem_despesas_id == NULL){ ?><?php } ?>

				<table class="form" cellpadding="6" cellspacing="0" border="0" width="100%">
				
				<tr>
						<td class="caption">
							<label for="controle_de_viagem_despesas_data" class="r" accesskey="N"><u>D</u>ata</label>
							
						</td>
						<td class="field">
							<?php
							unset($input);
							$input['accesskey'] = 'N';
							$input['name'] = 'controle_de_viagem_despesas_data';
							$input['id'] = 'controle_de_viagem_despesas_data';
							$input['size'] = '60';
							//$input['maxlength'] = '255';
							$input['tabindex'] = $t;
							$input['autocomplete'] = 'off';
							$input['value'] = @set_value('controle_de_viagem_despesas_data', $pre_os->controle_de_viagem_despesas_data);
							echo form_input($input);
							$t++;
							?>
						</td>
					</tr>
					
					<tr>
						<td class="caption">
							<label for="controle_de_viagem_despesas_controle_de_viagem_despesas_tipos_id" class="r" accesskey="G"><u>T</u>ipo</label>
						</td>
						<td class="field">
							<?php
							echo form_dropdown('controle_de_viagem_despesas_controle_de_viagem_despesas_tipos_id', $despesas_tipos, set_value('controle_de_viagem_despesas_controle_de_viagem_despesas_tipos_id', (isset($controle_de_viagem_despesas->controle_de_viagem_despesas_controle_de_viagem_despesas_tipos_id) ? $controle_de_viagem_despesas->controle_de_viagem_despesas_controle_de_viagem_despesas_tipos_id : 0)), 'tabindex="'.$t.'"');
							$t++;
							?>
							
						</td>
					</tr>
					
					<tr>
						<td class="caption">
							<label for="controle_de_viagem_despesas_valor" class="r" accesskey="N"><u>V</u>alor</label>
							
						</td>
						<td class="field">
							<?php
							unset($input);
							$input['accesskey'] = 'N';
							$input['name'] = 'controle_de_viagem_despesas_valor';
							$input['id'] = 'controle_de_viagem_despesas_valor';
							$input['size'] = '60';
							//$input['maxlength'] = '255';
							$input['tabindex'] = $t;
							$input['autocomplete'] = 'off';
							$input['value'] = @set_value('controle_de_viagem_despesas_valor', $pre_os->controle_de_viagem_despesas_valor);
							echo form_input($input);
							$t++;
							?>
						</td>
					</tr>
					
					<?php
					if($controle_de_viagem_despesas_id == NULL){
						$submittext = 'Adicionar';
					} else {
						$submittext = 'Salvar';
					}
					unset($buttons);
					$buttons[] = array('submit', 'uibutton', $submittext, 'disk1.gif', $t);
					$buttons[] = array('submit', 'uibutton icon add', 'Salvar e adicionar outra', 'disk1.gif', $t+1);
					$buttons[] = array('cancel', 'uibutton icon prev', 'Cancelar', 'arr-left.gif', $t+2, site_url('contabilidade/controle_de_viagem_despesas'));
					$this->load->view('parts/buttons', array('buttons' => $buttons));
					?>

				</table>
			</form>
		</div>
	</div>
</div>