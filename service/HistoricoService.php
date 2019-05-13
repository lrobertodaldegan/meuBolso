<?php
    require_once "Service.php";
    require_once $_SERVER['DOCUMENT_ROOT'] ."/meuBolso/controller/UsuarioController.php";
    require_once $_SERVER['DOCUMENT_ROOT'] ."/meuBolso/dao/HistoricoDao.php";

    class HistoricoService extends Service{
        function __construct(){
            parent::setDao(new HistoricoDao());
        }

        public function getAllByUserOrdened($uId) {
            return parent::getDao()->getAllByUserOrdened($uId);
        }

        public function getHistorico($usuarioId){
            return parent::getDao()->obterPorDataEUsuario(null, $usuarioId);
        }

        public function getHistoricoPorData($usuarioId, $data){
            return parent::getDao()->obterPorDataEUsuario($data, $usuarioId);
        }

        public function getLastOperationsByUser($uId) {
            return parent::getDao()->obterUltimasOperacoesDoSaldo($uId);
        }

        public function getLastSaldoByUserAndMonth($uId, $yM) {
            return parent::getDAO()->getLastSaldoByUserAndMonth($uId, $yM);
        }

        public function getLastLoginEvent($uId) {
            return parent::getDao()->getLastLoginEvent($uId);
        }
    }
?>