<div class="grid_2">
	<div class="box"> 
		<h2> 
			<a id="toggle-infologin">Informações</a>
		</h2>
		<p></p>
		<p><a href="#agendados">Agendados</a></p>
		<p><a href="#disponiveis">Disponíveis</a></p>
		<p><a href="#historico">Histórico</a></p>
	</div>
</div>

<div class="grid_14">
<?php if($controle_de_viagem_agenda != 0){ ?>
	<div class="box">
		<h2>
			<a name="agendados" href="#agendados" id="toggle-tables"><?php echo count($controle_de_viagem_agenda); ?> AGENDADOS</a>
		</h2>
		<div class="block" id="tables">

			<table class="list" width="100%" cellpadding="0" cellspacing="0" border="0">
				
				<thead>
					<tr class="heading">
						<td>ID</td>
						<td>TRANSPORTADORA</td>
						<td>MOTORISTA</td>
						<td>FROTA</td>
						<td>ORIGEM</td>
						<td>DESTINO</td>
						<td>DATA</td>
						<td></td>
					</tr>
				</thead>
				<tbody>
					<?php
						$i = 1;
						foreach ($controle_de_viagem_agenda as $controle_de_viagem_agenda) { 
					?>
					<tr class="tr">
						<td><?php echo $i++; ?></td>
						<td><?php echo character_limiter($controle_de_viagem_agenda->transportadoras_descricao, 20); ?></td>
						<td><?php echo character_limiter($controle_de_viagem_agenda->motoristas_descricao, 10); ?></td>
						<td><?php echo character_limiter($controle_de_viagem_agenda->caminhoes_descricao, 10); ?></td>
						<td><?php echo character_limiter($controle_de_viagem_agenda->controle_de_viagem_origem_descricao, 10); ?></td>
						<td><?php echo character_limiter($controle_de_viagem_agenda->controle_de_viagem_destino_descricao, 10); ?></td>
						<td><?php echo mysql2human($controle_de_viagem_agenda->controle_de_viagem_agenda_data); ?></td>
						
						<td class="currency">
							<?php
								$actiondata[0] = array('contabilidade/controle_de_viagem_agenda/controle_de_viagem_agenda_liberar_caminhao/'.$controle_de_viagem_agenda->controle_de_viagem_agenda_id.'/'.$controle_de_viagem_agenda->controle_de_viagem_agenda_caminhao_id, 'Descarregar', 'arrow_down.png' );
								$actiondata[1] = array('contabilidade/controle_de_viagem_agenda/editar/'.$controle_de_viagem_agenda->controle_de_viagem_agenda_id, 'Editar', 'pencil.png' );
								$actiondata[2] = array('contabilidade/controle_de_viagem_agenda/excluir/'.$controle_de_viagem_agenda->controle_de_viagem_agenda_id, 'Excluir', 'cross.png' );
								$this->load->view('parts/listactions', $actiondata);
							?>
						</td>
						
					</tr>
				<?php } ?>
				</tbody>
			</table>
			<p><?php echo anchor('contabilidade/controle_de_viagem_agenda/adicionar', 'AGENDA DE CONTROLE DE VIAGEM', 'class="uibutton icon add"'); ?></p>	
		</div>
	</div>
<?php } else { ?> <div class="box_error"><h2 align="center">NENHUM AGENDAMENTO</h2></div><?php } ?>

<hr />

<?php if($frotas != 0){ ?>
	<div class="box">
		<h2>
			<a name="disponiveis" href="#disponiveis" id="toggle-tables"><?php echo count($frotas); ?> DISPONÍVEIS</a>
		</h2>
		<div class="block" id="tables">

			<table class="list" width="100%" cellpadding="0" cellspacing="0" border="0">
				
				<thead>
				<tr class="heading">
					<td>ID</td>
					<td>FROTA</td>
					<td>CAVALO</td>
					<td>CARRETA</td>
				</tr>
				</thead>
				<tbody>
				<?php
					$i = 1;
					foreach ($frotas as $frotas) {
				?>
				<tr class="tr">
					<td><?php echo $i++; ?></td>
					<td><?php echo character_limiter($frotas->caminhoes_descricao, 50); ?></td>					
					<td><?php echo character_limiter($frotas->caminhoes_cavalo, 50); ?></td>					
					<td><?php echo character_limiter($frotas->caminhoes_carreta, 50); ?></td>					
				</tr>
				<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
<?php } else { ?> <div class="box_error"> <h2 align="center">nenhum caminhão disponível</h2> </div><?php } ?>

<hr />

<?php if($controle_de_viagem_agenda_historico != 0){ ?>
	<div class="box">
		<h2>
			<a name="historico" href="#historico" id="toggle-tables"><?php echo count($controle_de_viagem_agenda_historico); ?> HISTÓRICOS</a>
		</h2>
		<div class="block" id="tables">

			<table class="list" width="100%" cellpadding="0" cellspacing="0" border="0">
				
				<thead>
					<tr class="heading">
						<td>ID</td>
						<td>TRANSPORTADORA</td>
						<td>MOTORISTA</td>
						<td>FROTA</td>
						<td>ORIGEM</td>
						<td>DESTINO</td>
						<td>DATA</td>
						<td></td>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($controle_de_viagem_agenda_historico as $controle_de_viagem_agenda_historico) { ?>
					<tr class="tr">
						<td><?php echo $controle_de_viagem_agenda_historico->controle_de_viagem_agenda_id ?></td>
						<td><?php echo character_limiter($controle_de_viagem_agenda_historico->transportadoras_descricao, 20); ?></td>
						<td><?php echo character_limiter($controle_de_viagem_agenda_historico->motoristas_descricao, 10); ?></td>
						<td><?php echo character_limiter($controle_de_viagem_agenda_historico->caminhoes_descricao, 10); ?></td>
						<td><?php echo character_limiter($controle_de_viagem_agenda_historico->controle_de_viagem_origem_descricao, 10); ?></td>
						<td><?php echo character_limiter($controle_de_viagem_agenda_historico->controle_de_viagem_destino_descricao, 10); ?></td>
						<td><?php echo mysql2human($controle_de_viagem_agenda_historico->controle_de_viagem_agenda_data); ?></td>
						<td class="currency">
							<?php
								$actiondata[0] = array('contabilidade/controle_de_viagem_agenda/editar/'.$controle_de_viagem_agenda_historico->controle_de_viagem_agenda_id, 'Editar', 'pencil.png' );
								$actiondata[1] = array('contabilidade/controle_de_viagem_agenda/excluir/'.$controle_de_viagem_agenda_historico->controle_de_viagem_agenda_id, 'Excluir', 'cross.png' );
								$this->load->view('parts/listactions', $actiondata);
							?>
						</td>
					</tr>
				<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
<?php } ?>
</div>