-- phpMyAdmin SQL Dump
-- version 4.0.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 20, 2014 at 01:13 PM
-- Server version: 5.5.33
-- PHP Version: 5.5.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `gameception`
--

-- --------------------------------------------------------

--
-- Table structure for table `badges_profile`
--

CREATE TABLE `badges_profile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `badge_id` int(11) NOT NULL,
  `profile_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `badges_profile`
--

INSERT INTO `badges_profile` (`id`, `badge_id`, `profile_id`) VALUES
(1, 11, 1),
(8, 12, 1),
(9, 13, 1);

-- --------------------------------------------------------

--
-- Table structure for table `gamers_game`
--

CREATE TABLE `gamers_game` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gamer_id` int(11) NOT NULL,
  `game_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `games_listed`
--

CREATE TABLE `games_listed` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page` text NOT NULL,
  `game_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `games_listed`
--

INSERT INTO `games_listed` (`id`, `page`, `game_id`) VALUES
(1, 'bahis', 1),
(2, 'bahis', 2),
(3, 'bahis', 3),
(4, 'bahis', 4),
(5, 'main', 1),
(6, 'main', 2),
(7, 'main', 3),
(8, 'main', 4),
(9, 'bahis', 5);

-- --------------------------------------------------------

--
-- Table structure for table `kupon_matches`
--

