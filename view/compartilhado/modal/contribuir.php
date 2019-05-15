<div class="modal fade" id="contribuirModal" tabindex="-1" role="dialog" aria-labelledby="contribuirModalLbl" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="contribuirModalLbl">Contribuir</h5>    
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formContribuir" action="compartilhado/contrib.php">
                    <input type="hidden" name="atualizado_por" value="<?php echo $usuario->getId(); ?>"/>
                    <input type="hidden" id="saldo_original" name="saldo_original"/>
                    <input type="hidden" id="valor" name="valor"/>
                    <input type="hidden" id="id" name="id"/>
                        <div class="offset-md-3 col-md-7 left">
                            <div class="input-group">
                                <label for="saldo">Valor: </label>
                                <div class="input-group-prepend">
                                    <div class="input-group-text">R$</div>
                                </div>
                                <input type="number" class="form-control" name="saldo" id="saldo" min="0.10" placeholder="Informe o valor da sua contribuição" required>
                            </div>
                        </div>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <button id="btnSalvarConta" onclick="contribuir('#formContribuir', event, 'compartilhado/contrib.php');" class="btn btn-primary" data-dismiss="modal">
                                Contribuir
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $('#saldo').on('change', function(){
        if($('#saldo').val() >= $('#saldo_original').val())
            $('#btnSalvarConta').prop('disabled', false);
    });
</script>