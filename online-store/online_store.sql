-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 28 Sty 2023, 18:53
-- Wersja serwera: 10.4.27-MariaDB
-- Wersja PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `online_store`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Zrzut danych tabeli `items`
--

INSERT INTO `items` (`id`, `name`, `description`, `price`) VALUES
(1, 'Pędzel mały', 'Pędzel do malowania farbami akrylowymi o rozmiarze 3mm', 7.5),
(2, 'Pędzel średni', 'Pędzel do malowania farbami akrylowymi o rozmiarze 10mm', 11.5),
(3, 'Pędzel duży', 'Pędzel do malowania farbami akrylowymi o rozmiarze 30mm', 19.5),
(4, 'Farba akrylowa biała', 'Biała farba akrylowa, kryjąca, 200ml', 8.5),
(5, 'Farba akrylowa czarna', 'Czarna farba akrylowa, kryjąca, 200ml', 8.5),
(6, 'Farba akrylowa żółta', 'Żółta farba akrylowa, kryjąca, 200ml', 8.5),
(7, 'Farba akrylowa czerwona', 'Czerwona farba akrylowa, kryjąca, 200ml', 8.5),
(8, 'Farba akrylowa niebieska', 'Niebieska farba akrylowa, kryjąca, 200ml', 8.5),
(9, 'Farba akrylowa zielona', 'Zielona farba akrylowa, kryjąca, 200ml', 8.5),
(10, 'Sztaluga stołowa drewniana', 'Sztaluga stołowa drewniana, składana, wymiary płótna do 30x40', 39.9),
(11, 'Sztaluga stołowa metalowa', 'Sztaluga stołowa metalowa, składana, z pokrowcem, wymiary płótna do 30x40', 29.9),
(12, 'Sztaluga stojąca drewniana', 'Sztaluga stojąca drewniana, składana, wysokość 170 cm', 109.9),
(13, 'Płótno małe', 'Płótno o wymiarach 20x20, dwukronie gruntowane', 10.9),
(14, 'Płótno średnie', 'Płótno o wymiarach 30x40, dwukronie gruntowane', 14.9),
(15, 'Płótno duże', 'Płótno o wymiarach 40x50, dwukronie gruntowane', 19.9);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
