<?php
    require_once "../../controller/UsuarioController.php";
    require_once "../../controller/DescontoController.php";
    require_once "../../controller/BeneficioController.php";
    require_once "../../controller/TipoController.php";
    require_once "../../controller/CategoriaController.php";

    $uController = new UsuarioController();
    $dController = new DescontoController();
    $bController = new BeneficioController();
    $tController = new TipoController();
    $cController = new CategoriaController();

    $usuario = $uController->getLogado();

    $categorias = $cController->getAll();

    $tipos = $tController->getAll();
?>