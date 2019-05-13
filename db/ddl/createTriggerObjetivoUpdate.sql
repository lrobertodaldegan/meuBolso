DELIMITER $

CREATE TRIGGER updateObjetivo AFTER UPDATE ON meubolso.objetivo
FOR EACH ROW
BEGIN
    IF NEW.concluido > OLD.concluido THEN
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
            'Concluiu um objetivo',
            NEW.nome,
            'objetivo.concluido',
            NEW.id_usuario,
            OLD.concluido,
            NEW.concluido,
            NOW()
        );
    END IF;

    IF NEW.saldo > OLD.saldo THEN
        UPDATE usuario SET saldo = saldo - (NEW.saldo - OLD.saldo) WHERE id = NEW.id_usuario;
    END IF;

    IF NEW.saldo < OLD.saldo THEN
        UPDATE usuario SET saldo = saldo + (OLD.saldo - NEW.saldo) WHERE id = NEW.id_usuario;
    END IF;
END$

DELIMITER ;