<?php echo datepicker(); ?>
<script type="text/javascript">
	/* <![CDATA[ */
		$(function() {
				$('#controle_de_viagem_viagens_data').datepicker({
					userLang	: 'pt-BR',
					americanMode: false,
				});		
			});
			$(function() {
				$('#controle_de_viagem_postos_data').datepicker({
					userLang	: 'pt-BR',
					americanMode: false,
				});		
			});
			$(function() {
				$('#controle_de_viagem_despesas_data').datepicker({
					userLang	: 'pt-BR',
					americanMode: false,
				});		
			});
	/* ]]&gt; */
</script>

<div class="grid_3">
	<div class="box"> 
		<h2> 
			<a id="toggle-infocadastro">Informações</a> 
		</h2> 
		<div class="block" id="infocadastro"> 
			<p><a href="#viagens">Viagens</a></p>
			<p><a href="#postos">Postos</a></p>
			<p><a href="#despesas">Despesas</a></p>
		</div> 
	</div>
</div>

<div class="grid_13">

	<div class="box">
		<h2>
			<a href="#" id="toggle-forms">CONTROLE DE VIAGENS # <?php echo $controle_de_viagem_id; ?></a>
		</h2>
		<div class="block" id="forms">
			<?php echo form_open('contabilidade/controle_de_viagem/salvar', NULL, array('controle_de_viagem_id' => $controle_de_viagem_id)); $t = 1; ?>

			<?php if($controle_de_viagem_id == NULL){ ?><?php } ?>

				<table class="form" cellpadding="6" cellspacing="0" border="0" width="100%">
					
					<tr>
						<td class="caption">
							<label for="controle_de_viagem_transportadoras_id" class="r" accesskey="G"><u>T</u>ransportadora</label>
						</td>
						<td class="field">
							<?php
							echo form_dropdown('controle_de_viagem_transportadoras_id', $transportadoras, set_value('controle_de_viagem_transportadoras_id', (isset($controle_de_viagem->controle_de_viagem_transportadoras_id) ? $controle_de_viagem->controle_de_viagem_transportadoras_id : 0)), 'tabindex="'.$t.'"');
							$t++;
							?>
							
						</td>
					</tr>
					
					<tr>
						<td class="caption">
							<label for="controle_de_viagem_motorista_id" class="r" accesskey="G"><u>M</u>otorista</label>
						</td>
						<td class="field">
							<?php
							echo form_dropdown('controle_de_viagem_motorista_id', $motoristas, set_value('controle_de_viagem_motorista_id', (isset($controle_de_viagem->controle_de_viagem_motorista_id) ? $controle_de_viagem->controle_de_viagem_motorista_id : 0)), 'tabindex="'.$t.'"');
							$t++;
							?>
							
						</td>
					</tr>
					
					<tr>
						<td class="caption">
							<label for="controle_de_viagem_caminhoes_id" class="r" accesskey="G"><u>C</u>aminhão</label>
						</td>
						<td class="field">
							<?php
							echo form_dropdown('controle_de_viagem_caminhoes_id', $frotas, set_value('controle_de_viagem_caminhoes_id', (isset($controle_de_viagem->controle_de_viagem_caminhao_id) ? $controle_de_viagem->controle_de_viagem_caminhao_id : 0)), 'tabindex="'.$t.'"');
							$t++;
							?>
							
						</td>
					</tr>
					
					<tr>
						<td class="caption">
							<label for="controle_de_viagem_km_inicial" class="r" accesskey="N"><u>K</u>M Inicial</label>
							
						</td>
						<td class="field">
							<?php
							unset($input);
							$input['accesskey'] = 'N';
							$input['name'] = 'controle_de_viagem_km_inicial';
							$input['id'] = 'controle_de_viagem_km_inicial';
							$input['size'] = '30';
							//$input['maxlength'] = '255';
							$input['tabindex'] = $t;
							$input['autocomplete'] = 'off';
							$input['value'] = @set_value('controle_de_viagem_km_inicial', $controle_de_viagem->controle_de_viagem_km_inicial);
							echo form_input($input);
							echo form_error('controle_de_viagem_km_inicial');
							$t++;
							?>
						</td>
					</tr>
					
					<tr>
						<td class="caption">
							<label for="controle_de_viagem_km_final" class="r" accesskey="N"><u>K</u>M Final</label>
							
						</td>
						<td class="field">
							<?php
							unset($input);
							$input['accesskey'] = 'N';
							$input['name'] = 'controle_de_viagem_km_final';
							$input['id'] = 'controle_de_viagem_km_final';
							$input['size'] = '30';
							//$input['maxlength'] = '255';
							$input['tabindex'] = $t;
							$input['autocomplete'] = 'off';
							$input['value'] = @set_value('controle_de_viagem_km_final', $controle_de_viagem->controle_de_viagem_km_final);
							echo form_input($input);
							echo form_error('controle_de_viagem_km_final');
							$t++;
							?>
						</td>
					</tr>
					<!--
					<tr>
						<td class="caption">
							<label for="controle_de_viagem_horimetro" class="r" accesskey="N"><u>H</u>orímetro</label>
							
						</td>
						<td class="field">
							<?php
							unset($input);
							$input['accesskey'] = 'N';
							$input['name'] = 'controle_de_viagem_horimetro';
							$input['id'] = 'controle_de_viagem_horimetro';
							$input['size'] = '30';
							//$input['maxlength'] = '255';
							$input['tabindex'] = $t;
							$input['autocomplete'] = 'off';
							$input['value'] = @set_value('controle_de_viagem_horimetro', $controle_de_viagem->controle_de_viagem_horimetro);
							echo form_input($input);
							echo form_error('controle_de_viagem_horimetro');
							$t++;
							?>
						</td>
					</tr>
					
					<tr>
						<td class="caption">
							<label for="controle_de_viagem_horimetro_litros" class="r" accesskey="N"><u>H</u>orímetro Litros</label>
							
						</td>
						<td class="field">
							<?php
							unset($input);
							$input['accesskey'] = 'N';
							$input['name'] = 'controle_de_viagem_horimetro_litros';
							$input['id'] = 'controle_de_viagem_horimetro_litros';
							$input['size'] = '30';
							//$input['maxlength'] = '255';
							$input['tabindex'] = $t;
							$input['autocomplete'] = 'off';
							$input['value'] = @set_value('controle_de_viagem_horimetro_litros', $controle_de_viagem->controle_de_viagem_horimetro_litros);
							echo form_input($input);
							echo form_error('controle_de_viagem_horimetro_litros');
							$t++;
							?>
						</td>
					</tr>
					-->
					<?php
					if($controle_de_viagem_id == NULL){
						$submittext = 'Adicionar';
					} else {
						$submittext = 'Salvar';
					}
					unset($buttons);
					$buttons[] = array('submit', 'uibutton', $submittext, 'disk1.gif', $t);
					$buttons[] = array('cancel', 'uibutton icon prev', 'Cancelar', 'arr-left.gif', $t+1, site_url('contabilidade/controle_de_viagem'));
					//$buttons[] = array('cancel', 'uibutton icon prev', 'Voltar', 'arr-left.gif', $t+2, site_url('contabilidade/controle_de_viagem'));
					$this->load->view('parts/buttons', array('buttons' => $buttons));
					?>
				</table>
			</form>
		</div>
	</div>


