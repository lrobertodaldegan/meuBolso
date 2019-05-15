<?php
    require_once "Controller.php";
    require_once "ContaController.php";
    require_once "UsuarioController.php";
    require_once $_SERVER['DOCUMENT_ROOT'] ."/meuBolso/service/CompartilhaService.php";
    require_once $_SERVER['DOCUMENT_ROOT'] ."/meuBolso/model/ParametrosEnum.php";
    require_once $_SERVER['DOCUMENT_ROOT'] ."/meuBolso/model/MensagemEnum.php";

    class CompartilhaController extends Controller{
        function __construct(){
            parent::setService(new CompartilhaService());
        }

        public function getAllByBill($idConta) {
            if(empty($idConta))
                return [];

            $contas = parent::getService()->getAllByBill($idConta);

            if(empty($contas))
                return [];

            $compartilhadasAsContas = [];//lista de compartilhamentos

            foreach($contas as $c) {
                $c = $this->dePara($c);

                array_push($compartilhadasAsContas, $c);
            }

            return $compartilhadasAsContas;
        }

        public function getAllBills($uId, $isOwner) {
            if(empty($uId))
                return [];

            if($isOwner)
                $contas = parent::getService()->getAllByOwner($uId);
            else    
                $contas = parent::getAllByUser($uId);

            if(empty($contas))
                return [];

            $compartilhadasAsContas = [];//lista de contas

            foreach($contas as $c) {
                $c = $this->dePara($c);

                array_push($compartilhadasAsContas, $c->getConta());
            }

            return $compartilhadasAsContas;
        }

        public function checkShareByUserAndBill($uId, $cId) {
            if(empty($uId) || empty($cId))
                return true;

            return parent::getService()->checkShareByUserAndBill($uId, $cId);
        }

        public function save($req) {
            if($this->checkShareByUserAndBill($req['id_usuario'], $req['id_conta']))
                return 0;

            return parent::getService()->saveReturningContaId($this->dePara($req));
        }

        public function dePara($r) {
            $c = new Compartilha();

            if(empty($r))
                return $c;

            $r = (object) $r;

            $cController = new ContaController();

            $uController = new UsuarioController();

            if(!empty($r->id))
                $c->setId($r->id);

            if(!empty($r->id_conta))
                $c->setConta($cController->get($r->id_conta));

            if(!empty($r->id_usuario))
                $c->setUsuario($uController->get($r->id_usuario));

            if(!empty($r->id_owner))
                $c->setOwner($uController->get($r->id_owner));

            return $c;
        }
    }
?>