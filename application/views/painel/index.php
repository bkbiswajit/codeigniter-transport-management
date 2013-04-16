<div class="grid_4">
	<div class="box"> 
		<h2> 
			<a id="toggle-info-login">Usuários conectados</a>
		</h2> 
		<div class="block" id="info-login">
			<?php
				if(count($active_users) > 0){
					echo '<ul>';
					foreach($active_users as $usuario_id => $nome_ou_cpf){
						$class = '';
						/**/
						if($usuario_id == $this->session->userdata('usuario_id')){
							$class = ' style="color:black"';
							$nome_ou_cpf .= ' (você)';
						}
						echo sprintf('<li%s>%s</li>', $class, $nome_ou_cpf);
					}
					echo '</ul>';
				}
			?>	
		</div>
	</div>
</div>

<div class="grid_12">
	<div class="box"> 
		<h2> 
			<a id="toggle-info-login">#</a>
		</h2> 
		<div class="block" id="info-login">
			<p>ITAJAÍ - SÃO GABRIEL DO OESTE : R$ 2784,60 PEDÁGIO R$ 316,80 AL:7%</p>
			<p>COTRAOESTE - CHAPECÓ R$ 1688,83 PEDÁGIO R$ 123,00 AL:12%</p>
			<p>GUARUHOS - SÃO GABRIEL DO OESTE: R$ 1751.38 PEDÁGIO R$ 420,60 AL:7%</p>
			<p>GUAIÇARA - CHAPECÓ R$ 1751,38 PEDÁGIO R$ 130.20 AL:12%</p>
		</div>
	</div>
</div>