<?php
    require_once "../../controller/ContaController.php";
    $controller = new ContaController();

    $controller->pagar($_GET);
?>