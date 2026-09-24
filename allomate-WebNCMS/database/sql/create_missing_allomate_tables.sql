-- Missing Allomate tables (not present in khanllp.sql).
-- Run in phpMyAdmin on dottbfyw_staging.

CREATE TABLE IF NOT EXISTS `reports_types` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `report_type` varchar(191) NOT NULL,
  `status` tinyint NOT NULL DEFAULT 1,
  `created_by` int UNSIGNED DEFAULT NULL,
  `updated_by` int UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `reports` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `report_type_id` int UNSIGNED DEFAULT NULL,
  `report_title` varchar(191) DEFAULT NULL,
  `report_description` text,
  `publish_date` date DEFAULT NULL,
  `report_file` varchar(255) DEFAULT NULL,
  `slug` varchar(191) DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT 1,
  `created_by` int UNSIGNED DEFAULT NULL,
  `updated_by` int UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `application_forms` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `application_for` int UNSIGNED DEFAULT NULL,
  `first_name` varchar(191) DEFAULT NULL,
  `last_name` varchar(191) DEFAULT NULL,
  `email` varchar(191) DEFAULT NULL,
  `phone_number` varchar(50) DEFAULT NULL,
  `message` text,
  `linked_in` varchar(255) DEFAULT NULL,
  `resume` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `contact_us_forms` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) DEFAULT NULL,
  `email` varchar(191) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `subject` varchar(191) DEFAULT NULL,
  `message` text,
  `page_reference` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
