 -- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Feb 23, 2016 at 06:30 PM
-- Server version: 5.5.42
-- PHP Version: 5.6.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `reorg-test`
--
CREATE DATABASE IF NOT EXISTS `reorg-test` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `reorg-test`;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2016_02_20_235057_make_payments_table', 1),
('2016_02_21_082434_make_upload_data_log', 1),
('2016_02_21_221853_make_variables', 2);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
CREATE TABLE IF NOT EXISTS `payments` (
  `record_id` int(11) NOT NULL,
  `physician_profile_id` int(11) NOT NULL,
  `teaching_hospital_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `physician_first_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `physician_middle_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `physician_last_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `recipient_primary_business_street_address_line1` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `recipient_primary_business_street_address_line2` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `recipient_city` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `recipient_state` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `recipient_zip_code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `physician_primary_type` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `physician_specialty` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `applicable_manufacturer_or_applicable_gpo_making_payment_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `applicable_manufacturer_or_applicable_gpo_making_payment_state` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `contextual_information` longtext COLLATE utf8_unicode_ci NOT NULL,
  `total_amount_of_payment_usdollars` decimal(12,2) NOT NULL,
  `date_of_payment` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `form_of_payment_or_transfer_of_value` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `nature_of_payment_or_transfer_of_value` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_of_associated_covered_drug_or_biological1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_of_associated_covered_drug_or_biological2` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_of_associated_covered_drug_or_biological3` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_of_associated_covered_drug_or_biological4` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_of_associated_covered_drug_or_biological5` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_of_associated_covered_device_or_medical_supply1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_of_associated_covered_device_or_medical_supply2` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_of_associated_covered_device_or_medical_supply3` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_of_associated_covered_device_or_medical_supply4` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_of_associated_covered_device_or_medical_supply5` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `payment_publication_date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



--
-- Table structure for table `upload_log`
--

DROP TABLE IF EXISTS `upload_log`;
CREATE TABLE IF NOT EXISTS `upload_log` (
  `id` int(10) unsigned NOT NULL,
  `start_record` int(11) NOT NULL,
  `last_record` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



--
-- Table structure for table `variables`
--

DROP TABLE IF EXISTS `variables`;
CREATE TABLE IF NOT EXISTS `variables` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=338 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


--

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`record_id`);

--
-- Indexes for table `upload_log`
--
ALTER TABLE `upload_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `last_record` (`last_record`);

--
-- Indexes for table `variables`
--
ALTER TABLE `variables`
  ADD PRIMARY KEY (`id`),
  ADD KEY `variables_name_index` (`name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `upload_log`
--
ALTER TABLE `upload_log`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `variables`
--
ALTER TABLE `variables`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=338;







CREATE USER 'dbUser'@'localhost' IDENTIFIED BY 'AxJGKXDaYvMdwK7v';GRANT ALL PRIVILEGES ON *.* TO 'dbUser'@'localhost' IDENTIFIED BY 'AxJGKXDaYvMdwK7v' REQUIRE NONE WITH GRANT OPTION MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0;