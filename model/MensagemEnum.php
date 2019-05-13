<?php
    abstract class MensagemEnum {
        const ERRO = "Erro";
        const WARN = "Aviso";
        const INFO = "Informação";
        const SUCESSO = "Sucesso";

        const TIPO = "tipo";
        const CLASSE = "classe";
        const MENSAGEM = "mensagem";

        const CLASSE_SUCESSO = "alert alert-success";
        const CLASSE_ERRO    = "alert alert-danger";
        const CLASSE_AVISO   = "alert alert-warning";
        const CLASSE_INFO    = "alert alert-info";

        const USUARIO_N_ENCONTRADO =  "Usuário não encontrado. Tente novamente.";
        const ERRO_GENERICO = "Houve um erro. Tente novamente mais tarde.";
        const SUCESSO_GENERICO = "Operação realizada com sucesso!";
        const NADA_ENCONTRADO = "<b>:(</b><br><br>Desculpe, mas não conseguimos encontrar dados para os filtros informados.<br>Tente novamente mais tarde ou mude os filtros de pesquisa se houver algum.";
    }
?>