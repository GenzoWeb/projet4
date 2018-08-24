<?php $title = htmlspecialchars($post['title']); ?>

<?php ob_start(); ?>
<h1>BLOG</h1>
<p><a href="index.php">Retour à la liste des billets</a></p>

<h3>
    <?= htmlspecialchars($post['title'])?> le <?= $post['creation_date_fr']?>
</h3>

<p>
    <?= nl2br(htmlspecialchars($post['content']))?>
</p>

<h2>Commentaires</h2>

<form action="index.php?action=addComment&id=<?= $post['id'] ?>" method="post">
    <div>
        <label for="author">Auteur</label><br />
        <input type="text" id="author" name="author" />
    </div>
    <div>
        <label for="comment">Commentaire</label><br />
        <textarea id="comment" name="comment"></textarea>
    </div>
    <div>
        <input type="submit" />
    </div>
</form>

<?php
while($comment = $comments->fetch())
{    
?>

<p>
    <strong><?= htmlspecialchars($comment['author'])?></strong> le <?= $comment['comment_date_fr']?>
</p>

<p>
    <?= nl2br(htmlspecialchars($comment['comment']))?>
    <?php 
        if(!isset($_SESSION['login'])){
    ?>  
        <em>
            <a class="rep" href="index.php?action=report&id=<?=$comment['id']?>&post_id=<?=$comment['post_id']?>&reporting=<?=$comment['reporting']?>">Signaler un abus</a>
        </em> 

    <?php   
        }
    ?>
</p>  

<?php
}

$comments->closeCursor();

$content = ob_get_clean(); 

require('template.php'); 
?>

<script src="public/js/report.js"></script>
