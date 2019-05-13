CREATE TABLE meubolso.conta (
    id INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    descricao VARCHAR(100),
    valor DECIMAL(10,2),
    saldo DECIMAL(10,2),
    vencimento DATE,
    juros INT(5),
    tipo_juros INT(10),
    id_categoria INT(10),
    id_tipo INT(10),
    parcelas INT(3),
    id_usuario INT(10) NOT NULL,
    observacao TEXT,
    pago BOOLEAN,
    id_pai INT(10) NULL,
    atualizado_por INT(10) NULL
);

ALTER TABLE meubolso.conta ADD FOREIGN KEY (id_usuario) REFERENCES meubolso.usuario(id);
ALTER TABLE meubolso.conta ADD FOREIGN KEY (atualizado_por) REFERENCES meubolso.usuario(id);
ALTER TABLE meubolso.conta ADD FOREIGN KEY (id_categoria) REFERENCES meubolso.categoria(id);
ALTER TABLE meubolso.conta ADD FOREIGN KEY (id_tipo) REFERENCES meubolso.tipo(id);