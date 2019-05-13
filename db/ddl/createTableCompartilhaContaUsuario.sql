CREATE TABLE meubolso.compartilha_conta_usuario (
    id INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    id_conta INT(10) NOT NULL,
    id_usuario INT(10) NOT NULL
);

ALTER TABLE meubolso.rl_conta_usuario ADD FOREIGN KEY (id_usuario) REFERENCES meubolso.usuario(id);
ALTER TABLE meubolso.rl_conta_usuario ADD FOREIGN KEY (id_conta) REFERENCES meubolso.conta(id);