<?php
    require_once "Controller.php";
    require_once $_SERVER['DOCUMENT_ROOT'] ."/meuBolso/service/ObjetivoService.php";
    // require_once $_SERVER['DOCUMENT_ROOT'] ."/meuBolso/model/ParametrosEnum.php";
    require_once $_SERVER['DOCUMENT_ROOT'] ."/meuBolso/model/MensagemEnum.php";

    class ObjetivoController extends Controller{
        function __construct(){
            parent::setService(new ObjetivoService());
        }

        public function getAllPorUsuarioLogado($usuario){
            return parent::getService()->getAllPorUsuario($usuario);
        }

        public function delete($req){
            $req = (object) $req;

            if(!empty($req)){
                if($req->obj_type == "objetivo" && !empty($req->id))
                    return parent::delete($req->id);
            }

            return false;
        }

        public function getMedals($percent) {
            $medal = "";

            if($percent < 1)
                $c = 0;
            else
                $c = $percent / 30; 

            for($i=0; $i < (int) $c; $i++) {
                if($i == 0)
                    $medal .= "<span>Parabéns!!!</span><br><span style='font-size:28px;'>&#127941;</span>";
                else
                    $medal .= "<span style='font-size:28px;'>&#127941;</span>";
            }

            return $medal;
        }

        public function getPorcentagemConclusaoObjetivos($uId) {
            if(empty($uId))
                return 0;

            $r = parent::getService()->getPorcentagemConclusaoObjetivos($uId);

            if($r->total < 1)
                return 0;

            return (float) ($r->concluido * 100) / $r->total;
         }

        public function concluir($req) {
            if(empty($req))
                return null;

            return parent::getService()->concluir($req);
        }
    }
?>