<?php 
$title = 'Administration'; ?>

<?php ob_start(); ?>

<p>Commentaires à modérer :</p>

<?php
while($commentAdmin = $moderate->fetch())
{    
?>

<p>
    Le commentaire de <strong><?= $commentAdmin['author']?></strong> du <?= $commentAdmin['comment_date_fr']?> a été signalé <strong><?= $commentAdmin['reporting']?> fois</strong>.
</p>

<p>
    <?= nl2br(htmlspecialchars($commentAdmin['comment']))?>
    <em>
        <a href="index.php?action=deleteComment&id=<?=$commentAdmin['id']?>">Supprimer</a>
    </em> 
</p>  

<?php
}

$content = ob_get_clean();

require('view/frontend/template.php');

?>