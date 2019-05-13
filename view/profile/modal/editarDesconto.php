<div class="modal fade" id="modalEditarDesconto" tabindex="-1" role="dialog" aria-labelledby="cadastroModalLabelDsc" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cadastroModalLabelDsc">Cadastro</h5>    
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" onClick="resetarForm('#formEditDescontos');">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <form id="formEditDescontos" action="profile/editDesconto.php">
                        <input type="hidden" name="id_desconto" id="id_desconto"/>
                        <input type="hidden" name="id_usuario" id="edit_id_usuario_desconto" value="<?php echo $usuario->getId(); ?>"/>
                        <div class="row">
                            <div class="col-md-5 text-left">
                                <label for="categoria_desconto" id="lblCategoriaDesconto">Categoria: </label>
                            </div>
                            <div class="col-sm-7 text-center">
                                <select class="form-control" name="categoria_desconto" id="edit_categoria_desconto" onChange="habilitaInput('#edit_categoria_desconto','#nome_editar_desconto');">
                                    <option value="0">...</option>
                                    <?php if(!empty($categorias)) : ?>
                                        <?php foreach($categorias as $categoria) : ?>
                                            <option value="<?php echo $categoria->getId(); ?>"><?php echo $categoria->getDescricao(); ?></option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>
                        <div class="row" id="nome_editar_desconto">
                            <div class="col-md-5 text-left">
                                <label for="nome_desconto" id="lblNomeDesconto">Nome: </label>
                            </div>
                            <div class="col-sm-7 text-center">
                                <div class="input-group">
                                    <input class="form-control" type="text" name="nome_desconto" id="edit_nome_desconto" min="0" required/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5 text-left">
                                <label for="valor_desconto" id="lblValordesconto">Valor: </label>
                            </div>
                            <div class="col-sm-7 text-center">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">R$</div>
                                    </div>
                                    <input class="form-control" type="number" name="valor_desconto" id="edit_valor_desconto" min="0" required/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5 text-left">
                                <label for="porcentagem_desconto" id="lblPorcentagemDesconto">Porcentagem: </label>
                            </div>
                            <div class="col-md-7 text-center">
                                <div class="input-group">
                                    <input type="number" class="form-control" name="porcentagem_desconto" id="edit_porcentagem_desconto" min="0" required/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <button id="btnSalvarEditardescontos" onclick="save('#formEditDescontos', event, 'profile/editDesconto.php');" data-dismiss="modal" class="btn btn-primary w-50">Salvar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>