-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 30 2017 г., 17:21
-- Версия сервера: 5.7.16-log
-- Версия PHP: 5.6.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `blog`
--

-- --------------------------------------------------------

--
-- Структура таблицы `comment`
--

CREATE TABLE `comment` (
  `comment_id` bigint(20) UNSIGNED NOT NULL,
  `post_id` bigint(20) DEFAULT NULL,
  `comment_parent_id` bigint(20) DEFAULT NULL,
  `comment_username` varchar(255) DEFAULT NULL,
  `comment_text` text,
  `comment_datetime` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `comment`
--

INSERT INTO `comment` (`comment_id`, `post_id`, `comment_parent_id`, `comment_username`, `comment_text`, `comment_datetime`) VALUES
(1, 2, NULL, 'Jhon', 'I agree with yuo', NULL),
(2, 2, NULL, 'Monika', 'PHP most popular for WEB development', '2017-06-17 19:31:13'),
(3, 2, NULL, 'Ronald', 'I used PHP v 7 it`s wonderful', '2017-06-17 19:34:13'),
(4, 3, NULL, 'Michael', 'I am using YII ', '2017-06-17 19:36:14'),
(5, 3, NULL, 'Donald', 'I am using Laravel, it was popurary framework in Ukraine', '2017-06-17 19:38:19'),
(6, 3, NULL, 'Franklin', 'Symfiny is universal framework for PHP2', '2017-06-17 19:40:50'),
(7, 3, NULL, 'Sara', 'Cake framwork-easy to learn and work with it', '2017-06-17 19:44:53'),
(8, 4, NULL, 'Simon', 'PHP storm its wonderful for web development3', '2017-06-17 19:47:41'),
(9, 4, NULL, 'Tommy', 'I am use Sublime Text3 its OK2', '2017-06-17 19:48:52'),
(19, 2, 2, 'Duck', 'ok', NULL),
(20, 2, 2, 'Duck', 'Bla 2', '2017-06-26 21:00:00'),
(21, 2, 2, 'Serg', '123', NULL),
(22, 7, NULL, 'vasil', 'vasil comment', NULL),
(23, 6, NULL, 'Michael', 'It`s a good notebook.', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `login_admin`
--

CREATE TABLE `login_admin` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `login` varchar(128) DEFAULT NULL,
  `password` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `login_admin`
--

INSERT INTO `login_admin` (`id`, `login`, `password`) VALUES
(1, 'rudim', '123');

-- --------------------------------------------------------

--
-- Структура таблицы `post`
--

CREATE TABLE `post` (
  `post_id` bigint(20) UNSIGNED NOT NULL,
  `post_title` varchar(255) DEFAULT NULL,
  `post_min_text` text,
  `post_text` text,
  `post_create_datetime` datetime DEFAULT NULL,
  `post_update_datetime` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `post`
--

INSERT INTO `post` (`post_id`, `post_title`, `post_min_text`, `post_text`, `post_create_datetime`, `post_update_datetime`) VALUES
(1, 'subject', NULL, 'text body', '2017-06-17 21:54:56', NULL),
(2, 'Programming', NULL, 'Php is a popular programming language', '2017-06-17 21:58:23', NULL),
(3, 'Php framework', NULL, ' What framework are you using?', '2017-06-17 22:01:58', NULL),
(4, 'New title', 'qweqwe', 'asdadsasd23123Sas', '2017-06-27 19:28:13', NULL),
(5, 'bla', 'asdasdasdaw', 'qw`12`2`1`2qweqeqewqwe', '2017-06-27 20:17:48', NULL),
(6, 'Notebook', '                             Toshiba A100                        ', '                        Toshiba A100 -de3455qq		        	    ', '2017-06-27 20:27:03', '2017-06-30 13:47:46');

-- --------------------------------------------------------

--
-- Структура таблицы `post_to_tag`
--

CREATE TABLE `post_to_tag` (
  `post_to_tag_id` bigint(20) UNSIGNED NOT NULL,
  `post_id` bigint(20) DEFAULT NULL,
  `tag_id` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `post_to_tag`
--

INSERT INTO `post_to_tag` (`post_to_tag_id`, `post_id`, `tag_id`) VALUES
(1, 2, 1),
(2, 3, 1),
(5, 2, 3),
(6, 3, 3),
(8, 2, 4),
(9, 2, 5),
(10, 3, 5),
(11, 0, 6),
(12, 0, 7),
(19, 0, 8),
(20, 0, 9),
(21, 0, 10),
(22, 0, 11),
(25, 4, 1),
(26, 4, 12),
(27, 4, 13),
(28, 4, 14),
(29, 5, 15),
(34, 8, 19),
(35, 7, 17),
(36, 6, 16),
(37, 6, 20);

-- --------------------------------------------------------

--
-- Структура таблицы `tag`
--

CREATE TABLE `tag` (
  `tag_id` bigint(20) UNSIGNED NOT NULL,
  `tag_title` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tag`
--

INSERT INTO `tag` (`tag_id`, `tag_title`) VALUES
(1, 'Php'),
(2, 'IDE'),
(3, 'PHP'),
(4, 'JS'),
(5, 'framework'),
(6, 'twig'),
(7, ' шаблонизатор'),
(8, '123qweqwe'),
(9, '11'),
(10, ''),
(11, '123'),
(12, 'prog'),
(13, '2'),
(14, 'tag'),
(15, 'b'),
(16, 'note'),
(17, '3'),
(18, 'запись'),
(19, 'запись3'),
(20, ' tishiba');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `comment`
--
ALTER TABLE `comment`
  ADD UNIQUE KEY `comment_id` (`comment_id`);

--
-- Индексы таблицы `login_admin`
--
ALTER TABLE `login_admin`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `post`
--
ALTER TABLE `post`
  ADD UNIQUE KEY `post_id` (`post_id`);

--
-- Индексы таблицы `post_to_tag`
--
ALTER TABLE `post_to_tag`
  ADD UNIQUE KEY `post_to_tag_id` (`post_to_tag_id`);

--
-- Индексы таблицы `tag`
--
ALTER TABLE `tag`
  ADD UNIQUE KEY `tag_id` (`tag_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `comment`
--
ALTER TABLE `comment`
  MODIFY `comment_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT для таблицы `login_admin`
--
ALTER TABLE `login_admin`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `post`
--
ALTER TABLE `post`
  MODIFY `post_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT для таблицы `post_to_tag`
--
ALTER TABLE `post_to_tag`
  MODIFY `post_to_tag_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT для таблицы `tag`
--
ALTER TABLE `tag`
  MODIFY `tag_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
