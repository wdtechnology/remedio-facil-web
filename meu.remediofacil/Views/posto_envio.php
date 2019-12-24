
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

<!-- HOME CONTEÚDO -->
<div class="container-fluid">
    <div class="jumbotron jumbotron_bg">
        <div class="col-12 title">
            <h1>Doações para receber</h1>
        </div>
    </div>
</div>
<div class="container-fluid">
    <table class="table">
        <thead>
            <th>Doado por:</th>
            <th>Remédio:</th>
            <th>Data prevista:</th>
            <th>Confirmar para doação:</th>
        </thead>
        <?php if($envio == array()):?>
            <tbody>
                <td>Não há doações para receber</td>
            </tbody>
        <?php else:?>

            <?php foreach($envio as $e):?>
                <tbody>
                    <td><?php echo $e['usuario'];?></td>
                    <td title="<?php echo $e['remedio'];?>"><?php echo substr($e['remedio'], 0 , 40);?>...</td>
                    <td><?php echo date('d/m/Y', strtotime($e['estimada']));?></td>
                    <td>
                        <a href="<?php echo BASE_URL;?>posto/confirmar-recebimento/<?php echo $e['envio_id'];?>" class="btn btn-success">Confirmar</a>
                        <a href="<?php echo BASE_URL;?>posto/deletar-recebimento/<?php echo $e['envio_id'];?>" class="btn btn-danger">Inválido</a>
                    </td>
                </tbody>
            <?php endforeach;?>
        <?php endif;?>
    </table>
</div>