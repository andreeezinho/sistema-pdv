-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Generation Time: Dec 29, 2025 at 01:46 PM
-- Server version: 9.3.0
-- PHP Version: 8.2.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db`
--

-- --------------------------------------------------------

--
-- Table structure for table `clientes`
--

CREATE TABLE `clientes` (
  `id` int NOT NULL,
  `uuid` varchar(36) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `documento` varchar(18) DEFAULT NULL,
  `telefone` varchar(15) NOT NULL,
  `ie_rg` varchar(10) NOT NULL DEFAULT 'ISENTO',
  `contribuinte` tinyint(1) NOT NULL DEFAULT '0',
  `enderecos_id` int NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `clientes`
--

INSERT INTO `clientes` (`id`, `uuid`, `nome`, `email`, `documento`, `telefone`, `ie_rg`, `contribuinte`, `enderecos_id`, `ativo`, `created_at`, `updated_at`) VALUES
(1, '7410b9b2-83f9-49caeyay89ey849762d14', 'João da Silva', 'cliente@email.com', '13232121397', '(75) 99116-4106', 'ISENTO', 0, 1, 1, '2025-10-16 19:50:18', '2025-12-27 15:05:16');

-- --------------------------------------------------------

--
-- Table structure for table `cofins`
--

CREATE TABLE `cofins` (
  `id` int NOT NULL,
  `uuid` varchar(36) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `tributacao` float NOT NULL,
  `ativo` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `cofins`
--

INSERT INTO `cofins` (`id`, `uuid`, `nome`, `tributacao`, `ativo`, `created_at`, `updated_at`) VALUES
(2, '4e8dba46-5c5f-4a0b-8eb2-eb0a01cadef3', 'TRIBUTADO NORMAL', 7.6, 1, '2025-12-27 15:47:49', '2025-12-27 15:47:49'),
(3, 'daae1c1e-d33d-415b-9a12-c1c2692c798a', 'TRIBUTADO DIFERENCIADO', 9.65, 1, '2025-12-27 15:47:59', '2025-12-27 15:47:59'),
(4, '4eada673-e52f-40d9-8e85-0afbdf21ab4c', 'MONOFÁSICO', 0, 1, '2025-12-27 15:48:06', '2025-12-27 15:48:06'),
(5, 'bfbeaafb-e290-4971-bfab-6e65bd18e5e9', 'ALÍQUOTA ZERO', 0, 1, '2025-12-27 15:48:17', '2025-12-27 15:48:17'),
(6, '5fa60a9b-5f9f-40b6-9f9a-da7aa4cb4696', 'ISENTO', 0, 1, '2025-12-27 15:48:24', '2025-12-27 15:48:24');

-- --------------------------------------------------------

--
-- Table structure for table `emitente`
--

CREATE TABLE `emitente` (
  `id` int NOT NULL,
  `uuid` varchar(36) NOT NULL,
  `razao_social` varchar(255) NOT NULL,
  `nome_fantasia` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `documento` varchar(20) NOT NULL,
  `ie_rg` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `num_serie_nfe` int DEFAULT NULL,
  `enderecos_id` int NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `enderecos`
--

CREATE TABLE `enderecos` (
  `id` int NOT NULL,
  `uuid` varchar(36) NOT NULL,
  `cep` varchar(10) NOT NULL,
  `uf` varchar(2) DEFAULT NULL,
  `codigo` int NOT NULL,
  `ibge` int DEFAULT NULL,
  `cidade` varchar(150) NOT NULL,
  `rua` varchar(255) NOT NULL,
  `bairro` varchar(255) NOT NULL,
  `numero` varchar(10) NOT NULL DEFAULT 'S/N',
  `complemento` varchar(255) DEFAULT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `enderecos`
--

INSERT INTO `enderecos` (`id`, `uuid`, `cep`, `uf`, `codigo`, `ibge`, `cidade`, `rua`, `bairro`, `numero`, `complemento`, `ativo`, `created_at`, `updated_at`) VALUES
(1, '9e58d6d1-178d-4758-9e4e-a04g17947', '48790000', 'BA', 29, 25252, 'Tucano', 'Rua das Ruas', 'Bairro dos Bairros', 'S/N', NULL, 1, '2025-10-16 19:49:10', '2025-12-09 23:28:48');

-- --------------------------------------------------------

--
-- Table structure for table `entrada_produto`
--

CREATE TABLE `entrada_produto` (
  `id` int NOT NULL,
  `uuid` varchar(36) NOT NULL,
  `quantidade` varchar(100) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `ativo` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `entrada_produto`
--

INSERT INTO `entrada_produto` (`id`, `uuid`, `quantidade`, `tipo`, `ativo`, `created_at`, `updated_at`) VALUES
(28, 'eac03e98-8d23-4f66-8cff-90952d02g47c', '1', 'UN', 1, '2025-11-27 19:39:59', '2025-11-27 19:39:59'),
(29, 'bad52b44-9c73-4d99-afb3-502cgda1e12c', '24', 'CX', 1, '2025-11-27 19:39:59', '2025-11-27 19:39:59'),
(30, '7fb2d9d3-6b7a-4f1a-9c2a-13ba8gdad013', '12', 'CX', 1, '2025-11-27 19:39:59', '2025-11-27 19:39:59'),
(31, 'bad52b44-9c73-4d99-afb3-502caa1e1fdc', '8', 'CX', 1, '2025-11-27 19:39:59', '2025-11-27 19:39:59'),
(32, 'bad52b44-9c73-4d99-afb3-502cagffde2c', '6', 'CX', 1, '2025-11-27 19:39:59', '2025-11-27 19:39:59'),
(33, 'bad52b44-9c73-4d99-afb3-502cagakge2c', '4', 'CX', 1, '2025-11-27 19:39:59', '2025-11-27 19:39:59'),
(34, 'b1e4f89c-98d1-4325-a6c7-44bc31k4ka2e', '24', 'FD', 1, '2025-11-27 19:39:59', '2025-11-27 19:39:59'),
(35, 'b1e4f89c-98d1-4325-a6c7-44bc3kkg51a2', '12', 'FD', 1, '2025-11-27 19:39:59', '2025-11-27 19:39:59'),
(36, 'b1e4f89c-98d1-4325-a6c7-44bc31k31l2e', '8', 'FD', 1, '2025-11-27 19:39:59', '2025-11-27 19:39:59'),
(37, 'b1e4f89c-98d1-4325-a6c7-44bc3kg51a2e', '6', 'FD', 1, '2025-11-27 19:39:59', '2025-11-27 19:39:59'),
(38, 'b1e4f89c-98d1-4325-a6c7-44bc3lk51a2e', '4', 'FD', 1, '2025-11-27 19:39:59', '2025-11-27 19:39:59'),
(39, 'cd176a8f-c54f-4165-a16e-e66b1kldl5c6', '24', 'PC', 1, '2025-11-27 19:39:59', '2025-11-27 19:39:59'),
(40, 'cd176a8f-c54f-4165-a16e-e66bfc0hb5c6', '12', 'PC', 1, '2025-11-27 19:39:59', '2025-11-27 19:39:59'),
(41, 'cd176a8f-c54f-4165-a16e-e66b1y0d25c6', '8', 'PC', 1, '2025-11-27 19:39:59', '2025-11-27 19:39:59'),
(42, 'cd176a8f-c54f-4165-a16e-e66b1c0dbfc6', '6', 'PC', 1, '2025-11-27 19:39:59', '2025-11-27 19:39:59'),
(43, 'cd176a8f-c54f-4165-a16e-e66b1c0db5c6', '4', 'PC', 1, '2025-11-27 19:39:59', '2025-11-27 19:39:59'),
(44, '481917f6-8473-4de0-9c30-4c160434e7cb', '24', 'SC', 1, '2025-11-27 19:39:59', '2025-11-27 19:39:59'),
(45, '481917f6-8473-4de0-9c30-4c1604fbe7cb', '12', 'SC', 1, '2025-11-27 19:39:59', '2025-11-27 19:39:59'),
(46, '481917f6-8473-4de0-9c30-4c160f3ge7cb', '8', 'SC', 1, '2025-11-27 19:39:59', '2025-11-27 19:39:59'),
(47, '481917f6-8473-4de0-9c30-4c16053be7cb', '4', 'SC', 1, '2025-11-27 19:39:59', '2025-11-27 19:39:59'),
(48, '0dbf7e2a-61f4-4b4b-af43-cc64cg90brab', '1', 'KG', 1, '2025-11-27 19:39:59', '2025-11-27 19:39:59');

-- --------------------------------------------------------

--
-- Table structure for table `grupo_produto`
--

CREATE TABLE `grupo_produto` (
  `id` int NOT NULL,
  `uuid` varchar(36) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `ativo` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `grupo_produto`
--

INSERT INTO `grupo_produto` (`id`, `uuid`, `nome`, `ativo`, `created_at`, `updated_at`) VALUES
(1, 'c6c26550-d5c3-49dd-8678-6afafc4d16c6', 'Alimentos', 1, '2025-11-25 20:17:55', '2025-11-25 20:17:55'),
(2, 'f799d43e-388d-48a0-b7bd-7e608d170021', 'Limpeza', 1, '2025-12-27 15:51:13', '2025-12-27 15:51:13'),
(3, '4f8226cf-83d0-434a-8f05-84cc484fde15', 'Higiene Pessoal', 1, '2025-12-27 15:51:27', '2025-12-27 15:51:27'),
(4, 'd11459ef-8523-43ef-91d4-7c81a86d09e6', 'Bebidas', 1, '2025-12-27 15:51:32', '2025-12-27 15:51:32'),
(5, 'd6c19f1a-f4cb-4f2c-96ad-5062ca4be390', 'Pet Shop', 1, '2025-12-27 15:51:40', '2025-12-27 15:51:40'),
(6, '24391609-3cb1-4bd3-a4f8-933330b2e880', 'Cosméticos', 1, '2025-12-27 15:51:47', '2025-12-27 15:51:47'),
(7, '38499afc-f086-450d-b89b-3502d4d23179', 'Eletrônicos', 1, '2025-12-27 15:51:58', '2025-12-27 15:51:58'),
(8, '58b504a5-25bc-469b-9877-1fd0541b6e7b', 'Eletrodomésticos', 1, '2025-12-27 15:52:03', '2025-12-27 15:52:03'),
(9, 'c40d0cea-6b85-4bef-842f-edd298891dbb', 'Construção e Ferramentas', 1, '2025-12-27 15:52:22', '2025-12-27 15:52:22'),
(10, '66f19660-6c7c-4d23-a60c-d36410cf7c47', 'Conveniência', 1, '2025-12-27 15:52:35', '2025-12-27 15:52:35'),
(11, 'e8ab71a7-db64-4175-a827-6aca718ab62f', 'Utilidades', 1, '2025-12-27 15:52:53', '2025-12-27 15:52:53');

-- --------------------------------------------------------

--
-- Table structure for table `icms`
--

CREATE TABLE `icms` (
  `id` int NOT NULL,
  `uuid` varchar(36) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `tributacao` float NOT NULL,
  `ativo` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `icms`
--

INSERT INTO `icms` (`id`, `uuid`, `nome`, `tributacao`, `ativo`, `created_at`, `updated_at`) VALUES
(4, '9a782081-ff09-43ec-9a9a-ee3a6a4ef83c', 'TRIBUTADO 20,5%', 20.5, 1, '2025-12-27 15:43:04', '2025-12-27 15:43:04'),
(5, '89bef554-3d22-461f-895d-d139d4a7c1e6', 'ISENÇÃO TRIBUTÁRIA', 0, 1, '2025-12-27 15:43:18', '2025-12-27 15:43:18'),
(6, 'f2c3e413-403d-469d-b213-253e4203c9ab', 'NÃO TRIBUTADO', 0, 1, '2025-12-27 15:43:29', '2025-12-27 15:43:29'),
(7, 'ddd0d056-7b33-4459-9d61-70ac5bc798cf', 'TRIBUTADO 7%', 7, 1, '2025-12-27 15:43:41', '2025-12-27 15:43:41'),
(8, 'f03e9874-59a2-4a1f-b095-6056a5534090', 'TRIBUTADO 12%', 12, 1, '2025-12-27 15:43:52', '2025-12-27 15:43:52'),
(9, '586e9127-a1e7-4d4e-98b7-b2942b1deac2', 'TRIBUTADO COM REDUÇÃO 41,46%', 41.46, 1, '2025-12-27 15:44:07', '2025-12-27 15:44:07'),
(10, 'f634f757-a53e-4a32-b651-0cfa16628b5d', 'TRIBUTADO 22,5%', 22.5, 1, '2025-12-27 15:44:23', '2025-12-27 15:44:23');

-- --------------------------------------------------------

--
-- Table structure for table `ipi`
--

CREATE TABLE `ipi` (
  `id` int NOT NULL,
  `uuid` varchar(36) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `tributacao` float NOT NULL,
  `ativo` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `ipi`
--

INSERT INTO `ipi` (`id`, `uuid`, `nome`, `tributacao`, `ativo`, `created_at`, `updated_at`) VALUES
(2, 'e3196562-f034-484f-a395-f4c7790b6ac6', 'TRIBUTADO 5%', 5, 1, '2025-12-27 15:44:37', '2025-12-27 15:44:37'),
(3, 'd1dca54d-6e12-4d03-914b-d35e05cbc541', 'TRIBUTADO 10%', 10, 1, '2025-12-27 15:44:50', '2025-12-27 15:44:50'),
(4, 'e6b63c08-5d68-4ad2-a62a-3f0bb4c8f0b8', 'TRIBUTADO 15%', 15, 1, '2025-12-27 15:44:58', '2025-12-27 15:44:58'),
(5, 'b6e5dd68-63e3-4e0c-b612-0545e24fb92b', 'ALÍQUOTA ZERO 0%', 0, 1, '2025-12-27 15:45:08', '2025-12-27 15:45:08'),
(6, 'f473db7d-ed5b-4ac8-b45a-445376b11bc5', 'ISENTO', 0, 1, '2025-12-27 15:45:18', '2025-12-27 15:45:18');

-- --------------------------------------------------------

--
-- Table structure for table `origem`
--

CREATE TABLE `origem` (
  `id` int NOT NULL,
  `uuid` varchar(36) NOT NULL,
  `codigo` int NOT NULL,
  `nome` varchar(100) NOT NULL,
  `ativo` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `origem`
--

INSERT INTO `origem` (`id`, `uuid`, `codigo`, `nome`, `ativo`, `created_at`, `updated_at`) VALUES
(10, '7e4c3f1d-0c9f-4af0-b3af-9df6e8e2b4e1', 0, 'Nacional', 1, '2025-11-28 00:16:29', '2025-11-28 00:16:29'),
(11, 'c2b3bca4-1df2-4d6e-a93d-8ad7ae601d45', 1, 'Estrangeira – Importação Direta', 1, '2025-11-28 00:16:30', '2025-11-28 00:16:30'),
(12, '5f7a98aa-c2fe-4e32-a69c-139ef9d3145b', 2, 'Estrangeira – Adquirida no Mercado Interno', 1, '2025-11-28 00:16:30', '2025-11-28 00:16:30'),
(13, 'd9c35b78-e3fb-4e79-8b98-1576936af7d4', 3, 'Nacional com Conteúdo de Importação > 40%', 1, '2025-11-28 00:16:30', '2025-11-28 00:16:30'),
(14, '0f3f0c4c-67ad-4e6e-b6be-c6c3b99df2a1', 4, 'Nacional Produzida conforme PPB', 1, '2025-11-28 00:16:30', '2025-11-28 00:16:30'),
(15, 'b33e6f90-2a90-49cd-8e19-7543b9d9e0ed', 5, 'Nacional com Conteúdo de Importação ≤ 40%', 1, '2025-11-28 00:16:30', '2025-11-28 00:16:30'),
(16, '9a8b4bd7-2fd0-4c62-b06d-2410d62b87ea', 6, 'Estrangeira – Importação Direta sem Similar Nacional', 1, '2025-11-28 00:16:30', '2025-11-28 00:16:30'),
(17, 'fb1d2337-008f-4979-ada6-4fa56735d5d2', 7, 'Estrangeira – Mercado Interno sem Similar Nacional', 1, '2025-11-28 00:16:30', '2025-11-28 00:16:30'),
(18, 'e47241e0-774d-459e-b1b7-a2e8b93fe629', 8, 'Nacional – Conteúdo de Importação Indeterminado', 1, '2025-11-28 00:16:30', '2025-11-28 00:16:30');

-- --------------------------------------------------------

--
-- Table structure for table `pagamento`
--

CREATE TABLE `pagamento` (
  `id` int NOT NULL,
  `uuid` varchar(36) NOT NULL,
  `forma` varchar(100) NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pagamento`
