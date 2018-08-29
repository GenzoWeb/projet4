<?php 
$title = 'Administration'; ?>

<?php ob_start(); ?>

<p>Commentaires à modérer :</p>

<?php
if($moderate->rowCount()){ 
while($commentAdmin = $moderate->fetch())
    {    
    ?>

    <p>
        Le commentaire de <strong><?= htmlspecialchars($commentAdmin['author'])?></strong> du <?= $commentAdmin['comment_date_fr']?> a été signalé <strong><?= $commentAdmin['reporting']?> fois</strong>.
    </p>

    <p>
        <?= nl2br(htmlspecialchars($commentAdmin['comment']))?>
            <em>
                <a href="index.php?action=editComment&id=<?=$commentAdmin['id']?>">Modifier</a>
            </em>
            <em>
                <a href="index.php?action=deleteComment&id=<?=$commentAdmin['id']?>">Supprimer</a>
            </em> 
    </p>  

    <?php
    }
}
else{
    echo '<p>Aucun commentaire à modérer.</p>';
}

$content = ob_get_clean();

require('view/frontend/template.php');

?>