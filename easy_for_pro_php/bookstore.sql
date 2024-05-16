-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 03, 2024 at 08:29 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bookstore`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `book_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `publication_date` date NOT NULL,
  `isbn` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`book_id`, `title`, `author`, `publication_date`, `isbn`) VALUES
(1, 'harry potter1', 'j.k rolling', '2023-06-30', 's123'),
(2, 'Invisible man', 'adem smeth', '1999-01-02', 'p456'),
(3, 'Prem Katha', 'rubi', '1997-02-03', 'kl96'),
(4, 'To Kill a Mockingbird', 'Harper Lee', '2015-01-01', 'de34'),
(5, 'The Great Gatsby', 'F. Scott Fitzgerald', '2001-07-03', 'lp96'),
(6, 'The Lord of the Rings', 'J.R.R. Tolkien', '1995-11-03', 'po96');

-- --------------------------------------------------------

--
-- Table structure for table `book_formats`
--

CREATE TABLE `book_formats` (
  `book_id` int(11) NOT NULL,
  `format` enum('paperback','ebook','audiobook') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `book_formats`
--

INSERT INTO `book_formats` (`book_id`, `format`) VALUES
(1, 'paperback'),
(1, 'ebook'),
(2, 'paperback'),
(3, 'paperback'),
(3, 'audiobook'),
(4, 'paperback'),
(4, 'ebook'),
(5, 'ebook'),
(6, 'ebook'),
(6, 'audiobook');

-- --------------------------------------------------------

--
-- Table structure for table `book_reviews`
--

CREATE TABLE `book_reviews` (
  `review_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `reviewer_name` varchar(255) NOT NULL,
  `review` text NOT NULL,
  `rating` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `book_reviews`
--

INSERT INTO `book_reviews` (`review_id`, `book_id`, `reviewer_name`, `review`, `rating`) VALUES
(1, 1, 'pragya', 'nice book', 4),
(2, 1, 'Pooja', 'very good book', 5),
(3, 1, 'Rena', 'Nice story', 4),
(4, 2, 'Sam', 'Interesting book', 4),
(5, 2, 'Alex', 'Nice story', 4),
(6, 1, 'Anonymous', 'Superbook', 6),
(7, 1, 'Anonymous', 'super', NULL),
(8, 1, 'Anonymous', 'super se uper', NULL),
(9, 1, 'Anonymous', 'superrrrrr', NULL),
(10, 1, 'Anonymous', 'superrrrrr', NULL),
(11, 2, 'Anonymous', 'lol', NULL),
(12, 2, 'Anonymous', 'lol', NULL),
(13, 2, 'Anonymous', 'katarnaak', NULL),
(14, 1, 'Anonymous', 'great', NULL),
(15, 3, 'kyal', '', 3),
(16, 4, 'kathline', '', 4),
(17, 5, 'Anonymous', 'bravo', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`book_id`),
  ADD UNIQUE KEY `isbn` (`isbn`);

--
-- Indexes for table `book_formats`
--
ALTER TABLE `book_formats`
  ADD KEY `book_id` (`book_id`);

--
-- Indexes for table `book_reviews`
--
ALTER TABLE `book_reviews`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `book_id` (`book_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `book_reviews`
--
ALTER TABLE `book_reviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `book_formats`
--
ALTER TABLE `book_formats`
  ADD CONSTRAINT `book_formats_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`);

--
-- Constraints for table `book_reviews`
--
ALTER TABLE `book_reviews`
  ADD CONSTRAINT `book_reviews_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
