-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 13, 2019 at 12:45 AM
-- Server version: 5.7.24-log
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `cinqtest`
--
CREATE DATABASE IF NOT EXISTS `cinqtest` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `cinqtest`;

-- --------------------------------------------------------

--
-- Table structure for table `con_produto`
--

CREATE TABLE `con_produto` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_varejista` int(11) UNSIGNED NOT NULL,
  `nm_produto` text,
  `desc_produto` text,
  `preco` double(14,2) UNSIGNED NOT NULL DEFAULT '0.00',
  `imagem` text,
  `dt_criacao` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `publicado` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `ativo` tinyint(1) UNSIGNED NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `con_produto`
--

INSERT INTO `con_produto` (`id`, `id_varejista`, `nm_produto`, `desc_produto`, `preco`, `imagem`, `dt_criacao`, `publicado`, `ativo`) VALUES
(1, 1, 'Manopla do Infinito', 'Manopla do Infinito Eletrônica - HasbroA Manopla do Infinito foi desenhada pelo temível Thanos para receber as Joias do Infinito. Quando todas as joias estão montadas na manopla, o usuário deste objeto vai se tornar praticamente onipotente.\r\n\r\nFonte: https://www.americanas.com.br/produto/33495497/manopla-do-infinito-eletronica-hasbro?pfm_carac=Bonecos&pfm_index=2&pfm_page=category&pfm_pos=grid&pfm_type=vit_product_grid&sellerId', 10.90, '20190513002125imagem01.jpg', '2019-05-12 21:04:39', 1, 1),
(2, 1, 'Boneco Star Wars Ep7 Deluxe 18', 'Que tal recriar as aventuras da Saga Star Wars com o robô BB-8 da DTC?\r\n\r\nCom este boneco poderá relembrar as cenas históricas da saga e ainda colecionar os personagens preferidos, a criançada vai se divertir e as brincadeiras vão ficar ainda mais emocionante.\r\nInclua nas brincadeiras do seu filho a Saga Star Wars ou colecione este acessório para relembrar os momentos marcantes. Aproveite!\r\n\r\nImagens meramente ilustrativas.\r\nTodas as informações divulgadas são de responsabilidade do Fabricante/Fornecedor.\r\nObserve atentamente a idade recomendada para o brinquedo. Pode conter partes pequenas que podem ser engolidas.\r\n\r\nFonte: https://www.americanas.com.br/produto/128798171/boneco-star-wars-ep7-deluxe-18-bb-8-dtc?pfm_carac=Bonecos&pfm_index=4&pfm_page=category&pfm_pos=grid&pfm_type=vit_product_grid&sellerId', 20.99, '20190513002412imagem02.jpg', '2019-05-13 00:23:35', 1, 1),
(3, 2, 'Máscara Eletrônica Capitão América Fx Homem de Ferro - Hasbro', 'Que tal recriar as cenas de aventuras do Capitão América?\r\nCom a Máscara Eletrônica Capitão América Fx Homem de Ferro, da Hasbro isso é possível. Desenvolvida em plástico, conta com tira ajustável para garantir todo conforto.\r\nO personagem favorito do seu filho, para deixar as brincadeiras ainda mais emocionante. Aproveite!\r\n\r\nImagens Meramente Ilustrativas.\r\nTodas as Informações divulgadas são de responsabilidade do Fabricante/Fornecedor.\r\nObserve atentamente a idade recomendada para o brinquedo. Pode conter partes pequenas que podem ser engolidas e perigosas.\r\n\r\nFonte: https://www.americanas.com.br/produto/126516053/mascara-eletronica-capitao-america-fx-homem-de-ferro-hasbro?pfm_carac=Bonecos&pfm_index=3&pfm_page=category&pfm_pos=grid&pfm_type=vit_product_grid&sellerId', 31.25, '20190513002536imagem03.jpg', '2019-05-13 00:24:52', 1, 1),
(4, 2, 'Boneco Homem de Ferro - Vingadores E1410 - Hasbro', 'Os Vingadores se juntam para mais uma aventura com a linha Titan Hero Series. Os personagens são inspirados no próximo filme dos Vingadores: Guerra Infinita. Os bonecos possuem 5 pontos de articulação e efeitos sonoros ativados com o uso do \"Power Pack\", que é vendido separadamente.\r\n\r\nImagens meramente ilustrativas.\r\nTodas as informações divulgadas são de responsabilidade do Fabricante/Fornecedor.\r\nObserve atentamente a idade recomendada para o brinquedo. Pode conter partes pequenas que podem ser engolidas.\r\n\r\nFonte: https://www.americanas.com.br/produto/133302707/boneco-homem-de-ferro-vingadores-e1410-hasbro?pfm_carac=Bonecos&pfm_index=5&pfm_page=category&pfm_pos=grid&pfm_type=vit_product_grid&sellerId', 42.90, '20190513002618imagem04.jpg', '2019-05-13 00:25:42', 1, 1),
(5, 2, 'Boneco Thanos - Vingadores E0572 - Hasbro', 'Figura sólida do Thanos com aproximadamente 30cm, com 5 pontos de articulação e com suas características do filme. Falas e sons ativados com o uso do \"Power FX\", que é vendido separadamente.\r\n\r\nImagens meramente ilustrativas.\r\nTodas as informações divulgadas são de responsabilidade do Fabricante/Fornecedor.\r\nObserve atentamente a idade recomendada para o brinquedo. Pode conter partes pequenas que podem ser engolidas.\r\n\r\nFonte: https://www.americanas.com.br/produto/133302723/boneco-thanos-vingadores-e0572-hasbro?pfm_carac=Bonecos&pfm_index=6&pfm_page=category&pfm_pos=grid&pfm_type=vit_product_grid&sellerId', 53.30, '20190513002701imagem05.jpg', '2019-05-13 00:26:23', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `con_varejista`
--

CREATE TABLE `con_varejista` (
  `id` int(10) UNSIGNED NOT NULL,
  `nm_varejista` text,
  `desc_varejista` text,
  `site` text,
  `logo` text,
  `dt_criacao` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `publicado` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `ativo` tinyint(1) UNSIGNED NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `con_varejista`
--

INSERT INTO `con_varejista` (`id`, `nm_varejista`, `desc_varejista`, `site`, `logo`, `dt_criacao`, `publicado`, `ativo`) VALUES
(1, 'Roda Gigante', 'Existe um mundo em que as brincadeiras acontecem a todo o momento, um ambiente coberto de sonhos e fantasias. Neste lugar os carros andam por rodovias de tapete e as top models medem apenas 30 cm. Nela a única responsabilidade é ser feliz. Conheça este mundo de diversões.\r\n\r\nFonte: https://www.americanas.com.br/lojista/roda-gigante', 'https://www.americanas.com.br/lojista/roda-gigante', '20190513002257varejista01.jpg', '2019-05-12 19:41:19', 1, 1),
(2, 'Brinquedos de Montão', 'A BQD nasceu do sonho de um colecionador que queria trabalhar com o que mais gosta e entende: brinquedos. Em 2013 decidiu se profissionalizar e abrir a BQD para poder fazer o que gosta, cada vez melhor.\r\n\r\nFonte: https://www.americanas.com.br/lojista/brinquedos-de-montao', 'https://www.americanas.com.br/lojista/brinquedos-de-montao', '20190513002324varejista02.jpg', '2019-05-13 00:23:01', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `seg_categoria_tipo_transacao`
--

CREATE TABLE `seg_categoria_tipo_transacao` (
  `id` int(11) UNSIGNED NOT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  `dt_categoria_tipo_transacao` datetime DEFAULT CURRENT_TIMESTAMP,
  `publicado` tinyint(1) UNSIGNED DEFAULT '0',
  `ativo` tinyint(1) UNSIGNED DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `seg_categoria_tipo_transacao`
--

INSERT INTO `seg_categoria_tipo_transacao` (`id`, `descricao`, `dt_categoria_tipo_transacao`, `publicado`, `ativo`) VALUES
(1, 'Permissao', '2011-12-22 10:00:00', 1, 1),
(2, 'Acesso', '2011-12-22 10:00:00', 1, 1),
(3, 'Grupos', '2019-05-05 19:35:15', 1, 1),
(4, 'Usuario', '2011-12-22 10:00:00', 1, 1),
(5, 'Transacao', '2019-05-02 16:56:45', 1, 1),
(6, 'Produto', '2019-05-11 14:10:24', 1, 1),
(7, 'Varejista', '2019-05-11 14:10:42', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `seg_erros_mysql`
--

CREATE TABLE `seg_erros_mysql` (
  `id` int(10) UNSIGNED NOT NULL,
  `erro` longtext,
  `id_usuario` int(10) DEFAULT NULL,
  `ip` text,
  `dt_erro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `publicado` tinyint(1) UNSIGNED DEFAULT '0',
  `ativo` tinyint(1) UNSIGNED DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `seg_grupo_usuario`
