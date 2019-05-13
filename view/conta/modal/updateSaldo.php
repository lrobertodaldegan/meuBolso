<div class="modal fade" id="updateSaldo" tabindex="-1" role="dialog" aria-labelledby="edicaoModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edicaoModalLabel">Atualizar</h5>    
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formEditSaldo" action="conta/updSaldo.php">
                    <input type="hidden" name="id_usuario" value="<?php echo $usuario->getId(); ?>"/>
                    <div class="col-md-5 text-left">
                            <label for="saldo">Saldo atual:</label>
                        </div>
                        <div class="col-md-7">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">R$</div>
                                </div>
                                <input type="number" class="form-control" name="saldo" id="saldo" min="0.10" value="<?php echo $usuario->getSaldo(); ?>" placeholder="Valor do seu saldo" required>
                            </div>
                        </div>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <button id="btnSalvarConta" onclick="updateSaldo('#formEditSaldo', event, 'conta/updSaldo.php');" class="btn btn-primary" data-dismiss="modal">
                                Atualizar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>