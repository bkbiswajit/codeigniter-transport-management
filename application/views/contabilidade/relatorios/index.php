<?php echo datepicker();?>

<script type="text/javascript">
		$(function() {
				$('#data_inicio').datepicker({
					userLang	: 'pt-BR',
					americanMode: false,
				});		
			});
			$(function() {
				$('#data_fim').datepicker({
					userLang	: 'pt-BR',
					americanMode: false,
				});		
			});
</script>

<div class="grid_6">
	<div class="box"> 
		<h2> 
			<a id="toggle-infocadastro">Informações</a> 
		</h2> 
		<div class="block" id="forms">
				<?php echo form_open('contabilidade/relatorios/', NULL); $t = 1; ?>

					<table class="form" cellpadding="6" cellspacing="0" border="0" width="100%">
					<tr>
						<td class="caption">
							<label for="transportadoras_id" class="r" accesskey="G"><u>T</u>RANSPORTADORA</label>
						</td>
						<td class="field">
							<?php
							echo form_dropdown('transportadoras_id', $transportadoras, set_value('transportadoras_id', (isset($post_index['transportadoras_id']) ? $post_index['transportadoras_id'] : 0)), 'tabindex="'.$t.'"');
							$t++;
							?>
							
						</td>
					</tr>
					
					<tr>
						<td class="caption">
							<label for="caminhoes_id" class="r" accesskey="G"><u>F</u>ROTA</label>
						</td>
						<td class="field">
							<?php
							echo form_dropdown('caminhoes_id', $frotas, set_value('caminhoes_id', (isset($post_index['caminhoes_id']) ? $post_index['caminhoes_id'] : 0)), 'tabindex="'.$t.'"');
							$t++;
							?>
							
						</td>
					</tr>
					
					<tr>
						<td class="caption">
							<label for="motoristas_id" class="r" accesskey="G"><u>M</u>OTORISTA</label>
						</td>
						<td class="field">
							<?php
							echo form_dropdown('motoristas_id', $motoristas, set_value('motoristas_id', (isset($post_index['motoristas_id']) ? $post_index['motoristas_id'] : 0)), 'tabindex="'.$t.'"');
							$t++;
							?>
							
						</td>
					</tr>
					
					<tr>
						<td class="caption">
							<label for="controle_de_viagem_viagens_clientes_id" class="r" accesskey="G"><u>C</u>LIENTE</label>
						</td>
						<td class="field">
							<?php
							echo form_dropdown('controle_de_viagem_viagens_clientes_id', $clientes, set_value('controle_de_viagem_viagens_clientes_id', (isset($post_index['controle_de_viagem_viagens_clientes_id']) ? $post_index['controle_de_viagem_viagens_clientes_id'] : 0)), 'tabindex="'.$t.'"');
							$t++;
							?>
							
						</td>
					</tr>
					
					<tr>
						<td class="caption">
							<label for="controle_de_viagem_regioes_id" class="r" accesskey="G"><u>R</u>EGIÃO</label>
						</td>
						<td class="field">
							<?php
							echo form_dropdown('controle_de_viagem_regioes_id', $regioes, set_value('controle_de_viagem_regioes_id', (isset($post_index['controle_de_viagem_regioes_id']) ? $post_index['controle_de_viagem_regioes_id'] : 0)), 'tabindex="'.$t.'"');
							$t++;
							?>
							
						</td>
					</tr>
					
					<tr>
						<td class="caption">
							<label for="data_inicio" class="r" accesskey="N"><u>D</u>ATA INÍCIO</label>
							
						</td>
						<td class="field">
							<?php
							unset($input);
							$input['accesskey'] = 'N';
							$input['name'] = 'data_inicio';
							$input['id'] = 'data_inicio';
							$input['size'] = '30';
							//$input['maxlength'] = '255';
							$input['tabindex'] = $t;
							$input['autocomplete'] = 'off';
							$input['value'] = @set_value('data_inicio', mysql2human($post_index['data_inicio']));
							echo form_input($input);
							$t++;
							?>
						</td>
					</tr>
					
					<tr>
						<td class="caption">
							<label for="data_fim" class="r" accesskey="N"><u>D</u>ATA FIM</label>
							
						</td>
						<td class="field">
							<?php
							unset($input);
							$input['accesskey'] = 'N';
							$input['name'] = 'data_fim';
							$input['id'] = 'data_fim';
							$input['size'] = '30';
							//$input['maxlength'] = '255';
							$input['tabindex'] = $t;
							$input['autocomplete'] = 'off';
							$input['value'] = @set_value('data_fim', mysql2human($post_index['data_fim']));
							echo form_input($input);
							$t++;
							?>
						</td>
					</tr>
					
					<?php
						$buttons[] = array('submit', 'uibutton', 'Pesquisar', 'disk1.gif', $t);
						$buttons[] = array('submit', 'uibutton icon prev', 'Limpar', 'arr-left.gif', $t+1, site_url('contabilidade/relatorios'));
						$this->load->view('parts/buttons', array('buttons' => $buttons));
					?>
			</form>
			</table>
		</div>
	</div>
