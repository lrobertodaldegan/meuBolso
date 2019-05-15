<?php
    class Compartilha{
        const TABLE = 'compartilha_conta_usuario';

        private $id;
        private $conta;
        private $usuario;
        private $owner;
        private $fillable;

        function __construct(){
            $this->fillable = [
                "id",
                "id_conta",
                "id_usuario",
                "id_owner"
            ];
        }

        public function getFillable($keyAsString){
            if($keyAsString)
                return implode(", ", $this->fillable);
            
            return $this->fillable;
        }

        public function toArray(){
            return [
                "id" => Util::getNULLorId($this),
                "id_conta" => Util::getNULLorId($this->getConta()),
                "id_usuario" => $this->getUsuario()->getId(),
                "id_owner" => $this->getOwner()->getId()
            ];
        }

        public function toString(){
            return Util::getNULLorId($this) .", "
                . $this->getConta()->getId() .", "
                . $this->getUsuario()->getId() .", "
                . $this->getOwner()->getId()
            ;
        }

        public function getId(){
            return $this->id;
        }

        public function setId($param){
            $this->id = $param;
        }

        public function getConta(){
            return $this->conta;
        }

        public function setConta($param){
            $this->conta = $param;
        }
        
        public function getUsuario(){
            return $this->usuario;
        }

        public function setUsuario($param){
            $this->usuario = $param;
        }

        public function getOwner(){
            return $this->owner;
        }

        public function setOwner($param){
            $this->owner = $param;
        }
    }
?>