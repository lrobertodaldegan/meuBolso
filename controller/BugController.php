<?php
    require_once "Controller.php";

    require_once $_SERVER['DOCUMENT_ROOT'] ."/meuBolso/service/BugService.php";
    require_once $_SERVER['DOCUMENT_ROOT'] ."/meuBolso/model/ParametrosEnum.php";
    require_once $_SERVER['DOCUMENT_ROOT'] ."/meuBolso/model/MensagemEnum.php";

    class BugController extends Controller{
        function __construct(){
            parent::setService(new BugService());
        }

        public function save($req){
            $b = new Bug();
            
            $req = (object) $req;

            if(isset($req->nome_bug))
                $b->setNome($req->nome_bug);

            if(isset($req->email_bug))
                $b->setEmail($req->email_bug);

            $b->setRelato($req->relato);

            $b->setDate(date("Y-m-d"));

            return parent::save($b);
        }
    }
?>