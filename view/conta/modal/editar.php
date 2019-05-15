<div class="modal fade" id="modalEditarConta" tabindex="-1" role="dialog" aria-labelledby="edicaoModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edicaoModalLabel">Edição</h5>    
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formEditConta" action="dinheiro/upd.php">
                    <input type="hidden" name="id" id="edit_id_conta"/>
                    <input type="hidden" name="id_pai" id="edit_id_pai"/>
                    <input type="hidden" name="atualizado_por" value="<?php echo $usuario->getId(); ?>"/>
                    <input type="hidden" name="id_usuario" value="<?php echo $usuario->getId(); ?>"/>
                    <div class="row">
                        <div class="col-md-5 text-left">
                            <label for="descricao">Conta:</label>
                        </div>
                        <div class="col-md-7">
                            <input type="text" class="form-control" name="descricao" id="edit_nome" placeholder="Descrição breve">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5 text-left">
                            <label for="id_categoria" id="lblCategoriaConta">Categoria: </label>
                        </div>
                        <div class="col-sm-7 text-center">
                            <select class="form-control" name="id_categoria" id="edit_id_categoria">
                                <option value="0">...</option>
                                <?php if(!empty($categorias)) : ?>
                                    <?php foreach($categorias as $categoria) : ?>
                                        <option value="<?php echo $categoria->getId(); ?>"><?php echo $categoria->getNome(); ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5 text-left">
                            <label for="id_tipo" id="lblTipoConta">Tipo: </label>
                        </div>
                        <div class="col-sm-7 text-center">
                            <select class="form-control" name="id_tipo" id="edit_id_tipo">
                                <option value="0">...</option>
                                <?php if(!empty($tipos)) : ?>
                                    <?php foreach($tipos as $tipo) : ?>
                                        <option value="<?php echo $tipo->getId(); ?>"><?php echo $tipo->getNome(); ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>
                    <div class="row" title="Informe a data do primeiro vencimento">
                        <div class="col-md-5 text-left">
                            <label for="vencimento">Vence em:</label>
                        </div>
                        <div class="col-md-7">
                            <input type="date" class="form-control" name="vencimento" id="edit_vencimento" title="Informe a primeira data de vencimento" placeholder="Informe a data de vencimento" value="<?php echo date('Y-m-d'); ?>" required>
                        </div>
                    </div>
                    <div class="row" title="Informe o total da compra. Ex.: Se comprou R$ 400,00 em 2x, informe 400.">
                        <div class="col-md-5 text-left">
                            <label for="valor">Valor Total:</label>
                        </div>
                        <div class="col-md-7">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">R$</div>
                                </div>
                                <input type="number" class="form-control" name="valor" id="edit_valor" min="0.10" title="Valor total da conta" placeholder="Valor total da conta" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5 text-left">
                            <label for="parcelas"># Parcelas:</label>
                        </div>
                        <div class="col-md-7">
                            <input type="number" class="form-control" name="parcelas" id="edit_parcelas" title="Informe o número de parcelas" placeholder="Informe o número de parcelas" min="1" value="1">
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <button id="btnSalvarEditObjetivo" onclick="save('#formEditConta', event, 'conta/upd.php');" class="btn btn-primary" data-dismiss="modal">
                                <span class="lnr lnr-checkmark-circle"></span>
                                Atualizar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>