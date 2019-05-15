<?php
    require_once "GenericDAO.php";
    require_once $_SERVER['DOCUMENT_ROOT'] ."/meuBolso/model/Usuario.php";

    class UsuarioDAO extends GenericDAO {
        function __construct(){
            parent::setTable(Usuario::TABLE);
        }

        public function buscarPorLogin($login){
            $c = $this->connect();

            if(empty($c))
                return null;

            $q = $c->prepare("SELECT * FROM ". $this->getTable() ." WHERE login = ?");
            $q->bindParam(1, $login);
                
            $q->execute();

            return ($q->execute()) ? $q->fetch(PDO::FETCH_OBJ) : null;
        }

        public function getByIdNameLoginOrEmail($text) {
            $c = $this->connect();

            if($c != null){
                $sql = "SELECT * FROM ". parent::getTable();
                $sql.= " WHERE id = '". $text ."' OR nome like '". $text ."%' OR login like '". $text ."%'";
                
                $q = $c->prepare($sql);
                
                if($q->execute() && $q->rowCount() > 0)
                    return $q->fetch(PDO::FETCH_OBJ);
            }

            return null;
        }
    }
?>