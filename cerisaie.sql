DROP DATABASE IF EXISTS cerisaie;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";
CREATE DATABASE cerisaie CHARACTER SET utf8 COLLATE utf8_general_ci;

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `cerisaie`
--

-- --------------------------------------------------------

--
-- Structure de la table `Client`
--

CREATE TABLE `Client` (
  `id_client` bigint(20) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `nom` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `Client`
--

INSERT INTO `Client` (`id_client`, `prenom`, `nom`) VALUES
(1, 'Al', 'Pacino'),
(2, 'Robert', 'De Niro'),
(3, 'Leonardo', 'Martineau'),
(4, 'Kevin', 'Dicaprio'),
(5, 'Clint', 'Mifune'),
(6, 'Morgan', 'Deep'),
(7, 'Johnny', 'Friman');

--
-- Index pour la table `Client`
--
ALTER TABLE `Client`
  ADD PRIMARY KEY (`id_client`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `Client`
--
ALTER TABLE `Client`
  MODIFY `id_client` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

--
-- Structure de la table `Activite`
--

CREATE TABLE `Activite` (
  `id_activite` bigint(20) NOT NULL,
  `libelle` varchar(50) NOT NULL,
  `unite` varchar(50) NOT NULL,
  `tarif` float(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `Activite`
--

INSERT INTO `Activite` (`id_activite`, `libelle`, `unite`,`tarif`) VALUES
(1, 'Tennis', 'Heure', 10),
(2, 'VTT', 'Demi-journée', 12),
(3, 'Pédalo', 'Journée', 16),
(4, 'Planche à voile', '2 heures', 7),
(5, 'Canoë', 'Demi-journée', 12);

--
-- Index pour la table `Activite`
--
ALTER TABLE `Activite`
  ADD PRIMARY KEY (`id_activite`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `Activite`
--
ALTER TABLE `Activite`
  MODIFY `id_activite` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Structure de la table `Type_emplacement`
--

CREATE TABLE `Type_emplacement` (
  `id_type_emplacement` bigint(20) NOT NULL,
  `libelle` varchar(50) NOT NULL,
  `prix` float(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `Activite`
--

INSERT INTO `Type_emplacement` (`id_type_emplacement`, `libelle`, `prix`) VALUES
(1, 'Caravane', 13.50),
(2, 'Tente', 11.00),
(3, 'Camping-car', 14.00),
(4, 'Bungalow', 17.50);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `Type_emplacement`
--
ALTER TABLE `Type_emplacement`
  ADD PRIMARY KEY (`id_type_emplacement`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `Type_emplacement`
--
ALTER TABLE `Type_emplacement`
  MODIFY `id_type_emplacement` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Structure de la table `Emplacement`
--

CREATE TABLE `Emplacement` (
  `id_emplacement` bigint(20) NOT NULL,
  `id_type_emplacement` bigint(20) NOT NULL,
  `surface` float(50) NOT NULL,
  `capacite` int(5) NOT NULL,
  CONSTRAINT fk_id_type_emplacement FOREIGN KEY (id_type_emplacement) REFERENCES Type_emplacement(id_type_emplacement)
  ON DELETE CASCADE
  ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `Activite`
--

INSERT INTO `Emplacement` (`id_emplacement`, `id_type_emplacement`, `surface`, `capacite`) VALUES
(1, 1, 10.50, 4),
(2, 4, 20, 6),
(3, 2, 14, 3),
(4, 3, 17.50, 5);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `Emplacement`
--
ALTER TABLE `Emplacement`
  ADD PRIMARY KEY (`id_emplacement`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `Emplacement`
--
ALTER TABLE `Emplacement`
  MODIFY `id_emplacement` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Structure de la table `Sejour`
--

CREATE TABLE `Sejour` (
  `id_sejour` bigint(20) NOT NULL,
  `id_client` bigint(20) NOT NULL,
  `id_emplacement` bigint(20) NOT NULL,
  `date_debut` DATE NOT NULL,
  `date_fin` DATE NOT NULL,
  CONSTRAINT fk_id_client FOREIGN KEY (id_client) REFERENCES Client(id_client),
  CONSTRAINT fk_id_emplacement FOREIGN KEY (id_emplacement) REFERENCES Emplacement(id_emplacement)
  ON DELETE CASCADE
  ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `Sejour`
--

INSERT INTO `Sejour` (`id_sejour`, `id_client`, `id_emplacement`, `date_debut`, `date_fin`) VALUES
(1, 1, 4, '2019-04-01','2019-04-10'),
(2, 5, 1, '2019-04-02','2019-04-06'),
(3, 4, 3, '2019-04-02','2019-04-15'),
(4, 2, 2, '2019-04-06','2019-04-14');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `Sejour`
--
ALTER TABLE `Sejour`
  ADD PRIMARY KEY (`id_sejour`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `Sejour`
--
ALTER TABLE `Sejour`
  MODIFY `id_sejour` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Structure de la table `Reservation`
--

CREATE TABLE `Reservation` (
  `id_reservation` bigint(20) NOT NULL,
  `id_activite` bigint(20) NOT NULL,
  `id_sejour` bigint(20) NOT NULL,
  `nb_unite` int(5) NOT NULL,
  `date_activite` DATE NOT NULL,
  CONSTRAINT fk_id_activite FOREIGN KEY (id_activite) REFERENCES Activite(id_activite),
  CONSTRAINT fk_id_sejour FOREIGN KEY (id_sejour) REFERENCES Sejour(id_sejour)
  ON DELETE CASCADE
  ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `Reservation`
--

INSERT INTO `Reservation` (`id_reservation`, `id_activite`, `id_sejour`, `nb_unite`, `date_activite`) VALUES
(1, 1, 4, 4,'2019-04-10'),
(2, 5, 1, 3,'2019-04-06'),
(3, 4, 3, 1,'2019-04-15'),
(4, 2, 2, 6,'2019-04-14');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `Reservation`
--
ALTER TABLE `Reservation`
  ADD PRIMARY KEY (`id_reservation`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `Reservation`
--
ALTER TABLE `Reservation`
  MODIFY `id_reservation` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Structure de la table `Facture`
--

CREATE TABLE `Facture` (
  `id_facture` bigint(20) NOT NULL,
  `id_sejour` bigint(20) NOT NULL,
  CONSTRAINT fk_id_sejour_facture FOREIGN KEY (id_sejour) REFERENCES Sejour(id_sejour)
  ON DELETE CASCADE
  ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `Reservation`
--

INSERT INTO `Facture` (`id_facture`, `id_sejour`) VALUES
(1, 1),
(2, 3),
(3, 4),
(4, 2);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `Reservation`
--
ALTER TABLE `Facture`
  ADD PRIMARY KEY (`id_facture`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `Facture`
--
ALTER TABLE `Facture`
  MODIFY `id_facture` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;