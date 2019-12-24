
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

<section>
    <!-- ADICIONAR CONTEÚDO -->
    <div class="container-fluid">
        <div class="jumbotron jumbotron_bg">
            <div class="row">
                <div class="col-8 title">
                    <h1>Adicionar</h1>
                </div>

                <div class="col-sm title">
                    <form method="GET" action="<?php echo BASE_URL;?>farmacia/adicionar-remedio/buscar">
                        <div class="form-group form-inline">
                            <input type="text" name="pesquisa" placeholder="Qual remédio Procura?" class="form-control form-md"/>
                            <button class="btn btn-primary">Buscar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <!--REMÉDIOS-->
        <table class="table table-striped table_adicionar">
            <thead>
                <th>Nome Genérico</th>
                <th>Adicionado em:</th>
                <th>Ação</th>
            <th>Status</th>
            </thead>
            <?php foreach($all as $r):?>
                <tbody>
                    <td title="<?php echo $r['remedio_nome'];?>"><?php echo substr($r['remedio_nome'], 0, 40);?>...</td>
                    <td><?php echo date('d/m/Y', strtotime($r['remedio_create']));?></td>
                    <td>
                        <a href="<?php echo BASE_URL;?>farmacia/adicionar-remedio/<?php echo $r['remedio_id'];?>" class="btn btn-primary">Adicionar</a>
                    </td>
                    <td>
                        <?php foreach($compare as $teste):?>
                            <?php if($teste['teste'] == $r['remedio_id']):?>
                                <a href="<?php echo BASE_URL;?>farmacia/adicionar-remedio" class="btn btn-success">Adicionado</a>
                            <?php endif;?>
                        <?php endforeach;?>
                    </td>
                </tbody>
            <?php endforeach;?>
        </table>
        <!--INSERIR PAGINAÇÃO-->
    </div>
</section>


