<div class="grid_4">
	<div class="box"> 
		<h2> 
			<a id="toggle-infologin">Informações</a> 
		</h2> 
			
		<div class="block" id="tables">
			<table class="list" width="100%" cellpadding="0" cellspacing="0" border="0">
				<col /><col /><col />
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
<?php if($controle_de_viagem_viagens != 0){ ?>
	<div class="box">
		<h2>
			<a href="#" id="toggle-tables">DESPESAS</a>
		</h2>
		<div class="block" id="tables">

			<table class="list" width="100%" cellpadding="0" cellspacing="0" border="0">
				<col /><col /><col />
				<thead>
				<tr class="heading">
					<td class="h" title="ID">ID</td>
					<td class="h" title="ID">PRÉ OS ID</td>
					<td class="h" title="">Operação</td>
					<td class="h" title="">Quantidade</td>
					<td class="h" title=""></td>
					
				</tr>
				</thead>
				<tbody>
				<?php
				$i = 0;
				$now = now();
				foreach ($controle_de_viagem_viagens as $controle_de_viagem_viagens) {
				?>
				<tr class="tr">
					<td class="m"><?php echo $controle_de_viagem_viagens->controle_de_viagem_viagens_id;?></td>
					<td class="m"><?php echo $controle_de_viagem_viagens->pre_os_id;?></td>
					<td class="m"><?php echo character_limiter($controle_de_viagem_viagens->pre_operacoes_descricao, 50); ?></td>
					<td class="m"><?php echo character_limiter($controle_de_viagem_viagens->controle_de_viagem_viagens_quantidade, 50); ?></td>
					
					<td class="currency">
						<?php
						$actiondata[0] = array('contabilidade/controle_de_viagem_viagens/editar/'.$controle_de_viagem_viagens->controle_de_viagem_viagens_id, 'Editar', 'arr-right-sm.gif' );
						$actiondata[1] = array('contabilidade/controle_de_viagem_viagens/excluir/'.$controle_de_viagem_viagens->controle_de_viagem_viagens_id, 'Excluir', 'cross_sm.gif' );
						$this->load->view('parts/listactions', $actiondata);
						?>
					</td>
					
				</tr>	
				
				<?php $i++; } ?>
				</tbody>
			</table>
			<p><?php echo anchor('contabilidade/controle_de_viagem_viagens/adicionar', 'Adicionar PRE Itens', 'class="uibutton icon add"'); ?></p>
		</div>
	</div>
</div>

<?php } else { ?> <div class="box_error"> <h2 align="center">nenhuma produção cadastrada</h2> </div> </div> <?php } ?>