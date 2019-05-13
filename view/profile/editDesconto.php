<?php
    require_once "../../controller/DescontoController.php";
    
    $controller = new DescontoController();

    $controller->save($_GET);
?>