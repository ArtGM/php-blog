-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  sam. 30 mai 2020 à 10:58
-- Version du serveur :  5.7.26
-- Version de PHP :  7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT = @@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS = @@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION = @@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `phpblog`
--

--
-- Structure de la table `post`
--

DROP TABLE IF EXISTS `post`;
CREATE TABLE IF NOT EXISTS `post`
(
    `id`            int(11) NOT NULL AUTO_INCREMENT,
    `title`         varchar(45) DEFAULT NULL,
    `content`       longtext,
    `status`        tinyint(1)  DEFAULT NULL,
    `created_at`    datetime    DEFAULT NULL,
    `updated_at`    datetime    DEFAULT NULL,
    `post_type`     varchar(45) DEFAULT NULL,
    `user_id`       int(11) NOT NULL,
    `user_roles_id` int(11) NOT NULL,
    PRIMARY KEY (`id`, `user_id`, `user_roles_id`),
    KEY `fk_post_users1_idx` (`user_id`, `user_roles_id`)
) ENGINE = InnoDB
  AUTO_INCREMENT = 15
  DEFAULT CHARSET = utf8;

--
-- Déchargement des données de la table `post`
--

INSERT INTO `post` (`id`, `title`, `content`, `status`, `created_at`, `updated_at`, `post_type`, `user_id`,
                    `user_roles_id`)
VALUES (1, 'Bonjour tout le monde !', 'Ceci est un nouveau post créé à l\'installation', 1, '',
        '', '1', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `post_comment`
--

DROP TABLE IF EXISTS `post_comment`;
CREATE TABLE IF NOT EXISTS `post_comment`
(
    `id`                int(11)    NOT NULL AUTO_INCREMENT,
    `content`           varchar(45)         DEFAULT NULL,
    `create_time`       datetime            DEFAULT NULL,
    `comment_status_id` tinyint(4) NOT NULL DEFAULT '0',
    `user_id`           int(11)    NOT NULL,
    `post_id`           int(11)    NOT NULL,
    PRIMARY KEY (`id`, `comment_status_id`, `user_id`, `post_id`),
    KEY `fk_post_comment_comment_status1_idx` (`comment_status_id`),
    KEY `fk_post_comment_user1_idx` (`user_id`),
    KEY `fk_post_comment_post1_idx` (`post_id`)
) ENGINE = InnoDB
  AUTO_INCREMENT = 24
  DEFAULT CHARSET = utf8;

--
-- Déchargement des données de la table `post_comment`
--

INSERT INTO `post_comment` (`id`, `content`, `create_time`, `comment_status_id`, `user_id`, `post_id`)
VALUES (1, 'Ceci est un commentaire', '', 1, 1, 1);


-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user`
(
    `id`       int(11) NOT NULL AUTO_INCREMENT,
    `username` varchar(45)  DEFAULT NULL,
    `email`    varchar(45)  DEFAULT NULL,
    `password` varchar(255) DEFAULT NULL,
    `roles_id` int(11) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB
  AUTO_INCREMENT = 15
  DEFAULT CHARSET = utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password`, `roles_id`)
VALUES (1, 'Admin', 'admin@email.com', '$2y$10$/HpSuWQztTUUB.HL7zccferIZHAmKpzGNEGCG.o/LNqpD/uh6X/MO', 1);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `post_comment`
--
ALTER TABLE `post_comment`
    ADD CONSTRAINT `fk_post_comment_post1` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
    ADD CONSTRAINT `fk_post_comment_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;


/*!40101 SET CHARACTER_SET_CLIENT = @OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS = @OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION = @OLD_COLLATION_CONNECTION */;
