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
<?php if($metas != 0){ ?>
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
					<td class="h" title="Name">REGIÃO</td>
					<td class="h" title="Name">VALOR</td>
					<td class="h" title=""></td>
				</tr>
				</thead>
				<tbody>
				<?php
				foreach ($metas as $metas) {
				?>
				<tr class="tr">
					<td class="m"><?php echo $metas->metas_id ?></td>
					<td class="m"><?php echo character_limiter($metas->bonificacao_descricao, 50); ?></td>
					<td class="m"><?php echo character_limiter($metas->controle_de_viagem_regioes_descricao, 50); ?></td>
					<td class="m"><?php echo character_limiter($metas->metas_valor, 50); ?></td>
					<td class="currency">
						<?php
						$actiondata[0] = array('contabilidade/metas/editar/'.$metas->metas_id, 'Editar', 'arr-right-sm.gif' );
						$actiondata[1] = array('contabilidade/metas/excluir/'.$metas->metas_id, 'Excluir', 'cross_sm.gif' );
						$actiondata[1] = array('contabilidade/metas/excluir/'.$metas->metas_id, 'Excluir', 'cross_sm.gif' );
						$this->load->view('parts/listactions', $actiondata);
						?>
					</td>
				</tr>
				<?php } ?>
				</tbody>
			</table>
			<p><?php echo anchor('contabilidade/metas/adicionar', 'BONIFICAÇÃO', 'class="uibutton icon add"'); ?></p>
		</div>
	</div>
</div>

<?php } else { ?> <div class="box_error"> <h2 align="center">nenhum posto cadastrado</h2> </div> </div> <?php } ?>