CREATE TABLE `kupon_matches` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kupon_id` int(11) NOT NULL,
  `match_id` int(11) NOT NULL,
  `choice_gamer_id` int(11) NOT NULL,
  `profile_id` int(11) NOT NULL,
  `checked` int(11) NOT NULL COMMENT '0:unchecked 1:success 2:fail',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=199 ;

--
-- Dumping data for table `kupon_matches`
--

INSERT INTO `kupon_matches` (`id`, `kupon_id`, `match_id`, `choice_gamer_id`, `profile_id`, `checked`) VALUES
(2, 15, 7, 1, 1, 0),
(3, 15, 8, 2, 1, 1),
(4, 15, 13, 2, 1, 0),
(5, 16, 7, 2, 3, 0),
(6, 16, 8, 2, 3, 1),
(7, 16, 13, 2, 3, 0),
(8, 17, 7, 1, 3, 0),
(9, 17, 8, 1, 3, 2),
(10, 18, 7, 1, 3, 0),
(11, 18, 8, 1, 3, 2),
(12, 19, 13, 2, 3, 0),
(13, 20, 7, 2, 3, 0),
(14, 21, 7, 1, 1, 0),
(15, 21, 8, 1, 1, 2),
(16, 22, 7, 2, 1, 0),
(17, 22, 8, 2, 1, 1),
(18, 22, 13, 1, 1, 0),
(19, 23, 7, 2, 1, 0),
(20, 23, 8, 1, 1, 2),
(21, 24, 7, 1, 1, 0),
(22, 24, 8, 2, 1, 1),
(23, 25, 7, 2, 1, 0),
(24, 25, 8, 2, 1, 1),
(25, 26, 7, 2, 1, 0),
(26, 26, 8, 2, 1, 1),
(27, 27, 7, 2, 1, 0),
(28, 27, 8, 2, 1, 1),
(29, 28, 7, 1, 1, 0),
(30, 28, 8, 1, 1, 2),
(31, 29, 7, 2, 1, 0),
(32, 29, 8, 2, 1, 1),
(33, 30, 8, 2, 1, 1),
(34, 31, 7, 2, 1, 0),
(35, 32, 8, 2, 1, 1),
(36, 32, 13, 2, 1, 0),
(37, 33, 7, 2, 1, 0),
(38, 34, 13, 2, 1, 0),
(39, 35, 7, 1, 1, 0),
(40, 35, 13, 2, 1, 0),
(41, 35, 15, 1, 1, 1),
(42, 35, 16, 2, 1, 1),
(43, 35, 17, 1, 1, 2),
(44, 36, 15, 1, 1, 1),
(45, 36, 18, 1, 1, 0),
(46, 37, 15, 2, 1, 2),
(47, 37, 16, 1, 1, 2),
(48, 38, 7, 1, 1, 0),
(49, 38, 13, 2, 1, 0),
(50, 38, 18, 2, 1, 0),
(51, 39, 15, 1, 1, 1),
(52, 39, 16, 1, 1, 2),
(53, 40, 15, 1, 1, 1),
(54, 40, 16, 1, 1, 2),
(55, 41, 15, 1, 1, 1),
(56, 41, 16, 1, 1, 2),
(57, 42, 15, 1, 1, 1),
(58, 42, 16, 1, 1, 2),
(59, 43, 7, 1, 1, 0),
(60, 43, 8, 2, 1, 1),
(61, 43, 13, 2, 1, 0),
(62, 43, 15, 1, 1, 1),
(63, 43, 16, 1, 1, 2),
(64, 43, 17, 2, 1, 1),
(65, 43, 18, 1, 1, 0),
(66, 44, 7, 1, 1, 0),
(67, 44, 8, 2, 1, 1),
(68, 45, 13, 2, 1, 0),
(69, 45, 16, 2, 1, 1),
(70, 46, 7, 1, 1, 0),
(71, 46, 8, 1, 1, 2),
(72, 46, 15, 2, 1, 2),
(73, 46, 16, 2, 1, 1),
(74, 46, 17, 2, 1, 1),
(75, 47, 7, 1, 1, 0),
(76, 47, 8, 2, 1, 1),
(77, 47, 13, 2, 1, 0),
(78, 48, 15, 2, 1, 2),
(79, 48, 16, 1, 1, 2),
(80, 49, 15, 2, 1, 2),
(81, 49, 16, 2, 1, 1),
(82, 50, 7, 1, 1, 0),
(83, 50, 13, 2, 1, 0),
(84, 50, 15, 1, 1, 1),
(85, 50, 16, 2, 1, 1),
(86, 51, 15, 2, 1, 2),
(87, 51, 16, 1, 1, 2),
(88, 52, 15, 2, 1, 2),
(89, 53, 15, 2, 1, 2),
(90, 54, 15, 1, 1, 1),
(91, 54, 16, 2, 1, 1),
(92, 57, 15, 1, 1, 1),
(93, 58, 15, 1, 1, 1),
(94, 59, 16, 1, 1, 2),
(95, 60, 16, 1, 1, 2),
(96, 60, 13, 1, 1, 0),
(97, 61, 16, 1, 1, 2),
(98, 61, 15, 1, 1, 1),
(99, 61, 7, 1, 1, 0),
(100, 61, 17, 1, 1, 2),
(101, 63, 15, 1, 1, 1),
(102, 63, 16, 2, 1, 1),
(103, 63, 13, 1, 1, 0),
(104, 63, 8, 2, 1, 1),
(105, 63, 18, 1, 1, 0),
(106, 64, 15, 1, 1, 1),
(107, 64, 16, 2, 1, 1),
(108, 64, 8, 1, 1, 2),
(109, 64, 13, 2, 1, 0),
(110, 64, 18, 2, 1, 0),
(111, 65, 7, 1, 1, 0),
(112, 65, 8, 1, 1, 2),
(113, 65, 16, 2, 1, 1),
(114, 66, 15, 1, 1, 1),
(115, 66, 16, 2, 1, 1),
(116, 66, 8, 1, 1, 2),
(117, 66, 7, 2, 1, 0),
(118, 67, 15, 1, 1, 1),
(119, 67, 16, 2, 1, 1),
(120, 67, 7, 1, 1, 0),
(121, 67, 18, 1, 1, 0),
(122, 68, 15, 1, 1, 1),
(123, 68, 16, 2, 1, 1),
(124, 69, 16, 2, 1, 1),
(125, 70, 15, 2, 1, 2),
(126, 70, 16, 1, 1, 2),
(127, 70, 13, 1, 1, 0),
(128, 71, 16, 2, 1, 1),
(129, 71, 15, 1, 1, 1),
(130, 72, 15, 2, 1, 2),
(131, 72, 16, 1, 1, 2),
(132, 73, 15, 1, 1, 1),
(133, 73, 16, 2, 1, 1),
(134, 73, 7, 1, 1, 0),
(135, 73, 13, 2, 1, 0),
(136, 73, 8, 2, 1, 1),
(137, 74, 15, 2, 1, 2),
(138, 75, 15, 2, 1, 2),
(139, 76, 15, 2, 1, 2),
(140, 77, 15, 2, 1, 2),
(141, 78, 15, 2, 1, 2),
(142, 79, 15, 1, 1, 1),
(143, 80, 16, 1, 1, 2),
(144, 81, 15, 1, 1, 1),
(145, 82, 16, 1, 1, 2),
(146, 82, 15, 2, 1, 2),
(147, 83, 16, 2, 1, 1),
(148, 84, 15, 1, 1, 1),
(149, 84, 7, 2, 1, 0),
(150, 87, 15, 1, 1, 1),
(151, 87, 16, 2, 1, 1),
(152, 87, 7, 2, 1, 0),
(153, 87, 17, 1, 1, 2),
(154, 87, 13, 2, 1, 0),
(155, 87, 8, 1, 1, 2),
(156, 88, 15, 1, 1, 1),
(157, 88, 16, 2, 1, 1),
(158, 88, 7, 1, 1, 0),
(159, 88, 8, 2, 1, 1),
(160, 88, 13, 2, 1, 0),
(161, 88, 17, 1, 1, 2),
(162, 88, 18, 2, 1, 0),
(163, 89, 15, 2, 2, 2),
(164, 89, 16, 1, 2, 2),
(165, 89, 7, 1, 2, 0),
(166, 90, 15, 2, 2, 2),
(167, 104, 15, 2, 1, 2),
(168, 104, 16, 1, 1, 2),
(169, 105, 7, 1, 1, 0),
(170, 105, 16, 1, 1, 2),
(171, 106, 13, 2, 1, 0),
(172, 107, 15, 2, 1, 2),
(173, 107, 16, 1, 1, 2),
(174, 108, 15, 1, 1, 1),
(175, 109, 15, 2, 1, 2),
(176, 110, 15, 1, 1, 1),
(177, 111, 15, 2, 1, 2),
(178, 112, 15, 2, 1, 2),
(179, 113, 15, 1, 1, 1),
(180, 114, 15, 1, 1, 1),
(181, 115, 15, 1, 1, 1),
(182, 115, 16, 2, 1, 1),
(183, 115, 8, 2, 1, 1),
(184, 116, 15, 1, 1, 1),
(185, 116, 16, 2, 1, 1),
(186, 117, 16, 2, 1, 1),
(187, 117, 15, 1, 1, 1),
(188, 118, 16, 2, 1, 1),
(189, 119, 16, 1, 1, 2),
(190, 120, 15, 2, 1, 2),
(191, 121, 23, 2, 1, 2),
(192, 121, 22, 1, 1, 2),
(193, 122, 22, 2, 1, 1),
(194, 123, 22, 2, 1, 1),
(195, 124, 23, 1, 1, 1),
(196, 125, 25, 2, 1, 1),
(197, 126, 25, 2, 1, 1),
(198, 127, 27, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `kupon_questions`
--

CREATE TABLE `kupon_questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kupon_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `answer_id` int(11) NOT NULL,
  `profile_id` int(11) NOT NULL,
  `checked` int(11) NOT NULL COMMENT '0:unchecked 1:success 2:fail',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=64 ;

