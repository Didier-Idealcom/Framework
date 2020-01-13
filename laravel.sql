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
	(1, 'Y', 'Main', 'www.ideal-com.com', 'test', 'ga-123456', NULL, NULL, NULL, NULL, NULL, '2018-09-02 08:33:33', '2019-08-25 15:42:46');
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
	(1, 'Y', 'Core', 'Test', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-04-14 20:24:10', '2019-05-05 15:15:56');
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

-- Listage des données de la table laravel.formulaires : ~2 rows (environ)
/*!40000 ALTER TABLE `formulaires` DISABLE KEYS */;
INSERT INTO `formulaires` (`id`, `active`, `code`, `tracking`, `created_at`, `updated_at`) VALUES
	(1, 'N', 'test', NULL, '2018-10-28 11:07:25', '2019-05-04 22:06:32'),
	(2, 'N', 'test2', NULL, '2018-10-28 17:39:54', '2019-05-04 22:06:34');
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Listage des données de la table laravel.formulaires_fields : ~1 rows (environ)
/*!40000 ALTER TABLE `formulaires_fields` DISABLE KEYS */;
INSERT INTO `formulaires_fields` (`id`, `formulaire_id`, `active`, `order`, `code`, `type`, `created_at`, `updated_at`) VALUES
	(1, 1, 'N', 1, 'nom', 'string', '2018-10-28 11:12:29', '2019-05-04 22:16:41');
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Listage des données de la table laravel.formulaires_fields_translations : ~1 rows (environ)
/*!40000 ALTER TABLE `formulaires_fields_translations` DISABLE KEYS */;
INSERT INTO `formulaires_fields_translations` (`id`, `formulaire_field_id`, `locale`, `label_admin`, `label_front`, `placeholder`, `date_format`, `help`, `error`, `error_min`, `error_max`, `error_extension`, `error_filesize`, `error_dimension`, `error_date_format`) VALUES
	(1, 1, 'en', 'Nom', 'Nom', NULL, NULL, NULL, 'Merci de renseigner le nom', NULL, NULL, NULL, NULL, NULL, NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Listage des données de la table laravel.formulaires_translations : ~2 rows (environ)
/*!40000 ALTER TABLE `formulaires_translations` DISABLE KEYS */;
INSERT INTO `formulaires_translations` (`id`, `formulaire_id`, `locale`, `title`, `resume`) VALUES
	(1, 1, 'en', 'Formulaire test', 'Lorem ipsum lol'),
	(2, 2, 'en', 'Formulaire test2', 'Lorem ipsum');
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Listage des données de la table laravel.languages : ~1 rows (environ)
/*!40000 ALTER TABLE `languages` DISABLE KEYS */;
INSERT INTO `languages` (`id`, `active`, `alpha2`, `name`, `format_date_small`, `format_date_long`, `format_date_time`, `created_at`, `updated_at`) VALUES
	(1, 'Y', 'fr', 'Français', 'dd/mm/YYYY', '%d %B %Y', '%d/%m/%Y %H:%i:%s', '2018-09-02 08:59:05', '2019-08-23 10:35:03');
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
	(1, 1, 'N', 'index_index', 0, 0, 1, NULL, 'Y', 'Y', 'submenu', '2019-12-07 17:53:15', '2019-12-07 17:53:15');
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Listage des données de la table laravel.menuitems_translations : ~1 rows (environ)
/*!40000 ALTER TABLE `menuitems_translations` DISABLE KEYS */;
INSERT INTO `menuitems_translations` (`id`, `menuitem_id`, `locale`, `title_menu`, `title_page`, `link`, `target`) VALUES
	(1, 1, 'en', 'Accueil', 'Accueil', NULL, '_self');
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
	(1, 'N', 'home', '2019-12-22 23:10:24', '2019-12-22 23:10:24'),
	(2, 'N', 'main', '2019-12-22 23:10:24', '2019-12-22 23:10:24');
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
	(1, 1, 'en', 'Home menu'),
	(2, 1, 'fr', 'Menu accueil'),
	(3, 2, 'en', 'Main menu'),
	(4, 2, 'fr', 'Menu principal');
/*!40000 ALTER TABLE `menus_translations` ENABLE KEYS */;

-- Listage de la structure de la table laravel. migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Listage des données de la table laravel.migrations : 9 rows
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2018_08_02_173544_create_pages_table', 2),
	(6, '2018_08_12_182443_create_domains_table', 3),
	(7, '2018_08_12_182515_create_languages_table', 3),
	(8, '2018_09_09_085005_create_permission_tables', 4),
	(11, '2018_10_03_212343_create_formulaires_table', 5),
	(12, '2019_04_14_174320_create_emails_table', 6),
	(13, '2019_06_30_135843_create_menus_table', 7);
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
	(1, 'Y', '2018-08-09 15:07:28', '2019-09-05 21:12:10'),
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Listage des données de la table laravel.password_resets : 0 rows
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
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=52 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Listage des données de la table laravel.users : 50 rows
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Didier Largeron', 'd.largeron@ideal-com.com', '$2y$10$x6cPSat8/qq//H8sAC2HiuoPPixzcInF6XI7FJVmPo9mYAGMFoJtS', 'NvSSZQFPh44fR1pkqcYe7OahVJYvERTlXSMLTe7sGPfbzmCZCdOpFeLtR6sr', '2017-11-18 21:52:54', '2019-09-08 13:14:59'),
	(2, 'Kyla Padberg', 'zaria26@example.com', '$2y$10$ZhuSu5ukUYjAY0C.LZhgs.Tb2B9FMbOIfOVZe6TwN9oGx18c/PcQO', 'TGsqySEDUBz826rcetkIKuFjAhhHGZL7GDkqWZLOwaDnLWhctDEdoE4pmqxu', '2018-07-29 10:14:48', '2018-08-02 10:09:54'),
	(3, 'Miss Norma Kirlin', 'zgreenfelder@example.net', '$2y$10$ammWUozvT/NO1XWAlt8N6O2AmwjU/92EEdkamvwWfUqfRFGiob.m2', '9OmPO8K7go', '2018-07-29 10:14:48', '2018-07-29 10:14:48'),
	(4, 'Mr. Randall Skiles MD', 'uemard@example.org', '$2y$10$tPqu5CWPaPv0bTxSnSWKO.8HrIvCLlTXHENoNsJVRxzovOeZaoHES', 'Ensayrrfb1', '2018-07-29 10:14:48', '2018-07-29 10:14:48'),
	(5, 'Judy Gaylord', 'rozella22@example.org', '$2y$10$VuKZ39vOfTzUV.AxL9ThWOvzjNIx8.dttJJhWLVfAG9/ee.GU7Wve', 'DF4SnW0mBK', '2018-07-29 10:14:48', '2018-07-29 10:14:48'),
	(6, 'Carolina Kling', 'hgoodwin@example.com', '$2y$10$oQhv9q1V/4y58uYsewM3ceigSNVsxA9RRDvjaZhZ8zRRAY./QUT/m', 'RZGcEZ3cNm', '2018-07-29 10:14:48', '2018-07-29 10:14:48'),
	(7, 'Carole Hansen', 'bailey49@example.com', '$2y$10$.DkxCBYNRx2Atm.VSa7EZ.MH6qX/pcyH11zQiv16XFg3kTT9OaLNu', 'gslVmUV2gK', '2018-07-29 10:14:48', '2018-07-29 10:14:48'),
	(8, 'Garnett Corkery', 'alfonzo46@example.net', '$2y$10$xi9SbluGlXfAZxIILEwOCuXYfO/tts7Aes7ZuoMe08svDRtOYT25y', 'sSKcW3jnsb', '2018-07-29 10:14:48', '2018-07-29 10:14:48'),
	(9, 'Arturo Schaden I', 'mbarrows@example.com', '$2y$10$SJDS9SZPJoahiMDnqtRPA.7YDiOvH0vfiPTtTQjuxCN.PCoVkkKo2', 'bYgNJs0prK', '2018-07-29 10:14:48', '2018-07-29 10:14:48'),
	(10, 'Drake Johns', 'marina63@example.net', '$2y$10$oW2F.E2dDsi.rZDukS7D6.hXm8MlNRrkUPuytGmCubcN968dqhGWq', 'M5m6rjbocb', '2018-07-29 10:14:48', '2018-07-29 10:14:48'),
	(11, 'Miss Marjory Wiegand', 'zturcotte@example.net', '$2y$10$ZSYNu.Befasg1ZAANLoaseOgTYsr2XUpd3NxY4pXzy1qed2YwWZE6', '4RMXK5ThsV', '2018-07-29 10:14:48', '2018-07-29 10:14:48'),
	(12, 'Mr. Orrin Hauck Jr.', 'christiansen.ernestina@example.org', '$2y$10$zuxksx4.9gfOrFwUxazJZe1nNOojKIWPFfpqzOGyXhms8aeVEWy0y', 'N2tVvxwGpF', '2018-07-29 10:14:48', '2018-07-29 10:14:48'),
	(13, 'Dwight Moen', 'vcole@example.org', '$2y$10$xrgP6nMXdQSxQ1KogyHatuGRUhP03AibloY14Iy.u68f3fdbiVfx2', 'HBv8cOAkpm', '2018-07-29 10:14:48', '2018-07-29 10:14:48'),
	(14, 'Amely Rogahn', 'jewel.west@example.org', '$2y$10$k27Jdu4btOUfuypamFb4X.PnEWbK6Ej2rf4mzzo3gbjsiqTmbcKGy', 'HRrhTtl2ry', '2018-07-29 10:14:48', '2018-07-29 10:14:48'),
	(15, 'Isaiah Braun', 'wilderman.kiley@example.com', '$2y$10$kZK08z3uoK/zRwIO/ndi4Oe.NNAjiqObGJOnBZ1kwsx1BDVX37MzK', 'MDWKIAdzeZ', '2018-07-29 10:14:48', '2018-07-29 10:14:48'),
	(16, 'Maia Frami', 'nellie98@example.net', '$2y$10$xvJ4XT.4OHaql.94CDNOWeHv2puld6m5xT0sCpzWsopocQfh6HcEO', 'kTCkMz5x6T', '2018-07-29 10:14:48', '2018-07-29 10:14:48'),
	(17, 'Geraldine O\'Keefe', 'yost.garrett@example.net', '$2y$10$CFIP9CYSbug84REZ0YIXLuFGPEAFm1eryL0wYooowQM.kOOCa6P2.', 'Poc6khlofR', '2018-07-29 10:14:48', '2018-07-29 10:14:48'),
	(18, 'Mr. Tristian Lynch', 'celine.gislason@example.org', '$2y$10$7Qj1mUpSGhQZH0YfC/Htn.8tA3cpvWxFRmmWYbjmBnTs0p0I83pD.', 'dNxJc9ysK0', '2018-07-29 10:14:48', '2018-07-29 10:14:48'),
	(19, 'Beverly Wilkinson MD', 'beahan.philip@example.net', '$2y$10$ZNgF8MFVl93KOXXMSogmWeKg6H8SN5F6HR2ygZhalbA.nCc3vIhnq', 'MJbwktUFMY', '2018-07-29 10:14:48', '2018-07-29 10:14:48'),
	(20, 'Mike Hackett DVM', 'noemie70@example.net', '$2y$10$koWIURc49v7hUfOagaoQouV3u9epBcqWc20tRf1v18AB3c8EyrQu2', 'udPXvBDu8X', '2018-07-29 10:14:48', '2018-07-29 10:14:48'),
	(21, 'Prof. Jalon Hoppe', 'abernathy.lavina@example.net', '$2y$10$dqC/cm7bEK/lYKoH7TpQzudvIZoztFWmCC0AE2yDtbGeTYVWi37GO', 'SGLXjD98Ei', '2018-07-29 10:14:48', '2018-07-29 10:14:48'),
	(22, 'Shania O\'Kon', 'byost@example.com', '$2y$10$2/mG0.WbJU.grbStEL3vkOgB/rYzMjnK4uZzP1gtAB7nt.ytCTdq6', 'CEC7ZGbxJv', '2018-07-29 10:14:48', '2018-07-29 10:14:48'),
	(23, 'Carmen Watsica III', 'bogan.leonie@example.com', '$2y$10$b/ZfvZASfyXHE6wjF1GPme.Vbmk.I.GEorLYDFQgWhjo.2soQxTO.', 'jhh33tF2ay', '2018-07-29 10:14:48', '2018-07-29 10:14:48'),
	(24, 'Devin Crooks', 'btoy@example.org', '$2y$10$Z7WXuehqxr7cAlLBKiufEeeBvVjELSURETqvDUP7rpc2bcLBTW5q2', 'kQTQ27PgOI', '2018-07-29 10:14:48', '2018-07-29 10:14:48'),
	(25, 'Polly Emard', 'monique53@example.org', '$2y$10$oZ0TssLiMpNVBQJREpkfbut42Gd9Z0G1cclsRP1Vg.U0XrRcm7yEu', 'GQ3KFLII0E', '2018-07-29 10:14:48', '2018-07-29 10:14:48'),
	(26, 'Reggie Lakin', 'naomi12@example.com', '$2y$10$h1jZh5BnkGEbt9yF6rUMRe.W211HlWReb7T.3ubJ8RVtAeUDACS8m', 'zkAuUrS4cA', '2018-07-29 10:14:48', '2018-07-29 10:14:48'),
	(27, 'Arnaldo Howell', 'harris.marilou@example.org', '$2y$10$tpBmKec.FKdijuZxl9tQH.7to1a5bSo0qof3ErrdsTsqQnqn.doj6', 'ztC0aItgxR', '2018-07-29 10:14:48', '2018-07-29 10:14:48'),
	(28, 'Hailie Altenwerth', 'damon.dubuque@example.org', '$2y$10$PzqgnFs7R.gohAJ4O5Ie5u6.5vpzD.QYN4J5DL.XhqmGBwBVQKSO6', '7oqMwKOf1f', '2018-07-29 10:14:48', '2018-07-29 10:14:48'),
	(29, 'Emmanuelle Bergstrom', 'reggie.rodriguez@example.net', '$2y$10$RIsZlc5DiLzwGAhdghanUuAU2FxY7FHf4ZKxy9keLWwzajwUhK8WC', 'fUed4eCDBZ', '2018-07-29 10:14:48', '2018-07-29 10:14:48'),
	(30, 'Rickie Crist', 'ipfeffer@example.org', '$2y$10$PYSKmUFu8J7u29za5u/J1etuGo88OiUzZ51Mczx/IS949CmNTk4Wu', 'oljE1S7TAY', '2018-07-29 10:14:48', '2018-07-29 10:14:48'),
	(31, 'Mr. Dwight Labadie', 'wrunolfsson@example.net', '$2y$10$BK7TdgZbbSn2ixTV5LrwGO1WWl8OHfDpk/IZmSmXTptpvURgDQEAC', 'rWuRSVGIVy', '2018-07-29 10:14:48', '2018-07-29 10:14:48'),
	(32, 'Henderson McLaughlin DDS', 'eswift@example.net', '$2y$10$Y.L8xC6Z3ITMXCnyJBwl4elsnA4JIFGwKcjF/9st2kgZPY/kVrEv.', 'Lx97F3jllf', '2018-07-29 10:14:48', '2018-07-29 10:14:48'),
	(33, 'Dr. Tanya Moen', 'willow13@example.org', '$2y$10$Sg.HtBU7eXALS/Evy0yP5.yKisKz6conqyvaiFGOOBTj0fO8hyWKG', '1U6XhqnSvJ', '2018-07-29 10:14:48', '2018-07-29 10:14:48'),
	(34, 'Prof. Adele Nienow I', 'eleazar.walter@example.org', '$2y$10$IBAkQBpPP7wD2MqEkERx8OLndIxdhdP9Tzaq8z/5fHnm11sK3ISI6', 'ksRFAAKH9w', '2018-07-29 10:14:48', '2018-07-29 10:14:48'),
	(35, 'Mr. Sammie Fahey', 'iwolff@example.com', '$2y$10$9ThLEqOx0frFojxM0fgdjeqcK7Ehy9vLcIuJcu/InBeZ5B.1i33Yu', 'L6JdF53PDk', '2018-07-29 10:14:48', '2018-07-29 10:14:48'),
	(36, 'Philip Windler', 'courtney44@example.net', '$2y$10$ntv.C4FzJPaX419S47qdhOFbzhJK5Jn4Yks.HvHpZbnNLjIf6V7oe', 'NUGIyL2dH7', '2018-07-29 10:14:48', '2018-07-29 10:14:48'),
	(37, 'Mabel Predovic', 'cicero.johnston@example.net', '$2y$10$xZI7QFzXtk23UmVY8rhdmuGnrq7iiV.yloRL3Ii6ISWPXwLTHoOEC', '99DK4jbvJE', '2018-07-29 10:14:48', '2018-07-29 10:14:48'),
	(38, 'Mrs. Kamille Jaskolski III', 'wilton.nikolaus@example.com', '$2y$10$BY7qwvtIWtpWQCKlf9XMm.5T.NoNEMVynb0htIfoHyACVbRZJNwGG', 'SEBSNkW6JL', '2018-07-29 10:14:48', '2018-07-29 10:14:48'),
	(39, 'Mr. Remington Block Jr.', 'kdare@example.net', '$2y$10$OnK8rSo0tkymHCVXL5chxeMT3CK3vjgY3KTjy/D..bcP43UqF42ny', 'dkc9IfOg4G', '2018-07-29 10:14:48', '2018-07-29 10:14:48'),
	(40, 'Prof. Jerod Walsh II', 'tina.spinka@example.net', '$2y$10$K.C3xvLtHoTXWaL0hnGunuten6Lc9nqu9EUTUN.sasmf7HUEIQx2C', 'DZiFrKmjBy', '2018-07-29 10:14:48', '2018-07-29 10:14:48'),
	(41, 'Alaina Kutch', 'hills.flo@example.org', '$2y$10$chLrA2e0i9xbx2GCZu4..uVBTx.tXCMOqP4il3zdFg38HO4aw3Wh2', '5QtwsgBZHw', '2018-07-29 10:14:48', '2018-07-29 10:14:48'),
	(42, 'Gloria Botsford', 'cathryn.langworth@example.org', '$2y$10$zo9Dunzo/0n7j3GAy0ZoCeKdBzTaOFeOm6mJavwtgj.RCZZweFiS.', 'u3k4nRtuAj', '2018-07-29 10:14:48', '2018-07-29 10:14:48'),
	(43, 'Elvera Witting I', 'goyette.betsy@example.org', '$2y$10$1nVwaJxhGN6U0CQmv/Q4DODWe7SET960eiiEDpsr9fQHs/Q0wEi2q', 'fUck3GTJVw', '2018-07-29 10:14:48', '2018-07-29 10:14:48'),
	(44, 'Soledad Johnston', 'morissette.edwin@example.com', '$2y$10$dTf0r.hZsuY75lZJcisBPeyANdYWLabT1bdF7z0HtIPskmPKEBwG6', '40jYI5rdqp', '2018-07-29 10:14:48', '2018-07-29 10:14:48'),
	(45, 'Dr. Elda Stamm PhD', 'aohara@example.com', '$2y$10$UNEnYXqZd/st0EO7gcPftuMJU77XgnunRL2G4SzADtRhWRRpYeWqS', 'K5aNR6ztBM', '2018-07-29 10:14:48', '2018-07-29 10:14:48'),
	(46, 'Jensen Nikolaus', 'shanahan.nedra@example.org', '$2y$10$wovo.usIP.rM3kaCCIqeLuwNz2R7HW2iDWe1yeX7YQU3MAS3CGGz2', 'Sb1w59q9td', '2018-07-29 10:14:48', '2018-07-29 10:14:48'),
	(47, 'Orval Hoeger', 'jaren45@example.com', '$2y$10$mOBCj61Hp9YQjt6lJ4esd.aVP0gESO4eVvJ2ovDrm4xDkKsVCF9JS', 'shaTNJJ3Jg', '2018-07-29 10:14:48', '2018-07-29 10:14:48'),
	(48, 'Mrs. Destinee Waters I', 'triston.pouros@example.net', '$2y$10$L7qiALZYxm8tb3TLu6hR6OP/c10e5fkEBoj8kPYrZjIOPCuOK9lA.', '5NEP7bdfac', '2018-07-29 10:14:48', '2018-07-29 10:14:48'),
	(49, 'Jaclyn Bogan', 'demario13@example.com', '$2y$10$yrkc1kcK2gbwUA58o3iojOtjPPs5MvwN9KXhCy5RSxOG77.b9P2TC', 'm84OG0Rzdg', '2018-07-29 10:14:48', '2018-07-29 10:14:48'),
	(50, 'Osvaldo Bednar', 'anderson.stefanie@example.org', '$2y$10$GRyD8kJRujJ/zLK1DPo2neES1LHNjxdIWolBmCiOVminRVRyd9XVm', '4gsquRCpT4', '2018-07-29 10:14:48', '2018-07-29 10:14:48');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
