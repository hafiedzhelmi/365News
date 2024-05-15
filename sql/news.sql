-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 01, 2023 at 06:46 AM
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
-- Database: `news`
--

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

CREATE TABLE `article` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `image` blob DEFAULT NULL,
  `content` text DEFAULT NULL,
  `date` date DEFAULT NULL,
  `userid` int(11) DEFAULT NULL,
  `categoryid` int(11) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`id`, `title`, `image`, `content`, `date`, `userid`, `categoryid`, `timestamp`) VALUES
(8, 'babi', 0x55706c6f6164732f706f70636f726e62672e6a7067, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam accumsan consectetur tempor. In vestibulum tempor pellentesque. Donec sit amet tempor odio. Curabitur sagittis diam id elementum sollicitudin. Fusce ut felis semper, pulvinar eros ut, rutrum nisi. Pellentesque a erat lacinia, tincidunt nulla vel, facilisis orci. Maecenas et libero ut lectus molestie pulvinar.\r\n\r\nProin non diam ac quam tempus vestibulum. Nulla facilisi. Integer pretium eget leo ac sagittis. In hac habitasse platea dictumst. Nulla ipsum est, lacinia ut mauris non, efficitur condimentum lorem. Fusce elementum, lacus in ullamcorper hendrerit, mi libero tristique ante, eget dictum urna quam ut metus. Duis pulvinar, nisi ac ullamcorper laoreet, libero mi pellentesque lorem, eu facilisis turpis diam molestie ante. Nullam sagittis lorem in velit consectetur auctor. Mauris eu tortor non est ultrices scelerisque.\r\n\r\nDuis malesuada nulla sed tellus tincidunt sagittis. Donec vel dolor auctor, efficitur dolor a, posuere lacus. Etiam facilisis, tortor sit amet vehicula gravida, urna arcu ullamcorper quam, vitae maximus nisl urna et orci. Curabitur scelerisque fringilla augue vel tristique. Aliquam ut cursus nisl. Proin fermentum elementum maximus. Maecenas dictum nisi sit amet nunc pellentesque egestas. Nullam semper purus erat, non posuere ipsum aliquet sit amet. Nunc at mauris non dui venenatis eleifend ut ut est. Phasellus mattis eros aliquam justo viverra ullamcorper. Sed vehicula rhoncus risus, quis pellentesque lectus euismod eget.\r\n\r\nNam in convallis ex. Nulla sagittis lacus vitae quam aliquet lobortis. Aenean a nulla dolor. Cras ex urna, bibendum sit amet enim sed, congue tincidunt nulla. Ut egestas at ipsum eget vehicula. Pellentesque aliquam, erat a ultricies molestie, turpis neque vestibulum lectus, at congue eros odio vitae sapien. Interdum et malesuada fames ac ante ipsum primis in faucibus. Nunc porta odio porta, vehicula leo nec, scelerisque ipsum. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur pellentesque viverra diam vel pulvinar. Donec lobortis nibh felis, cursus malesuada ligula hendrerit eu. Pellentesque at arcu ut lectus ullamcorper dapibus sed id nisl. Maecenas tincidunt imperdiet vestibulum. Aliquam ac elementum ligula, in faucibus leo.\r\n\r\nPellentesque neque mauris, mollis at enim vel, dapibus auctor urna. Nullam purus neque, dictum ut dignissim eu, egestas ut augue. Phasellus iaculis eu purus vulputate luctus. Etiam tempus suscipit lectus, in hendrerit tellus tempus quis. Nunc blandit leo et lorem porta consectetur. Praesent lacus nibh, elementum vitae aliquet vitae, ultricies et dolor. Nunc pharetra lacus quis volutpat vestibulum. Nullam sit amet faucibus turpis. Donec tempor semper rutrum. Curabitur in metus euismod diam volutpat hendrerit. Morbi interdum lectus elit, blandit dignissim tortor luctus sit amet. Aliquam eget nulla augue. Aliquam hendrerit nisl vitae faucibus suscipit. Vivamus aliquet dictum mauris, at rhoncus felis tempor dignissim. Sed et condimentum eros. Nulla finibus quis magna at fringilla.', '2023-06-10', 1, 5, '2023-06-10 12:54:23'),
(9, 'article2', 0x55706c6f6164732f796f7574756265206472616d61207468756d626e61696c2e706e67, 'what is this contetesdflksfjlksdfjlkjlkfsdjlkfsdl; faggot', '2023-06-10', 1, 4, '2023-06-10 15:03:45'),
(11, 'LKSDJLFSDJIFJLKSEDFLK', 0x55706c6f6164732f576861747341707020496d61676520323032332d30342d30362061742031302e32382e30332e6a7067, 'U THOT I WAS FEELI\"N U? MUCNCHS', '2023-06-11', 1, 2, '2023-06-11 02:11:51'),
(12, 'sdlkflksdjlkfdlkjf', 0x55706c6f6164732f6e657773206572642e706e67, 'fuckckc', '2023-06-19', 2, 4, '2023-06-19 17:47:31'),
(13, 'LATEST ARTICLE', 0x55706c6f6164732f57494e5f32303233303430335f31365f32365f35375f50726f2e6a7067, 'dfsdjlkfjlkfdsjlkfsdsjlksdafjlk;sd lg sdfjlksdf jlksdflk;sdjfsdfaPRWJEREW0R3OIR3OROIEWOI2322#@#@#2', '2023-06-22', 1, 4, '2023-06-22 13:28:40');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `categoryid` int(11) NOT NULL,
  `categorytype` varchar(255) DEFAULT NULL,
  `categorydesc` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`categoryid`, `categorytype`, `categorydesc`) VALUES
(1, 'Politics', 'News related to politics'),
(2, 'Sports', 'News related to sports'),
(3, 'Entertainment', 'News related to entertainment'),
(4, 'Technology', 'News related to technology'),
(5, 'Business', 'News related to business');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userid` int(11) NOT NULL,
  `userpass` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `background` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `authority` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userid`, `userpass`, `name`, `background`, `username`, `authority`, `email`) VALUES
(1, 'password1', 'User 1', 'Background 1', 'user1', 'admin', 'mhafiedzhelmi@gmail.com'),
(2, 'password2', 'User 2', 'Background 2', 'user2', 'user', '2021619552@STUDENT.UITM.EDU.MY'),
(5, 'password5', 'User 5', 'Background 5', 'user5', NULL, NULL),
(6, 'emma', 'hafiedz helmi', NULL, 'emma', 'admin', 'hafiedzhelmi@gmail.com'),
(12, 'rando', 'rando', NULL, 'rando', 'reader', 'mahafiedzhelmi@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid` (`userid`),
  ADD KEY `categoryid` (`categoryid`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`categoryid`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userid`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `article`
--
ALTER TABLE `article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `categoryid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `article_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`),
  ADD CONSTRAINT `article_ibfk_2` FOREIGN KEY (`categoryid`) REFERENCES `category` (`categoryid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
