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
	<div class="box"> 
		<h2> 
			<a id="toggle-infocadastro">Informações</a> 
		</h2> 
		<div class="block" id="infocadastro"> 
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
				<col /><col /><col />
				<thead>
				<tr class="heading">
					<td class="h" title="Username">Usuário</td>
					<td class="h" title="Name">Nome</td>
					<td class="h" title="Name">Grupo</td>
					<td class="h" title="Lastlogin">Última Visita</td>
					<td class="h" title="Lastactivity">Última Atividade</td>
					<td class="h" title="X">&nbsp;</td>
				</tr>
				</thead>
				<tbody>
				<?php
				$i = 0;
				foreach ($usuarios as $usuario) {
				?>
				<tr class="tr<?php echo ($i & 1); echo ($usuario->ativo == 0) ? ' disabled' : NULL; ?>">
					<td class="t"><?php echo anchor('sistema/usuarios/editar/'.$usuario->usuario_id, $usuario->cpf) ?></td>
					<td class="m"><?php echo character_limiter($usuario->nome, 10); ?>&nbsp;</td>
					<td class="m"><?php echo $usuario->groupnome ?>&nbsp;</td>
					<td class="m"><?php echo mysqlhuman($usuario->ultimavisita, "d/m/Y H:i:s") ?>&nbsp;</td>
					<td class="m"><?php echo mysqlhuman($usuario->ultimaatividade, "d/m/Y H:i:s") ?>&nbsp;</td>
					<td class="currency" width="270">
					<?php
					$actiondata[0] = array('sistema/rastreador/usuario/'.$usuario->usuario_id, 'Relatório', 'magnifier_sm.gif');
					$actiondata[1] = array('sistema/permissoes/effective/'.$usuario->usuario_id, 'Permissões', 'key-sm.gif', 'facebox');
					$actiondata[2] = array('sistema/usuarios/excluir/'.$usuario->usuario_id, 'Excluir', 'cross.png');
					$this->load->view('parts/listactions', $actiondata);
					?></td>
				</tr>
				<?php $i++; } ?>
				</tbody>
			</table>
			<?php echo $this->pagination->create_links() ?>
			<p><?php echo anchor('sistema/usuarios/adicionar', 'USUÁRIOS', 'class="uibutton icon add"'); ?></p>
		</div>
	</div>
</div>

<?php } else { ?> <div class="box_error"> <h2 align="center"> NO NO NO </h2> </div> </div> <?php } ?>