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
<?php if($transportadoras != 0){ ?>
	<div class="box">
		<h2>
			<a href="#" id="toggle-tables">TRANSPORTADORAS</a>
		</h2>
		<div class="block" id="tables">

			<table class="list" width="100%" cellpadding="0" cellspacing="0" border="0">
				
				<thead>
				<tr class="heading">
					<td class="h" title="Name">ID</td>
					<td class="h" title="Name">TRANSPORTADORA</td>
					<td class="h" title=""></td>
					
				</tr>
				</thead>
				<tbody>
				<?php
				$i = 0;
				$now = now();
				foreach ($transportadoras as $transportadoras) {
				?>
				<tr class="tr">
					<td class="m"><?php echo $transportadoras->transportadoras_id ?></td>
					<td class="m"><?php echo character_limiter($transportadoras->transportadoras_descricao, 50); ?></td>
					
					<td class="currency">
						<?php
						$actiondata[0] = array('contabilidade/transportadoras/editar/'.$transportadoras->transportadoras_id, 'Editar', 'pencil.png' );
						$actiondata[1] = array('contabilidade/transportadoras/excluir/'.$transportadoras->transportadoras_id, 'Excluir', 'cross.png' );
						$this->load->view('parts/listactions', $actiondata);
						?>
					</td>
				</tr>
				<?php $i++; } ?>
				</tbody>
			</table>
			<p><?php echo anchor('contabilidade/transportadoras/adicionar', 'TRANSPORTADORA', 'class="uibutton icon add"'); ?></p>
		</div>
	</div>
</div>

<?php } else { ?> <div class="box_error"> <h2 align="center">nenhuma transportadora cadastrada</h2> </div> </div> <?php } ?>