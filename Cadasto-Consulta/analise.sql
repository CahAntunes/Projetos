-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Tempo de geração: 09/01/2024 às 13:25
-- Versão do servidor: 8.0.35-0ubuntu0.20.04.1
-- Versão do PHP: 7.4.3-4ubuntu2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `cadastro`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `produtos`
--

CREATE IF NOT EXIST TABLE `produtos` (
  `id` int NOT NULL,
  `codigo` varchar(10) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `descricao` varchar(100) NOT NULL,
  `valor` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `unidade` enum('mg','g','Kg','cm','m','un') CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `venda` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `fazparte` enum('Sim','Não') NOT NULL DEFAULT 'Sim'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Despejando dados para a tabela `produtos`
--

INSERT INTO `produtos` (`id`, `codigo`, `nome`, `descricao`, `valor`, `unidade`, `venda`, `fazparte`) VALUES
(1, '001', 'Reed Switch', 'Para conexão eletrica', '50,00', 'mg', '', 'Sim'),
(2, '002', 'PPA', 'Poliftalamida', '50,00', 'mg', '', 'Não'),
(3, '003', 'POM', 'Poliacetal', '30,00', 'Kg', '100,00', 'Não'),
(4, '004', 'PP', 'Polipropileno', '70,00', 'g', '150,00', 'Sim'),
(6, '005', 'PC', 'Policarbonato', '60,00', 'cm', '95,00', 'Não'),
(11, '006', 'Porca Hexagonal', 'Poliamida', '80,00', 'm', '200,00', 'Sim'),
(13, '007', 'Arruela NBR', 'vedação', '55,00', 'mg', '100,00', 'Sim'),
(14, '008', 'Arruela EPDM', 'vedação', '110,00', 'g', '220,00', 'Sim'),
(15, '009', 'Fita Vedante', 'fdfsdsd', '1233', 'mg', '456', 'Sim'),
(47, '010', 'Cano', 'Tigre', '100,00', 'mg', '150,00', 'Sim'),
(48, '011', 'Adaptador', 'Adaptador de fluxo de nível', '85,00', 'un', '115,00', 'Sim'),
(50, '012', 'Caixa', 'Caixa de papelão para embalagem', '20,00', 'un', '40,00', 'Não'),
(51, '013', 'Cabo', 'cabo para fluxo de água', '15,00', 'm', '25,00', 'Sim'),
(52, '014', 'Mouse', 'Mouse de mesa', '100.000.000,00', 'un', '100.000.000,00', 'Não');

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `codigo` (`codigo`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
