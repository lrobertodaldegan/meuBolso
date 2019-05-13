<?php
    require_once "Service.php";
    require_once $_SERVER['DOCUMENT_ROOT'] ."/meuBolso/dao/BeneficioDAO.php";
    require_once $_SERVER['DOCUMENT_ROOT'] ."/meuBolso/controller/UsuarioController.php";
    require_once $_SERVER['DOCUMENT_ROOT'] ."/meuBolso/controller/TipoController.php";
    require_once $_SERVER['DOCUMENT_ROOT'] ."/meuBolso/controller/CategoriaController.php";

    class BeneficioService extends Service{
        function __construct(){
            parent::setDao(new BeneficioDAO());
        }

        public function listarPorDataCredito($d){
            $beneficios = [];
            
            foreach(parent::getDao()->listarPorDataCredito() as $r){
                array_push($beneficios, $this->dePara($r));
            }
        }

        public function buscarPorUsuario($uId){
            $beneficios = [];

            foreach(parent::getDao()->buscarPorUsuario($uId) as $r){
                array_push($beneficios, $this->dePara($r));
            }
            
            return $beneficios;
        }

        public function listPaginated($pg, $lmt){
            $beneficios = [];

            foreach(parent::listPaginated($pg, $lmt) as $r){
                array_push($beneficios, $this->dePara($r));
            }
            
            return $beneficios;
        }

        public function listPaginatedByUser($pg, $lmt, $userId){
            $beneficios = [];

            $rs = parent::listPaginated($pg, $lmt, $userId);

            if(!empty($rs)){
                foreach($rs as $r){
                    array_push($beneficios, $this->dePara($r));
                }
            }
            
            return $beneficios;
        }

        public function get($id){
            return $this->dePara(parent::get($id));
        }

        public function getAll(){
            $beneficios = [];

            foreach(parent::getAll() as $r){
                array_push($beneficios, $this->dePara($r));
            }

            return $beneficios;
        }

        public function dePara($r){
            $beneficio = new Beneficio();

            if(empty($r))
                return $beneficio;  

            $r = (object) $r;

            if(isset($r->id))
                $beneficio->setId($r->id);
            
            if(isset($r->nome))
                $beneficio->setNome($r->nome);

            if(isset($r->valor))
                $beneficio->setValor($r->valor);
            
            if(isset($r->data_credito))
                $beneficio->setDataCredito($r->data_credito);
    
            if(isset($r->id_categoria)){
                $cController = new CategoriaController();
                $beneficio->setCategoria($cController->get($r->id_categoria));
            }
    
            if(isset($r->id_tipo)){
                $tcontroller = new TipoController();
                $beneficio->setTipo($tcontroller->get($r->id_tipo));
            }
             
            if(isset($r->id_usuario)){
                $uController = new UsuarioController();
                $beneficio->setUsuario($uController->get($r->id_usuario));
            }
    
            return $beneficio;
        }
    }
?>