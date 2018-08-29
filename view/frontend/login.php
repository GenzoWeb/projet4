<?php $title = "Connectez-vous" ?>

<?php ob_start(); ?>
<p><a href="index.php">Retour à la liste des chapitres</a></p>

<h2>Se connecter</h2>

<form action="" method="post">
    <div>
        <label for="login">Login</label><br />
        <input type="text" id="login" name="login" />
    </div>
    <div>
        <label for="pass">Mot de passe</label><br />
        <input type="password" id="pass" name="pass" />
    </div>
    <div>
        <input type="submit" id="submitAdmin" name="submitAdmin" value="Se connecter" />
    </div>
</form>

<?php

$content = ob_get_clean(); 

require('template.php'); 
?>