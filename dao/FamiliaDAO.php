<?php
    require_once "GenericDAO.php";
    require_once "../model/Familia.php";

    class FamiliaDAO extends GenericDAO {
        function __construct(){
            parent::setTable(Familia::TABLE);
            parent::setRlTable(Familia::RL_TABLE);
            parent::setRlCol(Familia::RL_COL);
        }
    }
?>