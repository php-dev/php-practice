-- phpMyAdmin SQL Dump
-- version 3.1.3.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 20, 2012 at 01:59 PM
-- Server version: 5.1.33
-- PHP Version: 5.2.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `db_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_details`
--

CREATE TABLE IF NOT EXISTS `tbl_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL,
  `age` varchar(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tbl_details`
--

INSERT INTO `tbl_details` (`id`, `name`, `age`) VALUES
(4, 'safasdasd', 'sda'),
(3, 'anit', '12');
