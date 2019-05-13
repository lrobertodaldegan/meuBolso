<?php
    require_once "Controller.php";
    require_once $_SERVER['DOCUMENT_ROOT'] ."/meuBolso/service/ContaService.php";
    require_once $_SERVER['DOCUMENT_ROOT'] ."/meuBolso/model/ParametrosEnum.php";
    require_once $_SERVER['DOCUMENT_ROOT'] ."/meuBolso/model/MensagemEnum.php";

    class ContaController extends Controller{
        private $conta = null;

        function __construct(){
            parent::setService(new ContaService());
        }

        public function listarPorData($d, $uId){
            if(empty($uId))
                return null;

            return parent::getService()->listarPorData($d, $uId);
        }

        public function getTotalContasPagas($uId, $date) {
            return parent::getService()->getTotalPagasPorMes($uId, Util::getYearAndMonth($date));
        }

        public function getTotalContas($uId, $date) {
            return parent::getService()->getTotalPorMes($uId, Util::getYearAndMonth($date));
        }

        public function calcularValorTotalContas($dt, $contas){
            $total = 0;
            
            if(!empty($contas)) {
                foreach($contas as $c) {
                    if(!$c->isPago() && $c->getVencimento() <= $dt)
                        $total += (float) $c->getValor();
                }
            }

            return $total;
        }

        public function calcularValorTotalContasBuscaPorData($uId, $d){
            $total = parent::getService()->calcularValorTotalPorData($uId, $d);
            
            return $total->total;
        }

        public function listarTresProximasContasMes($userId) {
            if(empty($userId))
                return [];

            return parent::getService()->listarTresProximasContasMes(date('Y-m-d'), $userId);
        }

        public function listarPaginadoPorDataAPartirDe($dt, $page, $limit, $userId){
            $limit = 5;
            $page = $page - 1;

            if($page < 0)
                $page = 0;

            if(empty($userId))
                return null;

            if(empty($dt))
                $dt = Util::getNextMonth(date('Y-m-d'));

            $dt = Util::getYearAndMonth($dt, true);

            return parent::getService()->listarPaginadoPorDataAPartirDe($dt, $page, $limit, $userId);
        }

        public function listarPaginadoPorData($dt, $page, $limit, $userId){
            $limit = 5;
            $page = $page - 1;

            if($page < 0)
                $page = 0;

            if(empty($userId))
                return null;

            if(empty($dt))
                $dt = date('Y-m-d');

            $dt = Util::getYearAndMonth($dt, true);

            return parent::getService()->listarPaginadoPorData($dt, $page, $limit, $userId);
        }

        public function listarPagosPaginadoPorData($dt, $page, $limit, $userId) {
            $limit = 5;
            $page = $page - 1;

            if($page < 0)
                $page = 0;

            if(empty($userId))
                return null;

            if(empty($dt))
                $dt = date('Y-m-d');

            return parent::getService()->listarPagosPaginadoPorData($dt, $page, $limit, $userId);
        }

        public function getAllParcelasByIdPai($id, $parcelaFilho, $idPai) {
            $totalParcelas = 1;

            if(empty($idPai))
                $idPai = $id;

            if(empty($parcelaFilho))
                $parcelaFilho = 1;

            if(!empty($idPai)){
                $totalParcelas = $this->getTotalParcelasByParentId($idPai);
            }

            return $parcelaFilho ." de ". $totalParcelas;
        }

        public function getTotalParcelasByParentId($idPai) {
            if(empty($idPai))
                return 1;
                
            return parent::getService()->getTotalParcelasByParentId($idPai);
        }

        public function calcularSaldoPorData($uId, $saldo, $renda, $dataPagamento, $totalContas, $dataFiltro) {
            $diferenca = Util::getMonthlyDiff(date('Y-m-d'), $dataFiltro);

            $diaPagamento = Util::getDay($dataPagamento, true);

            $contas = (float) $this->getTotalContas($uId, date('Y-m-d')) - $this->getTotalContasPagas($uId, date('Y-m-d'));
            
            $saldoEstimado = (float) $saldo - $contas;

            if($diferenca > 0 || $diaPagamento <= Util::getDay($dataFiltro, true)){//trocou mês ou passou o dia de pagamento
                $proximoMes = date('Y-m-d');

                if($diaPagamento <= Util::getDay($dataFiltro, true))
                    $diferenca++;

                for($i=0; $i < $diferenca; $i++){
                    $contas = (float) $this->getTotalContas($uId, $proximoMes) - $this->getTotalContasPagas($uId, $proximoMes);

                    $restanteMes = $renda - $contas;

                    $proximoMes = Util::getNextMonth($proximoMes);
                    
                    $saldoEstimado += $restanteMes;
                }
            }

            return $saldoEstimado;

        }

        public function getNextContas($dt, $uId) {
            if(empty($uId))
                return null;

            if(empty($dt))
                $dt = date('Y-m-d');

            return parent::getService()->getNextContas(Util::getYearAndMonth($dt), $dt, $uId);
        }
        
        public function listarAVencerPaginadoPorData($dt, $page, $limit, $userId){
            $limit = 5;
            $page = $page - 1;

            if($page < 0)
                $page = 0;

            if(empty($userId))
                return null;

            if(empty($dt))
                $dt = date('Y-m-d');

            return parent::getService()->listarAVencerPaginadoPorData($dt, $page, $limit, $userId);
        }

        public function deleteChildren($idPai) {
            if (empty($idPai))
                return false;

            return parent::getService()->deleteChildren($idPai);
        }

        public function update($req) {
            if(empty($req) || empty($req['valor']))
                return null;

            if($this->deleteChildren($req['id'])) {
                $req['id'] = null;
                
                return $this->save($req);
            }
        }

        public function save($req) {
            if(empty($req) || empty($req['valor']))
                return null;
                
            if($req['parcelas'] > 1){
                if(!empty($req['id_tipo'])){
                    $tController = new TipoController();
                    $tipo = $tController->get($req['id_tipo']);
                    $tipo = $tipo->getNome();
                }

                $req['valor'] = (float) ($req['valor'] / $req['parcelas']); 

                $idPai = 0;

                $totalParcelas = (int) $req['parcelas'];

                for($i=0; $i < $totalParcelas; $i++) {
                    
                    $req['parcelas'] = (int) ($totalParcelas - ($totalParcelas - ($i + 1)));

                    if($i == 0) {
                        $idPai = parent::getService()->save($req);
                    } else {
                        if($tipo == "mensal"){
                            $req['vencimento'] = Util::getNextMonth($req['vencimento']);
                        } else if($tipo == "di&aacute;rio"){
                            $req['vencimento'] = Util::getNextDay($req['vencimento']);
                        } else if($tipo == "semanal"){
                            $req['vencimento'] = Util::getNextWeek($req['vencimento']);
                        } else {
                            break;
                        }

                        $req['id_pai'] = (int) $idPai;
                        // salva a partir da segunda atualizando o vencimento e o numero de parcela, assim como o vínculo à conta pai
                        parent::getService()->save($req);
                    }
                }

                return true;
            }

            return parent::save($req);
        }

        public function delete($req) {
            if(empty($req) || empty($req['id']) || empty($req['vencimento']))
                return null;

            return parent::getService()->del($req['id'], $req['id_pai'], $req['vencimento']);
        }

        public function pagar($request) {
            if(empty($request) || empty($request['id']) || empty($request['valor']) || empty($request['atualizado_por']))
                return null;

            if(empty($request['saldo']))
                $request['saldo'] = $request['valor'];

            $diff = $request['valor'] - $request['saldo'];

            if($diff < 0) { // saldo(conta) informado é maior que o valor da conta
                $diff = $diff * -1;

                $request['saldo'] = $request['saldo'] - $diff;
            }

            if($diff == 0) // saldo(conta) igual ao valor da conta 
                $request['concluido'] = true;

            return parent::getService()->pagar($request['id'], $request['concluido'], $request['saldo'], $request['atualizado_por']);
        }

        public function getCategoriasPorContasMes($date, $uId) {
            if(empty($uId) || empty($date))
                return null;

            $r = parent::getService()->getGroupedCatByUserAndDate($uId, Util::getYearAndMonth($date, true));

            if(empty($r))
                return [];

            return $r;
        }

        public function getAllByUserAndDate($uId,$date){
            if(empty($uId) || empty($date))
                return null;
                
            return $this->getService()->getAllByUserAndDateMonth($uId, Util::getYearAndMonth($date, true));
        }

        public function getPagesByUser($uId){
            return $this->getService()->countPagesByUser($uId);
        }

        public function getAllPagesByUser($uId) {
            return parent::getPagesByUser($uId);
        }
    }
?>