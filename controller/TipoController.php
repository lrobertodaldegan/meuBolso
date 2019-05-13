<?php
    require_once "Controller.php";
    require_once $_SERVER['DOCUMENT_ROOT'] ."/meuBolso/service/TipoService.php";
    require_once $_SERVER['DOCUMENT_ROOT'] ."/meuBolso/model/ParametrosEnum.php";
    require_once $_SERVER['DOCUMENT_ROOT'] ."/meuBolso/model/MensagemEnum.php";

    class TipoController extends Controller {
        function __construct(){
            parent::setService(new TipoService());
        }
    }
?>