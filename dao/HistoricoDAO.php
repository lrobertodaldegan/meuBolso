<?php
    require_once "GenericDAO.php";
    require_once $_SERVER['DOCUMENT_ROOT'] ."/meuBolso/model/Historico.php";

    class HistoricoDAO extends GenericDAO {
        function __construct(){
            parent::setTable(Historico::TABLE);
        }

        public function getAllByUserOrdened($uId) {
            $c = $this->connect();

            $sql = "SELECT * FROM ". $this->getTable();
            $sql .= " WHERE id_usuario = ". $uId ." AND campo_alterado <> '' AND campo_alterado not like 'usuario%' ORDER BY data DESC, id DESC";

            return $c != null ? $c->query($sql)->fetchAll(PDO::FETCH_OBJ) : null;
        }

        public function obterPorDataEUsuario($data, $usuarioId){
            $c = $this->connect();

            if($c != null){
                $sql = "SELECT * FROM ". $this->getTable() ." WHERE id_usuario = ". $usuarioId;

                if(!empty($data))
                    $sql .= " AND data >= '". $data ."'";
                    
                $q = $c->prepare($sql);
                
                if($q->execute() && $q->rowCount() > 0)
                    return $q->fetchAll(PDO::FETCH_OBJ);
            }
            
            return null;
        }

        public function obterUltimasOperacoesDoSaldo($uId) {
            $c = $this->connect();

            if($c != null) {
                $sql = "SELECT * FROM ". $this->getTable() ." WHERE id_usuario = ". $uId . " AND CAMPO_ALTERADO = 'usuario.saldo' ORDER BY DATA DESC LIMIT 0, 3";

                $q = $c->prepare($sql);
                
                if($q->execute() && $q->rowCount() > 0)
                    return $q->fetchAll(PDO::FETCH_OBJ);
            }

            return null;
        }

        public function getLastSaldoByUserAndMonth($uId, $yM) {
            $c = $this->connect();

            if($c != null) {
                $sql = "SELECT * FROM ". $this->getTable();
                $sql .= " WHERE id_usuario = ". $uId ." AND CAMPO_ALTERADO = 'usuario.saldo'";
                $sql .= " AND DATA like '". $yM ."-%' ORDER BY DATA DESC LIMIT 0, 1";

                $q = $c->prepare($sql);
                
                if($q->execute() && $q->rowCount() > 0)
                    return $q->fetch(PDO::FETCH_OBJ);
            }

            return null;
        }

        public function getLastLoginEvent($uId) {
            $c = $this->connect();

            if($c != null) {
                $sql = "SELECT * FROM ". $this->getTable() ." WHERE id_usuario = ". $uId ." AND operacao = 'Fez login' ORDER BY data DESC LIMIT 0, 1";

                $q = $c->prepare($sql);

                if($q->execute() && $q->rowCount() > 0)
                    return $q->fetch(PDO::FETCH_OBJ);
            }

            return null;
        }
    }
?>