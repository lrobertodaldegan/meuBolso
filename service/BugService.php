<?php
    require_once "Service.php";
    require_once $_SERVER['DOCUMENT_ROOT'] ."/meuBolso/dao/BugDAO.php";

    class BugService extends Service{
        function __construct(){
            parent::setDao(new BugDAO());
        }
    }
?>