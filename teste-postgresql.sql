--TIPO
CREATE TYPE acesso_nested AS (
    senha VARCHAR(20)
);

CREATE TYPE endereco_nested AS (
    rua VARCHAR(50),
    numero INTEGER,
    bairro VARCHAR(20),
    cep INTEGER
);

--TABELA
CREATE TABLE pessoa (
    cpf VARCHAR(11) PRIMARY KEY,
    nome VARCHAR(50),
    dataNasc DATE,
    email VARCHAR(50),
    endereco endereco_nested,
    senha acesso_nested
);

CREATE TABLE livro (
    id SERIAL PRIMARY KEY,
    titulo VARCHAR(30),
    autor VARCHAR(50),
    editora VARCHAR(30),
    publicacao DATE,
    genero VARCHAR(15),
    secao VARCHAR(20),
    qtde INTEGER,
    alugado INTEGER
);

CREATE TABLE administrador (
    cpf VARCHAR(11) REFERENCES pessoa(cpf) ON DELETE CASCADE,
    ctps VARCHAR(20),
    cargo VARCHAR(20)
);

CREATE TABLE emprestimo (
    id INTEGER PRIMARY KEY,
    livro INTEGER REFERENCES livro(id) ON DELETE NO ACTION,
    usuario VARCHAR(11) REFERENCES pessoa(cpf) ON DELETE NO ACTION,
    data DATE
);

CREATE TABLE devolucao (
    emprestimo INTEGER REFERENCES emprestimo(id) ON DELETE NO ACTION,
    devolucao DATE
);

--TRIGGER & FUNCAO
CREATE OR REPLACE FUNCTION devolucao_BFINS() RETURNS TRIGGER AS $devolucao_bfins$
	BEGIN
        	UPDATE livro SET alugado = CAST(alugado AS SIGNED) - 1 WHERE id = (SELECT livro from emprestimo where id = NEW.id);
	END;
$devolucao_bfins$ LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION emprestimo_BFINS() RETURNS TRIGGER AS $emprestimo_bfins$
    BEGIN
        IF (SELECT qtde FROM livro WHERE id=NEW.livro) > (SELECT alugado FROM livro WHERE id=NEW.livro) AND (SELECT qtde FROM livro WHERE id=NEW.livro) > 0
            THEN UPDATE livro SET alugado = alugado+1 WHERE id = NEW.livro;
        ELSE
            RAISE EXCEPTION 'O LIVRO NÃO PODE SER EMPRESTADO!';
        END IF;
    END;
$emprestimo_bfins$ LANGUAGE plpgsql;

CREATE TRIGGER devolucao_BEFORE_INSERT 
    BEFORE INSERT ON devolucao
    FOR EACH ROW EXECUTE PROCEDURE devolucao_BFINS();

CREATE TRIGGER emprestimo_BEFORE_INSERT
    BEFORE INSERT ON emprestimo
    FOR EACH ROW EXECUTE PROCEDURE emprestimo_BFINS();
    