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
<?php if($bonificacao != 0){ ?>
	<div class="box">
		<h2>
			<a href="#" id="toggle-tables">POSTOS</a>
		</h2>
		<div class="block" id="tables">

			<table class="list" width="100%" cellpadding="0" cellspacing="0" border="0">
				<col /><col /><col />
				<thead>
				<tr class="heading">
					<td class="h" title="Name">ID</td>
					<td class="h" title="Name">MÊS</td>
					<td class="h" title="Name">PERÍODO INÍCIO</td>
					<td class="h" title="Name">PERÍODO FINAL</td>
					<td class="h" title=""></td>
				</tr>
				</thead>
				<tbody>
				<?php
				foreach ($bonificacao as $bonificacao) {
				?>
				<tr class="tr">
					<td class="m"><?php echo $bonificacao->bonificacao_id ?></td>
					<td class="m"><?php echo character_limiter($bonificacao->bonificacao_descricao, 50); ?></td>
					<td class="m"><?php echo mysql2human($bonificacao->bonificacao_mes_inicio); ?></td>
					<td class="m"><?php echo mysql2human($bonificacao->bonificacao_mes_final); ?></td>
					
					<td class="currency">
						<?php
						$actiondata[0] = array('contabilidade/bonificacao/editar/'.$bonificacao->bonificacao_id, 'Editar', 'pencil.png' );
						$actiondata[1] = array('contabilidade/bonificacao/excluir/'.$bonificacao->bonificacao_id, 'Excluir', 'cross.png' );
						$actiondata[1] = array('contabilidade/bonificacao/excluir/'.$bonificacao->bonificacao_id, 'Excluir', 'cross.png' );
						$this->load->view('parts/listactions', $actiondata);
						?>
					</td>
				</tr>
				<?php } ?>
				</tbody>
			</table>
			<p><?php echo anchor('contabilidade/bonificacao/adicionar', 'BONIFICAÇÃO', 'class="uibutton icon add"'); ?></p>
		</div>
	</div>
</div>

<?php } else { ?> <div class="box_error"> <h2 align="center">nenhum posto cadastrado</h2> </div> </div> <?php } ?>