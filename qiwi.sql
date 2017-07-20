-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               5.5.45 - MySQL Community Server (GPL)
-- ОС Сервера:                   Win32
-- HeidiSQL Версия:              9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Дамп структуры базы данных qiwi
CREATE DATABASE IF NOT EXISTS `qiwi` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `qiwi`;


-- Дамп структуры для таблица qiwi.auth_assignment
CREATE TABLE IF NOT EXISTS `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Дамп данных таблицы qiwi.auth_assignment: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `auth_assignment` DISABLE KEYS */;
/*!40000 ALTER TABLE `auth_assignment` ENABLE KEYS */;


-- Дамп структуры для таблица qiwi.auth_item
CREATE TABLE IF NOT EXISTS `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `idx-auth_item-type` (`type`),
  CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Дамп данных таблицы qiwi.auth_item: ~14 rows (приблизительно)
/*!40000 ALTER TABLE `auth_item` DISABLE KEYS */;
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('admin', 1, NULL, 'app\\components\\UserRoleRule', NULL, 1500502373, 1500502373),
	('guest', 1, NULL, 'app\\components\\UserRoleRule', NULL, 1500502373, 1500502373),
	('request/create', 2, NULL, NULL, NULL, 1500502373, 1500502373),
	('request/delete', 2, NULL, NULL, NULL, 1500502373, 1500502373),
	('request/getwork', 2, NULL, NULL, NULL, 1500502373, 1500502373),
	('request/index', 2, NULL, NULL, NULL, 1500502373, 1500502373),
	('request/sendtoreview', 2, NULL, NULL, NULL, 1500502373, 1500502373),
	('request/update', 2, NULL, NULL, NULL, 1500502373, 1500502373),
	('request/view', 2, NULL, NULL, NULL, 1500502373, 1500502373),
	('site/error', 2, NULL, NULL, NULL, 1500502373, 1500502373),
	('site/index', 2, NULL, NULL, NULL, 1500502373, 1500502373),
	('site/login', 2, NULL, NULL, NULL, 1500502373, 1500502373),
	('site/logout', 2, NULL, NULL, NULL, 1500502373, 1500502373),
	('user', 1, NULL, 'app\\components\\UserRoleRule', NULL, 1500502373, 1500502373);
/*!40000 ALTER TABLE `auth_item` ENABLE KEYS */;


-- Дамп структуры для таблица qiwi.auth_item_child
CREATE TABLE IF NOT EXISTS `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Дамп данных таблицы qiwi.auth_item_child: ~24 rows (приблизительно)
/*!40000 ALTER TABLE `auth_item_child` DISABLE KEYS */;
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('admin', 'request/create'),
	('user', 'request/create'),
	('admin', 'request/delete'),
	('admin', 'request/getwork'),
	('user', 'request/getwork'),
	('admin', 'request/index'),
	('user', 'request/index'),
	('admin', 'request/sendtoreview'),
	('user', 'request/sendtoreview'),
	('admin', 'request/update'),
	('admin', 'request/view'),
	('user', 'request/view'),
	('admin', 'site/error'),
	('guest', 'site/error'),
	('user', 'site/error'),
	('admin', 'site/index'),
	('guest', 'site/index'),
	('user', 'site/index'),
	('admin', 'site/login'),
	('guest', 'site/login'),
	('user', 'site/login'),
	('admin', 'site/logout'),
	('guest', 'site/logout'),
	('user', 'site/logout');
/*!40000 ALTER TABLE `auth_item_child` ENABLE KEYS */;


-- Дамп структуры для таблица qiwi.auth_rule
CREATE TABLE IF NOT EXISTS `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Дамп данных таблицы qiwi.auth_rule: ~1 rows (приблизительно)
/*!40000 ALTER TABLE `auth_rule` DISABLE KEYS */;
INSERT INTO `auth_rule` (`name`, `data`, `created_at`, `updated_at`) VALUES
	('app\\components\\UserRoleRule', _binary 0x4F3A32373A226170705C636F6D706F6E656E74735C55736572526F6C6552756C65223A333A7B733A343A226E616D65223B733A32373A226170705C636F6D706F6E656E74735C55736572526F6C6552756C65223B733A393A22637265617465644174223B693A313530303530323337333B733A393A22757064617465644174223B693A313530303530323337333B7D, 1500502373, 1500502373);
/*!40000 ALTER TABLE `auth_rule` ENABLE KEYS */;


