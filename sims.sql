-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 17, 2022 at 06:54 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sims`
--

-- --------------------------------------------------------

--
-- Table structure for table `actions`
--

CREATE TABLE `actions` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `actions`
--

INSERT INTO `actions` (`id`, `name`) VALUES
(1, 'add'),
(2, 'update'),
(3, 'delete'),
(4, 'read'),
(6, 'login'),
(7, 'logout'),
(8, 'update profile'),
(9, 'update account');

-- --------------------------------------------------------

--
-- Table structure for table `baranggays`
--

CREATE TABLE `baranggays` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Active',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `baranggays`
--

INSERT INTO `baranggays` (`id`, `name`, `code`, `status`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(52, 'Rizal', '034324', 'Active', 1, NULL, NULL, '2022-02-20 06:30:49', NULL, NULL),
(53, 'San Juan (Sipaway)', '543543', 'Active', 1, 1, NULL, '2022-02-20 06:31:02', '2022-03-18 01:08:20', NULL),
(54, 'Bagonbon', '45435', 'Active', 1, NULL, NULL, '2022-03-17 17:05:33', NULL, NULL),
(55, 'Buluangan', '45345', 'Active', 1, NULL, NULL, '2022-03-17 17:05:43', NULL, NULL),
(56, 'Codcod', '45345', 'Active', 1, NULL, NULL, '2022-03-17 17:05:54', NULL, NULL),
(57, 'Ermita (Sipaway)', '45345', 'Active', 1, NULL, NULL, '2022-03-17 17:06:05', NULL, NULL),
(58, 'Guadalupe', '435435', 'Active', 1, NULL, NULL, '2022-03-17 17:06:15', NULL, NULL),
(59, 'Nataban', '45435', 'Active', 1, NULL, NULL, '2022-03-17 17:06:31', NULL, NULL),
(60, 'Palampas', '435435', 'Active', 1, NULL, NULL, '2022-03-17 17:06:42', NULL, NULL),
(61, 'Barangay I (Poblacion)', '45435', 'Active', 1, NULL, NULL, '2022-03-17 17:06:49', NULL, NULL),
(62, 'Barangay II (Poblacion)', '5435', 'Active', 1, NULL, NULL, '2022-03-17 17:06:57', NULL, NULL),
(63, 'Barangay III (Poblacion)', '34324', 'Active', 1, NULL, NULL, '2022-03-17 17:07:06', NULL, NULL),
(64, 'Barangay IV (Poblacion)', '56546', 'Active', 1, NULL, NULL, '2022-03-17 17:07:14', NULL, NULL),
(65, 'Barangay V (Poblacion)', '45454', 'Active', 1, NULL, NULL, '2022-03-17 17:07:24', NULL, NULL),
(66, 'Barangay VI (Poblacion)', '4545', 'Active', 1, NULL, NULL, '2022-03-17 17:07:35', NULL, NULL),
(67, 'Prosperidad', '3434', 'Active', 1, NULL, NULL, '2022-03-17 17:07:42', NULL, NULL),
(68, 'Punao', '454545', 'Active', 1, NULL, NULL, '2022-03-17 17:07:54', NULL, NULL),
(69, 'Quezon', '343434', 'Active', 1, NULL, NULL, '2022-03-17 17:08:07', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `blood_types`
--

CREATE TABLE `blood_types` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Active',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blood_types`
--

