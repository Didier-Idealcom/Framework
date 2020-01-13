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
  `maintenance_message` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Listage des données de la table laravel.domains : ~1 rows (environ)
/*!40000 ALTER TABLE `domains` DISABLE KEYS */;
INSERT INTO `domains` (`id`, `active`, `title`, `name`, `folder`, `analytics`, `search_console`, `google_maps`, `maintenance_start`, `maintenance_end`, `maintenance_message`, `created_at`, `updated_at`) VALUES
	(1, 'Y', 'Main', 'www.ideal-com.com', 'test', 'ga-123456', NULL, NULL, NULL, NULL, NULL, '2018-09-02 08:33:33', '2020-01-12 17:29:51');
/*!40000 ALTER TABLE `domains` ENABLE KEYS */;

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Listage des données de la table laravel.emails : ~1 rows (environ)
/*!40000 ALTER TABLE `emails` DISABLE KEYS */;
INSERT INTO `emails` (`id`, `active`, `module`, `name`, `description`, `from`, `reply_to`, `to`, `cc`, `bcc`, `delay`, `created_at`, `updated_at`) VALUES
	(1, 'Y', 'Core', 'Test', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-04-14 20:24:10', '2020-01-12 17:31:49');
/*!40000 ALTER TABLE `emails` ENABLE KEYS */;

-- Listage de la structure de la table laravel. formulaires
CREATE TABLE IF NOT EXISTS `formulaires` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `active` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tracking` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Listage des données de la table laravel.formulaires : ~3 rows (environ)
/*!40000 ALTER TABLE `formulaires` DISABLE KEYS */;
INSERT INTO `formulaires` (`id`, `active`, `code`, `tracking`, `created_at`, `updated_at`) VALUES
	(1, 'Y', 'test', NULL, '2018-10-28 11:07:25', '2020-01-12 17:31:22'),
	(2, 'N', 'test2', NULL, '2020-01-12 13:06:56', '2020-01-12 13:06:56');
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Listage des données de la table laravel.formulaires_fields : ~2 rows (environ)
/*!40000 ALTER TABLE `formulaires_fields` DISABLE KEYS */;
INSERT INTO `formulaires_fields` (`id`, `formulaire_id`, `active`, `order`, `code`, `type`, `created_at`, `updated_at`) VALUES
	(1, 1, 'Y', 1, 'nom', 'text', '2018-10-28 11:12:29', '2020-01-12 17:31:34'),
	(2, 1, 'Y', 1, 'prenom', 'text', '2020-01-12 13:03:22', '2020-01-12 17:31:36');
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Listage des données de la table laravel.formulaires_fields_translations : ~4 rows (environ)
/*!40000 ALTER TABLE `formulaires_fields_translations` DISABLE KEYS */;
INSERT INTO `formulaires_fields_translations` (`id`, `formulaire_field_id`, `locale`, `label_admin`, `label_front`, `placeholder`, `date_format`, `help`, `error`, `error_min`, `error_max`, `error_extension`, `error_filesize`, `error_dimension`, `error_date_format`) VALUES
	(1, 1, 'fr', 'Nom', 'Nom', NULL, NULL, NULL, 'Merci de renseigner le nom', NULL, NULL, NULL, NULL, NULL, NULL),
	(2, 1, 'en', 'Lastname', 'Lastname', NULL, NULL, NULL, 'Please fill your lastname', NULL, NULL, NULL, NULL, NULL, NULL),
	(3, 2, 'fr', 'Prénom', 'Prénom', 'Prénom', NULL, NULL, 'Merci de renseigner votre prénom', NULL, NULL, NULL, NULL, NULL, NULL),
	(4, 2, 'en', 'Firstname', 'Firstname', 'Firstname', NULL, NULL, 'Please fill your firstname', NULL, NULL, NULL, NULL, NULL, NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Listage des données de la table laravel.formulaires_translations : ~4 rows (environ)
/*!40000 ALTER TABLE `formulaires_translations` DISABLE KEYS */;
INSERT INTO `formulaires_translations` (`id`, `formulaire_id`, `locale`, `title`, `resume`) VALUES
	(1, 1, 'fr', 'Formulaire test', 'Lorem ipsum lol'),
	(2, 1, 'en', 'Formulaire test', 'Lorem ipsum lol'),
	(3, 2, 'fr', 'Formulaire test 2', 'test'),
	(4, 2, 'en', 'Formulaire test 2', 'test');
/*!40000 ALTER TABLE `formulaires_translations` ENABLE KEYS */;

-- Listage de la structure de la table laravel. languages
CREATE TABLE IF NOT EXISTS `languages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `active` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `alpha2` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `format_date_small` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `format_date_long` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `format_date_time` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Listage des données de la table laravel.languages : ~5 rows (environ)
/*!40000 ALTER TABLE `languages` DISABLE KEYS */;
INSERT INTO `languages` (`id`, `active`, `alpha2`, `name`, `format_date_small`, `format_date_long`, `format_date_time`, `created_at`, `updated_at`) VALUES
	(1, 'Y', 'fr', 'Français', '%d/%m/%Y', '%d %B %Y', '%d/%m/%Y %H:%i:%s', NULL, '2020-01-12 17:29:57'),
	(2, 'N', 'en', 'English', '%m/%d/%Y', '%B %d %Y', '%m/%d/%Y %H:%i:%s', NULL, NULL),
	(3, 'N', 'es', 'Español', '%d/%m/%Y', '%d %B %Y', '%d/%m/%Y %H:%i:%s', NULL, NULL),
	(4, 'N', 'it', 'Italian', '%d/%m/%Y', '%d %B %Y', '%d/%m/%Y %H:%i:%s', NULL, NULL),
	(5, 'N', 'de', 'Deutch', '%d/%m/%Y', '%d %B %Y', '%d/%m/%Y %H:%i:%s', NULL, NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Listage des données de la table laravel.menuitems : ~1 rows (environ)
/*!40000 ALTER TABLE `menuitems` DISABLE KEYS */;
INSERT INTO `menuitems` (`id`, `menu_id`, `active`, `gabarit`, `bg`, `bd`, `niveau`, `parent_id`, `visible`, `cliquable`, `format`, `created_at`, `updated_at`) VALUES
	(1, 1, 'Y', 'index_index', 0, 0, 1, NULL, 'Y', 'Y', 'submenu', '2020-01-12 12:45:43', '2020-01-12 17:30:21');
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Listage des données de la table laravel.menuitems_translations : ~2 rows (environ)
/*!40000 ALTER TABLE `menuitems_translations` DISABLE KEYS */;
INSERT INTO `menuitems_translations` (`id`, `menuitem_id`, `locale`, `title_menu`, `title_page`, `link`, `target`) VALUES
	(1, 1, 'fr', 'Accueil', 'Accueil', NULL, '_self'),
	(2, 1, 'en', 'Home', 'Home', NULL, '_self');
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
	(1, 'N', 'home', '2020-01-04 18:05:17', '2020-01-04 18:05:17'),
	(2, 'N', 'main', '2020-01-04 18:05:17', '2020-01-04 18:05:17');
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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Listage des données de la table laravel.migrations : ~9 rows (environ)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2018_08_02_173544_create_pages_table', 1),
	(4, '2018_08_12_182443_create_domains_table', 1),
	(5, '2018_08_12_182515_create_languages_table', 1),
	(6, '2018_09_09_085005_create_permission_tables', 1),
	(7, '2018_10_03_212343_create_formulaires_table', 1),
	(8, '2019_04_14_174320_create_emails_table', 1),
	(9, '2019_06_30_135843_create_menus_table', 1);
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
	(2, 'Modules\\User\\Entities\\User', 1);
/*!40000 ALTER TABLE `model_has_roles` ENABLE KEYS */;

-- Listage de la structure de la table laravel. pages
CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `active` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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

-- Listage de la structure de la table laravel. permissions
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Listage des données de la table laravel.permissions : ~5 rows (environ)
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
	(1, 'permission_test1', 'admin', '2018-09-30 22:02:14', '2018-09-30 22:02:14'),
	(2, 'permission_test2', 'admin', '2018-09-30 22:02:21', '2018-09-30 22:02:21'),
	(3, 'permission_test3', 'admin', '2018-09-30 22:02:27', '2018-09-30 22:02:27'),
	(4, 'permission_test4', 'admin', '2018-09-30 22:02:33', '2018-09-30 22:02:33'),
	(5, 'permission_test5', 'admin', '2018-09-30 22:02:41', '2018-09-30 22:02:41');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;

-- Listage de la structure de la table laravel. roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Listage des données de la table laravel.roles : ~4 rows (environ)
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
	(1, 'Utilisateur', 'web', '2018-09-23 21:35:20', '2018-09-23 21:39:47'),
	(2, 'Superviseur', 'admin', '2018-09-23 21:35:33', '2018-09-23 21:39:55'),
	(3, 'Référenceur', 'admin', '2018-09-23 21:37:27', '2018-09-23 21:40:07'),
	(4, 'Administrateur 1', 'admin', '2018-09-23 21:39:16', '2018-09-23 21:40:16');
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

-- Listage des données de la table laravel.role_has_permissions : ~5 rows (environ)
/*!40000 ALTER TABLE `role_has_permissions` DISABLE KEYS */;
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
	(1, 2),
	(2, 2),
	(3, 2),
	(4, 2),
	(5, 2);
/*!40000 ALTER TABLE `role_has_permissions` ENABLE KEYS */;

-- Listage de la structure de la table laravel. users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Listage des données de la table laravel.users : ~51 rows (environ)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`, `email_verified_at`) VALUES
	(1, 'Didier Largeron', 'd.largeron@ideal-com.com', '$2y$10$HNndj3BOHGJicR2ZdudJO.tlFL.sIgAwFr0yEau6OcsZ/0Soqz9/G', NULL, '2020-01-04 18:05:17', '2020-01-04 18:05:17', '2020-01-04 18:05:17'),
	(2, 'Jessica Lang', 'ernestine38@example.org', '$2y$10$h42voZQtWBce3tsMS7n3lOwKCQR9eGPl9Nx0efBAVzzjTLKD6NdjC', 'TTSI6s6zkA', '2020-01-04 18:05:20', '2020-01-04 18:05:20', '2020-01-04 18:05:17'),
	(3, 'Ms. Kali Trantow', 'barton.omari@example.org', '$2y$10$2K9IYJHvC3z17279TSk4leqicDsWQph42jNEN7w2EvXM8hkbZdS/S', 'EhkisrT8Bf', '2020-01-04 18:05:20', '2020-01-04 18:05:20', '2020-01-04 18:05:17'),
	(4, 'Joanny Gutkowski', 'umarks@example.com', '$2y$10$2/3hKpPGc1XFOlUHwNz7IOZpuqTAA5QyGLGwjtcmQa251rTEOWEZq', 'XgMqLSSzMM', '2020-01-04 18:05:20', '2020-01-04 18:05:20', '2020-01-04 18:05:17'),
	(5, 'Maye Green', 'kyla88@example.com', '$2y$10$FmDOpEfSA2cm50H0lMZvy.dPKeHqVnIIgABcOpLXBQqwUXxEo66DK', '8JCSiqYAGA', '2020-01-04 18:05:20', '2020-01-04 18:05:20', '2020-01-04 18:05:17'),
	(6, 'Prof. Marcus Steuber', 'wyman.garett@example.org', '$2y$10$KxwsII360I/QgxvIOeXhrOMPJ7Xw8MOFkQGstBkWrwhLW/Q7uCsYG', '9FNgB0rVoH', '2020-01-04 18:05:20', '2020-01-04 18:05:20', '2020-01-04 18:05:17'),
	(7, 'Esmeralda Reilly', 'louvenia80@example.com', '$2y$10$WacGeP4bItLvUM...Ykyb.e8Imw8I1C957unIz0WOC/jteIVJDglK', 'DgfjlLRZZc', '2020-01-04 18:05:20', '2020-01-04 18:05:20', '2020-01-04 18:05:17'),
	(8, 'Brandt Luettgen', 'bwyman@example.com', '$2y$10$35s/6akKrHC0iNifZlvNN.PkQf3hgORJxmbmtGPmkCUafOkm8nK6y', 'tBkr7miqFM', '2020-01-04 18:05:20', '2020-01-04 18:05:20', '2020-01-04 18:05:17'),
	(9, 'Danika Muller', 'kaelyn37@example.org', '$2y$10$gwtpv80l6bgFhK9mGNtp/u2DsXUBsBvc/2yU8Nbt2dsASkSyGwBJi', 'SrLYLuzjR0', '2020-01-04 18:05:20', '2020-01-04 18:05:20', '2020-01-04 18:05:17'),
	(10, 'Antonetta Thiel', 'dgleichner@example.org', '$2y$10$1wI4JM2xB3T6ioO64rPsg.ZqVvlNhO2xO8akr5PfWOHg3LJU7kqCe', 'CHcm5mLECv', '2020-01-04 18:05:20', '2020-01-04 18:05:20', '2020-01-04 18:05:18'),
	(11, 'Keaton Heller', 'lemke.eudora@example.net', '$2y$10$/ULu74VklkPSWEmkxbZlpOF8fRoDOpV1/X7oRRx8WHjh2mo8Ir5SO', '0w0bzohsHd', '2020-01-04 18:05:20', '2020-01-04 18:05:20', '2020-01-04 18:05:18'),
	(12, 'Guido Torphy', 'tyreek08@example.com', '$2y$10$Wq7OyJ0oRmYrkTybh/t1X.qLMBMR5QEDyKRuuE6V9f4zzXlXz1zg2', '1bWDMe8gFO', '2020-01-04 18:05:20', '2020-01-04 18:05:20', '2020-01-04 18:05:18'),
	(13, 'Miracle Aufderhar DDS', 'hill.andre@example.net', '$2y$10$lIycpaZ2j/p/fBLd/qf0Humjeq/QmEeDYuddhZWWZ6aH4RIkHQw4e', 'reGxypmoy5', '2020-01-04 18:05:20', '2020-01-04 18:05:20', '2020-01-04 18:05:18'),
	(14, 'Ms. Anna Turcotte', 'cordie91@example.net', '$2y$10$e5qedVhpVx8U4bdeVQ4/b.Mxu96zSjOdlJsCby/YpkkBiKilQkuQi', 'wyc3g3zUQs', '2020-01-04 18:05:20', '2020-01-04 18:05:20', '2020-01-04 18:05:18'),
	(15, 'Gabriella Torp', 'dean36@example.com', '$2y$10$s1Juqe92F8/pD4hRu1W8XO01Q54d4TC61fMpHisqYAQy0tGzn80ba', 'qgcbwDwUwm', '2020-01-04 18:05:20', '2020-01-04 18:05:20', '2020-01-04 18:05:18'),
	(16, 'Granville Dach', 'kendra.schiller@example.com', '$2y$10$7OWRDvOJTCVVsnw/NAXmYud488AxEA8aRBndFDwKVp01iXEshnHaO', 'mKM8RTEmXh', '2020-01-04 18:05:20', '2020-01-04 18:05:20', '2020-01-04 18:05:18'),
	(17, 'Anastacio Daugherty Jr.', 'monique.rogahn@example.com', '$2y$10$JqMd2X/8iKm1boq95Ql9cuCQVlo5RXKDD5snLqlsJwvORujJj2npC', 'x9QdsI2H7D', '2020-01-04 18:05:20', '2020-01-04 18:05:20', '2020-01-04 18:05:18'),
	(18, 'Mrs. Marjolaine Romaguera', 'isaias68@example.net', '$2y$10$ECzHjwq15V9w55ajGfUlgupjX6UorkHbWRhkC5XCz2Hl27GOyvs6q', '4t3hze8H7p', '2020-01-04 18:05:20', '2020-01-04 18:05:20', '2020-01-04 18:05:18'),
	(19, 'Charley Lesch II', 'dickinson.jeremy@example.org', '$2y$10$hxUImV4l2wv0fcRZcXYZ7.S4sSVBryDWt11ubsUKv/WFSW4Dy5Kd6', 'l2XvjVM6lZ', '2020-01-04 18:05:20', '2020-01-04 18:05:20', '2020-01-04 18:05:18'),
	(20, 'Darius Auer', 'ora.quigley@example.net', '$2y$10$KfPtn1D24GomQ6ofMy63HeyMbXevas4xG9mMOn06rAvhPtPjxJz2C', 'mtHvFxHHUo', '2020-01-04 18:05:20', '2020-01-04 18:05:20', '2020-01-04 18:05:18'),
	(21, 'Dr. Minerva Labadie', 'pearline47@example.com', '$2y$10$Z5.Wii13ljR7V99vvFkKQuNyvj6qQ9HLrajii8bTKOP4e3PxUQqx2', 'MTquo7EUaw', '2020-01-04 18:05:20', '2020-01-04 18:05:20', '2020-01-04 18:05:18'),
	(22, 'Miss Eda Bruen III', 'xpredovic@example.net', '$2y$10$2Hhb/89sEw7RfkhSmxWzHur3Ak.Jc0gccfWxk86dp3/KFfCSTeRlS', 'VeUXq6FOZ9', '2020-01-04 18:05:20', '2020-01-04 18:05:20', '2020-01-04 18:05:18'),
	(23, 'Caitlyn Borer DDS', 'willard35@example.com', '$2y$10$MmKck6hFI.LgY6ZhoOzwte3M5EZEjnflKhdUA3J6iLJWK3SSqBYEe', 'YgxL1ijgUJ', '2020-01-04 18:05:20', '2020-01-04 18:05:20', '2020-01-04 18:05:18'),
	(24, 'Makenzie O\'Keefe II', 'stamm.taurean@example.net', '$2y$10$1ZPPQFa1wJBg8e5pTEOGx.9Ps5Vff0EEIDrqtKebe2VbJRh2c3MYa', 'Xip6iwFHfU', '2020-01-04 18:05:20', '2020-01-04 18:05:20', '2020-01-04 18:05:18'),
	(25, 'Prof. Orval Hamill', 'braun.laila@example.org', '$2y$10$.QAyH4RlE0KXb609Ivs1R.9Fk0woHkIcVSX3bR7RxVWuBhF/qqdaO', 'F40HyaLKn3', '2020-01-04 18:05:20', '2020-01-04 18:05:20', '2020-01-04 18:05:18'),
	(26, 'Emmet Pfeffer', 'spouros@example.com', '$2y$10$q.4AHUFaNWKjfK2CFdjjI.1TLOzQ8yE2N2ocB5tucoCoMO1sU/gWe', 'S2Y8aFC1kK', '2020-01-04 18:05:20', '2020-01-04 18:05:20', '2020-01-04 18:05:19'),
	(27, 'Jonas Satterfield', 'jbotsford@example.net', '$2y$10$1Eujif45eqa2xg9Ea3rHwu11aT42jepbXXvGgwAPj0JW2ziadXppq', 'fpSYKmDgzV', '2020-01-04 18:05:20', '2020-01-04 18:05:20', '2020-01-04 18:05:19'),
	(28, 'Ms. Alison Larkin', 'novella.eichmann@example.com', '$2y$10$XXCuHfiqnwRu7G5zPfJxX.UzqRKF44l70pFK7sFL6g52c0LHXCxtC', 'q5o9gyHrZm', '2020-01-04 18:05:20', '2020-01-04 18:05:20', '2020-01-04 18:05:19'),
	(29, 'Suzanne Bernier', 'bjohnson@example.com', '$2y$10$VdWy0eOu2Fo6epWQK05kSuVwYDfU1KvnNM9jfgs93TUMaMDtJyihi', 'Tfd83aHXVM', '2020-01-04 18:05:20', '2020-01-04 18:05:20', '2020-01-04 18:05:19'),
	(30, 'Orin Bruen', 'vella.gulgowski@example.org', '$2y$10$mlRWnN77ji4lq.Gzc4adH.nc8VoQkTeiXJQ5.0TlkBZ4e5zm4i96a', 'LApT0QsyKZ', '2020-01-04 18:05:20', '2020-01-04 18:05:20', '2020-01-04 18:05:19'),
	(31, 'Mr. Harold Pfannerstill Jr.', 'cartwright.harvey@example.com', '$2y$10$Ounp72Y2cmPvuy.tQ.x8u.nlB8lV6w9tXemnPKqJZMSa5zdr.nINu', 'qoEM9hSNL0', '2020-01-04 18:05:20', '2020-01-04 18:05:20', '2020-01-04 18:05:19'),
	(32, 'Wilma McDermott', 'bethel.dicki@example.com', '$2y$10$7XSfUm5bmDoUG1amdKecKePwcAQGeGSLLgw3XCEIFG/8AWEH8HJsa', '5vyXkd0ML9', '2020-01-04 18:05:20', '2020-01-04 18:05:20', '2020-01-04 18:05:19'),
	(33, 'Kale Haag V', 'wokuneva@example.org', '$2y$10$1MWwJ3gHH1oioYDSpzAKu.qU4ycgaXp5ijqOCJGtU6fWTNoLNpiaW', 'MAN9CYXbBx', '2020-01-04 18:05:20', '2020-01-04 18:05:20', '2020-01-04 18:05:19'),
	(34, 'Walker Reinger Jr.', 'purdy.connor@example.net', '$2y$10$O8XC6OCWpU2on.A58dY/Z.PLFmQHaDl4QkbQd.PMdX5bNfViwXWFW', 'Xz2LDjwOUj', '2020-01-04 18:05:20', '2020-01-04 18:05:20', '2020-01-04 18:05:19'),
	(35, 'Dr. Rodolfo Reichert', 'prosacco.emmanuelle@example.net', '$2y$10$4QaX2mXqxBXTKQouRw/Yk.tt9So8TQ9fa6Z/goZGG/8wIbDnfQV/C', '4mnIjBh8hZ', '2020-01-04 18:05:20', '2020-01-04 18:05:20', '2020-01-04 18:05:19'),
	(36, 'Ethyl Fadel', 'cummerata.lorena@example.net', '$2y$10$2rfBVk1YgpGITfMPTA2bAOYec0xEoKQ1QB8mGXodobJY/JC0FfIGW', '90GesBezug', '2020-01-04 18:05:20', '2020-01-04 18:05:20', '2020-01-04 18:05:19'),
	(37, 'Eldred Hilpert', 'mhyatt@example.net', '$2y$10$yon2Zchpgw1YrIpbqsQzeufqkvRY1FVdaU51ER1xK6JqVuDM2L3Ju', 'uEtXKv27Db', '2020-01-04 18:05:20', '2020-01-04 18:05:20', '2020-01-04 18:05:19'),
	(38, 'Mozell Ernser', 'lane08@example.net', '$2y$10$VX4jhbHuOqMVrJmcCfV.BOPUlG6HiJXY70ugtzGbtRy5WisK7.wNS', 'RhiBHforvQ', '2020-01-04 18:05:20', '2020-01-04 18:05:20', '2020-01-04 18:05:19'),
	(39, 'Mrs. Courtney Bahringer', 'rocky43@example.org', '$2y$10$G8qs1GffSzNHnKX66L/V8eJ3bShzZ34cwp6pgS7c2le77dhyVV5bi', 'NChfsjuWs9', '2020-01-04 18:05:20', '2020-01-04 18:05:20', '2020-01-04 18:05:19'),
	(40, 'Lexie Rowe', 'vruecker@example.org', '$2y$10$bPtfJHBK8VAPJM0tHv6uJ.s2WftmQJJg5IJE1PTa.5pW7VClM6Wxm', 'sSXUVGgSGY', '2020-01-04 18:05:20', '2020-01-04 18:05:20', '2020-01-04 18:05:19'),
	(41, 'Prof. Ellsworth Davis DDS', 'vicente84@example.net', '$2y$10$Hb1abYrKfeUc6aZRFlOHZ.3MUhjo58dxvkPpwyxnJp/jedI5TntwS', 'agW086EYZ8', '2020-01-04 18:05:20', '2020-01-04 18:05:20', '2020-01-04 18:05:20'),
	(42, 'Maximillia Davis II', 'odie78@example.org', '$2y$10$3dlVc2fksf2xSqnwcGGpe.Dt7ly3fGPXU1Z0GoubxvqRdsUHk/StC', 'RqTyPZ763O', '2020-01-04 18:05:20', '2020-01-04 18:05:20', '2020-01-04 18:05:20'),
	(43, 'Mrs. Freeda Lakin', 'steuber.lucie@example.org', '$2y$10$mbrU6nY4pNfjTVjqmIYAb.d9DAyVS2HciIVugILyAXRkho.NelJ2G', 'TGg82TrGQu', '2020-01-04 18:05:20', '2020-01-04 18:05:20', '2020-01-04 18:05:20'),
	(44, 'Mr. Ariel Bailey V', 'lysanne.armstrong@example.org', '$2y$10$SBenpQTHvQ9swJfYLvblgu.LiN2Z.80PmknLpgTxIhNz45JyfBi8q', '5wFrSJL0SP', '2020-01-04 18:05:20', '2020-01-04 18:05:20', '2020-01-04 18:05:20'),
	(45, 'Tierra Heidenreich', 'ybogisich@example.org', '$2y$10$xT4iolQt6zCwC6jHkcUMquMvTdC9FnEx/5RiqDfUpLaQSgFOCx8Ta', 'soO7INVY4B', '2020-01-04 18:05:20', '2020-01-04 18:05:20', '2020-01-04 18:05:20'),
	(46, 'Miss Kailey Trantow II', 'maribel.kovacek@example.com', '$2y$10$oYHCWSEtHIhrreFq0IG5pOAt/AEHQjwbCVmMv3L/6POBvwlyXAOVO', 'NcnahM0bc8', '2020-01-04 18:05:20', '2020-01-04 18:05:20', '2020-01-04 18:05:20'),
	(47, 'Brannon Botsford', 'jaquan.muller@example.net', '$2y$10$tgXl6eGVa4bT4H8BvNnCJ.LT2ttJgXwzMeTRChz5LyCmzL/nVeg.W', 'E1HY2yevXE', '2020-01-04 18:05:20', '2020-01-04 18:05:20', '2020-01-04 18:05:20'),
	(48, 'Delphia Mante', 'mitchel.crooks@example.com', '$2y$10$POMlYoytuE9lFNdUVt3dx.mf7yJsHwjIW/8hqpfR.4RISyYz1g5se', 'co7AEIHl6D', '2020-01-04 18:05:20', '2020-01-04 18:05:20', '2020-01-04 18:05:20'),
	(49, 'Prof. Lloyd Waters', 'boehm.jordon@example.org', '$2y$10$iM7uqIkCECTfEMX32F.DieSFZ37ZjoAKgejiuL/1DEm3n.A/5bwJu', 'GbrplwvJtN', '2020-01-04 18:05:20', '2020-01-04 18:05:20', '2020-01-04 18:05:20'),
	(50, 'Colby Adams', 'kris.urban@example.com', '$2y$10$WWYKH0ZSwcdfjk7LpIXxC.U6K3FKmnskC9g6L2GfPRri2z3Fd3cyW', 'j3PdYD0WlS', '2020-01-04 18:05:20', '2020-01-04 18:05:20', '2020-01-04 18:05:20'),
	(51, 'Bradford Kling Sr.', 'alexys49@example.net', '$2y$10$QRaEpcUXgCosIgAIY7kvoOfANxGvi.f8cqrQvbDx8dEu4ioYaBo3q', 'p5wLOZh4st', '2020-01-04 18:05:20', '2020-01-04 18:05:20', '2020-01-04 18:05:20');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
