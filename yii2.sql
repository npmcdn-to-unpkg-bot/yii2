-- phpMyAdmin SQL Dump
-- version 4.0.10.10
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Апр 17 2016 г., 22:41
-- Версия сервера: 5.5.45
-- Версия PHP: 5.5.28

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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `login`, `email`, `password_hash`, `status`, `id_usertype`) VALUES
(1, 'admin', 'admin@admi1n.admin', '$2y$13$L3RIHCTAIKlVqdMGxmspTeFwDmsrdSechoa7XnsfV.Nb0o1w61dvK', 10, ''),
(8, 'aaaaaaa1', 'aaaaaaa@aaaaa.aaa', '$2y$13$nswLmygeNS4DlCUKMMW.u.nmCVpsiN4Izds8JEbivNvo2imzchpxe', 10, ''),
(9, 'Admin123', 'Admin1231@aaaa.oi', '', 0, ''),
(10, 'qq', 'qq@aa.aa', '', 0, ''),
(11, 'Admin1232', 'Admin1231@aaaa.oi1', '', 0, ''),
(12, 'a111111111111', '111111@a.az', '', 32767, ''),
(13, 'Admin123123', 'aaaaaaaaaaaaaaaa@aaa.aaa', '$2y$13$vWSJ0dpWSP4.vupXylJHoevxbjR9tj8MTuvspSs1Bm.EOG916YEFq', 0, ''),
(14, 'qqqqqqqqqq2', 'aaaaaaaaa2aaaaaaa@aaa.aaa', '$2y$13$K4LUQXM81a54/cCkJj7CzOirDzoKjstq9Nv.AALN3RmxM7q8sxSbi', 0, ''),
(15, 'user', 'user@user.ru', '$2y$13$ZN8XBOr6JEUWlk8.bjZ4PO0XWwJpd9fWRPT.N.yHG1eOJkwofGeHa', 10, ''),
(16, 'user123', '2aaaaaaaaaaaaaaaa@aaa.aaa', '$2y$13$dzzeiDwQVvfRSwzsCKTGte4nX/pHX9VFCpOwa6sVRScVBdbGfi5hC', 10, ''),
(17, 'user1234', 'user1234@a.er', '$2y$13$XX7h0aQksu1riougCjjsUusIAnoAX4wUsSDGp1MOMZv6wXNuM/8.W', 10, 'Менеджер'),
(18, 'Admin12312', 'Admin21231@aaaa.oi', '$2y$13$LHK0jvAYeA.g1P/SQhb8xeaBypkhfFE4ktG5E3OxBUB7WwpVesnbS', 0, 'Менеджер'),
(19, 'Aaaaaaaaaaaaaaaaaaa', 'aaaaaaaaa2aaaaaaa@aaa.aaas', '$2y$13$UL3drqV8Bz5j6WAvjMc8neW323O7hvXphZqPhghI4ojM9E.mojVjC', 0, 'Менеджер'),
(20, 'A1231234', 'aaaaaaaaa2aaaaaaa@aaa2.aaas', '', 0, 'Менеджер'),
(21, 'Aadmin', 'aaaaaaaaaaa12aaaaa@aaa.aaa', '', 10, 'Менеджер'),
(22, 'admin1234', 'admin1234@as.as', '$2y$13$84Yzs9q9vRCSLdhao1mtMefDnxLPZaJ4admsWNZldqKfpaCWWC4Fa', 10, 'Менеджер');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
