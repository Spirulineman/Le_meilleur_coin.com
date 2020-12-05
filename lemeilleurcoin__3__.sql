-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  ven. 04 déc. 2020 à 16:29
-- Version du serveur :  5.7.17
-- Version de PHP :  7.1.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `lemeilleurcoin`
--
CREATE DATABASE `lemeilleurcoin`;
-- --------------------------------------------------------

--
-- Structure de la table `article`
--

CREATE TABLE `article` (
  `id` int(11) UNSIGNED NOT NULL,
  `titre` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `date_creation` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_categorie` int(11) UNSIGNED DEFAULT NULL,
  `prix` varchar(255) NOT NULL,
  `id_user` int(11) UNSIGNED DEFAULT NULL,
  `photo` varchar(255) NOT NULL,
  `disponible` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`id`, `titre`, `description`, `date_creation`, `id_categorie`, `prix`, `id_user`, `photo`, `disponible`) VALUES
(1, 'nous deux', 'Comme c\'est beau !! ;-)', '2020-12-02 10:43:21', NULL, '12', 1, '4_rice_terrace.jpg', 0),
(2, 'super', 'comme c\'est beau', '2020-12-03 10:35:34', NULL, '45', 5, 'unnamed.jpg', 0),
(3, 'là on est bien', 'là on est bien', '2020-12-03 10:35:56', NULL, '23', 6, 'photo_SGJPEYQU.jpg', 0),
(5, 'là on est bien', 'là on est bien', '2020-12-03 10:36:26', NULL, '25', 7, '1240x828_px_cave_China_forest_Jungle_landscape_men_nature-573578.jpg!d.jpg', 0),
(6, 'kilo', 'coucou', '2020-12-03 11:06:32', NULL, '25', 2, '2020_12_03_11_06_32b360299fb7ff02d90ce6bb1e03f82f74.jpg', 0),
(11, 'totologie_2_', 'juju', '2020-12-03 11:20:02', NULL, '12', 7, '2020_12_03_11_20_02b360299fb7ff02d90ce6bb1e03f82f74.jpg', 0),
(12, 'là on est bien', 'là on est bien', '2020-12-03 10:36:26', NULL, '25', 7, '1240x828_px_cave_China_forest_Jungle_landscape_men_nature-573578.jpg!d.jpg', 0),
(13, 'nous deux', 'Comme c\'est beau !! ;-)', '2020-12-02 10:43:21', NULL, '12', 1, '4_rice_terrace.jpg', 0),
(14, 'super', 'comme c\'est beau', '2020-12-03 10:35:34', NULL, '45', 5, 'unnamed.jpg', 0),
(15, 'là on est bien', 'là on est bien', '2020-12-03 10:35:56', NULL, '23', 6, 'photo_SGJPEYQU.jpg', 0),
(16, 'là on est bien', 'là on est bien', '2020-09-24 10:36:26', NULL, '25', 7, '1240x828_px_cave_China_forest_Jungle_landscape_men_nature-573578.jpg!d.jpg', 0),
(17, 'kilo', 'coucou', '2020-12-03 11:06:32', NULL, '25', 2, '2020_12_03_11_06_32b360299fb7ff02d90ce6bb1e03f82f74.jpg', 0),
(18, 'totologie_2_', 'juju', '2020-12-03 11:20:02', NULL, '12', 7, '2020_12_03_11_20_02b360299fb7ff02d90ce6bb1e03f82f74.jpg', 1),
(19, 'là on est bien', 'là on est bien', '2020-12-03 10:36:26', NULL, '25', 7, '1240x828_px_cave_China_forest_Jungle_landscape_men_nature-573578.jpg!d.jpg', 0),
(20, 'gigot', 'd\'agneau', '2020-12-03 17:47:24', NULL, '22', 7, '', 0);

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `id` int(11) UNSIGNED NOT NULL,
  `nom` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `id` int(11) UNSIGNED NOT NULL,
  `date_commande` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_user` int(11) UNSIGNED NOT NULL,
  `id_article` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`id`, `date_commande`, `id_user`, `id_article`) VALUES
(55, '2020-12-02 18:08:15', 9, 16),
(56, '2020-12-03 18:09:01', 9, 20);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) UNSIGNED NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  `telephone` varchar(15) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `mail` varchar(255) NOT NULL,
  `pwd` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `nom`, `prenom`, `adresse`, `admin`, `telephone`, `active`, `mail`, `pwd`) VALUES
(1, 'Karfoul', 'Bobby', '29 rue des Madières22854 Langueux', 0, '0102030405', 1, 'Mazen@local.com', NULL),
(2, 'Covert', 'Harry', '29 rue des Madières\r\n22854 Langueux', 0, '0102030405', 0, 'HarryCovert@lamarmite.com', NULL),
(3, 'bouboa', 'bouboa', '29 rue des Madières22854 Langueux', 0, '0102010201', 1, 'test@test.com', '$2y$10$fP0lG4rh4s5UVHuOIV0y7ex2w9/mhrpeN3oh.TlTOMZ5Z/dRYGJ8a '),
(5, 'iikgvkjg', 'ggg', 'Confirme_Password', 1, '11111111111', 1, 'mail.1@mail.com', '$2y$10$YBp6caad41j50o/pKD3GqOQEoBgZKOTJ81ABuC57xCcnxA4/Kp.PO'),
(6, 'pppp', 'pppp', 'pppp', 0, '11111111111', 1, 'pppp@pppp', '$2y$10$whJuC6Pz7uBIh3/EGQRCVuJ5N9W6HmRe6gvvQHW1o5ld0lLqo1yb.'),
(7, 'kkkkkljjjj', 'kkkkk', 'kkkkk', 0, '00000000000', 1, 'kkkkk@kkkkk.com', '$2y$10$KzvN72H.hd2vKU9U0EUkjOngGc7PrrClV7bLWqRZQz3Lvs6vsJ1QW'),
(9, 'test23', 'test23', 'test23', 0, '51511212121', 1, 'test23@test23.com', '$2y$10$LHWnP8ZyCUXgTi3RBik87.zlCyp7uKy.Rmd6/2dDKVIuut0oqnMzW');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_art--cat` (`id_categorie`),
  ADD KEY `FK_art--user` (`id_user`);

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_comm--art` (`id_article`),
  ADD KEY `FK_comm--user` (`id_user`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mail` (`mail`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `article`
--
ALTER TABLE `article`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `FK_art--cat` FOREIGN KEY (`id_categorie`) REFERENCES `categorie` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_art--user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `FK_comm--art` FOREIGN KEY (`id_article`) REFERENCES `article` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_comm--user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
