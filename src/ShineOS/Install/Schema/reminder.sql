-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 25, 2016 at 03:28 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `shinedb`
--

-- --------------------------------------------------------

--
-- Table structure for table `reminders`
--

CREATE TABLE IF NOT EXISTS `reminders` (
`id` int(10) unsigned NOT NULL,
  `reminder_id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `facilityuser_id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `patient_id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `remindermessage_id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reminder_message`
--

CREATE TABLE IF NOT EXISTS `reminder_message` (
`id` int(10) unsigned NOT NULL,
  `remindermessage_id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `reminder_subject` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `reminder_message` text COLLATE utf8_unicode_ci NOT NULL,
  `appointment_datetime` datetime NOT NULL,
  `daysbeforesending` int(11) NOT NULL,
  `remindermessage_type` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `sent_status` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('1','2','3') COLLATE utf8_unicode_ci NOT NULL,
  `reminder_type` enum('1','2','3','4') COLLATE utf8_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `reminders`
--
ALTER TABLE `reminders`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `reminders_reminder_id_unique` (`reminder_id`), ADD KEY `reminders_remindermessage_id_foreign` (`remindermessage_id`);

--
-- Indexes for table `reminder_message`
--
ALTER TABLE `reminder_message`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `reminder_message_remindermessage_id_unique` (`remindermessage_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `reminders`
--
ALTER TABLE `reminders`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `reminder_message`
--
ALTER TABLE `reminder_message`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `reminders`
--
ALTER TABLE `reminders`
ADD CONSTRAINT `reminders_remindermessage_id_foreign` FOREIGN KEY (`remindermessage_id`) REFERENCES `reminder_message` (`remindermessage_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
