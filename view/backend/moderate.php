<?php 
$title = 'Modération';
ob_start();
?>

<div id="moderate" class="container">
    <h2>Commentaires à modérer :</h2>

    <?php
    if($moderate->rowCount())
    { 
        while($commentAdmin = $moderate->fetch())
        {    
        ?>
            <div class="panel panel-info">
                <p class="panel-heading">
                    Le commentaire de <strong><?= strip_tags($commentAdmin['author'])?></strong> du <?= $commentAdmin['comment_date_fr']?> a été signalé <strong><?= $commentAdmin['reporting']?> fois</strong>.
                </p>

                <p class="panel-body"><?= nl2br(strip_tags($commentAdmin['comment']))?></p>
                <div id="moderate-choice" class="row">
                    <em class="pull-left">
                        <a href="index.php?action=editComment&id=<?=$commentAdmin['id']?>"><button id="button-modif-com" class="btn">MODIFIER</button></a>
                    </em>
                    <em class="pull-right">
                        <a href="index.php?action=deleteComment&id=<?=$commentAdmin['id']?>"><button id="button-delete-com" class="btn">SUPPRIMER</button></a>
                    </em>
                </div>
            </div>
        <?php
        }
    }
    else
    {
        echo '<p>Aucun commentaire à modérer.</p>';
    }
    ?>
</div>

<?php
$moderate->closeCursor();
$content = ob_get_clean();

require('view/frontend/template.php');
?>