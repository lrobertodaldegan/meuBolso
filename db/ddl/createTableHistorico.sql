CREATE TABLE meubolso.historico(
    id INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    operacao VARCHAR(250) NOT NULL,
    tip VARCHAR(250) NULL,
    campo_alterado VARCHAR(250),
    id_usuario INT(10),
    valor_de VARCHAR(250),
    valor_para VARCHAR(250),
    data DATE,
    saldo DECIMAL(10,2)
);

ALTER TABLE meubolso.historico ADD FOREIGN KEY (id_usuario) REFERENCES meubolso.usuario(id);