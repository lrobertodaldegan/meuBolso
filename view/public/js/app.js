function habilitaInput(idChanged, idToShowOrHide) {
    if(idChanged.includes("tipo")) {
        if($(idChanged).val() == 1)
            $(idToShowOrHide).css({"visibility":"visible"});
        else
            $(idToShowOrHide).css({"visibility":"hidden"});

    } else if(idChanged.includes("categoria")){
        if($(idChanged).val() == 7)
            $(idToShowOrHide).css({"visibility":"visible"});
        else
            $(idToShowOrHide).css({"visibility":"hidden"});
    }
}

function load(url){

    var endpoint = null;

    if(url == null || url == '') {
        if(location.href.includes('#contas'))
            endpoint = "conta/";

        if(location.href.includes('#historico'))
            endpoint = "historico/";

        if(location.href.includes('#home'))
            endpoint = "dash/";

        if(location.href.includes('#dinheiro'))
            endpoint = "dinheiro/";

        if(location.href.includes('#compartilhado'))
            endpoint = "compartilhado/";

        if(location.href.includes('#orcamento'))
            endpoint = "dinheiro/";

        if(location.href.includes('#objetivo'))
            endpoint = "objetivos/";
    }
        
    if(endpoint == null)
        endpoint = (url != '' && url != null) ? url : "dash/";

    $.ajax({
        type: "get",
        url: endpoint,
        success: function(resposta){
            $('#pages').empty();
            $('#pages').html(resposta);
            $('#page').css('opacity');
            $("#page").css({'opacity':'1'});
        }
    });

    $('.modal-backdrop').remove();
}

function resetarForm(form) {
    document.getElementById(form.replace('#','')).reset();//TODO MELHORAR
}

function pagarConta(idObj, urld, subListsTo, valor, saldo, atualizadorId) {
    $.ajax({
        type:"get",
        data:{
            "id":idObj,
            "valor":valor,
            "saldo":saldo,
            "atualizado_por":atualizadorId
        },
        url:urld,
        success: function(r) {
            console.log(r);

            if(urld == "conta/quickUpd.php")
                list(1, "#conta-list", "/meuBolso/view/conta/list.php");
            
            if(subListsTo)
                list(1, "#contas-listAll", "/meuBolso/view/conta/listAll.php");
        },
        error: function(e) {
            console.log(e);
        }
    });
}

function quickUpdate(idObj, isPaid, urld, subListsTo) {
    $.ajax({
        type:"get",
        data:{
            "id":idObj,
            "concluido":isPaid
        },
        url:urld,
        success: function(r) {
            console.log(r);
            if(urld == "objetivos/quickUpd.php")
                list(1, "#objetivos_list", "/meuBolso/view/objetivos/list.php");
        },
        error: function(e) {
            console.log(e);
        }
    });
}

function calcularDinheiroPorData(dt, pg){
    $.ajax({
        method:"get",
        data:{
            "data":dt,
            "page":pg,
            "limit":5
        },
        url:'/meuBolso/view/dinheiro/calc.php',
        success:function(resposta){
            $('#calculado').empty();
            $('#calculado').html(resposta);
        },
        error:function(e) {
            console.log(e);
        }
    });
}

function updateSaldo(form, event, urld){
    event.preventDefault();

    var formulario = $(form);
    var loadId = null;

    if(urld == 'dash/updSaldo.php')
        loadId = 'dash/';
    else
        loadId = 'conta/';

    $.ajax({
        type:"get",
        data:formulario.serialize(),
        url:'dash/updSaldo.php',
        success: function(r){
            console.log(r);

            load(loadId);
        },
        error: function(e){
            console.log("Erro: " + e);
        }
    });
}

function contribuir(idForm, evento, urld) {
    evento.preventDefault();

    var form = $(idForm);

    $.ajax({
        type:"get",
        data:form.serialize(),
        url:urld,
        success: function(r){
            console.log(r);

            load('compartilhado/');
        },
        error: function(e){
            console.log("Erro: " + e);
        }
    });

    resetarForm(idForm);
}

