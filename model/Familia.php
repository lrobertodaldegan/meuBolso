<?php
    class Familia{
        const TABLE = 'familia';
        const RL_TABLE = "usuario_familia";
        const RL_COL = "id_familia";

        private $id;
        private $nome;
        private $admin;
        private $criadoEm;
        private $fillable;

        function __construct(){
            $this->fillable = [
                "id",
                "nome",
                "usuario_administrador",
                "criado_em"
            ];
        }

        public function getFillable($keyAsString){
            if($keyAsString)
                return implode(", ", $this->fillable);
            
            return $this->fillable;
        }

        public function toArray(){
            $id = (!empty($this->getId()) ? $this->getId() : "'NULL'");

            return [
                "id" => $id,
                "nome" => $this->getNome(),
                "usuario_administrador" => $this->getUsuario()->getId(),
                "criado_em" => $this->getCriadoEm()
            ];
        }

        public function toString(){
            $id = (!empty($this->getId()) ? $this->getId() : "'NULL'");
            return $id .", "
                ."'". $this->getNome() ."', "
                ."'". $this->getUsuario()->getId() ."', "
                ."'". $this->getCriadoEm()
            ;
        }

        public function getId(){
            return $this->id;
        }

        public function setId($param){
            $this->id = $param;
        }

        public function getNome(){
            return $this->nome;
        }

        public function setNome($param){
            $this->nome = $param;
        }

        public function getUsuario(){
            return $this->usuario;
        }

        public function setUsuario($param){
            $this->usuario = $param;
        }

        public function getCriadoEm(){
            return $this->criadoEm;
        }

        public function setCriadoEm($param){
            $this->criadoEm = $param;
        }
    }
?>