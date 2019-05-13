<div id="page">
    <div id="dinheiro">
        <div class="row">
            <div class="col-sm-11">
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-5 text-right">
                            <label for="data" id="lblFiltroData">Selecione uma data para o filtro: </label>
                        </div>
                        <div class="col-sm-3 text-left">
                            <input class="form-control" type="date" name="data" id="data" value="<?php echo date('Y-m-d'); ?>">
                        </div>
                        <div class="col-sm-4 text-left">
                            <button id="btnCalcular" onclick="calcularDinheiroPorData($('#data').val(), 1);" class="btn btn-primary">Calcular</button>
                        </div>
                    </div>
                </div>
                <hr>
            </div>
        </div>
        <div id="calculado"></div>
    </div>
</div>
<script>
    $(document).ready(calcularDinheiroPorData($('#data').val(), 1));
</script>