<?php
    require_once "../../controller/HistoricoController.php";
    require_once "../../controller/UsuarioController.php";

    $controller = new HistoricoController();
    $uController = new UsuarioController();

    $usuario = $uController->getLogado();

    $eventos = $controller->getAllByUser($usuario->getId());

    if(empty($eventos)) :
?>
<div id="page">
    <div id="historico">
        <div class="row nadaEncontrado">
            <div class="col-sm-11 text-center">
                <p><?php echo MensagemEnum::NADA_ENCONTRADO; ?></p>
            </div>
        </div>  
    </div>
</div>

<?php else : ?>

<div id="page">
    <div id="historico">
        <div class="row">
            <div class="col-sm-11 text-center hdoisTitle" style="background:rgb(255,255,255,0.4);position:fixed;z-index:5;">
                <h2>Histórico</h2>
            </div>
        </div>
        <div class="row" style="margin-top:50px;">
            <div class="col-sm-11 historicoBlock">
                <?php foreach($eventos as $e) : ?>
                    <div class="evento">
                        <?php echo $controller->getEventDetails($e); ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<?php endif; ?>