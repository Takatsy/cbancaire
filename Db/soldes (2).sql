-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 04 mars 2024 à 09:42
-- Version du serveur :  10.4.17-MariaDB
-- Version de PHP : 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `soldes`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `nom` varchar(32) NOT NULL,
  `email` varchar(32) NOT NULL,
  `pass` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`id`, `nom`, `email`, `pass`) VALUES
(1, 'zafisolo', 'zafisolo@gmail.com', '2804');

-- --------------------------------------------------------

--
-- Structure de la table `audit_compte`
--

CREATE TABLE `audit_compte` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `numcompte` varchar(32) NOT NULL,
  `nomclient` varchar(32) NOT NULL,
  `solde` varchar(32) NOT NULL,
  `soldenouveau` varchar(32) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `action` enum('ajout','modifier','supprimer','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `audit_compte`
--

INSERT INTO `audit_compte` (`id`, `id_user`, `numcompte`, `nomclient`, `solde`, `soldenouveau`, `date`, `action`) VALUES
(8, 5, '147657687688', 'Zafisolo ', '10000', '200000', '2024-02-29 17:58:58', 'modifier'),
(9, 5, '147657687688', 'Zafisolo ', '200000', '', '2024-02-29 18:09:07', 'supprimer'),
(10, 5, '147657687688', 'Mihary', '6000000', '', '2024-02-29 18:09:54', 'ajout'),
(11, 7, '4435676654', 'Pongilary Noass', '200000', '', '2024-02-29 18:28:10', 'ajout'),
(12, 7, '4435676654', 'Pongilary Noass', '200000', '500000', '2024-02-29 18:28:21', 'modifier'),
(13, 5, '147657687688', 'Mihary', '6000000', '', '2024-02-29 18:46:08', 'supprimer'),
(14, 7, '87957687', 'RAFENOARIVO Marius', '100000', '', '2024-02-29 18:47:53', 'ajout'),
(15, 5, '87957687', 'RAFENOARIVO Marius', '100000', '200000', '2024-02-29 18:48:27', 'modifier'),
(16, 9, '33767687', 'RAJAO Marie', '250000', '', '2024-02-29 19:52:24', 'ajout'),
(17, 7, '33767687', 'RAJAO Marie', '250000', '200000', '2024-02-29 19:53:03', 'modifier'),
(18, 5, '87957687', 'RAFENOARIVO Marius', '200000', '', '2024-03-04 07:36:42', 'supprimer'),
(19, 5, '78787989', 'Tantely', '100000', '', '2024-03-04 09:51:19', 'ajout'),
(20, 10, '12434', 'XX', '10000', '', '2024-03-04 10:14:58', 'ajout'),
(21, 10, '12434', 'XX', '10000', '20000', '2024-03-04 10:15:20', 'modifier'),
(22, 10, '12434', 'XX', '20000', '', '2024-03-04 10:15:24', 'supprimer');

-- --------------------------------------------------------

--
-- Structure de la table `compte`
--

CREATE TABLE `compte` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `numcompte` varchar(20) NOT NULL,
  `nomclient` varchar(20) NOT NULL,
  `solde` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `compte`
--

INSERT INTO `compte` (`id`, `id_user`, `numcompte`, `nomclient`, `solde`) VALUES
(33, 7, '33767687', 'RAJAO Marie', '200000'),
(31, 7, '4435676654', 'Pongilary Noass', '500000'),
(34, 5, '78787989', 'Tantely', '100000');

--
-- Déclencheurs `compte`
--
DELIMITER $$
CREATE TRIGGER `Ajout` BEFORE INSERT ON `compte` FOR EACH ROW INSERT INTO audit_compte (id_user,numcompte, nomclient, solde,action) VALUES (new.id_user,new.numcompte, new.nomclient, new.solde,'ajout')
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `modifier` BEFORE UPDATE ON `compte` FOR EACH ROW INSERT INTO audit_compte (id_user,numcompte, nomclient, solde,Soldenouveau,action) VALUES (new.id_user, new.numcompte, new.nomclient, old.solde,new.Solde,'modifier')
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `supprimer` BEFORE DELETE ON `compte` FOR EACH ROW INSERT INTO audit_compte (id_user,numcompte, nomclient,solde,action) VALUES (old.id_user, old.numcompte, old.nomclient, old.solde,'supprimer')
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id_user` int(11) NOT NULL,
  `nom` varchar(32) NOT NULL,
  `email` varchar(32) NOT NULL,
  `pass` varchar(32) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id_user`, `nom`, `email`, `pass`) VALUES
(4, 'zaho', 'zaho@gmail.com', '12345678'),
(5, 'Adore', 'adore@gmail.com', '2107'),
(7, 'Mihary', 'mihary@gmail.com', '1999'),
(8, 'Masy', 'masy@gmail.com', '2199'),
(9, 'Setra', 'setra@gmail.com', '12345678'),
(10, 'Marius', 'marius@gmail.com', '1234');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `audit_compte`
--
ALTER TABLE `audit_compte`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Index pour la table `compte`
--
ALTER TABLE `compte`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `audit_compte`
--
ALTER TABLE `audit_compte`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT pour la table `compte`
--
ALTER TABLE `compte`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
