-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 20, 2022 at 11:16 AM
-- Server version: 5.7.38-cll-lve
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vljjgcrj_iems_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_mails`
--

CREATE TABLE `admin_mails` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `msg_id` bigint(20) UNSIGNED DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_msg` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `read_at` tinyint(4) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_mails`
--

INSERT INTO `admin_mails` (`id`, `user_id`, `msg_id`, `title`, `message`, `email_msg`, `type`, `read_at`, `created_by`, `updated_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 7, 32, 'Lorem Ipsum', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', '<!DOCTYPE html><html><head><title>IEM System | Contact Form Enquiry</title></head><body><table width=100% border=0><tr><td><tr><td colspan=2 style=position:absolute;left:350;top:60;><h2><font color = #346699>IEM System</font><h2></td></tr><tr><td colspan=2><br/><br/><br/><strong>Hello Yogesh,</strong></td></tr><tr><td colspan=2><br/><font size=3><b>Message: </b>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</font></td></tr><tr><td colspan=2><br/><br/><font size=3><b>Best regards,</b><br>IMES TEAM</font></td></tr></table></body></html>', NULL, 1, 1, NULL, NULL, '2022-07-06 06:19:59', '2022-07-06 06:19:59'),
(2, 1, NULL, 'cooling fan not working', 'Testing', '<!DOCTYPE html><html><head><title>IEM System | Job Order Form</title></head><body><table width=100% border=0><tr><td><tr><td colspan=2 style=position:absolute;left:350;top:60;><h2><font color = #346699>IEM System</font><h2></td></tr><tr><td colspan=2><br/><br/><br/><strong>To IMES TEAM,</strong></td></tr><tr><td colspan=2><br/><font size=3><b>Title: </b>cooling fan not working</font></td></tr><tr><td colspan=2><br/><font size=3><b>Start Date: </b>2022-06-07 12:25:00</font></td></tr><tr><td colspan=2><br/><font size=3><b>End Date: </b>2022-06-07 01:25:00</font></td></tr><tr><td colspan=2><br/><font size=3><b>Remarks: </b>Testing</font></td></tr><tr><td colspan=2><br/><br/><font size=3><b>Best regards,</b><br>SuperAdmin</font></td></tr></table></body></html>', 'job_order_reported', 0, 1, NULL, NULL, '2022-07-06 23:46:08', '2022-07-06 23:46:08'),
(3, 1, NULL, 'Cooling Tower', 'Testing', '<!DOCTYPE html><html><head><title>IEM System | Job Order Form</title></head><body><table width=100% border=0><tr><td><tr><td colspan=2 style=position:absolute;left:350;top:60;><h2><font color = #346699>IEM System</font><h2></td></tr><tr><td colspan=2><br/><br/><br/><strong>To IMES TEAM,</strong></td></tr><tr><td colspan=2><br/><font size=3><b>Title: </b>Cooling Tower</font></td></tr><tr><td colspan=2><br/><font size=3><b>Start Date: </b>2022-06-07 12:25:00</font></td></tr><tr><td colspan=2><br/><font size=3><b>End Date: </b>2022-06-07 01:25:00</font></td></tr><tr><td colspan=2><br/><font size=3><b>Remarks: </b>Testing</font></td></tr><tr><td colspan=2><br/><br/><font size=3><b>Best regards,</b><br>SuperAdmin</font></td></tr></table></body></html>', 'job_order_reported', 0, 1, NULL, NULL, '2022-07-18 06:44:52', '2022-07-18 06:44:52'),
(4, 1, NULL, 'Cooling Tower', 'Testing', '<!DOCTYPE html><html><head><title>IEM System | Job Order Form</title></head><body><table width=100% border=0><tr><td><tr><td colspan=2 style=position:absolute;left:350;top:60;><h2><font color = #346699>IEM System</font><h2></td></tr><tr><td colspan=2><br/><br/><br/><strong>To IMES TEAM,</strong></td></tr><tr><td colspan=2><br/><font size=3><b>Title: </b>Cooling Tower</font></td></tr><tr><td colspan=2><br/><font size=3><b>Start Date: </b>2022-06-07 12:25:00</font></td></tr><tr><td colspan=2><br/><font size=3><b>End Date: </b>2022-06-07 01:25:00</font></td></tr><tr><td colspan=2><br/><font size=3><b>Remarks: </b>Testing</font></td></tr><tr><td colspan=2><br/><br/><font size=3><b>Best regards,</b><br>SuperAdmin</font></td></tr></table></body></html>', 'job_order_reported', 0, 1, NULL, NULL, '2022-07-18 06:46:40', '2022-07-18 06:46:40'),
(5, 1, NULL, 'Cooling Tower', 'Testing', '<!DOCTYPE html><html><head><title>IEM System | Job Order Form</title></head><body><table width=100% border=0><tr><td><tr><td colspan=2 style=position:absolute;left:350;top:60;><h2><font color = #346699>IEM System</font><h2></td></tr><tr><td colspan=2><br/><br/><br/><strong>To IMES TEAM,</strong></td></tr><tr><td colspan=2><br/><font size=3><b>Title: </b>Cooling Tower</font></td></tr><tr><td colspan=2><br/><font size=3><b>Start Date: </b>2022-06-07 12:25:00</font></td></tr><tr><td colspan=2><br/><font size=3><b>End Date: </b>1970-01-01 05:30:00</font></td></tr><tr><td colspan=2><br/><font size=3><b>Remarks: </b>Testing</font></td></tr><tr><td colspan=2><br/><br/><font size=3><b>Best regards,</b><br>SuperAdmin</font></td></tr></table></body></html>', 'job_order_reported', 0, 1, NULL, NULL, '2022-07-18 06:46:57', '2022-07-18 06:46:57'),
(6, 1, NULL, 'Cooling Tower', 'Testing', '<!DOCTYPE html><html><head><title>IEM System | Job Order Form</title></head><body><table width=100% border=0><tr><td><tr><td colspan=2 style=position:absolute;left:350;top:60;><h2><font color = #346699>IEM System</font><h2></td></tr><tr><td colspan=2><br/><br/><br/><strong>To IMES TEAM,</strong></td></tr><tr><td colspan=2><br/><font size=3><b>Title: </b>Cooling Tower</font></td></tr><tr><td colspan=2><br/><font size=3><b>Start Date: </b>2022-06-07 12:25:00</font></td></tr><tr><td colspan=2><br/><font size=3><b>End Date: </b>1970-01-01 05:30:00</font></td></tr><tr><td colspan=2><br/><font size=3><b>Remarks: </b>Testing</font></td></tr><tr><td colspan=2><br/><br/><font size=3><b>Best regards,</b><br>SuperAdmin</font></td></tr></table></body></html>', 'job_order_reported', 0, 1, NULL, NULL, '2022-07-18 06:53:07', '2022-07-18 06:53:07'),
(7, 8, 43, 'Cooling Tower', 'Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance.', '<!DOCTYPE html><html><head><title>IEM System | Contact Form Enquiry</title></head><body><table width=100% border=0><tr><td><tr><td colspan=2 style=position:absolute;left:350;top:60;><h2><font color = #346699>IEM System</font><h2></td></tr><tr><td colspan=2><br/><br/><br/><strong>Hello Sachin,</strong></td></tr><tr><td colspan=2><br/><font size=3><b>Message: </b>Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance.</font></td></tr><tr><td colspan=2><br/><br/><font size=3><b>Best regards,</b><br>IMES TEAM</font></td></tr></table></body></html>', NULL, NULL, 1, NULL, NULL, '2022-07-20 05:11:09', '2022-07-20 05:11:09');

-- --------------------------------------------------------

--
-- Table structure for table `contact_forms`
--

