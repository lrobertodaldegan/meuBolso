<?php
    require_once "../../controller/DescontoController.php";

    $descontos = null;

    if(isset($_GET) && !empty($_GET)){
        $dController = new DescontoController();

        $descontos = $dController->listPaginated($_GET['page'], $_GET['limit']);
    }
?>
<div class="row">
    <div class="col-md-4">
        <h3>
            Descontos 
            <a href="#" data-toggle="modal" data-target="#cadastroModalDesconto">
                <span class="lnr lnr-plus-circle"></span>
            </a>
        </h3>
    </div>
</div>
<?php if(empty($descontos)) : ?>
    <div class="row">
        <div class="col-md-12 text-center" id="btnPrimeiroDesconto">
            <button data-toggle="modal" data-target="#cadastroModalDesconto" class="btn btn-primary w-80">
                Clique aqui para adicionar seu primeiro desconto
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
                    <th scope="col">Porcentagem</th>
                    <th scope="col">Opções</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    foreach($descontos as $d) :
                ?>
                <tr class="text-center">
                    <td scope="row"><?php echo $d->getId(); ?></td>
                    <td scope="row">
                    <?php
                        if($d->getCategoria()->getNome() != null) {
                            echo $d->getCategoria()->getNome();
                        } else {
                            if(!empty($d->getNome()))
                                echo $d->getNome();
                            else
                                echo "N/A";
                        }
                    ?>
                    </td>
                    <td scope="row">R$ <?php echo $d->getValor(); ?></td>
                    <td scope="row"><?php echo $d->getPorcentagem(); ?> %</td>
                    <td scope="row">
                        <a href="#" title="Editar" data-toggle="modal" data-target="#modalEditarDesconto" onClick="setDesconto('desconto', '<?php echo $d->getId(); ?>');" class="aumentaOnOver">
                            <span class="lnr lnr-pencil"></span>
                        </a>
                        <a href="#" title="Excluir" data-toggle="modal" data-target="#modalExcluirDesconto" onClick="preDelete('<?php echo $d->getId(); ?>', '#id_desconto_exclusao');" class="aumentaOnOver">
                            <span class="lnr lnr-trash"></span>
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="5" style="background: white;">
                    <nav>
                        <ul class="pagination justify-content-center">
                            <?php foreach($dController->getPagesByUser($usuario->getId()) as $pageNum) : ?>
                                <li class="page-item">
                                    <a class="page-link" href="#renda_desconto" onclick="list(<?php echo $pageNum; ?>,'#renda_desconto', '/meuBolso/view/profile/listDesconto.php');">
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
<div class="row">
    <div class="col-md-12 center">
        
    </div>
</div>
<?php
    endif;
?>
