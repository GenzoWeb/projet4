<?php 
$title = 'Administration'; ?>

<?php ob_start(); ?>
<p>Etes vous sur de vouloir supprimer ce chapitre?</p>

<p>Titre du chapitre : <?= htmlspecialchars($postAdmin['title']) ?></p>
<p><?= $postAdmin['content'] ?></p>

<p><a href="index.php?action=remove&id=<?= $postAdmin['id']?>">OUI</a></p>
<p><a href="index.php?action=login">NON</a></p>


<?php

$content = ob_get_clean();

require('view/frontend/template.php');

?>