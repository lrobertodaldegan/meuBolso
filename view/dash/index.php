<?php
    require_once "load.php";
    
    if(!empty($usuario)) :
?>
<div id="page">
    <div class="dash">
        <div class="row">
            <div class="col-sm-5" onClick="exibirModal('#updateSaldo');">
                <div class="saldo heightDashSaldoConta" title="Saldo atual">
                    <h2>Saldo <small><?php echo date('m/Y');?></small></h2>
                    <div class="row">
                        <div class="offset-md-1 col-md-6 text-left">
                            <h2>
                                <?php echo Util::getReais($saldoAtual); ?>
                            </h2>
                        </div>
                        <?php if(empty($tresUltimasOperacoesNoSaldo)) :?>
                            <div class="col-md-5" style="white-space:nowrap;" title="Três últimas operações no saldo">
                                <?php foreach($tresUltimasOperacoesNoSaldo as $op) :?>
                                    <div class="row">
                                        <div class="col-md-12 text-left">
                                            <?php echo $op->getIcon(); ?>
                                            <span>
                                                <?php echo Util::getReais($op->getValor()); ?>
                                                <small>
                                                    <?php echo Util::parseDate($op->getData(), true); ?>
                                                </small>
                                            </span>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php else : ?>
                            <div class="col-md-5" title="Três últimas operações no saldo">
                                <div class="row">
                                    <div class="col-md-12 text-justify">
                                        <span>Você não fez nada com seu saldo aqui ainda &#128176;</span>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="offset-sm-1 col-sm-5">
                <div class="contas heightDashSaldoConta" title="Total de contas em aberto atualmente.">
                    <h2>Contas em aberto <small><?php echo date('m/Y');?></small></h2>
                    <div class="row">
                        <div class="offset-sm-1 col-sm-6 text-center">
                            <h2>
                                <?php echo Util::getReais($totalContasEmAberto); ?>
                            </h2>
                        </div>
                        <div class="col-sm-5 text-right" title="Lista de contas à vencer neste mês.">
                            <?php if(empty($tresUltimasContasVencendo)) : ?>
                                <div class="row">
                                    <div class="col-md-12 text-justify">
                                        <span>
                                            Sem contas para os próximos dias do mês
                                            &#128513;
                                        </span>
                                    </div>
                                </div>
                            <?php else : ?>
                                <?php foreach($tresUltimasContasVencendo as $c) :?>
                                    <div class="row">
                                        <div class="col-md-12 text-left" style="white-space:nowrap;">
                                            <span>
                                                <?php echo Util::getReais($c->getValor()); ?>
                                                <small>
                                                    <?php echo Util::parseDate($c->getVencimento(), true); ?>
                                                </small>
                                            </span>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-5" title="Gráfico de histórico de gastos e saldo.">
                <canvas id="dashChart"></canvas>
            </div>
            <div class="offset-md-1 col-md-5" title="Gráfico de contas por categoria.">
                <canvas id="dashChartCatDoughnut"></canvas>
            </div>
        </div>
        <div class="row">
            <div class="col-md-5 text-center" style="padding-top:100px;" title="Gráfico de progesso dos objetivos.">
                <div class="progress" style="height:30px;">
                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-warning" role="progressbar" 
                         aria-valuenow="<?php echo number_format($pCentObjetivo, 2, '.','.'); ?>" 
                         aria-valuemin="0" aria-valuemax="100" style="width: <?php echo number_format($pCentObjetivo, 2,'.','.'); ?>%">
                         <b><?php echo Util::format($pCentObjetivo) ."%"; ?></b>
                    </div>
                </div>
                <span>Você concluiu <b><?php echo Util::format($pCentObjetivo); ?>%</b> dos seus objetivos!</span>
                <?php echo $oController->getMedals($pCentObjetivo); ?>
            </div>
        </div>
    </div>
    <script src="public/js/chart.js"></script>
    <script>
        //doughnut perfil gasto (categoria contas)
        <?php if(!empty($categoriasConta)) : ?>
        var doughnutChart = new Chart($('#dashChartCatDoughnut'), {
            type: 'doughnut',
            data: {
                datasets: [
                    {
                        data: [
                            <?php foreach($categoriasConta as $cat): echo $cat->qtd .","; endforeach; ?>
                        ],
                        backgroundColor: [
                            <?php foreach($categoriasConta as $cat): ?>
                                getColor(),
                            <?php endforeach;?>
                        ],
                        borderWidth: 5
                    }
                ],
                labels: [
                    <?php foreach($categoriasConta as $cat): echo "'". $cat->nome ."',"; endforeach; ?>
                ]
            },
            options: {
                cutoutPercentage: 25,
                legend: {
                    display: true,
                    position:'left'
                },
            }
        });
        <?php endif; ?>
        //linear dinheiro/contas histórico
        var grafico = new Chart($('#dashChart'), {
            type: 'line',
            data: {
                labels: [
                    "<?php echo date('M/Y', strtotime('-3 month')); ?>",
                    "<?php echo date('M/Y', strtotime('-2 month')); ?>",
                    "<?php echo date('M/Y', strtotime('-1 month')); ?>",
                    "<?php echo date('M/Y'); ?>"
                ],
                datasets: [{
                    label: 'Contas',
                    data: [
                        <?php echo $totalContas3LastMonth; ?>,
                        <?php echo $totalContas2LastMonth; ?>,
                        <?php echo $totalContasLastMonth; ?>,
                        <?php echo $totalContas; ?>
                    ],
                    backgroundColor: ['rgba(255, 50, 20, 0.2)'],
                    borderColor: ['red'],
                    borderWidth: 4
                }, {
                    label: 'Saldo',
                    data: [
                        <?php echo $saldoMenosTresMeses; ?>,
                        <?php echo $saldoMenosDoisMeses; ?>,
                        <?php echo $saldoMenosUmMes; ?>,
                        <?php echo $saldoAtual; ?>
                    ],
                    backgroundColor: ['rgba(112, 150, 255, 0.2)'],
                    borderColor: ['rgb(112, 150, 255)'],
                    borderWidth: 4
                }]
            },
            options: {
                legend: {
                    display: true,
                    position:'bottom'
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true,
                        }
                    }]
                }
            }
        });
    </script>
</div>
<?php else : ?>
<div id="calculado-resposta">
    <div class="row nadaEncontrado">
        <div class="col-sm-11 text-center">
            <p><?php echo MensagemEnum::NADA_ENCONTRADO; ?></p>
        </div>
    </div>
</div>
<?php endif; ?>
<?php
    require_once "modal/updateSaldo.php";
?>