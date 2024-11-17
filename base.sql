-- phpMyAdmin SQL Dump
-- version 
-- http://www.phpmyadmin.net
--
-- Хост: u429579.mysql.masterhost.ru
-- Время создания: Май 07 2015 г., 22:17
-- Версия сервера: 5.5.35
-- Версия PHP: 5.4.4-14+deb7u14

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";  
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `u429579_16`
--

-- --------------------------------------------------------

--
-- Структура таблицы `req`
--

CREATE TABLE IF NOT EXISTS `req` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `dstart` bigint(14) NOT NULL,
  `dend` bigint(14) NOT NULL,
  `status` smallint(1) NOT NULL,
  `uid` bigint(20) NOT NULL,
  `p` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=9 ;

--
-- Дамп данных таблицы `req`
--

INSERT INTO `req` (`id`, `name`, `dstart`, `dend`, `status`, `uid`, `p`) VALUES
(1, 'Тестирование планировщика задач', 1429052403, 1429059603, 1, 12, 0),
(2, 'Система для заказов (mysql)', 1428753622, 1428771622, 0, 12, 0),
(3, 'Задача 3', 1430469353, 1430807153, 0, 12, 0),
(4, 'Задача 2', 1430454933, 1431680133, 0, 12, 10),
(5, 'Задача 1', 1430843125, 1431604225, 0, 14, 1),
(6, 'Задача 5', 1430748014, 1431959415, 0, 12, 0),
(7, 'Задача на июнь', 1433120431, 1433898031, 0, 12, 0),
(8, 'Задача 9', 1435712406, 1438437726, 2, 13, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) NOT NULL,
  `pwd` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=16 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `pwd`, `name`, `status`) VALUES
(12, 'user9', 'user9', 'Петров Василий Сергеевич ', 'Менеджер'),
(13, 'user1', 'user1', 'Сергеев Алексей Иванович', 'Менеджер'),
(14, 'user2', 'user2', 'Иванов Иван Иванович', 'Менеджер'),
(15, 'user3', 'user2', 'Иванов Сергей', 'менеджер');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
