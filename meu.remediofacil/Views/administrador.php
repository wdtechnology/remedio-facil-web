
<!-- Conteúdo Superior -->
<nav class="navbar navbar-expand-lg border-bottom">

    <!--menu Toggle-->
    <div class="line_menu">
        <div class="lines"></div>
        <div class="lines"></div>
        <div class="lines"></div>
    </div>
    <!-- Fim menu Toggle -->

    <!-- Menu Mobile-->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <!-- Fim MENU Mobile -->

    <!-- Conteúdo Usuário -->
    <div class="collapse navbar-collapse collapse_button" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php
                    $nome = explode(" ",$info['farmacia_nome']);
                    echo $nome['0'];
                    ?>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="<?php echo BASE_URL;?>farmacia/minha-conta">Minha Conta</a>
                    <?php if($info['farmacia_status'] == 1):?>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?php echo BASE_URL;?>administrador">Visualizar sistema</a>
                    <?php endif;?>

                    <?php if(!empty($existe)):?>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?php echo BASE_URL;?>posto/">Gerenciar Posto</a>
                    <?php endif;?>
                </div>
            </li>
        </ul>
    </div>
    <!-- Fim Conteúdo Usuário -->
</nav>

<section id="action">
    <div class="container-fluid">
        <div class="jumbotron jumbotron_bg">
            <div class="col-12 title">
                <h1>Ações</h1>
            </div>
        </div>

        <div class="row">
            <div class="col-sm action_content">
                <div class="action_image">

                </div>
                <div class="action_btn d-flex justify-content-center">
                    <a href="<?php echo BASE_URL;?>administrador/visualizar-cadastros" class="btn btn-primary">Visualizar cadastros</a>
                </div>
            </div>
            <div class="col-sm action_content">
                <div class="action_image">

                </div>
                <div class="action_btn d-flex justify-content-center">
                    <a href="<?php echo BASE_URL;?>administrador/adicionar-remedios" class="btn btn-primary">Adicionar remédios</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm action_content">
                <div class="action_image">

                </div>
                <div class="action_btn d-flex justify-content-center">
                    <a href="<?php echo BASE_URL;?>administrador/editar-remedios" class="btn btn-primary">Editar remédios</a>
                </div>
            </div>
            <div class="col-sm">

            </div>
        </div>
    </div>
</section>