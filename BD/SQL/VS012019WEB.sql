-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 14, 2019 at 07:44 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.1.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `VS012019WEB`
--

-- --------------------------------------------------------

--
-- Table structure for table `Ator`
--

CREATE TABLE `Ator` (
  `Atr_Codigo` int(11) NOT NULL,
  `Atr_Nome` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Atr_DataNasc` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `Ator`
--

INSERT INTO `Ator` (`Atr_Codigo`, `Atr_Nome`, `Atr_DataNasc`) VALUES
(1, 'Brie Larson', '1989-11-01'),
(2, 'Samuel L. Jackson', '1948-12-21'),
(3, 'Jude Law', '1972-12-29');

-- --------------------------------------------------------

--
-- Table structure for table `AtorFilme`
--

CREATE TABLE `AtorFilme` (
  `Atfl_Codigo` int(11) NOT NULL,
  `Atfl_Atr_Codigo` int(11) DEFAULT NULL,
  `Atfl_Fil_Codigo` int(11) DEFAULT NULL,
  `Atfl_Papel` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Atfl_Importancia` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `AtorFilme`
--

INSERT INTO `AtorFilme` (`Atfl_Codigo`, `Atfl_Atr_Codigo`, `Atfl_Fil_Codigo`, `Atfl_Papel`, `Atfl_Importancia`) VALUES
(1, 1, 1, 'Capita Marvel', 1),
(2, 2, 1, 'Nick Fury', 2),
(3, 3, 1, 'Yon-Rogg', 2);

-- --------------------------------------------------------

--
-- Table structure for table `Classificacao`
--

CREATE TABLE `Classificacao` (
  `Cla_Codigo` int(11) NOT NULL,
  `Cla_Descricao` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Classificacao`
--

INSERT INTO `Classificacao` (`Cla_Codigo`, `Cla_Descricao`) VALUES
(1, 'Livre');

-- --------------------------------------------------------

--
-- Table structure for table `Comentario`
--

CREATE TABLE `Comentario` (
  `Com_Codigo` int(11) NOT NULL,
  `Com_Usuario` int(11) DEFAULT NULL,
  `Com_Comentario` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `Com_Gostou` int(11) DEFAULT NULL,
  `Com_NaoGostou` int(11) DEFAULT NULL,
  `Com_Avaliacao` int(11) DEFAULT NULL,
  `Com_Filme` int(11) DEFAULT NULL,
  `Com_Data` datetime DEFAULT NULL,
  `Com_Situacao` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Comentario`
--

INSERT INTO `Comentario` (`Com_Codigo`, `Com_Usuario`, `Com_Comentario`, `Com_Gostou`, `Com_NaoGostou`, `Com_Avaliacao`, `Com_Filme`, `Com_Data`, `Com_Situacao`) VALUES
(1, 1, 'Eu gostei Mais ou Menos do filme : /', 0, 0, 4, 1, '2019-05-14 14:43:18', '1'),
(2, 1, 'Eu gostei Mais ou Menos do filme : /', 0, 1, 3, 1, '2019-05-14 14:40:34', '1'),
(3, 1, 'Eu gostei Mais ou Menos do filme : /', 1, 0, 3, 1, '2019-05-14 14:40:34', '1'),
(14, 1, 'Eu gostei Mais ou Menos do filme : /', 0, 0, 3, 1, '2019-05-14 14:40:34', 'T'),
(15, 1, 'Eu gostei Mais ou Menos do filme : /', 0, 0, 3, 1, '2019-05-14 14:40:34', 'T'),
(16, 1, 'Eu gostei Mais ou Menos do filme : /', 0, 0, 3, 1, '2019-05-14 14:40:34', 'T');

-- --------------------------------------------------------

--
-- Table structure for table `Distribuidora`
--

CREATE TABLE `Distribuidora` (
  `Dis_Codigo` int(11) NOT NULL,
  `Dis_RazaoSocial` varchar(50) DEFAULT NULL,
  `Dis_NomeFantasia` varchar(50) DEFAULT NULL,
  `Dis_Cnpj` varchar(14) DEFAULT NULL,
  `Dis_Site` varchar(100) DEFAULT NULL,
  `Dis_Email` varchar(100) DEFAULT NULL,
  `Dis_Endereco` varchar(60) DEFAULT NULL,
  `Dis_Bairro` varchar(40) DEFAULT NULL,
  `Dis_Cidade` varchar(32) DEFAULT NULL,
  `Dis_Estado` char(2) DEFAULT NULL,
  `Dis_Numero` varchar(5) DEFAULT NULL,
  `Dis_Ie` varchar(14) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Distribuidora`
--

INSERT INTO `Distribuidora` (`Dis_Codigo`, `Dis_RazaoSocial`, `Dis_NomeFantasia`, `Dis_Cnpj`, `Dis_Site`, `Dis_Email`, `Dis_Endereco`, `Dis_Bairro`, `Dis_Cidade`, `Dis_Estado`, `Dis_Numero`, `Dis_Ie`) VALUES
(1, NULL, 'Marvel', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `Filmes`
--

CREATE TABLE `Filmes` (
  `Fil_Codigo` int(11) NOT NULL,
  `Fil_Titulo` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Fil_Sinopse` text COLLATE utf8_unicode_ci,
  `Fil_Foto` text COLLATE utf8_unicode_ci,
  `Fil_Lancamento` date DEFAULT NULL,
  `Fil_Tempo` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Fil_Genero` int(11) DEFAULT NULL,
  `Fil_Classificacao` int(11) DEFAULT NULL,
  `Fil_Distribuidora` int(11) DEFAULT NULL,
  `Fil_Situacao` varchar(7) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `Filmes`
--

INSERT INTO `Filmes` (`Fil_Codigo`, `Fil_Titulo`, `Fil_Sinopse`, `Fil_Foto`, `Fil_Lancamento`, `Fil_Tempo`, `Fil_Genero`, `Fil_Classificacao`, `Fil_Distribuidora`, `Fil_Situacao`) VALUES
(1, 'Capita Marvel', 'Carol Danvers (Brie Larson) é uma ex-agente da Força Aérea norte-americana, que, sem se lembrar de sua vida na Terra, é recrutada pelos Kree para fazer parte de seu exército de elite. Inimiga declarada dos Skrull, ela acaba voltando ao seu planeta de origem para impedir uma invasão dos metaformos, e assim vai acabar descobrindo a verdade sobre si, com a ajuda do agente Nick Fury (Samuel L. Jackson) e da gata Goose.', 'img/filmes/capa-capita-marvel.jpg', '2019-03-07', '2h10', 1, 1, 1, 'Cartaz');

-- --------------------------------------------------------

--
-- Table structure for table `Genero`
--

CREATE TABLE `Genero` (
  `Gen_Codigo` int(11) NOT NULL,
  `Gen_Descricao` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Genero`
--

INSERT INTO `Genero` (`Gen_Codigo`, `Gen_Descricao`) VALUES
(1, 'Aventura');

-- --------------------------------------------------------

--
-- Table structure for table `Moderador`
--

CREATE TABLE `Moderador` (
  `Mod_Codigo` int(11) NOT NULL,
  `Mod_Usuario` varchar(25) NOT NULL,
  `Mod_Nome` varchar(50) DEFAULT NULL,
  `Mod_Senha` varchar(20) DEFAULT NULL,
  `Mod_Email` varchar(100) DEFAULT NULL,
  `Mod_Telefone` varchar(15) DEFAULT NULL,
  `Mod_CPF` char(11) DEFAULT NULL,
  `Mod_Situacao` varchar(7) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Usuario`
--

CREATE TABLE `Usuario` (
  `Usu_Codigo` int(11) NOT NULL,
  `Usu_Usuario` varchar(25) NOT NULL,
  `Usu_Nome` varchar(50) DEFAULT NULL,
  `Usu_Senha` varchar(20) DEFAULT NULL,
  `Usu_Email` varchar(100) DEFAULT NULL,
  `Usu_Situacao` varchar(7) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Usuario`
--

INSERT INTO `Usuario` (`Usu_Codigo`, `Usu_Usuario`, `Usu_Nome`, `Usu_Senha`, `Usu_Email`, `Usu_Situacao`) VALUES
(1, 'caio', 'Caio Eduardo', '123456', 'souzacaiodu@cinemep.com', 'Ativo'),
(2, 'dudu', 'Eduardo Du', '123456', 'dudu@cinemep.br', 'Ativo'),
(3, 'igor', 'Igor Eduardo', '123456', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Inativo');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Ator`
--
ALTER TABLE `Ator`
  ADD PRIMARY KEY (`Atr_Codigo`);

--
-- Indexes for table `AtorFilme`
--
ALTER TABLE `AtorFilme`
  ADD PRIMARY KEY (`Atfl_Codigo`),
  ADD KEY `Atfl_Atr_Codigo` (`Atfl_Atr_Codigo`),
  ADD KEY `Atfl_Fil_Codigo` (`Atfl_Fil_Codigo`);

--
-- Indexes for table `Classificacao`
--
ALTER TABLE `Classificacao`
  ADD PRIMARY KEY (`Cla_Codigo`);

--
-- Indexes for table `Comentario`
--
ALTER TABLE `Comentario`
  ADD PRIMARY KEY (`Com_Codigo`),
  ADD KEY `Com_Usuario` (`Com_Usuario`),
  ADD KEY `Com_Filme` (`Com_Filme`);

--
-- Indexes for table `Distribuidora`
--
ALTER TABLE `Distribuidora`
  ADD PRIMARY KEY (`Dis_Codigo`);

--
-- Indexes for table `Filmes`
--
ALTER TABLE `Filmes`
  ADD PRIMARY KEY (`Fil_Codigo`),
  ADD KEY `Fil_Genero` (`Fil_Genero`),
  ADD KEY `Fil_Distribuidora` (`Fil_Distribuidora`),
  ADD KEY `Fil_Classificacao` (`Fil_Classificacao`);

--
-- Indexes for table `Genero`
--
ALTER TABLE `Genero`
  ADD PRIMARY KEY (`Gen_Codigo`);

--
-- Indexes for table `Moderador`
--
ALTER TABLE `Moderador`
  ADD PRIMARY KEY (`Mod_Codigo`);

--
-- Indexes for table `Usuario`
--
ALTER TABLE `Usuario`
  ADD PRIMARY KEY (`Usu_Codigo`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Ator`
--
ALTER TABLE `Ator`
  MODIFY `Atr_Codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `AtorFilme`
--
ALTER TABLE `AtorFilme`
  MODIFY `Atfl_Codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `Classificacao`
--
ALTER TABLE `Classificacao`
  MODIFY `Cla_Codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `Comentario`
--
ALTER TABLE `Comentario`
  MODIFY `Com_Codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `Distribuidora`
--
ALTER TABLE `Distribuidora`
  MODIFY `Dis_Codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `Filmes`
--
ALTER TABLE `Filmes`
  MODIFY `Fil_Codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `Genero`
--
ALTER TABLE `Genero`
  MODIFY `Gen_Codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `Moderador`
--
ALTER TABLE `Moderador`
  MODIFY `Mod_Codigo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Usuario`
--
ALTER TABLE `Usuario`
  MODIFY `Usu_Codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `AtorFilme`
--
ALTER TABLE `AtorFilme`
  ADD CONSTRAINT `AtorFilme_ibfk_1` FOREIGN KEY (`Atfl_Atr_Codigo`) REFERENCES `Ator` (`Atr_Codigo`),
  ADD CONSTRAINT `AtorFilme_ibfk_2` FOREIGN KEY (`Atfl_Fil_Codigo`) REFERENCES `Filmes` (`Fil_Codigo`);

--
-- Constraints for table `Comentario`
--
ALTER TABLE `Comentario`
  ADD CONSTRAINT `Comentario_ibfk_1` FOREIGN KEY (`Com_Usuario`) REFERENCES `Usuario` (`Usu_Codigo`),
  ADD CONSTRAINT `Comentario_ibfk_2` FOREIGN KEY (`Com_Filme`) REFERENCES `Filmes` (`Fil_Codigo`);

--
-- Constraints for table `Filmes`
--
ALTER TABLE `Filmes`
  ADD CONSTRAINT `Filmes_ibfk_1` FOREIGN KEY (`Fil_Genero`) REFERENCES `Genero` (`Gen_Codigo`),
  ADD CONSTRAINT `Filmes_ibfk_2` FOREIGN KEY (`Fil_Distribuidora`) REFERENCES `Distribuidora` (`Dis_Codigo`),
  ADD CONSTRAINT `Filmes_ibfk_3` FOREIGN KEY (`Fil_Classificacao`) REFERENCES `Classificacao` (`Cla_Codigo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
