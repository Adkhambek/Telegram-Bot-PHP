-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Время создания: Май 30 2020 г., 15:11
-- Версия сервера: 10.3.16-MariaDB
-- Версия PHP: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `id11985705_asostestbot`
--

-- --------------------------------------------------------

--
-- Структура таблицы `districts`
--

CREATE TABLE `districts` (
  `id` int(11) NOT NULL,
  `keyword` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `uz` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `ru` text COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `districts`
--

INSERT INTO `districts` (`id`, `keyword`, `uz`, `ru`) VALUES
(1, 'yunusobod', 'Yunusobod tumani', 'Юнусабаский район'),
(2, 'mirzo_ulugbek', 'Mirzo Ulug\'bek tumani', 'Мирзо Улугбекский район'),
(3, 'chilonzor', 'Chilonzor tumani', 'Чиланзарский район'),
(4, 'yashnaobod', 'Yashnaobod tumani', 'Яшнабадский район'),
(5, 'uchtepa', 'Uchtepa tumani', 'Учтепинский район'),
(6, 'olmazor', 'Olmazor tumani', 'Алмазарский район\r\n'),
(7, 'qibray', 'Qibray tumani', 'Кибрайский район'),
(8, 'shayxontoxur', 'Shayxontohur tumani', 'Шайхантахурский район'),
(9, 'yakkasaroy', 'Yakkasaroy tumani', 'Яккасарайский район'),
(10, 'mirobod', 'Mirobod tumani', 'Мирабадский район'),
(11, 'bektemir', 'Bektemir tumani', 'Бектемирский район'),
(12, 'sergeli', 'Sergeli tumani', 'Сергелийский район');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `districts`
--
ALTER TABLE `districts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `districts_keyword_uindex` (`keyword`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `districts`
--
ALTER TABLE `districts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
