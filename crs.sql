-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 24, 2021 at 03:09 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crs`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `courseinfo` (IN `_classId` INT, IN `_id` INT)  NO SQL
BEGIN

SELECT classes.name,courses.id 'course id',courses.Name 'course name' from courses
INNER JOIN classes
WHERE classes.id=_classId and courses.class=_classId and courses.instructor=_id;


END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getCResouce` (IN `_classId` INT, IN `_c` INT)  NO SQL
BEGIN

IF _c=-1 THEN
SELECT resource.Name,resource.Path,resource.Date,courses.Name 'Course' FROM resource JOIN courses on    
resource.courseid=courses.id WHERE courses.class=_classId
ORDER by resource.Date DESC;

ELSE

SELECT resource.Name,resource.Path,resource.Date,courses.Name 'Course' FROM resource JOIN courses on     
resource.courseid=courses.id WHERE courses.id=_c and courses.class=_classId
ORDER by resource.Date DESC;

END If;




END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `login_sp` (IN `_username` VARCHAR(50) CHARSET utf8, IN `_password` VARCHAR(50) CHARSET utf8)  NO SQL
BEGIN

IF EXISTS(SELECT * FROM studentusers WHERE studentusers.username=_username and studentusers.password=_password) THEN
SELECT * FROM studentusers  WHERE studentusers.username=_username and studentusers.password=_password;
ELSEIF EXISTS(SELECT * FROM instructor WHERE instructor.username=_username AND instructor.password=_password) THEN
SELECT * FROM instructor WHERE instructor.username=_username AND instructor.password=_password ;
ELSE
SELECT 'Incorrect Username Or Password' as Message;
End IF;




END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `registerClass` (IN `_name` VARCHAR(50), IN `_tid` VARCHAR(50), IN `_coursename` VARCHAR(50), IN `_type` VARCHAR(50))  NO SQL
BEGIN

IF _type='join' THEN

set @instructors = (SELECT classes.instructor FROM classes WHERE classes.Id=_name);

UPDATE classes SET classes.instructor=CONCAT(@instructors,_tid,',')  where classes.Id=_name;

insert INTO courses(courses.Name,courses.class,courses.instructor) VALUES(_coursename,_name,_tid);

SELECT 'joined' as Message;

elseif _type='create' THEN

if EXISTS(SELECT * from classes WHERE classes.Name=_name) THEN
SELECT 'Class Exist' as Message;
ELSE
INSERT into classes(classes.Name,classes.instructor) VALUES(_name,CONCAT(_tid,','));

set @classid=(SELECT classes.Id FROM classes ORDER BY classes.Id DESC LIMIT 1);

INSERT into courses(courses.Name,courses.class,courses.instructor) VALUES(_coursename,@classid,_tid);

SELECT 'registered&joined' as Message;

end if;
ELSE
SELECT 'error' as Message;
end if;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `registerResource` (IN `name` VARCHAR(50), IN `path` VARCHAR(500), IN `courseid` INT(11))  NO SQL
BEGIN

INSERT into resource(resource.Name,resource.path,resource.courseid,resource.Date)
VALUES(name,path,courseid,CURRENT_DATE());
SELECT 'Registered' as message;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `register_user` (IN `_type` INT, IN `_username` VARCHAR(50), IN `_password` VARCHAR(50), IN `_uid` VARCHAR(50), IN `_class` VARCHAR(50))  NO SQL
BEGIN

IF _type=1 THEN
INSERT into instructor(instructor.username,instructor.password) VALUES(_username,_password);
SELECT 'lecturer' as Message;
ELSE
IF EXISTS(SELECT * FROM classes WHERE classes.Name=_class) THEN
set @classid = (SELECT classes.Id FROM classes WHERE classes.Name=_class);
IF EXISTS(SELECT * FROM studentusers WHERE studentusers.username=_username or studentusers.studentid=_uid) THEN
SELECT 'username or ID taken' as Message;
else
INSERT into studentusers(studentusers.username,studentusers.password,studentusers.studentid,studentusers.Class) VALUES(_username,_password,_uid,@classid);
end if;



SELECT 'student' as Message;
ELSE
SELECT 'not found' as Message;
END If;
END If;

END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `Id` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `instructor` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`Id`, `Name`, `instructor`) VALUES
(9, 'CA174', '5,7,'),
(10, 'CA171', '5,6,'),
(11, 'CA181', '6,'),
(12, 'CA1991', '8,');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `Name` varchar(40) NOT NULL,
  `instructor` int(11) NOT NULL,
  `class` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `Name`, `instructor`, `class`) VALUES
