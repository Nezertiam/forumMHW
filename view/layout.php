<?php
    use App\Core\Session;
?>

<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= CSS_PATH ?>/uikit.min.css" />
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />
    <script src="<?= JS_PATH ?>/uikit.min.js"></script>
    <script src="<?= JS_PATH ?>/uikit-icons.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="<?= JS_PATH ?>/datatables.js"></script>
    
    <link rel="stylesheet" href="<?= CSS_PATH ?>/style.css">


    <title>MHW France <?= $title ? " - ".$title : "" ?></title>
</head>

<body>
    <header>

        <nav class="uk-navbar-container uk-container uk-container-xlarge" uk-navbar>

            <div class="uk-navbar-left">
                <ul class="uk-navbar-nav">
                    <li class="uk-active"><div id="logo"><a href="?"><img src="<?= IMG_PATH ?>/logo.png" alt=""></a></div></li>
                </ul>
            </div>

            <div class="uk-navbar-right">
                <ul class="uk-navbar-nav">
                    <li>
                        <?= Session::get("user") ? Session::get("user") : "<a href='?ctrl=auth&action=login'>Mon Compte WORLD</a>" ?>
                        <div class="uk-navbar-dropdown">
                            <ul class="uk-nav uk-navbar-dropdown-nav">
                            <?= Session::get("user") ? "<li><a href='?ctrl=auth&action=logout'>Déconnexion</a></li>" : "<li><a href='?ctrl=auth&action=login'>Connexion</a></li><li><a href='?ctrl=auth&action=register'>Inscription</a></li>"?>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
        
    </header>


    <?php include("messages.php"); ?>
    <div id="container" class="uk-container uk-container-small">
        <?= $page //ici s'intègrera la page que le contrôleur aura renvoyé !!?> 
    </div>


    <footer>
        <p><a href="?ctrl=home&action=voirRegles">Règlement du forum</a></p>
        <p id="copy">&copy; 2021 - Elan Formation</p>
    </footer>

</body>
</html>


