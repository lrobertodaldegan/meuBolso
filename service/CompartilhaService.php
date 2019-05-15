<?php
    require_once "Service.php";
    require_once $_SERVER['DOCUMENT_ROOT'] ."/meuBolso/dao/CompartilhaDAO.php";

    class CompartilhaService extends Service{
        function __construct(){
            parent::setDao(new CompartilhaDAO());
        }

        public function getAllByOwner($uId) {
            return parent::getDao()->getAllByOwner($uId);
        }

        public function getAllByBill($idConta) {
            return parent::getDao()->getAllByBill($idConta);
        }

        public function saveReturningContaId($obj) {
            return parent::getDao()->saveReturningContaId($obj);
        }

        public function checkShareByUserAndBill($uId, $cId) {
            return parent::getDao()->checkShareByUserAndBill($uId, $cId);
        }
    }
?>