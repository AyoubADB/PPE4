-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : dim. 24 mars 2024 à 16:51
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
-- Base de données : `ppe4`
--
CREATE DATABASE IF NOT EXISTS `ppe4` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `ppe4`;

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

DROP TABLE IF EXISTS `commande`;
CREATE TABLE `commande` (
  `id_com` int(11) NOT NULL,
  `id_u` int(11) DEFAULT NULL,
  `date_com` datetime DEFAULT current_timestamp(),
  `statut_com` enum('en_attente','validee','invalidee') DEFAULT 'en_attente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `detail_commande`
--

DROP TABLE IF EXISTS `detail_commande`;
CREATE TABLE `detail_commande` (
  `id_com` int(11) NOT NULL,
  `id_sto` int(11) NOT NULL,
  `quantite_det_com` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `mouvement`
--

DROP TABLE IF EXISTS `mouvement`;
CREATE TABLE `mouvement` (
  `id_mouv` int(11) NOT NULL,
  `id_com` int(11) DEFAULT NULL,
  `id_sto` int(11) DEFAULT NULL,
  `type_mouv` enum('entree','sortie') DEFAULT NULL,
  `quantite_mouv` int(255) DEFAULT NULL,
  `date_mouv` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE `role` (
  `id_r` int(30) NOT NULL,
  `role_r` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `role`
--

INSERT INTO `role` (`id_r`, `role_r`) VALUES
(1, 'user'),
(2, 'admin');

-- --------------------------------------------------------

--
-- Structure de la table `stock`
--

DROP TABLE IF EXISTS `stock`;
CREATE TABLE `stock` (
  `id_sto` int(11) NOT NULL,
  `nom_sto` varchar(255) DEFAULT NULL,
  `description_sto` varchar(255) DEFAULT NULL,
  `quantite_sto` int(255) DEFAULT NULL,
  `type_sto` enum('medicament','materiel') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `stock`
--

INSERT INTO `stock` (`id_sto`, `nom_sto`, `description_sto`, `quantite_sto`, `type_sto`) VALUES
(1, 'Aspirine', 'anti-douleur', 122, 'medicament'),
(2, 'Paracétamol', 'anti-douleur', 56, 'medicament'),
(3, 'Ibuproféne', 'anti-inflammatoire', 76, 'medicament'),
(4, 'seringues', 'sang', 347, 'materiel'),
(5, 'Stéthoscope.', 'sonore', 34, 'materiel'),
(6, 'Otoscope', 'oreille', 21, 'materiel'),
(7, 'Salbutamol ', 'ventoline', 45, 'medicament'),
(8, 'Doliprane', 'anti-douleur', 455, 'medicament'),
(9, 'Abaisse langue', 'bouche', 1210, 'materiel'),
(10, 'Efferalgan', 'Calme la douleur', 331, 'medicament');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE `utilisateur` (
  `id_u` int(11) NOT NULL,
  `nom_u` varchar(255) DEFAULT NULL,
  `prenom_u` varchar(255) DEFAULT NULL,
  `email_u` varchar(255) DEFAULT NULL,
  `password_u` varchar(255) DEFAULT NULL,
  `id_r` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id_u`, `nom_u`, `prenom_u`, `email_u`, `password_u`, `id_r`) VALUES
(1, 'Roche', 'Léa', 'lea.rouche@gmail.com', 'learoro', 1),
(2, 'Dubois', 'Marc', 'marc.dubois@gmail.com', 'dubmarc', 1),
(6, 'Janne', 'Marie', 'janne.marie@gmail.com', 'janmar', 1),
(7, 'Furry', 'Nick', 'nick.furry@gmail.com', 'nickfur', 1),
(9, 'test', 'test', '0@0', '0', 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`id_com`),
  ADD KEY `id_u` (`id_u`);

--
-- Index pour la table `detail_commande`
--
ALTER TABLE `detail_commande`
  ADD PRIMARY KEY (`id_com`,`id_sto`),
  ADD KEY `id_sto` (`id_sto`);

--
-- Index pour la table `mouvement`
--
ALTER TABLE `mouvement`
  ADD PRIMARY KEY (`id_mouv`),
  ADD KEY `id_com` (`id_com`),
  ADD KEY `id_sto` (`id_sto`);

--
-- Index pour la table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id_r`);

--
-- Index pour la table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`id_sto`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id_u`),
  ADD KEY `id_r` (`id_r`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
  MODIFY `id_com` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `mouvement`
--
ALTER TABLE `mouvement`
  MODIFY `id_mouv` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `role`
--
ALTER TABLE `role`
  MODIFY `id_r` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `stock`
--
ALTER TABLE `stock`
  MODIFY `id_sto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id_u` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `commande_ibfk_1` FOREIGN KEY (`id_u`) REFERENCES `utilisateur` (`id_u`);

--
-- Contraintes pour la table `detail_commande`
--
ALTER TABLE `detail_commande`
  ADD CONSTRAINT `detail_commande_ibfk_1` FOREIGN KEY (`id_com`) REFERENCES `commande` (`id_com`),
  ADD CONSTRAINT `detail_commande_ibfk_2` FOREIGN KEY (`id_sto`) REFERENCES `stock` (`id_sto`);

--
-- Contraintes pour la table `mouvement`
--
ALTER TABLE `mouvement`
  ADD CONSTRAINT `mouvement_ibfk_1` FOREIGN KEY (`id_com`) REFERENCES `commande` (`id_com`),
  ADD CONSTRAINT `mouvement_ibfk_2` FOREIGN KEY (`id_sto`) REFERENCES `stock` (`id_sto`);

--
-- Contraintes pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD CONSTRAINT `utilisateur_ibfk_1` FOREIGN KEY (`id_r`) REFERENCES `role` (`id_r`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