CREATE TABLE `contact_forms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_msg` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `read_at` tinyint(4) DEFAULT NULL,
  `admin_read_at` tinyint(4) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact_forms`
--

INSERT INTO `contact_forms` (`id`, `user_id`, `title`, `message`, `email_msg`, `type`, `read_at`, `admin_read_at`, `created_by`, `updated_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(32, 7, 'Lorem Ipsum', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '<!DOCTYPE html><html><head><title>IEM System | Contact Form Enquiry</title></head><body><table width=100% border=0><tr><td><tr><td colspan=2 style=position:absolute;left:350;top:60;><h2><font color = #346699>IEM System</font><h2></td></tr><tr><td colspan=2><br/><br/><br/><strong>To IMES TEAM,</strong></td></tr><tr><td colspan=2><br/><font size=3><b>Title/Subject: </b>Lorem Ipsum</font></td></tr><tr><td colspan=2><br/><font size=3><b>Message: </b>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</font></td></tr><tr><td colspan=2><br/><br/><font size=3><b>Best regards,</b><br>Yogesh</font></td></tr></table></body></html>', NULL, 0, 1, 7, NULL, NULL, '2022-07-06 06:13:54', '2022-07-18 13:20:19'),
(34, 8, 'cooling fan not working', 'Testing', '<!DOCTYPE html><html><head><title>IEM System | Job Order Form</title></head><body><table width=100% border=0><tr><td><tr><td colspan=2 style=position:absolute;left:350;top:60;><h2><font color = #346699>IEM System</font><h2></td></tr><tr><td colspan=2><br/><br/><br/><strong>To IMES TEAM,</strong></td></tr><tr><td colspan=2><br/><font size=3><b>Title: </b>cooling fan not working</font></td></tr><tr><td colspan=2><br/><font size=3><b>Start Date: </b>2022-06-07 12:25:00</font></td></tr><tr><td colspan=2><br/><font size=3><b>End Date: </b>2022-06-07 01:25:00</font></td></tr><tr><td colspan=2><br/><font size=3><b>Remarks: </b>Testing</font></td></tr><tr><td colspan=2><br/><br/><font size=3><b>Best regards,</b><br>SuperAdmin</font></td></tr></table></body></html>', 'job_order_reported', 0, 1, 1, NULL, NULL, '2022-07-06 23:43:42', '2022-07-18 13:26:22'),
(36, 8, 'fdfsdf', 'sfds', '<!DOCTYPE html><html><head><title>IEM System | Job Order </title></head><body><table width=100% border=0><tr><td><tr><td colspan=2 style=position:absolute;left:350;top:60;><h2><font color = #346699>IEM System</font><h2></td></tr><tr><td colspan=2><br/><br/><br/><strong>Hello Sachin,</strong></td></tr><tr><td colspan=2><br/><font size=3><b>Title/ Equipment Issue: </b>fdfsdf</font></td></tr><tr><td colspan=2><br/><font size=3><b>Order Date: </b>2022-07-07 06:00:00</font></td></tr><tr><td colspan=2><br/><font size=3><b>Address: </b>sdfsdf</font></td></tr><tr><td colspan=2><br/><font size=3><b>Scope Of Work: </b>sfds</font></td></tr><tr><td colspan=2><br/><font size=3><b>Client Name: </b>Yogesh</font></td></tr><tr><td colspan=2><br/><br/><font size=3><b>Best regards,</b><br>IMES TEAM</font></td></tr></table></body></html>', 'new_job_order', 0, 1, 1, NULL, NULL, '2022-07-07 00:31:40', '2022-07-18 13:28:53'),
(37, 8, 'ffdg', 'dfgdf', '<!DOCTYPE html><html><head><title>IEM System | Job Order </title></head><body><table width=100% border=0><tr><td><tr><td colspan=2 style=position:absolute;left:350;top:60;><h2><font color = #346699>IEM System</font><h2></td></tr><tr><td colspan=2><br/><br/><br/><strong>Hello Sachin,</strong></td></tr><tr><td colspan=2><br/><font size=3><b>Title/ Equipment Issue: </b>ffdg</font></td></tr><tr><td colspan=2><br/><font size=3><b>Order Date: </b>2022-07-07 06:01:00</font></td></tr><tr><td colspan=2><br/><font size=3><b>Address: </b>gdfgd</font></td></tr><tr><td colspan=2><br/><font size=3><b>Scope Of Work: </b>dfgdf</font></td></tr><tr><td colspan=2><br/><font size=3><b>Client Name: </b>Sandeep</font></td></tr><tr><td colspan=2><br/><br/><font size=3><b>Best regards,</b><br>IMES TEAM</font></td></tr></table></body></html>', 'new_job_order', 0, 1, 1, NULL, NULL, '2022-07-07 00:32:12', '2022-07-19 13:01:13'),
(38, 8, 'Cooling Tower', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '<!DOCTYPE html><html><head><title>IEM System | Job Order </title></head><body><table width=100% border=0><tr><td><tr><td colspan=2 style=position:absolute;left:350;top:60;><h2><font color = #346699>IEM System</font><h2></td></tr><tr><td colspan=2><br/><br/><br/><strong>Hello Sachin,</strong></td></tr><tr><td colspan=2><br/><font size=3><b>Title/ Equipment Issue: </b>Cooling Tower</font></td></tr><tr><td colspan=2><br/><font size=3><b>Order Date: </b>2022-08-07 06:13:00</font></td></tr><tr><td colspan=2><br/><font size=3><b>Address: </b>1-b, Sevashram Society, Ellora Park</font></td></tr><tr><td colspan=2><br/><font size=3><b>Scope Of Work: </b>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</font></td></tr><tr><td colspan=2><br/><font size=3><b>Client Name: </b>Sandeep</font></td></tr><tr><td colspan=2><br/><br/><font size=3><b>Best regards,</b><br>IMES TEAM</font></td></tr></table></body></html>', 'new_job_order', 0, 0, 1, NULL, NULL, '2022-07-08 00:46:59', '2022-07-08 00:46:59'),
(39, 8, 'Cooling Tower', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n\r\nIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', '<!DOCTYPE html><html><head><title>IEM System | Equipment Issue </title></head><body><table width=100% border=0><tr><td><tr><td colspan=2 style=position:absolute;left:350;top:60;><h2><font color = #346699>IEM System</font><h2></td></tr><tr><td colspan=2><br/><br/><br/><strong>Hello Sachin,</strong></td></tr><tr><td colspan=2><br/><font size=3><b>Title/ Equipment Issue: </b>Cooling Tower</font></td></tr><tr><td colspan=2><br/><font size=3><b>Order Date: </b>2022-08-07 06:13:00</font></td></tr><tr><td colspan=2><br/><font size=3><b>Address: </b>1-b, Sevashram Society, Ellora Park</font></td></tr><tr><td colspan=2><br/><font size=3><b>Scope Of Work: </b>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n\r\nIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</font></td></tr><tr><td colspan=2><br/><font size=3><b>Client Name: </b>Sandeep</font></td></tr><tr><td colspan=2><br/><br/><font size=3><b>Best regards,</b><br>IMES TEAM</font></td></tr></table></body></html>', 'new_job_order', 0, 0, 1, NULL, NULL, '2022-07-08 01:01:47', '2022-07-08 01:01:47'),
(40, 8, 'Chiller', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance.', '<!DOCTYPE html><html><head><title>IEM System | Equipment Issue </title></head><body><table width=100% border=0><tr><td><tr><td colspan=2 style=position:absolute;left:350;top:60;><h2><font color = #346699>IEM System</font><h2></td></tr><tr><td colspan=2><br/><br/><br/><strong>Hello Sachin,</strong></td></tr><tr><td colspan=2><br/><font size=3><b>Title/ Equipment Issue: </b>Chiller</font></td></tr><tr><td colspan=2><br/><font size=3><b>Order Date: </b>2022-08-07 06:36:00</font></td></tr><tr><td colspan=2><br/><font size=3><b>Address: </b>6th Flr, B Wing, Bsel Tak Park, Sector 30, Opp Vashi Railway Station, Vashi, Navi Mumbai</font></td></tr><tr><td colspan=2><br/><font size=3><b>Scope Of Work: </b>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance.</font></td></tr><tr><td colspan=2><br/><font size=3><b>Client Name: </b>Yogesh</font></td></tr><tr><td colspan=2><br/><br/><font size=3><b>Best regards,</b><br>IMES TEAM</font></td></tr></table></body></html>', 'new_job_order', 0, 0, 1, NULL, NULL, '2022-07-08 01:07:23', '2022-07-08 01:07:23'),
(41, 8, 'Chiller', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance.', '<!DOCTYPE html><html><head><title>IEM System | Equipment Issue </title></head><body><table width=100% border=0><tr><td><tr><td colspan=2 style=position:absolute;left:350;top:60;><h2><font color = #346699>IEM System</font><h2></td></tr><tr><td colspan=2><br/><br/><br/><strong>Hello Sachin,</strong></td></tr><tr><td colspan=2><br/><font size=3><b>Title/ Equipment Issue: </b>Chiller</font></td></tr><tr><td colspan=2><br/><font size=3><b>Order Date: </b>2022-08-07 06:38:00</font></td></tr><tr><td colspan=2><br/><font size=3><b>Address: </b>6th Flr, B Wing, Bsel Tak Park, Sector 30, Opp Vashi Railway Station, Vashi, Navi Mumbai</font></td></tr><tr><td colspan=2><br/><font size=3><b>Scope Of Work: </b>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance.</font></td></tr><tr><td colspan=2><br/><font size=3><b>Client Name: </b>Yogesh</font></td></tr><tr><td colspan=2><br/><br/><font size=3><b>Best regards,</b><br>IMES TEAM</font></td></tr></table></body></html>', 'new_job_order', 0, 0, 1, NULL, NULL, '2022-07-08 01:08:22', '2022-07-08 01:08:22'),
(42, 8, 'Cooling Tower', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance.', '<!DOCTYPE html><html><head><title>IEM System | Equipment Issue </title></head><body><table width=100% border=0><tr><td><tr><td colspan=2 style=position:absolute;left:350;top:60;><h2><font color = #346699>IEM System</font><h2></td></tr><tr><td colspan=2><br/><br/><br/><strong>Hello Sachin,</strong></td></tr><tr><td colspan=2><br/><font size=3><b>Title/ Equipment Issue: </b>Cooling Tower</font></td></tr><tr><td colspan=2><br/><font size=3><b>Order Date: </b>2022-08-07 03:30:00</font></td></tr><tr><td colspan=2><br/><font size=3><b>Address: </b>6th Flr, B Wing, Bsel Tak Park, Sector 30, Opp Vashi Railway Station, Vashi, Navi Mumbai</font></td></tr><tr><td colspan=2><br/><font size=3><b>Scope Of Work: </b>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance.</font></td></tr><tr><td colspan=2><br/><font size=3><b>Client Name: </b>Yogesh</font></td></tr><tr><td colspan=2><br/><br/><font size=3><b>Best regards,</b><br>IMES TEAM</font></td></tr></table></body></html>', 'new_job_order', 0, 0, 1, NULL, NULL, '2022-07-08 10:01:08', '2022-07-08 10:01:08'),
(43, 8, 'Cooling Tower', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance.', '<!DOCTYPE html><html><head><title>IEM System | Equipment Issue </title></head><body><table width=100% border=0><tr><td><tr><td colspan=2 style=position:absolute;left:350;top:60;><h2><font color = #346699>IEM System</font><h2></td></tr><tr><td colspan=2><br/><br/><br/><strong>Hello Sachin,</strong></td></tr><tr><td colspan=2><br/><font size=3><b>Title/ Equipment Issue: </b>Cooling Tower</font></td></tr><tr><td colspan=2><br/><font size=3><b>Order Date: </b>2022-08-07 03:30:00</font></td></tr><tr><td colspan=2><br/><font size=3><b>Address: </b>6th Flr, B Wing, Bsel Tak Park, Sector 30, Opp Vashi Railway Station, Vashi, Navi Mumbai</font></td></tr><tr><td colspan=2><br/><font size=3><b>Scope Of Work: </b>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance.</font></td></tr><tr><td colspan=2><br/><font size=3><b>Client Name: </b>Yogesh</font></td></tr><tr><td colspan=2><br/><br/><font size=3><b>Best regards,</b><br>IMES TEAM</font></td></tr></table></body></html>', 'new_job_order', 0, 1, 1, NULL, NULL, '2022-07-08 12:40:23', '2022-07-20 05:10:40'),
(44, 8, 'Cooling Tower', 'It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '<!DOCTYPE html><html><head><title>IEM System | New Work Order</title></head><body><table width=100% border=0><tr><td><tr><td colspan=2 style=position:absolute;left:350;top:60;><h2><font color = #346699>IEM System</font><h2></td></tr><tr><td colspan=2><br/><br/><br/><strong>Hello Sachin,</strong></td></tr><tr><td colspan=2><br/><font size=3><b>Title/ Equipment Issue: </b></font></td></tr><tr><td colspan=2><br/><font size=3><b>Order Date: </b>2022-08-07 07:02:00</font></td></tr><tr><td colspan=2><br/><font size=3><b>Address: </b>Silver Park, Wagle Estate, Road No 3, Mulund Checknaka, Thane(w)</font></td></tr><tr><td colspan=2><br/><font size=3><b>Scope Of Work: </b>It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</font></td></tr><tr><td colspan=2><br/><font size=3><b>Client Name: </b>Dr. Horacio Oduber Hospital</font></td></tr><tr><td colspan=2><br/><br/><font size=3><b>Best regards,</b><br>IMES TEAM</font></td></tr></table></body></html>', 'new_job_order', 0, 0, 1, NULL, NULL, '2022-07-08 13:38:16', '2022-07-08 13:38:16'),
(45, 8, 'Cooling Tower', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '<!DOCTYPE html><html><head><title>IEM System | Equipment Issue </title></head><body><table width=100% border=0><tr><td><tr><td colspan=2 style=position:absolute;left:350;top:60;><h2><font color = #346699>IEM System</font><h2></td></tr><tr><td colspan=2><br/><br/><br/><strong>Hello Sachin,</strong></td></tr><tr><td colspan=2><br/><font size=3><b>Title/ Equipment Issue: </b>Cooling Tower</font></td></tr><tr><td colspan=2><br/><font size=3><b>Order Date: </b>2022-11-07 11:40:00</font></td></tr><tr><td colspan=2><br/><font size=3><b>Address: </b>6th Flr, B Wing, Bsel Tak Park, Sector 30, Opp Vashi Railway Station, Vashi, Navi Mumbai</font></td></tr><tr><td colspan=2><br/><font size=3><b>Scope Of Work: </b>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</font></td></tr><tr><td colspan=2><br/><font size=3><b>Client Name: </b>Queen Beatrix International Airport</font></td></tr><tr><td colspan=2><br/><br/><font size=3><b>Best regards,</b><br>IMES TEAM</font></td></tr></table></body></html>', 'new_job_order', 0, 0, 1, NULL, NULL, '2022-07-11 06:17:08', '2022-07-11 06:17:08'),
(46, 8, 'Cooling Tower', 'Lorem Ipsum Is Simply Dummy Text Of The Printing And Typesetting Industry. Lorem Ipsum Has Been The Industry\'s Standard Dummy Text Ever Since The 1500s, When An Unknown Printer Took A Galley Of Type And Scrambled It To Make A Type Specimen Book. It Has Survived Not Only Five Centuries, But Also The Leap Into Electronic Typesetting, Remaining Essentially Unchanged. It Was Popularised In The 1960s With The Release Of Letraset Sheets Containing Lorem Ipsum Passages, And More Recently With Desktop Publishing Software Like Aldus PageMaker Including Versions Of Lorem Ipsum.', '<!DOCTYPE html><html><head><title>IEM System | New Work Order</title></head><body><table width=100% border=0><tr><td><tr><td colspan=2 style=position:absolute;left:350;top:60;><h2><font color = #346699>IEM System</font><h2></td></tr><tr><td colspan=2><br/><br/><br/><strong>Hello Sachin,</strong></td></tr><tr><td colspan=2><br/><font size=3><b>Title/ Equipment Issue: </b>Cooling Tower</font></td></tr><tr><td colspan=2><br/><font size=3><b>Order Date: </b>2022-11-07 12:34:00</font></td></tr><tr><td colspan=2><br/><font size=3><b>Address: </b>Silver Park, Wagle Estate, Road No 3, Mulund Checknaka, Thane(w)</font></td></tr><tr><td colspan=2><br/><font size=3><b>Scope Of Work: </b>Lorem Ipsum Is Simply Dummy Text Of The Printing And Typesetting Industry. Lorem Ipsum Has Been The Industry\'s Standard Dummy Text Ever Since The 1500s, When An Unknown Printer Took A Galley Of Type And Scrambled It To Make A Type Specimen Book. It Has Survived Not Only Five Centuries, But Also The Leap Into Electronic Typesetting, Remaining Essentially Unchanged. It Was Popularised In The 1960s With The Release Of Letraset Sheets Containing Lorem Ipsum Passages, And More Recently With Desktop Publishing Software Like Aldus PageMaker Including Versions Of Lorem Ipsum.</font></td></tr><tr><td colspan=2><br/><font size=3><b>Client Name: </b>Dr. Horacio Oduber Hospital</font></td></tr><tr><td colspan=2><br/><br/><font size=3><b>Best regards,</b><br>IMES TEAM</font></td></tr></table></body></html>', 'new_job_order', 0, 0, 1, NULL, NULL, '2022-07-11 07:05:51', '2022-07-11 07:05:51'),
(47, 8, 'Cooling Tower', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source.', '<!DOCTYPE html><html><head><title>IEM System | New Work Order</title></head><body><table width=100% border=0><tr><td><tr><td colspan=2 style=position:absolute;left:350;top:60;><h2><font color = #346699>IEM System</font><h2></td></tr><tr><td colspan=2><br/><br/><br/><strong>Hello Sachin,</strong></td></tr><tr><td colspan=2><br/><font size=3><b>Title/ Equipment Issue: </b>Cooling Tower</font></td></tr><tr><td colspan=2><br/><font size=3><b>Order Date: </b>2022-11-07 12:36:00</font></td></tr><tr><td colspan=2><br/><font size=3><b>Address: </b>Silver Park, Wagle Estate, Road No 3, Mulund Checknaka, Thane(w)</font></td></tr><tr><td colspan=2><br/><font size=3><b>Scope Of Work: </b>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source.</font></td></tr><tr><td colspan=2><br/><font size=3><b>Client Name: </b>Dr. Horacio Oduber Hospital</font></td></tr><tr><td colspan=2><br/><br/><font size=3><b>Best regards,</b><br>IMES TEAM</font></td></tr></table></body></html>', 'new_job_order', 0, 0, 1, NULL, NULL, '2022-07-11 07:06:31', '2022-07-11 07:06:31'),
(48, 15, 'Cooling Tower', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source.', '<!DOCTYPE html><html><head><title>IEM System | Equipment Issue </title></head><body><table width=100% border=0><tr><td><tr><td colspan=2 style=position:absolute;left:350;top:60;><h2><font color = #346699>IEM System</font><h2></td></tr><tr><td colspan=2><br/><br/><br/><strong>Hello Sunita,</strong></td></tr><tr><td colspan=2><br/><font size=3><b>Title/ Equipment Issue: </b>Cooling Tower</font></td></tr><tr><td colspan=2><br/><font size=3><b>Order Date: </b>2022-07-18 10:24:00</font></td></tr><tr><td colspan=2><br/><font size=3><b>Address: </b>6th Flr, B Wing, Bsel Tak Park, Sector 30, Opp Vashi Railway Station, Vashi, Navi Mumbai</font></td></tr><tr><td colspan=2><br/><font size=3><b>Scope Of Work: </b>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source.</font></td></tr><tr><td colspan=2><br/><font size=3><b>Client Name: </b>Queen Beatrix International Airport</font></td></tr><tr><td colspan=2><br/><br/><font size=3><b>Best regards,</b><br>IMES TEAM</font></td></tr></table></body></html>', 'new_job_order', 0, 0, 1, NULL, NULL, '2022-07-18 04:55:23', '2022-07-18 04:55:23'),
(49, 15, 'Cooling Tower', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source.', '<!DOCTYPE html><html><head><title>IEM System | New Work Order</title></head><body><table width=100% border=0><tr><td><tr><td colspan=2 style=position:absolute;left:350;top:60;><h2><font color = #346699>IEM System</font><h2></td></tr><tr><td colspan=2><br/><br/><br/><strong>Hello Sunita,</strong></td></tr><tr><td colspan=2><br/><font size=3><b>Title/ Equipment Issue: </b>Cooling Tower</font></td></tr><tr><td colspan=2><br/><font size=3><b>Order Date: </b>2022-07-18 10:25:00</font></td></tr><tr><td colspan=2><br/><font size=3><b>Address: </b>6th Flr, B Wing, Bsel Tak Park, Sector 30, Opp Vashi Railway Station, Vashi, Navi Mumbai</font></td></tr><tr><td colspan=2><br/><font size=3><b>Scope Of Work: </b>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source.</font></td></tr><tr><td colspan=2><br/><font size=3><b>Client Name: </b>Queen Beatrix International Airport</font></td></tr><tr><td colspan=2><br/><br/><font size=3><b>Best regards,</b><br>IMES TEAM</font></td></tr></table></body></html>', 'new_job_order', 0, 0, 1, NULL, NULL, '2022-07-18 04:56:26', '2022-07-18 04:56:26'),
(50, 15, 'Cooling Tower', 'Contrary To Popular Belief, Lorem Ipsum Is Not Simply Random Text. It Has Roots In A Piece Of Classical Latin Literature From 45 BC, Making It Over 2000 Years Old. Richard McClintock, A Latin Professor At Hampden-Sydney College In Virginia, Looked Up One Of The More Obscure Latin Words, Consectetur, From A Lorem Ipsum Passage, And Going Through The Cites Of The Word In Classical Literature, Discovered The Undoubtable Source.', '<!DOCTYPE html><html><head><title>IEM System | New Work Order</title></head><body><table width=100% border=0><tr><td><tr><td colspan=2 style=position:absolute;left:350;top:60;><h2><font color = #346699>IEM System</font><h2></td></tr><tr><td colspan=2><br/><br/><br/><strong>Hello Sunita,</strong></td></tr><tr><td colspan=2><br/><font size=3><b>Title/ Equipment Issue: </b>Cooling Tower</font></td></tr><tr><td colspan=2><br/><font size=3><b>Order Date: </b>2022-07-18 11:58:00</font></td></tr><tr><td colspan=2><br/><font size=3><b>Address: </b>Silver Park, Wagle Estate, Road No 3, Mulund Checknaka, Thane(w)</font></td></tr><tr><td colspan=2><br/><font size=3><b>Scope Of Work: </b>Contrary To Popular Belief, Lorem Ipsum Is Not Simply Random Text. It Has Roots In A Piece Of Classical Latin Literature From 45 BC, Making It Over 2000 Years Old. Richard McClintock, A Latin Professor At Hampden-Sydney College In Virginia, Looked Up One Of The More Obscure Latin Words, Consectetur, From A Lorem Ipsum Passage, And Going Through The Cites Of The Word In Classical Literature, Discovered The Undoubtable Source.</font></td></tr><tr><td colspan=2><br/><font size=3><b>Client Name: </b>Dr. Horacio Oduber Hospital</font></td></tr><tr><td colspan=2><br/><br/><font size=3><b>Best regards,</b><br>IMES TEAM</font></td></tr></table></body></html>', 'new_job_order', 0, 0, 1, NULL, NULL, '2022-07-18 06:28:44', '2022-07-18 06:28:44'),
(51, 15, 'Cooling Tower', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source.', '<!DOCTYPE html><html><head><title>IEM System | Equipment Issue </title></head><body><table width=100% border=0><tr><td><tr><td colspan=2 style=position:absolute;left:350;top:60;><h2><font color = #346699>IEM System</font><h2></td></tr><tr><td colspan=2><br/><br/><br/><strong>Hello Sunita,</strong></td></tr><tr><td colspan=2><br/><font size=3><b>Title/ Equipment Issue: </b>Cooling Tower</font></td></tr><tr><td colspan=2><br/><font size=3><b>Order Date: </b>2022-07-18 10:24:00</font></td></tr><tr><td colspan=2><br/><font size=3><b>Address: </b>6th Flr, B Wing, Bsel Tak Park, Sector 30, Opp Vashi Railway Station, Vashi, Navi Mumbai</font></td></tr><tr><td colspan=2><br/><font size=3><b>Scope Of Work: </b>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source.</font></td></tr><tr><td colspan=2><br/><font size=3><b>Client Name: </b>Queen Beatrix International Airport</font></td></tr><tr><td colspan=2><br/><br/><font size=3><b>Best regards,</b><br>IMES TEAM</font></td></tr></table></body></html>', 'new_job_order', 0, 0, 1, NULL, NULL, '2022-07-18 06:34:48', '2022-07-18 06:34:48'),
(52, 8, 'Cooling Tower', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '<!DOCTYPE html><html><head><title>IEM System | Equipment Issue </title></head><body><table width=100% border=0><tr><td><tr><td colspan=2 style=position:absolute;left:350;top:60;><h2><font color = #346699>IEM System</font><h2></td></tr><tr><td colspan=2><br/><br/><br/><strong>Hello Sachin,</strong></td></tr><tr><td colspan=2><br/><font size=3><b>Title/ Equipment Issue: </b>Cooling Tower</font></td></tr><tr><td colspan=2><br/><font size=3><b>Order Date: </b>2022-11-07 11:40:00</font></td></tr><tr><td colspan=2><br/><font size=3><b>Address: </b>6th Flr, B Wing, Bsel Tak Park, Sector 30, Opp Vashi Railway Station, Vashi, Navi Mumbai</font></td></tr><tr><td colspan=2><br/><font size=3><b>Scope Of Work: </b>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</font></td></tr><tr><td colspan=2><br/><font size=3><b>Client Name: </b>Queen Beatrix International Airport</font></td></tr><tr><td colspan=2><br/><br/><font size=3><b>Best regards,</b><br>IMES TEAM</font></td></tr></table></body></html>', 'new_job_order', 0, 0, 1, NULL, NULL, '2022-07-18 06:34:58', '2022-07-18 06:34:58'),
(53, 15, 'Cooling Tower', 'Testing', '<!DOCTYPE html><html><head><title>IEM System | Job Order Form</title></head><body><table width=100% border=0><tr><td><tr><td colspan=2 style=position:absolute;left:350;top:60;><h2><font color = #346699>IEM System</font><h2></td></tr><tr><td colspan=2><br/><br/><br/><strong>To IMES TEAM,</strong></td></tr><tr><td colspan=2><br/><font size=3><b>Title: </b>Cooling Tower</font></td></tr><tr><td colspan=2><br/><font size=3><b>Start Date: </b>2022-06-07 12:25:00</font></td></tr><tr><td colspan=2><br/><font size=3><b>End Date: </b>2022-06-07 01:25:00</font></td></tr><tr><td colspan=2><br/><font size=3><b>Remarks: </b>Testing</font></td></tr><tr><td colspan=2><br/><br/><font size=3><b>Best regards,</b><br>SuperAdmin</font></td></tr></table></body></html>', 'job_order_reported', 0, 0, 1, NULL, NULL, '2022-07-18 06:44:52', '2022-07-18 06:44:52'),
(54, 15, 'Cooling Tower', 'Testing', '<!DOCTYPE html><html><head><title>IEM System | Job Order Form</title></head><body><table width=100% border=0><tr><td><tr><td colspan=2 style=position:absolute;left:350;top:60;><h2><font color = #346699>IEM System</font><h2></td></tr><tr><td colspan=2><br/><br/><br/><strong>To IMES TEAM,</strong></td></tr><tr><td colspan=2><br/><font size=3><b>Title: </b>Cooling Tower</font></td></tr><tr><td colspan=2><br/><font size=3><b>Start Date: </b>2022-06-07 12:25:00</font></td></tr><tr><td colspan=2><br/><font size=3><b>End Date: </b>2022-06-07 01:25:00</font></td></tr><tr><td colspan=2><br/><font size=3><b>Remarks: </b>Testing</font></td></tr><tr><td colspan=2><br/><br/><font size=3><b>Best regards,</b><br>SuperAdmin</font></td></tr></table></body></html>', 'job_order_reported', 0, 0, 1, NULL, NULL, '2022-07-18 06:46:40', '2022-07-18 06:46:40'),
(55, 15, 'Cooling Tower', 'Testing', '<!DOCTYPE html><html><head><title>IEM System | Job Order Form</title></head><body><table width=100% border=0><tr><td><tr><td colspan=2 style=position:absolute;left:350;top:60;><h2><font color = #346699>IEM System</font><h2></td></tr><tr><td colspan=2><br/><br/><br/><strong>To IMES TEAM,</strong></td></tr><tr><td colspan=2><br/><font size=3><b>Title: </b>Cooling Tower</font></td></tr><tr><td colspan=2><br/><font size=3><b>Start Date: </b>2022-06-07 12:25:00</font></td></tr><tr><td colspan=2><br/><font size=3><b>End Date: </b>1970-01-01 05:30:00</font></td></tr><tr><td colspan=2><br/><font size=3><b>Remarks: </b>Testing</font></td></tr><tr><td colspan=2><br/><br/><font size=3><b>Best regards,</b><br>SuperAdmin</font></td></tr></table></body></html>', 'job_order_reported', 0, 0, 1, NULL, NULL, '2022-07-18 06:46:57', '2022-07-18 06:46:57'),
(56, 15, 'Cooling Tower', 'Testing', '<!DOCTYPE html><html><head><title>IEM System | Job Order Form</title></head><body><table width=100% border=0><tr><td><tr><td colspan=2 style=position:absolute;left:350;top:60;><h2><font color = #346699>IEM System</font><h2></td></tr><tr><td colspan=2><br/><br/><br/><strong>To IMES TEAM,</strong></td></tr><tr><td colspan=2><br/><font size=3><b>Title: </b>Cooling Tower</font></td></tr><tr><td colspan=2><br/><font size=3><b>Start Date: </b>2022-06-07 12:25:00</font></td></tr><tr><td colspan=2><br/><font size=3><b>End Date: </b>1970-01-01 05:30:00</font></td></tr><tr><td colspan=2><br/><font size=3><b>Remarks: </b>Testing</font></td></tr><tr><td colspan=2><br/><br/><font size=3><b>Best regards,</b><br>SuperAdmin</font></td></tr></table></body></html>', 'job_order_reported', 0, 0, 1, NULL, NULL, '2022-07-18 06:53:07', '2022-07-18 06:53:07'),
(57, 8, 'Chiller', '\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\"', '<!DOCTYPE html><html><head><title>IEM System | Equipment Issue </title></head><body><table width=100% border=0><tr><td><tr><td colspan=2 style=position:absolute;left:350;top:60;><h2><font color = #346699>IEM System</font><h2></td></tr><tr><td colspan=2><br/><br/><br/><strong>Hello Sachin,</strong></td></tr><tr><td colspan=2><br/><font size=3><b>Title/ Equipment Issue: </b>Chiller</font></td></tr><tr><td colspan=2><br/><font size=3><b>Order Date: </b>2022-07-19 10:57:00</font></td></tr><tr><td colspan=2><br/><font size=3><b>Address: </b>Silver Park, Wagle Estate, Road No 3, Mulund Checknaka, Thane(w)</font></td></tr><tr><td colspan=2><br/><font size=3><b>Scope Of Work: </b>\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\"</font></td></tr><tr><td colspan=2><br/><font size=3><b>Client Name: </b>Dr. Horacio Oduber Hospital</font></td></tr><tr><td colspan=2><br/><br/><font size=3><b>Best regards,</b><br>IMES TEAM</font></td></tr></table></body></html>', 'new_job_order', 0, 0, 1, NULL, NULL, '2022-07-19 05:36:43', '2022-07-19 05:36:43'),
(58, 8, 'Chiller', '\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\"', '<!DOCTYPE html><html><head><title>IEM System | Equipment Issue </title></head><body><table width=100% border=0><tr><td><tr><td colspan=2 style=position:absolute;left:350;top:60;><h2><font color = #346699>IEM System</font><h2></td></tr><tr><td colspan=2><br/><br/><br/><strong>Hello Sachin,</strong></td></tr><tr><td colspan=2><br/><font size=3><b>Title/ Equipment Issue: </b>Chiller</font></td></tr><tr><td colspan=2><br/><font size=3><b>Order Date: </b>2022-07-19 11:18:00</font></td></tr><tr><td colspan=2><br/><font size=3><b>Address: </b>Silver Park, Wagle Estate, Road No 3, Mulund Checknaka, Thane(w)</font></td></tr><tr><td colspan=2><br/><font size=3><b>Scope Of Work: </b>\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\"</font></td></tr><tr><td colspan=2><br/><font size=3><b>Client Name: </b>Dr. Horacio Oduber Hospital</font></td></tr><tr><td colspan=2><br/><br/><font size=3><b>Best regards,</b><br>IMES TEAM</font></td></tr></table></body></html>', 'new_job_order', 0, 0, 1, NULL, NULL, '2022-07-19 05:47:57', '2022-07-19 05:47:57'),
(59, 8, 'Chiller', '\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\"', '<!DOCTYPE html><html><head><title>IEM System | Equipment Issue </title></head><body><table width=100% border=0><tr><td><tr><td colspan=2 style=position:absolute;left:350;top:60;><h2><font color = #346699>IEM System</font><h2></td></tr><tr><td colspan=2><br/><br/><br/><strong>Hello Sachin,</strong></td></tr><tr><td colspan=2><br/><font size=3><b>Title/ Equipment Issue: </b>Chiller</font></td></tr><tr><td colspan=2><br/><font size=3><b>Order Date: </b>2022-07-19 11:18:00</font></td></tr><tr><td colspan=2><br/><font size=3><b>Address: </b>Silver Park, Wagle Estate, Road No 3, Mulund Checknaka, Thane(w)</font></td></tr><tr><td colspan=2><br/><font size=3><b>Scope Of Work: </b>\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\"</font></td></tr><tr><td colspan=2><br/><font size=3><b>Client Name: </b>Dr. Horacio Oduber Hospital</font></td></tr><tr><td colspan=2><br/><br/><font size=3><b>Best regards,</b><br>IMES TEAM</font></td></tr></table></body></html>', 'new_job_order', 1, 0, 1, NULL, NULL, '2022-07-19 05:48:32', '2022-07-20 05:33:48'),
(60, 8, 'Chiller', '\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\"', '<!DOCTYPE html><html><head><title>IEM System | New Work Order</title></head><body><table width=100% border=0><tr><td><tr><td colspan=2 style=position:absolute;left:350;top:60;><h2><font color = #346699>IEM System</font><h2></td></tr><tr><td colspan=2><br/><br/><br/><strong>Hello Sachin,</strong></td></tr><tr><td colspan=2><br/><font size=3><b>Title/ Equipment Issue: </b>Chiller</font></td></tr><tr><td colspan=2><br/><font size=3><b>Order Date: </b>2022-07-19 11:30:00</font></td></tr><tr><td colspan=2><br/><font size=3><b>Address: </b>Silver Park, Wagle Estate, Road No 3, Mulund Checknaka, Thane(w)</font></td></tr><tr><td colspan=2><br/><font size=3><b>Scope Of Work: </b>\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\"</font></td></tr><tr><td colspan=2><br/><font size=3><b>Client Name: </b>Dr. Horacio Oduber Hospital</font></td></tr><tr><td colspan=2><br/><br/><font size=3><b>Best regards,</b><br>IMES TEAM</font></td></tr></table></body></html>', 'new_job_order', 0, 0, 1, NULL, NULL, '2022-07-19 06:04:19', '2022-07-19 06:04:19');
INSERT INTO `contact_forms` (`id`, `user_id`, `title`, `message`, `email_msg`, `type`, `read_at`, `admin_read_at`, `created_by`, `updated_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(61, 8, 'Cooling Tower', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '<!DOCTYPE html><html><head><title>IEM System | New Work Order</title></head><body><table width=100% border=0><tr><td><tr><td colspan=2 style=position:absolute;left:350;top:60;><h2><font color = #346699>IEM System</font><h2></td></tr><tr><td colspan=2><br/><br/><br/><strong>Hello Sachin,</strong></td></tr><tr><td colspan=2><br/><font size=3><b>Title/ Equipment Issue: </b>Cooling Tower</font></td></tr><tr><td colspan=2><br/><font size=3><b>Order Date: </b>2022-07-19 05:18:00</font></td></tr><tr><td colspan=2><br/><font size=3><b>Address: </b>6th Flr, B Wing, Bsel Tak Park, Sector 30, Opp Vashi Railway Station, Vashi, Navi Mumbai</font></td></tr><tr><td colspan=2><br/><font size=3><b>Scope Of Work: </b>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</font></td></tr><tr><td colspan=2><br/><font size=3><b>Client Name: </b>Queen Beatrix International Airport</font></td></tr><tr><td colspan=2><br/><br/><font size=3><b>Best regards,</b><br>IMES TEAM</font></td></tr></table></body></html>', 'new_job_order', 0, 0, 1, NULL, NULL, '2022-07-19 11:48:48', '2022-07-19 11:48:48'),
(62, 8, 'Cooling Tower', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '<!DOCTYPE html><html><head><title>IEM System | New Work Order</title></head><body><table width=100% border=0><tr><td><tr><td colspan=2 style=position:absolute;left:350;top:60;><h2><font color = #346699>IEM System</font><h2></td></tr><tr><td colspan=2><br/><br/><br/><strong>Hello Sachin,</strong></td></tr><tr><td colspan=2><br/><font size=3><b>Title/ Equipment Issue: </b>Cooling Tower</font></td></tr><tr><td colspan=2><br/><font size=3><b>Order Date: </b>2022-07-19 05:18:00</font></td></tr><tr><td colspan=2><br/><font size=3><b>Address: </b>6th Flr, B Wing, Bsel Tak Park, Sector 30, Opp Vashi Railway Station, Vashi, Navi Mumbai</font></td></tr><tr><td colspan=2><br/><font size=3><b>Scope Of Work: </b>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</font></td></tr><tr><td colspan=2><br/><font size=3><b>Client Name: </b>Queen Beatrix International Airport</font></td></tr><tr><td colspan=2><br/><br/><font size=3><b>Best regards,</b><br>IMES TEAM</font></td></tr></table></body></html>', 'new_job_order', 0, 0, 1, NULL, NULL, '2022-07-19 11:50:44', '2022-07-19 11:50:44'),
(63, 8, 'Chiller', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', '<!DOCTYPE html><html><head><title>IEM System | New Work Order</title></head><body><table width=100% border=0><tr><td><tr><td colspan=2 style=position:absolute;left:350;top:60;><h2><font color = #346699>IEM System</font><h2></td></tr><tr><td colspan=2><br/><br/><br/><strong>Hello Sachin,</strong></td></tr><tr><td colspan=2><br/><font size=3><b>Title/ Equipment Issue: </b>Chiller</font></td></tr><tr><td colspan=2><br/><font size=3><b>Order Date: </b>2022-07-19 06:30:00</font></td></tr><tr><td colspan=2><br/><font size=3><b>Address: </b>6th Flr, B Wing, Bsel Tak Park, Sector 30, Opp Vashi Railway Station, Vashi, Navi Mumbai</font></td></tr><tr><td colspan=2><br/><font size=3><b>Scope Of Work: </b>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</font></td></tr><tr><td colspan=2><br/><font size=3><b>Client Name: </b>Queen Beatrix International Airport</font></td></tr><tr><td colspan=2><br/><br/><font size=3><b>Best regards,</b><br>IMES TEAM</font></td></tr></table></body></html>', 'new_job_order', 0, 0, 1, NULL, NULL, '2022-07-19 12:02:03', '2022-07-19 12:02:03'),
(64, 8, 'Chiller', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', '<!DOCTYPE html><html><head><title>IEM System | New Work Order</title></head><body><table width=100% border=0><tr><td><tr><td colspan=2 style=position:absolute;left:350;top:60;><h2><font color = #346699>IEM System</font><h2></td></tr><tr><td colspan=2><br/><br/><br/><strong>Hello Sachin,</strong></td></tr><tr><td colspan=2><br/><font size=3><b>Title/ Equipment Issue: </b>Chiller</font></td></tr><tr><td colspan=2><br/><font size=3><b>Order Date: </b>2022-07-19 06:30:00</font></td></tr><tr><td colspan=2><br/><font size=3><b>Address: </b>6th Flr, B Wing, Bsel Tak Park, Sector 30, Opp Vashi Railway Station, Vashi, Navi Mumbai</font></td></tr><tr><td colspan=2><br/><font size=3><b>Scope Of Work: </b>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</font></td></tr><tr><td colspan=2><br/><font size=3><b>Client Name: </b>Queen Beatrix International Airport</font></td></tr><tr><td colspan=2><br/><br/><font size=3><b>Best regards,</b><br>IMES TEAM</font></td></tr></table></body></html>', 'new_job_order', 0, 1, 1, NULL, NULL, '2022-07-19 12:06:52', '2022-07-20 05:07:37'),
(65, 8, 'Testing', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '<!DOCTYPE html><html><head><title>IEM System | Contact Form Enquiry</title></head><body><table width=100% border=0><tr><td><tr><td colspan=2 style=position:absolute;left:350;top:60;><h2><font color = #346699>IEM System</font><h2></td></tr><tr><td colspan=2><br/><br/><br/><strong>To IMES TEAM,</strong></td></tr><tr><td colspan=2><br/><font size=3><b>Title/Subject: </b>Testing</font></td></tr><tr><td colspan=2><br/><font size=3><b>Message: </b>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</font></td></tr><tr><td colspan=2><br/><br/><font size=3><b>Best regards,</b><br>Sachin</font></td></tr></table></body></html>', NULL, 1, NULL, 8, NULL, NULL, '2022-07-20 05:27:54', '2022-07-20 05:29:33');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `department_no` varchar(255) NOT NULL,
  `colorbg` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `department_no`, `colorbg`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '40', '40', '#BA017D', 1, 1, 1, '2022-07-18 10:59:31', '2022-07-18 11:19:33', NULL),
(2, '45', '45', '#56B228', 1, 1, NULL, '2022-07-18 10:59:51', '2022-07-18 10:59:51', NULL),
(3, '50', '50', '#8128AE', 1, 1, 1, '2022-07-18 11:00:23', '2022-07-18 11:11:34', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `equipment`
--

CREATE TABLE `equipment` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `inventory_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `equipment_info` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `equipment`
--

INSERT INTO `equipment` (`id`, `user_id`, `inventory_id`, `title`, `equipment_info`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(4, 1, 5, 'Chiller', '{\"type=1\":\"CHILLER\",\"asset=10\":\"dsfd\",\"asset-tag=11\":\"sdsd\",\"site-aaa=2\":\"Land\",\"aaa-maximo-location=9\":\"fsdfs\",\"location=3\":\"U1-21\",\"assets-type=4\":\"FUTUR\",\"asset-description-maximo=12\":\"gfgdf\",\"asset-description=13\":\"fgdf\",\"parent-of-assets-clarification=14\":\"dgd\",\"asset-class-maximo=15\":\"dfgdf\",\"vendorsupplier=5\":\"CHS\",\"manufacturer=6\":\"CARRIER\",\"year-made=16\":\"2019\",\"model=17\":\"gfd76765765\",\"serial=18\":\"gdfg54546\",\"cost-afl=19\":\"1000\",\"installation-date=20\":\"07\\/02\\/2022\",\"expected-life-years=21\":\"10\",\"subcontracto=7\":\"CHS\",\"upload-pdf=25\":\"doc\\/equipments\\/2022\\/07\\/04\\/pdf-sample_1656933296.pdf\",\"building-map=27\":\"doc\\/equipments\\/2022\\/07\\/04\\/FirstFloor_1656932257.jpg\"}', 1, 2, 1, '2022-06-30 05:41:43', '2022-07-04 05:44:56'),
(6, 1, 5, 'Cooling Tower', '{\"type=1\":\"COOLING TOWER\",\"asset=10\":\"asdff\",\"asset-tag=11\":\"sfsf\",\"site-aaa=2\":\"Air Side\",\"aaa-maximo-location=9\":\"sdfsdf\",\"location=3\":\"U1-11\",\"assets-type=4\":\"JK\",\"asset-description-maximo=12\":\"fsdf\",\"asset-description=13\":\"fsdfs\",\"parent-of-assets-clarification=14\":\"dfsdf\",\"asset-class-maximo=15\":\"fsdf\",\"vendorsupplier=5\":\"CHS\",\"manufacturer=6\":\"FUTURE\",\"year-made=16\":\"2020\",\"model=17\":\"2020ffgdf\",\"serial=18\":\"dfgdfgdfgd120\",\"cost-afl=19\":\"1600\",\"installation-date=20\":\"07\\/30\\/2022\",\"expected-life-years=21\":\"10\",\"subcontracto=7\":\"J&D\",\"building-map=27\":\"doc\\/equipments\\/2022\\/07\\/04\\/Map-of-office-building-This-work-compares-three-different-configurations-considering_1656933920.png\",\"upload-pdf=25\":\"doc\\/equipments\\/2022\\/07\\/04\\/c4611_sample_explain_1656933906.pdf\"}', 1, 1, 1, '2022-07-04 05:55:06', '2022-07-04 05:55:20');

-- --------------------------------------------------------

--
-- Table structure for table `equipment_issue_loggings`
--

CREATE TABLE `equipment_issue_loggings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_nr` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `equipment_id` bigint(20) UNSIGNED NOT NULL,
  `priority` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `department_no` int(11) DEFAULT NULL,
  `scope_of_work` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `staff_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `address` longtext COLLATE utf8mb4_unicode_ci,
  `orderdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `start_date` timestamp NULL DEFAULT NULL,
  `end_date` timestamp NULL DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `equipment_issue_loggings`
--

INSERT INTO `equipment_issue_loggings` (`id`, `order_nr`, `user_id`, `equipment_id`, `priority`, `department_no`, `scope_of_work`, `description`, `staff_id`, `client_id`, `address`, `orderdate`, `start_date`, `end_date`, `status`, `created_by`, `updated_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(10000, '#00000001', 1, 6, 'highest', 40, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source.', 8, 6, '6th Flr, B Wing, Bsel Tak Park, Sector 30, Opp Vashi Railway Station, Vashi, Navi Mumbai', '2022-07-18 06:34:55', '2022-11-07 06:10:00', NULL, 2, 1, 1, NULL, '2022-07-11 06:17:05', '2022-07-18 06:34:55'),
(10002, '#00010001', 1, 6, 'high', 45, 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source.', 'Lorem Ipsum Is Simply Dummy Text Of The Printing And Typesetting Industry. Lorem Ipsum Has Been The Industry\'s Standard Dummy Text Ever Since The 1500s, When An Unknown Printer Took A Galley Of Type And Scrambled It To Make A Type Specimen Book. It Has Survived Not Only Five Centuries, But Also The Leap Into Electronic Typesetting, Remaining Essentially Unchanged. It Was Popularised In The 1960s With The Release Of Letraset Sheets Containing Lorem Ipsum Passages, And More Recently With Desktop Publishing Software Like Aldus PageMaker Including Versions Of Lorem Ipsum.', 15, 6, '6th Flr, B Wing, Bsel Tak Park, Sector 30, Opp Vashi Railway Station, Vashi, Navi Mumbai', '2022-07-18 06:34:46', '2022-07-18 04:54:00', NULL, 2, 1, 1, NULL, '2022-07-18 04:55:16', '2022-07-18 06:34:46'),
(10004, '#00010003', 1, 4, 'medium', 50, '\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\"', '\"Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?\"', 8, 7, 'Silver Park, Wagle Estate, Road No 3, Mulund Checknaka, Thane(w)', '2022-07-19 05:27:00', '2022-07-19 05:27:00', NULL, 1, 1, NULL, NULL, '2022-07-19 05:36:41', '2022-07-19 05:36:41'),
(10006, '#00010005', 1, 4, 'highest', 50, '\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\"', '\"Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?\"', 8, 7, 'Silver Park, Wagle Estate, Road No 3, Mulund Checknaka, Thane(w)', '2022-07-19 05:48:00', '2022-07-19 05:48:00', NULL, 1, 1, NULL, NULL, '2022-07-19 05:48:30', '2022-07-19 05:48:30');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `file_logs`
--

CREATE TABLE `file_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `filename` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `file_logs`
--

INSERT INTO `file_logs` (`id`, `filename`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'dmart_equipments_1656334693_892455852.csv', 2, 1, NULL, '2022-06-28 00:44:11', '2022-06-28 00:44:11'),
(2, 'dmart_equipments_1656398361_342389006.csv', 2, 1, NULL, '2022-06-28 01:09:35', '2022-06-28 01:09:35'),
(3, 'dmart_equipments_1656398361_342389006.csv', 1, 1, NULL, '2022-06-28 01:12:09', '2022-06-28 01:12:09'),
(4, 'dmart_equipments_1656398361_342389006.csv', 1, 1, NULL, '2022-06-28 02:13:03', '2022-06-28 02:13:03'),
(5, 'dmart_equipments_1656577341_890643362.csv', 1, 1, NULL, '2022-06-30 03:08:58', '2022-06-30 03:08:58'),
(6, 'dmart_equipments_1656577341_890643362.csv', 1, 1, NULL, '2022-06-30 03:22:12', '2022-06-30 03:22:12');

-- --------------------------------------------------------

--
-- Table structure for table `inventories`
--

CREATE TABLE `inventories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint(4) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `inventories`
--

INSERT INTO `inventories` (`id`, `user_id`, `name`, `phone`, `address`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(5, 2, 'Vmart', '12385274369', '1-b, Sevashram Society, Ellora Park', 1, 2, 1, '2022-06-30 05:40:39', '2022-07-08 12:33:09'),
(6, 1, 'Queen Beatrix International Airport', '123654789', '6th Flr, B Wing, Bsel Tak Park, Sector 30, Opp Vashi Railway Station, Vashi, Navi Mumbai', 1, 1, 1, '2022-07-07 12:14:00', '2022-07-08 12:32:45'),
(7, 1, 'dr. Horacio Oduber Hospital', '123456789', 'Silver Park, Wagle Estate, Road No 3, Mulund Checknaka, Thane(w)', 1, 1, 1, '2022-07-07 12:16:55', '2022-07-08 12:32:31');

-- --------------------------------------------------------

--
-- Table structure for table `job_orders`
--

CREATE TABLE `job_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `eilid` bigint(20) UNSIGNED NOT NULL,
  `job_performed_by` bigint(20) UNSIGNED DEFAULT NULL,
  `start_date` timestamp NULL DEFAULT NULL,
  `end_date` timestamp NULL DEFAULT NULL,
  `remarks` longtext COLLATE utf8mb4_unicode_ci,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menuitem`
--

CREATE TABLE `menuitem` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `menu_order` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menuitem`
--

INSERT INTO `menuitem` (`id`, `name`, `url`, `menu_order`, `created_by`, `updated_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(2, 'Users', '/admin/users', '1', 1, NULL, NULL, '2022-07-05 00:40:32', '2022-07-05 00:40:32'),
(3, 'Add User', '/admin/users/add-users', '2', 1, NULL, NULL, '2022-07-05 00:41:04', '2022-07-05 00:41:04'),
(4, 'UserRoles', '/roles', '3', 1, NULL, NULL, '2022-07-05 00:41:29', '2022-07-05 00:41:29'),
(5, 'Permissions', '/permissions', '4', 1, NULL, NULL, '2022-07-05 00:41:49', '2022-07-05 00:41:49'),
(6, 'Customer', '/user/inventory', '5', 1, 1, NULL, '2022-07-05 00:42:22', '2022-07-06 06:34:47'),
(7, 'Add Customer', '/user/inventory/create', '6', 1, 1, NULL, '2022-07-05 00:42:37', '2022-07-06 06:34:38'),
(8, 'Work Orders', '/user/work_order', '7', 1, NULL, NULL, '2022-07-05 00:44:52', '2022-07-05 00:44:52'),
(9, 'Add Work Order', '/user/work_order/create', '8', 1, NULL, NULL, '2022-07-05 00:45:09', '2022-07-05 00:45:09'),
(10, 'Employees Report', '/user/employees/report', '9', 1, NULL, NULL, '2022-07-05 00:45:31', '2022-07-05 00:45:31'),
(11, 'Equipment Report', '/user/equipment/report', '10', 1, NULL, NULL, '2022-07-05 00:45:51', '2022-07-05 00:45:51'),
(12, 'Work Order Report', '/user/work-order-status/report', '11', 1, NULL, NULL, '2022-07-05 00:46:11', '2022-07-05 00:46:11'),
(13, 'Menus', '/menus', '12', 1, 1, NULL, '2022-07-05 00:47:08', '2022-07-05 01:12:34'),
(14, 'Menu Item', '/menus-item', '13', 1, NULL, NULL, '2022-07-05 01:13:06', '2022-07-05 01:13:06'),
(15, 'Equipment Issues', '/user/equipment_issues', '14', 1, NULL, NULL, '2022-07-08 00:17:49', '2022-07-08 00:17:49'),
(16, 'Add Equipment Issue', '/user/equipment_issues/create', '15', 1, NULL, NULL, '2022-07-08 00:18:35', '2022-07-08 00:18:35'),
(17, 'Department', '/user/departments', '16', 1, NULL, NULL, '2022-07-18 11:54:57', '2022-07-18 11:54:57');

-- --------------------------------------------------------

--
-- Table structure for table `menuses`
--

CREATE TABLE `menuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `menu_item` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `faicon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `child_menu` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_menu` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `menu_order` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menuses`
--

INSERT INTO `menuses` (`id`, `user_role`, `menu_item`, `faicon`, `url`, `child_menu`, `parent_menu`, `menu_order`, `status`, `created_by`, `updated_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'admin,Super-Admin', 'Users', 'fas fa-users', '#', 'Yes', '2,3,4,5', '1', 1, 1, 1, NULL, '2022-07-05 01:01:41', '2022-07-08 01:31:45'),
(2, 'admin,Super-Admin', 'Customer', 'fas fa-indent', '#', 'Yes', '6,7', '2', 1, 1, 1, NULL, '2022-07-05 01:02:26', '2022-07-08 01:30:14'),
(3, 'admin,Client,Staff,Super-Admin', 'Work Order', 'fas fa-tasks', '#', 'Yes', '8,9', '4', 1, 1, 1, NULL, '2022-07-05 01:03:05', '2022-07-08 12:57:25'),
(4, 'admin,Super-Admin', 'Reports', 'fas fa-chart-pie', '#', 'Yes', '10,11,12', '5', 1, 1, 1, NULL, '2022-07-05 01:03:55', '2022-07-08 12:56:31'),
(5, 'Super-Admin', 'Menus', 'fas fa-th', '#', 'Yes', '13,14', '7', 1, 1, 1, NULL, '2022-07-05 01:04:57', '2022-07-19 11:11:29'),
(6, 'admin,Super-Admin', 'Settings', 'fas fa-cog', '/settings', 'No', NULL, '9', 1, 1, 1, NULL, '2022-07-05 01:05:41', '2022-07-19 11:11:55'),
(7, 'admin,Client,Staff,Super-Admin', 'Mail', 'far fa-envelope', '/mail', 'No', NULL, '8', 1, 1, 1, NULL, '2022-07-05 05:42:29', '2022-07-19 11:11:45'),
(8, 'admin,Client,Staff,Super-Admin', 'Equipment Issues', 'fa fa-bug', '#', 'Yes', '15,16', '3', 1, 1, 1, NULL, '2022-07-08 00:20:28', '2022-07-08 01:34:48'),
(9, 'admin,Super-Admin', 'Departments', 'fa fa-solid fa-building', '/user/departments', 'No', NULL, '6', 1, 1, 1, NULL, '2022-07-18 11:57:00', '2022-07-19 11:11:14'),
(10, 'admin,Client,Staff,Super-Admin', 'Notifications', 'far fa-bell', '/notifications', 'No', NULL, '10', 2, 1, 1, NULL, '2022-07-19 11:10:27', '2022-07-19 11:15:32'),
(11, 'Client,Staff', 'Contact', 'fa fa-address-book', '/contact', 'No', NULL, '11', 2, 1, 1, NULL, '2022-07-20 05:18:31', '2022-07-20 05:35:12');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_06_23_072953_create_permissions_table', 1),
(6, '2022_06_23_073001_create_roles_table', 1),
(7, '2022_06_23_073121_create_users_permissions_table', 1),
(8, '2022_06_23_073216_create_users_roles_table', 1),
(9, '2022_06_23_082042_create_permission_tables', 2),
(12, '2022_06_23_112901_create_inventories_table', 3),
(15, '2022_06_24_042203_create_taxonomies_table', 5),
(17, '2022_06_24_050617_create_taxonomy_data_table', 7),
(19, '2022_06_23_122047_create_equipment_table', 8),
(24, '2022_06_28_060653_create_file_logs_table', 10),
(25, '2022_06_29_070456_create_usersbkup_table', 11),
(30, '2022_06_27_064412_create_work_orders_table', 14),
(32, '2022_06_29_093143_create_work_order_images_table', 15);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(2, 'App\\Models\\User', 1),
(1, 'App\\Models\\User', 2),
(4, 'App\\Models\\User', 3),
(4, 'App\\Models\\User', 4),
(4, 'App\\Models\\User', 5),
(3, 'App\\Models\\User', 6),
(3, 'App\\Models\\User', 7),
(4, 'App\\Models\\User', 8),
(3, 'App\\Models\\User', 9),
(3, 'App\\Models\\User', 13),
(4, 'App\\Models\\User', 15);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `icon` longtext COLLATE utf8mb4_unicode_ci,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` longtext COLLATE utf8mb4_unicode_ci,
  `lastid` int(11) DEFAULT NULL,
  `read_at` tinyint(4) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `title`, `description`, `icon`, `type`, `url`, `lastid`, `read_at`, `created_by`, `updated_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 8, 'Cooling Tower', 'You have received new job order!', 'https://iems.avisdemo.in/public/websetting/ch-favicon_1656925650.png', 'new_job_order', '/user/work_order/10004', 10004, 1, 1, NULL, NULL, '2022-07-19 11:50:44', '2022-07-19 12:52:41'),
(2, 8, 'Chiller', 'You have received new job order!', 'https://iems.avisdemo.in/public/websetting/ch-favicon_1656925650.png', 'new_job_order', '/user/work_order/10006', 10006, 1, 1, NULL, NULL, '2022-07-19 12:06:52', '2022-07-19 12:42:20');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('sachin@gmail.com', '$2y$10$GiObgYyFJ4PiYAO.oB/2Ne8hL9OegVE23af1fBT5rHGISnijQs.pm', '2022-06-30 06:35:46'),
('sachin@gmail.com', '6JcTJtcXlADfuNw7Rd0l1TGDy0RmfejZfXgeX2BKgHQjUpxo5T4q7FLzB3VR3uHg', '2022-06-30 06:40:10'),
('jyoti.610weblab@gmail.com', '$2y$10$6xFfNvewJCE4JJHa77dxL.ssp9g7.WpbI/CKvtxLDpWexsv4/GK1i', '2022-07-01 00:01:21');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'login', 'web', '2022-06-23 04:06:30', '2022-06-23 04:18:25'),
(2, 'logout', 'web', '2022-06-23 04:06:30', '2022-06-23 04:06:30'),
(3, 'register', 'web', '2022-06-23 04:06:30', '2022-06-23 04:06:30'),
(4, 'password.request', 'web', '2022-06-23 04:06:30', '2022-06-23 04:06:30'),
(5, 'password.email', 'web', '2022-06-23 04:06:30', '2022-06-23 04:06:30'),
(6, 'password.reset', 'web', '2022-06-23 04:06:30', '2022-06-23 04:06:30'),
(7, 'password.update', 'web', '2022-06-23 04:06:30', '2022-06-23 04:06:30'),
(8, 'password.confirm', 'web', '2022-06-23 04:06:30', '2022-06-23 04:06:30'),
(9, 'logout.perform', 'web', '2022-06-23 04:06:30', '2022-06-23 04:06:30'),
(10, 'users', 'web', '2022-06-23 04:06:30', '2022-06-23 04:06:30'),
(11, 'addUser', 'web', '2022-06-23 04:06:30', '2022-06-23 04:06:30'),
(12, 'storeUser', 'web', '2022-06-23 04:06:30', '2022-06-23 04:06:30'),
(13, 'editUser', 'web', '2022-06-23 04:06:30', '2022-06-23 04:06:30'),
(14, 'updateUser', 'web', '2022-06-23 04:06:30', '2022-06-23 04:06:30'),
(15, 'viewUser', 'web', '2022-06-23 04:06:30', '2022-06-23 04:06:30'),
(16, 'deleteUser', 'web', '2022-06-23 04:06:30', '2022-06-23 04:06:30'),
(17, 'roles.create', 'web', '2022-06-23 04:06:30', '2022-06-23 04:06:30'),
(18, 'roles.store', 'web', '2022-06-23 04:06:30', '2022-06-23 04:06:30'),
(19, 'roles.show', 'web', '2022-06-23 04:06:30', '2022-06-23 04:06:30'),
(20, 'roles.edit', 'web', '2022-06-23 04:06:30', '2022-06-23 04:06:30'),
(21, 'roles.update', 'web', '2022-06-23 04:06:30', '2022-06-23 04:06:30'),
(22, 'roles.destroy', 'web', '2022-06-23 04:06:30', '2022-06-23 04:06:30'),
(23, 'permissions.index', 'web', '2022-06-23 04:06:30', '2022-06-23 04:06:30'),
(24, 'permissions.create', 'web', '2022-06-23 04:06:30', '2022-06-23 04:06:30'),
(25, 'permissions.store', 'web', '2022-06-23 04:06:30', '2022-06-23 04:06:30'),
(26, 'permissions.show', 'web', '2022-06-23 04:06:30', '2022-06-23 04:06:30'),
(27, 'permissions.edit', 'web', '2022-06-23 04:06:30', '2022-06-23 04:06:30'),
(28, 'permissions.update', 'web', '2022-06-23 04:06:30', '2022-06-23 04:06:30'),
(29, 'permissions.destroy', 'web', '2022-06-23 04:06:30', '2022-06-23 04:06:30'),
(30, 'dashboard', 'web', '2022-06-23 04:06:30', '2022-06-23 04:06:30'),
(32, 'roles.index', 'web', '2022-06-23 05:17:17', '2022-06-23 05:17:17'),
(33, 'inventory.index', 'web', '2022-06-23 06:13:52', '2022-06-23 06:13:52'),
(34, 'inventory.create', 'web', '2022-06-23 06:13:52', '2022-06-23 06:13:52'),
(35, 'inventory.store', 'web', '2022-06-23 06:13:52', '2022-06-23 06:13:52'),
(36, 'inventory.show', 'web', '2022-06-23 06:13:52', '2022-06-23 06:13:52'),
(37, 'inventory.edit', 'web', '2022-06-23 06:13:52', '2022-06-23 06:13:52'),
(38, 'inventory.update', 'web', '2022-06-23 06:13:52', '2022-06-23 06:13:52'),
(39, 'inventory.destroy', 'web', '2022-06-23 06:13:52', '2022-06-23 06:13:52'),
(47, 'equipment.index', 'web', '2022-06-23 07:19:28', '2022-06-23 07:19:28'),
(48, 'equipment.create', 'web', '2022-06-23 07:19:28', '2022-06-23 07:19:28'),
(49, 'equipment.store', 'web', '2022-06-23 07:19:28', '2022-06-23 07:19:28'),
(50, 'equipment.show', 'web', '2022-06-23 07:19:28', '2022-06-23 07:19:28'),
(51, 'equipment.edit', 'web', '2022-06-23 07:19:28', '2022-06-23 07:19:28'),
(52, 'equipment.update', 'web', '2022-06-23 07:19:28', '2022-06-23 07:19:28'),
(53, 'equipment.destroy', 'web', '2022-06-23 07:19:28', '2022-06-23 07:19:28'),
(54, 'taxonomy.index', 'web', '2022-06-23 23:09:17', '2022-06-23 23:09:17'),
(55, 'taxonomy.create', 'web', '2022-06-23 23:09:17', '2022-06-23 23:09:17'),
(56, 'taxonomy.store', 'web', '2022-06-23 23:09:17', '2022-06-23 23:09:17'),
(57, 'taxonomy.show', 'web', '2022-06-23 23:09:17', '2022-06-23 23:09:17'),
(58, 'taxonomy.edit', 'web', '2022-06-23 23:09:17', '2022-06-23 23:09:17'),
(59, 'taxonomy.update', 'web', '2022-06-23 23:09:17', '2022-06-23 23:09:17'),
(60, 'taxonomy.destroy', 'web', '2022-06-23 23:09:17', '2022-06-23 23:09:17'),
(61, 'taxonomyData.index', 'web', '2022-06-23 23:39:46', '2022-06-23 23:39:46'),
(62, 'taxonomyData.create', 'web', '2022-06-23 23:39:47', '2022-06-23 23:39:47'),
(63, 'taxonomyData.store', 'web', '2022-06-23 23:39:47', '2022-06-23 23:39:47'),
(64, 'taxonomyData.show', 'web', '2022-06-23 23:39:47', '2022-06-23 23:39:47'),
(65, 'taxonomyData.edit', 'web', '2022-06-23 23:39:47', '2022-06-23 23:39:47'),
(66, 'taxonomyData.update', 'web', '2022-06-23 23:39:47', '2022-06-23 23:39:47'),
(67, 'taxonomyData.destroy', 'web', '2022-06-23 23:39:47', '2022-06-23 23:39:47'),
(68, 'equipment.downloadPDF', 'web', '2022-06-24 06:27:19', '2022-06-24 06:27:19'),
(69, 'equipment.getQRCode', 'web', '2022-06-26 23:51:01', '2022-06-26 23:51:01'),
(70, 'work_order.index', 'web', '2022-06-27 01:15:58', '2022-06-27 01:15:58'),
(71, 'work_order.create', 'web', '2022-06-27 01:15:58', '2022-06-27 01:15:58'),
(72, 'work_order.store', 'web', '2022-06-27 01:15:58', '2022-06-27 01:15:58'),
(73, 'work_order.show', 'web', '2022-06-27 01:15:58', '2022-06-27 01:15:58'),
(74, 'work_order.edit', 'web', '2022-06-27 01:15:58', '2022-06-27 01:15:58'),
(75, 'work_order.update', 'web', '2022-06-27 01:15:58', '2022-06-27 01:15:58'),
(76, 'work_order.destroy', 'web', '2022-06-27 01:15:58', '2022-06-27 01:15:58'),
(77, 'equipment.export', 'web', '2022-06-27 04:15:54', '2022-06-27 04:15:54'),
(78, 'equipment.import', 'web', '2022-06-27 04:15:54', '2022-06-27 04:15:54'),
(79, 'work_order.report', 'web', '2022-06-28 04:05:50', '2022-06-28 04:05:50'),
(80, 'dashboard.clientStaff', 'web', '2022-06-28 06:07:06', '2022-06-28 06:07:06'),
(81, 'clientUser', 'web', '2022-06-28 06:08:21', '2022-06-28 06:08:21'),
(82, 'staffsUser', 'web', '2022-06-28 06:08:21', '2022-06-28 06:08:21'),
(83, 'user.profile', 'web', '2022-06-29 00:52:21', '2022-06-29 00:52:21'),
(84, 'authRemove', 'web', '2022-06-29 01:30:10', '2022-06-29 01:30:10'),
(85, 'employees.report', 'web', '2022-06-30 00:48:53', '2022-06-30 00:48:53'),
(86, 'equipment.report', 'web', '2022-06-30 00:48:53', '2022-06-30 00:48:53'),
(87, 'settings.index', 'web', '2022-07-04 02:59:43', '2022-07-04 02:59:43'),
(88, 'settings.store', 'web', '2022-07-04 03:30:30', '2022-07-04 03:30:30'),
(89, 'menus.index', 'web', '2022-07-04 07:40:20', '2022-07-04 07:40:20'),
(90, 'menus.create', 'web', '2022-07-04 07:40:28', '2022-07-04 07:40:28'),
(91, 'menus.store', 'web', '2022-07-04 07:40:38', '2022-07-04 07:40:38'),
(92, 'menus.edit', 'web', '2022-07-04 07:40:46', '2022-07-04 07:40:46'),
(93, 'menus.update', 'web', '2022-07-04 07:40:59', '2022-07-04 07:40:59'),
(94, 'menus.destroy', 'web', '2022-07-04 07:41:18', '2022-07-04 07:41:18'),
(95, 'menus_item.index', 'web', '2022-07-05 00:20:26', '2022-07-05 00:20:26'),
(96, 'menus_item.create', 'web', '2022-07-05 00:20:35', '2022-07-05 00:20:35'),
(97, 'menus_item.store', 'web', '2022-07-05 00:20:45', '2022-07-05 00:20:45'),
(98, 'menus_item.edit', 'web', '2022-07-05 00:20:56', '2022-07-05 00:20:56'),
(99, 'menus_item.update', 'web', '2022-07-05 00:21:04', '2022-07-05 00:21:04'),
(100, 'menus_item.destroy', 'web', '2022-07-05 00:21:12', '2022-07-05 00:21:12'),
(101, 'dashboard.workorder', 'web', '2022-07-05 03:21:12', '2022-07-05 03:21:12'),
(102, 'dashboard.contactstore', 'web', '2022-07-05 04:57:32', '2022-07-05 04:57:32'),
(103, 'dashboard.mail', 'web', '2022-07-05 05:40:09', '2022-07-05 05:40:09'),
(104, 'dashboard.readmail', 'web', '2022-07-05 06:06:07', '2022-07-05 06:06:07'),
(105, 'dashboard.replymessage', 'web', '2022-07-05 06:58:45', '2022-07-05 06:58:45'),
(106, 'dashboard.destorymail', 'web', '2022-07-05 07:49:07', '2022-07-05 07:49:07'),
(108, 'save-token', 'web', '2022-07-06 02:41:49', '2022-07-06 02:41:49'),
(110, 'send.notification', 'web', '2022-07-06 02:42:44', '2022-07-06 02:42:44'),
(111, 'user.fetchClient', 'web', '2022-07-07 23:37:13', '2022-07-07 23:37:13'),
(112, 'equipment_issues.index', 'web', '2022-07-08 00:14:37', '2022-07-08 00:14:37'),
(113, 'equipment_issues.create', 'web', '2022-07-08 00:14:46', '2022-07-08 00:14:46'),
(114, 'equipment_issues.store', 'web', '2022-07-08 00:14:57', '2022-07-08 00:14:57'),
(115, 'equipment_issues.show', 'web', '2022-07-08 00:15:10', '2022-07-08 00:15:10'),
(116, 'equipment_issues.edit', 'web', '2022-07-08 00:15:17', '2022-07-08 00:15:17'),
(117, 'equipment_issues.update', 'web', '2022-07-08 00:15:25', '2022-07-08 00:15:25'),
(118, 'equipment_issues.destroy', 'web', '2022-07-08 00:15:40', '2022-07-08 00:15:40'),
(119, 'equipment_issues_order.create', 'web', '2022-07-08 01:49:58', '2022-07-08 01:49:58'),
(120, 'equipment_issues_order.store', 'web', '2022-07-08 01:50:06', '2022-07-08 01:50:06'),
(121, 'equipment_issues_order.index', 'web', '2022-07-08 01:50:14', '2022-07-08 01:50:14'),
(122, 'equipment_issues_order.edit', 'web', '2022-07-08 01:50:20', '2022-07-08 01:50:20'),
(123, 'equipment_issues_order.update', 'web', '2022-07-08 01:50:28', '2022-07-08 01:50:28'),
(124, 'equipment_issues_order.destroy', 'web', '2022-07-08 01:50:36', '2022-07-08 01:50:36'),
(125, 'user.fetchInventory', 'web', '2022-07-08 13:03:44', '2022-07-08 13:03:44'),
(126, 'departments.index', 'web', '2022-07-18 10:47:41', '2022-07-18 10:47:41'),
(127, 'departments.create', 'web', '2022-07-18 10:48:06', '2022-07-18 10:48:06'),
(128, 'departments.store', 'web', '2022-07-18 10:48:26', '2022-07-18 10:48:26'),
(129, 'departments.edit', 'web', '2022-07-18 10:48:36', '2022-07-18 10:48:36'),
(130, 'departments.update', 'web', '2022-07-18 10:48:52', '2022-07-18 10:48:52'),
(131, 'departments.destroy', 'web', '2022-07-18 10:49:10', '2022-07-18 10:49:10'),
(132, 'notification.destroy', 'web', '2022-07-19 11:05:42', '2022-07-19 11:05:42'),
(133, 'notification.clearAll', 'web', '2022-07-19 11:06:12', '2022-07-19 11:06:12'),
(134, 'dashboard.notificationsList', 'web', '2022-07-19 11:06:30', '2022-07-19 11:06:30'),
(135, 'dashboard.contactindex', 'web', '2022-07-20 05:19:10', '2022-07-20 05:19:10');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 8, 'LaravelSanctumAuth', '797d60338f39d2fb45c7abecbf624fc2147f67a37fd85d17f366979612597558', '[\"*\"]', '2022-07-06 07:30:41', '2022-07-06 07:25:03', '2022-07-06 07:30:41'),
(2, 'App\\Models\\User', 1, 'LaravelSanctumAuth', '3447231a17f922bd0fad9cdd7cbbe81431256704f4de79b4efaa8b7a84a64f83', '[\"*\"]', NULL, '2022-07-06 22:59:25', '2022-07-06 22:59:25'),
(3, 'App\\Models\\User', 1, 'LaravelSanctumAuth', 'eddc195d1d50e01e1308e5d43969ae1868cdf82e82c2b16c3acfab9f46abf19f', '[\"*\"]', '2022-07-18 06:53:05', '2022-07-06 22:59:57', '2022-07-18 06:53:05'),
(4, 'App\\Models\\User', 12, 'LaravelSanctumAuth', '4bc195188cd6e0186a40708e5b125fa63ef144351e639bb9ceef6b1c0c80bef0', '[\"*\"]', '2022-07-14 08:14:57', '2022-07-14 07:14:41', '2022-07-14 08:14:57'),
(5, 'App\\Models\\User', 12, 'LaravelSanctumAuth', '3727d0ad3ed24bab219d5fedabefd330d990f36293d3457e81c7548d85e489a4', '[\"*\"]', NULL, '2022-07-14 07:38:53', '2022-07-14 07:38:53'),
(6, 'App\\Models\\User', 12, 'LaravelSanctumAuth', 'f117f1ef66d346fd5d3758d37beb4c67b5cc792a9007a70ea76fb9b4ff3a3071', '[\"*\"]', NULL, '2022-07-14 07:39:58', '2022-07-14 07:39:58'),
(7, 'App\\Models\\User', 12, 'LaravelSanctumAuth', '5b3a7f5ec10355b2a3c6d84350e5d1cff0c600540fe52a5f2abbe46395029137', '[\"*\"]', NULL, '2022-07-14 07:42:08', '2022-07-14 07:42:08'),
(8, 'App\\Models\\User', 13, 'LaravelSanctumAuth', '1bb756976066f79deeac72ce31f96be75fbec4cd0ee119c803346ab1d65eeb7e', '[\"*\"]', '2022-07-14 09:59:41', '2022-07-14 09:37:31', '2022-07-14 09:59:41'),
(9, 'App\\Models\\User', 14, 'LaravelSanctumAuth', 'ad8395c65fe6afe6306b4f8589e02cc8fcca570153ba5a37580cc452e56a3382', '[\"*\"]', NULL, '2022-07-18 04:43:53', '2022-07-18 04:43:53'),
(10, 'App\\Models\\User', 14, 'LaravelSanctumAuth', '2018185a673250b778dbbcb4f551da992b41663bd7387b7d394d7a347066eee8', '[\"*\"]', '2022-07-18 04:48:39', '2022-07-18 04:44:22', '2022-07-18 04:48:39'),
(11, 'App\\Models\\User', 15, 'LaravelSanctumAuth', 'b5bbb8f1c8343d49f56944feb4f05bbf594c4f387ea878dace9e6f6b70caef1c', '[\"*\"]', '2022-07-18 04:50:43', '2022-07-18 04:50:22', '2022-07-18 04:50:43'),
(12, 'App\\Models\\User', 15, 'LaravelSanctumAuth', '455948ab6513d6b466761c1787b8e8b724516c245177362c53a007f29fdd6120', '[\"*\"]', '2022-07-18 05:11:06', '2022-07-18 04:50:48', '2022-07-18 05:11:06'),
(13, 'App\\Models\\User', 15, 'LaravelSanctumAuth', '705f00804444306b79995ea59d7b23e9e0a6794e37e69d74391524184bfb8d7b', '[\"*\"]', '2022-07-18 06:28:48', '2022-07-18 05:18:27', '2022-07-18 06:28:48'),
(14, 'App\\Models\\User', 15, 'LaravelSanctumAuth', '58aa8b6e50a1807b63d6d96b8f34242d1ee65b55a69a9ab3637e7fb2dc9380d3', '[\"*\"]', NULL, '2022-07-18 05:24:27', '2022-07-18 05:24:27'),
(15, 'App\\Models\\User', 15, 'LaravelSanctumAuth', '848fcb1d79aba1094b52ae0cb3a35715d7e6f07e37c595408a7e9f1e6486afd2', '[\"*\"]', '2022-07-18 05:26:49', '2022-07-18 05:24:54', '2022-07-18 05:26:49'),
(16, 'App\\Models\\User', 8, 'LaravelSanctumAuth', '90aa262f5fbc45013175adc2deb23169b4a24c9ff57d4cf29f027991d32fa0e2', '[\"*\"]', NULL, '2022-07-18 07:30:01', '2022-07-18 07:30:01'),
(17, 'App\\Models\\User', 8, 'LaravelSanctumAuth', '7a0030f86b69efdb25ed0ef5d6ab76abdae289cfa1092d6082863783c61a1deb', '[\"*\"]', NULL, '2022-07-18 09:12:48', '2022-07-18 09:12:48'),
(18, 'App\\Models\\User', 8, 'LaravelSanctumAuth', 'b3c64e17fbb740bb00acf33caf7919c5142f0e0657b0cf0075662f2fd1f47850', '[\"*\"]', NULL, '2022-07-18 09:27:14', '2022-07-18 09:27:14'),
(19, 'App\\Models\\User', 8, 'LaravelSanctumAuth', '7c78f4c23d8a67d6768c54fa257542df6b65610c7efd934e15693a91eafc410e', '[\"*\"]', '2022-07-18 09:44:58', '2022-07-18 09:27:46', '2022-07-18 09:44:58'),
(20, 'App\\Models\\User', 1, 'LaravelSanctumAuth', 'e8a02cbbe7bd72a104c2a44a48c4e986e93607801242eabc7333d37e92c39b5f', '[\"*\"]', '2022-07-18 09:57:27', '2022-07-18 09:46:36', '2022-07-18 09:57:27'),
(21, 'App\\Models\\User', 1, 'LaravelSanctumAuth', '9f82f23207551478f1b8aece5419ca2a1a207e1722d335655499cf91e2209935', '[\"*\"]', '2022-07-18 12:14:09', '2022-07-18 09:53:02', '2022-07-18 12:14:09'),
(22, 'App\\Models\\User', 1, 'LaravelSanctumAuth', '9b87f7eba39b5171d5bb8fa753e95244dddf3a61a595ce304fc7ec87e8299463', '[\"*\"]', '2022-07-18 10:01:26', '2022-07-18 10:01:01', '2022-07-18 10:01:26'),
(23, 'App\\Models\\User', 1, 'LaravelSanctumAuth', '0cf77ba7208fde7f47110700bbb68c5a1a64c74b9a950569902e87717fd5dcea', '[\"*\"]', '2022-07-18 10:28:04', '2022-07-18 10:06:21', '2022-07-18 10:28:04'),
(24, 'App\\Models\\User', 1, 'LaravelSanctumAuth', 'ac22d4d7c7350e6331cff17b52fd28864833dbca84cfea79769db93d0ed81118', '[\"*\"]', '2022-07-18 11:20:47', '2022-07-18 10:22:16', '2022-07-18 11:20:47'),
(25, 'App\\Models\\User', 1, 'LaravelSanctumAuth', 'eb925592ba77ca37714a4280749f0eaf37c212b41996c60a9fb7ac9be5dc61ec', '[\"*\"]', '2022-07-19 07:32:49', '2022-07-19 04:30:46', '2022-07-19 07:32:49'),
(26, 'App\\Models\\User', 1, 'LaravelSanctumAuth', '312d488937eea2fcb5b54edc4e677f3c2b03672b2dfb613cc53226e45c4f47dc', '[\"*\"]', '2022-07-19 07:28:45', '2022-07-19 07:28:44', '2022-07-19 07:28:45'),
(27, 'App\\Models\\User', 1, 'LaravelSanctumAuth', '034b02cd6b7c28916a5526656080b66bad5766a70d5d1ad5c9488718ddd97a4b', '[\"*\"]', '2022-07-19 10:39:00', '2022-07-19 07:33:21', '2022-07-19 10:39:00'),
(28, 'App\\Models\\User', 1, 'LaravelSanctumAuth', '3b6a1cd5256d9226abfa83e9cb9c2a51872e166e9b9eedca2d9682fcd96640c4', '[\"*\"]', NULL, '2022-07-19 10:20:21', '2022-07-19 10:20:21'),
(29, 'App\\Models\\User', 1, 'LaravelSanctumAuth', '74f4631344c4edc62c7b34730bdeaa9a416da85c11a4fbd2a697df21fbbe0a08', '[\"*\"]', NULL, '2022-07-19 10:21:13', '2022-07-19 10:21:13'),
(30, 'App\\Models\\User', 1, 'LaravelSanctumAuth', 'c04043867e59f0f9ee8f225579eb4ff736a92e796bcde9a9f33dd6b6327d8122', '[\"*\"]', NULL, '2022-07-19 10:38:06', '2022-07-19 10:38:06'),
(31, 'App\\Models\\User', 1, 'LaravelSanctumAuth', 'ee0f04305ad3ec2c74bc457e03a7a1371e432f8c7931fe4544e0fdb38a9ea7ae', '[\"*\"]', '2022-07-19 11:58:25', '2022-07-19 10:55:00', '2022-07-19 11:58:25'),
(32, 'App\\Models\\User', 1, 'LaravelSanctumAuth', '187459d03e0be567d5adc31107007f8124757c0c747bfbfc6f51db0b191f2db6', '[\"*\"]', NULL, '2022-07-19 11:04:03', '2022-07-19 11:04:03'),
(33, 'App\\Models\\User', 9, 'LaravelSanctumAuth', '1383bec699872acdd5075e7328d8d715765388433500699c1a5f1efde9f8df6f', '[\"*\"]', '2022-07-19 11:54:57', '2022-07-19 11:52:52', '2022-07-19 11:54:57'),
(34, 'App\\Models\\User', 8, 'LaravelSanctumAuth', 'bdbc522019495030d3f7a8e94fe98e262e5b7eeab13508b0ae89bc4f94020250', '[\"*\"]', '2022-07-19 12:47:23', '2022-07-19 11:55:29', '2022-07-19 12:47:23'),
(35, 'App\\Models\\User', 1, 'LaravelSanctumAuth', '200a8871b137e7229a276abb85af783a6aa4cc1fe52c3f813027084244c1bf07', '[\"*\"]', NULL, '2022-07-19 15:37:53', '2022-07-19 15:37:53'),
(36, 'App\\Models\\User', 1, 'LaravelSanctumAuth', '559fcab9a150921dcecfb20048a9013db70eeefd0a15f1009e189c1892e702dd', '[\"*\"]', NULL, '2022-07-20 04:27:22', '2022-07-20 04:27:22'),
(37, 'App\\Models\\User', 8, 'LaravelSanctumAuth', '063e52b077c99a806dd45f1cfcab2d237215a8cf62d33ebc4cd6ccf2a9d1917a', '[\"*\"]', NULL, '2022-07-20 05:13:27', '2022-07-20 05:13:27');

-- --------------------------------------------------------

--
-- Table structure for table `reset_code_passwords`
--

CREATE TABLE `reset_code_passwords` (
  `id` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reset_code_passwords`
--

INSERT INTO `reset_code_passwords` (`id`, `email`, `code`, `created_at`, `updated_at`) VALUES
(3, 'sunita@gmail.com', '269586', '2022-07-18 05:40:38', '2022-07-18 05:40:38');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'web', '2022-06-23 04:09:09', '2022-06-23 04:09:09'),
(2, 'Super-Admin', 'web', '2022-06-23 04:43:17', '2022-06-23 04:43:17'),
(3, 'Client', 'web', '2022-06-23 04:44:05', '2022-06-23 04:44:05'),
(4, 'Staff', 'web', '2022-06-27 01:50:29', '2022-06-27 01:50:29');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(30, 1),
(33, 1),
(34, 1),
(35, 1),
(36, 1),
(37, 1),
(38, 1),
(39, 1),
(47, 1),
(48, 1),
(49, 1),
(50, 1),
(51, 1),
(52, 1),
(53, 1),
(54, 1),
(55, 1),
(56, 1),
(57, 1),
(58, 1),
(59, 1),
(60, 1),
(61, 1),
(62, 1),
(63, 1),
(64, 1),
(65, 1),
(66, 1),
(67, 1),
(68, 1),
(69, 1),
(77, 1),
(78, 1),
(83, 1),
(84, 1),
(101, 1),
(102, 1),
(103, 1),
(104, 1),
(105, 1),
(106, 1),
(108, 1),
(110, 1),
(111, 1),
(112, 1),
(113, 1),
(114, 1),
(115, 1),
(116, 1),
(117, 1),
(118, 1),
(119, 1),
(120, 1),
(121, 1),
(122, 1),
(123, 1),
(124, 1),
(125, 1),
(126, 1),
(127, 1),
(128, 1),
(129, 1),
(130, 1),
(131, 1),
(132, 1),
(133, 1),
(134, 1),
(1, 2),
(2, 2),
(3, 2),
(4, 2),
(5, 2),
(6, 2),
(7, 2),
(8, 2),
(9, 2),
(10, 2),
(11, 2),
(12, 2),
(13, 2),
(14, 2),
(15, 2),
(16, 2),
(17, 2),
(18, 2),
(19, 2),
(20, 2),
(21, 2),
(22, 2),
(23, 2),
(24, 2),
(25, 2),
(26, 2),
(27, 2),
(28, 2),
(29, 2),
(30, 2),
(32, 2),
(33, 2),
(34, 2),
(35, 2),
(36, 2),
(37, 2),
(38, 2),
(39, 2),
(47, 2),
(48, 2),
(49, 2),
(50, 2),
(51, 2),
(52, 2),
(53, 2),
(54, 2),
(55, 2),
(56, 2),
(57, 2),
(58, 2),
(59, 2),
(60, 2),
(61, 2),
(62, 2),
(63, 2),
(64, 2),
(65, 2),
(66, 2),
(67, 2),
(68, 2),
(69, 2),
(70, 2),
(71, 2),
(72, 2),
(73, 2),
(74, 2),
(75, 2),
(76, 2),
(77, 2),
(78, 2),
(79, 2),
(80, 2),
(81, 2),
(82, 2),
(83, 2),
(84, 2),
(85, 2),
(86, 2),
(87, 2),
(88, 2),
(89, 2),
(90, 2),
(91, 2),
(92, 2),
(93, 2),
(94, 2),
(95, 2),
(96, 2),
(97, 2),
(98, 2),
(99, 2),
(100, 2),
(101, 2),
(102, 2),
(103, 2),
(104, 2),
(105, 2),
(106, 2),
(108, 2),
(110, 2),
(111, 2),
(112, 2),
(113, 2),
(114, 2),
(115, 2),
(116, 2),
(117, 2),
(118, 2),
(119, 2),
(120, 2),
(121, 2),
(122, 2),
(123, 2),
(124, 2),
(125, 2),
(126, 2),
(127, 2),
(128, 2),
(129, 2),
(130, 2),
(131, 2),
(132, 2),
(133, 2),
(134, 2),
(1, 3),
(2, 3),
(3, 3),
(30, 3),
(70, 3),
(74, 3),
(75, 3),
(83, 3),
(84, 3),
(101, 3),
(102, 3),
(103, 3),
(104, 3),
(108, 3),
(110, 3),
(111, 3),
(112, 3),
(113, 3),
(114, 3),
(115, 3),
(116, 3),
(117, 3),
(118, 3),
(119, 3),
(120, 3),
(121, 3),
(122, 3),
(123, 3),
(124, 3),
(125, 3),
(132, 3),
(133, 3),
(134, 3),
(135, 3),
(1, 4),
(2, 4),
(70, 4),
(73, 4),
(74, 4),
(75, 4),
(83, 4),
(84, 4),
(101, 4),
(102, 4),
(103, 4),
(104, 4),
(108, 4),
(110, 4),
(111, 4),
(112, 4),
(113, 4),
(114, 4),
(115, 4),
(116, 4),
(117, 4),
(118, 4),
(119, 4),
(120, 4),
(121, 4),
(122, 4),
(123, 4),
(124, 4),
(125, 4),
(132, 4),
(133, 4),
(134, 4),
(135, 4);

-- --------------------------------------------------------

--
-- Table structure for table `taxonomies`
--

CREATE TABLE `taxonomies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `input_field_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `input_required` tinyint(4) DEFAULT NULL,
  `file_accept` text COLLATE utf8mb4_unicode_ci,
  `order_no` bigint(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `taxonomies`
--

INSERT INTO `taxonomies` (`id`, `name`, `slug`, `input_field_type`, `input_required`, `file_accept`, `order_no`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Type', 'type', 'Select', 1, NULL, 1, 1, 1, 1, '2022-06-23 23:20:42', '2022-06-30 02:07:39'),
(2, 'Site (AAA)', 'site-aaa', 'Select', 1, NULL, 4, 1, 1, 1, '2022-06-23 23:22:47', '2022-06-30 02:07:34'),
(3, 'Location', 'location', 'Select', 1, NULL, 6, 1, 1, 1, '2022-06-23 23:23:02', '2022-06-30 02:07:29'),
(4, 'Assets Type', 'assets-type', 'Select', 0, NULL, 7, 1, 1, 1, '2022-06-23 23:23:16', '2022-06-30 02:12:03'),
(5, 'Vendor/Supplier', 'vendorsupplier', 'Select', 1, NULL, 12, 1, 1, 1, '2022-06-23 23:23:31', '2022-06-30 02:07:25'),
(6, 'Manufacturer', 'manufacturer', 'Select', 1, NULL, 13, 1, 1, 1, '2022-06-23 23:23:44', '2022-06-30 02:07:19'),
(7, 'Subcontracto', 'subcontracto', 'Select', 1, NULL, 20, 1, 1, 1, '2022-06-23 23:24:01', '2022-06-30 02:07:12'),
(9, 'AAA (MAXIMO) LOCATION', 'aaa-maximo-location', 'Text', 0, NULL, 5, 1, 1, 1, '2022-06-24 01:28:34', '2022-06-30 02:07:06'),
(10, 'Asset #', 'asset', 'Text', 0, NULL, 2, 1, 1, 1, '2022-06-24 01:42:55', '2022-06-30 02:25:01'),
(11, 'Asset Tag', 'asset-tag', 'Text', 0, NULL, 3, 1, 1, 1, '2022-06-24 02:15:04', '2022-06-30 02:06:58'),
(12, 'Asset description (MAXIMO)', 'asset-description-maximo', 'Textarea', 0, NULL, 8, 1, 1, 1, '2022-06-24 02:16:06', '2022-06-30 02:06:42'),
(13, 'Asset description', 'asset-description', 'Text', 0, NULL, 9, 1, 1, 1, '2022-06-24 02:17:17', '2022-06-30 02:06:39'),
(14, 'Parent of Assets Clarification', 'parent-of-assets-clarification', 'Text', 0, NULL, 10, 1, 1, 1, '2022-06-24 02:17:36', '2022-06-30 02:06:35'),
(15, 'ASSET CLASS (MAXIMO)', 'asset-class-maximo', 'Text', 0, NULL, 11, 1, 1, 1, '2022-06-24 02:18:18', '2022-06-30 02:06:30'),
(16, 'Year Made', 'year-made', 'Text', 0, NULL, 14, 1, 1, 1, '2022-06-24 02:18:53', '2022-06-30 02:06:24'),
(17, 'Model #', 'model', 'Text', 0, NULL, 15, 1, 1, 1, '2022-06-24 02:19:08', '2022-06-30 02:14:36'),
(18, 'Serial #', 'serial', 'Text', 1, NULL, 16, 1, 1, 1, '2022-06-24 02:19:36', '2022-06-30 02:14:46'),
(19, 'Cost (Afl.)', 'cost-afl', 'Number', 0, NULL, 17, 1, 1, 1, '2022-06-24 02:19:47', '2022-06-30 02:06:09'),
(20, 'Installation Date', 'installation-date', 'Date', 0, NULL, 18, 1, 1, 1, '2022-06-24 02:20:43', '2022-06-30 02:06:05'),
(21, 'Expected Life (Years)', 'expected-life-years', 'Text', 0, NULL, 19, 1, 1, 1, '2022-06-24 02:21:01', '2022-06-30 04:02:21'),
(25, 'Upload PDF', 'upload-pdf', 'File', 0, 'png,jpg,pdf', 22, 1, 1, 1, '2022-07-01 04:23:51', '2022-07-04 01:48:44'),
(27, 'Building MAP', 'building-map', 'File', 0, 'png,jpg,jpeg', 21, 1, 1, 1, '2022-07-04 05:19:52', '2022-07-04 05:20:14'),
(28, 'Manuals', 'manuals', 'File', 0, 'pdf', 1, 1, 1, NULL, '2022-07-05 06:51:45', '2022-07-05 06:51:45');

-- --------------------------------------------------------

--
-- Table structure for table `taxonomy_data`
--

CREATE TABLE `taxonomy_data` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `taxonomy_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `taxonomy_data`
--

INSERT INTO `taxonomy_data` (`id`, `taxonomy_id`, `name`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 7, 'CHS', 1, 1, NULL, '2022-06-23 23:54:50', '2022-06-23 23:54:50'),
(2, 6, 'J&D', 1, 1, NULL, '2022-06-23 23:58:03', '2022-06-23 23:58:03'),
(3, 6, 'GRUNDFOS', 1, 1, NULL, '2022-06-24 00:00:11', '2022-06-24 00:00:11'),
(4, 6, 'CARRIER', 1, 1, NULL, '2022-06-24 00:02:14', '2022-06-24 00:02:14'),
(5, 6, 'FUTURE', 1, 1, NULL, '2022-06-24 00:04:00', '2022-06-24 00:04:00'),
(6, 6, 'SES', 1, 1, NULL, '2022-06-24 00:04:55', '2022-06-24 00:04:55'),
(7, 6, 'PROTEC', 1, 1, NULL, '2022-06-24 00:06:24', '2022-06-24 00:06:24'),
(8, 6, 'ELKAY', 1, 1, NULL, '2022-06-24 00:07:46', '2022-06-24 00:07:46'),
(9, 6, 'MULTI AQUA', 1, 1, NULL, '2022-06-24 00:08:02', '2022-06-24 00:08:02'),
(10, 6, 'LIEBERT', 1, 1, NULL, '2022-06-24 00:08:12', '2022-06-24 00:08:12'),
(11, 6, 'REFLEX', 1, 1, NULL, '2022-06-24 00:08:24', '2022-06-24 00:08:24'),
(12, 6, 'DAALDEROP', 1, 1, NULL, '2022-06-24 00:08:33', '2022-06-24 00:08:33'),
(13, 6, 'BERSON', 1, 1, NULL, '2022-06-24 00:08:43', '2022-06-24 00:08:43'),
(14, 6, 'ABB', 1, 1, NULL, '2022-06-24 00:08:52', '2022-06-24 00:08:52'),
(15, 5, 'CHS', 1, 1, NULL, '2022-06-24 00:49:16', '2022-06-24 00:49:16'),
(16, 4, 'FUTUR', 1, 1, NULL, '2022-06-24 00:51:13', '2022-06-24 00:51:13'),
(18, 3, 'U1-01', 1, 1, NULL, '2022-06-24 00:53:44', '2022-06-24 00:53:44'),
(19, 3, 'U1-11', 1, 1, NULL, '2022-06-24 00:53:56', '2022-06-24 00:53:56'),
(20, 3, 'U1-24', 1, 1, NULL, '2022-06-24 00:54:14', '2022-06-24 00:54:14'),
(21, 3, 'GH-02', 1, 1, NULL, '2022-06-24 00:54:23', '2022-06-24 00:54:23'),
(22, 3, 'D1-07', 1, 1, NULL, '2022-06-24 00:54:33', '2022-06-24 00:54:33'),
(23, 3, 'G.House', 1, 1, NULL, '2022-06-24 00:54:42', '2022-06-24 00:54:42'),
(24, 3, 'U1-07', 1, 1, NULL, '2022-06-24 00:54:55', '2022-06-24 00:54:55'),
(25, 3, 'U1-08', 1, 1, NULL, '2022-06-24 00:55:04', '2022-06-24 00:55:04'),
(26, 3, 'U1-12', 1, 1, NULL, '2022-06-24 00:55:27', '2022-06-24 00:55:27'),
(27, 3, 'U1-19', 1, 1, NULL, '2022-06-24 00:55:37', '2022-06-24 00:55:37'),
(28, 3, 'U1-20', 1, 1, NULL, '2022-06-24 00:55:46', '2022-06-24 00:55:46'),
(29, 3, 'U1-21', 1, 1, NULL, '2022-06-24 00:55:55', '2022-06-24 00:55:55'),
(30, 3, 'U1-23', 1, 1, NULL, '2022-06-24 00:56:07', '2022-06-24 00:56:07'),
(31, 3, 'U1-18', 1, 1, NULL, '2022-06-24 00:59:03', '2022-06-24 00:59:03'),
(32, 2, 'Land', 1, 1, NULL, '2022-06-24 01:00:47', '2022-06-24 01:00:47'),
(33, 2, 'Air Side', 1, 1, NULL, '2022-06-24 01:00:56', '2022-06-24 01:00:56'),
(34, 2, 'Land Side', 1, 1, NULL, '2022-06-24 01:01:07', '2022-06-24 01:01:07'),
(35, 2, 'G1-01', 1, 1, NULL, '2022-06-24 01:01:19', '2022-06-24 01:01:19'),
(36, 1, 'CEILING FAN', 1, 1, NULL, '2022-06-24 01:02:00', '2022-06-24 01:02:00'),
(37, 1, 'CHILLED WATER PUMP', 1, 1, NULL, '2022-06-24 01:02:10', '2022-06-24 01:02:10'),
(38, 1, 'CHILLER', 1, 1, NULL, '2022-06-24 01:02:21', '2022-06-24 01:02:21'),
(39, 1, 'CHILLER CONTROL PANEL', 1, 1, NULL, '2022-06-24 01:02:32', '2022-06-24 01:02:32'),
(40, 1, 'CONDENSER WATER', 1, 1, NULL, '2022-06-24 01:02:42', '2022-06-24 01:02:42'),
(41, 1, 'COOLING TOWER', 1, 1, NULL, '2022-06-24 01:02:53', '2022-06-24 01:02:53'),
(42, 1, 'DOMESTIC WATER PUMP', 1, 1, NULL, '2022-06-24 01:03:05', '2022-06-24 01:03:05'),
(43, 1, 'DOMESTIC WATER PUMP CONTROLLER', 1, 1, NULL, '2022-06-24 01:03:20', '2022-06-24 01:03:20'),
(44, 1, 'DRINKING FOUNTAIN', 1, 1, NULL, '2022-06-24 01:03:32', '2022-06-24 01:03:32'),
(45, 1, 'EXHAUST FAN', 1, 1, NULL, '2022-06-24 01:03:45', '2022-06-24 01:03:45'),
(46, 1, 'AIR HANDLER UNIT', 1, 1, NULL, '2022-06-24 01:03:54', '2022-06-24 01:03:54'),
(47, 1, 'AIR HANDLER UNIT (outdoor)', 1, 1, NULL, '2022-06-24 01:04:05', '2022-06-24 01:04:05'),
(48, 1, 'FAN COIL UNIT', 1, 1, NULL, '2022-06-24 01:04:23', '2022-06-24 01:04:23'),
(49, 1, 'NOT AN ASSET IN MAXIMO', 1, 1, NULL, '2022-06-24 01:04:34', '2022-06-24 01:04:34'),
(50, 1, 'UV-FILTER - EXSITING', 1, 1, NULL, '2022-06-24 01:04:45', '2022-06-24 01:04:45'),
(51, 1, 'UV-FILTER - NEW', 1, 1, NULL, '2022-06-24 01:04:54', '2022-06-24 01:04:54'),
(52, 1, 'VAR. FREQ. DRIVE', 1, 1, 1, '2022-06-24 01:05:09', '2022-06-24 01:16:50'),
(53, 4, 'JK', 1, 1, NULL, '2022-06-28 02:13:03', '2022-06-28 02:13:03'),
(54, 3, 'U1-28', 1, 1, NULL, '2022-06-29 07:41:46', '2022-06-29 07:41:46'),
(55, 3, 'U1-22', 1, 1, NULL, '2022-06-30 03:03:31', '2022-06-30 03:03:31'),
(56, 7, 'J&D', 1, 1, NULL, '2022-06-30 03:03:31', '2022-06-30 03:03:31'),
(57, 7, 'SES', 1, 2, NULL, '2022-06-30 05:42:05', '2022-06-30 05:42:05');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'avatar.png',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permissionid` bigint(20) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `device_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `image`, `remember_token`, `permissionid`, `status`, `deleted_at`, `created_by`, `updated_by`, `created_at`, `updated_at`, `device_token`) VALUES
(1, 'SuperAdmin', 'superamin@gmail.com', NULL, '$2y$10$fOtFfLEJ30EAC6U/0fOl6ed3ckJagB9llEzt1.FSIhIDTKHbQyBDC', '/users/avatar2_1656680911.png', NULL, 1, 1, NULL, NULL, 1, '2022-06-23 02:37:41', '2022-07-07 04:57:09', NULL),
(2, 'Admin', 'admin@gmail.com', NULL, '$2y$10$VseD2y93UMRgObkxY0jad.P1zDV1k7sD9ZQ1peIh32Y4Zg8K4AgLu', '/users/avatar_1656680891.png', NULL, 1, 1, NULL, NULL, 1, '2022-06-23 04:09:09', '2022-07-01 07:38:11', NULL),
(3, 'Nick', 'nick@gmail.com', NULL, '$2y$10$hTb1GpysrTERzj/0lWX9DOALgdQfNfKXzURNxZT7kRLaImhSZXd8S', 'avatar4.png_1656483131.png', NULL, NULL, 1, '2022-06-29 02:34:55', NULL, 1, '2022-06-27 01:49:58', '2022-06-29 02:34:55', NULL),
(4, 'Ele', 'ele@gmail.com', NULL, '$2y$10$XRC/kX51O5qCDOuDqKLo/eEDwPSrx4zm5SJupvPx/r0JghVbdfBbS', 'avatar3.png_1656483113.png', NULL, NULL, 1, '2022-06-29 01:41:59', NULL, 1, '2022-06-27 01:53:37', '2022-06-29 01:41:59', NULL),
(5, 'Mick', 'mick@gmail.com', NULL, '$2y$10$OMVPW2oFq5h3zCRpNlZB2uqpb5iaSLQLPD4BZINDJM9Y00EhwmQme', 'avatar5.png_1656486781.png', NULL, NULL, 1, '2022-06-29 01:43:29', NULL, 1, '2022-06-29 01:43:01', '2022-06-29 01:43:29', NULL),
(6, 'Rahul', 'rahul@gmail.com', NULL, '$2y$10$Rs56cvXtL7tE4jMTdnIC7OOpfnN98C/qjhHNi395j9wphRmqW39bO', '/users/avatar5_1656680878.png', NULL, NULL, 1, NULL, NULL, 1, '2022-06-29 02:27:55', '2022-07-07 23:21:31', NULL),
(7, 'Yogesh', 'yogesh@gmail.com', NULL, '$2y$10$DLglPsQXdKjSYozgrZ.Pq.xojOxU4OwBzQfuLDWf40YumJmc3LfHW', '/users/avatar_1656680861.png', NULL, NULL, 1, NULL, NULL, 1, '2022-06-29 02:34:14', '2022-07-07 23:21:13', 'cvEAfRpouEW9Z10KkOODyh:APA91bFXcZUoa-KqP5iQFlVeH8jWfUNk2b6APAYYDOH5ynQYyNvqHUQi7ip3JpiK1XjY89C6cti38w2hDWfQ060-bTKIFqBh7sl1VhbzjmuGox4HEhLL3wZKSk57aHHgocW3kuGTE64K'),
(8, 'Sachin', 'sachin@gmail.com', NULL, '$2y$10$eKB5xi4V4q.Er62pM4/4Guv6R6zmW17gv9FcPQMnW.RSmzZwYjabS', '/users/avatar4_1656680839.png', NULL, NULL, 1, NULL, NULL, 1, '2022-06-29 02:34:42', '2022-07-19 11:55:29', 'cvEAfRpouEW9Z10KkOODyh:APA91bFXcZUoa-KqP5iQFlVeH8jWfUNk2b6APAYYDOH5ynQYyNvqHUQi7ip3JpiK1XjY89C6cti38w2hDWfQ060-bTKIFqBh7sl1VhbzjmuGox4HEhLL3wZKSk57aHHgocW3kuGTE64K'),
(9, 'sandeep', 'sandeep@gmail.com', NULL, '$2y$10$FJP7f.Ea1jW1Vsynl3r8e.nqsyPccdGd4bDK5zZUkLI/lG7EUqjqq', '/users/user8-128x128_1656680791.jpg', NULL, NULL, 1, NULL, NULL, 1, '2022-06-29 07:40:35', '2022-07-19 11:55:25', NULL),
(12, 'yogesh chandra', 'yogeshchandra@gmail.com', NULL, '$2y$10$WhMdG3srZK3nc7Q/EFVY3e3Da5fQuGiosyvOFpVVv7FnY7tNOMTXe', 'avatar.png', NULL, NULL, 1, NULL, NULL, 12, '2022-07-14 07:14:41', '2022-07-14 07:48:08', NULL),
(13, 'abhay', 'abhay@gmail.com', NULL, '$2y$10$gPrHqa7ETJ6e/UVz2hDMIesKBmBh9/8GRLat4/pp6WAHoaiG5Hbpa', 'avatar.png', NULL, NULL, 1, NULL, NULL, 1, '2022-07-14 09:34:54', '2022-07-14 09:34:54', NULL),
(15, 'Sunita', 'sunita@gmail.com', NULL, '$2y$10$DcXZzEKvPOFkuGxk/tPbyu5KkZAmclUNXcz3oejEyBY0poJWsD4ga', '/users/chs-logo_1658121830.png', NULL, NULL, 1, NULL, NULL, 1, '2022-07-18 04:50:20', '2022-07-18 05:23:50', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `usersbkup`
--

CREATE TABLE `usersbkup` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'avatar.png',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `permissionid` tinyint(4) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `web_settings`
--

CREATE TABLE `web_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `option_title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `option_value` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `web_settings`
--

INSERT INTO `web_settings` (`id`, `option_title`, `option_value`, `created_by`, `updated_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'header', '{\"sitename\":\"IEM System\",\"tsclr\":\"2\",\"copyright\":\"Copyright \\u00a9 2022 IEMS. All rights reserved.\",\"logoimage\":\"\\/websetting\\/chs-logo_1657189473.png\",\"faviconimage\":\"\\/websetting\\/ch-favicon_1656925650.png\"}', 1, NULL, NULL, '2022-07-04 03:37:30', '2022-07-07 04:54:33');

-- --------------------------------------------------------

--
-- Table structure for table `work_orders`
--

CREATE TABLE `work_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_nr` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `department_no` int(11) DEFAULT NULL,
  `equipmentissue_id` int(11) NOT NULL,
  `priority` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `scope_of_work` longtext COLLATE utf8mb4_unicode_ci,
  `staff_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `address` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `orderdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `start_date` timestamp NULL DEFAULT NULL,
  `end_date` timestamp NULL DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `work_orders`
--

INSERT INTO `work_orders` (`id`, `order_nr`, `user_id`, `department_no`, `equipmentissue_id`, `priority`, `description`, `scope_of_work`, `staff_id`, `client_id`, `address`, `orderdate`, `start_date`, `end_date`, `status`, `created_by`, `updated_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(10000, '#00000001', 1, 45, 10002, 'highest', 'Lorem Ipsum Is Simply Dummy Text Of The Printing And Typesetting Industry. Lorem Ipsum Has Been The Industry\'s Standard Dummy Text Ever Since The 1500s, When An Unknown Printer Took A Galley Of Type And Scrambled It To Make A Type Specimen Book. It Has Survived Not Only Five Centuries, But Also The Leap Into Electronic Typesetting, Remaining Essentially Unchanged. It Was Popularised In The 1960s With The Release Of Letraset Sheets Containing Lorem Ipsum Passages, And More Recently With Desktop Publishing Software Like Aldus PageMaker Including Versions Of Lorem Ipsum.', 'Contrary To Popular Belief, Lorem Ipsum Is Not Simply Random Text. It Has Roots In A Piece Of Classical Latin Literature From 45 BC, Making It Over 2000 Years Old. Richard McClintock, A Latin Professor At Hampden-Sydney College In Virginia, Looked Up One Of The More Obscure Latin Words, Consectetur, From A Lorem Ipsum Passage, And Going Through The Cites Of The Word In Classical Literature, Discovered The Undoubtable Source.', 15, 7, 'Silver Park, Wagle Estate, Road No 3, Mulund Checknaka, Thane(w)', '2022-07-18 06:41:59', '2022-07-18 06:28:00', NULL, 3, 1, 1, NULL, '2022-07-18 06:28:42', '2022-07-18 06:41:59'),
(10001, '#00010001', 1, 50, 10006, 'medium', '\"Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?\"', '\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\"', 8, 7, 'Silver Park, Wagle Estate, Road No 3, Mulund Checknaka, Thane(w)', '2022-07-19 06:00:00', '2022-07-19 06:00:00', NULL, 1, 1, NULL, NULL, '2022-07-19 06:03:20', '2022-07-19 06:03:20'),
(10002, '#00010002', 1, 50, 10006, 'medium', '\"Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?\"', '\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\"', 8, 7, 'Silver Park, Wagle Estate, Road No 3, Mulund Checknaka, Thane(w)', '2022-07-19 06:00:00', '2022-07-19 06:00:00', NULL, 1, 1, NULL, NULL, '2022-07-19 06:04:12', '2022-07-19 06:04:12'),
(10004, '#00010003', 1, 45, 10000, 'lowest', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 8, 6, '6th Flr, B Wing, Bsel Tak Park, Sector 30, Opp Vashi Railway Station, Vashi, Navi Mumbai', '2022-07-19 11:48:00', '2022-07-18 23:48:00', NULL, 3, 1, NULL, NULL, '2022-07-19 11:50:41', '2022-07-19 11:50:41'),
(10005, '#00010005', 1, 40, 10004, 'low', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 8, 6, '6th Flr, B Wing, Bsel Tak Park, Sector 30, Opp Vashi Railway Station, Vashi, Navi Mumbai', '2022-07-19 13:00:00', '2022-07-19 01:00:00', NULL, 3, 1, NULL, NULL, '2022-07-19 12:02:00', '2022-07-19 12:02:00'),
(10006, '#00010006', 1, 40, 10004, 'low', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 8, 6, '6th Flr, B Wing, Bsel Tak Park, Sector 30, Opp Vashi Railway Station, Vashi, Navi Mumbai', '2022-07-19 13:00:00', '2022-07-19 01:00:00', NULL, 3, 1, NULL, NULL, '2022-07-19 12:06:48', '2022-07-19 12:06:48');

-- --------------------------------------------------------

--
-- Table structure for table `work_order_images`
--

CREATE TABLE `work_order_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `workorder_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` tinyint(4) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `work_order_meta`
--

CREATE TABLE `work_order_meta` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `woid` bigint(20) UNSIGNED NOT NULL,
  `job_performed_by` bigint(20) UNSIGNED DEFAULT NULL,
  `start_date` timestamp NULL DEFAULT NULL,
  `end_date` timestamp NULL DEFAULT NULL,
  `remarks` longtext COLLATE utf8mb4_unicode_ci,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `work_order_meta`
--

INSERT INTO `work_order_meta` (`id`, `woid`, `job_performed_by`, `start_date`, `end_date`, `remarks`, `created_by`, `updated_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 10000, 8, '2022-06-07 06:55:00', '2022-06-06 19:55:00', 'Testing', 1, NULL, NULL, '2022-07-18 06:44:50', '2022-07-18 06:44:50'),
(2, 10000, 8, '2022-06-07 06:55:00', '2022-06-06 19:55:00', 'Testing', 1, NULL, NULL, '2022-07-18 06:46:39', '2022-07-18 06:46:39'),
(4, 10000, 8, '2022-06-07 06:55:00', '0000-00-00 00:00:00', 'Testing', 1, NULL, NULL, '2022-07-18 06:53:05', '2022-07-18 06:53:05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_mails`
--
ALTER TABLE `admin_mails`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_mails_user_id_foreign` (`user_id`),
  ADD KEY `admin_mails_msg_id_foreign` (`msg_id`);

--
-- Indexes for table `contact_forms`
--
ALTER TABLE `contact_forms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contact_forms_user_id_foreign` (`user_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `equipment`
--
ALTER TABLE `equipment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `equipment_user_id_foreign` (`user_id`),
  ADD KEY `equipment_inventory_id_foreign` (`inventory_id`);

--
-- Indexes for table `equipment_issue_loggings`
--
ALTER TABLE `equipment_issue_loggings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `equipment_issue_loggings_user_id_foreign` (`user_id`),
  ADD KEY `equipment_issue_loggings_equipment_id_foreign` (`equipment_id`),
  ADD KEY `equipment_issue_loggings_staff_id_foreign` (`staff_id`),
  ADD KEY `equipment_issue_loggings_client_id_foreign` (`client_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `file_logs`
--
ALTER TABLE `file_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventories`
--
ALTER TABLE `inventories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `inventories_user_id_foreign` (`user_id`);

--
-- Indexes for table `job_orders`
--
ALTER TABLE `job_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `job_orders_job_performed_by_foreign` (`job_performed_by`),
  ADD KEY `job_orders_eilid_foreign` (`eilid`);

--
-- Indexes for table `menuitem`
--
ALTER TABLE `menuitem`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menuses`
--
ALTER TABLE `menuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_user_id_foreign` (`user_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `reset_code_passwords`
--
ALTER TABLE `reset_code_passwords`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reset_code_passwords_email_index` (`email`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `taxonomies`
--
ALTER TABLE `taxonomies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `taxonomy_data`
--
ALTER TABLE `taxonomy_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `taxonomy_data_taxonomy_id_foreign` (`taxonomy_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `usersbkup`
--
ALTER TABLE `usersbkup`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usersbkup_email_unique` (`email`);

--
-- Indexes for table `web_settings`
--
ALTER TABLE `web_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `work_orders`
--
ALTER TABLE `work_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `work_orders_user_id_foreign` (`user_id`),
  ADD KEY `work_orders_staff_id_foreign` (`staff_id`),
  ADD KEY `work_orders_client_id_foreign` (`client_id`);

--
-- Indexes for table `work_order_images`
--
ALTER TABLE `work_order_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `work_order_images_workorder_id_foreign` (`workorder_id`),
  ADD KEY `work_order_images_user_id_foreign` (`user_id`);

--
-- Indexes for table `work_order_meta`
--
ALTER TABLE `work_order_meta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `work_order_meta_job_performed_by_foreign` (`job_performed_by`),
  ADD KEY `work_order_meta_woid_foreign` (`woid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_mails`
--
ALTER TABLE `admin_mails`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `contact_forms`
--
ALTER TABLE `contact_forms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `equipment`
--
ALTER TABLE `equipment`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `equipment_issue_loggings`
--
ALTER TABLE `equipment_issue_loggings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10007;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `file_logs`
--
ALTER TABLE `file_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `inventories`
--
ALTER TABLE `inventories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `job_orders`
--
ALTER TABLE `job_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menuitem`
--
ALTER TABLE `menuitem`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `menuses`
--
ALTER TABLE `menuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `reset_code_passwords`
--
ALTER TABLE `reset_code_passwords`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `taxonomies`
--
ALTER TABLE `taxonomies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `taxonomy_data`
--
ALTER TABLE `taxonomy_data`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `usersbkup`
--
ALTER TABLE `usersbkup`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `web_settings`
--
ALTER TABLE `web_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `work_orders`
--
ALTER TABLE `work_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10007;

--
-- AUTO_INCREMENT for table `work_order_images`
--
ALTER TABLE `work_order_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `work_order_meta`
--
ALTER TABLE `work_order_meta`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin_mails`
--
ALTER TABLE `admin_mails`
  ADD CONSTRAINT `admin_mails_msg_id_foreign` FOREIGN KEY (`msg_id`) REFERENCES `contact_forms` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `admin_mails_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `contact_forms`
--
ALTER TABLE `contact_forms`
  ADD CONSTRAINT `contact_forms_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `equipment`
--
ALTER TABLE `equipment`
  ADD CONSTRAINT `equipment_inventory_id_foreign` FOREIGN KEY (`inventory_id`) REFERENCES `inventories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `equipment_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `equipment_issue_loggings`
--
ALTER TABLE `equipment_issue_loggings`
  ADD CONSTRAINT `equipment_issue_loggings_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `equipment_issue_loggings_equipment_id_foreign` FOREIGN KEY (`equipment_id`) REFERENCES `equipment` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `equipment_issue_loggings_staff_id_foreign` FOREIGN KEY (`staff_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `equipment_issue_loggings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `inventories`
--
ALTER TABLE `inventories`
  ADD CONSTRAINT `inventories_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `job_orders`
--
ALTER TABLE `job_orders`
  ADD CONSTRAINT `job_orders_eilid_foreign` FOREIGN KEY (`eilid`) REFERENCES `equipment_issue_loggings` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `job_orders_job_performed_by_foreign` FOREIGN KEY (`job_performed_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `taxonomy_data`
--
ALTER TABLE `taxonomy_data`
  ADD CONSTRAINT `taxonomy_data_taxonomy_id_foreign` FOREIGN KEY (`taxonomy_id`) REFERENCES `taxonomies` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `work_orders`
--
ALTER TABLE `work_orders`
  ADD CONSTRAINT `work_orders_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `inventories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `work_orders_staff_id_foreign` FOREIGN KEY (`staff_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `work_orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
