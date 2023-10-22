-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           8.0.30 - MySQL Community Server - GPL
-- SE du serveur:                Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Listage de la structure de table laravel. domains
CREATE TABLE IF NOT EXISTS `domains` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `active` enum('Y','N') COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `title` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `folder` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `analytics` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `google_maps_api_key` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `maintenance_start` datetime DEFAULT NULL,
  `maintenance_end` datetime DEFAULT NULL,
  `maintenance_message` text COLLATE utf8mb3_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Listage des données de la table laravel.domains : ~0 rows (environ)
INSERT INTO `domains` (`id`, `active`, `title`, `name`, `folder`, `analytics`, `google_maps_api_key`, `maintenance_start`, `maintenance_end`, `maintenance_message`, `created_at`, `updated_at`) VALUES
	(1, 'Y', 'Laravel', 'laravel.test', NULL, NULL, NULL, NULL, NULL, NULL, '2023-07-09 13:59:45', '2023-07-09 13:59:45'),
	(2, 'Y', 'Laravel 2', 'laravel2.test', NULL, NULL, NULL, NULL, NULL, NULL, '2023-07-09 14:07:27', '2023-07-09 14:07:30');

-- Listage de la structure de table laravel. domains_languages
CREATE TABLE IF NOT EXISTS `domains_languages` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `domain_id` int unsigned NOT NULL,
  `language_id` int unsigned NOT NULL,
  `active` enum('Y','N') COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `order` int NOT NULL DEFAULT '1',
  `url_redirect` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `url_blog` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `url_facebook` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `url_instagram` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `url_linkedin` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `url_pinterest` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `url_twitter` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `url_youtube` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `u_domain_language_domain_id_language_id` (`domain_id`,`language_id`),
  KEY `fk_domain_language_language_id` (`language_id`),
  CONSTRAINT `fk_domain_language_domain_id` FOREIGN KEY (`domain_id`) REFERENCES `domains` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_domain_language_language_id` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Listage des données de la table laravel.domains_languages : ~3 rows (environ)
INSERT INTO `domains_languages` (`id`, `domain_id`, `language_id`, `active`, `order`, `url_redirect`, `url_blog`, `url_facebook`, `url_instagram`, `url_linkedin`, `url_pinterest`, `url_twitter`, `url_youtube`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, 'Y', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-07-09 13:59:46', '2023-07-09 13:59:46'),
	(2, 1, 2, 'Y', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-07-09 14:07:43', '2023-07-09 14:07:46'),
	(3, 2, 1, 'Y', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-07-09 14:07:54', '2023-07-09 14:07:56');

-- Listage de la structure de table laravel. emails
CREATE TABLE IF NOT EXISTS `emails` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `active` enum('Y','N') COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `module` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `from` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `reply_to` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `to` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `cc` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `bcc` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `delay` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Listage des données de la table laravel.emails : ~0 rows (environ)

-- Listage de la structure de table laravel. failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb3_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb3_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb3_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb3_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Listage des données de la table laravel.failed_jobs : ~0 rows (environ)

-- Listage de la structure de table laravel. formulaires
CREATE TABLE IF NOT EXISTS `formulaires` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `active` enum('Y','N') COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `code` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `tracking` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Listage des données de la table laravel.formulaires : ~0 rows (environ)

-- Listage de la structure de table laravel. formulaires_fields
CREATE TABLE IF NOT EXISTS `formulaires_fields` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `formulaire_id` int unsigned NOT NULL,
  `active` enum('Y','N') COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `order` int NOT NULL DEFAULT '1',
  `code` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_form_field_formulaire_id` (`formulaire_id`),
  CONSTRAINT `fk_form_field_formulaire_id` FOREIGN KEY (`formulaire_id`) REFERENCES `formulaires` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Listage des données de la table laravel.formulaires_fields : ~0 rows (environ)

-- Listage de la structure de table laravel. formulaires_fields_translations
CREATE TABLE IF NOT EXISTS `formulaires_fields_translations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `formulaire_field_id` int unsigned NOT NULL,
  `locale` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `label_admin` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `label_front` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `placeholder` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `date_format` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `help` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `error` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `error_min` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `error_max` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `error_extension` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `error_filesize` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `error_dimension` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `error_date_format` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `u_form_field_trans_formulaire_field_id_locale` (`formulaire_field_id`,`locale`),
  KEY `formulaires_fields_translations_locale_index` (`locale`),
  CONSTRAINT `fk_form_field_trans_formulaire_field_id` FOREIGN KEY (`formulaire_field_id`) REFERENCES `formulaires_fields` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Listage des données de la table laravel.formulaires_fields_translations : ~0 rows (environ)

-- Listage de la structure de table laravel. formulaires_fields_values
CREATE TABLE IF NOT EXISTS `formulaires_fields_values` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `formulaire_field_id` int unsigned NOT NULL,
  `active` enum('Y','N') COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `order` int NOT NULL DEFAULT '1',
  `code` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_form_field_value_formulaire_field_id` (`formulaire_field_id`),
  CONSTRAINT `fk_form_field_value_formulaire_field_id` FOREIGN KEY (`formulaire_field_id`) REFERENCES `formulaires_fields` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Listage des données de la table laravel.formulaires_fields_values : ~0 rows (environ)

-- Listage de la structure de table laravel. formulaires_fields_values_translations
CREATE TABLE IF NOT EXISTS `formulaires_fields_values_translations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `formulaire_field_value_id` int unsigned NOT NULL,
  `locale` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `u_form_field_value_trans_formulaire_field_value_id_locale` (`formulaire_field_value_id`,`locale`),
  KEY `formulaires_fields_values_translations_locale_index` (`locale`),
  CONSTRAINT `fk_form_field_value_trans_formulaire_field_value_id` FOREIGN KEY (`formulaire_field_value_id`) REFERENCES `formulaires_fields_values` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Listage des données de la table laravel.formulaires_fields_values_translations : ~0 rows (environ)

-- Listage de la structure de table laravel. formulaires_translations
CREATE TABLE IF NOT EXISTS `formulaires_translations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `formulaire_id` int unsigned NOT NULL,
  `locale` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `resume` text COLLATE utf8mb3_unicode_ci,
  PRIMARY KEY (`id`),
  UNIQUE KEY `u_form_trans_formulaire_id_locale` (`formulaire_id`,`locale`),
  KEY `formulaires_translations_locale_index` (`locale`),
  CONSTRAINT `fk_form_trans_formulaire_id` FOREIGN KEY (`formulaire_id`) REFERENCES `formulaires` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Listage des données de la table laravel.formulaires_translations : ~0 rows (environ)

-- Listage de la structure de table laravel. languages
CREATE TABLE IF NOT EXISTS `languages` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `active` enum('Y','N') COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `alpha2` varchar(2) COLLATE utf8mb3_unicode_ci NOT NULL,
  `alpha3` varchar(3) COLLATE utf8mb3_unicode_ci NOT NULL,
  `locale` varchar(10) COLLATE utf8mb3_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `flag` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `format_date_small` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `format_date_long` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `format_date_time` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Listage des données de la table laravel.languages : ~5 rows (environ)
