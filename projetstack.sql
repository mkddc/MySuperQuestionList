{\rtf1\ansi\ansicpg1252\cocoartf1404\cocoasubrtf340
{\fonttbl\f0\fswiss\fcharset0 Helvetica;}
{\colortbl;\red255\green255\blue255;}
\paperw11900\paperh16840\margl1440\margr1440\vieww10800\viewh8400\viewkind0
\pard\tx566\tx1133\tx1700\tx2267\tx2834\tx3401\tx3968\tx4535\tx5102\tx5669\tx6236\tx6803\pardirnatural\partightenfactor0

\f0\fs24 \cf0 -- phpMyAdmin SQL Dump\
-- version 4.4.10\
-- http://www.phpmyadmin.net\
--\
-- Client :  localhost:8889\
-- G\'e9n\'e9r\'e9 le :  Sam 26 Mars 2016 \'e0 15:57\
-- Version du serveur :  5.5.42\
-- Version de PHP :  5.6.10\
\
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";\
SET time_zone = "+00:00";\
\
--\
-- Base de donn\'e9es :  `projetstack`\
--\
CREATE DATABASE IF NOT EXISTS `projetstack` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;\
USE `projetstack`;\
\
-- --------------------------------------------------------\
\
--\
-- Structure de la table `categories`\
--\
\
CREATE TABLE `categories` (\
  `id` int(11) NOT NULL,\
  `nom_categorie` varchar(50) NOT NULL\
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;\
\
--\
-- Contenu de la table `categories`\
--\
\
INSERT INTO `categories` (`id`, `nom_categorie`) VALUES\
(1, 'Developpement'),\
(2, 'Sport'),\
(4, 'Culture'),\
(5, 'Sciences'),\
(6, 'Sexo');\
\
-- --------------------------------------------------------\
\
--\
-- Structure de la table `questions`\
--\
\
CREATE TABLE `questions` (\
  `id` int(11) NOT NULL,\
  `utilisateur_id` int(11) NOT NULL,\
  `categorie_id` int(11) NOT NULL,\
  `titre` varchar(200) NOT NULL,\
  `corps` text NOT NULL,\
  `date_publication` date NOT NULL,\
  `vote` int(11) NOT NULL,\
  `nb_vues` int(11) NOT NULL\
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;\
\
--\
-- Contenu de la table `questions`\
--\
\
INSERT INTO `questions` (`id`, `utilisateur_id`, `categorie_id`, `titre`, `corps`, `date_publication`, `vote`, `nb_vues`) VALUES\
(2, 4, 1, 'Le SQL : pourquoi s''embeter ?', 'SQL (sigle de Structured Query Language, en fran''e7ais langage de requ''eate structur''e9e) est un langage informatique normalis''e9 servant ''e0 exploiter des bases de donn''e9es relationnelles. La partie langage de manipulation des donn''e9es de SQL permet de rechercher, d''ajouter, de modifier ou de supprimer des donn''e9es dans les bases de donn''e9es relationnelles.', '2016-03-18', 6, 64),\
(3, 3, 2, 'Ping pong ou Badminton ?', 'Quel est le sport le plus fatigant ''e0 pratiquer? ', '2016-03-16', 0, 7),\
(4, 2, 4, 'Quel est selon vous le meilleur artiste du dernier festival d''Angoul''eame ?', 'Le festival international de la bande dessin''e9e d''Angoul''eame, plus commun''e9ment appel''e9 festival d''Angoul''eame, est le principal festival de bande dessin''e9e francophone et le plus important d''Europe en termes de notori''e9t''e9 et de rayonnement culturel. Il a lieu tous les ans en janvier depuis 1974 et associe expositions, d''e9bats, rencontres et nombreuses s''e9ances de d''e9dicace, les principaux auteurs francophones ''e9tant pr''e9sents. Plusieurs prix y sont d''e9cern''e9s, dont le Grand Prix de la ville d''Angoul''eame, qui r''e9compense un auteur pour l''ensemble de son ''9cuvre, et le Fauve d''or, r''e9compensant un album paru l''ann''e9e pr''e9c''e9dente.', '2016-03-19', 3, 42),\
(5, 4, 4, 'Cin\'e9ma : horreur ou com\'e9die ?', 'Je ne sais pas quoi regarder pour mon samedi soir. Un conseil ?', '2016-03-15', 3, 88),\
(6, 4, 5, 'Quelle est la plus grande plan\'e8te du syst\'e8me solaire', 'Quelle est la plus grande plan\'e8te du syst\'e8me solaire', '2016-03-22', 0, 14),\
(7, 1, 5, 'Quel est l''animal le plus rapide du monde ?', 'Ca doit \'eatre un f\'e9lin mais je ne suis pas certain de savoir lequel ?', '2016-03-22', 2, 32),\
(8, 4, 4, 'Quel est le meilleur film sorti cette ann\'e9e au cin\'e9ma ?', 'Quel est celui qui vous a le plus plu ?', '2016-03-22', 1, 2);\
\
-- --------------------------------------------------------\
\
--\
-- Structure de la table `reponses`\
--\
\
CREATE TABLE `reponses` (\
  `id` int(11) NOT NULL,\
  `question_id` int(11) NOT NULL,\
  `utilisateur_id` int(11) NOT NULL,\
  `corps` text NOT NULL,\
  `date_publication` date NOT NULL,\
  `vote` int(11) NOT NULL,\
  `best` tinyint(1) NOT NULL DEFAULT '0'\
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;\
\
--\
-- Contenu de la table `reponses`\
--\
\
INSERT INTO `reponses` (`id`, `question_id`, `utilisateur_id`, `corps`, `date_publication`, `vote`, `best`) VALUES\
(1, 5, 1, 'Plut\'f4t horreur : Evil dead, l''exorciste ou Les griffes de la nuit', '2016-03-21', 4, 1),\
(2, 5, 2, 'Plut\'f4t com\'e9die : Y''a-t-il un flic pour sauver la reine. Ou pour sauver le pr\'e9sident', '2016-03-20', 0, 0),\
(3, 4, 4, 'Uderzo', '2016-03-21', 0, 0),\
(4, 4, 4, 'Mac farlane', '2016-03-21', 0, 0),\
(5, 4, 4, 'Mac farlane', '2016-03-21', 0, 0),\
(6, 4, 4, 'Moebius', '2016-03-21', 0, 0),\
(7, 2, 1, 'Pour etre bon d&eacute;veloppeur', '2016-03-21', -1, 0),\
(8, 3, 1, 'Ping Pong', '2016-03-21', 0, 0),\
(9, 3, 1, 'Ping Pong', '2016-03-21', 0, 0),\
(10, 3, 4, 'Plut&ocirc;t Badminton !', '2016-03-21', 0, 0),\
(11, 3, 4, 'J''h&eacute;site en fait...', '2016-03-21', 0, 0),\
(12, 3, 1, 'Non, plut&ocirc;t ping-pong en fait', '2016-03-22', 0, 0),\
(13, 7, 4, 'Je crois que c''est le gu&eacute;pard !', '2016-03-22', 1, 0),\
(14, 2, 4, 'Pour &ecirc;tre au top !', '2016-03-22', 2, 0),\
(15, 6, 1, 'Mars', '2016-03-22', 6, 0),\
(16, 6, 3, 'Jupiter', '2016-03-22', 4, 1),\
(17, 8, 1, 'The revenant', '2016-03-22', 0, 1),\
(18, 8, 3, 'Deadpool', '2016-03-22', 0, 0);\
\
-- --------------------------------------------------------\
\
--\
-- Structure de la table `utilisateurs`\
--\
\
CREATE TABLE `utilisateurs` (\
  `id` int(11) NOT NULL,\
  `login` varchar(20) NOT NULL,\
  `mdp` varchar(20) NOT NULL,\
  `email` varchar(50) NOT NULL\
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;\
\
--\
-- Contenu de la table `utilisateurs`\
--\
\
INSERT INTO `utilisateurs` (`id`, `login`, `mdp`, `email`) VALUES\
(1, 'chawips', '123456', 'chawips@gmail.com'),\
(2, 'gyojishukke', '123456', 'thierry@mezenge.fr'),\
(3, 'yvan', '123456', 'yvan.lebrigand@gmail.com'),\
(4, 'malik', '123456', 'malik.kaddache@gmail.com'),\
(5, 'mk2', 'mk2@gmail.com', '123456');\
\
--\
-- Index pour les tables export\'e9es\
--\
\
--\
-- Index pour la table `categories`\
--\
ALTER TABLE `categories`\
  ADD PRIMARY KEY (`id`);\
\
--\
-- Index pour la table `questions`\
--\
ALTER TABLE `questions`\
  ADD PRIMARY KEY (`id`),\
  ADD KEY `utilisateur_id` (`utilisateur_id`),\
  ADD KEY `categorie_id` (`categorie_id`);\
\
--\
-- Index pour la table `reponses`\
--\
ALTER TABLE `reponses`\
  ADD PRIMARY KEY (`id`),\
  ADD KEY `question_id` (`question_id`),\
  ADD KEY `utilisateur_id` (`utilisateur_id`);\
\
--\
-- Index pour la table `utilisateurs`\
--\
ALTER TABLE `utilisateurs`\
  ADD PRIMARY KEY (`id`);\
\
--\
-- AUTO_INCREMENT pour les tables export\'e9es\
--\
\
--\
-- AUTO_INCREMENT pour la table `categories`\
--\
ALTER TABLE `categories`\
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;\
--\
-- AUTO_INCREMENT pour la table `questions`\
--\
ALTER TABLE `questions`\
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;\
--\
-- AUTO_INCREMENT pour la table `reponses`\
--\
ALTER TABLE `reponses`\
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;\
--\
-- AUTO_INCREMENT pour la table `utilisateurs`\
--\
ALTER TABLE `utilisateurs`\
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;\
--\
-- Contraintes pour les tables export\'e9es\
--\
\
--\
-- Contraintes pour la table `questions`\
--\
ALTER TABLE `questions`\
  ADD CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateurs` (`id`),\
  ADD CONSTRAINT `questions_ibfk_2` FOREIGN KEY (`categorie_id`) REFERENCES `categories` (`id`);\
\
--\
-- Contraintes pour la table `reponses`\
--\
ALTER TABLE `reponses`\
  ADD CONSTRAINT `reponses_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`),\
  ADD CONSTRAINT `reponses_ibfk_2` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateurs` (`id`);\
}