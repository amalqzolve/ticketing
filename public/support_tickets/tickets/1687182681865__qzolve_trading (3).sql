-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 26, 2023 at 10:23 AM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `qzolve_trading`
--

-- --------------------------------------------------------

--
-- Table structure for table `qsupport_ticketstatus_updations`
--

DROP TABLE IF EXISTS `qsupport_ticketstatus_updations`;
CREATE TABLE IF NOT EXISTS `qsupport_ticketstatus_updations` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `assignment_id` int(11) DEFAULT NULL COMMENT 'primary id of ''qsupport_ticket_assignments''',
  `ticket_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL COMMENT 'User Id who updated status',
  `status_date` date NOT NULL,
  `status_id` int(11) NOT NULL,
  `present_status` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comments` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `del_flag` tinyint(4) NOT NULL DEFAULT 1,
  `add_ip_addrs` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `add_admin_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `qsupport_ticketstatus_updations`
--

INSERT INTO `qsupport_ticketstatus_updations` (`id`, `assignment_id`, `ticket_id`, `user_id`, `status_date`, `status_id`, `present_status`, `comments`, `created_at`, `updated_at`, `del_flag`, `add_ip_addrs`, `add_admin_id`) VALUES
(1, NULL, 1, 1, '2023-01-14', 2, NULL, 'Status updated as status 2', '2023-01-14 13:13:46', NULL, 2, '::1', 1),
(2, NULL, 1, 1, '2023-01-14', 2, NULL, 'Status updated as status 2', '2023-01-14 13:13:46', NULL, 2, '::1', 1),
(3, NULL, 1, 39, '2023-01-14', 3, NULL, 'piffy updated status as status 3', '2023-01-14 14:37:15', NULL, 2, '::1', 39),
(4, NULL, 1, 39, '2023-01-14', 6, NULL, 'piffy updated  status as Status 4', '2023-01-14 15:00:44', NULL, 1, '::1', 39);

-- --------------------------------------------------------

--
-- Table structure for table `qsupport_ticket_activitylog`
--

DROP TABLE IF EXISTS `qsupport_ticket_activitylog`;
CREATE TABLE IF NOT EXISTS `qsupport_ticket_activitylog` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `subject_id` int(11) NOT NULL,
  `subject` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `activity_type` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `activity` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `add_ip_addrs` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `qsupport_ticket_activitylog`
--

INSERT INTO `qsupport_ticket_activitylog` (`id`, `subject_id`, `subject`, `ticket_id`, `activity_type`, `activity`, `user_id`, `created_at`, `updated_at`, `add_ip_addrs`) VALUES
(1, 1, 'id', 1, 'Ticket Added', 'ticket_tickets', 1, '2023-01-12 08:56:33', '2023-01-12 08:56:33', '::1'),
(2, 1, 'id', 1, 'Ticket Updated', 'ticket_tickets', 1, '2023-01-12 08:58:50', '2023-01-12 08:58:50', '::1'),
(3, 1, 'assignment_id', 1, 'Ticket Delegated', 'ticket_delegations', 1, '2023-01-14 07:24:53', '2023-01-14 07:24:53', '::1'),
(4, 1, 'id', 1, 'Ticket Status Updated', 'ticketstatus_updations', 1, '2023-01-14 07:43:46', '2023-01-14 07:43:46', '::1'),
(5, 2, 'id', 1, 'Ticket Status Updated', 'ticketstatus_updations', 1, '2023-01-14 07:43:46', '2023-01-14 07:43:46', '::1'),
(6, 3, 'id', 1, 'Ticket Status Updated', 'ticketstatus_updations', 39, '2023-01-14 09:07:15', '2023-01-14 09:07:15', '::1'),
(7, 1, 'id', 1, 'Comment Added', 'ticket_commoncomments', 39, '2023-01-14 09:14:08', '2023-01-14 09:14:08', '::1'),
(8, 4, 'id', 1, 'Ticket Status Updated', 'ticketstatus_updations', 39, '2023-01-14 09:30:44', '2023-01-14 09:30:44', '::1'),
(9, 1, 'id', 1, 'Ticket Closed', 'ticket_delegations', 39, '2023-01-14 09:32:43', '2023-01-14 09:32:43', '::1'),
(10, 2, 'id', 1, 'Ticket Closed', 'ticket_delegations', 40, '2023-01-15 13:43:17', '2023-01-15 13:43:17', '::1');

-- --------------------------------------------------------

--
-- Table structure for table `qsupport_ticket_assignments`
--

DROP TABLE IF EXISTS `qsupport_ticket_assignments`;
CREATE TABLE IF NOT EXISTS `qsupport_ticket_assignments` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ticket_id` int(11) NOT NULL COMMENT 'primary id of ''qsupport_ticket_tickets''',
  `assigned_to` int(11) NOT NULL,
  `assigned_by` int(11) NOT NULL,
  `assigned_date` date DEFAULT NULL,
  `ticket_status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1-Open, 0-Closed',
  `close_comments` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ticketclosed_date` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `add_ip_addrs` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `edit_ip_addrs` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delegation_comments` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delegated_date` timestamp NULL DEFAULT NULL,
  `delegation_flag` tinyint(4) NOT NULL DEFAULT 0 COMMENT '1=Delegated, 0=No delegation, 2=All delegates closed the ticket',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `qsupport_ticket_assignments`
