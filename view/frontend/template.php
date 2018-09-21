<?php 
unset($_SESSION['erreur']);
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="description" content="" />
        <link rel="stylesheet" href="public/css/style.css" /> 
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Yesteryear" rel="stylesheet">
        <link rel="icon" type="image/x-icon" href="public/images/favicon.ico" />
        <!--[if IE]><link rel="shortcut icon" type="image/x-icon" href="public/images/favicon.ico" /><![endif]-->
        <title><?= $title ?></title>
        <script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=g41dsr31kz48t5x37w6hpvr6op9v3a5p8xsasdl4mf661an8"></script> 
        <script>
            tinymce.init({
                selector: '#mytextarea'
            });
        </script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>

    <body>
        <header id="menu" class="navbar">
            <section id="menu-bar" class="row">
                <?php
                if (isset($_SESSION['login']))
                {
                ?>
                
                    <div id="menu-admin" class="navbar">
                        <div class="container-fluid">
                            <div class="navbar-header hidden-xs">
                                <p id="text-menu-admin" class="navbar-brand">Bonjour <?=  $_SESSION['login']?></p>
                            </div>

                            <ul id ="list-admin" class="nav navbar-nav navbar-right">
                                <li><a href="index.php?action=admin"><span class="glyphicon glyphicon-home"></span>Accueil</a></li>
                                <li><a href="index.php?action=newPost">Ajouter</a></li>
                                <li><a href="index.php?action=moderate">Modération</a></li>
                                <li><a href="index.php?action=logout">Déconnexion</a></li>
                            </ul> 
                        </div>
                    </div> 
                <?php 
                }
                else
                {
                ?>
                    <div id ="menu-user" class="navbar col-md-12">
                        <div class="navbar-header">
                            <p id="logo" class="hidden-xs">Jean Forteroche</p>
                        </div>    
                        <ul id ="link-menu-user" class="nav navbar-nav navbar-right">
                            <li><a href="index.php"><span class="glyphicon glyphicon-home"></span>ACCUEIL</a></li>
                            <li><a href="index.php?action=login">SE CONNECTER</a></li>
                        </ul> 
                    </div>
                <?php 
                }
                ?>  
            </section>
        </header> 

        <?= $content ?>

        <footer class="footer">
            <div class="container">
                 <div id="text-footer" class="row">
                    <p class="pull-left col-sm-5 col-xs-12">BILLET SIMPLE POUR L' ALASKA </p>
                    <p class="pull-right col-sm-3 col-xs-12">Jean FORTEROCHE</p>
                </div>
            </div>
        </footer>
    </body>
</html>