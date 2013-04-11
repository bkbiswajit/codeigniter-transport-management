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
	<div class="box">
		<h2>
			<a href="#" id="toggle-search">Configurações Gerais</a>
		</h2>
		<div class="block" id="search">
			<?php echo form_open('sistema/geral/salvar'); $t = 1; ?>
				<fieldset class="login"> 
					<legend>Configurações do Sistema</legend>

				<table class="form" cellpadding="6" cellspacing="0" border="0" width="100%">
					
					<tr>
						<td class="caption">
							<label>Nome: </label>
						</td>
						<td class="field">
						  <?php
							$nome['accesskey'] = 'N';
							$nome['name'] = 'nome';
							$nome['id'] = 'nome';
							$nome['size'] = '50';
							$nome['maxlength'] = '100';
							$nome['tabindex'] = $t;
							$nome['value'] = set_value('nome', $main->nome);
							echo form_input($nome);
							$t++;
							?>
						</td>
					</tr>
					<tr>
						<td class="caption">
							<label>Subnome: </label>
						</td>
						<td class="field">
						  <?php
							$subnome['accesskey'] = 'N';
							$subnome['name'] = 'subnome';
							$subnome['id'] = 'subnome';
							$subnome['size'] = '50';
							$subnome['maxlength'] = '100';
							$subnome['tabindex'] = $t;
							$subnome['value'] = set_value('subnome', $main->subnome);
							echo form_input($subnome);
							$t++;
							?>
						</td>
					</tr>
					<tr>
						<td class="caption">
							<label>CNPJ: </label>
						</td>
						<td class="field">
						  <?php
							$cnpj['accesskey'] = 'N';
							$cnpj['name'] = 'cnpj';
							$cnpj['id'] = 'cnpj';
							$cnpj['size'] = '50';
							$cnpj['maxlength'] = '100';
							$cnpj['tabindex'] = $t;
							$cnpj['value'] = set_value('cnpj', $main->cnpj);
							echo form_input($cnpj);
							$t++;
							?>
						</td>
					</tr>
					
					<tr>
						<td class="caption">
							<label>Incricao Estadual: </label>
						</td>
						<td class="field">
						  <?php
							$incricao_estadual['accesskey'] = 'N';
							$incricao_estadual['name'] = 'incricao_estadual';
							$incricao_estadual['id'] = 'incricao_estadual';
							$incricao_estadual['size'] = '50';
							$incricao_estadual['maxlength'] = '100';
							$incricao_estadual['tabindex'] = $t;
							$incricao_estadual['value'] = set_value('incricao_estadual', $main->incricao_estadual);
							echo form_input($incricao_estadual);
							$t++;
							?>
						</td>
					</tr>
					<tr>
						<td class="caption">
							<label>URL: </label>
						</td>
						<td class="field">
						  <?php
							#$val = @field($this->validation->url);
							$url['accesskey'] = 'U';
							$url['name'] = 'url';
							$url['id'] = 'url';
							$url['size'] = '50';
							$url['maxlength'] = '100';
							$url['tabindex'] = $t;
							$url['value'] = set_value('url', $main->url);
							echo form_input($url);
							$t++;
							?>
						</td>
					</tr>
					<tr>
						<td class="caption">
							<label>E-mail: </label>
						</td>
						<td class="field">
						  <?php
							$email['accesskey'] = 'N';
							$email['name'] = 'email';
							$email['id'] = 'email';
							$email['size'] = '50';
							$email['maxlength'] = '100';
							$email['tabindex'] = $t;
							$email['value'] = set_value('email', $main->email);
							echo form_input($email);
							$t++;
							?>
						</td>
					</tr>
					<tr>
						<td class="caption">
							<label>Telefone: </label>
						</td>
						<td class="field">
						  <?php
							$telefone['accesskey'] = 'N';
							$telefone['name'] = 'telefone';
							$telefone['id'] = 'telefone';
							$telefone['size'] = '50';
							$telefone['maxlength'] = '100';
							$telefone['tabindex'] = $t;
							$telefone['value'] = set_value('telefone', $main->telefone);
							echo form_input($telefone);
							$t++;
							?>
						</td>
					</tr>
					<tr>
						<td class="caption">
							<label>Endereço: </label>
						</td>
						<td class="field">
						  <?php
							$endereco['accesskey'] = 'N';
							$endereco['name'] = 'endereco';
							$endereco['id'] = 'endereco';
							$endereco['size'] = '50';
							$endereco['maxlength'] = '100';
							$endereco['tabindex'] = $t;
							$endereco['value'] = set_value('endereco', $main->endereco);
							echo form_input($endereco);
							$t++;
							?>
						</td>
					</tr>
					<?php
						unset($buttons);
						$buttons[] = array('submit', 'positive', 'Salvar', 'disk1.gif', $t);
						$this->load->view('parts/buttons', array('buttons' => $buttons));
					?>
				</table>
			<?php echo form_close(); ?>
		</div>
	</div>
</div>