-- MySQL dump 10.13  Distrib 8.0.27, for Win64 (x86_64)
--
-- Host: localhost    Database: bslonc02_bslonc
-- ------------------------------------------------------
-- Server version	8.0.27

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `audit`
--

DROP TABLE IF EXISTS `audit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `audit` (
                         `id` int NOT NULL AUTO_INCREMENT,
                         `user` int NOT NULL,
                         `page` varchar(255) NOT NULL,
                         `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                         `ip` varchar(255) NOT NULL,
                         `viewed` int NOT NULL,
                         PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `bsl_sample_data`
--

DROP TABLE IF EXISTS `bsl_sample_data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bsl_sample_data` (
                                   `bsl_sample_data_id` int NOT NULL AUTO_INCREMENT,
                                   `bsl_sample_data_name` varchar(128) NOT NULL,
                                   `bsl_sample_data_frame_rate` int NOT NULL,
                                   `bsl_sample_data_configuration_type` int NOT NULL,
                                   `bsl_sample_data_laser_type` varchar(45) NOT NULL,
                                   `bsl_sample_data_other_laser_type` varchar(45) DEFAULT NULL,
                                   `bsl_sample_data_laser_wavelength` int NOT NULL,
                                   `bsl_sample_data_permission` int NOT NULL,
                                   `bsl_sample_data_insert_timestamp` datetime NOT NULL,
                                   `bsl_sample_data_amount_of_images` int NOT NULL,
                                   `bsl_sample_data_unique_id` varchar(45) NOT NULL,
                                   `bsl_sample_data_owner_id` int NOT NULL,
                                   PRIMARY KEY (`bsl_sample_data_id`),
                                   UNIQUE KEY `bsl_sample_data_id_UNIQUE` (`bsl_sample_data_id`),
                                   UNIQUE KEY `bsl_sample_data_unique_id_UNIQUE` (`bsl_sample_data_unique_id`)
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `bsl_sample_images`
--

DROP TABLE IF EXISTS `bsl_sample_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bsl_sample_images` (
                                     `bsl_sample_images_id` int NOT NULL AUTO_INCREMENT,
                                     `bsl_sample_images_data_id` int NOT NULL,
                                     `bsl_sample_images_name` varchar(128) NOT NULL,
                                     `bsl_sample_images_size` varchar(45) NOT NULL,
                                     `bsl_sample_images_blob` blob NOT NULL,
                                     `bsl_sample_images_timestamp` datetime DEFAULT NULL,
                                     `bsl_sample_images_insert_timestamp` datetime NOT NULL,
                                     PRIMARY KEY (`bsl_sample_images_id`),
                                     UNIQUE KEY `bsl_sample_images_id_UNIQUE` (`bsl_sample_images_id`)
) ENGINE=InnoDB AUTO_INCREMENT=183 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `crons`
--

DROP TABLE IF EXISTS `crons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `crons` (
                         `id` int NOT NULL AUTO_INCREMENT,
                         `active` int NOT NULL DEFAULT '1',
                         `sort` int NOT NULL,
                         `name` varchar(255) NOT NULL,
                         `file` varchar(255) NOT NULL,
                         `createdby` int NOT NULL,
                         `created` datetime DEFAULT NULL,
                         `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                         PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `crons_logs`
--

DROP TABLE IF EXISTS `crons_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `crons_logs` (
                              `id` int NOT NULL AUTO_INCREMENT,
                              `cron_id` int NOT NULL,
                              `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                              `user_id` int NOT NULL,
                              PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `email`
--

DROP TABLE IF EXISTS `email`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `email` (
                         `id` int NOT NULL AUTO_INCREMENT,
                         `website_name` varchar(100) NOT NULL,
                         `smtp_server` varchar(100) NOT NULL,
                         `smtp_port` int NOT NULL,
                         `email_login` varchar(150) NOT NULL,
                         `email_pass` varchar(100) NOT NULL,
                         `from_name` varchar(100) NOT NULL,
                         `from_email` varchar(150) NOT NULL,
                         `transport` varchar(255) NOT NULL,
                         `verify_url` varchar(255) NOT NULL,
                         `email_act` int NOT NULL,
                         `debug_level` int NOT NULL DEFAULT '0',
                         `isSMTP` int NOT NULL DEFAULT '0',
                         `isHTML` varchar(5) NOT NULL DEFAULT 'true',
                         `useSMTPauth` varchar(6) NOT NULL DEFAULT 'true',
                         `authtype` varchar(50) DEFAULT 'CRAM-MD5',
                         PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `groups_menus`
--

DROP TABLE IF EXISTS `groups_menus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `groups_menus` (
                                `id` int unsigned NOT NULL AUTO_INCREMENT,
                                `group_id` int unsigned NOT NULL,
                                `menu_id` int unsigned NOT NULL,
                                PRIMARY KEY (`id`),
                                KEY `group_id` (`group_id`),
                                KEY `menu_id` (`menu_id`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `keys`
--

DROP TABLE IF EXISTS `keys`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `keys` (
                        `id` int NOT NULL AUTO_INCREMENT,
                        `stripe_ts` varchar(255) NOT NULL,
                        `stripe_tp` varchar(255) NOT NULL,
                        `stripe_ls` varchar(255) NOT NULL,
                        `stripe_lp` varchar(255) NOT NULL,
                        `recap_pub` varchar(100) NOT NULL,
                        `recap_pri` varchar(100) NOT NULL,
                        PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `logs`
--

DROP TABLE IF EXISTS `logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `logs` (
                        `id` int NOT NULL AUTO_INCREMENT,
                        `user_id` int NOT NULL DEFAULT '0',
                        `logdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                        `logtype` varchar(25) NOT NULL,
                        `lognote` mediumtext NOT NULL,
                        `ip` varchar(75) DEFAULT NULL,
                        `metadata` blob,
                        PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `menus`
--

DROP TABLE IF EXISTS `menus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `menus` (
                         `id` int NOT NULL AUTO_INCREMENT,
                         `menu_title` varchar(255) NOT NULL,
                         `parent` int NOT NULL,
                         `dropdown` int NOT NULL,
                         `logged_in` int NOT NULL,
                         `display_order` int NOT NULL,
                         `label` varchar(255) NOT NULL,
                         `link` varchar(255) NOT NULL,
                         `icon_class` varchar(255) NOT NULL,
                         PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `message_threads`
--

DROP TABLE IF EXISTS `message_threads`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `message_threads` (
                                   `id` int NOT NULL AUTO_INCREMENT,
                                   `msg_to` int NOT NULL,
                                   `msg_from` int NOT NULL,
                                   `msg_subject` varchar(255) NOT NULL,
                                   `last_update` datetime NOT NULL,
                                   `last_update_by` int NOT NULL,
                                   `archive_from` int NOT NULL DEFAULT '0',
                                   `archive_to` int NOT NULL DEFAULT '0',
                                   `hidden_from` int NOT NULL DEFAULT '0',
                                   `hidden_to` int NOT NULL DEFAULT '0',
                                   PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `messages` (
                            `id` int NOT NULL AUTO_INCREMENT,
                            `msg_from` int NOT NULL,
                            `msg_to` int NOT NULL,
                            `msg_body` mediumtext NOT NULL,
                            `msg_read` int NOT NULL,
                            `msg_thread` int NOT NULL,
                            `deleted` int NOT NULL,
                            `sent_on` datetime NOT NULL,
                            PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `notifications` (
                                 `id` int unsigned NOT NULL AUTO_INCREMENT,
                                 `user_id` int NOT NULL,
                                 `message` longtext NOT NULL,
                                 `is_read` tinyint NOT NULL,
                                 `is_archived` tinyint(1) DEFAULT '0',
                                 `date_created` datetime DEFAULT NULL,
                                 `date_read` datetime DEFAULT NULL,
                                 `last_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                                 `class` varchar(100) DEFAULT NULL,
                                 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pages` (
                         `id` int NOT NULL AUTO_INCREMENT,
                         `page` varchar(255) DEFAULT NULL,
                         `title` varchar(255) DEFAULT NULL,
                         `private` int NOT NULL DEFAULT '0',
                         `re_auth` int NOT NULL DEFAULT '0',
                         `core` int DEFAULT '0',
                         PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=117 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `permission_page_matches`
--

DROP TABLE IF EXISTS `permission_page_matches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permission_page_matches` (
                                           `id` int NOT NULL AUTO_INCREMENT,
                                           `permission_id` int DEFAULT NULL,
                                           `page_id` int DEFAULT NULL,
                                           PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=80 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permissions` (
                               `id` int NOT NULL AUTO_INCREMENT,
                               `name` varchar(150) NOT NULL,
                               PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `profiles`
--

DROP TABLE IF EXISTS `profiles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `profiles` (
                            `id` int NOT NULL AUTO_INCREMENT,
                            `user_id` int NOT NULL,
                            `bio` mediumtext NOT NULL,
                            PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `settings` (
                            `id` int NOT NULL AUTO_INCREMENT,
                            `recaptcha` int NOT NULL DEFAULT '0',
                            `force_ssl` int NOT NULL,
                            `css_sample` int NOT NULL,
                            `site_name` varchar(100) NOT NULL,
                            `language` varchar(255) NOT NULL,
                            `site_offline` int NOT NULL,
                            `force_pr` int NOT NULL,
                            `glogin` int NOT NULL DEFAULT '0',
                            `fblogin` int NOT NULL,
                            `gid` varchar(255) NOT NULL,
                            `gsecret` varchar(255) NOT NULL,
                            `gredirect` varchar(255) NOT NULL,
                            `ghome` varchar(255) NOT NULL,
                            `fbid` varchar(255) NOT NULL,
                            `fbsecret` varchar(255) NOT NULL,
                            `fbcallback` varchar(255) NOT NULL,
                            `graph_ver` varchar(255) NOT NULL,
                            `finalredir` varchar(255) NOT NULL,
                            `req_cap` int NOT NULL,
                            `req_num` int NOT NULL,
                            `min_pw` int NOT NULL,
                            `max_pw` int NOT NULL,
                            `min_un` int NOT NULL,
                            `max_un` int NOT NULL,
                            `messaging` int NOT NULL,
                            `snooping` int NOT NULL,
                            `echouser` int NOT NULL,
                            `wys` int NOT NULL,
                            `change_un` int NOT NULL,
                            `backup_dest` varchar(255) NOT NULL,
                            `backup_source` varchar(255) NOT NULL,
                            `backup_table` varchar(255) NOT NULL,
                            `msg_notification` int NOT NULL,
                            `permission_restriction` int NOT NULL,
                            `auto_assign_un` int NOT NULL,
                            `page_permission_restriction` int NOT NULL,
                            `msg_blocked_users` int NOT NULL,
                            `msg_default_to` int NOT NULL,
                            `notifications` int NOT NULL,
                            `notif_daylimit` int NOT NULL,
                            `recap_public` varchar(100) NOT NULL,
                            `recap_private` varchar(100) NOT NULL,
                            `page_default_private` int NOT NULL,
                            `navigation_type` tinyint(1) NOT NULL,
                            `copyright` varchar(255) NOT NULL,
                            `custom_settings` int NOT NULL,
                            `system_announcement` varchar(255) NOT NULL,
                            `twofa` int DEFAULT '0',
                            `force_notif` tinyint(1) DEFAULT NULL,
                            `cron_ip` varchar(255) DEFAULT NULL,
                            `registration` tinyint(1) DEFAULT NULL,
                            `join_vericode_expiry` int unsigned NOT NULL,
                            `reset_vericode_expiry` int unsigned NOT NULL,
                            `admin_verify` tinyint(1) NOT NULL,
                            `admin_verify_timeout` int NOT NULL,
                            `session_manager` tinyint(1) NOT NULL,
                            `template` varchar(255) DEFAULT 'standard',
                            `saas` tinyint(1) DEFAULT NULL,
                            `redirect_uri_after_login` mediumtext,
                            `show_tos` tinyint(1) DEFAULT '1',
                            `default_language` varchar(11) DEFAULT NULL,
                            `allow_language` tinyint(1) DEFAULT NULL,
                            `spice_api` varchar(75) DEFAULT NULL,
                            `announce` datetime DEFAULT NULL,
                            `bleeding_edge` tinyint(1) DEFAULT '0',
                            `err_time` int DEFAULT '15',
                            `container_open_class` varchar(255) DEFAULT 'container-fluid',
                            `debug` tinyint(1) DEFAULT '0',
                            PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `updates`
--

DROP TABLE IF EXISTS `updates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `updates` (
                           `id` int NOT NULL AUTO_INCREMENT,
                           `migration` varchar(15) NOT NULL,
                           `applied_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                           `update_skipped` tinyint(1) DEFAULT NULL,
                           PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `us_announcements`
--

DROP TABLE IF EXISTS `us_announcements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `us_announcements` (
                                    `id` int NOT NULL AUTO_INCREMENT,
                                    `dismissed` int NOT NULL,
                                    `link` varchar(255) DEFAULT NULL,
                                    `title` varchar(255) DEFAULT NULL,
                                    `message` varchar(255) DEFAULT NULL,
                                    `ignore` varchar(50) DEFAULT NULL,
                                    `class` varchar(50) DEFAULT NULL,
                                    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `us_fingerprint_assets`
--

DROP TABLE IF EXISTS `us_fingerprint_assets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `us_fingerprint_assets` (
                                         `kFingerprintAssetID` int unsigned NOT NULL AUTO_INCREMENT,
                                         `fkFingerprintID` int NOT NULL,
                                         `IP_Address` varchar(255) NOT NULL,
                                         `User_Browser` varchar(255) NOT NULL,
                                         `User_OS` varchar(255) NOT NULL,
                                         PRIMARY KEY (`kFingerprintAssetID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `us_fingerprints`
--

DROP TABLE IF EXISTS `us_fingerprints`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `us_fingerprints` (
                                   `kFingerprintID` int unsigned NOT NULL AUTO_INCREMENT,
                                   `fkUserID` int NOT NULL,
                                   `Fingerprint` varchar(32) NOT NULL,
                                   `Fingerprint_Expiry` datetime NOT NULL,
                                   `Fingerprint_Added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                                   PRIMARY KEY (`kFingerprintID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `us_form_validation`
--

DROP TABLE IF EXISTS `us_form_validation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `us_form_validation` (
                                      `id` int NOT NULL AUTO_INCREMENT,
                                      `value` varchar(255) NOT NULL,
                                      `description` varchar(255) NOT NULL,
                                      `params` varchar(255) NOT NULL,
                                      PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `us_form_views`
--

DROP TABLE IF EXISTS `us_form_views`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `us_form_views` (
                                 `id` int NOT NULL AUTO_INCREMENT,
                                 `form_name` varchar(255) NOT NULL,
                                 `view_name` varchar(255) NOT NULL,
                                 `fields` mediumtext NOT NULL,
                                 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `us_forms`
--

DROP TABLE IF EXISTS `us_forms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `us_forms` (
                            `id` int NOT NULL AUTO_INCREMENT,
                            `form` varchar(255) NOT NULL,
                            PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `us_ip_blacklist`
--

DROP TABLE IF EXISTS `us_ip_blacklist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `us_ip_blacklist` (
                                   `id` int NOT NULL AUTO_INCREMENT,
                                   `ip` varchar(50) NOT NULL,
                                   `last_user` int NOT NULL DEFAULT '0',
                                   `reason` int NOT NULL DEFAULT '0',
                                   PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `us_ip_list`
--

DROP TABLE IF EXISTS `us_ip_list`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `us_ip_list` (
                              `id` int NOT NULL AUTO_INCREMENT,
                              `ip` varchar(50) NOT NULL,
                              `user_id` int NOT NULL,
                              `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                              PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `us_ip_whitelist`
--

DROP TABLE IF EXISTS `us_ip_whitelist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `us_ip_whitelist` (
                                   `id` int NOT NULL AUTO_INCREMENT,
                                   `ip` varchar(50) NOT NULL,
                                   PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `us_management`
--

DROP TABLE IF EXISTS `us_management`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `us_management` (
                                 `id` int NOT NULL AUTO_INCREMENT,
                                 `page` varchar(255) NOT NULL,
                                 `view` varchar(255) NOT NULL,
                                 `feature` varchar(255) NOT NULL,
                                 `access` varchar(255) NOT NULL,
                                 PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `us_plugin_hooks`
--

DROP TABLE IF EXISTS `us_plugin_hooks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `us_plugin_hooks` (
                                   `id` int unsigned NOT NULL AUTO_INCREMENT,
                                   `page` varchar(255) NOT NULL,
                                   `folder` varchar(255) NOT NULL,
                                   `position` varchar(255) NOT NULL,
                                   `hook` varchar(255) NOT NULL,
                                   `disabled` tinyint(1) DEFAULT '0',
                                   PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `us_plugins`
--

DROP TABLE IF EXISTS `us_plugins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `us_plugins` (
                              `id` int NOT NULL AUTO_INCREMENT,
                              `plugin` varchar(255) DEFAULT NULL,
                              `status` varchar(255) DEFAULT NULL,
                              `updates` mediumtext,
                              `last_check` datetime DEFAULT '2020-01-01 00:00:00',
                              PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `us_saas_levels`
--

DROP TABLE IF EXISTS `us_saas_levels`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `us_saas_levels` (
                                  `id` int NOT NULL AUTO_INCREMENT,
                                  `level` varchar(255) NOT NULL,
                                  `users` int NOT NULL,
                                  `details` mediumtext NOT NULL,
                                  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `us_saas_orgs`
--

DROP TABLE IF EXISTS `us_saas_orgs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `us_saas_orgs` (
                                `id` int NOT NULL AUTO_INCREMENT,
                                `org` varchar(255) NOT NULL,
                                `owner` int NOT NULL,
                                `level` int NOT NULL,
                                `active` int NOT NULL DEFAULT '1',
                                PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `us_user_sessions`
--

DROP TABLE IF EXISTS `us_user_sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `us_user_sessions` (
                                    `kUserSessionID` int unsigned NOT NULL AUTO_INCREMENT,
                                    `fkUserID` int unsigned NOT NULL,
                                    `UserFingerprint` varchar(255) NOT NULL,
                                    `UserSessionIP` varchar(255) NOT NULL,
                                    `UserSessionOS` varchar(255) NOT NULL,
                                    `UserSessionBrowser` varchar(255) NOT NULL,
                                    `UserSessionStarted` datetime NOT NULL,
                                    `UserSessionLastUsed` datetime DEFAULT NULL,
                                    `UserSessionLastPage` varchar(255) NOT NULL,
                                    `UserSessionEnded` tinyint(1) NOT NULL DEFAULT '0',
                                    `UserSessionEnded_Time` datetime DEFAULT NULL,
                                    PRIMARY KEY (`kUserSessionID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `user_permission_matches`
--

DROP TABLE IF EXISTS `user_permission_matches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_permission_matches` (
                                           `id` int NOT NULL AUTO_INCREMENT,
                                           `user_id` int NOT NULL,
                                           `permission_id` int NOT NULL,
                                           PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=117 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
                         `id` int NOT NULL AUTO_INCREMENT,
                         `permissions` tinyint(1) NOT NULL,
                         `email` varchar(155) NOT NULL,
                         `email_new` varchar(155) DEFAULT NULL,
                         `username` varchar(255) NOT NULL,
                         `password` varchar(255) DEFAULT NULL,
                         `pin` varchar(255) DEFAULT NULL,
                         `fname` varchar(255) NOT NULL,
                         `lname` varchar(255) NOT NULL,
                         `language` varchar(255) DEFAULT 'en-US',
                         `email_verified` tinyint(1) NOT NULL DEFAULT '0',
                         `vericode` varchar(15) DEFAULT NULL,
                         `vericode_expiry` datetime DEFAULT NULL,
                         `oauth_provider` varchar(255) DEFAULT NULL,
                         `oauth_uid` varchar(255) DEFAULT NULL,
                         `gender` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
                         `locale` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
                         `gpluslink` varchar(255) DEFAULT NULL,
                         `account_owner` tinyint NOT NULL DEFAULT '1',
                         `account_id` int NOT NULL DEFAULT '0',
                         `account_mgr` int NOT NULL DEFAULT '0',
                         `fb_uid` varchar(255) DEFAULT NULL,
                         `picture` varchar(255) DEFAULT NULL,
                         `created` datetime NOT NULL,
                         `protected` tinyint(1) NOT NULL DEFAULT '0',
                         `msg_exempt` tinyint(1) NOT NULL DEFAULT '0',
                         `dev_user` tinyint(1) NOT NULL DEFAULT '0',
                         `msg_notification` tinyint(1) NOT NULL DEFAULT '1',
                         `cloak_allowed` tinyint(1) NOT NULL DEFAULT '0',
                         `oauth_tos_accepted` tinyint(1) DEFAULT NULL,
                         `un_changed` tinyint(1) NOT NULL DEFAULT '0',
                         `force_pr` tinyint(1) NOT NULL DEFAULT '0',
                         `logins` int unsigned NOT NULL DEFAULT '0',
                         `last_login` datetime DEFAULT NULL,
                         `join_date` datetime DEFAULT NULL,
                         `modified` datetime DEFAULT NULL,
                         `active` tinyint(1) DEFAULT '1',
                         `institution` varchar(128) DEFAULT NULL,
                         `skills` varchar(128) DEFAULT NULL,
                         `agreement` tinyint(1) DEFAULT NULL,
                         `newsletter` tinyint(1) DEFAULT NULL,
                         PRIMARY KEY (`id`),
                         KEY `EMAIL` (`email`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `users_online`
--

DROP TABLE IF EXISTS `users_online`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users_online` (
                                `id` int NOT NULL,
                                `ip` varchar(15) NOT NULL,
                                `timestamp` varchar(15) NOT NULL,
                                `user_id` int DEFAULT NULL,
                                `session` varchar(50) NOT NULL,
                                PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `users_session`
--

DROP TABLE IF EXISTS `users_session`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users_session` (
                                 `id` int NOT NULL AUTO_INCREMENT,
                                 `user_id` int NOT NULL,
                                 `hash` varchar(255) NOT NULL,
                                 `uagent` mediumtext,
                                 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-10-18  9:15:32
