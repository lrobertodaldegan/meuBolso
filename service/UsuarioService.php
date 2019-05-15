<?php
    require_once "Service.php";
    require_once $_SERVER['DOCUMENT_ROOT'] ."/meuBolso/dao/UsuarioDAO.php";
    // require_once $_SERVER['DOCUMENT_ROOT'] ."/meuBolso/model/Usuario.php";

    class UsuarioService extends Service{
        function __construct(){
            parent::setDao(new UsuarioDAO());
        }

        public function buscarPorLogin($login){
            if(empty($login))
                return null;

            return $this->dePara(parent::getDao()->buscarPorLogin($login));
        }

        public function getAll(){
            $resultados = parent::getDao()->getAll();

            if(empty($resultados))
                return null;
            
            $usuarios = [];

            foreach($resultados as $r){
                array_push($usuarios, $this->dePara($r));
            }

            return $usuarios;
        }

        public function get($id = null){
            if(!empty($id))
                return $this->dePara(parent::get($id));

            return null;
        }

        public function dePara($r){
            $us = new Usuario();

            if(empty($r))
                return null;

            $r = (object) $r;

            if(!empty($r->id)){
                $us->setId($r->id);
                $us->setSenha($r->senha, false);
            }else{
                $us->setId('NULL');
                $us->setSenha($r->senha, true);
            }

            $us->setNome($r->nome);
            $us->setLogin($r->login);
            $us->setEmail($r->email);
            $us->setApelido($r->apelido);

            $us->setRenda($r->renda);
            $us->setDataPagamento($r->data_pagamento);

            $us->setSaldo($r->saldo);

            return $us;
        }

        public function save($obj){
            return parent::save($obj);
        }

        public function getByIdNameLoginOrEmail($text) {
            return $this->dePara(parent::getDao()->getByIdNameLoginOrEmail($text));
        }
        
    }
?>