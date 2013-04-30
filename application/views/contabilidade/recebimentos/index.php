<?php echo datepicker();?>

<script type="text/javascript">
		$(function() {
				$('#recebimentos_data').datepicker({
					userLang	: 'pt-BR',
					americanMode: false,
				});		
			});
			$(function() {
				$('#recebimentos_data_recebido').datepicker({
					userLang	: 'pt-BR',
					americanMode: false,
				});		
			});
</script>

<div class="grid_16">
	<p>
		<?php echo anchor('contabilidade/recebimentos/adicionar', 'RECEBIMENTO', 'class="uibutton icon add"'); ?>
		<a class="fancybox uibutton" href="#pesquisa_avancada" title="PESQUISA AVANÇADA">PESQUISA AVANÇADA</a>
	</p>
</div>

<!-- Add jQuery library -->
<!-- <script type="text/javascript" src="<?php echo base_url()?>js/jquery-1.9.1.min.js"></script> -->
<!-- Add fancyBox -->
<link rel="stylesheet" href="<?php echo base_url()?>assets/fancyapps-fancyBox-0ffc358/source/jquery.fancybox.css?v=2.1.4" type="text/css" media="screen" />
<script type="text/javascript" src="<?php echo base_url()?>assets/fancyapps-fancyBox-0ffc358/source/jquery.fancybox.pack.js?v=2.1.4"></script>

<script type="text/javascript">
	$(document).ready(function() {
		$(".fancybox").fancybox();
	});
</script>

<div id="pesquisa_avancada" style="width:auto;display:none;">

	<div class="grid_12">
		<div class="box">
			<h2>
				<a href="#" id="toggle-forms">Editar recebimento</a>
			</h2>
			<div class="block" id="forms">
				<?php echo form_open('contabilidade/recebimentos/avancada', NULL); $t = 1; ?>

					<table class="form" cellpadding="6" cellspacing="0" border="0" width="100%">

						<tr>
							<td class="caption">
								<label for="recebimentos_transportadoras_id" class="r" accesskey="G"><u>T</u>ransportadora</label>
							</td>
							<td class="field">
								<?php
								echo form_dropdown('recebimentos_transportadoras_id', $transportadoras, set_value('recebimentos_transportadoras_id', (isset($p['recebimentos_transportadoras_id']) ? $p['recebimentos_transportadoras_id'] : 0)), 'tabindex="'.$t.'"');
								echo form_error('recebimentos_transportadoras_id');
								$t++;
								?>
								
							</td>
						</tr>

						<tr>
							<td class="caption">
								<label for="recebimentos_clientes_id" class="r" accesskey="G"><u>C</u>liente</label>
							</td>
							<td class="field">
								<?php
								echo form_dropdown('recebimentos_clientes_id', $clientes, set_value('recebimentos_clientes_id', (isset($p['recebimentos_clientes_id']) ? $p['recebimentos_clientes_id'] : 0)), 'tabindex="'.$t.'"');
								$t++;
								?>
							</td>
						</tr>
						
						<tr>
							<td class="caption">
								<label for="recebimentos_recebimentos_descricao" class="r" accesskey="U">Número</label>
								
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
								<label for="recebimentos_caminhoes_id" class="r" accesskey="G"><u>F</u>rota</label>
							</td>
							<td class="field">
								<?php
								echo form_dropdown('recebimentos_caminhoes_id', $frotas, set_value('recebimentos_caminhoes_id', (isset($p['recebimentos_caminhoes_id']) ? $p['recebimentos_caminhoes_id'] : 0)), 'tabindex="'.$t.'"');
								echo form_error('recebimentos_caminhoes_id');
								$t++;
								?>
								
							</td>
						</tr>
						
						<tr>
							<td class="caption">
								<label for="recebimentos_data" class="r" accesskey="U">Carregamento</label>
								
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
								$input['value'] = @set_value('recebimentos_data', mysql2human($p['recebimentos_data']));
								echo form_input($input);
								echo form_error('recebimentos_data');
								$t++;
								?>
							</td>
						</tr>
						
						<tr>
							<td class="caption">
								<label for="recebimentos_data_recebido" class="r" accesskey="U">Recebimento</label>
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
								$input['value'] = @set_value('recebimentos_data_recebido', mysql2human($p['recebimentos_data_recebido']));
								echo form_input($input);
								echo form_error('recebimentos_data_recebido');
								$t++;
								?>
							</td>
						</tr>
						
						<tr>
							<td class="caption">
								<label for="recebimentos_recebimentos_descricao" class="r" accesskey="U">Valor R$</label>
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
								$input['value'] = @set_value('recebimentos_valor', $p['recebimentos_valor']);
								echo form_input($input);
								echo form_error('recebimentos_valor');
								$t++;
								?>
							</td>
						</tr>
						
						<tr>
							<td class="caption">
								<label for="recebimentos_recebido" class="r" accesskey="G"><u>R</u>ecebido</label>
							</td>
							<td class="field">
								<?php
								echo form_dropdown('recebimentos_recebido', array('' => 'SELECIONE', '2' => 'NÃO', '1' => 'SIM'), set_value('recebimentos_recebido', (isset($p['recebimentos_recebido']) ? $p['recebimentos_recebido'] : '')), 'tabindex="'.$t.'"');
								echo form_error('recebimentos_recebido');
								$t++;
								?>
								
							</td>
						</tr>
						
						<?php
							$buttons[] = array('submit', 'uibutton', 'Pesquisar', 'disk1.gif', $t);
							$buttons[] = array('cancel', 'uibutton icon prev', 'Cancelar', 'arr-left.gif', $t+2, site_url('contabilidade/recebimentos'));
							$this->load->view('parts/buttons', array('buttons' => $buttons));
						?>

					</table>
				</form>
			</div>
		</div>
	</div>
