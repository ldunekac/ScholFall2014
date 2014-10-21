-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 13, 2014 at 08:53 PM
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
-- Table structure for table `pets`
--

CREATE TABLE IF NOT EXISTS `pets` (
  `ID` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `age` int(11) NOT NULL,
  `pettype` varchar(45) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

/*

Display all pets
SELECT * FROM 'pets'

ID 	name 	age 	pettype
1 	Fluffy 	3		cat
2 	Fido	8		dog
3 	Fiona 	2 		turtle
4 	Felix 	10		cat
5 	Foobar 	4 		dog

--------------------------------------------------------

Display the name and ages of the cats

SELECT `name`, `age` FROM `pets` WHERE `pettype`='cat'

name 	age
Fluffy 	3
Feli 	10

--------------------------------------------------------

Display the number of dogs
SELECT COUNT('ID') FROM `pets` WHERE `pettype`='dog'

COUNT('ID')
2

--------------------------------------------------------

Change the turtle's name from "Fiona" to "Thomas"
UPDATE `pets` SET `name`='Thomas' WHERE `name`='Fiona' AND `pettype`='turtle'

--------------------------------------------------------
Remove "Foobar" from the table
DELETE FROM `pets` WHERE `name`='Foobar'

--------------------------------------------------------
Display all pets (will help to see if prior 2 queries worked)
SELECT * FROM 'pets'

ID 	name 	age 	pettype
1 	Fluffy 	3 		cat
2 	Fido 	8 		dog
3 	Thomas 	2 		turtle
4 	Fleix 	10 		cat


--------------------------------------------------------
Create two additional queries of your choice - just play!
SELECT `name`, `pettype` FROM `pets` WHERE `pettype`='cat' OR `pettype`='dog'

name 	pettype
Fluffy	cat
Fido 	dog
Felix 	cat

SELECT COUNT(`ID`) FROM `pets` WHERE `pettype`!='cat'

COUNT('ID')
2

*/


