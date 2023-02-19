-- phpMyAdmin SQL Dump
-- version 5.2.1-dev+20220704.3975e7bb9d
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 05, 2022 at 05:08 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quiz1db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `email` varchar(200) NOT NULL,
  `pwd` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `email`, `pwd`) VALUES
(1, 'admin6856@gmail.com', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `cid` int(11) NOT NULL,
  `cname` varchar(200) NOT NULL,
  `cdesc` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`cid`, `cname`, `cdesc`) VALUES
(2, 'C++ Language', 'C++ is a general-purpose programming language created by Bjarne Stroustrup as an extension of the C programming language, or \"C with Classes\".'),
(3, 'Python', 'pthon desc...'),
(4, 'JavaScript', 'This is a js description....');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `cid` int(11) NOT NULL,
  `qid` int(11) NOT NULL,
  `question` varchar(600) NOT NULL,
  `op1` varchar(200) NOT NULL,
  `op2` varchar(200) NOT NULL,
  `op3` varchar(200) NOT NULL,
  `op4` varchar(200) NOT NULL,
  `correct_ans` int(11) NOT NULL,
  `type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`cid`, `qid`, `question`, `op1`, `op2`, `op3`, `op4`, `correct_ans`, `type`) VALUES
(2, 1, 'In C/CPP Programming an uninitialized variable may have', 'Null value', 'Garbage value', 'Null String', 'Zero value', 2, 'easy'),
(2, 2, 'Can a Structure contain pointer to itself?', 'Yes', 'No', 'Compilation Error', 'Runtime Error', 1, 'medium'),
(2, 3, 'Which operator has highest precedence?', '=', '*', '++', '()', 4, 'easy'),
(2, 4, 'Which operator has highest precedence in * / % ?', '/', '*', '%', 'all have same precedence', 4, 'easy'),
(2, 5, 'Which part of memory is used for the allocation of local variables declared inside any function.', 'Heap', 'Stack', 'Address space', 'Depends on compiler', 2, 'medium'),
(2, 6, 'Can we typecast void * into int *?', 'Yes', 'No', 'Undefined', 'Depends on Compiler', 1, 'medium'),
(2, 8, 'What is output of below program?\r\n\r\nint main()\r\n{\r\n  int a=10;\r\n  int b,c;\r\n  b = a++;\r\n  c = a;\r\n  cout<<a<<b<<c;\r\n  return 0;\r\n}', '111111', '111011', '101011', '101010', 2, 'easy'),
(2, 10, 'In C++ Program, inline fuctions are expanded during ____', 'Compile Time', 'Run Time', 'Debug Time', 'Coding Time', 2, 'easy'),
(2, 11, 'Find the output of below program.\r\n\r\nint main()\r\n{\r\nfor(int i=1;i<=2;i++)\r\n{\r\nfor(int j=i;j<=2;j++)\r\ncout<<i<<\'#\';\r\n}\r\n}', '1#2#', '1#2#1#', '1#2#2#', '1#1#2#', 4, 'easy');

-- --------------------------------------------------------

--
-- Table structure for table `quiz_details`
--

CREATE TABLE `quiz_details` (
  `testid` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  `total_questions` int(11) NOT NULL,
  `duration_minutes` float NOT NULL,
  `correct_marks` float NOT NULL,
  `incorrect_marks` float NOT NULL,
  `passing_percentages` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `quiz_details`
--

INSERT INTO `quiz_details` (`testid`, `cid`, `total_questions`, `duration_minutes`, `correct_marks`, `incorrect_marks`, `passing_percentages`) VALUES
(1, 2, 4, 10, 1.5, -0.25, 35);

-- --------------------------------------------------------

--
-- Table structure for table `quiz_result`
--

CREATE TABLE `quiz_result` (
  `rid` int(11) NOT NULL,
  `testid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  `total_questions` int(11) NOT NULL,
  `correct_ans` int(11) NOT NULL,
  `incorrect_ans` int(11) NOT NULL,
  `marks` float NOT NULL,
  `percentage` float NOT NULL,
  `submit_time` datetime NOT NULL,
  `status` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `quiz_result`
--

INSERT INTO `quiz_result` (`rid`, `testid`, `uid`, `cid`, `total_questions`, `correct_ans`, `incorrect_ans`, `marks`, `percentage`, `submit_time`, `status`) VALUES
(171, 1, 1, 2, 4, 0, 2, -0.5, -8, '2022-04-06 12:04:00', 'fail');

-- --------------------------------------------------------

--
-- Table structure for table `user_register`
--

CREATE TABLE `user_register` (
  `uid` int(11) NOT NULL,
  `uname` varchar(100) NOT NULL,
  `uemail` varchar(200) NOT NULL,
  `upwd` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_register`
--

INSERT INTO `user_register` (`uid`, `uname`, `uemail`, `upwd`) VALUES
(1, 'Ankit Sahu', 'sahu6856@gmail.com', '123'),
(6, 'Ankit Kumar', 'hacker6856@gmail.com', '321');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`qid`);

--
-- Indexes for table `quiz_details`
--
ALTER TABLE `quiz_details`
  ADD PRIMARY KEY (`testid`);

--
-- Indexes for table `quiz_result`
--
ALTER TABLE `quiz_result`
  ADD PRIMARY KEY (`rid`);

--
-- Indexes for table `user_register`
--
ALTER TABLE `user_register`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `uemail` (`uemail`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `qid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `quiz_details`
--
ALTER TABLE `quiz_details`
  MODIFY `testid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `quiz_result`
--
ALTER TABLE `quiz_result`
  MODIFY `rid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=172;

--
-- AUTO_INCREMENT for table `user_register`
--
ALTER TABLE `user_register`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