function save(idForm, evento, urld){
    evento.preventDefault();

    var form = $(idForm);
    var listId = null;
    var callListItens = null;

    if(urld == "profile/saveBeneficio.php" || urld == "profile/editBeneficio.php"){
        listId = "#renda_beneficio";
        callListItens = '/meuBolso/view/profile/listBeneficio.php';
    }

    if(urld == "profile/saveDesconto.php" || urld == "profile/editDesconto.php"){
        listId = "#renda_desconto";
        callListItens = "/meuBolso/view/profile/listDesconto.php";
    }

    if(urld == "objetivos/save.php" || urld == "objetivos/upd.php"){
        listId = "#objetivos_list";
        callListItens = "/meuBolso/view/objetivos/list.php";
    }

    if(urld == "conta/save.php" || urld == "conta/upd.php"){
        listId = "#conta-list";
        callListItens = "/meuBolso/view/conta/list.php";
    }

    $.ajax({
        type:"get",
        data:form.serialize(),
        url:urld,
        success: function(r){
            console.log(r);

            if(listId != null && callListItens != null)
                list(1,listId, callListItens);
        },
        error: function(e){
            console.log("Erro: " + e);
        }
    });

    resetarForm(idForm);
}

function preDelete(id, target){
    if(target == "#del_id_conta"){
        $.ajax({
            action:"get",
            data:{
                "id":id,
                "obj":"conta"
            },
            url:"buscar.php",
            success: function(r){
                r = JSON.parse(r);

                $(target).val(r.id);

                $('#del_vencimento_conta').val(r.vencimento);

                if(r.id_pai != null && r.id_pai > 0)
                    $('#del_id_pai_conta').val(r.id_pai);
            },
            error: function(e){
                console.log();
            }
        });
    } else {
        $(target).val(id);
    }
}

function del(formId, evento, urld){
    evento.preventDefault();

    var form = $(formId);
    var listId = null;
    var callListItens = null;

    if(urld == 'profile/delBeneficio.php'){
        listId = "#renda_beneficio";
        callListItens = '/meuBolso/view/profile/listBeneficio.php';
    }

    if(urld == 'profile/delDesconto.php'){
        listId = "#renda_desconto";
        callListItens = "/meuBolso/view/profile/listDesconto.php";
    }

    if(urld == "objetivos/del.php"){
        listId = "#objetivos_list";
        callListItens = "/meuBolso/view/objetivos/list.php";
    }

    if(urld == "conta/del.php"){
        listId = "#conta-list";
        callListItens = "/meuBolso/view/conta/list.php";
    }

    $.ajax({
        type:"get",
        data:form.serialize(),
        url: urld,
        success: function(r){
            console.log(r);
            if(list != null && callListItens != null){
                list(1,listId, callListItens);
            }
        },
        error: function(e){
            console.log(e);
        }
    });
}

function exibeAllContas(idTarget) {
    if(idTarget != null)
        list(1,idTarget, '/meuBolso/view/conta/listAll.php');
}

function list(pg, target, urld){
    $.ajax({
        action:"get",
        data:{
            "page":pg,
            "limit":5
        },
        url:urld,
        success:function(r){
            $(target).html(r);

            $('.modal-backdrop').remove();
        },
        error:function(e){
            console.log(e);
        }
    });
}

function habilita(id, sim) {
    $(id).prop("disabled",sim);
    $(id).val(0);
}