(22, 'Javascript', 5, 9),
(23, 'C#', 5, 10),
(24, 'SAAD', 6, 11),
(25, 'Flutter', 6, 10),
(26, 'Asp', 7, 9),
(27, 'DS', 8, 12);

-- --------------------------------------------------------

--
-- Table structure for table `instructor`
--

CREATE TABLE `instructor` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `type` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `instructor`
--

INSERT INTO `instructor` (`id`, `username`, `password`, `type`) VALUES
(5, 'naqib', '123', 1),
(6, 'naqibtech', '123', 1),
(7, 'mohamed', '123', 1),
(8, 'KZ123', '123', 1),
(9, 'admink', '123', 1);

-- --------------------------------------------------------

--
-- Table structure for table `resource`
--

CREATE TABLE `resource` (
  `id` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `path` varchar(500) NOT NULL,
  `courseid` int(11) NOT NULL,
  `Date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `resource`
--

INSERT INTO `resource` (`id`, `Name`, `path`, `courseid`, `Date`) VALUES
(22, 'Examples PT5 - WebView.pptx', '../Resources/CA174/Javascript/Examples PT5 - WebView.pptx', 22, '2020-11-02'),
(23, 'bootstrap.min.css', '../Resources/CA174/Javascript/bootstrap.min.css', 22, '2020-11-02'),
(24, 'bussincard1.zip', '../Resources/CA171/C#/bussincard1.zip', 23, '2020-11-02'),
(25, 'jadwal.docx', '../Resources/CA181/SAAD/jadwal.docx', 24, '2020-11-02'),
(26, 'social psychology muniiro.docx', '../Resources/CA171/Flutter/social psychology muniiro.docx', 25, '2020-11-02'),
(27, 'Answers.pdf', '../Resources/CA171/C#/Answers.pdf', 23, '2020-11-04'),
(28, 'Android Course Student List.docx', '../Resources/CA171/C#/Android Course Student List.docx', 23, '2020-11-04'),
(29, 'Classes.xlsx', '../Resources/CA174/Asp/Classes.xlsx', 26, '2020-11-04'),
(30, 'dashboard.zip', '../Resources/CA174/Asp/dashboard.zip', 26, '2020-11-04'),
(31, 'Hacking_Terminology.pdf', '../Resources/CA1991/DS/Hacking_Terminology.pdf', 27, '2021-01-05'),
(32, 'chapter2exercises.docx', '../Resources/CA1991/DS/chapter2exercises.docx', 27, '2021-01-05');

-- --------------------------------------------------------

--
-- Table structure for table `studentusers`
--

CREATE TABLE `studentusers` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(30) NOT NULL,
  `studentid` varchar(40) NOT NULL,
  `Class` int(11) NOT NULL,
  `type` int(11) NOT NULL DEFAULT 2
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `studentusers`
--

INSERT INTO `studentusers` (`id`, `username`, `password`, `studentid`, `Class`, `type`) VALUES
(11, 'moha', '123', 'C117147', 9, 2),
(12, 'ali', '555', 'c112121', 10, 2),
(13, 'apdykadir41@gmail.com ', 'apdykadir', 'C118048 ', 10, 2),
(14, 'ali1', '123', 'C1131212', 9, 2),
(15, 'naqibm', '123', 'C113125', 9, 2),
(16, 'hasaaan', '123', 'c13131', 10, 2),
(17, 'naqib', '123', 'C1171470', 9, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `Nameunique` (`Name`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `courseandclass` (`class`);

--
-- Indexes for table `instructor`
--
ALTER TABLE `instructor`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usernameunique` (`username`);

--
-- Indexes for table `resource`
--
ALTER TABLE `resource`
  ADD PRIMARY KEY (`id`),
  ADD KEY `resourcewithcourse` (`courseid`);

--
-- Indexes for table `studentusers`
--
ALTER TABLE `studentusers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usernameunique` (`username`),
  ADD UNIQUE KEY `studentid` (`studentid`),
  ADD KEY `studentwithClass` (`Class`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `instructor`
--
ALTER TABLE `instructor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `resource`
--
ALTER TABLE `resource`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `studentusers`
--
ALTER TABLE `studentusers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courseandclass` FOREIGN KEY (`class`) REFERENCES `classes` (`Id`);

--
-- Constraints for table `resource`
--
ALTER TABLE `resource`
  ADD CONSTRAINT `resourcewithcourse` FOREIGN KEY (`courseid`) REFERENCES `courses` (`id`);

--
-- Constraints for table `studentusers`
--
ALTER TABLE `studentusers`
  ADD CONSTRAINT `studentwithClass` FOREIGN KEY (`Class`) REFERENCES `classes` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
