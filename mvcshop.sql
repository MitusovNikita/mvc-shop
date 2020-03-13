-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Мар 12 2020 г., 17:45
-- Версия сервера: 10.1.41-MariaDB-0+deb9u1
-- Версия PHP: 7.0.33-0+deb9u6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `mvcshop`
--

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `sort_order` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `category`
--

INSERT INTO `category` (`id`, `name`, `sort_order`, `status`) VALUES
(1, 'Рубашки', 1, 1),
(2, 'Платья', 5, 1),
(3, 'Футболки', 3, 1),
(4, 'Майки', 4, 1),
(5, 'Сумки', 2, 1),
(6, 'Чемоданы', 6, 1),
(7, 'Брюки', 7, 1),
(8, 'Пиджаки', 8, 1),
(9, 'Галстуки', 9, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `code` int(11) NOT NULL,
  `price` float NOT NULL,
  `availability` int(11) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `is_new` int(11) NOT NULL DEFAULT '0',
  `is_recommended` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `product`
--

INSERT INTO `product` (`id`, `name`, `category_id`, `code`, `price`, `availability`, `brand`, `image`, `description`, `is_new`, `is_recommended`, `status`) VALUES
(1, 'Piazza Italia', 7, 53543, 553, 1, 'Piazza', '', '', 0, 0, 1),
(2, 'DKNY BTF', 7, 1768, 777, 1, 'DKNY', '', '', 1, 1, 1),
(3, 'Piazza Italia xl oil', 1, 87345, 832, 1, 'Piazza', '', '', 0, 1, 1),
(4, 'G-STAR Raw Синие', 2, 17849, 1229, 0, 'G-STAR', '', '', 1, 1, 1),
(5, 'G-STAR Raw Красные', 3, 83222, 1009, 0, 'G-STAR', '', '', 1, 1, 1),
(6, 'Piazza Italia M oil', 4, 12267, 788, 1, 'Piazza', '', '', 0, 1, 1),
(7, 'Piazza Italia 79262', 7, 23323, 880, 1, 'Piazza', '', '', 0, 0, 1),
(8, 'Piazza P Желтые', 7, 91122, 299, 1, 'Piazza', '', '', 0, 0, 1),
(9, 'Piazza P Зеленые', 7, 91123, 299, 1, 'Piazza', '', '', 0, 0, 1),
(10, 'Piazza P Синие', 7, 91124, 299, 1, 'Piazza', '', '', 0, 0, 1),
(13, 'Новый товар 3', 1, 123123, 123, 1, 'H & M', '', '', 1, 1, 1),
(14, 'Новый товар 4', 1, 123123, 123, 1, '', '', '', 1, 1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `product_order`
--

CREATE TABLE `product_order` (
  `id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_phone` varchar(255) NOT NULL,
  `user_comment` text NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `products` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `product_order`
--

INSERT INTO `product_order` (`id`, `user_name`, `user_phone`, `user_comment`, `user_id`, `date`, `products`, `status`) VALUES
(1, 'mitusov@office11.ru', '89819473496', 'test', 0, '2019-12-12 15:41:52', '{\"11\":1}', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) CHARACTER SET utf8mb4 NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `role`) VALUES
(1, 'Nikita1', 'mitusov@office11.ru', 'Minima123', 'admin'),
(3, 'Никита Митусов', 'mitusov333@gmail.com', '123123', ''),
(4, 'Никита', 'test@gmail.com', '12312332131', '');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `product_order`
--
ALTER TABLE `product_order`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT для таблицы `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT для таблицы `product_order`
--
ALTER TABLE `product_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
