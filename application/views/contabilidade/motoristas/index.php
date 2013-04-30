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
<?php if($motoristas != 0){ ?>
	<div class="box">
		<h2>
			<a href="#" id="toggle-tables">MOTORISTAS</a>
		</h2>
		<div class="block" id="tables">

			<table class="list" width="100%" cellpadding="0" cellspacing="0" border="0">
				<col /><col /><col />
				<thead>
				<tr class="heading">
					<td class="h" title="Name">ID</td>
					<td class="h" title="Name">MOTORISTA</td>
					<td class="h" title="Name">CELULAR</td>
					<td class="h" title=""></td>
					
				</tr>
				</thead>
				<tbody>
				<?php
				foreach ($motoristas as $motoristas) {
				?>
				<tr class="tr">
					<td class="m"><?php echo $motoristas->motoristas_id ?></td>
					<td class="m"><?php echo character_limiter($motoristas->motoristas_descricao, 50); ?></td>
					<td class="m"><?php echo character_limiter($motoristas->motoristas_celular, 50); ?></td>
					
					<td class="currency">
						<?php
						$actiondata[0] = array('contabilidade/motoristas/editar/'.$motoristas->motoristas_id, 'Editar', 'pencil.png' );
						$actiondata[1] = array('contabilidade/motoristas/excluir/'.$motoristas->motoristas_id, 'Excluir', 'cross.png' );
						$actiondata[1] = array('contabilidade/motoristas/excluir/'.$motoristas->motoristas_id, 'Excluir', 'cross.png' );
						$this->load->view('parts/listactions', $actiondata);
						?>
					</td>
				</tr>
				<?php } ?>
				</tbody>
			</table>
			<p><?php echo anchor('contabilidade/motoristas/adicionar', 'MOTORISTA', 'class="uibutton icon add"'); ?></p>
		</div>
	</div>
</div>

<?php } else { ?> <div class="box_error"> <h2 align="center">nenhum motorista cadastrado</h2> </div> </div> <?php } ?>