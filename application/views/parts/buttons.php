<?php
/*
	0 type
	1 class
	2 text
	3 image
	4 tabindex
	5 url (for cancel)
*/
?><tr>
	<td>&nbsp;</td>
	<td class="action">
		<div class="buttons">
			<div class="uibutton-group">
				<?php
				$width = '16';
				$height = '16';
				$e = '';
				foreach($buttons as $button){
					switch($button[0]){
						
						case 'submit':
							$html = '<button type="submit" name="btn_submit" value="%2$s" class="%1$s" tabindex="%4$d">';
							$html .= '%2$s</button>';
							echo sprintf($html, $button[1], $button[2], $button[3], $button[4])."\n";
						break;
						
						case 'other':
							$html = '<button type="button" id="%5$s" name="%2$s" value="%2$s" class="%1$s" tabindex="%4$d">';
							$html .= '%2$s</button>';
							echo sprintf($html, $button[1], $button[2], $button[3], $button[4], strtolower(url_title($button[2])))."\n";
						break;
						
						case 'cancel':
							if($button[3] == NULL){
								$width = 1;
								$height = 16;
								$button[3] = 'blank.gif';
								$e = 'style="width:0"';
							}
							$html = '<a href="%5$s" class="%1$s" tabindex="%4$d">';
							$html .= '%2$s</a>';
							echo sprintf(
								$html,
								$button[1],	$button[2],	$button[3],	$button[4],	$button[5],
								$width, $height, $e
							)."\n";
						break;
						
						default:
						echo '<div style="display:block;float:left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>';
						break;
					}
				}
				?>
			</div>
		</div>
	</td>
</tr>
