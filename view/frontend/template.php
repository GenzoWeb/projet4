<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="description" content="" />
        <link rel="stylesheet" href="public/css/style.css" />   
        <title><?= $title ?></title>
    </head>

    <body>
        <div>
            <p><a href="index.php?action=login">ADMINISTRATION</a></p>
        </div>

        <?php 
            if (isset($_SESSION['login'])){
                echo 'Bonjour ' . $_SESSION['login'];
            }
        ?>       
         
        <?= $content ?>
    </body>
</html>