-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 18-Jun-2019 às 02:15
-- Versão do servidor: 10.1.38-MariaDB
-- versão do PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `biblioteca`
--
CREATE DATABASE IF NOT EXISTS `biblioteca` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `biblioteca`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `dados_acesso`
--

CREATE TABLE `dados_acesso` (
  `cpf_usuario` varchar(11) COLLATE utf8_bin NOT NULL,
  `senha` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Truncate table before insert `dados_acesso`
--

TRUNCATE TABLE `dados_acesso`;
--
-- Extraindo dados da tabela `dados_acesso`
--

INSERT INTO `dados_acesso` (`cpf_usuario`, `senha`) VALUES
('11122233344', 'admin'),
('12233333333', 'mena'),
('12321321321', 'admin'),
('32132132131', 'aaaaaa');

-- --------------------------------------------------------

--
-- Estrutura da tabela `devolucao`
--

CREATE TABLE `devolucao` (
  `id_emprestimo` int(11) NOT NULL,
  `dtdevolucao` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Truncate table before insert `devolucao`
--

TRUNCATE TABLE `devolucao`;
--
-- Extraindo dados da tabela `devolucao`
--

INSERT INTO `devolucao` (`id_emprestimo`, `dtdevolucao`) VALUES
(1, '2019-06-17 19:38:37'),
(2, '2019-06-17 19:41:23'),
(3, '2019-06-17 19:41:16'),
(4, '2019-06-17 20:48:55');

--
-- Acionadores `devolucao`
--
DELIMITER $$
CREATE TRIGGER `devolucao_BEFORE_INSERT` BEFORE INSERT ON `devolucao` FOR EACH ROW BEGIN
	DECLARE id_do_livro INT;
	SET id_do_livro = (SELECT id_livro FROM emprestimo WHERE id=NEW.id_emprestimo);
	UPDATE livro SET qtalugado=CAST(qtalugado AS SIGNED)-1 WHERE id=id_do_livro;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `emprestimo`
--

CREATE TABLE `emprestimo` (
  `id` int(11) NOT NULL,
  `id_livro` int(11) NOT NULL,
  `cpf_usuario` varchar(11) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `dtemprestimo` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Truncate table before insert `emprestimo`
--

TRUNCATE TABLE `emprestimo`;
--
-- Extraindo dados da tabela `emprestimo`
--

INSERT INTO `emprestimo` (`id`, `id_livro`, `cpf_usuario`, `dtemprestimo`) VALUES
(1, 1, '11122233344', '2019-06-17 19:15:54'),
(2, 1, '11122233344', '2019-06-17 19:41:03'),
(3, 1, '11122233344', '2019-06-17 19:41:09'),
(4, 5, '11122233344', '2019-06-17 20:48:44');

--
-- Acionadores `emprestimo`
--
DELIMITER $$
CREATE TRIGGER `emprestimo_BEFORE_INSERT` BEFORE INSERT ON `emprestimo` FOR EACH ROW BEGIN
	IF (SELECT qttotal FROM livro WHERE id=NEW.id_livro)>(SELECT qtalugado FROM livro WHERE id=NEW.id_livro) AND (SELECT qttotal FROM livro WHERE id=NEW.id_livro) > 0 AND (SELECT qtalugado FROM livro WHERE id=NEW.id_livro) >= 0
		THEN
		UPDATE livro SET qtalugado=qtalugado+1 WHERE id=NEW.id_livro;
	ELSE
        SIGNAL SQLSTATE '20000' SET MESSAGE_TEXT = 'Não possuimos mais esse livro em estoque! :(';
	END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `endereco`
--

CREATE TABLE `endereco` (
  `cpf_usuario` varchar(11) COLLATE utf8_bin NOT NULL,
  `rua` varchar(255) COLLATE utf8_bin NOT NULL,
  `numero` int(11) NOT NULL,
  `bairro` varchar(255) COLLATE utf8_bin NOT NULL,
  `cep` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Truncate table before insert `endereco`
--

TRUNCATE TABLE `endereco`;
--
-- Extraindo dados da tabela `endereco`
--

INSERT INTO `endereco` (`cpf_usuario`, `rua`, `numero`, `bairro`, `cep`) VALUES
('11122233344', 'Rua do rolê', 66, 'Townsville', 12345666),
('12233333333', 'teste', 312, 'teste', 32131231),
('32132132131', 'rerstrer', 321, '3123131', 12312312);

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionario`
--

CREATE TABLE `funcionario` (
  `cpf_usuario` varchar(11) COLLATE utf8_bin NOT NULL,
  `ctps` varchar(12) COLLATE utf8_bin NOT NULL,
  `cargo` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Truncate table before insert `funcionario`
--

TRUNCATE TABLE `funcionario`;
--
-- Extraindo dados da tabela `funcionario`
--

INSERT INTO `funcionario` (`cpf_usuario`, `ctps`, `cargo`) VALUES
('11122233344', '999888777666', 'admin'),
('12233333333', '312321321321', 'admin'),
('32132132131', '3213131231', 'super');

-- --------------------------------------------------------

--
-- Estrutura da tabela `livro`
--

CREATE TABLE `livro` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) COLLATE utf8_bin NOT NULL,
  `autor` varchar(45) COLLATE utf8_bin NOT NULL,
  `editora` varchar(255) COLLATE utf8_bin NOT NULL,
  `dtpublicacao` date NOT NULL,
  `genero` varchar(255) COLLATE utf8_bin NOT NULL,
  `secao` varchar(255) COLLATE utf8_bin NOT NULL,
  `qttotal` int(11) UNSIGNED NOT NULL,
  `qtalugado` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Truncate table before insert `livro`
--

TRUNCATE TABLE `livro`;
--
-- Extraindo dados da tabela `livro`
--

INSERT INTO `livro` (`id`, `titulo`, `autor`, `editora`, `dtpublicacao`, `genero`, `secao`, `qttotal`, `qtalugado`) VALUES
(1, 'O Senhor dos Anéis', 'JRR Tolkien', 'Martins Fonts', '1952-01-01', 'Fantasia', 'Literatura Fantástica', 100, 0),
(2, 'Senhor do Tempo', 'Testada', 'No Teclado', '2019-02-11', 'Romance', 'Romance', 110, 0),
(3, 'ASer', 'do', 'Humano', '2018-06-10', 'Teste', 'Estante', 50, 0),
(4, '', '', '', '0000-00-00', '', '', 0, 0),
(5, 'Percy jackson', 'teste', 'teste', '2010-05-05', 'teste', 'teste', 45, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `multa`
--

CREATE TABLE `multa` (
  `id_emprestimo` int(11) NOT NULL,
  `dtmulta` datetime NOT NULL,
  `duracao` datetime NOT NULL,
  `motivo` varchar(45) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Truncate table before insert `multa`
--

TRUNCATE TABLE `multa`;
-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `cpf` varchar(11) COLLATE utf8_bin NOT NULL,
  `dtnascimento` date NOT NULL,
  `nome` varchar(255) COLLATE utf8_bin NOT NULL,
  `email` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Truncate table before insert `usuario`
--

TRUNCATE TABLE `usuario`;
--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`cpf`, `dtnascimento`, `nome`, `email`) VALUES
('11122233344', '2000-01-01', 'admin', 'admin@admin.com.br'),
('12233333333', '1999-02-02', 'teste', 'teste@teste.com'),
('12321321321', '1999-02-02', 'teste', 'teste@teste.com'),
('31232131231', '1999-02-02', 'test', 'teste@teste.com'),
('32132132131', '1999-02-02', 'teste', 'test2e@teste.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dados_acesso`
--
ALTER TABLE `dados_acesso`
  ADD PRIMARY KEY (`cpf_usuario`);

--
-- Indexes for table `devolucao`
--
ALTER TABLE `devolucao`
  ADD PRIMARY KEY (`id_emprestimo`);

--
-- Indexes for table `emprestimo`
--
ALTER TABLE `emprestimo`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD KEY `cpf_emprestimo_idx` (`cpf_usuario`),
  ADD KEY `id_livro_idx` (`id_livro`);

--
-- Indexes for table `endereco`
--
ALTER TABLE `endereco`
  ADD PRIMARY KEY (`cpf_usuario`);

--
-- Indexes for table `funcionario`
--
ALTER TABLE `funcionario`
  ADD PRIMARY KEY (`cpf_usuario`),
  ADD UNIQUE KEY `ctps_UNIQUE` (`ctps`),
  ADD UNIQUE KEY `cpf_usuario_UNIQUE` (`cpf_usuario`);

--
-- Indexes for table `livro`
--
ALTER TABLE `livro`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `multa`
--
ALTER TABLE `multa`
  ADD PRIMARY KEY (`id_emprestimo`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`cpf`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `emprestimo`
--
ALTER TABLE `emprestimo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `livro`
--
ALTER TABLE `livro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `dados_acesso`
--
ALTER TABLE `dados_acesso`
  ADD CONSTRAINT `cpf_dados` FOREIGN KEY (`cpf_usuario`) REFERENCES `usuario` (`cpf`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `devolucao`
--
ALTER TABLE `devolucao`
  ADD CONSTRAINT `id_devolucao` FOREIGN KEY (`id_emprestimo`) REFERENCES `emprestimo` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `emprestimo`
--
ALTER TABLE `emprestimo`
  ADD CONSTRAINT `cpf_emprestimo` FOREIGN KEY (`cpf_usuario`) REFERENCES `usuario` (`cpf`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `id_livro` FOREIGN KEY (`id_livro`) REFERENCES `livro` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `endereco`
--
ALTER TABLE `endereco`
  ADD CONSTRAINT `cpf_endereco` FOREIGN KEY (`cpf_usuario`) REFERENCES `usuario` (`cpf`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `funcionario`
--
ALTER TABLE `funcionario`
  ADD CONSTRAINT `cpf_funcionario` FOREIGN KEY (`cpf_usuario`) REFERENCES `usuario` (`cpf`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `multa`
--
ALTER TABLE `multa`
  ADD CONSTRAINT `id_multa` FOREIGN KEY (`id_emprestimo`) REFERENCES `emprestimo` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
