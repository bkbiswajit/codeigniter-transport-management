<div class="grid_4">
	<div class="box"> 
		<h2> 
			<a id="toggle-infocadastro">Informações</a> 
		</h2> 
		<div class="block" id="infocadastro"> 
			<p></p> 
		</div> 
	</div>
</div>
<div class="grid_12">
<?php if($frotas != 0){ ?>
	<div class="box">
		<h2>
			<a><?php echo count($frotas); ?> FROTAS</a>
		</h2>
		<div class="block" id="tables">

			<table class="list" width="100%" cellpadding="0" cellspacing="0" border="0">
				
				<thead>
				<tr class="heading">
					<td class="h" title="Name">ID</td>
					<td class="h" title="Name">FROTA</td>
					<td class="h" title="Name">CAVALO</td>
					<td class="h" title="Name">CAVALO ANO</td>
					<td class="h" title="Name">CARRETA</td>
					<td class="h" title="Name">CARRETA ANO</td>
					<td class="h" title=""></td>
					
				</tr>
				</thead>
				<tbody>
				<?php
					foreach ($frotas as $frotas) {
				?>
				<tr class="tr">
					<td class="m"><?php echo $frotas->caminhoes_id ?></td>
					<td class="m"><?php echo character_limiter($frotas->caminhoes_descricao, 50); ?></td>
					<td class="m"><?php echo character_limiter($frotas->caminhoes_cavalo, 50); ?></td>
					<td class="m"><?php echo character_limiter($frotas->caminhoes_cavalo_ano, 4); ?></td>
					<td class="m"><?php echo character_limiter($frotas->caminhoes_carreta, 50); ?></td>
					<td class="m"><?php echo character_limiter($frotas->caminhoes_carreta_ano, 4); ?></td>
					
					<td class="currency">
						<?php
						$actiondata[0] = array('contabilidade/frotas/editar/'.$frotas->caminhoes_id, 'Editar', 'pencil.png' );
						$actiondata[1] = array('contabilidade/frotas/excluir/'.$frotas->caminhoes_id, 'Excluir', 'cross.png' );
						$actiondata[1] = array('contabilidade/frotas/excluir/'.$frotas->caminhoes_id, 'Excluir', 'cross.png' );
						$this->load->view('parts/listactions', $actiondata);
						?>
					</td>
				</tr>
				<?php } ?>
				</tbody>
			</table>
			<p><?php echo anchor('contabilidade/frotas/adicionar', 'FROTAS', 'class="uibutton icon add"'); ?></p>
		</div>
	</div>
</div>
<?php } else { ?> <div class="box_error"> <h2 align="center">nenhum caminhão cadastrado</h2> </div> </div> <?php } ?>