--
-- Dumping data for table `kupon_questions`
--

INSERT INTO `kupon_questions` (`id`, `kupon_id`, `question_id`, `answer_id`, `profile_id`, `checked`) VALUES
(1, 58, 1, 1, 1, 2),
(2, 58, 2, 5, 1, 2),
(3, 59, 1, 1, 1, 2),
(4, 60, 1, 2, 1, 1),
(5, 60, 2, 5, 1, 2),
(6, 61, 1, 1, 1, 2),
(7, 61, 4, 8, 1, 2),
(8, 61, 6, 13, 1, 0),
(9, 62, 1, 2, 1, 1),
(10, 62, 2, 5, 1, 2),
(11, 62, 4, 9, 1, 2),
(12, 62, 6, 12, 1, 0),
(13, 63, 2, 5, 1, 2),
(14, 63, 1, 1, 1, 2),
(15, 63, 4, 9, 1, 2),
(16, 63, 6, 14, 1, 0),
(17, 64, 2, 5, 1, 2),
(18, 64, 1, 2, 1, 1),
(19, 65, 6, 15, 1, 0),
(20, 65, 4, 8, 1, 2),
(21, 65, 2, 6, 1, 1),
(22, 65, 1, 2, 1, 1),
(23, 66, 6, 10, 1, 0),
(24, 66, 4, 8, 1, 2),
(25, 67, 1, 1, 1, 2),
(26, 67, 2, 6, 1, 1),
(27, 67, 4, 9, 1, 2),
(28, 67, 6, 12, 1, 0),
(29, 70, 1, 1, 1, 2),
(30, 70, 2, 6, 1, 1),
(31, 71, 1, 1, 1, 2),
(32, 72, 2, 5, 1, 2),
(33, 72, 1, 1, 1, 2),
(34, 73, 2, 4, 1, 2),
(35, 73, 1, 1, 1, 2),
(36, 73, 4, 8, 1, 2),
(37, 73, 6, 13, 1, 0),
(38, 85, 1, 1, 1, 2),
(39, 85, 2, 6, 1, 1),
(40, 86, 1, 1, 1, 2),
(41, 87, 2, 5, 1, 2),
(42, 87, 1, 1, 1, 2),
(43, 87, 6, 14, 1, 0),
(44, 87, 4, 8, 1, 2),
(45, 88, 2, 4, 1, 2),
(46, 88, 1, 2, 1, 1),
(47, 88, 4, 8, 1, 2),
(48, 88, 6, 13, 1, 0),
(49, 90, 1, 2, 2, 0),
(50, 90, 2, 6, 2, 1),
(51, 90, 4, 8, 2, 2),
(52, 90, 6, 15, 2, 0),
(53, 104, 2, 5, 1, 2),
(54, 104, 1, 2, 1, 1),
(55, 105, 2, 5, 1, 2),
(56, 107, 2, 5, 1, 2),
(57, 107, 1, 1, 1, 2),
(58, 115, 2, 6, 1, 1),
(59, 115, 4, 9, 1, 2),
(60, 115, 6, 12, 1, 0),
(61, 125, 12, 43, 1, 2),
(62, 126, 12, 42, 1, 1),
(63, 127, 13, 45, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `monthly_execution`
--

CREATE TABLE `monthly_execution` (
  `last` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `monthly_execution`
--

INSERT INTO `monthly_execution` (`last`) VALUES
(1394372891);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `profile_id` int(11) NOT NULL,
  `body` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `obj_badges`
--

CREATE TABLE `obj_badges` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `desc` text NOT NULL,
  `image` text NOT NULL,
  `xp` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `obj_badges`
--

INSERT INTO `obj_badges` (`id`, `name`, `desc`, `image`, `xp`) VALUES
(1, 'Üyelik Süresi Level 1', '1 Aylık Üye', 'uyelik1.png', 30),
(2, 'Üyelik Süresi Level 2', '3 Aylık Üye', 'uyelik2.png', 50),
(3, 'Üyelik Süresi Level 3', '6 Aylık Üye', 'uyelik3.png', 100),
(4, 'Üyelik Süresi Level 4', '1 Yıllık Üye', 'uyelik4.png', 120),
(5, 'Üyelik Süresi Level 5', '3 Yıllık Üye', 'uyelik5.png', 620),
(6, 'Sıralama Level 1', 'Sıralamada ilk 100''ye girdi', 'siralama1.png', 20),
(7, 'Sıralama Level 2', 'Sıralamada ilk 50''ye girdi', 'siralama2.png', 60),
(8, 'Sıralama Level 3', 'Sıralamada ilk 10''a girdi', 'siralama3.png', 100),
(9, 'Sıralama Level 4', 'Sıralamada ilk 3''e girdi', 'siralama4.png', 200),
(10, 'Sıralama Level 5', 'Sıralamada 1. oldu', 'siralama5.png', 300),
(11, 'Level Badge Level 1', 'Level 2''ye ulaştı', 'gglevel1.png', 30),
(12, 'Level Badge Level 2', 'Level 5''e ulaştı', 'gglevel2.png', 50),
(13, 'Level Badge Level 3', 'Level 10''a ulaştı', 'gglevel3.png', 150),
(14, 'Level Badge Level 4', 'Level 20''ye ulaştı', 'gglevel4.png', 300),
(15, 'Level Badge Level 5', 'Level 50''ye ulaştı', 'gglevel5.png', 500);

-- --------------------------------------------------------

--
-- Table structure for table `obj_gamers`
--

CREATE TABLE `obj_gamers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` tinyint(4) NOT NULL COMMENT '1:team 2:person',
  `name` text NOT NULL,
  `image` text NOT NULL,
  `active` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `obj_gamers`
--

INSERT INTO `obj_gamers` (`id`, `type`, `name`, `image`, `active`) VALUES
(1, 1, 'HWA', 'hwa.png', 1),
(2, 1, 'Fanatic', 'fanatic.png', 1),
(3, 2, 'Turushan ''Sleeep'' Aktay', 'turus.png', 1),
(4, 2, 'Pamir ''walkover'' Çevikoğulları', 'walkover.png', 1),
(5, 2, 'ĞışŞöüıı', 'asd.png', 1),
(6, 2, 'ĞışŞöüıı', 'asd.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `obj_games`
--

CREATE TABLE `obj_games` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `abbr` text NOT NULL,
  `active` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `obj_games`
--

INSERT INTO `obj_games` (`id`, `name`, `abbr`, `active`) VALUES
(1, 'League Of Legends', 'LoL', 1),
(2, 'World Of Warcraft', 'WoW', 1),
(3, 'Counter Strike', 'CS', 1),
(4, 'World Of Tanks', 'WoT', 1),
(5, 'Worms World Party', 'WWP', 1);

-- --------------------------------------------------------

--
-- Table structure for table `obj_kupon`
--

CREATE TABLE `obj_kupon` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `profile_id` int(11) NOT NULL,
  `spent` float NOT NULL,
  `checked` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0:unchecked 1:success 2:fail',
  `date` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=128 ;

--
-- Dumping data for table `obj_kupon`
--

INSERT INTO `obj_kupon` (`id`, `profile_id`, `spent`, `checked`, `date`) VALUES
(15, 1, 3, 0, 1393883189),
(16, 3, 7, 0, 1393883189),
(17, 3, 3000, 1, 1393883189),
(18, 3, 3000, 1, 1393883189),
(19, 3, 999, 0, 1393883189),
(20, 3, 44444, 1, 1393883189),
(21, 1, 4, 2, 1393883189),
(22, 1, 80, 0, 1393883189),
(23, 1, 3, 2, 1393883189),
(24, 1, 77, 1, 1393883189),
(25, 1, 9, 1, 1393883189),
(26, 1, 99, 1, 1393883189),
(27, 1, 5, 1, 1393883189),
(28, 1, 3, 2, 1393883189),
(29, 1, 3, 1, 1393883189),
(30, 1, 5, 1, 1393883189),
(31, 1, 2712, 1, 1393883189),
(32, 1, 5, 0, 1393883189),
(33, 1, 2000, 1, 1393883189),
(34, 1, 9, 0, 1393883189),
(35, 1, 4, 2, 1393883189),
(36, 1, 4, 1, 1393883189),
(37, 1, 444, 2, 1393883189),
(38, 1, 3, 0, 1393883189),
(39, 1, 4, 2, 1393883189),
(40, 1, 4, 2, 1393883189),
(41, 1, 55, 2, 1393883189),
(42, 1, 3, 2, 1393883189),
(43, 1, 9, 2, 1393883189),
(44, 1, 6, 1, 1393883189),
(45, 1, 5, 0, 1393883189),
(46, 1, 10, 2, 1393883189),
(47, 1, 5, 0, 1393883189),
(48, 1, 3, 2, 1393883189),
(49, 1, 1, 2, 1393883189),
(50, 1, 4, 0, 1393883189),
(51, 1, 6, 2, 1393883189),
(52, 1, 5, 2, 1393883189),
(53, 1, 1, 2, 1393883189),
(54, 1, 3, 1, 1393883189),
(57, 1, 5, 1, 1393883189),
(58, 1, 5, 2, 1393883189),
(59, 1, 3, 2, 1393883189),
(60, 1, 7, 2, 1393883189),
(61, 1, 5, 2, 1393883189),
(62, 1, 77, 2, 1393883189),
(63, 1, 5, 2, 1393883189),
(64, 1, 4, 2, 1393883189),
(65, 1, 99, 2, 1393883189),
(66, 1, 100, 2, 1393883189),
(67, 1, 123, 2, 1393883189),
(68, 1, 4, 1, 1393883189),
(69, 1, 1, 1, 1393883327),
(70, 1, 4, 2, 1393887550),
(71, 1, 3, 2, 1393887616),
(72, 1, 4, 2, 1393941941),
(73, 1, 3, 2, 1394006406),
(74, 1, 9999, 2, 1394006500),
(75, 1, 99999, 2, 1394006528),
(76, 1, 1, 2, 1394006582),
(77, 1, 2, 2, 1394006628),
(78, 1, 2, 2, 1394006654),
(79, 1, 20, 1, 1394006806),
(80, 1, 24132, 2, 1394007134),
(81, 1, 3424.53, 1, 1394007141),
(82, 1, 1.0001, 2, 1394007152),
(83, 1, 1.0001, 1, 1394007160),
(84, 1, 5, 1, 1394038490),
(85, 1, 2, 2, 1394039684),
(86, 1, 5, 2, 1394039814),
(87, 1, 30, 2, 1394064233),
(88, 1, 20999, 2, 1394065116),
(89, 2, 2, 2, 1394065369),
(90, 2, 1, 2, 1394065400),
(104, 1, 3, 2, 1394192145),
(105, 1, 99, 2, 1394219117),
(106, 1, 999, 0, 1394237471),
(107, 1, 20, 2, 1394364856),
(108, 1, 50, 1, 1394364878),
(109, 1, 4, 1, 1394364942),
(110, 1, 4, 1, 1394365000),
(111, 1, 3, 1, 1394365084),
(112, 1, 4, 1, 1394365100),
(113, 1, 2, 1, 1394365106),
(114, 1, 2, 1, 1394365113),
(115, 1, 20, 2, 1394402953),
(116, 1, 3, 1, 1394567237),
(117, 1, 20000, 1, 1394570546),
(118, 1, 30000, 1, 1394570563),
(119, 1, 444444, 1, 1394570590),
(120, 1, 3, 1, 1394611507),
(121, 1, 99, 2, 1394808366),
(122, 1, 5, 0, 1394824591),
(123, 1, 20, 0, 1394829477),
(124, 1, 99, 1, 1394829665),
(125, 1, 5, 2, 1395258802),
(126, 1, 9, 1, 1395258916),
(127, 1, 5, 1, 1395313052);

-- --------------------------------------------------------

--
-- Table structure for table `obj_matches`
--

CREATE TABLE `obj_matches` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gamer1_id` int(11) NOT NULL,
  `gamer2_id` int(11) NOT NULL,
  `gamer1_rate` float NOT NULL,
  `gamer2_rate` float NOT NULL,
  `game_id` int(11) NOT NULL,
  `stream` text NOT NULL,
  `date_t` int(11) NOT NULL COMMENT 'unix UTC',
  `end_t` int(11) NOT NULL COMMENT 'unix UTC',
  `desc` text NOT NULL,
  `xp` int(11) NOT NULL,
  `active` tinyint(4) NOT NULL COMMENT '0:notactive 1:active 2:ended',
  `winner_gamer_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `obj_matches`
--

INSERT INTO `obj_matches` (`id`, `gamer1_id`, `gamer2_id`, `gamer1_rate`, `gamer2_rate`, `game_id`, `stream`, `date_t`, `end_t`, `desc`, `xp`, `active`, `winner_gamer_id`) VALUES
(1, 1, 2, 1.4, 2.28, 1, '<object type="application/x-shockwave-flash" height="378" width="620" id="live_embed_player_flash" data="http://tr.twitch.tv/widgets/live_embed_player.swf?channel=smitegame" bgcolor="#000000"><param name="allowFullScreen" value="true" /><param name="allowScriptAccess" value="always" /><param name="allowNetworking" value="all" /><param name="movie" value="http://tr.twitch.tv/widgets/live_embed_player.swf" /><param name="flashvars" value="hostname=tr.twitch.tv&channel=smitegame&auto_play=true&start_volume=25" /></object><a href="http://www.twitch.tv/smitegame" style="padding:2px 0px 4px; display:block; width:345px; font-weight:normal; font-size:10px;text-decoration:underline; text-align:center;">Watch live video from Smitegame on tr.twitch.tv</a>', 1392829572, 1392829572, 'denemeee', 20, 1, 0),
(2, 2, 3, 3.01, 1.12, 2, '<object type="application/x-shockwave-flash" height="378" width="620" id="live_embed_player_flash" data="http://tr.twitch.tv/widgets/live_embed_player.swf?channel=smitegame" bgcolor="#000000"><param name="allowFullScreen" value="true" /><param name="allowScriptAccess" value="always" /><param name="allowNetworking" value="all" /><param name="movie" value="http://tr.twitch.tv/widgets/live_embed_player.swf" /><param name="flashvars" value="hostname=tr.twitch.tv&channel=smitegame&auto_play=true&start_volume=25" /></object><a href="http://www.twitch.tv/smitegame" style="padding:2px 0px 4px; display:block; width:345px; font-weight:normal; font-size:10px;text-decoration:underline; text-align:center;">Watch live video from Smitegame on tr.twitch.tv</a>', 1392829572, 1392829572, '', 30, 1, 0),
(3, 5, 3, 1.2, 1.3, 1, '', 1392829572, 1392829572, 'denemeee', 20, 1, 0),
(4, 1, 2, 4.2, 4.3, 3, '', 1321228800, 1321228800, '', 44, 1, 0),
(6, 1, 2, 4.2, 4.3, 1, '<object type="application/x-shockwave-flash" height="378" width="620" id="live_embed_player_flash" data="http://tr.twitch.tv/widgets/live_embed_player.swf?channel=smitegame" bgcolor="#000000"><param name="allowFullScreen" value="true" /><param name="allowScriptAccess" value="always" /><param name="allowNetworking" value="all" /><param name="movie" value="http://tr.twitch.tv/widgets/live_embed_player.swf" /><param name="flashvars" value="hostname=tr.twitch.tv&channel=smitegame&auto_play=true&start_volume=25" /></object><a href="http://www.twitch.tv/smitegame" style="padding:2px 0px 4px; display:block; width:345px; font-weight:normal; font-size:10px;text-decoration:underline; text-align:center;">Watch live video from Smitegame on tr.twitch.tv</a>', 1321228800, 1321228800, '', 44, 1, 0),
(9, 1, 2, 4.2, 4.3, 1, '<object type="application/x-shockwave-flash" height="378" width="620" id="live_embed_player_flash" data="http://tr.twitch.tv/widgets/live_embed_player.swf?channel=smitegame" bgcolor="#000000"><param name="allowFullScreen" value="true" /><param name="allowScriptAccess" value="always" /><param name="allowNetworking" value="all" /><param name="movie" value="http://tr.twitch.tv/widgets/live_embed_player.swf" /><param name="flashvars" value="hostname=tr.twitch.tv&channel=smitegame&auto_play=true&start_volume=25" /></object><a href="http://www.twitch.tv/smitegame" style="padding:2px 0px 4px; display:block; width:345px; font-weight:normal; font-size:10px;text-decoration:underline; text-align:center;">Watch live video from Smitegame on tr.twitch.tv</a>', 1393063565, 1393063565, '', 44, 1, 1),
(10, 1, 2, 4.2, 4.3, 1, '<object type="application/x-shockwave-flash" height="378" width="620" id="live_embed_player_flash" data="http://tr.twitch.tv/widgets/live_embed_player.swf?channel=smitegame" bgcolor="#000000"><param name="allowFullScreen" value="true" /><param name="allowScriptAccess" value="always" /><param name="allowNetworking" value="all" /><param name="movie" value="http://tr.twitch.tv/widgets/live_embed_player.swf" /><param name="flashvars" value="hostname=tr.twitch.tv&channel=smitegame&auto_play=true&start_volume=25" /></object><a href="http://www.twitch.tv/smitegame" style="padding:2px 0px 4px; display:block; width:345px; font-weight:normal; font-size:10px;text-decoration:underline; text-align:center;">Watch live video from Smitegame on tr.twitch.tv</a>', 1393149993, 1393149993, '', 44, 1, 1),
(11, 1, 2, 4.2, 4.3, 3, '<object type="application/x-shockwave-flash" height="378" width="620" id="live_embed_player_flash" data="http://tr.twitch.tv/widgets/live_embed_player.swf?channel=smitegame" bgcolor="#000000"><param name="allowFullScreen" value="true" /><param name="allowScriptAccess" value="always" /><param name="allowNetworking" value="all" /><param name="movie" value="http://tr.twitch.tv/widgets/live_embed_player.swf" /><param name="flashvars" value="hostname=tr.twitch.tv&channel=smitegame&auto_play=true&start_volume=25" /></object><a href="http://www.twitch.tv/smitegame" style="padding:2px 0px 4px; display:block; width:345px; font-weight:normal; font-size:10px;text-decoration:underline; text-align:center;">Watch live video from Smitegame on tr.twitch.tv</a>', 1393067203, 1393067203, '', 44, 1, 2),
(12, 1, 2, 4.2, 4.3, 1, '<object type="application/x-shockwave-flash" height="378" width="620" id="live_embed_player_flash" data="http://tr.twitch.tv/widgets/live_embed_player.swf?channel=smitegame" bgcolor="#000000"><param name="allowFullScreen" value="true" /><param name="allowScriptAccess" value="always" /><param name="allowNetworking" value="all" /><param name="movie" value="http://tr.twitch.tv/widgets/live_embed_player.swf" /><param name="flashvars" value="hostname=tr.twitch.tv&channel=smitegame&auto_play=true&start_volume=25" /></object><a href="http://www.twitch.tv/smitegame" style="padding:2px 0px 4px; display:block; width:345px; font-weight:normal; font-size:10px;text-decoration:underline; text-align:center;">Watch live video from Smitegame on tr.twitch.tv</a>', 1393074412, 1393074412, '', 44, 1, 0),
(13, 1, 2, 4.2, 4.3, 3, '<object type="application/x-shockwave-flash" height="378" width="620" id="live_embed_player_flash" data="http://tr.twitch.tv/widgets/live_embed_player.swf?channel=smitegame" bgcolor="#000000"><param name="allowFullScreen" value="true" /><param name="allowScriptAccess" value="always" /><param name="allowNetworking" value="all" /><param name="movie" value="http://tr.twitch.tv/widgets/live_embed_player.swf" /><param name="flashvars" value="hostname=tr.twitch.tv&channel=smitegame&auto_play=true&start_volume=25" /></object><a href="http://www.twitch.tv/smitegame" style="padding:2px 0px 4px; display:block; width:345px; font-weight:normal; font-size:10px;text-decoration:underline; text-align:center;">Watch live video from Smitegame on tr.twitch.tv</a>', 1394273222, 1394273222, '', 44, 1, 0),
(14, 1, 2, 4.2, 4.3, 1, '<object type="application/x-shockwave-flash" height="378" width="620" id="live_embed_player_flash" data="http://tr.twitch.tv/widgets/live_embed_player.swf?channel=smitegame" bgcolor="#000000"><param name="allowFullScreen" value="true" /><param name="allowScriptAccess" value="always" /><param name="allowNetworking" value="all" /><param name="movie" value="http://tr.twitch.tv/widgets/live_embed_player.swf" /><param name="flashvars" value="hostname=tr.twitch.tv&channel=smitegame&auto_play=true&start_volume=25" /></object><a href="http://www.twitch.tv/smitegame" style="padding:2px 0px 4px; display:block; width:345px; font-weight:normal; font-size:10px;text-decoration:underline; text-align:center;">Watch live video from Smitegame on tr.twitch.tv</a>', 1393150077, 1393150077, '', 44, 1, 0),
(19, 4, 5, 1.2, 1.03, 2, '<object type="application/x-shockwave-flash" height="378" width="620" id="live_embed_player_flash" data="http://tr.twitch.tv/widgets/live_embed_player.swf?channel=smitegame" bgcolor="#000000"><param name="allowFullScreen" value="true" /><param name="allowScriptAccess" value="always" /><param name="allowNetworking" value="all" /><param name="movie" value="http://tr.twitch.tv/widgets/live_embed_player.swf" /><param name="flashvars" value="hostname=tr.twitch.tv&channel=smitegame&auto_play=true&start_volume=25" /></object><a href="http://www.twitch.tv/smitegame" style="padding:2px 0px 4px; display:block; width:345px; font-weight:normal; font-size:10px;text-decoration:underline; text-align:center;">Watch live video from Smitegame on tr.twitch.tv</a>', 1392404400, 1392400800, '', 30, 1, 0),
(20, 2, 3, 1.1, 1.2, 1, 'asdasdas', 1394825400, 1394823600, '', 99, 1, 0),
(21, 0, 0, 0, 0, 0, '', 0, 0, '', 0, 1, 0),
(22, 2, 3, 1.1, 1.2, 1, '<iframe width="560" height="315" src="//www.youtube.com/embed/uWJOksHEdnA" frameborder="0" allowfullscreen></iframe>', 1394833500, 1394830800, '', 90, 1, 0),
(23, 5, 6, 1.7, 2.1, 1, 'lejgl sjhv sljdbvh sldjkvh ', 1395885600, 1395021600, '', 200, 1, 1),
(24, 4, 6, 1.1, 1.2, 1, 'asdasdasd', 1395109800, 1395108600, '', 90, 1, 0),
(25, 1, 2, 1.3, 1.4, 3, '', 1395261000, 1395259200, '', 300, 1, 2),
(26, 2, 5, 1.2, 1.3, 1, '<object type="application/x-shockwave-flash" height="378" width="620" id="live_embed_player_flash" data="http://tr.twitch.tv/widgets/live_embed_player.swf?channel=dotastarladder_en" bgcolor="#000000"><param name="allowFullScreen" value="true" /><param name="allowScriptAccess" value="always" /><param name="allowNetworking" value="all" /><param name="movie" value="http://tr.twitch.tv/widgets/live_embed_player.swf" /><param name="flashvars" value="hostname=tr.twitch.tv&channel=dotastarladder_en&auto_play=true&start_volume=25" /></object><a href="http://www.twitch.tv/dotastarladder_en" style="padding:2px 0px 4px; display:block; width:345px; font-weight:normal; font-size:10px;text-decoration:underline; text-align:center;">Watch live video from dotastarladder_en on tr.twitch.tv</a>', 0, 0, '', 0, 1, 0),
(27, 2, 5, 1.2, 1.3, 1, '<object type="application/x-shockwave-flash" height="378" width="620" id="live_embed_player_flash" data="http://tr.twitch.tv/widgets/live_embed_player.swf?channel=dotastarladder_en" bgcolor="#000000"><param name="allowFullScreen" value="true" /><param name="allowScriptAccess" value="always" /><param name="allowNetworking" value="all" /><param name="movie" value="http://tr.twitch.tv/widgets/live_embed_player.swf" /><param name="flashvars" value="hostname=tr.twitch.tv&channel=dotastarladder_en&auto_play=true&start_volume=25" /></object><a href="http://www.twitch.tv/dotastarladder_en" style="padding:2px 0px 4px; display:block; width:345px; font-weight:normal; font-size:10px;text-decoration:underline; text-align:center;">Watch live video from dotastarladder_en on tr.twitch.tv</a>', 1395347400, 1395345600, '', 30, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `obj_match_special_answers`
--

CREATE TABLE `obj_match_special_answers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question_id` int(11) NOT NULL,
  `answer` text NOT NULL,
  `rate` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=46 ;

--
-- Dumping data for table `obj_match_special_answers`
--

INSERT INTO `obj_match_special_answers` (`id`, `question_id`, `answer`, `rate`) VALUES
(1, 1, 'Turushan ''Sleeep'' Aktay', 3.2),
(2, 1, 'Pamir ''walkover'' Çevikoğulları', 3.2),
(4, 2, 'Turushan ''Sleeep'' Aktay', 3.8),
(5, 2, 'Pamir ''Walkover'' Çevikoğulları', 1.4),
(6, 2, 'Oğuz ''oguz'' Gelal', 2.2),
(7, 4, 'Turushan ''Sleeep'' Aktay', 5.4),
(8, 4, 'Oguz ''oguz'' Gelal', 3.2),
(9, 4, 'Pamir ''walkover'' Çevikoğulları', 1.4),
(10, 6, '0 - 30dk', 6.2),
(11, 6, '30dk - 1saat', 4.2),
(12, 6, '1saat - 2saat', 2.1),
(13, 6, '2saat - 3saat', 3.4),
(14, 6, '3saat - 4saat', 4.3),
(15, 6, '4saat - ...', 4.3),
(16, 7, 'naber hop 123', 3.1),
(17, 7, 'ilk deneme 2', 3.2),
(18, 7, 'hoppp', 1.2),
(19, 7, 'ddddd', 2.2),
(20, 7, 'change2', 1.1),
(21, 7, 'change3', 5.5),
(22, 7, 'change4', 3.3),
(23, 7, 'd5d5d5d5', 1.1),
(24, 7, 'dneme sonn', 0),
(25, 8, 'Answer 1', 1.1),
(26, 8, 'Answer 2', 1.2),
(27, 8, 'Answer 3', 3.1),
(28, 8, 'Deneme Answer', 1.4),
(29, 8, 'Deneme SONN', 0.3),
(30, 8, 'Deneme SONNNN', 0.1),
(31, 8, 'DENEME SON', 1.9),
(32, 8, 'SONNNNN', 1.1),
(33, 8, 'sadgasfgasdf', 3.1),
(34, 10, 'deneme answer 1', 1),
(35, 10, 'deneme answer 2', 2),
(38, 11, 'answer deneme', 1),
(40, 11, 'asdasd deneme', 2.1),
(41, 11, 'asgsdgsafdg', 1.1),
(42, 12, 'HWA', 1.1),
(43, 12, 'Fanatic', 1.2),
(44, 13, 'Turus', 1.1),
(45, 13, 'Oguz', 3.1);

-- --------------------------------------------------------

--
-- Table structure for table `obj_match_special_questions`
--

CREATE TABLE `obj_match_special_questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `match_id` int(11) NOT NULL,
  `question` text NOT NULL,
  `correct_answer_id` int(11) NOT NULL,
  `xp` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `obj_match_special_questions`
--

INSERT INTO `obj_match_special_questions` (`id`, `match_id`, `question`, `correct_answer_id`, `xp`) VALUES
(1, 23, 'En çok kill\\''i kim alır ???', 2, 20),
(2, 15, 'İlk kim ölür ?', 6, 25),
(4, 8, 'İlk kill''i kim alır ', 1, 13),
(6, 8, 'Maç ne kadar sürer ?', 0, 11),
(10, -1, '', 35, 0),
(11, 23, 'deneme special bet 2', 0, 30),
(12, 25, 'İlk hangi takım kill alır ?', 42, 30),
(13, 27, 'İlk kill\\\\\\''i kim alır', 45, 20);

-- --------------------------------------------------------

--
-- Table structure for table `obj_profile`
--

CREATE TABLE `obj_profile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `surname` text NOT NULL,
  `nick` text NOT NULL,
  `pass` text NOT NULL,
  `type` tinyint(4) NOT NULL COMMENT '1:user 2:admin',
  `image` text NOT NULL,
  `bio` text NOT NULL,
  `level` int(11) NOT NULL,
  `xp` double NOT NULL,
  `money` double NOT NULL,
  `total_money` double NOT NULL,
  `matches_won` int(11) NOT NULL,
  `matches_lost` int(11) NOT NULL,
  `questions_won` int(11) NOT NULL,
  `questions_lost` int(11) NOT NULL,
  `kupon_won` int(11) NOT NULL,
  `kupon_lost` int(11) NOT NULL,
  `regdate` int(11) NOT NULL,
  `active` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `obj_profile`
--

INSERT INTO `obj_profile` (`id`, `name`, `surname`, `nick`, `pass`, `type`, `image`, `bio`, `level`, `xp`, `money`, `total_money`, `matches_won`, `matches_lost`, `questions_won`, `questions_lost`, `kupon_won`, `kupon_lost`, `regdate`, `active`) VALUES
(1, 'Oğuz', 'Gelal', 'oguz', '7c4a8d09ca3762af61e59520943dc26494f8941b', 2, 'oguz.png', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.', 7, 1596, 9244103.67231, 0, 77, 54, 13, 36, 42, 55, 1392850908, 1),
(2, 'Turushan', 'Aktay', 'Sleeep', 'b904d4dda345c58a5ce90748f2d249a9fecf6402', 2, 'turus.png', 'sşkdgmnsş sgnsşdgknlşs bio asdasdas', 1, 0, 0, 0, 0, 3, 1, 1, 0, 2, 1392850908, 1),
(3, 'user', 'surname', 'user1', 'b3daa77b4c04a9551b8781d03191fe098f325e67', 1, 'aaa.png', 'aaa', 1, 0, 2222220, 0, 1, 2, 0, 0, 1, 2, 222850908, 1),
(4, 'user', 'surname', 'user2', 'a1881c06eec96db9901c7bbfe41c42a3f08e9cb4', 1, 'aaa.png', 'aaa', 1, 0, 2222220, 0, 0, 0, 0, 0, 0, 0, 222850908, 1),
(5, 'user', 'surname', 'user3', '0b7f849446d3383546d15a480966084442cd2193', 1, 'aaa.png', 'aaa', 1, 0, 2222220, 0, 0, 0, 0, 0, 0, 0, 222850908, 1);

-- --------------------------------------------------------

--
-- Table structure for table `obj_turnuva`
--

CREATE TABLE `obj_turnuva` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `country_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `date_d` int(11) NOT NULL,
  `date_m` int(11) NOT NULL,
  `date_y` int(11) NOT NULL,
  `date_t` int(11) NOT NULL,
  `active` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `profile_follow`
--

CREATE TABLE `profile_follow` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `profile1_id` int(11) NOT NULL,
  `profile2_id` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `profile_message`
--

CREATE TABLE `profile_message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `profile1_id` int(11) NOT NULL,
  `profile2_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `turnuva_gamers`
--

CREATE TABLE `turnuva_gamers` (
  `id` int(11) NOT NULL,
  `gamer_id` int(11) NOT NULL,
  `turnuva_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
