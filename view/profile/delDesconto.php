<?php
    require_once "../../controller/DescontoController.php";
    
    $dController = new DescontoController();

    $dController->delete($_GET);
?>