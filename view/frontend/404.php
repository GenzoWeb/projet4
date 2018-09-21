<?php
$title = "Page inexistante";
ob_start();
?>

<div id ="page-error" class="container-fluid">
    <div id="message-page-error" class="container">
        <p>Cette page n'existe pas</p>
        <p><a id="button-page-error" class="btn btn-primary" href="index.php">Revenir à l'accueil</a></p>
    </div>
</div>

<?php
$content = ob_get_clean(); 

require('template.php'); 
?>
