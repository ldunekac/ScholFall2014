-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 13, 2014 at 11:13 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mysql`
--

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--
DROP TABLE IF EXISTS `authors`;
CREATE TABLE IF NOT EXISTS `authors` (
  `ID` int(11) NOT NULL,
  `first_name` varchar(45) NOT NULL,
  `last_name` varchar(45) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `authors`
--

INSERT INTO `authors` (`ID`, `first_name`, `last_name`) VALUES
(1, 'Edward', 'Wilson'),
(2, 'Stephen', 'Gould'),
(3, 'Larry', 'Laudan'),
(4, 'Richard', 'Feynman');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

--
-- Database: `mysql`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

DROP TABLE IF EXISTS `books`;
CREATE TABLE IF NOT EXISTS `books` (
  `ISBN` varchar(45) NOT NULL,
  `title` varchar(45) NOT NULL,
  `Author` int(11) DEFAULT NULL,
  PRIMARY KEY (`ISBN`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`ISBN`, `title`, `Author`) VALUES
('0-226-46949-2', 'Science and Relativism', 3),
('0-262-55025-3', 'Growing Artifical Societies', NULL),
('0-393-31047-7', 'The Diversity of Life', 1),
('0-517-70393-9', 'Dinosaur in a Haystack', 2),
('0-674-45490-1', 'The Insect Societies', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


/*
Do an inner join of the two tables.
ISBN 			title 					Author 	ID 	first_name 	last_name
0-393-31047-7 	The Diversity of Life 	1 		1 	Edward 		Wilson
0-674-45490-1	The Insect Societies 	1 		1 	Edward 		Wilson
0-517-70393-9	Dinosaur in a Haystack 	2 		2 	Stephen 	Gould
0-226-46949-2	Science and Relativism 	3 		3 	Larry 		Laudan

-------------------------------------------------------------------
Do an inner join but select only those books written by author #1 (i.e., Wilson).
ISBN 			title 					Author 	ID 	first_name 	last_name
0-393-31047-7 	The Diversity of Life 	1 		1 	Edward 		Wilson
0-674-45490-1	The Insect Societies 	1 		1 	Edward 		Wilson

Do an inner join but select only those books written by authors with the last name of 'Gould'. (i.e., select by author name, NOT author id).
SELECT `books`.ISBN, `books`.Title FROM `books` INNER JOIN `authors` ON `books`.author=`authors`.ID WHERE `authors`.last_name='Gould'

ISBN 			Title
0-517-70393-9 	Dinosaur in a Haystack

-------------------------------------------------------------------
Do a left join that shows all books along with author information (if any... note that some information will be NULL)
SELECT * FROM `books` LEFT JOIN `authors` ON `books`.author=`authors`.ID 

ISBN 			title 						Author 	ID 		first_name 	last_name
0-393-31047-7 	The Diversity of Life 		1 		1 		Edward 		Wilson
0-674-45490-1	The Insect Societies 		1 		1 		Edward 		Wilson
0-517-70393-9	Dinosaur in a Haystack 		2 		2 		Stephen 	Gould
0-226-46949-2	Science and Relativism 		3 		3 		Larry 		Laudan
0-262-55025-3 	Growing Artifical Societies	NULL	NULL 	NULL 		NULL


-------------------------------------------------------------------
Do a right join that shows all authors along with book information 

ISBN 			title 						Author 	ID 		first_name 	last_name
0-226-46949-2	Science and Relativism 		3 		3 		Larry 		Laudan
0-393-31047-7 	The Diversity of Life 		1 		1 		Edward 		Wilson
0-517-70393-9	Dinosaur in a Haystack 		2 		2 		Stephen 	Gould
0-674-45490-1	The Insect Societies 		1 		1 		Edward 		Wilson
NULL			NULL 						NULL	4 		Richard 	Feynman

-------------------------------------------------------------------
Do a join to display the first and last name of any authors who do not have any books
SELECT `authors`.first_name, `authors`.last_name FROM `books` RIGHT JOIN `authors` ON `books`.author=`authors`.ID WHERE `books`.author IS NULL

first_name 	last_name
Richard 	Feynman


*/