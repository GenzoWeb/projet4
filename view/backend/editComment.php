<?php 
$title = 'Administration'; ?>

<?php ob_start(); ?>
<form action="index.php?action=updateComment&id=<?= $comment['id']?>" method="post">
    <div>
        <label for="comment">Commentaire</label><br />
        <textarea name="comment"><?= $comment['comment']?></textarea>
    </div>
    <div>
        <input type="submit" id="submit" name="submit" value="Envoyer" />
    </div>
</form>

<?php

$content = ob_get_clean();

require('view/frontend/template.php');

?>