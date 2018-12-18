-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 18, 2018 at 03:36 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.0.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fb_conversations`
--

-- --------------------------------------------------------

--
-- Table structure for table `fbinbox_conversation`
--

CREATE TABLE `fbinbox_conversation` (
  `id` int(10) NOT NULL,
  `conversation_id` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `updated_time` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `page_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fbinbox_message`
--

CREATE TABLE `fbinbox_message` (
  `id` int(10) NOT NULL,
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  `created_time` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `to` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `from` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `conversation_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fbinbox_page`
--

CREATE TABLE `fbinbox_page` (
  `id` int(10) NOT NULL,
  `page_id` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `page_name` text COLLATE utf8_unicode_ci NOT NULL,
  `access_token` text COLLATE utf8_unicode_ci NOT NULL,
  `updated_time` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fbinbox_user`
--

CREATE TABLE `fbinbox_user` (
  `id` int(10) NOT NULL,
  `user_id` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `name` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fbinbox_conversation`
--
ALTER TABLE `fbinbox_conversation`
  ADD UNIQUE KEY `conversation_index` (`id`);

--
-- Indexes for table `fbinbox_message`
--
ALTER TABLE `fbinbox_message`
  ADD UNIQUE KEY `message_id` (`id`);

--
-- Indexes for table `fbinbox_page`
--
ALTER TABLE `fbinbox_page`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fbinbox_user`
--
ALTER TABLE `fbinbox_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `fbinbox_conversation`
--
ALTER TABLE `fbinbox_conversation`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fbinbox_message`
--
ALTER TABLE `fbinbox_message`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fbinbox_page`
--
ALTER TABLE `fbinbox_page`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fbinbox_user`
--
ALTER TABLE `fbinbox_user`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
