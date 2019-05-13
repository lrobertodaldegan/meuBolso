<?php
    require_once "GenericDAO.php";
    require_once $_SERVER['DOCUMENT_ROOT'] ."/meuBolso/model/Bug.php";

    class BugDAO extends GenericDAO {
        function __construct(){
            parent::setTable(Bug::TABLE);
        }
    }
?>