</div>

<div class="grid_10">
<?php if($cvs != NULL){ ?>
	<p><a class="fancybox uibutton" href="#relatorio_completo" title="RELATÓRIO COMPLETO">RELATÓRIO COMPLETO</a></p>
	<div class="box">
		<h2>
			<a href="#" id="toggle-tables">Relatório de Controle de Viagens</a>
		</h2>
		<div class="block" id="tables">

			<table class="list" width="100%" cellpadding="0" cellspacing="0" border="0">
				<col /><col /><col />
				<thead>
				<tr class="heading">
					<td class="h">ID</td>
					<td class="h">CLIENTE</td>
					<td class="h">TRANSPORTADORA</td>
					<td class="h">FROTA</td>
					<td class="h">MOTORISTA</td>
					<td class="h">ORIGEM</td>
					<td class="h">DESTINO</td>
					<td class="h">DATA</td>
					
				</tr>
				</thead>
				<tbody>
				<?php $i=1; foreach ($cvs as $cvs) { ?>
				<tr class="tr">
					<td class="m"><?php echo $i++; ?></td>
					<td class="m"><?php echo character_limiter($cvs->clientes_descricao, 5); ?></td>
					<td class="m"><?php echo character_limiter($cvs->transportadoras_descricao, 5); ?></td>
					<td class="m"><?php echo character_limiter($cvs->caminhoes_descricao, 5); ?></td>
					<td class="m"><?php echo character_limiter($cvs->motoristas_descricao, 5); ?></td>
					<td class="m"><?php echo character_limiter($cvs->controle_de_viagem_origem_descricao, 5); ?></td>
					<td class="m"><?php echo character_limiter($cvs->controle_de_viagem_destino_descricao, 5); ?></td>
					<td class="m"><?php echo mysql2human($cvs->controle_de_viagem_viagens_data); ?></td>
				</tr>
				<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<div class="grid_10">
	<div class="box">
			<h2>
				<a href="#" id="toggle-tables">Relatório de Controle de Viagens</a>
			</h2>
			<div class="block" id="tables">
			<table class="list" width="100%" cellpadding="0" cellspacing="0" border="0">
				<col /><col /><col />
				<thead>
				<tr class="heading">
					<td class="h">ITEM</td>
					<td class="h">VALOR</td>
					
				</tr>
				</thead>
				<tbody>
				<tr class="tr">
					<td class="m">KM</td>
					<td class="m"><?php echo number_format($km->soma,3,",","."); ?> M</td>
				</tr>
				<tr class="tr">
					<td class="m">LITROS</td>
					<td class="m"><?php echo number_format($litros->soma,3,",","."); ?> L</td>
				</tr>
				<tr class="tr">
					<td class="m">MÉDIA</td>
					<td class="m"><?php echo number_format($km->soma/$litros->soma,2,",","."); ?> KM/L</td>
				</tr>
				<tr class="tr">
					<td class="m">DESPESAS</td>
					<td class="m"><?php echo brl($despesas->soma); ?></td>
				</tr>
				</tbody>
			</table>
			</div>
	</div>
<a class="fancybox uibutton" href="#relatorio_completo" title="RELATÓRIO COMPLETO">RELATÓRIO COMPLETO</a>
</div>


<?php } else { ?> <div class="box_error"> <h2 align="center">nenhum resultado</h2> </div> </div> <?php } ?>

<!-- Add jQuery library -->
<!-- <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script> -->

<!-- Add mousewheel plugin (this is optional) -->
<script type="text/javascript" src="<?php echo base_url()?>assets/fancyapps-fancyBox-0ffc358/lib/jquery.mousewheel-3.0.6.pack.js"></script>

<!-- Add fancyBox -->
<link rel="stylesheet" href="<?php echo base_url()?>assets/fancyapps-fancyBox-0ffc358/source/jquery.fancybox.css?v=2.1.4" type="text/css" media="screen" />
<script type="text/javascript" src="<?php echo base_url()?>assets/fancyapps-fancyBox-0ffc358/source/jquery.fancybox.pack.js?v=2.1.4"></script>

<script type="text/javascript">
	$(document).ready(function() {
		$(".fancybox").fancybox();
	});
</script>

<div id="relatorio_completo" style="display:none;width:100%;">
<div class="grid_16">
<?php if($cvs != NULL){ ?>
	<div class="box">
		<h2>
			<a href="#" id="toggle-tables">Relatório de Controle de Viagens</a>
		</h2>
		<div class="block" id="tables">

			<table class="list" width="100%" cellpadding="0" cellspacing="0" border="0">
				<col /><col /><col />
				<thead>
				<tr class="heading">
					<td class="h">ID</td>
					<td class="h">DATA</td>
					<td class="h">CLIENTE</td>
					<td class="h">TRANSPORTADORA</td>
					<td class="h">FROTA</td>
					<td class="h">MOTORISTA</td>
					<td class="h">REGIÃO</td>
					<td class="h">ORIGEM</td>
					<td class="h">DESTINO</td>
					<td class="h">FRETE/VALOR</td>
					<td class="h">BÔNUS/FRETE</td>
					<td class="h">COMISSÃO</td>
					<td class="h">BÔNUS/COMISSÃO</td>
					
				</tr>
				</thead>
				<tbody>
				<?php $i=1; foreach ($cvs2 as $cvs2) {

				if($cvs2->controle_de_viagem_viagens_bonus == 1){
					$bonus = 0;
				}else{
					$bonus = $cvs2->controle_de_viagem_viagens_bonus/100;
				}


				?>
				<tr class="tr">
					<td class="m"><?php echo $i++; ?></td>
					<td class="m"><?php echo mysql2human($cvs2->controle_de_viagem_viagens_data); ?></td>
					<td class="m"><?php echo character_limiter($cvs2->clientes_descricao, 50); ?></td>
					<td class="m"><?php echo character_limiter($cvs2->transportadoras_descricao, 50); ?></td>
					<td class="m"><?php echo character_limiter($cvs2->caminhoes_descricao, 50); ?></td>
					<td class="m"><?php echo character_limiter($cvs2->motoristas_descricao, 50); ?></td>
					<td class="m"><?php echo character_limiter($cvs2->controle_de_viagem_regioes_descricao, 50); ?></td>
					<td class="m"><?php echo character_limiter($cvs2->controle_de_viagem_origem_descricao, 50); ?></td>
					<td class="m"><?php echo character_limiter($cvs2->controle_de_viagem_destino_descricao, 50); ?></td>
					<td class="m"><?php echo brl($cvs2->controle_de_viagem_viagens_valor_frete); ?></td>
					<td class="m"><?php echo brl($cvs2->controle_de_viagem_viagens_valor_frete*$bonus); ?></td>
					<td class="m"><?php echo brl($cvs2->controle_de_viagem_viagens_valor_frete*$cvs2->motoristas_comissao/100); ?></td>
					<td class="m"><?php echo brl($cvs2->controle_de_viagem_viagens_valor_frete*$bonus*$bonus); ?></td>
				</tr>
				<?php } ?>
				</tbody>
				<tfoot>
					<td>TOTAL</td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td><?php echo brl($cvs_sum->sum);?></td>
					<td><?php echo brl($cvs_bonus->soma); ?></td>
					<td><?php echo brl($cvs_comissao_motorista->soma) ;?></td>
					<td><?php echo brl($cvs_bonus_motorista->soma); ?></td>
				</tfoot>
			</table>
		</div>
	</div>
</div>
<div class="grid_6">
	<div class="box">
			<h2>
				<a href="#" id="toggle-tables">Relatório de Controle de Viagens</a>
			</h2>
			
			<div class="block" id="tables">
			<table class="list" width="100%" cellpadding="0" cellspacing="0" border="0">
				<col /><col /><col />
				<thead>
				<tr class="heading">
					<td class="h">ITEM</td>
					<td class="h">VALOR</td>
					
				</tr>
				</thead>
				<tbody>
				<tr class="tr">
					<td class="m">KM</td>
					<td class="m"><?php echo number_format($km->soma,3,",","."); ?> M</td>
				</tr>
				<tr class="tr">
					<td class="m">LITROS</td>
					<td class="m"><?php echo number_format($litros->soma,3,",","."); ?> L</td>
				</tr>
				<tr class="tr">
					<td class="m">MÉDIA</td>
					<td class="m"><?php echo number_format($km->soma/$litros->soma,2,",","."); ?> KM/L</td>
				</tr>
				<tr class="tr">
					<td class="m">DESPESAS</td>
					<td class="m"><?php echo brl($despesas->soma); ?></td>
				</tr>
				</tbody>
			</table>
			</div>
			
	</div>
</div>
<?php } else { ?> <div class="box_error"> <h2 align="center">nenhum resultado</h2> </div><?php } ?>
</div>