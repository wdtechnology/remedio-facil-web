
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

<section id="testar">
    <div class="container-fluid">
        <div class="jumbotron jumbotron_bg">
            <div class="col-12 title">
                <h1>Testar CNPJ</h1>
            </div>
        </div>
        <div class="col-12">
            <div class="voltar">
                <a href="<?php echo BASE_URL;?>administrador/visualizar-cadastros">Voltar</a>
            </div>
        </div><br/>
        <div class="col-12">
            <form method="POST">
                <div class="form-group">
                    <input type="text" name="cnpj" placeholder="CNPJ" class="form-control cnpj" readonly value="<?php echo $all['cadastro_cnpj'];?>" required/>
                </div>
                <div class="form-group">
                    <div class="form-control">
                        <?php if(!empty($r->nome)):?>
                            <p>
                                <span>Empresa: </span>
                                <?php echo $r->nome;?>
                            </p>
                            <p>
                                <span>Situação: </span>
                                <?php echo $r->situacao;?>
                            </p>
                            <p>
                                <span>UF: </span>
                                <?php echo $r->uf;?>
                            </p>
                            <p>
                                <span>Municipio: </span>
                                <?php echo $r->municipio;?>
                            </p>
                            <p>
                                <span>Bairro: </span>
                                <?php echo $r->bairro;?>
                            </p>
                            <p>
                                <span>Logradouro: </span>
                                <?php echo $r->logradouro;?>
                            </p>
                            <p>
                                <span>Cep: </span>
                                <?php echo $r->cep;?>
                            </p>
                        <?php elseif(!empty($r->message)):?>
                            <span>Info: </span>
                            <?php echo $r->message;?>
                        <?php elseif(!empty($r)):?>
                            <span>Info: </span>
                            <?php echo $r;?>
                        <?php endif;?>
                    </div>
                </div>
                <div class="form-inline d-flex justify-content-end">
                    <div class="form-group">
                        <input type="submit" value="Iniciar" class="btn btn-primary"/>
                    </div>
                    <div class="form-group">
                        <a href="<?php echo BASE_URL;?>administrador/visualizar-cadastros/adicionar/<?php echo $all['cadastro_id'];?>" class="btn btn-success">Adicionar</a>
                    </div>&nbsp;&nbsp;
                    <div class="form-group">
                        <a href="<?php echo BASE_URL;?>administrador/visualizar-cadastros/excluir/<?php echo $all['cadastro_id'];?>" class="btn btn-danger">Excluir</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>