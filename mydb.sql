-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 03 juin 2024 à 14:24
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

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
-- Structure de la table `artiste`
--

CREATE TABLE `artiste` (
  `idArtiste` int(11) NOT NULL,
  `Nom_de_scène` varchar(45) DEFAULT NULL,
  `nom_artiste` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `artiste`
--

INSERT INTO `artiste` (`idArtiste`, `Nom_de_scène`, `nom_artiste`) VALUES
(1, 'JSP', 'Poppy'),
(2, 'X', 'Ehtan'),
(3, 'L', 'GOD');

-- --------------------------------------------------------

--
-- Structure de la table `billet_achete`
--

CREATE TABLE `billet_achete` (
  `idBillet` int(11) NOT NULL,
  `idUtilisateur` int(11) NOT NULL,
  `idConcert` int(11) NOT NULL,
  `Date_achat_billet` date NOT NULL,
  `place` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `billet_achete`
--

INSERT INTO `billet_achete` (`idBillet`, `idUtilisateur`, `idConcert`, `Date_achat_billet`, `place`) VALUES
(1, 88, 1, '2024-05-22', 'A3'),
(2, 87, 1, '2024-05-12', 'A5'),
(3, 88, 1, '2024-05-02', 'B2'),
(4, 88, 2, '2024-05-23', 'A3'),
(5, 88, 3, '2024-04-18', 'C4'),
(6, 88, 1, '2024-05-31', 'E2'),
(8, 88, 1, '2024-05-31', 'C5'),
(9, 88, 1, '2024-05-31', 'D4'),
(10, 88, 1, '2024-05-31', 'F6');

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

CREATE TABLE `commentaire` (
  `idCommentaire` int(11) NOT NULL DEFAULT 1,
  `Date_commentaire` date DEFAULT NULL,
  `Like_commentaire` int(11) DEFAULT NULL,
  `Contenu_commentaire` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `commentaire`
--

INSERT INTO `commentaire` (`idCommentaire`, `Date_commentaire`, `Like_commentaire`, `Contenu_commentaire`) VALUES
(1, '2024-04-22', 0, 'Default Comment');

-- --------------------------------------------------------

--
-- Structure de la table `concert`
--

CREATE TABLE `concert` (
  `idConcert` int(11) NOT NULL,
  `Titre` varchar(45) DEFAULT NULL,
  `Date_concert` date DEFAULT NULL,
  `Debut_heure` varchar(10) DEFAULT NULL,
  `Duree` varchar(10) DEFAULT NULL,
  `Fin_heure` varchar(10) DEFAULT NULL,
  `Description` varchar(255) DEFAULT NULL,
  `Categorie` varchar(45) DEFAULT NULL,
  `Etat` varchar(45) DEFAULT NULL,
  `Likes` int(11) DEFAULT NULL,
  `ImagePath` varchar(255) DEFAULT NULL,
  `Prix` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `concert`
--

INSERT INTO `concert` (`idConcert`, `Titre`, `Date_concert`, `Debut_heure`, `Duree`, `Fin_heure`, `Description`, `Categorie`, `Etat`, `Likes`, `ImagePath`, `Prix`) VALUES
(1, 'concert1', '2024-05-29', '11:30', '2', '13:30', 'un exemple de concert pour le test', 'Test', 'A venir', 1, 'concert1.jpg', 0.00),
(2, 'Concert2', '2024-05-29', '15:30', '1:30', '17:00', 'Test', 'Test', 'En cours', 1, 'concert4.jpg', NULL),
(3, 'Concert3', '2024-05-01', '12:00', '1', '13:00', '33333333333333', 'Test', 'Terminé', 5, 'concert5.jpg', 50.00);

-- --------------------------------------------------------

--
-- Structure de la table `concert_has_artiste`
--

CREATE TABLE `concert_has_artiste` (
  `idConcert` int(11) NOT NULL,
  `idArtiste` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `concert_has_artiste`
--

INSERT INTO `concert_has_artiste` (`idConcert`, `idArtiste`) VALUES
(1, 1),
(2, 2),
(3, 3);

-- --------------------------------------------------------

--
-- Structure de la table `donnees`
--

CREATE TABLE `donnees` (
  `idDonnees` int(11) NOT NULL,
  `date` date NOT NULL,
  `niveauSonore` int(11) NOT NULL,
  `idCapteurSonore` int(11) NOT NULL,
  `Heure` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `donnees`
--

INSERT INTO `donnees` (`idDonnees`, `date`, `niveauSonore`, `idCapteurSonore`, `Heure`) VALUES
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
-- Structure de la table `faq`
--

CREATE TABLE `faq` (
  `idFAQ` int(11) NOT NULL,
  `Titre` varchar(45) DEFAULT NULL,
  `Contenu` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `faq`
--

INSERT INTO `faq` (`idFAQ`, `Titre`, `Contenu`) VALUES
(1, 's', 's'),
(2, 'd', 'ddd'),
(3, 's', 's'),
(4, 's', 'sjj'),
(5, 'b', 'j');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
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
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`idUtilisateur`, `Nom`, `Prenom`, `Mail`, `Mdp`, `Type`, `Numero`, `Date_inscription`, `isAdmin`) VALUES
(52, 'Admin', 'Admin', 'admin@audioinsight.com', '$2y$10$syc./7B.7LRQXjgc2bLEDOHqDnJCDEppNn09nESF6pfpMble5ZV3O', NULL, NULL, NULL, 1),
(85, 'e', 'e', 'e@eee', '$2y$10$0nhZiOltnSNlJeWx6epUzOwmnf54r.PXLsOeOmFwQ52FzcLmGAj9K', NULL, NULL, NULL, 0),
(87, 's', 's', 's@s', '$2y$10$Z3fo8FcFHei7AyAiTOhwPu71RTJjCXjBL7a3PjN0vmhF.Y3tjBQ1W', NULL, '0646892081', NULL, 0),
(88, 'User', 'User', 'pawa61880@eleve.isep.fr', '$2y$10$EH5K3SYfFQ0rrjFk3ECOC.ZnDuzhpDiF/1N27o/tWKHMzRHJ5J8V.', NULL, '0766161616', '2024-05-23', 1),
(89, 'XXX', 'XXX', 'eos.1012798373@gmail.com', '$2y$10$.3yZvPJm7RIlGOQhRP/NV./cwBMVfvVCIt5jQIrleXyb6wAehdNp2', NULL, '0766666666', '2024-05-23', 0);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur_has_faq`
--

CREATE TABLE `utilisateur_has_faq` (
  `idUtilisateur` int(11) NOT NULL,
  `idForum_sujet` int(11) NOT NULL,
  `idFAQ` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `artiste`
--
ALTER TABLE `artiste`
  ADD PRIMARY KEY (`idArtiste`);

--
-- Index pour la table `billet_achete`
--
ALTER TABLE `billet_achete`
  ADD PRIMARY KEY (`idBillet`);

--
-- Index pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD PRIMARY KEY (`idCommentaire`);

--
-- Index pour la table `concert`
--
ALTER TABLE `concert`
  ADD PRIMARY KEY (`idConcert`);

--
-- Index pour la table `concert_has_artiste`
--
ALTER TABLE `concert_has_artiste`
  ADD PRIMARY KEY (`idConcert`),
  ADD KEY `idArtiste` (`idArtiste`);

--
-- Index pour la table `donnees`
--
ALTER TABLE `donnees`
  ADD PRIMARY KEY (`idDonnees`),
  ADD KEY `idCapteurSonore` (`idCapteurSonore`);

--
-- Index pour la table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`idFAQ`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`idUtilisateur`);

--
-- Index pour la table `utilisateur_has_faq`
--
ALTER TABLE `utilisateur_has_faq`
  ADD PRIMARY KEY (`idUtilisateur`),
  ADD KEY `idx_Utilisateur_has_FAQ_idForum_sujet` (`idForum_sujet`),
  ADD KEY `idx_Utilisateur_has_FAQ_idFAQ` (`idFAQ`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `artiste`
--
ALTER TABLE `artiste`
  MODIFY `idArtiste` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `billet_achete`
--
ALTER TABLE `billet_achete`
  MODIFY `idBillet` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `concert`
--
ALTER TABLE `concert`
  MODIFY `idConcert` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `donnees`
--
ALTER TABLE `donnees`
  MODIFY `idDonnees` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT pour la table `faq`
--
ALTER TABLE `faq`
  MODIFY `idFAQ` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `idUtilisateur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `concert_has_artiste`
--
ALTER TABLE `concert_has_artiste`
  ADD CONSTRAINT `concert_has_artiste_ibfk_1` FOREIGN KEY (`idConcert`) REFERENCES `concert` (`idConcert`),
  ADD CONSTRAINT `concert_has_artiste_ibfk_2` FOREIGN KEY (`idArtiste`) REFERENCES `artiste` (`idArtiste`);

--
-- Contraintes pour la table `utilisateur_has_faq`
--
ALTER TABLE `utilisateur_has_faq`
  ADD CONSTRAINT `fk_Utilisateur_has_FAQ_FAQ` FOREIGN KEY (`idFAQ`) REFERENCES `faq` (`idFAQ`),
  ADD CONSTRAINT `fk_Utilisateur_has_FAQ_Utilisateur` FOREIGN KEY (`idUtilisateur`) REFERENCES `utilisateur` (`idUtilisateur`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
