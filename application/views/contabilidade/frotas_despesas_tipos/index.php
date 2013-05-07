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
<?php if($frotas_despesas_tipos != 0){ ?>
	<div class="box">
		<h2>
			<a><?php echo count($frotas_despesas_tipos); ?> FROTAS DESPESAS TIPOS</a>
		</h2>
		<div class="block" id="tables">
			<table class="list" width="100%" cellpadding="0" cellspacing="0" border="0">
				<thead>
				<tr class="heading">
					<td>ID</td>
					<td>TIPO</td>
					<td></td>
				</tr>
				</thead>
				<tbody>
				<?php
					foreach ($frotas_despesas_tipos as $frotas_despesas_tipos) {
				?>
				<tr class="tr">
					<td><?php echo $frotas_despesas_tipos->frotas_despesas_tipos_id ?></td>
					<td><?php echo character_limiter($frotas_despesas_tipos->frotas_despesas_tipos_descricao, 50); ?></td>				
					<td class="currency">
						<?php
						$actiondata[0] = array('contabilidade/frotas_despesas_tipos/editar/'.$frotas_despesas_tipos->frotas_despesas_tipos_id, 'Editar', 'pencil.png' );
						$actiondata[1] = array('contabilidade/frotas_despesas_tipos/excluir/'.$frotas_despesas_tipos->frotas_despesas_tipos_id, 'Excluir', 'cross.png' );
						$actiondata[1] = array('contabilidade/frotas_despesas_tipos/excluir/'.$frotas_despesas_tipos->frotas_despesas_tipos_id, 'Excluir', 'cross.png' );
						$this->load->view('parts/listactions', $actiondata);
						?>
					</td>
				</tr>
				<?php } ?>
				</tbody>
			</table>
			<p><?php echo anchor('contabilidade/frotas_despesas_tipos/adicionar', 'FROTAS DESPESAS TIPOS', 'class="uibutton icon add"'); ?></p>
		</div>
	</div>
</div>
<?php } else { ?> <div class="box_error"> <h2 align="center">NENHUMA FROTAS DESPESAS TIPOS CADASTRADA</h2> </div> </div> <?php } ?>