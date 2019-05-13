DELIMITER $

CREATE TRIGGER updateUsuario AFTER UPDATE ON meubolso.usuario
FOR EACH ROW
BEGIN
    IF NEW.saldo <> OLD.saldo THEN
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
            'Teve o saldo da renda atualizado',
            NULL,
            'usuario.saldo',
            NEW.id,
            OLD.saldo,
            NEW.saldo,
            NOW()
        );
    END IF;

    IF NEW.renda <> OLD.renda THEN
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
            'Atualizou a renda',
            NULL,
            'usuario.renda',
            NEW.id,
            OLD.renda,
            NEW.renda,
            NOW()
        );
    END IF;

    IF NEW.data_pagamento <> OLD.data_pagamento THEN
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
            'Alterou a data de renovação de renda (saldo)',
            NEW.data_pagamento,
            'usuario.data_pagamento',
            NEW.id,
            OLD.data_pagamento,
            NEW.data_pagamento,
            NOW()
        );
    END IF;
END$

DELIMITER ;