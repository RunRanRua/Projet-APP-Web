-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : mer. 08 mai 2024 à 18:57
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `mydb`
--

-- --------------------------------------------------------

--
-- Structure de la table `Artiste`
--

CREATE TABLE `Artiste` (
  `idArtiste` int(11) NOT NULL,
  `Nom_de_scène` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `Billet_achete`
--

CREATE TABLE `Billet_achete` (
  `Date_achat_billet` date DEFAULT NULL,
  `Prix_billet` int(11) DEFAULT NULL,
  `idPlace` int(11) NOT NULL,
  `idBillet` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `Commentaire`
--

CREATE TABLE `Commentaire` (
  `idCommentaire` int(11) NOT NULL DEFAULT 1,
  `Date_commentaire` date DEFAULT NULL,
  `Like_commentaire` int(11) DEFAULT NULL,
  `Contenu_commentaire` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `Commentaire`
--

INSERT INTO `Commentaire` (`idCommentaire`, `Date_commentaire`, `Like_commentaire`, `Contenu_commentaire`) VALUES
(1, '2024-04-22', 0, 'Default Comment');

-- --------------------------------------------------------

--
-- Structure de la table `Concert`
--

CREATE TABLE `Concert` (
  `idConcert` int(11) NOT NULL,
  `Titre` varchar(45) DEFAULT NULL,
  `Date_concert` date DEFAULT NULL,
  `Duree` int(11) DEFAULT NULL,
  `Description` varchar(255) DEFAULT NULL,
  `Categorie` varchar(45) DEFAULT NULL,
  `Etat` varchar(45) DEFAULT NULL,
  `Like` int(11) DEFAULT NULL,
  `ImagePath` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `Concert`
--

INSERT INTO `Concert` (`idConcert`, `Titre`, `Date_concert`, `Duree`, `Description`, `Categorie`, `Etat`, `Like`, `ImagePath`) VALUES
(21, 'Beatlssss', '2024-05-03', NULL, 'Concert en salle fermée ! Maximu 2000 personnes', NULL, NULL, NULL, 'concert1.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `Concert_has_Artiste`
--

CREATE TABLE `Concert_has_Artiste` (
  `idConcert` int(11) NOT NULL,
  `idArtiste` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `Donnees`
--

CREATE TABLE `Donnees` (
  `idDonnees` int(11) NOT NULL,
  `date` date NOT NULL,
  `niveauSonore` int(11) NOT NULL,
  `idCapteurSonore` int(11) NOT NULL,
  `Heure` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `Donnees`
--

INSERT INTO `Donnees` (`idDonnees`, `date`, `niveauSonore`, `idCapteurSonore`, `Heure`) VALUES
(89, '2024-05-02', 65, 1, '2024-05-02 08:00:00'),
(90, '2024-05-02', 70, 1, '2024-05-02 09:00:00'),
(91, '2024-05-02', 75, 1, '2024-05-02 10:00:00'),
(95, '2024-05-01', 60, 1, '2024-05-01 00:00:00'),
(96, '2024-05-01', 62, 1, '2024-05-01 01:00:00'),
(97, '2024-05-01', 64, 1, '2024-05-01 02:00:00'),
(98, '2024-05-01', 63, 1, '2024-05-01 03:00:00'),
(99, '2024-05-01', 65, 1, '2024-05-01 04:00:00'),
(100, '2024-05-01', 67, 1, '2024-05-01 05:00:00'),
(101, '2024-05-02', 68, 1, '2024-05-02 00:00:00'),
(102, '2024-05-02', 70, 1, '2024-05-02 01:00:00'),
(103, '2024-05-03', 72, 1, '2024-05-03 00:00:00'),
(104, '2024-05-04', 73, 1, '2024-05-04 00:00:00'),
(105, '2024-05-05', 74, 1, '2024-05-05 00:00:00'),
(106, '2024-05-06', 75, 1, '2024-05-06 00:00:00'),
(107, '2024-05-07', 76, 1, '2024-05-07 00:00:00'),
(108, '2024-05-08', 77, 1, '2024-05-08 00:00:00'),
(109, '2024-05-09', 78, 1, '2024-05-09 00:00:00'),
(110, '2024-05-10', 79, 1, '2024-05-10 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `FAQ`
--

CREATE TABLE `FAQ` (
  `idFAQ` int(11) NOT NULL,
  `Titre` varchar(45) DEFAULT NULL,
  `Contenu` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `FAQ`
--

INSERT INTO `FAQ` (`idFAQ`, `Titre`, `Contenu`) VALUES
(1, 's', 's'),
(2, 'd', 'ddd'),
(3, 's', 's'),
(4, 's', 'sjj'),
(5, 'b', 'j');

-- --------------------------------------------------------

--
-- Structure de la table `Utilisateur`
--

CREATE TABLE `Utilisateur` (
  `idUtilisateur` int(11) NOT NULL,
  `Nom` varchar(45) DEFAULT NULL,
  `Prenom` varchar(45) DEFAULT NULL,
  `Mail` varchar(45) DEFAULT NULL,
  `Mdp` varchar(255) DEFAULT NULL,
  `Type` varchar(100) DEFAULT NULL,
  `Numero` varchar(20) DEFAULT NULL,
  `Date_inscription` date DEFAULT NULL,
  `isAdmin` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `Utilisateur`
--

INSERT INTO `Utilisateur` (`idUtilisateur`, `Nom`, `Prenom`, `Mail`, `Mdp`, `Type`, `Numero`, `Date_inscription`, `isAdmin`) VALUES
(52, 'Admin', 'Admin', 'admin@audioinsight.com', '$2y$10$syc./7B.7LRQXjgc2bLEDOHqDnJCDEppNn09nESF6pfpMble5ZV3O', NULL, NULL, NULL, 1),
(81, 'ee', 'ee', 'r@t.comaa', '$2y$10$oyS8QDwpSTrwA0OC/ZOktOSZQxlEnRdGCG8GoqydcGWK6WNgz4VOS', NULL, '0616892081', '2024-05-03', 0),
(84, 's', 'a', 'r@t.com', '$2y$10$of5Wk5hK80vD6WZcfBeMMezJa5nQzlpERcimkAfIpKq13vZvuvhIu', NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Structure de la table `Utilisateur_has_FAQ`
--

CREATE TABLE `Utilisateur_has_FAQ` (
  `idUtilisateur` int(11) NOT NULL,
  `idForum_sujet` int(11) NOT NULL,
  `idFAQ` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Artiste`
--
ALTER TABLE `Artiste`
  ADD PRIMARY KEY (`idArtiste`);

--
-- Index pour la table `Billet_achete`
--
ALTER TABLE `Billet_achete`
  ADD PRIMARY KEY (`idBillet`),
  ADD KEY `idx_Billet_achete_idPlace` (`idPlace`);

--
-- Index pour la table `Commentaire`
--
ALTER TABLE `Commentaire`
  ADD PRIMARY KEY (`idCommentaire`);

--
-- Index pour la table `Concert`
--
ALTER TABLE `Concert`
  ADD PRIMARY KEY (`idConcert`);

--
-- Index pour la table `Concert_has_Artiste`
--
ALTER TABLE `Concert_has_Artiste`
  ADD PRIMARY KEY (`idConcert`),
  ADD KEY `idx_Concert_has_Artiste_idArtiste` (`idArtiste`);

--
-- Index pour la table `Donnees`
--
ALTER TABLE `Donnees`
  ADD PRIMARY KEY (`idDonnees`),
  ADD KEY `idCapteurSonore` (`idCapteurSonore`);

--
-- Index pour la table `FAQ`
--
ALTER TABLE `FAQ`
  ADD PRIMARY KEY (`idFAQ`);

--
-- Index pour la table `Utilisateur`
--
ALTER TABLE `Utilisateur`
  ADD PRIMARY KEY (`idUtilisateur`);

--
-- Index pour la table `Utilisateur_has_FAQ`
--
ALTER TABLE `Utilisateur_has_FAQ`
  ADD PRIMARY KEY (`idUtilisateur`),
  ADD KEY `idx_Utilisateur_has_FAQ_idForum_sujet` (`idForum_sujet`),
  ADD KEY `idx_Utilisateur_has_FAQ_idFAQ` (`idFAQ`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `Billet_achete`
--
ALTER TABLE `Billet_achete`
  MODIFY `idBillet` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT pour la table `Concert`
--
ALTER TABLE `Concert`
  MODIFY `idConcert` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT pour la table `Donnees`
--
ALTER TABLE `Donnees`
  MODIFY `idDonnees` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT pour la table `FAQ`
--
ALTER TABLE `FAQ`
  MODIFY `idFAQ` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `Utilisateur`
--
ALTER TABLE `Utilisateur`
  MODIFY `idUtilisateur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `Concert_has_Artiste`
--
ALTER TABLE `Concert_has_Artiste`
  ADD CONSTRAINT `fk_Concert_has_Artiste_Artiste` FOREIGN KEY (`idArtiste`) REFERENCES `Artiste` (`idArtiste`),
  ADD CONSTRAINT `fk_Concert_has_Artiste_Concert` FOREIGN KEY (`idConcert`) REFERENCES `Concert` (`idConcert`);

--
-- Contraintes pour la table `Utilisateur_has_FAQ`
--
ALTER TABLE `Utilisateur_has_FAQ`
  ADD CONSTRAINT `fk_Utilisateur_has_FAQ_FAQ` FOREIGN KEY (`idFAQ`) REFERENCES `FAQ` (`idFAQ`),
  ADD CONSTRAINT `fk_Utilisateur_has_FAQ_Utilisateur` FOREIGN KEY (`idUtilisateur`) REFERENCES `Utilisateur` (`idUtilisateur`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
