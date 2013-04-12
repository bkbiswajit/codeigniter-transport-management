<div class="grid_4">
	<div class="box"> 
		<h2> 
			<a id="toggle-infocadastro">Informações</a> 
		</h2> 
		<div class="block" id="infocadastro"> 
			<?php foreach ($series as $serie): ?>
				<p><?php echo anchor('contabilidade/recebimentos/por_serie/'. $serie->recebimentos_serie, 'SÉRIE => ' . $serie->recebimentos_serie); ?></p>
			<?php endforeach ?>
			<?php echo anchor('contabilidade/recebimentos', 'TODAS AS SÉRIES'); ?>
		</div> 
	</div>
</div>

<div class="grid_12">
<?php if($recebimentos != 0){ ?>
	<div class="box">
		<h2>
			<a href="#" id="toggle-tables">RECEBIMENTOS</a>
		</h2>
		<div class="block" id="tables">

			<table class="list" width="100%" cellpadding="0" cellspacing="0" border="0">
				<col /><col /><col />
				<thead>
				<tr class="heading">
					<td class="h" title="Name">ID</td>
					<td class="h" title="Name">NÚMERO</td>
					<td class="h" title="Name">SÉRIE</td>
					<td class="h" title="Name">VALOR</td>
					<td class="h" title="Name">DATA</td>
					<td class="h" title="Name">DATA RECEBIMENTO</td>
					<td class="h" title="Name">RECEBIDO</td>
					<td class="h" title=""></td>
					
				</tr>
				</thead>
				<tbody>
				<?php
					//$grupos as $grupo_id =>$group_name
					foreach ($recebimentos as $recebimentos) {
						if ($recebimentos->recebimentos_recebido == 0) {
							$bgColor = 'red';
							$recebido = 'NÃO';
						} else {
							$bgColor = 'green';
							$recebido = 'SIM';
						}
				?>
				<tr class="<?php echo $bgColor; ?>">
					<td class="m"><?php echo $recebimentos->recebimentos_id ?></td>
					<td class="m"><?php echo character_limiter($recebimentos->recebimentos_descricao, 50); ?></td>
					<td class="m"><?php echo character_limiter($recebimentos->recebimentos_serie, 50); ?></td>
					<td class="m" if ><?php echo brl($recebimentos->recebimentos_valor); ?></td>
					<td class="m"><?php echo mysql2human($recebimentos->recebimentos_data); ?></td>
					<td class="m" if ><?php echo mysql2human($recebimentos->recebimentos_data_recebido); ?></td>
					<td class="m" if ><?php echo $recebido; ?></td>
					
					
					<td class="currency">
						<?php
						$actiondata[0] = array('contabilidade/recebimentos/editar/'.$recebimentos->recebimentos_id, 'Editar', 'arr-right-sm.gif' );
						$actiondata[1] = array('contabilidade/recebimentos/excluir/'.$recebimentos->recebimentos_id, 'Excluir', 'cross_sm.gif' );
						$actiondata[1] = array('contabilidade/recebimentos/excluir/'.$recebimentos->recebimentos_id, 'Excluir', 'cross_sm.gif' );
						$this->load->view('parts/listactions', $actiondata);
						?>
					</td>
				</tr>
				<?php } ?>
				</tbody>
			</table>
			<p><?php echo anchor('contabilidade/recebimentos/adicionar', 'RECEBIMENTO', 'class="uibutton icon add"'); ?></p>
		</div>
	</div>
</div>

<?php } else { ?> <div class="box_error"> <h2 align="center">nenhum recebimento cadastrado</h2> </div> </div> <?php } ?>