<?php 
$title = 'Administration'; ?>

<?php ob_start(); ?>
<p>Etes vous sur de vouloir supprimer ce commentaire?</p>

<p>Auteur du commentaire : <?= $comment['author'] ?></p>
<p><?= $comment['comment'] ?></p>

<p><a href="index.php?action=removeComment&id=<?= $comment['id']?>">OUI</a></p>
<p><a href="index.php?action=moderate">NON</a></p>


<?php

$content = ob_get_clean();

require('view/frontend/template.php');

?>