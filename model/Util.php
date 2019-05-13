<?php
    class Util{
        public static function parseDate($data, $USToBR){
            if($USToBR)
                return $data[8] . $data[9] ."/". $data[5] . $data[6] ."/". $data[0].$data[1].$data[2].$data[3];

            return $data[6] . $data[7] . $data[8] . $data[9] ."-". $data[3] . $data[4] ."-". $data[0] . $data[1];
        }

        public static function getParsedMonth($data, $USToBR){
            if($USToBR)
                return $data[5] . $data[6] ."/". $data[0].$data[1].$data[2].$data[3];

            return $data[6] . $data[7] . $data[8] . $data[9] ."-". $data[3] . $data[4];
        }

        public static function getDay($data, $UStoBR=true) {
            if($UStoBR)
                return $data[8] . $data[9];

            return $data[0] . $data[1];
        }

        public static function getMonth($data, $UStoBR=true) {
            if($UStoBR)
                return $data[5] . $data[6];

            return $data[3] . $data[4];
        }

        public static function getYear($data, $UStoBR=true) {
            if($UStoBR)
                return $data[0].$data[1].$data[2].$data[3];

            return $data[6] . $data[7] . $data[8] . $data[9];
        }

        public static function getYearAndMonth($date, $UStoBR=true) {
            return self::getYear($date, $UStoBR) .'-'. self::getMonth($date, $UStoBR);
        }

        public static function getMonthlyDiff($date1, $date2) {
            $diff = (int) self::getMonth($date1) - (int) self::getMonth($date2);

            return $diff >= 0 ? $diff : $diff * -1;
        }

        public function getNextMonth($date) {
            $date = new DateTime($date);
            $date = $date->modify('next month');
            
            return $date->format('Y-m-d');
        }

        public function getNextWeek($date) {
            $date = new DateTime($date);
            $date = $date->modify('next week');
            
            return $date->format('Y-m-d');
        }

        public function getNextDay($date) {
            $date = new DateTime($date);
            $date = $date->modify('next day');
            
            return $date->format('Y-m-d');
        }

        public function getDateMinusNMonths($date, $nMonths) {
            if(empty($date))
                $date = date('Y-m-d');

            if(empty($nMonths) || $nMonths < 1)
                $nMonths = 1;

            $date = new DateTime($date);
            $date = $date->modify('-'. $nMonths .' month');
            
            return $date->format('Y-m-d');
        }

        public static function getNULLorId($o){
            if(!empty($o)){
                if(!empty($o->getId()))
                    return $o->getId();
            }

            return 'NULL';
        }

        public static function getIdOrNull($o){
            if(!empty($o)){
                if(!empty($o->getId()))
                    return $o->getId();
            }

            return null;
        }

        public static function getZeroIfNull($param){
            return (empty($param)) ? 0 : $param;
        }

        public static function getOneIfNullOrZero($param){
            return (empty($param)) ? 1 : $param;
        }

        public static function getTRUEorFALSE($b) {
            return ($b) ? "'true'" : "'false'";
        }

        public static function getZeroIfFalse($b) {
            return ($b) ? 1 : 0;
        }

        public static function getDateOrNULL($date) {
            return (empty($date)) ? 'NULL' : "'". $date ."'";
        }

        public static function getNullOrDate($date) {
            return (empty($date)) ? null : $date;
        }

        public static function getReais($valor) {
            if($valor === null)
                return $valor;

            $valor = round($valor, 2);

            return "R$ ". number_format($valor, 2, ',', '.');
        }

        public static function format($number) {
            if(empty($number))
                $number = 0;
                
            return number_format($number, 2, ',','.');
        }

        public static function subtrair($valor, $valor2) {
            $total = $valor - $valor2;
    
            return ($total < 0) ? $total * -1 : $total;
        }
    }
?>