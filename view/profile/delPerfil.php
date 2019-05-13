<?php
    require_once "../../controller/UsuarioController.php";
    
    $controller = new UsuarioController();

    $controller->delete($_POST['id_perfil']);
?>