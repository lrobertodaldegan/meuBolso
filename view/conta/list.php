<?php
    require_once "load.php";
?>
<div id="conta-resposta">
    <div class="row">
        <div class="col-sm-3" onClick="exibirModal('#updateSaldo');">
            <div class="saldo" title="Saldo em <?php echo date('d/m/Y'); ?>.">
                <h2>Saldo atual</h2>
                <div class="row">
                    <div class="offset-sm-1 col-sm-11 text-center">
                        <h4><?php echo Util::getReais($saldoAtual); ?></h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="offset-sm-1 col-sm-3">
            <div class="contas contas-pagas" title="Valor de contas pagas atualmente">
                <h2>Contas pagas</h2>
                <div class="row">
                    <div class="offset-sm-1 col-sm-11 text-left">
                        <h4>
                            <?php echo Util::getReais($totalContasPagas); ?>
                            <small style="font-size:12px !important;"> de <?php echo Util::getReais($totalContas); ?></small>
                        </h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="offset-sm-1 col-sm-3">
            <div class="contas contas-total" title="Valor total das contas deste mês">
                <h2>Em aberto</h2>
                <div class="row">
                    <div class="offset-sm-1 col-sm-11 text-left">
                        <h4>
                            <?php echo Util::getReais($totalContasEmAberto); ?>
                            <small style="font-size:12px !important;"> de <?php echo Util::getReais($totalContas); ?></small>
                        </h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-11 listaContas">
            <h2>
                <a href="#" data-toggle="modal" data-target="#modalCadastroConta" style="font-size:18px;position:relative;top:-1.9;">
                    <span class="lnr lnr-plus-circle"></span>
                </a>
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
                        <th scope="col">Parcela</th>                                                        
                        <th scope="col">Categoria</th>
                        <th scope="col">Tipo</th>
                        <th scope="col">Pago</th>
                        <th scope="col">Opções</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        if(!empty($contas)) :
                            foreach($contas as $c) :
                    ?>
                    <?php if($c->venceu() && !$c->isPago()) : ?>
                        <tr class="text-center" style="color:red !important;" title="Conta em atraso">
                    <?php else : ?>
                        <tr class="text-center">
                    <?php endif; ?>
                        <td scope="row"><?php echo $c->getDescricao(); ?></td>
                        <td scope="row">
                            <?php echo Util::getReais($c->getValor()); ?>
                        </td>
                        <td scope="row"><?php echo Util::parseDate($c->getVencimento(), true); ?></td>
                        <td scope="row">
                            <?php
                                echo $controller->getAllParcelasByIdPai($c->getId(), $c->getParcelas(), $c->getIdPai());
                            ?>
                        </td>
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
                                <span class="lnr lnr-cross-circle spanVermelho" title="Pagar" onClick="pagarConta('<?php echo $c->getId(); ?>', 'conta/quickUpd.php', false, '<?php echo $c->getValor(); ?>', null, '<?php echo $usuario->getId(); ?>')"></span>
                            <?php endif; ?>
                        </td>
                        <td scope="row">
                            <a href="#contas" title="Compartilhar" data-toggle="modal" data-target="#modalCompartilhar" onClick="setCompartilhar('conta','<?php echo $c->getId(); ?>');" class="aumentaOnOver">
                                <span class="lnr lnr-location"></span>
                            </a>
                            <?php if(!$c->isPago() && empty($c->getIdPai())) : ?>
                                <a href="#contas" title="Editar" data-toggle="modal" data-target="#modalEditarConta" onClick="setConta('conta','<?php echo $c->getId(); ?>', false);" class="aumentaOnOver">
                                    <span class="lnr lnr-pencil"></span>
                                </a>    
                            <?php
                                endif;
                                if(empty($c->getIdPai())) :
                            ?>
                                <a href="#contas" title="Excluir" data-toggle="modal" data-target="#modalExcluirConta" onClick="preDelete('<?php echo $c->getId(); ?>', '#del_id_conta');" class="aumentaOnOver">
                                    <span class="lnr lnr-trash"></span>
                                </a>
                            <?php
                                else :
                            ?>
                                <span class="pointerSpan" title="As opções foram desabilitadas, pois estas contas são apenas parcelas de outra conta.">
                                    ...
                                </span>
                            <?php
                                endif;
                            ?>
                        </td>
                    </tr>
                    <?php
                            endforeach;
                        endif;
                    ?>
                    <tr>
                        <td colspan="9" style="background: white;">
                        <nav>
                            <ul class="pagination justify-content-center">
                                <?php foreach($controller->getPagesByUser($usuario->getId()) as $pageNum) : ?>
                                    <li class="page-item">
                                        <a class="page-link" href="#contas" onclick="list(<?php echo $pageNum; ?>,'#conta-list', '/meuBolso/view/conta/list.php');">
                                            <?php echo $pageNum; ?>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </nav>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <?php
        require_once "modal/salvar.php";
        require_once "modal/editar.php";
        require_once "modal/excluir.php";
        require_once "modal/updateSaldo.php";
        require_once "modal/compartilhar.php";
    ?>
</div>