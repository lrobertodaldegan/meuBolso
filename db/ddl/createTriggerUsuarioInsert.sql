CREATE TRIGGER insertUsuario AFTER INSERT ON meubolso.usuario
FOR EACH ROW
    INSERT INTO meubolso.historico (
        id,
        operacao,
        tip,
        campo_alterado,
        id_usuario,
        valor_de,
        valor_para,
        data
    ) VALUES (
        NULL,
        'Se cadastrou',
        NULL,
        'usuario.id',
        NEW.id,
        NULL,
        NEW.id,
        NOW()
    )
;