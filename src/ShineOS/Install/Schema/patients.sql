-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 25, 2016 at 03:23 AM
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
-- Table structure for table `allergy_patient`
--

CREATE TABLE IF NOT EXISTS `allergy_patient` (
`id` int(10) unsigned NOT NULL,
  `allergy_patient_id` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `patient_alert_id` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `allergy_id` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `allergy_reaction_id` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `allergy_severity` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `disability_patient`
--

CREATE TABLE IF NOT EXISTS `disability_patient` (
`id` int(10) unsigned NOT NULL,
  `disability_patient_id` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `patient_alert_id` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `disability_id` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `disability_others` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE IF NOT EXISTS `patients` (
`id` int(10) unsigned NOT NULL,
  `patient_id` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `middle_name` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `maiden_lastname` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `maiden_middlename` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name_suffix` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gender` enum('F','M','U') COLLATE utf8_unicode_ci NOT NULL,
  `civil_status` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `birthdate` date NOT NULL,
  `birthtime` time NOT NULL,
  `birthplace` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `highest_education` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `highesteducation_others` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `religion` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `religion_others` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nationality` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `blood_type` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `birth_order` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `referral_notif` tinyint(1) NOT NULL,
  `broadcast_notif` tinyint(1) NOT NULL,
  `nonreferral_notif` tinyint(1) NOT NULL,
  `patient_consent` tinyint(1) NOT NULL,
  `myshine_acct` tinyint(1) NOT NULL,
  `age` int(11) NOT NULL,
  `photo_url` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patient_alert`
--

CREATE TABLE IF NOT EXISTS `patient_alert` (
`id` int(10) unsigned NOT NULL,
  `patient_alert_id` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `patient_id` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `alert_type` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `alert_type_other` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patient_contact`
--

CREATE TABLE IF NOT EXISTS `patient_contact` (
`id` int(10) unsigned NOT NULL,
  `patient_contact_id` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `patient_id` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `street_address` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `barangay` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `province` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `region` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `zip` int(11) NOT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone_ext` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mobile` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patient_death_info`
--

CREATE TABLE IF NOT EXISTS `patient_death_info` (
`id` int(10) unsigned NOT NULL,
  `patient_deathinfo_id` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `patient_id` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `causeofdeath` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `causeofdeath_notes` text COLLATE utf8_unicode_ci NOT NULL,
  `placeofdeath` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `datetime_death` datetime NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patient_emergencyinfo`
--

CREATE TABLE IF NOT EXISTS `patient_emergencyinfo` (
`id` int(10) unsigned NOT NULL,
  `patient_emergencyinfo_id` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `patient_id` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `emergency_name` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `emergency_relationship` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `emergency_phone` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `emergency_mobile` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `emergency_address` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patient_monitoring`
--

CREATE TABLE IF NOT EXISTS `patient_monitoring` (
`id` int(11) NOT NULL,
  `monitoring_id` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `patient_id` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `bloodpressure_systolic` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bloodpressure_diastolic` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bloodpressure_assessment` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `allergy_patient`
--
ALTER TABLE `allergy_patient`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `allergy_patient_allergy_patient_id_unique` (`allergy_patient_id`), ADD KEY `allergy_patient_patient_alert_id_foreign` (`patient_alert_id`);

--
-- Indexes for table `disability_patient`
--
ALTER TABLE `disability_patient`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `disability_patient_disability_patient_id_unique` (`disability_patient_id`), ADD KEY `disability_patient_patient_alert_id_foreign` (`patient_alert_id`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `patients_patient_id_unique` (`patient_id`);

--
-- Indexes for table `patient_alert`
--
ALTER TABLE `patient_alert`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `patient_alert_patient_alert_id_unique` (`patient_alert_id`), ADD KEY `patient_alert_patient_id_foreign` (`patient_id`);

--
-- Indexes for table `patient_contact`
--
ALTER TABLE `patient_contact`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `patient_contact_patient_contact_id_unique` (`patient_contact_id`), ADD KEY `patient_contact_patient_id_foreign` (`patient_id`);

--
-- Indexes for table `patient_death_info`
--
ALTER TABLE `patient_death_info`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `patient_death_info_patient_deathinfo_id_unique` (`patient_deathinfo_id`), ADD KEY `patient_death_info_patient_id_foreign` (`patient_id`);

--
-- Indexes for table `patient_emergencyinfo`
--
ALTER TABLE `patient_emergencyinfo`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `patient_emergencyinfo_patient_emergencyinfo_id_unique` (`patient_emergencyinfo_id`), ADD KEY `patient_emergencyinfo_patient_id_foreign` (`patient_id`);

--
-- Indexes for table `patient_monitoring`
--
ALTER TABLE `patient_monitoring`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `monitoring_id` (`monitoring_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `allergy_patient`
--
ALTER TABLE `allergy_patient`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `disability_patient`
--
ALTER TABLE `disability_patient`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `patient_alert`
--
ALTER TABLE `patient_alert`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `patient_contact`
--
ALTER TABLE `patient_contact`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `patient_death_info`
--
ALTER TABLE `patient_death_info`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `patient_emergencyinfo`
--
ALTER TABLE `patient_emergencyinfo`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `patient_monitoring`
--
ALTER TABLE `patient_monitoring`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `allergy_patient`
--
ALTER TABLE `allergy_patient`
ADD CONSTRAINT `allergy_patient_patient_alert_id_foreign` FOREIGN KEY (`patient_alert_id`) REFERENCES `patient_alert` (`patient_alert_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `disability_patient`
--
ALTER TABLE `disability_patient`
ADD CONSTRAINT `disability_patient_patient_alert_id_foreign` FOREIGN KEY (`patient_alert_id`) REFERENCES `patient_alert` (`patient_alert_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `patient_alert`
--
ALTER TABLE `patient_alert`
ADD CONSTRAINT `patient_alert_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`patient_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `patient_contact`
--
ALTER TABLE `patient_contact`
ADD CONSTRAINT `patient_contact_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`patient_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `patient_death_info`
--
ALTER TABLE `patient_death_info`
ADD CONSTRAINT `patient_death_info_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`patient_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `patient_emergencyinfo`
--
ALTER TABLE `patient_emergencyinfo`
ADD CONSTRAINT `patient_emergencyinfo_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`patient_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
