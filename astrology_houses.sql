-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 23, 2019 at 05:41 PM
-- Server version: 5.5.61-0ubuntu0.14.04.1
-- PHP Version: 7.0.31-1+ubuntu14.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";




--
-- Database: `dictionary`
--

-- --------------------------------------------------------

--
-- Table structure for table `astrology_houses`
--

CREATE TABLE `astrology_houses` (
  `id` int(11) NOT NULL,
  `house_number` int(11) DEFAULT NULL,
  `house_quality` varchar(255) DEFAULT NULL,
  `house_element` varchar(255) DEFAULT NULL,
  `house_element_quality` varchar(255) DEFAULT NULL,
  `house_generates` varchar(255) DEFAULT NULL,
  `house_overcomes` varchar(255) DEFAULT NULL,
  `house_weakens` varchar(255) NOT NULL,
  `house_element_glyph` char(32) DEFAULT NULL,
  `house_season` varchar(255) DEFAULT NULL,
  `house_ruler` mediumtext,
  `house_alchemical_process` varchar(255) DEFAULT NULL,
  `house_opposite` varchar(255) DEFAULT NULL,
  `house_description` longtext,
  `house_sun` mediumtext,
  `house_moon` mediumtext,
  `house_planet` mediumtext,
  `house_positive` mediumtext,
  `house_negative` mediumtext,
  `house_glyph` char(32) DEFAULT NULL,
  `house_color` varchar(255) NOT NULL,
  `num1` int(11) DEFAULT NULL,
  `num2` int(11) DEFAULT NULL,
  `num3` int(11) DEFAULT NULL,
  `pythagorean` int(111) DEFAULT NULL,
  `num1_inner` int(11) NOT NULL,
  `num2_inner` int(11) NOT NULL,
  `num3_inner` int(11) NOT NULL,
  `pythagorean_inner` int(11) NOT NULL,
  `chaldean` int(11) DEFAULT NULL,
  `vowelsum` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `astrology_houses`
--

INSERT INTO `astrology_houses` (`id`, `house_number`, `house_quality`, `house_element`, `house_element_quality`, `house_generates`, `house_overcomes`, `house_weakens`, `house_element_glyph`, `house_season`, `house_ruler`, `house_alchemical_process`, `house_opposite`, `house_description`, `house_sun`, `house_moon`, `house_planet`, `house_positive`, `house_negative`, `house_glyph`, `house_color`, `num1`, `num2`, `num3`, `pythagorean`, `num1_inner`, `num2_inner`, `num3_inner`, `pythagorean_inner`, `chaldean`, `vowelsum`) VALUES
(1, 1, 'Life', 'Fire', 'Cardinal', 'Earth', 'Air', '', '', 'Spring', 'Aries', 'Calcination', 'Libra', 'House of Self	Physical appearance, traits and characteristics. First impressions. General outlook into the world. Ego. Beginnings and initiatives.', NULL, NULL, NULL, NULL, NULL, '♈︎', 'red', NULL, NULL, NULL, NULL, 0, 0, 0, 0, NULL, 0),
(2, 2, 'Wealth', 'Earth', 'Fixed', 'Air', 'Water', '', '', 'Spring', 'Taurus', 'Congelation', 'Scorpio', 'House of Value	Material and immaterial things of certain value. Money. Belongings, property, acquisitions. Cultivation and growth. Substance. Self-worth.', NULL, NULL, NULL, NULL, NULL, '♉︎', 'green', NULL, NULL, NULL, NULL, 0, 0, 0, 0, NULL, 0),
(3, 3, 'Brothers', 'Air', 'Mutable', 'Water', 'Wood', '', '', 'Spring', 'Gemini', 'Fixation', 'Sagittarius', 'House of Communications	Early education and childhood environment. Communication. Happiness. Intelligence. Achievements. Siblings. Neighborhood matters. Short, local travel, and transportation.', NULL, NULL, NULL, NULL, NULL, '♊︎', 'skyblue', NULL, NULL, NULL, NULL, 0, 0, 0, 0, NULL, 0),
(4, 4, 'Parent', 'Water', 'Cardinal', 'Wood', 'Fire', '', '', 'Summer', 'Cancer', 'Dissolution', 'Capricorn', 'House of Home and Family	Ancestry, heritage, roots. Early foundation and environment. Mother or mothers as figure. The caretaker of the household. Comfort. Cyclic end of matters.', NULL, NULL, NULL, NULL, NULL, '♋︎', 'navyblue', NULL, NULL, NULL, NULL, 0, 0, 0, 0, NULL, 0),
(5, 5, 'Children', 'Fire', 'Fixed', 'Earth', 'Air', '', '', 'Summer', 'Leo', 'Digestion', 'Aquarius', 'House of Pleasure	Recreational and leisure activities. Things which makes for enjoyment and entertainment. Games and gambling. Children. Love and romance. Creative self-expression.', NULL, NULL, NULL, NULL, NULL, '♌︎', 'yellow', NULL, NULL, NULL, NULL, 0, 0, 0, 0, NULL, 0),
(6, 6, 'Health', 'Earth', 'Mutable', 'Air', 'Water', '', '', 'Summer', 'Virgo', 'Distillation', 'Pisces', 'House of Health	Routine tasks and duties. Skills or training acquired. Jobs and Employments. Health and overall well-being. Service performed for others. Caretaking. Pets and small domestic animals.', NULL, NULL, NULL, NULL, NULL, '♍︎', 'brown', NULL, NULL, NULL, NULL, 0, 0, 0, 0, NULL, 0),
(7, 7, 'Spouse', 'Air', 'Cardinal', 'Water', 'Wood', '', '', 'Autumn', 'Libra', 'Sublimation', 'Aries', 'House of Partnerships	Close, confidante-like relationships. Marriage and business partners. Agreements and treaties. Matters dealing with diplomatic relations of all kinds, including open (known) enemies. Attraction to qualities we admire from the other partner.', NULL, NULL, NULL, NULL, NULL, '♎︎', 'royalblue', NULL, NULL, NULL, NULL, 0, 0, 0, 0, NULL, 0),
(8, 8, 'Death', 'Water', 'Fixed', 'Wood', 'Fire', '', '', 'Autumn', 'Scorpio', 'Separation', 'Taurus', 'House of Reincarnation	Cycles of Deaths And Rebirth. Sexual relationships and deeply committed relationships of all kinds. Joint funds, finances. Other person\'s resource. Occult, psychic and taboo matters. Regeneration. Self-transformation.', NULL, NULL, NULL, NULL, NULL, '♏︎', 'burgundy', NULL, NULL, NULL, NULL, 0, 0, 0, 0, NULL, 0),
(9, 9, 'Journeys', 'Fire', 'Mutable', 'Earth', 'Air', '', '', 'Autumn', 'Sagittarius', 'Incineration', 'Gemini', 'House of Philosophy	Foreign travel and foreign countries. Culture. Long distance travels and journeys. Religion. Law and ethics. Higher education. Knowledge. Experience through expansion.', NULL, NULL, NULL, NULL, NULL, '♐︎', 'orange', NULL, NULL, NULL, NULL, 0, 0, 0, 0, NULL, 0),
(10, 10, 'Kingdom', 'Earth', 'Cardinal', 'Air', 'Water', '', '', 'Winter', 'Capricorn', 'Fermentation', 'Cancer', 'House of Social Status	Ambitions. Motivations. Career. Status in society. Government. Authority. Father or father figure. The breadwinner of the household. One\'s public appearance/impression at-large (audience).', NULL, NULL, NULL, NULL, NULL, '♑︎', 'silver', NULL, NULL, NULL, NULL, 0, 0, 0, 0, NULL, 0),
(11, 11, 'Friendship', 'Air', 'Fixed', 'Water', 'Wood', '', '', 'Winter', 'Aquarius', 'Multiplication', 'Leo', 'House of Friendships	Friends and acquaintances of like-minded attitudes. Groups, clubs and societies. Higher associations. Benefits and fortunes from career. One\'s hopes and wishes.', NULL, NULL, NULL, NULL, NULL, '♒︎', 'smoke', NULL, NULL, NULL, NULL, 0, 0, 0, 0, NULL, 0),
(12, 12, 'Prison', 'Water', 'Mutable', 'Wood', 'Fire', '', '', 'Winter', 'Pisces', 'Projection', 'Virgo', 'House of Self-Undoing	Mysticism and mystery. Places of seclusion such as hospitals, prisons and institutions, including self-imposed imprisonments. Things which are not apparent to self, yet clearly seen by others. Elusive, clandestine, secretive or unbeknownst matters. Privacy, retreat, reflection, and self-sacrifice. Unconscious/subconscious, dreams. Unknown enemies.', NULL, NULL, NULL, NULL, NULL, '♓︎', 'aqua', NULL, NULL, NULL, NULL, 0, 0, 0, 0, NULL, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `astrology_houses`
--
ALTER TABLE `astrology_houses`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `astrology_houses`
--
ALTER TABLE `astrology_houses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;


