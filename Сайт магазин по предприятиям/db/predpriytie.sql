-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Авг 07 2024 г., 06:03
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
-- База данных: `predpriytie`
--

-- --------------------------------------------------------

--
-- Структура таблицы `predpri`
--

CREATE TABLE `predpri` (
  `id` int(11) NOT NULL,
  `image` text NOT NULL,
  `descripton` text NOT NULL,
  `region` text NOT NULL,
  `name` text NOT NULL,
  `count_E_R` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `predpri`
--

INSERT INTO `predpri` (`id`, `image`, `descripton`, `region`, `name`, `count_E_R`) VALUES
(3, '1.jpg', 'Занимаются производством в Москве', 'Москва', 'Агростроймонтаж-12', 123000),
(4, '1.jpg', 'Занимаемся производством в Москве', 'Москва', 'Агростроймонтаж-1', 123000),
(5, '3.jpg', 'Занимаются производством в Сибири ', 'Сибирь', 'Агростроймонтаж-3', 100000),
(0, '1.jpg', 'крутой', 'Москва', 'завод', 100000);

-- --------------------------------------------------------

--
-- Структура таблицы `regions`
--

CREATE TABLE `regions` (
  `id` int(11) NOT NULL,
  `region` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `regions`
--

INSERT INTO `regions` (`id`, `region`) VALUES
(1, 'Москва'),
(2, 'Санкт-Петербург'),
(3, 'Сибирь');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
