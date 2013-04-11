<div id="content" class="grid_16">
<?php if($controle_de_viagem_postos != 0){ ?>
		<div class="block" id="tables">

			<table class="list" width="100%" cellpadding="0" cellspacing="0" border="0">
									<col /><col /><col />
									<thead>
									<tr class="heading">
										<td class="h">ID</td>
										<td class="h">Data</td>
										<td class="h">Posto</td>
										<td class="h">Litros</td>
										<td class="h">R$/Litro</td>
										<td class="h">Total</td>
										<td class="h" title=""></td>
									</tr>
									</thead>
									<tbody>
									<?php foreach ($controle_de_viagem_postos as $controle_de_viagem_postos) { ?>
									<tr class="tr">
										<td class="m"><?php echo $controle_de_viagem_postos->controle_de_viagem_postos_id;?></td>										
										<td class="m"><?php echo mysql2human($controle_de_viagem_postos->controle_de_viagem_postos_data); ?></td>										
										<td class="m"><?php echo $controle_de_viagem_postos->postos_descricao;?></td>										
										<td class="m"><?php echo $controle_de_viagem_postos->controle_de_viagem_postos_litros;?></td>										
										<td class="m"><?php echo brl($controle_de_viagem_postos->controle_de_viagem_postos_valor_litro);?></td>
										<td class="m"><?php echo brl($controle_de_viagem_postos->controle_de_viagem_postos_litros*$controle_de_viagem_postos->controle_de_viagem_postos_valor_litro);?></td>
										<td class="currency">
											<?php echo anchor('contabilidade/controle_de_viagem_postos/ajax_excluir/'.$controle_de_viagem_postos->controle_de_viagem_postos_id . '/' . $controle_de_viagem_postos->controle_de_viagem_postos_controle_de_viagem_viagens_id , 'Excluir', array('onClick'=>'return deletechecked(\' '.base_url().'contabilidade/controle_de_viagem_postos/ajax_excluir/'.$controle_de_viagem_postos->controle_de_viagem_postos_id . '/'.$controle_de_viagem_postos->controle_de_viagem_postos_controle_de_viagem_viagens_id . '\')')); ?>
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
											<td></td>	
											<td></td>
										</tr>
									</tfoot>
								</table>
		</div>
	</div>
</div>

<?php } else { ?> <div class="box_error"> <h2 align="center">nenhuma produção cadastrada</h2> </div> </div> <?php } ?>