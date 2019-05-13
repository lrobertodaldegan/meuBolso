<?php
    class Tipo{
        const TABLE = 'tipo';

        private $id;
        private $nome;
        private $criadoPor;
        private $criadoEm;

        function __construct(){
            $this->fillable = [
                "id",
                "nome",
                "criado_por",
                "criado_em"
            ];
        }

        public function getFillable($keyAsString){
            if($keyAsString)
                return implode(", ", $this->fillable);
            
            return $this->fillable;
        }

        public function toArray(){
            $id = (!empty($this->getId()) ? $this->getId() : "NULL");

            return [
                "id" => $id,
                "nome" => "'". $this->getNome() ."'",
                "criado_por" => $this->getCriadoPor()->getId(),
                "criado_em" => "'". $this->getCriadoEm() ."'"
            ];
        }

        public function toString(){
            $id = (!empty($this->getId()) ? $this->getId() : "NULL");
            return $id .", "
                ."'". $this->getNome() ."', "
                ."'". $this->getCriadoPor()->getId() ."', "
                ."'". $this->getCriadoEm() ."'"
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

        public function getCriadoPor(){
            return $this->criadoPor;
        }

        public function setCriadoPor($param){
            $this->criadoPor = $param;
        }

        public function getCriadoEm(){
            return $this->criadoEm;
        }

        public function setCriadoEm($param){
            $this->criadoEm = $param;
        }
    }
?>