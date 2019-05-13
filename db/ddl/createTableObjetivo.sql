CREATE TABLE objetivo (
    id INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(250) NOT NULL,
    prioridade INT(1),
    data_cadastro DATE NOT NULL,
    data_realizacao DATE,
    valor_total DECIMAL(10,2) NOT NULL,
    saldo DECIMAL(10,2),
    parcelas INT(4),
    id_usuario INT(10) NOT NULL,
    concluido INT(1)
);

ALTER TABLE meubolso.objetivo ADD FOREIGN KEY (id_usuario) REFERENCES meubolso.usuario(id);
