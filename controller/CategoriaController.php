<?php
    require_once "Controller.php";
    require_once $_SERVER['DOCUMENT_ROOT'] ."/meuBolso/service/CategoriaService.php";
    require_once $_SERVER['DOCUMENT_ROOT'] ."/meuBolso/model/ParametrosEnum.php";
    require_once $_SERVER['DOCUMENT_ROOT'] ."/meuBolso/model/MensagemEnum.php";

    class CategoriaController extends Controller {
        function __construct(){
            parent::setService(new CategoriaService());
        }
    }
?>