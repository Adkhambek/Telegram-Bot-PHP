-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Июн 25 2020 г., 12:23
-- Версия сервера: 5.7.21-20-beget-5.7.21-20-1-log
-- Версия PHP: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `bunnypeace_getfo`
--

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--
-- Создание: Май 31 2020 г., 17:07
-- Последнее обновление: Июн 25 2020 г., 08:53
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `uz` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `ru` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `uz`, `ru`) VALUES
(28, '🥃Choy va ☕️ coffee', NULL),
(29, '🍹 suv va ichimliklar', NULL),
(30, '🌻O\'simlik yog\'i', NULL),
(31, '🍖Go\'sht mahsulotlari', NULL),
(33, '🍞 non va non mahsulotlari', NULL),
(34, '🥛Sut va sut mahsulotlari', NULL),
(35, '🍚Don mahsulotlari', NULL),
(37, '🍼Bolalar uchun', NULL),
(38, '🥚Tuxumlar', NULL),
(40, '🍶Tuzlar', NULL),
(41, '📕 Kitoblar', NULL),
(42, '🧼Yuvish vositalari', NULL),
(43, '🥫Konserva mahsulotlari', NULL),
(44, '🧴gigiena', NULL),
(45, '🍫Shirinliklar', NULL),
(46, '🍟Chipslar/ Semechka / Popcorn', NULL),
(47, '🍝 makaron / 🍥un / 🍬shakar', NULL),
(48, '🥫Tomatlar', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--
-- Создание: Июн 04 2020 г., 13:24
-- Последнее обновление: Июн 24 2020 г., 22:17
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `uz` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `ru` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `categoryId` varchar(255) DEFAULT NULL,
  `options` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `info` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `photoUrl` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `uz`, `ru`, `categoryId`, `options`, `info`, `photoUrl`) VALUES
