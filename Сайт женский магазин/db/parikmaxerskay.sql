-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Авг 07 2024 г., 05:46
-- Версия сервера: 10.4.32-MariaDB
-- Версия PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `parikmaxerskay`
--

-- --------------------------------------------------------

--
-- Структура таблицы `brands`
--

CREATE TABLE `brands` (
  `id` int(11) NOT NULL,
  `brand` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `brands`
--

INSERT INTO `brands` (`id`, `brand`) VALUES
(1, 'PROMOZER'),
(0, 'PROMOZER2'),
(2, 'PROMOZER2'),
(2, 'Harizma');

-- --------------------------------------------------------

--
-- Структура таблицы `parimaxer`
--

CREATE TABLE `parimaxer` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `descripton` text NOT NULL,
  `count` int(10) NOT NULL,
  `image` text NOT NULL,
  `brand` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `parimaxer`
--

INSERT INTO `parimaxer` (`id`, `name`, `descripton`, `count`, `image`, `brand`) VALUES
(0, 'Плойка, но от другого бренда', 'описание12', 5000, '1.jpg', 'Promozer'),
(3, 'Harizma MEGA Curl h1544DF', 'Плойка другая и от другого бренда ', 15000, 'ploika3.jpg', 'Harizma'),
(0, 'Плойка, но от другого бренда', 'описание12', 5000, '1.jpg', 'Promozer'),
(0, 'Плойка, но от другого бренда	', 'Harizma MEGA Curl h1544DF', 10000, '1.jpg', 'Promozer');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
