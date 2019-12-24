
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
        <div class="row">

            <div class="col-10 title">
                <h1>Dashboard</h1>
            </div>

            <?php if(empty($existe)):?>
                <div class="col-2 title">
                    <div class="point_cursor" aria-hidden="true" title="Clique" data-toggle="modal" data-target=".modal_open">
                        <p>Posto de entrega?</p>
                    </div>
                </div>
            <?php endif;?>
        </div>
    </div>

    <!-- INFO CONTENT-->
    <div class="row">
        <div class="col-sm">
            <div class="info_content">
                <div class="info_name">
                    <span>Remédios adicionados</span>
                </div>
                <div class="info_value">
                    <span><?php echo $total;?></span>
                </div>
            </div>
        </div>

        <div class="col-sm">
            <div class="info_content">
                <div class="info_name">
                    <span>Em baixas</span>
                </div>
                <div class="info_value">
                    <span><?php echo $baixas;?></span>
                </div>
            </div>
        </div>

        <div class="col-sm">
            <div class="info_content">
                <div class="info_name">
                    <span>Remédios no sistema</span>
                </div>
                <div class="info_value">
                    <span><?php echo $count;?></span>
                </div>
            </div>
        </div>
    </div>

    <!-- INFO-REMEDIOS CONTENT-->
    <div class="jumbotron">
        <div class="row">
            <div class="col-sm grafico_bg">
                <canvas id="grafico"></canvas>
            </div>
            <div class="col-sm grafico_bg">
                <canvas id="pie"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade modal_open" tabindex="-1" role="dialog" aria-labelledby="TituloModalCentralizado" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="TituloModalCentralizado">Posto de entrega</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Seja um posto de entrega de remédios em sua cidade</p>
                <p>Escolhendo se tornar um posto, você receberá notificações de datas de entregas dos possíveis doadores em sua região.</p>
                <p>Sendo assim, responsável pela coleta, armazenamento e verificação de tais medicamentos, até o momento de entrega aos recebedores.</p>
                <p>Contamos com sua parceria</p>
            </div>
            <div class="modal-footer">
                <a href="<?php echo BASE_URL;?>posto/posto-entrega/<?php echo $_SESSION['user_farmacia'];?>" class="btn btn-success">Se tornar um ponto</a>
            </div>
        </div>
    </div>
</div>
<!--SCRIPT GRÁFICO-->
<script type="text/javascript">

    window.onload = function() {
        //gráfico line chart js
        var canvas = document.getElementById("grafico");
        var ctx = canvas.getContext('2d');

        var oilCanvas = document.getElementById("pie");
        var teste = oilCanvas.getContext('2d');

        //definições globais do gráfico
        Chart.defaults.global.defaultFontColor = '#555';
        Chart.defaults.global.defaultFontSize = 16;
        Chart.defaults.global.defaultFontFamily = "Roboto";

        var oilData = {
            labels: [
                "Qtd. adicionados",
                "Qtd. Em baixa"
            ],
            datasets: [{
                data: [
                    <?php echo $total;?>,
                    <?php echo $baixas;?>
                ],
                backgroundColor: [
                    "#ffa500",
                    "#4facfe"
                ]
            }]
        };

        var pieChart = new Chart(canvas, {
            type: 'pie',
            data: oilData
        });


        //doughnut
        var doughnutData = {
            labels: [
                "Qtd. No sistema",
                "Qtd. Em sua conta"
            ],
            datasets: [{
                data: [
                    <?php echo $count;?>,
                    <?php echo $total;?>
                ],
                backgroundColor: [
                    "#4facfe",
                    "#ffa500"
                ]
            }]
        };

        var pieChart = new Chart(oilCanvas, {
            type: 'doughnut',
            data: doughnutData
        });
    };
</script>