<script type="text/javascript" src="<?php echo $this->config->item('base_url').''; ?>js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" charset="utf-8">
	$(function () {
		var tabContainers = $('div.tabs >div');
		tabContainers.hide().filter(':grupo_1').show();
		
		$('div.tabs ul.tabnavigation a').click(function () {
			tabContainers.hide();
			tabContainers.filter(this.hash).show();
			$('div.tabs ul.tabnavigation a').removeClass('selected');
			$(this).addClass('selected');
			return false;
		}).filter(':grupo_1').click();
	});
</script>
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
<?php 
	$errors = validation_errors(); 
	if($errors){
		echo '<div class="grid_12"><div class="box_error"><a><h2>' . $errors . '<h2></a></div></div>';
	}
?>
<div class="grid_12">
	<div class="box">
		<h2>
			<a href="#" id="toggle-tables">Permissões</a>
		</h2>
		<div class="block" id="tables">
			<div class="tabs">
				<ul class="tabnavigation">
					<?php
					foreach($grupos as $grupo_id =>$group_name){
						echo '<li><a href="'.current_url().'#grupo_'.$grupo_id.'">'.$group_name.'</a></li>';
					}
					?>
				</ul>
				<?php foreach($grupos as $grupo_id =>$group_name){ 
					echo '<div id="grupo_'.$grupo_id.'">';
					echo form_open('sistema/permissoes/salvar', NULL, array('grupo_id' =>$grupo_id)); ?>
					<table class="form a-t" cellpadding="0" cellspacing="0" border="0">
					
						<tr>
							<td>
								<!-- PAINÉL -->
								<?php
								unset($checks);
								$checks['options'] = $permissoes['painel'];
								$checks['grupo_id'] = $grupo_id;
								$checks['category'] = 'Painél';
								$this->load->view('sistema/permissoes/permissoes.checks.php', $checks);
								?>
							</td>
							<td width="50">&nbsp;</td>
							<td>
								<!-- CONTA -->
								<?php
								unset($checks);
								$checks['options'] = $permissoes['conta'];
								$checks['grupo_id'] = $grupo_id;
								$checks['category'] = 'Conta';
								$this->load->view('sistema/permissoes/permissoes.checks.php', $checks);
								?>
							</td>
						</tr>
						<tr>
							<td width="400">
								<!-- CLIENTES -->
								<?php
								unset($checks);
								$checks['options'] = $permissoes['clientes'];
								$checks['grupo_id'] = $grupo_id;
								$checks['category'] = 'Clientes';
								$this->load->view('sistema/permissoes/permissoes.checks.php', $checks);
								?>
							</td>
							<td width="50">&nbsp;</td>
							<td width="400">
								<!-- DESPESAS -->
								<?php
								unset($checks);
								$checks['options'] = $permissoes['despesas'];
								$checks['grupo_id'] = $grupo_id;
								$checks['category'] = 'Despesas';
								$this->load->view('sistema/permissoes/permissoes.checks.php', $checks);
								?>
							</td>
						</tr>

						<tr>
							<td width="400">
								<!-- CLIENTES -->
								<?php
								unset($checks);
								$checks['options'] = $permissoes['producao'];
								$checks['grupo_id'] = $grupo_id;
								$checks['category'] = 'Produção';
								$this->load->view('sistema/permissoes/permissoes.checks.php', $checks);
								?>
							</td>
							<td width="50">&nbsp;</td>
							<td width="400">
								<!-- DESPESAS -->
								<?php
								unset($checks);
								$checks['options'] = $permissoes['relatorios'];
								$checks['grupo_id'] = $grupo_id;
								$checks['category'] = 'Relatórios';
								$this->load->view('sistema/permissoes/permissoes.checks.php', $checks);
								?>
							</td>
						</tr>

						
						<tr>
							<td>
								<!-- USUÁRIOS -->
								<?php
								unset($checks);
								$checks['options'] = $permissoes['usuarios'];
								$checks['grupo_id'] = $grupo_id;
								$checks['category'] = 'Usuários';
								$this->load->view('sistema/permissoes/permissoes.checks.php', $checks);
								?>
							</td>
							<td width="50">&nbsp;</td>
							<td>
								<!-- GRUPOS -->
								<?php
								unset($checks);
								$checks['options'] = $permissoes['grupos'];
								$checks['grupo_id'] = $grupo_id;
								$checks['category'] = 'Grupos';
								$this->load->view('sistema/permissoes/permissoes.checks.php', $checks);
								?>
							</td>
						</tr>
						<tr>
							<td>
								<!-- SISTEMA -->
								<?php
								unset($checks);
								$checks['options'] = $permissoes['sistema'];
								$checks['grupo_id'] = $grupo_id;
								$checks['category'] = 'Sistema';
								$this->load->view('sistema/permissoes/permissoes.checks.php', $checks);
								?>
							</td>
						</tr>
						<tr>
							<td colspan="3">
								<table class="form" cellpadding="0" cellspacing="0" border="0" width="100%">
									<?php
									unset($buttons);
									$buttons[] = array('submit', 'positive', 'Salvar permissões', 'disk1.gif', 0);
									$this->load->view('parts/buttons', array('buttons' =>$buttons));
									?>
								</table>
							</td>
							
						</tr>
					</table>
				</form>
				</div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>
<style type="text/css" media="screen">
<!--
ul.tabnavigation {
	list-style: none;
	margin: 0;
	padding: 0;
}
ul.tabnavigation li {
	display: inline;
}
ul.tabnavigation li a {
	background-color: #ccc;
	color: #000;
	padding: 3px 5px;
	text-decoration: none;
}
ul.tabnavigation li a.selected,
ul.tabnavigation li a:hover {
	background-color: #333;
	color: #fff;
	padding-top: 7px;
}
ul.tabnavigation li a:focus {
	outline: 0;
}
div.tabs >div {
	margin-top: 3px;
	padding: 5px;
}
div.tabs >div h2 {
	margin-top: 0;
}
-->
</style>
<script>
$(document).ready(function(){
$("#checkAll").change(function() {
if(this.checked){
v = true;
}else{
v = false;
}
chs = $(".c").get();
for(i=0; i
chs[i].checked=v;
});
});
</script>
<input type="checkbox" id="checkAll" />
