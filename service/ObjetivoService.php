<?php
    require_once "Service.php";
    require_once $_SERVER['DOCUMENT_ROOT'] ."/meuBolso/dao/ObjetivoDao.php";
    require_once $_SERVER['DOCUMENT_ROOT'] ."/meuBolso/controller/UsuarioController.php";

    class ObjetivoService extends Service{
        function __construct(){
            parent::setDao(new ObjetivoDao());
        }

        public function get($id) {
            return $this->dePara(parent::get($id));
        }

        public function getAllPorUsuario($usuario){
            $objetivos = [];

            $rs = parent::getDao()->listarPorUsuario($usuario);

            if(!empty($rs)){
                foreach($rs as $r){
                    array_push($objetivos, $this->dePara($r));
                }
            }

            return $objetivos;
        }

        public function listPaginatedByUser($init, $limit, $userId) {
            $objetivos = [];

            $rs = parent::getDao()->listPaginatedByUser($init, $limit, $userId);

            if(!empty($rs)){
                foreach($rs as $r){
                    array_push($objetivos, $this->dePara($r));
                }
            }

            return $objetivos;
        }

        public function save($req){
            return parent::save($this->dePara($req));
        }

        public function concluir($req) {
             return parent::getDao()->concluir($this->dePara($req));
        }

        public function dePara($r){
            $o = new Objetivo();

            $r = (object) $r;

            if(isset($r->id) && !empty($r->id))
                $o->setId($r->id);

            if(isset($r->nome))
                $o->setNome($r->nome);
            
            if(isset($r->prioridade))
                $o->setPrioridade($r->prioridade);

            if(isset($r->data_cadastro))
                $o->setDataCadastro($r->data_cadastro);
            else
                $o->setDataCadastro(date('Y-m-d'));

            if(isset($r->data_realizacao))
                $o->setDataRealizacao($r->data_realizacao);
            
            if(isset($r->valor_total))
                $o->setValorTotal($r->valor_total);
            
            if(isset($r->saldo))
                $o->setSaldo($r->saldo);
            
            if(!empty($r->parcelas))
                $o->setParcelas($r->parcelas);
            else
                $o->setParcelas($this->calcParcelas($o, null, '%m'));

            if(!empty($r->id_usuario)){
                $uController = new UsuarioController();
                $o->setUsuario($uController->get($r->id_usuario));
            }

            if(isset($r->concluido))
                $o->setConcluido(!empty($r->concluido));

            else
                $o->setConcluido(false);
            
            return $o;
        }

        public function calcParcelas($objetivo, $dataInicio, $format){
            $parcelas = 0;

            if(empty($dataInicio))
                $dtInicio = $objetivo->getDataCadastro(false);
            else
                $dtInicio = $dataInicio;

            $dtInicio = new DateTime($dtInicio);

            $dtFim = new DateTime($objetivo->getDataRealizacao());

            $parcelas = date_diff($dtInicio, $dtFim)->format($format);

            return $parcelas;
        }

        public function getPorcentagemConclusaoObjetivos($uId) {
            return parent::getDao()->getPorcentagemConclusaoObjetivos($uId);
        }
    }
?>