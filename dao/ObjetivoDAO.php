<?php
    require_once "GenericDAO.php";
    require_once $_SERVER['DOCUMENT_ROOT'] ."/meuBolso/model/Objetivo.php";

    class ObjetivoDAO extends GenericDAO {
        function __construct(){
            parent::setTable(Objetivo::TABLE);
        }

        public function listPaginatedByUser($pg, $limit, $userId){         
            $init = $limit * $pg;

            $connection = $this->connect();

            if($connection != null){
                $q = $connection->query(
                    "SELECT * FROM ". $this->getTable() ." WHERE id_usuario = ". $userId ." ORDER BY concluido ASC, prioridade DESC, data_cadastro DESC LIMIT ". $init .", ". $limit
                );
                
                return $q->fetchAll(PDO::FETCH_OBJ);
            }

            return null;
        }

        public function getPorcentagemConclusaoObjetivos($uId) {
            $c = $this->connect();

            if($c != null){
                $subSql = "(SELECT COUNT(id) FROM ". $this->getTable() ." where id_usuario = ". $uId ." AND concluido = true)";
                $sql = "SELECT COUNT(id) as total, ". $subSql ." as concluido FROM ". $this->getTable() ." WHERE id_usuario = ". $uId;

                $q = $c->prepare($sql);

                if($q->execute())
                    return $q->fetch(PDO::FETCH_OBJ);

                return 0;
            }

            return 0;
        }

        public function concluir($objeto) {
            $c = $this->connect();

            if($c != null){
                $sql = "UPDATE ". $this->getTable() ." SET concluido = '". $objeto->isConcluido() ."'";

                $sql .= ' WHERE id = '. $objeto->getId();

                $q = $c->prepare($sql);

                return $q->execute();
            }

            return false;
        }
    }
?>