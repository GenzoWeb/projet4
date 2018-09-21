<?php 
$title = 'Supprimer chapitre';
ob_start();
?>

<div id="delete-post" class="container">
	<h2>Etes-vous sur de vouloir supprimer ce chapitre?</h2>
	<div id="table-delete" class="panel">
		<div id="header-table-delete" class="panel-heading">
			<?= htmlspecialchars($postAdmin['title']) ?>
		</div>
		<div class="panel-body">
			<?= $textPost ?>
		</div>
		<div id="confirm-delete" class="row">
			<a id="confirm-delete-post" class="pull-left" href="index.php?action=remove&id=<?= $postAdmin['id']?>"><button class="btn btn-primary">OUI</button></a>
			<a id="refuse-delete-post" class="pull-right" href="index.php?action=login"><button class="btn btn-primary">NON</button></a>
		</div>
	</div>
</div>

<?php
$content = ob_get_clean();

require('view/frontend/template.php');
?>