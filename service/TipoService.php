<?php
    require_once "Service.php";
    require_once $_SERVER['DOCUMENT_ROOT'] ."/meuBolso/dao/TipoDAO.php";
    require_once $_SERVER['DOCUMENT_ROOT'] ."/meuBolso/controller/UsuarioController.php";

    class TipoService extends Service {
        function __construct(){
            parent::setDao(new TipoDAO());
        }

        public function get($id){
            return $this->dePara(parent::get($id));
        }

        public function getAll() {
            $tipos = [];

            foreach(parent::getAll() as $r){
                array_push($tipos, $this->dePara($r));
            }

            return $tipos;
        }

        public function dePara($r){
            if(empty($r))
                return null;
                
            $tipo = new Tipo();

            $r = (object) $r;

            if(isset($r->id))
                $tipo->setId($r->id);

            if(isset($r->nome))
                $tipo->setNome($r->nome);
            
            if(isset($r->criado_em))
                $tipo->setCriadoEm($r->criado_em);

            if(isset($r->criado_por)) {
                $uController = new UsuarioController();
                $tipo->setCriadoPor($uController->get($r->criado_por));
            }

            return $tipo;
        }
    }
?>