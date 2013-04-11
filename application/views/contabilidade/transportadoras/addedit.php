<?php echo datepicker(); ?>
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
			<a href="#" id="toggle-forms">Editar transportadoras</a>
		</h2>
		<div class="block" id="forms">
			<?php echo form_open('contabilidade/transportadoras/salvar', NULL, array('transportadoras_id' => $transportadoras_id)); $t = 1; ?>

			<?php if($transportadoras_id == NULL){ ?><?php } ?>

				<table class="form" cellpadding="6" cellspacing="0" border="0" width="100%">
					
					<tr>
						<td class="caption">
							<label for="transportadoras_descricao" class="r" accesskey="N"><u>N</u>ome</label>
							
						</td>
						<td class="field">
							<?php
							unset($input);
							$input['accesskey'] = 'N';
							$input['name'] = 'transportadoras_descricao';
							$input['id'] = 'transportadoras_descricao';
							$input['size'] = '60';
							//$input['maxlength'] = '255';
							$input['tabindex'] = $t;
							$input['autocomplete'] = 'off';
							$input['value'] = @set_value('transportadoras_descricao', $transportadoras->transportadoras_descricao);
							echo form_input($input);
							echo form_error('transportadoras_descricao');
							$t++;
							?>
						</td>
					</tr>
					
					<tr>
						<td class="caption">
							<label for="transportadoras_ativo" accesskey="E"><u>A</u>tivo</label>
						</td>
						<td class="field">
							<label for="transportadoras_ativo" class="check">
							<?php
							unset($check);
							$check['name'] = 'transportadoras_ativo';
							$check['id'] = 'transportadoras_ativo';
							$check['value'] = '1';
							$check['checked'] = @set_checkbox($check['name'], $check['value'], ($transportadoras->transportadoras_ativo == 1));
							$check['tabindex'] = $t;
							echo form_checkbox($check);
							$t++;
							?>
							</label>

						</td>
					</tr>
					
					<?php
					if($transportadoras_id == NULL){
						$submittext = 'Adicionar';
					} else {
						$submittext = 'Salvar';
					}
					unset($buttons);
					$buttons[] = array('submit', 'uibutton', $submittext, 'disk1.gif', $t);
					$buttons[] = array('submit', 'uibutton icon add', 'Salvar e adicionar outro', 'disk1.gif', $t+1);
					$buttons[] = array('cancel', 'uibutton icon prev', 'Cancelar', 'arr-left.gif', $t+2, site_url('contabilidade/transportadoras'));
					$this->load->view('parts/buttons', array('buttons' => $buttons));
					?>

				</table>
			</form>
		</div>
	</div>
</div>