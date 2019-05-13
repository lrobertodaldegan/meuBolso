<?php
    class Usuario{
        const TABLE = 'usuario';

        private $id;
        private $nome;
        private $login;
        private $email;
        private $apelido;
        private $senha;
        private $renda;
        private $dataPagamento;
        private $saldo;
        private $fillable;

        function __construct(){
            $this->fillable = [
                "id",
                "nome",
                "login",
                "email",
                "apelido",
                "senha",
                "renda",
                "data_pagamento",
                "saldo"
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
                "nome" => "'". $this->getNome() ."'",
                "login" => "'". $this->getLogin() ."'",
                "email" => "'". $this->getEmail() ."'",
                "apelido" => "'". $this->getApelido() ."'",
                "senha" => "'". $this->getSenha() ."'",
                "renda" => "'". $this->getRenda() ."'",
                "data_pagamento" => "'". $this->getDataPagamento() ."'",
                "saldo" => "'". $this->getSaldo() ."'"
            ];
        }

        public function toString(){
            $id = (!empty($this->getId()) ? $this->getId() : "NULL");
            return $id .", "
                ."'". $this->getNome() ."', "
                ."'". $this->getLogin() ."', "
                ."'". $this->getEmail() ."', "
                ."'". $this->getApelido() ."', "
                ."'". $this->getSenha() ."', "
                . $this->getRenda() .", "
                ."'". $this->getDataPagamento() ."', "
                ."'". $this->getSaldo() ."'"
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
        
        public function getLogin(){
            return $this->login;
        }
        
        public function setLogin($param){
            $this->login = $param;
        }
        
        public function getEmail(){
            return $this->email;
        }
        
        public function setEmail($param){
            $this->email = $param;
        }
        
        public function getApelido(){
            return $this->apelido;
        }
        
        public function setApelido($param){
            $this->apelido = $param;
        }
        
        public function getSenha(){
            return $this->senha;
        }
        
        public function setSenha($param, $hash){
            if($hash)
                $this->senha = password_hash($param, PASSWORD_BCRYPT);
            else
                $this->senha = $param;
        }

        public function getRenda() {
            return $this->renda;
        }

        public function setRenda($param) {
            $this->renda = $param;
        }

        public function getDataPagamento() {
            return $this->dataPagamento;
        }

        public function setDataPagamento($param) {
            $this->dataPagamento = $param;
        }

        public function getSaldo() {
            return $this->saldo;
        }
        public function setSaldo($saldo) {
            $this->saldo = $saldo;
        }

        public function getFoto(){
            return base64_decode($this->foto);
        }

        public function setFoto($param){
            if(empty($param))
                $this->foto = null;

            $this->foto = base64_encode($param);
        }
    }
?>