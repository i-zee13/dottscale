-- Create missing portfolio tables (fixes /admin/portfolios 500)
-- Preferred:
-- /opt/alt/php81/usr/bin/php artisan migrate --path=database/migrations/2026_09_26_163000_create_portfolio_categories_table.php --force

CREATE TABLE IF NOT EXISTS `portfolio_categories` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `service_name` varchar(255) DEFAULT NULL,
  `publish` tinyint NOT NULL DEFAULT 1,
  `created_by` int unsigned DEFAULT NULL,
  `updated_by` int unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `portfolios` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `portfolio_name` varchar(255) DEFAULT NULL,
  `page_route` varchar(255) DEFAULT NULL,
  `page_title` varchar(255) DEFAULT NULL,
  `categories` text DEFAULT NULL,
  `is_slider_show` tinyint NOT NULL DEFAULT 0,
  `thumbnail` varchar(255) DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT 1,
  `page_meta_tags` longtext DEFAULT NULL,
  `meta_og_image` varchar(255) DEFAULT NULL,
  `created_by` int unsigned DEFAULT NULL,
  `updated_by` int unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
