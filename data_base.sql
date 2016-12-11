-- phpMyAdmin SQL Dump
-- version 4.4.15.7
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Дек 11 2016 г., 21:59
-- Версия сервера: 5.7.13-log
-- Версия PHP: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `vh26035_healthy_air_db`
--

-- --------------------------------------------------------

--
-- Структура таблицы `air_data`
--

CREATE TABLE IF NOT EXISTS `air_data` (
  `uid` int(11) NOT NULL,
  `station_id` int(11) NOT NULL,
  `t` double NOT NULL,
  `rh` double NOT NULL,
  `co2` int(11) NOT NULL,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `air_data`
--

INSERT INTO `air_data` (`uid`, `station_id`, `t`, `rh`, `co2`, `datetime`) VALUES
(2, 8, 24.341828, 35.312941, 1260, '2016-10-18 20:29:46'),
(2, 8, 24.547797, 43.455893, 1430, '2016-10-19 20:24:24'),
(2, 8, 20.376168, 46.407288, 990, '2016-10-19 20:24:33'),
(2, 8, 20.0483, 34.212736, 908, '2016-11-04 13:41:32'),
(2, 8, 20.376953, 34.91244, 826, '2016-11-04 14:55:53'),
(2, 8, 24.215026, 30.015176, 781, '2016-11-04 14:55:57'),
(2, 8, 20.015186, 36.813558, 1296, '2016-11-04 14:56:00'),
(2, 8, 24.709726, 49.372199, 846, '2016-11-04 14:56:04'),
(2, 8, 23.986176, 33.952509, 626, '2016-11-04 15:01:44'),
(2, 8, 23.718779, 35.953787, 1158, '2016-11-04 15:01:47'),
(2, 8, 24.01216, 47.973241, 652, '2016-11-04 15:01:53'),
(2, 8, 21.294948, 37.074504, 1388, '2016-11-04 15:01:58'),
(2, 8, 24.730571, 35.854032, 1281, '2016-11-04 16:07:11'),
(2, 8, 23.802735, 30.905113, 941, '2016-11-04 16:07:15'),
(2, 8, 24.978281, 44.392726, 1126, '2016-11-04 16:07:20'),
(2, 8, 24.025701, 42.225214, 908, '2016-11-04 16:07:23'),
(2, 8, 24.224112, 49.173599, 975, '2016-11-04 16:22:16'),
(2, 8, 21.209582, 37.45237, 1209, '2016-11-04 16:22:20'),
(2, 8, 22.925366, 46.669078, 1329, '2016-11-04 16:22:23'),
(2, 8, 23.278872, 34.51796, 714, '2016-11-04 16:22:25'),
(2, 8, 24.110237, 48.115727, 971, '2016-11-04 16:22:27'),
(2, 8, 22.416131, 44.731723, 784, '2016-11-04 16:22:29'),
(2, 8, 24.619789, 30.097014, 1033, '2016-11-04 16:22:39'),
(2, 8, 21.863908, 45.796692, 818, '2016-11-04 16:22:51'),
(2, 8, 21.647922, 41.608139, 1418, '2016-11-04 16:22:57'),
(2, 8, 22.076195, 40.296457, 839, '2016-11-04 16:22:59'),
(2, 8, 21.341641, 42.137025, 910, '2016-11-04 16:23:01'),
(2, 8, 22.694313, 33.268833, 636, '2016-11-04 16:23:03'),
(2, 8, 22.929471, 36.969558, 664, '2016-11-04 16:23:05'),
(2, 8, 22.968537, 43.206524, 946, '2016-11-04 17:08:54'),
(2, 8, 24.956809, 45.178222, 933, '2016-11-04 17:08:57'),
(2, 8, 20.2976, 48.775713, 949, '2016-11-04 17:24:57'),
(2, 8, 20.751047, 30.493665, 1148, '2016-11-04 17:25:12'),
(2, 8, 24.901661, 38.357834, 639, '2016-12-11 21:48:33'),
(2, 8, 22.531576, 40.623841, 1385, '2016-12-11 21:49:27');

-- --------------------------------------------------------

--
-- Структура таблицы `invites`
--

CREATE TABLE IF NOT EXISTS `invites` (
  `invite` text NOT NULL,
  `is_used` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `invites`
--

INSERT INTO `invites` (`invite`, `is_used`) VALUES
('10f25fb615788ff0985484f74a2c2f00', 1),
('0', 1),
('70685d61a223be135fc38a53d9ba7382', 1),
('201c50a82dfa81a6fa65b27630a2de19', 0),
('45cb632b4ca00eebe99345e8e0f238ad', 0),
('2782b63db74adad9f2f149d41c23eefc', 0),
('f06fa31dc12c3acf0384c5e2f7ef4594', 0),
('5a3287960479cee3b917dcbf17abe464', 0),
('4769ed150a0caf4ed5cd3ff471d1b977', 0),
('a05bf3d6e9c19ce1e892b21f84269f91', 0),
('10a601b9106f9c5d31e98528cb145410', 0),
('3fe17c805c55d7818ffe0d6b382d3608', 0),
('461efcc9d6b55a8643227b4240f986c3', 0),
('8a310933f060666d1303d2622a44450c', 0),
('8ccc28e587c6cc1353310873cb3b66f2', 0),
('684c8d1d318b63af257d171be010bf8d', 0),
('26fd77924fc5732ab376bbfe695f8b63', 0),
('60704d3e9c29ae4cf236f48826524be3', 0),
('25c99ac160765e9591479a2e06b08a28', 0),
('852068ef008c8fcf77845b398a20d6a1', 0),
('36f6cd014b01d1c64c230a76066d0222', 0),
('fc753361d2e401e96837d94e64788858', 0),
('c2e9d8d75ae4e3c565c1fa9774af88dc', 0),
('578010570b3e0dc18cf217a4dc171e88', 0),
('275a4ceee9455deab6e0b4aba110633b', 0),
('9628e5c13bc324c2037156b1d71938ce', 0),
('8413baebd7fa3a52702f46e314e93d1e', 0),
('8a796b86397b0818819e3f60398aaca9', 0),
('93232f4931f8b360a1a2230bc0857fdb', 0),
('2cbad874b5136d3abc0154a5652e27dc', 0),
('3150cdb554744e71cddb28dc77dfc53f', 0),
('18d1150127a671d44d3f3f66e2f2bc06', 0),
('52046e825d6c41bb8ba40c1f10e79d95', 0),
('cde59ff0095afac6c7fad1940b98a52c', 0),
('be006edb9cf93344d3d512e0452f1a28', 0),
('8b6d960ec2f0e8ecab0272d48846e31e', 0),
('af94d178d89a3de2afb9193544534340', 0),
('71087bc8409d6e27c7251d263d1b1252', 0),
('de63cd30e04c8522585b92bc9451e773', 0),
('879d6385301f40c89b2cf431c742b2e6', 0),
('80d0eaedda87a8ef890f7a7cc45ddfbb', 0),
('fe6893fa013d7ff17e782d01dcf717c7', 0),
('fab5794767f1b0eb0cd68a66eddd39bd', 0),
('446b9566ca821344e277cc43a19575b7', 0),
('4f856fd70dc8fbd9ead72f10b6f81efc', 0),
('247c3ec4f77bed7c5603cffb4a1c4955', 0),
('4b06016a8d6c6617ddabeb5049a75a2d', 0),
('9ac2dd41cf00fb29925185a615027e61', 0),
('8f56a31f7052cacb9f08c11d3d10cbf0', 0),
('8004de034609d532af5096b8c3331be0', 0),
('c02b87682c23e94040057e4b9d80408b', 0),
('5e05b9ee0304153fe45ac549abd166f4', 0),
('75850bc601eb997133778541dd277517', 0),
('6b467fcbfaa88e110f96ab32069a4887', 0),
('1892267e0e1721054de703ab30be6943', 0),
('d7ffcb10bf24d00d57d9740162cba132', 0),
('03a28cb84815bd37a49fb1d5492b8b08', 0),
('f494d55c7aa164c61a547b97606a5293', 0),
('7d8d45f577c24ab84f9176b5ad0ac5f3', 0),
('7d800b50262cd650b315abf6d3683b4b', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `room_categories`
--

CREATE TABLE IF NOT EXISTS `room_categories` (
  `category_id` int(11) NOT NULL,
  `category_name` text NOT NULL,
  `category_desc` text,
  `user_id` int(11) NOT NULL,
  `t_good_low` double NOT NULL,
  `t_good_high` double NOT NULL,
  `t_norm_low` double NOT NULL,
  `t_norm_high` double NOT NULL,
  `rh_good_low` double NOT NULL,
  `rh_good_high` double NOT NULL,
  `rh_norm_low` double NOT NULL,
  `rh_norm_high` double NOT NULL,
  `co2_good_high` double NOT NULL,
  `co2_norm_high` double NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `room_categories`
--

INSERT INTO `room_categories` (`category_id`, `category_name`, `category_desc`, `user_id`, `t_good_low`, `t_good_high`, `t_norm_low`, `t_norm_high`, `rh_good_low`, `rh_good_high`, `rh_norm_low`, `rh_norm_high`, `co2_good_high`, `co2_norm_high`) VALUES
(1, '1', 'Помещения 1-й категории: помещения, в которых люди в положении лежа или сидя находятся в состоянии покоя и отдыха.', -1, 20, 22, 18, 24, 30, 45, 30, 60, 400, 1000),
(2, '2', 'Помещения 2-й категории: помещения, в которых люди заняты умственным трудом, учебой.', -1, 19, 21, 18, 23, 30, 45, 30, 60, 400, 1000),
(3, '3а', 'Помещения 3а категории: помещения с массовым пребыванием людей, в которых люди находятся преимущественно в положении сидя без уличной одежды.', -1, 20, 21, 19, 23, 30, 45, 30, 60, 400, 1000),
(4, '3б', 'Помещения 3б категории: помещения с массовым пребыванием людей, в которых люди находятся преимущественно в положении сидя в уличной одежде.', -1, 14, 16, 12, 17, 30, 45, 30, 60, 400, 1000),
(5, '4', 'Помещения 4-й категории: помещения для занятий подвижными видами спорта.', -1, 17, 19, 15, 21, 30, 45, 30, 60, 400, 1000),
(6, '5', 'Помещения, в которых люди находятся в полураздетом виде (раздевалки, процедурные кабинеты, кабинеты врачей и т. п.).', -1, 20, 22, 20, 24, 30, 45, 30, 60, 400, 1000),
(7, '6', 'Помещения 6-й категории: помещения с временным пребыванием людей (вестибюли, гардеробные, коридоры, лестницы, санузлы, курительные, кладовые).', -1, 16, 18, 14, 20, 0, 100, 0, 100, 400, 1000);

-- --------------------------------------------------------

--
-- Структура таблицы `stations`
--

CREATE TABLE IF NOT EXISTS `stations` (
  `id` bigint(20) NOT NULL,
  `name` text NOT NULL,
  `user_id` text NOT NULL,
  `room_category` int(11) DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `stations`
--

INSERT INTO `stations` (`id`, `name`, `user_id`, `room_category`) VALUES
(8, 'station', '2', 1),
(9, 'station 1', '2', 1),
(10, 'station 2', '2', 7),
(11, 'station 3', '2', 1),
(20, '1', '2', 1),
(21, '2', '2', 1),
(22, '3', '2', 1),
(23, '4', '2', 1),
(24, '5', '2', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) NOT NULL,
  `email` text NOT NULL,
  `passwd_hash` text NOT NULL,
  `user_name` text NOT NULL,
  `max_measures` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `email`, `passwd_hash`, `user_name`, `max_measures`) VALUES
(2, 'muller95@yandex.ru', 'de677fded5c7d0923d25cee089968d69173f5b9c951b3e66134e94e0d6f2c154bddc2991b7c42314d5dd4bcc4f674cae156c45ee50091584247f871f5bb100ab', 'Вадим', 200),
(4, 'ro41-45@yandex.ru', 'de677fded5c7d0923d25cee089968d69173f5b9c951b3e66134e94e0d6f2c154bddc2991b7c42314d5dd4bcc4f674cae156c45ee50091584247f871f5bb100ab', 'Вадим', 200);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `room_categories`
--
ALTER TABLE `room_categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Индексы таблицы `stations`
--
ALTER TABLE `stations`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `room_categories`
--
ALTER TABLE `room_categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT для таблицы `stations`
--
ALTER TABLE `stations`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
