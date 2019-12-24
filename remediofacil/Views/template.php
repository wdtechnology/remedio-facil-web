<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Remédio Fácil</title>
        <!--META TAGS-->
        <meta charset="utf-8"/>
        <meta name="author" content="Samuel V-S-S"/>
        <meta name="keywords" content=""/>
        <meta name="description" content=""/>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <!--FAVICON-->
        <link rel="shortcut icon" href="<?php echo BASE_URL;?>assets/images/favicon.png"/>
        <!--STYLES-->
        <link rel="stylesheet" href="<?php echo BASE_URL;?>assets/css/bootstrap.min.css"/>
        <link rel="stylesheet" href="<?php echo BASE_URL;?>assets/css/animate.css"/>
        <link rel="stylesheet" href="<?php echo BASE_URL;?>assets/css/style.css"/>
    </head>
    <body>
        <header id="header">
            <nav class="navbar navbar-expand-lg">
                <div class="logo">
                    <h3>
                        <a href="<?php echo BASE_URL;?>">
                            <img src="<?php echo BASE_URL;?>assets/images/logo.png" alt="Logo"/>
                        </a>
                    </h3>
                </div>

                <!--MENU MOBILE-->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#menu">
                    <img src="<?php echo BASE_URL;?>assets/images/menu.png" class="menu_img" alt="Menu Icone"/>
                </button>


                <!--FIM MENU MOBILE-->
                <div class="menu collapse navbar-collapse" id="menu">
                    <nav>
                        <ul class="navbar-nav">
                            <li>
                                <a href="<?php echo BASE_URL;?>home">Home</a>
                            </li>
                            <li>
                                <a href="<?php echo BASE_URL;?>seja-nosso-parceiro">Seja nosso parceiro</a>
                            </li>
                            <li >
                                <a class="link_login" href="<?php echo BASE_URL;?>entrar" target="_blank">Entrar</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </nav>
        </header>
        <?php $this->loadViewInTemplate($viewName, $viewData);?>

        <footer id="footer">
            <div class="container-fluid">
                <div class="row">

                </div>
            </div>
        </footer>

        <script src="<?php echo BASE_URL;?>assets/js/jquery-3.4.1.min.js"></script>
        <script src="<?php echo BASE_URL;?>assets/js/jquery.mask.min.js"></script>
        <script src="<?php echo BASE_URL;?>assets/js/bootstrap.min.js"></script>
        <script src="<?php echo BASE_URL;?>assets/js/wow.min.js"></script>
        <script src="<?php echo BASE_URL;?>assets/js/script.js"></script>
    </body>
</html>

