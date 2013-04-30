<div class="grid_3">
	<div class="box"> 
		<h2> 
			<a id="toggle-infologin">Informações</a> 
		</h2>
	</div>
</div>
<div class="grid_13">
<?php if($controle_de_viagem != 0){ ?>
	<div class="box">
		<h2>
			<a href="#" id="toggle-tables">CONTROLE DE VIAGENS</a>
		</h2>
		<div class="block" id="tables">

			<table class="list" width="100%" cellpadding="0" cellspacing="0" border="0">
				<col /><col /><col />
				<thead>
				<tr class="heading">
					<td class="h" title="">ID</td>
					<td class="h" title="">TRANSPORTADORA</td>
					<td class="h" title="">MOTORISTA</td>
					<td class="h" title="">FROTA</td>
					<td class="h" title=""></td>
					
				</tr>
				</thead>
				<tbody>
				<?php
				foreach ($controle_de_viagem as $controle_de_viagem) {
				?>
				<tr class="tr">
					<td class="m"><?php echo $controle_de_viagem->controle_de_viagem_id ?></td>
					<td class="m"><?php echo character_limiter($controle_de_viagem->transportadoras_descricao, 50); ?></td>
					<td class="m"><?php echo character_limiter($controle_de_viagem->motoristas_descricao, 50); ?></td>
					<td class="m"><?php echo character_limiter($controle_de_viagem->caminhoes_descricao, 50); ?></td>
					
					<td class="currency">
						<?php
						$actiondata[0] = array('contabilidade/controle_de_viagem/editar/'.$controle_de_viagem->controle_de_viagem_id, 'Editar', 'pencil.png' );
						$actiondata[1] = array('contabilidade/controle_de_viagem/excluir/'.$controle_de_viagem->controle_de_viagem_id, 'Excluir', 'cross.png' );
						$this->load->view('parts/listactions', $actiondata);
						?>
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
					</tr>
				</tfoot>
			</table>
			<p><?php echo anchor('contabilidade/controle_de_viagem/adicionar', 'CONTROLE DE VIAGEM', 'class="uibutton icon add"'); ?></p>
		</div>
	</div>
</div>

<?php } else { ?> <div class="box_error"> <h2 align="center">nenhum controle de viagem cadastrado</h2> </div> </div> <?php } ?>