-- phpMyAdmin SQL Dump
-- version 2.11.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 04, 2012 at 02:54 PM
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

-- --------------------------------------------------------

--
-- Table structure for table `paymentmethod`
--

CREATE TABLE `paymentmethod` (
  `PaymentMethodId` int(3) NOT NULL,
  `PaymentMethod` text NOT NULL,
  PRIMARY KEY  (`PaymentMethodId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

-- --------------------------------------------------------

--
-- Table structure for table `roomprices`
--

CREATE TABLE `roomprices` (
  `RoomPriceId` int(3) NOT NULL,
  `RoomPrice` int(10) NOT NULL,
  PRIMARY KEY  (`RoomPriceId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

-- --------------------------------------------------------

--
-- Table structure for table `roomtypes`
--

CREATE TABLE `roomtypes` (
  `RoomTypeId` int(3) NOT NULL,
  `RoomType` text NOT NULL,
  PRIMARY KEY  (`RoomTypeId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
