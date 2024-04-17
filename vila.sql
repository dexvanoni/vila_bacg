-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 18-Jan-2023 às 12:55
-- Versão do servidor: 8.0.31
-- versão do PHP: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `vila`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `autorizacoes`
--

DROP TABLE IF EXISTS `autorizacoes`;
CREATE TABLE IF NOT EXISTS `autorizacoes` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `autorizacao` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `autorizacoes`
--

INSERT INTO `autorizacoes` (`id`, `autorizacao`, `created_at`, `updated_at`) VALUES
(1, 'Permissionário', NULL, NULL),
(2, 'Dependente', NULL, NULL),
(3, 'Sócio-Titular', NULL, NULL),
(4, 'Sócio-Dependente', NULL, NULL),
(5, 'Funcionário Escola', NULL, NULL),
(6, 'Responsável por aluno', NULL, NULL),
(7, 'Prestador de serviço', NULL, NULL),
(8, 'Portaria', NULL, NULL),
(9, 'Síndico', NULL, NULL),
(10, 'Administrador', NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `avisos`
--

DROP TABLE IF EXISTS `avisos`;
CREATE TABLE IF NOT EXISTS `avisos` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `titulo` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `dono` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mensagem` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `duracao` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `a_quem` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `arquivo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prioridade` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `avisos`
--

INSERT INTO `avisos` (`id`, `titulo`, `dono`, `mensagem`, `duracao`, `a_quem`, `arquivo`, `prioridade`, `created_at`, `updated_at`) VALUES
(2, 'Fabiana Bezerra de Souza Vanoni', 'WALTER', 'Fabiana teste', '1', 'TODOS', 'CARTEIRA_TRAB_FABIANA_1673024738.pdf', 'Média', '2023-01-06 20:05:38', '2023-01-06 20:05:38'),
(23, 'Onca', 'DENIS VIEIRA VANONI', 'Onca', '2', 'TODOS', '20230106_113123_1673240591.jpg', 'Baixa', '2023-01-09 04:03:11', '2023-01-09 04:03:11'),
(24, 'Convênio ECO PARK', 'DENIS VIEIRA VANONI', '<b>Furada total..kkkk</b>', '1', 'TODOS', '306271739_5284552948333395_7090192510539636224_n_1673731030.jpg', 'Baixa', '2023-01-14 20:17:10', '2023-01-14 20:17:10');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cad_vis_entrada`
--

DROP TABLE IF EXISTS `cad_vis_entrada`;
CREATE TABLE IF NOT EXISTS `cad_vis_entrada` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `onesignal_id` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `apelido` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nome_completo` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `doc` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `funcao` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `veiculo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cor_veiculo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `liberador` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `destino` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dt_entrada` date NOT NULL,
  `dt_saida` date NOT NULL,
  `hr_entrada` time NOT NULL,
  `hr_saida` time NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `movimentacao` text COLLATE utf8mb4_unicode_ci,
  `dt_entrou` date DEFAULT NULL,
  `hr_entrou` time DEFAULT NULL,
  `dt_saiu` date DEFAULT NULL,
  `hr_saiu` time DEFAULT NULL,
  `observacao` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `cad_vis_entrada`
--

INSERT INTO `cad_vis_entrada` (`id`, `onesignal_id`, `apelido`, `nome_completo`, `doc`, `funcao`, `veiculo`, `cor_veiculo`, `liberador`, `destino`, `dt_entrada`, `dt_saida`, `hr_entrada`, `hr_saida`, `status`, `movimentacao`, `dt_entrou`, `hr_entrou`, `dt_saiu`, `hr_saiu`, `observacao`, `created_at`, `updated_at`) VALUES
(14, '13', 'Roberlan', 'Roberlan', 'Sem função', 'Convidado de Evento', 'Fiesta', 'branco', 'Fabiana Bezerra de Souza Vanoni', 'ALSS', '2023-01-11', '2023-01-11', '21:24:00', '23:24:00', 'Liberado', 'S', '2023-01-12', '12:07:00', '2023-01-12', '12:31:00', 'Churrasco', '2023-01-12 00:24:33', '2023-01-12 00:24:33'),
(13, '13', 'Motorista App', 'Nome do motorista (Uber, 99)', 'Sem função', 'Motorista', 'Particular', 'Sem função', 'Fabiana Bezerra de Souza Vanoni', 'PNR - F.2018', '2023-01-13', '2023-01-13', '21:21:00', '23:21:00', 'Liberado', 'A', NULL, NULL, NULL, NULL, 'Novo teste', '2023-01-12 00:21:47', '2023-01-12 00:21:47'),
(12, '13', 'IFood', 'Nome do entregador', 'Sem função', 'Entregador', 'Particular', 'Sem função', 'Fabiana Bezerra de Souza Vanoni', 'PNR - F.2018', '2023-01-11', '2023-01-11', '20:53:00', '22:53:00', 'Liberado', 'S', '2023-01-12', '12:35:00', '2023-01-12', '21:34:00', 'Teste', '2023-01-11 23:53:32', '2023-01-11 23:53:32'),
(11, '3', 'Denis o mestre', 'DENIS VIEIRA VANONI', '00470162139', 'Desenvolvedor', 'moto', NULL, 'DENIS VIEIRA VANONI', 'Escola', '2023-01-11', '2023-01-11', '15:35:00', '18:36:00', 'Liberado', 'S', '2023-01-12', '18:50:00', '2023-01-13', '19:32:00', 'teste', NULL, NULL),
(15, '14', 'Mudança', 'Nome do motorista (Uber, 99)', 'Sem função', 'Motorista', 'Particular', 'Sem função', 'Walter', 'PNR - F.2017', '2023-01-11', '2023-01-11', '21:38:00', '23:38:00', 'Liberado', 'A', NULL, NULL, NULL, NULL, 'Teste Walter', '2023-01-12 00:38:52', '2023-01-12 00:38:52'),
(16, '14', 'Particular', 'Nome do entregador', 'Sem função', 'Entregador', 'Particular', 'Sem função', 'Walter', 'PNR - F.2017', '2023-01-12', '2023-01-12', '07:18:00', '12:18:00', 'Liberado', 'A', NULL, NULL, NULL, NULL, 'nad', '2023-01-12 10:18:53', '2023-01-12 10:18:53'),
(17, '14', 'Motorista App', 'Nome do motorista (Uber, 99)', 'Sem função', 'Motorista', 'Particular', 'Sem função', 'Walter', 'PNR - F.2017', '2023-01-12', '2023-01-12', '07:23:00', '12:23:00', 'Liberado', 'A', NULL, NULL, NULL, NULL, 'nnn', '2023-01-12 10:23:54', '2023-01-12 10:23:54'),
(18, '14', 'Motorista App', 'Nome do motorista (Uber, 99)', 'Sem função', 'Motorista', 'Particular', 'Sem função', 'Walter', 'PNR - F.2017', '2023-01-12', '2023-01-12', '07:23:00', '12:23:00', 'Liberado', 'E', '2023-01-12', '18:49:00', NULL, NULL, 'nnn', '2023-01-12 10:23:55', '2023-01-12 10:23:55'),
(19, '3', 'IFood', 'Nome do entregador', 'Sem função', 'Entregador', 'Particular', 'Sem função', 'DENIS VIEIRA VANONI', 'Escola', '2023-01-12', '2023-01-12', '14:36:00', '16:36:00', 'Liberado', 'S', '2023-01-12', '14:48:00', '2023-01-12', '14:48:00', 'Nada', '2023-01-12 17:36:30', '2023-01-12 17:36:30'),
(20, '3', 'IFood', 'Nome do entregador', 'Sem função', 'Entregador', 'Particular', 'Sem função', 'DENIS VIEIRA VANONI', 'Escola', '2023-01-12', '2023-01-12', '21:31:00', '22:32:00', 'Liberado', 'S', '2023-01-12', '21:33:00', '2023-01-12', '21:33:00', 'Teste de persistência', '2023-01-13 00:32:42', '2023-01-13 00:32:42'),
(21, '13', 'IFood', 'Nome do entregador', 'Sem função', 'Entregador', 'Particular', 'Sem função', 'Fabiana Bezerra de Souza Vanoni', 'PNR - F.2018', '2023-01-13', '2023-01-13', '10:17:00', '11:17:00', 'Liberado', 'E', '2023-01-13', '10:19:00', NULL, NULL, 'Teste de persistência de observação', '2023-01-13 13:17:55', '2023-01-13 13:17:55'),
(22, '13', 'IFood', 'Nome do entregador', 'Sem função', 'Entregador', 'Particular', 'Sem função', 'Fabiana Bezerra de Souza Vanoni', 'PNR - F.2018', '2023-01-13', '2023-01-13', '10:21:00', '11:21:00', 'Liberado', 'E', '2023-01-13', '10:21:00', NULL, NULL, 'Teste de persistência de observação', '2023-01-13 13:21:34', '2023-01-13 13:21:34'),
(23, '13', 'IFood', 'Nome do entregador', 'Sem função', 'Entregador', 'Particular', 'Sem função', 'Fabiana Bezerra de Souza Vanoni', 'PNR - F.2018', '2023-01-13', '2023-01-13', '10:26:00', '11:26:00', 'Liberado', 'S', '2023-01-13', '10:26:00', '2023-01-13', '19:31:00', 'Teste de persistência', '2023-01-13 13:26:29', '2023-01-13 13:26:29'),
(24, '13', 'João', 'João', 'Sem função', 'Convidado de Evento', 'moto', 'verde', 'Fabiana Bezerra de Souza Vanoni', 'ALCTS', '2023-01-13', '2023-01-13', '10:29:00', '11:29:00', 'Liberado', 'E', '2023-01-13', '10:29:00', NULL, NULL, 'Teste de persistência', '2023-01-13 13:29:30', '2023-01-13 13:29:30'),
(25, '13', 'IFood', 'Nome do entregador', 'Sem função', 'Entregador', 'Particular', 'Sem função', 'Fabiana Bezerra de Souza Vanoni', 'PNR - F.2018', '2023-01-13', '2023-01-13', '10:30:00', '13:31:00', 'Liberado', 'S', '2023-01-13', '10:32:00', '2023-01-13', '10:32:00', NULL, '2023-01-13 13:31:42', '2023-01-13 13:31:42'),
(26, '13', 'Roberlan', 'Roberlan', 'Sem função', 'Convidado de Evento', 'Fiesta', 'branco', 'Fabiana Bezerra de Souza Vanoni', 'PNR - F.2018', '2023-01-13', '2023-01-13', '10:40:00', '11:40:00', 'Liberado', 'S', '2023-01-13', '10:41:00', '2023-01-13', '10:41:00', NULL, '2023-01-13 13:40:42', '2023-01-13 13:40:42'),
(27, '13', 'Motorista App', 'Nome do motorista (Uber, 99)', 'Sem função', 'Motorista', 'Particular', 'Sem função', 'Fabiana Bezerra de Souza Vanoni', 'PNR - F.2018', '2023-01-13', '2023-01-27', '13:25:00', '14:25:00', 'Liberado', 'E', '2023-01-13', '13:42:00', NULL, NULL, NULL, '2023-01-13 16:25:38', '2023-01-13 16:25:38'),
(28, '3', 'IFood', 'Nome do entregador', 'Sem função', 'Entregador', 'Particular', 'Sem função', 'DENIS VIEIRA VANONI', 'Escola', '2023-01-13', '2023-01-13', '18:59:00', '21:00:00', 'Liberado', 'E', '2023-01-13', '19:18:00', NULL, NULL, 'Nada', '2023-01-13 22:00:22', '2023-01-13 22:00:22'),
(29, '3', 'Transportadora', 'Nome do motorista (Uber, 99)', 'Sem função', 'Motorista', 'Particular', 'Sem função', 'DENIS VIEIRA VANONI', 'Escola', '2023-01-13', '2023-01-13', '15:02:00', '22:05:00', 'Liberado', 'INVÁLIDA', '2023-01-14', '09:36:00', NULL, NULL, 'teste', '2023-01-13 22:02:38', '2023-01-13 22:02:38'),
(30, '3', 'Particular', 'Nome do entregador', 'Sem função', 'Entregador', 'Particular', 'Sem função', 'DENIS VIEIRA VANONI', 'Escola', '2023-01-11', '2023-01-12', '19:43:00', '21:43:00', 'Liberado', 'INVÁLIDA', '2023-01-13', '19:43:00', NULL, NULL, 'teste', '2023-01-13 22:43:39', '2023-01-13 22:43:39'),
(31, '3', 'Robert', 'Robert Jao', '00470162139', 'Amigo', 'Fiesta', 'verde', 'DENIS VIEIRA VANONI', 'Escola', '2023-01-14', '2023-01-14', '09:35:00', '18:36:00', 'Liberado', 'S', '2023-01-14', '09:37:00', '2023-01-14', '09:37:00', 'Teste', NULL, NULL),
(32, '13', 'Motorista App', 'Nome do motorista (Uber, 99)', 'Sem função', 'Motorista', 'Particular', 'Sem função', 'Fabiana Bezerra de Souza Vanoni', 'PNR - F.2018', '2023-01-14', '2023-01-14', '09:38:00', '14:38:00', 'Liberado', 'A', NULL, NULL, NULL, NULL, NULL, '2023-01-14 12:38:45', '2023-01-14 12:38:45'),
(33, '3', 'IFood', 'Nome do entregador', 'Sem função', 'Entregador', 'Particular', 'Sem função', 'DENIS VIEIRA VANONI', 'PNR - F.2018', '2023-01-15', '2023-01-15', '09:36:00', '11:36:00', 'Liberado', 'E', '2023-01-15', '09:36:00', NULL, NULL, 'teste', '2023-01-15 12:36:44', '2023-01-15 12:36:44');

-- --------------------------------------------------------

--
-- Estrutura da tabela `lista_ingresso`
--

DROP TABLE IF EXISTS `lista_ingresso`;
CREATE TABLE IF NOT EXISTS `lista_ingresso` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `portao` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `onesignal_portaria` text COLLATE utf8mb4_unicode_ci,
  `dono` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `local_evento` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `dt_evento` date NOT NULL,
  `hr_evento` time NOT NULL,
  `qtn` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `arquivo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `lista_ingresso`
--

INSERT INTO `lista_ingresso` (`id`, `portao`, `onesignal_portaria`, `dono`, `local_evento`, `dt_evento`, `hr_evento`, `qtn`, `arquivo`, `created_at`, `updated_at`) VALUES
(1, 'PVSS - Vila dos Suboficiais e Sargentos (Taveirópolis)', NULL, 'DENIS VIEIRA VANONI', 'ALSS', '2023-01-15', '10:00:00', '10', 'camiseta_1673746167.pdf', '2023-01-15 00:29:27', '2023-01-15 00:29:27'),
(2, 'PVO - Vila dos Oficiais (Duque de Caxias)', NULL, 'DENIS VIEIRA VANONI', 'ALOF', '2023-01-15', '10:00:00', '10', 'Pasta_de_trabalho_6_1673746372.pdf', '2023-01-15 00:32:52', '2023-01-15 00:32:52'),
(3, 'PVO - Vila dos Oficiais (Duque de Caxias)', NULL, 'DENIS VIEIRA VANONI', 'ALOF', '2023-01-15', '00:00:00', '10', 'ESTATUTO_TROJAN_AIRSOFT_TEAM_1673055213_1673751252.pdf', '2023-01-15 01:54:12', '2023-01-15 01:54:12'),
(4, 'PVO - Vila dos Oficiais (Duque de Caxias)', '16', 'DENIS VIEIRA VANONI', 'ALOF', '2023-01-15', '18:00:00', '10', 'ESTATUTO_TROJAN_AIRSOFT_TEAM_1673055213_1673751874.pdf', '2023-01-15 02:04:34', '2023-01-15 02:04:34'),
(5, 'PVO - Vila dos Oficiais (Duque de Caxias)', '16', 'DENIS VIEIRA VANONI', 'ALOF', '2023-01-15', '06:07:00', '10', 'push_1673752023.txt', '2023-01-17 02:07:03', '2023-01-15 02:07:03'),
(6, 'PVO - Vila dos Oficiais (Duque de Caxias)', '16', 'DENIS VIEIRA VANONI', 'ALOF', '2023-01-15', '18:42:00', '10', 'ESTATUTO_TROJAN_AIRSOFT_TEAM_1673055213_1673808126.pdf', '2023-01-15 17:42:06', '2023-01-15 17:42:06'),
(7, 'PVSS - Vila dos Suboficiais e Sargentos (Taveirópolis)', '17', 'DENIS VIEIRA VANONI', 'ALSS', '2023-01-21', '16:00:00', '25', 'IE_ES_EAOF_2023_1674006117.pdf', '2023-01-18 00:41:57', '2023-01-18 00:41:57'),
(8, 'PVO - Vila dos Oficiais (Duque de Caxias)', '16', 'DENIS VIEIRA VANONI', 'ALOF', '2023-01-18', '23:39:00', '55', 'modelo_lista_1674009587.pdf', '2023-01-18 01:39:47', '2023-01-18 01:39:47'),
(9, 'PVSS - Vila dos Suboficiais e Sargentos (Taveirópolis)', '17', 'DENIS VIEIRA VANONI', 'ALSS', '2023-01-19', '20:18:00', '502', 'modelo_lista_1674009619.pdf', '2023-01-18 01:40:19', '2023-01-18 01:40:19');

-- --------------------------------------------------------

--
-- Estrutura da tabela `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2023_01_05_181033_crete_autorizacoes_table', 2),
(4, '2023_01_06_114233_create_avisos_table', 3),
(5, '2023_01_08_155448_create_liberar_table', 4),
(6, '2023_01_10_082513_create_ocorrencias_table', 5),
(7, '2023_01_14_173619_create_lista_table', 6);

-- --------------------------------------------------------

--
-- Estrutura da tabela `ocorrencias`
--

DROP TABLE IF EXISTS `ocorrencias`;
CREATE TABLE IF NOT EXISTS `ocorrencias` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `dono` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mensagem` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `a_quem` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prioridade` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `arquivo` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `ocorrencias`
--

INSERT INTO `ocorrencias` (`id`, `dono`, `mensagem`, `a_quem`, `prioridade`, `status`, `arquivo`, `created_at`, `updated_at`) VALUES
(6, 'DENIS VIEIRA VANONI', 'logo Flamengo', 'Escola', 'Baixa', 'Novo', 'flamengo-logo-0_1673399970.png', '2023-01-11 00:19:30', '2023-01-11 00:19:30'),
(2, 'DENIS VIEIRA VANONI', 'teste', 'Escola', 'Média', 'Novo', NULL, '2023-01-10 23:57:26', '2023-01-10 23:57:26'),
(3, 'DENIS VIEIRA VANONI', 'aaaaa', 'Escola', 'Baixa', 'Novo', NULL, '2023-01-10 23:58:20', '2023-01-10 23:58:20'),
(4, 'DENIS VIEIRA VANONI', 'tttt', 'Escola', 'Baixa', 'Novo', NULL, '2023-01-10 23:59:28', '2023-01-10 23:59:28'),
(5, 'DENIS VIEIRA VANONI', 'aaa', 'Escola', 'Baixa', 'Novo', 'cav_1673398817.png', '2023-01-11 00:00:17', '2023-01-11 00:00:17'),
(7, 'DENIS VIEIRA VANONI', 'Teste foto Teste foto Teste foto Teste foto Teste foto Teste foto Teste foto Teste foto Teste foto Teste foto Teste foto Teste foto Teste foto Teste foto Teste foto Teste foto Teste foto Teste foto Teste foto Teste foto Teste foto Teste foto Teste foto Teste foto Teste foto Teste foto Teste foto Teste foto Teste foto Teste foto Teste foto Teste foto Teste foto Teste foto Teste foto Teste foto Teste foto Teste foto Teste foto Teste foto Teste foto Teste foto Teste foto Teste foto Teste foto Teste foto', 'Escola', 'Baixa', 'Novo', 'df7aa8377fed39018353d7a351e4bbd3_1673400635.jpg', '2023-01-11 00:30:35', '2023-01-11 00:30:35'),
(8, 'DENIS VIEIRA VANONI', 'Miguel', 'Escola', 'Baixa', 'Novo', 'IMG_20230109_172235312_1673401022.jpg', '2023-01-11 00:37:02', '2023-01-11 00:37:02');

-- --------------------------------------------------------

--
-- Estrutura da tabela `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('vanonidvv@fab.mil.br', '$2y$10$PifL4QzFnVed75eRze.RCOjYji1BzCYaHGyvS1dR4.q22CFIyLpKW', '2023-01-09 11:54:52');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `autorizacao` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `local` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `autorizacao`, `local`, `created_at`, `updated_at`) VALUES
(3, 'DENIS VIEIRA VANONI', 'vanonidvv@fab.mil.br', NULL, '$2y$10$pow3aCu9bR02X3rCkBD7HunJZe4BYMuSUIx8W4gYcu6js1C0BOhAu', 'Y7DE53OSxSDuOfJmsMOkrtIRgqQ8BxoZaz6SXB42qfPDs1qdd8uYMI8hyWvP', 'ad', 'PNR - F.2018', '2023-01-06 00:06:45', '2023-01-06 00:08:11'),
(16, 'PVO - Portão Vila dos Oficiais', 'pvo_sisvila@gmail.com', NULL, '$2y$10$wRn5p4E.EIIBoPz.Uj3dzuncFPnXMAoedUhKeaPRMOj9kBdMXzKh2', 'zhKzPiBxoROU6mHEUqISkUV0fqSlIEeaMtQf6Q6Ruw3QKrWS1zUC8ysgK023', 'po', 'PVO', '2023-01-15 01:22:30', '2023-01-15 01:22:30'),
(13, 'Fabiana Bezerra de Souza Vanoni', 'fabianartv@gmail.com', NULL, '$2y$10$iQpj4BEWcuDlB7Q.w0q9aO9kKOZJ08/uvqH8zJ2xm5//985/2lyAW', 'K5jQ21s9ln3yhLPK2tRUgsVLXWT1725Pbsib4puxzkKRVj9TZISAI4zw9Gr9', 'de,sd', 'PNR - F.2018', '2023-01-11 23:51:45', '2023-01-11 23:51:45'),
(15, 'Sgt Walter', 'walter@gmail.com', NULL, '$2y$10$ev5OnVTwhOtt4TOJ6cKtHeIcL5mYQGERdHCEri73zziFL5Ot7GvVm', NULL, 'ad', 'PNR - F.2010', '2023-01-14 15:34:41', '2023-01-14 15:34:41'),
(17, 'PVSS - Portão Vila dos Suboficiais e Sargentos', 'pvss_sisvila@gmail.com', NULL, '$2y$10$IkvAv6HjxhJ/Taw7NKRW6OJeXi.1vX7NoakG56h22TvIBsJvPoaK2', NULL, 'po', 'PVSS', '2023-01-15 01:24:17', '2023-01-15 01:24:17');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
