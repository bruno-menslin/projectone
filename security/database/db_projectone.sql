-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 17/02/2021 às 14:25
-- Versão do servidor: 10.4.17-MariaDB
-- Versão do PHP: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `db_projectone`
--
CREATE DATABASE IF NOT EXISTS `db_projectone` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `db_projectone`;

-- --------------------------------------------------------

--
-- Estrutura para tabela `categorias`
--

CREATE TABLE `categorias` (
  `id` tinyint(3) UNSIGNED ZEROFILL NOT NULL,
  `nome` varchar(30) NOT NULL,
  `descricao` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `categorias`
--

INSERT INTO `categorias` (`id`, `nome`, `descricao`) VALUES
(001, 'Aeronaves', NULL),
(002, 'Embarcações', NULL),
(003, 'Automóveis', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `produtos`
--

CREATE TABLE `produtos` (
  `codigo` smallint(5) UNSIGNED ZEROFILL NOT NULL,
  `modelo` varchar(30) NOT NULL,
  `valor` decimal(7,2) UNSIGNED NOT NULL,
  `descricao` text DEFAULT NULL,
  `categorias_id` tinyint(3) UNSIGNED ZEROFILL NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `produtos`
--

INSERT INTO `produtos` (`codigo`, `modelo`, `valor`, `descricao`, `categorias_id`) VALUES
(00001, 'Chevette DL 1.6/S 1993 Álcool', '9899.90', NULL, 003),
(00002, 'LeveFort Marajó 16', '25000.00', 'Casco 2003, motor mercury 2017 50HP.', 002);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `usuario` varchar(12) NOT NULL,
  `senha` char(32) NOT NULL,
  `email` varchar(100) NOT NULL,
  `permissao` tinyint(1) UNSIGNED NOT NULL,
  `ativo` tinyint(1) UNSIGNED NOT NULL COMMENT '0 - ATIVO\n1 - INATIVO'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `senha`, `email`, `permissao`, `ativo`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin@admin.com', 1, 0),
(2, 'user', 'ee11cbb19052e40b07aac0ca060c23ee', 'user@user.com', 0, 0);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`codigo`),
  ADD KEY `fk_produtos_categorias_idx` (`categorias_id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario_UNIQUE` (`usuario`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` tinyint(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `codigo` smallint(5) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `produtos`
--
ALTER TABLE `produtos`
  ADD CONSTRAINT `fk_produtos_categorias` FOREIGN KEY (`categorias_id`) REFERENCES `categorias` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
