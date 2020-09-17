-- phpMyAdmin SQL Dump
-- version 3.1.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 04, 2020 at 09:26 PM
-- Server version: 5.1.30
-- PHP Version: 5.2.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `leboncup`
--

-- --------------------------------------------------------

--
-- Table structure for table `ads`
--

CREATE TABLE IF NOT EXISTS `ads` (
  `idad` int(50) NOT NULL AUTO_INCREMENT,
  `title` varchar(30) NOT NULL,
  `category` varchar(30) NOT NULL,
  `description` varchar(3000) NOT NULL,
  `image1` varchar(100) NOT NULL DEFAULT '',
  `image2` varchar(100) NOT NULL DEFAULT '',
  `image3` varchar(100) NOT NULL DEFAULT '',
  `price` int(20) NOT NULL DEFAULT '0',
  `views` int(20) NOT NULL DEFAULT '0',
  `visibility` varchar(30) NOT NULL DEFAULT 'every_one',
  `location` varchar(30) NOT NULL DEFAULT '',
  `seller` varchar(25) NOT NULL,
  `publish_date` datetime NOT NULL,
  `last_refresh` datetime NOT NULL,
  `status` varchar(30) NOT NULL DEFAULT 'to_sell',
  PRIMARY KEY (`idad`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=58 ;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `idcat` int(30) NOT NULL AUTO_INCREMENT,
  `category` varchar(30) NOT NULL,
  `category_cleaned` varchar(30) NOT NULL,
  `icon` varchar(30) NOT NULL,
  `parent` int(30) DEFAULT NULL,
  `description` varchar(200) NOT NULL,
  `visibililty` varchar(30) NOT NULL,
  PRIMARY KEY (`idcat`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `idmessage` int(11) NOT NULL AUTO_INCREMENT,
  `send_by` varchar(30) NOT NULL,
  `dest` varchar(30) NOT NULL,
  `text` varchar(150) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`idmessage`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=105 ;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE IF NOT EXISTS `notifications` (
  `date` datetime NOT NULL,
  `idnotif` int(11) NOT NULL AUTO_INCREMENT,
  `iduser` varchar(30) NOT NULL,
  `icon` varchar(100) NOT NULL,
  `content` varchar(200) NOT NULL,
  `viewed` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idnotif`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=37 ;

-- --------------------------------------------------------

--
-- Table structure for table `suggestions`
--

CREATE TABLE IF NOT EXISTS `suggestions` (
  `idsuggestion` int(11) NOT NULL AUTO_INCREMENT,
  `iduser` varchar(25) NOT NULL DEFAULT '',
  `title` varchar(30) NOT NULL,
  `content` varchar(3000) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`idsuggestion`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `iduser` varchar(25) NOT NULL,
  `username` varchar(25) NOT NULL,
  `creation_account` datetime NOT NULL,
  `last_connexion` datetime NOT NULL,
  `phone` varchar(15) NOT NULL DEFAULT '',
  `phone_visibility` varchar(30) NOT NULL DEFAULT 'only_me',
  `mail` varchar(50) NOT NULL,
  `mail_visibility` varchar(30) NOT NULL DEFAULT 'every_one',
  `facebook` varchar(100) NOT NULL DEFAULT '',
  `facebook_visibility` varchar(30) NOT NULL DEFAULT 'only_me',
  `cash` tinyint(1) NOT NULL DEFAULT '1',
  `visa` tinyint(1) NOT NULL DEFAULT '1',
  `payut` tinyint(1) NOT NULL DEFAULT '1',
  `beer` tinyint(1) NOT NULL DEFAULT '0',
  `paypal` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`iduser`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users_ad-views-likes`
--

CREATE TABLE IF NOT EXISTS `users_ad-views-likes` (
  `iduser` varchar(25) NOT NULL,
  `idad` int(50) NOT NULL,
  `viewed` tinyint(1) NOT NULL DEFAULT '1',
  `liked` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`iduser`,`idad`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `visibility`
--

CREATE TABLE IF NOT EXISTS `visibility` (
  `name` varchar(30) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Dumping data for table `visibility`
--

INSERT INTO `visibility` (`name`, `description`) VALUES
('connected_user', 'Utilisateur connecté '),
('every_one', 'Tout le monde'),
('only_me', 'Seulement moi');


--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`idcat`, `category`, `category_cleaned`, `icon`, `parent`, `description`, `visibililty`) VALUES
(1, 'Toutes catégories', 'toutes-categories', 'icon-menu', NULL, '', 'every_one'),
(2, 'Logement', 'logement', 'icon-lodging', NULL, '', 'every_one'),
(3, 'Location', 'location', '', 2, '', 'every_one'),
(4, 'Colocation', 'colocation', '', 2, '', 'every_one'),
(5, 'Chambre chez l''habitant', 'chambre-chez-l-habitant', '', 2, '', 'every_one'),
(6, 'Mobilier', 'mobilier', '', 2, '', 'every_one'),
(7, 'Décoration', 'decoration', '', 2, '', 'every_one'),
(8, 'Electroménager', 'electromenager', '', 2, '', 'every_one'),
(9, 'Vêtements', 'vetements', 'icon-t-shirt', NULL, '', 'every_one'),
(10, 'Hauts', 'hauts', '', 9, '', 'every_one'),
(11, 'Bas', 'bas', '', 9, '', 'every_one'),
(12, 'Chaussures', 'chaussures', '', 9, '', 'every_one'),
(13, 'Accessoires', 'accessoires', '', 9, '', 'every_one'),
(14, 'Transport', 'transport', 'icon-bicycle', NULL, '', 'every_one'),
(15, 'Voitures', 'voitures', '', 14, '', 'every_one'),
(16, 'Vélos', 'velos', '', 14, '', 'every_one'),
(17, 'Skates et rollers', 'skates-et-rollers', '', 14, '', 'every_one'),
(18, 'Covoiturage', 'covoiturage', '', 14, '', 'every_one'),
(19, 'Objets perdus', 'objets-perdus', 'icon-search', NULL, '', 'every_one'),
(20, 'Etudes', 'etudes', 'icon-graduation-cap', NULL, '', 'every_one'),
(21, 'Cours particuliers', 'cours-particuliers', '', 20, '', 'every_one'),
(22, 'Polycopiés', 'polycopies', '', 20, '', 'every_one'),
(23, 'Annales', 'annales', '', 20, '', 'every_one'),
(24, 'Fournitures', 'fournitures', '', 20, '', 'every_one'),
(25, 'Autres', 'autres', 'icon-menu', NULL, '', 'every_one');


ALTER TABLE `users` ADD `mail_news` INT( 10 ) NOT NULL; 
UPDATE `users` SET `mail_news` = FLOOR( 10000 + RAND( ) *89999 ) WHERE 1=1;

ALTER TABLE `users` ADD `mail_ads` INT( 10 ) NOT NULL; 
UPDATE `users` SET `mail_ads` = FLOOR( 10000 + RAND( ) *89999 ) WHERE 1=1;