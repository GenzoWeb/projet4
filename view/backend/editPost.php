<?php 
$title = 'Modifiez chapitre';
ob_start();
?>

<div id="edit-post" class="container">
    <div class="form-container">
        <h2>Modifiez un chapitre</h2>
        <form class="form-container" action="index.php?action=update&id=<?= $postAdmin['id']?>&page=<?= $_GET['page']?>" method="post">
            <div class="form-group">
                <label for="title">Titre</label><br />
                <input class="form-control" type="text" id="title" name="title" value="<?= htmlspecialchars($postAdmin['title'])?>"/>
            </div>
            <div class="form-group">
                <label for="content">Contenu</label><br />
                <textarea class="form-control" id="mytextarea" name="content"><?= $postAdmin['content']?></textarea>
            </div>
            <div id="edit-post-button">
                <button class="btn btn-primary" type="submit" id="submit" name="submit">Envoyer</button>
            </div>
        </form>
    </div>

<?php
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
?>
</div>

<?php
$content = ob_get_clean();

require('view/frontend/template.php');
?>