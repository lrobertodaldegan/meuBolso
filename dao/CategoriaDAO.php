<?php
    require_once "GenericDAO.php";
    require_once $_SERVER['DOCUMENT_ROOT'] ."/meuBolso/model/Categoria.php";

    class CategoriaDAO extends GenericDAO {
        function __construct(){
            parent::setTable(Categoria::TABLE);
        }
    }
?>