CREATE TABLE meubolso.desconto (
    id INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(200) not null,
    valor DECIMAL(10,2) NOT NULL,
    id_categoria INT(10) NULL,
    porcentagem DECIMAL(10,2),
    id_beneficio INT(10),
    criado_por INT(10),
    id_usuario INT(10) NOT ,
);

ALTER TABLE meubolso.desconto ADD FOREIGN KEY (id_beneficio) REFERENCES meubolso.beneficio(id);
ALTER TABLE meubolso.desconto ADD FOREIGN KEY (criado_por) REFERENCES meubolso.usuario(id);
ALTER TABLE meubolso.desconto ADD FOREIGN KEY (id_usuario) REFERENCES meubolso.usuario(id);
ALTER TABLE meubolso.desconto ADD FOREIGN KEY (id_categoria) REFERENCES meubolso.categoria(id);