--

INSERT INTO `pagamento` (`id`, `uuid`, `forma`, `ativo`, `created_at`, `updated_at`) VALUES
(2, 'dec50032-ac29-4622-9e73-8b36a551e74c', 'Dinheiro', 1, '2025-12-27 16:50:28', '2025-12-27 16:50:31'),
(3, 'a2a7b0cd-90d8-438a-a280-2503c148d24a', 'Pix', 1, '2025-12-27 16:50:35', '2025-12-27 16:50:35'),
(4, '3e6167e3-a817-4766-bef7-490b2c9210e6', 'Crédito', 1, '2025-12-27 16:50:40', '2025-12-27 16:50:40'),
(5, '57f5d8fa-e00b-4c74-9792-59a06c8b3b28', 'Débito', 1, '2025-12-27 16:50:45', '2025-12-27 16:50:45');

-- --------------------------------------------------------

--
-- Table structure for table `permissao_usuario`
--

CREATE TABLE `permissao_usuario` (
  `id` int NOT NULL,
  `uuid` varchar(36) NOT NULL,
  `permissoes_id` int NOT NULL,
  `usuarios_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissoes`
--

CREATE TABLE `permissoes` (
  `id` int NOT NULL,
  `uuid` varchar(36) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `tipo` enum('visualizar','cadastrar','editar','deletar') NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pis`
--

CREATE TABLE `pis` (
  `id` int NOT NULL,
  `uuid` varchar(36) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `tributacao` float NOT NULL,
  `ativo` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pis`
--

INSERT INTO `pis` (`id`, `uuid`, `nome`, `tributacao`, `ativo`, `created_at`, `updated_at`) VALUES
(3, '80c87b3e-2a3c-427e-8025-c3190c51ac8a', 'TRIBUTADO NORMAL', 1.65, 1, '2025-12-27 15:45:39', '2025-12-27 15:45:39'),
(4, 'd6836e21-e954-45f8-96f6-0de621dc46e6', 'TRIBUTADO DIFERENCIADO', 2.1, 1, '2025-12-27 15:45:47', '2025-12-27 15:45:47'),
(5, '6d9f6312-2af7-4821-ad05-931ad676b3bb', 'MONOFÁSICO', 0, 1, '2025-12-27 15:45:55', '2025-12-27 15:45:55'),
(6, '58d1a745-3933-46f5-98ab-d4b1a5d431ac', 'ISENTO', 0, 1, '2025-12-27 15:46:11', '2025-12-27 15:46:11');

-- --------------------------------------------------------

--
-- Table structure for table `produtos`
--

CREATE TABLE `produtos` (
  `id` int NOT NULL,
  `uuid` varchar(36) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `codigo` varchar(13) NOT NULL,
  `preco` float(7,2) NOT NULL,
  `estoque` float(7,2) NOT NULL,
  `tipo` enum('un','kg') NOT NULL,
  `grupo_produto_id` int NOT NULL,
  `entrada_produto_id` int NOT NULL,
  `saida_produto_id` int NOT NULL,
  `icms_id` int NOT NULL,
  `ipi_id` int NOT NULL,
  `pis_id` int NOT NULL,
  `cofins_id` int NOT NULL,
  `origem_id` int NOT NULL,
  `cfop` varchar(20) DEFAULT NULL,
  `ncm` varchar(25) DEFAULT NULL,
  `cest` varchar(25) DEFAULT NULL,
  `nat_receita` int DEFAULT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `recuperar_senha`
--

CREATE TABLE `recuperar_senha` (
  `id` int NOT NULL,
  `uuid` varchar(36) NOT NULL,
  `usuarios_id` int NOT NULL,
  `codigo` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `saida_produto`
--

CREATE TABLE `saida_produto` (
  `id` int NOT NULL,
  `uuid` varchar(36) NOT NULL,
  `quantidade` varchar(100) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `ativo` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `saida_produto`
--

INSERT INTO `saida_produto` (`id`, `uuid`, `quantidade`, `tipo`, `ativo`, `created_at`, `updated_at`) VALUES
(1, 'eac03e98-8d23-4f66-8cff-90952d02g47c', '1', 'UN', 1, '2025-11-27 19:43:17', '2025-11-27 19:43:17'),
(2, 'bad52b44-9c73-4d99-afb3-502cgda1e12c', '24', 'CX', 1, '2025-11-27 19:43:18', '2025-11-27 19:43:18'),
(3, '7fb2d9d3-6b7a-4f1a-9c2a-13ba8gdad013', '12', 'CX', 1, '2025-11-27 19:43:18', '2025-11-27 19:43:18'),
(4, 'bad52b44-9c73-4d99-afb3-502caa1e1fdc', '8', 'CX', 1, '2025-11-27 19:43:18', '2025-11-27 19:43:18'),
(5, 'bad52b44-9c73-4d99-afb3-502cagffde2c', '6', 'CX', 1, '2025-11-27 19:43:18', '2025-11-27 19:43:18'),
(6, 'bad52b44-9c73-4d99-afb3-502cagakge2c', '4', 'CX', 1, '2025-11-27 19:43:18', '2025-11-27 19:43:18'),
(7, 'b1e4f89c-98d1-4325-a6c7-44bc31k4ka2e', '24', 'FD', 1, '2025-11-27 19:43:18', '2025-11-27 19:43:18'),
(8, 'b1e4f89c-98d1-4325-a6c7-44bc3kkg51a2', '12', 'FD', 1, '2025-11-27 19:43:18', '2025-11-27 19:43:18'),
(9, 'b1e4f89c-98d1-4325-a6c7-44bc31k31l2e', '8', 'FD', 1, '2025-11-27 19:43:18', '2025-11-27 19:43:18'),
(10, 'b1e4f89c-98d1-4325-a6c7-44bc3kg51a2e', '6', 'FD', 1, '2025-11-27 19:43:18', '2025-11-27 19:43:18'),
(11, 'b1e4f89c-98d1-4325-a6c7-44bc3lk51a2e', '4', 'FD', 1, '2025-11-27 19:43:18', '2025-11-27 19:43:18'),
(12, 'cd176a8f-c54f-4165-a16e-e66b1kldl5c6', '24', 'PC', 1, '2025-11-27 19:43:18', '2025-11-27 19:43:18'),
(13, 'cd176a8f-c54f-4165-a16e-e66bfc0hb5c6', '12', 'PC', 1, '2025-11-27 19:43:18', '2025-11-27 19:43:18'),
(14, 'cd176a8f-c54f-4165-a16e-e66b1y0d25c6', '8', 'PC', 1, '2025-11-27 19:43:18', '2025-11-27 19:43:18'),
(15, 'cd176a8f-c54f-4165-a16e-e66b1c0dbfc6', '6', 'PC', 1, '2025-11-27 19:43:18', '2025-11-27 19:43:18'),
(16, 'cd176a8f-c54f-4165-a16e-e66b1c0db5c6', '4', 'PC', 1, '2025-11-27 19:43:18', '2025-11-27 19:43:18'),
(17, '481917f6-8473-4de0-9c30-4c160434e7cb', '24', 'SC', 1, '2025-11-27 19:43:18', '2025-11-27 19:43:18'),
(18, '481917f6-8473-4de0-9c30-4c1604fbe7cb', '12', 'SC', 1, '2025-11-27 19:43:18', '2025-11-27 19:43:18'),
(19, '481917f6-8473-4de0-9c30-4c160f3ge7cb', '8', 'SC', 1, '2025-11-27 19:43:18', '2025-11-27 19:43:18'),
(20, '481917f6-8473-4de0-9c30-4c16053be7cb', '4', 'SC', 1, '2025-11-27 19:43:18', '2025-11-27 19:43:18'),
(21, '0dbf7e2a-61f4-4b4b-af43-cc64cg90brab', '1', 'KG', 1, '2025-11-27 19:43:18', '2025-11-27 19:43:18');

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int NOT NULL,
  `uuid` varchar(36) NOT NULL,
  `usuario` varchar(100) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `telefone` varchar(15) DEFAULT NULL,
  `senha` varchar(255) NOT NULL,
  `online` tinyint(1) DEFAULT '0',
  `situacao` enum('banheiro','almoco','lanche','feedback','reuniao','em servico') DEFAULT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT '1',
  `cargo` enum('Administrativo','Frente de Caixa','Repositor','Entregador') NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `icone` varchar(255) DEFAULT 'default.png',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id`, `uuid`, `usuario`, `nome`, `email`, `cpf`, `telefone`, `senha`, `online`, `situacao`, `ativo`, `cargo`, `is_admin`, `icone`, `created_at`, `updated_at`) VALUES
(1, '9e58d6d1-178d-4758-9e4e-1b1d0a117947', 'adm', 'André Victor', 'admin@admin.com', '111.222.333-45', '(75) 99116-4106', '$2y$10$QNITTqPrt8aa0sICQsq2IuyiYzngUW4tFQKZq7wxwEqVnUOxvtUmy', 1, 'em servico', 1, 'Administrativo', 1, 'default.png', '2025-10-16 19:47:58', '2025-12-04 14:32:59'),
(2, '2f3957ca-ec33-4ea0-af86-10e2664d31ea', 'user', 'Maria Luiza', 'maria@maria.com', '555.619.762-64', '(11) 99116-4106', '$2y$10$h0.iqsjfa3PubcS.qn2U2.JoBCMd7YLdfXVQzjGvfdq0PLKMn735u', 0, 'em servico', 1, 'Frente de Caixa', 0, 'default.png', '2025-12-04 14:15:41', '2025-12-29 13:46:00');

-- --------------------------------------------------------

--
-- Table structure for table `vendas`
--

CREATE TABLE `vendas` (
  `id` int NOT NULL,
  `uuid` varchar(36) NOT NULL,
  `desconto` int NOT NULL DEFAULT '0',
  `total` float(7,2) DEFAULT NULL,
  `troco` float(7,2) NOT NULL DEFAULT '0.00',
  `usuarios_id` int NOT NULL,
  `situacao` enum('cancelada','em andamento','em espera','concluida') NOT NULL DEFAULT 'em andamento',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `venda_cliente`
--

CREATE TABLE `venda_cliente` (
  `id` int NOT NULL,
  `uuid` varchar(36) NOT NULL,
  `clientes_id` int NOT NULL,
  `vendas_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `venda_pagamento`
--

CREATE TABLE `venda_pagamento` (
  `id` int NOT NULL,
  `uuid` varchar(36) NOT NULL,
  `vendas_id` int NOT NULL,
  `pagamento_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `venda_produto`
--

CREATE TABLE `venda_produto` (
  `id` int NOT NULL,
  `uuid` varchar(36) NOT NULL,
  `quantidade` float(7,2) NOT NULL DEFAULT '1.00',
  `vendas_id` int NOT NULL,
  `produtos_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uuid_UNIQUE` (`uuid`),
  ADD KEY `fk_clientes_enderecos1_idx` (`enderecos_id`);

--
-- Indexes for table `cofins`
--
ALTER TABLE `cofins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uuid_UNIQUE` (`uuid`);

--
-- Indexes for table `emitente`
--
ALTER TABLE `emitente`
  ADD PRIMARY KEY (`id`,`enderecos_id`),
  ADD UNIQUE KEY `uuid_UNIQUE` (`uuid`),
  ADD KEY `fk_emitente_enderecos1_idx` (`enderecos_id`);

--
-- Indexes for table `enderecos`
--
ALTER TABLE `enderecos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uuid_UNIQUE` (`uuid`);

--
-- Indexes for table `entrada_produto`
--
ALTER TABLE `entrada_produto`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uuid_UNIQUE` (`uuid`);

--
-- Indexes for table `grupo_produto`
--
ALTER TABLE `grupo_produto`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uuid_UNIQUE` (`uuid`);

--
-- Indexes for table `icms`
--
ALTER TABLE `icms`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uuid_UNIQUE` (`uuid`);

--
-- Indexes for table `ipi`
--
ALTER TABLE `ipi`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uuid_UNIQUE` (`uuid`);

--
-- Indexes for table `origem`
--
ALTER TABLE `origem`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uuid_UNIQUE` (`uuid`);

--
-- Indexes for table `pagamento`
--
ALTER TABLE `pagamento`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uuid_UNIQUE` (`uuid`);

--
-- Indexes for table `permissao_usuario`
--
ALTER TABLE `permissao_usuario`
  ADD PRIMARY KEY (`id`,`permissoes_id`,`usuarios_id`),
  ADD UNIQUE KEY `uuid_UNIQUE` (`uuid`),
  ADD KEY `fk_permissao_usuario_permissoes1_idx` (`permissoes_id`),
  ADD KEY `fk_permissao_usuario_usuarios1_idx` (`usuarios_id`);

--
-- Indexes for table `permissoes`
--
ALTER TABLE `permissoes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uuid_UNIQUE` (`uuid`);

--
-- Indexes for table `pis`
--
ALTER TABLE `pis`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uuid_UNIQUE` (`uuid`);

--
-- Indexes for table `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uuid_UNIQUE` (`uuid`),
  ADD KEY `fk_produtos_grupo_produto1_idx` (`grupo_produto_id`),
  ADD KEY `fk_produtos_entrada_produto1_idx` (`entrada_produto_id`),
  ADD KEY `fk_produtos_saida_produto1_idx` (`saida_produto_id`),
  ADD KEY `fk_produtos_icms1_idx` (`icms_id`),
  ADD KEY `fk_produtos_ipi1_idx` (`ipi_id`),
  ADD KEY `fk_produtos_pis1_idx` (`pis_id`),
  ADD KEY `fk_produtos_origem1_idx` (`origem_id`),
  ADD KEY `fk_produtos_cofins1_idx` (`cofins_id`);

--
-- Indexes for table `recuperar_senha`
--
ALTER TABLE `recuperar_senha`
  ADD PRIMARY KEY (`id`,`usuarios_id`),
  ADD UNIQUE KEY `uuid_UNIQUE` (`uuid`),
  ADD KEY `fk_recuperar_senha_usuarios1_idx` (`usuarios_id`);

--
-- Indexes for table `saida_produto`
--
ALTER TABLE `saida_produto`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uuid_UNIQUE` (`uuid`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uuid_UNIQUE` (`uuid`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`),
  ADD UNIQUE KEY `cpf_UNIQUE` (`cpf`),
  ADD UNIQUE KEY `usuario_UNIQUE` (`usuario`);

--
-- Indexes for table `vendas`
--
ALTER TABLE `vendas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uuid_UNIQUE` (`uuid`),
  ADD KEY `fk_vendas_usuarios1_idx` (`usuarios_id`);

--
-- Indexes for table `venda_cliente`
--
ALTER TABLE `venda_cliente`
  ADD PRIMARY KEY (`id`,`clientes_id`,`vendas_id`),
  ADD UNIQUE KEY `uuid_UNIQUE` (`uuid`),
  ADD KEY `fk_venda_fiado_clientes1_idx` (`clientes_id`),
  ADD KEY `fk_venda_fiado_vendas1_idx` (`vendas_id`);

--
-- Indexes for table `venda_pagamento`
--
ALTER TABLE `venda_pagamento`
  ADD PRIMARY KEY (`id`,`vendas_id`,`pagamento_id`),
  ADD UNIQUE KEY `uuid_UNIQUE` (`uuid`),
  ADD KEY `fk_venda_pagamento_vendas1_idx` (`vendas_id`),
  ADD KEY `fk_venda_pagamento_pagamento1_idx` (`pagamento_id`);

--
-- Indexes for table `venda_produto`
--
ALTER TABLE `venda_produto`
  ADD PRIMARY KEY (`id`,`vendas_id`,`produtos_id`),
  ADD UNIQUE KEY `uuid_UNIQUE` (`uuid`),
  ADD KEY `fk_venda_produto_vendas1_idx` (`vendas_id`),
  ADD KEY `fk_venda_produto_produtos1_idx` (`produtos_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cofins`
--
ALTER TABLE `cofins`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `emitente`
--
ALTER TABLE `emitente`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `enderecos`
--
ALTER TABLE `enderecos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `entrada_produto`
--
ALTER TABLE `entrada_produto`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `grupo_produto`
--
ALTER TABLE `grupo_produto`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `icms`
--
ALTER TABLE `icms`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `ipi`
--
ALTER TABLE `ipi`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `origem`
--
ALTER TABLE `origem`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `pagamento`
--
ALTER TABLE `pagamento`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `permissao_usuario`
--
ALTER TABLE `permissao_usuario`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissoes`
--
ALTER TABLE `permissoes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pis`
--
ALTER TABLE `pis`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `recuperar_senha`
--
ALTER TABLE `recuperar_senha`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `saida_produto`
--
ALTER TABLE `saida_produto`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `vendas`
--
ALTER TABLE `vendas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `venda_cliente`
--
ALTER TABLE `venda_cliente`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `venda_pagamento`
--
ALTER TABLE `venda_pagamento`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `venda_produto`
--
ALTER TABLE `venda_produto`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `clientes`
--
ALTER TABLE `clientes`
  ADD CONSTRAINT `fk_clientes_enderecos1` FOREIGN KEY (`enderecos_id`) REFERENCES `enderecos` (`id`);

--
-- Constraints for table `emitente`
--
ALTER TABLE `emitente`
  ADD CONSTRAINT `fk_emitente_enderecos1` FOREIGN KEY (`enderecos_id`) REFERENCES `enderecos` (`id`);

--
-- Constraints for table `permissao_usuario`
--
ALTER TABLE `permissao_usuario`
  ADD CONSTRAINT `fk_permissao_usuario_permissoes1` FOREIGN KEY (`permissoes_id`) REFERENCES `permissoes` (`id`),
  ADD CONSTRAINT `fk_permissao_usuario_usuarios1` FOREIGN KEY (`usuarios_id`) REFERENCES `usuarios` (`id`);

--
-- Constraints for table `produtos`
--
ALTER TABLE `produtos`
  ADD CONSTRAINT `fk_produtos_cofins1` FOREIGN KEY (`cofins_id`) REFERENCES `cofins` (`id`),
  ADD CONSTRAINT `fk_produtos_entrada_produto1` FOREIGN KEY (`entrada_produto_id`) REFERENCES `entrada_produto` (`id`),
  ADD CONSTRAINT `fk_produtos_grupo_produto1` FOREIGN KEY (`grupo_produto_id`) REFERENCES `grupo_produto` (`id`),
  ADD CONSTRAINT `fk_produtos_icms1` FOREIGN KEY (`icms_id`) REFERENCES `icms` (`id`),
  ADD CONSTRAINT `fk_produtos_ipi1` FOREIGN KEY (`ipi_id`) REFERENCES `ipi` (`id`),
  ADD CONSTRAINT `fk_produtos_origem1` FOREIGN KEY (`origem_id`) REFERENCES `origem` (`id`),
  ADD CONSTRAINT `fk_produtos_pis1` FOREIGN KEY (`pis_id`) REFERENCES `pis` (`id`),
  ADD CONSTRAINT `fk_produtos_saida_produto1` FOREIGN KEY (`saida_produto_id`) REFERENCES `saida_produto` (`id`);

--
-- Constraints for table `recuperar_senha`
--
ALTER TABLE `recuperar_senha`
  ADD CONSTRAINT `fk_recuperar_senha_usuarios1` FOREIGN KEY (`usuarios_id`) REFERENCES `usuarios` (`id`);

--
-- Constraints for table `vendas`
--
ALTER TABLE `vendas`
  ADD CONSTRAINT `fk_vendas_usuarios1` FOREIGN KEY (`usuarios_id`) REFERENCES `usuarios` (`id`);

--
-- Constraints for table `venda_cliente`
--
ALTER TABLE `venda_cliente`
  ADD CONSTRAINT `fk_venda_fiado_clientes1` FOREIGN KEY (`clientes_id`) REFERENCES `clientes` (`id`),
  ADD CONSTRAINT `fk_venda_fiado_vendas1` FOREIGN KEY (`vendas_id`) REFERENCES `vendas` (`id`);

--
-- Constraints for table `venda_pagamento`
--
ALTER TABLE `venda_pagamento`
  ADD CONSTRAINT `fk_venda_pagamento_pagamento1` FOREIGN KEY (`pagamento_id`) REFERENCES `pagamento` (`id`),
  ADD CONSTRAINT `fk_venda_pagamento_vendas1` FOREIGN KEY (`vendas_id`) REFERENCES `vendas` (`id`);

--
-- Constraints for table `venda_produto`
--
ALTER TABLE `venda_produto`
  ADD CONSTRAINT `fk_venda_produto_produtos1` FOREIGN KEY (`produtos_id`) REFERENCES `produtos` (`id`),
  ADD CONSTRAINT `fk_venda_produto_vendas1` FOREIGN KEY (`vendas_id`) REFERENCES `vendas` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
