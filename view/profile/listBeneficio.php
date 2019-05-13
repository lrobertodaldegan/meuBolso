<?php
    require_once "../../controller/BeneficioController.php";
    require_once "../../controller/UsuarioController.php";

    $beneficios = null;

    if(isset($_GET) && !empty($_GET)){
        $bController = new BeneficioController();
        $uController = new UsuarioController();
    
        $usuario = $uController->getLogado();

        $beneficios = $bController->listPaginatedByUser($_GET['page'], $_GET['limit'], $usuario);
    }
?>
<div class="row">
    <div class="col-md-4">
        <h3>
            Benefícios 
            <a href="#" data-toggle="modal" data-target="#cadastroModal">
                <span class="lnr lnr-plus-circle"></span>
            </a>
        </h3>
    </div>
</div>
<?php if(empty($beneficios)) : ?>
    <div class="row">
        <div class="col-md-12 text-center" id="btnPrimeiroBeneficio">
            <button data-toggle="modal" data-target="#cadastroModal" class="btn btn-primary w-80">
                Clique aqui para adicionar seu primeiro benefício
            </button>
        </div>
    </div>
<?php else :?>
<div class="row">
    <div class="col-md-12">
        <table class="table table-striped">
            <thead>
                <tr class="text-center">
                    <th scope="col">#</th>
                    <th scope="col">Categoria/Nome</th>
                    <th scope="col">Valor</th>                                                        
                    <th scope="col">Tipo</th>
                    <th scope="col">Data de crédito</th>
                    <th scope="col">Opções</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    foreach($beneficios as $b) :
                ?>
                <tr class="text-center">
                    <td scope="row"><?php echo $b->getId(); ?></td>
                    <td scope="row">
                        <?php
                            if($b->getCategoria()->getNome() != null) {
                                echo $b->getCategoria()->getNome();
                            } else {
                                if(!empty($b->getNome()))
                                    echo $b->getNome();
                                else
                                    echo "N/A";
                            }
                        ?>
                    </td>
                    <td scope="row">R$ <?php echo $b->getValor(); ?></td>
                    <td scope="row">
                        <?php
                            echo ($b->getTipo()->getNome()) ?
                                $b->getTipo()->getNome()
                            :
                                "N/A"
                            ; 
                        ?>
                    </td>
                    <td scope="row" title="dd/mm/yyyy">
                        <?php
                            echo Util::parseDate($b->getDataCredito(), true);
                        ?>
                    </td>
                    <td scope="row">
                        <a href="#" title="Editar" data-toggle="modal" data-target="#modalEditarBeneficio" onClick="setBeneficio('beneficio','<?php echo $b->getId(); ?>');" class="aumentaOnOver">
                            <span class="lnr lnr-pencil"></span>
                        </a>
                        <a href="#" title="Excluir" data-toggle="modal" data-target="#modalExcluirBeneficio" onClick="preDelete('<?php echo $b->getId(); ?>', '#id_beneficio_exclusao');" class="aumentaOnOver">
                            <span class="lnr lnr-trash"></span>
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="6" style="background: white;">
                    <nav>
                        <ul class="pagination justify-content-center">
                            <?php foreach($bController->getPagesByUser($usuario->getId()) as $pageNum) : ?>
                                <li class="page-item">
                                    <a class="page-link" href="#" onclick="list(<?php echo $pageNum; ?>,'#renda_beneficio', '/meuBolso/view/profile/listBeneficio.php');">
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
?>