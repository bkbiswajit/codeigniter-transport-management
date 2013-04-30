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
			<a>Confirmação</a> 
		</h2> 
		<div class="block" id="infocadastro"> 
			<?php echo form_open($action, NULL, array('id' => $id)); $t = 1;?>
			<?php echo $this->msg->help(' Você tem certeza de que deseja excluir este item?'); ?>
			<?php // if(isset($text)){ echo $this->msg->warn($text); } ?>
			<?php
				unset($buttons);
				$buttons[] = array('submit', 'uibutton', 'Excluir', 'f_err.gif', $t);
				$buttons[] = array('cancel', 'uibutton icon prev', 'Cancelar', 'arr-left.gif', $t+2, site_url($cancel));
				$this->load->view('parts/buttons', array('buttons' => $buttons));
			?>
			<br />
			<?php echo form_close(); ?>
		</div>
	</div>
</div>