(64, 'Coca cola', NULL, '29', '[{\"name\":\"Coca cola 1.5L\",\"price\":\"8000 so\'m\"},{\"name\":\"Coca cola 1L\",\"price\":\"6000 so\'m\"},{\"name\":\"Coca cola 0.5L\",\"price\":\"4500 so\'m\"}]', 'Kuchli gazlangan ichimlik', 'photos/3.jpg'),
(67, 'Pepsi', NULL, '29', '[{\"name\":\"Pepsi 1.5L\",\"price\":\"8000 so\'m\"},{\"name\":\"Pepsi 1L\",\"price\":\"6000 so\'m\"},{\"name\":\"Pepsi 0.5L\",\"price\":\"4500 so\'m\"}]', 'Gazlangan ichimlik', 'photos/6.jpg'),
(68, 'RC Cola', NULL, '29', '[{\"name\":\"RC Cola 1.5L\",\"price\":\"8000 so\'m\"},{\"name\":\"RC Cola 1L\",\"price\":\"6000 so\'m\"},{\"name\":\"RC Cola 0.5L\",\"price\":\"4000 so\'m\"}]', 'Gazlangan ichimlik', 'photos/8.jpg'),
(69, 'Fanta orange', NULL, '29', '[{\"name\":\"Fanta 1.5L\",\"price\":\"8000 so\'m\"},{\"name\":\"Fanta 1L\",\"price\":\"6500\"},{\"name\":\"Fanta 0.5L\",\"price\":\"4500\"}]', 'Kuchli gazlangan ichimlik', 'photos/9.jpg'),
(71, 'Flash energy', NULL, '29', '[{\"name\":\"Flash 0.25L\",\"price\":\"5500\"},{\"name\":\"Flash 0.33L\",\"price\":\"6000\"},{\"name\":\"Flash 0.5L\",\"price\":\"7000\"}]', 'Alkogolsiz quvvat beruvchi gazlangan ichimlik', 'photos/11.jpg'),
(72, '7up ichimlik', NULL, '29', '[{\"name\":\"7up 1.5L\",\"price\":\"8000\"},{\"name\":\"7up 1L\",\"price\":\"6000\"},{\"name\":\"7up 0.5L\",\"price\":\"4500\"}]', '7up ichimligi gazlangan', 'photos/12.jpg'),
(73, 'Mirinda', NULL, '29', '[{\"name\":\"Mirinda 1.5L\",\"price\":\"8000\"},{\"name\":\"Mirinda 1L\",\"price\":\"6000\"},{\"name\":\"Mirinda 0.5L\",\"price\":\"4500\"}]', 'Mirinda alkogolsiz gazlangan ichimlik', 'photos/13.jpg'),
(74, 'Nestle', NULL, '29', '[{\"name\":\"Nestle 1.5L\",\"price\":\"2500\"},{\"name\":\"Nestle 1L\",\"price\":\"2000\"},{\"name\":\"Nestle 0.5L\",\"price\":\"1500\"}]', 'Gazlanmagan ichimlik', 'photos/14.jpg'),
(75, 'Hydrolife', NULL, '29', '[{\"name\":\"Hydrolife 1.5L\",\"price\":\"2500\"},{\"name\":\"Hydrolife 1L\",\"price\":\"2000\"},{\"name\":\"Hydrolife 0.5L\",\"price\":\"1500\"}]', 'Gazlangan ichimlik', 'photos/15.jpg'),
(76, 'Hydrolife gazsiz', NULL, '29', '[{\"name\":\"Hydrolife 10L\",\"price\":\"8500\"},{\"name\":\"Hydrolife 5L\",\"price\":\"5500\"},{\"name\":\"Hydrolife 1.5L\",\"price\":\"2500\"},{\"name\":\"Hydrolife 1L\",\"price\":\"2000\"},{\"name\":\"Hydrolife 0.5L\",\"price\":\"1500\"}]', 'Gazlanmagan tog\' eco suvi', 'photos/16.jpg'),
(77, 'Red bull', NULL, '29', '[{\"name\":\"Red bull 250ml\",\"price\":\"17000\"},{\"name\":\"Red bull 330ml\",\"price\":\"23500\"}]', 'Energetik ichimlik', 'photos/17.jpg'),
(78, 'Buxanka ( oddiy )', NULL, '33', '[{\"name\":\"Buxanka\",\"price\":\"1700\"}]', 'Oddiy buxanka', 'photos/18.jpg'),
(80, 'Bunge pro', NULL, '30', '[{\"name\":\"1L\",\"price\":\"12000\"},{\"name\":\"5L\",\"price\":\"60000\"}]', 'O\'simlik yog\'i', 'photos/20.jpg'),
(81, 'Ideal', NULL, '30', '[{\"name\":\"1L\",\"price\":\"14000\"},{\"name\":\"2L\",\"price\":\"28000\"}]', 'O\'simlik yog\'i', 'photos/21.jpg'),
(82, 'Zateya', NULL, '30', '[{\"name\":\"1L\",\"price\":\"14000\"},{\"name\":\"1.8L\",\"price\":\"27000\"},{\"name\":\"5L\",\"price\":\"70000\"}]', 'O\'simlik yog\'i', 'photos/22.jpg'),
(83, 'Oleyna', NULL, '30', '[{\"name\":\"1L\",\"price\":\"14000\"},{\"name\":\"2L\",\"price\":\"27000\"},{\"name\":\"3L\",\"price\":\"42000\"},{\"name\":\"5L\",\"price\":\"68000\"}]', 'Qayta ishlangan Kungaboqor yog\'i', 'photos/23.jpg'),
(84, 'Крупная Соль', NULL, '40', '[{\"name\":\"1kg\",\"price\":\"3000\"},{\"name\":\"3kg\",\"price\":\"7000\"}]', 'Yo\'dlangan osh tuzi', 'photos/24.jpg'),
(85, 'Orzu osh tuzi', NULL, '40', '[{\"name\":\"1kg\",\"price\":\"3000\"},{\"name\":\"3kg\",\"price\":\"7000\"}]', 'Birinchi nav tuz', 'photos/25.jpg'),
(86, 'Аведовь', NULL, '30', '[{\"name\":\"1L\",\"price\":\"14000\"},{\"name\":\"5L\",\"price\":\"65000\"}]', 'Kungaboqor yog\'i', 'photos/26.jpg'),
(87, 'Guruch', NULL, '35', '[{\"name\":\"Nukus\",\"price\":\"8000\"},{\"name\":\"Alanga zo\'r\",\"price\":\"12000\"},{\"name\":\"Lazir\",\"price\":\"16000\"},{\"name\":\"Alanga\",\"price\":\"11000\"}]', 'Guruchlar 4 xil', 'photos/27.jpg'),
(88, 'Нежинское', NULL, '30', '[{\"name\":\"1L\",\"price\":\"11000\"},{\"name\":\"5L\",\"price\":\"53000\"}]', 'Birinchi nav o\'simlik yog\'i', 'photos/28.jpg'),
(90, 'Sut mahsulotlari', NULL, '34', '[{\"name\":\"Sut\",\"price\":\"6000\"},{\"name\":\"Qattiq\",\"price\":\"9000\"},{\"name\":\"Qaymoq\",\"price\":\"40000\"},{\"name\":\"Tvarog\",\"price\":\"18000\"},{\"name\":\"Yogurd\",\"price\":\"24000\"},{\"name\":\"Brinza 1Kg\",\"price\":\"45000\"},{\"name\":\"Suzma 1kg\",\"price\":\"16000\"}]', 'Sut\nQattiq\nQaymoq\nTvarog\nYogurd\nBirinza \nSuzma', 'photos/31.jpg'),
(91, 'Kofe Jacobs Gold 95g', NULL, '28', '[{\"name\":\"Jacobs Gold 95g\",\"price\":\"51000\"}]', 'Muvozanatli ta\\\'m', 'photos/33.jpg'),
(92, 'Kofe Jacobs Monarch klassik 230g', NULL, '28', '[{\"name\":\"Jacobs Monarch klassik 230g\",\"price\":\"56000\"}]', 'Muvozanatli ta\'m', 'photos/34.jpg'),
(93, 'Kofe Jacobs Monarch klassik 500g', NULL, '28', '[{\"name\":\"Jacobs Monarch klassik 500g\",\"price\":\"110000\"}]', 'Muvozanatli ta\'m', 'photos/35.jpg'),
(94, 'Kofe Nescafe classic 500g', NULL, '28', '[{\"name\":\"Kofe Nescafe classic 500g\",\"price\":\"90000\"}]', 'Yangi ta\'m va aromat', 'photos/36.jpg'),
(95, 'Kofe Nescafe Classic 47,5g', NULL, '28', '[{\"name\":\"Nescafe Classic 47,5g\",\"price\":\"17000\"}]', 'Shishali qadoqda', 'photos/37.jpg'),
(96, 'Kofe Nescafe Classic 95g', NULL, '28', '[{\"name\":\"Nescafe Classic 95g\",\"price\":\"19000\"}]', 'Shishali qadoqda', 'photos/38.jpg'),
(97, 'Kofe MacCoffee 3 in 1', NULL, '28', '[{\"name\":\"Maccoffee 20g\",\"price\":\"1500\"}]', 'Qahva ichimligi Maccoffee 3tasi1da 20g', 'photos/39.jpg'),
(98, 'Kofe Nescafe gold 47.5g', NULL, '28', '[{\"name\":\"Nescafe Gold 47.5g\",\"price\":\"20000\"}]', 'Shishali qadoqda', 'photos/40.jpg'),
(99, 'Kofe Nescafe Gold 75g', NULL, '28', '[{\"name\":\"Kofe Nescafe Gold 75g\",\"price\":\"20000\"}]', 'Yumshoq qadoqda Nafis ta\'m', 'photos/41.jpg'),
(100, 'Kofe Nescafe Gold 150g', NULL, '28', '[{\"name\":\"Nescafe Gold 150g\",\"price\":\"39000\"}]', 'Yumshoq qadoqda Nafis ta\'m', 'photos/42.jpg'),
(101, 'Kofe MacCoffee Gold 75g', NULL, '28', '[{\"name\":\"MacCoffee Gold 75g\",\"price\":\"19000\"}]', 'Yumshoq qadoqda', 'photos/43.jpg'),
(102, 'Kofe Nescafe Gold 250g', NULL, '28', '[{\"name\":\"Nescafe Gold 250g\",\"price\":\"61000\"}]', 'Yumshoq qadoqda Nafis ta\'m', 'photos/44.jpg'),
(103, 'Kofe Nescafe Gold 100g', NULL, '28', '[{\"name\":\"Nescafe Gold 100g\",\"price\":\"23000\"}]', 'Yumshoq qadoqda Nafis ta\'m', 'photos/45.jpg'),
(104, 'Kofe Nescafe Gold Barista 75g', NULL, '28', '[{\"name\":\"Nescafe Gold Barista 75g\",\"price\":\"21000\"}]', '100% tabiiy qahva maydalangan eruvchan', 'photos/46.jpg'),
(105, 'Ko\'k choy Tudor paketli 50g', NULL, '28', '[{\"name\":\"Tudor 50g\",\"price\":\"12000\"}]', 'Ko\'k choy paketli', 'photos/47.jpg'),
(106, 'Ko\'k choy Tudor bargli 250g', NULL, '28', '[{\"name\":\"Tudor bargli 250g\",\"price\":\"38000\"}]', 'Ko\'k choy Tudor bargli', 'photos/48.jpg'),
(107, 'Ko\'k choy Toza №95 bargli 80g', NULL, '28', '[{\"name\":\"Toza №95 bargli 80g\",\"price\":\"5500\"}]', 'Toza №95 bargli', 'photos/49.jpg'),
(108, 'Ko\'k choy Ahmad tea Grean tea bargli 100g', NULL, '28', '[{\"name\":\"Grean tea\",\"price\":\"21000\"}]', 'Ahmad tea ko\'k choyi', 'photos/50.jpg'),
(109, 'Ko\'k choy Ahmad tea Gunpowder Grean tea bargli 100g', NULL, '28', '[{\"name\":\"Gunpowder 100g\",\"price\":\"20000\"}]', 'Ahmad tea Gunpowder Grean choyi', 'photos/51.jpg'),
(110, 'Makfa makaron 450g', NULL, '39', '[{\"name\":\"Banitik\",\"price\":\"13000\"},{\"name\":\"Speral\",\"price\":\"13000\"},{\"name\":\"Rashkiy\",\"price\":\"13000\"},{\"name\":\"Qochqor\",\"price\":\"13000\"},{\"name\":\"Turbichka\",\"price\":\"13000\"},{\"name\":\"Vermishel\",\"price\":\"13000\"},{\"name\":\"Spaghetti\",\"price\":\"13000\"},{\"name\":\"Lapsha\",\"price\":\"13000\"},{\"name\":\"Salomka\",\"price\":\"13000\"}]', 'Makfa makaron turlari\nBanitik ✔️\nSperal ✔️\nRashkiy ✔️\nQochqor ✔️\nTurbichka ✔️\nVermishel ✔️\nSpagetti ✔️\nLapsha ✔️\nSalomka\n🇺🇿 O\'zbekistonda ishlab chiqarilgan', 'photos/52.jpg'),
(113, 'Makfa 450g', NULL, '39', '[{\"name\":\"Bantik\",\"price\":\"13000\"},{\"name\":\"Speral\",\"price\":\"13000\"},{\"name\":\"Rashkiy\",\"price\":\"13000\"},{\"name\":\"Qochqor\",\"price\":\"13000\"},{\"name\":\"Turbichka\",\"price\":\"13000\"},{\"name\":\"Vermishel\",\"price\":\"13000\"},{\"name\":\"Spagetti\",\"price\":\"13000\"},{\"name\":\"Lapsha\",\"price\":\"13000\"},{\"name\":\"Salomka\",\"price\":\"13000\"}]', 'Makiz makaron turlari\nBanitik ✔️\nSperal ✔️\nRashkiy ✔️\nQochqor ✔️\nTurbichka ✔️\nVermishel ✔️\nSpagetti ✔️\nLapsha ✔️\nSalomka\n🇺🇿 O\'zbekistonda ishlab chiqarilgan', 'photos/56.jpg'),
(114, 'Qora choy Greenfield English Edition', NULL, '28', '[{\"name\":\"English Edition\",\"price\":\"16000\"},{\"name\":\"Golden Ceylon\",\"price\":\"16000\"}]', 'Nafis ta\'m', 'photos/58.jpg'),
(115, 'Ko\'k choy Exclusive 8008 / 8810', NULL, '28', '[{\"name\":\"8008\",\"price\":\"8000\"},{\"name\":\"8810\",\"price\":\"8000\"},{\"name\":\"Oolong\",\"price\":\"9000\"},{\"name\":\"Jasmine\",\"price\":\"8500\"}]', 'Nafis ta\'m', 'photos/59.jpg'),
(116, 'Tess chay', NULL, '28', '[{\"name\":\"Flirt\",\"price\":\"14000\"},{\"name\":\"Lime\",\"price\":\"14500\"},{\"name\":\"Style\",\"price\":\"15000\"}]', 'Nafis ta\'m', 'photos/61.jpg'),
(117, 'Buon Gusto', NULL, '39', '[{\"name\":\"Bantik\",\"price\":\"14000\"}]', 'Buon Gusto\n\nBuon Gusto makaron turlari\nBanitik ✔️\nSperal ✔️\nRashkiy ✔️\nQochqor ✔️\nTurbichka ✔️\nVermishel ✔️\nSpagetti ✔️\nLapsha ✔️\nSalomka', 'photos/62.jpg'),
(118, 'Xorazm shakar', NULL, '47', '[{\"name\":\"1kg\",\"price\":\"6500\"}]', 'Kristal Shakar\n|||-toifa\nSaqlash muddati 4yil', 'photos/63.jpg'),
(119, 'Makfa makaron rakushka', NULL, '47', '[{\"name\":\"Narhi\",\"price\":\"7000\"}]', 'Makfa judayam mazali', 'photos/64.jpg'),
(120, 'Колбаса Андалус докторская', NULL, '31', '[{\"name\":\"1Кг\",\"price\":\"45000\"}]', 'Состав: говядина, мясо птицы, куриная кожа менее 15%, яйцо, сливочное масло, крахмал (мука), белок, соль, специи, нитрит натрия.', 'photos/65.jpg'),
(121, 'Сосиски молочные екстра Ширин', NULL, '31', '[{\"name\":\"1кг\",\"price\":\"44500\"}]', 'Состав: говядина, мясо птицы, подсолнечное масло, сливочное масло, сухое молоко, соевый белок, яйца, крахмал, соль, специи, нитрит натрия,\n\nПищевая ценность в 100г: жиры – 16 г, белки – 12 г\n\nЭнергетическая ценность 192 кКал', 'photos/66.jpg'),
(122, 'сосиски егерские с сыром Ширин', NULL, '31', '[{\"name\":\"1кг\",\"price\":\"53550\"}]', 'Сосиски', 'photos/67.jpg'),
(123, 'Егерские сосиски Ширин', NULL, '31', '[{\"name\":\"1кг\",\"price\":\"52000\"}]', 'СРОК ХРАНЕНИЯ:\n\nХранить при температуре +2+6 градусов при относительной влажности воздуха 75-78% не более 20 суток.\n\nЭНЕРГЕТИЧЕСКАЯ ЦЕННОСТЬ:\n\n231 Ккал. Жиры - 19 г., белки - 15 г.\n\nО продукте:\n\nРецептура \"Егерских\" сосисок Sherin основана на истории знаменитых егерских колбасок. Немецкие егери (то есть, охотники) заготавливали колбаски из мяса кабанов прямо на охоте и коптили их над костром. \"Егерские\" сосиски в исполнении Sherin - это оптимизированная версия традиционного немецкого рецепта - мягкая текстура измельчённого мяса с явными нотками копчения, но без содержания свинины.', 'photos/68.jpg'),
(124, 'Makfa makaron bantiki 400g', NULL, '47', '[{\"name\":\"Bantik\",\"price\":\"7000\"}]', 'Макароны Макфа являются энергетически ценным пищевым продуктом. Изготовленные из высококачественной муки грубого помола, макаронные бантики имеют привлекательную цельную форму и обладают гармоничным и насыщенным вкусом. Подавать со сливочным, грибным или томатным соусом и сыром.\n\nСостав:\n\nМука из твердых сортов пшеницы, вода, соль. Витамины В1, В 2, РР, клетчатку, клейковину, макро и микроэлементы.\n\nПищевая ценность на 100г продукта: белки 11г, жиры 1,1г, углеводы 71,5г.\n\nЭнергетическая ценность на 100г продукта: 344ккал.', 'photos/69.jpg'),
(125, 'Makfa Lapsha 400g', NULL, '47', '[{\"name\":\"Lapsha\",\"price\":\"7000\"}]', 'Lapsha', 'photos/70.jpg'),
(126, 'Makfa speral 400g', NULL, '47', '[{\"name\":\"Speral\",\"price\":\"7000\"}]', 'Вес: 400 г.\nКалорийность: 338 Ккал / кДж на 100 г.\nБ/Ж/У: 11 / 1.3 / 70.5\n\nСостав: мука из твердой пшеницы для макаронных изделий высшего сорта, вода питьевая', 'photos/71.jpg'),
(127, 'Makfa rashkiy 400g', NULL, '47', '[{\"name\":\"Rashki\",\"price\":\"7500\"}]', 'Вес: 400 г.\nКалорийность: 338 Ккал / кДж на 100 г.\nБ/Ж/У: 11 / 1.3 / 70.5\n\nСостав: мука из твердой пшеницы для макаронных изделий высшего сорта, вода питьевая', 'photos/72.jpg'),
(128, 'Pringles Xtra Cheesy Nacho Cheese 150g', NULL, '46', '[{\"name\":\"Pringles Xtra Cheesy\",\"price\":\"25500\"}]', 'Пищевая и энергетическая ценности\n\nЖиры, г/100г32Белки, г/100г4.3Углеводы, г/100г51Энергетическая ценность, ккал/100г505', 'photos/73.jpg'),
(129, 'Chips Pringles Mushroom&Cream 165 г', NULL, '46', '[{\"name\":\"Mushroom&Cream\",\"price\":\"26000\"}]', 'Пищевая ценность на 100 г\n\nБелки4,5 г\n\nЖиры 31 г\n\nУглеводы 56 г\n\nКалорийность 527 Ккал', 'photos/74.jpg'),
(130, 'Нестле мультизлаковая каша 9 месяцев', NULL, '37', '[{\"name\":\"мультизлаковая каша\",\"price\":\"25000\"}]', 'Тип\n\nмолочная мультизлаковая каша\n\nРекомендуемый возраст\n\nс 9 месяцев\n\nНе требует варки да\n\nДобавки мед\n\nФрукты абрикос\n\nОсобенности\n\nне содержит соли, сахара, пальмового масла, искусственных ароматизаторов, искусственных красителей, консервантов, загустителей\n\nУпаковка\n\nмягкая\n\nВес 220 г\n\nСостав\n\nСостав\n\nмука (60,7 %) ( пшеничная (50,5 %) (содержит глютен), мука гречневая (3.4%), мука овсяная (3.4%) (содержит глютен), мука рисовая (1.7%), мука кукурузная (1.7%)), молоко сухое обезжиренное (22%), низкоэруковое рапсовое масло, подсолнечное масло, кусочки абрикоса (2.5%), мед (2.5%), минеральные вещества (кальция карбонат, железа (II) фумарат, цинка сульфат, йодид калия), витамины (С (L- аскорбиновая кислота, аскорбилпальмитат), E (DL-альфа-токоферола ацетат, DL-альфа токоферол), РР (никотинамид), B5 (D-пантотенат кальция), A (ретинола ацетат), В1 (тиамина мононитрат), В6 (пиридоксин гидрохлорид), В2 (рибофлавин), B9 ( фолиевая кислота), D (D3 холекальциферол)), бифидобактерии не менее 1х10⁶ КОЕ/г\n\nЭнергетическая ценность\n\n425 ккал/100 грамм', 'photos/75.jpg'),
(131, 'Makfa turbichka 400g', NULL, '47', '[{\"name\":\"Turbichka\",\"price\":\"7000\"}]', 'Формула продукта:\nУниверсальный формат; Полезный состав; Группа, А; Высший сорт; Натуральное сырье; Без ГМО; ГОСТ; Короткий формат;\n\nЧто приготовить:\nДетские блюда; Вегетарианские блюда; Диетические блюда; Постные блюда;\n\nКБЖУ на 100 г сухого продукта:\n344 Ккал; углеводы — 70,5 г ; пищевые волокна — 3,7 г; белки — 12,5 г; жиры — 1,3 г ;\nВитамины: РР — 1,2 мг; В1 — 0,17 мг;\nМакро- и микроэлементы: Р — 87,0 мг; Fe — 1,6 мг;', 'photos/76.jpg'),
(132, 'Ittifoq tomat 1L', NULL, '48', '[{\"name\":\"Tomat\",\"price\":\"19000\"}]', 'Tomat pastasi', 'photos/77.jpg'),
(133, 'Ittifoq tomat 400g', NULL, '48', '[{\"name\":\"Tomat\",\"price\":\"11000\"}]', 'Tomat pastasi', 'photos/78.jpg'),
(134, 'Salça tomat', NULL, '48', '[{\"name\":\"1L\",\"price\":\"20000\"},{\"name\":\"400g\",\"price\":\"11000\"}]', 'Tomat pastasi judayam zo\'r', 'photos/79.jpg'),
(135, 'Алтын Дан пакетли', NULL, '47', '[{\"name\":\"1кг\",\"price\":\"7500\"},{\"name\":\"2кг\",\"price\":\"15000\"},{\"name\":\"3кг\",\"price\":\"23000\"},{\"name\":\"5кг\",\"price\":\"38000\"},{\"name\":\"10кг\",\"price\":\"68000\"}]', 'Выход муки на мельзаводах достигает 74 %, что соответственно по сортам составляет:\n\nмука высшего сорта – 30 %,\n\nмука 1/сорта – 36 %,\n\nмука 2/сорта – 8%,\n\nотруби – 23%.', 'photos/80.jpg'),
(136, 'Rossiya Shakari 2-toifa', NULL, '47', '[{\"name\":\"1kg\",\"price\":\"6500\"}]', 'Rossiya shakari judayam sifatli', 'photos/81.jpg'),
(137, 'Altindan Jayma', NULL, '47', '[{\"name\":\"Жайма\",\"price\":\"11000\"}]', 'Изготовлено из муки высшего сорта «Алтын Дан»\n\nСостав: мука высшего сорта, яичный порошок, вода, соль.\n\nУсловия хранения: хранить в сухом, без постоянных запахов месте,  при температуре не выше +30 с, относительной влажности воздуха 70 %\n\nСрок годности со дня изготовления:12 месяцев. Дата выпуска указывается на сварном шве.\n\nГруппа В, класса 1.\n\nВ 100 граммах продукта: белки – 10,4 гр., жиры – 1,1 гр., углеводы – 71,5 гр. Энергетическая ценность – 344 ккал.\n\nСТ ТОО 39878003-01-2010 ', 'photos/82.jpg'),
(138, 'Buon Gusto speral 500g', NULL, '47', '[{\"name\":\"Speral\",\"price\":\"7500\"}]', 'Макаронные изделия Buon Gusto первого класса группы В, яичные', 'photos/83.jpg'),
(139, 'Makfa spaghetti 400g', NULL, '47', '[{\"name\":\"Spagetti\",\"price\":\"7000\"}]', 'Характеристики Изделия макаронные Спагетти Makfa м/у 400г.\n\nЕдиница продажи\n\nВес нетто, г400Вес нетто, кг0.4\n\nПитательные характеристики\n\nЖиры, г/100г1.3Белки, г/100г11Углеводы, г/100г72Калорийность, кДж/100г1484ккал/100г350\n\nУсловия хранения\n\nСрок годности, мес.24Макс. температура+30Температура хранения, до,ºC30Срок годности, дней720\n\nПрочее\n\nВид продукцииСПАГЕТТИПроисхождениеТВЕРДЫЕ СОРТА ПШЕНИЦЫВесовой товарНЕТКоличество, шт.1Планограмма выкладки товараДАТип макаронных изделийСПАГЕТТИ', 'photos/84.jpg'),
(140, 'Buon Gusto lapsha 500g', NULL, '47', '[{\"name\":\"Lapsha\",\"price\":\"8000\"}]', 'Макаронные изделия Buon Gusto первого класса группы В, яичные.', 'photos/85.jpg'),
(141, 'Makfa salomka 400g', NULL, '47', '[{\"name\":\"Salomka\",\"price\":\"8000\"}]', 'Страна производитель:\n\nРоссия\n\nСрок хранения:\n\n29 месяцев\n\nУсловия хранения:\n\n+20°С\n\nТип упаковки:\n\nПакет\n\nЭнергетическая ценность:\n\n338ккал.\n\nПищевая ценность в 100 гр.:\n\nБелки 11г, углеводы  70,5г, жиры 1,3г.', 'photos/86.jpg'),
(142, 'Makfa pero 400g', NULL, '47', '[{\"name\":\"Pero\",\"price\":\"7000\"}]', 'Состав\n\nСостав: Мука из твердой пшеницы для макаронных изделий высшего сорта, вода питьевая.\n\nОсновные\n\nВес товара,\nг400ФормаПерьяРазмер макаронных изделийКороткиеВид мукиПшеничнаяОсобенностиИз твердых сортов пшеницыЕдиниц в одном товаре1', 'photos/87.jpg'),
(144, 'Qo\'qon patr', NULL, '33', '[{\"name\":\"Qo\'qon patr\",\"price\":\"3500\"}]', 'Mazzali patr noni', 'photos/91.jpg'),
(145, 'Jaydari besh qayragoch', NULL, '33', '[{\"name\":\"Besh qayragoch\",\"price\":\"3000\"}]', 'Mazzali non', 'photos/92.jpg'),
(146, 'Saryog\'li patr', NULL, '33', '[{\"name\":\"Saryog\'li patr\",\"price\":\"4000\"}]', 'Mazzali patr noni', 'photos/93.jpg'),
(147, 'Malochniy patr', NULL, '33', '[{\"name\":\"Patr\",\"price\":\"3000\"}]', 'Mazzali patr noni', 'photos/94.jpg'),
(148, 'Samarqand noni', NULL, '33', '[{\"name\":\"Patr\",\"price\":\"3000\"}]', 'Mazzali non', 'photos/95.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `shoppingcart`
--
-- Создание: Июн 09 2020 г., 17:16
-- Последнее обновление: Июн 25 2020 г., 08:41
--

DROP TABLE IF EXISTS `shoppingcart`;
CREATE TABLE `shoppingcart` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `optionNum` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `shoppingcart`
--

INSERT INTO `shoppingcart` (`id`, `userId`, `productId`, `quantity`, `optionNum`) VALUES
(76, 501450632, 68, 9, 0),
(77, 501450632, 68, 9, 2),
(78, 501450632, 68, 5, 1),
(79, 501450632, 72, 9, 2),
(88, 482944903, 91, 9, 0),
(89, 482944903, 82, 1, 1),
(97, 511603256, 90, 1, 1),
(98, 81115821, 92, 2, 0),
(99, 81115821, 79, 2, 0),
(101, 884658656, 92, 6, 0),
(102, 884658656, 64, 6, 0),
(116, 173754010, 119, 1, 0),
(118, 1090914928, 80, 2, 0),
(119, 1090914928, 85, 5, 1),
(123, 327632212, 87, 1, 2),
(124, 635793263, 91, 5, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `texts`
--
-- Создание: Май 31 2020 г., 07:34
--

DROP TABLE IF EXISTS `texts`;
CREATE TABLE `texts` (
  `id` int(11) NOT NULL,
  `keyword` varchar(255) DEFAULT NULL,
  `uz` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `ru` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `texts`
--

INSERT INTO `texts` (`id`, `keyword`, `uz`, `ru`) VALUES
(1, 'page_main_btn_1', '📁 Katalog', '1'),
(2, 'page_main_btn_2', '🛍 Savat', '2'),
(3, 'page_main_btn_3', '📞 Qayta aloqa', '3'),
(4, 'page_main_btn_4', 'ℹ️ Bot haqida', '4'),
(5, 'Xpage_main_btn_5', '⚙️ Sozlamalar', '5'),
(6, 'Xpage_main_btn_6', '📞 Qayta aloqa', '6'),
(7, 'page_main_text', 'Bosh sahifa', 'ru text'),
(8, 'page_categories_text', 'Bo\'limni tanlang', '..'),
(9, 'page_products_text', 'Tovarni tanlang.', '..'),
(10, 'back_btn', '🔙 Orqaga', '🔙 Назад'),
(11, 'page_main_admin_btn', '👮‍♂️Admin Panel', 'Админ панель'),
(12, 'btn_add_more', '➕ Yana tur qo\'shish', '+++'),
(13, 'btn_done', '✅ Tasdiqlash', 'doneee'),
(14, 'btn_preview', '👁 Tovarni ko\'rish', 'ss'),
(15, 'soum', 'so\'m', 'сум'),
(16, 'page_products_text_no_product', 'Bu kategoriyada mahsulotlar yo\'q.', '..'),
(17, 'page_categories_text_no_category', 'Hozircha kategoriyalar yo\'q.', '..'),
(18, 'page_choose_count_text', 'Iltimos, mahsulot miqdorini tanlang:', '..'),
(19, 'product_added_to_cart', 'Mahsulot savatga qo\'shildi.', '..');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--
-- Создание: Май 30 2020 г., 13:07
-- Последнее обновление: Июн 25 2020 г., 09:16
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `data_json` longtext,
  `chatID` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `data_json`, `chatID`) VALUES
(11, '{\"lang\":\"dXo=\",\"quantity\":\"MA==\",\"page\":\"cGFnZV9tYWlu\",\"categoryId\":\"MzE=\",\"productId\":\"MTM1\",\"product\":\"eyJvcHRpb25zQ291bnQiOjAsImNhdGVnb3J5SWQiOiIzMyIsInBob3RvVXJsIjoicGhvdG9zXC85NS5qcGciLCJuYW1lIjoiU2FtYXJxYW5kIG5vbmkiLCJpbmZvIjoiTWF6emFsaSBub24iLCJvcHRpb25zIjpbeyJuYW1lIjoiUGF0ciIsInByaWNlIjoiMzAwMCJ9XX0=\",\"orderType\":\"ZGVsaXZlcnlUeXBl\",\"latitude\":\"NDEsMzk4NDE0\",\"longitude\":\"NjksNDQxNDQ=\",\"phoneNumber\":\"OTk4OTc3MTQxMTcx\",\"orderText\":\"PGI+WUVUS0FaSUIgQkVSSVNIPC9iPgotLS0tLS0tLS0tLS0tCgo8Yj5CVVlVUlRNQTwvYj46CktvZmUgSmFjb2JzIE1vbmFyY2gga2xhc3NpayAyMzBnIEphY29icyBNb25hcmNoIGtsYXNzaWsgMjMwZywgMiBkb25hIC0gMTEyIDAwMCBzbydtCgotLS0tLS0tLS0tLS0tLS0tLS0tLQpKYW1pOiAxMTIgMDAwIHNvJ20KCklzbTogQWttYWwKVGVsZWZvbiByYXFhbTogOTk4OTc3MTQxMTcx\",\"productOption\":\"NQ==\",\"firstName\":\"QWttYWw=\"}', 742826077),
(12, '{\"lang\":\"dXo=\",\"quantity\":\"MA==\",\"page\":\"cGFnZV9tYWlu\",\"categoryId\":\"NDY=\",\"productId\":\"Njc=\",\"productOption\":\"MA==\",\"orderType\":\"ZGVsaXZlcnlUeXBl\",\"latitude\":\"\",\"longitude\":\"\",\"phoneNumber\":\"OTk4OTc3NTYxMTcy\",\"orderText\":\"PGI+WUVUS0FaSUIgQkVSSVNIPC9iPgotLS0tLS0tLS0tLS0tCgo8Yj5CVVlVUlRNQTwvYj46ClBlcHNpIFBlcHNpIDFMLCAyIGRvbmEgLSAxMiAwMDAgc28nbQoKQnV4YW5rYSAoIG9kZGl5ICkgQnV4YW5rYSwgNiBkb25hIC0gMTAgMjAwIHNvJ20KCkNoaXBzIFByaW5nbGVzIE11c2hyb29tJkNyZWFtIDE2NSDQsyBNdXNocm9vbSZDcmVhbSwgNCBkb25hIC0gMTA0IDAwMCBzbydtCgotLS0tLS0tLS0tLS0tLS0tLS0tLQpKYW1pOiAxMjYgMjAwIHNvJ20KCklzbTogTWlyYWJib3MKVGVsZWZvbiByYXFhbTogOTk4OTc3NTYxMTcy\",\"firstName\":\"TWlyYWJib3M=\"}', 579705378),
(17, '{\"lang\":\"dXo=\",\"quantity\":\"MA==\",\"page\":\"cGFnZV9tYWlu\",\"categoryId\":\"Mjg=\",\"productId\":\"NTE=\",\"productOption\":\"MA==\",\"orderType\":\"ZGVsaXZlcnlUeXBl\",\"latitude\":\"NDEsMzEzNzYz\",\"longitude\":\"NjksMTU3Mjc4\",\"phoneNumber\":\"OTAxMjM0NTY3\",\"orderText\":\"PGI+WUVUS0FaSUIgQkVSSVNIPC9iPgotLS0tLS0tLS0tLS0tCgo8Yj5CVVlVUlRNQTwvYj46Ck1hY0NvZmZlZSBDb2ZmZWUsIDM0IGRvbmEgLSA1MSAwMDAgc28nbQoKU2d1c2hlbmthIDAuNSBsaXRyLCAzNyBkb25hIC0gMTQ4IDAwMCBzbydtCgpTZ3VzaGVua2EgMSBsaXRyLCA0NyBkb25hIC0gMzI5IDAwMCBzbydtCgotLS0tLS0tLS0tLS0tLS0tLS0tLQpKYW1pOiA1MjggMDAwIHNvJ20KClRlbGVmb24gcmFxYW06IDkwMTIzNDU2Nw==\"}', 778867282),
(18, '{\"lang\":\"dXo=\",\"quantity\":\"MA==\",\"page\":\"cGFnZV9tYWlu\",\"categoryId\":\"Mjk=\",\"productId\":\"NTM=\",\"productOption\":\"MQ==\",\"orderType\":\"ZGVsaXZlcnlUeXBl\",\"latitude\":\"NDEsMzk4NDA0\",\"longitude\":\"NjksNDQxMzE2\",\"phoneNumber\":\"OTk4OTQ2NDYxMTcy\",\"orderText\":\"PGI+WUVUS0FaSUIgQkVSSVNIPC9iPgotLS0tLS0tLS0tLS0tCgo8Yj5CVVlVUlRNQTwvYj46Ck1hY0NvZmZlZSBDb2ZmZWUsIDkgZG9uYSAtIDEzIDUwMCBzbydtCgpTZ3VzaGVua2EgMSBsaXRyLCA2IGRvbmEgLSA0MiAwMDAgc28nbQoKLS0tLS0tLS0tLS0tLS0tLS0tLS0KSmFtaTogNTUgNTAwIHNvJ20KClRlbGVmb24gcmFxYW06IDk5ODk0NjQ2MTE3Mg==\"}', 779504501),
(19, '{\"lang\":\"dXo=\",\"quantity\":\"MA==\",\"page\":\"cGFnZV9tYWlu\",\"categoryId\":\"NDY=\",\"productId\":\"MTI4\",\"productOption\":\"MA==\",\"orderType\":\"ZGVsaXZlcnlUeXBl\",\"latitude\":\"\",\"longitude\":\"\",\"phoneNumber\":\"OTk4OTk4NzYxNzE1\",\"orderText\":\"PGI+WUVUS0FaSUIgQkVSSVNIPC9iPgotLS0tLS0tLS0tLS0tCgo8Yj5CVVlVUlRNQTwvYj46ClNndXNoZW5rYSAwLjUgbGl0ciwgNSBkb25hIC0gMjAgMDAwIHNvJ20KCi0tLS0tLS0tLS0tLS0tLS0tLS0tCkphbWk6IDIwIDAwMCBzbydtCgpUZWxlZm9uIHJhcWFtOiA5OTg5OTg3NjE3MTU=\"}', 848621096),
(20, '{\"lang\":\"dXo=\",\"quantity\":\"MA==\",\"page\":\"cGFnZV9jYXRhbG9n\",\"categoryId\":\"NDE=\",\"productId\":\"NjY=\",\"productOption\":\"MA==\"}', 641275548),
(21, '{\"lang\":\"dXo=\",\"quantity\":\"MA==\",\"page\":\"cGFnZV9jYXRhbG9n\",\"categoryId\":\"NDI=\",\"productId\":\"NzI=\",\"productOption\":\"Mg==\",\"orderType\":\"ZGVsaXZlcnlUeXBl\"}', 501450632),
(22, '{\"lang\":\"dXo=\",\"quantity\":\"MA==\",\"page\":\"cGFnZV9tYWlu\",\"categoryId\":\"MzM=\",\"productId\":\"ODc=\",\"productOption\":\"Mg==\"}', 131146293),
(23, '{\"lang\":\"dXo=\",\"quantity\":\"MA==\",\"page\":\"c2hvcHBpbmdfY2FydF9wYWdl\",\"categoryId\":\"NDA=\",\"productId\":\"ODU=\",\"productOption\":\"MQ==\"}', 1090914928),
(24, '{\"lang\":\"dXo=\",\"quantity\":\"MA==\",\"page\":\"cGFnZV9wcm9kdWN0cw==\",\"categoryId\":\"MzE=\",\"productId\":\"MTIy\",\"productOption\":\"NQ==\"}', 760002040),
(25, '{\"lang\":\"dXo=\",\"quantity\":\"MA==\",\"page\":\"c2hvcHBpbmdfY2FydF9wYWdl\",\"categoryId\":\"MzA=\",\"productId\":\"ODI=\",\"productOption\":\"MQ==\"}', 482944903),
(26, '{\"lang\":\"dXo=\",\"quantity\":\"MA==\",\"page\":\"cGFnZV9tYWlu\",\"categoryId\":\"Mjk=\",\"productId\":\"NjQ=\",\"productOption\":\"MA==\"}', 600464660),
(27, '{\"lang\":\"dXo=\",\"quantity\":\"MA==\",\"page\":\"cGFnZV9tYWlu\",\"categoryId\":\"NDY=\",\"productId\":\"MTE2\"}', 844551001),
(28, '{\"lang\":\"dXo=\",\"quantity\":\"MA==\",\"page\":\"b3JkZXJfY29uZmlybWF0aW9uX3BhZ2U=\",\"categoryId\":\"MzA=\",\"productId\":\"Nzk=\",\"productOption\":\"MA==\",\"orderType\":\"ZGVsaXZlcnlUeXBl\",\"firstName\":\"QWttYWw=\",\"latitude\":\"NDAsNTEzODkz\",\"longitude\":\"NzIsMzM0NjIx\",\"phoneNumber\":\"OTk4OTc1ODIwMjE3\",\"orderText\":\"PGI+WUVUS0FaSUIgQkVSSVNIPC9iPgotLS0tLS0tLS0tLS0tCgo8Yj5CVVlVUlRNQTwvYj46CktvZmUgSmFjb2JzIE1vbmFyY2gga2xhc3NpayAyMzBnIEphY29icyBNb25hcmNoIGtsYXNzaWsgMjMwZywgMiBkb25hIC0gMTEyIDAwMCBzbydtCgogLCAyIGRvbmEgLSAwIHNvJ20KCi0tLS0tLS0tLS0tLS0tLS0tLS0tCkphbWk6IDExMiAwMDAgc28nbQoKSXNtOiBBa21hbApUZWxlZm9uIHJhcWFtOiA5OTg5NzU4MjAyMTc=\"}', 81115821),
(29, '{\"lang\":\"dXo=\",\"quantity\":\"MA==\",\"page\":\"cGFnZV9tYWlu\",\"categoryId\":\"MzQ=\",\"productId\":\"OTA=\",\"productOption\":\"MQ==\",\"orderType\":\"ZGVsaXZlcnlUeXBl\",\"firstName\":\"QQ==\"}', 511603256),
(30, '{\"lang\":\"dXo=\",\"quantity\":\"MA==\",\"page\":\"cGFnZV9jYXRhbG9n\"}', 1147874293),
(31, '{\"lang\":\"dXo=\",\"quantity\":\"MA==\",\"page\":\"cGFnZV9wcm9kdWN0cw==\",\"categoryId\":\"Mjg=\",\"productId\":\"OTg=\"}', 861976898),
(32, '{\"lang\":\"dXo=\",\"quantity\":\"MA==\",\"page\":\"b3JkZXJfY29uZmlybWF0aW9uX3BhZ2U=\",\"categoryId\":\"Mjk=\",\"productId\":\"NjQ=\",\"productOption\":\"MA==\",\"orderType\":\"ZGVsaXZlcnlUeXBl\",\"firstName\":\"QWttYWw=\",\"latitude\":\"NDAsNTEzODkz\",\"longitude\":\"NzIsMzM0NjIx\",\"phoneNumber\":\"OTk4OTE0ODE2OTcx\",\"orderText\":\"PGI+WUVUS0FaSUIgQkVSSVNIPC9iPgotLS0tLS0tLS0tLS0tCgo8Yj5CVVlVUlRNQTwvYj46CktvZmUgSmFjb2JzIE1vbmFyY2gga2xhc3NpayAyMzBnIEphY29icyBNb25hcmNoIGtsYXNzaWsgMjMwZywgNiBkb25hIC0gMzM2IDAwMCBzbydtCgpDb2NhIGNvbGEgQ29jYSBjb2xhIDEuNUwsIDYgZG9uYSAtIDQ4IDAwMCBzbydtCgotLS0tLS0tLS0tLS0tLS0tLS0tLQpKYW1pOiAzODQgMDAwIHNvJ20KCklzbTogQWttYWwKVGVsZWZvbiByYXFhbTogOTk4OTE0ODE2OTcx\"}', 884658656),
(33, '{\"lang\":\"dXo=\",\"quantity\":\"MA==\",\"page\":\"cGFnZV9wcm9kdWN0cw==\",\"categoryId\":\"Mjk=\",\"productId\":\"NzE=\",\"productOption\":\"NQ==\"}', 678073156),
(34, '{\"lang\":\"dXo=\",\"quantity\":\"MA==\",\"page\":\"cGFnZV9tYWlu\"}', 1004138757),
(35, '{\"lang\":\"dXo=\",\"quantity\":\"MA==\",\"page\":\"cGFnZV9wcm9kdWN0cw==\",\"categoryId\":\"NDc=\",\"productId\":\"ODI=\"}', 1252891698),
(36, '{\"lang\":\"dXo=\",\"quantity\":\"MA==\",\"page\":\"cGFnZV9jYXRhbG9n\",\"categoryId\":\"NDU=\",\"productId\":\"ODM=\"}', 824171992),
(37, '{\"lang\":\"dXo=\",\"quantity\":\"MA==\",\"page\":\"cGFnZV9jYXRhbG9n\",\"categoryId\":\"NDc=\",\"productId\":\"MTIx\"}', 737237726),
(38, '{\"lang\":\"dXo=\",\"quantity\":\"MA==\",\"page\":\"cGFnZV9wcm9kdWN0cw==\",\"categoryId\":\"Mjk=\",\"productId\":\"Nzc=\"}', 1052336630),
(39, '{\"lang\":\"dXo=\",\"quantity\":\"MA==\",\"page\":\"cGFnZV9jYXRhbG9n\",\"categoryId\":\"NDI=\"}', 641789104),
(41, '{\"lang\":\"dXo=\",\"quantity\":\"MA==\",\"page\":\"cGFnZV9wcm9kdWN0cw==\",\"categoryId\":\"Mjg=\",\"productId\":\"MTAy\"}', 814010410),
(42, '{\"lang\":\"dXo=\",\"quantity\":\"MA==\",\"page\":\"cGFnZV9tYWlu\",\"categoryId\":\"NTA=\",\"productId\":\"NjQ=\",\"productOption\":\"MA==\",\"orderType\":\"ZGVsaXZlcnlUeXBl\",\"firstName\":\"TWlyYWZ6YWw=\",\"latitude\":\"\",\"longitude\":\"\",\"phoneNumber\":\"Kzk5ODk5ODgxMjQzNg==\",\"orderText\":\"PGI+WUVUS0FaSUIgQkVSSVNIPC9iPgotLS0tLS0tLS0tLS0tCgo8Yj5CVVlVUlRNQTwvYj46CktvZmUgSmFjb2JzIEdvbGQgOTVnIEphY29icyBHb2xkIDk1ZywgNSBkb25hIC0gMjU1IDAwMCBzbydtCgotLS0tLS0tLS0tLS0tLS0tLS0tLQpKYW1pOiAyNTUgMDAwIHNvJ20KCklzbTogTWlyYWZ6YWwKVGVsZWZvbiByYXFhbTogKzk5ODk5ODgxMjQzNg==\",\"product\":\"eyJvcHRpb25zQ291bnQiOjAsImNhdGVnb3J5SWQiOiI1MCJ9\"}', 635793263),
(47, '{\"lang\":\"dXo=\",\"quantity\":\"MA==\",\"page\":\"cGFnZV9tYWlu\"}', 1144018041),
(48, '{\"lang\":\"dXo=\",\"quantity\":\"MA==\",\"page\":\"cGFnZV9jYXRhbG9n\",\"categoryId\":\"MzQ=\",\"productId\":\"OTA=\",\"productOption\":\"NA==\"}', 2216910),
(49, '{\"lang\":\"dXo=\",\"quantity\":\"MA==\",\"page\":\"cGFnZV9tYWlu\",\"categoryId\":\"NDg=\",\"productId\":\"MTMy\"}', 993526408),
(50, '{\"lang\":\"dXo=\",\"quantity\":\"MA==\",\"page\":\"cGFnZV9jYXRhbG9n\",\"categoryId\":\"Mzc=\",\"productId\":\"ODc=\"}', 28183341),
(51, '{\"lang\":\"dXo=\",\"quantity\":\"MA==\",\"page\":\"cGFnZV9wcm9kdWN0cw==\",\"categoryId\":\"Mjk=\",\"productId\":\"ODE=\",\"productOption\":\"MQ==\",\"orderType\":\"ZGVsaXZlcnlUeXBl\",\"firstName\":\"SmFtb2w=\",\"latitude\":\"NDEsNTczMTI=\",\"longitude\":\"NjQsMjE3ODEx\"}', 54150136),
(52, '{\"lang\":\"dXo=\",\"quantity\":\"MA==\",\"page\":\"cGFnZV9wcm9kdWN0cw==\",\"categoryId\":\"Mjg=\"}', 128544107),
(53, '{\"lang\":\"dXo=\",\"quantity\":\"MA==\",\"page\":\"cGFnZV9tYWlu\",\"categoryId\":\"NDc=\",\"productId\":\"MTE5\",\"productOption\":\"MA==\"}', 173754010),
(54, '{\"lang\":\"dXo=\",\"quantity\":\"MA==\",\"page\":\"cGFnZV9wcm9kdWN0cw==\",\"categoryId\":\"Mjk=\",\"productId\":\"NjQ=\"}', 597263052),
(55, '{\"lang\":\"dXo=\",\"quantity\":\"MA==\",\"page\":\"cGFnZV9wcm9kdWN0cw==\",\"categoryId\":\"MzM=\"}', 597265180),
(56, '{\"lang\":\"dXo=\",\"quantity\":\"MA==\",\"page\":\"cGFnZV9tYWlu\"}', 125137620),
(57, '{\"lang\":\"dXo=\",\"quantity\":\"MA==\",\"page\":\"cGFnZV9tYWlu\",\"categoryId\":\"NDI=\"}', 54124988),
(58, '{\"lang\":\"dXo=\",\"quantity\":\"MA==\",\"page\":\"cGFnZV9wcm9kdWN0cw==\",\"categoryId\":\"Mjg=\",\"productId\":\"MTA3\"}', 328026251),
(59, '{\"lang\":\"dXo=\",\"quantity\":\"MA==\",\"page\":\"cGFnZV9jYXRhbG9n\",\"categoryId\":\"Mzc=\"}', 672234477),
(60, '{\"lang\":\"dXo=\",\"quantity\":\"MA==\",\"page\":\"cGFnZV9tYWlu\"}', 4118432),
(61, '{\"lang\":\"dXo=\",\"quantity\":\"MA==\",\"page\":\"cGFnZV9wcm9kdWN0cw==\",\"categoryId\":\"NDc=\",\"productId\":\"MTM1\"}', 67926926),
(62, '{\"lang\":\"dXo=\",\"quantity\":\"MA==\",\"page\":\"cGFnZV9jYXRhbG9n\"}', 456613303),
(63, '{\"lang\":\"dXo=\",\"quantity\":\"MA==\",\"page\":\"cGFnZV9wcm9kdWN0cw==\",\"categoryId\":\"Mjk=\",\"productId\":\"Nzc=\"}', 88906551),
(64, '{\"lang\":\"dXo=\",\"quantity\":\"MA==\",\"page\":\"cGFnZV9wcm9kdWN0cw==\",\"categoryId\":\"NDY=\",\"productId\":\"MTI5\"}', 525731603),
(65, '{\"lang\":\"dXo=\",\"quantity\":\"MA==\",\"page\":\"cGFnZV9wcm9kdWN0cw==\",\"categoryId\":\"NDA=\"}', 709836845),
(66, '{\"lang\":\"dXo=\",\"quantity\":\"MA==\",\"page\":\"cGFnZV9jYXRhbG9n\"}', 1080557105),
(67, '{\"lang\":\"dXo=\",\"quantity\":\"MA==\",\"page\":\"cGFnZV9tYWlu\",\"categoryId\":\"Mjk=\",\"productId\":\"Njc=\",\"productOption\":\"MQ==\",\"orderType\":\"ZGVsaXZlcnlUeXBl\"}', 257958421),
(68, '{\"lang\":\"dXo=\",\"quantity\":\"MA==\",\"page\":\"cGFnZV9wcm9kdWN0cw==\",\"categoryId\":\"NDY=\",\"productId\":\"MTI4\"}', 694204592),
(69, '{\"lang\":\"dXo=\",\"quantity\":\"MA==\",\"page\":\"cGFnZV9wcm9kdWN0cw==\",\"categoryId\":\"Mjk=\",\"productId\":\"Njc=\"}', 741704238),
(70, '{\"lang\":\"dXo=\",\"quantity\":\"MA==\",\"page\":\"cGFnZV9tYWlu\",\"categoryId\":\"NDc=\",\"productOption\":\"MA==\",\"productId\":\"MTE4\"}', 2914282),
(71, '{\"lang\":\"dXo=\",\"quantity\":\"MA==\",\"page\":\"cGFnZV9wcm9kdWN0cw==\",\"categoryId\":\"NDc=\"}', 660739510),
(72, '{\"lang\":\"dXo=\",\"quantity\":\"MA==\",\"page\":\"cGFnZV9wcm9kdWN0cw==\",\"categoryId\":\"Mjk=\",\"productId\":\"NzE=\"}', 1852611),
(73, '{\"lang\":\"dXo=\",\"quantity\":\"MA==\",\"page\":\"cGFnZV9jYXRhbG9n\"}', 3442668),
(74, '{\"lang\":\"dXo=\",\"quantity\":\"MA==\",\"page\":\"cGFnZV9wcm9kdWN0cw==\",\"categoryId\":\"Mjg=\",\"productId\":\"MTIy\"}', 966815182),
(75, '{\"lang\":\"dXo=\",\"quantity\":\"MA==\",\"page\":\"cGFnZV9wcm9kdWN0cw==\",\"categoryId\":\"Mjg=\",\"productId\":\"MTA5\"}', 961187475),
(76, '{\"lang\":\"dXo=\",\"quantity\":\"MA==\",\"page\":\"cGFnZV9jYXRhbG9n\"}', 3850205),
(77, '{\"lang\":\"dXo=\",\"quantity\":\"MA==\",\"page\":\"cGFnZV9jYXRhbG9n\",\"categoryId\":\"NDg=\",\"productId\":\"MTM0\"}', 39902282),
(78, '{\"lang\":\"dXo=\",\"quantity\":\"MA==\",\"page\":\"cGFnZV9wcm9kdWN0cw==\",\"categoryId\":\"Mzc=\"}', 1023850739),
(79, '{\"lang\":\"dXo=\",\"quantity\":\"MA==\",\"page\":\"b3JkZXJfY29uZmlybWF0aW9uX3BhZ2U=\",\"categoryId\":\"MzU=\",\"productId\":\"ODc=\",\"productOption\":\"Mg==\",\"orderType\":\"cGlja3VwVHlwZQ==\",\"firstName\":\"S2h1cnNoaWQ=\",\"phoneNumber\":\"OTY2NTQ0MjEyOTc0\",\"orderText\":\"PGI+T0xJQiBLRVRJU0g8L2I+Ci0tLS0tLS0tLS0tLS0KCjxiPkJVWVVSVE1BPC9iPjoKR3VydWNoIExhemlyLCAxIGRvbmEgLSAxNiAwMDAgc28nbQoKLS0tLS0tLS0tLS0tLS0tLS0tLS0KSmFtaTogMTYgMDAwIHNvJ20KCklzbTogS2h1cnNoaWQKVGVsZWZvbiByYXFhbTogOTY2NTQ0MjEyOTc0\"}', 327632212),
(80, '{\"lang\":\"dXo=\",\"quantity\":\"MA==\",\"page\":\"cGFnZV9wcm9kdWN0cw==\",\"categoryId\":\"Mjk=\",\"productId\":\"NjQ=\"}', 304227470),
(81, '{\"lang\":\"dXo=\",\"quantity\":\"MA==\",\"page\":\"cGFnZV9wcm9kdWN0cw==\",\"categoryId\":\"MzE=\",\"productId\":\"MTIx\"}', 840641106),
(82, NULL, 23412342),
(83, '{\"lang\":\"dXo=\",\"quantity\":\"MA==\",\"page\":\"cGFnZV9wcm9kdWN0cw==\",\"categoryId\":\"NDY=\"}', 570007329);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `shoppingcart`
--
ALTER TABLE `shoppingcart`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `texts`
--
ALTER TABLE `texts`
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
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=149;

--
-- AUTO_INCREMENT для таблицы `shoppingcart`
--
ALTER TABLE `shoppingcart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;

--
-- AUTO_INCREMENT для таблицы `texts`
--
ALTER TABLE `texts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
