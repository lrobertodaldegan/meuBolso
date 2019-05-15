<?php
    require_once "Service.php";
    require_once $_SERVER['DOCUMENT_ROOT'] ."/meuBolso/dao/ContaDAO.php";
    require_once $_SERVER['DOCUMENT_ROOT'] ."/meuBolso/controller/CategoriaController.php";
    require_once $_SERVER['DOCUMENT_ROOT'] ."/meuBolso/controller/TipoController.php";
    require_once $_SERVER['DOCUMENT_ROOT'] ."/meuBolso/controller/UsuarioController.php";

    class ContaService extends Service{
        function __construct(){
            parent::setDao(new ContaDAO());
        }

        public function calcularValorTotalPorData($uId, $d){
            if(empty($d))
                $d = date('Y-m-d');

            $total = parent::getDao()->getValorTotalPorData($uId, $d);
            
            if($total != null)
                return $total;
                
            return 0;
        }

        public function getTotalPorMes($uId, $yM) {
            $r = parent::getDao()->getTotalPorMes($uId, $yM);
            
            if($r->total != null)
                return $r->total;
                
            return 0;
        }

        public function getTotalPagasPorMes($uId, $yM) {
            $r = parent::getDao()->getTotalPagasPorMes($uId, $yM);
            
            if($r->total != null)
                return $r->total;
                
            return 0;
        }

        public function listarPorData($d, $uId){
            $contas = [];
            
            if(empty($d))
                $d = date('Y-m-d');

            $rs = parent::getDao()->listarPorData($d, $uId);

            if(empty($rs))
                return $contas;

            foreach($rs as $r){
                array_push($contas, $this->dePara($r));
            }

            return $contas;
        }

        public function getTotalParcelasByParentId($idPai) {
            return parent::getDao()->getTotalParcelasByParentId($idPai);
        }

        public function del($id, $idPai, $vencimento) {
            return parent::getDao()->del($id, $idPai, $vencimento);
        }

        public function save($req) {
            return parent::save($this->dePara($req));
        }

        public function listarTresProximasContasMes($data, $uId) {
            $contas = [];

            $rs = parent::getDao()->listarTresProximasContasMes($data, $uId);

            if(empty($rs))
                return $contas;

            foreach($rs as $r) {
                array_push($contas, $this->dePara($r));
            }

            return $contas;
        }

        public function listarPagosPaginadoPorData($d, $pg, $lmt, $uId) {
            $contas = [];

            $rs = parent::getDao()->listarPagosPaginadoPorData($d, $pg, $lmt, $uId);

            if(empty($rs))
                return $contas;

            foreach($rs as $r){
                array_push($contas, $this->dePara($r));
            }

            return $contas;
        }

        public function listarPaginadoPorData($d, $pg, $lmt, $uId) {
            $contas = [];

            $rs = parent::getDao()->listarPaginadoPorData($d, $pg, $lmt, $uId);

            if(empty($rs))
                return $contas;

            foreach($rs as $r){
                array_push($contas, $this->dePara($r));
            }

            return $contas;
        }

        public function listarPaginadoPorDataAPartirDe($d, $pg, $lmt, $uId) {
            $contas = [];

            $rs = parent::getDao()->listarPaginadoPorDataAPartirDe($d, $pg, $lmt, $uId);

            if(empty($rs))
                return $contas;

            foreach($rs as $r){
                array_push($contas, $this->dePara($r));
            }

            return $contas;
        }

        public function getNextContas($yM, $dt, $uId) {
            $contas = [];

            $rs = parent::getDao()->getNextContas($yM, $dt, $uId);

            if(empty($rs))
                return $contas;

            foreach($rs as $r) {
                array_push($contas, $this->dePara($r));
            }

            return $contas;
        }

        public function listPaginatedByUser($page, $limit, $uId) {
            $contas = [];

            $rs = parent::listPaginatedByUser($page, $limit, $uId);

            if(empty($rs))
                return $contas;

            foreach($rs as $r){
                array_push($contas, $this->dePara($r));
            }

            return $contas;
        }

        public function getAllByUserAndDateMonth($uId, $dM){
            $contas = [];

            $rs = $this->getDao()->getAllByUserAndDateMonth($uId, $dM);

            if(empty($rs))
                return $contas;
                
            foreach($rs as $r) {
                array_push($contas, $this->dePara($r));
            }

            return $contas;
        }

        public function listarAVencerPaginadoPorData($d, $pg, $lmt, $uId) {
            $contas = [];

            $rs = parent::getDao()->listarAVencerPaginadoPorData($d, $pg, $lmt, $uId);

            if(empty($rs))
                return $contas;

            foreach($rs as $r){
                array_push($contas, $this->dePara($r));
            }

            return $contas;
        }

        public function getGroupedCatByUserAndDate($uId, $date) {
            return parent::getDao()->getGroupedCatByUserAndDate($uId, $date);
        }

        public function deleteChildren($idPai) {
            return parent::getDao()->deleteParentAndChildren($idPai);
        }

        public function pagar($idConta, $isPago, $saldo, $atualizadorId) {
            return parent::getDao()->pagar($idConta, $isPago, $saldo, $atualizadorId); 
        }

        public function get($id){
            return $this->dePara(parent::get($id));
        }

        public function getAll(){
            $contas = [];

            foreach(parent::getAll() as $r){
                array_push($contas, $this->dePara($r));
            }

            return $contas;
        }

        public function dePara($r){
            if(empty($r))
                return null;
                
            $conta = new Conta();

            $r = (object) $r;

            $uController = new UsuarioController();

            if(!empty($r->id_categoria)){
                $catController = new CategoriaController();

                $conta->setCategoria($catController->get($r->id_categoria));
            }

            if(!empty($r->id_tipo)){
                $tController = new TipoController();

                $conta->setTipo($tController->get($r->id_tipo));
            }

            if(!empty($r->id_usuario))
                $conta->setUsuario($uController->get($r->id_usuario));

            if(!empty($r->id))
                $conta->setId($r->id);
            
            if(!empty($r->descricao))
                $conta->setDescricao($r->descricao);
            
            if(isset($r->valor_total) && !empty($r->valor_total))
                $conta->setValorTotal($r->valor_total);
            
            if(!empty($r->valor))
                $conta->setValor($r->valor);

            if(!empty($r->pago))
                $conta->setPago($r->pago);

            if(!empty($r->saldo))
                $conta->setSaldo($r->saldo);
            else if(empty($r->saldo) && $conta->isPago())
                $conta->setSaldo($r->valor);

            if(!empty($r->vencimento))
                $conta->setVencimento($r->vencimento);
            
            if(!empty($r->juros))
                $conta->setJuros($r->juros);
        
            if(!empty($r->tipo_juros))
                $conta->setTipoJuros($r->tipo_juros);
            
            if(!empty($r->parcelas))
                $conta->setParcelas($r->parcelas);

            if(isset($r->parcelas_total) && !empty($r->parcelas_total))
                $conta->setParcelasTotal($r->parcelas_total);
            
            if(!empty($r->observacao))
                $conta->setObservacao($r->observacao);

            if(!empty($r->id_pai))
                $conta->setIdPai($r->id_pai);

            if(!empty($r->atualizado_por)){
                $conta->setAtualizadoPor($uController->get($r->atualizado_por));
            } else {
                $conta->setAtualizadoPor($uController->getLogado());
            }

            return $conta;
        }

        public function countPagesByUser($uId) {
            $pages =[];
            
            $total = $this->getDao()->countByUser($uId)->p;

            if($total > 0){
                $total = ceil($total / 5);
            }else{
                $total = 1;
            }

            for($i=1; $i <= $total; $i++){
                array_push($pages, $i);
            }

            return $pages;
        }
    }
?>