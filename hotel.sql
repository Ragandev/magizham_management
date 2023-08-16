-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 11, 2023 at 03:05 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `resto_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `branch` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `username`, `password`, `branch`, `role`, `img`) VALUES
(3, 'Ranjith', 'ragan', '123', 'Main Branch', 'Admin', ''),
(4, 'Keerthana', 'keerthi', '123', 'Main Branch', 'Store Manager', ''),
(5, 'Indhumathi', 'indhu', '123', 'Branch 1', 'Branch Manager', ''),
(6, 'Dhanush', 'praveen', '123', 'Branch 2', 'Kitchen Manager', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
