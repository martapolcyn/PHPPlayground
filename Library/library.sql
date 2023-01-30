-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 30 Sty 2023, 07:04
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
-- Baza danych: `library`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Zrzut danych tabeli `books`
--

INSERT INTO `books` (`id`, `title`, `author`) VALUES
(1, 'Władca Pierścieni', 'J.R.R Tolkien'),
(2, 'Mały Książę', 'Antoine de Saint-Exupery'),
(3, 'Solaris', 'Stanisław Lem'),
(4, 'Diuna', 'Frank Herbert'),
(5, 'Harry Potter i Kamień Filozoficzny', 'J.K. Rowling'),
(6, 'Hobbit', 'J.R.R Tolkien');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `borrowings`
--

CREATE TABLE `borrowings` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_book` int(11) NOT NULL,
  `date_borrow` date NOT NULL,
  `date_return` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Zrzut danych tabeli `borrowings`
--

INSERT INTO `borrowings` (`id`, `id_user`, `id_book`, `date_borrow`, `date_return`) VALUES
(1, 8, 1, '2023-01-29', '2023-01-29'),
(5, 8, 3, '2023-01-29', '2023-01-29'),
(16, 9, 2, '2023-01-11', '2023-01-14'),
(17, 9, 3, '2023-02-04', '2023-02-05'),
(20, 8, 4, '2023-02-01', '2023-02-15'),
(21, 10, 5, '2023-01-01', '2023-01-03'),
(22, 8, 5, '2022-12-28', '2023-01-29'),
(23, 11, 3, '2023-02-01', '2023-02-05');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `utype` varchar(16) NOT NULL DEFAULT 'user',
  `passwordhash` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `utype`, `passwordhash`) VALUES
(7, 'Marta', 'Admin', 'admin@example.com', 'admin', '$2y$10$V26luus4b8mhD36yNumvCunWU/x7OBSeaW5LZvYrZylvKNSnp7Mou'),
(8, 'Grażyna', 'Kowalska', 'grazka@example.com', 'user', '$2y$10$zIiKcinR9HrQlSUqMSz7mOLh5opQAz0WcABetE.gkctA77CxYJ1zK'),
(9, 'Janusz', 'Nosacz', 'typowyjanusz@example.com', 'user', '$2y$10$pN5XTt5MkcH3Dy8XlGGMxON13Rg8JkwKI2lSgxt5yw0QvMzQOJlpW'),
(10, 'Jessica', 'Nowak', 'drzesiczka@example.com', 'user', '$2y$10$iBosmbalpnDxEK/s8EvXA.IloF85A1ikF9Y.8U0C0PCTZsVYdvJ/y'),
(11, 'Karina', 'Kowalska', 'karyna@example.com', 'user', '$2y$10$VEKQjbeGyMXJx34uqlwjD.5OScOFzbo1shq7LqTjYKoFHu.1unDfu');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `borrowings`
--
ALTER TABLE `borrowings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_book` (`id_book`),
  ADD KEY `fk_user` (`id_user`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT dla tabeli `borrowings`
--
ALTER TABLE `borrowings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `borrowings`
--
ALTER TABLE `borrowings`
  ADD CONSTRAINT `fk_book` FOREIGN KEY (`id_book`) REFERENCES `books` (`id`),
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
