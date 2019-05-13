<?php
    require_once "load.php";
?>
<div id="page">
    <div class="compartilhado">
        <div class="row">
            <div class="col-sm-11 listaContas">
                <h2>
                    Compartilhados comigo
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
                                    <span style="color:red;"> - </span>
                                <?php endif; ?>
                            </td>
                            <td scope="row">
                                <a href="#contas" title="Contribuir" data-toggle="modal" data-target="#contribuirModal" onClick="setConta('conta','<?php echo $c->getId(); ?>', true);" class="aumentaOnOver">
                                    <span class="lnr lnr-hand"></span>
                                </a>
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
    </div>
</div>
<?php
    require_once "modal/contribuir.php";
?>