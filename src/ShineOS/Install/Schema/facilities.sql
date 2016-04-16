-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 25, 2016 at 03:25 AM
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
-- Table structure for table `facilities`
--

CREATE TABLE IF NOT EXISTS `facilities` (
`id` int(10) unsigned NOT NULL,
  `facility_id` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `facility_name` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `DOH_facility_code` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `phic_accr_id` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `phic_accr_date` date NOT NULL,
  `phic_benefit_package` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `phic_benefit_package_date` date NOT NULL,
  `ownership_type` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `facility_type` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `provider_type` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `bmonc_cmonc` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hospital_license_number` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `flag_allow_referral` varchar(1) COLLATE utf8_unicode_ci DEFAULT '0',
  `specializations` text COLLATE utf8_unicode_ci,
  `services` text COLLATE utf8_unicode_ci,
  `equipment` text COLLATE utf8_unicode_ci,
  `enabled_modules` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `enabled_plugins` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `facility_contact`
--

CREATE TABLE IF NOT EXISTS `facility_contact` (
`id` int(10) unsigned NOT NULL,
  `facilitycontact_id` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `facility_id` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `house_no` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `building_name` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `street_name` varchar(60) COLLATE utf8_unicode_ci DEFAULT '0',
  `village` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `barangay` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `province` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `region` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `zip` int(11) NOT NULL,
  `phone` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `mobile` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `email_address` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `website` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `flag_allow_referral` varchar(1) COLLATE utf8_unicode_ci DEFAULT '0',
  `bmonc_cmonc` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hospital_license_number` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `facility_patient_user`
--

CREATE TABLE IF NOT EXISTS `facility_patient_user` (
`id` int(10) unsigned NOT NULL,
  `facilitypatientuser_id` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `patient_id` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `facilityuser_id` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `facility_user`
--

CREATE TABLE IF NOT EXISTS `facility_user` (
`id` int(10) unsigned NOT NULL,
  `facilityuser_id` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `facility_id` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `featureroleuser_id` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `facilities`
--
ALTER TABLE `facilities`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `facilities_facility_id_unique` (`facility_id`);

--
-- Indexes for table `facility_contact`
--
ALTER TABLE `facility_contact`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `facility_contact_facilitycontact_id_unique` (`facilitycontact_id`), ADD KEY `facility_contact_facility_id_foreign` (`facility_id`);

--
-- Indexes for table `facility_patient_user`
--
ALTER TABLE `facility_patient_user`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `facility_patient_user_facilitypatientuser_id_unique` (`facilitypatientuser_id`), ADD KEY `facility_patient_user_patient_id_foreign` (`patient_id`), ADD KEY `facility_patient_user_facilityuser_id_foreign` (`facilityuser_id`);

--
-- Indexes for table `facility_user`
--
ALTER TABLE `facility_user`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `facility_user_facilityuser_id_unique` (`facilityuser_id`), ADD KEY `facility_user_user_id_foreign` (`user_id`), ADD KEY `facility_user_facility_id_foreign` (`facility_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `facilities`
--
ALTER TABLE `facilities`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `facility_contact`
--
ALTER TABLE `facility_contact`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `facility_patient_user`
--
ALTER TABLE `facility_patient_user`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `facility_user`
--
ALTER TABLE `facility_user`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=43;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `facility_contact`
--
ALTER TABLE `facility_contact`
ADD CONSTRAINT `facility_contact_facility_id_foreign` FOREIGN KEY (`facility_id`) REFERENCES `facilities` (`facility_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `facility_patient_user`
--

--
-- Constraints for table `facility_user`
--
ALTER TABLE `facility_user`
ADD CONSTRAINT `facility_user_facility_id_foreign` FOREIGN KEY (`facility_id`) REFERENCES `facilities` (`facility_id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `facility_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
