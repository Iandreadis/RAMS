-- phpMyAdmin SQL Dump
-- version 4.0.10.14
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Jul 07, 2016 at 10:40 PM
-- Server version: 5.5.50-cll
-- PHP Version: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `iandread_RAMS`
--
CREATE DATABASE IF NOT EXISTS `iandread_RAMS` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `iandread_RAMS`;

-- --------------------------------------------------------

--
-- Table structure for table `basket`
--

CREATE TABLE IF NOT EXISTS `basket` (
  `prod_id` int(11) NOT NULL DEFAULT '0',
  `cust_id` int(11) NOT NULL DEFAULT '0',
  `quantity` float DEFAULT NULL,
  PRIMARY KEY (`prod_id`,`cust_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Truncate table before insert `basket`
--

TRUNCATE TABLE `basket`;
--
-- Dumping data for table `basket`
--

INSERT INTO `basket` (`prod_id`, `cust_id`, `quantity`) VALUES
(2, 2, 1),
(19, 2, 1),
(19, 10, 2),
(20, 10, 3),
(21, 2, 2),
(21, 10, 2),
(22, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `cf_costs`
--

CREATE TABLE IF NOT EXISTS `cf_costs` (
  `cost_id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `type` int(11) NOT NULL,
  `description` text NOT NULL,
  `amount` decimal(10,0) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  PRIMARY KEY (`cost_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Truncate table before insert `cf_costs`
--

TRUNCATE TABLE `cf_costs`;
-- --------------------------------------------------------

--
-- Table structure for table `cf_costtypes`
--

CREATE TABLE IF NOT EXISTS `cf_costtypes` (
  `type_id` int(11) NOT NULL AUTO_INCREMENT,
  `type_name` int(11) NOT NULL,
  PRIMARY KEY (`type_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Truncate table before insert `cf_costtypes`
--

TRUNCATE TABLE `cf_costtypes`;
-- --------------------------------------------------------

--
-- Table structure for table `cf_documents`
--

CREATE TABLE IF NOT EXISTS `cf_documents` (
  `document_id` int(11) NOT NULL AUTO_INCREMENT,
  `event_id` int(11) NOT NULL,
  PRIMARY KEY (`document_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Truncate table before insert `cf_documents`
--

TRUNCATE TABLE `cf_documents`;
-- --------------------------------------------------------

--
-- Table structure for table `cf_emp_events`
--

CREATE TABLE IF NOT EXISTS `cf_emp_events` (
  `employee_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Truncate table before insert `cf_emp_events`
--

TRUNCATE TABLE `cf_emp_events`;
--
-- Dumping data for table `cf_emp_events`
--

INSERT INTO `cf_emp_events` (`employee_id`, `event_id`) VALUES
(5, 9),
(6, 9),
(5, 10);

-- --------------------------------------------------------

--
-- Table structure for table `cf_events`
--

CREATE TABLE IF NOT EXISTS `cf_events` (
  `event_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `location` varchar(30) NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  `customer_id` int(11) NOT NULL,
  `audience` text NOT NULL,
  `event_manager` varchar(30) NOT NULL,
  PRIMARY KEY (`event_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Truncate table before insert `cf_events`
--

TRUNCATE TABLE `cf_events`;
--
-- Dumping data for table `cf_events`
--

INSERT INTO `cf_events` (`event_id`, `name`, `location`, `start`, `end`, `customer_id`, `audience`, `event_manager`) VALUES
(3, 'myconference', 'a', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'Audience', 'Thomas Jonhes'),
(4, 'Conversioning', 'Lydra Hotel', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '?????', 'Lilly Allen'),
(5, 'aa', 'Hilton Hotel', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'aaaaaaa', 'Fixed Pane'),
(8, 'Beach Party', 'Athens Aur', '2016-07-20 01:30:00', '2016-07-08 03:00:00', 8, 'All the good staff !', 'Tolis Voskopoulos'),
(9, 'The best', 'Peraus', '2016-07-16 00:30:00', '2016-07-30 01:00:00', 8, 'Allalaoutis asd', 'Makis Chris'),
(10, 'Summer 2016', 'Mykonos', '2016-07-11 00:00:00', '2016-07-30 02:30:00', 7, 'all the beach', 'Teris Xrysos');

-- --------------------------------------------------------

--
-- Table structure for table `cf_items_events`
--

CREATE TABLE IF NOT EXISTS `cf_items_events` (
  `event_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`event_id`,`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Truncate table before insert `cf_items_events`
--

TRUNCATE TABLE `cf_items_events`;
--
-- Dumping data for table `cf_items_events`
--

INSERT INTO `cf_items_events` (`event_id`, `item_id`, `quantity`) VALUES
(10, 22, 2),
(10, 24, 2),
(10, 25, 5);

-- --------------------------------------------------------

--
-- Table structure for table `cm_customers`
--

CREATE TABLE IF NOT EXISTS `cm_customers` (
  `customer_ID` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(30) NOT NULL,
  `socialsecuritynumber` int(11) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `address` varchar(30) NOT NULL,
  `tax_number` varchar(30) NOT NULL,
  `e_mail` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  PRIMARY KEY (`customer_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Truncate table before insert `cm_customers`
--

TRUNCATE TABLE `cm_customers`;
--
-- Dumping data for table `cm_customers`
--

INSERT INTO `cm_customers` (`customer_ID`, `firstname`, `socialsecuritynumber`, `phone`, `address`, `tax_number`, `e_mail`, `lastname`) VALUES
(1, 'a', 66, '66', '', '', '', ''),
(2, 'giannis andreadis', 1, '13123312', 'asdsdasd', '121124', 'adasdsa', 'ades'),
(3, 'Kostas', 2147483647, '1313312123', 'home', '15451', 'asd', 'm'),
(4, 'Kostas', 4011, '1313312123', 'home', '15451', 'asd', 'm'),
(6, 'sdfsd', 242342455, '24234', 'sdfdsf 234', '234234', 'sdf@er.com', 'fdf'),
(7, 'Nikos', 222222222, '234234', 'sdfs4', '234321', 'sdf@sfd.com', 'Alafouzos'),
(8, 'Pounentis', 234345345, '23435345', 'sdf s324', '234234', 'sdf@tre.com', 'Lakos');

-- --------------------------------------------------------

--
-- Table structure for table `em_employees`
--

CREATE TABLE IF NOT EXISTS `em_employees` (
  `employee_ID` int(11) NOT NULL AUTO_INCREMENT,
  `em_firstname` varchar(30) NOT NULL,
  `socialsecuritynumber` int(11) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `address` varchar(30) NOT NULL,
  `tax_number` varchar(30) NOT NULL,
  `specialty` varchar(30) NOT NULL,
  `status` int(11) NOT NULL,
  `e_mail` varchar(30) NOT NULL,
  `em_lastname` varchar(30) NOT NULL,
  PRIMARY KEY (`employee_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Truncate table before insert `em_employees`
--

TRUNCATE TABLE `em_employees`;
--
-- Dumping data for table `em_employees`
--

INSERT INTO `em_employees` (`employee_ID`, `em_firstname`, `socialsecuritynumber`, `phone`, `address`, `tax_number`, `specialty`, `status`, `e_mail`, `em_lastname`) VALUES
(5, 'giannaras', 13, '411441', 'hometown', '123', 'audio', 3, 'asdasd', 'papadeiros'),
(6, 'Mike', 123154554, '210315015', 'Fery Boat 12', '12121221212', 'none', 1, 'dog@gmail.com', 'Lake');

-- --------------------------------------------------------

--
-- Table structure for table `em_status`
--

CREATE TABLE IF NOT EXISTS `em_status` (
  `status_id` int(11) NOT NULL AUTO_INCREMENT,
  `status_name` varchar(30) NOT NULL,
  PRIMARY KEY (`status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Truncate table before insert `em_status`
--

TRUNCATE TABLE `em_status`;
-- --------------------------------------------------------

--
-- Table structure for table `sp_suppliers`
--

CREATE TABLE IF NOT EXISTS `sp_suppliers` (
  `supplier_ID` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(30) CHARACTER SET latin1 NOT NULL,
  `phone` varchar(30) CHARACTER SET latin1 NOT NULL,
  `address` varchar(30) CHARACTER SET latin1 NOT NULL,
  `tax_number` varchar(30) CHARACTER SET latin1 NOT NULL,
  `e_mail` varchar(30) CHARACTER SET latin1 NOT NULL,
  `lastname` varchar(30) CHARACTER SET latin1 NOT NULL,
  `company_name` varchar(30) CHARACTER SET latin1 NOT NULL,
  `website` varchar(30) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`supplier_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Truncate table before insert `sp_suppliers`
--

TRUNCATE TABLE `sp_suppliers`;
--
-- Dumping data for table `sp_suppliers`
--

INSERT INTO `sp_suppliers` (`supplier_ID`, `firstname`, `phone`, `address`, `tax_number`, `e_mail`, `lastname`, `company_name`, `website`) VALUES
(2, 'Nikos', '1315153152', 'Adreopoulou 12', '12123123', 'sds@sd.com', 'Takis', 'Coca-Cola S.A.', ''),
(3, 'Frichten', '787678687', 'Xin Zao 45', '98621212', 'hjkjh@ere.com', 'Richten', 'Siemens', ''),
(4, 'Ben', '76876876', 'Lex Square NY', '78678687', 'jhghjgjhg@sdf.com', 'Ten', 'Sony', 'www.sony.com'),
(5, 'Petros', '1213123', 'Kolokotroneou', '13123323', 'io@io.gr', 'Solomou', 'BluePrint S.A.', 'www.blueprint.com');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `usr_id` int(11) NOT NULL AUTO_INCREMENT,
  `usr_username` varchar(45) NOT NULL,
  `usr_password` varchar(45) NOT NULL,
  `usr_admin` int(11) DEFAULT NULL,
  PRIMARY KEY (`usr_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Truncate table before insert `users`
--

TRUNCATE TABLE `users`;
--
-- Dumping data for table `users`
--

INSERT INTO `users` (`usr_id`, `usr_username`, `usr_password`, `usr_admin`) VALUES
(1, 'usr1', '1', 1),
(2, 'usr2', '2', 0),
(3, 'ert', 'ertert', 0),
(6, 'Brexit', 'sdfsd', 0),
(7, 'Nikos', 'nick', 0),
(8, 'Makis', 'asd', 0),
(9, 'a', '3', 0),
(10, 'aaa', '111', 0);

-- --------------------------------------------------------

--
-- Table structure for table `wh_categories`
--

CREATE TABLE IF NOT EXISTS `wh_categories` (
  `cat_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(30) NOT NULL,
  `user` smallint(6) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`cat_id`),
  UNIQUE KEY `cat_name` (`cat_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Truncate table before insert `wh_categories`
--

TRUNCATE TABLE `wh_categories`;
-- --------------------------------------------------------

--
-- Table structure for table `wh_images`
--

CREATE TABLE IF NOT EXISTS `wh_images` (
  `image_id` int(11) NOT NULL AUTO_INCREMENT,
  `filename` varchar(50) NOT NULL COMMENT 'e.g. item1,png',
  `image_caption` varchar(200) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`image_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Truncate table before insert `wh_images`
--

TRUNCATE TABLE `wh_images`;
-- --------------------------------------------------------

--
-- Table structure for table `wh_itemimages`
--

CREATE TABLE IF NOT EXISTS `wh_itemimages` (
  `itemimage_ID` int(11) NOT NULL AUTO_INCREMENT,
  `caption` varchar(30) NOT NULL,
  `description` text NOT NULL,
  `item_id` int(11) NOT NULL,
  `filename` varchar(50) NOT NULL,
  PRIMARY KEY (`itemimage_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Truncate table before insert `wh_itemimages`
--

TRUNCATE TABLE `wh_itemimages`;
--
-- Dumping data for table `wh_itemimages`
--

INSERT INTO `wh_itemimages` (`itemimage_ID`, `caption`, `description`, `item_id`, `filename`) VALUES
(20, '', '', 22, '859-BENQ.jpg'),
(21, '', '', 23, 'cable.jpeg'),
(22, '', '', 24, 'yamaha.jpg'),
(23, '', '', 25, 'yamahaspeaker.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `wh_items`
--

CREATE TABLE IF NOT EXISTS `wh_items` (
  `item_id` int(11) NOT NULL AUTO_INCREMENT,
  `model_number` varchar(20) DEFAULT NULL,
  `model` varchar(30) DEFAULT NULL,
  `name` varchar(60) NOT NULL COMMENT 'Characteristic text for item',
  `description` text,
  `category` smallint(6) NOT NULL,
  `brand` smallint(6) DEFAULT NULL,
  `user` smallint(6) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `origin` int(11) NOT NULL,
  `ownership` tinyint(4) DEFAULT NULL,
  `publish` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`item_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Truncate table before insert `wh_items`
--

TRUNCATE TABLE `wh_items`;
--
-- Dumping data for table `wh_items`
--

INSERT INTO `wh_items` (`item_id`, `model_number`, `model`, `name`, `description`, `category`, `brand`, `user`, `timestamp`, `origin`, `ownership`, `publish`, `quantity`) VALUES
(22, '5478', 'Benq Projector', 'X45-F20', 'Brand new from BenQ', 0, NULL, 0, '2016-07-07 19:33:03', 0, NULL, 0, 37),
(23, '7896', 'China Corp.', 'VGA - Cable S11', 'VGA cable female to male', 0, NULL, 0, '2016-07-07 18:17:23', 0, NULL, 0, 120),
(24, '3214', 'Yamaha', 'SX-256 Stereo', 'Stereo sound system for all applications', 0, NULL, 0, '2016-07-07 19:24:35', 0, NULL, 0, 18),
(25, '2596', 'Yamaha', 'Yamaha XZ-7', 'Stereo Speaker DD', 0, NULL, 0, '2016-07-07 19:24:35', 0, NULL, 0, 20);

-- --------------------------------------------------------

--
-- Table structure for table `wh_microphones`
--

CREATE TABLE IF NOT EXISTS `wh_microphones` (
  `micro_id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`micro_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Truncate table before insert `wh_microphones`
--

TRUNCATE TABLE `wh_microphones`;
-- --------------------------------------------------------

--
-- Table structure for table `wh_monitors`
--

CREATE TABLE IF NOT EXISTS `wh_monitors` (
  `monitor_id` int(11) NOT NULL AUTO_INCREMENT,
  `monitor_item_id` int(11) NOT NULL,
  PRIMARY KEY (`monitor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Truncate table before insert `wh_monitors`
--

TRUNCATE TABLE `wh_monitors`;
-- --------------------------------------------------------

--
-- Table structure for table `wh_projectors`
--

CREATE TABLE IF NOT EXISTS `wh_projectors` (
  `proj_id` int(11) NOT NULL AUTO_INCREMENT,
  `proj_item_id` int(11) NOT NULL,
  `resolution` varchar(11) NOT NULL,
  `Aspect Ratio` varchar(30) NOT NULL,
  `luminance` varchar(30) NOT NULL,
  `name` varchar(30) NOT NULL,
  PRIMARY KEY (`proj_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Truncate table before insert `wh_projectors`
--

TRUNCATE TABLE `wh_projectors`;
--
-- Dumping data for table `wh_projectors`
--

INSERT INTO `wh_projectors` (`proj_id`, `proj_item_id`, `resolution`, `Aspect Ratio`, `luminance`, `name`) VALUES
(1, 0, '1024', 'beautiful', 'very bright', ''),
(2, 2, '3', 'a', 'b', '');

-- --------------------------------------------------------

--
-- Table structure for table `wh_rented`
--

CREATE TABLE IF NOT EXISTS `wh_rented` (
  `cost` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Truncate table before insert `wh_rented`
--

TRUNCATE TABLE `wh_rented`;
-- --------------------------------------------------------

--
-- Table structure for table `wh_sns`
--

CREATE TABLE IF NOT EXISTS `wh_sns` (
  `item_id` int(11) NOT NULL,
  `sn` varchar(30) NOT NULL,
  `notes` varchar(255) NOT NULL,
  `user` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Truncate table before insert `wh_sns`
--

TRUNCATE TABLE `wh_sns`;
-- --------------------------------------------------------

--
-- Table structure for table `wh_speakers`
--

CREATE TABLE IF NOT EXISTS `wh_speakers` (
  `speak_id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`speak_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Truncate table before insert `wh_speakers`
--

TRUNCATE TABLE `wh_speakers`;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
