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
<?php if($clientes != 0){ ?>
	<div class="box">
		<h2>
			<a href="#" id="toggle-tables">CLIENTES</a>
		</h2>
		<div class="block" id="tables">

			<table class="list" width="100%" cellpadding="0" cellspacing="0" border="0">
				<col /><col /><col />
				<thead>
				<tr class="heading">
					<td class="h">ID</td>
					<td class="h">CLIENTE</td>
					<td class="h" title=""></td>
					
				</tr>
				</thead>
				<tbody>
				<?php
				$i = 0;
				$now = now();
				foreach ($clientes as $clientes) {
				?>
				<tr class="tr">
					<td class="m"><?php echo $clientes->clientes_id ?></td>
					<td class="m"><?php echo character_limiter($clientes->clientes_descricao, 50); ?></td>
					
					<td class="currency">
						<?php
						$actiondata[0] = array('contabilidade/clientes/editar/'.$clientes->clientes_id, 'Editar', 'arr-right-sm.gif' );
						$actiondata[1] = array('contabilidade/clientes/excluir/'.$clientes->clientes_id, 'Excluir', 'cross_sm.gif' );
						$this->load->view('parts/listactions', $actiondata);
						?>
					</td>
				</tr>
				<?php $i++; } ?>
				</tbody>
			</table>
			<p><?php echo anchor('contabilidade/clientes/adicionar', 'CLIENTE', 'class="uibutton icon add"'); ?></p>
		</div>
	</div>
</div>

<?php } else { ?> <div class="box_error"> <h2 align="center">nenhum cliente cadastrado</h2> </div> </div> <?php } ?>