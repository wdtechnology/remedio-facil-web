
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

<div class="container-fluid">
    <div class="jumbotron jumbotron_bg">
        <div class="col-12 title">
            <h1>Minha Conta</h1>
        </div>
    </div>
</div>
<?php if(!empty($sucesso)):?>
    <div class="container-fluid">
        <div class="alert alert-success">
            <?php echo $sucesso;?>
        </div>
    </div>
<?php elseif(!empty($alerta)):?>
    <div class="container-fluid">
        <div class="alert alert-warning">
            <?php echo $alerta;?>
        </div>
    </div>
<?php endif;?>
<div class="container-fluid">
    <form method="POST" class="form_content">
        <!--NOME-->
        <div class="row">
            <div class="col">
                <input type="text" name="nome" readonly placeholder="Farmácia" value="<?php echo utf8_encode($info['farmacia_nome']);?>" required class="form-control"/>
            </div>
        </div>
        <!-- FIM NOME-->
        <!--EMAIL E CNPJ-->
        <div class="row">
            <div class="col">
                <input type="text" name="email" placeholder="Email" value="<?php echo $info['farmacia_login'];?>" readonly class="form-control"/>
            </div>
            <div class="col">
                <input type="text" name="cnpj" placeholder="CNPJ" value="<?php echo $info['cnpj'];?>" readonly class="form-control cnpj"/>
            </div>
        </div>
        <!-- FIM EMAIL E CNPJ-->
        <!--CNPJ E CEP-->
        <div class="row">
            <div class="col">
                <input type="text" name="cep" placeholder="CEP" value="<?php echo $info['farmacia_cep'];?>" readonly class="form-control cep"/>
            </div>
            <div class="col">
                <input type="text" name="cidade" placeholder="Cidade" value="<?php echo utf8_encode($info['farmacia_cidade']);?>" readonly class="form-control"/>
            </div>
        </div>
        <!-- FIM CNPJ E CEP-->
        <!--CIDADE E BAIRRO-->
        <div class="row">
            <div class="col">
                <input type="text" name="bairro" placeholder="Bairro" value="<?php echo utf8_encode($info['farmacia_bairro']);?>" readonly class="form-control"/>
            </div>
            <div class="col">
                <input type="text" name="rua" placeholder="Rua" value="<?php echo utf8_encode($info['farmacia_rua']);?>" readonly class="form-control"/>
            </div>
        </div>
        <!-- FIM CIDADE E BAIRRO-->
        <!--RUA E DATA-->
        <div class="row">
            <div class="col">
                <input type="text" name="uf" placeholder="UF" value="<?php echo utf8_encode($info['farmacia_uf']);?>" readonly class="form-control"/>
            </div>
            <div class="col">
                <span class="form-control span_control">Conta criada em <?php echo date('d/m/Y', strtotime($info['farmacia_create']));?></span>
            </div>
        </div>
        <!-- FIM RUA E DATA-->
        <!--TROCAR SENHA-->
        <div class="row">
            <div class="col">
                <input type="password" name="senha" placeholder="Nova senha" class="form-control" required/>
            </div>
            <div class="col">
                <input type="password" name="confirmar" placeholder="Digite novamente a senha" class="form-control" required/>
            </div>
        </div>
        <div class="row">
            <div class="col d-flex justify-content-end">
                <input type="submit" value="Editar" class="btn btn-primary"/>
            </div>
        </div>
    </form>
</div>