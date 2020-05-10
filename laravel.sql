-- --------------------------------------------------------
-- Hôte :                        localhost
-- Version du serveur:           10.3.10-MariaDB-log - mariadb.org binary distribution
-- SE du serveur:                Win64
-- HeidiSQL Version:             9.5.0.5332
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Listage de la structure de la base pour laravel
CREATE DATABASE IF NOT EXISTS `laravel` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;
USE `laravel`;

-- Listage de la structure de la table laravel. domains
CREATE TABLE IF NOT EXISTS `domains` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `active` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `folder` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `analytics` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `search_console` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `google_maps` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `maintenance_start` datetime DEFAULT NULL,
  `maintenance_end` datetime DEFAULT NULL,
  `maintenance_message` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Listage des données de la table laravel.domains : ~0 rows (environ)
/*!40000 ALTER TABLE `domains` DISABLE KEYS */;
INSERT INTO `domains` (`id`, `active`, `title`, `name`, `folder`, `analytics`, `search_console`, `google_maps`, `maintenance_start`, `maintenance_end`, `maintenance_message`, `created_at`, `updated_at`) VALUES
	(1, 'Y', 'test', 'www.test.fr', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-02-22 17:44:13', '2020-05-09 14:20:53');
/*!40000 ALTER TABLE `domains` ENABLE KEYS */;

-- Listage de la structure de la table laravel. domains_languages
CREATE TABLE IF NOT EXISTS `domains_languages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `domain_id` int(10) unsigned NOT NULL,
  `language_id` int(10) unsigned NOT NULL,
  `active` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `default` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `order` int(11) NOT NULL DEFAULT 1,
  `url_redirect` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `url_blog` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `url_facebook` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `url_googleplus` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `url_instagram` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `url_linkedin` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `url_pinterest` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `url_twitter` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `url_viadeo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `url_youtube` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `home_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `home_content` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `u_domain_language_domain_id_language_id` (`domain_id`,`language_id`),
  KEY `fk_domain_language_language_id` (`language_id`),
  CONSTRAINT `fk_domain_language_domain_id` FOREIGN KEY (`domain_id`) REFERENCES `domains` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_domain_language_language_id` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Listage des données de la table laravel.domains_languages : ~0 rows (environ)
/*!40000 ALTER TABLE `domains_languages` DISABLE KEYS */;
INSERT INTO `domains_languages` (`id`, `domain_id`, `language_id`, `active`, `default`, `order`, `url_redirect`, `url_blog`, `url_facebook`, `url_googleplus`, `url_instagram`, `url_linkedin`, `url_pinterest`, `url_twitter`, `url_viadeo`, `url_youtube`, `home_title`, `home_content`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, 'Y', 'Y', 1, 'https://www.google.fr', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-05-10 13:27:54', '2020-05-10 12:03:06');
/*!40000 ALTER TABLE `domains_languages` ENABLE KEYS */;

-- Listage de la structure de la table laravel. emails
CREATE TABLE IF NOT EXISTS `emails` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `active` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `module` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `from` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reply_to` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `to` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cc` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bcc` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `delay` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Listage des données de la table laravel.emails : ~0 rows (environ)
/*!40000 ALTER TABLE `emails` DISABLE KEYS */;
/*!40000 ALTER TABLE `emails` ENABLE KEYS */;

-- Listage de la structure de la table laravel. failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8_unicode_ci NOT NULL,
  `queue` text COLLATE utf8_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Listage des données de la table laravel.failed_jobs : ~0 rows (environ)
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;

-- Listage de la structure de la table laravel. formulaires
CREATE TABLE IF NOT EXISTS `formulaires` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `active` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tracking` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Listage des données de la table laravel.formulaires : ~0 rows (environ)
/*!40000 ALTER TABLE `formulaires` DISABLE KEYS */;
/*!40000 ALTER TABLE `formulaires` ENABLE KEYS */;

-- Listage de la structure de la table laravel. formulaires_fields
CREATE TABLE IF NOT EXISTS `formulaires_fields` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `formulaire_id` int(10) unsigned NOT NULL,
  `active` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `order` int(11) NOT NULL DEFAULT 1,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_form_field_formulaire_id` (`formulaire_id`),
  CONSTRAINT `fk_form_field_formulaire_id` FOREIGN KEY (`formulaire_id`) REFERENCES `formulaires` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Listage des données de la table laravel.formulaires_fields : ~0 rows (environ)
/*!40000 ALTER TABLE `formulaires_fields` DISABLE KEYS */;
/*!40000 ALTER TABLE `formulaires_fields` ENABLE KEYS */;

-- Listage de la structure de la table laravel. formulaires_fields_translations
CREATE TABLE IF NOT EXISTS `formulaires_fields_translations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `formulaire_field_id` int(10) unsigned NOT NULL,
  `locale` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `label_admin` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `label_front` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `placeholder` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_format` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `help` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `error` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `error_min` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `error_max` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `error_extension` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `error_filesize` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `error_dimension` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `error_date_format` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `u_form_field_trans_formulaire_field_id_locale` (`formulaire_field_id`,`locale`),
  KEY `formulaires_fields_translations_locale_index` (`locale`),
  CONSTRAINT `fk_form_field_trans_formulaire_field_id` FOREIGN KEY (`formulaire_field_id`) REFERENCES `formulaires_fields` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Listage des données de la table laravel.formulaires_fields_translations : ~0 rows (environ)
/*!40000 ALTER TABLE `formulaires_fields_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `formulaires_fields_translations` ENABLE KEYS */;

-- Listage de la structure de la table laravel. formulaires_fields_values
CREATE TABLE IF NOT EXISTS `formulaires_fields_values` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `formulaire_field_id` int(10) unsigned NOT NULL,
  `active` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `order` int(11) NOT NULL DEFAULT 1,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_form_field_value_formulaire_field_id` (`formulaire_field_id`),
  CONSTRAINT `fk_form_field_value_formulaire_field_id` FOREIGN KEY (`formulaire_field_id`) REFERENCES `formulaires_fields` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Listage des données de la table laravel.formulaires_fields_values : ~0 rows (environ)
/*!40000 ALTER TABLE `formulaires_fields_values` DISABLE KEYS */;
/*!40000 ALTER TABLE `formulaires_fields_values` ENABLE KEYS */;

-- Listage de la structure de la table laravel. formulaires_fields_values_translations
CREATE TABLE IF NOT EXISTS `formulaires_fields_values_translations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `formulaire_field_value_id` int(10) unsigned NOT NULL,
  `locale` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `u_form_field_value_trans_formulaire_field_value_id_locale` (`formulaire_field_value_id`,`locale`),
  KEY `formulaires_fields_values_translations_locale_index` (`locale`),
  CONSTRAINT `fk_form_field_value_trans_formulaire_field_value_id` FOREIGN KEY (`formulaire_field_value_id`) REFERENCES `formulaires_fields_values` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Listage des données de la table laravel.formulaires_fields_values_translations : ~0 rows (environ)
/*!40000 ALTER TABLE `formulaires_fields_values_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `formulaires_fields_values_translations` ENABLE KEYS */;

-- Listage de la structure de la table laravel. formulaires_translations
CREATE TABLE IF NOT EXISTS `formulaires_translations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `formulaire_id` int(10) unsigned NOT NULL,
  `locale` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `resume` text COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `u_form_trans_formulaire_id_locale` (`formulaire_id`,`locale`),
  KEY `formulaires_translations_locale_index` (`locale`),
  CONSTRAINT `fk_form_trans_formulaire_id` FOREIGN KEY (`formulaire_id`) REFERENCES `formulaires` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Listage des données de la table laravel.formulaires_translations : ~0 rows (environ)
/*!40000 ALTER TABLE `formulaires_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `formulaires_translations` ENABLE KEYS */;

-- Listage de la structure de la table laravel. languages
CREATE TABLE IF NOT EXISTS `languages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `active` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `alpha2` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `alpha3` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `locale` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `format_date_small` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `format_date_long` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `format_date_time` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Listage des données de la table laravel.languages : ~1 rows (environ)
/*!40000 ALTER TABLE `languages` DISABLE KEYS */;
INSERT INTO `languages` (`id`, `active`, `alpha2`, `alpha3`, `locale`, `name`, `format_date_small`, `format_date_long`, `format_date_time`, `created_at`, `updated_at`) VALUES
	(1, 'Y', 'fr', 'fra', 'fr_FR.utf8', 'Français', '%d/%m/%Y', '%d %B %Y', '%d/%m/%Y %H:%i:%s', '2020-05-09 17:11:16', '2020-05-09 15:17:02');
/*!40000 ALTER TABLE `languages` ENABLE KEYS */;

-- Listage de la structure de la table laravel. menuitems
CREATE TABLE IF NOT EXISTS `menuitems` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `menu_id` int(10) unsigned NOT NULL,
  `active` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `gabarit` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `bg` int(10) unsigned NOT NULL DEFAULT 0,
  `bd` int(10) unsigned NOT NULL DEFAULT 0,
  `niveau` int(10) unsigned NOT NULL DEFAULT 1,
  `parent_id` int(10) unsigned DEFAULT NULL,
  `visible` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `cliquable` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `format` enum('submenu','big_submenu') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'submenu',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `menuitems_menu_id_foreign` (`menu_id`),
  KEY `menuitems_parent_id_foreign` (`parent_id`),
  CONSTRAINT `menuitems_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `menuitems_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `menuitems` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Listage des données de la table laravel.menuitems : ~3 rows (environ)
/*!40000 ALTER TABLE `menuitems` DISABLE KEYS */;
INSERT INTO `menuitems` (`id`, `menu_id`, `active`, `gabarit`, `bg`, `bd`, `niveau`, `parent_id`, `visible`, `cliquable`, `format`, `created_at`, `updated_at`) VALUES
	(1, 1, 'Y', 'index_index', 0, 0, 1, NULL, 'Y', 'Y', 'submenu', '2020-04-26 20:47:16', '2020-05-09 14:33:41'),
	(2, 2, 'Y', 'cmspages_index', 0, 0, 1, NULL, 'Y', 'Y', 'submenu', '2020-05-02 17:38:24', '2020-05-09 14:32:58');
/*!40000 ALTER TABLE `menuitems` ENABLE KEYS */;

-- Listage de la structure de la table laravel. menuitems_translations
CREATE TABLE IF NOT EXISTS `menuitems_translations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `menuitem_id` int(10) unsigned NOT NULL,
  `locale` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title_menu` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title_page` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `target` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `menuitems_translations_menuitem_id_locale_unique` (`menuitem_id`,`locale`),
  KEY `menuitems_translations_locale_index` (`locale`),
  CONSTRAINT `menuitems_translations_menuitem_id_foreign` FOREIGN KEY (`menuitem_id`) REFERENCES `menuitems` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Listage des données de la table laravel.menuitems_translations : ~4 rows (environ)
/*!40000 ALTER TABLE `menuitems_translations` DISABLE KEYS */;
INSERT INTO `menuitems_translations` (`id`, `menuitem_id`, `locale`, `title_menu`, `title_page`, `link`, `target`) VALUES
	(1, 1, 'fr', 'Accueil', 'Accueil', NULL, '_self'),
	(2, 1, 'en', 'Home', 'Home', NULL, '_self'),
	(3, 2, 'fr', 'Item 1', 'Item 1', NULL, '_self'),
	(4, 2, 'en', 'Item 1', 'Item 1', NULL, '_self');
/*!40000 ALTER TABLE `menuitems_translations` ENABLE KEYS */;

-- Listage de la structure de la table laravel. menus
CREATE TABLE IF NOT EXISTS `menus` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `active` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Listage des données de la table laravel.menus : ~2 rows (environ)
/*!40000 ALTER TABLE `menus` DISABLE KEYS */;
INSERT INTO `menus` (`id`, `active`, `code`, `created_at`, `updated_at`) VALUES
	(1, 'Y', 'home', '2020-04-26 20:45:43', '2020-05-09 14:32:46'),
	(2, 'Y', 'main', '2020-04-26 20:46:03', '2020-05-09 14:31:11');
/*!40000 ALTER TABLE `menus` ENABLE KEYS */;

-- Listage de la structure de la table laravel. menus_translations
CREATE TABLE IF NOT EXISTS `menus_translations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `menu_id` int(10) unsigned NOT NULL,
  `locale` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `menus_translations_menu_id_locale_unique` (`menu_id`,`locale`),
  KEY `menus_translations_locale_index` (`locale`),
  CONSTRAINT `menus_translations_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Listage des données de la table laravel.menus_translations : ~4 rows (environ)
/*!40000 ALTER TABLE `menus_translations` DISABLE KEYS */;
INSERT INTO `menus_translations` (`id`, `menu_id`, `locale`, `title`) VALUES
	(1, 1, 'fr', 'Menu accueil'),
	(2, 1, 'en', 'Home menu'),
	(3, 2, 'fr', 'Menu principal'),
	(4, 2, 'en', 'Main menu');
/*!40000 ALTER TABLE `menus_translations` ENABLE KEYS */;

-- Listage de la structure de la table laravel. migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Listage des données de la table laravel.migrations : ~14 rows (environ)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2018_08_02_173544_create_pages_table', 1),
	(10, '2018_08_12_182443_create_domains_table', 2),
	(12, '2018_09_09_085005_create_permission_tables', 2),
	(13, '2018_10_03_212343_create_formulaires_table', 2),
	(14, '2019_04_14_174320_create_emails_table', 2),
	(15, '2019_06_30_135843_create_menus_table', 2),
	(17, '2020_01_27_052021_create_permalinks_table', 3),
	(18, '2018_08_12_182515_create_languages_table', 4),
	(19, '2019_08_19_000000_create_failed_jobs_table', 5),
	(22, '2020_05_09_153204_rename_field_users_table', 6),
	(23, '2020_05_09_155329_update_users_table', 6),
	(24, '2020_05_10_102048_create_domains_languages_table', 7);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Listage de la structure de la table laravel. model_has_permissions
CREATE TABLE IF NOT EXISTS `model_has_permissions` (
  `permission_id` int(10) unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Listage des données de la table laravel.model_has_permissions : ~0 rows (environ)
/*!40000 ALTER TABLE `model_has_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `model_has_permissions` ENABLE KEYS */;

-- Listage de la structure de la table laravel. model_has_roles
CREATE TABLE IF NOT EXISTS `model_has_roles` (
  `role_id` int(10) unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Listage des données de la table laravel.model_has_roles : ~2 rows (environ)
/*!40000 ALTER TABLE `model_has_roles` DISABLE KEYS */;
INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
	(1, 'Modules\\User\\Entities\\User', 1),
	(1, 'Modules\\User\\Entities\\User', 2);
/*!40000 ALTER TABLE `model_has_roles` ENABLE KEYS */;

-- Listage de la structure de la table laravel. pages
CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `active` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Listage des données de la table laravel.pages : ~3 rows (environ)
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;
INSERT INTO `pages` (`id`, `active`, `created_at`, `updated_at`) VALUES
	(1, 'Y', '2018-08-09 15:07:28', '2020-01-12 17:31:16'),
	(2, 'N', '2018-08-09 15:08:29', '2019-05-04 22:06:24'),
	(3, 'N', '2018-09-23 13:49:11', '2019-05-04 22:06:26');
/*!40000 ALTER TABLE `pages` ENABLE KEYS */;

-- Listage de la structure de la table laravel. pages_translations
CREATE TABLE IF NOT EXISTS `pages_translations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `page_id` int(10) unsigned NOT NULL,
  `locale` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pages_translations_page_id_locale_unique` (`page_id`,`locale`),
  KEY `pages_translations_locale_index` (`locale`),
  CONSTRAINT `pages_translations_page_id_foreign` FOREIGN KEY (`page_id`) REFERENCES `pages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Listage des données de la table laravel.pages_translations : ~6 rows (environ)
/*!40000 ALTER TABLE `pages_translations` DISABLE KEYS */;
INSERT INTO `pages_translations` (`id`, `page_id`, `locale`, `title`, `content`) VALUES
	(1, 1, 'fr', 'Page test', '<style>* { box-sizing: border-box; } body {margin: 0;}*{box-sizing:border-box;}body{margin-top:0px;margin-right:0px;margin-bottom:0px;margin-left:0px;}.c3658{padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px;}</style><div class="c3658">Lorem ipsum FR</div>'),
	(2, 1, 'en', 'Test page', '<style>* { box-sizing: border-box; } body {margin: 0;}.c3738{padding:10px;}</style><div class="c3738">Lorem ipsum EN</div>'),
	(3, 2, 'fr', 'Page test 2', ''),
	(4, 2, 'en', 'Test page 2', ''),
	(5, 3, 'fr', 'Page test grapesjs', '<style>* { box-sizing: border-box; } body {margin: 0;}*{box-sizing:border-box;}body{margin-top:0px;margin-right:0px;margin-bottom:0px;margin-left:0px;}.row{display:table;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px;width:100%;}.cell{width:8%;display:table-cell;height:75px;}.c2946{padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px;}@media (max-width: 768px){.cell{width:100%;display:block;}.cell{width:100%;display:block;}}</style><div class="row"><div class="cell"></div><div class="cell"><div class="c2946"><p>Insert your text here</p></div></div></div>'),
	(6, 3, 'en', 'Test page grapesjs', '<style>* { box-sizing: border-box; } body {margin: 0;}.row{display:table;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px;width:100%;}.cell{width:8%;display:table-cell;height:75px;}.c2984{padding:10px;}.c3023{padding:10px;}@media (max-width: 768px){.cell{width:100%;display:block;}.cell{width:100%;display:block;}}</style><div class="row"><div class="cell"><div class="c2984"><p>Insert your text here</p></div></div><div class="cell"><section class="bdg-sect"><h1 class="heading">Insert title here</h1><p class="paragraph">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua</p></section></div><div class="cell"><div class="c3023"><p>Insert your text here</p></div></div></div>');
/*!40000 ALTER TABLE `pages_translations` ENABLE KEYS */;

-- Listage de la structure de la table laravel. password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Listage des données de la table laravel.password_resets : ~0 rows (environ)
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Listage de la structure de la table laravel. permalinks
CREATE TABLE IF NOT EXISTS `permalinks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `active` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `entity_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `entity_id` int(10) unsigned DEFAULT NULL,
  `redirect` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `permalinks_redirect_foreign` (`redirect`),
  CONSTRAINT `permalinks_redirect_foreign` FOREIGN KEY (`redirect`) REFERENCES `permalinks` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Listage des données de la table laravel.permalinks : ~4 rows (environ)
/*!40000 ALTER TABLE `permalinks` DISABLE KEYS */;
INSERT INTO `permalinks` (`id`, `active`, `entity_type`, `entity_id`, `redirect`, `created_at`, `updated_at`) VALUES
	(1, 'N', 'Modules\\Menu\\Entities\\Menuitem', 1, NULL, '2020-04-26 20:47:19', '2020-04-26 20:47:19'),
	(2, 'N', 'Modules\\Menu\\Entities\\Menuitem', 2, NULL, '2020-05-02 17:38:24', '2020-05-02 21:08:16'),
	(3, 'N', 'Modules\\Menu\\Entities\\Menuitem', 2, 2, '2020-05-02 21:04:15', '2020-05-02 21:08:16'),
	(4, 'N', 'Modules\\Menu\\Entities\\Menuitem', 2, 2, '2020-05-02 21:07:52', '2020-05-02 21:08:16');
/*!40000 ALTER TABLE `permalinks` ENABLE KEYS */;

-- Listage de la structure de la table laravel. permalinks_translations
CREATE TABLE IF NOT EXISTS `permalinks_translations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `permalink_id` int(10) unsigned NOT NULL,
  `locale` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `full_path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permalinks_translations_permalink_id_locale_unique` (`permalink_id`,`locale`),
  KEY `permalinks_translations_locale_index` (`locale`),
  CONSTRAINT `permalinks_translations_permalink_id_foreign` FOREIGN KEY (`permalink_id`) REFERENCES `permalinks` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Listage des données de la table laravel.permalinks_translations : ~8 rows (environ)
/*!40000 ALTER TABLE `permalinks_translations` DISABLE KEYS */;
INSERT INTO `permalinks_translations` (`id`, `permalink_id`, `locale`, `slug`, `full_path`) VALUES
	(1, 1, 'fr', '2020-04-26-home', '2020-04-26-home'),
	(2, 1, 'en', '2020-04-26-home', '2020-04-26-home'),
	(3, 2, 'fr', '2020-05-02-item-1', '2020-05-02-item-1'),
	(4, 2, 'en', '2020-05-02-item-1', '2020-05-02-item-1'),
	(5, 3, 'fr', '2020-05-02-item-1-test-1', '2020-05-02-item-1-test-1'),
	(6, 3, 'en', '2020-05-02-item-1', '2020-05-02-item-1'),
	(7, 4, 'fr', '2020-05-02-item-1-test-2', '2020-05-02-item-1-test-2'),
	(8, 4, 'en', '2020-05-02-item-1', '2020-05-02-item-1');
/*!40000 ALTER TABLE `permalinks_translations` ENABLE KEYS */;

-- Listage de la structure de la table laravel. permissions
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Listage des données de la table laravel.permissions : ~0 rows (environ)
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;

-- Listage de la structure de la table laravel. roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Listage des données de la table laravel.roles : ~6 rows (environ)
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
	(1, 'Superviseur', 'admin', '2020-05-10 12:36:34', '2020-05-10 12:36:34'),
	(2, 'Administrateur 1', 'admin', '2020-05-10 12:36:48', '2020-05-10 12:36:48'),
	(3, 'Administrateur 2', 'admin', '2020-05-10 12:36:56', '2020-05-10 12:36:56'),
	(4, 'Administrateur 3', 'admin', '2020-05-10 12:37:03', '2020-05-10 12:37:03'),
	(5, 'Référenceur', 'admin', '2020-05-10 12:37:25', '2020-05-10 12:37:25'),
	(6, 'Client', 'guest', '2020-05-10 12:39:10', '2020-05-10 12:39:10');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;

-- Listage de la structure de la table laravel. role_has_permissions
CREATE TABLE IF NOT EXISTS `role_has_permissions` (
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Listage des données de la table laravel.role_has_permissions : ~0 rows (environ)
/*!40000 ALTER TABLE `role_has_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `role_has_permissions` ENABLE KEYS */;

-- Listage de la structure de la table laravel. users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `active` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `firstname` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lastname` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `last_login_at` timestamp NULL DEFAULT NULL,
  `last_login_ip` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Listage des données de la table laravel.users : ~51 rows (environ)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `active`, `firstname`, `lastname`, `email`, `password`, `remember_token`, `created_at`, `updated_at`, `email_verified_at`, `last_login_at`, `last_login_ip`) VALUES
	(1, 'Y', 'Didier', 'Largeron', 'd.largeron@ideal-com.com', '$2y$10$HNndj3BOHGJicR2ZdudJO.tlFL.sIgAwFr0yEau6OcsZ/0Soqz9/G', 'KwzrSq9G7q1cYmlUKNu2g0ZTRfhYZ93IstO54u9bxcFYE2PchvDzcGVbOVLn', '2020-01-04 18:05:17', '2020-05-10 13:43:13', '2020-01-04 18:05:17', '2020-05-10 13:43:13', '127.0.0.1'),
	(2, 'Y', 'test', 'test', 'test@test.fr', '$2y$10$KPu6PFlEtXq.a8swey/.5uiq0cvI5DCjLY2wVwr0SfqlTFIjCKARm', NULL, '2020-05-09 16:23:03', '2020-05-10 12:40:28', '2020-05-09 16:23:00', '2020-05-10 12:40:28', '127.0.0.1'),
	(3, 'N', 'Michelle', 'Beatty', 'monroe.senger@example.com', '$2y$10$QLxY4.spZheX1SoHdxT9qeYv3a1ZcWnGbKw41gw30oV3ZpkYfIxLm', NULL, '2020-05-09 16:23:03', '2020-05-09 16:23:03', '2020-05-09 16:23:00', NULL, NULL),
	(4, 'N', 'Maudie', 'Kilback', 'okeefe.mozelle@example.net', '$2y$10$jT6/5LluZyBwRQJg4aNS8eLC.zB5b15.jAIJfio21Xm4TraO7Wssq', NULL, '2020-05-09 16:23:03', '2020-05-09 16:23:03', '2020-05-09 16:23:00', NULL, NULL),
	(5, 'N', 'Josie', 'Rutherford', 'paucek.joy@example.org', '$2y$10$jWtsh6S8/8hL0sRTYlgLB.mpU7n/B6kA6CBlc/Tz17negJRaRMpRq', NULL, '2020-05-09 16:23:03', '2020-05-09 16:23:03', '2020-05-09 16:23:00', NULL, NULL),
	(6, 'N', 'Allen', 'Strosin', 'maribel.fritsch@example.net', '$2y$10$xAhXBvUbfk/w5DjVSuS1s.AJcJp2bBXLBnRj/BMVuNTfgMVBh/2Im', NULL, '2020-05-09 16:23:03', '2020-05-09 16:23:03', '2020-05-09 16:23:00', NULL, NULL),
	(7, 'N', 'Sydnee', 'Flatley', 'quitzon.sandra@example.com', '$2y$10$Txk3mW6heDmXr6Z5YU3pH.xk2c.491QU2LLkhqirWtm8ZUsrP2UHm', NULL, '2020-05-09 16:23:03', '2020-05-09 16:23:03', '2020-05-09 16:23:00', NULL, NULL),
	(8, 'N', 'Kellen', 'Stehr', 'bridie.zemlak@example.com', '$2y$10$gznUW8.Au0Jbvx6DLP2WEuPy32gHhQtRhEVTeqo/Dh7HblR5Vvi4W', NULL, '2020-05-09 16:23:03', '2020-05-09 16:23:03', '2020-05-09 16:23:00', NULL, NULL),
	(9, 'N', 'Meggie', 'Kshlerin', 'thauck@example.net', '$2y$10$Zz2gtclYP5SySr1rkKCnI.Y3NA0Cfg/2fLbx5ho/7feyxRtvo6qRO', NULL, '2020-05-09 16:23:03', '2020-05-09 16:23:03', '2020-05-09 16:23:00', NULL, NULL),
	(10, 'N', 'Chadrick', 'Cassin', 'ucorkery@example.net', '$2y$10$IIPdiaAahAzuVwPn3mkNRez3jorfqyfcSOgY/YrvZLHvNd9jrFh/6', NULL, '2020-05-09 16:23:03', '2020-05-09 16:23:03', '2020-05-09 16:23:01', NULL, NULL),
	(11, 'N', 'Wilbert', 'D\'Amore', 'bednar.joan@example.com', '$2y$10$uJmhF9FD/1xv2/bpasbu8OAlAuNog3Se.hzhTz3b0boxgFXFmfGn.', NULL, '2020-05-09 16:23:03', '2020-05-09 16:23:03', '2020-05-09 16:23:01', NULL, NULL),
	(12, 'N', 'Tyrique', 'Hamill', 'glemke@example.net', '$2y$10$uNW0wrxX.QVyvC1bB2XGoujiHafO/w1TBd8tgzXrCWSbaw0QCrlJi', NULL, '2020-05-09 16:23:03', '2020-05-09 16:23:03', '2020-05-09 16:23:01', NULL, NULL),
	(13, 'N', 'Ike', 'Wilderman', 'htrantow@example.org', '$2y$10$BGHYFm9L4o9UPyyunU2yUOn1ciifZh0MqEFWlee13VxVGe4Y/C2TG', NULL, '2020-05-09 16:23:03', '2020-05-09 16:23:03', '2020-05-09 16:23:01', NULL, NULL),
	(14, 'N', 'Shaina', 'Emard', 'aida55@example.net', '$2y$10$nU9CcIIO8gnwoi9bC9HUa.u1VGhOoJhboz0cPpJZ3ntn.nhnE502S', NULL, '2020-05-09 16:23:03', '2020-05-09 16:23:03', '2020-05-09 16:23:01', NULL, NULL),
	(15, 'N', 'Jack', 'Adams', 'maritza41@example.net', '$2y$10$5R8giZwibGbUgPmryn.kTOOTVVROCsrg1NOUi2NSZKcGwmxQYbyP6', NULL, '2020-05-09 16:23:03', '2020-05-09 16:23:03', '2020-05-09 16:23:01', NULL, NULL),
	(16, 'N', 'Trace', 'Schuppe', 'dibbert.prudence@example.net', '$2y$10$.ICAcF5yQDZkZLJgIwg1BOHVv1J/8nnK./Q0SVmuBVPXmm7j1aBNO', NULL, '2020-05-09 16:23:03', '2020-05-09 16:23:03', '2020-05-09 16:23:01', NULL, NULL),
	(17, 'N', 'Orrin', 'Hammes', 'tia.heathcote@example.com', '$2y$10$O0vM1PU1Q8TWhimRxXqNU.e/6Ri4uUC1enQw6i8jJLjExxHRJbaT2', NULL, '2020-05-09 16:23:03', '2020-05-09 16:23:03', '2020-05-09 16:23:01', NULL, NULL),
	(18, 'N', 'Curtis', 'Torphy', 'annamae.rutherford@example.org', '$2y$10$80IBGBQyHo5QsR9ZAxwruOmjfe1lSSE7sDWAt.n/tgdoLp4B5eZCW', NULL, '2020-05-09 16:23:03', '2020-05-09 16:23:03', '2020-05-09 16:23:01', NULL, NULL),
	(19, 'N', 'Lisandro', 'Streich', 'fgutmann@example.com', '$2y$10$7NBfzZlhvsWSAd.GdOLY5OFkPTy8xKOfY4cPr90gfmXiniitu8qTW', NULL, '2020-05-09 16:23:03', '2020-05-09 16:23:03', '2020-05-09 16:23:01', NULL, NULL),
	(20, 'N', 'Rossie', 'Ebert', 'dayana.klein@example.org', '$2y$10$Eqb7pXd23rz03yoijQl1n.ZrLbxkFn4JknUy1Y/xN98Tk2uGlkFGS', NULL, '2020-05-09 16:23:03', '2020-05-09 16:23:03', '2020-05-09 16:23:01', NULL, NULL),
	(21, 'N', 'Eloisa', 'Kassulke', 'usauer@example.com', '$2y$10$ZT/9gW2iERLbJvnEwmx.U.J2Lo6blHpr4NnOpUOXoQ7dZDixL.Q6K', NULL, '2020-05-09 16:23:03', '2020-05-09 16:23:03', '2020-05-09 16:23:01', NULL, NULL),
	(22, 'N', 'Jerrell', 'Schroeder', 'xdickinson@example.com', '$2y$10$FDlNO4x9YFR374fvAGYTr.JAaSSxD3pRO8akhmwTRE6b5GyE8OBN.', NULL, '2020-05-09 16:23:03', '2020-05-09 16:23:03', '2020-05-09 16:23:01', NULL, NULL),
	(23, 'N', 'Adah', 'Streich', 'jamison.dickinson@example.net', '$2y$10$ow6byq5BXcXC2UG3t4lRQeOc3ciIx21paPbifRBTZ0f66HvCWWgCW', NULL, '2020-05-09 16:23:03', '2020-05-09 16:23:03', '2020-05-09 16:23:01', NULL, NULL),
	(24, 'N', 'Lexus', 'Rath', 'odoyle@example.org', '$2y$10$borJ0HtJQnBZydh9.m.r0e.FY4jyyj1enaZACp.iY7hlH6d/2wOcq', NULL, '2020-05-09 16:23:03', '2020-05-09 16:23:03', '2020-05-09 16:23:01', NULL, NULL),
	(25, 'N', 'Elaina', 'Conroy', 'ullrich.ana@example.com', '$2y$10$kELqVvR.8XLKvcnQ/UvnaeZSpGVMCMDAx2.fTw94dN8x.KrccMeEi', NULL, '2020-05-09 16:23:03', '2020-05-09 16:23:03', '2020-05-09 16:23:01', NULL, NULL),
	(26, 'N', 'Tony', 'Zemlak', 'roscoe.dickinson@example.org', '$2y$10$CyctIFA0HJbeBGZIADMrceSmyyG3aScm7bB1AFxqXNlL/62X2BXn2', NULL, '2020-05-09 16:23:03', '2020-05-09 16:23:03', '2020-05-09 16:23:02', NULL, NULL),
	(27, 'N', 'Sadie', 'Kulas', 'maynard.abernathy@example.com', '$2y$10$3/wTXVClrX.TdXCXDYW0aOttgjapsdiTMrNG4k.8YoZZAP5bnHdIe', NULL, '2020-05-09 16:23:03', '2020-05-09 16:23:03', '2020-05-09 16:23:02', NULL, NULL),
	(28, 'N', 'Fred', 'Blick', 'thora30@example.net', '$2y$10$SCRp8bX/O6yQpLU9L378cOpwsALZHBSU3hgsLFew5pydFbITZjlKS', NULL, '2020-05-09 16:23:03', '2020-05-09 16:23:03', '2020-05-09 16:23:02', NULL, NULL),
	(29, 'N', 'Jo', 'Rempel', 'dhowell@example.com', '$2y$10$1dNEPwSmHsdueqdd4AbVcuJvYAmNUA2va0oESm6iLcTp5FBFIhMsO', NULL, '2020-05-09 16:23:03', '2020-05-09 16:23:03', '2020-05-09 16:23:02', NULL, NULL),
	(30, 'N', 'Santina', 'Leffler', 'grant.santa@example.org', '$2y$10$spHnGRQ.eGizy8q9OISjxOfGdfk9hxZWYwH/4Z405KpvZtIEU65P6', NULL, '2020-05-09 16:23:03', '2020-05-09 16:23:03', '2020-05-09 16:23:02', NULL, NULL),
	(31, 'N', 'Dillon', 'Schinner', 'crist.lucile@example.org', '$2y$10$4RYWbbpeVoy9Qmy1IMB7yOOtYJ7MVpsNx8vdptyFFjyBI3oxfiKBy', NULL, '2020-05-09 16:23:03', '2020-05-09 16:23:03', '2020-05-09 16:23:02', NULL, NULL),
	(32, 'N', 'Maximus', 'Langosh', 'trobel@example.net', '$2y$10$jwMJepcty2Zz4jhLyUQjZOmUc/rig3gUNFEZ1f252NjrkJ.pqvCTe', NULL, '2020-05-09 16:23:03', '2020-05-09 16:23:03', '2020-05-09 16:23:02', NULL, NULL),
	(33, 'N', 'Maia', 'Champlin', 'yasmine.sipes@example.com', '$2y$10$hboamMnezJZSZRvb5.6IGOLTEPlYIqvFwP/VkdcrnI6bBGAFjhLGq', NULL, '2020-05-09 16:23:03', '2020-05-09 16:23:03', '2020-05-09 16:23:02', NULL, NULL),
	(34, 'N', 'Claudine', 'Schuppe', 'xthiel@example.org', '$2y$10$cSqk4y/AhmlJBZOrVieLJu5HflMH4IhaE7XQR0KhI.Ze2wjQ3OtGG', NULL, '2020-05-09 16:23:03', '2020-05-09 16:23:03', '2020-05-09 16:23:02', NULL, NULL),
	(35, 'N', 'Quinten', 'Lindgren', 'hammes.cloyd@example.org', '$2y$10$RAHCTbaThgFD8xrL591Pkexa43wwboQ41w1WCuRlnA3.FMy9QbJma', NULL, '2020-05-09 16:23:03', '2020-05-09 16:23:03', '2020-05-09 16:23:02', NULL, NULL),
	(36, 'N', 'Hailee', 'Leuschke', 'naomie.schamberger@example.net', '$2y$10$tKlDVNobbCEzVM9yOB28UOkrMlmlmPtP6gT/MfVkji2eGOiWc796e', NULL, '2020-05-09 16:23:03', '2020-05-09 16:23:03', '2020-05-09 16:23:02', NULL, NULL),
	(37, 'N', 'Camryn', 'Fay', 'demarcus73@example.org', '$2y$10$2SCCeCZ6AssIXboUjBDHv.U8flDcL4MCySewIFgaGOvTUUkjmsiKK', NULL, '2020-05-09 16:23:03', '2020-05-09 16:23:03', '2020-05-09 16:23:02', NULL, NULL),
	(38, 'N', 'Guido', 'Kshlerin', 'yfadel@example.net', '$2y$10$/IKdIXVJvHJKEu08DdcFAuxAdvaPwhKZcXNwkMI2Chc.B9rjL7Lbm', NULL, '2020-05-09 16:23:03', '2020-05-09 16:23:03', '2020-05-09 16:23:02', NULL, NULL),
	(39, 'N', 'Aditya', 'Gleichner', 'swilliamson@example.com', '$2y$10$1eM7uP4P0ak2jkrAcPk6z.Tr9WN2gZHdHHKehCT8AMVEKnowKuvpO', NULL, '2020-05-09 16:23:03', '2020-05-09 16:23:03', '2020-05-09 16:23:02', NULL, NULL),
	(40, 'N', 'Cleve', 'Erdman', 'cornell.thompson@example.net', '$2y$10$eHiOsdtx4XDHEZa/Mst2ZOpzQAN8fhcvQpIylMlXZpMmKpO6470gi', NULL, '2020-05-09 16:23:03', '2020-05-09 16:23:03', '2020-05-09 16:23:02', NULL, NULL),
	(41, 'N', 'Lucienne', 'Green', 'yvette.mcclure@example.com', '$2y$10$M6YDecPpM0hOTGzeueIlCuefhZISChgMRj/zNzvbyBgCuSPDqaHz.', NULL, '2020-05-09 16:23:03', '2020-05-09 16:23:03', '2020-05-09 16:23:02', NULL, NULL),
	(42, 'N', 'Thelma', 'Homenick', 'kuvalis.velma@example.org', '$2y$10$NFS8BJHZfX3d2BXNJCLcsOvyd1zYIUdqHMR581GGABev2/rGG7IL2', NULL, '2020-05-09 16:23:03', '2020-05-09 16:23:03', '2020-05-09 16:23:03', NULL, NULL),
	(43, 'N', 'Gregorio', 'Runolfsson', 'robel.madisyn@example.com', '$2y$10$hZsDTTUarPWcadrePPKlp.hAY738n43k/pJdKkFXD16GDBxxoADJW', NULL, '2020-05-09 16:23:03', '2020-05-09 16:23:03', '2020-05-09 16:23:03', NULL, NULL),
	(44, 'N', 'Celestine', 'Murazik', 'pruecker@example.org', '$2y$10$p75Fn13dy4sWMnuafjZaJ.Sbcm0rQ7GSRCrkoqebNq3IqStoxYmJO', NULL, '2020-05-09 16:23:03', '2020-05-09 16:23:03', '2020-05-09 16:23:03', NULL, NULL),
	(45, 'N', 'Penelope', 'Ebert', 'timmothy76@example.org', '$2y$10$yVW8vXwAuJIhk1WbTp36pOLdeVMxjOeQU8i3ODCoNewzVs/VlbeR2', NULL, '2020-05-09 16:23:03', '2020-05-09 16:23:03', '2020-05-09 16:23:03', NULL, NULL),
	(46, 'N', 'Verdie', 'Funk', 'gwendolyn.murray@example.org', '$2y$10$adoXOEhVzd8ioJRDlEpxReo0a7YDTiZCYfB7dfwFj9.uZFESKn8g2', NULL, '2020-05-09 16:23:03', '2020-05-09 16:23:03', '2020-05-09 16:23:03', NULL, NULL),
	(47, 'N', 'Reilly', 'Leannon', 'mclaughlin.gerhard@example.net', '$2y$10$XpuD9ouSLfKBTDt5bVMcGO4NJ01sLbt7gEFRfJysQG18W26gKHSvG', NULL, '2020-05-09 16:23:03', '2020-05-09 16:23:03', '2020-05-09 16:23:03', NULL, NULL),
	(48, 'N', 'Humberto', 'Roob', 'berneice.blanda@example.net', '$2y$10$5Fm5hVJhW7s3uRRfRAY6kO0L74KKF.E/O9fOP7YOK2WO3yPW6OJ/u', NULL, '2020-05-09 16:23:03', '2020-05-09 16:23:03', '2020-05-09 16:23:03', NULL, NULL),
	(49, 'N', 'Loy', 'Abshire', 'aokuneva@example.org', '$2y$10$xDMySFUyp9H0WgKCg41eWesguca/LgEPZiJmwHm0kAMQvYPuz.cOO', NULL, '2020-05-09 16:23:03', '2020-05-09 16:23:03', '2020-05-09 16:23:03', NULL, NULL),
	(50, 'N', 'Lamar', 'Bernhard', 'boconner@example.com', '$2y$10$2op4ufPCOsdXHEwsIdgSMeAZwwW.ixuVRYbxQlGFS.kNstSdy570K', NULL, '2020-05-09 16:23:03', '2020-05-09 16:23:03', '2020-05-09 16:23:03', NULL, NULL),
	(51, 'N', 'Felton', 'Orn', 'karlie.boehm@example.org', '$2y$10$lDMbLV7g05QbXQa/VIRj7einJ.NB0qEMfMyK0Z.3aVwXAvL0c3xia', NULL, '2020-05-09 16:23:03', '2020-05-09 16:23:03', '2020-05-09 16:23:03', NULL, NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
