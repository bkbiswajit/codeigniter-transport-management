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
<?php if($controle_de_viagem_despesas_tipos != 0){ ?>
	<div class="box">
		<h2>
			<a href="#" id="toggle-tables">Controle de Viagem Despesas Tipos</a>
		</h2>
		<div class="block" id="tables">

			<table class="list" width="100%" cellpadding="0" cellspacing="0" border="0">
				
				<thead>
				<tr class="heading">
					<td class="h" title="Name">ID</td>
					<td class="h" title="Name">Cliente</td>
					<td class="h" title=""></td>
					
				</tr>
				</thead>
				<tbody>
				<?php
				$i = 0;
				$now = now();
				foreach ($controle_de_viagem_despesas_tipos as $controle_de_viagem_despesas_tipos) {
				?>
				<tr class="tr">
					<td class="m"><?php echo $controle_de_viagem_despesas_tipos->controle_de_viagem_despesas_tipos_id ?></td>
					<td class="m"><?php echo character_limiter($controle_de_viagem_despesas_tipos->controle_de_viagem_despesas_tipos_descricao, 50); ?></td>
					
					<td class="currency">
						<?php
						$actiondata[0] = array('contabilidade/controle_de_viagem_despesas_tipos/editar/'.$controle_de_viagem_despesas_tipos->controle_de_viagem_despesas_tipos_id, 'Editar', 'pencil.png' );
						$actiondata[1] = array('contabilidade/controle_de_viagem_despesas_tipos/excluir/'.$controle_de_viagem_despesas_tipos->controle_de_viagem_despesas_tipos_id, 'Excluir', 'cross.png' );
						$this->load->view('parts/listactions', $actiondata);
						?>
					</td>
				</tr>
				<?php $i++; } ?>
				</tbody>
			</table>
			<p><?php echo anchor('contabilidade/controle_de_viagem_despesas_tipos/adicionar', 'Controle de Viagem Despesas Tipos', 'class="uibutton icon add"'); ?></p>
		</div>
	</div>
</div>

<?php } else { ?> <div class="box_error"> <h2 align="center">nenhuma controle_de_viagem_despesas_tipos cadastrada</h2> </div> </div> <?php } ?>