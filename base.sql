-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 01/06/2024 às 21:34
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `base`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `avaliacoes`
--

CREATE TABLE `avaliacoes` (
  `id_avaliacao` int(11) NOT NULL,
  `id_pj` int(11) DEFAULT NULL,
  `avaliacao` int(11) DEFAULT NULL,
  `comentario` text DEFAULT NULL,
  `data_avaliacao` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `avaliacoes`
--

INSERT INTO `avaliacoes` (`id_avaliacao`, `id_pj`, `avaliacao`, `comentario`, `data_avaliacao`) VALUES
(1, 1, 1, 'Muito bom', '2024-05-05 01:17:05'),
(2, 1, 1, 'Muito bom', '2024-05-05 01:18:31'),
(3, 1, 1, 'Muito bom', '2024-05-05 01:19:51'),
(0, 7, 5, 'Comida boa', '2024-05-26 22:34:30');

-- --------------------------------------------------------

--
-- Estrutura para tabela `pf_registro`
--

CREATE TABLE `pf_registro` (
  `id` int(11) NOT NULL,
  `user_log` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `cpf_registro` varchar(14) NOT NULL,
  `pw_log` varchar(60) DEFAULT NULL,
  `telefone` varchar(14) NOT NULL,
  `genero` varchar(10) NOT NULL,
  `data_nascimento` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `pf_registro`
--

INSERT INTO `pf_registro` (`id`, `user_log`, `email`, `cpf_registro`, `pw_log`, `telefone`, `genero`, `data_nascimento`) VALUES
(5, 'Henrique Bressiani Bohrer', 'henrique300415@gmail.com', '11811363938', '$2y$10$uBsD1qga0nfqCNvr17xm/egT8RQ7SdXwCnwtD5CJeJUAeIO13pmzS', '49984287347', 'homem', '2003-04-30');

-- --------------------------------------------------------

--
-- Estrutura para tabela `pj_registro`
--

CREATE TABLE `pj_registro` (
  `id_pj` int(11) NOT NULL,
  `nome_empresa` varchar(255) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `endereco` varchar(255) NOT NULL,
  `horario_funcionamento` varchar(100) NOT NULL,
  `link_google_maps` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `pj_registro`
--

INSERT INTO `pj_registro` (`id_pj`, `nome_empresa`, `telefone`, `endereco`, `horario_funcionamento`, `link_google_maps`) VALUES
(1, 'Barbearia La Mafia Club', '41 30928600', 'R. Des. Westphalen, 2109 - Centro, Curitiba - PR, 80220-030', 'Seg - Sex: 09:00 - 20:00 Sab: 09:00 - 19:00', 'https://maps.app.goo.gl/Q6j6w34zfu9ULLJD8'),
(2, 'Arena UP e-Sports', '(41) 3121-6868', 'Av. Sete de Setembro, 2436-A - Centro, Curitiba - PR, 80230-085', 'Seg - Sab: 13:00 - 22:00', 'https://maps.app.goo.gl/L1doUWsLvTXiaTiC8'),
(3, 'Sal e Brasa Curitiba', '(41) 3077-7983', 'Av. Com. Franco, 4097 - Jardim das Américas, Curitiba - PR, 81530-440', 'Seg - Sex: 11:30 - 22:30', 'https://maps.app.goo.gl/ZQTMY536Qi1Ya3zu9'),
(4, 'A Magia - Tatuagem', '(41) 3369-4619', 'R. Luiz França, 2290 - Cajuru, Curitiba - PR, 82940-010', 'Seg - Sab: 09:00 - 18:30', 'https://maps.app.goo.gl/C7XpzLnt46aHtWwM8');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `pf_registro`
--
ALTER TABLE `pf_registro`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `pj_registro`
--
ALTER TABLE `pj_registro`
  ADD PRIMARY KEY (`id_pj`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `pf_registro`
--
ALTER TABLE `pf_registro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `pj_registro`
--
ALTER TABLE `pj_registro`
  MODIFY `id_pj` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