INSERT INTO `languages` (`id`, `active`, `alpha2`, `alpha3`, `locale`, `name`, `flag`, `format_date_small`, `format_date_long`, `format_date_time`, `created_at`, `updated_at`) VALUES
	(1, 'Y', 'fr', 'fra', 'fr_FR', 'Français', '/images/flags/fr.svg', '%d/%m/%Y', '%d %B %Y', '%d/%m/%Y %H:%i:%s', '2023-07-09 13:59:45', '2023-07-09 13:59:45'),
	(2, 'Y', 'en', 'eng', 'en_US', 'English', '/images/flags/en.svg', '%m/%d/%Y', '%B %d %Y', '%m/%d/%Y %H:%i:%s', '2023-07-09 13:59:45', '2023-07-09 14:07:14'),
	(3, 'N', 'es', 'esp', 'es_ES', 'Español', '/images/flags/es.svg', '%d/%m/%Y', '%d %B %Y', '%d/%m/%Y %H:%i:%s', '2023-07-09 13:59:45', '2023-07-09 13:59:45'),
	(4, 'N', 'it', 'ita', 'it_IT', 'Italian', '/images/flags/it.svg', '%d/%m/%Y', '%d %B %Y', '%d/%m/%Y %H:%i:%s', '2023-07-09 13:59:45', '2023-07-09 13:59:45'),
	(5, 'N', 'de', 'deu', 'de_DE', 'Deutch', '/images/flags/de.svg', '%d/%m/%Y', '%d %B %Y', '%d/%m/%Y %H:%i:%s', '2023-07-09 13:59:45', '2023-07-09 13:59:45');

-- Listage de la structure de table laravel. ltm_translations
CREATE TABLE IF NOT EXISTS `ltm_translations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `status` int NOT NULL DEFAULT '0',
  `locale` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `group` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `key` text COLLATE utf8mb3_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb3_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Listage des données de la table laravel.ltm_translations : ~0 rows (environ)

-- Listage de la structure de table laravel. menuitems
CREATE TABLE IF NOT EXISTS `menuitems` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `menu_id` int unsigned NOT NULL,
  `active` enum('Y','N') COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `gabarit` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `bg` int unsigned NOT NULL DEFAULT '0',
  `bd` int unsigned NOT NULL DEFAULT '0',
  `niveau` int unsigned NOT NULL DEFAULT '1',
  `parent_id` int unsigned DEFAULT NULL,
  `visible` enum('Y','N') COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `cliquable` enum('Y','N') COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `format` enum('submenu','big_submenu') COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'submenu',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `menuitems_menu_id_foreign` (`menu_id`),
  KEY `menuitems_parent_id_foreign` (`parent_id`),
  CONSTRAINT `menuitems_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `menuitems_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `menuitems` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Listage des données de la table laravel.menuitems : ~3 rows (environ)
INSERT INTO `menuitems` (`id`, `menu_id`, `active`, `gabarit`, `bg`, `bd`, `niveau`, `parent_id`, `visible`, `cliquable`, `format`, `created_at`, `updated_at`) VALUES
	(1, 1, 'N', 'cmspages_index', 1, 4, 1, NULL, 'Y', 'Y', 'submenu', '2023-07-15 05:38:01', '2023-07-15 05:38:55'),
	(2, 1, 'N', 'cmspages_index', 5, 6, 1, NULL, 'Y', 'Y', 'submenu', '2023-07-15 05:38:15', '2023-07-15 05:38:55'),
	(3, 1, 'N', 'cmspages_index', 2, 3, 2, 1, 'Y', 'Y', 'submenu', '2023-07-15 05:38:31', '2023-07-15 05:38:55');

-- Listage de la structure de table laravel. menuitems_translations
CREATE TABLE IF NOT EXISTS `menuitems_translations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `menuitem_id` int unsigned NOT NULL,
  `locale` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `title_menu` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `title_page` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `target` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `menuitems_translations_menuitem_id_locale_unique` (`menuitem_id`,`locale`),
  KEY `menuitems_translations_locale_index` (`locale`),
  CONSTRAINT `menuitems_translations_menuitem_id_foreign` FOREIGN KEY (`menuitem_id`) REFERENCES `menuitems` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Listage des données de la table laravel.menuitems_translations : ~6 rows (environ)
INSERT INTO `menuitems_translations` (`id`, `menuitem_id`, `locale`, `title_menu`, `title_page`, `link`, `target`) VALUES
	(1, 1, 'fr', 'Menuitem 1', 'Menuitem 1', NULL, '_self'),
	(2, 1, 'en', 'Menuitem 1', 'Menuitem 1', NULL, '_self'),
	(3, 2, 'fr', 'Menuitem 2', 'Menuitem 2', NULL, '_self'),
	(4, 2, 'en', 'Menuitem 2', 'Menuitem 2', NULL, '_self'),
	(5, 3, 'fr', 'Sous menuitem 1.1', 'Sous menuitem 1.1', NULL, '_self'),
	(6, 3, 'en', 'Sub menuitem 1.1', 'Sub menuitem 1.1', NULL, '_self');

-- Listage de la structure de table laravel. menus
CREATE TABLE IF NOT EXISTS `menus` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `active` enum('Y','N') COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `code` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Listage des données de la table laravel.menus : ~0 rows (environ)
INSERT INTO `menus` (`id`, `active`, `code`, `created_at`, `updated_at`) VALUES
	(1, 'Y', 'main', '2023-07-09 13:59:48', '2023-07-09 13:59:48');

-- Listage de la structure de table laravel. menus_translations
CREATE TABLE IF NOT EXISTS `menus_translations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `menu_id` int unsigned NOT NULL,
  `locale` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `menus_translations_menu_id_locale_unique` (`menu_id`,`locale`),
  KEY `menus_translations_locale_index` (`locale`),
  CONSTRAINT `menus_translations_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Listage des données de la table laravel.menus_translations : ~2 rows (environ)
INSERT INTO `menus_translations` (`id`, `menu_id`, `locale`, `title`) VALUES
	(1, 1, 'en', 'Main menu'),
	(2, 1, 'fr', 'Menu principal');

