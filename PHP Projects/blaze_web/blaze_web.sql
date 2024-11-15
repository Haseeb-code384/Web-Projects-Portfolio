-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 15, 2024 at 02:00 PM
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
-- Database: `blaze_web`
--

-- --------------------------------------------------------

--
-- Table structure for table `checktest`
--

CREATE TABLE `checktest` (
  `Date` timestamp NOT NULL DEFAULT current_timestamp(),
  `Name` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(244) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `checktest`
--

INSERT INTO `checktest` (`Date`, `Name`, `Email`, `Password`) VALUES
('2024-08-20 09:36:24', 'Haseeb', 'hassthrohew09', 'bhiu9ugu98g9'),
('2024-08-20 09:36:34', 'Haseeb', 'hassthrohew09', 'bhiu9ugu98g9');

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `file_name` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `file_type` varchar(255) NOT NULL,
  `id` int(13) NOT NULL,
  `Date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`file_name`, `file_path`, `file_type`, `id`, `Date`) VALUES
('uploads/66c4d173bd03b_41OUvnk0DgL._SL1500_.jpg,uploads/66c4d173c4d06_WhatsApp Image 2024-08-04 at 19.46.44_22576946.jpg', '', 'photos', 5, '2024-08-20 17:36:08'),
('uploads/66c4d173d74bc_Bootcamp Ecommerce Presentation.pdf,uploads/66c4d17408724_Fatima.pdf', '', 'pdfs', 5, '2024-08-20 17:36:08'),
('uploads/66c4d289df12b_41OUvnk0DgL._SL1500_.jpg,uploads/66c4d289e6ac6_WhatsApp Image 2024-08-04 at 19.46.44_22576946.jpg', '', 'photos', 5, '2024-08-20 17:36:08'),
('uploads/66c4d289f30c6_Bootcamp Ecommerce Presentation.pdf,uploads/66c4d28a1dd6c_Fatima.pdf', '', 'pdfs', 5, '2024-08-20 17:36:08'),
('uploads/66c4d38d843bd_Passport Back.jpg,uploads/66c4d38d8ac1d_41OUvnk0DgL._SL1500_.jpg', '', 'photos', 5, '2024-08-20 17:36:08'),
('uploads/66c4d38d987ed_CV(New)--OA.pdf,uploads/66c4d38dbb5b6_free-cv-template-7.pdf', '', 'pdfs', 5, '2024-08-20 17:36:08'),
('uploads/66c4d38ddc2fa_Y2Mate.is - Make a Clock using Python  Python Project-at7rpdT8FeI-480p-1655182932348.mp4,uploads/66c4d38e315e6_Y2Mate.is - How to make a website with Python and Django - BASICS (E01)-rA4X73E_HV0-480p-1655183610979.mp4', '', 'videos', 5, '2024-08-20 17:36:08'),
('uploads/66c4d46ad0720_41OUvnk0DgL._SL1500_.jpg', '', 'photos', 5, '2024-08-20 17:37:46'),
('uploads/66c4d46ae02de_PassportDoc.pdf', '', 'pdfs', 5, '2024-08-20 17:37:47'),
('uploads/66c4d46b0dffe_6394054-uhd_4096_2048_24fps.mp4', '', 'videos', 5, '2024-08-20 17:40:05'),
('uploads/66c4d7a2ca063_41OUvnk0DgL._SL1500_.jpg,uploads/66c4d7a2d0c2c_Passport Back.jpg', '', 'photos', 5, '2024-08-20 17:51:30'),
('uploads/66c4d7a2d90d9_PassportDoc.pdf,uploads/66c4d7a302726_Dr. Muhammad Sufyan.pdf', '', 'pdfs', 5, '2024-08-20 17:51:31'),
('uploads/66c4d7a3291aa_pexels-artem-podrez-6003772.mp4', '', 'videos', 5, '2024-08-20 17:53:56'),
('uploads/66c4d83404bdd_audio.mp3,uploads/66c4d834972a1_vegetariana.mp3', '', 'audios', 5, '2024-08-20 17:53:58');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(6) NOT NULL,
  `user_name` varchar(30) NOT NULL,
  `user_email` varchar(30) NOT NULL,
  `user_password` varchar(30) NOT NULL,
  `user_country` varchar(20) NOT NULL DEFAULT 'N/A',
  `register_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_email`, `user_password`, `user_country`, `register_date`) VALUES
(1, 'Haseebtariq', 'haseebtariq4824@gmail.com', '', 'pk', '2024-06-18 09:19:30'),
(7, 'jethalald3e3', 'jetha64f4@example.com', '', 'in', '2024-06-18 09:51:51'),
(10, 'Razaq Raza', 'razaq467@example.com', 'khdydhd/4989.didh', 'pk', '2024-06-18 09:55:20'),
(11, 'Haseebtyu8', 'hugyfyufyufyu@gmai', 'drdyr3486', 'pk', '2024-06-22 08:28:28'),
(12, 'Razaulhaq', 'razaulhaq44@gmail.com', 'dr8/47878', 'pk', '2024-06-08 16:36:22'),
(13, 'Raza33', 'razaee@example.com', 'drdyr;ee3', 'pk', '2024-06-08 16:37:17'),
(14, 'Raza466', 'raza45@example.com', 'drd8/47878', 'pk', '2024-06-08 16:37:47'),
(15, 'Haseeb', 'haseebtariq8dd92@gmail.com', '7487ioklh', 'pk', '2024-06-18 07:20:52'),
(16, 'Hasetariq', 'razaq7@example.com', '785765', 'pk', '2024-06-22 08:09:38'),
(17, 'usama', 'yeueru687@gamil.com', '789689huy', 'in', '2024-06-22 08:17:56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_email` (`user_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
