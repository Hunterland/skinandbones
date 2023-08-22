-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Tempo de geração: 24/10/2022 às 08:02
-- Versão do servidor: 8.0.30-0ubuntu0.20.04.2
-- Versão do PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `skin_and_bones`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_client`
--

CREATE TABLE `tb_client` (
  `client_id` int NOT NULL,
  `client_name` varchar(100) NOT NULL,
  `client_email` varchar(50) NOT NULL,
  `client_password` text NOT NULL,
  `createAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Despejando dados para a tabela `tb_client`
--

INSERT INTO `tb_client` (`client_id`, `client_name`, `client_email`, `client_password`, `createAt`) VALUES
(7, 'ricardo', 'rmvnew@gmail.com', '$2y$10$XHo/apro475O1hFTTFijQOJZohBeFyDoAKJ8aMEJRUoVOQf.Pqs9G', '2022-10-22 09:52:12'),
(8, 'rmvnew@gmail.com', '', '$2y$10$x93ssbh4ZEK8jbwXYvbKSeZugDVQSb3pPDYCuMiEEXty3hximy6Ji', '2022-10-22 10:34:53'),
(9, 'MATEUS', 'mateus@gmail.com', '$2y$10$wmyq.UKGZFOaMRfntrnwSe4JljQ3jIlzQEC4ql9eC9.OULbmCr56.', '2022-10-22 14:36:56'),
(10, 'TESTE', 'rmvnew@gmail.com3', '$2y$10$xHUwbki9CNTQDC3L.g6Py.2WhypJ4ihiInjH4OVNUwvRXAAV8afBO', '2022-10-23 11:25:11');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_profile`
--

CREATE TABLE `tb_profile` (
  `profile_id` int NOT NULL,
  `profile_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Despejando dados para a tabela `tb_profile`
--

INSERT INTO `tb_profile` (`profile_id`, `profile_name`) VALUES
(1, 'Administrador'),
(2, 'Usuário');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_user`
--

CREATE TABLE `tb_user` (
  `user_id` int NOT NULL,
  `profile_id` int DEFAULT NULL,
  `user_name` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `user_email` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `user_password` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `createAt` datetime DEFAULT NULL,
  `updateAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Despejando dados para a tabela `tb_user`
--

INSERT INTO `tb_user` (`user_id`, `profile_id`, `user_name`, `user_email`, `user_password`, `createAt`, `updateAt`) VALUES
(3, 1, 'RICARDO MANGABEIRO', 'rmvnew@gmail.com', '$2y$10$g03FbLkVd0oQlSRkcvKNLOxfAO4TfhpyjWOwMiDxXr.uEBMCA.td2', '2022-10-22 15:34:17', '2022-10-22 15:55:40');

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `tb_client`
--
ALTER TABLE `tb_client`
  ADD PRIMARY KEY (`client_id`);

--
-- Índices de tabela `tb_profile`
--
ALTER TABLE `tb_profile`
  ADD PRIMARY KEY (`profile_id`);

--
-- Índices de tabela `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `user_FK` (`profile_id`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `tb_client`
--
ALTER TABLE `tb_client`
  MODIFY `client_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `tb_profile`
--
ALTER TABLE `tb_profile`
  MODIFY `profile_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restrições para dumps de tabelas
--

--
-- Restrições para tabelas `tb_user`
--
ALTER TABLE `tb_user`
  ADD CONSTRAINT `user_FK` FOREIGN KEY (`profile_id`) REFERENCES `tb_profile` (`profile_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
