<?php
$title = htmlspecialchars($post['title']);
ob_start();
?>

<div id="post-view" class="container">
    <p id="return"><a href="index.php?action=listPosts">Retour à la liste des chapitres</a></p>
    <div id="post" class="row">
        <h3 class="title-post2">
            <?= htmlspecialchars($post['title'])?> le <?= $post['creation_date_fr']?>
        </h3>

        <div id="post-content">
            <?= $post['content']?>
        </div>
    </div>
    <div id="comment" class="row">
        <?php
        if($comments->rowCount() <= 1)
        {
        ?>
            <h2>Commentaire</h2>
        <?php
        }
        else
        {
        ?>
            <h2>Commentaires</h2>
        <?php
        }

        if(isset($_SESSION['erreur']))
        {
        ?>
            <div id="error" class="alert alert-block alert-danger">
                <?php
                echo $_SESSION['erreur'];
                ?>
            </div>
        <?php
        }
        if($comments->rowCount())
        {
            while($comment = $comments->fetch())
            {    
            ?>
                <div class="panel panel-info">
                    <p class="panel-heading">
                        <strong class="panel-title"><?= strip_tags($comment['author'])?></strong> le <?= $comment['comment_date_fr']?>
                    </p>

                    <p class="panel-body">
                        <?= nl2br(strip_tags($comment['comment']))?>
                    </p>
                        
                    <em>
                        <a id="report-com" class="btn" href="index.php?action=report&id=<?=$comment['id']?>&post_id=<?=$comment['post_id']?>&reporting=<?=$comment['reporting']?>">Signaler un abus</a>
                    </em>  
                </div>
            <?php
            }
        }
        else
        {
        ?>
            <p>Aucun commentaire !</p>
        <?php
        }
        ?>
        <h2>Ajoutez un commentaire</h2>
        <div id ="form-comment" class="container">
            <div class="form-container">
                <form action="index.php?action=addComment&id=<?= $post['id'] ?>" method="post">
                    <div class="form-group">
                        <label for="author">Auteur</label><br />
                        <input type="text" id="author" name="author" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label for="comment">Commentaire</label><br />
                        <textarea id="comment" name="comment" class="form-control"></textarea>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary">Envoyer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
$comments->closeCursor();
$content = ob_get_clean(); 

require('template.php'); 
?>

<script src="public/js/report.js"></script>
