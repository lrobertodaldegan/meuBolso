<?php
    require_once "../../controller/BeneficioController.php";
    
    $bController = new BeneficioController();

    $bController->save($_GET);
?>