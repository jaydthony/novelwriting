-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 28, 2023 at 12:02 AM
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
-- Database: `writing`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `story_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `paragraph_id` int(11) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `body` longtext DEFAULT NULL,
  `date_created` varchar(255) DEFAULT NULL,
  `time_created` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `story_id`, `user_id`, `paragraph_id`, `username`, `body`, `date_created`, `time_created`) VALUES
(1, 2, 6, 5, 'gm', 'This is good!!!', '2023-06-27', '10:16:35 am'),
(2, 2, 6, 5, 'gm', 'Really really good !!!', '2023-06-27', '10:18:05 am');

-- --------------------------------------------------------

--
-- Table structure for table `favorite`
--

CREATE TABLE `favorite` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `story_id` int(11) DEFAULT NULL,
  `date_created` varchar(255) DEFAULT NULL,
  `time_created` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `favorite`
--

INSERT INTO `favorite` (`id`, `user_id`, `story_id`, `date_created`, `time_created`) VALUES
(4, 6, 2, '2023-06-19', '08:37:26 pm'),
(5, 6, 3, '2023-06-19', '08:37:33 pm'),
(7, 7, 2, '2023-06-19', '10:39:47 pm'),
(8, 6, 1, '2023-06-19', '11:51:27 pm'),
(9, 6, 7, '2023-06-20', '07:45:51 pm');

-- --------------------------------------------------------

--
-- Table structure for table `paragraphs`
--

CREATE TABLE `paragraphs` (
  `id` int(11) NOT NULL,
  `story_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `body` longtext DEFAULT NULL,
  `netvotes` int(255) DEFAULT 0,
  `date_created` varchar(255) DEFAULT NULL,
  `time_created` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `paragraphs`
--

