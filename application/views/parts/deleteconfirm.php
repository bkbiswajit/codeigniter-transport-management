<div class="grid_4">
	<div class="box"> 
		<h2> 
			<a id="toggle-infocadastro">Informações</a> 
		</h2> 
		<div class="block" id="infocadastro"> 
			<p></p> 
		</div> 
	</div>
	<div class="box"> 
		<h2> 
			<a id="toggle-infologin">Informações</a> 
		</h2> 
		<div class="block" id="infologin">
		<p></p>
		</div> 
	</div>
</div>
<div class="grid_12">
	<div class="box"> 
		<h2> 
			<a id="toggle-infocadastro">Informações</a> 
		</h2> 
		<div class="block" id="infocadastro"> 
			<?php
			echo form_open($action, NULL, array('id' => $id));
			echo '<br />';
			echo $this->msg->help(' Você tem certeza de que deseja excluir este item?');
			if(isset($text)){ echo $this->msg->warn($text); }
			?>
				<br /><br />
				<table class="form">
				<?php
				$t = 1;
				unset($buttons);
				$buttons[] = array('submit', 'positive', 'Excluir', 'f_err.gif', $t);
				$buttons[] = array('cancel', 'negative', 'Cancelar', 'arr-left.gif', $t+2, site_url($cancel));
				$this->load->view('parts/buttons', array('buttons' => $buttons));
				?>
				</table>
			</form>
		</div>
	</div>
</div>
