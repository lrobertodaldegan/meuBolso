<?php
    require_once "../../controller/CompartilhaController.php";
    require_once "../../controller/UsuarioController.php";

    $uController = new UsuarioController();
    $usuario = $uController->getLogado();

    $controller = new CompartilhaController();
    $compartilhadosComigo = $controller->getAllBills($usuario->getId(), false); //lista de contas
    $compartilhadosPorMim = $controller->getAllBills($usuario->getId(), true); //lista de contas    
?>