INSERT INTO `paragraphs` (`id`, `story_id`, `user_id`, `username`, `body`, `netvotes`, `date_created`, `time_created`) VALUES
(5, 2, 4, '@whizz', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Atque nobis, deserunt cum quibusdam aliquam nihil unde et impedit, quaerat! Corporis praesentium aspernatur autem laboriosam natus similique, adipisci nam maxime.', 0, '2023-06-04', '08:00:05 am'),
(11, 1, 4, '@whizz', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Atque nobis, deserunt cum quibusdam aliquam nihil unde et impedit, sequi, modi quos porro iure enim suscipit itaque earum tenetur praesentium quaerat! Corporis praesentium aspernatur autem laboriosam natus similique, adipisci nam. Chapter 1', 0, '2023-06-04', '08:41:42 am'),
(12, 4, 4, '@whizz', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Atque nobis, deserunt cum quibusdam aliquam nihil unde et impedit, quaerat! Corporis praesentium aspernatur autem laboriosam natus similique, adipisci nam maxime.', 0, '2023-06-04', '08:42:19 am'),
(13, 4, 3, '@whizzolad', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Atque nobis, deserunt cum quibusdam aliquam nihil unde et impedit, quaerat! Corporis praesentium aspernatur autem laboriosam natus similique, adipisci nam maxime.', 0, '2023-06-04', '08:42:35 am'),
(15, 2, 6, 'gm', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Atque nobis, deserunt cum quibusdam aliquam nihil unde et impedit, quaerat! Corporis praesentium aspernatur autem laboriosam natus similique, adipisci nam maxime.', 0, '2023-06-19', '06:18:16 pm'),
(21, 3, 6, 'gm', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Atque nobis, deserunt cum quibusdam aliquam nihil unde et impedit, quaerat! Corporis praesentium aspernatur autem laboriosam natus similique, adipisci nam maxime.', 0, '2023-06-19', '07:38:23 pm'),
(22, 1, 6, 'gm', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Atque nobis, deserunt cum quibusdam aliquam nihil unde et impedit, quaerat! Corporis praesentium aspernatur autem laboriosam natus similique, adipisci nam maxime. Chapter 2', 0, '2023-06-19', '10:26:51 pm'),
(23, 5, 7, '@test', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Atque nobis, deserunt cum quibusdam aliquam nihil unde et impedit, quaerat! Corporis praesentium aspernatur autem laboriosam natus similique, adipisci nam maxime.', 0, '2023-06-19', '10:38:15 pm'),
(24, 5, 4, '@whizz', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Atque nobis, deserunt cum quibusdam aliquam nihil unde et impedit, quaerat! Corporis praesentium aspernatur autem laboriosam natus similique, adipisci nam maxime.', 0, '2023-06-19', '10:38:41 pm'),
(25, 7, 6, 'gm', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Atque nobis, deserunt cum quibusdam aliquam nihil unde et impedit, quaerat! Corporis praesentium aspernatur autem laboriosam natus similique, adipisci nam.', 0, '2023-06-20', '07:37:03 pm');

-- --------------------------------------------------------

--
-- Table structure for table `site_settings`
--

CREATE TABLE `site_settings` (
  `id` int(11) NOT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `company_address` varchar(255) DEFAULT NULL,
  `owner_name` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `site_settings`
--

INSERT INTO `site_settings` (`id`, `company_name`, `phone`, `company_address`, `owner_name`, `logo`) VALUES
(1, 'Writing', '123456789', 'World', 'Client', 'gmekxpmee1bp8im.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `stories`
--

CREATE TABLE `stories` (
  `id` int(11) NOT NULL,
  `name` varchar(500) DEFAULT NULL,
  `host_id` int(11) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `genre` varchar(255) DEFAULT NULL,
  `tags` varchar(500) DEFAULT NULL,
  `wpp` int(11) DEFAULT NULL,
  `ppc` int(11) DEFAULT NULL,
  `sector` varchar(255) DEFAULT NULL,
  `about` varchar(500) DEFAULT NULL,
  `date_created` varchar(255) DEFAULT NULL,
  `time_created` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stories`
--

INSERT INTO `stories` (`id`, `name`, `host_id`, `username`, `genre`, `tags`, `wpp`, `ppc`, `sector`, `about`, `date_created`, `time_created`) VALUES
(1, 'The Beautiful Bride', 4, '@whizz', 'Love', 'love,drama,romance,betrayal', 50, 1, 'public', 'This is the story of a little girl!!!', '2023-05-26', '10:13:38 am'),
(2, 'The Beautiful Groom', 4, '@whizz', 'War', 'love,drama,romance,betrayal', 50, 50, 'public', 'This is the story of a little boy wanted to be good but he no get joy shoye, when i don\'t sleep mo joko awon angeli wan korin ogo, inu midun eti miran, aya miya gaga !!!', '2023-05-26', '10:48:20 am'),
(3, 'The Beautiful Plane', 4, '@whizz', 'Sci-fi', 'love,drama,romance,skit', 5, 50, 'public', 'World of science is fast growing !!!!', '2023-05-26', '07:42:07 pm'),
(7, 'The Beautiful Woman', 6, 'gm', 'Art', 'love,drama,romance,betrayal', 30, 1, 'public', 'Everything!!!', '2023-06-20', '06:45:42 pm');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `hashed_password` varchar(255) DEFAULT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `bio` varchar(500) DEFAULT NULL,
  `date_created` varchar(255) DEFAULT NULL,
  `time_created` varchar(255) DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `hashed_password`, `fullname`, `email`, `bio`, `date_created`, `time_created`, `file`) VALUES
(4, '@whizz', '$2y$10$GmyV5ENpKZ4xTMNhNBHO7elkMh12VVMwQHDPcuMRYArUrsvevqgpS', 'Lateef Oladoja', 'oladojablessing66@gmail.com', 'I\'m a competent Javascript Developer. Hit me up for even coffee!!!', '2023-05-23', '08:18:11 am', '@whizzsu8q1bxn9qaay.jpg'),
(6, 'gm', '$2y$10$JEutyi5KbaruU4QBpLc29eLkIMJ2iUiMbISw68y3fg6FKSFto1pRq', 'Admin', 'admin@gmail.com', 'Site Owner!!!', '2023-06-18', '11:29:27 am', 'gmkocbesgyqz0xx.jpg'),
(7, '@test', '$2y$10$voBH5PLd03Vu6rj9QEEr3urJsGi8iZzoIgWSas9IlkpnHVrTbjxcm', 'Testing', 'test@gmail.com', 'I am a writer contributing to a novel!!!', '2023-06-19', '10:34:23 pm', '@testzhzz8irzoy7fb.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `uservotes`
--

CREATE TABLE `uservotes` (
  `id` int(11) NOT NULL,
  `paragraph_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `vote` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `favorite`
--
ALTER TABLE `favorite`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paragraphs`
--
ALTER TABLE `paragraphs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `site_settings`
--
ALTER TABLE `site_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stories`
--
ALTER TABLE `stories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `uservotes`
--
ALTER TABLE `uservotes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `favorite`
--
ALTER TABLE `favorite`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `paragraphs`
--
ALTER TABLE `paragraphs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `site_settings`
--
ALTER TABLE `site_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `stories`
--
ALTER TABLE `stories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `uservotes`
--
ALTER TABLE `uservotes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
