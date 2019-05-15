<?php
    require_once "../../../controller/CompartilhaController.php";

    if(empty($_GET))
        $compartilhadoCom = [];

    $controller = new CompartilhaController();
    $compartilhadoCom = $controller->getAllByBill($_GET['id_conta']);

    if(!empty($compartilhadoCom)) :
?>
<table class="table table-striped">
    <thead>
        <tr class="text-center">
            <th scope="col">Nome</th>
            <th scope="col">Remover compartilhamento</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($compartilhadoCom as $c) :?>
            <tr class="text-center">
                <td scope="row">
                    <?php echo $c->getUsuario()->getNome(); ?>
                </td>
                <td scope="row">
                    <a href="#contas" onclick="unShare('<?php echo $c->getId() ?>');">
                        <span class="lnr lnr-cross"></span>
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php
    else :
        echo "<span>Este gasto ainda não foi compartilhado com ninguém.</span>";
    endif;
?>