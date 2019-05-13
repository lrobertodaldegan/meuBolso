<?php
    require_once "Service.php";
    require_once $_SERVER['DOCUMENT_ROOT'] ."/meuBolso/dao/CategoriaDAO.php";
    require_once $_SERVER['DOCUMENT_ROOT'] ."/meuBolso/controller/UsuarioController.php";

    class CategoriaService extends Service {
        function __construct(){
            parent::setDao(new CategoriaDAO());
        }

        public function get($id){
            return $this->dePara(parent::get($id));
        }

        public function getAll() {
            $categorias = [];

            foreach(parent::getAll() as $r){
                array_push($categorias, $this->dePara($r));
            }

            return $categorias;
        }

        public function dePara($r){
            $categoria = new Categoria();

            $r = (object) $r;

            $categoria->setId($r->id);
            $categoria->setNome($r->nome);
            $categoria->setCriadoEm($r->criado_em);

            $uController = new UsuarioController();

            $categoria->setCriadoPor($uController->get($r->criado_por));

            return $categoria;
        }
    }
?>