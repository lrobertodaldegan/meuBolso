<div class="modal fade" id="modalExcluirObjetivo" tabindex="-1" role="dialog" aria-labelledby="excModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="excModalLabel">Exclusão</h5>    
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <form id="formExcObjetivo" action="objetivos/del.php">
                        <input type="hidden" name="id" id="del_id_objetivo"/>
                        <input type="hidden" name="obj_type" id="obj_beneficio" value="objetivo"/>
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <p>
                                    Tem certeza que deseja excluir o objetivo?
                                    <br>
                                    <span>A ação não poderá ser desfeita!</span>
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <button id="btnExcluirBeneficios" onclick="del('#formExcObjetivo', event, 'objetivos/del.php');" data-dismiss="modal" class="btn btn-primary w-50">Sim, tenho certeza.</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>