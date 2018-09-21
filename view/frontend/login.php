<?php
$title = "Connectez-vous";
ob_start();
?>

<div id ="form-login" class="container">
    <div class="form-container">
        <h2>Se connecter</h2>

        <form action="" method="post" class="form-container">
            <div class="form-group">
                <label for="login ">Login : </label>
                <input id="text" type="login" name="login" class="form-control">
            </div>
            <div class="form-group">
                <label for="pass ">Mot de passe : </label>
                <input id="pass" type="password" name="pass" class="form-control">
            </div>
            <button type="submit" id="submitAdmin" name="submitAdmin" class="btn btn-primary">Se connecter</button>
        </form>

        <?php
        if(isset($_SESSION['erreur']))
        {
        ?>
            <div id="error" class="alert alert-block alert-danger">
            <?= $_SESSION['erreur'];?>
            </div>
        <?php
        }
        ?>
    </div>
</div>

<?php
$content = ob_get_clean(); 

require('template.php'); 
?>