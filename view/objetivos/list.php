<?php
    require_once "../../controller/ObjetivoController.php";
    require_once "../../controller/UsuarioController.php";

    $objetivos = null;

    if(isset($_GET) && !empty($_GET)){
        $controller = new ObjetivoController();
        $uController = new UsuarioController();
    
        $usuario = $uController->getLogado();

        $objetivos = $controller->listPaginatedByUser($_GET['page'], $_GET['limit'], $usuario); 
    }
?>
<div class="row" style="margin:50px 0;">
    <div class="col-md-4">
        <h3>
            Objetivos 
            <a href="#" data-toggle="modal" data-target="#cadastroModal">
                <span class="lnr lnr-plus-circle"></span>
            </a>
        </h3>
    </div>
</div>
<?php if(empty($objetivos)) : ?>
    <div class="row">
        <div class="col-md-12 text-center" id="btnPrimeiroObjetivo">
            <button data-toggle="modal" data-target="#cadastroModal" class="btn btn-primary w-80">
                Clique aqui para adicionar seu primeiro objetivo
            </button>
        </div>
    </div>
<?php else : ?>
<div class="row">
    <div class="col-sm-11">
        <table class="table table-striped">
            <thead>
                <tr class="text-center">
                    <th scope="col">Objetivo</th>
                    <th scope="col">Cadastrado Em</th>
                    <th scope="col">Se realizará em</th>                                                        
                    <th scope="col">Valor Total</th>
                    <th scope="col">Saldo Atual</th>
                    <th scope="col">Concluído</th>
                    <th scope="col">Opções</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    foreach($objetivos as $o) :
                ?>
                <tr class="text-center">
                    <td scope="row">
                        <?php echo $o->getNome(); ?>
                    </td>
                    <td scope="row">
                        <?php echo Util::parseDate($o->getDataCadastro(), true); ?>
                    </td>
                    <td scope="row">
                        <?php echo Util::parseDate($o->getDataRealizacao(), true); ?>
                    </td>
                    <td scope="row">
                        <?php echo $o->getValorTotal(); ?>
                    </td>
                    <td scope="row">
                        <?php echo $o->getSaldo(); ?>
                    </td>
                    <td scope="row">
                        <?php if($o->isConcluido()) : ?>
                            <span class="lnr lnr-checkmark-circle spanVerde"></span>
                        <?php else : ?>
                            <span class="lnr lnr-cross-circle spanVermelho" onClick="quickUpdate('<?php echo $o->getId(); ?>', true, 'objetivos/quickUpd.php', false)"></span>
                        <?php endif; ?>
                    </td>
                    <td scope="row">
                        <?php if(!$o->isConcluido()) : ?>
                            <a href="#" title="Mais informações" data-toggle="modal" data-target="#infoModalO" onClick="setObjetivoInfo('objetivo','<?php echo $o->getId(); ?>');" class="aumentaOnOver">
                                <span class="lnr lnr-text-align-left"></span>
                            </a>
                        <?php endif; ?>
                        <a href="#" title="Editar" data-toggle="modal" data-target="#edicaoModalO" onClick="setObjetivo('objetivo','<?php echo $o->getId(); ?>');" class="aumentaOnOver">
                            <span class="lnr lnr-pencil"></span>
                        </a>
                        <a href="#" title="Excluir" data-toggle="modal" data-target="#modalExcluirObjetivo" onClick="preDelete('<?php echo $o->getId(); ?>', '#del_id_objetivo');" class="aumentaOnOver">
                            <span class="lnr lnr-trash"></span>
                        </a>    
                    </td>
                </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="9" style="background: white;">
                    <nav>
                        <ul class="pagination justify-content-center">
                            <?php foreach($controller->getPagesByUser($usuario->getId()) as $pageNum) : ?>
                                <li class="page-item">
                                    <a class="page-link" href="#" onclick="list(<?php echo $pageNum; ?>,'#objetivos_list', '/meuBolso/view/objetivos/list.php');">
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
    endif;

    require_once "modal/salvar.php";
    require_once "modal/editar.php";
    require_once "modal/excluir.php";
    require_once "modal/info.php";
?>