-- phpMyAdmin SQL Dump
-- version 2.11.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 04, 2012 at 02:51 PM
-- Server version: 5.0.51
-- PHP Version: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `hoteldb`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `CustomerId` int(3) NOT NULL auto_increment,
  `CustomerTitle` text NOT NULL,
  `Membership` text NOT NULL,
  `CustomerFName` text NOT NULL,
  `CustomerLName` text NOT NULL,
  `AddressTown` text NOT NULL,
  `AddressCountry` text NOT NULL,
  `AddressPostalCode` varchar(15) NOT NULL,
  `PhoneNumber1` varchar(15) NOT NULL,
  `PhoneNumber2` varchar(15) NOT NULL,
  `CustomerEmail` varchar(50) NOT NULL,
  `IdNumber` varchar(10) NOT NULL,
  `IdType` text NOT NULL,
  `PlateNumber` varchar(15) NOT NULL,
  `Status` text NOT NULL,
  `Date` varchar(15) NOT NULL,
  PRIMARY KEY  (`CustomerId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`CustomerId`, `CustomerTitle`, `Membership`, `CustomerFName`, `CustomerLName`, `AddressTown`, `AddressCountry`, `AddressPostalCode`, `PhoneNumber1`, `PhoneNumber2`, `CustomerEmail`, `IdNumber`, `IdType`, `PlateNumber`, `Status`, `Date`) VALUES
(1, 'Dr.', 'Yes', 'keith', 'Chirwa', 'chi', 'Malawi', 'box 5678', '99999999', '999345678', 'kay@yahoo.com', '65656', 'Driving License', 'none', 'Out', '2012 10 21 15 5'),
(2, 'Mr.', 'Yes', 'fina', 'chirwa', 'llz', 'Malawi', 'box 99 mz', '999123456', '999345678', 'fina@yahoo.com', '456789', 'Driving License', 'nm 756', 'Out', '2012 10 21 15 4'),
(3, 'Mr.', 'No', 'Tendai', 'Shaba', 'Chiwembe', 'Malawi', 'Box 7898 Bt', '265999354546', '265888345678', 'tex@yahoo.com', 'Mw 4567', 'Passport', 'NA 3892', 'Out', '2012 11 04 14 1'),
(4, 'Dr.', 'Yes', 'Jen', 'Richie', 'Ndixville', 'Malawi', 'P. O Box 99 Bt', '265999354546', '265888345678', 'jen@yahoo.com', '1234567', 'Driving License', 'MZ 900', 'In', ''),
(5, 'Mr.', 'Yes', 'John', 'Green', 'chichiri', 'Malawi', 'p o box 678 bt', '265999354546', '265888567765', 'john@yahoo.com', 'mw 23456', 'Passport', 'ZA 657', 'In', '');

-- --------------------------------------------------------

--
-- Table structure for table `guest`
--

CREATE TABLE `guest` (
  `GuestId` int(3) NOT NULL,
  `GuestTitle` text NOT NULL,
  `FirstName` text NOT NULL,
  `LastName` text NOT NULL,
  `AddressTown` text NOT NULL,
  `AddressPostalCode` varchar(20) NOT NULL,
  `AddressCountry` text NOT NULL,
  `PhoneNumber1` varchar(15) NOT NULL,
  `PhoneNumber2` varchar(15) NOT NULL,
  `GuestEmail` varchar(50) NOT NULL,
  PRIMARY KEY  (`GuestId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `guest`
--

INSERT INTO `guest` (`GuestId`, `GuestTitle`, `FirstName`, `LastName`, `AddressTown`, `AddressPostalCode`, `AddressCountry`, `PhoneNumber1`, `PhoneNumber2`, `GuestEmail`) VALUES
(4, 'Dr.', 'Jen', 'Richie', 'Ndixville', 'P. O Box 99 Bt', 'Malawi', '265999354546', '265888345678', 'jen@yahoo.com'),
(5, 'Mr.', 'John', 'Green', 'chichiri', 'p o box 678 bt', 'Malawi', '265999354546', '265888567765', 'john@yahoo.com');

-- --------------------------------------------------------

--
-- Table structure for table `paymentmethod`
--

CREATE TABLE `paymentmethod` (
  `PaymentMethodId` int(3) NOT NULL,
  `PaymentMethod` text NOT NULL,
  PRIMARY KEY  (`PaymentMethodId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `paymentmethod`
--

INSERT INTO `paymentmethod` (`PaymentMethodId`, `PaymentMethod`) VALUES
(1, 'Visa Card'),
(2, 'Cash');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `PaymentId` int(3) NOT NULL auto_increment,
  `CustomerId` int(3) NOT NULL,
  `PaymentMethodId` int(3) NOT NULL,
  `AmountPaid` int(10) NOT NULL,
  `Totalcost` int(10) NOT NULL,
  `Balance` int(10) NOT NULL,
  PRIMARY KEY  (`PaymentId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`PaymentId`, `CustomerId`, `PaymentMethodId`, `AmountPaid`, `Totalcost`, `Balance`) VALUES
(8, 1, 1, 40000, 40000, 0),
(9, 2, 2, 40000, 40000, 0),
(10, 3, 1, 40000, 40000, 0),
(11, 4, 2, 20000, 18000, 0),
(12, 5, 1, 30000, 30000, 0),
(13, 5, 1, 30000, 30000, 0),
(14, 5, 1, 30000, 30000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `ReservationId` int(4) NOT NULL auto_increment,
  `CustomerId` int(3) NOT NULL,
  `RoomNo` int(3) NOT NULL,
  `RoomType` text NOT NULL,
  `DateIn` varchar(10) NOT NULL,
  `DateOut` varchar(10) NOT NULL,
  `Duration` int(3) NOT NULL,
  `Month` text NOT NULL,
  `NoAdults` int(2) NOT NULL,
  `NoChildren` int(2) NOT NULL,
  PRIMARY KEY  (`ReservationId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`ReservationId`, `CustomerId`, `RoomNo`, `RoomType`, `DateIn`, `DateOut`, `Duration`, `Month`, `NoAdults`, `NoChildren`) VALUES
(2, 4, 14, 'Deluxe', '2012-11-04', '2012-11-04', 1, 'November', 1, 0),
(3, 5, 9, 'Family', '2012-11-04', '2012-11-05', 2, 'November', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `reservedrooms`
--

CREATE TABLE `reservedrooms` (
  `ReservationId` int(3) NOT NULL,
  `RoomNo` int(3) NOT NULL,
  `GuestId` int(3) NOT NULL,
  PRIMARY KEY  (`ReservationId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reservedrooms`
--

INSERT INTO `reservedrooms` (`ReservationId`, `RoomNo`, `GuestId`) VALUES
(2, 14, 4),
(3, 9, 5);

-- --------------------------------------------------------

--
-- Table structure for table `roomprices`
--

CREATE TABLE `roomprices` (
  `RoomPriceId` int(3) NOT NULL,
  `RoomPrice` int(10) NOT NULL,
  PRIMARY KEY  (`RoomPriceId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roomprices`
--

INSERT INTO `roomprices` (`RoomPriceId`, `RoomPrice`) VALUES
(1, 10000),
(2, 12000),
(3, 15000),
(4, 18000);

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `RoomNo` int(3) NOT NULL,
  `RoomTypeId` int(3) NOT NULL,
  `RoomPriceId` int(3) NOT NULL,
  `Available` text NOT NULL,
  PRIMARY KEY  (`RoomNo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`RoomNo`, `RoomTypeId`, `RoomPriceId`, `Available`) VALUES
(1, 1, 1, 'No'),
(2, 1, 1, 'Yes'),
(3, 1, 1, 'Yes'),
(4, 1, 1, 'Yes'),
(5, 2, 2, 'Yes'),
(6, 2, 2, 'Yes'),
(7, 2, 2, 'yes'),
(8, 2, 2, 'Yes'),
(9, 3, 3, 'No'),
(10, 3, 3, 'Yes'),
(11, 3, 3, 'Yes'),
(12, 3, 3, 'Yes'),
(13, 3, 3, 'Yes'),
(14, 4, 4, 'No'),
(15, 4, 4, 'Yes'),
(16, 4, 4, 'Yes'),
(17, 4, 4, 'Yes'),
(18, 4, 4, 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `roomtypes`
--

CREATE TABLE `roomtypes` (
  `RoomTypeId` int(3) NOT NULL,
  `RoomType` text NOT NULL,
  PRIMARY KEY  (`RoomTypeId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roomtypes`
--

INSERT INTO `roomtypes` (`RoomTypeId`, `RoomType`) VALUES
(1, 'Single'),
(2, 'Double'),
(3, 'Family'),
(4, 'Deluxe');

-- --------------------------------------------------------

--
-- Table structure for table `sys_admins`
--

CREATE TABLE `sys_admins` (
  `admin_id` int(3) NOT NULL auto_increment,
  `First_name` text NOT NULL,
  `Last_name` text NOT NULL,
  `Email` varchar(50) NOT NULL,
  `login_alias` varchar(20) NOT NULL,
  `login_password` varchar(100) NOT NULL,
  `User_type` text NOT NULL,
  `accountStatus` text NOT NULL,
  PRIMARY KEY  (`admin_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `sys_admins`
--

INSERT INTO `sys_admins` (`admin_id`, `First_name`, `Last_name`, `Email`, `login_alias`, `login_password`, `User_type`, `accountStatus`) VALUES
(8, 'Kay', 'Cece', 'kay@sytec.com', 'admin', 'e2a7106f1cc8bb1e1318df70aa0a3540', 'Administrator', '');

-- --------------------------------------------------------

--
-- Table structure for table `sys_users`
--

CREATE TABLE `sys_users` (
  `User_id` int(3) NOT NULL auto_increment,
  `First_name` text NOT NULL,
  `Last_name` text NOT NULL,
  `Email` varchar(50) NOT NULL,
  `login_alias` varchar(15) NOT NULL,
  `login_password` varchar(100) NOT NULL,
  `User_type` text NOT NULL,
  `accountStatus` text NOT NULL,
  `Date` date NOT NULL,
  PRIMARY KEY  (`User_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `sys_users`
--

INSERT INTO `sys_users` (`User_id`, `First_name`, `Last_name`, `Email`, `login_alias`, `login_password`, `User_type`, `accountStatus`, `Date`) VALUES
(4, 'Fatu', 'Spliff', 'fatu@sytec.com', 'user', 'e2a7106f1cc8bb1e1318df70aa0a3540', 'Limited', '', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `users_login_stats`
--

CREATE TABLE `users_login_stats` (
  `user_stat_id` int(3) NOT NULL auto_increment,
  `User_id` int(3) NOT NULL,
  `login_stats` text NOT NULL,
  `date_time` varchar(30) NOT NULL,
  `logout_time` varchar(15) NOT NULL,
  PRIMARY KEY  (`user_stat_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=45 ;

--
-- Dumping data for table `users_login_stats`
--

INSERT INTO `users_login_stats` (`user_stat_id`, `User_id`, `login_stats`, `date_time`, `logout_time`) VALUES
(5, 2, '0', '2012 09 19 01 17 59', '2012 09 20 00 1'),
(6, 2, '1', '2012 09 19 01 18 03', ''),
(7, 2, '1', '2012 09 19 01 18 05', ''),
(8, 2, '1', '2012 09 19 01 18 08', ''),
(9, 2, '1', '2012 09 19 01 18 12', ''),
(10, 2, '1', '2012 09 19 01 18 13', ''),
(11, 2, '1', '2012 09 19 01 18 14', ''),
(12, 2, '1', '2012 09 19 01 18 16', ''),
(13, 2, '1', '2012 09 19 01 18 21', ''),
(14, 2, '1', '2012 09 20 00 11 54', ''),
(15, 2, '1', '2012 09 20 00 12 25', ''),
(16, 2, '1', '2012 09 20 00 13 03', ''),
(17, 2, '1', '2012 09 20 00 13 14', ''),
(18, 2, '1', '2012 09 20 00 13 16', ''),
(19, 2, '1', '2012 09 20 00 13 18', ''),
(20, 2, '1', '2012 09 20 00 13 20', ''),
(21, 2, '1', '2012 09 20 00 13 21', ''),
(22, 2, '1', '2012 09 20 00 13 23', ''),
(23, 2, '1', '2012 09 20 00 13 25', ''),
(24, 2, '1', '2012 09 20 00 13 28', ''),
(25, 2, '1', '2012 09 20 00 13 29', ''),
(26, 2, '1', '2012 09 20 00 13 38', ''),
(27, 2, '1', '2012 09 20 00 14 38', ''),
(28, 2, '1', '2012 09 20 00 14 55', ''),
(29, 2, '1', '2012 09 20 00 15 14', ''),
(30, 0, '1', '2012 09 21 18 41 57', ''),
(31, 0, '1', '2012 10 01 15 58 10', ''),
(32, 0, '1', '2012 10 01 15 59 54', ''),
(33, 0, '1', '2012 10 01 16 00 27', ''),
(34, 2, '1', '2012 10 01 16 09 18', ''),
(35, 2, '1', '2012 10 01 16 09 26', ''),
(36, 2, '1', '2012 10 01 16 12 12', ''),
(37, 2, '1', '2012 10 01 16 12 13', ''),
(38, 2, '1', '2012 10 01 16 12 16', ''),
(39, 0, '1', '2012 10 01 16 12 41', ''),
(40, 0, '1', '2012 10 01 16 13 24', ''),
(41, 0, '1', '2012 10 01 16 14 11', ''),
(42, 0, '1', '2012 10 01 19 54 01', ''),
(43, 0, '1', '2012 10 01 19 54 11', ''),
(44, 0, '1', '2012 10 01 19 54 26', '');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle`
--

CREATE TABLE `vehicle` (
  `Vehicle_id` int(11) NOT NULL auto_increment,
  `PlateNumber` varchar(15) NOT NULL,
  `Vehicle` text NOT NULL,
  `VehicleModel` text NOT NULL,
  PRIMARY KEY  (`Vehicle_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `vehicle`
--

INSERT INTO `vehicle` (`Vehicle_id`, `PlateNumber`, `Vehicle`, `VehicleModel`) VALUES
(1, 'CZ 784', 'Car', 'BMW'),
(2, 'mz 657', 'Car', 'Toyota'),
(3, 'NB 7865', 'Car', 'Toyota'),
(4, 'nm 9087', 'Car', 'benz'),
(5, 'none', 'none', 'none'),
(6, 'none', 'None', 'none'),
(7, 'none', 'None', 'none'),
(8, 'none', 'None', 'none'),
(9, 'none', 'None', 'none'),
(10, 'none', 'None', 'none'),
(11, 'none', 'None', 'none'),
(12, 'none', 'None', 'none'),
(13, 'none', 'None', 'none'),
(14, 'none', 'None', 'none'),
(15, 'none', 'None', 'none'),
(16, 'none', 'None', 'none'),
(17, 'none', 'None', 'none'),
(18, 'none', 'None', 'none'),
(19, 'none', 'None', 'none'),
(20, 'nm 9087', 'None', 'none'),
(21, 'none', 'None', 'none'),
(22, 'none', 'None', 'none'),
(23, 'nm 756', 'Car', 'bmw'),
(24, 'NA 3892', 'Car', 'Toyota'),
(25, 'MZ 900', 'Car', 'Toyota'),
(26, 'ZA 657', 'Car', 'Audi');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `guest`
--
ALTER TABLE `guest`
  ADD CONSTRAINT `guest_ibfk_1` FOREIGN KEY (`GuestId`) REFERENCES `customers` (`CustomerId`);

--
-- Constraints for table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservations_ibfk_1` FOREIGN KEY (`ReservationId`) REFERENCES `reservedrooms` (`ReservationId`) ON DELETE CASCADE ON UPDATE NO ACTION;
