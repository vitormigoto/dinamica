-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           5.7.17-log - MySQL Community Server (GPL)
-- OS do Servidor:               Win32
-- HeidiSQL Versão:              10.3.0.5771
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Copiando estrutura do banco de dados para cliente
CREATE DATABASE IF NOT EXISTS `cliente` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `cliente`;

-- Copiando estrutura para tabela cliente.cliente
CREATE TABLE IF NOT EXISTS `cliente` (
  `cod` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(200) NOT NULL,
  `cpf` char(14) NOT NULL,
  `telefone` char(15) NOT NULL,
  `celular` char(15) DEFAULT NULL,
  `email` varchar(150) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `endereco` varchar(200) NOT NULL,
  `numero` int(11) NOT NULL DEFAULT '0',
  `bairro` varchar(200) NOT NULL,
  `cep` char(10) NOT NULL,
  `cidade` varchar(100) NOT NULL,
  `estado` char(2) NOT NULL DEFAULT '',
  `dt_nasc` date NOT NULL,
  `dt_cadastro` datetime NOT NULL,
  `status` enum('S','N') NOT NULL DEFAULT 'N',
  `log` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`cod`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela cliente.cliente: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `cliente` DISABLE KEYS */;
INSERT IGNORE INTO `cliente` (`cod`, `nome`, `cpf`, `telefone`, `celular`, `email`, `senha`, `endereco`, `numero`, `bairro`, `cep`, `cidade`, `estado`, `dt_nasc`, `dt_cadastro`, `status`, `log`) VALUES
	(1, 'Vitor Hugo Migoto de Gouvêa', '370.268.748-37', '(12)9913-66810', '', 'vitoridesa@gmail.com', '$2y$10$dsJpHVol6U7eBaFpGcoSUuk/b7ovDWje6hhtOW6Jr1dgqc9DZT0Nu', 'Rua Fundição de Ouro', 86, 'Vila São Geraldo', '12062040', 'Taubaté', 'SP', '1988-09-12', '2020-01-16 10:52:30', 'S', '2020-01-16 11:12:22');
/*!40000 ALTER TABLE `cliente` ENABLE KEYS */;

-- Copiando estrutura para tabela cliente.produtos
CREATE TABLE IF NOT EXISTS `produtos` (
  `cod_produto` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `descricao` text NOT NULL,
  `detalhes` text NOT NULL,
  `imagem` varchar(250) DEFAULT NULL,
  `qtd_atual` int(11) NOT NULL,
  `parcelas` int(11) NOT NULL,
  `valor` float NOT NULL,
  `libera` enum('S','N') NOT NULL DEFAULT 'S',
  `log` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`cod_produto`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela cliente.produtos: ~13 rows (aproximadamente)
/*!40000 ALTER TABLE `produtos` DISABLE KEYS */;
INSERT IGNORE INTO `produtos` (`cod_produto`, `nome`, `descricao`, `detalhes`, `imagem`, `qtd_atual`, `parcelas`, `valor`, `libera`, `log`) VALUES
	(1, 'INTRO PLAN', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean scelerisque metus eget sem. Suspendisse fermentum. Proin diam augue.\r\n', '', 'images/logo_xpto_color.png', 10, 0, 399.9, 'S', '2020-01-16 10:57:28'),
	(2, 'STANDARD PLAN', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean scelerisque metus eget sem. Suspendisse fermentum. Proin diam augue.\r\nLorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean scelerisque metus eget sem. Suspendisse fermentum. Proin diam augue.\r\nLorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean scelerisque metus eget sem. Suspendisse fermentum. Proin diam augue.', '', 'images/logo_xpto_color.png', 10, 0, 1099.9, 'S', '2020-01-16 10:57:30'),
	(3, 'MASTER PLAN5º Ano - Corpo Humano', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean scelerisque metus eget sem. Suspendisse fermentum. Proin diam augue.\r\nLorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean scelerisque metus eget sem. Suspendisse fermentum. Proin diam augue.\r\nLorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean scelerisque metus eget sem. Suspendisse fermentum. Proin diam augue.\r\nLorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean scelerisque metus eget sem. Suspendisse fermentum. Proin diam augue.\r\nLorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean scelerisque metus eget sem. Suspendisse fermentum. Proin diam augue.', '', 'images/logo_xpto_color.png', 10, 0, 14300, 'S', '2020-01-16 10:57:31'),
	(4, 'PARTNER PLAN', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean scelerisque metus eget sem. Suspendisse fermentum. Proin diam augue.\r\nLorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean scelerisque metus eget sem. Suspendisse fermentum. Proin diam augue.\r\nLorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean scelerisque metus eget sem. Suspendisse fermentum. Proin diam augue.\r\nLorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean scelerisque metus eget sem. Suspendisse fermentum. Proin diam augue.\r\nLorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean scelerisque metus eget sem. Suspendisse fermentum. Proin diam augue.\r\nLorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean scelerisque metus eget sem. Suspendisse fermentum. Proin diam augue.\r\n', '', 'images/logo_xpto_color.png', 10, 0, 16800, 'S', '2020-01-16 10:57:33');
/*!40000 ALTER TABLE `produtos` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
