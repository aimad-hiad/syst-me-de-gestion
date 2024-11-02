-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 05 avr. 2023 à 04:58
-- Version du serveur :  10.4.14-MariaDB
-- Version de PHP : 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `my_database`
--

-- --------------------------------------------------------

--
-- Structure de la table `charges`
--

CREATE TABLE `charges` (
  `id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `electricite` decimal(10,2) DEFAULT NULL,
  `eau` decimal(10,2) DEFAULT NULL,
  `loyer` decimal(10,2) DEFAULT NULL,
  `gasoil` decimal(10,2) DEFAULT NULL,
  `abonnements` decimal(10,2) DEFAULT NULL,
  `comptable` decimal(10,2) DEFAULT NULL,
  `marchandises` decimal(10,2) DEFAULT NULL,
  `URSSAF` decimal(10,2) DEFAULT NULL,
  `salaires` decimal(10,2) DEFAULT NULL,
  `autres` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `charges`
--

INSERT INTO `charges` (`id`, `date`, `electricite`, `eau`, `loyer`, `gasoil`, `abonnements`, `comptable`, `marchandises`, `URSSAF`, `salaires`, `autres`) VALUES
(1, '2023-04-01', '120.00', '0.00', '100.00', '100.00', '0.00', '500.00', '0.00', '0.00', '0.00', '0.00'),
(2, '2023-03-01', '100.00', '100.00', '100.00', '100.00', '100.00', '500.00', '100.00', '100.00', '0.00', '0.00'),
(3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, '2023-02-01', '100.00', '100.00', '100.00', '100.00', '0.00', '600.00', '0.00', '0.00', '0.00', '0.00');

-- --------------------------------------------------------

--
-- Structure de la table `degrenne_invoice`
--

CREATE TABLE `degrenne_invoice` (
  `invoice_id` int(11) NOT NULL,
  `invoice_date` date NOT NULL,
  `invoice_amount` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `degrenne_invoice`
--

INSERT INTO `degrenne_invoice` (`invoice_id`, `invoice_date`, `invoice_amount`) VALUES
(3, '2023-04-01', '2100.00'),
(5, '2023-03-01', '300.00');

-- --------------------------------------------------------

--
-- Structure de la table `recettes`
--

CREATE TABLE `recettes` (
  `id` int(11) NOT NULL,
  `declared_amount` float NOT NULL,
  `undeclared_amount` float NOT NULL,
  `undeclared_expenses` float NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `recettes`
--

INSERT INTO `recettes` (`id`, `declared_amount`, `undeclared_amount`, `undeclared_expenses`, `date`) VALUES
(1, 4000, 150, 235, '2023-04-04'),
(2, 0, 100, 0, '2023-04-07'),
(3, 4000, 1000, 1000, '2023-04-02'),
(4, 1000, 200, 100, '2023-03-05'),
(5, 2000, 200, 100, '2023-03-06'),
(6, 700, 200, 50, '2023-04-05'),
(7, 1000, 100, 100, '2023-03-31');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`username`, `password`, `fullname`, `id`) VALUES
('admin', 'qsdfwxcv', 'Abdellah el merghani', 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `charges`
--
ALTER TABLE `charges`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `degrenne_invoice`
--
ALTER TABLE `degrenne_invoice`
  ADD PRIMARY KEY (`invoice_id`);

--
-- Index pour la table `recettes`
--
ALTER TABLE `recettes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `charges`
--
ALTER TABLE `charges`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `degrenne_invoice`
--
ALTER TABLE `degrenne_invoice`
  MODIFY `invoice_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `recettes`
--
ALTER TABLE `recettes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
