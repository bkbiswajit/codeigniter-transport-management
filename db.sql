-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tempo de Geração: 
-- Versão do Servidor: 5.5.27
-- Versão do PHP: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Banco de Dados: `transportes`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientes`
--

CREATE TABLE IF NOT EXISTS `clientes` (
  `clientes_id` int(11) NOT NULL AUTO_INCREMENT,
  `clientes_descricao` varchar(45) NOT NULL,
  `clientes_ativo` char(1) NOT NULL,
  PRIMARY KEY (`clientes_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Extraindo dados da tabela `clientes`
--

INSERT INTO `clientes` (`clientes_id`, `clientes_descricao`, `clientes_ativo`) VALUES
(1, 'TESTE', '1'),
(2, 'COOPERATIVA CENTRAL AURORA ALIMENTOS', '1'),
(3, 'MÉTODO TRANSPORTES LTDA', '1'),
(4, 'BAUER CARGAS', '0');

-- --------------------------------------------------------

--
-- Estrutura da tabela `config`
--

CREATE TABLE IF NOT EXISTS `config` (
  `id` int(11) NOT NULL,
  `nome` varchar(45) DEFAULT NULL,
  `subnome` varchar(45) DEFAULT NULL,
  `cnpj` varchar(50) NOT NULL,
  `incricao_estadual` varchar(50) NOT NULL,
  `url` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `senha_email` varchar(255) NOT NULL,
  `telefone` varchar(50) NOT NULL,
  `endereco` varchar(255) NOT NULL,
  `ultimo_backup` int(11) NOT NULL,
  `ativo` char(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `config`
--

INSERT INTO `config` (`id`, `nome`, `subnome`, `cnpj`, `incricao_estadual`, `url`, `email`, `senha_email`, `telefone`, `endereco`, `ultimo_backup`, `ativo`) VALUES
(0, 'Gerenciamento de Frotas v1', '', '', '', '', 'lautenai@yahoo.com.br', 'DrLau007', '', '', 1365701173, '1');

-- --------------------------------------------------------

--
-- Estrutura da tabela `controle_de_viagem`
--

CREATE TABLE IF NOT EXISTS `controle_de_viagem` (
  `controle_de_viagem_id` int(11) NOT NULL AUTO_INCREMENT,
  `controle_de_viagem_transportadoras_id` int(11) NOT NULL,
  `controle_de_viagem_motorista_id` int(11) NOT NULL,
  `controle_de_viagem_caminhao_id` int(11) NOT NULL,
  `controle_de_viagem_valor_frete` varchar(255) NOT NULL,
  `controle_de_viagem_km_inicial` varchar(255) NOT NULL,
  `controle_de_viagem_km_final` varchar(255) NOT NULL,
  `controle_de_viagem_litros` varchar(255) NOT NULL,
  `controle_de_viagem_horimetro` varchar(255) NOT NULL,
  `controle_de_viagem_horimetro_litros` varchar(255) NOT NULL,
  PRIMARY KEY (`controle_de_viagem_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Extraindo dados da tabela `controle_de_viagem`
--

INSERT INTO `controle_de_viagem` (`controle_de_viagem_id`, `controle_de_viagem_transportadoras_id`, `controle_de_viagem_motorista_id`, `controle_de_viagem_caminhao_id`, `controle_de_viagem_valor_frete`, `controle_de_viagem_km_inicial`, `controle_de_viagem_km_final`, `controle_de_viagem_litros`, `controle_de_viagem_horimetro`, `controle_de_viagem_horimetro_litros`) VALUES
(1, 1, 1, 3, '', '989999', '999999', '', '100', '120'),
(2, 3, 10, 13, '', '951040', '952735', '', '0', '0'),
(3, 3, 3, 11, '', '300444', '304900', '', '88', '43');

-- --------------------------------------------------------

--
-- Estrutura da tabela `controle_de_viagem_agenda`
--

CREATE TABLE IF NOT EXISTS `controle_de_viagem_agenda` (
  `controle_de_viagem_agenda_id` int(11) NOT NULL AUTO_INCREMENT,
  `controle_de_viagem_agenda_transportadoras_id` int(11) NOT NULL,
  `controle_de_viagem_agenda_motorista_id` int(11) NOT NULL,
  `controle_de_viagem_agenda_caminhao_id` int(11) NOT NULL,
  `controle_de_viagem_agenda_clientes_id` int(11) NOT NULL,
  `controle_de_viagem_agenda_origem_id` int(11) NOT NULL,
  `controle_de_viagem_agenda_destino_id` int(11) NOT NULL,
  `controle_de_viagem_agenda_data` date NOT NULL,
  `controle_de_viagem_agenda_caminhao_liberado` char(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`controle_de_viagem_agenda_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Extraindo dados da tabela `controle_de_viagem_agenda`
--

INSERT INTO `controle_de_viagem_agenda` (`controle_de_viagem_agenda_id`, `controle_de_viagem_agenda_transportadoras_id`, `controle_de_viagem_agenda_motorista_id`, `controle_de_viagem_agenda_caminhao_id`, `controle_de_viagem_agenda_clientes_id`, `controle_de_viagem_agenda_origem_id`, `controle_de_viagem_agenda_destino_id`, `controle_de_viagem_agenda_data`, `controle_de_viagem_agenda_caminhao_liberado`) VALUES
(1, 3, 6, 3, 2, 18, 12, '2013-01-15', '0'),
(2, 5, 9, 11, 2, 1, 15, '2013-01-28', '0'),
(3, 3, 7, 7, 2, 21, 10, '2013-01-28', '1'),
(4, 3, 4, 8, 2, 6, 28, '2013-01-28', '1'),
(5, 5, 3, 11, 4, 24, 24, '2013-04-11', '0');

-- --------------------------------------------------------

--
-- Estrutura da tabela `controle_de_viagem_despesas`
--

CREATE TABLE IF NOT EXISTS `controle_de_viagem_despesas` (
  `controle_de_viagem_despesas_id` int(11) NOT NULL AUTO_INCREMENT,
  `controle_de_viagem_despesas_controle_de_viagem_viagens_id` int(11) NOT NULL,
  `controle_de_viagem_despesas_data` date NOT NULL,
  `controle_de_viagem_despesas_controle_de_viagem_despesas_tipos_id` int(11) NOT NULL,
  `controle_de_viagem_despesas_valor` varchar(255) NOT NULL,
  PRIMARY KEY (`controle_de_viagem_despesas_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Extraindo dados da tabela `controle_de_viagem_despesas`
--

INSERT INTO `controle_de_viagem_despesas` (`controle_de_viagem_despesas_id`, `controle_de_viagem_despesas_controle_de_viagem_viagens_id`, `controle_de_viagem_despesas_data`, `controle_de_viagem_despesas_controle_de_viagem_despesas_tipos_id`, `controle_de_viagem_despesas_valor`) VALUES
(1, 3, '2013-04-01', 3, '300'),
(3, 3, '2013-04-01', 7, '486'),
(4, 1, '2013-04-11', 6, '1'),
(5, 1, '2013-04-11', 6, '1');

-- --------------------------------------------------------

--
-- Estrutura da tabela `controle_de_viagem_despesas_tipos`
--

CREATE TABLE IF NOT EXISTS `controle_de_viagem_despesas_tipos` (
  `controle_de_viagem_despesas_tipos_id` int(11) NOT NULL AUTO_INCREMENT,
  `controle_de_viagem_despesas_tipos_descricao` varchar(255) NOT NULL,
  `controle_de_viagem_despesas_tipos_ativo` char(1) NOT NULL,
  PRIMARY KEY (`controle_de_viagem_despesas_tipos_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Extraindo dados da tabela `controle_de_viagem_despesas_tipos`
--

INSERT INTO `controle_de_viagem_despesas_tipos` (`controle_de_viagem_despesas_tipos_id`, `controle_de_viagem_despesas_tipos_descricao`, `controle_de_viagem_despesas_tipos_ativo`) VALUES
(1, 'TESTE', '1'),
(2, 'PEDÁGIO CTF', '1'),
(3, 'PNEU', '1'),
(4, 'MECÂNICA', '1'),
(5, 'LAVAGEM', '1'),
(6, 'ELÉTRICA', '1'),
(7, 'OUTROS', '1');

-- --------------------------------------------------------

--
-- Estrutura da tabela `controle_de_viagem_destino`
--

CREATE TABLE IF NOT EXISTS `controle_de_viagem_destino` (
  `controle_de_viagem_destino_id` int(11) NOT NULL AUTO_INCREMENT,
  `controle_de_viagem_destino_regiao_id` int(11) NOT NULL,
  `controle_de_viagem_destino_descricao` varchar(255) NOT NULL,
  `controle_de_viagem_destino_ativo` char(1) NOT NULL,
  PRIMARY KEY (`controle_de_viagem_destino_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;

--
-- Extraindo dados da tabela `controle_de_viagem_destino`
--

INSERT INTO `controle_de_viagem_destino` (`controle_de_viagem_destino_id`, `controle_de_viagem_destino_regiao_id`, `controle_de_viagem_destino_descricao`, `controle_de_viagem_destino_ativo`) VALUES
(1, 5, 'MATRIZ', '1'),
(2, 5, 'GUATAMBÚ', '1'),
(3, 5, 'CHAPECÓ', '1'),
(4, 4, 'SÃO PAULO', '1'),
(5, 5, 'ITAJAÍ', '1'),
(6, 3, 'FASGO', '1'),
(7, 3, 'BRASILIA', '1'),
(8, 3, 'CAMPO GRANDE', '1'),
(9, 5, 'CL', '1'),
(10, 5, 'ITAJAI', '1'),
(11, 5, 'CHAPECÓ', '1'),
(12, 2, 'MACAPÁ', '1'),
(13, 4, 'RIO DE JANEIRO', '1'),
(14, 4, 'SÃO JOSE DO RIO PRETO', '1'),
(15, 4, 'JANDIRA', '1'),
(16, 5, 'SARANDI', '1'),
(17, 5, 'ERECHIM', '1'),
(18, 5, 'MIRAGUAI', '1'),
(19, 5, 'MARAVILHA', '1'),
(20, 5, 'BONDIO', '1'),
(21, 5, 'SAIC', '1'),
(22, 5, 'XAXIM', '1'),
(23, 5, 'PINHALZINHO', '1'),
(24, 5, 'ABELARDO', '1'),
(25, 5, 'SÃO MIGUEL DO OESTE', '1'),
(26, 4, 'GUARULHOS', '1'),
(27, 4, 'CAMPINAS', '1'),
(28, 5, 'PALMAS', '1'),
(29, 5, 'QUILOMBO', '1'),
(30, 3, 'SÃO GABRIEL', '1'),
(31, 5, 'LUIS ALVES', '1'),
(32, 5, 'NONOAI', '1');

-- --------------------------------------------------------

--
-- Estrutura da tabela `controle_de_viagem_motoristas_despesas`
--

CREATE TABLE IF NOT EXISTS `controle_de_viagem_motoristas_despesas` (
  `controle_de_viagem_motoristas_despesas_id` int(11) NOT NULL AUTO_INCREMENT,
  `controle_de_viagem_motoristas_despesas_controle_de_viagem_id` int(11) NOT NULL,
  `controle_de_viagem_motoristas_despesas_tipos_id` int(11) NOT NULL,
  `controle_de_viagem_motoristas_despesas_data` date NOT NULL,
  `controle_de_viagem_motoristas_despesas_valor` varchar(255) NOT NULL,
  PRIMARY KEY (`controle_de_viagem_motoristas_despesas_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `controle_de_viagem_motoristas_despesas_tipos`
--

CREATE TABLE IF NOT EXISTS `controle_de_viagem_motoristas_despesas_tipos` (
  `controle_de_viagem_motoristas_despesas_tipos_id` int(11) NOT NULL AUTO_INCREMENT,
  `controle_de_viagem_motoristas_despesas_tipos_descricao` varchar(255) NOT NULL,
  `controle_de_viagem_motoristas_despesas_tipos_ativo` char(1) NOT NULL,
  PRIMARY KEY (`controle_de_viagem_motoristas_despesas_tipos_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `controle_de_viagem_motoristas_despesas_tipos`
--

INSERT INTO `controle_de_viagem_motoristas_despesas_tipos` (`controle_de_viagem_motoristas_despesas_tipos_id`, `controle_de_viagem_motoristas_despesas_tipos_descricao`, `controle_de_viagem_motoristas_despesas_tipos_ativo`) VALUES
(1, 'ADIANTAMENTO', '1');

-- --------------------------------------------------------

--
-- Estrutura da tabela `controle_de_viagem_origem`
--

CREATE TABLE IF NOT EXISTS `controle_de_viagem_origem` (
  `controle_de_viagem_origem_id` int(11) NOT NULL AUTO_INCREMENT,
  `controle_de_viagem_origem_regiao_id` int(11) NOT NULL,
  `controle_de_viagem_origem_descricao` varchar(255) NOT NULL,
  `controle_de_viagem_origem_ativo` char(1) NOT NULL,
  PRIMARY KEY (`controle_de_viagem_origem_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;

--
-- Extraindo dados da tabela `controle_de_viagem_origem`
--

INSERT INTO `controle_de_viagem_origem` (`controle_de_viagem_origem_id`, `controle_de_viagem_origem_regiao_id`, `controle_de_viagem_origem_descricao`, `controle_de_viagem_origem_ativo`) VALUES
(1, 5, 'MATRIZ', '1'),
(2, 5, 'GUATAMBÚ', '1'),
(3, 5, 'CHAPECÓ', '1'),
(4, 4, 'SÃO PAULO', '1'),
(5, 5, 'ITAJAÍ', '1'),
(6, 3, 'FASGO', '1'),
(7, 3, 'BRASILIA', '1'),
(8, 3, 'CAMPO GRANDE', '1'),
(9, 5, 'CL', '1'),
(12, 2, 'MACAPÁ', '1'),
(13, 4, 'RIO DE JANEIRO', '1'),
(14, 4, 'SÃO JOSE DO RIO PRETO', '1'),
(15, 4, 'JANDIRA', '1'),
(16, 5, 'SARANDI', '1'),
(17, 5, 'ERECHIM', '1'),
(18, 5, 'MIRAGUAI', '1'),
(19, 5, 'MARAVILHA', '1'),
(20, 5, 'BONDIO', '1'),
(21, 5, 'SAIC', '1'),
(22, 5, 'XAXIM', '1'),
(23, 5, 'PINHALZINHO', '1'),
(24, 5, 'ABELARDO', '1'),
(25, 5, 'SÃO MIGUEL DO OESTE', '1'),
(26, 4, 'GUARULHOS', '1'),
(27, 4, 'CAMPINAS', '1'),
(28, 5, 'PALMAS', '1'),
(29, 5, 'QUILOMBO', '1'),
(30, 3, 'SÃO GABRIEL', '1'),
(31, 5, 'LUÍS ALVES', '1'),
(32, 5, 'NONOAI', '1');

-- --------------------------------------------------------

--
-- Estrutura da tabela `controle_de_viagem_postos`
--

CREATE TABLE IF NOT EXISTS `controle_de_viagem_postos` (
  `controle_de_viagem_postos_id` int(11) NOT NULL AUTO_INCREMENT,
  `controle_de_viagem_postos_controle_de_viagem_viagens_id` int(11) NOT NULL,
  `controle_de_viagem_postos_data` date NOT NULL,
  `controle_de_viagem_postos_postos_id` int(11) NOT NULL,
  `controle_de_viagem_postos_litros` varchar(255) NOT NULL,
  `controle_de_viagem_postos_valor_litro` varchar(255) NOT NULL,
  PRIMARY KEY (`controle_de_viagem_postos_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Extraindo dados da tabela `controle_de_viagem_postos`
--

INSERT INTO `controle_de_viagem_postos` (`controle_de_viagem_postos_id`, `controle_de_viagem_postos_controle_de_viagem_viagens_id`, `controle_de_viagem_postos_data`, `controle_de_viagem_postos_postos_id`, `controle_de_viagem_postos_litros`, `controle_de_viagem_postos_valor_litro`) VALUES
(1, 3, '2013-04-01', 1, '350', '2.1'),
(2, 3, '2013-04-01', 1, '350', '2.1'),
(3, 3, '2013-04-01', 1, '241', '2.1'),
(4, 3, '2013-04-01', 1, '200', '2.1'),
(5, 3, '2013-04-01', 1, '400', '2.1'),
(6, 3, '2013-04-01', 1, '360', '2.1'),
(7, 3, '2013-04-01', 1, '217', '2.1'),
(9, 1, '2013-04-11', 4, '1', '1'),
(10, 1, '2013-04-11', 4, '1', '1');

-- --------------------------------------------------------

--
-- Estrutura da tabela `controle_de_viagem_regioes`
--

CREATE TABLE IF NOT EXISTS `controle_de_viagem_regioes` (
  `controle_de_viagem_regioes_id` int(11) NOT NULL AUTO_INCREMENT,
  `controle_de_viagem_regioes_descricao` varchar(255) NOT NULL,
  PRIMARY KEY (`controle_de_viagem_regioes_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Extraindo dados da tabela `controle_de_viagem_regioes`
--

INSERT INTO `controle_de_viagem_regioes` (`controle_de_viagem_regioes_id`, `controle_de_viagem_regioes_descricao`) VALUES
(1, 'NORTE'),
(2, 'NORDESTE'),
(3, 'CENTRO-OESTE'),
(4, 'SUDESTE'),
(5, 'SUL');

-- --------------------------------------------------------

--
-- Estrutura da tabela `controle_de_viagem_viagens`
--

CREATE TABLE IF NOT EXISTS `controle_de_viagem_viagens` (
  `controle_de_viagem_viagens_id` int(11) NOT NULL AUTO_INCREMENT,
  `controle_de_viagem_viagens_controle_de_viagem_viagens_id` int(11) NOT NULL,
  `controle_de_viagem_viagens_data` date NOT NULL,
  `controle_de_viagem_viagens_clientes_id` int(11) NOT NULL,
  `controle_de_viagem_viagens_origem_id` int(11) NOT NULL,
  `controle_de_viagem_viagens_destino_id` int(11) NOT NULL,
  `controle_de_viagem_viagens_valor_frete` varchar(255) NOT NULL,
  `controle_de_viagem_viagens_bonus` varchar(255) NOT NULL DEFAULT '0',
  PRIMARY KEY (`controle_de_viagem_viagens_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=35 ;

--
-- Extraindo dados da tabela `controle_de_viagem_viagens`
--

INSERT INTO `controle_de_viagem_viagens` (`controle_de_viagem_viagens_id`, `controle_de_viagem_viagens_controle_de_viagem_viagens_id`, `controle_de_viagem_viagens_data`, `controle_de_viagem_viagens_clientes_id`, `controle_de_viagem_viagens_origem_id`, `controle_de_viagem_viagens_destino_id`, `controle_de_viagem_viagens_valor_frete`, `controle_de_viagem_viagens_bonus`) VALUES
(1, 3, '2013-03-26', 2, 3, 10, '2273.30', '0'),
(2, 3, '2013-03-27', 4, 5, 30, '3101.4', '0'),
(3, 3, '2013-04-03', 3, 30, 5, '4744.91', '0'),
(4, 3, '2013-04-04', 2, 31, 32, '1000', '12');

-- --------------------------------------------------------

--
-- Estrutura da tabela `frotas`
--

CREATE TABLE IF NOT EXISTS `frotas` (
  `caminhoes_id` int(11) NOT NULL AUTO_INCREMENT,
  `caminhoes_descricao` varchar(255) NOT NULL,
  `caminhoes_nome` varchar(255) NOT NULL,
  `caminhoes_cavalo` varchar(255) NOT NULL,
  `caminhoes_carreta` varchar(255) NOT NULL,
  `caminhoes_data_nascimento` date DEFAULT NULL,
  `caminhoes_endereco` text,
  `caminhoes_telefone` varchar(255) DEFAULT NULL,
  `caminhoes_celular` varchar(255) DEFAULT NULL,
  `caminhoes_celular_operadora` varchar(255) DEFAULT NULL,
  `caminhoes_email` varchar(255) DEFAULT NULL,
  `caminhoes_setor` varchar(255) DEFAULT NULL,
  `caminhoes_cargo` varchar(255) DEFAULT NULL,
  `caminhoes_matricula` varchar(255) DEFAULT NULL,
  `caminhoes_cpf` varchar(255) DEFAULT NULL,
  `caminhoes_pis` varchar(255) DEFAULT NULL,
  `caminhoes_ctps_numero` varchar(255) DEFAULT NULL,
  `caminhoes_ctps_serie` varchar(255) DEFAULT NULL,
  `caminhoes_ctps_uf` varchar(255) DEFAULT NULL,
  `caminhoes_data_admissao` date DEFAULT NULL,
  `caminhoes_data_demissao` date DEFAULT NULL,
  `caminhoes_percentagem` varchar(255) NOT NULL,
  `caminhoes_ativo` varchar(255) DEFAULT NULL,
  `caminhoes_controle_de_viagem_agenda_liberado` char(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`caminhoes_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Extraindo dados da tabela `frotas`
--

INSERT INTO `frotas` (`caminhoes_id`, `caminhoes_descricao`, `caminhoes_nome`, `caminhoes_cavalo`, `caminhoes_carreta`, `caminhoes_data_nascimento`, `caminhoes_endereco`, `caminhoes_telefone`, `caminhoes_celular`, `caminhoes_celular_operadora`, `caminhoes_email`, `caminhoes_setor`, `caminhoes_cargo`, `caminhoes_matricula`, `caminhoes_cpf`, `caminhoes_pis`, `caminhoes_ctps_numero`, `caminhoes_ctps_serie`, `caminhoes_ctps_uf`, `caminhoes_data_admissao`, `caminhoes_data_demissao`, `caminhoes_percentagem`, `caminhoes_ativo`, `caminhoes_controle_de_viagem_agenda_liberado`) VALUES
(1, 'TESTE', '', '', '', '2013-01-18', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '2013-01-18', '2013-01-18', '0', '1', '0'),
(3, 'MJI2702', '', '', '', '2013-01-23', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '2013-01-23', '2013-01-23', '0', '1', '0'),
(4, 'MJE3294', '', '', '', '2013-01-23', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '2013-01-23', '2013-01-23', '0', '1', '0'),
(5, 'MJE4774', '', '', '', '2013-01-23', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '2013-01-23', '2013-01-23', '0', '1', '0'),
(6, 'MJA6703', '', '', '', '2013-01-23', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '2013-01-23', '2013-01-23', '0', '1', '0'),
(7, 'MJT3527', '', '', '', '2013-01-23', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '2013-01-23', '2013-01-23', '0', '1', '1'),
(8, 'MCU3580', '', '', '', '2013-01-23', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '2013-01-23', '2013-01-23', '0', '1', '1'),
(9, 'MJL0797', '', '', '', '2013-01-23', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '2013-01-23', '2013-01-23', '0', '1', '0'),
(10, 'MDY2503', '', '', '', '2013-01-23', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '2013-01-23', '2013-01-23', '0', '1', '0'),
(11, '0001', '', 'ASD123', 'ASD123', '2013-04-11', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '2013-04-11', '2013-04-11', '0', '1', '0'),
(13, 'MDK2143', '', '', '', '2013-01-28', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '2013-01-28', '2013-01-28', '0', '1', '0');

-- --------------------------------------------------------

--
-- Estrutura da tabela `grupos`
--

CREATE TABLE IF NOT EXISTS `grupos` (
  `grupo_id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) DEFAULT NULL,
  `permissoes` text,
  `criado` date DEFAULT NULL,
  `ativo` char(1) DEFAULT NULL,
  PRIMARY KEY (`grupo_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Extraindo dados da tabela `grupos`
--

INSERT INTO `grupos` (`grupo_id`, `nome`, `permissoes`, `criado`, `ativo`) VALUES
(1, 'Super Admin', 'a:27:{i:0;s:6:"painel";i:1;s:5:"conta";i:2;s:8:"clientes";i:3;s:18:"clientes.adicionar";i:4;s:15:"clientes.editar";i:5;s:16:"clientes.excluir";i:6;s:8:"despesas";i:7;s:18:"despesas.adicionar";i:8;s:15:"despesas.editar";i:9;s:16:"despesas.excluir";i:10;s:8:"producao";i:11;s:18:"producao.adicionar";i:12;s:15:"producao.editar";i:13;s:16:"producao.excluir";i:14;s:10:"relatorios";i:15;s:8:"usuarios";i:16;s:18:"usuarios.adicionar";i:17;s:15:"usuarios.editar";i:18;s:16:"usuarios.excluir";i:19;s:17:"usuarios.rastrear";i:20;s:6:"grupos";i:21;s:16:"grupos.adicionar";i:22;s:13:"grupos.editar";i:23;s:14:"grupos.excluir";i:24;s:7:"sistema";i:25;s:13:"sistema.geral";i:26;s:18:"sistema.permissoes";}', '2010-01-31', '1'),
(2, 'Administrador', 'a:16:{i:0;s:6:"painel";i:1;s:5:"conta";i:2;s:8:"clientes";i:3;s:18:"clientes.adicionar";i:4;s:15:"clientes.editar";i:5;s:16:"clientes.excluir";i:6;s:8:"despesas";i:7;s:18:"despesas.adicionar";i:8;s:15:"despesas.editar";i:9;s:16:"despesas.excluir";i:10;s:8:"producao";i:11;s:18:"producao.adicionar";i:12;s:15:"producao.editar";i:13;s:16:"producao.excluir";i:14;s:10:"relatorios";i:15;s:7:"sistema";}', '2012-05-20', '1'),
(3, 'Teste', 'a:2:{i:0;s:6:"painel";i:1;s:7:"sistema";}', '2012-06-09', '1');

-- --------------------------------------------------------

--
-- Estrutura da tabela `motoristas`
--

CREATE TABLE IF NOT EXISTS `motoristas` (
  `motoristas_id` int(11) NOT NULL AUTO_INCREMENT,
  `motoristas_descricao` varchar(255) NOT NULL,
  `motoristas_nome` varchar(255) NOT NULL,
  `motoristas_data_nascimento` date DEFAULT NULL,
  `motoristas_endereco` text,
  `motoristas_telefone` varchar(255) DEFAULT NULL,
  `motoristas_celular` varchar(255) DEFAULT NULL,
  `motoristas_celular_operadora` varchar(255) DEFAULT NULL,
  `motoristas_email` varchar(255) DEFAULT NULL,
  `motoristas_setor` varchar(255) DEFAULT NULL,
  `motoristas_cargo` varchar(255) DEFAULT NULL,
  `motoristas_matricula` varchar(255) DEFAULT NULL,
  `motoristas_cpf` varchar(255) DEFAULT NULL,
  `motoristas_pis` varchar(255) DEFAULT NULL,
  `motoristas_ctps_numero` varchar(255) DEFAULT NULL,
  `motoristas_ctps_serie` varchar(255) DEFAULT NULL,
  `motoristas_ctps_uf` varchar(255) DEFAULT NULL,
  `motoristas_data_admissao` date DEFAULT NULL,
  `motoristas_data_demissao` date DEFAULT NULL,
  `motoristas_comissao` varchar(255) NOT NULL,
  `motoristas_ativo` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`motoristas_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Extraindo dados da tabela `motoristas`
--

INSERT INTO `motoristas` (`motoristas_id`, `motoristas_descricao`, `motoristas_nome`, `motoristas_data_nascimento`, `motoristas_endereco`, `motoristas_telefone`, `motoristas_celular`, `motoristas_celular_operadora`, `motoristas_email`, `motoristas_setor`, `motoristas_cargo`, `motoristas_matricula`, `motoristas_cpf`, `motoristas_pis`, `motoristas_ctps_numero`, `motoristas_ctps_serie`, `motoristas_ctps_uf`, `motoristas_data_admissao`, `motoristas_data_demissao`, `motoristas_comissao`, `motoristas_ativo`) VALUES
(1, 'TESTE', 'TESTE', '2013-01-18', 'teste', 'teste', '0000000000', 'teste', 'teste@teste.com', 'teste', 'teste', 'teste', 'teste', 'teste', 'teste', 'teste', 'teste', '2013-01-18', '2013-01-18', '11', '1'),
(2, 'EVERSON', 'EVERSON JORGE ANTUNES', '1981-07-19', 'Xaxim -SC', '4999363028', '4999363028', '', '', 'transportes', 'Motorista', '013', '00835649938', '12938493721', '4007717', '001-0', 'sc', '2007-06-01', '2013-01-23', '11%', '1'),
(3, 'ALAOR', 'JOSÉ ALAOR LEMES DA SILVA', '1967-04-09', 'R.Pascoal Mora 76-d', '4999024938', '4999024938', 'TIM', '', 'Transportes', 'Motorista', '009', '564324889-15', '12189309117', '27129', '0015', 'SC', '2005-06-01', '2013-01-23', '11%', '1'),
(4, 'EDSON', 'EDSON LUIZ SALVADOR', '1973-09-04', 'CHAPECO-SC', '4991180437', '4991180437', 'TIM', '', 'TRANSPORTES', 'MOTORISTA', '014', '864022699-72', '12451996600', '17486', '00021', 'SC', '2008-05-02', '2013-01-23', '11%', '1'),
(5, 'VONINHO', 'VONINHO DOS SANTOS MORAIS', '1981-11-06', 'GUATAMBU-SC', '4999373814', '4999373814', 'TIM', '', 'TRANSPORTES', 'MOTORISTA', '016', '03037943998', '12657505726', '34774', '00025', 'SC', '2009-04-01', '2013-04-11', '11%', '1'),
(6, 'ALCEU', 'ALCEU ARAUJO TATSCH', '1957-11-21', 'ESPUMOSO-RS', '4991178820', '4991178820', 'TIM', '', 'TRANSPORTES', 'MOTORISTA', '020', '34748733934', '17009763141', '2949411', '00010', 'SC', '2011-08-01', '2013-01-23', '11%', '1'),
(7, 'ROBERTO', 'ROBERTO CARLOS LORENZATTO', '1980-10-26', 'SAO CARLOS-SC', '4991181926', '4991181926', 'TIM', '', 'TRANSPORTES', 'MOTORISTA', '023', '03101007984', '133165587210', '1786172', '0010', 'SC', '2012-01-23', '2013-01-23', '11%', '1'),
(8, 'PAULO', 'PAULO CEZAR ALVES', '1981-02-01', 'XAXIM-SC', '4999008820', '4999008820', 'TIM', '', 'TRANSPORTES', 'MOTORISTA', '024', '02834908966', '12737524514', '8810028', '00030', 'SC', '2012-02-01', '2013-01-23', '11%', '1'),
(9, 'CEZAR', 'CEZAR LUZZI', '1968-02-15', 'rua joão tormen', '4999238637', '', '', '', 'transportes', 'motorista', '1', '1', '1', '1', '1', 'sc', '2013-01-01', '2013-01-28', '11', '1'),
(10, 'ANGELO', 'ANGELO GILBERTO DAL MORO', '1978-08-14', 'R. A, 45 - D Q 2450 L 04', '4999622802', '4999622802', 'tim', '', 'Transportes', 'Motorista', '000', '02377111920', '12805756721', '28921', '00027', 'sc', '2013-01-01', '2013-01-28', '11%', '1');

-- --------------------------------------------------------

--
-- Estrutura da tabela `postos`
--

CREATE TABLE IF NOT EXISTS `postos` (
  `postos_id` int(11) NOT NULL AUTO_INCREMENT,
  `postos_descricao` varchar(255) NOT NULL,
  `postos_nome` varchar(255) NOT NULL,
  `postos_endereco` text,
  `postos_telefone` varchar(255) DEFAULT NULL,
  `postos_celular` varchar(255) DEFAULT NULL,
  `postos_celular_operadora` varchar(255) DEFAULT NULL,
  `postos_email` varchar(255) DEFAULT NULL,
  `postos_cnpj` varchar(255) DEFAULT NULL,
  `postos_data_admissao` date DEFAULT NULL,
  `postos_ativo` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`postos_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Extraindo dados da tabela `postos`
--

INSERT INTO `postos` (`postos_id`, `postos_descricao`, `postos_nome`, `postos_endereco`, `postos_telefone`, `postos_celular`, `postos_celular_operadora`, `postos_email`, `postos_cnpj`, `postos_data_admissao`, `postos_ativo`) VALUES
(1, 'POSTO RUSSI', 'POSTO RUSSI', 'RODOVIA BR470', '4735230766', '', '', '', '80451289000102', '2013-01-01', '1'),
(2, 'COOPERATIVA TRANSP DO OESTE - CO', 'COTRAOESTE', 'RUA SERVIDAO ODILA MAGIONE TORME, BELVEDERE - CHAPECO -SC', '49 3324.4230', '49 3331.2166', 'OUTRO FIXO', '', '05551625/0001-65', '2013-01-01', '1'),
(3, 'POSTO AGRICOPEL LTDA', 'AGRICOPEL', 'RODOVIA BR-476, S/N', '41 36251530', '', '', 'nfes@agricopel.com.br', '83488882/0022-38', '2013-01-01', '1'),
(4, 'AUTO POSTO ALEXANDRIA LTDA', 'ALEXANDRIA', 'ROD. RAPOSO TAVARES, 431', '18 33497131', '', '', '', '47608344/0001-41', '2013-01-01', '1'),
(5, 'POSTO JB 4 IRMAOS LTDA', '4 IRMAOS', 'ROD. BR116 KM 467', '13 38641109', '', '', '', '46209847/0001-81', '2013-01-01', '1'),
(6, 'AUTOS POSTO MACEDAO LTDA', 'MACEDAO', 'ROD. BR153 KM 82', '17 32581384', '', '', 'macedao@terra.com.br', '59720177/0001-05', '2013-01-01', '1');

-- --------------------------------------------------------

--
-- Estrutura da tabela `transportadoras`
--

CREATE TABLE IF NOT EXISTS `transportadoras` (
  `transportadoras_id` int(11) NOT NULL AUTO_INCREMENT,
  `transportadoras_descricao` varchar(45) NOT NULL,
  `transportadoras_ativo` char(1) NOT NULL,
  PRIMARY KEY (`transportadoras_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Extraindo dados da tabela `transportadoras`
--

INSERT INTO `transportadoras` (`transportadoras_id`, `transportadoras_descricao`, `transportadoras_ativo`) VALUES
(1, 'TESTE', '1'),
(3, 'MANO TRANSPORTES LTDA', '1'),
(4, 'IVA TRANSPORTES LTDA', '1'),
(5, 'CEZAR LUZZI ME', '0'),
(6, 'TRANSPORTES JOAMO', '0'),
(7, 'SAQUETTI REPRESENTAÇÕES LTDA', '0'),
(8, 'TRANSPORTES CONSTANCI LTDA', '0'),
(9, 'TRANSPORTES HLM', '0');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `usuario_id` int(11) NOT NULL AUTO_INCREMENT,
  `grupo_id` int(11) NOT NULL COMMENT 'fk grupo_id grupos',
  `cpf` varchar(104) DEFAULT NULL,
  `number_id` varchar(11) NOT NULL,
  `password` varchar(104) DEFAULT NULL,
  `password_raw` varchar(104) NOT NULL,
  `activation_code` varchar(40) NOT NULL,
  `forgotten_password_code` varchar(40) NOT NULL,
  `ip_address` char(16) NOT NULL,
  `nome` varchar(45) DEFAULT NULL,
  `ativo` char(1) DEFAULT NULL,
  `email` varchar(104) DEFAULT NULL,
  `retrato` varchar(255) NOT NULL,
  `criado` date DEFAULT NULL,
  `ultimavisita` timestamp NULL DEFAULT NULL,
  `ultimaatividade` datetime DEFAULT NULL,
  `cookiekey` char(40) DEFAULT NULL,
  PRIMARY KEY (`usuario_id`),
  KEY `fk_usuarios_grupos1` (`grupo_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`usuario_id`, `grupo_id`, `cpf`, `number_id`, `password`, `password_raw`, `activation_code`, `forgotten_password_code`, `ip_address`, `nome`, `ativo`, `email`, `retrato`, `criado`, `ultimavisita`, `ultimaatividade`, `cookiekey`) VALUES
(2, 1, '05310852956', '05310852956', '79c3d9a074ec40f64840c70c2f00bbd0e2fa092f', '', '', '', '', 'Lautenai Jr.', '1', 'lautenai@gmail.com', '', '2012-05-16', '2013-04-11 22:55:15', '2013-04-11 20:29:17', NULL),
(3, 1, '59364840925', '59364840925', '9df3f209a6d62edf8a49e1f1531ef3d41630de06', '', '', '', '', 'Cezar Antônio Dal Piva', '1', 'mano.trans@yahoo.com.br', '', '2013-01-18', '2013-01-23 17:24:09', '2013-01-23 15:24:09', NULL),
(4, 2, '73242268920', '73242268920', 'edf20e46f9c0ae16c413a2861430218b636b24da', '', '', '', '', 'sidinei dal piva', '1', 'dalpiva01@gmail.com', '', '2013-01-23', '2013-01-28 11:31:05', '2013-01-28 09:41:17', NULL),
(5, 2, '367842', '367842', 'f1fb36022c1a1f8e12445460a5cf842c0dc7fff0', '', '', '', '', 'Leonardo Dal Piva', '1', 'leodalpiva10@hotmail.com', '', '2013-01-23', '2013-01-31 17:38:52', '2013-01-31 15:57:08', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios_ativos`
--

CREATE TABLE IF NOT EXISTS `usuarios_ativos` (
  `usuario_id` int(11) NOT NULL COMMENT 'fk usuario_id usuarios',
  `timestamp` int(11) DEFAULT NULL,
  KEY `fk_usuarios_ativos_usuarios1` (`usuario_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuarios_ativos`
--

INSERT INTO `usuarios_ativos` (`usuario_id`, `timestamp`) VALUES
(2, 1365722957);

-- --------------------------------------------------------

--
-- Estrutura da tabela `visita`
--

CREATE TABLE IF NOT EXISTS `visita` (
  `visit_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `visit_entry_visit_id` bigint(20) NOT NULL,
  `visit_visitor_id` bigint(20) NOT NULL COMMENT 'fk visitor_id visitante',
  `visit_visit_date` datetime NOT NULL,
  `visit_uri` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`visit_id`),
  KEY `fk_visit_visitor1` (`visit_visitor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `visitante`
--

CREATE TABLE IF NOT EXISTS `visitante` (
  `visitor_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) NOT NULL COMMENT 'fk usuario_id usuarios',
  `visitor_agent` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `visitor_platform` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `visitor_user_agent_string` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `visitor_ip_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `visitor_is_mobile` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `visitor_is_browser` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `visitor_is_robot` char(1) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`visitor_id`),
  KEY `fk_visitor_usuarios1` (`usuario_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=22 ;

--
-- Restrições para as tabelas dumpadas
--

--
-- Restrições para a tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_usuarios_grupos1` FOREIGN KEY (`grupo_id`) REFERENCES `grupos` (`grupo_id`) ON UPDATE CASCADE;

--
-- Restrições para a tabela `usuarios_ativos`
--
ALTER TABLE `usuarios_ativos`
  ADD CONSTRAINT `usuarios_ativos_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`usuario_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Restrições para a tabela `visita`
--
ALTER TABLE `visita`
  ADD CONSTRAINT `fk_visit_visitor1` FOREIGN KEY (`visit_visitor_id`) REFERENCES `visitante` (`visitor_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para a tabela `visitante`
--
ALTER TABLE `visitante`
  ADD CONSTRAINT `fk_visitor_usuarios1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`usuario_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
