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
-- База данных: `games`
--

-- --------------------------------------------------------

--
-- Структура таблицы `game`
--

CREATE TABLE `game` (
  `id` int(11) NOT NULL,
  `image` text NOT NULL,
  `description` text NOT NULL,
  `game` text NOT NULL,
  `ganre` text NOT NULL,
  `count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `game`
--

INSERT INTO `game` (`id`, `image`, `description`, `game`, `ganre`, `count`) VALUES
(1, 'game1.jpg', 'Очень увлекательная стратегическая игра!', 'DOTA 3', 'Стратегия', 0),
(2, 'game2.jpg', 'Увлекательная стрелялка', 'Csgo', 'Шутер', 500),
(3, 'game3.jpg', 'Крутая стрелялка с монстрами', 'DOOM', 'Шутер', 500),
(4, 'game4.jpg', 'Кубическая игра для детей ', 'roblox', 'Песочница', 1000);

-- --------------------------------------------------------

--
-- Структура таблицы `ganres`
--

CREATE TABLE `ganres` (
  `id` int(11) NOT NULL,
  `ganre` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `ganres`
--

INSERT INTO `ganres` (`id`, `ganre`) VALUES
(1, 'Стратегия'),
(2, 'Шутер'),
(3, 'Песочница');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
