<?php
    require_once "GenericDAO.php";
    require_once $_SERVER['DOCUMENT_ROOT'] ."/meuBolso/model/Conta.php";

    class ContaDAO extends GenericDAO {
        function __construct(){
            parent::setTable(Conta::TABLE);
        }

        public function get($id) {
            $c = $this->connect();

            if($c != null){
                $subSql = "(SELECT SUM(valor) FROM ". $this->getTable() ." WHERE id = ? OR id_pai = ?) AS valor_total";
                $subSql.= ", (SELECT parcelas FROM ". $this->getTable() ." WHERE id = ? OR id_pai = ? ORDER BY parcelas DESC LIMIT 0, 1) AS parcelas_total";
                $sql = "SELECT *, ". $subSql ." FROM ". $this->getTable() ." WHERE id = ?";
                
                $q = $c->prepare($sql);
                $q->bindParam(1, $id);
                $q->bindParam(2, $id);
                $q->bindParam(3, $id);
                $q->bindParam(4, $id);
                $q->bindParam(5, $id);
                
                if($q->execute() && $q->rowCount() > 0)
                    return $q->fetch(PDO::FETCH_OBJ);
            }
            
            return null;
        }

        public function getValorTotalPorData($uId, $d){
            $c = $this->connect();

            if($c != null){
                $q = $c->prepare("SELECT SUM(valor) as total FROM ". parent::getTable() ." WHERE id_usuario = ". $uId ." AND vencimento <= ?");
                $q->bindParam(1, $d);
                
                if($q->execute())
                    return $q->fetch(PDO::FETCH_OBJ);
            }
            
            return 0;
        }

        public function getTotalPorMes($uId, $yM) {
            $c = $this->connect();

            if($c != null){
                $q = $c->prepare("SELECT SUM(valor) as total FROM ". parent::getTable() ." WHERE id_usuario = ". $uId ." AND vencimento like '". $yM ."-%'");

                if($q->execute())
                    return $q->fetch(PDO::FETCH_OBJ);
            }
            
            return 0;
        }

        public function getTotalPagasPorMes($uId, $yM) {
            $c = $this->connect();

            if($c != null){
                $q = $c->prepare("SELECT SUM(valor) as total FROM ". parent::getTable() ." WHERE id_usuario = ". $uId ." AND vencimento like '". $yM ."%' AND pago = true");

                if($q->execute())
                    return $q->fetch(PDO::FETCH_OBJ);
            }
            
            return 0;
        }

        public function getAllByUserAndDateMonth($uId, $dM) {
            $c = $this->connect();

            if($c != null){
                $sql = "SELECT * FROM ". parent::getTable();
                $sql .= " WHERE vencimento like '". $dM ."%' AND id_usuario = ". $uId ." ORDER BY vencimento DESC";

                $q = $c->prepare($sql);
                
                if($q->execute() && $q->rowCount() > 0)
                    return $q->fetchAll(PDO::FETCH_OBJ);
            }
            
            return null;
        }

        public function listarPorData($d, $uId){
            $c = $this->connect();

            if($c != null){
                $q = $c->prepare("SELECT * FROM ". parent::getTable() ." WHERE vencimento <= ? AND id_usario = ?");
                $q->bindParam(1, $d);
                $q->bindParam(2, $uId);
                
                if($q->execute() && $q->rowCount() > 0)
                    return $q->fetchAll(PDO::FETCH_OBJ);
            }
            
            return null;
        }

        public function getGroupedCatByUserAndDate($uId, $date) {
            $c = $this->connect();

            if($c != null){
                $sql = "SELECT cat.nome, count(c.id_categoria) as qtd FROM ". $this->getTable() ." c, categoria cat ";
                $sql.= "WHERE c.id_categoria = cat.id AND c.id_usuario = ? AND c.vencimento like '". $date ."-%' GROUP BY c.id_categoria";

                $q = $c->prepare($sql);
                $q->bindParam(1, $uId);

                if($q->execute() && $q->rowCount() > 0)
                    return $q->fetchAll(PDO::FETCH_OBJ);
            }

            return null;
        }

        public function deleteParentAndChildren($idPai) {
            $c = $this->connect();

            if($c != null){
                $sql = "DELETE FROM ". $this->getTable() ." WHERE id = ? OR id_pai = ?";

                $q = $c->prepare($sql);
                $q->bindParam(1, $idPai);
                $q->bindParam(2, $idPai);

                return $q->execute();
            }

            return false;
        }

        public function pagar($cId, $isPago, $saldo, $atualizadorId) {
            $c = $this->connect();

            if($c != null){
                $sql = "UPDATE ". $this->getTable() ." SET pago = ". $isPago .", saldo = '". $saldo ."', atualizado_por = ". $atualizadorId;
                $sql .= ' WHERE id = '. $cId;

                $q = $c->prepare($sql);

                return $q->execute();
            }

            return false;
        }

        public function getTotalParcelasByParentId($idPai) {
            $c = $this->connect();

            if($c != null){
                $q = $c->prepare("SELECT parcelas FROM ". parent::getTable() ." WHERE id_pai = ". $idPai ." ORDER BY parcelas DESC LIMIT 0, 1");

                if($q->execute() && $q->rowCount() > 0)
                    return $q->fetch(PDO::FETCH_OBJ)->parcelas;
            }
            
            return 1;
        }

        public function save($obj){
            $c = $this->connect();

            if($c != null){
                $sql = "INSERT INTO ". $this->getTable() ." (". $obj->getFillable(true) .") ";
                $sql .= "VALUES (". $obj->toString() .")";

                $q = $c->prepare($sql);

                if($q->execute())
                    return (int) $c->lastInsertId();

                return null;
            }

            return null;
        }

        public function del($id, $idPai, $vencimento){
            $c = $this->connect();

            if($c != null){
                $sql = "DELETE FROM ". $this->getTable();
                
                if(!empty($idPai) && !empty($vencimento))
                    $sql .= " WHERE id_pai = ". $idPai ." AND vencimento >= '". $vencimento ."'";

                if(empty($idPai))
                    $sql .= " WHERE id = ". $id ." OR id_pai = ". $id;
                
                $q = $c->prepare($sql);
                
                return $q->execute();
            }

            return false;
        }
        
        public function listarAVencerPaginadoPorData($d, $pg, $limit, $userId) {
            $init = $limit * $pg;

            $connection = $this->connect();

            if($connection != null){
                $q = $connection->query(
                    "SELECT * FROM ". $this->getTable() ." WHERE vencimento <= '". $d ."' AND pago = false AND id_usuario = ". $userId ." ORDER BY vencimento ASC LIMIT ". $init .", ". $limit
                );

                return $q->fetchAll(PDO::FETCH_OBJ);
            }

            return null;
        }

        public function listarPagosPaginadoPorData($d, $pg, $limit, $userId) {
            $init = $limit * $pg;

            $connection = $this->connect();

            if($connection != null){
                $q = $connection->query(
                    "SELECT * FROM ". $this->getTable() ." WHERE vencimento <= '". $d ."' AND pago = true AND id_usuario = ". $userId ." ORDER BY vencimento DESC LIMIT ". $init .", ". $limit
                );

                return $q->fetchAll(PDO::FETCH_OBJ);
            }

            return null;
        }

        public function listarTresProximasContasMes($dt, $uId) {
            $connection = $this->connect();

            if($connection != null){
                $q = $connection->query(
                    "SELECT * FROM ". $this->getTable() ." WHERE pago = false AND vencimento >= '". $dt ."' AND id_usuario = ". $uId ." ORDER BY vencimento DESC LIMIT 0, 3"
                );

                return $q->fetchAll(PDO::FETCH_OBJ);
            }

            return null;
        }

        public function listarPaginadoPorDataAPartirDe($d, $pg, $limit, $userId) {
            $init = $limit * $pg;

            $connection = $this->connect();

            if($connection != null){
                $q = $connection->query(
                    "SELECT * FROM ". $this->getTable() ." WHERE vencimento > '". $d ."-01' AND id_usuario = ". $userId ." ORDER BY pago ASC, vencimento ASC LIMIT ". $init .", ". $limit
                );

                return $q->fetchAll(PDO::FETCH_OBJ);
            }

            return null;
        }

        public function getNextContas($yM, $dt, $uId) {
            $connection = $this->connect();

            if($connection != null){
                $q = $connection->query(
                    "SELECT * FROM ". $this->getTable() ." WHERE vencimento like '".$yM."-%' AND vencimento >= '". $dt ."' AND id_usuario = ". $uId ." ORDER BY pago ASC, vencimento DESC LIMIT 0, 3"
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
                    "SELECT * FROM ". $this->getTable() ." WHERE id_usuario = ". $userId ." ORDER BY pago ASC, vencimento ASC LIMIT ". $init .", ". $limit
                );
                
                return $q->fetchAll(PDO::FETCH_OBJ);
            }

            return null;
        }

        public function listarPaginadoPorData($d, $pg, $limit, $userId) {
            $init = $limit * $pg;

            $connection = $this->connect();

            if($connection != null){
                $q = $connection->query(
                    "SELECT * FROM ". $this->getTable() ." WHERE vencimento like '". $d ."-%' AND id_usuario = ". $userId ." ORDER BY pago ASC, vencimento ASC LIMIT ". $init .", ". $limit
                );

                return $q->fetchAll(PDO::FETCH_OBJ);
            }

            return null;
        }

        public function countByUser($uId) {
            $connection = $this->connect();

            if($connection != null){
                $q = $connection->query("SELECT COUNT(id) as p FROM ". $this->getTable() ." WHERE vencimento like '". date('Y-m') ."%' AND id_usuario = ". $uId);
                
                return $q->fetch(PDO::FETCH_OBJ);
            }
            
            return 0;
        }
    }
?>