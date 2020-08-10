-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 15-Jul-2020 às 20:54
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
-- Database: `bdtrabalhosja`
--
CREATE DATABASE IF NOT EXISTS `bdtrabalhosja` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `bdtrabalhosja`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `entregas`
--
-- Criação: 10-Jul-2020 às 18:57
--

DROP TABLE IF EXISTS `entregas`;
CREATE TABLE `entregas` (
  `id_entrega` int(11) NOT NULL,
  `id_trabalho` int(11) NOT NULL,
  `id_turma` int(11) NOT NULL,
  `data_entrega` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `nm_estudante` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `tipo` varchar(100) DEFAULT NULL,
  `titulo` varchar(300) NOT NULL,
  `conteudo` varchar(15000) NOT NULL,
  `anexo_img` varchar(100) DEFAULT NULL,
  `anexo_extra` varchar(100) DEFAULT NULL,
  `id_professor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `entregas`
--

INSERT INTO `entregas` (`id_entrega`, `id_trabalho`, `id_turma`, `data_entrega`, `nm_estudante`, `email`, `tipo`, `titulo`, `conteudo`, `anexo_img`, `anexo_extra`, `id_professor`) VALUES
(7, 155, 120, '2020-07-15 15:31:59', 'isaque felipe', 'email@email.com', NULL, 'Teste de Funcionalidade do Sistema', '                            <center class=\"placeedit\">\r\n                              <h1>...</h1>\r\n                              <h6>use esta área para redigir ou codificar</h6>\r\n                              <p>...</p>\r\n                            </center>  \r\n                          ', NULL, 'upload/15.07.2020-20.31.595f0f4b9f078e1.png', 103);

-- --------------------------------------------------------

--
-- Estrutura da tabela `materias`
--
-- Criação: 10-Jul-2020 às 16:59
--

DROP TABLE IF EXISTS `materias`;
CREATE TABLE `materias` (
  `id_materia` int(11) NOT NULL,
  `id_professor` int(11) NOT NULL,
  `materia` varchar(100) NOT NULL,
  `descrição` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `materias`
--

INSERT INTO `materias` (`id_materia`, `id_professor`, `materia`, `descrição`) VALUES
(118, 103, 'Calculo Estruturado', NULL),
(119, 103, 'Design Web', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `trabalhos`
--
-- Criação: 10-Jul-2020 às 16:59
--

DROP TABLE IF EXISTS `trabalhos`;
CREATE TABLE `trabalhos` (
  `id_trabalho` int(11) NOT NULL,
  `id_professor` int(11) NOT NULL,
  `id_turma` int(11) NOT NULL,
  `id_materia` int(11) NOT NULL,
  `data_inicial` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `data_limite` date DEFAULT NULL,
  `tipo` varchar(50) DEFAULT NULL,
  `titulo` varchar(300) NOT NULL,
  `contexto` varchar(15000) NOT NULL,
  `anexo_img` varchar(200) DEFAULT NULL,
  `anexo_extra` varchar(200) DEFAULT NULL,
  `link` varchar(100) DEFAULT NULL COMMENT 'aqui esta guardado o link para acessar o trabalho'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `trabalhos`
--

INSERT INTO `trabalhos` (`id_trabalho`, `id_professor`, `id_turma`, `id_materia`, `data_inicial`, `data_limite`, `tipo`, `titulo`, `contexto`, `anexo_img`, `anexo_extra`, `link`) VALUES
(155, 103, 120, 118, '2020-07-15 14:49:28', '2020-07-30', NULL, 'Teste de Funcionalidade do Sistema', '<p><br></p><table class=\"table table-bordered\"><tbody><tr><td>Tem como função avaliar as funções do sistema observando se estão funcionando corretamente. Envolvendo testes anteriores como por exemplo, os testes de unidade, de integração, de sistema e etc. Testes de funcionalidade dão prioridade a navegação e as interações.<br></td></tr></tbody></table><p><br></p><p><br></p>', NULL, 'upload/15.07.2020-19.49.285f0f41a8207ff.png', 'http://localhost/trabalhosja/?I155ENT');

-- --------------------------------------------------------

--
-- Estrutura da tabela `turmas`
--
-- Criação: 10-Jul-2020 às 16:59
--

DROP TABLE IF EXISTS `turmas`;
CREATE TABLE `turmas` (
  `id_turma` int(11) NOT NULL,
  `id_professor` int(11) NOT NULL,
  `turma` varchar(20) NOT NULL,
  `descricao` varchar(200) DEFAULT NULL,
  `extra` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `turmas`
--

INSERT INTO `turmas` (`id_turma`, `id_professor`, `turma`, `descricao`, `extra`) VALUES
(119, 103, '2º ano Tec. Inf', NULL, NULL),
(120, 103, '4º ano Eng. Mec', NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--
-- Criação: 10-Jul-2020 às 16:59
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `id_professor` int(11) NOT NULL,
  `nm_usuario` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(16) NOT NULL,
  `imgperfil` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id_professor`, `nm_usuario`, `email`, `senha`, `imgperfil`) VALUES
