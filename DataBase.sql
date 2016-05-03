SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- База данных: `Testmastake`
--

-- --------------------------------------------------------

--
-- Структура таблицы `CrListModuls`
--

CREATE TABLE IF NOT EXISTS `CrListModuls` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `urlname` varchar(50) NOT NULL,
  `pathname` varchar(50) NOT NULL,
  `issystems` int(1) NOT NULL DEFAULT '0',
  `dateinstall` date NOT NULL,
  `urlinfo` varchar(7000) NOT NULL,
  `creatermail` varchar(7000) NOT NULL,
  `creatername` varchar(70) NOT NULL,
  `blockedmoduls` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `urlname` (`urlname`,`pathname`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=28 ;

--
-- Очистить таблицу перед добавлением данных `CrListModuls`
--

TRUNCATE TABLE `CrListModuls`;
--
-- Дамп данных таблицы `CrListModuls`
--

INSERT INTO `CrListModuls` (`id`, `urlname`, `pathname`, `issystems`, `dateinstall`, `urlinfo`, `creatermail`, `creatername`, `blockedmoduls`) VALUES
(1, 'mydevice', 'mydevice', 0, '2016-01-13', 'for  url', 'for mail', 'for name', 0),
(4, 'users', 'users', 1, '2016-01-13', '', '', '', 0),
(5, 'adminpannel', 'apannel', 1, '2016-01-13', '', '', '', 0),
(10, 'staticpage', 'staticpage', 1, '0000-00-00', '', '', '', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `CrMenuTable`
--

CREATE TABLE IF NOT EXISTS `CrMenuTable` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` text CHARACTER SET utf8,
  `name` text CHARACTER SET utf8,
  `type` int(11) DEFAULT NULL,
  `menu` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=27 ;

--
-- Очистить таблицу перед добавлением данных `CrMenuTable`
--

TRUNCATE TABLE `CrMenuTable`;
--
-- Дамп данных таблицы `CrMenuTable`
--

INSERT INTO `CrMenuTable` (`id`, `url`, `name`, `type`, `menu`) VALUES
(1, '/', 'Главная', 0, 1),
(2, 'adminpannel/', 'Администраторская паннель', 3, 1),
(3, 'users/capcha', 'Капча (спорим зависнешь надолго?)', 0, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `CrStaticPage`
--

CREATE TABLE IF NOT EXISTS `CrStaticPage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `urlname` text NOT NULL,
  `pathname` text NOT NULL,
  `typepage` varchar(3) NOT NULL DEFAULT 'pag' COMMENT 'pag,man',
  `rightpage` int(11) NOT NULL,
  `title` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Очистить таблицу перед добавлением данных `CrStaticPage`
--

TRUNCATE TABLE `CrStaticPage`;
--
-- Дамп данных таблицы `CrStaticPage`
--

INSERT INTO `CrStaticPage` (`id`, `urlname`, `pathname`, `typepage`, `rightpage`, `title`) VALUES
(1, 'main', 'hello', 'pag', 0, 'Главная');

-- --------------------------------------------------------

--
-- Структура таблицы `CrUserMain`
--

CREATE TABLE IF NOT EXISTS `CrUserMain` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userlogin` text,
  `username` text,
  `userdate` date DEFAULT NULL,
  `userpassword` text,
  `userrools` int(11) DEFAULT '3',
  `useremeil` text,
  `userphone` text,
  `usercoutry` int(70) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Очистить таблицу перед добавлением данных `CrUserMain`
--

TRUNCATE TABLE `CrUserMain`;
--
-- Дамп данных таблицы `CrUserMain`
--

INSERT INTO `CrUserMain` (`id`, `userlogin`, `username`, `userdate`, `userpassword`, `userrools`, `useremeil`, `userphone`, `usercoutry`) VALUES
(1, 'fdsasdf44', 'Администратор', '2016-04-26', 'a8bc86caa078d0a11f849a33676d0329', 3, 'Vanilio@q.ru', NULL, NULL),
(10, 'Sadovnic', 'садовник', '2016-04-29', '36b033ac98c4806f39d453bc85f9c769', 3, 'cfghji', NULL, NULL);
