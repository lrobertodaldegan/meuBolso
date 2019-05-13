<?php
    require_once "../../controller/ContaController.php";
    require_once "../../controller/UsuarioController.php";
    require_once "../../controller/CategoriaController.php";
    require_once "../../controller/TipoController.php";

    $request = (object) $_GET;

    $mesFiltro = Util::getParsedMonth(date('Y-m-d'), true);

    $catController = new CategoriaController();
    $categorias = $catController->getAll();
    
    $tController = new TipoController();
    $tipos = $tController->getAll();

    $uController = new UsuarioController();
    $usuario = $uController->getLogado();

    $controller = new ContaController();
    $contas = $controller->listarPaginadoPorData(date('Y-m-d'), $request->page, $request->limit, $usuario->getId());

    $totalContasPagas = $controller->getTotalContasPagas($usuario->getId(), date('Y-m-d'));
    $totalContas = $controller->getTotalContas($usuario->getId(), date('Y-m-d'));
    $totalContasEmAberto = Util::subtrair($totalContas, $totalContasPagas);
    $saldoAtual = $usuario->getSaldo();
?>