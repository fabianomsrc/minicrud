DROP DATABASE IF EXISTS `minicrud`;

CREATE DATABASE `minicrud` DEFAULT CHARACTER SET `utf8mb4` COLLATE `utf8mb4_general_ci`;

USE `minicrud`;

DROP TABLE IF EXISTS `person`;

CREATE TABLE `person` (
  `person_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `person_name` varchar(150) NOT NULL DEFAULT '',
  `person_email` varchar(100) NOT NULL DEFAULT '',
  `person_phone` char(20) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`person_id`),
  UNIQUE KEY `UQ_person_email` (`person_email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
