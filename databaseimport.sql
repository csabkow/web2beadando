-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u2
-- http://www.phpmyadmin.net
--
-- Hoszt: localhost
-- Létrehozás ideje: 2018. Ápr 26. 12:57
-- Szerver verzió: 5.5.59-0+deb8u1
-- PHP verzió: 5.6.33-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `menus`
--

CREATE TABLE IF NOT EXISTS `menus` (
`menu_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `title` varchar(32) CHARACTER SET utf8 COLLATE utf8_hungarian_ci NOT NULL,
  `page_name` varchar(32) CHARACTER SET utf8 COLLATE utf8_hungarian_ci NOT NULL,
  `id` varchar(16) CHARACTER SET utf8 COLLATE utf8_hungarian_ci NOT NULL,
  `role` tinyint(1) NOT NULL,
  `ordering` int(5) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `menus`
--

INSERT INTO `menus` (`menu_id`, `parent_id`, `title`, `page_name`, `id`, `role`, `ordering`) VALUES
(1, 0, 'Főoldal', 'home', '', 0, 1),
(2, 0, 'Projektek', '', '', 1, 2),
(3, 2, 'Autók', '', '', 1, 3),
(4, 0, 'Rólam', 'about', '', 0, 4),
(5, 3, 'Martin', 'martin', '', 1, 1),
(6, 3, 'Sajat', 'sajat', '', 1, 1),
(7, 3, 'Merci', 'merci', '', 1, 1),
(11, 0, 'Belépés', 'login', '', 0, 5),
(12, 0, 'Regisztráció', 'register', '', 0, 6),
(13, 0, 'Kijelentkezés', '', 'logout', 1, 10),
(14, 0, 'Admin', 'admin', '', 2, 7),
(15, 0, 'Hozzászólások', 'reviews', '', 1, 9),
(16, 0, 'Színválasztó', 'cpicker', '', 1, 9);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `reviews`
--

CREATE TABLE IF NOT EXISTS `reviews` (
`review_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `review` text NOT NULL,
  `insert_date` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `reviews`
--

INSERT INTO `reviews` (`review_id`, `user_id`, `review`, `insert_date`) VALUES
(1, 3, 'remek fotók', '2018-04-11 07:10:06'),
(11, 3, 'jó cucc', '2018-04-01 22:53:28');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`user_id` int(11) NOT NULL,
  `username` varchar(32) CHARACTER SET utf8 COLLATE utf8_hungarian_ci NOT NULL,
  `password` varchar(126) NOT NULL,
  `email` varchar(64) CHARACTER SET utf8 COLLATE utf8_hungarian_ci NOT NULL,
  `role` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `email`, `role`) VALUES
(3, 'admin', '*4ACFE3202A5FF5CF467898FC58AAB1D615029441', 'admin@email.com', 2),
(4, 'felhasznalo', '*D5D9F81F5542DE067FFF5FF7A4CA4BDD322C578F', 'user@felhasznalo.com', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
 ADD PRIMARY KEY (`menu_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
 ADD PRIMARY KEY (`review_id`), ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `reviews`
--
ALTER TABLE `reviews`
ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
