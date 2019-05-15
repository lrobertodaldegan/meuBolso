<?php
    require_once "../../controller/CompartilhaController.php";
    $controller = new CompartilhaController();

    echo $controller->save($_GET);
?>