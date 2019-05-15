<?php
    require_once "../controller/UsuarioController.php";
    require_once "../controller/DescontoController.php";
    require_once "../controller/BeneficioController.php";
    require_once "../controller/TipoController.php";
    require_once "../controller/CategoriaController.php";
    require_once "../controller/ObjetivoController.php";
    require_once "../controller/ContaController.php";

    const BENEFICIO = "beneficio";
    const USUARIO = "usuario";
    const DESCONTO = "desconto";
    const TIPO = "tipo";
    const CATEGORIA = "categoria";
    const OBJETIVO = "objetivo";
    const CONTA = "conta";

    $retorno = null;

    if(isset($_GET) && !empty($_GET)){
        $uController = new UsuarioController();
        $dController = new DescontoController();
        $bController = new BeneficioController();
        $tController = new TipoController();
        $cController = new CategoriaController();
        $oController = new ObjetivoController();
        $contaController = new ContaController();

        switch($_GET["obj"]){
            case BENEFICIO:
                $retorno = $bController->get($_GET['id']);
                break;
            case USUARIO:
                $retorno = $uController->getByIdNameLoginOrEmail($_GET['id']);
                break;
            case DESCONTO:
                $retorno = $dController->get($_GET['id']);
                break;
            case TIPO:
                $retorno = $tController->get($_GET['id']);
                break;
            case CATEGORIA:
                $retorno = $cController->get($_GET['id']);
                break;
            case OBJETIVO:
                $retorno = $oController->get($_GET['id']);
                break;
            case CONTA:
                $retorno = $contaController->get($_GET['id']);
                break;
            default:
                break;
        }
    }

    if(!empty($retorno))
        echo $retorno->toJSON();
    
    die();
?>