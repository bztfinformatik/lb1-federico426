-- Adminer 4.7.3 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

CREATE DATABASE `formDB` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;
USE `formDB`;

DROP TABLE IF EXISTS `Forms`;
CREATE TABLE `Forms` (
  `id` int(11) NOT NULL,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `lastname` text COLLATE utf8_unicode_ci NOT NULL,
  `datefrom` date NOT NULL,
  `dateto` date NOT NULL,
  `listingids` int(11) NOT NULL,
  `total` float NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `Listings`;
CREATE TABLE `Listings` (
  `id` int(11) NOT NULL,
  `formid` int(11) NOT NULL,
  `formdate` date NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `price` double NOT NULL,
  `VAT` double NOT NULL,
  `account` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `Listings` (`id`, `formid`, `formdate`, `description`, `price`, `VAT`, `account`) VALUES
(0,	1,	'2019-11-21',	'FORM1',	999,	78,	100);

-- 2019-11-24 18:15:14