<?php
    class Controller {
        private $service;
        
        public function get($id = null){
            if(empty($id) || $id == 0)
                return null;

            return $this->service->get($id);
        }

        public function getAll(){
            return $this->getService()->getAll();
        }

        public function getAllByUser($uId){
            return $this->getService()->getAllByUser($uId);
        }

        public function getPages(){
            return $this->getService()->countPages();
        }

        public function getPagesByUser($uId){
            return $this->getService()->countPagesByUser($uId);
        }

        public function listPaginated($page, $limit){
            $limit = 5;
            $page = $page -1;

            return $this->getService()->listPaginated($page, $limit);
        }

        public function listPaginatedByUser($page, $limit, $user){
            $limit = 5;
            $page = $page -1;

            return $this->getService()->listPaginatedByUser($page, $limit, $user->getId());
        }

        public function getService(){
            return $this->service;
        }

        public function setService($service){
            $this->service = $service;
        }

        public function save($obj){
            if($this->getService()->save($obj)){
                // $mensagem = MensagemEnum::SUCESSO_GENERICO;
                // $classe = MensagemEnum::CLASSE_SUCESSO;
                // $tipo = MensagemEnum::SUCESSO;
                $b = true;
            }else{
                // $mensagem = MensagemEnum::ERRO_GENERICO;
                // $classe = MensagemEnum::CLASSE_ERRO;
                // $tipo = MensagemEnum::ERRO;
                $b = false;
            }

            // session_start();

            // $_SESSION[ParametrosEnum::MENSAGEM] = [
            //     MensagemEnum::TIPO => $tipo,
            //     MensagemEnum::CLASSE => $classe,
            //     MensagemEnum::MENSAGEM => $mensagem,
            // ];

            return $b;
        }

        public function delete($id){
            return $this->getService()->delete($id);
        }

        public function parseData($data, $USToBR){
            if($USToBR)
                return $data[8] . $data[9] ."/". $data[5] . $data[6] ."/". $data[0].$data[1].$data[2].$data[3];
    
            return $data[6] . $data[7] . $data[8] . $data[9] ."-". $data[3] . $data[4] ."-". $data[0] . $data[1];
        }
    }
?>