-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Ven 03 Mars 2017 à 01:36
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `archives`
--

-- --------------------------------------------------------

--
-- Structure de la table `recentactivity`
--

CREATE TABLE IF NOT EXISTS `recentactivity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `activite` varchar(250) NOT NULL,
  `date` bigint(20) NOT NULL,
  `iduser` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Contenu de la table `recentactivity`
--

INSERT INTO `recentactivity` (`id`, `activite`, `date`, `iduser`) VALUES
(1, 'jojoa modifier un fichier', 1488497835, 1),
(2, ' a ajouter un nouveau fichier', 1488498064, 1),
(3, 'jojo a ajouter a ajout? des fichiers au dossierimpôt 2008', 1488498778, 1),
(4, 'jojo a modifier un fichier', 1488499826, 1),
(5, 'jojo a supprimer un fichier', 1488499828, 1),
(6, 'jojo a modifier un fichier', 1488499828, 1),
(7, 'jojo a supprimer un fichier', 1488499840, 1),
(8, 'jojo a modifier un fichier', 1488499840, 1),
(9, 'jojo a modifier un fichier', 1488499926, 1),
(10, 'jojo a modifier un fichier', 1488499926, 1),
(11, 'jojo a modifier un fichier', 1488500018, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
