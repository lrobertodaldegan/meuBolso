DELIMITER $

CREATE TRIGGER updateConta AFTER UPDATE ON meubolso.conta
FOR EACH ROW
BEGIN
    IF NEW.pago > OLD.pago THEN
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
            OLD.pago,
            NEW.pago,
            NOW()
        );

        UPDATE meubolso.usuario SET saldo = saldo - NEW.saldo WHERE id = NEW.atualizado_por;
    ELSE
        IF NEW.saldo > OLD.saldo THEN
            UPDATE meubolso.usuario SET saldo = saldo - (NEW.saldo - OLD.saldo) WHERE id = NEW.atualizado_por;
        ELSE
            UPDATE meubolso.usuario SET saldo = saldo + (OLD.saldo - NEW.saldo) WHERE id = NEW.atualizado_por;
        END IF;
    END IF;
END$

DELIMITER ;