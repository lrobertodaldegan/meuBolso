CREATE TABLE meubolso.usuario (
    id INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(200),
    login VARCHAR(50),
    email VARCHAR(200),
    apelido VARCHAR(200),
    senha TEXT,
    renda DECIMAL(10,2),
    data_pagamento DATE,
    saldo DECIMAL(10,2)
);