<?php 
$title = 'Administration'; ?>

<?php ob_start(); ?>
<form action="index.php?action=update&id=<?= $postAdmin['id']?>" method="post">
    <div>
        <label for="title">Titre</label><br />
        <input type="text" id="title" name="title" value="<?= htmlspecialchars($postAdmin['title'])?>"/>
    </div>
    <div>
        <label for="content">Contenu</label><br />
        <textarea id="content" name="content"><?= htmlspecialchars($postAdmin['content'])?></textarea>
    </div>
    <div>
        <input type="submit" id="submit" name="submit" value="Envoyer" />
    </div>
</form>

<?php

$content = ob_get_clean();

require('view/frontend/template.php');

?>