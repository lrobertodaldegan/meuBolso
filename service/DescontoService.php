<?php
    require_once "Service.php";
    require_once $_SERVER['DOCUMENT_ROOT'] ."/meuBolso/dao/DescontoDAO.php";
    require_once $_SERVER['DOCUMENT_ROOT'] ."/meuBolso/controller/UsuarioController.php";

    class DescontoService extends Service{
        function __construct(){
            parent::setDao(new DescontoDAO());
        }

        public function buscarPorUsuario($uId){
            $descontos = [];

            foreach(parent::getDao()->buscarPorUsuario($uId) as $r){
                array_push($descontos, $this->dePara($r));
            }
            
            return $descontos;
        }

        public function buscarPorSalario($salarioId){
            if(empty($salarioId))
                return $this->dePara(null);

            return $this->dePara(parent::getDao()->buscarPorSalario($salarioId));
        }

        public function listPaginated($pg, $lmt){
            $descontos = [];

            foreach(parent::listPaginated($pg, $lmt) as $r){
                array_push($descontos, $this->dePara($r));
            }
            
            return $descontos;
        }

        public function listarPorData($d){
            $contas = [];
            
            foreach(parent::getDao()->listarPorData() as $r){
                array_push($contas, $this->dePara($r));
            }
        }

        public function get($id){
            return $this->dePara(parent::get($id));
        }

        public function getAll(){
            $descontos = [];

            foreach(parent::getAll() as $r){
                array_push($descontos, $this->dePara($r));
            }

            return $descontos;
        }

        public function dePara($r){
            $desconto = new Desconto();

            if(empty($r))
                return $desconto;

            if(isset($r->id))
                $desconto->setId($r->id);
            
            if(isset($r->nome))
                $desconto->setNome($r->nome);

            if(isset($r->valor))
                $desconto->setvalor($r->valor);
            
            if(isset($r->porcentagem))    
                $desconto->setPorcentagem($r->porcentagem);
            
            if(isset($r->id_categoria)){
                $cController = new CategoriaController();
                $desconto->setCategoria($cController->get($r->id_categoria));
            }

            if(isset($r->id_usuario)){
                $uController = new UsuarioController();
                $desconto->setUsuario($uController->get($r->id_usuario));
            }

            if(isset($r->id_beneficio)){
                $bController = new BeneficioController();
                $desconto->setBeneficio($bController->get($r->id_beneficio));
            }

            return $desconto;
        }
    }
?>