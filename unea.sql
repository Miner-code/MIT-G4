-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 09 nov. 2023 à 11:17
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `commentaire`
--

INSERT INTO `commentaire` (`id_com`, `contenu_com`, `date_com`, `id_imp`) VALUES
(4, 'contenu commentaire', '2023-11-07 15:37:07', 4),
(7, 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Modi similique repudiandae eaque labore doloremque obcaecati magnam iste, soluta, minus id nostrum ratione. Fugit maxime molestiae vitae autem veritatis nesciunt aliquid eveniet quaerat quibusdam quis est, sit quod dolore magnam optio. Pariatur voluptatibus accusamus ipsum? Quas quod perspiciatis delectus beatae repellat?\r\n', '2023-11-07 15:50:43', 4),
(8, 'yo ceci \'*est une test', '2023-11-07 15:50:43', 4);

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `cursus`
--

INSERT INTO `cursus` (`id_cursus`, `libelle_cursus`, `spe_cursus`) VALUES
(1, 'BTS SN', 'IR');

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `etablissement`
--

INSERT INTO `etablissement` (`id_etab`, `nom_etab`, `adresse_etab`, `profil_etab`, `banniere_etab`, `id_ville`) VALUES
(1, 'Institut G4 - Marseille', 'Marseille 13e', NULL, NULL, 1),
(3, 'Saint Michel', 'rue de ta race', NULL, NULL, 19);

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `impression`
--

INSERT INTO `impression` (`id_imp`, `titre_imp`, `contenu_imp`, `date_imp`, `id_theme`, `id_user`) VALUES
(4, 'Ecole', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eum recusandae explicabo nesciunt illo. Dolorem pariatur quis voluptatem quod, animi quaerat consectetur repellendus vero iste in, adipisci minima similique totam error ipsam maxime tempora? Ratione officiis architecto quo soluta nihil. Facilis facere deserunt architecto aliquam veniam magni, odit culpa, unde beatae debitis laborum! Earum, beatae ullam! Nostrum laboriosam quibusdam aspernatur, quisquam illum eligendi architecto id, nam sint ut similique saepe dolor modi inventore unde quis! Fugit velit, nemo quaerat officiis eum consectetur delectus laudantium?', '2023-11-07 13:45:50', 1, 1);

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
(1, 1, 1, '01/09/2023', '2023-09-02'),
(9, 1, 3, '12/12/2020', '12/12/2022'),
(10, 1, 3, '03/09/2023', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `theme`
--

DROP TABLE IF EXISTS `theme`;
CREATE TABLE IF NOT EXISTS `theme` (
  `id_theme` int(11) NOT NULL AUTO_INCREMENT,
  `libelle_theme` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id_theme`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `theme`
--

INSERT INTO `theme` (`id_theme`, `libelle_theme`) VALUES
(1, 'Musique'),
(2, 'Culture');

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
(1, 'Sardou', 'Michel', 'admin@gmail.com', '01/01/1980', 'f2d81a260dea8a100dd517984e53c56a7523d96942a834b9cdc249bd4e8c7aa9', 'upload/user/defaut.png', 1, 1),
(2, 'LENFOIRET', 'Heuss', 'test@gmail.com', '12/12/2020', 'f2d81a260dea8a100dd517984e53c56a7523d96942a834b9cdc249bd4e8c7aa9', 'upload/user/defaut.png', 0, 1),
(3, 'Jackson', 'Michael', 'michael.jackson@gmail.com', '01/01/2001', 'f2d81a260dea8a100dd517984e53c56a7523d96942a834b9cdc249bd4e8c7aa9', 'upload/user/defaut.png', 0, 1),
(9, 'Dupond', 'Michel', 'michel@gmail.com', '12/12/1999', 'f2d81a260dea8a100dd517984e53c56a7523d96942a834b9cdc249bd4e8c7aa9', 'upload/user/defaut.png', 0, 1),
(10, 'Tartuf', 'Jacques', 'test2@gmail.com', '12/12/1999', 'f2d81a260dea8a100dd517984e53c56a7523d96942a834b9cdc249bd4e8c7aa9', 'upload/user/defaut.png', 0, 0);

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
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `ville`
--

INSERT INTO `ville` (`id_ville`, `nom_ville`, `cp_ville`) VALUES
(1, 'Isle-sur-la-Sorgue', '84800'),
(18, 'Marseille', '13000'),
(19, 'Marseille', '13000');

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
