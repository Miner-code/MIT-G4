-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 19 sep. 2023 à 14:46
-- Version du serveur :  5.7.31
-- Version de PHP : 7.3.21

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
  `num_com` int(2) NOT NULL,
  `num_imp` int(2) NOT NULL,
  `cont_com` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`num_com`),
  KEY `FK_Commentaire_Impression` (`num_imp`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `cursus`
--

DROP TABLE IF EXISTS `cursus`;
CREATE TABLE IF NOT EXISTS `cursus` (
  `num_cursus` int(2) NOT NULL,
  `libele_cursus` varchar(128) NOT NULL,
  `spe_cursus` varchar(128) NOT NULL,
  PRIMARY KEY (`num_cursus`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `etablissement`
--

DROP TABLE IF EXISTS `etablissement`;
CREATE TABLE IF NOT EXISTS `etablissement` (
  `num_etab` int(2) NOT NULL,
  `num_Ville` int(2) NOT NULL,
  `nom_etab` varchar(128) DEFAULT NULL,
  `adresse_etab` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`num_etab`),
  KEY `FK_Etablissement_Ville` (`num_Ville`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `impression`
--

DROP TABLE IF EXISTS `impression`;
CREATE TABLE IF NOT EXISTS `impression` (
  `num_imp` int(2) NOT NULL,
  `num_Theme` int(2) NOT NULL,
  `num_user` int(2) NOT NULL,
  `titre_imp` varchar(128) NOT NULL,
  `contenu_imp` varchar(255) NOT NULL,
  PRIMARY KEY (`num_imp`),
  KEY `FK_Impression_Theme` (`num_Theme`),
  KEY `FK_Impression_User` (`num_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `participer`
--

DROP TABLE IF EXISTS `participer`;
CREATE TABLE IF NOT EXISTS `participer` (
  `num_user` int(2) NOT NULL,
  `num_cursus` int(2) NOT NULL,
  `date_obtention` date DEFAULT NULL,
  PRIMARY KEY (`num_user`,`num_cursus`),
  KEY `FK_Participer_Cursus` (`num_cursus`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `theme`
--

DROP TABLE IF EXISTS `theme`;
CREATE TABLE IF NOT EXISTS `theme` (
  `num_theme` int(2) NOT NULL,
  `libele_theme` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`num_theme`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `num_user` int(2) NOT NULL,
  `num_etab` int(2) NOT NULL,
  `nom_user` char(32) NOT NULL,
  `prenom_user` char(32) NOT NULL,
  `mail_user` char(32) NOT NULL,
  `dtn_user` date DEFAULT NULL,
  `mdp_user` char(50) NOT NULL,
  `img_user` varchar(128) DEFAULT NULL,
  `role_user` smallint(1) NOT NULL,
  PRIMARY KEY (`num_user`),
  KEY `FK_User_Etablissement` (`num_etab`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `ville`
--

DROP TABLE IF EXISTS `ville`;
CREATE TABLE IF NOT EXISTS `ville` (
  `num_ville` int(2) NOT NULL,
  `nom_ville` char(32) DEFAULT NULL,
  `cp_ville` int(5) DEFAULT NULL,
  PRIMARY KEY (`num_ville`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD CONSTRAINT `commentaire_ibfk_1` FOREIGN KEY (`num_imp`) REFERENCES `impression` (`num_imp`);

--
-- Contraintes pour la table `etablissement`
--
ALTER TABLE `etablissement`
  ADD CONSTRAINT `etablissement_ibfk_1` FOREIGN KEY (`num_Ville`) REFERENCES `ville` (`num_ville`);

--
-- Contraintes pour la table `impression`
--
ALTER TABLE `impression`
  ADD CONSTRAINT `impression_ibfk_1` FOREIGN KEY (`num_Theme`) REFERENCES `theme` (`num_theme`),
  ADD CONSTRAINT `impression_ibfk_2` FOREIGN KEY (`num_user`) REFERENCES `user` (`num_user`);

--
-- Contraintes pour la table `participer`
--
ALTER TABLE `participer`
  ADD CONSTRAINT `participer_ibfk_1` FOREIGN KEY (`num_user`) REFERENCES `user` (`num_user`),
  ADD CONSTRAINT `participer_ibfk_2` FOREIGN KEY (`num_cursus`) REFERENCES `cursus` (`num_cursus`);

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`num_etab`) REFERENCES `etablissement` (`num_etab`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
