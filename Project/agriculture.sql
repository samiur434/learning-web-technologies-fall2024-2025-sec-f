-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 23, 2025 at 07:54 PM
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
-- Database: `agriculture`
--

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `category` varchar(255) NOT NULL,
  `module` varchar(255) DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `title`, `description`, `category`, `module`, `duration`, `price`, `image`) VALUES
(1, 'Crop Rotation Techniques', 'Learn the best practices for rotating crops to maximize soil fertility, control pests, and improve crop yields. This course includes real-world examples and practical applications.', 'crop', 'Introduction', 5, 50.00, 'istockphoto-157182162-612x612.jpg'),
(2, 'Sustainable Farming Practices', 'Explore eco-friendly farming methods to maintain soil health and biodiversity. This course covers organic fertilizers, composting, and water conservation techniques.', 'crop', 'Intermediate', 7, 75.00, 'images.jpeg'),
(3, 'Livestock Care Basics', 'Essential care techniques for maintaining healthy livestock, including feeding routines, vaccination schedules, and disease prevention strategies.', 'livestock', 'Basics', 4, 40.00, 'istockphoto-157182162-612x612.jpg'),
(4, 'Dairy Farming Essentials', 'Master the art of dairy farming, including milk production processes, cattle health monitoring, and profitability strategies.', 'livestock', 'Essentials', 6, 60.00, NULL),
(5, 'Advanced Agri-Tech', 'Discover the latest technologies in agriculture, including precision farming, GPS-guided equipment, and AI applications for decision-making.', 'technology', 'Advanced', 10, 120.00, NULL),
(6, 'Smart Farming with IoT', 'Learn how the Internet of Things (IoT) is transforming agriculture with connected sensors, automated systems, and real-time data analysis.', 'technology', 'Technology', 12, 150.00, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `course_ratings`
--

CREATE TABLE `course_ratings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `comment` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course_ratings`
--

INSERT INTO `course_ratings` (`id`, `user_id`, `course_id`, `rating`, `comment`, `created_at`) VALUES
(1, 1, 1, 5, 'RECOMMENDED', '2025-01-17 15:28:15'),
(2, 1, 6, 5, 'great!!!!!!!!!!!', '2025-01-19 17:34:23');

-- --------------------------------------------------------

--
-- Table structure for table `enquiry`
--

CREATE TABLE `enquiry` (
  `Email` varchar(100) NOT NULL,
  `Discussion Area` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `enquiry`
--

INSERT INTO `enquiry` (`Email`, `Discussion Area`) VALUES
('samiurr434@gmail.com', 'My problem is not fixed yet'),
('samiurr434@gmail.com', 'dgdhbrehrehrtttttttttttttt'),
('samiurr434@gmail.com', 'dgdhbrehrehrtttttttttttttt jgndklgmlerhjeorlgk,d;lfgjmdrkltjerigtjiojgeriogjoerifjeriojerioferjfoierfjeriofjeriof'),
('samiurr434@gmail.com', 'i have a problem');

-- --------------------------------------------------------

--
-- Table structure for table `enrollments`
--

CREATE TABLE `enrollments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `enrollment_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `enrollments`
--

INSERT INTO `enrollments` (`id`, `user_id`, `course_id`, `enrollment_date`) VALUES
(33, 1, 1, '2025-01-17 14:58:09'),
(34, 1, 1, '2025-01-17 15:08:47'),
(35, 1, 1, '2025-01-17 15:12:11'),
(36, 2, 1, '2025-01-17 16:23:06'),
(37, 1, 6, '2025-01-19 15:24:53'),
(38, 1, 6, '2025-01-19 15:28:37'),
(39, 1, 6, '2025-01-19 15:41:26'),
(40, 1, 1, '2025-01-19 16:43:15'),
(0, 5, 1, '2025-01-20 08:28:30');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `feedback_text` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `user_id`, `feedback_text`, `created_at`, `updated_at`) VALUES
(4, 1, 'New Feedback ', '2025-01-15 09:37:42', '2025-01-15 09:37:42'),
(5, 1, 'New Feedback 2\r\n', '2025-01-15 09:37:54', '2025-01-15 09:37:54'),
(0, 7, 'Great Course!!', '2025-01-20 04:32:45', '2025-01-20 04:32:45');

-- --------------------------------------------------------

--
-- Table structure for table `leaderboard`
--

CREATE TABLE `leaderboard` (
  `rank` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `quiz` varchar(15) NOT NULL,
  `score` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `leaderboard`
--

INSERT INTO `leaderboard` (`rank`, `username`, `quiz`, `score`) VALUES
(1, 'samiur', 'farming', 50),
(2, 'jabid', 'agriculture', 60);

-- --------------------------------------------------------

--
-- Table structure for table `quiz`
--

CREATE TABLE `quiz` (
  `quizname` varchar(20) NOT NULL,
  `quiztype` varchar(10) NOT NULL,
  `timelimit` int(10) NOT NULL,
  `lastdate` date NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quiz`
--

INSERT INTO `quiz` (`quizname`, `quiztype`, `timelimit`, `lastdate`, `id`) VALUES
('Agriculture history', 'Broad ques', 100, '2025-01-31', 2),
('Agriculture man powe', 'MCQ', 10, '2024-12-30', 3),
('agriculture name', 'Short ques', 200, '2025-01-16', 7),
('agriculture types', 'Broad ques', 15, '2025-01-12', 12),
('agriculture types', 'Broad ques', 15, '2025-01-12', 13),
('agriculture types', 'Broad ques', 15, '2025-01-12', 14);

-- --------------------------------------------------------

--
-- Table structure for table `quizzes`
--

CREATE TABLE `quizzes` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `course_id` int(11) NOT NULL,
  `score` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quiz_scores`
--

CREATE TABLE `quiz_scores` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `quiz_id` int(11) DEFAULT NULL,
  `score` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `saved_courses`
--

CREATE TABLE `saved_courses` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `saved_courses`
--

INSERT INTO `saved_courses` (`id`, `user_id`, `course_id`) VALUES
(2, 1, 2),
(0, 1, 4),
(0, 1, 6);

-- --------------------------------------------------------

--
-- Table structure for table `support_tickets`
--

CREATE TABLE `support_tickets` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `subject` varchar(255) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `support_tickets`
--

INSERT INTO `support_tickets` (`id`, `title`, `message`, `created_at`, `subject`, `status`, `user_id`) VALUES
(1, 'Harvesting problem', 'Harvesting problem', '2025-01-15 06:56:20', NULL, NULL, NULL),
(2, 'Test Ticket', 'This is a test ticket.', '2025-01-19 17:14:42', NULL, NULL, 1),
(0, 'harvvesting', 'harvvesting problem', '2025-01-20 04:31:54', NULL, NULL, 7),
(0, 'harvvesting', 'harvvesting problem', '2025-01-20 04:31:55', NULL, NULL, 7),
(0, 'harvvesting', 'harvvesting problem', '2025-01-20 04:31:56', NULL, NULL, 7),
(0, 'harvvesting', 'harvvesting problem', '2025-01-20 04:31:56', NULL, NULL, 7);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `password` varchar(15) NOT NULL,
  `email` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `email`) VALUES
(5, 'imtiaz', 'samiur1234', 'samiurr434'),
(7, 'jabid', 'jabid123', 'samiurr434'),
(8, 'samiur', 'samiue@13', 'samiurr435'),
(11, 'rifat', 'rifat1234', 'tanvir@hot'),
(12, 'sakib', 'sakib123', 'samiurr435');

-- --------------------------------------------------------

--
-- Table structure for table `users_progress`
--

CREATE TABLE `users_progress` (
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `progress` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users_progress`
--

INSERT INTO `users_progress` (`id`, `username`, `progress`) VALUES
(1, 'samiur', 50),
(2, 'sakib', 100),
(3, 'arif', 75);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `leaderboard`
--
ALTER TABLE `leaderboard`
  ADD PRIMARY KEY (`rank`);

--
-- Indexes for table `quiz`
--
ALTER TABLE `quiz`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_progress`
--
ALTER TABLE `users_progress`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `leaderboard`
--
ALTER TABLE `leaderboard`
  MODIFY `rank` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `quiz`
--
ALTER TABLE `quiz`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users_progress`
--
ALTER TABLE `users_progress`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
