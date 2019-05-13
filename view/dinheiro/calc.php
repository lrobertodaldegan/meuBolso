<?php
    require_once "../../controller/ContaController.php";
    require_once "../../controller/UsuarioController.php";

    if(empty($_GET) || !isset($_GET))
        return null;

    $request = (object) $_GET;

    $mesFiltro = Util::getParsedMonth($request->data, true);
    $dataFiltro = Util::parseDate($request->data, true);

    $uController = new UsuarioController();
    $usuario = $uController->getLogado();

    $controller = new ContaController();
    $contas = $controller->getAllByUserAndDate($usuario->getId(), $request->data); //todas as contas do mês informado no filtro data

    $totalContasPorData = $controller->calcularValorTotalContas($request->data, $contas);
    $saldoPorData = $controller->calcularSaldoPorData(
        $usuario->getId(), $usuario->getSaldo(), $usuario->getRenda(), $usuario->getDataPagamento(), $totalContasPorData, $request->data
    );
?>
<div id="calculado-resposta">
    <div class="row">
        <div class="col-sm-5">
            <div class="saldo" title="Saldo de <?php echo $dataFiltro; ?> considerando todas as contas pagas até a data.">
                <h2>Saldo</h2>
                <div class="row">
                    <div class="pffset-sm-1 col-sm-11 text-center">
                        <h2><?php echo Util::getReais($saldoPorData); ?></h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="offset-sm-1 col-sm-5">
            <div class="contas" title="Valor de contas em aberto vencendo até <?php echo $dataFiltro; ?>">
                <h2>Contas em aberto</h2>
                <div class="row">
                    <div class="offset-sm-1 col-sm-11 text-center">
                        <h2><?php echo Util::getReais($totalContasPorData); ?></h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-11 listaContas">
            <h2>
                Lista de gastos
                <small style="font-size:14px;">
                    <?php echo $mesFiltro; ?>
                </small>
            </h2>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-11">
            <table class="table table-striped">
                <thead>
                    <tr class="text-center">
                        <th scope="col">Descrição</th>
                        <th scope="col">Valor Parcela</th>
                        <th scope="col">Vencimento</th>
                        <th scope="col">Parcelas</th>                                                        
                        <th scope="col">Categoria</th>
                        <th scope="col">Tipo</th>
                        <th scope="col">Pago</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        if(!empty($contas)) :
                            foreach($contas as $c) :
                    ?>
                    <tr class="text-center">
                        <td scope="row"><?php echo $c->getDescricao(); ?></td>
                        <td scope="row">
                            <?php echo Util::getReais($c->getValor()); ?>
                        </td>
                        <td scope="row"><?php echo Util::parseDate($c->getVencimento(), true); ?></td>
                        <td scope="row"><?php echo Util::getOneIfNullOrZero($c->getParcelas()); ?></td>
                        <td scope="row">
                            <?php
                                if(empty($c->getCategoria())){
                                    $categoria = "-";
                                } else {
                                    if(empty($c->getCategoria()->getNome()))
                                        $categoria = "-";
                                    else
                                        $categoria = $c->getCategoria()->getNome();   
                                }

                                echo $categoria;
                            ?>
                        </td>
                        <td scope="row">
                            <?php
                                if(empty($c->getTipo())){
                                    $tipo = "-";
                                } else {
                                    if(empty($c->getTipo()->getNome()))
                                        $tipo = "-";
                                    else
                                        $tipo = $c->getTipo()->getNome();
                                }

                                echo $tipo;
                            ?>
                        </td>
                        <td scope="row">
                            <?php if($c->isPago()) : ?>
                                <span class="lnr lnr-checkmark-circle spanVerde"></span>
                            <?php else : ?>
                                <span class="lnr lnr-cross-circle" style="color:red;"></span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php
                            endforeach;
                        endif;
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>