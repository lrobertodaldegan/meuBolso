<div class="modal fade" id="modalEditarBeneficio" tabindex="-1" role="dialog" aria-labelledby="cadastroModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cadastroModalLabel">Cadastro</h5>    
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" onClick="resetarForm('#formEditBeneficios');">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <form id="formEditBeneficios" action="profile/editBeneficio.php">
                        <input type="hidden" name="id_beneficio" id="id_beneficio"/>
                        <input type="hidden" name="id_usuario" id="edit_id_usuario_beneficio" value="<?php echo $usuario->getId(); ?>"/>
                        <div class="row">
                            <div class="col-md-5 text-left">
                                <label for="categoria_beneficio" id="lblCategoriaBeneficio">Categoria: </label>
                            </div>
                            <div class="col-sm-7 text-center">
                                <select class="form-control" name="categoria_beneficio" id="edit_categoria_beneficio" onChange="habilitaInput('#edit_categoria_beneficio', '#nome_editar_beneficio');">
                                    <option value="0">...</option>
                                    <?php if(!empty($categorias)) : ?>
                                        <?php foreach($categorias as $categoria) : ?>
                                            <option value="<?php echo $categoria->getId(); ?>"><?php echo $categoria->getNome(); ?></option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>
                        <div class="row" id="nome_editar_beneficio">
                            <div class="col-md-5 text-left">
                                <label for="nome_beneficio" id="lblNomeBeneficio">Nome: </label>
                            </div>
                            <div class="col-sm-7 text-center">
                                <div class="input-group">
                                    <input class="form-control" type="text" name="nome_beneficio" id="edit_nome_beneficio"/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5 text-left">
                                <label for="valor_beneficio" id="lblValorBeneficio">Valor: </label>
                            </div>
                            <div class="col-sm-7 text-center">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">R$</div>
                                    </div>
                                    <input class="form-control" type="number" name="valor_beneficio" id="edit_valor_beneficio" min="0" required/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5 text-left">
                                <label for="tipo_beneficio" id="lblTipoBeneficio">Tipo (se semanal, mensal...): </label>
                            </div>
                            <div class="col-sm-7 text-center">
                                <select class="form-control" name="tipo_beneficio" id="edit_tipo_beneficio" onChange="habilitaInput('#tipo_beneficio','#dt_editar_beneficio');">
                                    <option value="0">...</option>
                                    <?php if(!empty($tipos)) : ?>
                                        <?php foreach($tipos as $tipo) : ?>
                                            <option value="<?php echo $tipo->getId(); ?>"><?php echo $tipo->getNome(); ?></option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>
                        <div class="row" id="dt_editar_beneficio">
                            <div class="col-md-5 text-left">
                                <label for="dt_beneficio" id="lblDtBeneficio">Data de crédito: </label>
                            </div>
                            <div class="col-sm-7">
                                <input class="form-control" type="date" name="dt_beneficio" id="edit_dt_beneficio"/>
                                <small>Quando o benefício estará disponível.</small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <button id="btnSalvarEditarBeneficios" onclick="save('#formEditBeneficios', event, 'profile/editBeneficio.php');" data-dismiss="modal" class="btn btn-primary w-50">Salvar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>