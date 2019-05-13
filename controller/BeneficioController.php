<?php
    require_once "Controller.php";

    require_once $_SERVER['DOCUMENT_ROOT'] ."/meuBolso/service/BeneficioService.php";
    require_once $_SERVER['DOCUMENT_ROOT'] ."/meuBolso/model/ParametrosEnum.php";
    require_once $_SERVER['DOCUMENT_ROOT'] ."/meuBolso/model/MensagemEnum.php";

    class BeneficioController extends Controller{
        private $beneficio = null;

        function __construct(){
            parent::setService(new BeneficioService());
        }

        public function listarPorDataCredito($d){
            return parent::getService()->listarPorDataCredito($d);
        }

        public function buscarPorUsuario($usuario){
            if(empty($usuario))
                return null;

            $result = parent::getService()->buscarPorUsuario($usuario->getId());
            
            //TODO FIX: adequar
            
            return (empty($result)) ? new Beneficio() : $result;
        }

        public function save($req){
            $b = new Beneficio();
            
            $req = (object) $req;

            $uController = new UsuarioController();
            $cController = new CategoriaController();
            $tController = new TipoController();

            if(isset($req->id_beneficio))
                $b->setId($req->id_beneficio);

            if(isset($req->nome_beneficio))
                $b->setNome($req->nome_beneficio);

            $b->setUsuario($uController->get($req->id_usuario));
            $b->setCategoria($cController->get($req->categoria_beneficio));
            $b->setValor($req->valor_beneficio);
            $b->setDataCredito($req->dt_beneficio);
            $b->setTipo($tController->get($req->tipo_beneficio));

            return parent::save($b);
        }

        public function delete($req){
            $req = (object) $req;

            if(!empty($req)){
                if($req->obj_type == "beneficio" && !empty($req->id_beneficio))
                    return parent::delete($req->id_beneficio);
            }

            return false;
        }
    }
?>