-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 12, 2022 at 01:18 PM
-- Server version: 10.3.34-MariaDB-0ubuntu0.20.04.1
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `accountant_base`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(18) NOT NULL AUTO_INCREMENT,
  `label` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `fy_start` date NOT NULL,
  `fy_end` date NOT NULL,
  `db_datasource` varchar(111) NOT NULL,
  `db_database` varchar(111) NOT NULL,
  `db_host` varchar(111) NOT NULL,
  `db_port` int(6) NOT NULL,
  `db_login` varchar(111) NOT NULL,
  `db_password` varchar(111) NOT NULL,
  `db_prefix` varchar(111) NULL DEFAULT NULL,
  `db_persistent` int(1) NOT NULL,
  `db_schema` varchar(111) NULL DEFAULT NULL,
  `db_unixsocket` varchar(111) NULL DEFAULT NULL,
  `db_settings` varchar(111) NULL DEFAULT NULL,
  `ssl_key` varchar(111) NULL DEFAULT NULL,
  `ssl_cert` varchar(111) NULL DEFAULT NULL,
  `ssl_ca` varchar(111) NULL DEFAULT NULL,
  `account_locked` int(1) NOT NULL,
    PRIMARY KEY(`id`),
    UNIQUE KEY `unique_id` (`id`)
) DEFAULT CHARSET=utf8,
COLLATE=utf8_unicode_ci,
AUTO_INCREMENT=1,
ENGINE=InnoDB;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(18) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL,
  `description` varchar(100) NOT NULL,
    PRIMARY KEY(`id`),
    UNIQUE KEY `unique_id` (`id`)
) DEFAULT CHARSET=utf8,
COLLATE=utf8_unicode_ci,
AUTO_INCREMENT=1,
ENGINE=InnoDB;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`name`, `description`) VALUES
('admin', 'Administrator'),
('manager', 'Manager'),
('accountant', 'Accountant'),
('data_entry_operator', 'Data Entry Operator');

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(18) NOT NULL AUTO_INCREMENT,
  `label` varchar(25) NOT NULL,
  `ip_address` varchar(18) NOT NULL,
  `login` varchar(9) NOT NULL,
  `time` date NOT NULL,
    PRIMARY KEY(`id`),
    UNIQUE KEY `unique_id` (`id`)
) DEFAULT CHARSET=utf8,
COLLATE=utf8_unicode_ci,
AUTO_INCREMENT=1,
ENGINE=InnoDB;

-- --------------------------------------------------------

--
-- Table structure for table `bg-head-bgpermissions`
--

CREATE TABLE `permissions` (
  `id` int(18) NOT NULL AUTO_INCREMENT,
  `group_id` tinyint(1) NOT NULL DEFAULT '0',
  `account_settings-index` tinyint(1) NOT NULL DEFAULT '0',
  `account_settings-main` tinyint(1) NOT NULL DEFAULT '0',
  `account_settings-cf` tinyint(1) NOT NULL DEFAULT '0',
  `account_settings-email` tinyint(1) NOT NULL DEFAULT '0',
  `account_settings-printer` tinyint(1) NOT NULL DEFAULT '0',
  `account_settings-tags` tinyint(1) NOT NULL DEFAULT '0',
  `account_settings-entrytypes` tinyint(1) NOT NULL DEFAULT '0',
  `account_settings-lock` tinyint(1) NOT NULL DEFAULT '0',
  `accounts-index` tinyint(1) NOT NULL DEFAULT '0',
  `dashboard-index` tinyint(1) NOT NULL DEFAULT '0',
  `entries-index` tinyint(1) NOT NULL DEFAULT '0',
  `entries-add` tinyint(1) NOT NULL DEFAULT '0',
  `entries-edit` tinyint(1) NOT NULL DEFAULT '0',
  `entries-delete` tinyint(1) NOT NULL DEFAULT '0',
  `entries-view` tinyint(1) NOT NULL DEFAULT '0',
  `groups-add` tinyint(1) NOT NULL DEFAULT '0',
  `groups-edit` tinyint(1) NOT NULL DEFAULT '0',
  `groups-delete` tinyint(1) NOT NULL DEFAULT '0',
  `ledgers-add` tinyint(1) NOT NULL DEFAULT '0',
  `ledgers-edit` tinyint(1) NOT NULL DEFAULT '0',
  `ledgers-delete` tinyint(1) NOT NULL DEFAULT '0',
  `reports-index` tinyint(1) NOT NULL DEFAULT '0',
  `reports-balancesheet` tinyint(1) NOT NULL DEFAULT '0',
  `reports-profitloss` tinyint(1) NOT NULL DEFAULT '0',
  `reports-trialbalance` tinyint(1) NOT NULL DEFAULT '0',
  `reports-ledgerstatement` tinyint(1) NOT NULL DEFAULT '0',
  `reports-ledgerentries` tinyint(1) NOT NULL DEFAULT '0',
  `reports-reconciliation` tinyint(1) NOT NULL DEFAULT '0',
  `search-index` tinyint(1) NOT NULL DEFAULT '0',
  `admin-log` tinyint(1) NOT NULL DEFAULT '0',
    PRIMARY KEY(`id`),
    UNIQUE KEY `unique_id` (`id`),
    KEY `id` (`id`),
    KEY `group_id` (`group_id`)
) DEFAULT CHARSET=utf8,
COLLATE=utf8_unicode_ci,
AUTO_INCREMENT=1,
ENGINE=InnoDB;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `group_id`, `account_settings-index`, `account_settings-main`, `account_settings-cf`, `account_settings-email`, `account_settings-printer`, `account_settings-tags`, `account_settings-entrytypes`, `account_settings-lock`, `accounts-index`, `dashboard-index`, `entries-index`, `entries-add`, `entries-edit`, `entries-delete`, `entries-view`, `groups-add`, `groups-edit`, `groups-delete`, `ledgers-add`, `ledgers-edit`, `ledgers-delete`, `reports-index`, `reports-balancesheet`, `reports-profitloss`, `reports-trialbalance`, `reports-ledgerstatement`, `reports-ledgerentries`, `reports-reconciliation`, `search-index`, `admin-log`) VALUES
(1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0),
(2, 2, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(3, 3, 1, 1, 0, 0, 0, 0, 0, 0, 1, 1, 1, 1, 0, 0, 1, 1, 0, 0, 1, 0, 0, 1, 1, 1, 0, 0, 0, 0, 1, 0),
(4, 4, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 1, 0, 0, 0, 1, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(18) NOT NULL AUTO_INCREMENT,
  `sitename` varchar(255) DEFAULT NULL,
  `drcr_toby` varchar(4) DEFAULT NULL,
  `date_format` varchar(25) DEFAULT NULL,
  `entry_form` tinyint(1) DEFAULT NULL,
  `enable_logging` tinyint(1) DEFAULT NULL,
  `row_count` tinyint(4) DEFAULT NULL,
  `user_registration` tinyint(4) DEFAULT NULL,
  `admin_verification` tinyint(4) DEFAULT NULL,
  `email_verification` tinyint(4) DEFAULT NULL,
  `email_protocol` varchar(4) DEFAULT NULL,
  `smtp_host` varchar(9) DEFAULT NULL,
  `smtp_port` smallint(6) DEFAULT NULL,
  `smtp_tls` tinyint(4) DEFAULT NULL,
  `smtp_username` varchar(111) DEFAULT NULL,
  `smtp_password` varchar(111) DEFAULT NULL,
  `email_from` varchar(16) DEFAULT NULL,
  `version` decimal(2,1) DEFAULT NULL,
  `language` varchar(11) DEFAULT NULL,
  `dark_mode` TINYINT(1) NOT NULL DEFAULT '0',
    PRIMARY KEY(`id`),
    UNIQUE KEY `unique_id` (`id`)
) DEFAULT CHARSET=utf8,
COLLATE=utf8_unicode_ci,
AUTO_INCREMENT=1,
ENGINE=InnoDB;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `sitename`, `drcr_toby`, `date_format`, `entry_form`, `enable_logging`, `row_count`, `user_registration`, `admin_verification`, `email_verification`, `email_protocol`, `smtp_host`, `smtp_port`, `smtp_tls`, `smtp_username`, `smtp_password`, `email_from`, `version`, `language`, `dark_mode`) VALUES
(1, 'Accountant', 'drcr', 'd-M-Y|dd-M-yy|dd-MMM-yyyy', 1, 1, 10, 1, 1, 0, 'smtp', 'localhost', 3306, 0, 'example@gmail.com', 'password', 'info@company.com', '6.0', 'english', '0');

