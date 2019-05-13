<div class="modal fade" id="modalExcluirConta" tabindex="-1" role="dialog" aria-labelledby="excModalLabel" aria-hidden="true">
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
                    <form id="formExcConta" action="conta/del.php">
                        <input type="hidden" name="id" id="del_id_conta"/>
                        <input type="hidden" name="obj_type" id="obj_conta" value="conta"/>
                        <input type="hidden" name="id_pai" id="del_id_pai_conta"/>
                        <input type="hidden" name="vencimento" id="del_vencimento_conta"/>
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <p>
                                    Tem certeza que deseja excluir essa conta?
                                    <br>
                                    <span>
                                        A ação não poderá ser desfeita! 
                                        Se houverem contas vinculadas (parcelas) o valor total da conta poderá ser recalculado, 
                                        alterando a quantidade de parcelas.
                                    </span>
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <button id="btnExcluirConta" onclick="del('#formExcConta', event, 'conta/del.php');" data-dismiss="modal" class="btn btn-primary w-50">Sim, tenho certeza.</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>