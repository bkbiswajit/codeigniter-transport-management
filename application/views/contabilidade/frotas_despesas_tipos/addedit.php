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
			<a href="#" id="toggle-forms">EDITAR FROTA DESPESA TIPO</a>
		</h2>
		<div class="block" id="forms">
		
			<?php echo form_open('contabilidade/frotas_despesas_tipos/salvar', NULL, array('frotas_despesas_tipos_id' => $frotas_despesas_tipos_id)); $t = 1; ?>

				<table cellpadding="6" cellspacing="0" border="0" width="100%">
					
					<tr>
						<td class="caption">
							<label for="caminhoes_caminhoes_descricao" class="r" accesskey="U">Tipo</label>
							<span class="required">*</span>
						</td>
						<td class="field">
							<?php
							unset($input);
							$input['accesskey'] = 'U';
							$input['name'] = 'frotas_despesas_tipos_descricao';
							$input['id'] = 'frotas_despesas_tipos_descricao';
							$input['size'] = '50';
							$input['maxlength'] = '255';
							$input['tabindex'] = $t;
							$input['autocomplete'] = 'off';
							$input['value'] = @set_value('frotas_despesas_tipos_descricao', $frotas_despesas_tipos->frotas_despesas_tipos_descricao);
							echo form_input($input);
							echo form_error('frotas_despesas_tipos_descricao');
							$t++;
							?>
						</td>
					</tr>
					<tr>
						<td class="caption">
						<label for="frotas_despesas_tipos_ativo" accesskey="E">Ativo</label>
						</td>
						<td class="field">
						<label for="frotas_despesas_tipos_ativo" class="check">
						<?php
						unset($check);
						$check['name'] = 'frotas_despesas_tipos_ativo';
						$check['id'] = 'frotas_despesas_tipos_ativo';
						$check['value'] = '1';
						$check['checked'] = @set_checkbox($check['name'], $check['value'], ($frotas_despesas_tipos->frotas_despesas_tipos_ativo == 1));
						$check['tabindex'] = $t;
						echo form_checkbox($check);
						$t++;
						?>
						</label>

						</td>
					</tr>
						<?php
						if($frotas_despesas_tipos_id == NULL){
							$submittext = 'Adicionar';
						} else {
							$submittext = 'Salvar';
						}
						unset($buttons);
						$buttons[] = array('submit', 'uibutton', $submittext, 'disk1.gif', $t);
						$buttons[] = array('submit', 'uibutton icon add', 'Salvar e adicionar outro', 'disk1.gif', $t+1);
						$buttons[] = array('cancel', 'uibutton icon prev', 'Cancelar', 'arr-left.gif', $t+2, site_url('contabilidade/frotas_despesas_tipos'));
						$this->load->view('parts/buttons', array('buttons' => $buttons));
						?>
				</table>
			</form>
		</div>
	</div>
</div>