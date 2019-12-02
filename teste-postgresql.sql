CREATE TYPE acesso_nested AS (
    senha VARCHAR(20)
);

CREATE TYPE endereco_nested AS (
    rua VARCHAR(50),
    numero INTEGER,
    bairro VARCHAR(20),
    cep INTEGER
);

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
