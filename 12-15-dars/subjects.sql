-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Время создания: Май 30 2020 г., 16:18
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
-- Структура таблицы `subjects`
--

CREATE TABLE `subjects` (
  `id` int(11) NOT NULL,
  `keyword` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `uz` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `ru` text COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `subjects`
--

INSERT INTO `subjects` (`id`, `keyword`, `uz`, `ru`) VALUES
(1, 'russian', 'Rus tili', 'Русский язык'),
(2, 'chinese', 'Xitoy tili', 'Китайский язык'),
(3, 'arabic', 'Arab tili', 'Арабский язык'),
(4, 'buxgalteriya', 'Buxgalteriya', 'Бухгалтерия'),
(5, 'pochemuchka', 'Pochemuchka', 'Почемучка'),
(6, 'chess', 'Shaxmat', 'Шахматы'),
(7, 'mental_arifmetika', 'Mental arifmetika', 'Ментальная арифметика'),
(8, 'drawing', 'Rassomlik', 'Рисование'),
(9, 'english', 'Ingliz tili', 'Английский язык'),
(11, 'physics', 'Fizika', 'Физика'),
(12, 'chemistry', 'Ximiya', 'Химия'),
(13, 'biology', 'Biologiya', 'Биология'),
(14, 'history', 'Tarix', 'История'),
(15, 'mother_language', 'Ona tili', 'Родной язык'),
(16, 'korean', 'Koreys tili', 'Корейский язык'),
(17, 'german', 'Nemis tili', 'Немецкий'),
(18, 'komputer', 'Kompyuter kurslari', 'Компьютерные курсы'),
(19, 'math', 'Matematika', 'Математика'),
(20, 'informatika', 'Informatika', 'Информатика'),
(21, 'japanese', 'Yapon tili', 'Японский язык'),
(22, 'turkish', 'Turk tili', 'Турецкий язык'),
(23, 'french', 'Fransuz tili', 'Французский язык');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `subjects_keyword_uindex` (`keyword`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
