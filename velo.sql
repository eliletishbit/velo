-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : sam. 29 avr. 2023 à 17:08
-- Version du serveur : 10.4.27-MariaDB
-- Version de PHP : 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `velo`
--

-- --------------------------------------------------------

--
-- Structure de la table `location`
--

CREATE TABLE `location` (
  `idLoc` int(11) NOT NULL,
  `idVelo` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `dateDebut` datetime NOT NULL,
  `dateFin` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `location`
--

INSERT INTO `location` (`idLoc`, `idVelo`, `userId`, `dateDebut`, `dateFin`) VALUES
(1, 66, 1, '2023-04-27 17:32:00', '2023-04-28 17:32:00'),
(2, 66, 1, '2023-04-27 17:33:00', '2023-04-28 17:33:00'),
(3, 66, 1, '2023-04-27 17:34:00', '2023-04-28 17:34:00'),
(4, 62, 1, '2023-04-28 11:08:00', '2023-05-03 11:08:00');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `userId` int(11) NOT NULL,
  `userName` varchar(255) NOT NULL,
  `userMail` varchar(255) NOT NULL,
  `userMdp` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`userId`, `userName`, `userMail`, `userMdp`) VALUES
(1, 'léa Borgel', 'lea@gmail.com', 'lea@@');

-- --------------------------------------------------------

--
-- Structure de la table `velos`
--

CREATE TABLE `velos` (
  `idVelo` int(11) NOT NULL,
  `modeleVelo` varchar(255) NOT NULL,
  `marqueVelo` varchar(255) NOT NULL,
  `typeVelo` varchar(255) NOT NULL,
  `couleurVelo` varchar(255) NOT NULL,
  `prixLocation` double(10,2) NOT NULL,
  `imageVelo` varchar(255) NOT NULL,
  `inLocation` tinyint(1) NOT NULL,
  `dateAjout` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `velos`
--

INSERT INTO `velos` (`idVelo`, `modeleVelo`, `marqueVelo`, `typeVelo`, `couleurVelo`, `prixLocation`, `imageVelo`, `inLocation`, `dateAjout`) VALUES
(63, 'Cannondale Topstone Carbon 105', 'Cannondale ', 'Vélo de gravel', 'Noir', 90.00, '1682524358C20_C15600M_Topstone_Crb_105_BPL_PD.jpg', 1, '2023-04-26 15:52:38'),
(64, 'Gazelle Orange C7+', 'Gazelle', 'Vélo de ville', 'Rouge', 55.00, '1682524452Gazelle-ebike-ultimate-Velo-electrique.jpg', 0, '2023-04-26 15:54:12'),
(65, 'Gazelle Orange C7+', 'Gazelle', 'Vélo de ville', 'Noir', 59.00, '16825244801280_TOnc2vYd88IOhuLx.png', 0, '2023-04-26 15:54:40'),
(66, 'Cannondale Topstone Carbon 105', 'Cannondale ', 'Vélo de gravel', 'Noir', 79.00, '1682524549Topstone-Carbon-In-The-Wild-6.jpg', 0, '2023-04-26 15:55:49');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`idLoc`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userId`);

--
-- Index pour la table `velos`
--
ALTER TABLE `velos`
  ADD PRIMARY KEY (`idVelo`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `location`
--
ALTER TABLE `location`
  MODIFY `idLoc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `velos`
--
ALTER TABLE `velos`
  MODIFY `idVelo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
