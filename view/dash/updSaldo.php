<?php
    require_once "../../controller/UsuarioController.php";

    if(!empty($_GET) && isset($_GET['saldo'])){
        $controller = new UsuarioController();
        
        $controller->updateSaldoManualmente($_GET);
    }
?>