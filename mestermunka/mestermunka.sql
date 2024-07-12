-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gép: localhost
-- Létrehozás ideje: 2024. Júl 12. 07:49
-- Kiszolgáló verziója: 8.0.31
-- PHP verzió: 8.2.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `mestermunka`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `tasks`
--

CREATE TABLE `tasks` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `status` varchar(30) NOT NULL,
  `person` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- A tábla adatainak kiíratása `tasks`
--

INSERT INTO `tasks` (`id`, `name`, `description`, `status`, `person`, `date`) VALUES
(31, 'Aratás', 'Vida, nyáriné tábla aratása, szemszállítás 2-es telepre. Sándor arat, Dániel szállít a 6630 traktorral.', 'Folyamatban', 'Sándor, Dániel', '2024-07-10'),
(32, 'Szemszállítás', 'Repce szállítás telepek között, utána betermelés a magtárba csigával.', 'Kész', 'Tibor', '2024-07-11'),
(33, 'Tárcsázás', 'F12 Tarló tárcsázás', 'Folyamatban', 'Tibor', '2024-08-10'),
(35, 'Aratás', 'Összes búza aratása', 'Előkészületben', 'Dániel, Sándor', '2024-07-14'),
(36, 'Kultivátorozás', 'Kukorica kultivátorozás műtrágyaszórással, pétisó 120 kg/ha', 'kész', 'Dániel', '2024-06-02'),
(37, 'Permetezés', 'Napraforgó permetezés 6630 traktorral, régi amazone géppel. Bacardy napraforgó, pulsar plus 2l/ha 250 l/ha víz', ' folyamatban', 'Tibor', '2024-05-02'),
(42, 'bfgb', 'ydbd', 'xcvxc', 'Sándor', '2024-04-30'),
(43, 'Aratáshoz szállítás', 'asdvass klloer nvdjn', 'Kész', 'Péter', '2024-08-22'),
(45, 'sdvs', 'ÉEFM', 'eéfmeklw', 'DÁniel', '2024-08-14'),
(46, 'Tárcsázás hsld,', 'lorem tárcsa dolor ', 'Folyamatban', 'Tibor', '2024-08-02');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
