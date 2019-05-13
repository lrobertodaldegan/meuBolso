<?php
    require_once "../../controller/ContaController.php";
    $controller = new ContaController();

    $controller->save($_GET);
?>