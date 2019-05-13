<div id="page">
    <div id="conta">
        <div id="conta-list" style="margin-top:50px;"></div>
        <div id="contas-listAll">
            <div class="row">
                <div class="offset-md-1 col-md-10 text-right">
                    <a href="#contas" id="btnExibeAllContas" class="btn-link" onclick="exibeAllContas('#contas-listAll');">Ver todas</a>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(function(){
        list(1,"#conta-list", "/meuBolso/view/conta/list.php");
    });
</script>