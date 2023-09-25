-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 25 sep. 2023 à 08:08
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
-- Base de données : `bdd`
--

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

DROP TABLE IF EXISTS `commentaire`;
CREATE TABLE IF NOT EXISTS `commentaire` (
  `num_commentaire` int(11) NOT NULL AUTO_INCREMENT,
  `contenu_commentaire` text,
  `date_publication_commentaire` date DEFAULT NULL,
  `num_impression` int(11) NOT NULL,
  PRIMARY KEY (`num_commentaire`),
  KEY `num_impression` (`num_impression`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `cursus`
--

DROP TABLE IF EXISTS `cursus`;
CREATE TABLE IF NOT EXISTS `cursus` (
  `num_cursus` int(11) NOT NULL AUTO_INCREMENT,
  `libelle_cursus` varchar(250) DEFAULT NULL,
  `spe_cursus` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`num_cursus`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `etablissement`
--

DROP TABLE IF EXISTS `etablissement`;
CREATE TABLE IF NOT EXISTS `etablissement` (
  `num_etab` int(11) NOT NULL AUTO_INCREMENT,
  `nom_etab` varchar(200) DEFAULT NULL,
  `adresse_etab` varchar(250) DEFAULT NULL,
  `num_ville` int(11) NOT NULL,
  PRIMARY KEY (`num_etab`),
  KEY `num_ville` (`num_ville`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `impression`
--

DROP TABLE IF EXISTS `impression`;
CREATE TABLE IF NOT EXISTS `impression` (
  `num_impression` int(11) NOT NULL AUTO_INCREMENT,
  `titre_impression` varchar(250) DEFAULT NULL,
  `contenu_impression` text,
  `num_theme` int(11) NOT NULL,
  `num_user` int(11) NOT NULL,
  PRIMARY KEY (`num_impression`),
  KEY `num_theme` (`num_theme`),
  KEY `num_user` (`num_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `participer`
--

DROP TABLE IF EXISTS `participer`;
CREATE TABLE IF NOT EXISTS `participer` (
  `num_user` int(11) NOT NULL,
  `num_cursus` int(11) NOT NULL,
  `num_etab` int(11) NOT NULL,
  `date_debut` date DEFAULT NULL,
  `date_fin` date DEFAULT NULL,
  PRIMARY KEY (`num_user`,`num_cursus`,`num_etab`),
  KEY `num_cursus` (`num_cursus`),
  KEY `num_etab` (`num_etab`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `theme`
--

DROP TABLE IF EXISTS `theme`;
CREATE TABLE IF NOT EXISTS `theme` (
  `num_theme` int(11) NOT NULL AUTO_INCREMENT,
  `libelle_theme` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`num_theme`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `num_user` int(11) NOT NULL AUTO_INCREMENT,
  `nom_user` varchar(50) NOT NULL,
  `prenom_user` varchar(50) NOT NULL,
  `mail_user` varchar(50) NOT NULL,
  `dtn_user` date DEFAULT NULL,
  `mdp_user` varchar(50) NOT NULL,
  `img_user` varchar(250) DEFAULT NULL,
  `role_user` int(11) NOT NULL,
  PRIMARY KEY (`num_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `ville`
--

DROP TABLE IF EXISTS `ville`;
CREATE TABLE IF NOT EXISTS `ville` (
  `num_ville` int(11) NOT NULL AUTO_INCREMENT,
  `nom_ville` varchar(50) DEFAULT NULL,
  `cp_ville` decimal(5,0) DEFAULT NULL,
  PRIMARY KEY (`num_ville`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD CONSTRAINT `commentaire_ibfk_1` FOREIGN KEY (`num_impression`) REFERENCES `impression` (`num_impression`);

--
-- Contraintes pour la table `etablissement`
--
ALTER TABLE `etablissement`
  ADD CONSTRAINT `etablissement_ibfk_1` FOREIGN KEY (`num_ville`) REFERENCES `ville` (`num_ville`);

--
-- Contraintes pour la table `impression`
--
ALTER TABLE `impression`
  ADD CONSTRAINT `impression_ibfk_1` FOREIGN KEY (`num_theme`) REFERENCES `theme` (`num_theme`),
  ADD CONSTRAINT `impression_ibfk_2` FOREIGN KEY (`num_user`) REFERENCES `user` (`num_user`);

--
-- Contraintes pour la table `participer`
--
ALTER TABLE `participer`
  ADD CONSTRAINT `participer_ibfk_1` FOREIGN KEY (`num_user`) REFERENCES `user` (`num_user`),
  ADD CONSTRAINT `participer_ibfk_2` FOREIGN KEY (`num_cursus`) REFERENCES `cursus` (`num_cursus`),
  ADD CONSTRAINT `participer_ibfk_3` FOREIGN KEY (`num_etab`) REFERENCES `etablissement` (`num_etab`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
