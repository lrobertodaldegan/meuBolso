<?php
    require_once "Util.php";

    class Objetivo{
        const TABLE = 'objetivo';

        private $id;
        private $nome;
        private $prioridade;
        private $dataCadastro;
        private $dataRealizacao;
        private $valorTotal;
        private $saldo;
        private $parcelas; //unused
        private $usuario;
        private $concluido;

        function __construct(){
            $this->fillable = [
                "id",
                "nome",
                "prioridade",
                "data_cadastro",
                "data_realizacao",
                "valor_total",
                "saldo",
                "parcelas",
                "id_usuario",
                "concluido"
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
                "nome" => "'". $this->getNome() ."'",
                "prioridade" => Util::getZeroIfNull($this->getPrioridade()),
                "data_cadastro" => "'". $this->getDataCadastro() ."'",
                "data_realizacao" => Util::getDateOrNULL($this->getDataRealizacao()),
                "valor_total" => "'". $this->getValorTotal() ."'",
                "saldo" => "'". $this->getSaldo() ."'",
                "parcelas" => $this->getParcelas(),
                "id_usuario" => $this->getUsuario()->getId(),
                "concluido" => Util::getZeroIfFalse($this->isConcluido())
            ];
        }

        public function toString(){
            return Util::getNULLorId($this) .", "
                ."'". $this->getNome() ."', "
                . Util::getZeroIfNull($this->getPrioridade()) .", "
                ."'". $this->getDataCadastro() ."', "
                . Util::getDateOrNULL($this->getDataRealizacao()) .", "
                ."'". $this->getValorTotal() ."', "
                ."'". $this->getSaldo() ."', "
                . $this->getParcelas() .", "
                . $this->getUsuario()->getId() .", "
                . Util::getZeroIfFalse($this->isConcluido())
            ;
        }

        public function toJSON(){
            return json_encode([
                "id" => Util::getIdOrNull($this),
                "nome" => $this->getNome(),
                "prioridade" => Util::getZeroIfNull($this->getPrioridade()),
                "data_cadastro" => $this->getDataCadastro(),
                "data_realizacao" => Util::getNullOrDate($this->getDataRealizacao()),
                "valor_total" => $this->getValorTotal(),
                "saldo" => $this->getSaldo(),
                "parcelas" => $this->getParcelas(),
                "id_usuario" => Util::getIdOrNull($this->getUsuario()),
                "concluido" => $this->isConcluido()
            ]);
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

        public function getPrioridade(){
            return $this->prioridade;
        }

        public function setPrioridade($param){
            $this->prioridade = $param;
        }

        public function getDataCadastro(){
            return $this->dataCadastro;
        }

        public function setDataCadastro($param){
            $this->dataCadastro = $param;
        }

        public function getDataRealizacao($BR=true){
            return $this->dataRealizacao;
        }

        public function setDataRealizacao($param){
            $this->dataRealizacao = $param;
        }

        public function getValorTotal(){
            return $this->valorTotal;
        }

        public function setValorTotal($param){
            $this->valorTotal = $param;
        }
        
        public function getSaldo(){
            return $this->saldo;
        }

        public function setSaldo($param){
            $this->saldo = $param;
        }

        public function getParcelas(){
            return $this->parcelas;
        }

        public function setParcelas($param){
            $this->parcelas = $param;
        }

        public function getUsuario(){
            return $this->usuario;
        }

        public function setUsuario($param){
            $this->usuario = $param;
        }

        public function isConcluido(){
            return ($this->concluido);
        }

        public function setConcluido($param){
            $this->concluido = $param;
        }
    }
?>