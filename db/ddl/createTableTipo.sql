CREATE TABLE meubolso.tipo (
    id INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100),
    criado_por INT(10),
    criado_em DATE
);

ALTER TABLE meubolso.tipo ADD FOREIGN KEY (criado_por) REFERENCES meubolso.usuario(id);