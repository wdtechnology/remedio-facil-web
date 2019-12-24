<!DOCTYPE html>
<html>
    <head>
        <title>Meu Remédio Fácil | Login</title>
        <meta chaset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="author" content="Remédio Fácil"/>
        <meta name="description" content=""/>
        <meta name="keywords" content=""/>

        <!--ADICIONAR SCRIPT DO GOOGLE ANALYTICS-->

        <!--LINK REL-->
        <link rel="shortcut icon" href="<?php echo BASE_URL;?>assets/images/favicon.png"/>
        <link rel="stylesheet" href="<?php echo BASE_URL;?>assets/css/bootstrap.min.css"/>
        <link rel="stylesheet" href="<?php echo BASE_URL;?>assets/css/style.css"/>
    </head>
    <body>
        <section id="login">
            <div class="container-fluid">
                <div class="row row-bg">
                    <div class="col-sm capa-bg">
                        <div class="capa_content">
                            <div class="capa_image">
                                <img src="<?php echo BASE_URL;?>assets/images/mao_capa.png"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm form-bg">
                        <div class="capa_content">
                            <div class="form">
                                <h2>Login</h2>
                                <form method="POST">
                                    <div class="form-group">
                                        <input type="email" name="email" placeholder="E-mail" required class="form-control"/>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="senha" placeholder="Senha" required class="form-control"/>
                                    </div>
                                    <input type="submit" value="Logar" class="btn btn-primary circular"/>
                                </form>
                                <a class="link_login" href="<?php echo BASE_URL;?>reset/esqueci-a-senha">Esqueceu a senha?</a>
                                <?php if(!empty($alerta)):?>
                                    <div class="alert alert-warning" role="alert">
                                        <?php echo $alerta;?>
                                    </div>
                                <?php endif;?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <script type="text/javascript" src="<?php echo BASE_URL;?>assets/js/jquery-3.4.1.min.js"></script>
        <script type="text/javascript" src="<?php echo BASE_URL;?>assets/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="<?php echo BASE_URL;?>assets/js/script.js"></script>
    </body>
</html>