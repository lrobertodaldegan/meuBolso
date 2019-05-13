<?php
    require_once "Util.php";

    class Bug {
        const TABLE = 'bug';
        private $id;
        private $nome;
        private $email;
        private $data;
        private $relato;
        private $fillable = [
            "id",
            "nome",
            "email",
            "data",
            "relato"
        ];

        public function getFillable($toString){
            if($toString)
                return implode(', ', $this->fillable);

            return $this->fillable;
        }

        public function toString(){
            return Util::getNULLorId($this) .", "
                ."'". $this->getNome() ."', "
                ."'". $this->getEmail() ."', "
                ."'". $this->getData() ."', "
                ."'". $this->getRelato() ."'";
        }

        public function toArray(){
            return [
                "id" => Util::getNULLorId($this),
                "nome" => "'". $this->getNome() ."'",
                "email" => $this->getEmail(),
                "data" => $this->getData(),
                "relato" => "'". $this->getRelato() ."'"
            ];
        }
        
        public function toJSON(){
            return json_encode([
                "id" => Util::getIdOrNull($this),
                "nome" => "'". $this->getNome() ."'",
                "email" => "'". $this->getEmail() ."'",
                "data" => "'". $this->getData() ."'",
                "relato" => "'". $this->getRelato() ."'"
            ]);
        }

        public function getId(){
            return $this->id;
        }

        public function setId($id){
            $this->id = $id;
        }

        public function getNome(){
            return $this->nome;
        }

        public function setNome($nome){
            $this->nome = $nome;
        }

        public function getEmail(){
            return $this->email;
        }

        public function setEmail($email){
            $this->email = $email;
        }

        public function getData(){
            return $this->data;
        }

        public function setData($data){
            $this->data = $data;
        }

        public function getRelato(){
            return $this->relato;
        }

        public function setRelato($relato){
            $this->relato = $relato;
        }        
    }
?>