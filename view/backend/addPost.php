<?php 
$title = 'Ajout chapitre';
ob_start();
?>

<div id="add-post" class="container">
    <div class="form-container">
        <h2>Ajoutez un chapitre</h2>
        <form action="index.php?action=addPost" method="post" class="form-container">
            <div class="form-group">
                <label for="title">Titre</label><br />
                <input class="form-control" type="text" id="title" name="title" />
            </div>
            <div class="form-group">
                <label for="content">Contenu</label><br />
                <textarea class="form-control" id="mytextarea" name="content"></textarea>
            </div>
            <div id="add-post-button">
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