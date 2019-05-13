<?php
    require_once "Util.php";

    class Historico{
        const TABLE = "historico";

        private $id;
        private $operacao;
        private $tip;
        private $campoAlterado;
        private $usuario;
        private $valorDe;
        private $valorPara;
        private $data;
        private $saldo;
        private $fillable;

        private $icon; //transient
        private $valor; //transient
        
        function __construct(){
            $this->fillable = [
                "id",
                "operacao",
                "tip",
                "campo_alterado",
                "id_usuario",
                "valor_de",
                "valor_para",
                "data",
                "saldo"
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
                "operacao" => "'". $this->getOperacao() ."'",
                "tip" => "'". $this->getTip() ."'",
                "campo_alterado" => "'". $this->getCampoAlterado() ."'",
                "id_usuario" => Util::getNULLorId($this->getUsuario()),
                "valor_de" => "'". $this->getValorDe() ."'",
                "valor_para" => "'". $this->getValorPara() ."'",
                "data" => "'". $this->getData() ."'",
                "saldo" => "'". $this->getSaldo() ."'"
            ];
        }

        public function toJSON(){
            return json_encode([
                "id" => Util::getIdOrNull($this),
                "operacao" => $this->getOperacao(),
                "tip" => $this->getTip(),
                "campo_alterado" => $this->getCampoAlterado(),
                "id_usuario" => Util::getIdOrNull($this->getUsuario()),
                "valor_de" => $this->getValorDe(),
                "valor_para" => $this->getValorPara(),
                "data" => $this->getData(),
                "saldo" => $this->getSaldo()
            ]);
        }

        public function toString(){
            return Util::getNULLorId($this) .", "
                ."'". $this->getOperacao() ."', "
                ."'". $this->getTip() ."', "
                ."'". $this->getCampoAlterado() ."', "
                . Util::getNULLorId($this->getUsuario()) .", "
                ."'". $this->getValorDe() ."', "
                ."'". $this->getValorPara() ."', "
                ."'". $this->getData() ."', "
                ."'". $this->getSaldo() ."'"
            ;
        }

        public function getId(){
            return $this->id;
        }

        public function setId($param){
            $this->id = $param;
        }

        public function getOperacao(){
            return $this->operacao;
        }

        public function setOperacao($param){
            $this->operacao = $param;
        }

        public function getTip(){
            return $this->tip;
        }

        public function setTip($param){
            $this->tip = $param;
        }

        public function getCampoAlterado(){
            return $this->campoAlterado;
        }

        public function setCampoAlterado($param){
            $this->campoAlterado = $param;
        }

        public function getUsuario(){
            return $this->usuario;
        }

        public function setUsuario($param){
            $this->usuario = $param;
        }

        public function getValorDe(){
            return $this->valorDe;
        }

        public function setValorDe($param){
            $this->valorDe = $param;
        }

        public function getValorPara(){
            return $this->valorPara;
        }

        public function setValorPara($param){
            $this->valorPara = $param;
        }

        public function getData(){
            return $this->data;
        }

        public function setData($param){
            $this->data = $param;
        }

        public function getSaldo(){
            return $this->saldo;
        }

        public function setSaldo($param){
            $this->saldo = $param;
        }

        public function getIcon() {
            return $this->icon;
        }

        public function setIcon($param) {
            $this->icon = $param;
        }

        public function getValor() {
            return $this->valor;
        }

        public function setValor($valor) {
            $this->valor = $valor;
        }
    }
?>