--

CREATE TABLE `seg_grupo_usuario` (
  `id` int(11) UNSIGNED NOT NULL,
  `nm_grupo_usuario` varchar(255) DEFAULT NULL,
  `dt_grupo_usuario` datetime DEFAULT CURRENT_TIMESTAMP,
  `publicado` tinyint(1) UNSIGNED DEFAULT '0',
  `ativo` tinyint(1) UNSIGNED DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `seg_grupo_usuario`
--

INSERT INTO `seg_grupo_usuario` (`id`, `nm_grupo_usuario`, `dt_grupo_usuario`, `publicado`, `ativo`) VALUES
(1, 'Administrador', '2011-12-22 10:05:35', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `seg_permissao`
--

CREATE TABLE `seg_permissao` (
  `id_tipo_transacao` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `id_grupo_usuario` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `dt_permissao` datetime DEFAULT CURRENT_TIMESTAMP,
  `publicado` tinyint(1) UNSIGNED DEFAULT '0',
  `ativo` tinyint(1) UNSIGNED DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `seg_permissao`
--

INSERT INTO `seg_permissao` (`id_tipo_transacao`, `id_grupo_usuario`, `dt_permissao`, `publicado`, `ativo`) VALUES
(1, 1, '2011-12-22 10:00:00', 1, 1),
(2, 1, '2011-12-22 10:00:00', 1, 1),
(3, 1, '2011-12-22 10:00:00', 1, 1),
(4, 1, '2011-12-22 10:00:00', 1, 1),
(5, 1, '2011-12-22 10:00:00', 1, 1),
(6, 1, '2011-12-22 10:00:00', 1, 1),
(7, 1, '2011-12-22 10:00:00', 1, 1),
(8, 1, '2011-12-22 10:00:00', 1, 1),
(9, 1, '2011-12-22 10:00:00', 1, 1),
(10, 1, '2011-12-22 10:00:00', 1, 1),
(11, 1, '2011-12-22 10:00:00', 1, 1),
(12, 1, '2011-12-22 10:00:00', 1, 1),
(13, 1, '2011-12-22 10:00:00', 1, 1),
(14, 1, '2011-12-22 10:00:00', 1, 1),
(15, 1, '2011-12-22 10:00:00', 1, 1),
(16, 1, '2011-12-22 10:00:00', 1, 1),
(17, 1, '2011-12-22 10:00:00', 1, 1),
(18, 1, '2011-12-22 10:00:00', 1, 1),
(19, 1, '2011-12-22 10:00:00', 1, 1),
(20, 1, '2011-12-22 10:00:00', 1, 1),
(21, 1, '2011-12-22 10:00:00', 1, 1),
(22, 1, '2019-05-02 16:49:57', 1, 1),
(23, 1, '2019-05-02 16:49:57', 1, 1),
(24, 1, '2019-05-02 16:49:57', 1, 1),
(25, 1, '2019-05-02 16:49:57', 1, 1),
(26, 1, '2019-05-02 16:49:57', 1, 1),
(27, 1, '2019-05-02 16:52:39', 1, 1),
(28, 1, '2019-05-02 16:56:43', 1, 1),
(29, 1, '2019-05-07 20:48:20', 1, 1),
(30, 1, '2019-05-07 20:48:20', 1, 1),
(31, 1, '2019-05-07 20:48:20', 1, 1),
(32, 1, '2019-05-07 20:48:20', 1, 1),
(33, 1, '2019-05-07 20:48:20', 1, 1),
(34, 1, '2019-05-07 23:10:43', 1, 1),
(35, 1, '2019-05-07 23:10:43', 1, 1),
(36, 1, '2019-05-07 23:10:43', 1, 1),
(37, 1, '2019-05-07 23:10:43', 1, 1),
(38, 1, '2019-05-07 23:10:43', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `seg_tipo_transacao`
--

CREATE TABLE `seg_tipo_transacao` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_categoria_tipo_transacao` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `transacao` varchar(255) DEFAULT NULL,
  `dt_tipo_transacao` datetime DEFAULT CURRENT_TIMESTAMP,
  `publicado` tinyint(1) UNSIGNED DEFAULT '0',
  `ativo` tinyint(1) UNSIGNED DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `seg_tipo_transacao`
--

INSERT INTO `seg_tipo_transacao` (`id`, `id_categoria_tipo_transacao`, `transacao`, `dt_tipo_transacao`, `publicado`, `ativo`) VALUES
(1, 1, 'Alterar', '2011-12-22 10:00:00', 1, 1),
(2, 2, 'Login', '2011-12-22 10:00:00', 1, 1),
(3, 2, 'Logout', '2011-12-22 10:00:00', 1, 1),
(4, 3, 'Visualizar', '2011-12-22 10:00:00', 1, 1),
(5, 3, 'Alterar', '2011-12-22 10:00:00', 1, 1),
(6, 3, 'Cadastrar', '2011-12-22 10:00:00', 1, 1),
(7, 3, 'Excluir', '2011-12-22 10:00:00', 1, 1),
(8, 3, 'Desativar', '2011-12-22 10:00:00', 1, 1),
(9, 4, 'Visualizar', '2011-12-22 10:00:00', 1, 1),
(10, 4, 'Alterar', '2011-12-22 10:00:00', 1, 1),
(11, 4, 'AlterarSenha', '2011-12-22 10:00:00', 1, 1),
(12, 4, 'Cadastrar', '2011-12-22 10:00:00', 1, 1),
(13, 4, 'Excluir', '2011-12-22 10:00:00', 1, 1),
(14, 4, 'Desativar', '2011-12-22 10:00:00', 1, 1),
(15, 5, 'Visualizar', '2011-12-22 10:00:00', 1, 1),
(16, 5, 'Alterar', '2011-12-22 10:00:00', 1, 1),
(17, 5, 'Cadastrar', '2011-12-22 10:00:00', 1, 1),
(18, 5, 'Excluir', '2011-12-22 10:00:00', 1, 1),
(19, 5, 'Desativar', '2011-12-22 10:00:00', 1, 1),
(20, 5, 'VerLog', '2011-12-22 10:00:00', 1, 1),
(21, 5, 'VerErro', '2011-12-22 10:00:00', 1, 1),
(22, 6, 'Visualizar', '2019-05-02 16:49:57', 1, 1),
(23, 6, 'Cadastrar', '2019-05-02 16:49:57', 1, 1),
(24, 6, 'Alterar', '2019-05-02 16:49:57', 1, 1),
(25, 6, 'Desativar', '2019-05-02 16:49:57', 1, 1),
(26, 6, 'Teste', '2019-05-02 16:49:57', 1, 1),
(27, 6, 'Excluir', '2019-05-02 16:52:38', 1, 1),
(28, 5, 'VerErrosMySQL', '2019-05-02 16:56:43', 1, 1),
(34, 7, 'Visualizar', '2019-05-11 14:10:39', 1, 1),
(35, 7, 'Cadastrar', '2019-05-11 14:10:39', 1, 1),
(36, 7, 'Alterar', '2019-05-11 14:10:39', 1, 1),
(37, 7, 'Excluir', '2019-05-11 14:10:39', 1, 1),
(38, 7, 'Desativar', '2019-05-11 14:10:39', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `seg_transacao`
--

CREATE TABLE `seg_transacao` (
  `id` bigint(50) UNSIGNED NOT NULL,
  `id_tipo_transacao` int(11) UNSIGNED DEFAULT '0',
  `id_usuario` int(11) UNSIGNED DEFAULT '0',
  `objeto` longtext,
  `ip` varchar(255) DEFAULT NULL,
  `dt_transacao` datetime DEFAULT CURRENT_TIMESTAMP,
  `publicado` tinyint(1) UNSIGNED DEFAULT '1',
  `ativo` tinyint(1) UNSIGNED DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `seg_transacao`
--

INSERT INTO `seg_transacao` (`id`, `id_tipo_transacao`, `id_usuario`, `objeto`, `ip`, `dt_transacao`, `publicado`, `ativo`) VALUES
(1, 28, 2, 'Usuário Admin Test acessou o log de erros de mysql do sistema!', '::1', '2019-05-13 00:41:51', 1, 1),
(2, 21, 2, 'Usuário Admin Test acessou o log de erros do sistema!', '::1', '2019-05-13 00:41:54', 1, 1),
(3, 20, 2, 'Usuário Admin Test acessou o log de transações do sistema!', '::1', '2019-05-13 00:41:55', 1, 1),
(4, 15, 2, 'Usuário Admin Test acessou a gerência de transações do sistema!', '::1', '2019-05-13 00:41:56', 1, 1),
(5, 4, 2, 'Usuário Admin Test acessou a lista de grupos de usuários do sistema!', '::1', '2019-05-13 00:41:58', 1, 1),
(6, 9, 2, 'Usuário Admin Test acessou a lista de usuários do sistema!', '::1', '2019-05-13 00:42:02', 1, 1),
(7, 10, 2, 'Usuário Admin Test liberou a disponibilidade de novo login para o usuário: admin', '::1', '2019-05-13 00:42:05', 1, 1),
(8, 9, 2, 'Usuário Admin Test acessou a lista de usuários do sistema!', '::1', '2019-05-13 00:42:11', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `seg_transacao_acesso`
--

CREATE TABLE `seg_transacao_acesso` (
  `id` bigint(50) UNSIGNED NOT NULL,
  `id_tipo_transacao` int(11) UNSIGNED DEFAULT '0',
  `id_usuario` int(11) UNSIGNED DEFAULT '0',
  `objeto` longtext,
  `ip` varchar(255) DEFAULT NULL,
  `dt_transacao` datetime DEFAULT CURRENT_TIMESTAMP,
  `publicado` tinyint(1) UNSIGNED DEFAULT '1',
  `ativo` tinyint(1) UNSIGNED DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `seg_usuario`
--

CREATE TABLE `seg_usuario` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_grupo_usuario` int(11) UNSIGNED DEFAULT '0',
  `nm_usuario` varchar(255) DEFAULT NULL,
  `login` varchar(255) DEFAULT NULL,
  `senha` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `logado` tinyint(1) UNSIGNED DEFAULT '0',
  `dt_usuario` datetime DEFAULT CURRENT_TIMESTAMP,
  `publicado` tinyint(1) UNSIGNED DEFAULT '0',
  `ativo` tinyint(1) UNSIGNED DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `seg_usuario`
--

INSERT INTO `seg_usuario` (`id`, `id_grupo_usuario`, `nm_usuario`, `login`, `senha`, `email`, `logado`, `dt_usuario`, `publicado`, `ativo`) VALUES
(1, 1, 'Dávìd Këstêrîng', 'david', 'tudobem', 'davidkestering@gmail.com', 0, '2011-12-22 10:20:34', 1, 1),
(2, 1, 'Admin Test', 'admin', 'admin', 'admin@test.com.br', 0, '2019-05-12 20:17:24', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `con_produto`
--
ALTER TABLE `con_produto`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `con_varejista`
--
ALTER TABLE `con_varejista`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seg_categoria_tipo_transacao`
--
ALTER TABLE `seg_categoria_tipo_transacao`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `descricao` (`descricao`);

--
-- Indexes for table `seg_erros_mysql`
--
ALTER TABLE `seg_erros_mysql`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `seg_grupo_usuario`
--
ALTER TABLE `seg_grupo_usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nm_grupo_usuario` (`nm_grupo_usuario`);

--
-- Indexes for table `seg_permissao`
--
ALTER TABLE `seg_permissao`
  ADD PRIMARY KEY (`id_tipo_transacao`,`id_grupo_usuario`);

--
-- Indexes for table `seg_tipo_transacao`
--
ALTER TABLE `seg_tipo_transacao`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categoria_tipo_transacao` (`id_categoria_tipo_transacao`,`transacao`);

--
-- Indexes for table `seg_transacao`
--
ALTER TABLE `seg_transacao`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seg_transacao_acesso`
--
ALTER TABLE `seg_transacao_acesso`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seg_usuario`
--
ALTER TABLE `seg_usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`,`ativo`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `con_produto`
--
ALTER TABLE `con_produto`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `con_varejista`
--
ALTER TABLE `con_varejista`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `seg_categoria_tipo_transacao`
--
ALTER TABLE `seg_categoria_tipo_transacao`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `seg_erros_mysql`
--
ALTER TABLE `seg_erros_mysql`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `seg_grupo_usuario`
--
ALTER TABLE `seg_grupo_usuario`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `seg_tipo_transacao`
--
ALTER TABLE `seg_tipo_transacao`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `seg_transacao`
--
ALTER TABLE `seg_transacao`
  MODIFY `id` bigint(50) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `seg_transacao_acesso`
--
ALTER TABLE `seg_transacao_acesso`
  MODIFY `id` bigint(50) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `seg_usuario`
--
ALTER TABLE `seg_usuario`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;
