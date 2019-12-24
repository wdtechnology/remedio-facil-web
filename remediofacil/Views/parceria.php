<!--BANNER-->
<div class="container-fluid">
    <div class="row trabalho_bg">
        <div class="col-12 d-flex justify-content-center">
            <h3>Seja nosso parceiro</h3>
        </div>
        <div class="col-12 d-flex justify-content-center">
            <p>Faça parte desse novo empreendimento em sua cidade</p>
        </div>
    </div>
</div>
<!--FIM BANNER-->
<section>
    <div class="container-fluid">
        <div class="row d-flex justify-content-center">
            <?php if(!empty($alert)):?>
                <div class="alert alert-warning top_space">
                    <?php echo $alert;?>
                </div>
            <?php elseif(!empty($sucesso)):?>
                <div class="alert alert-success top_space">
                    <?php echo $sucesso;?>
                </div>
            <?php endif;?>
        </div>
        <!--FORMULÁRIO-->
        <div class="row d-flex justify-content-center">
            <div class="col-12 d-flex justify-content-center form_title">
                <h4>Preencha todos os campos</h4>
            </div>
            <div class="col-lg">
                <form method="POST" class="form_space">
                    <div class="form-group">
                        <input type="text" name="nome" placeholder="Nome completo" required class="form-control nome"/>
                    </div>
                    <div class="form-group">
                        <input type="text" name="email" placeholder="E-mail" required class="form-control email"/>
                    </div>
                    <div class="form-group">
                        <input type="text" name="cnpj" placeholder="CNPJ" required class="form-control cnpj"/>
                    </div>
                    <div class="d-flex justify-content-end">
                        <input type="submit" value="Cadastrar" class="btn btn-primary" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>