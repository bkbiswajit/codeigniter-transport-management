<div class="grid_4"> 
	<div class="box"> 
		<h2> 
			<a id="toggle-infologin">Informações</a> 
		</h2> 
		<div class="block" id="infologin"> 
			<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p> 
			<p>Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</p> 
		</div> 
	</div>
</div>
<div class="grid_12">
	<?php if($usuarios != 0){ ?>
		<div class="box">
		<h2>
			<a href="#" id="toggle-tables">Usuários</a>
		</h2>
		<div class="block" id="tables">
			<table class="list" width="99%" cellpadding="0" cellspacing="0" border="0">
				
				<thead>
				<tr>
					<td>USUÁRIO</td>
					<td>NOME COMPLETO</td>
					<td>GRUPO</td>
					<td>ÚLTIMA VISITA</td>
					<td>ÚLTIMA ATIVIDADE</td>
					<td>&nbsp;</td>
				</tr>
				</thead>
				<tbody>
				<?php
				$i = 0;
				foreach ($usuarios as $usuario) {
				?>
				<tr class="tr<?php echo ($i & 1); echo ($usuario->ativo == 0) ? ' disabled' : NULL; ?>">
					<td><?php echo anchor('sistema/usuarios/editar/'.$usuario->usuario_id, $usuario->cpf) ?></td>
					<td><?php echo character_limiter($usuario->nome, 10); ?></td>
					<td><?php echo $usuario->groupnome ?></td>
					<td><?php echo mysqlhuman($usuario->ultimavisita, "d/m/Y H:i:s") ?></td>
					<td><?php echo mysqlhuman($usuario->ultimaatividade, "d/m/Y H:i:s") ?></td>
					<td class="currency">
						<?php
							$actiondata[0] = array('sistema/rastreador/usuario/'.$usuario->usuario_id, 'Relatório', 'magnifier.png');
							$actiondata[1] = array('sistema/permissoes/effective/'.$usuario->usuario_id, 'Permissões', 'key.png', 'facebox');
							$actiondata[2] = array('sistema/usuarios/excluir/'.$usuario->usuario_id, 'Excluir', 'cross.png');
							$this->load->view('parts/listactions', $actiondata);
						?>
					</td>
				</tr>
				<?php $i++; } ?>
				</tbody>
			</table>
			<?php echo $this->pagination->create_links() ?>
			<p><?php echo anchor('sistema/usuarios/adicionar', 'USUÁRIOS', 'class="uibutton icon add"'); ?></p>
		</div>
	</div>
</div>

<?php } else { ?> <div class="box_error"> <h2 align="center"> NO </h2> </div> </div> <?php } ?>