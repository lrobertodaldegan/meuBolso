<?php
    require_once "controller/UsuarioController.php";
    
    $controller = new UsuarioController();
    
    if(empty($_POST))
        $controller->redirecionaSeNaoLogado();
    
    $controller->save($_POST);
?>