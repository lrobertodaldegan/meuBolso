<?php require_once "load.php"; ?>
<div id="page">
    <div id="profile-view">
        <div class="row">
            <div class="col-sm-11">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="perfil-link" data-toggle="tab" href="#perfil" role="tab" aria-controls="perfil" aria-selected="true">Perfil</a>
                    </li>
                    <!--
                    <li class="nav-item">
                        <a class="nav-link" id="renda-link" data-toggle="tab" href="#renda" role="tab" aria-controls="renda" aria-selected="false" onclick="list(1,'#renda_beneficio', '/meuBolso/view/profile/listBeneficio.php');list(1,'#renda_desconto', '/meuBolso/view/profile/listDesconto.php');">Benefícios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="bug-link" data-toggle="tab" href="#bug" role="tab" aria-controls="bug" aria-selected="false">Relatar um problema ou sugestão</a>
                    </li>
                    -->
                    <li>
                        <a class="nav-link" id="log-out" data-toggle="tab" href="#logout" role="tab" aria-controls="logout" aria-selected="false">Sair</a>
                    </li>
                </ul>
                <div class="tab-content" id="conteudo">
                    <div class="tab-pane fade show active" id="perfil" role="tabpanel" aria-labelledby="perfil-link">
                        <!-- perfil -->
                        <div class="form-group"><form id="formPerfil">
                            <input type="hidden" name="id" id="id" value="<?php echo $usuario->getId(); ?>"/>
                            <div class="row">
                                <div class="offset-md-2 col-md-3 text-left">
                                    <label for="nome" id="lblNome">Meu nome é: </label>
                                </div>
                                <div class="col-sm-5 text-center">
                                    <input class="form-control" type="text" name="nome" id="nome" value="<?php echo $usuario->getNome(); ?>"/>
                                </div>
                            </div>
                            <div class="row">
                                <div class="offset-md-2 col-md-3 text-left">
                                    <label for="apelido" id="lblApelido">Pode me chamar de: </label>
                                </div>
                                <div class="col-sm-5 text-center">
                                    <input class="form-control" type="text" name="apelido" id="apelido" value="<?php echo $usuario->getApelido(); ?>"/>
                                </div>
                            </div>
                            <div class="row">
                                <div class="offset-md-2 col-md-3 text-left">
                                    <label for="login" id="lblLogin">Login: </label>
                                </div>
                                <div class="col-sm-5 text-center">
                                    <input class="form-control" type="text" name="login" id="login" value="<?php echo $usuario->getLogin(); ?>"/>
                                </div>
                            </div>
                            <div class="row">
                                <div class="offset-md-2 col-md-3 text-left">
                                    <label for="senha" id="lblSenha">Nova senha: </label>
                                </div>
                                <div class="col-sm-5 text-center">
                                    <input class="form-control" type="password" name="senha" id="senha" placeholder="Uma senha segura deve conter números e letras.">
                                    <small>Se você deixar este campo em branco, sua senha antiga será mantida.</small>
                                </div>
                            </div>
                            <div class="row">
                                <div class="offset-md-1 col-md-10">
                                    <hr>
                                </div>
                            </div>
                            <div class="row" title="Caso possua mais de uma fonte de renda, recomendamos que some todos os seus ganhos ao informar o valor aqui.">
                                <div class="offset-md-2 col-md-3 text-left">
                                    <label for="bruto" id="lblSalarioB">Renda total (líquido): </label>
                                </div>
                                <div class="col-md-5 text-center">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">R$</div>
                                        </div>
                                        <input class="form-control" type="number" name="renda" id="usuario_renda" value="<?php echo $usuario->getRenda(); ?>"/>
                                    </div>
                                </div>
                            </div>
                            <div class="row" title="Informe o dia de pagamento. Por mais que seja um campo de data, só o dia será levado em consideração.">
                                <div class="offset-md-2 col-md-3 text-left">
                                    <label for="dataPagamento" id="lblDtPagamento">Dia de Pagamento: </label>
                                </div>
                                <div class="col-sm-5 text-center">
                                    <input class="form-control" type="date" name="dataPagamento" id="dataPagamento" value="<?php echo $usuario->getDataPagamento(); ?>"/>
                                </div>
                            </div>
                            <div class="row">
                                <div class="offset-md-2 col-md-8 text-center">
                                    <button id="btnSalvarPerfil" onclick="save('#formPerfil', event, 'updPerfil.php');" class="btn btn-primary">Salvar</button>
                                </div>
                            </div>
                            <div class="row extraSpace">
                                <div class="offset-md-1 col-md-10">
                                    <hr>
                                </div>
                            </form></div>
                            <div class="row">
                                <div class="offset-md-2 col-md-8 text-center">
                                    <button id="btnExcluirPerfil" onclick="preDelete('<?php echo $usuario->getId(); ?>','#id_perfil_exclusao');" class="btn btn-outline-primary w-100" data-toggle="modal" data-target="#modalExcluirPerfil">Excluir conta</button>
                                    <br>
                                    <br>
                                    <small>Espero que esteja tudo bem! Respeitamos sua escolha &#128532;</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--
                    <div class="tab-pane fade" id="renda" role="tabpanel" aria-labelledby="renda-link">
                        <div id="renda_beneficio"></div>
                        <div id="renda_desconto"></div>
                    </div>
                    -->
                    <!-- recomendação -->
                    <!--
                    <div class="tab-pane fade" id="bug" role="tabpanel" aria-labelledby="bug-link">
                        <form id="formBug">
                            <h3>Bug <span class="lnr lnr-bug"></span></h3>
                            <hr>
                            <input class="form-control" type="hidden" name="nome_bug" id="nome_bug" value="<?php echo $usuario->getNome(); ?>"/>
                            <input class="form-control" type="hidden" name="email_bug" id="email_bug" value="<?php echo $usuario->getEmail(); ?>"/>
                            <div class="row">
                                <div class="offset-md-2 col-md-2 text-left">
                                    <label for="relato_bug" id="lblRelatoBug">O que aconteceu? </label>
                                </div>
                                <div class="col-sm-6 text-center">
                                    <textarea class="form-control bigInput" name="relato_t" id="relato_bug" cols="30" rows="10" required></textarea>
                                    <input type="hidden" name="relato" id="relato"/>
                                </div>
                            </div>
                            <div class="row">
                                <div class="offset-md-2 col-md-8 text-left">
                                    <button onclick="save('#formBug', event, 'profile/saveBug.php')" class="btn btn-primary w-100">Enviar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    -->
                    <div class="tab-pane fade" id="logout" role="tabpanel" aria-labelledby="log-out">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <form action="logout.php" method="post">
                                    <button class="btn btn-primary"><span class="lnr lnr-exit"></span> Sair</button>
                                    <br>
                                    <br>
                                    <small>
                                        Até logo! Sentiremos a sua falta!
                                        &#128533;
                                    </small>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        </div> 
    </div> 
</div>
<?php
    require_once "modal/excluirPerfil.php";
    require_once "modal/salvarBeneficio.php";
    require_once "modal/editarBeneficio.php";
    require_once "modal/excluirBeneficio.php";
    require_once "modal/salvarDesconto.php";
    require_once "modal/excluirDesconto.php";
    require_once "modal/editarDesconto.php";
?>