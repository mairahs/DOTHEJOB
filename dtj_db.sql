-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Client: 127.0.0.1
-- Généré le: Jeu 07 Mai 2015 à 17:32
-- Version du serveur: 5.5.32
-- Version de PHP: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `dtj_db`
--
CREATE DATABASE IF NOT EXISTS `dtj_db` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `dtj_db`;

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE IF NOT EXISTS `categorie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `categorie`
--

INSERT INTO `categorie` (`id`, `nom`) VALUES
(1, 'Design'),
(2, 'Développement');

-- --------------------------------------------------------

--
-- Structure de la table `competence`
--

CREATE TABLE IF NOT EXISTS `competence` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `competence`
--

INSERT INTO `competence` (`id`, `nom`) VALUES
(1, 'Photoshop'),
(2, 'PLV'),
(3, 'Illustrator'),
(4, 'symphony');

-- --------------------------------------------------------

--
-- Structure de la table `competence_job`
--

CREATE TABLE IF NOT EXISTS `competence_job` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_j` int(11) NOT NULL,
  `id_c` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `competence_job_j_fk` (`id_j`),
  KEY `competence_job_c_fk` (`id_c`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Contenu de la table `competence_job`
--

INSERT INTO `competence_job` (`id`, `id_j`, `id_c`) VALUES
(2, 1, 2),
(4, 1, 3),
(5, 7, 1),
(6, 7, 2),
(7, 7, 3),
(8, 8, 2),
(9, 8, 3),
(13, 2, 2),
(14, 2, 3);

-- --------------------------------------------------------

--
-- Structure de la table `contrat`
--

CREATE TABLE IF NOT EXISTS `contrat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `contrat`
--

INSERT INTO `contrat` (`id`, `nom`) VALUES
(1, 'CDD'),
(2, 'CDI');

-- --------------------------------------------------------

--
-- Structure de la table `job`
--

CREATE TABLE IF NOT EXISTS `job` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) DEFAULT NULL,
  `offre_short` text,
  `offre_long` text,
  `created_at` datetime DEFAULT NULL,
  `id_cat` int(11) NOT NULL,
  `id_societe` int(11) NOT NULL,
  `id_contrat` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `job_categorie_fk` (`id_cat`),
  KEY `job_contrat_fk` (`id_contrat`),
  KEY `job_societe_fk` (`id_societe`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Contenu de la table `job`
--

INSERT INTO `job` (`id`, `nom`, `offre_short`, `offre_long`, `created_at`, `id_cat`, `id_societe`, `id_contrat`) VALUES
(1, 'Formateur PHP', 'Desc courte du job formateur php', 'Description longue du job Formateur PHP', '2015-04-15 15:34:14', 2, 1, 1),
(2, 'graphiste PLV 44', 'Desc courte graphiste PLV', 'Desc longue graphiste PLV', '2015-04-24 14:20:18', 1, 1, 2),
(3, 'Developpeur Front end', 'Offre short Developpeur front end', 'Offre long Developpeur front end', '2015-04-22 10:29:41', 1, 1, 1),
(4, 'DÃ©veloppeur Back End Symfony', 'DÃ©veloppeur Back End Symfonycourte', 'DÃ©veloppeur Back End Symfony longue', '2015-04-22 13:00:25', 2, 2, 2),
(5, 'llkkd', 'ddddd', 'dddd', '2015-04-22 15:11:45', 2, 2, 2),
(6, 'jjjj', 'xxx', 'xx', '2015-04-22 15:57:41', 1, 1, 1),
(7, 'jjjj', 'xxx', 'xx', '2015-04-22 16:00:10', 1, 1, 1),
(8, 'ggg', 'gg', 'gg', '2015-04-22 16:00:29', 1, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `societe`
--

CREATE TABLE IF NOT EXISTS `societe` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) DEFAULT NULL,
  `nom_rh` varchar(255) DEFAULT NULL,
  `infos` text,
  `adresse` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `societe`
--

INSERT INTO `societe` (`id`, `nom`, `nom_rh`, `infos`, `adresse`) VALUES
(1, 'Next Formation', 'Pascale', 'Centre de Formation', '9 Avenue de Paris 94300 VINCENES'),
(2, 'Fnac', 'Max Théret', 'Ex revendeur de disques', 'Clichy La Garenne');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id`, `username`, `password`) VALUES
(1, 'Mairah', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `competence_job`
--
ALTER TABLE `competence_job`
  ADD CONSTRAINT `competence_job_c_fk` FOREIGN KEY (`id_c`) REFERENCES `competence` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `competence_job_j_fk` FOREIGN KEY (`id_j`) REFERENCES `job` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `job`
--
ALTER TABLE `job`
  ADD CONSTRAINT `job_categorie_fk` FOREIGN KEY (`id_cat`) REFERENCES `categorie` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `job_contrat_fk` FOREIGN KEY (`id_contrat`) REFERENCES `contrat` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `job_societe_fk` FOREIGN KEY (`id_societe`) REFERENCES `societe` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
