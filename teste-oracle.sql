CREATE OR REPLACE TYPE Acesso_Nested AS TABLE OF VARCHAR2(20);

CREATE OR REPLACE TYPE Endereco_Type AS OBJECT (
    Rua VARCHAR2(50),
    Numero INTEGER,
    Bairro VARCHAR2(20),
    Cep NUMBER(7)
);

CREATE OR REPLACE TYPE Pessoa_Type AS OBJECT (
    Cpf NUMBER(11),
    Nome VARCHAR2(50),
    DataNasc DATE,
    Email VARCHAR2(50),
    Endereco Endereco_Type,
    Senha Acesso_Nested
) NOT FINAL;

CREATE OR REPLACE TYPE Livro_Type AS OBJECT (
    Id INTEGER,
    Titulo VARCHAR2(30),
    Autor VARCHAR2(50),
    Editora VARCHAR2(30),
    Publicacao DATE,
    Genero VARCHAR2(15),
    Secao VARCHAR2(20),
    Qtde INTEGER,
    Alugado INTEGER
);

CREATE OR REPLACE TYPE Administrador_Type UNDER Pessoa_Type (
    Ctps NUMBER(20),
    Cargo VARCHAR2(20)
);

CREATE OR REPLACE TYPE Emprestimo_Type AS OBJECT (
    Id INTEGER,
    Livro REF Livro_Type,
    Usuario REF Pessoa_Type,
    Data DATE
);

CREATE OR REPLACE TYPE Devolucao_Type AS OBJECT (
    Emprestimo REF Emprestimo_Type,
    Devolucao DATE
);

CREATE TABLE Administrador OF Administrador_Type (PRIMARY KEY (CPF, CTPS))  NESTED TABLE Senha STORE AS ACESSO_ADM_STORED;
CREATE TABLE Aluno OF Pessoa_Type (PRIMARY KEY (CPF))  NESTED TABLE Senha STORE AS ACESSO_STORED;
CREATE TABLE Livro OF Livro_Type (Primary KEY (Id));
CREATE TABLE Emprestimo OF Emprestimo_Type (PRIMARY KEY (Id));
CREATE TABLE Devolucao OF Devolucao_Type;
