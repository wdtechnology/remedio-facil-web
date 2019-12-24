
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
    <div class="container-fluid">
        <div class="jumbotron jumbotron_bg">
            <div class="col-12 title">
                <h1>Visualizar cadastros</h1>
            </div>
        </div>
        <div class="col-12">
            <div class="voltar">
                <a href="<?php echo BASE_URL;?>administrador">Voltar</a>
            </div>
        </div><br/>
        <table class="table">
            <thead>
                <th>E-mail</th>
                <th>CNPJ</th>
                <th>Criado em:</th>
                <th>Ação</th>
            </thead>
            <?php if($all == array()):?>
                <tbody>
                    <td>Nenhum cadastro</td>
                </tbody>
            <?php else:?>
                <?php foreach($all as $c):?>
                    <tbody>
                        <td><?php echo $c['cadastro_email'];?></td>
                        <td class="cnpj"><?php echo $c['cadastro_cnpj'];?></td>
                        <td><?php echo date('d/m/Y', strtotime($c['cadastro_create']));?></td>
                        <td>
                            <a href="<?php echo BASE_URL;?>administrador/visualizar-cadastros/testar/<?php echo $c['cadastro_id'];?>" class="btn btn-primary">Testar</a>
                        </td>
                    </tbody>
                <?php endforeach;?>
            <?php endif;?>
        </table>
    </div>
</section>
