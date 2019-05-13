<?php
    require_once "Service.php";
    require_once $_SERVER['DOCUMENT_ROOT'] ."/meuBolso/dao/FamiliaDAO.php";

    class FamiliaService extends Service{
        function __construct(){
            parent::setDao(new FamiliaDAO());
        }
    }
?>