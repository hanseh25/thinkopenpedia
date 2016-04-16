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
-- Table structure for table `chest_xray`
--

CREATE TABLE IF NOT EXISTS `chest_xray` (
`id` int(10) unsigned NOT NULL,
  `chestxray_id` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `healthcareservice_id` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `scheduled_date` datetime NOT NULL,
  `actual_date` datetime NOT NULL,
  `xray_result` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `notes_remarks` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `diagnosis`
--

CREATE TABLE IF NOT EXISTS `diagnosis` (
`id` int(10) unsigned NOT NULL,
  `diagnosis_id` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `healthcareservice_id` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `diagnosislist_id` text COLLATE utf8_unicode_ci,
  `diagnosis_type` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `diagnosis_notes` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `diagnosis_icd10`
--

CREATE TABLE IF NOT EXISTS `diagnosis_icd10` (
`id` int(10) unsigned NOT NULL,
  `diagnosisicd10_id` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `diagnosis_id` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `icd10_classifications` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `icd10_subClassifications` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `icd10_type` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `icd10_code` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `disposition`
--

CREATE TABLE IF NOT EXISTS `disposition` (
`id` int(10) unsigned NOT NULL,
  `disposition_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `healthcareservice_id` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `disposition` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `discharge_condition` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `discharge_datetime` datetime NOT NULL,
  `discharge_notes` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `examination`
--

CREATE TABLE IF NOT EXISTS `examination` (
`id` int(10) unsigned NOT NULL,
  `examination_id` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `healthcareservice_id` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `Pallor` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `Rashes` varchar(48) COLLATE utf8_unicode_ci NOT NULL,
  `Jaundice` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `Good_Skin_Turgor` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `skin_others` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `Anicteric_Sclerae` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `Pupils` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `Aural_Discharge` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `Intact_Tympanic_Membrane` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `Nasal_Discharge` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `Tonsillopharyngeal_Congestion` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `Hypertrophic_Tonsils` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `Palpable_Mass_B` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `Exudates` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `heent_others` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `Symmetrical_Chest_Expansion` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `Clear_Breathsounds` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `Crackles_Rales` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `Wheezes` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `chest_others` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `Adynamic_Precordium` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `Rhythm` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `Heaves` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `Murmurs` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `heart_others` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `anatomy_heart_Others` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `Flat` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `Globular` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `Flabby` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `Muscle_Guarding` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `Tenderness` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `Palpable_Mass` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `abdomen_others` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `Normal_Gait` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `Full_Equal_Pulses` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `extreme_others` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `general_consultation`
--

CREATE TABLE IF NOT EXISTS `general_consultation` (
`id` int(10) unsigned NOT NULL,
  `generalconsultation_id` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `healthcareservice_id` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `medicalcategory_id` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `complaint` blob NOT NULL,
  `complaint_history` blob NOT NULL,
  `physical_examination` blob NOT NULL,
  `remarks` blob NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `healthcare_addendum`
--

CREATE TABLE IF NOT EXISTS `healthcare_addendum` (
`id` int(11) NOT NULL,
  `addendum_id` varchar(60) NOT NULL,
  `healthcareservice_id` varchar(60) NOT NULL,
  `addendum_notes` blob NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `healthcare_services`
--

CREATE TABLE IF NOT EXISTS `healthcare_services` (
`id` int(10) unsigned NOT NULL,
  `healthcareservice_id` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `facilitypatientuser_id` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `healthcareservicetype_id` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `consultation_type` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `encounter_type` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `parent_service_id` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `source_referrer_type` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `source_referrer` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `encounter_datetime` datetime NOT NULL,
  `seen_by` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lab_results`
--

CREATE TABLE IF NOT EXISTS `lab_results` (
`id` int(10) unsigned NOT NULL,
  `labresults_id` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `healthcareservice_id` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `labresult_type` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `filename` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `medicalorder`
--

CREATE TABLE IF NOT EXISTS `medicalorder` (
`id` int(10) unsigned NOT NULL,
  `medicalorder_id` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `healthcareservice_id` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `medicalorder_type` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `user_instructions` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `medicalorder_others` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `medicalorder_laboratoryexam`
--

CREATE TABLE IF NOT EXISTS `medicalorder_laboratoryexam` (
`id` int(10) unsigned NOT NULL,
  `medicalorderlaboratoryexam_id` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `medicalorder_id` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `laboratory_test_type` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `laboratory_test_type_others` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `medicalorder_prescription`
--

CREATE TABLE IF NOT EXISTS `medicalorder_prescription` (
`id` int(10) unsigned NOT NULL,
  `medicalorderprescription_id` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `medicalorder_id` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `generic_name` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `brand_name` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `dose_quantity` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `total_quantity` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `dosage_regimen` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `dosage_regimen_others` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `duration_of_intake` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `regimen_startdate` date NOT NULL,
  `regimen_enddate` date NOT NULL,
  `prescription_remarks` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `medicalorder_procedure`
--

CREATE TABLE IF NOT EXISTS `medicalorder_procedure` (
`id` int(10) unsigned NOT NULL,
  `medicalorderprocedure_id` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `medicalorder_id` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `procedure_order` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `procedure_date` datetime NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vital_physical`
--

CREATE TABLE IF NOT EXISTS `vital_physical` (
`id` int(10) unsigned NOT NULL,
  `vitalphysical_id` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `healthcareservice_id` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `bloodpressure_systolic` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bloodpressure_diastolic` varchar(48) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bloodpressure_assessment` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `heart_rate` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pulse_rate` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `respiratory_rate` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `temperature` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `height` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `weight` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `BMI_category` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `waist` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pregnant` tinyint(1) DEFAULT NULL,
  `weight_loss` tinyint(1) DEFAULT NULL,
  `with_intact_uterus` tinyint(1) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chest_xray`
--
ALTER TABLE `chest_xray`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `chest_xray_chestxray_id_unique` (`chestxray_id`), ADD KEY `chest_xray_healthcareservice_id_foreign` (`healthcareservice_id`);

--
-- Indexes for table `diagnosis`
--
ALTER TABLE `diagnosis`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `diagnosis_diagnosis_id_unique` (`diagnosis_id`), ADD KEY `diagnosis_healthcareservice_id_foreign` (`healthcareservice_id`);

--
-- Indexes for table `diagnosis_icd10`
--
ALTER TABLE `diagnosis_icd10`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `diagnosis_icd10_diagnosisicd10_id_unique` (`diagnosisicd10_id`);

--
-- Indexes for table `disposition`
--
ALTER TABLE `disposition`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `disposition_disposition_id_unique` (`disposition_id`);

--
-- Indexes for table `examination`
--
ALTER TABLE `examination`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `examination_examination_id_unique` (`examination_id`), ADD KEY `examination_healthcareservice_id_foreign` (`healthcareservice_id`);

--
-- Indexes for table `general_consultation`
--
ALTER TABLE `general_consultation`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `general_consultation_generalconsultation_id_unique` (`generalconsultation_id`), ADD KEY `general_consultation_healthcareservice_id_foreign` (`healthcareservice_id`), ADD KEY `general_consultation_medicalcategory_id_foreign` (`medicalcategory_id`);

--
-- Indexes for table `healthcare_addendum`
--
ALTER TABLE `healthcare_addendum`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `addendum_id` (`addendum_id`), ADD KEY `healthcareservice_id` (`healthcareservice_id`);

--
-- Indexes for table `healthcare_services`
--
ALTER TABLE `healthcare_services`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `healthcare_services_healthcareservice_id_unique` (`healthcareservice_id`), ADD KEY `healthcare_services_facilitypatientuser_id_foreign` (`facilitypatientuser_id`);

--
-- Indexes for table `lab_results`
--
ALTER TABLE `lab_results`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medicalorder`
--
ALTER TABLE `medicalorder`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `medicalorder_medicalorder_id_unique` (`medicalorder_id`), ADD KEY `medicalorder_healthcareservice_id_foreign` (`healthcareservice_id`);

--
-- Indexes for table `medicalorder_laboratoryexam`
--
ALTER TABLE `medicalorder_laboratoryexam`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `medicalorder_laboratoryexam_medicalorderlaboratoryexam_id_unique` (`medicalorderlaboratoryexam_id`), ADD KEY `medicalorder_laboratoryexam_medicalorder_id_foreign` (`medicalorder_id`);

--
-- Indexes for table `medicalorder_prescription`
--
ALTER TABLE `medicalorder_prescription`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `medicalorder_prescription_medicalorderprescription_id_unique` (`medicalorderprescription_id`), ADD KEY `medicalorder_prescription_medicalorder_id_foreign` (`medicalorder_id`);

--
-- Indexes for table `medicalorder_procedure`
--
ALTER TABLE `medicalorder_procedure`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `medicalorder_procedure_medicalorderprocedure_id_unique` (`medicalorderprocedure_id`), ADD KEY `medicalorder_procedure_medicalorder_id_foreign` (`medicalorder_id`);

--
-- Indexes for table `vital_physical`
--
ALTER TABLE `vital_physical`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `vital_physical_vitalphysical_id_unique` (`vitalphysical_id`), ADD KEY `vital_physical_healthcareservice_id_foreign` (`healthcareservice_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chest_xray`
--
ALTER TABLE `chest_xray`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `diagnosis`
--
ALTER TABLE `diagnosis`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `diagnosis_icd10`
--
ALTER TABLE `diagnosis_icd10`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `disposition`
--
ALTER TABLE `disposition`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `examination`
--
ALTER TABLE `examination`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `general_consultation`
--
ALTER TABLE `general_consultation`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `healthcare_addendum`
--
ALTER TABLE `healthcare_addendum`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `healthcare_services`
--
ALTER TABLE `healthcare_services`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `lab_results`
--
ALTER TABLE `lab_results`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `medicalorder`
--
ALTER TABLE `medicalorder`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `medicalorder_laboratoryexam`
--
ALTER TABLE `medicalorder_laboratoryexam`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `medicalorder_prescription`
--
ALTER TABLE `medicalorder_prescription`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `medicalorder_procedure`
--
ALTER TABLE `medicalorder_procedure`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `vital_physical`
--
ALTER TABLE `vital_physical`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `chest_xray`
--
ALTER TABLE `chest_xray`
ADD CONSTRAINT `chest_xray_healthcareservice_id_foreign` FOREIGN KEY (`healthcareservice_id`) REFERENCES `healthcare_services` (`healthcareservice_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `diagnosis`
--
ALTER TABLE `diagnosis`
ADD CONSTRAINT `diagnosis_healthcareservice_id_foreign` FOREIGN KEY (`healthcareservice_id`) REFERENCES `healthcare_services` (`healthcareservice_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `examination`
--
ALTER TABLE `examination`
ADD CONSTRAINT `examination_healthcareservice_id_foreign` FOREIGN KEY (`healthcareservice_id`) REFERENCES `healthcare_services` (`healthcareservice_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `general_consultation`
--
ALTER TABLE `general_consultation`
ADD CONSTRAINT `general_consultation_healthcareservice_id_foreign` FOREIGN KEY (`healthcareservice_id`) REFERENCES `healthcare_services` (`healthcareservice_id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `general_consultation_medicalcategory_id_foreign` FOREIGN KEY (`medicalcategory_id`) REFERENCES `lov_medicalcategory` (`medicalcategory_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `healthcare_services`
--
ALTER TABLE `healthcare_services`
ADD CONSTRAINT `healthcare_services_facilitypatientuser_id_foreign` FOREIGN KEY (`facilitypatientuser_id`) REFERENCES `facility_patient_user` (`facilitypatientuser_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `medicalorder`
--
ALTER TABLE `medicalorder`
ADD CONSTRAINT `medicalorder_healthcareservice_id_foreign` FOREIGN KEY (`healthcareservice_id`) REFERENCES `healthcare_services` (`healthcareservice_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `medicalorder_laboratoryexam`
--
ALTER TABLE `medicalorder_laboratoryexam`
ADD CONSTRAINT `medicalorder_laboratoryexam_medicalorder_id_foreign` FOREIGN KEY (`medicalorder_id`) REFERENCES `medicalorder` (`medicalorder_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `medicalorder_prescription`
--
ALTER TABLE `medicalorder_prescription`
ADD CONSTRAINT `medicalorder_prescription_medicalorder_id_foreign` FOREIGN KEY (`medicalorder_id`) REFERENCES `medicalorder` (`medicalorder_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `medicalorder_procedure`
--
ALTER TABLE `medicalorder_procedure`
ADD CONSTRAINT `medicalorder_procedure_medicalorder_id_foreign` FOREIGN KEY (`medicalorder_id`) REFERENCES `medicalorder` (`medicalorder_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `vital_physical`
--
ALTER TABLE `vital_physical`
ADD CONSTRAINT `vital_physical_healthcareservice_id_foreign` FOREIGN KEY (`healthcareservice_id`) REFERENCES `healthcare_services` (`healthcareservice_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