--

INSERT INTO `qsupport_ticket_assignments` (`id`, `ticket_id`, `assigned_to`, `assigned_by`, `assigned_date`, `ticket_status`, `close_comments`, `ticketclosed_date`, `created_at`, `updated_at`, `add_ip_addrs`, `edit_ip_addrs`, `delegation_comments`, `delegated_date`, `delegation_flag`) VALUES
(1, 1, 1, 1, '2023-01-12', 1, NULL, NULL, '2023-01-12 14:28:49', '2023-01-14 07:24:53', '::1', '::1', 'delegated the first ticket to piffy and reuben', '2023-01-14 07:24:53', 2);

-- --------------------------------------------------------

--
-- Table structure for table `qsupport_ticket_assignment_history`
--

DROP TABLE IF EXISTS `qsupport_ticket_assignment_history`;
CREATE TABLE IF NOT EXISTS `qsupport_ticket_assignment_history` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ticket_id` int(11) NOT NULL COMMENT 'primary id of ''qsupport_ticket_tickets''',
  `assigned_to` int(11) NOT NULL,
  `assigned_by` int(11) NOT NULL,
  `assigned_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `add_ip_addrs` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `del_flag` tinyint(4) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `qsupport_ticket_assignment_history`
--

INSERT INTO `qsupport_ticket_assignment_history` (`id`, `ticket_id`, `assigned_to`, `assigned_by`, `assigned_date`, `created_at`, `add_ip_addrs`, `del_flag`) VALUES
(1, 1, 1, 1, '2023-01-12', '2023-01-12 14:28:50', '::1', 1),
(2, 1, 39, 1, '2023-01-14', '2023-01-14 12:54:53', '::1', 1),
(3, 1, 40, 1, '2023-01-14', '2023-01-14 12:54:53', '::1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `qsupport_ticket_cmncomment_attachment`
--

DROP TABLE IF EXISTS `qsupport_ticket_cmncomment_attachment`;
CREATE TABLE IF NOT EXISTS `qsupport_ticket_cmncomment_attachment` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ticket_id` int(11) NOT NULL,
  `comment_id` int(11) NOT NULL,
  `attachment` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `del_flag` tinyint(4) NOT NULL DEFAULT 1,
  `add_ip_addrs` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `edit_ip_addrs` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `add_admin_id` int(11) DEFAULT NULL,
  `edit_admin_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `qsupport_ticket_cmncomment_attachment`
--

INSERT INTO `qsupport_ticket_cmncomment_attachment` (`id`, `ticket_id`, `comment_id`, `attachment`, `created_at`, `updated_at`, `del_flag`, `add_ip_addrs`, `edit_ip_addrs`, `add_admin_id`, `edit_admin_id`) VALUES
(1, 1, 1, 'D:\\wamp64\\www\\trading\\public\\support_tickets/ticket_cmncomments1673707448100_9.jpg', '2023-01-14 14:44:08', NULL, 1, '::1', NULL, 39, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `qsupport_ticket_commoncomments`
--

DROP TABLE IF EXISTS `qsupport_ticket_commoncomments`;
CREATE TABLE IF NOT EXISTS `qsupport_ticket_commoncomments` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ticket_id` int(11) NOT NULL,
  `comment_by` int(11) NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `add_ip_addrs` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `edit_ip_addrs` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `del_flag` tinyint(4) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `qsupport_ticket_commoncomments`
--

INSERT INTO `qsupport_ticket_commoncomments` (`id`, `ticket_id`, `comment_by`, `comment`, `created_at`, `updated_at`, `add_ip_addrs`, `edit_ip_addrs`, `del_flag`) VALUES
(1, 1, 39, 'piffy commented on the ticket delegated by Qzolve. My comment 1.', '2023-01-14 09:14:08', '2023-01-14 09:14:08', '::1', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `qsupport_ticket_delegations`
--

DROP TABLE IF EXISTS `qsupport_ticket_delegations`;
CREATE TABLE IF NOT EXISTS `qsupport_ticket_delegations` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `assignment_id` int(11) NOT NULL COMMENT 'primary id of ''qsupport_ticket_assignments''',
  `ticket_id` int(11) NOT NULL COMMENT 'primary id of ''qsupport_ticket_tickets''',
  `assigned_to` int(11) NOT NULL,
  `assigned_by` int(11) NOT NULL,
  `assigned_date` date DEFAULT NULL,
  `ticket_status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1-Open, 0-Closed',
  `delegation_comments` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `close_comments` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ticketclosed_date` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `add_ip_addrs` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `edit_ip_addrs` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `qsupport_ticket_delegations`
--

INSERT INTO `qsupport_ticket_delegations` (`id`, `assignment_id`, `ticket_id`, `assigned_to`, `assigned_by`, `assigned_date`, `ticket_status`, `delegation_comments`, `close_comments`, `ticketclosed_date`, `created_at`, `updated_at`, `add_ip_addrs`, `edit_ip_addrs`) VALUES
(1, 1, 1, 39, 1, '2023-01-14', 0, 'delegated the first ticket to piffy and reuben', 'piffy closed the ticket', '2023-01-14 09:32:43', '2023-01-14 07:24:52', '2023-01-14 09:32:43', '::1', '::1'),
(2, 1, 1, 40, 1, '2023-01-14', 0, 'delegated the first ticket to piffy and reuben', 'reuben closed 2nd', '2023-01-15 13:43:17', '2023-01-14 07:24:53', '2023-01-15 13:43:17', '::1', '::1');

-- --------------------------------------------------------

--
-- Table structure for table `qsupport_ticket_emailsettings`
--

DROP TABLE IF EXISTS `qsupport_ticket_emailsettings`;
CREATE TABLE IF NOT EXISTS `qsupport_ticket_emailsettings` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `host` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `passwrd` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `smtpsecure_status` tinyint(4) NOT NULL COMMENT '1=Yes, 2=No',
  `port_no` int(11) NOT NULL,
  `sender_email` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `receiver_email` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `edit_ip_addrs` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `edit_admin_id` int(11) DEFAULT NULL,
  `del_flag` tinyint(4) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `qsupport_ticket_emailsettings`
--

INSERT INTO `qsupport_ticket_emailsettings` (`id`, `host`, `username`, `passwrd`, `smtpsecure_status`, `port_no`, `sender_email`, `receiver_email`, `created_at`, `updated_at`, `edit_ip_addrs`, `edit_admin_id`, `del_flag`) VALUES
(1, 'smtpout.secureserver.net', 'support@qzolve.com', 'Qzolve@123support', 1, 80, 'support@qzolve.com', '', '2023-01-01 02:43:07', NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `qsupport_ticket_ticketautoincr_code`
--

DROP TABLE IF EXISTS `qsupport_ticket_ticketautoincr_code`;
CREATE TABLE IF NOT EXISTS `qsupport_ticket_ticketautoincr_code` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `start` int(50) NOT NULL,
  `code` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `qsupport_ticket_ticketautoincr_code`
--

INSERT INTO `qsupport_ticket_ticketautoincr_code` (`id`, `start`, `code`) VALUES
(1, 100003, 'TC-');

-- --------------------------------------------------------

--
-- Table structure for table `qsupport_ticket_tickets`
--

DROP TABLE IF EXISTS `qsupport_ticket_tickets`;
CREATE TABLE IF NOT EXISTS `qsupport_ticket_tickets` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ticketID` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `client_id` int(11) NOT NULL,
  `ticket_against` tinyint(4) NOT NULL COMMENT '1=New Task, 2=Project',
  `ticket_againstname` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `project_id` int(11) DEFAULT NULL,
  `ticket_title` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ticket_category_id` int(11) NOT NULL,
  `ticket_date` date NOT NULL,
  `completion_date` date DEFAULT NULL COMMENT 'due date',
  `scope_of_work` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `priority_id` int(11) DEFAULT NULL,
  `priority_name` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `assigned_status` tinyint(4) DEFAULT NULL COMMENT '1-assigned, 0-not assigned',
  `reference` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ticket_details` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `del_flag` tinyint(4) NOT NULL DEFAULT 1,
  `add_ip_addrs` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `edit_ip_addrs` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `add_admin_id` int(11) DEFAULT NULL,
  `edit_admin_id` int(11) DEFAULT NULL,
  `ticket_status` tinyint(4) NOT NULL COMMENT '1=Open, 0=Closed',
  `ticketclosed_date` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `qsupport_ticket_tickets`
--

INSERT INTO `qsupport_ticket_tickets` (`id`, `ticketID`, `client_id`, `ticket_against`, `ticket_againstname`, `project_id`, `ticket_title`, `ticket_category_id`, `ticket_date`, `completion_date`, `scope_of_work`, `priority_id`, `priority_name`, `assigned_status`, `reference`, `ticket_details`, `created_at`, `updated_at`, `del_flag`, `add_ip_addrs`, `edit_ip_addrs`, `add_admin_id`, `edit_admin_id`, `ticket_status`, `ticketclosed_date`) VALUES
(1, 'TC-100004', 2, 1, 'New Task', NULL, 'testing ticket', 3, '2023-01-12', '2023-01-13', 'test scope', 1, 'Normal', 1, 'test refe', 'test ticket details', '2023-01-12 08:56:33', '2023-01-12 08:58:49', 1, '::1', '::1', 1, 1, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `qsupport_ticket_ticketuploads`
--

DROP TABLE IF EXISTS `qsupport_ticket_ticketuploads`;
CREATE TABLE IF NOT EXISTS `qsupport_ticket_ticketuploads` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ticket_id` int(11) NOT NULL COMMENT 'primary id of''qsupport_ticket_tickets''',
  `file_name` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `del_flag` tinyint(4) NOT NULL DEFAULT 1,
  `add_ip_addrs` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `edit_ip_addrs` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `add_admin_id` int(11) DEFAULT NULL,
  `edit_admin_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `qsupport_ticket_ticketuploads`
--

INSERT INTO `qsupport_ticket_ticketuploads` (`id`, `ticket_id`, `file_name`, `created_at`, `updated_at`, `del_flag`, `add_ip_addrs`, `edit_ip_addrs`, `add_admin_id`, `edit_admin_id`) VALUES
(1, 1, 'support_tickets/tickets/1673533526800__100_9.jpg', '2023-01-12 14:26:33', NULL, 1, '::1', NULL, 1, NULL),
(2, 1, 'support_tickets/tickets/1673533526802__100_10.jpg', '2023-01-12 14:26:33', NULL, 1, '::1', NULL, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `qsupport_ticket_ticket_category`
--

DROP TABLE IF EXISTS `qsupport_ticket_ticket_category`;
CREATE TABLE IF NOT EXISTS `qsupport_ticket_ticket_category` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `category` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `del_flag` tinyint(4) NOT NULL DEFAULT 1,
  `add_ip_addrs` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `edit_ip_addrs` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `add_admin_id` int(11) DEFAULT NULL,
  `edit_admin_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `qsupport_ticket_ticket_category`
--

INSERT INTO `qsupport_ticket_ticket_category` (`id`, `category`, `description`, `created_at`, `updated_at`, `del_flag`, `add_ip_addrs`, `edit_ip_addrs`, `add_admin_id`, `edit_admin_id`) VALUES
(1, 'Category 1', 'ctg1 desc', '2022-11-19 00:47:03', '2022-11-19 00:47:03', 1, '::1', NULL, NULL, NULL),
(2, 'Category 2', NULL, '2022-11-19 00:47:57', '2022-11-19 00:47:57', 0, '::1', NULL, NULL, NULL),
(3, 'Category 2', NULL, '2022-11-19 00:47:57', '2022-11-19 00:47:57', 1, '::1', NULL, NULL, NULL),
(4, 'Category 3', NULL, '2022-11-19 00:53:38', '2022-11-19 00:53:38', 0, '::1', NULL, NULL, NULL),
(5, 'Category 4', NULL, '2022-11-19 00:53:38', '2022-11-20 23:16:23', 0, '::1', '::1', NULL, 1),
(6, 'Category 3', NULL, '2022-11-20 23:16:10', '2022-11-20 23:16:10', 1, '::1', NULL, NULL, NULL),
(7, 'CTG-4', NULL, '2022-11-22 03:16:14', '2022-11-22 03:16:14', 1, '::1', NULL, NULL, NULL),
(8, 'ctg 5', NULL, '2022-11-22 08:47:02', '2022-11-22 08:47:29', 0, '::1', NULL, NULL, NULL),
(9, 'ctg 5', NULL, '2022-11-22 08:47:02', '2022-11-22 08:47:02', 1, '::1', NULL, NULL, NULL),
(10, 'ctg 6', NULL, '2022-11-22 08:51:45', '2022-11-22 08:51:45', 1, '::1', NULL, NULL, NULL),
(11, 'ctg 7', NULL, '2022-11-22 08:52:05', '2022-11-22 08:52:05', 1, '::1', NULL, NULL, NULL),
(12, 'Ctg 8', NULL, '2022-11-22 08:52:23', '2022-11-22 08:52:23', 1, '::1', NULL, NULL, NULL),
(13, 'ctg 11', NULL, '2022-11-22 08:57:25', '2022-11-22 08:57:25', 1, '::1', NULL, NULL, NULL),
(14, 'ctg 12', NULL, '2022-11-22 08:57:45', '2022-11-22 08:57:45', 1, '::1', NULL, NULL, NULL),
(15, 'ctg 9', NULL, '2022-11-22 08:58:01', '2022-11-22 08:58:01', 1, '::1', NULL, NULL, NULL),
(16, 'ctg 10', NULL, '2022-11-22 08:58:44', '2022-11-22 08:58:44', 1, '::1', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `qsupport_ticket_ticket_status`
--

DROP TABLE IF EXISTS `qsupport_ticket_ticket_status`;
CREATE TABLE IF NOT EXISTS `qsupport_ticket_ticket_status` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `status` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `del_flag` tinyint(4) NOT NULL DEFAULT 1,
  `add_ip_addrs` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `edit_ip_addrs` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `add_admin_id` int(11) DEFAULT NULL,
  `edit_admin_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `qsupport_ticket_ticket_status`
--

INSERT INTO `qsupport_ticket_ticket_status` (`id`, `status`, `description`, `created_at`, `updated_at`, `del_flag`, `add_ip_addrs`, `edit_ip_addrs`, `add_admin_id`, `edit_admin_id`) VALUES
(1, 'Status 1', 'desc 1', '2022-11-19 09:42:50', '2022-11-19 09:42:50', 1, '::1', NULL, NULL, NULL),
(2, 'Status 2', NULL, '2022-11-19 09:43:37', '2022-11-19 09:43:37', 1, '::1', NULL, NULL, NULL),
(3, 'Status 3', NULL, '2022-11-19 09:43:57', '2022-11-19 09:43:57', 1, '::1', NULL, NULL, NULL),
(4, 'Status 4', 'desc 4', '2022-11-19 09:44:09', '2022-11-19 09:44:37', 0, '::1', '::1', NULL, 1),
(5, 'Stat', NULL, '2022-11-20 23:22:03', '2022-11-20 23:22:09', 0, '::1', NULL, NULL, NULL),
(6, 'Status 4', NULL, '2022-12-01 02:54:01', '2022-12-01 02:54:01', 1, '::1', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `qsupport_ticket_ticket_tags`
--

DROP TABLE IF EXISTS `qsupport_ticket_ticket_tags`;
CREATE TABLE IF NOT EXISTS `qsupport_ticket_ticket_tags` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tag_name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `del_flag` tinyint(4) NOT NULL DEFAULT 1,
  `add_ip_addrs` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `edit_ip_addrs` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `add_admin_id` int(11) DEFAULT NULL,
  `edit_admin_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `qsupport_ticket_ticket_tags`
--

INSERT INTO `qsupport_ticket_ticket_tags` (`id`, `tag_name`, `description`, `created_at`, `updated_at`, `del_flag`, `add_ip_addrs`, `edit_ip_addrs`, `add_admin_id`, `edit_admin_id`) VALUES
(1, 'Tag 1', 'tag 1desc', '2022-11-19 05:45:31', '2022-11-19 05:45:31', 1, '::1', NULL, NULL, NULL),
(2, 'Tag 21', NULL, '2022-11-19 05:45:51', '2022-11-19 06:45:02', 1, '::1', '::1', NULL, 1),
(3, 'Tag 3', NULL, '2022-11-19 05:46:32', '2022-11-19 05:46:32', 1, '::1', NULL, NULL, NULL),
(4, 'test', NULL, '2022-11-19 06:45:56', '2022-11-19 06:45:56', 0, '::1', NULL, NULL, NULL),
(5, 'test', NULL, '2022-11-19 06:50:22', '2022-11-19 06:50:22', 0, '::1', NULL, NULL, NULL),
(6, 'test', NULL, '2022-11-20 23:19:40', '2022-11-20 23:19:47', 0, '::1', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `qsupport_ticket_ticket_type`
--

DROP TABLE IF EXISTS `qsupport_ticket_ticket_type`;
CREATE TABLE IF NOT EXISTS `qsupport_ticket_ticket_type` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `type_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `del_flag` tinyint(4) NOT NULL DEFAULT 1,
  `add_ip_addrs` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `edit_ip_addrs` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `add_admin_id` int(11) DEFAULT NULL,
  `edit_admin_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `qsupport_ticket_ticket_type`
--

INSERT INTO `qsupport_ticket_ticket_type` (`id`, `type_name`, `description`, `created_at`, `updated_at`, `del_flag`, `add_ip_addrs`, `edit_ip_addrs`, `add_admin_id`, `edit_admin_id`) VALUES
(1, 'Type1', NULL, '2022-11-08 23:40:57', '2022-11-08 23:40:57', 1, '::1', NULL, 0, 0),
(2, 'Type 2', 'test2', '2022-11-09 00:11:05', '2022-11-09 10:16:28', 1, '::1', '::1', 0, 0),
(3, 'Type 3', NULL, '2022-11-09 10:17:51', '2022-11-09 10:17:51', 1, '::1', NULL, 0, 0),
(4, 'Type 4', NULL, '2022-11-18 00:33:30', '2022-11-18 00:33:30', 1, '::1', NULL, NULL, NULL),
(5, 'Type 5', NULL, '2022-11-18 00:35:44', '2022-11-18 00:35:44', 1, '::1', NULL, NULL, NULL),
(6, 'Type 6', NULL, '2022-11-18 00:38:41', '2022-11-18 00:38:41', 1, '::1', NULL, NULL, NULL),
(7, 'Type 7', NULL, '2022-11-18 00:39:54', '2022-11-18 00:39:54', 1, '::1', NULL, NULL, NULL),
(8, 'Type 8', NULL, '2022-11-18 00:40:47', '2022-11-18 00:40:47', 1, '::1', NULL, NULL, NULL),
(9, 'Type 9', 'updated description', '2022-11-18 18:59:17', '2022-11-18 19:15:23', 0, '::1', '::1', NULL, 1),
(10, 'Type 10', NULL, '2022-11-18 19:17:08', '2022-11-18 19:17:08', 0, '::1', NULL, NULL, NULL),
(11, 'Type 9', NULL, '2022-11-19 00:59:40', '2022-11-19 00:59:40', 0, '::1', NULL, NULL, NULL),
(12, 'Type 9', NULL, '2022-11-19 00:59:40', '2022-11-19 00:59:40', 0, '::1', NULL, NULL, NULL),
(13, 'Type 9', NULL, '2022-11-19 00:59:40', '2022-11-20 23:02:08', 0, '::1', NULL, NULL, NULL),
(14, 'Type 9', NULL, '2022-11-22 01:02:14', '2022-11-22 01:02:14', 1, '::1', NULL, NULL, NULL),
(15, 'Type 9', NULL, '2022-11-22 01:02:19', '2022-11-22 01:02:19', 1, '::1', NULL, NULL, NULL),
(16, 'Type 10', NULL, '2022-11-22 01:05:59', '2022-11-22 01:05:59', 1, '::1', NULL, NULL, NULL),
(17, 'Type 11', NULL, '2022-11-22 01:06:17', '2022-11-22 01:06:17', 1, '::1', NULL, NULL, NULL),
(18, 'Type 12', NULL, '2022-11-22 06:49:15', '2022-11-22 06:49:15', 1, '::1', NULL, NULL, NULL),
(19, 'Type 12', NULL, '2022-11-22 06:49:15', '2022-11-22 06:49:15', 1, '::1', NULL, NULL, NULL),
(20, 'Type 13', NULL, '2022-11-22 06:50:08', '2022-11-22 06:50:08', 1, '::1', NULL, NULL, NULL),
(21, 'Type 14', NULL, '2022-11-22 06:50:22', '2022-11-22 06:50:31', 0, '::1', NULL, NULL, NULL),
(22, 'Type 14', NULL, '2022-11-22 06:50:22', '2022-11-22 06:50:22', 1, '::1', NULL, NULL, NULL),
(23, 'Type 15', NULL, '2022-11-22 06:51:06', '2022-11-22 06:51:06', 1, '::1', NULL, NULL, NULL),
(24, 'Type 15', NULL, '2022-11-22 06:51:06', '2022-11-22 06:51:06', 1, '::1', NULL, NULL, NULL),
(25, 'Type 16', NULL, '2022-11-22 07:23:22', '2022-11-22 07:23:22', 1, '::1', NULL, NULL, NULL),
(26, 'Type 16', NULL, '2022-11-22 07:23:22', '2022-11-22 07:23:22', 1, '::1', NULL, NULL, NULL),
(27, 'Type 16', NULL, '2022-11-22 07:23:22', '2022-11-22 07:23:22', 1, '::1', NULL, NULL, NULL),
(28, 'Type 17', NULL, '2022-11-22 07:30:47', '2022-11-22 07:30:47', 1, '::1', NULL, NULL, NULL),
(29, 'Type 18', NULL, '2022-11-22 07:31:04', '2022-11-22 07:31:04', 1, '::1', NULL, NULL, NULL),
(30, 'Type 19', NULL, '2022-11-22 07:33:18', '2022-11-22 07:33:18', 1, '::1', NULL, NULL, NULL),
(31, 'Type 20', NULL, '2022-11-22 07:47:37', '2022-11-22 07:47:37', 1, '::1', NULL, NULL, NULL),
(32, 'Type 21', NULL, '2022-11-22 07:58:48', '2022-11-22 07:58:48', 1, '::1', NULL, NULL, NULL),
(33, 'Type 22', NULL, '2022-11-22 07:59:07', '2022-11-22 07:59:07', 1, '::1', NULL, NULL, NULL),
(34, 'TYpe 23', NULL, '2022-11-22 07:59:25', '2022-11-22 07:59:25', 1, '::1', NULL, NULL, NULL),
(35, 'Type 25', NULL, '2022-11-22 07:59:49', '2022-11-22 08:21:13', 1, '::1', '::1', NULL, 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
