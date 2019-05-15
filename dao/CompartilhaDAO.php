<?php
    require_once "GenericDAO.php";
    require_once $_SERVER['DOCUMENT_ROOT'] ."/meuBolso/model/Compartilha.php";

    class CompartilhaDAO extends GenericDAO {
        function __construct(){
            parent::setTable(Compartilha::TABLE);
        }

        public function getAllByOwner($uId) {
            $c = $this->connect();
    
            if($c != null) {
                $q = $c->query("SELECT * FROM ". $this->getTable() ." WHERE id_owner = ". $uId);

                if($q->execute() && $q->rowcount() > 0)
                    return $q->fetchAll(PDO::FETCH_OBJ);

                return null;
            }

            return null;
        }

        public function getAllByBill($idConta) {
            $c = $this->connect();
    
            if($c != null && !empty($idConta)) {
                $q = $c->query("SELECT * FROM ". $this->getTable() ." WHERE id_conta = ". $idConta);

                if($q->execute() && $q->rowcount() > 0)
                    return $q->fetchAll(PDO::FETCH_OBJ);

                return null;
            }

            return null;
        }

        public function saveReturningContaId($obj) {
            $c = $this->connect();

            if($c != null){
                $sql = "INSERT INTO ". $this->getTable() ." (". $obj->getFillable(true) .") ";
                $sql .= "VALUES (". $obj->toString() .")";

                $q = $c->prepare($sql);

                if($q->execute())
                    return $obj->getConta()->getId();

                return 0;
            }

            return 0;
        }

        public function checkShareByUserAndBill($uId, $cId) {
            $c = $this->connect();

            if($c != null){
                $q = $c->prepare("SELECT id FROM ". $this->getTable() ." WHERE id_usuario = ". $uId ." AND id_conta = ". $cId);

                if($q->execute() && $q->rowcount() == 0)
                    return false;

                return true;
            }

            return true;
        } 
    }
?>