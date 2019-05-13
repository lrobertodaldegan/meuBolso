DELIMITER $

CREATE TRIGGER insertObjetivo AFTER INSERT ON meubolso.objetivo
FOR EACH ROW
BEGIN
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
        'Cadastrou um objetivo novo',
        NEW.nome,
        'objetivo.id',
        NEW.id_usuario,
        NULL,
        NEW.id,
        NOW()
    );

    IF NEW.saldo IS NOT NULL AND NEW.saldo > 0 THEN
        UPDATE usuario SET saldo = (saldo - NEW.saldo) WHERE id = NEW.id_usuario;
    END IF;
END$

DELIMITER ;