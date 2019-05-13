<?php
    require_once "Util.php";
    require_once "Beneficio.php";

    class Desconto{
        const TABLE = "desconto";

        private $id;
        private $nome;
        private $categoria;
        private $valor;
        private $porcentagem;
        private $beneficio;
        private $usuario;
        private $fillable;

        function __construct(){
            $this->fillable = [
                "id",
                "nome",
                "valor",
                "id_categoria",
                "porcentagem",
                "id_beneficio",
                "id_usuario"
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
                "valor" => "'". $this->getValor() ."'",
                "id_categoria" => Util::getNULLorId($this->getCategoria()),
                "porcentagem" => "'". $this->getPorcentagem() ."'",
                "id_beneficio" => Util::getNULLorId($this->getBeneficio()),
                "id_usuario" => $this->getUsuario()->getId()
            ];
        }

        public function toString(){
            return Util::getNULLorId($this) .", "
                ."'". $this->getNome() ."', "
                ."'". $this->getValor() ."', "
                . Util::getNULLorId($this->getCategoria()) .", "
                ."'". $this->getPorcentagem() ."', "
                . Util::getNULLorId($this->getBeneficio()) .", "
                . $this->getUsuario()->getId()
            ;
        }

        public function toJSON(){
            return json_encode([
                "id" => Util::getIdOrNull($this),
                "nome" => "'". $this->getNome() ."'",
                "categoria" => [
                    "id" => Util::getIdOrNull($this->getCategoria()),
                    "nome" => (empty($this->getCategoria()) ? '' : $this->getCategoria()->getNome())
                ],
                "valor" => $this->getValor(),
                "porcentagem" => $this->getPorcentagem(),
                "id_usuario" => Util::getIdOrNull($this->getUsuario())
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

        public function getValor(){
            return $this->valor;
        }

        public function setValor($param){
            $this->valor = $param;
        }

        public function getCategoria(){
            if(empty($this->categoria))
                $this->categoria = new Categoria();

            return $this->categoria;
        }

        public function setCategoria($param){
            $this->categoria = $param;
        }

        public function getPorcentagem(){
            return $this->porcentagem;
        }

        public function setPorcentagem($param){
            $this->porcentagem = $param;
        }

        public function getBeneficio(){
            if(empty($this->beneficio))
                return new Beneficio();

            return $this->beneficio;
        }
        
        public function setBeneficio($param){
            $this->beneficio = $param;
        }

        public function getUsuario(){
            return $this->usuario;
        }

        public function setUsuario($param){
            $this->usuario = $param;
        }
    }
?>