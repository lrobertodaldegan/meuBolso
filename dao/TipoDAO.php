<?php
    require_once "GenericDAO.php";
    require_once $_SERVER['DOCUMENT_ROOT'] ."/meuBolso/model/Tipo.php";

    class TipoDAO extends GenericDAO {
        function __construct(){
            parent::setTable(Tipo::TABLE);
        }
    }
?>