-- Дамп структуры для таблица qiwi.migration
CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы qiwi.migration: ~3 rows (приблизительно)
/*!40000 ALTER TABLE `migration` DISABLE KEYS */;
INSERT INTO `migration` (`version`, `apply_time`) VALUES
	('m000000_000000_base', 1500206639),
	('m140506_102106_rbac_init', 1500206643),
	('m170716_133902_add_users', 1500320299);
/*!40000 ALTER TABLE `migration` ENABLE KEYS */;


-- Дамп структуры для таблица qiwi.request
CREATE TABLE IF NOT EXISTS `request` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `description` text,
  `status` varchar(50) DEFAULT '0',
  `result` text,
  `worked_by` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы qiwi.request: ~10 rows (приблизительно)
/*!40000 ALTER TABLE `request` DISABLE KEYS */;
INSERT INTO `request` (`id`, `name`, `description`, `status`, `result`, `worked_by`, `created_by`, `created_at`) VALUES
	(7, 'test', 'test', 'inreview', 'заявка заврешнеа', 6, 3, '2017-07-19 20:35:09'),
	(8, 'test2', 'test2', 'inreview', 'Сделал всё прекрасно', 4, 3, '2017-07-19 20:35:17'),
	(9, 'test3', 'test3', 'inreview', 'Сделал', 3, 4, '2017-07-19 20:35:43'),
	(10, 'test4', 'test4', 'inreview', 'ыфваываываыв', 4, 4, '2017-07-19 20:35:53'),
	(11, 'test4', 'test4', 'new', NULL, NULL, 4, '2017-07-19 20:36:01'),
	(12, 'sadfasd', 'fasdfsd', 'new', NULL, NULL, 4, '2017-07-19 20:40:19'),
	(13, 'sadfsdf', 'asdfsd', 'new', NULL, NULL, 4, '2017-07-19 20:40:25'),
	(14, 'sadfsdfsda', 'fsdafsdfsd', 'new', NULL, NULL, 4, '2017-07-19 20:40:36'),
	(15, 'asdfsd', 'fsdfsdf', 'new', NULL, NULL, 4, '2017-07-19 20:40:45'),
	(16, 'sadfasd', 'fsdfasdfsdf', 'inwork', NULL, 4, 4, '2017-07-19 20:40:51');
/*!40000 ALTER TABLE `request` ENABLE KEYS */;


-- Дамп структуры для таблица qiwi.request_history
CREATE TABLE IF NOT EXISTS `request_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `request_id` int(11) NOT NULL DEFAULT '0',
  `changed_by` int(11) DEFAULT NULL,
  `description` varchar(255) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы qiwi.request_history: ~7 rows (приблизительно)
/*!40000 ALTER TABLE `request_history` DISABLE KEYS */;
INSERT INTO `request_history` (`id`, `request_id`, `changed_by`, `description`, `created_at`) VALUES
	(1, 9, 3, 'Заявка переведена в статус "В работе"', '2017-07-19 23:19:09'),
	(2, 9, 3, 'Заявка переведена в статус "На проверке"', '2017-07-19 23:20:21'),
	(3, 8, 4, 'Заявка переведена в статус "В работе"', '2017-07-20 01:13:11'),
	(4, 10, 4, 'Заявка переведена в статус "В работе"', '2017-07-20 01:13:21'),
	(5, 8, 4, 'Заявка переведена в статус "На проверке"', '2017-07-20 01:15:55'),
	(6, 10, 4, 'Заявка переведена в статус "На проверке"', '2017-07-20 01:16:05'),
	(7, 16, 4, 'Заявка переведена в статус "В работе"', '2017-07-20 01:16:27');
/*!40000 ALTER TABLE `request_history` ENABLE KEYS */;


-- Дамп структуры для таблица qiwi.user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `surname` varchar(255) DEFAULT NULL,
  `middle_name` varchar(255) DEFAULT NULL,
  `role` varchar(50) DEFAULT NULL,
  `salt` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы qiwi.user: ~4 rows (приблизительно)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `login`, `password`, `name`, `surname`, `middle_name`, `role`, `salt`) VALUES
	(3, 'manager1', '82902c42095c91510266bdd64a287d3f', 'Андрей', 'Попов', 'Алексеевич', 'user', '596d122b57'),
	(4, 'manager2', '82902c42095c91510266bdd64a287d3f', 'Виктор', 'Семёнов', 'Андреевич', 'user', '596d122b57'),
	(5, 'admin', '82902c42095c91510266bdd64a287d3f', 'Роман', 'Станиславович', 'Пермитин', 'admin', '596d122b57'),
	(6, 'manager3', '82902c42095c91510266bdd64a287d3f', 'Сергей', 'Романович', 'Петров', 'user', '596d122b57');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
