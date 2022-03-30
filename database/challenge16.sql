-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 30, 2022 at 04:41 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `challenge16`
--

-- --------------------------------------------------------

--
-- Table structure for table `typeofbusiness`
--

CREATE TABLE `typeofbusiness` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `typeofbusiness`
--

INSERT INTO `typeofbusiness` (`id`, `type`) VALUES
(1, 'Services'),
(2, 'Products');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `coverurl` varchar(2048) NOT NULL,
  `maintitle` varchar(64) NOT NULL,
  `subtitle` varchar(128) NOT NULL,
  `bio` varchar(255) NOT NULL,
  `telnumber` int(11) NOT NULL,
  `location` varchar(128) NOT NULL,
  `typeofbsn` int(10) UNSIGNED NOT NULL,
  `produrl` varchar(2048) NOT NULL,
  `proddesc` varchar(512) NOT NULL,
  `produrltwo` varchar(2048) NOT NULL,
  `proddesctwo` varchar(512) NOT NULL,
  `produrlthree` varchar(2048) NOT NULL,
  `proddescthree` varchar(512) NOT NULL,
  `compdesc` varchar(512) NOT NULL,
  `linkedin` varchar(128) NOT NULL,
  `facebook` varchar(128) NOT NULL,
  `twitter` varchar(128) NOT NULL,
  `instagram` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `coverurl`, `maintitle`, `subtitle`, `bio`, `telnumber`, `location`, `typeofbsn`, `produrl`, `proddesc`, `produrltwo`, `proddesctwo`, `produrlthree`, `proddescthree`, `compdesc`, `linkedin`, `facebook`, `twitter`, `instagram`) VALUES
(0, 'https://www.industrialempathy.com/img/remote/ZiClJf-1920w.jpg', 'Challenge', 'Challenge-16 PDO', '  Lorem ipsum dolor sit amet consectetur adipisicing elit. Modi provident optio, facilis itaque nulla quis dolorum? Voluptates modi quidem similique a molestias deserunt neque illo, ratione quas omnis facere? Nihil iusto eum ut magnam fuga quis. Magni acc', 3018513, 'Ohio, United States', 2, 'https://blog.hubspot.com/hubfs/parts-url.jpg', '  Lorem ipsum dolor sit amet consectetur adipisicing elit. Modi provident optio, facilis itaque nulla quis dolorum? Voluptates modi quidem similique a molestias deserunt neque illo, ratione quas omnis facere? Nihil iusto eum ut magnam fuga quis. Magni accusantium voluptas incidunt, cupiditate fugit quaerat dignissimos! Porro officia dolorum provident quia harum?', 'https://www.industrialempathy.com/img/remote/ZiClJf-1920w.jpg', '  Lorem ipsum dolor sit amet consectetur adipisicing elit. Modi provident optio, facilis itaque nulla quis dolorum? Voluptates modi quidem similique a molestias deserunt neque illo, ratione quas omnis facere? Nihil iusto eum ut magnam fuga quis. Magni accusantium voluptas incidunt, cupiditate fugit quaerat dignissimos! Porro officia dolorum provident quia harum?', 'https://blog.hubspot.com/hubfs/parts-url.jpg', '  Lorem ipsum dolor sit amet consectetur adipisicing elit. Modi provident optio, facilis itaque nulla quis dolorum? Voluptates modi quidem similique a molestias deserunt neque illo, ratione quas omnis facere? Nihil iusto eum ut magnam fuga quis. Magni accusantium voluptas incidunt, cupiditate fugit quaerat dignissimos! Porro officia dolorum provident quia harum?', '  Lorem ipsum dolor sit amet consectetur adipisicing elit. Modi provident optio, facilis itaque nulla quis dolorum? Voluptates modi quidem similique a molestias deserunt neque illo, ratione quas omnis facere? Nihil iusto eum ut magnam fuga quis. Magni accusantium voluptas incidunt, cupiditate fugit quaerat dignissimos! Porro officia dolorum provident quia harum?', 'linkedin', 'facebook', 'twitter', 'instagram');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `typeofbusiness`
--
ALTER TABLE `typeofbusiness`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `typeofbsn` (`typeofbsn`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `typeofbusiness`
--
ALTER TABLE `typeofbusiness`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`typeofbsn`) REFERENCES `typeofbusiness` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
