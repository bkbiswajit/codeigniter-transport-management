<div id="content" class="grid_16">
<?php if($controle_de_viagem_viagens != 0){ ?>
		<div class="block" id="tables">
			<table class="list" width="100%" cellpadding="0" cellspacing="0" border="0">
				
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
						<?php echo anchor('contabilidade/controle_de_viagem_viagens/ajax_excluir/'.$controle_de_viagem_viagens->controle_de_viagem_viagens_id . '/' . $controle_de_viagem_viagens->controle_de_viagem_viagens_controle_de_viagem_viagens_id , 'Excluir', array('onClick'=>'return deletechecked(\' '.base_url().'contabilidade/controle_de_viagem_viagens/ajax_excluir/'.$controle_de_viagem_viagens->controle_de_viagem_viagens_id . '/'.$controle_de_viagem_viagens->controle_de_viagem_viagens_controle_de_viagem_viagens_id . '\')')); ?>
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
						<td><?php echo brl($controle_de_viagem_viagens_total);?></td>	
						<td><?php echo brl($controle_de_viagem_viagens_total*$motoristas_comissao/100);?></td>	
						<td></td>
						<td></td>
					</tr>
				</tfoot>
			</table>
		</div>
	</div>
</div>

<?php } else { ?> <div class="box_error"> <h2 align="center">nenhuma produção cadastrada</h2> </div> </div> <?php } ?>