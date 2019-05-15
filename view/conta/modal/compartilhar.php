<div class="modal fade" id="modalCompartilhar" tabindex="-1" role="dialog" aria-labelledby="compModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="compModalLabel">Compartilhar</h5>    
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formCompartilhar" action="conta/share.php">
                    <input type="hidden" name="id_owner" value="<?php echo $usuario->getId(); ?>"/>
                    <input type="hidden" id="id_conta" name="id_conta"/>
                    <div class="row" title="Nome ou login de quem vai ver sua conta de forma compartilhada">
                        <div class="col-md-12 text-left" style="line-height:30px;">
                            <label for="usuario">Compartilhar com:</label>
                        </div>
                    </div>
                    <div class="row" title="Nome ou login de quem vai ver sua conta de forma compartilhada">
                        <div class="col-md-12">
                            <div class="input-group">
                                <input type="text" class="form-control" name="usuario" id="usuario" onkeyup="setSharedUser('#usuario', '#id_usuario', '#nome_usuario');" placeholder="Nome ou login de quem vai ver sua conta de forma compartilhada" required>
                                <input type="hidden" id="id_usuario" name="id_usuario"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <input type="text" class="form-control" name="nome_usuario" id="nome_usuario" disabled/> 
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <button id="btnSalvarConta" onclick="compartilhar('#formCompartilhar', event, 'conta/share.php');" class="btn btn-primary">
                                Compartilhar
                            </button>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12 text-left">
                            <h5>Esta conta foi compartilhada com</h5>
                            <div id="listCompartilhado"></div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>