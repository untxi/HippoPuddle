-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 05-06-2016 a las 13:10:54
-- Versión del servidor: 5.5.49-MariaDB-1ubuntu0.14.04.1
-- Versión de PHP: 5.5.9-1ubuntu4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `hippopuddle`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Words`
--

CREATE TABLE IF NOT EXISTS `Words` (
  `Word_ID` int(16) NOT NULL COMMENT 'It''s the primary key of Words table',
  `Word` text COLLATE utf8_bin NOT NULL COMMENT 'Word for search',
  `WordsInText` int(16) NOT NULL COMMENT 'Quantity of words in text',
  `Link` text COLLATE utf8_bin NOT NULL COMMENT 'Link from where were get the text data',
  `XML_ID` int(4) NOT NULL COMMENT 'ID of Lead in XML for search wole data',
  PRIMARY KEY (`Word_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table for save information about words ';

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
