<?php 
$title = 'Supprimer commentaire';
ob_start();
?>

<div id="delete-comment" class="container">
	<h2>Etes-vous sur de vouloir supprimer ce commentaire?</h2>
	<div class="panel panel-info">
		<p class="panel-heading">Auteur du commentaire : <?= strip_tags($comment['author']) ?></p>
		<p class="panel-body"><?= nl2br(strip_tags($comment['comment'])) ?></p>
		<div id="moderate-choice" class="row">
			<a class="pull-left" href="index.php?action=removeComment&id=<?= $comment['id']?>"><button id="button-confirm-delete-com" class="btn">OUI</button></a>
			<a class="pull-right" href="index.php?action=moderate"><button id="button-refuse-delete-com" class="btn">NON</button></a>
		</div>
	</div>
</div>
<?php
$content = ob_get_clean();

require('view/frontend/template.php');
?>