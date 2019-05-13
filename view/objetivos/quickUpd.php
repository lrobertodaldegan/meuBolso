<?php
    require_once "../../controller/ObjetivoController.php";
    $controller = new ObjetivoController();

    $controller->concluir($_GET);
?>