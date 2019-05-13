<?php
    require_once "../router.php";

    $usuario = $controller->getLogado();
?>
<html>
    <head>
        <meta charset="utf-8">  
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>MeuBolso - Sistema de Gestão Financeira</title>
        
        <link rel="shortcut icon" href="/meuBolso/view/public/img/logo.ico">
        <meta name="description" content="BiblioTech! Para facilitar sua leitura."/>
	    <meta name="keywords" content="livro, acervo, biblioteca, tecnologia, reserva, emprestimo, bibliotech, leitura, escola, estado, pais, cidade, cultura"/>
	    <meta name="author" content="Lucas Roberto http://lucasroberto.com"/>

	    <link href="/meuBolso/view/public/bootstrap/css/bootstrap.min.css" rel="stylesheet"/>
        <link href="/meuBolso/view/public/linearicons/linearicons.min.css" rel="stylesheet"/>
	    <link href="/meuBolso/view/public/css/app.css" rel="stylesheet"/>
	    <link href="/meuBolso/view/public/css/app_mobile.css" rel="stylesheet"/>
    </head>
    <body>
        <script src="/meuBolso/view/public/js/jquery.min.js"></script>
	    <script src="/meuBolso/view/public/js/app.js"></script>
	    <script src="/meuBolso/view/public/bootstrap/js/popper.min.js"></script>
	    <script src="/meuBolso/view/public/bootstrap/js/bootstrap.min.js"></script>
        <script src="/meuBolso/view/public/js/app.js"></script>
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
                <div class="perfil col-sm-1 text-center">
                    <h1 id="letraNome" class="text-center"><?php echo $usuario->getNome()[0];?></h1>
                    <a title="Editar perfil" onclick="load('profile/')">
                        <span class="lnr lnr-cog"></span> Configurar
                    </a>
                    <hr>
                </div>
            </div>
            <div class="row">
                <div class="menu col-sm-1" id="#menu">
                    <ul>
                        <li id="menu-home" title="Home" onclick="load('dash/');">
                            <a href="#home" title="Home">
                                <span class="lnr lnr-chart-bars"></span>
                            </a>
                        </li>
                        <li id="menu-contas" title="Gastos" onclick="load('conta/')">
                            <a href="#contas" title="Gastos">
                                <span class="lnr lnr-pushpin"></span>
                            </a>
                        </li>
                        <li id="menu-dinheiro" title="Orçamento" onclick="load('dinheiro/');">
                            <a href="#orcamento" title="Orçamento">
                                <span class="lnr lnr-calendar-full"></span>
                            </a>
                        </li>
                        <li id="menu-obj" title="Objetivos" onclick="load('objetivos/');">
                            <a href="#objetivo" title="Objetivos">
                                <span class="lnr lnr-gift"></span>
                            </a>
                        </li>
                        <li id="menu-hist" title="Histórico" onclick="load('historico/');">
                            <a href="#historico" title="Histórico">
                                <span class="lnr lnr-list"></span>
                            </a>
                        </li>
                        <li id="menu-familia" title="Compartilhado" onclick="load('compartilhado/');">
                            <a href="#compartilhado" title="Compartilhado">
                                <span class="lnr lnr-users"></span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div id="pages" class="offset-sm-2">
            </div>
        </div>
        <script>
            $(document).ready(load(null));
        </script>
    </body> 
</html>