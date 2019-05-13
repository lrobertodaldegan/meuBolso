<div class="modal fade" id="infoModalO" tabindex="-1" role="dialog" aria-labelledby="infModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="infModalLabel">Informação</h5>    
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <div class="row" style="height:30px;">
                        <div class="offset-md-1 col-md-3 text-left">
                            <span>Objetivo: </span>
                        </div>
                        <div class="col-md-4 text-left">
                            <span id="info_nome"></span>
                        </div>
                    </div>
                    <div class="row" style="height:30px;">
                        <div class="offset-md-1 col-md-3 text-left">
                            <span>Cadastrado em: </span>
                        </div>
                        <div class="col-md-3 text-left">
                            <span id="info_data_cadastro"></span>
                        </div>
                        <div class="col-md-5 text-left">
                            <span>Porcentagem de conclusão do objetivo:</span>
                        </div>
                    </div>
                    <div class="row" style="height:30px;">
                        <div class="offset-md-1 col-md-3 text-left">
                            <span>Se realizará em: </span>
                        </div>
                        <div class="col-md-3 text-left">
                            <span id="info_data_realizacao"></span>
                        </div>
                        <div class="offset-md-1 col-md-3 text-center" title="Percentual de conclusão do objetivo (por saldo)">
                            <div class="progress">
                                <div id="progressBar" class="progress-bar progress-bar-striped progress-bar-animated bg-info" role="progressbar" 
                                    aria-valuemin="0" aria-valuemax="100">
                                    <b id="progressBarIn" style="font-size:16px;"></b>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="height:30px;">
                        <div class="offset-md-1 col-md-3 text-left">
                            <span>Valor total: </span>
                        </div>
                        <div class="col-md-4 text-left">
                            <span id="info_valor_total"></span>
                        </div>
                    </div>
                    <div class="row" style="height:30px;">
                        <div class="offset-md-1 col-md-3 text-left">
                            <span>Saldo: </span>
                        </div>
                        <div class="col-md-4 text-left">
                            <span id="info_saldo"></span>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6 text-left">
                            <span>Economize: </span>
                        </div>
                    </div>
                    <div class="row" style="margin-top:20px;">
                        <div class="col-md-3 text-center saldo" style="margin-left:4%;">
                            <span id="porDia"></span>
                            <br>
                            <span><b>Por dia</b></span>
                        </div>
                        <div class="offset-md-1 col-md-3 text-center contas contas-pagas">
                            <span id="porSemana"></span>
                            <br>
                            <span><b>Por semana</b></span>
                        </div>
                        <div class="offset-md-1 col-md-3 text-center contas contas-total">
                            <span id="porMes"></span>
                            <br>
                            <span><b>Por mês</b></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>