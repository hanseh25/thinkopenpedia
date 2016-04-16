-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 25, 2016 at 03:27 AM
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
-- Table structure for table `referrals`
--

CREATE TABLE IF NOT EXISTS `referrals` (
`id` int(10) unsigned NOT NULL,
  `referral_id` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `facility_id` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `healthcareservice_id` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `urgency` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `method_transport` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `management_done` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `medical_given` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `referral_remarks` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `referral_status` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `referral_messages`
--

CREATE TABLE IF NOT EXISTS `referral_messages` (
`id` int(10) unsigned NOT NULL,
  `referralmessage_id` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `referral_id` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `referral_subject` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `referral_message` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `referral_datetime` datetime NOT NULL,
  `referral_message_status` int(11) NOT NULL,
  `referrer` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `referral_reasons`
--

CREATE TABLE IF NOT EXISTS `referral_reasons` (
`id` int(10) unsigned NOT NULL,
  `referralreason_id` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `referral_id` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `lovreferralreason_id` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `referrals`
--
ALTER TABLE `referrals`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `referrals_referral_id_unique` (`referral_id`);

--
-- Indexes for table `referral_messages`
--
ALTER TABLE `referral_messages`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `referral_messages_referralmessage_id_unique` (`referralmessage_id`), ADD KEY `referral_messages_referral_id_foreign` (`referral_id`);

--
-- Indexes for table `referral_reasons`
--
ALTER TABLE `referral_reasons`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `referral_reasons_referralreason_id_unique` (`referralreason_id`), ADD KEY `referral_reasons_referral_id_foreign` (`referral_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `referrals`
--
ALTER TABLE `referrals`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `referral_messages`
--
ALTER TABLE `referral_messages`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `referral_reasons`
--
ALTER TABLE `referral_reasons`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `referral_messages`
--
ALTER TABLE `referral_messages`
ADD CONSTRAINT `referral_messages_referral_id_foreign` FOREIGN KEY (`referral_id`) REFERENCES `referrals` (`referral_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `referral_reasons`
--
ALTER TABLE `referral_reasons`
ADD CONSTRAINT `referral_reasons_referral_id_foreign` FOREIGN KEY (`referral_id`) REFERENCES `referrals` (`referral_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
