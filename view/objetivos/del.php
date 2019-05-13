<?php
    require_once "../../controller/ObjetivoController.php";
    $controller = new ObjetivoController();

    $controller->delete($_GET);
?>