<?php if($controle_de_viagem_id != NULL){ ?>

<div class="grid_16">
	<div class="box">
		<h2>
			<a name="viagens" href="#viagens" id="toggle-forms">VIAGENS</a>
		</h2>
		<div class="block" id="forms">
			<?php echo form_open('contabilidade/controle_de_viagem_viagens/salvar', 'id="viagens_form"', array('controle_de_viagem_viagens_controle_de_viagem_viagens_id' => $controle_de_viagem_id)); ?>

			<?php if($controle_de_viagem_id == NULL){ ?><?php } ?>

				<table class="form" cellpadding="6" cellspacing="0" border="0" width="100%">
					
					<tr>
						<td class="caption">
							<label for="controle_de_viagem_viagens_data" class="r" accesskey="N"><u>D</u>ata</label>
							
						</td>
						<td class="field">
							<?php
							unset($input);
							$input['accesskey'] = 'N';
							$input['name'] = 'controle_de_viagem_viagens_data';
							$input['id'] = 'controle_de_viagem_viagens_data';
							$input['size'] = '30';
							//$input['maxlength'] = '255';
							$input['tabindex'] = $t;
							$input['autocomplete'] = 'off';
							$input['value'] = @set_value('controle_de_viagem_viagens_data', mysql2human($controle_de_viagem->controle_de_viagem_viagens_data));
							echo form_input($input);
							$t++;
							?>
						</td>
					</tr>
					
					<tr>
						<td class="caption">
							<label for="controle_de_viagem_viagens_clientes_id" class="r" accesskey="G"><u>C</u>liente</label>
						</td>
						<td class="field">
							<?php
							echo form_dropdown('controle_de_viagem_viagens_clientes_id', $clientes, set_value('controle_de_viagem_viagens_clientes_id', (isset($controle_de_viagem->controle_de_viagem_viagens_clientes_id) ? $controle_de_viagem->controle_de_viagem_viagens_clientes_id : 0)), 'tabindex="'.$t.'"');
							$t++;
							?>
						</td>
					</tr>
					
					<tr>
						<td class="caption">
							<label for="controle_de_viagem_viagens_origem_id" class="r" accesskey="G"><u>O</u>rigem</label>
						</td>
						<td class="field">
							<?php
							echo form_dropdown('controle_de_viagem_viagens_origem_id', $origens, set_value('controle_de_viagem_viagens_origem_id', (isset($controle_de_viagem->controle_de_viagem_viagens_origem_id) ? $controle_de_viagem->controle_de_viagem_viagens_origem_id : 0)), 'tabindex="'.$t.'"');
							$t++;
							?>
						</td>
					</tr>
					
					<tr>
						<td class="caption">
							<label for="controle_de_viagem_viagens_destino_id" class="r" accesskey="G"><u>D</u>estino</label>
						</td>
						<td class="field">
							<?php
							echo form_dropdown('controle_de_viagem_viagens_destino_id', $destinos, set_value('controle_de_viagem_viagens_destino_id', (isset($controle_de_viagem->controle_de_viagem_viagens_destino_id) ? $controle_de_viagem->controle_de_viagem_viagens_destino_id : 0)), 'tabindex="'.$t.'"');
							$t++;
							?>
						</td>
					</tr>
					
					<tr>
						<td class="caption">
							<label for="controle_de_viagem_viagens_valor_frete" class="r" accesskey="N"><u>V</u>alor Frete</label>
							
						</td>
						<td class="field">
							<?php
							unset($input);
							$input['accesskey'] = 'N';
							$input['name'] = 'controle_de_viagem_viagens_valor_frete';
							$input['id'] = 'controle_de_viagem_viagens_valor_frete';
							$input['size'] = '30';
							//$input['maxlength'] = '255';
							$input['tabindex'] = $t;
							$input['autocomplete'] = 'off';
							$input['value'] = @set_value('controle_de_viagem_viagens_valor_frete', $controle_de_viagem->controle_de_viagem_viagens_valor_frete);
							echo form_input($input);
							$t++;
							?>
						</td>
					</tr>
					
					<tr>
						<td class="caption">
							<label for="controle_de_viagem_viagens_valor_frete" class="r" accesskey="N"><u>B</u>onus %</label>
							
						</td>
						<td class="field">
							<?php
							unset($input);
							$input['accesskey'] = 'N';
							$input['name'] = 'controle_de_viagem_viagens_bonus';
							$input['id'] = 'controle_de_viagem_viagens_bonus';
							$input['size'] = '30';
							//$input['maxlength'] = '255';
							$input['tabindex'] = $t;
							$input['autocomplete'] = 'off';
							$input['value'] = @set_value('controle_de_viagem_viagens_bonus', $controle_de_viagem->controle_de_viagem_viagens_bonus);
							echo form_input($input);
							$t++;
							?>
						</td>
					</tr>
					
					<?php
					if($controle_de_viagem_id == NULL){
						$submittext = 'Adicionar';
					} else {
						$submittext = 'Adicionar';
					}
					unset($buttons);
					$buttons[] = array('submit', 'uibutton', $submittext, 'disk1.gif', $t);
					$this->load->view('parts/buttons', array('buttons' => $buttons));
					?>

				</table>
			</form>
		</div>
		<hr />
		<!-- the resultado of the search will be rendered inside this div -->
		<div id="resultado_viagens">
			<?php if($controle_de_viagem_viagens != 0){ ?>
			<div id="content_viagens" class="grid_16">
					<div class="block" id="tables">
						<table class="list" width="100%" cellpadding="0" cellspacing="0" border="0">
							<col /><col /><col />
							<thead>
							<tr class="heading">
								<td class="h">ID</td>
								<td class="h">DATA</td>
								<td class="h">CLIENTE</td>
								<td class="h">ORIGEM</td>
								<td class="h">DESTINO</td>
								<td class="h">VALOR/FRETE</td>
								<td class="h">COMISSÃO</td>
								<td class="h" title=""></td>
							</tr>
							</thead>
							<tbody>
							<?php foreach ($controle_de_viagem_viagens as $controle_de_viagem_viagens) { ?>
							<tr class="tr">
								<td class="m"><?php echo $controle_de_viagem_viagens->controle_de_viagem_viagens_id;?></td>										
								<td class="m"><?php echo mysql2human($controle_de_viagem_viagens->controle_de_viagem_viagens_data); ?></td>										
								<td class="m"><?php echo $controle_de_viagem_viagens->clientes_descricao;?></td>
								<td class="m"><?php echo $controle_de_viagem_viagens->controle_de_viagem_origem_descricao;?></td>										
								<td class="m"><?php echo $controle_de_viagem_viagens->controle_de_viagem_destino_descricao;?></td>										
								<td class="m"><?php echo brl($controle_de_viagem_viagens->controle_de_viagem_viagens_valor_frete);?></td>
								<td class="m" title="COMISSÃO: <?php echo $motoristas_comissao; ?>%"><?php echo brl($controle_de_viagem_viagens->controle_de_viagem_viagens_valor_frete*$motoristas_comissao/100);?></td>
								<td class="currency">
									<?php echo anchor('contabilidade/controle_de_viagem_viagens/ajax_excluir/'.$controle_de_viagem_viagens->controle_de_viagem_viagens_id . '/' .$controle_de_viagem_id, 'Excluir', array('onClick'=>'return deletechecked(\' '.base_url().'contabilidade/controle_de_viagem_viagens/ajax_excluir/'.$controle_de_viagem_viagens->controle_de_viagem_viagens_id.'/' . $controle_de_viagem_id . '    \')')); ?>
								</td>
							</tr>	
							<?php } ?>
							</tbody>
							<tfoot>
								<tr>
									<th>TOTAL</th>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td><?php echo brl($controle_de_viagem_viagens_total);?></td>	
									<td><?php echo brl($controle_de_viagem_viagens_total*$motoristas_comissao/100);?></td>	
									<td></td>
								</tr>
							</tfoot>
						</table>
					</div>
			</div>
		</div>
		<?php } ?>
	</div>
</div>



<div class="grid_16">
	<div class="box">
		<h2>
			<a name="postos" href="#postos" id="toggle-forms">POSTOS</a>
		</h2>
		<div class="block" id="forms">
			<?php echo form_open('contabilidade/controle_de_viagem_postos/salvar', 'id="postos_form"', array('controle_de_viagem_postos_controle_de_viagem_viagens_id' => $controle_de_viagem_id)); ?>

			<?php if($controle_de_viagem_id == NULL){ ?><?php } ?>

				<table class="form" cellpadding="6" cellspacing="0" border="0" width="100%">
					
					<tr>
						<td class="caption">
							<label for="controle_de_viagem_postos_data" class="r" accesskey="N"><u>D</u>ata</label>
							
						</td>
						<td class="field">
							<?php
							unset($input);
							$input['accesskey'] = 'N';
							$input['name'] = 'controle_de_viagem_postos_data';
							$input['id'] = 'controle_de_viagem_postos_data';
							$input['size'] = '30';
							//$input['maxlength'] = '255';
							$input['tabindex'] = $t;
							$input['autocomplete'] = 'off';
							$input['value'] = @set_value('controle_de_viagem_postos_data', mysql2human($controle_de_viagem->controle_de_viagem_postos_data));
							echo form_input($input);
							$t++;
							?>
						</td>
					</tr>
					
					
					<tr>
						<td class="caption">
							<label for="controle_de_viagem_postos_postos_id" class="r" accesskey="G"><u>P</u>osto</label>
						</td>
						<td class="field">
							<?php
							echo form_dropdown('controle_de_viagem_postos_postos_id', $postos, set_value('controle_de_viagem_postos_postos_id', (isset($controle_de_viagem->controle_de_viagem_postos_postos_id) ? $controle_de_viagem->controle_de_viagem_postos_postos_id : 0)), 'tabindex="'.$t.'"');
							$t++;
							?>
							
						</td>
					</tr>
					
					<tr>
						<td class="caption">
							<label for="controle_de_viagem_postos_litros" class="r" accesskey="N"><u>L</u>itros</label>
							
						</td>
						<td class="field">
							<?php
							unset($input);
							$input['accesskey'] = 'N';
							$input['name'] = 'controle_de_viagem_postos_litros';
							$input['id'] = 'controle_de_viagem_postos_litros';
							$input['size'] = '30';
							//$input['maxlength'] = '255';
							$input['tabindex'] = $t;
							$input['autocomplete'] = 'off';
							$input['value'] = @set_value('controle_de_viagem_postos_litros', $controle_de_viagem->controle_de_viagem_postos_litros);
							echo form_input($input);
							$t++;
							?>
						</td>
					</tr>
					
					<tr>
						<td class="caption">
							<label for="controle_de_viagem_postos_valor_litro" class="r" accesskey="N"><u>P</u>reço/Litro</label>
							
						</td>
						<td class="field">
							<?php
							unset($input);
							$input['accesskey'] = 'N';
							$input['name'] = 'controle_de_viagem_postos_valor_litro';
							$input['id'] = 'controle_de_viagem_postos_valor_litro';
							$input['size'] = '30';
							//$input['maxlength'] = '255';
							$input['tabindex'] = $t;
							$input['autocomplete'] = 'off';
							$input['value'] = @set_value('controle_de_viagem_postos_valor_litro', $controle_de_viagem->controle_de_viagem_postos_valor_litro);
							echo form_input($input);
							$t++;
							?>
						</td>
					</tr>
					
					<?php
					$submittext = 'Adicionar';
					unset($buttons);
					$buttons[] = array('submit', 'uibutton', $submittext, 'disk1.gif', $t);
					$this->load->view('parts/buttons', array('buttons' => $buttons));
					?>

				</table>
			</form>
		</div>
		<hr />
		<!-- the resultado of the search will be rendered inside this div -->
		<div id="resultado_postos">
			<?php if($controle_de_viagem_postos != 0){ ?>
			<div id="content_postos" class="grid_16">
					<div class="block" id="tables">

						<table class="list" width="100%" cellpadding="0" cellspacing="0" border="0">
							<col /><col /><col />
							<thead>
							<tr class="heading">
								<td class="h">ID</td>
								<td class="h">DATA</td>
								<td class="h">POSTO</td>
								<td class="h">LITROS</td>
								<td class="h">R$/LITRO</td>
								<td class="h">TOTAL</td>
								<td class="h" title=""></td>
							</tr>
							</thead>
							<tbody>
							<?php $total_valor_litros = 0; ?>
							<?php foreach ($controle_de_viagem_postos as $controle_de_viagem_postos) { ?>

							<?php $total_valor_litros += $controle_de_viagem_postos->controle_de_viagem_postos_litros*$controle_de_viagem_postos->controle_de_viagem_postos_valor_litro; ?>


							<tr class="tr">
								<td class="m"><?php echo $controle_de_viagem_postos->controle_de_viagem_postos_id;?></td>										
								<td class="m"><?php echo mysql2human($controle_de_viagem_postos->controle_de_viagem_postos_data); ?></td>										
								<td class="m"><?php echo $controle_de_viagem_postos->postos_descricao;?></td>										
								<td class="m"><?php echo $controle_de_viagem_postos->controle_de_viagem_postos_litros;?></td>										
								<td class="m"><?php echo brl($controle_de_viagem_postos->controle_de_viagem_postos_valor_litro);?></td>
								<td class="m"><?php echo brl($controle_de_viagem_postos->controle_de_viagem_postos_litros*$controle_de_viagem_postos->controle_de_viagem_postos_valor_litro);?></td>
								<td class="currency">
									<?php echo anchor('contabilidade/controle_de_viagem_postos/ajax_excluir/'.$controle_de_viagem_postos->controle_de_viagem_postos_id . '/' .$controle_de_viagem_id, 'Excluir', array('onClick'=>'return deletechecked(\' '.base_url().'contabilidade/controle_de_viagem_postos/ajax_excluir/'.$controle_de_viagem_postos->controle_de_viagem_postos_id . '/' . $controle_de_viagem_id . '\')')); ?>
								</td>
							</tr>
							<?php } ?>
							</tbody>
							<tfoot>
								<tr>
									<th>TOTAL</th>
									<td></td>
									<td></td>
									<td><?php echo $controle_de_viagem_postos_litros_total;?></td>	
									<td></td>
									<td><?php echo brl($total_valor_litros); ?></td>	
									<td></td>
								</tr>
							</tfoot>
						</table>
				</div>
			</div>
		</div>
		<?php } ?>
	</div>
</div>



<div class="grid_16">
	<div class="box">
		<h2>
			<a name="despesas" href="#despesas" id="toggle-forms">DESPESAS</a>
		</h2>
		<div class="block" id="forms">
			<?php echo form_open('contabilidade/controle_de_viagem_despesas/salvar', 'id="despesas_form"', array('controle_de_viagem_despesas_controle_de_viagem_viagens_id' => $controle_de_viagem_id)); ?>

			<?php if($controle_de_viagem_id == NULL){ ?><?php } ?>

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
							$input['size'] = '30';
							//$input['maxlength'] = '255';
							$input['tabindex'] = $t;
							$input['autocomplete'] = 'off';
							$input['value'] = @set_value('controle_de_viagem_despesas_data', mysql2human($controle_de_viagem->controle_de_viagem_despesas_data));
							echo form_input($input);
							$t++;
							?>
						</td>
					</tr>
					
					
					<tr>
						<td class="caption">
							<label for="controle_de_viagem_despesas_controle_de_viagem_despesas_tipos_id" class="r" accesskey="G"><u>D</u>espesa</label>
						</td>
						<td class="field">
							<?php
							echo form_dropdown('controle_de_viagem_despesas_controle_de_viagem_despesas_tipos_id', $despesas_tipos, set_value('controle_de_viagem_despesas_controle_de_viagem_despesas_tipos_id', (isset($controle_de_viagem->controle_de_viagem_despesas_controle_de_viagem_despesas_tipos_id) ? $controle_de_viagem->controle_de_viagem_despesas_controle_de_viagem_despesas_tipos_id : 0)), 'tabindex="'.$t.'"');
							$t++;
							?>
							
						</td>
					</tr>
					
					<tr>
						<td class="caption">
							<label for="controle_de_viagem_despesas_valor" class="r" accesskey="N"><u>V</u>alor&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
							
						</td>
						<td class="field">
							<?php
							unset($input);
							$input['accesskey'] = 'N';
							$input['name'] = 'controle_de_viagem_despesas_valor';
							$input['id'] = 'controle_de_viagem_despesas_valor';
							$input['size'] = '30';
							//$input['maxlength'] = '255';
							$input['tabindex'] = $t;
							$input['autocomplete'] = 'off';
							$input['value'] = @set_value('controle_de_viagem_despesas_valor', $controle_de_viagem->controle_de_viagem_despesas_valor);
							echo form_input($input);
							$t++;
							?>
						</td>
					</tr>
					
					
					<?php
					$submittext = 'Adicionar';
					unset($buttons);
					$buttons[] = array('submit', 'uibutton', $submittext, 'disk1.gif', $t);
					$this->load->view('parts/buttons', array('buttons' => $buttons));
					?>
				</table>
			</form>
		</div>
		<hr />
		<!-- the resultado of the search will be rendered inside this div -->
		<div id="resultado_despesas">
			<?php if($controle_de_viagem_despesas != 0){ ?>
			<div id="content_despesas" class="grid_16">
				<div class="block" id="tables">
					<table class="list" width="100%" cellpadding="0" cellspacing="0" border="0">
						<col /><col /><col />
						<thead>
						<tr class="heading">
							<td class="h">ID</td>
							<td class="h">DATA</td>
							<td class="h">DESPESA</td>
							<td class="h">VALOR</td>
							<td></td>
						</tr>
						</thead>
						<tbody>
							<?php foreach ($controle_de_viagem_despesas as $controle_de_viagem_despesas) { ?>
							<tr class="tr">
								<td class="m"><?php echo $controle_de_viagem_despesas->controle_de_viagem_despesas_id;?></td>										
								<td class="m"><?php echo mysql2human($controle_de_viagem_despesas->controle_de_viagem_despesas_data); ?></td>										
								<td class="m"><?php echo $controle_de_viagem_despesas->controle_de_viagem_despesas_tipos_descricao;?></td>										
								<td class="m"><?php echo brl($controle_de_viagem_despesas->controle_de_viagem_despesas_valor);?></td>										
								<td class="currency">
									<?php echo anchor('contabilidade/controle_de_viagem_despesas/ajax_excluir/'.$controle_de_viagem_despesas->controle_de_viagem_despesas_id . '/' .$controle_de_viagem_id , 'Excluir', array('onClick'=>'return deletechecked(\' '.base_url().'contabilidade/controle_de_viagem_despesas/ajax_excluir/'.$controle_de_viagem_despesas->controle_de_viagem_despesas_id . '/' .$controle_de_viagem_id . '\')')); ?>
								</td>
							</tr>
						<?php } ?>
						</tbody>
						<tfoot>
							<tr>
								<th>TOTAL</th>
								<td></td>
								<td></td>
								<td><?php echo brl($controle_de_viagem_despesas_total); ?></td>	
								<td></td>
							</tr>
						</tfoot>
					</table>
				</div>
			</div>
		</div>
		<?php } ?>
	</div>
</div>

<script>
/* attach a submit handler to the form */
$("#viagens_form").submit(function (event) {
    /* stop form from submitting normally */
    event.preventDefault();
    /* get some values from elements on the page: */
    var $form = $(this),
        controle_de_viagem_viagens_id = $form.find('input[name="controle_de_viagem_viagens_id"]').val(),
        controle_de_viagem_viagens_controle_de_viagem_viagens_id = $form.find('input[name="controle_de_viagem_viagens_controle_de_viagem_viagens_id"]').val(),
        controle_de_viagem_viagens_data = $form.find('input[name="controle_de_viagem_viagens_data"]').val(),
        controle_de_viagem_viagens_clientes_id = $form.find('select[name="controle_de_viagem_viagens_clientes_id"]').val(),
        controle_de_viagem_viagens_origem_id = $form.find('select[name="controle_de_viagem_viagens_origem_id"]').val(),
        controle_de_viagem_viagens_destino_id = $form.find('select[name="controle_de_viagem_viagens_destino_id"]').val(),
        controle_de_viagem_viagens_valor_frete = $form.find('input[name="controle_de_viagem_viagens_valor_frete"]').val(),
        controle_de_viagem_viagens_bonus = $form.find('input[name="controle_de_viagem_viagens_bonus"]').val(),
        url = $form.attr('action');
    /* Send the data using post and put the resultados in a div */
    $.post(url, {
        controle_de_viagem_viagens_id: controle_de_viagem_viagens_id,
        controle_de_viagem_viagens_controle_de_viagem_viagens_id: controle_de_viagem_viagens_controle_de_viagem_viagens_id,
        controle_de_viagem_viagens_data: controle_de_viagem_viagens_data,
        controle_de_viagem_viagens_clientes_id: controle_de_viagem_viagens_clientes_id,
        controle_de_viagem_viagens_origem_id: controle_de_viagem_viagens_origem_id,
        controle_de_viagem_viagens_destino_id: controle_de_viagem_viagens_destino_id,
        controle_de_viagem_viagens_valor_frete: controle_de_viagem_viagens_valor_frete,
        controle_de_viagem_viagens_bonus: controle_de_viagem_viagens_bonus
    }, function (data) {
        if (data == 'ERRO') {
            alert('ERRO NO PREENCHIMENTO DOS CAMPOS');
        } else {
            var content = $(data).find('#content_viagens');
            $("#resultado_viagens").html(data);
        };
        if (data != 'ERRO') {
            $('#viagens_form').each(function () {
                this.reset();
            });
        };
    });
});
/* attach a submit handler to the form */
$("#postos_form").submit(function (event) {
    /* stop form from submitting normally */
    event.preventDefault();
    /* get some values from elements on the page: */
    var $form = $(this),
        controle_de_viagem_postos_controle_de_viagem_viagens_id = $form.find('input[name="controle_de_viagem_postos_controle_de_viagem_viagens_id"]').val(),
        controle_de_viagem_postos_data = $form.find('input[name="controle_de_viagem_postos_data"]').val(),
        controle_de_viagem_postos_postos_id = $form.find('select[name="controle_de_viagem_postos_postos_id"]').val(),
        controle_de_viagem_postos_litros = $form.find('input[name="controle_de_viagem_postos_litros"]').val(),
        controle_de_viagem_postos_valor_litro = $form.find('input[name="controle_de_viagem_postos_valor_litro"]').val(),
        url = $form.attr('action');
    /* Send the data using post and put the resultados in a div */
    $.post(url, {
        controle_de_viagem_postos_controle_de_viagem_viagens_id: controle_de_viagem_postos_controle_de_viagem_viagens_id,
        controle_de_viagem_postos_data: controle_de_viagem_postos_data,
        controle_de_viagem_postos_postos_id: controle_de_viagem_postos_postos_id,
        controle_de_viagem_postos_litros: controle_de_viagem_postos_litros,
        controle_de_viagem_postos_valor_litro: controle_de_viagem_postos_valor_litro
    }, function (data) {
        if (data == 'ERRO') {
            alert('ERRO NO PREENCHIMENTO DOS CAMPOS');
        } else {
            var content = $(data).find('#content_postos');
            $("#resultado_postos").html(data);
        };
        if (data != 'ERRO') {
            $('#postos_form').each(function () {
                this.reset();
            });
        };
    });
});
/* attach a submit handler to the form */
$("#despesas_form").submit(function (event) {
    /* stop form from submitting normally */
    event.preventDefault();
    /* get some values from elements on the page: */
    var $form = $(this),
        controle_de_viagem_despesas_controle_de_viagem_viagens_id = $form.find('input[name="controle_de_viagem_despesas_controle_de_viagem_viagens_id"]').val(),
        controle_de_viagem_despesas_data = $form.find('input[name="controle_de_viagem_despesas_data"]').val(),
        controle_de_viagem_despesas_controle_de_viagem_despesas_tipos_id = $form.find('select[name="controle_de_viagem_despesas_controle_de_viagem_despesas_tipos_id"]').val(),
        controle_de_viagem_despesas_valor = $form.find('input[name="controle_de_viagem_despesas_valor"]').val(),
        url = $form.attr('action');
    /* Send the data using post and put the resultados in a div */
    $.post(url, {
        controle_de_viagem_despesas_controle_de_viagem_viagens_id: controle_de_viagem_despesas_controle_de_viagem_viagens_id,
        controle_de_viagem_despesas_data: controle_de_viagem_despesas_data,
        controle_de_viagem_despesas_controle_de_viagem_despesas_tipos_id: controle_de_viagem_despesas_controle_de_viagem_despesas_tipos_id,
        controle_de_viagem_despesas_valor: controle_de_viagem_despesas_valor
    }, function (data) {
        if (data == 'ERRO') {
            alert('ERRO NO PREENCHIMENTO DOS CAMPOS');
        } else {
            var content = $(data).find('#content_despesas');
            $("#resultado_despesas").html(data);
        };
        if (data != 'ERRO') {
            $('#despesas_form').each(function () {
                this.reset();
            });
        };
    })
});
</script>
<script type="text/javascript">
function deletechecked(link) {
    var answer = confirm('Você realmente deseja excluir este item?')
    if (answer) {
        window.location = link;
    }
    return false;
}
</script>
<?php } ?>