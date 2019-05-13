<?php
    require_once "GenericDAO.php";
    require_once $_SERVER['DOCUMENT_ROOT'] ."/meuBolso/model/Desconto.php";

    class DescontoDAO extends GenericDAO {
        function __construct(){
            parent::setTable(Desconto::TABLE);
        }

        public function buscarPorUsuario($idU){
            $c = $this->connect();

            if($c != null){
                $q = $c->prepare("SELECT * FROM ". $this->getTable() ." WHERE id_usuario = ?");
                $q->bindParam(1, $idU);
                
                if($q->execute() && $q->rowCount() > 0)
                    return $q->fetchAll(PDO::FETCH_OBJ);
            }

            return null;
        }
    }
?>