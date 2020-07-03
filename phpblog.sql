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

-- --------------------------------------------------------

--
-- Structure de la table `image`
--

DROP TABLE IF EXISTS `image`;
CREATE TABLE IF NOT EXISTS `image`
(
    `id`   int(11) NOT NULL AUTO_INCREMENT,
    `name` varchar(45) DEFAULT NULL,
    `alt`  varchar(45) DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB
  AUTO_INCREMENT = 5
  DEFAULT CHARSET = utf8;

--
-- Déchargement des données de la table `image`
--

INSERT INTO `image` (`id`, `name`, `alt`)
VALUES (1, 'avatar_1', 'avater_1'),
       (2, 'avatar_2', 'avatar_2'),
       (3, 'avatar_1', 'avater_1'),
       (4, 'avatar_2', 'avatar_2');

-- --------------------------------------------------------

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
VALUES (4, 'Nouveau post', 'Ceci est un nouveau post créé depuis l\'administration', 1, '2020-05-07 20:50:14',
        '2020-05-07 20:50:14', '1', 3, 1),
       (5, 'Test ajax', 'Modification', 1, '2020-05-08 10:53:06', '2020-05-09 21:39:46', '1', 3, 1),
       (6, 'Test 2', 'Test du nouveau slug', 1, '2020-05-08 11:40:05', '2020-05-10 14:54:27', '1', 3, 1),
       (9, 'Test article', 'Test rechargement', 0, '2020-05-08 21:40:24', '2020-05-10 16:18:30', '1', 3, 1),
       (11, 'Nouveau Post (encore)', 'Lorem ipsum', 1, '2020-05-10 16:19:24', '2020-05-23 11:11:05', '1', 3, 1),
       (13, 'Creation',
        '    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
        1, '2020-05-23 10:44:20', '2020-05-23 10:44:20', '1', 3, 1),
       (14, 'Hello world',
        '    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
        1, '2020-05-23 10:56:16', '2020-05-23 11:01:07', '1', 3, 1);

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
VALUES (18, 'Ceci est un commentaire', '2020-05-15 13:34:02', 1, 3, 5),
       (19, 'Hello les gens', '2020-05-15 15:17:47', 1, 3, 4),
       (21, 'Ceci est un commentaire', '2020-05-29 09:46:32', 1, 3, 4),
       (22, 'Test', '2020-05-29 09:53:32', 1, 3, 4),
       (23, 'Hello', '2020-05-29 10:18:00', 1, 3, 5);

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles`
(
    `id`   int(11) NOT NULL AUTO_INCREMENT,
    `role` varchar(45) DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB
  AUTO_INCREMENT = 3
  DEFAULT CHARSET = utf8;

--
-- Déchargement des données de la table `roles`
--

INSERT INTO `roles` (`id`, `role`)
VALUES (1, 'Administrateur'),
       (2, 'Utilisateur');

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
    PRIMARY KEY (`id`, `roles_id`),
    KEY `fk_users_roles1_idx` (`roles_id`)
) ENGINE = InnoDB
  AUTO_INCREMENT = 15
  DEFAULT CHARSET = utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password`, `roles_id`)
VALUES (3, 'Arthur', 'dev@arthurmorisson.fr', '123456789', 1),
       (4, 'Tony', 'tony.glandil@yopmail.com', '123456789', 2),
       (6, 'arthur.morisson@pm.me', 'ArtMG', '123456789', 2),
       (7, 'ArtMG', 'arthur.morisson@pm.me', '$2y$10$UlGGH8Oauqji5Tuhl05FXOrNLD/nS5lEjpIGiBShnPqWJCrF/B7H2', 2),
       (8, 'ArtMG', 'arthur.morisson@pm.me', '$2y$10$EPq7RrRWHotlbm29h9PevOaJirhFdZGTP25BFvkfZP0QtUdmxhcFO', 2),
       (9, 'Nouvel utilistaeur', 'test@email.com', '$2y$10$VvRHA4uwnh8ovtkMdVDwIef7uH5pK0gwMgC820Pg.e8Zx36qjY6VK', 2),
       (10, 'Test', 'test@email.com', '$2y$10$VLCVCJQ3n9sCZmb4BYTNGuJayou.ztk1r4ifByNGs.7WYMvF0sWj.', 2),
       (11, 'Test', 'test@email.com', '$2y$10$/zcTmSZ0lsUZ8YL.3UZ2CuPB8WhApb7przNjef13lLmTrhzPb7JOK', 2),
       (12, 'test', 'test@email.com', '$2y$10$KdwFWnKUmT8ofMtTpfVs/uSEITfJTQ2HQUTifbdasOzk/SZ4P4ge2', 2),
       (13, 'Globix', 'd@m.fr', '$2y$10$/OhQbW2oZ7GQNtGEph9.UOfn8VqKP16BsU9zTxkn2Q13y50t.eKL6', 2),
       (14, 'Youpi', 'user@email.com', '$2y$10$L41X8Yw8BOKRcpRjAfisxu9wZmeO2P0b./GZxVMcTgfHxxudqpvQW', 2);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `post`
--
ALTER TABLE `post`
    ADD CONSTRAINT `fk_post_users1` FOREIGN KEY (`user_id`, `user_roles_id`) REFERENCES `user` (`id`, `roles_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `post_comment`
--
ALTER TABLE `post_comment`
    ADD CONSTRAINT `fk_post_comment_post1` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
    ADD CONSTRAINT `fk_post_comment_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
    ADD CONSTRAINT `fk_users_roles1` FOREIGN KEY (`roles_id`) REFERENCES `roles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT = @OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS = @OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION = @OLD_COLLATION_CONNECTION */;
