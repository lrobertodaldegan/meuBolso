<?php
    class GenericDAO {
        const HOST = 'localhost';
        const DB   = 'meubolso';
        const USER = 'meubolso';
        const PASS = 'd2m0d1n9';
        const SGBD = 'mysql';

        private $table;
        private $rlTable;
        private $rlCol;

        public function connect(){
            return new PDO(self::SGBD .':host='. self::HOST .';dbname='. self::DB, self::USER, self::PASS);
        }

        public function getAll(){
            $c = $this->connect();

            return $c != null ? $c->query("SELECT * FROM ". $this->getTable())->fetchAll(PDO::FETCH_OBJ) : null;
        }

        public function getAllByUser($uId) {
            $c = $this->connect();

            return $c != null ? $c->query("SELECT * FROM ". $this->getTable() ." WHERE id_usuario = ". $uId)->fetchAll(PDO::FETCH_OBJ) : null;
        }

        public function get($id){
            $c = $this->connect();

            if($c != null){
                $q = $c->prepare("SELECT * FROM ". $this->getTable() ." WHERE id = ?");
                $q->bindParam(1, $id);
                
                if($q->execute() && $q->rowCount() > 0)
                    return $q->fetch(PDO::FETCH_OBJ);
            }
            
            return null;
        }

        public function getByUser($id, $uId) {
            $c = $this->connect();

            if($c != null){
                $q = $c->prepare("SELECT * FROM ". $this->getTable() ." WHERE id = ? AND id_usuario = ?");
                $q->bindParam(1, $id);
                $q->bindParam(2, $uId);
                
                if($q->execute() && $q->rowCount() > 0)
                    return $q->fetch(PDO::FETCH_OBJ);
            }
            
            return null;
        }

        public function listPaginated($pg, $limit){         
            $init = $limit * $pg;

            $connection = $this->connect();

            if($connection != null){
                $q = $connection->query(
                    "SELECT * FROM ". $this->getTable() ." LIMIT ". $init .", ". $limit
                );
                
                return $q->fetchAll(PDO::FETCH_OBJ);
            }

            return null;
        }

        public function listPaginatedByUser($pg, $limit, $userId){         
            $init = $limit * $pg;

            $connection = $this->connect();

            if($connection != null){
                $q = $connection->query(
                    "SELECT * FROM ". $this->getTable() ." WHERE id_usuario = ". $userId ." LIMIT ". $init .", ". $limit
                );
                
                return $q->fetchAll(PDO::FETCH_OBJ);
            }

            return null;
        }

        public function count(){
            $connection = $this->connect();

            if($connection != null){
                $q = $connection->query("SELECT COUNT(id) as p FROM ". $this->getTable());
                
                return $q->fetch(PDO::FETCH_OBJ);
            }
            
            return 0;
        }

        public function countByUser($uId) {
            $connection = $this->connect();

            if($connection != null){
                $q = $connection->query("SELECT COUNT(id) as p FROM ". $this->getTable() ." WHERE id_usuario = ". $uId);
                
                return $q->fetch(PDO::FETCH_OBJ);
            }
            
            return 0;
        }

        public function save($obj){
            $c = $this->connect();

            if($c != null){
                $sql = "INSERT INTO ". $this->getTable() ." (". $obj->getFillable(true) .") ";
                $sql .= "VALUES (". $obj->toString() .")";

                $q = $c->prepare($sql);

                return $q->execute();
            }

            return null;
        }

        public function delete($id){
            $c = $this->connect();

            if($c != null){
                $q = $c->prepare("DELETE FROM ". $this->getTable() ." WHERE id = ?");
                $q->bindParam(1, $id);
                
                return $q->execute();
            }
            return false;
        }

        public function update($obj){
            $c = $this->connect();

            if($c != null){
                $objArray = $obj->toArray();

                $sql = "UPDATE ". $this->getTable() ." SET ";

                foreach($obj->getFillable(false) as $key => $a){
                    $sql .= ($key == 0 ? '' : ', ') . $a .' = '. $objArray[$a];
                }

                $sql .= ' WHERE id = '. $obj->getId();

                $q = $c->prepare($sql);

                return $q->execute();
            }
            return false;
        }

        public function getTable(){
            return $this->table;
        }
        
        public function getRlTable(){
            return $this->rlTable;
        }

        public function getRlCol(){
            return $this->rlCol;
        }

        public function setTable($tbl){
            $this->table = $tbl;
        }

        public function setRlTable($rlTbl){
            $this->rlTable = $rlTbl;
        }

        public function setRlCol($rlCol){
            $this->rlCol = $rlCol;
        }
    }
?>