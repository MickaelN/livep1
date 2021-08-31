-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 30 août 2021 à 08:44
-- Version du serveur :  10.4.10-MariaDB
-- Version de PHP : 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `livep1`
--

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `NAME` varchar(50) NOT NULL,
  `LEVEL` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `roles`
--

INSERT INTO `roles` (`ID`, `NAME`, `LEVEL`) VALUES
(1, 'Administrateur', 100),
(2, 'Moderateur', 80),
(3, 'Redacteur', 60),
(4, 'Lecteur', 10);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `MAIL` varchar(100) NOT NULL,
  `PASSWORD_HASH` varchar(255) NOT NULL,
  `PSEUDO` varchar(50) NOT NULL,
  `AVATAR` varchar(50) DEFAULT NULL,
  `HASH` varchar(50) DEFAULT NULL,
  `IS_ACTIVATED` tinyint(1) NOT NULL DEFAULT 0,
  `CREATED_AT` datetime NOT NULL DEFAULT current_timestamp(),
  `LAST_SESSION_AT` datetime NOT NULL DEFAULT current_timestamp(),
  `ID_ROLES` int(11) NOT NULL DEFAULT 4,
  PRIMARY KEY (`ID`),
  KEY `USERS_ROLES_FK` (`ID_ROLES`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `USERS_ROLES_FK` FOREIGN KEY (`ID_ROLES`) REFERENCES `roles` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


#------------------------------------------------------------
# Table: MailType
#------------------------------------------------------------

CREATE TABLE MAILTYPE(
        ID   Int  Auto_increment  NOT NULL ,
        NAME Varchar (255) NOT NULL
	,CONSTRAINT MAILTYPE_PK PRIMARY KEY (ID)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Mail
#------------------------------------------------------------

CREATE TABLE MAIL(
        ID          Int  Auto_increment  NOT NULL ,
        SUBJECT     Varchar (255) NOT NULL ,
        CONTENT     Longtext NOT NULL ,
        ID_MAILTYPE Int NOT NULL
	,CONSTRAINT MAIL_PK PRIMARY KEY (ID)

	,CONSTRAINT MAIL_MAILTYPE_FK FOREIGN KEY (ID_MAILTYPE) REFERENCES MAILTYPE(ID)
)ENGINE=InnoDB;