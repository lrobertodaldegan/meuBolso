<?php
    require_once "../../controller/ObjetivoController.php";
    $controller = new ObjetivoController();

    $controller->save($_GET);
?>