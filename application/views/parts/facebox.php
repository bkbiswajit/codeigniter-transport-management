<!-- CSS -->
	<link href="<?php echo $this->config->item('base_url').''; ?>css/facebox/facebox.css" media="screen" rel="stylesheet" type="text/css"/>
<!-- END CSS -->

<!-- JS -->
	<script type="text/javascript" src="<?php echo $this->config->item('base_url').''; ?>js/jquery-1.3.2.min.js"></script>
	<script type="text/javascript" src="<?php echo $this->config->item('base_url').''; ?>js/jquery-ui.js"></script>
	<script type="text/javascript" src="<?php echo $this->config->item('base_url').''; ?>js/jquery-fluid16.js"></script>
	<script src="<?php echo $this->config->item('base_url').''; ?>js/facebox/facebox.js" type="text/javascript"></script>
	<script>
		jQuery(document).ready(function($) {
		  $('a[rel*=facebox]').facebox()
		})
	</script>
	<?php
	if(isset($js)){
		foreach($js as $j){
			echo '<script type="text/javascript" src="'.$this->config->item('base_url').'js/' . $j .'"></script>';
			echo "\n";
		}
	}
	?>
	<script type="text/javascript">jQuery.fx.off = true;</script>
<!-- END JS -->