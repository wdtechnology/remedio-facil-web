<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Meu Remédio Fácil | Sua Conta</title>
        <!--META TAGS-->
        <meta charset="utf-8"/>
        <meta name="author" content="Remédio Facil"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content=""/>
        <meta name="keywords" content=""/>
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <!--ADICIONAR SCRIPT GOOGLE ANALYTICS-->

        <link rel="shortcut icon" href="<?php echo BASE_URL;?>assets/images/icone.png"/>
        <!--CSS-->
        <link rel="stylesheet" href="<?php echo BASE_URL;?>assets/css/bootstrap.min.css"/>
        <link rel="stylesheet" href="<?php echo BASE_URL;?>assets/css/chart.min.css"/>
        <link rel="stylesheet" href="<?php echo BASE_URL;?>assets/css/style.css"/>
    </head>
    <body>
        <div class="d-flex wrapper" id="wrapper">

            <!-- Sidebar-->
            <div class="sidebar_content sidebar-wrapper">
                <!-- Sidebar Titulo-->
                <div class="sidebar-heading sidebar-top d-flex justify-content-center">
                    <a href="<?php echo BASE_URL;?>" title="Remédio Fácil">
                        <img src="<?php echo BASE_URL;?>assets/images/icone.png" style="width:50px;" title="Remédio Fácil"/>
                    </a>
                </div>
                <!-- Sidebar Menus -->
                <div class="list-group list-group-flush menu_lateral">
                    <nav>
                        <ul>
                            <li>
                                <a href="<?php echo BASE_URL;?>" class="list-group-item list-group-item-action" title="Home">
                                    Home
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo BASE_URL;?>farmacia/adicionar-remedio" class="list-group-item list-group-item-action" title="Adicionar">
                                    Adicionar
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo BASE_URL;?>farmacia/remedios-adicionados" class="list-group-item list-group-item-action" title="Adicionados">
                                    Adicionados
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo BASE_URL;?>farmacia/encerrar-sessao" class="list-group-item list-group-item-action" title="Sair">
                                    Sair
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            <!-- Conteúdo Maior -->
            <div class="page-content-wrapper">

                <?php $this->loadViewInTemplate($viewName, $viewData);?>

            </div>
        </div>
        <script type="text/javascript" src="<?php echo BASE_URL;?>assets/js/jquery-3.4.1.min.js"></script>
        <script type="text/javascript" src="<?php echo BASE_URL;?>assets/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="<?php echo BASE_URL;?>assets/js/jquery.mask.min.js"></script>
        <script type="text/javascript" src="<?php echo BASE_URL;?>assets/js/chart.min.js"></script>
        <script type="text/javascript" src="<?php echo BASE_URL;?>assets/js/script.js"></script>
    </body>
</html>