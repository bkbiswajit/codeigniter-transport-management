<?php echo datepicker(); ?>
<script type="text/javascript">
	/* <![CDATA[ */
		$(function() {
				$('#frotas_despesas_data_vencimento').datepicker({
					userLang	: 'pt-BR',
					americanMode: false,
				});		
			});
			$(function() {
				$('#frotas_despesas_data_pagamento').datepicker({
					userLang	: 'pt-BR',
					americanMode: false,
				});		
			});
	/* ]]&gt; */
</script>

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
	<div class="box">
		<h2>
			<a href="#" id="toggle-forms">Editar Frota</a>
		</h2>
		<div class="block" id="forms">
		
			<?php echo form_open('contabilidade/frotas_despesas/salvar', NULL, array('frotas_despesas_id' => $frotas_despesas_id)); $t = 1; ?>

				<table cellpadding="6" cellspacing="0" border="0" width="100%">
				
					<tr>
						<td class="caption">
							<label for="frotas_despesas_frotas_id">Frota</label>
							<span class="required">*</span>
						</td>
						<td class="field">
							<?php
							echo form_dropdown('frotas_despesas_frotas_id', $frotas, set_value('frotas_despesas_frotas_id', (isset($frotas_despesas->frotas_despesas_frotas_id) ? $frotas_despesas->frotas_despesas_frotas_id : 0)), 'tabindex="'.$t.'"');
							$t++;
							?>
							
						</td>
					</tr>
					
					<tr>
						<td class="caption">
							<label for="frotas_despesas_tipos_id">Tipo Despesa</label>
							<span class="required">*</span>
						</td>
						<td class="field">
							<?php
							echo form_dropdown('frotas_despesas_tipos_id', $frotas_despesas_tipos, set_value('frotas_despesas_tipos_id', (isset($frotas_despesas->frotas_despesas_tipos_id) ? $frotas_despesas->frotas_despesas_tipos_id : 0)), 'tabindex="'.$t.'"');
							$t++;
							?>
							
						</td>
					</tr>
					
					<tr>
						<td class="caption">
							<label for="frotas_despesas_data_vencimento">Data Vencimento</label>
							<span class="required">*</span>
						</td>
						<td class="field">
							<?php
							unset($input);
							$input['accesskey'] = 'N';
							$input['name'] = 'frotas_despesas_data_vencimento';
							$input['id'] = 'frotas_despesas_data_vencimento';
							$input['size'] = '30';
							//$input['maxlength'] = '255';
							$input['tabindex'] = $t;
							$input['autocomplete'] = 'off';
							$input['value'] = @set_value('frotas_despesas_data_vencimento', mysql2human($frotas_despesas->frotas_despesas_data_vencimento));
							echo form_input($input);
							$t++;
							?>
						</td>
					</tr>
					
					<tr>
						<td class="caption">
							<label for="frotas_despesas_data_pagamento">Data Pagamento</label>
							<span class="required">*</span>
						</td>
						<td class="field">
							<?php
							unset($input);
							$input['accesskey'] = 'N';
							$input['name'] = 'frotas_despesas_data_pagamento';
							$input['id'] = 'frotas_despesas_data_pagamento';
							$input['size'] = '30';
							//$input['maxlength'] = '255';
							$input['tabindex'] = $t;
							$input['autocomplete'] = 'off';
							$input['value'] = @set_value('frotas_despesas_data_pagamento', mysql2human($frotas_despesas->frotas_despesas_data_pagamento));
							echo form_input($input);
							$t++;
							?>
						</td>
					</tr>
					<tr>
						<td class="caption">
							<label for="frotas_despesas_valor">Valor</label>
							<span class="required">*</span>
						</td>
						<td class="field">
							<?php
							unset($input);
							$input['accesskey'] = 'N';
							$input['name'] = 'frotas_despesas_valor';
							$input['id'] = 'frotas_despesas_valor';
							$input['size'] = '30';
							//$input['maxlength'] = '255';
							$input['tabindex'] = $t;
							$input['autocomplete'] = 'off';
							$input['value'] = @set_value('frotas_despesas_valor', $frotas_despesas->frotas_despesas_valor);
							echo form_input($input);
							$t++;
							?>
						</td>
					</tr>
					
					<tr>
						<td class="caption">
							<label for="caminhoes_caminhoes_descricao">Comentario</label>
						</td>
						<td class="field">
							<?php
							unset($input);
							$input['accesskey'] = 'U';
							$input['name'] = 'frotas_despesas_descricao';
							$input['id'] = 'frotas_despesas_descricao';
							$input['size'] = '50';
							$input['maxlength'] = '255';
							$input['tabindex'] = $t;
							$input['autocomplete'] = 'off';
							$input['value'] = @set_value('frotas_despesas_descricao', $frotas_despesas->frotas_despesas_descricao);
							echo form_input($input);
							echo form_error('frotas_despesas_descricao');
							$t++;
							?>
						</td>
					</tr>
					
					<tr>
						<td class="caption">
						<label for="frotas_despesas_ativo" accesskey="E">Ativo</label>
						</td>
						<td class="field">
						<label for="frotas_despesas_ativo" class="check">
						<?php
						unset($check);
						$check['name'] = 'frotas_despesas_ativo';
						$check['id'] = 'frotas_despesas_ativo';
						$check['value'] = '1';
						$check['checked'] = @set_checkbox($check['name'], $check['value'], ($frotas_despesas->frotas_despesas_ativo == 1));
						$check['tabindex'] = $t;
						echo form_checkbox($check);
						$t++;
						?>
						</label>

						</td>
					</tr>
						<?php
						if($frotas_despesas_id == NULL){
							$submittext = 'Adicionar';
						} else {
							$submittext = 'Salvar';
						}
						unset($buttons);
						$buttons[] = array('submit', 'uibutton', $submittext, 'disk1.gif', $t);
						$buttons[] = array('submit', 'uibutton icon add', 'Salvar e adicionar outro', 'disk1.gif', $t+1);
						$buttons[] = array('cancel', 'uibutton icon prev', 'Cancelar', 'arr-left.gif', $t+2, site_url('contabilidade/frotas_despesas'));
						$this->load->view('parts/buttons', array('buttons' => $buttons));
						?>
				</table>
			</form>
		</div>
	</div>
</div>