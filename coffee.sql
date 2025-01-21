-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Nov 07, 2024 at 06:25 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `coffee`
--

-- --------------------------------------------------------

--
-- Table structure for table `coffeeadminlogin`
--

CREATE TABLE `coffeeadminlogin` (
  `username` text NOT NULL,
  `password` varchar(10) NOT NULL,
  `adminid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `coffeeadminlogin`
--

INSERT INTO `coffeeadminlogin` (`username`, `password`, `adminid`) VALUES
('Harper Stern', 'harper45', 1),
('Eric Tao', 'eric56', 2),
('Robert', 'rob', 10);

-- --------------------------------------------------------

--
-- Table structure for table `coffeeuserlogin`
--

CREATE TABLE `coffeeuserlogin` (
  `id` int(11) NOT NULL,
  `fullname` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `coffeeuserlogin`
--

INSERT INTO `coffeeuserlogin` (`id`, `fullname`, `email`, `password`) VALUES
(1, 'Venessa Thoithi', 'thoithivenessa33@gmail.com', 'venessa33');

-- --------------------------------------------------------

--
-- Table structure for table `coffeeusersignup`
--

CREATE TABLE `coffeeusersignup` (
  `id` int(11) NOT NULL,
  `fullname` text NOT NULL,
  `mobilenumber` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(10) NOT NULL,
  `confirmpassword` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `coffeeusersignup`
--

INSERT INTO `coffeeusersignup` (`id`, `fullname`, `mobilenumber`, `email`, `password`, `confirmpassword`) VALUES
(1, 'Venessa Thoithi', '0787181543', 'thoithivenessa33@gmail.com', 'venessa33', 'venessa33');

-- --------------------------------------------------------

--
-- Table structure for table `user_submissions`
--

CREATE TABLE `user_submissions` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `phonenumber` text NOT NULL,
  `feedback` text NOT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `submission_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `response_text` text DEFAULT NULL,
  `response_file` varchar(255) DEFAULT NULL,
  `response_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_submissions`
--

INSERT INTO `user_submissions` (`id`, `name`, `email`, `phonenumber`, `feedback`, `file_path`, `submission_date`, `response_text`, `response_file`, `response_date`) VALUES
(1, 'Venessa', 'thoithivenessa33@gmail.com', '', 'Loved the coffee', 'uploads/Latte.jpeg', '2024-11-05 12:36:07', NULL, NULL, '2024-11-05 20:24:49');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `coffeeadminlogin`
--
ALTER TABLE `coffeeadminlogin`
  ADD PRIMARY KEY (`adminid`);

--
-- Indexes for table `coffeeuserlogin`
--
ALTER TABLE `coffeeuserlogin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coffeeusersignup`
--
ALTER TABLE `coffeeusersignup`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_submissions`
--
ALTER TABLE `user_submissions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `coffeeadminlogin`
--
ALTER TABLE `coffeeadminlogin`
  MODIFY `adminid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `coffeeuserlogin`
--
ALTER TABLE `coffeeuserlogin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `coffeeusersignup`
--
ALTER TABLE `coffeeusersignup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_submissions`
--
ALTER TABLE `user_submissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