function setConta(objType, inputVal, isShared) {
    $.ajax({
        action:"get",
        data:{
            "id":inputVal,
            "obj":objType
        },
        url:"buscar.php",
        success: function(r){
            r = JSON.parse(r);

            if(!isShared) {//pagar / editar gasto
                $('#edit_id_conta').val(r.id);
                $('#edit_id_pai').val(r.id_pai);
                $('#edit_nome').val(r.descricao);
                $('#edit_valor').val(r.valor_total.replace(',','.'));
                $('#edit_parcelas').val(r.parcelas_total);
                $('#edit_pago').prop("checked", r.pago);

                if(r.vencimento !== null && r.vencimento != "'0000-00-00'" && r.vencimento != "0000-00-00"){
                    $('#edit_vencimento').val(r.vencimento.replace(new RegExp("'", 'g'),''));   
                }

                if(r.categoria !== null){
                    if(r.categoria.id !== null)
                        $('#edit_id_categoria').append("<option value='"+ r.categoria.id +"' selected>"+ r.categoria.nome + "</option>");
                }

                if(r.tipo !== null){
                    if(r.tipo.id !== null)
                        $('#edit_id_tipo').append("<option value='"+ r.tipo.id +"' selected>"+ r.tipo.nome + "</option>");
                }
            } else {//contribuir compartilhado
                $('#id').val(r.id);

                if(typeof r.saldo != 'undefined' && r.saldo > 0 && r.saldo != r.valor) {
                    $('#saldo').val(r.saldo);
                    $('#saldo_original').val(r.saldo);
                    $('#valor').val(r.valor);
                } else {
                    $('#valor').val(r.valor);
                    $('#saldo').val(r.valor);
                    $('#saldo_original').val(0);
                }

                if($('#saldo').val() >= $('#saldo_original').val())
                    $('#btnSalvarConta').prop('disabled', false);
                else
                    $('#btnSalvarConta').prop('disabled', true);
            }
        },
        error: function(e){
            console.log(e);
        }
    });
}

function setSharedUser(input, targetId, addTargetId) {
    $.ajax({
        action:"get",
        data:{
            "id":$(input).val(),
            "obj":'usuario'
        },
        url:"buscar.php",
        success: function(r){
            if(r != null && r != 'undefined' && r != '') {
                r = JSON.parse(r);

                $(targetId).val(r.id);
                $(addTargetId).val(r.nome);
                $(addTargetId).prop('disabled', true);
            }
        },
        error: function(e){
            console.log(e);
        }
    });
}

function setCompartilhar(objType, inputVal) {
    $('#id_conta').val(inputVal);

    loadSharedTable(inputVal);
}

function compartilhar(idForm, event, urlD) {
    event.preventDefault();

    var form = $(idForm);

    $.ajax({
        type:"get",
        data:form.serialize(),
        url:urlD,
        success: function(r){
            console.log(r);

            loadSharedTable(r);
        },
        error: function(e){
            console.log("Erro: " + e);
        }
    });

    resetarForm(idForm);
}

function unShare(id) {
    $.ajax({
        type:"get",
        data:{
            "id":id
        },
        url:"conta/unShare.php",
        success: function(r){
            console.log(r);

            loadSharedTable(r);
        },
        error: function(e){
            console.log("Erro: " + e);
        }
    });
}

function loadSharedTable(idConta) {
    $.ajax({
        action:"get",
        data:{
            "id_conta":idConta,
        },
        url:"conta/modal/compartilhadoTable.php",
        success: function(r){
            $('#listCompartilhado').html(r);
        },
        error:function(e){}
    });
}

function setObjetivoInfo(objType, inputVal) {
    $.ajax({
        action:"get",
        data:{
            "id":inputVal,
            "obj":objType
        },
        url:"buscar.php",
        success: function(r){
            console.log(r);

            r = JSON.parse(r);

            $('#info_nome').text(r.nome);
            $('#info_valor_total').text("R$ " + r.valor_total.replace('.', ','));
            $('#info_saldo').text("R$ " + r.saldo.replace('.', ',')); 

            var date1 = new Date(r.data_cadastro);
            var date2 = new Date(r.data_realizacao);
            var diffTime = Math.abs(date2.getTime() - date1.getTime());
            var diffDays = Math.round(diffTime / 86400000);
            var diffWeek = Math.round(diffTime / 604800000);
            var diffMonth= r.parcelas;

            var porDia = "+- R$ " + (r.valor_total/diffDays).toFixed(2).replace('.',',');
            var porSemana = "+- R$ " + (r.valor_total/diffWeek).toFixed(2).replace('.',',');
            var porMes = "+- R$ " + (r.valor_total/diffMonth).toFixed(2).replace('.',',');

            $('#porDia').text(porDia);
            $('#porSemana').text(porSemana);
            $('#porMes').text(porMes);

            var percent = (r.saldo * 100) / r.valor_total;

            $('#progressBar').prop("aria-valuenow", percent.toFixed(2));
            $('#progressBar').prop("width", percent.toFixed(2) + "%");
            $('#progressBarIn').text(percent.toFixed(2).replace('.',',') + "%");

            var data = null;

            if(r.data_realizacao !== null && r.data_realizacao != "'0000-00-00'" && r.data_realizacao != "0000-00-00"){
                data = new Date(r.data_realizacao);
                r.data_realizacao = data.getDate() + " / " + (data.getMonth() + 1) + " / " + data.getFullYear();

                $('#info_data_realizacao').text(r.data_realizacao);   
            }

            if(r.data_cadastro !== null && r.data_cadastro != "'0000-00-00'" && r.data_cadastro != "0000-00-00"){
                data = new Date(r.data_cadastro);
                r.data_cadastro = data.getDate() + " / " + (data.getMonth() + 1) + " / " + data.getFullYear();

                $('#info_data_cadastro').text(r.data_cadastro);   
            }
        },
        error: function(e){
            console.log(e);
        }
    });
}

