<?php
    require_once "redirectIfExists.php";
?>
<!-- login -->
<html>
    <head>
        <!-- <meta charset="utf-8">   -->
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Bem vindo ao seu Bolso! - Login</title>
        
        <link rel="shortcut icon" href="/meuBolso/view/public/img/logo.ico">
        <meta name="description" content="MeuBolso - Gestão financeira simplificada pra você!"/>
	    <meta name="keywords" content="financas, dinheiro, facil, agil, easy, money, bolso, pocket, economia, beneficios, tempo, cultura"/>
	    <meta name="author" content="Lucas Roberto http://lucasroberto.com"/>

	    <link href="/meuBolso/view/public/bootstrap/css/bootstrap.min.css" rel="stylesheet"/>
        <link href="/meuBolso/view/public/linearicons/linearicons.min.css" rel="stylesheet"/>
	    <link href="/meuBolso/view/public/css/app.css" rel="stylesheet"/>
	    <link href="/meuBolso/view/public/css/app_mobile.css" rel="stylesheet"/>
    </head>
    <body>
        <div class="container-fluid">
            <?php if(isset($_SESSION[ParametrosEnum::MENSAGEM])) : ?>
                <div class="row" style="position:fixed;top:5;z-index=10">
                    <div class="col-md-12">
                        <?php
                            $s = $_SESSION[ParametrosEnum::MENSAGEM];

                            echo "<div class='". $s[MensagemEnum::CLASSE] ."' role='alert'>";
                            echo $s[MensagemEnum::MENSAGEM];

                            unset($_SESSION[ParametrosEnum::MENSAGEM]);
                        ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <div class="row">
                <div class="col-sm-4 offset-sm-4">
                    <div class="login">
                        <p>Já tenho login:</p>
                        <form action="login.php" method="post">
                            <div class="form-group">
                                <label for="login">Login</label><br>
                                <input type="text" class="form-control" name="login" id="login" name="login" placeholder="Informe seu login aqui">
                            </div>
                            <div class="form-group">
                                <label for="senha">Senha:</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                    <div class="input-group-text" id="verSenha">
                                        <span class="lnr lnr-eye"></span>
                                    </div>
                                </div>
                                <input type="password" class="form-control" name="senha" id="senha" name="senha" placeholder="Informe a sua senha aqui">
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="lembrarLogin" id="lembrarLogin">
                                <label for="lembrarLogin"><span>Lembre meus dados no próximo login</span></label>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-outline-primary">
                                    <span class="lnr lnr-enter"></span>
                                    Entrar
                                </button>
                            </div>
                        </form>
                        <hr>    
                        <p>Sou novo aqui:</p>
                        <div class="text-center">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#cadastroModal">
                                <span class="lnr lnr-license"></span>
                                Cadastre-se
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="cadastroModal" tabindex="-1" role="dialog" aria-labelledby="cadastroModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="cadastroModalLabel">Cadastro</h5>    
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="cadastro.php" method="post">
                            <div class="form-group">
                                <label for="nome">Nome:</label>
                                <input type="text" class="form-control" name="nome" id="nome" placeholder="Seu nome aqui" required>
                            </div>
                            <!--<div class="form-group">
                                <label for="apelido">(Opcional) Quero ser chamado de:</label>
                                <input type="text" class="form-control" name="apelido" id="apelido" placeholder="Com quer ser chamado?">
                            </div> -->
                            <div class="form-group">
                                <label for="login">Login:</label>
                                <input type="text" class="form-control" name="login" id="login_" placeholder="Seu novo login aqui" required>
                            </div>
                            <div class="form-group">
                                <label for="senha">Senha:</label>
                                <input type="password" class="form-control" name="senha" id="senha_" placeholder="Sua nova senha aqui" required>
                            </div>
                            <div class="form-group">
                                <label for="email">(Opcional) E-mail:</label>
                                <input type="text" class="form-control" name="email" id="email" placeholder="Seu e-mail aqui">
                            </div>
                            <!--<div class="form-group">
                                <input type="checkbox" name="lembrarLogin" id="lembrarLogin_">
                                <label for="lembrarLogin"></label><span>Lembre meus dados no próximo login</span></label>
                            </div> -->
                            <hr>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">
                                    <span class="lnr lnr-checkmark-circle"></span>
                                    Salvar e Continuar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script src="/meuBolso/view/public/js/jquery.min.js"></script>
	    <script src="/meuBolso/view/public/js/app.js"></script>
	    <script src="/meuBolso/view/public/bootstrap/js/popper.min.js"></script>
	    <script src="/meuBolso/view/public/bootstrap/js/bootstrap.min.js"></script>
    </body>
</html>