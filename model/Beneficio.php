<?php
    require_once "Util.php";

    class Beneficio {
        const TABLE = 'beneficio';
        private $id;
        private $nome;
        private $categoria;
        private $valor;
        private $dataCredito;
        private $tipo;
        private $usuario;
        private $fillable = [
            "id",
            "nome",
            "id_categoria",
            "valor",
            "data_credito",
            "id_tipo",
            "id_usuario"
        ];

        public function getFillable($toString){
            if($toString)
                return implode(', ', $this->fillable);

            return $this->fillable;
        }

        public function toString(){
            return Util::getNULLorId($this) .", "
                ."'". $this->getNome() ."', "
                . Util::getNULLorId($this->getCategoria()) .", "
                . $this->getValor() .", "
                ."'". $this->getDataCredito() ."', "
                . Util::getNULLorId($this->getTipo()) .", "
                . $this->getUsuario()->getId();
        }

        public function toArray(){
            return [
                "id" => Util::getNULLorId($this),
                "nome" => "'". $this->getNome() ."'",
                "id_categoria" => Util::getNULLorId($this->getCategoria()),
                "valor" => $this->getValor(),
                "data_credito" => "'". $this->getDataCredito() ."'",
                "id_tipo" => Util::getNULLorId($this->getTipo()),
                "id_usuario" => $this->getUsuario()->getId()
            ];
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
                "data_credito" => "'". $this->getDataCredito() ."'",
                "tipo" => [
                    "id" => Util::getIdOrNull($this->getTipo()),
                    "nome" => (empty($this->getTipo()) ? '' : $this->getTipo()->getNome())
                ],
                "id_usuario" => Util::getIdOrNull($this->getUsuario())
            ]);
        }

        public function getId(){
            return $this->id;
        }
    
        public function getNome(){
            return $this->nome;
        }
    
        public function getCategoria(){
            if(empty($this->categoria))
                return new Categoria();

            return $this->categoria;
        }
    
        public function getValor(){
            return $this->valor;
        }
    
        public function getDataCredito(){
            return $this->dataCredito;
        }
    
        public function getTipo(){
            if(empty($this->tipo))
                return new Tipo();
            
            return $this->tipo;
        }
    
        public function getUsuario(){
            return $this->usuario;
        }

        public function setId($id){
            $this->id = $id;
        }

        public function setNome($nome){
            $this->nome = $nome;
        }

        public function setCategoria($cat){
            $this->categoria = $cat;
        }

        public function setValor($valor){
            $this->valor = $valor;
        }

        public function setDataCredito($data){
            $this->dataCredito = $data;
        }

        public function setTipo($tipo){
            $this->tipo = $tipo;
        }

        public function setUsuario($u){
            $this->usuario = $u;
        }        
    }
?>