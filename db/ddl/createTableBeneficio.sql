CREATE TABLE meubolso.beneficio (
    id INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(200) not null,
    id_categoria INT(10),
    valor DECIMAL(10,2) NOT NULL,
    data_credito DATE NOT NULL,
    id_tipo INT(10),
    id_usuario INT(10)
);

ALTER TABLE meubolso.beneficio ADD FOREIGN KEY (id_categoria) REFERENCES meubolso.categoria(id);
ALTER TABLE meubolso.beneficio ADD FOREIGN KEY (id_tipo) REFERENCES meubolso.tipo(id);
ALTER TABLE meubolso.beneficio ADD FOREIGN KEY (id_usuario) REFERENCES meubolso.usuario(id);