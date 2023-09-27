-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 27 sep. 2023 à 13:32
-- Version du serveur : 5.7.36
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `unea`
--

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

DROP TABLE IF EXISTS `commentaire`;
CREATE TABLE IF NOT EXISTS `commentaire` (
  `num` int(11) NOT NULL AUTO_INCREMENT,
  `contenu` text,
  `num_date` int(11) NOT NULL,
  `num_1` int(11) NOT NULL,
  PRIMARY KEY (`num`),
  KEY `num_date` (`num_date`),
  KEY `num_1` (`num_1`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `cursus`
--

DROP TABLE IF EXISTS `cursus`;
CREATE TABLE IF NOT EXISTS `cursus` (
  `num` int(11) NOT NULL AUTO_INCREMENT,
  `lib` varchar(250) DEFAULT NULL,
  `spe` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`num`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `date_`
--

DROP TABLE IF EXISTS `date_`;
CREATE TABLE IF NOT EXISTS `date_` (
  `num_date` int(11) NOT NULL AUTO_INCREMENT,
  `value_date` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`num_date`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `etablissement`
--

DROP TABLE IF EXISTS `etablissement`;
CREATE TABLE IF NOT EXISTS `etablissement` (
  `num_etablissement` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(200) DEFAULT NULL,
  `adresse` varchar(250) DEFAULT NULL,
  `profil_etablissement` varchar(500) NOT NULL,
  `banniere_etablissement` varchar(500) NOT NULL,
  `num` int(11) NOT NULL,
  PRIMARY KEY (`num_etablissement`),
  KEY `num` (`num`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `impressions`
--

DROP TABLE IF EXISTS `impressions`;
CREATE TABLE IF NOT EXISTS `impressions` (
  `num` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(250) DEFAULT NULL,
  `contenu` text,
  `num_date` int(11) NOT NULL,
  `num_1` int(11) NOT NULL,
  `num_user` int(11) NOT NULL,
  PRIMARY KEY (`num`),
  KEY `num_date` (`num_date`),
  KEY `num_1` (`num_1`),
  KEY `num_user` (`num_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `participer`
--

DROP TABLE IF EXISTS `participer`;
CREATE TABLE IF NOT EXISTS `participer` (
  `num_user` int(11) NOT NULL AUTO_INCREMENT,
  `num` int(11) NOT NULL,
  `num_etablissement` int(11) NOT NULL,
  `date_debut` date DEFAULT NULL,
  `date_fin` date DEFAULT NULL,
  PRIMARY KEY (`num_user`,`num`,`num_etablissement`),
  KEY `num` (`num`),
  KEY `num_etablissement` (`num_etablissement`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `theme`
--

DROP TABLE IF EXISTS `theme`;
CREATE TABLE IF NOT EXISTS `theme` (
  `num` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`num`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `user_`
--

DROP TABLE IF EXISTS `user_`;
CREATE TABLE IF NOT EXISTS `user_` (
  `num_user` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) DEFAULT NULL,
  `prenom` varchar(50) DEFAULT NULL,
  `mail` varchar(50) DEFAULT NULL,
  `dtn` date DEFAULT NULL,
  `mdp` varchar(50) DEFAULT NULL,
  `img` varchar(250) DEFAULT NULL,
  `role` int(11) DEFAULT NULL,
  PRIMARY KEY (`num_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `ville`
--

DROP TABLE IF EXISTS `ville`;
CREATE TABLE IF NOT EXISTS `ville` (
  `num` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) DEFAULT NULL,
  `cp` decimal(5,0) DEFAULT NULL,
  PRIMARY KEY (`num`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD CONSTRAINT `commentaire_ibfk_1` FOREIGN KEY (`num_date`) REFERENCES `date_` (`num_date`),
  ADD CONSTRAINT `commentaire_ibfk_2` FOREIGN KEY (`num_1`) REFERENCES `impressions` (`num`);

--
-- Contraintes pour la table `etablissement`
--
ALTER TABLE `etablissement`
  ADD CONSTRAINT `etablissement_ibfk_1` FOREIGN KEY (`num`) REFERENCES `ville` (`num`);

--
-- Contraintes pour la table `impressions`
--
ALTER TABLE `impressions`
  ADD CONSTRAINT `impressions_ibfk_1` FOREIGN KEY (`num_date`) REFERENCES `date_` (`num_date`),
  ADD CONSTRAINT `impressions_ibfk_2` FOREIGN KEY (`num_1`) REFERENCES `theme` (`num`),
  ADD CONSTRAINT `impressions_ibfk_3` FOREIGN KEY (`num_user`) REFERENCES `user_` (`num_user`);

--
-- Contraintes pour la table `participer`
--
ALTER TABLE `participer`
  ADD CONSTRAINT `participer_ibfk_1` FOREIGN KEY (`num_user`) REFERENCES `user_` (`num_user`),
  ADD CONSTRAINT `participer_ibfk_2` FOREIGN KEY (`num`) REFERENCES `cursus` (`num`),
  ADD CONSTRAINT `participer_ibfk_3` FOREIGN KEY (`num_etablissement`) REFERENCES `etablissement` (`num_etablissement`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
