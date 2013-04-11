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
	<?php if($grupos != 0){ ?>
	
	<div class="box">
		<h2>
			<a href="#" id="toggle-tables">Grupos</a>
		</h2>
		<div class="block" id="tables">
			<table class="list" width="100%" cellpadding="0" cellspacing="0" border="0">
				<col /><col /><col />
				<thead>
				<tr class="heading">
					<td class="h" title="Name">Grupo</td>
					<!--<td class="h" title="Description">Description</td>-->
					<td class="h" title="Usercount">Número de usuários</td>
					<td class="h" title="X">&nbsp;</td>
				</tr>
				</thead>
				<tbody>
				<?php
				$i = 0;
				foreach ($grupos as $group) {
				?>
				<tr class="tr<?php echo ($i & 1); echo ($group->ativo == 0) ? ' disabled' : NULL; ?>">
					<td class="t"><?php echo anchor('sistema/grupos/editar/'.$group->grupo_id, $group->nome) ?></td>
					<!--<td class="m"><span title="<?php echo $group->description ?>"><?php echo word_limiter($group->description, 5) ?>&nbsp;</span></td>-->
					<td class="x"><?php echo $group->usercount ?>&nbsp;</td>
					<td class="currency">
					<?php
					$actiondata[0] = array('sistema/usuarios/nogrupo/'.$group->grupo_id, 'Exibir usuarios', '');
					$actiondata[1] = array('sistema/permissoes/paraogrupo/'.$group->grupo_id, ' | Editar permissoes | ', '');
					$actiondata[2] = array('sistema/grupos/excluir/'.$group->grupo_id, 'Excluir', '');
					$this->load->view('parts/listactions', $actiondata);
					?></td>
				</tr>
				<?php $i++; } ?>
				</tbody>
			</table>
		</div>		
	</div>
</div>

<?php } else { ?> <div class="box_error"> <h2 align="center"> NO NO NO </h2> </div> </div> <?php } ?>