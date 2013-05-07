<div class="grid_4">
	<div class="box"> 
		<h2> 
			<a id="toggle-infologin">Informações</a> 
		</h2> 
			
		<div class="block" id="tables">
			<table class="list" width="100%" cellpadding="0" cellspacing="0" border="0">
				
				<thead>
				<tr class="heading">
					<td class="h" title="">ITEM</td>
				</tr>
				</thead>
				<tbody>
				<tr class="tr">
					<td class="m">TOTAL MÊS ATUAL</td>
				</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>

<div class="grid_12">
<?php if($controle_de_viagem_despesas != 0){ ?>
	<div class="box">
		<h2>
			<a href="#" id="toggle-tables">DESPESAS</a>
		</h2>
		<div class="block" id="tables">

			<table class="list" width="100%" cellpadding="0" cellspacing="0" border="0">
				
				<thead>
				<tr class="heading">
					<td class="h" title="ID">ID</td>
					<td class="h" title="ID">CV ID</td>
					<td class="h" title="">Data</td>
					<td class="h" title="">Quantidade</td>
					<td class="h" title=""></td>
					
				</tr>
				</thead>
				<tbody>
				<?php
				foreach ($controle_de_viagem_despesas as $controle_de_viagem_despesas) {
				?>
				<tr class="tr">
					<td class="m"><?php echo $controle_de_viagem_despesas->controle_de_viagem_despesas_id;?></td>
					<td class="m"><?php echo $controle_de_viagem_despesas->controle_de_viagem_despesas_controle_de_viagem_viagens_id;?></td>
					<td class="m"><?php echo $controle_de_viagem_despesas->controle_de_viagem_despesas_data;?></td>
					<td class="m"><?php echo $controle_de_viagem_despesas->controle_de_viagem_despesas_controle_de_viagem_despesas_tipos_id;?></td>
					<td class="m"><?php echo $controle_de_viagem_despesas->controle_de_viagem_despesas_litros;?></td>
					<td class="m"><?php echo $controle_de_viagem_despesas->controle_de_viagem_despesas_valor_litro;?></td>
					
					<td class="currency">
						<?php
						$actiondata[0] = array('contabilidade/controle_de_viagem_despesas/editar/'.$controle_de_viagem_despesas->controle_de_viagem_despesas_id, 'Editar', 'pencil.png' );
						$actiondata[1] = array('contabilidade/controle_de_viagem_despesas/excluir/'.$controle_de_viagem_despesas->controle_de_viagem_despesas_id, 'Excluir', 'cross.png' );
						$this->load->view('parts/listactions', $actiondata);
						?>
					</td>
					
				</tr>	
				
				<?php } ?>
				</tbody>
			</table>
			<p><?php echo anchor('contabilidade/controle_de_viagem_despesas/adicionar', 'Adicionar PRE Itens', 'class="uibutton icon add"'); ?></p>
		</div>
	</div>
</div>

<?php } else { ?> <div class="box_error"> <h2 align="center">nenhuma produção cadastrada</h2> </div> </div> <?php } ?>