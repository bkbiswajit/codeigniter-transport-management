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
<?php if($controle_de_viagem_origem != 0){ ?>
	<div class="box">
		<h2>
			<a href="#" id="toggle-tables">origem</a>
		</h2>
		<div class="block" id="tables">

			<table class="list" width="100%" cellpadding="0" cellspacing="0" border="0">
				<col /><col /><col />
				<thead>
				<tr class="heading">
					<td class="h" title="Name">ID</td>
					<td class="h" title="Name">REGIÃO</td>
					<td class="h" title="Name">ORIGEM</td>
					<td class="h" title=""></td>
					
				</tr>
				</thead>
				<tbody>
				<?php
				$i = 0;
				$now = now();
				foreach ($controle_de_viagem_origem as $controle_de_viagem_origem) {
				?>
				<tr class="tr">
					<td class="m"><?php echo $controle_de_viagem_origem->controle_de_viagem_origem_id ?></td>
					<td class="m"><?php echo character_limiter($controle_de_viagem_origem->controle_de_viagem_origem_regiao_id, 50); ?></td>
					<td class="m"><?php echo character_limiter($controle_de_viagem_origem->controle_de_viagem_origem_descricao, 50); ?></td>
					
					<td class="currency">
						<?php
						$actiondata[0] = array('contabilidade/controle_de_viagem_origem_destino/editar/'.$controle_de_viagem_origem->controle_de_viagem_origem_id, 'Editar', 'arr-right-sm.gif' );
						$actiondata[1] = array('contabilidade/controle_de_viagem_origem_destino/excluir/'.$controle_de_viagem_origem->controle_de_viagem_origem_id, 'Excluir', 'cross_sm.gif' );
						$this->load->view('parts/listactions', $actiondata);
						?>
					</td>
				</tr>
				<?php $i++; } ?>
				</tbody>
			</table>
			<p><?php echo anchor('contabilidade/controle_de_viagem_origem_destino/adicionar', 'Origem/Destino', 'class="uibutton icon add"'); ?></p>
		</div>
	</div>
</div>

<?php } else { ?> <div class="box_error"> <h2 align="center">nenhuma despesa tipo cadastrada</h2> </div> </div> <?php } ?>