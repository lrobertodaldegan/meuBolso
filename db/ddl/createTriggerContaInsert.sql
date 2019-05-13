DELIMITER $

CREATE TRIGGER insertConta AFTER INSERT ON meubolso.conta
FOR EACH ROW
BEGIN
    IF NEW.pago > 0 THEN
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
            'Uma conta foi paga',
            NEW.descricao,
            'conta.pago',
            NEW.id_usuario,
            0,
            NEW.pago,
            NOW()
        );

        UPDATE meubolso.usuario SET saldo = saldo - NEW.saldo WHERE id = NEW.atualizado_por;
    END IF;
END$

DELIMITER ;