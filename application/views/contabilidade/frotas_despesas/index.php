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
<?php if($frotas_despesas != 0){ ?>
	<div class="box">
		<h2>
			<a><?php echo count($frotas_despesas); ?> FROTAS DESPESAS</a>
		</h2>
		<div class="block" id="tables">

			<table class="list" width="100%" cellpadding="0" cellspacing="0" border="0">
				
				<thead>
				<tr>
					<td>ID</td>
					<td>FROTA</td>
					<td>TIPO</td>
					<td>DATA PAG.</td>
					<td>DATA VENC.</td>
					<td>VALOR</td>
					<td></td>
				</tr>
				</thead>
				<tbody>
				<?php
					foreach ($frotas_despesas as $frotas_despesas) {
				?>
				<tr>
					<td><?php echo $frotas_despesas->frotas_despesas_id ?></td>
					<td><?php echo character_limiter($frotas_despesas->caminhoes_descricao, 50); ?></td>				
					<td><?php echo character_limiter($frotas_despesas->frotas_despesas_tipos_descricao, 50); ?></td>				
					<td><?php echo mysql2human($frotas_despesas->frotas_despesas_data_pagamento); ?></td>				
					<td><?php echo mysql2human($frotas_despesas->frotas_despesas_data_vencimento); ?></td>				
					<td><?php echo brl($frotas_despesas->frotas_despesas_valor, 50); ?></td>				
					<td class="currency">
						<?php
						$actiondata[0] = array('contabilidade/frotas_despesas/editar/'.$frotas_despesas->frotas_despesas_id, 'Editar', 'pencil.png' );
						$actiondata[1] = array('contabilidade/frotas_despesas/excluir/'.$frotas_despesas->frotas_despesas_id, 'Excluir', 'cross.png' );
						$actiondata[1] = array('contabilidade/frotas_despesas/excluir/'.$frotas_despesas->frotas_despesas_id, 'Excluir', 'cross.png' );
						$this->load->view('parts/listactions', $actiondata);
						?>
					</td>
				</tr>
				<?php } ?>
				</tbody>
			</table>
			<p><?php echo anchor('contabilidade/frotas_despesas/adicionar', 'FROTAS DESPESAS', 'class="uibutton icon add"'); ?></p>
		</div>
	</div>
</div>
<?php } else { ?> <div class="box_error"> <h2 align="center">NENHUMA FROTAS DESPESAS CADASTRADA</h2> </div> </div> <?php } ?>