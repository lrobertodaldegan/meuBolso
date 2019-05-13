<?php
    class Service {
        private $dao;

        public function getDao(){
            return $this->dao;
        }

        public function setDao($dao){
            $this->dao = $dao;
        }

        public function get($id){
            return $this->getDao()->get($id);
        }

        public function getAll(){          
            return $this->getDao()->getAll();
        }

        public function getAllByUser($uId){
            return $this->getDao()->getAllByUser($uId);
        }

        public function countPages(){
            $pages =[];
            
            $total = $this->getDao()->count()->p;

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

        public function listPaginated($pg, $limit){
            return $this->getDao()->listPaginated($pg, $limit);
        }

        public function listPaginatedByUser($pg, $limit, $userId){
            return $this->getDao()->listPaginatedByUser($pg, $limit, $userId);
        }

        public function save($obj){
            if(!empty($obj)){
                if(empty($obj->getId()))
                    return $this->getDao()->save($obj);
                
                return $this->getDao()->update($obj);
            }

            return false;
        }

        public function delete($id){
            return $this->dao->delete($id);
        }

        public function treatDate($d){
            if(!empty($d))
                return date('d/m/Y', strtotime($d));
            
            return null;
        }
    }
?>