INSERT INTO `blood_types` (`id`, `name`, `status`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(12, 'A', 'Active', 1, NULL, NULL, '2022-02-20 06:36:21', NULL, NULL),
(13, 'A+', 'Active', 1, NULL, NULL, '2022-02-20 06:36:25', NULL, NULL),
(14, 'B', 'Active', 1, NULL, NULL, '2022-02-20 06:36:28', NULL, NULL),
(15, 'B+', 'Active', 1, NULL, NULL, '2022-02-20 06:36:32', NULL, NULL),
(16, 'AB', 'Active', 1, NULL, NULL, '2022-02-20 06:36:37', NULL, NULL),
(17, 'O', 'Active', 1, NULL, NULL, '2022-02-20 06:36:41', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `business_permits`
--

CREATE TABLE `business_permits` (
  `id` int(11) NOT NULL,
  `permit_no` int(11) DEFAULT NULL,
  `issued_at` date NOT NULL,
  `expired_at` date NOT NULL,
  `company_id` int(11) NOT NULL,
  `payment_id` int(11) NOT NULL,
  `business_permit_signature_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `business_permit_inspections`
--

CREATE TABLE `business_permit_inspections` (
  `id` int(11) NOT NULL,
  `business_permit_id` int(11) NOT NULL,
  `rate` int(11) NOT NULL,
  `is_passed` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `business_permit_inspection_checklists`
--

CREATE TABLE `business_permit_inspection_checklists` (
  `id` int(11) NOT NULL,
  `checklist_id` int(11) NOT NULL,
  `business_permit_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='business_permit_inspection_checklists';

-- --------------------------------------------------------

--
-- Table structure for table `business_permit_signatures`
--

CREATE TABLE `business_permit_signatures` (
  `id` int(11) NOT NULL,
  `sanitary_inspector_id` int(11) NOT NULL,
  `sanitary_inspector_position` varchar(255) NOT NULL,
  `city_health_officer_id` int(11) NOT NULL,
  `city_health_officer_position` varchar(255) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cemeteries`
--

CREATE TABLE `cemeteries` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Active',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cemeteries`
--

INSERT INTO `cemeteries` (`id`, `name`, `address`, `status`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(12, 'Public Cemetery', ' FCJ7+JQV, San Carlos City, 6127 Negros Occidental', 'Active', 1, 1, NULL, '2022-02-22 03:56:09', '2022-03-18 01:12:09', NULL),
(13, 'Memorial Cemetery', 'Eco - Translink Hwy, San Carlos City, Negros Occidental', 'Active', 1, 1, NULL, '2022-02-22 03:56:18', '2022-03-18 01:12:32', NULL),
(17, 'San Carlos Memorial Park Inc.', 'Greenville highway brvy rizal, Greenvilke highway, San Carlos City, 6127 Negros Occidental', 'Active', 1, 1, NULL, '2022-02-28 14:53:02', '2022-03-18 01:11:35', NULL),
(18, 'Quezon Cemetery', 'C7Q5+2VX, San Carlos City, Negros Occidental', 'Active', 1, NULL, NULL, '2022-03-17 17:12:49', NULL, NULL),
(19, 'Medina Cemetery', 'Sitio Medina Barangay, San Carlos City', 'Active', 1, NULL, NULL, '2022-03-17 17:13:27', NULL, NULL),
(20, 'Tree Park Cemetery', 'F9VM+XR7, San Carlos City, Negros Occidental', 'Active', 1, NULL, NULL, '2022-03-17 17:13:45', NULL, NULL),
(21, 'Lagha, Cemetery', 'F6XW+H95, San Carlos City, Negros Occidental', 'Active', 1, NULL, NULL, '2022-03-17 17:14:11', NULL, NULL),
(22, 'Pilang Cemetery', 'Eco - Translink Hwy, San Carlos City, Negros Occidental', 'Active', 1, NULL, NULL, '2022-03-17 17:14:36', NULL, NULL),
(23, 'Palampas Private Cemetery', 'GCC5+V2J, San Carlos City, Negros Occidental', 'Active', 1, NULL, NULL, '2022-03-17 17:14:55', NULL, NULL),
(24, 'Ongbontic Private Cemetery', 'Unnamed Road, San Carlos City, Negros Occidental', 'Active', 1, NULL, NULL, '2022-03-17 17:15:17', NULL, NULL),
(25, 'Guadalupe Public Cemetery', 'F93G+Q78, San Carlos City, Negros Occidental', 'Active', 1, NULL, NULL, '2022-03-17 17:15:34', NULL, NULL),
(26, 'Sitio STO Nino Cemetery', ' C9H2+F9P, San Carlos City, Negros Occidental', 'Active', 1, NULL, NULL, '2022-03-17 17:15:54', NULL, NULL),
(27, 'St. Peter Chapels - San Carlos', 'San Carlos City, Negros, 6127 Negros Occidental', 'Active', 1, NULL, NULL, '2022-03-17 17:16:36', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `checklists`
--

CREATE TABLE `checklists` (
  `id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Active',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `checklists`
--

INSERT INTO `checklists` (`id`, `description`, `status`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'sss', 'Inactive', 1, 1, 1, '2022-03-06 05:57:12', '2022-03-06 14:10:08', '2022-03-06 14:11:23'),
(2, 'MAINTENANCE OF PREMISES', 'Active', 1, 1, NULL, '2022-03-06 06:09:16', '2022-03-17 15:04:58', NULL),
(3, 'TOILET PROVISION', 'Active', 1, 1, NULL, '2022-03-06 13:19:26', '2022-03-17 15:05:16', NULL),
(4, 'HANDWASHING FACILITIES', 'Active', 1, 1, NULL, '2022-03-06 13:19:32', '2022-03-17 15:06:00', NULL),
(5, 'WATER SUPPLY', 'Active', 1, 1, NULL, '2022-03-06 13:19:38', '2022-03-17 15:07:02', NULL),
(6, 'LIQUID WASTE MANAGEMENT', 'Active', 1, 1, NULL, '2022-03-06 13:19:46', '2022-03-17 15:07:18', NULL),
(7, 'CONTRUCTION OF PREMISES', 'Active', 1, 1, NULL, '2022-03-15 14:15:52', '2022-03-17 15:05:04', NULL),
(8, 'SOLID WASTE MANAGEMENT', 'Active', 1, NULL, NULL, '2022-03-17 07:07:33', NULL, NULL),
(9, 'WHOLESOMENESS OF FOOD', 'Active', 1, NULL, NULL, '2022-03-17 07:08:00', NULL, NULL),
(10, 'PROTECTION OF FOOD', 'Active', 1, NULL, NULL, '2022-03-17 07:08:11', NULL, NULL),
(11, 'VERMIN CONTROL', 'Active', 1, NULL, NULL, '2022-03-17 07:08:25', NULL, NULL),
(12, 'CLEANLINESS AND TIDINESS', 'Active', 1, NULL, NULL, '2022-03-17 07:08:42', NULL, NULL),
(13, 'PERSONAL CLEANLINESS', 'Active', 1, NULL, NULL, '2022-03-17 07:08:59', NULL, NULL),
(14, 'HOUSEKEEPING AND MANAGEMENT', 'Active', 1, NULL, NULL, '2022-03-17 07:09:12', NULL, NULL),
(15, 'CONDITIONS OF APPLIANCES AND UTENSILS', 'Active', 1, NULL, NULL, '2022-03-17 07:09:37', NULL, NULL),
(16, 'SAN, CONDITIONS OF APPLIANCES AND UTENSILS', 'Active', 1, NULL, NULL, '2022-03-17 07:10:57', NULL, NULL),
(17, 'DISEASE CONTROL', 'Active', 1, NULL, NULL, '2022-03-17 07:11:06', NULL, NULL),
(18, 'MISCELLANEOUS', 'Active', 1, NULL, NULL, '2022-03-17 07:11:34', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `citizenships`
--

CREATE TABLE `citizenships` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Active',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `citizenships`
--

INSERT INTO `citizenships` (`id`, `name`, `status`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(10, 'Filipino', 'Active', 1, NULL, NULL, '2022-02-20 06:34:07', NULL, NULL),
(11, 'American', 'Active', 1, NULL, NULL, '2022-02-20 06:34:13', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `civil_statuses`
--

CREATE TABLE `civil_statuses` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Active',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `civil_statuses`
--

INSERT INTO `civil_statuses` (`id`, `name`, `status`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(9, 'Single', 'Active', 1, NULL, NULL, '2022-02-20 06:34:21', NULL, NULL),
(10, 'Merried', 'Active', 1, NULL, NULL, '2022-02-20 06:34:25', NULL, NULL),
(11, 'Widowed', 'Active', 1, NULL, NULL, '2022-03-17 17:18:16', NULL, NULL),
(12, 'Separated', 'Active', 1, NULL, NULL, '2022-03-17 17:18:24', NULL, NULL),
(13, 'Divorced', 'Active', 1, NULL, NULL, '2022-03-17 17:18:31', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `establishment_id` int(11) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `contact_no` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Active',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `name`, `establishment_id`, `owner`, `contact_no`, `email`, `address`, `status`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(18, 'Xyla Monroe', 12, 'John Doe', '06786586578', 'micix@mailinator.com', 'Eiusmod unde exercit', 'Active', 1, 1, NULL, '2022-02-25 16:18:25', '2022-03-18 01:24:29', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `complaints`
--

CREATE TABLE `complaints` (
  `id` int(11) NOT NULL,
  `statement` varchar(255) NOT NULL,
  `incident_address` varchar(255) NOT NULL,
  `action_taken` varchar(255) NOT NULL,
  `date_incident` date NOT NULL,
  `date_reported` date NOT NULL,
  `complainant_id` int(11) NOT NULL,
  `respondent_id` int(11) NOT NULL,
  `person_involved_id` int(11) NOT NULL,
  `complaint_type_id` int(11) NOT NULL,
  `complaint_status_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `complaint_statuses`
--

CREATE TABLE `complaint_statuses` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Active',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `complaint_statuses`
--

INSERT INTO `complaint_statuses` (`id`, `name`, `status`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(8, 'Settled', 'Default', 1, 1, NULL, '2022-02-20 06:32:42', '2022-02-20 14:32:48', NULL),
(9, 'Unsettled', 'Default', 1, 1, NULL, '2022-02-20 06:32:55', '2022-02-20 14:33:12', NULL),
(10, 'Pending', 'Active', 1, NULL, NULL, '2022-02-20 06:33:06', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `complaint_types`
--

CREATE TABLE `complaint_types` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Active',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `complaint_types`
--

INSERT INTO `complaint_types` (`id`, `name`, `status`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(10, 'Feces', 'Active', 1, NULL, NULL, '2022-02-20 06:32:34', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `educational_attainments`
--

CREATE TABLE `educational_attainments` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Active',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `educational_attainments`
--

INSERT INTO `educational_attainments` (`id`, `name`, `status`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(6, 'Elementary', 'Active', 1, NULL, NULL, '2022-02-20 06:36:03', NULL, NULL),
(7, 'Secondary', 'Active', 1, NULL, NULL, '2022-02-20 06:36:09', NULL, NULL),
(8, 'College', 'Active', 1, NULL, NULL, '2022-02-20 06:36:15', NULL, NULL),
(9, 'Vocational', 'Active', 1, NULL, NULL, '2022-03-17 17:10:04', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `establishments`
--

CREATE TABLE `establishments` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Active',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `establishments`
--

INSERT INTO `establishments` (`id`, `name`, `status`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(12, 'Bar', 'Active', 1, 1, NULL, '2022-02-22 04:06:17', '2022-03-18 01:19:32', NULL),
(13, 'Public House', 'Active', 1, 1, 2, '2022-02-22 04:06:21', '2022-03-18 01:19:21', NULL),
(14, 'Nightclub', 'Active', 1, 1, NULL, '2022-02-22 04:06:26', '2022-03-18 01:19:11', NULL),
(15, 'Membership clubs', 'Active', 1, NULL, NULL, '2022-03-17 17:19:40', NULL, NULL),
(16, 'Bed and Breakfast', 'Active', 1, NULL, NULL, '2022-03-17 17:19:48', NULL, NULL),
(17, 'One to Five Star Hotels', 'Active', 1, NULL, NULL, '2022-03-17 17:19:55', NULL, NULL),
(18, 'Budget hotels', 'Active', 1, NULL, NULL, '2022-03-17 17:20:02', NULL, NULL),
(19, 'Fast food', 'Active', 1, NULL, NULL, '2022-03-17 17:20:08', NULL, NULL),
(20, 'Cafes and coffee shops', 'Active', 1, NULL, NULL, '2022-03-17 17:20:14', NULL, NULL),
(21, 'Fine Dining', 'Active', 1, NULL, NULL, '2022-03-17 17:20:21', NULL, NULL),
(22, 'Chain restaurant', 'Active', 1, NULL, NULL, '2022-03-17 17:20:28', NULL, NULL),
(23, 'Non commercial Establishments', 'Active', 1, NULL, NULL, '2022-03-17 17:20:35', NULL, NULL),
(24, 'Commercial Establishments', 'Active', 1, NULL, NULL, '2022-03-17 17:20:43', NULL, NULL),
(25, 'Local establishments', 'Active', 1, NULL, NULL, '2022-03-17 17:20:49', NULL, NULL),
(26, 'National Establishments', 'Active', 1, NULL, NULL, '2022-03-17 17:20:55', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `exhumation_certificates`
--

CREATE TABLE `exhumation_certificates` (
  `id` int(11) NOT NULL,
  `name_of_deceased` varchar(255) NOT NULL,
  `cause_of_death` varchar(255) NOT NULL,
  `death_at` datetime NOT NULL,
  `issued_at` datetime NOT NULL,
  `relationship_id` int(11) NOT NULL,
  `civil_status_id` int(11) NOT NULL,
  `citizenship_id` int(11) NOT NULL,
  `resident_id` int(11) NOT NULL,
  `exhumation_certificate_signature_id` int(11) NOT NULL,
  `payment_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `exhumation_certificate_signatures`
--

CREATE TABLE `exhumation_certificate_signatures` (
  `id` int(11) NOT NULL,
  `city_health_officer_position` varchar(255) NOT NULL,
  `city_health_officer_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `deleted_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fees`
--

CREATE TABLE `fees` (
  `id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `amount` double(10,2) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fees`
--

INSERT INTO `fees` (`id`, `type`, `name`, `amount`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Permits', 'Sanitary Permits', 1000.00, 1, 1, NULL, '2022-03-04 18:47:48', '2022-03-18 01:04:00', NULL),
(2, 'Permits', 'Business Permits', 1000.00, 1, 1, NULL, '2022-03-06 02:47:56', '2022-03-18 01:03:37', NULL),
(3, 'Certificates', 'Medical Certificates', 500.00, 1, 1, NULL, '2022-03-06 02:48:52', '2022-03-06 10:54:17', NULL),
(4, 'Certificates', 'Exhumation Certificates', 200.00, 1, 1, NULL, '2022-03-06 02:49:17', '2022-03-18 01:03:52', NULL),
(5, 'Certificates', 'Transfer of Cadaver', 200.00, 1, 1, NULL, '2022-03-06 02:49:35', '2022-03-18 01:04:05', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `genders`
--

CREATE TABLE `genders` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Active',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `genders`
--

INSERT INTO `genders` (`id`, `name`, `status`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(10, 'Male', 'Default', 1, NULL, NULL, '2022-02-20 06:34:44', NULL, NULL),
(11, 'Female', 'Default', 1, NULL, NULL, '2022-02-20 06:34:48', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `health_certificates`
--

CREATE TABLE `health_certificates` (
  `id` int(11) NOT NULL,
  `issued_at` date NOT NULL,
  `register_no` int(11) DEFAULT NULL,
  `place_of_work` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `street_building_house` varchar(255) NOT NULL,
  `purok_id` int(11) NOT NULL,
  `baranggay_id` int(11) NOT NULL,
  `occupation_id` int(11) NOT NULL,
  `gender_id` int(11) NOT NULL,
  `civil_status_id` int(11) NOT NULL,
  `resident_id` int(11) NOT NULL,
  `health_certificate_signature_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `health_certificate_signatures`
--

CREATE TABLE `health_certificate_signatures` (
  `id` int(11) NOT NULL,
  `sanitary_inspector_id` int(11) NOT NULL,
  `sanitary_inspector_position` varchar(255) NOT NULL,
  `city_health_officer_id` int(11) NOT NULL,
  `city_health_officer_position` varchar(255) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `health_officials`
--

CREATE TABLE `health_officials` (
  `id` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `suffix` varchar(255) DEFAULT NULL,
  `license_no` varchar(255) NOT NULL,
  `birth_date` date NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact_no` varchar(255) NOT NULL,
  `street_building_house` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Active',
  `position_id` int(11) NOT NULL,
  `gender_id` int(11) NOT NULL,
  `civil_status_id` int(11) NOT NULL,
  `purok_id` int(11) NOT NULL,
  `baranggay_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `health_officials`
--

INSERT INTO `health_officials` (`id`, `image`, `first_name`, `middle_name`, `last_name`, `suffix`, `license_no`, `birth_date`, `email`, `contact_no`, `street_building_house`, `status`, `position_id`, `gender_id`, `civil_status_id`, `purok_id`, `baranggay_id`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '2022-03-18-01-53-45-623375a92b56c.png', 'Admin', 'T.', 'Test', NULL, '12321321', '1999-12-27', 'peza.app@gmail.com', '06786586578', 'Bug-as', 'Active', 10, 10, 9, 36, 53, 2, 1, NULL, '2022-02-25 15:40:13', '2022-02-28 16:09:20', NULL),
(2, '2022-03-18-01-46-29-623373f5eb7f6.png', 'ROMEO', 'GOMEZ', 'AGRAVIADOR', 'M.D.', '2321321', '1979-10-19', 'nygasob@mailinator.com', '08734543543', 'Sapiente quo iure in', 'Active', 12, 10, 10, 34, 53, 1, 1, NULL, '2022-03-04 09:34:36', '2022-03-18 01:46:29', NULL),
(3, '2022-03-18-01-46-51-6233740be6c6f.png', 'VIRGILIO', 'F.', 'TAN', 'M.D', '0111748', '1987-02-13', 'nygasob@mailinator.com', '07893465435435', 'Facilis autem vel et', 'Active', 12, 10, 10, 34, 53, 1, 1, NULL, '2022-03-17 16:44:44', '2022-03-18 01:46:51', NULL),
(4, '2022-03-18-01-46-38-623373fe848d2.png', 'ELIAKIM', 'U.', 'LASCO', '', '2321323414543', '1903-04-09', 'qekoxoq@mailinator.com', '08734543543', 'Sapiente quo iure in', 'Active', 13, 10, 9, 34, 53, 1, 1, NULL, '2022-03-17 16:50:01', '2022-03-18 01:46:38', NULL),
(5, '2022-03-18-01-46-45-62337405aefef.png', 'ARNEL', 'Q.', 'LAURENCE', 'M.D.', '', '2022-03-01', 'qekoxoq@mailinator.com', '08734543543', 'Sapiente quo iure in', 'Active', 14, 10, 9, 34, 52, 1, 1, NULL, '2022-03-17 16:53:32', '2022-03-18 01:46:45', NULL),
(6, NULL, 'JESSA', 'M.', 'TIAPON', 'M.D.', '2321321343', '1970-01-01', 'fokasejuk@mailinator.com', '0873S4543543', 'Facilis autem vel et', 'Active', 15, 11, 9, 34, 52, 1, 1, NULL, '2022-03-17 16:59:51', '2022-03-18 01:00:32', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `requests` longtext NOT NULL,
  `ip` varchar(255) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `module_id` int(11) NOT NULL,
  `action_id` int(11) NOT NULL,
  `record_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `medical_certificates`
--

CREATE TABLE `medical_certificates` (
  `id` int(11) NOT NULL,
  `gender_id` int(11) NOT NULL,
  `age` int(11) NOT NULL,
  `fit_for` varchar(255) NOT NULL,
  `blood_pressure` varchar(255) NOT NULL,
  `weight` int(11) NOT NULL,
  `height` int(11) NOT NULL,
  `issued_at` date NOT NULL,
  `street_building_house` varchar(255) NOT NULL,
  `baranggay_id` int(11) NOT NULL,
  `purok_id` int(11) NOT NULL,
  `civil_status_id` int(11) NOT NULL,
  `resident_id` int(11) NOT NULL,
  `medical_officer_id` int(11) NOT NULL,
  `payment_id` int(11) NOT NULL,
  `medical_certificate_signature_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `medical_certificate_signatures`
--

CREATE TABLE `medical_certificate_signatures` (
  `id` int(11) NOT NULL,
  `city_health_officer_position` varchar(255) NOT NULL,
  `city_health_officer_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `id` int(11) NOT NULL,
  `code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `code`, `name`) VALUES
(1, 'use', 'users'),
(2, 'bar', 'barangays'),
(3, 'pur', 'puroks'),
(4, 'cot', 'complaint types'),
(5, 'cos', 'complaint statuses'),
(6, 'cit', 'citizenship'),
(7, 'cis', 'civil statuses'),
(8, 'occ', 'occupations'),
(9, 'gen', 'genders'),
(10, 'rel', 'relationships'),
(11, 'ped', 'persons disabilities'),
(12, 'eda', 'educational attainments'),
(13, 'blt', 'blood types'),
(14, 'cem', 'cemeteries'),
(15, 'est', 'establishments'),
(16, 'res', 'residents'),
(17, 'heo', 'health officials'),
(18, 'compa', 'companies'),
(19, 'compl', 'complaints'),
(20, 'sap', 'sanitary permits'),
(21, 'bup', 'business permits'),
(22, 'hec', 'health certificates'),
(23, 'mec', 'medical certificates'),
(24, 'exc', 'exhumation certificates'),
(25, 'trc', 'transfer cadavers'),
(26, 'sig', 'signatures'),
(27, 'fee', 'fees'),
(28, 'che', 'checklist'),
(29, 'sac', 'sanitary checklists');

-- --------------------------------------------------------

--
-- Table structure for table `occupations`
--

CREATE TABLE `occupations` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Active',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `occupations`
--

INSERT INTO `occupations` (`id`, `name`, `status`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(6, 'NURSE', 'Active', 1, 1, NULL, '2022-02-20 06:34:31', '2022-03-18 00:55:11', NULL),
(7, 'DOCTOR', 'Active', 1, 1, NULL, '2022-02-20 06:34:36', '2022-03-18 00:54:54', NULL),
(10, 'ADMINISTRATOR', 'Active', 1, 1, NULL, '2022-02-27 11:48:44', '2022-03-18 00:55:03', NULL),
(11, 'MEDICAL OFFICER IVM', 'Active', 1, 1, NULL, '2022-03-17 16:42:40', '2022-03-18 00:54:25', NULL),
(12, 'MEDICAL OFFICER IV', 'Active', 1, 1, NULL, '2022-03-17 16:45:18', '2022-03-18 00:54:42', NULL),
(13, 'SANITARY INSPECTOR - OIC', 'Active', 1, 1, NULL, '2022-03-17 16:50:39', '2022-03-18 00:54:13', NULL),
(14, 'CITY HEALTH OFFICER', 'Active', 1, NULL, NULL, '2022-03-17 16:54:02', NULL, NULL),
(15, 'MEDICAL OFFICER III', 'Active', 1, NULL, NULL, '2022-03-17 17:00:20', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `or_no` varchar(255) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `paid_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `person_disabilities`
--

CREATE TABLE `person_disabilities` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Active',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `person_disabilities`
--

INSERT INTO `person_disabilities` (`id`, `name`, `status`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(7, 'None', 'Default', 1, NULL, NULL, '2022-02-20 06:35:48', NULL, NULL),
(8, 'Blindeness', 'Active', 1, NULL, NULL, '2022-02-20 06:35:55', NULL, NULL),
(11, 'Low vision', 'Active', 1, NULL, NULL, '2022-02-26 09:05:36', NULL, NULL),
(12, 'Dwarfism', 'Active', 1, NULL, NULL, '2022-02-26 09:05:40', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `puroks`
--

CREATE TABLE `puroks` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Active',
  `baranggay_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `puroks`
--

INSERT INTO `puroks` (`id`, `name`, `status`, `baranggay_id`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(34, 'Purok 2', 'Active', 52, 1, NULL, NULL, '2022-02-20 06:31:23', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `relationships`
--

CREATE TABLE `relationships` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Active',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `relationships`
--

INSERT INTO `relationships` (`id`, `name`, `status`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(7, 'Mother', 'Active', 1, NULL, NULL, '2022-02-20 06:34:54', NULL, NULL),
(8, 'Sister', 'Active', 1, 1, 2, '2022-02-20 06:34:58', '2022-02-27 19:45:59', NULL),
(9, 'Brother', 'Active', 2, 1, 2, '2022-02-25 05:18:06', '2022-02-27 19:45:55', NULL),
(10, 'Father', 'Active', 2, NULL, NULL, '2022-02-25 07:16:11', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `residents`
--

CREATE TABLE `residents` (
  `id` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `national_id` varchar(255) NOT NULL,
  `voter_status` varchar(255) NOT NULL,
  `birth_date` date NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact_no` varchar(255) NOT NULL,
  `street_building_house` varchar(255) NOT NULL,
  `weight` int(11) DEFAULT NULL,
  `height` int(11) DEFAULT NULL,
  `monthly_income` decimal(10,2) DEFAULT NULL,
  `skills` varchar(255) DEFAULT NULL,
  `total_household_member` int(11) DEFAULT NULL,
  `land_ownerships` varchar(255) DEFAULT NULL,
  `house_ownerships` varchar(255) DEFAULT NULL,
  `water_usages` varchar(255) DEFAULT NULL,
  `lighting_facilities` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Active',
  `civil_status_id` int(11) NOT NULL,
  `person_disability_id` int(11) NOT NULL,
  `gender_id` int(11) NOT NULL,
  `position_id` int(11) NOT NULL,
  `citizenship_id` int(11) NOT NULL,
  `baranggay_id` int(11) NOT NULL,
  `purok_id` int(11) NOT NULL,
  `blood_type_id` int(11) NOT NULL,
  `educational_attainment_id` int(11) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `residents`
--

INSERT INTO `residents` (`id`, `image`, `first_name`, `middle_name`, `last_name`, `national_id`, `voter_status`, `birth_date`, `email`, `contact_no`, `street_building_house`, `weight`, `height`, `monthly_income`, `skills`, `total_household_member`, `land_ownerships`, `house_ownerships`, `water_usages`, `lighting_facilities`, `status`, `civil_status_id`, `person_disability_id`, `gender_id`, `position_id`, `citizenship_id`, `baranggay_id`, `purok_id`, `blood_type_id`, `educational_attainment_id`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(24, '2022-02-27-08-31-48-621b6f3409be2.png', 'John', 'T.', 'Doe', '45435435', 'Active', '1996-07-27', 'wyqyju@mailinator.com', 'Rerum iste dolore do', 'Facilis autem vel et', 95, 61, '576.00', 'Quidem quos minus of', 71, 'Ea sint minus facil', 'Sed distinctio Rem ', 'Dolorem consectetur ', 'Accusantium exercita', 'Active', 10, 7, 10, 7, 10, 53, 34, 13, 6, 1, 1, NULL, '2022-02-26 07:29:09', '2022-03-18 01:25:05', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sanitary_checklists`
--

CREATE TABLE `sanitary_checklists` (
  `id` int(11) NOT NULL,
  `satisfaction_from` int(11) NOT NULL,
  `satisfaction_to` int(11) NOT NULL,
  `very_satisfaction_from` int(11) NOT NULL,
  `very_satisfaction_to` int(11) NOT NULL,
  `excelent_from` int(11) NOT NULL,
  `excelent_to` int(11) NOT NULL,
  `module_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sanitary_checklists`
--

INSERT INTO `sanitary_checklists` (`id`, `satisfaction_from`, `satisfaction_to`, `very_satisfaction_from`, `very_satisfaction_to`, `excelent_from`, `excelent_to`, `module_id`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 50, 59, 60, 89, 90, 100, 20, 1, 1, NULL, '2022-03-06 06:23:04', '2022-03-17 18:05:15', NULL),
(2, 50, 69, 70, 89, 90, 100, 21, 1, 1, NULL, '2022-03-06 14:41:47', '2022-03-18 00:10:35', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sanitary_checklist_assigns`
--

CREATE TABLE `sanitary_checklist_assigns` (
  `id` int(11) NOT NULL,
  `sanitary_checklist_id` int(11) NOT NULL,
  `checklist_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sanitary_checklist_assigns`
--

INSERT INTO `sanitary_checklist_assigns` (`id`, `sanitary_checklist_id`, `checklist_id`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(538, 1, 12, 1, NULL, NULL, '2022-03-17 10:05:15', NULL, NULL),
(539, 1, 7, 1, NULL, NULL, '2022-03-17 10:05:15', NULL, NULL),
(540, 1, 17, 1, NULL, NULL, '2022-03-17 10:05:15', NULL, NULL),
(541, 1, 4, 1, NULL, NULL, '2022-03-17 10:05:15', NULL, NULL),
(542, 1, 14, 1, NULL, NULL, '2022-03-17 10:05:15', NULL, NULL),
(543, 1, 6, 1, NULL, NULL, '2022-03-17 10:05:15', NULL, NULL),
(544, 1, 2, 1, NULL, NULL, '2022-03-17 10:05:15', NULL, NULL),
(545, 1, 18, 1, NULL, NULL, '2022-03-17 10:05:15', NULL, NULL),
(546, 1, 13, 1, NULL, NULL, '2022-03-17 10:05:15', NULL, NULL),
(547, 1, 10, 1, NULL, NULL, '2022-03-17 10:05:15', NULL, NULL),
(548, 1, 16, 1, NULL, NULL, '2022-03-17 10:05:15', NULL, NULL),
(549, 1, 8, 1, NULL, NULL, '2022-03-17 10:05:15', NULL, NULL),
(550, 1, 3, 1, NULL, NULL, '2022-03-17 10:05:15', NULL, NULL),
(551, 1, 11, 1, NULL, NULL, '2022-03-17 10:05:15', NULL, NULL),
(552, 1, 5, 1, NULL, NULL, '2022-03-17 10:05:15', NULL, NULL),
(553, 1, 9, 1, NULL, NULL, '2022-03-17 10:05:15', NULL, NULL),
(554, 2, 17, 1, NULL, NULL, '2022-03-17 16:10:35', NULL, NULL),
(555, 2, 4, 1, NULL, NULL, '2022-03-17 16:10:35', NULL, NULL),
(556, 2, 14, 1, NULL, NULL, '2022-03-17 16:10:35', NULL, NULL),
(557, 2, 6, 1, NULL, NULL, '2022-03-17 16:10:35', NULL, NULL),
(558, 2, 2, 1, NULL, NULL, '2022-03-17 16:10:35', NULL, NULL),
(559, 2, 18, 1, NULL, NULL, '2022-03-17 16:10:35', NULL, NULL),
(560, 2, 13, 1, NULL, NULL, '2022-03-17 16:10:35', NULL, NULL),
(561, 2, 10, 1, NULL, NULL, '2022-03-17 16:10:35', NULL, NULL),
(562, 2, 16, 1, NULL, NULL, '2022-03-17 16:10:35', NULL, NULL),
(563, 2, 8, 1, NULL, NULL, '2022-03-17 16:10:35', NULL, NULL),
(564, 2, 3, 1, NULL, NULL, '2022-03-17 16:10:35', NULL, NULL),
(565, 2, 11, 1, NULL, NULL, '2022-03-17 16:10:35', NULL, NULL),
(566, 2, 5, 1, NULL, NULL, '2022-03-17 16:10:35', NULL, NULL),
(567, 2, 9, 1, NULL, NULL, '2022-03-17 16:10:35', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sanitary_permits`
--

CREATE TABLE `sanitary_permits` (
  `id` int(11) NOT NULL,
  `permit_no` int(11) DEFAULT NULL,
  `issued_at` date NOT NULL,
  `expired_at` date NOT NULL,
  `company_id` int(11) NOT NULL,
  `payment_id` int(11) NOT NULL,
  `sanitary_permit_signature_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sanitary_permit_inspections`
--

CREATE TABLE `sanitary_permit_inspections` (
  `id` int(11) NOT NULL,
  `sanitary_permit_id` int(11) NOT NULL,
  `rate` int(11) NOT NULL,
  `is_passed` int(11) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sanitary_permit_inspection_checklists`
--

CREATE TABLE `sanitary_permit_inspection_checklists` (
  `id` int(11) NOT NULL,
  `checklist_id` int(11) NOT NULL,
  `sanitary_permit_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sanitary_permit_signatures`
--

CREATE TABLE `sanitary_permit_signatures` (
  `id` int(11) NOT NULL,
  `sanitary_inspector_id` int(11) NOT NULL,
  `sanitary_inspector_position` varchar(255) NOT NULL,
  `city_health_officer_id` int(11) NOT NULL,
  `city_health_officer_position` varchar(255) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `signatures`
--

CREATE TABLE `signatures` (
  `id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `si_signature_type` varchar(255) DEFAULT NULL,
  `si_signature` varchar(255) DEFAULT NULL,
  `si_position` varchar(255) DEFAULT NULL,
  `sanitary_inspector_id` int(11) DEFAULT NULL,
  `cho_signature_type` varchar(255) DEFAULT NULL,
  `cho_signature` varchar(255) DEFAULT NULL,
  `cho_position` varchar(255) DEFAULT NULL,
  `city_health_officer_id` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `signatures`
--

INSERT INTO `signatures` (`id`, `type`, `name`, `si_signature_type`, `si_signature`, `si_position`, `sanitary_inspector_id`, `cho_signature_type`, `cho_signature`, `cho_position`, `city_health_officer_id`, `updated_by`, `deleted_by`, `updated_at`, `deleted_at`) VALUES
(1, 'Permits', 'Sanitary Permits', 'Manual', 'sign.png', 'SANITARY INSPECTOR - OIC', 4, 'Manual', 'sign.png', 'CITY HEALTH OFFICER', 5, 1, NULL, '2022-03-18 01:02:43', NULL),
(2, 'Permits', 'Business Permits', 'Manual', 'sign.png', 'SANITARY INSPECTOR - OIC', 4, 'Manual', 'sign.png', 'CITY HEALTH OFFICER', 5, 1, NULL, '2022-03-18 01:02:54', NULL),
(3, 'Certificates', 'Health Certificates', 'Manual', 'sign.png', 'SANITARY INSPECTOR - OIC', 4, 'Manual', 'sign.png', 'CITY HEALTH OFFICER', 5, 1, NULL, '2022-03-18 00:57:46', NULL),
(4, 'Certificates', 'Medical Certificates', NULL, NULL, '', NULL, 'Manual', 'sign.png', 'MEDICAL OFFICER III', 6, 1, NULL, '2022-03-18 01:00:49', NULL),
(5, 'Certificates', 'Exhumation Certificates', 'Manual', NULL, '', NULL, 'Manual', 'sign.png', 'MEDICAL OFFICER IV', 2, 1, NULL, '2022-03-18 01:02:05', NULL),
(6, 'Certificates', 'Transfer of Cadaver', NULL, NULL, '', NULL, 'Manual', 'sign.png', 'MEDICAL OFFICER IV', 2, 1, NULL, '2022-03-18 00:58:20', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `transfer_cadavers`
--

CREATE TABLE `transfer_cadavers` (
  `id` int(11) NOT NULL,
  `name_of_deceased` varchar(255) NOT NULL,
  `cause_of_death` varchar(255) NOT NULL,
  `place_of_death` varchar(255) NOT NULL,
  `death_at` date NOT NULL,
  `issued_at` date NOT NULL,
  `relationship_id` int(11) NOT NULL,
  `civil_status_id` int(11) NOT NULL,
  `citizenship_id` int(11) NOT NULL,
  `cemetery_id` int(11) NOT NULL,
  `physician_id` int(11) NOT NULL,
  `resident_id` int(11) NOT NULL,
  `payment_id` int(11) NOT NULL,
  `transfer_cadaver_signature_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `transfer_cadaver_signatures`
--

CREATE TABLE `transfer_cadaver_signatures` (
  `id` int(11) NOT NULL,
  `city_health_officer_id` int(11) NOT NULL,
  `city_health_officer_position` varchar(255) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Active',
  `health_official_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `status`, `health_official_id`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'admin', '$2y$10$zepXhy3ZJFDah0uoASfi1O0xDWfl3SRiPTyNYSgBUXESuOIsRVhfG', 'Active', 1, 2, NULL, NULL, '2022-02-25 15:56:02', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `actions`
--
ALTER TABLE `actions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `baranggays`
--
ALTER TABLE `baranggays`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`),
  ADD KEY `deleted_by` (`deleted_by`);

--
-- Indexes for table `blood_types`
--
ALTER TABLE `blood_types`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`),
  ADD KEY `deleted_by` (`deleted_by`);

--
-- Indexes for table `business_permits`
--
ALTER TABLE `business_permits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `deleted_by` (`deleted_by`),
  ADD KEY `updated_by` (`updated_by`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `business_id` (`company_id`),
  ADD KEY `payment_id` (`payment_id`),
  ADD KEY `city_health_officer_id` (`business_permit_signature_id`);

--
-- Indexes for table `business_permit_inspections`
--
ALTER TABLE `business_permit_inspections`
  ADD PRIMARY KEY (`id`),
  ADD KEY `business_permit_id` (`business_permit_id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`),
  ADD KEY `deleted_by` (`deleted_by`);

--
-- Indexes for table `business_permit_inspection_checklists`
--
ALTER TABLE `business_permit_inspection_checklists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `business_inspection-id` (`business_permit_id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`),
  ADD KEY `deleted_by` (`deleted_by`);

--
-- Indexes for table `business_permit_signatures`
--
ALTER TABLE `business_permit_signatures`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sanitary_inspector_id` (`sanitary_inspector_id`),
  ADD KEY `city_health_officer_id` (`city_health_officer_id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`),
  ADD KEY `deleted_by` (`deleted_by`);

--
-- Indexes for table `cemeteries`
--
ALTER TABLE `cemeteries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`),
  ADD KEY `deleted_by` (`deleted_by`);

--
-- Indexes for table `checklists`
--
ALTER TABLE `checklists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `updated_by` (`updated_by`),
  ADD KEY `deleted_by` (`deleted_by`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `citizenships`
--
ALTER TABLE `citizenships`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`),
  ADD KEY `deleted_by` (`deleted_by`);

--
-- Indexes for table `civil_statuses`
--
ALTER TABLE `civil_statuses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`),
  ADD KEY `deleted_by` (`deleted_by`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`),
  ADD KEY `deleted_by` (`deleted_by`);

--
-- Indexes for table `complaints`
--
ALTER TABLE `complaints`
  ADD PRIMARY KEY (`id`),
  ADD KEY `complaint_type_id` (`complaint_type_id`),
  ADD KEY `complaint_status_id` (`complaint_status_id`),
  ADD KEY `respondent_id` (`respondent_id`),
  ADD KEY `person_involved_id` (`person_involved_id`),
  ADD KEY `resident_id` (`complainant_id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`),
  ADD KEY `deleted_by` (`deleted_by`);

--
-- Indexes for table `complaint_statuses`
--
ALTER TABLE `complaint_statuses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`),
  ADD KEY `deleted_by` (`deleted_by`);

--
-- Indexes for table `complaint_types`
--
ALTER TABLE `complaint_types`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`),
  ADD KEY `deleted_by` (`deleted_by`);

--
-- Indexes for table `educational_attainments`
--
ALTER TABLE `educational_attainments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `deleted_by` (`deleted_by`),
  ADD KEY `updated_by` (`updated_by`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `establishments`
--
ALTER TABLE `establishments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`),
  ADD KEY `deleted_by` (`deleted_by`);

--
-- Indexes for table `exhumation_certificates`
--
ALTER TABLE `exhumation_certificates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `relationship_id` (`relationship_id`),
  ADD KEY `resident_id` (`resident_id`),
  ADD KEY `medical_officer_id` (`exhumation_certificate_signature_id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`),
  ADD KEY `deleted_by` (`deleted_by`),
  ADD KEY `payment_id` (`payment_id`),
  ADD KEY `civil_status` (`civil_status_id`);

--
-- Indexes for table `exhumation_certificate_signatures`
--
ALTER TABLE `exhumation_certificate_signatures`
  ADD PRIMARY KEY (`id`),
  ADD KEY `city_health_officer_id` (`city_health_officer_id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `deleted_by` (`deleted_by`);

--
-- Indexes for table `fees`
--
ALTER TABLE `fees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`),
  ADD KEY `deleted_by` (`deleted_by`);

--
-- Indexes for table `genders`
--
ALTER TABLE `genders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`),
  ADD KEY `deleted_by` (`deleted_by`);

--
-- Indexes for table `health_certificates`
--
ALTER TABLE `health_certificates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `occupation_id` (`occupation_id`),
  ADD KEY `resident_id` (`resident_id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`),
  ADD KEY `deleted_by` (`deleted_by`),
  ADD KEY `baranggay_id` (`baranggay_id`),
  ADD KEY `purok_id` (`purok_id`),
  ADD KEY `gender_id` (`gender_id`),
  ADD KEY `civil_status_id` (`civil_status_id`),
  ADD KEY `health_certificate_siganture_id` (`health_certificate_signature_id`);

--
-- Indexes for table `health_certificate_signatures`
--
ALTER TABLE `health_certificate_signatures`
  ADD PRIMARY KEY (`id`),
  ADD KEY `deleted_by` (`deleted_by`),
  ADD KEY `updated_by` (`updated_by`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `sanitary_inspector_id` (`sanitary_inspector_id`),
  ADD KEY `city_health_officer_id` (`city_health_officer_id`);

--
-- Indexes for table `health_officials`
--
ALTER TABLE `health_officials`
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `postion_id` (`position_id`),
  ADD KEY `gender_id` (`gender_id`),
  ADD KEY `civil_status_id` (`civil_status_id`),
  ADD KEY `purok_id` (`purok_id`),
  ADD KEY `barnggay_id` (`baranggay_id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`),
  ADD KEY `deleted_by` (`deleted_by`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `action_id` (`action_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `module_id` (`module_id`),
  ADD KEY `record_id` (`record_id`);

--
-- Indexes for table `medical_certificates`
--
ALTER TABLE `medical_certificates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `resident_id` (`resident_id`),
  ADD KEY `medical_officer_id` (`medical_officer_id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`),
  ADD KEY `deleted_by` (`deleted_by`),
  ADD KEY `payment_id` (`payment_id`),
  ADD KEY `purok_id` (`purok_id`),
  ADD KEY `baranggay_id` (`baranggay_id`),
  ADD KEY `medical_certificate_signature_id` (`medical_certificate_signature_id`);

--
-- Indexes for table `medical_certificate_signatures`
--
ALTER TABLE `medical_certificate_signatures`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`),
  ADD KEY `deleted_by` (`deleted_by`),
  ADD KEY `city_health_officer_id` (`city_health_officer_id`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `occupations`
--
ALTER TABLE `occupations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`),
  ADD KEY `deleted_by` (`deleted_by`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `person_disabilities`
--
ALTER TABLE `person_disabilities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`),
  ADD KEY `deleted_by` (`deleted_by`);

--
-- Indexes for table `puroks`
--
ALTER TABLE `puroks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`),
  ADD KEY `deleted_by` (`deleted_by`),
  ADD KEY `baranggay_id` (`baranggay_id`);

--
-- Indexes for table `relationships`
--
ALTER TABLE `relationships`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `deleted_by` (`deleted_by`);

--
-- Indexes for table `residents`
--
ALTER TABLE `residents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `deleted_by` (`deleted_by`),
  ADD KEY `updated_by` (`updated_by`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `educational_attainment_id` (`educational_attainment_id`),
  ADD KEY `purok_id` (`purok_id`),
  ADD KEY `baranggay_id` (`baranggay_id`),
  ADD KEY `citizenship_id` (`citizenship_id`),
  ADD KEY `position_id` (`position_id`),
  ADD KEY `gender_id` (`gender_id`),
  ADD KEY `person_disability_id` (`person_disability_id`),
  ADD KEY `civil_status_id` (`civil_status_id`),
  ADD KEY `blood_type_id` (`blood_type_id`);

--
-- Indexes for table `sanitary_checklists`
--
ALTER TABLE `sanitary_checklists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `module_id` (`module_id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`),
  ADD KEY `deleted_by` (`deleted_by`);

--
-- Indexes for table `sanitary_checklist_assigns`
--
ALTER TABLE `sanitary_checklist_assigns`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sanitary_checklist_id` (`sanitary_checklist_id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`),
  ADD KEY `deleted_by` (`deleted_by`),
  ADD KEY `checklist_id` (`checklist_id`);

--
-- Indexes for table `sanitary_permits`
--
ALTER TABLE `sanitary_permits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `business_id` (`company_id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`),
  ADD KEY `deleted_by` (`deleted_by`),
  ADD KEY `payment_id` (`payment_id`),
  ADD KEY `sanitary_inspector_id` (`sanitary_permit_signature_id`);

--
-- Indexes for table `sanitary_permit_inspections`
--
ALTER TABLE `sanitary_permit_inspections`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sanitary_permit_id` (`sanitary_permit_id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`),
  ADD KEY `deleted_by` (`deleted_by`);

--
-- Indexes for table `sanitary_permit_inspection_checklists`
--
ALTER TABLE `sanitary_permit_inspection_checklists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `checklist_id` (`checklist_id`),
  ADD KEY `sanitary_permit_id` (`sanitary_permit_id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`),
  ADD KEY `deleted_by` (`deleted_by`);

--
-- Indexes for table `sanitary_permit_signatures`
--
ALTER TABLE `sanitary_permit_signatures`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sanitary_inspector_id` (`sanitary_inspector_id`),
  ADD KEY `city_health_officer_id` (`city_health_officer_id`);

--
-- Indexes for table `signatures`
--
ALTER TABLE `signatures`
  ADD PRIMARY KEY (`id`),
  ADD KEY `si_id` (`sanitary_inspector_id`),
  ADD KEY `city_health_officer_id` (`city_health_officer_id`),
  ADD KEY `updated_by` (`updated_by`),
  ADD KEY `deleted_by` (`deleted_by`);

--
-- Indexes for table `transfer_cadavers`
--
ALTER TABLE `transfer_cadavers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `resident_id` (`resident_id`),
  ADD KEY `physician_id` (`physician_id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`),
  ADD KEY `deleted_by` (`deleted_by`),
  ADD KEY `payment_id` (`payment_id`),
  ADD KEY `relationship_id` (`relationship_id`),
  ADD KEY `civil_status_id` (`civil_status_id`),
  ADD KEY `citizenship_id` (`citizenship_id`),
  ADD KEY `cemetery_id` (`cemetery_id`),
  ADD KEY `health_certificate_signature_id` (`transfer_cadaver_signature_id`);

--
-- Indexes for table `transfer_cadaver_signatures`
--
ALTER TABLE `transfer_cadaver_signatures`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`),
  ADD KEY `deleted_by` (`deleted_by`),
  ADD KEY `city_health_officer_id` (`city_health_officer_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`),
  ADD KEY `deleted_by` (`deleted_by`),
  ADD KEY `health_official_id` (`health_official_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `actions`
--
ALTER TABLE `actions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `baranggays`
--
ALTER TABLE `baranggays`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `blood_types`
--
ALTER TABLE `blood_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `business_permits`
--
ALTER TABLE `business_permits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `business_permit_inspections`
--
ALTER TABLE `business_permit_inspections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `business_permit_inspection_checklists`
--
ALTER TABLE `business_permit_inspection_checklists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=149;

--
-- AUTO_INCREMENT for table `business_permit_signatures`
--
ALTER TABLE `business_permit_signatures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `cemeteries`
--
ALTER TABLE `cemeteries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `checklists`
--
ALTER TABLE `checklists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `citizenships`
--
ALTER TABLE `citizenships`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `civil_statuses`
--
ALTER TABLE `civil_statuses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `complaints`
--
ALTER TABLE `complaints`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `complaint_statuses`
--
ALTER TABLE `complaint_statuses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `complaint_types`
--
ALTER TABLE `complaint_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `educational_attainments`
--
ALTER TABLE `educational_attainments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `establishments`
--
ALTER TABLE `establishments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `exhumation_certificates`
--
ALTER TABLE `exhumation_certificates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `exhumation_certificate_signatures`
--
ALTER TABLE `exhumation_certificate_signatures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `fees`
--
ALTER TABLE `fees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `genders`
--
ALTER TABLE `genders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `health_certificates`
--
ALTER TABLE `health_certificates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `health_certificate_signatures`
--
ALTER TABLE `health_certificate_signatures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `health_officials`
--
ALTER TABLE `health_officials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=942;

--
-- AUTO_INCREMENT for table `medical_certificates`
--
ALTER TABLE `medical_certificates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `medical_certificate_signatures`
--
ALTER TABLE `medical_certificate_signatures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `occupations`
--
ALTER TABLE `occupations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=159;

--
-- AUTO_INCREMENT for table `person_disabilities`
--
ALTER TABLE `person_disabilities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `puroks`
--
ALTER TABLE `puroks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `relationships`
--
ALTER TABLE `relationships`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `residents`
--
ALTER TABLE `residents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `sanitary_checklists`
--
ALTER TABLE `sanitary_checklists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sanitary_checklist_assigns`
--
ALTER TABLE `sanitary_checklist_assigns`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=568;

--
-- AUTO_INCREMENT for table `sanitary_permits`
--
ALTER TABLE `sanitary_permits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `sanitary_permit_inspections`
--
ALTER TABLE `sanitary_permit_inspections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `sanitary_permit_inspection_checklists`
--
ALTER TABLE `sanitary_permit_inspection_checklists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=263;

--
-- AUTO_INCREMENT for table `sanitary_permit_signatures`
--
ALTER TABLE `sanitary_permit_signatures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `signatures`
--
ALTER TABLE `signatures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `transfer_cadavers`
--
ALTER TABLE `transfer_cadavers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `transfer_cadaver_signatures`
--
ALTER TABLE `transfer_cadaver_signatures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
