<?php 
$title = 'Administration'; ?>

<?php ob_start(); ?>
<form action="index.php?action=addPost" method="post">
    <div>
        <label for="title">Titre</label><br />
        <input type="text" id="title" name="title" />
    </div>
    <div>
        <label for="content">Contenu</label><br />
        <textarea id="content" name="content"></textarea>
    </div>
    <div>
        <input type="submit" id="submit" name="submit" value="Envoyer" />
    </div>
</form>

<?php

$content = ob_get_clean();

require('view/frontend/template.php');

?>