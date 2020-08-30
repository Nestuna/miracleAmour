-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le :  lun. 30 mars 2020 à 16:42
-- Version du serveur :  8.0.13-4
-- Version de PHP :  7.2.24-0ubuntu0.18.04.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `t84EM39Jzz`
--

-- --------------------------------------------------------

--
-- Structure de la table `chat`
--

CREATE TABLE `chat` (
  `id_envoyeur` int(11) NOT NULL,
  `id_receveur` int(11) NOT NULL,
  `message` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `id_message` int(11) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `cinema`
--

CREATE TABLE `cinema` (
  `id_cinema` int(11) NOT NULL,
  `nom_genre` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `identifiant`
--

CREATE TABLE `identifiant` (
  `id_usr` int(11) NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `identifiant-cinema`
--

CREATE TABLE `identifiant-cinema` (
  `id_usr` int(11) NOT NULL,
  `id_cinema` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `identifiant-litterature`
--

CREATE TABLE `identifiant-litterature` (
  `id_usr` int(11) NOT NULL,
  `id_litterature` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `identifiant-musique`
--

CREATE TABLE `identifiant-musique` (
  `id_usr` int(11) NOT NULL,
  `id_musique` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `identifiant-sport`
--

CREATE TABLE `identifiant-sport` (
  `id_usr` int(11) NOT NULL,
  `id_sport` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `litterature`
--

CREATE TABLE `litterature` (
  `id_litterature` int(11) NOT NULL,
  `nom_litterature` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `musique`
--

CREATE TABLE `musique` (
  `id_musique` int(11) NOT NULL,
  `nom_musique` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `photo`
--

CREATE TABLE `photo` (
  `id_photo` int(11) NOT NULL,
  `id_usr` int(11) NOT NULL,
  `url_photo` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `profile_indiv`
--

CREATE TABLE `profile_indiv` (
  `id_indiv` int(11) NOT NULL,
  `id_usr` int(11) NOT NULL,
  `sexe` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `date_naissance` date NOT NULL,
  `adresse` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `orientation_sexe` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `relation`
--

CREATE TABLE `relation` (
  `id_usr1` int(11) NOT NULL,
  `id_usr2` int(11) NOT NULL,
  `match` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `sport`
--

CREATE TABLE `sport` (
  `id_sport` int(11) NOT NULL,
  `nom_sport` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id_message`),
  ADD KEY `chat_identifiant_id_usr_fk` (`id_envoyeur`),
  ADD KEY `chat_identifiant_id_usr_fk_2` (`id_receveur`);

--
-- Index pour la table `cinema`
--
ALTER TABLE `cinema`
  ADD PRIMARY KEY (`id_cinema`);

--
-- Index pour la table `identifiant`
--
ALTER TABLE `identifiant`
  ADD PRIMARY KEY (`id_usr`),
  ADD UNIQUE KEY `identifiant_email_uindex` (`email`);

--
-- Index pour la table `identifiant-cinema`
--
ALTER TABLE `identifiant-cinema`
  ADD PRIMARY KEY (`id_usr`,`id_cinema`),
  ADD KEY `identifiant-cinema_cinema_id_cinema_fk` (`id_cinema`);

--
-- Index pour la table `identifiant-litterature`
--
ALTER TABLE `identifiant-litterature`
  ADD PRIMARY KEY (`id_usr`,`id_litterature`),
  ADD KEY `identifiant-litterature_litterature_id_litterature_fk` (`id_litterature`);

--
-- Index pour la table `identifiant-musique`
--
ALTER TABLE `identifiant-musique`
  ADD PRIMARY KEY (`id_usr`,`id_musique`),
  ADD KEY `identifiant-musique_musique_id_musique_fk` (`id_musique`);

--
-- Index pour la table `identifiant-sport`
--
ALTER TABLE `identifiant-sport`
  ADD PRIMARY KEY (`id_usr`,`id_sport`),
  ADD KEY `identifiant-sport_sport_id_sport_fk` (`id_sport`);

--
-- Index pour la table `litterature`
--
ALTER TABLE `litterature`
  ADD PRIMARY KEY (`id_litterature`);

--
-- Index pour la table `musique`
--
ALTER TABLE `musique`
  ADD PRIMARY KEY (`id_musique`);

--
-- Index pour la table `photo`
--
ALTER TABLE `photo`
  ADD PRIMARY KEY (`id_photo`),
  ADD KEY `photo_identifiant_id_usr_fk` (`id_usr`);

--
-- Index pour la table `profile_indiv`
--
ALTER TABLE `profile_indiv`
  ADD PRIMARY KEY (`id_indiv`),
  ADD KEY `profile_indiv_identifiant_id_usr_fk` (`id_usr`);

--
-- Index pour la table `relation`
--
ALTER TABLE `relation`
  ADD PRIMARY KEY (`id_usr1`,`id_usr2`),
  ADD KEY `relation_identifiant_id_usr_fk_2` (`id_usr2`);

--
-- Index pour la table `sport`
--
ALTER TABLE `sport`
  ADD PRIMARY KEY (`id_sport`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `chat`
--
ALTER TABLE `chat`
  MODIFY `id_message` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `cinema`
--
ALTER TABLE `cinema`
  MODIFY `id_cinema` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `identifiant`
--
ALTER TABLE `identifiant`
  MODIFY `id_usr` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `litterature`
--
ALTER TABLE `litterature`
  MODIFY `id_litterature` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `photo`
--
ALTER TABLE `photo`
  MODIFY `id_photo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `profile_indiv`
--
ALTER TABLE `profile_indiv`
  MODIFY `id_indiv` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `sport`
--
ALTER TABLE `sport`
  MODIFY `id_sport` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `chat`
--
ALTER TABLE `chat`
  ADD CONSTRAINT `chat_identifiant_id_usr_fk` FOREIGN KEY (`id_envoyeur`) REFERENCES `identifiant` (`id_usr`),
  ADD CONSTRAINT `chat_identifiant_id_usr_fk_2` FOREIGN KEY (`id_receveur`) REFERENCES `identifiant` (`id_usr`);

--
-- Contraintes pour la table `identifiant-cinema`
--
ALTER TABLE `identifiant-cinema`
  ADD CONSTRAINT `identifiant-cinema_cinema_id_cinema_fk` FOREIGN KEY (`id_cinema`) REFERENCES `cinema` (`id_cinema`),
  ADD CONSTRAINT `identifiant-cinema_identifiant_id_usr_fk` FOREIGN KEY (`id_usr`) REFERENCES `identifiant` (`id_usr`);

--
-- Contraintes pour la table `identifiant-litterature`
--
ALTER TABLE `identifiant-litterature`
  ADD CONSTRAINT `identifiant-litterature_identifiant_id_usr_fk` FOREIGN KEY (`id_usr`) REFERENCES `identifiant` (`id_usr`),
  ADD CONSTRAINT `identifiant-litterature_litterature_id_litterature_fk` FOREIGN KEY (`id_litterature`) REFERENCES `litterature` (`id_litterature`);

--
-- Contraintes pour la table `identifiant-musique`
--
ALTER TABLE `identifiant-musique`
  ADD CONSTRAINT `identifiant-musique_identifiant_id_usr_fk` FOREIGN KEY (`id_usr`) REFERENCES `identifiant` (`id_usr`),
  ADD CONSTRAINT `identifiant-musique_musique_id_musique_fk` FOREIGN KEY (`id_musique`) REFERENCES `musique` (`id_musique`);

--
-- Contraintes pour la table `identifiant-sport`
--
ALTER TABLE `identifiant-sport`
  ADD CONSTRAINT `identifiant-sport_identifiant_id_usr_fk` FOREIGN KEY (`id_usr`) REFERENCES `identifiant` (`id_usr`),
  ADD CONSTRAINT `identifiant-sport_sport_id_sport_fk` FOREIGN KEY (`id_sport`) REFERENCES `sport` (`id_sport`);

--
-- Contraintes pour la table `photo`
--
ALTER TABLE `photo`
  ADD CONSTRAINT `photo_identifiant_id_usr_fk` FOREIGN KEY (`id_usr`) REFERENCES `identifiant` (`id_usr`);

--
-- Contraintes pour la table `profile_indiv`
--
ALTER TABLE `profile_indiv`
  ADD CONSTRAINT `profile_indiv_identifiant_id_usr_fk` FOREIGN KEY (`id_usr`) REFERENCES `identifiant` (`id_usr`);

--
-- Contraintes pour la table `relation`
--
ALTER TABLE `relation`
  ADD CONSTRAINT `relation_identifiant_id_usr_fk` FOREIGN KEY (`id_usr1`) REFERENCES `identifiant` (`id_usr`),
  ADD CONSTRAINT `relation_identifiant_id_usr_fk_2` FOREIGN KEY (`id_usr2`) REFERENCES `identifiant` (`id_usr`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
