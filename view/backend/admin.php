<?php 
$title = 'Administration'; 

ob_start();
?>
<ul>
	<li><a href="">Accueil</a></li>
	<li><a href="index.php?action=newPost">Ajouter</a></li>
	<li><a href="index.php?action=moderate">Modération</a></li>
	<li><a href="view/backend/logout.php">Déconnexion</a></li>
</ul>

<?php

$content = ob_get_clean();

require('view/frontend/template.php');

?>