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

<script type="text/javascript">
	/* <![CDATA[ */
		$(function() {
				$('#producao_data').datepicker({
					userLang	: 'pt-BR',
					americanMode: false,
				});
				
				$('#despesas_data').datepicker({
					userLang	: 'pt-BR',
					americanMode: false,
				});				
			});
	/* ]]&gt; */
</script>