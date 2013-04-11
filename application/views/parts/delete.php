<?php

$title = (isset($title)) ? $title : 'Excluir';
$confirm = (isset($confirm)) ? $confirm : 'Are you sure you want to excluir this item?'; 

#echo '<a href="'.site_url($url).'" title="'.$title.'" onclick="if(!confirm(\''.$confirm.'\')){return false;}" />'.$title.'</a>';
echo '<a href="'.site_url($url).'" title="'.$title.'" />'.$title.'</a>';

?>