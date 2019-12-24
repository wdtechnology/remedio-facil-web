<!DOCTYPE html>
<html>
    <head>
        <title>Remédio Fácil | Alterar senha</title>
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
    <body class="esqueci_bg">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm container_reset">
                    <div class="col-sm reset_text">
                        <h5>Alterar senha</h5>
                    </div>
                    <form method="post" class="form">
                        <div class="form-group">
                            <input type="password" name="senha" placeholder="Nova senha" class="form-control" required/>
                        </div>
                        <div class="form-group">
                            <input type="password" name="confirmar" placeholder="Digite novamente" class="form-control" required/>
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Enviar" class="btn btn-primary"/>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row d-flex justify-content-center">
                <?php if(!empty($alerta)):?>
                    <div class="alert alert-warning">
                        <?php echo $alerta;?>
                    </div>
                <?php endif;?>
            </div>
        </div>
        <script type="text/javascript" src="<?php echo BASE_URL;?>assets/js/jquery-3.4.1.min.js"></script>
        <script type="text/javascript" src="<?php echo BASE_URL;?>assets/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="<?php echo BASE_URL;?>assets/js/script.js"></script>
    </body>
</html>