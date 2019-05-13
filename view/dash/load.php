<?php
    require_once "../../controller/UsuarioController.php";
    require_once "../../controller/HistoricoController.php";
    require_once "../../controller/ContaController.php";
    require_once "../../controller/ObjetivoController.php";

    $controller = new UsuarioController();
    $cController = new ContaController();
    $hController = new HistoricoController();
    $oController = new ObjetivoController();

    $usuario = $controller->getLogado();

    $saldoAtual = $usuario->getSaldo();

    $saldoMenosUmMes = $hController->getLastSaldoByUserAndMonth($usuario->getId(), Util::getDateMinusNMonths(date('Y-m-d'), 1));
    $saldoMenosDoisMeses = $hController->getLastSaldoByUserAndMonth($usuario->getId(), Util::getDateMinusNMonths(date('Y-m-d'), 2));
    $saldoMenosTresMeses = $hController->getLastSaldoByUserAndMonth($usuario->getId(), Util::getDateMinusNMonths(date('Y-m-d'), 3));

    $totalContasPagas = $cController->getTotalContasPagas($usuario->getId(), date('Y-m-d'));
    
    $totalContas = $cController->getTotalContas($usuario->getId(), date('Y-m-d'));
    $totalContasLastMonth = $cController->getTotalContas($usuario->getId(), Util::getDateMinusNMonths(date('Y-m-d'), 1));
    $totalContas2LastMonth = $cController->getTotalContas($usuario->getId(), Util::getDateMinusNMonths(date('Y-m-d'), 2));
    $totalContas3LastMonth = $cController->getTotalContas($usuario->getId(), Util::getDateMinusNMonths(date('Y-m-d'), 3));
    
    $totalContasEmAberto = Util::subtrair($totalContas, $totalContasPagas);

    $tresUltimasContasVencendo = $cController->getNextContas(date('Y-m-d'), $usuario->getId()); //busca as proximas 3 contas

    $tresUltimasOperacoesNoSaldo = $hController->getLastOperationsByUser($usuario->getId()); // buscar de histórico

    $categoriasConta = $cController->getCategoriasPorContasMes(date('Y-m-d'), $usuario->getId());

    $pCentObjetivo = $oController->getPorcentagemConclusaoObjetivos($usuario->getId());
?>