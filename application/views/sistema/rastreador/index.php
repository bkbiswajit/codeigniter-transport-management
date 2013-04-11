<div class="grid_3"> 
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
<div class="grid_13">
	<?php if($tracker != 0){ ?> 
	<div class="box">
		<h2>
			<a href="#" id="toggle-tables">Rastreamento</a>
		</h2>
		<div class="block" id="tables">
			<table class="list" width="100%" cellpadding="0" cellspacing="0" border="0">
				<thead>
					<tr class="heading">
						<td>Usuário</td>
						<td>Navegador</td>
						<td class="h" title="Sistema Operacional">S.O.</td>
						<td>URI Acessado</td>
						<td>Data de Acesso</td>
						<td class="h" title="Endereço de IP">I.P.</td>
					</tr>
				</thead>
				<tbody>
					<?php
					$i = 0;
					foreach ($tracker as $track) {
					?>
					<tr>
						<td><?php echo anchor('sistema/usuarios/editar/'.$track->usuario_id	, $track->nome) ?></td>
						<td title="<?php echo $track->visitor_user_agent_string ; ?>"><?php echo $track->visitor_agent ; ?></td>
						<td><?php echo $track->visitor_platform ; ?></td>
						<td><?php echo $track->visit_uri; ?></td>
						<td><?php echo mysqlhuman($track->visit_visit_date) ; ?></td>
						<td><?php echo $track->visitor_ip_address ; ?></td>
					</tr>
					<?php $i++; } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<?php } else { ?> <div class="box_error"> <h2 align="center"> NO NO NO </h2> </div> </div> <?php } ?>