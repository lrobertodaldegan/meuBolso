<?php
    require_once "controller/UsuarioController.php";

    if(isset($_POST)){
        $controller = new UsuarioController();
        $controller->logar($_POST);
    }
?>