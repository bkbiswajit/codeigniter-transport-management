<?php echo datepicker(); ?>
<script type="text/javascript">
	$(function() {
			$('#controle_de_viagem_agenda_data').datepicker({
				userLang	: 'pt-BR',
				americanMode: false,
			});		
		});
</script>

<div class="grid_3">
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
	/*
	$errors = validation_errors(); 
	if($errors){
		echo '<div class="grid_16"><div class="box_error"><h2>' . $errors . '</h2></div></div>';
	}
	*/
?>

<div class="grid_13">

	<div class="box">
		<h2>
			<a href="#" id="toggle-forms">CONTROLE DE VIAGENS # <?php echo $controle_de_viagem_agenda_id; ?></a>
		</h2>
		<div class="block" id="forms">
			<?php echo form_open('contabilidade/controle_de_viagem_agenda/salvar', NULL, array('controle_de_viagem_agenda_id' => $controle_de_viagem_agenda_id, 'controle_de_viagem_agenda_caminhao_id_antigo' => isset($controle_de_viagem_agenda->controle_de_viagem_agenda_caminhao_id) ? $controle_de_viagem_agenda->controle_de_viagem_agenda_caminhao_id : '')); $t = 1; ?>

			<?php if($controle_de_viagem_agenda_id == NULL){ ?><?php } ?>

				<table class="form" cellpadding="6" cellspacing="0" border="0" width="100%">
					
					<tr>
						<td class="caption">
							<label for="controle_de_viagem_agenda_transportadoras_id" class="r" accesskey="G"><u>T</u>ransportadora</label>
						</td>
						<td class="field">
							<?php
							echo form_dropdown('controle_de_viagem_agenda_transportadoras_id', $transportadoras, set_value('controle_de_viagem_agenda_transportadoras_id', (isset($controle_de_viagem_agenda->controle_de_viagem_agenda_transportadoras_id) ? $controle_de_viagem_agenda->controle_de_viagem_agenda_transportadoras_id : 0)), 'tabindex="'.$t.'"');
							echo form_error('controle_de_viagem_agenda_transportadoras_id');
							$t++;
							?>
							
						</td>
					</tr>
					
					<tr>
						<td class="caption">
							<label for="controle_de_viagem_agenda_motorista_id" class="r" accesskey="G"><u>M</u>otorista</label>
						</td>
						<td class="field">
							<?php
							echo form_dropdown('controle_de_viagem_agenda_motorista_id', $motoristas, set_value('controle_de_viagem_agenda_motorista_id', (isset($controle_de_viagem_agenda->controle_de_viagem_agenda_motorista_id) ? $controle_de_viagem_agenda->controle_de_viagem_agenda_motorista_id : 0)), 'tabindex="'.$t.'"');
							echo form_error('controle_de_viagem_agenda_motorista_id');
							$t++;
							?>
							
						</td>
					</tr>
					
					<tr>
						<td class="caption">
							<label for="controle_de_viagem_agenda_caminhoes_id" class="r" accesskey="G"><u>F</u>rota</label>
						</td>
						<td class="field">
							<?php
							echo form_dropdown('controle_de_viagem_agenda_caminhoes_id', $frotas, set_value('controle_de_viagem_agenda_caminhoes_id', (isset($controle_de_viagem_agenda->controle_de_viagem_agenda_caminhao_id) ? $controle_de_viagem_agenda->controle_de_viagem_agenda_caminhao_id : 0)), 'tabindex="'.$t.'"');
							echo form_error('controle_de_viagem_agenda_caminhoes_id');
							$t++;
							?>
							
						</td>
					</tr>
					
					<tr>
						<td class="caption">
							<label for="controle_de_viagem_agenda_clientes_id" class="r" accesskey="G"><u>C</u>liente</label>
						</td>
						<td class="field">
							<?php
							echo form_dropdown('controle_de_viagem_agenda_clientes_id', $clientes, set_value('controle_de_viagem_agenda_clientes_id', (isset($controle_de_viagem_agenda->controle_de_viagem_agenda_clientes_id) ? $controle_de_viagem_agenda->controle_de_viagem_agenda_clientes_id : 0)), 'tabindex="'.$t.'"');
							echo form_error('controle_de_viagem_agenda_clientes_id');
							$t++;
							?>
						</td>
					</tr>
					
					<tr>
						<td class="caption">
							<label for="controle_de_viagem_agenda_origem_id" class="r" accesskey="G"><u>O</u>rigem</label>
						</td>
						<td class="field">
							<?php
							echo form_dropdown('controle_de_viagem_agenda_origem_id', $origens, set_value('controle_de_viagem_agenda_origem_id', (isset($controle_de_viagem_agenda->controle_de_viagem_agenda_origem_id) ? $controle_de_viagem_agenda->controle_de_viagem_agenda_origem_id : 0)), 'tabindex="'.$t.'"');
							echo form_error('controle_de_viagem_agenda_origem_id');
							$t++;
							?>
						</td>
					</tr>
					
					<tr>
						<td class="caption">
							<label for="controle_de_viagem_agenda_destino_id" class="r" accesskey="G"><u>D</u>estino</label>
						</td>
						<td class="field">
							<?php
							echo form_dropdown('controle_de_viagem_agenda_destino_id', $destinos, set_value('controle_de_viagem_agenda_destino_id', (isset($controle_de_viagem_agenda->controle_de_viagem_agenda_destino_id) ? $controle_de_viagem_agenda->controle_de_viagem_agenda_destino_id : 0)), 'tabindex="'.$t.'"');
							echo form_error('controle_de_viagem_agenda_destino_id');
							$t++;
							?>
						</td>
					</tr>
					
					<tr>
						<td class="caption">
							<label for="controle_de_viagem_agenda_data" class="r" accesskey="N"><u>D</u>ata</label>
							
						</td>
						<td class="field">
							<?php
							unset($input);
							$input['accesskey'] = 'N';
							$input['name'] = 'controle_de_viagem_agenda_data';
							$input['id'] = 'controle_de_viagem_agenda_data';
							$input['size'] = '30';
							//$input['maxlength'] = '255';
							$input['tabindex'] = $t;
							$input['autocomplete'] = 'off';
							$input['value'] = @set_value('controle_de_viagem_agenda_data', mysql2human($controle_de_viagem_agenda->controle_de_viagem_agenda_data));
							echo form_input($input);
							echo form_error('controle_de_viagem_agenda_data');
							$t++;
							?>
						</td>
					</tr>
					
					<?php
					if($controle_de_viagem_agenda_id == NULL){
						$submittext = 'Adicionar';
					} else {
						$submittext = 'Salvar';
					}
					unset($buttons);
					$buttons[] = array('submit', 'uibutton', $submittext, 'disk1.gif', $t);
					$buttons[] = array('submit', 'uibutton icon prev', 'Salvar e adicionar outra', 'arr-left.gif', $t+1);
					$buttons[] = array('cancel', 'uibutton icon prev', 'Voltar', 'arr-left.gif', $t+2, site_url('contabilidade/controle_de_viagem_agenda'));
					$this->load->view('parts/buttons', array('buttons' => $buttons));
					?>
				</table>
			</form>
		</div>
	</div>
</div>