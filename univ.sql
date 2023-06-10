-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : sam. 10 juin 2023 à 18:49
-- Version du serveur : 10.4.24-MariaDB
-- Version de PHP : 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `univ`
--

-- --------------------------------------------------------

--
-- Structure de la table `image`
--

CREATE TABLE `image` (
  `id` int(11) NOT NULL,
  `front` text COLLATE utf8_unicode_ci NOT NULL,
  `left` text COLLATE utf8_unicode_ci NOT NULL,
  `right` text COLLATE utf8_unicode_ci NOT NULL,
  `far` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `image`
--

INSERT INTO `image` (`id`, `front`, `left`, `right`, `far`) VALUES
(8, 'houssam_cheriet/64846b331803c.jpg', 'houssam_cheriet/64846b33190a1.jpg', 'houssam_cheriet/64846b3319dc6.jpg', 'houssam_cheriet/64846b331aa7a.jpg'),
(9, 'houssam_cheriet/6484a57cc34c4.jpg', 'houssam_cheriet/6484a57cc4366.jpg', 'houssam_cheriet/6484a57cc4b54.jpg', 'houssam_cheriet/6484a57cc5302.png'),
(10, 'houssem eddine_cheriet/6484a6a1322fb.jpg', 'houssem eddine_cheriet/6484a6a132750.png', 'houssem eddine_cheriet/6484a6a132b42.jpg', 'houssem eddine_cheriet/6484a6a133137.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `student`
--

CREATE TABLE `student` (
  `id` int(11) NOT NULL,
  `firstname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(160) COLLATE utf8_unicode_ci NOT NULL,
  `birthday` date NOT NULL,
  `place` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `univname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `department` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `specialty` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `card_id` int(11) NOT NULL,
  `imageid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `student`
--

INSERT INTO `student` (`id`, `firstname`, `lastname`, `email`, `birthday`, `place`, `univname`, `department`, `specialty`, `card_id`, `imageid`) VALUES
(1, 'houssam', 'cheriet', 'houssamcheriet@gmail.com', '2000-09-30', 'biskra', 'biskra university', 'computer science', 'ia', 35038643, 9),
(2, 'houssem eddine', 'cheriet', 'houssamcheriet01@gmail.com', '2000-09-30', 'loutay', 'biskra', 'math', 'math', 35038644, 10);

-- --------------------------------------------------------

--
-- Structure de la table `super_user`
--

CREATE TABLE `super_user` (
  `id` int(11) NOT NULL,
  `username` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(200) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `super_user`
--

INSERT INTO `super_user` (`id`, `username`, `password`) VALUES
(3, 'admin', '$2y$10$OvRkWd08TTfPdKTWEP37auTXbJfTjFymyFZsdQlLISeW5ZSIyHBR.');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `stedunt-card-id` (`card_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `student_ibfk_1` (`imageid`);

--
-- Index pour la table `super_user`
--
ALTER TABLE `super_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `image`
--
ALTER TABLE `image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `super_user`
--
ALTER TABLE `super_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`imageid`) REFERENCES `image` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
