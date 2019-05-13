<?php
    require_once "Controller.php";
    require_once "CategoriaController.php";

    require_once $_SERVER['DOCUMENT_ROOT'] ."/meuBolso/service/DescontoService.php";
    require_once $_SERVER['DOCUMENT_ROOT'] ."/meuBolso/model/ParametrosEnum.php";
    require_once $_SERVER['DOCUMENT_ROOT'] ."/meuBolso/model/MensagemEnum.php";

    class DescontoController extends Controller {
        function __construct(){
            parent::setService(new DescontoService());
        }

        public function buscarPorSalario($salario){
            if(empty($salario))
                return null;

            return parent::getService()->buscarPorSalario($salario->getId());
        }

        public function buscarPorUsuario($usuario){
            if(empty($usuario))
                return null;

            $result = parent::getService()->buscarPorUsuario($usuario->getId());
            
            //TODO FIX: adequar
            
            return (empty($result)) ? new Desconto() : $result;
        }

        public function save($req){
            $d = new Desconto();
            
            $req = (object) $req;

            $uController = new UsuarioController();
            $cController = new CategoriaController();

            if(isset($req->id_desconto))
                $d->setId($req->id_desconto);

            if(isset($req->nome_desconto))
                $d->setNome($req->nome_desconto);

            $d->setUsuario($uController->get($req->id_usuario));
            $d->setCategoria($cController->get($req->categoria_desconto));
            $d->setValor($req->valor_desconto);
            $d->setPorcentagem($req->porcentagem_desconto);

            return parent::save($d);
        }

        public function delete($req){
            $req = (object) $req;

            if(!empty($req)){
                if($req->obj_type == "desconto" && !empty($req->id_desconto))
                    return parent::delete($req->id_desconto);
            }

            return false;
        }
    }
?>