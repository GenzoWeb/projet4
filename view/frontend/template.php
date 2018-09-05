<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="description" content="" />
        <link rel="stylesheet" href="public/css/style.css" />   
        <title><?= $title ?></title>
        <script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=g41dsr31kz48t5x37w6hpvr6op9v3a5p8xsasdl4mf661an8"></script> 
        <script>
            tinymce.init({
                selector: '#mytextarea'
            });
        </script>
    </head>

    <body>
        <?php 
            if (!isset($_SESSION['login'])){
        ?>        
                <p><a href="index.php?action=login">ADMINISTRATION</a></p>

        <?php
            } 
            if (isset($_SESSION['login'])){
                echo 'Bonjour ' . $_SESSION['login'];
        ?>  

            <ul>
                <li><a href="index.php?action=admin">Accueil</a></li>
                <li><a href="index.php?action=newPost">Ajouter</a></li>
                <li><a href="index.php?action=moderate">Modération</a></li>
                <li><a href="index.php?action=logout">Déconnexion</a></li>
            </ul> 

            <?php 
            }
            ?>   
         
        <?= $content ?>
    </body>
</html>