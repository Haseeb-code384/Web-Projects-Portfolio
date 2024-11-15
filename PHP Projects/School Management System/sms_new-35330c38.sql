-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 15, 2024 at 01:26 PM
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
-- Database: `sms_new-35330c38`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `attendance_id` int(20) NOT NULL,
  `date` date NOT NULL,
  `status` varchar(100) NOT NULL,
  `class_id` int(20) NOT NULL,
  `student_id` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`attendance_id`, `date`, `status`, `class_id`, `student_id`) VALUES
(1, '2024-10-18', 'present', 1, 5),
(2, '2024-10-25', 'late', 1, 5),
(3, '2024-10-17', 'late', 1, 7);

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `class_id` int(20) NOT NULL,
  `class_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`class_id`, `class_name`) VALUES
(1, 'one'),
(2, 'two');

-- --------------------------------------------------------

--
-- Table structure for table `enrollments`
--

CREATE TABLE `enrollments` (
  `enrollment_id` int(20) NOT NULL,
  `enrollment_date` date NOT NULL,
  `class_id` int(20) NOT NULL,
  `student_id` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `enrollments`
--

INSERT INTO `enrollments` (`enrollment_id`, `enrollment_date`, `class_id`, `student_id`) VALUES
(1, '2024-10-11', 1, 5),
(2, '2024-10-24', 2, 10),
(3, '2024-10-17', 1, 7);

-- --------------------------------------------------------

--
-- Table structure for table `exam_results`
--

CREATE TABLE `exam_results` (
  `exam_id` int(20) NOT NULL,
  `student_id` int(20) NOT NULL,
  `subject_id` int(20) NOT NULL,
  `obtained_marks` int(20) NOT NULL,
  `total_marks` int(20) NOT NULL,
  `exam_date` date NOT NULL,
  `result_id` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `exam_results`
--

INSERT INTO `exam_results` (`exam_id`, `student_id`, `subject_id`, `obtained_marks`, `total_marks`, `exam_date`, `result_id`) VALUES
(23, 5, 1, 45, 78, '2024-10-25', 1),
(23, 10, 2, 23, 50, '2024-10-30', 2),
(34556, 10, 1, 45, 50, '2024-10-29', 3),
(34556, 11, 3, 75, 100, '2024-10-30', 4);

-- --------------------------------------------------------

--
-- Table structure for table `fees`
--

CREATE TABLE `fees` (
  `student_id` int(20) NOT NULL,
  `class_id` int(20) NOT NULL,
  `amount` int(20) NOT NULL,
  `due_date` date NOT NULL,
  `status` varchar(100) NOT NULL,
  `fee_id` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fees`
--

INSERT INTO `fees` (`student_id`, `class_id`, `amount`, `due_date`, `status`, `fee_id`) VALUES
(10, 1, 5000, '2024-10-25', 'paid', 3),
(11, 1, 5000, '2024-11-29', 'pending', 4);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `notification_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `section_id` int(20) NOT NULL,
  `section_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`section_id`, `section_name`) VALUES
(1, 'A'),
(2, 'B');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `class_id` int(20) NOT NULL,
  `section_id` int(20) NOT NULL,
  `student_id` int(20) NOT NULL,
  `student_name` varchar(200) NOT NULL,
  `father_name` varchar(100) NOT NULL,
  `class_name` varchar(100) NOT NULL,
  `section_name` varchar(100) NOT NULL,
  `date_of_birth` date NOT NULL,
  `gender` varchar(100) NOT NULL,
  `address` varchar(500) NOT NULL,
  `phone` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `enrolled_date` date NOT NULL,
  `father_cnic` varchar(200) NOT NULL,
  `f_ph_number` varchar(200) NOT NULL,
  `student_bform` varchar(200) NOT NULL,
  `user_id` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`class_id`, `section_id`, `student_id`, `student_name`, `father_name`, `class_name`, `section_name`, `date_of_birth`, `gender`, `address`, `phone`, `email`, `enrolled_date`, `father_cnic`, `f_ph_number`, `student_bform`, `user_id`) VALUES
(2, 1, 7, 'Haseeb Tariq', 'Tariq', '', '', '2024-11-01', 'male', 'nsnababibiau', '987654321', 'tch787124@gmail.com', '2024-10-10', '12345678901234', '12345678910', '123456', 123),
(2, 2, 10, 'Adnan', 'Ahmad', '', '', '2024-10-03', 'male', 'Chak 45/12 Chichawatni', '98765432145', 'Adnan4824@gmail.com', '2024-10-25', '12345678901234', '923456789132', '123456789', 1245),
(1, 1, 11, 'Rehan', 'Aslam', '', '', '2018-07-12', 'male', 'Chak 45/12 Chichawatni, Sahiwal', '03065432123', 'rehan@gmail.com', '2024-10-16', '123445901234', '12345678910', '123456456', 123);

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `subject_id` int(20) NOT NULL,
  `subject_name` varchar(100) NOT NULL,
  `class_id` int(20) NOT NULL,
  `teacher_id` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`subject_id`, `subject_name`, `class_id`, `teacher_id`) VALUES
(1, 'Science', 1, 1),
(2, 'Mathematics', 2, 2),
(3, 'Urdu', 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `teacher_id` int(20) NOT NULL,
  `teacher_name` varchar(100) NOT NULL,
  `user_id` int(20) NOT NULL,
  `date_of_birth` date NOT NULL,
  `gender` varchar(30) NOT NULL,
  `address` varchar(200) NOT NULL,
  `phone` int(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `hire_date` date NOT NULL,
  `teacher_cnic` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`teacher_id`, `teacher_name`, `user_id`, `date_of_birth`, `gender`, `address`, `phone`, `email`, `hire_date`, `teacher_cnic`) VALUES
(1, 'Haseeb', 12, '2024-10-17', 'male', 'nsnababibiau', 987654321, 'haseebtariq4824@gmail.com', '2024-10-17', 2147483647),
(2, 'Arslan', 12334, '2024-10-24', 'male', 'Chak 45/12 Chichawatni', 2147483647, 'arslan566@gmail.com', '2024-10-25', 2147483647),
(3, 'Bilal Ahmed', 1245, '1998-10-24', 'male', 'Chak 45/12 Chichawatni, Sahiwal', 2147483647, 'bilalahmed@gmail.com', '2024-10-15', 2147483647);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`attendance_id`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`class_id`);

--
-- Indexes for table `enrollments`
--
ALTER TABLE `enrollments`
  ADD PRIMARY KEY (`enrollment_id`);

--
-- Indexes for table `exam_results`
--
ALTER TABLE `exam_results`
  ADD PRIMARY KEY (`result_id`);

--
-- Indexes for table `fees`
--
ALTER TABLE `fees`
  ADD PRIMARY KEY (`fee_id`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`section_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`subject_id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`teacher_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `attendance_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `class_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `enrollments`
--
ALTER TABLE `enrollments`
  MODIFY `enrollment_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `exam_results`
--
ALTER TABLE `exam_results`
  MODIFY `result_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `fees`
--
ALTER TABLE `fees`
  MODIFY `fee_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `section_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `student_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `subject_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `teacher_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
