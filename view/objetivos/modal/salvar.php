<div class="modal fade" id="cadastroModal" tabindex="-1" role="dialog" aria-labelledby="cadastroModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cadastroModalLabel">Cadastro</h5>    
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formCadObjetivo" action="objetivos/save.php">
                    <input type="hidden" name="id_usuario" value="<?php echo $usuario->getId(); ?>"/>
                    <div class="row">
                        <div class="col-md-5 text-left">
                            <label for="nome">Nome:</label>
                        </div>
                        <div class="col-md-7">
                            <input type="text" class="form-control" name="nome" id="nome" placeholder="Nome do objetivo">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5 text-left">
                            <label for="prioridade">Prioridade:</label>
                        </div>
                        <div class="col-md-7">
                            <input type="number" class="form-control" name="prioridade" id="prioridade" title="Informe a prioridade com relação aos demais objetivos" placeholder="Informe a prioridade com relação aos demais objetivos">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5 text-left">
                            <label for="data_realizacao">Data de realização:</label>
                        </div>
                        <div class="col-md-7">
                            <input type="date" class="form-control" name="data_realizacao" id="data_realizacao" title="Informe a data de realização" placeholder="Informe a data de realização">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5 text-left">
                            <label for="valor_total">Valor Total:</label>
                        </div>
                        <div class="col-md-7">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">R$</div>
                                </div>
                                <input type="number" class="form-control" name="valor_total" id="valor_total" title="Valor total para realizar seu objetivo" placeholder="Valor total para realizar seu ojetivo" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5 text-left">
                            <label for="saldo">Saldo atual:</label>
                        </div>
                        <div class="col-md-7">
                            <input type="number" class="form-control" name="saldo" id="saldo" title="Saldo atual" placeholder="Saldo atual">
                        </div>
                    </div>
                    <div class="row">
                        <div class="offset-md-5 col-md-7 text-center">
                            <input type="checkbox" name="concluido" id="concluido">
                            <label for="concluido"></label><span>Já está concluído</span></label>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <button id="btnSalvarObjetivo" onclick="save('#formCadObjetivo', event, 'objetivos/save.php');" class="btn btn-primary" data-dismiss="modal">
                                <span class="lnr lnr-checkmark-circle"></span>
                                Salvar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>