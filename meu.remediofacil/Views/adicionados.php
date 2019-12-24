
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
            <h1>Adicionados</h1>
        </div>
    </div>
</div>
<div class="container-fluid">
    <table class="table">
        <thead>
            <th>Nome Genérico</th>
            <th>Adicionado em:</th>
            <th>Quantidade</th>
        </thead>
        <?php if($servico == array()):?>
            <tbody>
                <td>Nenhum remédio foi adicionado</td>
            </tbody>
        <?php else:?>
            <?php foreach($servico as $s):?>
                <tbody>
                    <td title="<?php echo $s['remedio'];?>"><?php echo substr($s['remedio'], 0 ,40);?>...</td>
                    <td><?php echo date('d/m/Y', strtotime($s['data']));?></td>
                    <td><?php echo $s['qtd'];?></td>
                </tbody>
            <?php endforeach;?>
        <?php endif;?>
        
    </table>
</div>