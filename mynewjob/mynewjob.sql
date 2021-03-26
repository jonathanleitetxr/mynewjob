-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3307
-- Généré le : ven. 26 mars 2021 à 15:40
-- Version du serveur :  10.4.13-MariaDB
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `mynewjob`
--

-- --------------------------------------------------------

--
-- Structure de la table `annonce`
--

DROP TABLE IF EXISTS `annonce`;
CREATE TABLE IF NOT EXISTS `annonce` (
  `idAnnonce` int(11) NOT NULL AUTO_INCREMENT,
  `nomAnnonce` varchar(50) COLLATE latin1_bin NOT NULL,
  `heures` varchar(50) COLLATE latin1_bin NOT NULL,
  `pre_requis` varchar(50) COLLATE latin1_bin NOT NULL,
  `horaires` varchar(50) COLLATE latin1_bin NOT NULL,
  `description` varchar(50) COLLATE latin1_bin NOT NULL,
  `contrat` varchar(50) COLLATE latin1_bin NOT NULL,
  `dureeContrat` varchar(50) COLLATE latin1_bin NOT NULL,
  `demarrage` varchar(50) COLLATE latin1_bin NOT NULL,
  `siren` int(11) NOT NULL,
  `idMetier` int(11) NOT NULL,
  `idVille` int(11) NOT NULL,
  PRIMARY KEY (`idAnnonce`),
  KEY `Annonce_Entreprise_FK` (`siren`),
  KEY `Annonce_metier0_FK` (`idMetier`),
  KEY `Annonce_ville1_FK` (`idVille`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Déchargement des données de la table `annonce`
--

INSERT INTO `annonce` (`idAnnonce`, `nomAnnonce`, `heures`, `pre_requis`, `horaires`, `description`, `contrat`, `dureeContrat`, `demarrage`, `siren`, `idMetier`, `idVille`) VALUES
(1, 'peintre', '35h/semaine', '3 ans expérience', '8h-16h', 'Cherche peintre pour ...', 'Intérim', '5 mois', 'Dès que possible', 123456789, 1, 1),
(2, 'Maçon', '35h/semaine', '1 an expérience', '8h-16h', 'Cherche un maçon pour ..', 'Intérim', '1 mois', '1 Septembre', 123456789, 2, 2),
(3, 'Médecin', '35h/semaine', 'Aucun', '8h-16h', 'Cherche un médecin pour ..', 'Intérim', '1 mois', '1 Septembre', 123456789, 3, 3),
(4, 'Docteur', '35h/semaine', '5 ans expérience', '8h-16h', 'Cherche un docteur pour ..', 'Intérim', '5 mois', '1 Septembre', 123456789, 4, 4),
(5, 'Serveur', '35h/semaine', '2 ans expérience', '8h-16h', 'Cherche un serveur pour ..', 'Intérim', '1 mois', '1 Septembre', 123456789, 5, 1),
(6, 'Jardiniste', '35h/semaine', '40 ans expérience', '8h-16h', 'Cherche un jardiniste pour ..', 'Intérim', '2 mois', '1 Septembre', 123456789, 6, 2);

-- --------------------------------------------------------

--
-- Structure de la table `civilite`
--

DROP TABLE IF EXISTS `civilite`;
CREATE TABLE IF NOT EXISTS `civilite` (
  `idCivilite` int(11) NOT NULL AUTO_INCREMENT,
  `nomCivilite` varchar(10) COLLATE latin1_bin NOT NULL,
  PRIMARY KEY (`idCivilite`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Déchargement des données de la table `civilite`
--

INSERT INTO `civilite` (`idCivilite`, `nomCivilite`) VALUES
(1, 'Madame'),
(2, 'Monsieur');

-- --------------------------------------------------------

--
-- Structure de la table `deplacementtravail`
--

DROP TABLE IF EXISTS `deplacementtravail`;
CREATE TABLE IF NOT EXISTS `deplacementtravail` (
  `idDeplacementTravail` int(11) NOT NULL AUTO_INCREMENT,
  `nomDeplacementTravail` varchar(20) COLLATE latin1_bin NOT NULL,
  PRIMARY KEY (`idDeplacementTravail`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Déchargement des données de la table `deplacementtravail`
--

INSERT INTO `deplacementtravail` (`idDeplacementTravail`, `nomDeplacementTravail`) VALUES
(1, 'Grand déplacement'),
(2, 'Découcher');

-- --------------------------------------------------------

--
-- Structure de la table `document`
--

DROP TABLE IF EXISTS `document`;
CREATE TABLE IF NOT EXISTS `document` (
  `idFichier` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE latin1_bin NOT NULL,
  `file_url` varchar(255) COLLATE latin1_bin NOT NULL,
  `idInterimaire` int(11) NOT NULL,
  PRIMARY KEY (`idFichier`),
  KEY `document_client_FK` (`idInterimaire`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Déchargement des données de la table `document`
--

INSERT INTO `document` (`idFichier`, `name`, `file_url`, `idInterimaire`) VALUES
(23, 'loupe.png', 'C:/Users/Logic Interim 5/Desktop/files/3_Leite_Jonathan/loupe.png', 3);

-- --------------------------------------------------------

--
-- Structure de la table `entreprise`
--

DROP TABLE IF EXISTS `entreprise`;
CREATE TABLE IF NOT EXISTS `entreprise` (
  `siren` int(11) NOT NULL,
  `nomEnt` varchar(50) COLLATE latin1_bin NOT NULL,
  `ape` varchar(50) COLLATE latin1_bin NOT NULL,
  `adresseEnt` varchar(50) COLLATE latin1_bin NOT NULL,
  `telephoneEnt` int(11) NOT NULL,
  `emailEnt` varchar(50) COLLATE latin1_bin NOT NULL,
  `mdpEnt` varchar(50) COLLATE latin1_bin NOT NULL,
  PRIMARY KEY (`siren`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Déchargement des données de la table `entreprise`
--

INSERT INTO `entreprise` (`siren`, `nomEnt`, `ape`, `adresseEnt`, `telephoneEnt`, `emailEnt`, `mdpEnt`) VALUES
(123456789, 'Entreprise', '1234a', '38 rue du chap', 784785896, 'entreprise@entreprise.fr', 'c44590662a7bafe2b8aa4eda46585fda64fe8e15');

-- --------------------------------------------------------

--
-- Structure de la table `interimaire`
--

DROP TABLE IF EXISTS `interimaire`;
CREATE TABLE IF NOT EXISTS `interimaire` (
  `idInterimaire` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) COLLATE latin1_bin NOT NULL,
  `prenom` varchar(50) COLLATE latin1_bin NOT NULL,
  `telephone` int(11) NOT NULL,
  `email` varchar(50) COLLATE latin1_bin NOT NULL,
  `mdp` varchar(50) COLLATE latin1_bin NOT NULL,
  `adresse` varchar(50) COLLATE latin1_bin DEFAULT NULL,
  `dateDeNaissance` date DEFAULT NULL,
  `maxKm` int(10) DEFAULT NULL,
  `idCivilite` int(11) DEFAULT NULL,
  `idVille` int(10) DEFAULT NULL,
  `idTransport` int(10) DEFAULT NULL,
  `idPermis` int(10) DEFAULT NULL,
  `idTempsTravail` int(10) DEFAULT NULL,
  `idMomentTravail` int(11) DEFAULT NULL,
  `idDeplacementTravail` int(11) DEFAULT NULL,
  PRIMARY KEY (`idInterimaire`),
  KEY `idCivilite` (`idCivilite`),
  KEY `idVille` (`idVille`),
  KEY `idTransport` (`idTransport`),
  KEY `idPermis` (`idPermis`),
  KEY `idTempsTravail` (`idTempsTravail`),
  KEY `idMomentTravail` (`idMomentTravail`),
  KEY `idDeplacementTravail` (`idDeplacementTravail`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Déchargement des données de la table `interimaire`
--

INSERT INTO `interimaire` (`idInterimaire`, `nom`, `prenom`, `telephone`, `email`, `mdp`, `adresse`, `dateDeNaissance`, `maxKm`, `idCivilite`, `idVille`, `idTransport`, `idPermis`, `idTempsTravail`, `idMomentTravail`, `idDeplacementTravail`) VALUES
(3, 'Leite', 'Jonathan', 781777837, 'jo@jo.fr', 'c44590662a7bafe2b8aa4eda46585fda64fe8e15', '38 bis rue henri pavard', '2000-01-10', 20, 2, 2, 1, 1, 1, 1, 1),
(4, 'toto', 'toto', 781456985, 'to@to.fr', 'c44590662a7bafe2b8aa4eda46585fda64fe8e15', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `metier`
--

DROP TABLE IF EXISTS `metier`;
CREATE TABLE IF NOT EXISTS `metier` (
  `idMetier` int(11) NOT NULL AUTO_INCREMENT,
  `nomMetier` varchar(50) COLLATE latin1_bin NOT NULL,
  `description` varchar(255) COLLATE latin1_bin NOT NULL,
  `imgMetier` varchar(255) COLLATE latin1_bin NOT NULL,
  `logoMetier` varchar(255) COLLATE latin1_bin NOT NULL,
  PRIMARY KEY (`idMetier`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Déchargement des données de la table `metier`
--

INSERT INTO `metier` (`idMetier`, `nomMetier`, `description`, `imgMetier`, `logoMetier`) VALUES
(1, 'Peintre', 'Peinture batiment ...', 'painter-2751666_1920.jpg', 'symbole-de-contour-de-briques-a-l\'interieur-d\'un-cercle1.png'),
(2, 'Maçon', 'Maçon est ....', 'construction-5770317_1920', 'symbole-de-contour-de-briques-a-l\'interieur-d\'un-cercle1'),
(3, 'Médecin', 'Médecin est ...', 'health-2382316_1920', 'medecins-stethoscope1'),
(4, 'Docteur', 'Docteur est ...', 'doctor-563429_1920', 'medecins-stethoscope1'),
(5, 'Serveur', 'Serveur est ...', 'drink-2639456_1920', 'restaurant1'),
(6, 'Jardiniste', 'Jardiniste est ...', 'box-hedge-topiary-869073_1920', 'arbre1');

-- --------------------------------------------------------

--
-- Structure de la table `momenttravail`
--

DROP TABLE IF EXISTS `momenttravail`;
CREATE TABLE IF NOT EXISTS `momenttravail` (
  `idMomentTravail` int(11) NOT NULL AUTO_INCREMENT,
  `nomMomentTravail` varchar(20) COLLATE latin1_bin NOT NULL,
  PRIMARY KEY (`idMomentTravail`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Déchargement des données de la table `momenttravail`
--

INSERT INTO `momenttravail` (`idMomentTravail`, `nomMomentTravail`) VALUES
(1, 'Journée'),
(2, 'Nuit'),
(3, 'Week-end(VSD)');

-- --------------------------------------------------------

--
-- Structure de la table `permis`
--

DROP TABLE IF EXISTS `permis`;
CREATE TABLE IF NOT EXISTS `permis` (
  `idPermis` int(10) NOT NULL AUTO_INCREMENT,
  `etatPermis` varchar(10) COLLATE latin1_bin NOT NULL,
  PRIMARY KEY (`idPermis`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Déchargement des données de la table `permis`
--

INSERT INTO `permis` (`idPermis`, `etatPermis`) VALUES
(1, 'oui'),
(2, 'non');

-- --------------------------------------------------------

--
-- Structure de la table `tempstravail`
--

DROP TABLE IF EXISTS `tempstravail`;
CREATE TABLE IF NOT EXISTS `tempstravail` (
  `idTempsTravail` int(10) NOT NULL AUTO_INCREMENT,
  `nomTempsTravail` varchar(20) COLLATE latin1_bin NOT NULL,
  PRIMARY KEY (`idTempsTravail`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Déchargement des données de la table `tempstravail`
--

INSERT INTO `tempstravail` (`idTempsTravail`, `nomTempsTravail`) VALUES
(1, 'Temps complet'),
(2, 'Temps partiel');

-- --------------------------------------------------------

--
-- Structure de la table `transport`
--

DROP TABLE IF EXISTS `transport`;
CREATE TABLE IF NOT EXISTS `transport` (
  `idTransport` int(10) NOT NULL AUTO_INCREMENT,
  `nomTransport` varchar(10) COLLATE latin1_bin NOT NULL,
  PRIMARY KEY (`idTransport`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Déchargement des données de la table `transport`
--

INSERT INTO `transport` (`idTransport`, `nomTransport`) VALUES
(1, 'Voiture'),
(2, 'Moto'),
(3, 'Vélo'),
(4, 'Autre');

-- --------------------------------------------------------

--
-- Structure de la table `travailler`
--

DROP TABLE IF EXISTS `travailler`;
CREATE TABLE IF NOT EXISTS `travailler` (
  `idInterimaire` int(11) NOT NULL,
  `idMetier` int(11) NOT NULL,
  PRIMARY KEY (`idInterimaire`,`idMetier`),
  KEY `posseder_metier0_FK` (`idMetier`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Déchargement des données de la table `travailler`
--

INSERT INTO `travailler` (`idInterimaire`, `idMetier`) VALUES
(3, 1),
(3, 2);

-- --------------------------------------------------------

--
-- Structure de la table `ville`
--

DROP TABLE IF EXISTS `ville`;
CREATE TABLE IF NOT EXISTS `ville` (
  `idVille` int(11) NOT NULL AUTO_INCREMENT,
  `codePostal` int(11) NOT NULL,
  `nomVille` varchar(50) COLLATE latin1_bin NOT NULL,
  `idZone` int(11) NOT NULL,
  PRIMARY KEY (`idVille`),
  KEY `ville_zone_FK` (`idZone`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Déchargement des données de la table `ville`
--

INSERT INTO `ville` (`idVille`, `codePostal`, `nomVille`, `idZone`) VALUES
(1, 45000, 'Orléans', 1),
(2, 45140, 'Saint Jean De La Ruelle', 1),
(3, 45200, 'Montargis', 2),
(4, 45200, 'Amilly', 2);

-- --------------------------------------------------------

--
-- Structure de la table `zone`
--

DROP TABLE IF EXISTS `zone`;
CREATE TABLE IF NOT EXISTS `zone` (
  `idZone` int(11) NOT NULL AUTO_INCREMENT,
  `nomZone` varchar(50) COLLATE latin1_bin NOT NULL,
  PRIMARY KEY (`idZone`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Déchargement des données de la table `zone`
--

INSERT INTO `zone` (`idZone`, `nomZone`) VALUES
(1, 'Orléans'),
(2, 'Montargis');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `annonce`
--
ALTER TABLE `annonce`
  ADD CONSTRAINT `Annonce_Entreprise_FK` FOREIGN KEY (`siren`) REFERENCES `entreprise` (`siren`),
  ADD CONSTRAINT `Annonce_metier0_FK` FOREIGN KEY (`idMetier`) REFERENCES `metier` (`idMetier`),
  ADD CONSTRAINT `Annonce_ville1_FK` FOREIGN KEY (`idVille`) REFERENCES `ville` (`idVille`);

--
-- Contraintes pour la table `document`
--
ALTER TABLE `document`
  ADD CONSTRAINT `document_client_FK` FOREIGN KEY (`idInterimaire`) REFERENCES `interimaire` (`idInterimaire`);

--
-- Contraintes pour la table `interimaire`
--
ALTER TABLE `interimaire`
  ADD CONSTRAINT `mynewjob_civilite_FK` FOREIGN KEY (`idCivilite`) REFERENCES `civilite` (`idCivilite`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mynewjob_deplacementtravail_FK` FOREIGN KEY (`idDeplacementTravail`) REFERENCES `deplacementtravail` (`idDeplacementTravail`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mynewjob_momenttravail_FK` FOREIGN KEY (`idMomentTravail`) REFERENCES `momenttravail` (`idMomentTravail`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mynewjob_permis_FK` FOREIGN KEY (`idPermis`) REFERENCES `permis` (`idPermis`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mynewjob_tempstravail_FK` FOREIGN KEY (`idTempsTravail`) REFERENCES `tempstravail` (`idTempsTravail`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mynewjob_transport_FK` FOREIGN KEY (`idTransport`) REFERENCES `transport` (`idTransport`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mynewjob_ville_FK` FOREIGN KEY (`idVille`) REFERENCES `ville` (`idVille`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `travailler`
--
ALTER TABLE `travailler`
  ADD CONSTRAINT `posseder_interimaire_FK` FOREIGN KEY (`idInterimaire`) REFERENCES `interimaire` (`idInterimaire`),
  ADD CONSTRAINT `posseder_metier0_FK` FOREIGN KEY (`idMetier`) REFERENCES `metier` (`idMetier`);

--
-- Contraintes pour la table `ville`
--
ALTER TABLE `ville`
  ADD CONSTRAINT `ville_zone_FK` FOREIGN KEY (`idZone`) REFERENCES `zone` (`idZone`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
