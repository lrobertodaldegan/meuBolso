<?php
    require_once "../../controller/CompartilhaController.php";
    $controller = new CompartilhaController();

    $controller->delete($_GET['id']);
?>