</div>

<div class="grid_16">
<?php if($recebimentos != 0){ ?>
	<div class="box">
		<h2>
			<a href="#" id="toggle-tables"><?php echo count($recebimentos); ?> RECEBIMENTOS</a>
		</h2>
		<div class="block" id="tables">

			<table class="list" width="100%" cellpadding="0" cellspacing="0" border="0">
				<col /><col /><col />
				<thead>
				<tr class="heading">
					<!-- <td>ID</td> -->
					<td>NÚM</td>
					<td>SÉRIE</td>
					<td>TRANSPORTADORAS</td>
					<td>CLIENTE</td>
					<td>FROTA</td>
					<td>CARREGAMENTO</td>
					<td>RECEBIMENTO</td>
					<td>VALOR</td>
					<td>CONFIRMADO</td>
					<td>RECEBIDO</td>
					<td></td>
					
				</tr>
				</thead>
				<tbody>
				<?php
					$sum = 0;
					//$grupos as $grupo_id =>$group_name
					foreach ($recebimentos as $recebimentos) {

						 $sum += $recebimentos->recebimentos_valor;

						if ($recebimentos->recebimentos_recebido == 0) {
							$bgColor = 'white';
							// $recebido = 'NÃO';
							$recebido = '<img src="'.base_url().'images/icons/bullet_red.png" alt="NÃO" title="NÃO">';
							$rec = 0;
						} else {
							$bgColor = 'green';
							// $recebido = 'SIM';
							$recebido = '<img src="'.base_url().'images/icons/bullet_green.png" alt="SIM" title="SIM">';
							$rec = 1;
						}

						if ($recebimentos->recebimentos_confirmado == 0) {
							$bgColor = 'red';
							// $confirmado = 'NÃO';
							$confirmado = '<img src="'.base_url().'images/icons/bullet_red.png" alt="NÃO" title="NÃO">';
						} else {
							// $confirmado = 'SIM';
							$confirmado = '<img src="'.base_url().'images/icons/bullet_green.png" alt="SIM" title="SIM">';

						}
				?>
				<tr class="<?php echo $bgColor; ?>">
					<!-- <td class="m"><?php echo $recebimentos->recebimentos_id ?></td> -->
					<td class="m"><?php echo character_limiter($recebimentos->recebimentos_descricao, 50); ?></td>
					<td class="m"><?php echo character_limiter($recebimentos->recebimentos_serie, 50); ?></td>
					<td class="m"><?php echo character_limiter($recebimentos->transportadoras_descricao, 10); ?></td>
					<td class="m"><?php echo character_limiter($recebimentos->clientes_descricao, 10); ?></td>
					<td class="m"><?php echo character_limiter($recebimentos->caminhoes_descricao, 4); ?></td>
					<td class="m"><?php echo mysql2human($recebimentos->recebimentos_data); ?></td>
					<td class="m" if ><?php echo mysql2human($recebimentos->recebimentos_data_recebido); ?></td>
					<td class="m" if ><?php echo brl($recebimentos->recebimentos_valor); ?></td>
					<td class="m" if ><?php echo $confirmado; ?></td>
					<td class="m" if ><?php echo $recebido; ?></td>
					<td class="currency">
					<?php

						if ($recebimentos->recebimentos_confirmado == 0) {
							$actiondata[0] = array('contabilidade/recebimentos/confirmar/'.$recebimentos->recebimentos_id, 'Confirmar', 'accept.png', '','onclick="return confirm(\'Você tem certeza que deseja marcar como CONFIRMADO?\')"' );
						} else {
							// $actiondata[0] = array('contabilidade/recebimentos/desconfirmar/'.$recebimentos->recebimentos_id, 'DESCONFIRMAR', 'cross.png', '','onclick="return confirm(\'Você tem certeza que deseja marcar como NÃO CONFIRMADO?\')"' );
							$actiondata[0] = array('contabilidade/recebimentos/desconfirmar/'.$recebimentos->recebimentos_id, 'Desconfirmar', 'exclamation.png', '','onclick="return confirm(\'Você tem certeza que deseja marcar como NÃO CONFIRMADO?\')"' );
						}

						if ($recebimentos->recebimentos_recebido == 0) {
							$actiondata[1] = array('contabilidade/recebimentos/recebido/'.$recebimentos->recebimentos_id, 'Receber', 'money_add.png', '','onclick="return confirm(\'Você tem certeza que deseja marcar como RECEBIDO?\')"' );
						} else {
							// $actiondata[1] = array('contabilidade/recebimentos/devolvido/'.$recebimentos->recebimentos_id, 'DEVOLVER', 'cross.png', '','onclick="return confirm(\'Você tem certeza que deseja marcar como NÃO RECEBIDO?\')"' );
							$actiondata[1] = array('contabilidade/recebimentos/devolvido/'.$recebimentos->recebimentos_id, 'Rejeitar', 'money_delete.png', '','onclick="return confirm(\'Você tem certeza que deseja marcar como NÃO RECEBIDO?\')"' );
						}
					
						$actiondata[2] = array('contabilidade/recebimentos/editar/'.$recebimentos->recebimentos_id, 'Editar', 'pencil.png' );
						$actiondata[3] = array('contabilidade/recebimentos/excluir/'.$recebimentos->recebimentos_id, 'Excluir', 'cross.png' );
						$this->load->view('parts/listactions', $actiondata);
					?>
					</td>
				</tr>
				<?php } ?>

				</tbody>
				<tfoot>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td><strong><?php echo brl($sum); ?></strong></td>
					<td></td>
					<td></td>
					<td></td>
				</tfoot>
			</table>
			<p><?php echo anchor('contabilidade/recebimentos/adicionar', 'RECEBIMENTO', 'class="uibutton icon add"'); ?></p>
		</div>
	</div>
</div>

<?php } else { ?> <div class="box_error"> <h2 align="center">nenhum recebimento cadastrado</h2> </div> </div> <?php } ?>