<?php
    require_once "GenericDAO.php";
    require_once $_SERVER['DOCUMENT_ROOT'] ."/meuBolso/model/Beneficio.php";

    class BeneficioDAO extends GenericDAO {
        function __construct(){
            parent::setTable(Beneficio::TABLE);
        }

        public function listarPorDataCredito($data){
            $c = $this->connect();

            if($c != null){
                $q = $c->prepare("SELECT * FROM ". $this->getTable() ." WHERE data_credito = ?");
                $q->bindParam(1, $data);
                
                if($q->execute() && $q->rowCount() > 0)
                    return $q->fetchAll(PDO::FETCH_OBJ);
            }

            return null;
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