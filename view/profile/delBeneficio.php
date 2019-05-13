<?php
    require_once "../../controller/BeneficioController.php";
    
    $bController = new BeneficioController();

    $bController->delete($_GET);
?>