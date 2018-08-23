<?php 
$title = 'Administration'; ?>

<?php ob_start(); ?>
<ul>
	<li><a href="">Accueil</a></li>
</ul>

<?php

$content = ob_get_clean();

require('view/frontend/template.php');

?>