function setObjetivo(objType, inputVal) {
    $.ajax({
        action:"get",
        data:{
            "id":inputVal,
            "obj":objType
        },
        url:"buscar.php",
        success: function(r){
            r = JSON.parse(r);

            $('#edit_id').val(r.id);
            $('#edit_nome').val(r.nome);
            $('#edit_valor_total').val(r.valor_total);
            $('#edit_saldo').val(r.saldo);
            $('#edit_parcelas').val(r.parcelas);
            $('#edit_concluido').prop("checked", r.concluido);

            if(r.data_realizacao !== null && r.data_realizacao != "'0000-00-00'" && r.data_realizacao != "0000-00-00"){
                $('#edit_data_realizacao').val(r.data_realizacao.replace(new RegExp("'", 'g'),''));   
            }

            if(r.data_cadastro !== null && r.data_cadastro != "'0000-00-00'" && r.data_cadastro != "0000-00-00"){
                $('#edit_data_cadastro').val(r.data_cadastro.replace(new RegExp("'", 'g'),''));   
            }
        },
        error: function(e){
            console.log(e);
        }
    });
}

function setBeneficio(objType, inputVal){
    $.ajax({
        action:"get",
        data:{
            "id":inputVal,
            "obj":objType
        },
        url:"buscar.php",
        success: function(r){
            r = JSON.parse(r);
            
            $('#id_beneficio').val(r.id);
            if(r.categoria !== null){
                if(r.categoria.id !== null)
                    $('#edit_categoria_beneficio').append("<option value='"+ r.categoria.id +"' selected>"+ r.categoria.nome + "</option>");
            }
            $('#edit_valor_beneficio').val(r.valor);
            if(r.data_credito !== null &&  r.data_credito != "'0000-00-00'"){
                $('#edit_dt_beneficio').val(r.data_credito.replace(new RegExp("'", 'g'),''));   
            }
            if(r.tipo !== null){
                if(r.tipo.id !== null)
                    $('#edit_tipo_beneficio').append("<option value='"+ r.tipo.id +"' selected>"+ r.tipo.nome + "</option>");
            }
        },
        error: function(e){
            console.log(e);
        }
    });
}

function setDesconto(objType, inputVal){
    $.ajax({
        action:"get",
        data:{
            "id":inputVal,
            "obj":objType
        },
        url:"buscar.php",
        success: function(r){
            r = JSON.parse(r); 
            $('#id_desconto').val(r.id);
            if(r.categoria !== null){
                if(r.categoria.id !== null)
                    $('#edit_categoria_desconto').append("<option value='"+ r.categoria.id +"' selected>"+ r.categoria.nome + "</option>");
            }
            $('#edit_valor_desconto').val(r.valor);
            $('#edit_porcentagem_desconto').val(r.porcentagem);
        },
        error: function(e){
            console.log(e);
        }
    });
}

function getColor(){
    var hexadecimais = '0123456789ABCDEF';
    var cor = '#';
  
    // Pega um número aleatório no array acima
    for (var i = 0; i < 6; i++ ) {
    //E concatena à variável cor
        cor += hexadecimais[Math.floor(Math.random() * 16)];
    }
    return cor;
}

function exibirModal(modalId) {
    $(modalId).modal('show');
}