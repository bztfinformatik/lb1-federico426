SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';


USE `formDB`;

DROP TABLE IF EXISTS `Forms`;
CREATE TABLE `Forms` (
  `id` int(11) NOT NULL,
  `email` text COLLATE utf8_unicode_ci NOT NULL,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `lastname` text COLLATE utf8_unicode_ci NOT NULL,
  `company` text COLLATE utf8_unicode_ci NOT NULL,
  `event` text COLLATE utf8_unicode_ci NOT NULL,
  `datefrom` date NOT NULL,
  `dateto` date NOT NULL,
  `listingids` int(11) NOT NULL,
  `total` float NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `Forms` (`id`, `email`, `name`, `lastname`, `event`, `company`, `datefrom`, `dateto`, `listingids`, `total`, `status`) VALUES
(1,'federico.degan@yahoo.com', 'Federico', 'Degan', 'Event', 'Casasoft', '2019-11-17', '2019-11-20', 1,  12.5, 0),
(2,'federico.degan@yahoo.com', 'Federico Degan', 'Degan', 'Weihnachtsfeier', 'Casasoft', '2019-11-13', '2019-11-21', 2,  123,  1),
(3,'federico.degan@yahoo.com', 'Federico Degan', 'Degan', 'Event in Bern', 'Casasoft', '2019-11-24', '2019-11-24', 3,  274.29, 0),
(4,'federico.degan@yahoo.com', 'Federico Degan', 'Degan', 'Reise nach Köln', 'Immoscout24', '2019-11-24', '2019-11-24', 4,  137.76, 1),
(5,'federico.degan@yahoo.com', 'Federico Degan', 'Degan', 'Kundenbesuch', 'Immoscout24', '2019-11-28', '2019-11-29', 5,  262.08, 0)
ON DUPLICATE KEY UPDATE `id` = VALUES(`id`),`email` = VALUES(`email`), `name` = VALUES(`name`), `lastname` = VALUES(`lastname`), `event` = VALUES(`event`), `company` = VALUES(`company`), `datefrom` = VALUES(`datefrom`), `dateto` = VALUES(`dateto`), `listingids` = VALUES(`listingids`), `total` = VALUES(`total`), `status` = VALUES(`status`);

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
(0, 1,  '2019-11-21', 'FORM1',  999,  78, 100),
(0, 2,  '2019-11-30', '1223', 123,  7,  100),
(0, 3,  '2019-11-20', 'qewd', 123,  123,  100),
(0, 4,  '2019-11-30', 'wqrwer', 123,  12, 100),
(0, 5,  '2019-11-22', 'wwferfger',  234,  12, 100)
ON DUPLICATE KEY UPDATE `id` = VALUES(`id`), `formid` = VALUES(`formid`), `formdate` = VALUES(`formdate`), `description` = VALUES(`description`), `price` = VALUES(`price`), `VAT` = VALUES(`VAT`), `account` = VALUES(`account`);