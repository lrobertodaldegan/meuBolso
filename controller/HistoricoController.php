<?php
    require_once "Controller.php";
    require_once $_SERVER['DOCUMENT_ROOT'] ."/meuBolso/service/HistoricoService.php";
    require_once $_SERVER['DOCUMENT_ROOT'] ."/meuBolso/controller/UsuarioController.php";
    require_once $_SERVER['DOCUMENT_ROOT'] ."/meuBolso/model/Historico.php";

    class HistoricoController extends Controller{
        function __construct(){
            parent::setService(new HistoricoService());
        }

        public function getAllByUser($uId) {
            if(empty($uId))
                return null;

            $hs = [];

            $rs = $this->getService()->getAllByUserOrdened($uId);

            foreach($rs as $r) {
                array_push($hs, $this->dePara($r));
            }

            return $hs;
        }

        public function getHistorico($usuarioId){
            return parent::getService()->getHistorico($usuarioId);
        }

        public function getHistoricoPorData($usuarioId, $dataAte){
            return parent::getService()->getHistoricoPorData($usuarioId, $dataAte);
        }

        public function getLastOperationsByUser($uId) {
            $eventos = [];
            
            if(empty($uId))
                return [];

            $operacoes = parent::getService()->getLastOperationsByUser($uId);

            if(!empty($operacoes)) {
                foreach($operacoes as $op) {
                    array_push($eventos, $this->dePara($op));
                }
            }

            foreach($eventos as $h) {
                $valor = ($h->getValorDe() - $h->getValorPara()) * -1; //tratando se operação de adição ou subtração

                if($valor < 0) {
                    $h->setIcon("<span class='lnr lnr-circle-minus'></span>");
                    $valor = $valor * -1; //converte para manter tudo positivo pra exibição
                } else {
                    $h->setIcon("<span class='lnr lnr-plus-circle'></span>");
                }

                $h->setValor($valor);
            }

            return $eventos;
        }

        public function getLastSaldoByUserAndMonth($uId, $date) {
            if(empty($uId) || empty($date))
                return 0;

            $r = parent::getService()->getLastSaldoByUserAndMonth($uId, Util::getYearAndMonth($date));

            return Util::getZeroIfNull($this->dePara($r)->getValorPara());
        }

        public function getLastLoginEvent($uId) {
            $r = parent::getService()->getLastLoginEvent($uId);

            return $this->dePara($r);
        }

        public function salvarEventoAcesso($usuario) {
            if(!empty($usuario) && !empty($usuario->getId())){
                $h = new Historico();

                $h->setOperacao("Fez login");
                $h->setUsuario($usuario);
                $h->setData(date('Y-m-d'));

                return parent::save($h);
            }

            return false;
        }

        public function dePara($r) {
            $h = new Historico();
            
            if(empty($r))
                return $h;

            $r = (object) $r;

            if(isset($r->id))
                $h->setId($r->id);

            if(isset($r->operacao))
                $h->setOperacao($r->operacao);

            if(isset($r->tip))
                $h->setTip($r->tip);
            
            if(isset($r->campo_alterado))
                $h->setCampoAlterado($r->campo_alterado);
            
            if(isset($r->id_usuario)) {
                $uController = new UsuarioController();

                $usuario = $uController->get($r->id_usuario);
            } else {
                $uController = new UsuarioController();

                $usuario = $uController->getLogado();
            }

            $h->setUsuario($usuario);

            if(isset($r->valor_de))
                $h->setValorDe($r->valor_de);

            if(isset($r->valor_para))
                $h->setValorPara($r->valor_para);
            
            if(isset($r->data))
                $h->setData($r->data);
            else
                $h->setData(date('Y-m-d'));
            
            if(isset($r->saldo))
                $h->setSaldo($r->saldo);
                
            $this->setIcon($h);
            
            return $h;
        }

        public function setIcon($historico) {
            switch($historico->getOperacao()){
                case 'Teve o saldo da renda atualizado':
                    $icon = '<span class="lnr lnr-sync" style="color:orange;"></span>';
                    break;
                case 'Atualizou a renda':
                    $icon = '<span class="lnr lnr-sync" style="color:orange;"></span>';
                    break;
                case 'Alterou a data de renovação de renda (saldo)':
                    $icon = '<span class="lnr lnr-calendar-full" style="color:gray;"></span>';
                    break;
                case 'Uma conta foi paga':
                    $icon = '<span>&#128184;</span>';
                    break;
                case 'Se cadastrou':
                    $icon = '<span class="lnr lnr-heart" style="color:red;"></span>';
                    break;
                case 'Cadastrou um objetivo novo':
                    $icon = '<span>&#127919;</span>';
                    break;
                case 'Concluiu um objetivo':
                    $icon = '<span>&#127941;</span>';
                    break;
                default:
                    $icon = '<span class="lnr lnr-bookmark" style="color:blue;"></span>';
                    break;
            }

            $historico->setIcon($icon);
        }

        public function getEventDetails($historico) {
            $spanIni = '<span style="margin-right:10px;margin-left:-3px;">';
            $spanDesc= '<span class="desc">';
            $spanDate= '<span class="dt"> ';
            $spanEnd = '</span>';
            $bold = '';
            $boldEnd = ': ';

            if($historico->getOperacao() == 'Concluiu um objetivo'){
                $spanDesc = '<span class="desc" style="font-size:28px;">';
                $bold = '<b>UAU! Você ';
                $boldEnd = '</b>: ';
            }

            return $spanIni. $historico->getIcon() .$spanEnd
                .$spanDesc.$bold. $historico->getOperacao() .$boldEnd. $historico->getTip() .$spanEnd
                .$spanDate. Util::parseDate($historico->getData(), true) .$spanEnd
            ;
        }
    }
?>
