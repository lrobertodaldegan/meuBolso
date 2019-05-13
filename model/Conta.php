<?php
    require_once "Util.php";
    
    class Conta{
        const TABLE = 'conta';

        private $id;
        private $descricao;
        private $valor;
        private $saldo;
        private $vencimento;
        private $juros;
        private $tipoJuros;
        private $categoria;
        private $tipo;
        private $parcelas;
        private $usuario;
        private $observacao;
        private $pago;
        private $pai;
        private $atualizadoPor;

        private $valorTotal; // transient
        private $parcelasTotal; // transient

        private $fillable;

        function __construct(){
            $this->fillable = [
                "id",
                "descricao",
                "valor",
                "saldo",
                "vencimento",
                "juros",
                "tipo_juros",
                "id_categoria",
                "id_tipo",
                "parcelas",
                "id_usuario",
                "observacao",
                "pago",
                "id_pai",
                "atualizado_por"
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
                "descricao" => "'". $this->getDescricao() ."'",
                "valor" => "'". $this->getValor() ."'",
                "saldo" => "'". $this->getSaldo() ."'",
                "vencimento" => "'". $this->getVencimento() ."'",
                "juros" => "'". $this->getJuros() ."'",
                "tipo_juros" => "'". $this->getTipoJuros() ."'",
                "id_categoria" => Util::getNULLorId($this->getCategoria()),
                "id_tipo" => Util::getNULLorId($this->getTipo()),
                "parcelas" => $this->getParcelas(),
                "id_usuario" => $this->getUsuario()->getId(),
                "observacao" => "'". $this->getObservacao() ."'",
                "pago" => Util::getZeroIfFalse($this->isPago()),
                "id_pai" => $this->getIdPai(),
                "atualizado_por" => $this->getAtualizadoPor()->getId()
            ];
        }

        public function toJSON(){
            return json_encode([
                "id" => Util::getIdOrNull($this),
                "descricao" => $this->getDescricao(),
                "valor" => $this->getValor(),
                "saldo" => $this->getSaldo(),
                "valor_total"=> $this->getValorTotal(), // transient
                "vencimento" => $this->getVencimento(),
                "juros" => $this->getJuros(),
                "tipo_juros" => $this->getTipoJuros(),
                "categoria" => [
                    "id" => Util::getIdOrNull($this->getCategoria()),
                    "nome" => (empty($this->getCategoria()) ? '' : $this->getCategoria()->getNome())
                ],
                "tipo" => [
                    "id" => Util::getIdOrNull($this->getTipo()),
                    "nome" => (empty($this->getTipo()) ? '' : $this->getTipo()->getNome())
                ],
                "parcelas" => $this->getParcelas(),
                "parcelas_total" => $this->getParcelasTotal(), // transient
                "id_usuario" => $this->getUsuario()->getId(),
                "observacao" => $this->getObservacao(),
                "pago" => $this->isPago(),
                "id_pai" => $this->getIdPai(),
                "atualizado_por" => $this->getAtualizadoPor()->getId()
            ]);
        }

        public function toString(){
            return Util::getNULLorId($this) .", "
                ."'". $this->getDescricao() ."', "
                ."'". $this->getValor() ."', "
                ."'". $this->getSaldo() ."', "
                ."'". $this->getVencimento() ."', "
                ."'". $this->getJuros() ."', "
                ."'". $this->getTipoJuros() ."', "
                . Util::getNULLorId($this->getCategoria()) .", "
                . Util::getNULLorId($this->getTipo()) .", "
                . $this->getParcelas() .", "
                . $this->getUsuario()->getId() . ", "
                ."'". $this->getObservacao() ."', "
                . Util::getZeroIfFalse($this->isPago()) .", "
                . $this->getIdPai() .", "
                . $this->getAtualizadoPor()->getId()
            ;
        }

        public function getId(){
            return $this->id;
        }       

        public function setId($param){
            $this->id = $param;
        }

        public function getDescricao(){
            return $this->descricao;
        }       

        public function setDescricao($param){
            $this->descricao = $param;
        }

        public function getValor(){          
            return $this->valor;
        }       

        public function setValor($param){
            $this->valor = $param;
        }

        public function getSaldo(){          
            return $this->saldo;
        }       

        public function setSaldo($param){
            $this->saldo = $param;
        }

        public function getValorTotal() {
            return $this->valorTotal;
        }

        public function setValorTotal($param) {
            $this->valorTotal = $param;
        }

        public function getVencimento(){
            return $this->vencimento;
        }       

        public function setVencimento($param){
            $this->vencimento = $param;
        }

        public function getJuros(){
            return $this->juros;
        }       

        public function setJuros($param){
            $this->juros = $param;
        }

        public function getTipoJuros(){
            return $this->tipoJuros;
        }       

        public function setTipoJuros($param){
            $this->tipoJuros = $param;
        }

        public function getCategoria(){
            return $this->categoria;
        }       

        public function setCategoria($param){
            $this->categoria = $param;
        }

        public function getTipo(){
            return $this->tipo;
        }       

        public function setTipo($param){
            $this->tipo = $param;
        }

        public function getParcelas(){
            return $this->parcelas;
        }       

        public function setParcelas($param){
            $this->parcelas = $param;
        }

        public function getParcelasTotal(){
            return $this->parcelasTotal;
        }       

        public function setParcelasTotal($param){
            $this->parcelasTotal = $param;
        }

        public function getUsuario(){
            return $this->usuario;
        }       

        public function setUsuario($param){
            $this->usuario = $param;
        }

        public function getObservacao(){
            return $this->observacao;
        }       

        public function setObservacao($param){
            $this->observacao = $param;
        }

        public function isPago(){
            return $this->pago;
        }          

        public function setPago($param){
            $this->pago = $param;
        }

        public function getIdPai() {
            if(empty($this->pai))
                $this->pai = 0;

            return $this->pai;
        }

        public function setIdPai($conta) {
            $this->pai = $conta;
        }

        public function getAtualizadoPor() {
            return $this->atualizadoPor;
        }

        public function setAtualizadoPor($param) {
            $this->atualizadoPor = $param;
        }

        public function venceu() {
            return $this->getVencimento() < date('Y-m-d');
        }
    }
?>