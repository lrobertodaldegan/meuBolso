<?php
    require_once "Controller.php";
    require_once "HistoricoController.php";
    require_once $_SERVER['DOCUMENT_ROOT'] ."/meuBolso/service/UsuarioService.php";
    require_once $_SERVER['DOCUMENT_ROOT'] ."/meuBolso/model/ParametrosEnum.php";
    require_once $_SERVER['DOCUMENT_ROOT'] ."/meuBolso/model/MensagemEnum.php";
    require_once $_SERVER['DOCUMENT_ROOT'] ."/meuBolso/model/Util.php";

    class UsuarioController extends Controller{
        private $usuario = null;

        function __construct(){
            parent::setService(new UsuarioService());
        }

        public function buscarPorLogin($login){
            return parent::getService()->buscarPorLogin($login);
        }

        public function getLogado(){
            if(isset($_COOKIE[ParametrosEnum::USUARIO])){
                $this->usuario = $this->buscarPorLogin($_COOKIE[ParametrosEnum::USUARIO]);
                $token = $_COOKIE[ParametrosEnum::TOKEN];
            }else{
                if(!isset($_SESSION))
                    session_start();
                
                if(isset($_SESSION[ParametrosEnum::USUARIO])){ 
                    $this->usuario = $this->buscarPorLogin($_SESSION[ParametrosEnum::USUARIO]);
                    $token = $_SESSION[ParametrosEnum::TOKEN];
                }
            }

            if(!empty($this->usuario)){
                if(password_verify($this->getToken(false, $this->usuario), $token))
                    return $this->usuario;
            }

            return null;
        }

        public function getByIdNameLoginOrEmail($text) {
            if(empty($text))
                return null;

            return parent::getService()->getByIdNameLoginOrEmail($text);
        }

        public function updateSaldoPorContribuicao($contribValor, $uId) {
            if(empty($contribValor) || empty($uId))
                return false;

            $user = parent::get($uId);

            $saldoAtualizado = (float) ($user->getSaldo() - $contribValor);

            $user->setSaldo($saldoAtualizado);

            return parent::save($user);
        }

        public function updateSaldoManualmente($req) {
            if(empty($req['saldo']))
                return false;

            $usuario = $this->getLogado();

            $usuario->setSaldo($req['saldo']);

            return parent::save($usuario);
        }

        public function updateSaldo($usuario) {
            //atualiza o saldo de acordo com a data de pagamento salva, se necessário
            $hoje = date('Y-m-d');

            $diaPagamento = Util::getDay($usuario->getDataPagamento(), true);

            $hController = new HistoricoController();
            $ultimoLogin = $hController->getLastLoginEvent($usuario->getId())->getData();

            $diferenca = Util::getMonthlyDiff($hoje, $ultimoLogin);
            
            if($diferenca > 0) { // se houve "troca" de mês
                if($diaPagamento <= Util::getDay($hoje) || Util::getDay($ultimoLogin, true) < $diaPagamento) {

                    $saldo = $usuario->getSaldo();

                    for($i=0; $i < $diferenca; $i++) {
                        $saldo += $usuario->getRenda();
                    }

                    $usuario->setSaldo($saldo);

                    return parent::save($usuario);
                }
            }

            return false;
        }

        public function logar($req){
            if(!empty($req)){
                if(isset($req[ParametrosEnum::LOGIN])){
                    $this->usuario = $this->buscarPorLogin($req[ParametrosEnum::LOGIN]);
                    
                    if(!empty($this->usuario) && password_verify($req[ParametrosEnum::SENHA], $this->usuario->getSenha())){                
                        //verificar se o saldo deve ser atualizado com a data de pagamento da renda
                        $this->updateSaldo($this->usuario);

                        //salvar registro do evento
                        $hController = new HistoricoController();
                        $hController->salvarEventoAcesso($this->usuario);

                        //salvar dados na sessão se encontrar o usuario
                        if(isset($req[ParametrosEnum::LEMBRAR_LOGIN])){
                            $dias = time() + ParametrosEnum::TRINTA_DIAS; //expira em 30 dias
        
                            setcookie(ParametrosEnum::USUARIO, $this->usuario->getLogin(), $dias);
                            setcookie(ParametrosEnum::TOKEN, $this->getToken(true, $this->usuario));
                        }else{
                            session_start();
        
                            $_SESSION[ParametrosEnum::USUARIO] = $this->usuario->getLogin();
                            $_SESSION[ParametrosEnum::TOKEN]   = $this->getToken(true, $this->usuario);
                        }
                    }else{
                        session_start();
        
                        $_SESSION[ParametrosEnum::MENSAGEM] = [
                            MensagemEnum::MENSAGEM => MensagemEnum::USUARIO_N_ENCONTRADO,
                            MensagemEnum::TIPO     => MensagemEnum::ERRO,
                            MensagemEnum::CLASSE   => MensagemEnum::CLASSE_ERRO
                        ];
                    }
                }
            }

            header("Location: /meuBolso/view/");
            die();
        }

        public function logout(){
            //limpa  sessao e a verifica redirecionando o usuario
            session_start();
            session_destroy();
            session_unset();

            $this->redirecionaSeNaoLogado();
        }

        public function getToken($hash, $user){
            $key = $user->getLogin() ."-". $user->getSenha();

            if($hash)
                return password_hash($key, PASSWORD_DEFAULT);

            return $key;
        }

        public function redirecionaSeNaoLogado(){
            if(!isset($_COOKIE['meuBolso_usuario'])){ //sem usuario na secao
                session_start();

                if(!isset($_SESSION['meuBolso_usuario'])){ 
                    header('Location: /meuBolso/'); //goto login
                    die();
                }
            }
        }

        public function redirecionaSeSalvoExistir(){
            if(isset($_COOKIE[ParametrosEnum::USUARIO])){
                $this->usuario = $this->buscarPorLogin($_COOKIE[ParametrosEnum::USUARIO]);
                $token = $_COOKIE[ParametrosEnum::TOKEN];
            }else{
                session_start();
                if(isset($_SESSION[ParametrosEnum::USUARIO])){ 
                    $this->usuario = $this->buscarPorLogin($_SESSION[ParametrosEnum::USUARIO]);
                    $token = $_SESSION[ParametrosEnum::TOKEN];
                }
            }

            if(!empty($this->usuario)){
                if(password_verify($this->getToken(false, $this->usuario), $token)){
                    header("Location: /meuBolso/view/");
                    die();
                }
            }
        }

        public function update($req) {
            $u = new Usuario();

            $req = (object) $req;

            $u->setId($req->id);
            $u->setNome($req->nome);
            $u->setApelido($req->apelido);
            $u->setLogin($req->login);

            if(isset($req->senha))
                $u->setSenha($req->senha, true);
            
            if(isset($req->usuario_renda))
                $u->setRenda($req->usuario_renda);
            
            if(isset($req->dataPagamento))
                $u->setDataPagamento($req->dataPagamento);

            if(isset($req->saldo))
                $u->setSaldo($req->saldo);

            if(!empty($req->email))
                $u->setEmail($req->email);

            return parent::save($u);
        }

        public function save($req){
            $u = new Usuario();

            $u->setId($req['id']);
            $u->setNome($req[ParametrosEnum::NOME]);
            $u->setApelido($req[ParametrosEnum::APELIDO]);
            $u->setLogin($req[ParametrosEnum::LOGIN]);
            $u->setSenha($req[ParametrosEnum::SENHA], true);
            $u->setRenda($req['usuario_renda']);
            $u->setDataPagamento($req['dataPagamento']);

            if(isset($req['saldo']))
                $u->setSaldo($req['saldo']);
            else
                $u->setSaldo($u->getRenda());

            if(!empty($req[ParametrosEnum::EMAIL]))
                $u->setEmail($req[ParametrosEnum::EMAIL]);

            if(parent::save($u))
                $this->logar($req);

            header("Location: /meuBolso/");
            die();
        }

        public function delete($id){
            if(!empty($id))
                parent::delete($id);

            $this->logout();
        }


    }
?>