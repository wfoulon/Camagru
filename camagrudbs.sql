-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 12, 2018 at 08:58 AM
-- Server version: 5.7.22
-- PHP Version: 7.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `camagrudbs`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `login` varchar(255) NOT NULL,
  `text` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `login` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `login` varchar(255) NOT NULL,
  `creation_date` datetime DEFAULT NULL,
  `nb_likes` int(10) UNSIGNED DEFAULT '0',
  `nb_comments` int(10) UNSIGNED DEFAULT '0',
  `link` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `login`, `creation_date`, `nb_likes`, `nb_comments`, `link`, `name`) VALUES
(1, '1', '2018-06-08 06:46:54', 0, 0, '../pictures/c5445d2ebda452c1cbbd0f028dee7534.png', 'hello'),
(2, '1', '2018-06-08 06:47:24', 0, 0, '../pictures/e3ceb29526bba90dd26b461c3fdae822.png', 'asd'),
(3, '1', '2018-06-08 07:01:33', 0, 0, '../pictures/917046f266d77e48600dd4f8533fa6fb.png', 'fdp'),
(4, '1', '2018-06-08 07:03:42', 0, 0, '../pictures/ce0adfc764fdd55345fb6a532c89c064.png', 'fdp2'),
(5, '1', '2018-06-08 07:43:53', 0, 0, '../pictures/4f26311546b691868dadfe92a5cd8324.png', 'yolo'),
(6, '1', '2018-06-08 08:35:38', 0, 0, '../pictures/da5a07e5764064aa3c3e34b44f4d9246.png', 'yolo'),
(7, '1', '2018-06-08 08:36:37', 0, 0, '../pictures/f32a294a11108d527d7f966e2566d6e2.png', '523'),
(8, '1', '2018-06-09 04:49:09', 0, 0, '../pictures/dbb2afdf93eead01ee10dc73dd5f35a7.png', 'NTM'),
(9, '1', '2018-06-11 03:14:52', 0, 0, '../pictures/c983de57de8549b69874cbef1c8d9cbf.png', 'allo'),
(10, '1', '2018-06-11 03:18:51', 0, 0, '../pictures/fa90de28de81a3947cb6d4b7374a6895.png', 'moto'),
(12, '1', '2018-06-11 06:04:37', 0, 0, '../pictures/a30d2acf02bb75a1c017144749e095c5.png', 'GG'),
(13, '1', '2018-06-11 07:52:41', 0, 0, '../pictures/47b4441b06c4991c82f002b4e8b524fb.png', 'super'),
(14, '1', '2018-06-11 07:53:48', 0, 0, '../pictures/3acfe0a6da368f6e99110a10cc102f76.png', 'JD'),
(15, '2', '2018-06-12 02:27:07', 0, 0, '../pictures/093de770630a012d221ba8d3a6ff5cde.png', 'NTM3'),
(16, '1', '2018-06-12 06:04:13', 0, 0, '../pictures/2ba9a2e937bd9d1ae2b37316c4088c3b.png', 'superr'),
(17, '2', '2018-06-12 07:14:18', 0, 0, '../pictures/6cdaae7953102ecb66c910f012f7a159.png', 'okokok'),
(18, '3', '2018-06-12 07:17:18', 0, 0, '../pictures/5728db26405554e752d7136c1d7d8895.png', 'yyy'),
(20, '2', '2018-06-12 08:06:30', 0, 0, '../pictures/15423e089016c9c092f6d9bbec8a8128.png', 'ffffff'),
(21, '2', '2018-06-12 08:08:49', 0, 0, '../pictures/1e216675916894c85ec16f54a300fbfc.png', 'asd'),
(22, '2', '2018-06-12 08:13:26', 0, 0, '../pictures/000e7b0cfbfe7f4372f0b471f6e67ad4.png', 'yolo'),
(23, '2', '2018-06-12 08:14:10', 0, 0, '../pictures/1f6c24f5de29ee8112f63d02d93f28c3.png', 'adsda');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `login` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `confirmation` int(1) NOT NULL DEFAULT '0',
  `token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `login`, `email`, `password`, `confirmation`, `token`) VALUES
(1, 'wfoulon', 'wfoulon@student.42.fr', '3ea96d2f377f3e1af344eeda0e6d65a47a4959034e3e9e79ad2b1e9b27739e87847004f284505721170b9526dec31208c600c9c234e246b777ab28c33cb6f69d', 1, '5e4450165df6540c58124ff5088515b7e0aae341'),
(2, 'lefdp', 'moulfrok@hotmail.com', '7a39afbf5124c00aa63cb619bc23bbd76018d80ddebab307a2689e7cca53b09327e0eb680e1968480f4b07307e5aa1d6012e1e7b5fc3eced56179836b8609764', 1, '62951522dbaaefa19b27f9242a774f2645a7017c'),
(3, 'fdp', 'fdp@gmail.com', '593f76fb7dcd54473b58da72ff03057080e3f0ad46039e6a2484f14de1367abdb72503c79f2cdef81672c79640551eb094ade1a995395402933d4ee6967ed476', 1, 'd36a0f8f4eee85dba52371680eb21651299ff66a');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