-- --------------------------------------------------------

--
-- Table structure for table `useraccounts`
--

CREATE TABLE `useraccounts` (
  `id` int(18) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(18) NOT NULL,
  `account_id` varchar(18) NOT NULL,
  `role` varchar(11) NOT NULL,
  PRIMARY KEY(`id`),
  UNIQUE KEY `unique_id` (`id`),
  KEY `id` (`id`),
  KEY `account_id` (`account_id`),
  KEY `user_id` (`user_id`)
) DEFAULT CHARSET=utf8,
COLLATE=utf8_unicode_ci,
AUTO_INCREMENT=1,
ENGINE=InnoDB;


-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(18) NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(18) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(11) NOT NULL,
  `email` varchar(25) NOT NULL,
  `activation_code` varchar(1) DEFAULT NULL,
  `forgotten_password_code` varchar(1) DEFAULT NULL,
  `forgotten_password_time` varchar(1) DEFAULT NULL,
  `remember_code` varchar(25) DEFAULT NULL,
  `created_on` int(11) unsigned DEFAULT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `first_name` varchar(11) DEFAULT NULL,
  `last_name` varchar(11) DEFAULT NULL,
  `company` varchar(25) DEFAULT NULL,
  `phone` bigint(20) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `accounts` varchar(11) DEFAULT NULL,
  `all_accounts` tinyint(1) DEFAULT NULL,
  PRIMARY KEY(`id`),
  UNIQUE KEY `unique_id` (`id`)
) DEFAULT CHARSET=utf8,
COLLATE=utf8_unicode_ci,
AUTO_INCREMENT=1,
ENGINE=InnoDB;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`, `image`, `accounts`, `all_accounts`) VALUES
(1, '127.0.0.1', 'administrator', '$2y$08$EGx2jQH.YUr3zbhr1M2Fxe8chLikvG2Q2L3K9x1lhjOuDN820YVRu', '', 'admin@admin.com', '', '', '', 'wVSNu3sKc57wYS31vjV4m.', 1268889823, 1656912514, 1, 'Admin', 'istratora', 'ADMIN', 1234567890, 'administrator.png', '[\"all\"]', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE `users_groups` (
  `id` int(18) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(18) NOT NULL,
  `group_id` varchar(18) NOT NULL,
  PRIMARY KEY(`id`),
  UNIQUE KEY `unique_id` (`id`),
  KEY `id` (`id`),
  KEY `user_id` (`user_id`),
  KEY `group_id` (`group_id`)
) DEFAULT CHARSET=utf8,
COLLATE=utf8_unicode_ci,
AUTO_INCREMENT=1,
ENGINE=InnoDB;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
