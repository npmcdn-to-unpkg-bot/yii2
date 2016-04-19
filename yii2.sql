-- phpMyAdmin SQL Dump
-- version 4.0.10.10
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Апр 19 2016 г., 11:24
-- Версия сервера: 5.6.26
-- Версия PHP: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `yii2`
--

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `status` smallint(6) NOT NULL,
  `id_usertype` varchar(255) NOT NULL,
  `auth_key` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `login`, `email`, `password_hash`, `status`, `id_usertype`, `auth_key`) VALUES
(1, 'admin', 'admin@admin.admin', '$2y$13$L3RIHCTAIKlVqdMGxmspTeFwDmsrdSechoa7XnsfV.Nb0o1w61dvK', 1, 'Администратор', ''),
(2, 'user', 'user@user.user', '$2y$13$vWSJ0dpWSP4.vupXylJHoevxbjR9tj8MTuvspSs1Bm.EOG916YEFq', 0, 'Менеджер', ''),
(3, 'user1', 'user1@user.user', '$2y$13$K4LUQXM81a54/cCkJj7CzOirDzoKjstq9Nv.AALN3RmxM7q8sxSbi', 0, 'Оператор', ''),
(4, 'user2', 'user2@user.user', '$2y$13$ZN8XBOr6JEUWlk8.bjZ4PO0XWwJpd9fWRPT.N.yHG1eOJkwofGeHa', 10, 'Менеджер', '');