-- Listage de la structure de table laravel. migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Listage des données de la table laravel.migrations : ~0 rows (environ)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_04_02_193005_create_translations_table', 1),
	(2, '2014_10_12_000000_create_users_table', 1),
	(3, '2014_10_12_100000_create_password_resets_table', 1),
	(4, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
	(5, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
	(6, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
	(7, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
	(8, '2016_06_01_000004_create_oauth_clients_table', 1),
	(9, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
	(10, '2018_08_02_173544_create_pages_table', 1),
	(11, '2018_08_12_182443_create_domains_table', 1),
	(12, '2018_08_12_182515_create_languages_table', 1),
	(13, '2018_09_09_085005_create_permission_tables', 1),
	(14, '2018_10_03_212343_create_formulaires_table', 1),
	(15, '2019_04_14_174320_create_emails_table', 1),
	(16, '2019_06_30_135843_create_menus_table', 1),
	(17, '2019_08_19_000000_create_failed_jobs_table', 1),
	(18, '2020_01_27_052021_create_permalinks_table', 1),
	(19, '2020_05_09_153204_rename_field_users_table', 1),
	(20, '2020_05_09_155329_update_users_table', 1),
	(21, '2020_05_10_102048_create_domains_languages_table', 1),
	(22, '2020_07_18_160614_add_users_avatar', 1),
	(23, '2023_04_10_084422_create_sessions_table', 1),
	(24, '2023_06_03_144735_create_model_has_domains_table', 1),
	(25, '2023_06_17_085218_add_users_lang', 1),
	(26, '2023_06_17_102111_add_languages_flag', 1),
	(27, '2019_12_14_000001_create_personal_access_tokens_table', 2);

-- Listage de la structure de table laravel. model_has_domains
CREATE TABLE IF NOT EXISTS `model_has_domains` (
  `domain_id` int unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`domain_id`,`model_id`,`model_type`),
  KEY `model_has_domains_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `fk_model_has_domains_domain_id` FOREIGN KEY (`domain_id`) REFERENCES `domains` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Listage des données de la table laravel.model_has_domains : ~3 rows (environ)
INSERT INTO `model_has_domains` (`domain_id`, `model_type`, `model_id`) VALUES
	(1, 'Modules\\Core\\Entities\\User', 1),
	(2, 'Modules\\Core\\Entities\\User', 1),
	(1, 'Modules\\Core\\Entities\\User', 2);

-- Listage de la structure de table laravel. model_has_permissions
CREATE TABLE IF NOT EXISTS `model_has_permissions` (
  `permission_id` int unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Listage des données de la table laravel.model_has_permissions : ~0 rows (environ)

-- Listage de la structure de table laravel. model_has_roles
CREATE TABLE IF NOT EXISTS `model_has_roles` (
  `role_id` int unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Listage des données de la table laravel.model_has_roles : ~2 rows (environ)
INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
	(1, 'Modules\\Core\\Entities\\User', 1),
	(2, 'Modules\\Core\\Entities\\User', 1);

-- Listage de la structure de table laravel. oauth_access_tokens
CREATE TABLE IF NOT EXISTS `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb3_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `client_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb3_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_access_tokens_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Listage des données de la table laravel.oauth_access_tokens : ~8 rows (environ)
INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
	('1f359d0d046d8edb43a7660a675ae545357d194ee61ecfe0f3bb7a883cc4a2571c886006169bad65', 1, 1, 'authToken', '[]', 0, '2023-10-07 19:13:03', '2023-10-07 19:13:03', '2024-10-07 21:13:03'),
	('2d7a06fe0e54b235edc1fc0efcc920e32f7d44cc0e12a5e5dca5a71b9f9d027f2fe22e2ab2428180', 1, 2, NULL, '[]', 0, '2023-10-07 19:15:43', '2023-10-07 19:15:43', '2024-10-07 21:15:43'),
	('342305d1da9b69023a520912dd9aa2c8aa799dd371dc88d619bbf18efa7cb1a7317166aab4966c43', 1, 1, 'authToken', '[]', 0, '2023-10-07 19:20:10', '2023-10-07 19:20:10', '2024-10-07 21:20:10'),
	('b75d2482f24bd6bbdaf2b5e111c90836f04010b378bd463ef306a4d14acb929a3e7ec189c8d8902f', 1, 2, NULL, '[]', 0, '2023-10-07 08:01:53', '2023-10-07 08:01:53', '2024-10-07 10:01:53'),
	('b86df10c701fb521e0aec65805c7e6a4cb4bea6576682c98b0f3ab6e8b4debd622e906a6a4c60304', 1, 1, 'authToken', '[]', 0, '2023-10-07 19:17:55', '2023-10-07 19:17:55', '2024-10-07 21:17:55'),
	('cbf867089f9ffcc17c61b28b23e0d6534e98bcbf1e776fcfc4ebf7e035a7012da42d888827160ddf', 1, 1, 'authToken', '[]', 0, '2023-10-07 08:00:58', '2023-10-07 08:00:58', '2024-10-07 10:00:58'),
	('d069b7dce2ec5ae24826b8ff7dde36b73ddd398a7bdd3eb814b5cac4f8b5a3187718048a6c987099', 1, 1, 'authToken', '[]', 0, '2023-10-07 19:16:14', '2023-10-07 19:16:14', '2024-10-07 21:16:14'),
	('f1bb9a6d27177f2cf571de38eab018df8d26b7941f2189e5ce3723ac1c9d6f80e7168581efc7535d', 1, 2, NULL, '[]', 0, '2023-10-07 08:36:09', '2023-10-07 08:36:09', '2024-10-07 10:36:09'),
	('fd9cc7428b432bde68b1c197d78a96d6c8802af962da6c284b8b97229676b3f302b8ef9fd747c676', 1, 1, 'authToken', '[]', 0, '2023-10-07 08:37:12', '2023-10-07 08:37:12', '2024-10-07 10:37:12');

-- Listage de la structure de table laravel. oauth_auth_codes
CREATE TABLE IF NOT EXISTS `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb3_unicode_ci NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `client_id` bigint unsigned NOT NULL,
  `scopes` text COLLATE utf8mb3_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_auth_codes_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Listage des données de la table laravel.oauth_auth_codes : ~0 rows (environ)

-- Listage de la structure de table laravel. oauth_clients
CREATE TABLE IF NOT EXISTS `oauth_clients` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `redirect` text COLLATE utf8mb3_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_clients_user_id_index` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Listage des données de la table laravel.oauth_clients : ~2 rows (environ)
INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `provider`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
	(1, NULL, 'Laravel Personal Access Client', 'TnFuE9QnYCVXLzANoZp55uuReccMkwsd9JG7U19d', NULL, 'http://localhost', 1, 0, 0, '2023-10-07 07:58:12', '2023-10-07 07:58:12'),
	(2, NULL, 'Laravel Password Grant Client', 'lPT8wPVxceWzKkKcxBy3tAO4opbvhpbSXCJ26dGR', 'users', 'http://localhost', 0, 1, 0, '2023-10-07 07:58:12', '2023-10-07 07:58:12');

-- Listage de la structure de table laravel. oauth_personal_access_clients
CREATE TABLE IF NOT EXISTS `oauth_personal_access_clients` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `client_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Listage des données de la table laravel.oauth_personal_access_clients : ~0 rows (environ)
INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
	(1, 1, '2023-10-07 07:58:12', '2023-10-07 07:58:12');

-- Listage de la structure de table laravel. oauth_refresh_tokens
CREATE TABLE IF NOT EXISTS `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb3_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb3_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Listage des données de la table laravel.oauth_refresh_tokens : ~2 rows (environ)
INSERT INTO `oauth_refresh_tokens` (`id`, `access_token_id`, `revoked`, `expires_at`) VALUES
	('0b949089522c95ce038533cb2e97c37cf34e7364a641ddff5660bb8f079a8a7af842cffb1d0d4dd5', 'f1bb9a6d27177f2cf571de38eab018df8d26b7941f2189e5ce3723ac1c9d6f80e7168581efc7535d', 0, '2024-10-07 10:36:09'),
	('3df294d440d941236e8e068356fff19e194f35aa5f5605ee309baebe8edd7d82d11a99c4eecae32e', '2d7a06fe0e54b235edc1fc0efcc920e32f7d44cc0e12a5e5dca5a71b9f9d027f2fe22e2ab2428180', 0, '2024-10-07 21:15:43'),
	('88f12d8c4472c2174d4207fa4c66e1abe7c56bdbef31915a050c7d79147a4a1b1495431bb358cacc', 'b75d2482f24bd6bbdaf2b5e111c90836f04010b378bd463ef306a4d14acb929a3e7ec189c8d8902f', 0, '2024-10-07 10:01:53');

-- Listage de la structure de table laravel. pages
CREATE TABLE IF NOT EXISTS `pages` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `active` enum('Y','N') COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Listage des données de la table laravel.pages : ~0 rows (environ)
INSERT INTO `pages` (`id`, `active`, `created_at`, `updated_at`) VALUES
	(1, 'N', '2023-07-29 12:47:37', '2023-07-29 12:47:37');

-- Listage de la structure de table laravel. pages_translations
CREATE TABLE IF NOT EXISTS `pages_translations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `page_id` int unsigned NOT NULL,
  `locale` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pages_translations_page_id_locale_unique` (`page_id`,`locale`),
  KEY `pages_translations_locale_index` (`locale`),
  CONSTRAINT `pages_translations_page_id_foreign` FOREIGN KEY (`page_id`) REFERENCES `pages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Listage des données de la table laravel.pages_translations : ~2 rows (environ)
INSERT INTO `pages_translations` (`id`, `page_id`, `locale`, `title`, `content`) VALUES
	(1, 1, 'fr', 'test FR', '<style>* { box-sizing: border-box; } body {margin: 0;}</style>'),
	(2, 1, 'en', 'test EN', '<style>* { box-sizing: border-box; } body {margin: 0;}</style>');

-- Listage de la structure de table laravel. password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Listage des données de la table laravel.password_resets : ~0 rows (environ)

-- Listage de la structure de table laravel. permalinks
CREATE TABLE IF NOT EXISTS `permalinks` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `active` enum('Y','N') COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `entity_type` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `entity_id` int unsigned DEFAULT NULL,
  `redirect` int unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `permalinks_redirect_foreign` (`redirect`),
  CONSTRAINT `permalinks_redirect_foreign` FOREIGN KEY (`redirect`) REFERENCES `permalinks` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Listage des données de la table laravel.permalinks : ~8 rows (environ)
INSERT INTO `permalinks` (`id`, `active`, `entity_type`, `entity_id`, `redirect`, `created_at`, `updated_at`) VALUES
	(1, 'N', 'Modules\\Menu\\Entities\\Menuitem', 1, NULL, '2023-07-14 20:40:53', '2023-07-14 20:40:53'),
	(2, 'N', 'Modules\\Menu\\Entities\\Menuitem', 2, NULL, '2023-07-14 20:41:34', '2023-07-14 20:41:34'),
	(3, 'N', 'Modules\\Menu\\Entities\\Menuitem', 1, NULL, '2023-07-14 20:44:54', '2023-07-14 20:44:54'),
	(4, 'N', 'Modules\\Menu\\Entities\\Menuitem', 2, NULL, '2023-07-14 20:51:04', '2023-07-14 20:51:04'),
	(5, 'N', 'Modules\\Menu\\Entities\\Menuitem', 1, NULL, '2023-07-15 05:26:48', '2023-07-15 05:26:48'),
	(6, 'N', 'Modules\\Menu\\Entities\\Menuitem', 2, NULL, '2023-07-15 05:27:16', '2023-07-15 05:27:16'),
	(7, 'N', 'Modules\\Menu\\Entities\\Menuitem', 1, NULL, '2023-07-15 05:38:01', '2023-07-15 05:38:01'),
	(8, 'N', 'Modules\\Menu\\Entities\\Menuitem', 2, NULL, '2023-07-15 05:38:15', '2023-07-15 05:38:15'),
	(9, 'N', 'Modules\\Menu\\Entities\\Menuitem', 3, NULL, '2023-07-15 05:38:31', '2023-07-15 05:38:31');

-- Listage de la structure de table laravel. permalinks_translations
CREATE TABLE IF NOT EXISTS `permalinks_translations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `permalink_id` int unsigned NOT NULL,
  `locale` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `full_path` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permalinks_translations_permalink_id_locale_unique` (`permalink_id`,`locale`),
  KEY `permalinks_translations_locale_index` (`locale`),
  CONSTRAINT `permalinks_translations_permalink_id_foreign` FOREIGN KEY (`permalink_id`) REFERENCES `permalinks` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Listage des données de la table laravel.permalinks_translations : ~8 rows (environ)
INSERT INTO `permalinks_translations` (`id`, `permalink_id`, `locale`, `slug`, `full_path`) VALUES
	(1, 5, 'fr', 'menuitem-1', 'menuitem-1'),
	(2, 5, 'en', 'menuitem-1', 'menuitem-1'),
	(3, 7, 'fr', 'menuitem-1', 'menuitem-1'),
	(4, 7, 'en', 'menuitem-1', 'menuitem-1'),
	(5, 8, 'fr', 'menuitem-2', 'menuitem-2'),
	(6, 8, 'en', 'menuitem-2', 'menuitem-2'),
	(7, 9, 'fr', 'sous-menuitem-11', 'sous-menuitem-11'),
	(8, 9, 'en', 'sub-menuitem-11', 'sub-menuitem-11');

-- Listage de la structure de table laravel. permissions
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Listage des données de la table laravel.permissions : ~20 rows (environ)
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
	(1, 'User_read', 'admin', '2023-07-09 13:59:46', '2023-07-09 13:59:46'),
	(2, 'User_edit', 'admin', '2023-07-09 13:59:46', '2023-07-09 13:59:46'),
	(3, 'User_create', 'admin', '2023-07-09 13:59:46', '2023-07-09 13:59:46'),
	(4, 'User_delete', 'admin', '2023-07-09 13:59:46', '2023-07-09 13:59:46'),
	(5, 'Role_read', 'admin', '2023-07-09 13:59:46', '2023-07-09 13:59:46'),
	(6, 'Role_edit', 'admin', '2023-07-09 13:59:46', '2023-07-09 13:59:46'),
	(7, 'Role_create', 'admin', '2023-07-09 13:59:46', '2023-07-09 13:59:46'),
	(8, 'Role_delete', 'admin', '2023-07-09 13:59:46', '2023-07-09 13:59:46'),
	(9, 'Permission_read', 'admin', '2023-07-09 13:59:46', '2023-07-09 13:59:46'),
	(10, 'Permission_edit', 'admin', '2023-07-09 13:59:46', '2023-07-09 13:59:46'),
	(11, 'Permission_create', 'admin', '2023-07-09 13:59:46', '2023-07-09 13:59:46'),
	(12, 'Permission_delete', 'admin', '2023-07-09 13:59:46', '2023-07-09 13:59:46'),
	(13, 'Domain_read', 'admin', '2023-07-09 13:59:46', '2023-07-09 13:59:46'),
	(14, 'Domain_edit', 'admin', '2023-07-09 13:59:46', '2023-07-09 13:59:46'),
	(15, 'Domain_create', 'admin', '2023-07-09 13:59:46', '2023-07-09 13:59:46'),
	(16, 'Domain_delete', 'admin', '2023-07-09 13:59:46', '2023-07-09 13:59:46'),
	(17, 'Language_read', 'admin', '2023-07-09 13:59:46', '2023-07-09 13:59:46'),
	(18, 'Language_edit', 'admin', '2023-07-09 13:59:46', '2023-07-09 13:59:46'),
	(19, 'Language_create', 'admin', '2023-07-09 13:59:46', '2023-07-09 13:59:46'),
	(20, 'Language_delete', 'admin', '2023-07-09 13:59:47', '2023-07-09 13:59:47');

-- Listage de la structure de table laravel. roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Listage des données de la table laravel.roles : ~2 rows (environ)
INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
	(1, 'Superviseur', 'admin', '2023-07-09 13:59:47', '2023-07-09 13:59:47'),
	(2, 'Client', 'web', '2023-07-09 13:59:47', '2023-07-09 13:59:47');

-- Listage de la structure de table laravel. role_has_permissions
CREATE TABLE IF NOT EXISTS `role_has_permissions` (
  `permission_id` int unsigned NOT NULL,
  `role_id` int unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Listage des données de la table laravel.role_has_permissions : ~20 rows (environ)
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
	(1, 1),
	(2, 1),
	(3, 1),
	(4, 1),
	(5, 1),
	(6, 1),
	(7, 1),
	(8, 1),
	(9, 1),
	(10, 1),
	(11, 1),
	(12, 1),
	(13, 1),
	(14, 1),
	(15, 1),
	(16, 1),
	(17, 1),
	(18, 1),
	(19, 1),
	(20, 1);

-- Listage de la structure de table laravel. sessions
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb3_unicode_ci,
  `payload` longtext COLLATE utf8mb3_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Listage des données de la table laravel.sessions : ~6 rows (environ)
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
	('1CwuxyISIIBXOS5MoikqWg9D7FbvIZBPVlgszcoo', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/117.0.0.0 Safari/537.36', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiS2J0dU1kYmJrWDdzR0hUcExiOFhBc0xqWWNFaHQ1MUtyWFRRb0lIUCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1696733763),
	('2LlD6aA1Bdtqp9C9k2WStJImb2Ldc8xKaERUaMfE', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/117.0.0.0 Safari/537.36', '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ZGQ0OVdqbUt2Wm5nMEFHZnRGWUciO3M6NjoiYXZhdGFyIjtOO3M6MTc6InR3b19mYWN0b3Jfc2VjcmV0IjtOO3M6MjU6InR3b19mYWN0b3JfcmVjb3ZlcnlfY29kZXMiO047czoyMzoidHdvX2ZhY3Rvcl9jb25maXJtZWRfYXQiO047czoxNDoicmVtZW1iZXJfdG9rZW4iO047czoxNToiY3VycmVudF90ZWFtX2lkIjtOO3M6MTg6InByb2ZpbGVfcGhvdG9fcGF0aCI7TjtzOjEwOiJjcmVhdGVkX2F0IjtzOjE5OiIyMDIzLTA3LTA5IDE1OjU5OjQ3IjtzOjEwOiJ1cGRhdGVkX2F0IjtzOjE5OiIyMDIzLTEwLTA3IDIxOjUzOjM4IjtzOjEzOiJsYXN0X2xvZ2luX2F0IjtOO3M6MTM6Imxhc3RfbG9naW5faXAiO047fXM6MTE6IgAqAG9yaWdpbmFsIjthOjE5OntzOjI6ImlkIjtpOjE7czo2OiJhY3RpdmUiO3M6MToiWSI7czo0OiJsYW5nIjtzOjI6ImZyIjtzOjk6ImZpcnN0bmFtZSI7czo2OiJEaWRpZXIiO3M6ODoibGFzdG5hbWUiO3M6ODoiTGFyZ2Vyb24iO3M6NToiZW1haWwiO3M6MjU6Imxhcmdlcm9uLmRpZGllckBnbWFpbC5jb20iO3M6MTc6ImVtYWlsX3ZlcmlmaWVkX2F0IjtOO3M6ODoicGFzc3dvcmQiO3M6NjA6IiQyeSQxMCRMMW9EVXk0bUlOLk5mR2MzNjdFQnQuREdKSGJhM3RwRzJkZDQ5V2ptS3ZabmcwQUdmdEZZRyI7czo2OiJhdmF0YXIiO047czoxNzoidHdvX2ZhY3Rvcl9zZWNyZXQiO047czoyNToidHdvX2ZhY3Rvcl9yZWNvdmVyeV9jb2RlcyI7TjtzOjIzOiJ0d29fZmFjdG9yX2NvbmZpcm1lZF9hdCI7TjtzOjE0OiJyZW1lbWJlcl90b2tlbiI7TjtzOjE1OiJjdXJyZW50X3RlYW1faWQiO047czoxODoicHJvZmlsZV9waG90b19wYXRoIjtOO3M6MTA6ImNyZWF0ZWRfYXQiO3M6MTk6IjIwMjMtMDctMDkgMTU6NTk6NDciO3M6MTA6InVwZGF0ZWRfYXQiO3M6MTk6IjIwMjMt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Y3JlbWVudGluZyI7YjoxO3M6NzoiACoAd2l0aCI7YTowOnt9czoxMjoiACoAd2l0aENvdW50IjthOjA6e31zOjE5OiJwcmV2ZW50c0xhenlMb2FkaW5nIjtiOjA7czoxMDoiACoAcGVyUGFnZSI7aToxNTtzOjY6ImV4aXN0cyI7YjoxO3M6MTg6Indhc1JlY2VudGx5Q3JlYXRlZCI7YjowO3M6Mjg6IgAqAGVzY2FwZVdoZW5DYXN0aW5nVG9TdHJpbmciO2I6MDtzOjEzOiIAKgBhdHRyaWJ1dGVzIjthOjEyOntzOjI6ImlkIjtpOjE7czo2OiJhY3RpdmUiO3M6MToiWSI7czo2OiJhbHBoYTIiO3M6MjoiZnIiO3M6NjoiYWxwaGEzIjtzOjM6ImZyYSI7czo2OiJsb2NhbGUiO3M6NToiZnJfRlIiO3M6NDoibmFtZSI7czo5OiJGcmFuw6dhaXMiO3M6NDoiZmxhZyI7czoyMDoiL2ltYWdlcy9mbGFncy9mci5zdmciO3M6MTc6ImZvcm1hdF9kYXRlX3NtYWxsIjtzOjg6IiVkLyVtLyVZIjtzOjE2OiJmb3JtYXRfZGF0ZV9sb25nIjtzOjg6IiVkICVCICVZIjtzOjE2OiJmb3JtYXRfZGF0ZV90aW1lIjtzOjE3OiIlZC8lbS8lWSAlSDolaTolcyI7czoxMDoiY3JlYXRlZF9hdCI7czoxOToiMjAyMy0wNy0wOSAxNTo1OTo0NSI7czoxMDoidXBkYXRlZF9hdCI7czoxOToiMjAyMy0wNy0wOSAxNTo1OTo0NSI7fXM6MTE6IgAqAG9yaWdpbmFsIjthOjEyOntzOjI6ImlkIjtpOjE7czo2OiJhY3RpdmUiO3M6MToiWSI7czo2OiJhbHBoYTIiO3M6MjoiZnIiO3M6NjoiYWxwaGEzIjtzOjM6ImZyYSI7czo2OiJsb2NhbGUiO3M6NToiZnJfRlIiO3M6NDoibmFtZSI7czo5OiJGcmFuw6dhaXMiO3M6NDoiZmxhZyI7czoyMDoiL2ltYWdlcy9mbGFncy9mci5zdmciO3M6MTc6ImZvcm1hdF9kYXRlX3NtYWxsIjtzOjg6IiVkLyVtLyVZIjtzOjE2OiJmb3JtYXRfZGF0ZV9sb25nIjtzOjg6IiVkICVCICVZIjtzOjE2OiJmb3JtYXRfZGF0ZV90aW1lIjtzOjE3OiIlZC8lbS8lWSAlSDolaTolcyI7czoxMDoiY3JlYXRlZF9hdCI7czoxOToiMjAyMy0wNy0wOSAxNTo1OTo0NSI7czoxMDoidXBkYXRlZF9hdCI7czoxOToiMjAyMy0wNy0wOSAxNTo1OTo0NSI7fXM6MTA6IgAqAGNoYW5nZXMiO2E6MDp7fXM6ODoiACoAY2FzdHMiO2E6MDp7fXM6MTc6IgAqAGNsYXNzQ2FzdENhY2hlIjthOjA6e31zOjIxOiIAKgBhdHRyaWJ1dGVDYXN0Q2FjaGUiO2E6MDp7fXM6MTM6IgAqAGRhdGVGb3JtYXQiO047czoxMDoiACoAYXBwZW5kcyI7YTozOntpOjA7czozOiJ1cmwiO2k6MTtzOjExOiJ1cmxfYmFja2VuZCI7aToyO3M6NzoidXJsX2FwaSI7fXM6MTk6IgAqAGRpc3BhdGNoZXNFdmVudHMiO2E6MDp7fXM6MTQ6IgAqAG9ic2VydmFibGVzIjthOjA6e31zOjEyOiIAKgByZWxhdGlvbnMiO2E6MDp7fXM6MTA6IgAqAHRvdWNoZXMiO2E6MDp7fXM6MTA6InRpbWVzdGFtcHMiO2I6MTtzOjEzOiJ1c2VzVW5pcXVlSWRzIjtiOjA7czo5OiIAKgBoaWRkZW4iO2E6MDp7fXM6MTA6IgAqAHZpc2libGUiO2E6MDp7fXM6MTE6IgAqAGZpbGxhYmxlIjthOjA6e31zOjEwOiIAKgBndWFyZGVkIjthOjA6e319aToxO086MzA6Ik1vZHVsZXNcQ29yZVxFbnRpdGllc1xMYW5ndWFnZSI6MzA6e3M6MTM6IgAqAGNvbm5lY3Rpb24iO3M6NToibXlzcWwiO3M6ODoiACoAdGFibGUiO3M6OToibGFuZ3VhZ2VzIjtzOjEzOiIAKgBwcmltYXJ5S2V5IjtzOjI6ImlkIjtzOjEwOiIAKgBrZXlUeXBlIjtzOjM6ImludCI7czoxMjoiaW5jcmVtZW50aW5nIjtiOjE7czo3OiIAKgB3aXRoIjthOjA6e31zOjEyOiIAKgB3aXRoQ291bnQiO2E6MDp7fXM6MTk6InByZXZlbnRzTGF6eUxvYWRpbmciO2I6MDtzOjEwOiIAKgBwZXJQYWdlIjtpOjE1O3M6NjoiZXhpc3RzIjtiOjE7czoxODoid2FzUmVjZW50bHlDcmVhdGVkIjtiOjA7czoyODoiACoAZXNjYXBlV2hlbkNhc3RpbmdUb1N0cmluZyI7YjowO3M6MTM6IgAqAGF0dHJpYnV0ZXMiO2E6MTI6e3M6MjoiaWQiO2k6MjtzOjY6ImFjdGl2ZSI7czoxOiJZIjtzOjY6ImFscGhhMiI7czoyOiJlbiI7czo2OiJhbHBoYTMiO3M6MzoiZW5nIjtzOjY6ImxvY2FsZSI7czo1OiJlbl9VUyI7czo0OiJuYW1lIjtzOjc6IkVuZ2xpc2giO3M6NDoiZmxhZyI7czoyMDoiL2ltYWdlcy9mbGFncy9lbi5zdmciO3M6MTc6ImZvcm1hdF9kYXRlX3NtYWxsIjtzOjg6IiVtLyVkLyVZIjtzOjE2OiJmb3JtYXRfZGF0ZV9sb25nIjtzOjg6IiVCICVkICVZIjtzOjE2OiJmb3JtYXRfZGF0ZV90aW1lIjtzOjE3OiIlbS8lZC8lWSAlSDolaTolcyI7czoxMDoiY3JlYXRlZF9hdCI7czoxOToiMjAyMy0wNy0wOSAxNTo1OTo0NSI7czoxMDoidXBkYXRlZF9hdCI7czoxOToiMjAyMy0wNy0wOSAxNjowNzoxNCI7fXM6MTE6IgAqAG9yaWdpbmFsIjthOjEyOntzOjI6ImlkIjtpOjI7czo2OiJhY3RpdmUiO3M6MToiWSI7czo2OiJhbHBoYTIiO3M6MjoiZW4iO3M6NjoiYWxwaGEzIjtzOjM6ImVuZyI7czo2OiJsb2NhbGUiO3M6NToiZW5fVVMiO3M6NDoibmFtZSI7czo3OiJFbmdsaXNoIjtzOjQ6ImZsYWciO3M6MjA6Ii9pbWFnZXMvZmxhZ3MvZW4uc3ZnIjtzOjE3OiJmb3JtYXRfZGF0ZV9zbWFsbCI7czo4OiIlbS8lZC8lWSI7czoxNjoiZm9ybWF0X2RhdGVfbG9uZyI7czo4OiIlQiAlZCAlWSI7czoxNjoiZm9ybWF0X2RhdGVfdGltZSI7czoxNzoiJW0vJWQvJVkgJUg6JWk6JXMiO3M6MTA6ImNyZWF0ZWRfYXQiO3M6MTk6IjIwMjMtMDctMDkgMTU6NTk6NDUiO3M6MTA6InVwZGF0ZWRfYXQiO3M6MTk6IjIwMjMtMDctMDkgMTY6MDc6MTQiO31zOjEwOiIAKgBjaGFuZ2VzIjthOjA6e31zOjg6IgAqAGNhc3RzIjthOjA6e31zOjE3OiIAKgBjbGFzc0Nhc3RDYWNoZSI7YTowOnt9czoyMToiACoAYXR0cmlidXRlQ2FzdENhY2hlIjthOjA6e31zOjEzOiIAKgBkYXRlRm9ybWF0IjtOO3M6MTA6IgAqAGFwcGVuZHMiO2E6Mzp7aTowO3M6MzoidXJsIjtpOjE7czoxMToidXJsX2JhY2tlbmQiO2k6MjtzOjc6InVybF9hcGkiO31zOjE5OiIAKgBkaXNwYXRjaGVzRXZlbnRzIjthOjA6e31zOjE0OiIAKgBvYnNlcnZhYmxlcyI7YTowOnt9czoxMjoiACoAcmVsYXRpb25zIjthOjA6e31zOjEwOiIAKgB0b3VjaGVzIjthOjA6e31zOjEwOiJ0aW1lc3RhbXBzIjtiOjE7czoxMzoidXNlc1VuaXF1ZUlkcyI7YjowO3M6OToiACoAaGlkZGVuIjthOjA6e31zOjEwOiIAKgB2aXNpYmxlIjthOjA6e31zOjExOiIAKgBmaWxsYWJsZSI7YTowOnt9czoxMDoiACoAZ3VhcmRlZCI7YTowOnt9fX1zOjI4OiIAKgBlc2NhcGVXaGVuQ2FzdGluZ1RvU3RyaW5nIjtiOjA7fX0=', 1696717454),
	('BJyTIJhECtWiXMZxH88dERkqLMYD3N7xkJXkG0rL', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/117.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiS1pOb3NvU2VCNGQ3RmxseGo3ZXZNRlY5cUFxSXg0TmN6M09HSW5jSSI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozNDoiaHR0cHM6Ly9sYXJhdmVsLnRlc3QvYWRtaW4vZG9tYWlucyI7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjMyOiJodHRwczovL2xhcmF2ZWwudGVzdC9hZG1pbi9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1696759287),
	('lfs6bMycmkrMmpDGeAOr1znt4ZvARnBdWoVJw3tw', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/117.0.0.0 Safari/537.36', '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Wm5nMEFHZnRGWUciO3M6NjoiYXZhdGFyIjtOO3M6MTc6InR3b19mYWN0b3Jfc2VjcmV0IjtOO3M6MjU6InR3b19mYWN0b3JfcmVjb3ZlcnlfY29kZXMiO047czoyMzoidHdvX2ZhY3Rvcl9jb25maXJtZWRfYXQiO047czoxNDoicmVtZW1iZXJfdG9rZW4iO047czoxNToiY3VycmVudF90ZWFtX2lkIjtOO3M6MTg6InByb2ZpbGVfcGhvdG9fcGF0aCI7TjtzOjEwOiJjcmVhdGVkX2F0IjtzOjE5OiIyMDIzLTA3LTA5IDE1OjU5OjQ3IjtzOjEwOiJ1cGRhdGVkX2F0IjtzOjE5OiIyMDIzLTA3LTI5IDE0OjU2OjA5IjtzOjEzOiJsYXN0X2xvZ2luX2F0IjtOO3M6MTM6Imxhc3RfbG9naW5faXAiO047fXM6MTE6IgAqAG9yaWdpbmFsIjthOjE5OntzOjI6ImlkIjtpOjE7czo2OiJhY3RpdmUiO3M6MToiWSI7czo0OiJsYW5nIjtzOjI6ImZyIjtzOjk6ImZpcnN0bmFtZSI7czo2OiJEaWRpZXIiO3M6ODoibGFzdG5hbWUiO3M6ODoiTGFyZ2Vyb24iO3M6NToiZW1haWwiO3M6MjQ6ImQubGFyZ2Vyb25AaWRlYWwtY29tLmNvbSI7czoxNzoiZW1haWxfdmVyaWZpZWRfYXQiO047czo4OiJwYXNzd29yZCI7czo2MDoiJDJ5JDEwJEwxb0RVeTRtSU4uTmZHYzM2N0VCdC5ER0pIYmEzdHBHMmRkNDlXam1LdlpuZzBBR2Z0RllHIjtzOjY6ImF2YXRhciI7TjtzOjE3OiJ0d29fZmFjdG9yX3NlY3JldCI7TjtzOjI1OiJ0d29fZmFjdG9yX3JlY292ZXJ5X2NvZGVzIjtOO3M6MjM6InR3b19mYWN0b3JfY29uZmlybWVkX2F0IjtOO3M6MTQ6InJlbWVtYmVyX3Rva2VuIjtOO3M6MTU6ImN1cnJlbnRfdGVhbV9pZCI7TjtzOjE4OiJwcm9maWxlX3Bob3RvX3BhdGgiO047czoxMDoiY3JlYXRlZF9hdCI7czoxOToiMjAyMy0wNy0wOSAxNTo1OTo0NyI7czoxMDoidXBkYXRlZF9hdCI7czoxOToiMjAyMy0wNy0yOSAxNDo1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IjtiOjE7czo3OiIAKgB3aXRoIjthOjA6e31zOjEyOiIAKgB3aXRoQ291bnQiO2E6MDp7fXM6MTk6InByZXZlbnRzTGF6eUxvYWRpbmciO2I6MDtzOjEwOiIAKgBwZXJQYWdlIjtpOjE1O3M6NjoiZXhpc3RzIjtiOjE7czoxODoid2FzUmVjZW50bHlDcmVhdGVkIjtiOjA7czoyODoiACoAZXNjYXBlV2hlbkNhc3RpbmdUb1N0cmluZyI7YjowO3M6MTM6IgAqAGF0dHJpYnV0ZXMiO2E6MTI6e3M6MjoiaWQiO2k6MTtzOjY6ImFjdGl2ZSI7czoxOiJZIjtzOjY6ImFscGhhMiI7czoyOiJmciI7czo2OiJhbHBoYTMiO3M6MzoiZnJhIjtzOjY6ImxvY2FsZSI7czo1OiJmcl9GUiI7czo0OiJuYW1lIjtzOjk6IkZyYW7Dp2FpcyI7czo0OiJmbGFnIjtzOjIwOiIvaW1hZ2VzL2ZsYWdzL2ZyLnN2ZyI7czoxNzoiZm9ybWF0X2RhdGVfc21hbGwiO3M6ODoiJWQvJW0vJVkiO3M6MTY6ImZvcm1hdF9kYXRlX2xvbmciO3M6ODoiJWQgJUIgJVkiO3M6MTY6ImZvcm1hdF9kYXRlX3RpbWUiO3M6MTc6IiVkLyVtLyVZICVIOiVpOiVzIjtzOjEwOiJjcmVhdGVkX2F0IjtzOjE5OiIyMDIzLTA3LTA5IDE1OjU5OjQ1IjtzOjEwOiJ1cGRhdGVkX2F0IjtzOjE5OiIyMDIzLTA3LTA5IDE1OjU5OjQ1Ijt9czoxMToiACoAb3JpZ2luYWwiO2E6MTI6e3M6MjoiaWQiO2k6MTtzOjY6ImFjdGl2ZSI7czoxOiJZIjtzOjY6ImFscGhhMiI7czoyOiJmciI7czo2OiJhbHBoYTMiO3M6MzoiZnJhIjtzOjY6ImxvY2FsZSI7czo1OiJmcl9GUiI7czo0OiJuYW1lIjtzOjk6IkZyYW7Dp2FpcyI7czo0OiJmbGFnIjtzOjIwOiIvaW1hZ2VzL2ZsYWdzL2ZyLnN2ZyI7czoxNzoiZm9ybWF0X2RhdGVfc21hbGwiO3M6ODoiJWQvJW0vJVkiO3M6MTY6ImZvcm1hdF9kYXRlX2xvbmciO3M6ODoiJWQgJUIgJVkiO3M6MTY6ImZvcm1hdF9kYXRlX3RpbWUiO3M6MTc6IiVkLyVtLyVZICVIOiVpOiVzIjtzOjEwOiJjcmVhdGVkX2F0IjtzOjE5OiIyMDIzLTA3LTA5IDE1OjU5OjQ1IjtzOjEwOiJ1cGRhdGVkX2F0IjtzOjE5OiIyMDIzLTA3LTA5IDE1OjU5OjQ1Ijt9czoxMDoiACoAY2hhbmdlcyI7YTowOnt9czo4OiIAKgBjYXN0cyI7YTowOnt9czoxNzoiACoAY2xhc3NDYXN0Q2FjaGUiO2E6MDp7fXM6MjE6IgAqAGF0dHJpYnV0ZUNhc3RDYWNoZSI7YTowOnt9czoxMzoiACoAZGF0ZUZvcm1hdCI7TjtzOjEwOiIAKgBhcHBlbmRzIjthOjM6e2k6MDtzOjM6InVybCI7aToxO3M6MTE6InVybF9iYWNrZW5kIjtpOjI7czo3OiJ1cmxfYXBpIjt9czoxOToiACoAZGlzcGF0Y2hlc0V2ZW50cyI7YTowOnt9czoxNDoiACoAb2JzZXJ2YWJsZXMiO2E6MDp7fXM6MTI6IgAqAHJlbGF0aW9ucyI7YTowOnt9czoxMDoiACoAdG91Y2hlcyI7YTowOnt9czoxMDoidGltZXN0YW1wcyI7YjoxO3M6MTM6InVzZXNVbmlxdWVJZHMiO2I6MDtzOjk6IgAqAGhpZGRlbiI7YTowOnt9czoxMDoiACoAdmlzaWJsZSI7YTowOnt9czoxMToiACoAZmlsbGFibGUiO2E6MDp7fXM6MTA6IgAqAGd1YXJkZWQiO2E6MDp7fX1pOjE7TzozMDoiTW9kdWxlc1xDb3JlXEVudGl0aWVzXExhbmd1YWdlIjozMDp7czoxMzoiACoAY29ubmVjdGlvbiI7czo1OiJteXNxbCI7czo4OiIAKgB0YWJsZSI7czo5OiJsYW5ndWFnZXMiO3M6MTM6IgAqAHByaW1hcnlLZXkiO3M6MjoiaWQiO3M6MTA6IgAqAGtleVR5cGUiO3M6MzoiaW50IjtzOjEyOiJpbmNyZW1lbnRpbmciO2I6MTtzOjc6IgAqAHdpdGgiO2E6MDp7fXM6MTI6IgAqAHdpdGhDb3VudCI7YTowOnt9czoxOToicHJldmVudHNMYXp5TG9hZGluZyI7YjowO3M6MTA6IgAqAHBlclBhZ2UiO2k6MTU7czo2OiJleGlzdHMiO2I6MTtzOjE4OiJ3YXNSZWNlbnRseUNyZWF0ZWQiO2I6MDtzOjI4OiIAKgBlc2NhcGVXaGVuQ2FzdGluZ1RvU3RyaW5nIjtiOjA7czoxMzoiACoAYXR0cmlidXRlcyI7YToxMjp7czoyOiJpZCI7aToyO3M6NjoiYWN0aXZlIjtzOjE6IlkiO3M6NjoiYWxwaGEyIjtzOjI6ImVuIjtzOjY6ImFscGhhMyI7czozOiJlbmciO3M6NjoibG9jYWxlIjtzOjU6ImVuX1VTIjtzOjQ6Im5hbWUiO3M6NzoiRW5nbGlzaCI7czo0OiJmbGFnIjtzOjIwOiIvaW1hZ2VzL2ZsYWdzL2VuLnN2ZyI7czoxNzoiZm9ybWF0X2RhdGVfc21hbGwiO3M6ODoiJW0vJWQvJVkiO3M6MTY6ImZvcm1hdF9kYXRlX2xvbmciO3M6ODoiJUIgJWQgJVkiO3M6MTY6ImZvcm1hdF9kYXRlX3RpbWUiO3M6MTc6IiVtLyVkLyVZICVIOiVpOiVzIjtzOjEwOiJjcmVhdGVkX2F0IjtzOjE5OiIyMDIzLTA3LTA5IDE1OjU5OjQ1IjtzOjEwOiJ1cGRhdGVkX2F0IjtzOjE5OiIyMDIzLTA3LTA5IDE2OjA3OjE0Ijt9czoxMToiACoAb3JpZ2luYWwiO2E6MTI6e3M6MjoiaWQiO2k6MjtzOjY6ImFjdGl2ZSI7czoxOiJZIjtzOjY6ImFscGhhMiI7czoyOiJlbiI7czo2OiJhbHBoYTMiO3M6MzoiZW5nIjtzOjY6ImxvY2FsZSI7czo1OiJlbl9VUyI7czo0OiJuYW1lIjtzOjc6IkVuZ2xpc2giO3M6NDoiZmxhZyI7czoyMDoiL2ltYWdlcy9mbGFncy9lbi5zdmciO3M6MTc6ImZvcm1hdF9kYXRlX3NtYWxsIjtzOjg6IiVtLyVkLyVZIjtzOjE2OiJmb3JtYXRfZGF0ZV9sb25nIjtzOjg6IiVCICVkICVZIjtzOjE2OiJmb3JtYXRfZGF0ZV90aW1lIjtzOjE3OiIlbS8lZC8lWSAlSDolaTolcyI7czoxMDoiY3JlYXRlZF9hdCI7czoxOToiMjAyMy0wNy0wOSAxNTo1OTo0NSI7czoxMDoidXBkYXRlZF9hdCI7czoxOToiMjAyMy0wNy0wOSAxNjowNzoxNCI7fXM6MTA6IgAqAGNoYW5nZXMiO2E6MDp7fXM6ODoiACoAY2FzdHMiO2E6MDp7fXM6MTc6IgAqAGNsYXNzQ2FzdENhY2hlIjthOjA6e31zOjIxOiIAKgBhdHRyaWJ1dGVDYXN0Q2FjaGUiO2E6MDp7fXM6MTM6IgAqAGRhdGVGb3JtYXQiO047czoxMDoiACoAYXBwZW5kcyI7YTozOntpOjA7czozOiJ1cmwiO2k6MTtzOjExOiJ1cmxfYmFja2VuZCI7aToyO3M6NzoidXJsX2FwaSI7fXM6MTk6IgAqAGRpc3BhdGNoZXNFdmVudHMiO2E6MDp7fXM6MTQ6IgAqAG9ic2VydmFibGVzIjthOjA6e31zOjEyOiIAKgByZWxhdGlvbnMiO2E6MDp7fXM6MTA6IgAqAHRvdWNoZXMiO2E6MDp7fXM6MTA6InRpbWVzdGFtcHMiO2I6MTtzOjEzOiJ1c2VzVW5pcXVlSWRzIjtiOjA7czo5OiIAKgBoaWRkZW4iO2E6MDp7fXM6MTA6IgAqAHZpc2libGUiO2E6MDp7fXM6MTE6IgAqAGZpbGxhYmxlIjthOjA6e31zOjEwOiIAKgBndWFyZGVkIjthOjA6e319fXM6Mjg6IgAqAGVzY2FwZVdoZW5DYXN0aW5nVG9TdHJpbmciO2I6MDt9fQ==', 1696672576),
	('SbQGe0dPRsisshGg2cIaeb3W9eJRiVnzDG4kuo65', NULL, '127.0.0.1', 'PostmanRuntime/7.33.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibkpnTjNTSVZrbGd4UkllQ2VMeHVOSkFxQnFHVmJZbnVvWk5EUHRwTCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjU6Imh0dHA6Ly9sYXJhdmVsLnRlc3QvbG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1696713491),
	('uoneZWCuJCxKybnCXpbRMwfp2bkFkrMz9tvpjJzR', NULL, '127.0.0.1', 'PostmanRuntime/7.32.3', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoienp2Q0Vhc3hjd1lxNTNqS3k4U3lLbFpGSGlIbGdoS1pYbTYwNTZuZSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjU6Imh0dHA6Ly9sYXJhdmVsLnRlc3QvbG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1696674790);

-- Listage de la structure de table laravel. users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `active` enum('Y','N') COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `lang` varchar(2) COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'fr',
  `firstname` varchar(100) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `lastname` varchar(100) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb3_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `two_factor_secret` text COLLATE utf8mb3_unicode_ci,
  `two_factor_recovery_codes` text COLLATE utf8mb3_unicode_ci,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `current_team_id` bigint unsigned DEFAULT NULL,
  `profile_photo_path` varchar(2048) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `last_login_at` timestamp NULL DEFAULT NULL,
  `last_login_ip` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Listage des données de la table laravel.users : ~0 rows (environ)
INSERT INTO `users` (`id`, `active`, `lang`, `firstname`, `lastname`, `email`, `email_verified_at`, `password`, `avatar`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`, `last_login_at`, `last_login_ip`) VALUES
	(1, 'Y', 'fr', 'Didier', 'Largeron', 'largeron.didier@gmail.com', NULL, '$2y$10$L1oDUy4mIN.NfGc367EBt.DGJHba3tpG2dd49WjmKvZng0AGftFYG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-07-09 13:59:47', '2023-10-07 19:53:38', NULL, NULL);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
