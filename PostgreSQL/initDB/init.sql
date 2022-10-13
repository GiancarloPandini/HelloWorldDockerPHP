CREATE TABLE pessoas (
	id SERIAL PRIMARY KEY NOT NULL,
    nome VARCHAR(100) NOT NULL,
    sobrenome VARCHAR(100) NOT NULL,
    data_nascimento DATE NOT NULL,
    sexo smallint NOT NULL CHECK(sexo in(1,2)),
    apelido VARCHAR(50)
);