(103, 'professorX', 'professorX@email.com', '123', NULL),
(104, 'professorY', 'professorY@email.com', '123', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `entregas`
--
ALTER TABLE `entregas`
  ADD PRIMARY KEY (`id_entrega`),
  ADD KEY `id_trabalho` (`id_trabalho`),
  ADD KEY `id_turma` (`id_turma`),
  ADD KEY `id_professor` (`id_professor`);

--
-- Indexes for table `materias`
--
ALTER TABLE `materias`
  ADD PRIMARY KEY (`id_materia`),
  ADD KEY `materias_ibfk_1` (`id_professor`);

--
-- Indexes for table `trabalhos`
--
ALTER TABLE `trabalhos`
  ADD PRIMARY KEY (`id_trabalho`),
  ADD KEY `id_professor` (`id_professor`),
  ADD KEY `id_turma` (`id_turma`),
  ADD KEY `trabalhos_ibfk_3` (`id_materia`);

--
-- Indexes for table `turmas`
--
ALTER TABLE `turmas`
  ADD PRIMARY KEY (`id_turma`),
  ADD KEY `turmas_ibfk_1` (`id_professor`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_professor`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `entregas`
--
ALTER TABLE `entregas`
  MODIFY `id_entrega` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `materias`
--
ALTER TABLE `materias`
  MODIFY `id_materia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT for table `trabalhos`
--
ALTER TABLE `trabalhos`
  MODIFY `id_trabalho` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=156;

--
-- AUTO_INCREMENT for table `turmas`
--
ALTER TABLE `turmas`
  MODIFY `id_turma` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_professor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `entregas`
--
ALTER TABLE `entregas`
  ADD CONSTRAINT `entregas_ibfk_1` FOREIGN KEY (`id_trabalho`) REFERENCES `trabalhos` (`id_trabalho`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `entregas_ibfk_2` FOREIGN KEY (`id_turma`) REFERENCES `turmas` (`id_turma`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `entregas_ibfk_3` FOREIGN KEY (`id_professor`) REFERENCES `usuarios` (`id_professor`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `materias`
--
ALTER TABLE `materias`
  ADD CONSTRAINT `materias_ibfk_1` FOREIGN KEY (`id_professor`) REFERENCES `usuarios` (`id_professor`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `trabalhos`
--
ALTER TABLE `trabalhos`
  ADD CONSTRAINT `trabalhos_ibfk_1` FOREIGN KEY (`id_professor`) REFERENCES `usuarios` (`id_professor`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `trabalhos_ibfk_2` FOREIGN KEY (`id_turma`) REFERENCES `turmas` (`id_turma`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `trabalhos_ibfk_3` FOREIGN KEY (`id_materia`) REFERENCES `materias` (`id_materia`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `turmas`
--
ALTER TABLE `turmas`
  ADD CONSTRAINT `turmas_ibfk_1` FOREIGN KEY (`id_professor`) REFERENCES `usuarios` (`id_professor`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
