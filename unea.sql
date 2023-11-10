-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 10 nov. 2023 à 18:24
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
  `id_com` int(11) NOT NULL AUTO_INCREMENT,
  `contenu_com` text,
  `date_com` timestamp NOT NULL,
  `id_imp` int(11) NOT NULL,
  PRIMARY KEY (`id_com`),
  KEY `id_imp` (`id_imp`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `cursus`
--

DROP TABLE IF EXISTS `cursus`;
CREATE TABLE IF NOT EXISTS `cursus` (
  `id_cursus` int(11) NOT NULL AUTO_INCREMENT,
  `libelle_cursus` varchar(250) DEFAULT NULL,
  `spe_cursus` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_cursus`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `cursus`
--

INSERT INTO `cursus` (`id_cursus`, `libelle_cursus`, `spe_cursus`) VALUES
(1, 'BTS SN', 'IR'),
(2, 'BTS SIO', 'SLAM'),
(3, 'BTS SIO', 'SISR'),
(4, 'BTS SN', 'EC'),
(5, 'INGE-1', 'WebMedia'),
(6, 'INGE-1', 'Développement');

-- --------------------------------------------------------

--
-- Structure de la table `etablissement`
--

DROP TABLE IF EXISTS `etablissement`;
CREATE TABLE IF NOT EXISTS `etablissement` (
  `id_etab` int(11) NOT NULL AUTO_INCREMENT,
  `nom_etab` varchar(200) DEFAULT NULL,
  `adresse_etab` varchar(250) DEFAULT NULL,
  `profil_etab` varchar(500) DEFAULT NULL,
  `banniere_etab` varchar(500) DEFAULT NULL,
  `id_ville` int(11) NOT NULL,
  PRIMARY KEY (`id_etab`),
  KEY `id_ville` (`id_ville`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `etablissement`
--

INSERT INTO `etablissement` (`id_etab`, `nom_etab`, `adresse_etab`, `profil_etab`, `banniere_etab`, `id_ville`) VALUES
(1, 'Institut G4 - Marseille', '21 Rue Marc Donadille, 13013 Marseille', 'upload/user/Ecole.png', NULL, 18),
(3, 'Lycée Alphonse-Benoît', 'Cr Victor Hugo, 84800 L\'Isle-sur-la-Sorgue', 'upload/user/Ecole.png', NULL, 1),
(6, 'Marie CURIE', '16 Bd Jeanne d Arc', 'upload/user/Ecole.png', NULL, 18);

-- --------------------------------------------------------

--
-- Structure de la table `impression`
--

DROP TABLE IF EXISTS `impression`;
CREATE TABLE IF NOT EXISTS `impression` (
  `id_imp` int(11) NOT NULL AUTO_INCREMENT,
  `titre_imp` varchar(250) DEFAULT NULL,
  `contenu_imp` text,
  `date_imp` timestamp NOT NULL,
  `id_theme` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id_imp`),
  KEY `id_theme` (`id_theme`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `impression`
--

INSERT INTO `impression` (`id_imp`, `titre_imp`, `contenu_imp`, `date_imp`, `id_theme`, `id_user`) VALUES
(5, 'Institut G4, Marseille', 'Chez G4 on aime sortir des codes. Nous portons une attention toute particulière à la personnalité de nos étudiants et nous valorisons autant les résultats académiques de nos candidats que leurs compétences personnelles (soft skills).\r\nNégociation, esprit d’équipe, créativité, prise de décision, gestion du temps…\r\n\r\nAutant d’atouts primordiaux sur lesquels nous nous appuierons et développerons ensemble, pour faire de vous un élément clé dans votre futur entreprise. Nos différentes formations permettent de s’adapter à votre niveau d’étude, à vos envies futures et à vos caractéristiques personnelles.\r\n\r\nNotre mission, révéler et développer ce qui est unique chez vous, pour vous démarquer et vous aider à devenir qui vous êtes !', '2023-11-09 11:30:00', 6, 3),
(9, 'Lycée Alphonse-Benoît', 'Le Lycée Alphonse Benoît est un lycée polyvalent public situé à L Isle-sur-la-Sorgue et faisant partie de l académie d Aix-Marseille. Il propose deux types de spécialités pour les BTS système numérique: Informatiques & Réseaux et Electroniques & Communications.', '2023-11-09 11:30:00', 4, 2),
(10, 'Lycée Technologique Marie Curie, Marseille', 'Le lycée public Marie-Curie à Marseille est un lycée technique à vocation régionale localisé au cœur de la ville de Marseille. Il accueille 1 400 élèves et étudiants de la seconde jusqu au BTS voire licence pour certaines formations et même master.', '2023-11-09 11:30:00', 3, 1),
(11, 'Lycée Technologique Marie Curie', 'Le lycée technique public Marie-Curie, situé au cœur de la ville de Marseille, est dédié à des formations régionales. Il compte 1 400 élèves et étudiants, allant de la seconde jusqu\'au BTS, voire la licence pour certaines filières, et même le master.\r\n\r\n\r\n\r\n\r\n', '2023-11-10 17:16:36', 4, 1),
(12, 'G4', 'Chez G4, nous aimons rompre avec les conventions. Nous accordons une importance particulière à la personnalité de nos étudiants, mettant en valeur non seulement leurs résultats académiques, mais aussi leurs compétences personnelles (soft skills). La négociation, l\'esprit d\'équipe, la créativité, la prise de décision, la gestion du temps... Ce sont autant d\'atouts essentiels sur lesquels nous nous appuierons et que nous développerons ensemble afin de faire de vous un élément clé au sein de votre future entreprise. Nos diverses formations sont conçues pour s\'adapter à votre niveau d\'étude, à vos aspirations futures et à vos caractéristiques personnelles. Notre mission est de révéler et développer ce qui vous rend unique, vous permettant de vous démarquer et de devenir la personne que vous êtes destiné à être !\r\n\r\n\r\n\r\n\r\n', '2023-11-10 17:21:58', 6, 3);

-- --------------------------------------------------------

--
-- Structure de la table `participer`
--

DROP TABLE IF EXISTS `participer`;
CREATE TABLE IF NOT EXISTS `participer` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `id_cursus` int(11) NOT NULL,
  `id_etab` int(11) NOT NULL,
  `date_debut` varchar(10) DEFAULT NULL,
  `date_fin` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id_user`,`id_cursus`,`id_etab`),
  KEY `id_user` (`id_user`),
  KEY `id_cursus` (`id_cursus`),
  KEY `id_etab` (`id_etab`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `participer`
--

INSERT INTO `participer` (`id_user`, `id_cursus`, `id_etab`, `date_debut`, `date_fin`) VALUES
(1, 2, 6, '01/09/2021', '01/06/2023'),
(2, 1, 3, '01/09/2021', '01/06/2023'),
(3, 3, 1, '01/09/2021', '01/06/2023'),
(9, 6, 1, '01/09/2023', '01/09/2024'),
(10, 6, 1, '01/09/2023', '01/09/2024');

-- --------------------------------------------------------

--
-- Structure de la table `theme`
--

DROP TABLE IF EXISTS `theme`;
CREATE TABLE IF NOT EXISTS `theme` (
  `id_theme` int(11) NOT NULL AUTO_INCREMENT,
  `libelle_theme` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id_theme`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `theme`
--

INSERT INTO `theme` (`id_theme`, `libelle_theme`) VALUES
(3, 'SLAM et SISR'),
(4, 'Système Numérique'),
(6, 'Développement Web et Management');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `nom_user` varchar(50) DEFAULT NULL,
  `prenom_user` varchar(50) DEFAULT NULL,
  `mail_user` varchar(50) DEFAULT NULL,
  `dtn_user` varchar(10) DEFAULT NULL,
  `mdp_user` varchar(65) DEFAULT NULL,
  `img_user` varchar(250) DEFAULT NULL,
  `role_user` int(11) DEFAULT NULL,
  `newsLetter` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id_user`, `nom_user`, `prenom_user`, `mail_user`, `dtn_user`, `mdp_user`, `img_user`, `role_user`, `newsLetter`) VALUES
(1, 'RIEHL', 'Alan', 'admin@gmail.com', '21/04/1999', 'f2d81a260dea8a100dd517984e53c56a7523d96942a834b9cdc249bd4e8c7aa9', 'upload/user/defaut.png', 1, 1),
(2, 'GUY', 'Benjamin', 'test@gmail.com', '22/10/2003', 'f2d81a260dea8a100dd517984e53c56a7523d96942a834b9cdc249bd4e8c7aa9', 'upload/user/defaut.png', 0, 1),
(3, 'VALLET', 'Hugo', 'test2@gmail.com', '30/12/2001', 'f2d81a260dea8a100dd517984e53c56a7523d96942a834b9cdc249bd4e8c7aa9', 'upload/user/defaut.png', 0, 1),
(9, 'MOSTEFAOUI', 'Boualem', 'boualem.mostefaoui@gmail.com', '30/10/2002', 'f2d81a260dea8a100dd517984e53c56a7523d96942a834b9cdc249bd4e8c7aa9', 'upload/user/defaut.png', 0, 1),
(10, 'MONCHAU', 'Ioamra', 'ioamra.monchau@gmail.com', '12/08/1998', 'f2d81a260dea8a100dd517984e53c56a7523d96942a834b9cdc249bd4e8c7aa9', 'upload/user/defaut.png', 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `ville`
--

DROP TABLE IF EXISTS `ville`;
CREATE TABLE IF NOT EXISTS `ville` (
  `id_ville` int(11) NOT NULL AUTO_INCREMENT,
  `nom_ville` varchar(50) DEFAULT NULL,
  `cp_ville` decimal(5,0) DEFAULT NULL,
  PRIMARY KEY (`id_ville`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `ville`
--

INSERT INTO `ville` (`id_ville`, `nom_ville`, `cp_ville`) VALUES
(1, 'Isle-sur-la-Sorgue', '84800'),
(18, 'Marseille', '13000');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD CONSTRAINT `commentaire_ibfk_1` FOREIGN KEY (`id_imp`) REFERENCES `impression` (`id_imp`);

--
-- Contraintes pour la table `etablissement`
--
ALTER TABLE `etablissement`
  ADD CONSTRAINT `etablissement_ibfk_1` FOREIGN KEY (`id_ville`) REFERENCES `ville` (`id_ville`);

--
-- Contraintes pour la table `impression`
--
ALTER TABLE `impression`
  ADD CONSTRAINT `impression_ibfk_1` FOREIGN KEY (`id_theme`) REFERENCES `theme` (`id_theme`),
  ADD CONSTRAINT `impression_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Contraintes pour la table `participer`
--
ALTER TABLE `participer`
  ADD CONSTRAINT `participer_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `participer_ibfk_2` FOREIGN KEY (`id_cursus`) REFERENCES `cursus` (`id_cursus`),
  ADD CONSTRAINT `participer_ibfk_3` FOREIGN KEY (`id_etab`) REFERENCES `etablissement` (`id_etab`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
