
--

-- --------------------------------------------------------

--
-- Структура таблицы `client`
--

CREATE TABLE IF NOT EXISTS `client` (
  `idclient` int(11) NOT NULL AUTO_INCREMENT,
  `enterprise` char(80) COLLATE cp1251_bin DEFAULT NULL,
  `fio` char(80) COLLATE cp1251_bin DEFAULT NULL,
  `mail` char(80) COLLATE cp1251_bin DEFAULT NULL,
  `login` char(80) COLLATE cp1251_bin DEFAULT NULL,
  `parol` char(80) COLLATE cp1251_bin DEFAULT NULL,
  `phone` char(80) COLLATE cp1251_bin DEFAULT NULL,
  `info` char(80) COLLATE cp1251_bin DEFAULT NULL,
  PRIMARY KEY (`idclient`)
) ENGINE=InnoDB  DEFAULT CHARSET=cp1251 COLLATE=cp1251_bin AUTO_INCREMENT=12 ;

--
-- Дамп данных таблицы `client`
--

INSERT INTO `client` (`idclient`, `enterprise`, `fio`, `mail`, `login`, `parol`, `phone`, `info`) VALUES
(10, '-', 'Селезнев ИВ', 'qwe@uq.ru', 'yui', '123', '5534583', '4248 223904 23'),
(11, '-', 'Холмокова ИВ', 'jkl@h.rt', 'ghj', '345', '1644523', '123556 675');

-- --------------------------------------------------------

--
-- Структура таблицы `request`
--

CREATE TABLE IF NOT EXISTS `request` (
  `idrequest` int(11) NOT NULL AUTO_INCREMENT,
  `idclient` int(11) NOT NULL,
  `idworker` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `name` char(80) COLLATE cp1251_bin DEFAULT NULL,
  `term` date DEFAULT NULL,
  `status` char(80) COLLATE cp1251_bin DEFAULT NULL,
  `cost` int(11) NOT NULL,
  `paid` varchar(80) COLLATE cp1251_bin NOT NULL,
  `discr` varchar(80) COLLATE cp1251_bin NOT NULL,
  PRIMARY KEY (`idrequest`),
  KEY `R_1` (`idclient`),
  KEY `R_2` (`idworker`)
) ENGINE=InnoDB  DEFAULT CHARSET=cp1251 COLLATE=cp1251_bin AUTO_INCREMENT=12 ;

--
-- Дамп данных таблицы `request`
--

INSERT INTO `request` (`idrequest`, `idclient`, `idworker`, `date`, `name`, `term`, `status`, `cost`, `paid`, `discr`) VALUES
(5, 11, 5, '2018-11-23', 'Заявка 11223', '2018-12-25', 'Заказ выполнен', 10000, 'Оплачено', '-'),
(8, 10, 7, '2018-11-22', 'Заявка 53345', '2018-12-25', 'Выполняется', 10000, 'Предоплата', '-'),
(9, 10, 5, '2018-11-24', 'Заявка 66553', '2018-12-25', 'На рассмотрении', 1000, 'Предоплата', '-'),
(11, 10, 5, '2018-11-24', 'Заявка 76534', '2018-11-24', 'На рассмотрении', 10000, 'Не оплачено', '-');

-- --------------------------------------------------------

--
-- Структура таблицы `service`
--

CREATE TABLE IF NOT EXISTS `service` (
  `idservice` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(200) COLLATE cp1251_bin DEFAULT NULL,
  `cost` int(11) DEFAULT NULL,
  PRIMARY KEY (`idservice`)
) ENGINE=InnoDB  DEFAULT CHARSET=cp1251 COLLATE=cp1251_bin AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `service`
--

INSERT INTO `service` (`idservice`, `name`, `cost`) VALUES
(1, 'Первичный осмотр и диагностика аппаратной неисправности', 800),
(2, 'Первичный ремонт и/или замена аппаратного обеспечения', 3000),
(3, 'Замена картриджа', 2500),
(4, 'Консультации по выбору, настройке и приобретению программного и аппаратного обеспечения', 2500),
(5, 'Замена дисплея', 2500);

-- --------------------------------------------------------

--
-- Структура таблицы `servicing`
--

CREATE TABLE IF NOT EXISTS `servicing` (
  `idservicing` int(11) NOT NULL AUTO_INCREMENT,
  `idrequest` int(11) NOT NULL,
  `idservice` int(11) NOT NULL,
  PRIMARY KEY (`idservicing`),
  KEY `R_3` (`idrequest`),
  KEY `R_4` (`idservice`)
) ENGINE=InnoDB  DEFAULT CHARSET=cp1251 COLLATE=cp1251_bin AUTO_INCREMENT=11 ;

--
-- Дамп данных таблицы `servicing`
--

INSERT INTO `servicing` (`idservicing`, `idrequest`, `idservice`) VALUES
(7, 5, 4),
(8, 8, 1),
(9, 8, 3),
(10, 9, 3);

-- --------------------------------------------------------

--
-- Структура таблицы `worker`
--

CREATE TABLE IF NOT EXISTS `worker` (
  `idworker` int(11) NOT NULL AUTO_INCREMENT,
  `fio` char(80) COLLATE cp1251_bin DEFAULT NULL,
  `post` char(80) COLLATE cp1251_bin DEFAULT NULL,
  `phone` char(80) COLLATE cp1251_bin DEFAULT NULL,
  `login` char(80) COLLATE cp1251_bin DEFAULT NULL,
  `parol` char(80) COLLATE cp1251_bin DEFAULT NULL,
  PRIMARY KEY (`idworker`)
) ENGINE=InnoDB  DEFAULT CHARSET=cp1251 COLLATE=cp1251_bin AUTO_INCREMENT=9 ;

--
-- Дамп данных таблицы `worker`
--

INSERT INTO `worker` (`idworker`, `fio`, `post`, `phone`, `login`, `parol`) VALUES
(1, 'Сергеев ИВ', 'Менеджер', '3483228', 'qwe', '123'),
(2, 'Матвеев ВВ', 'Менеджер', '656342', 'wer', '234'),
(3, 'Митяев КВ', 'Менеджер', '348322', 'ert', '345'),
(4, 'Маргасов ЛВ', 'Директор', '645624', 'asd', '432'),
(5, 'Андреев АП', 'Исполнитель', '467978', 'dfg', '546'),
(6, 'Александров ЛВ', 'Исполнитель', '675678', 'zxc', '432'),
(7, 'Смолов МА', 'Исполнитель', '956784', 'bvc', '534'),
(8, 'Матвеев ИА', 'Администратор', '3402349', 'admin', 'master');

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `request`
--
ALTER TABLE `request`
  ADD CONSTRAINT `R_1` FOREIGN KEY (`idclient`) REFERENCES `client` (`idclient`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `R_2` FOREIGN KEY (`idworker`) REFERENCES `worker` (`idworker`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `servicing`
--
ALTER TABLE `servicing`
  ADD CONSTRAINT `R_3` FOREIGN KEY (`idrequest`) REFERENCES `request` (`idrequest`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `R_4` FOREIGN KEY (`idservice`) REFERENCES `service` (`idservice`) ON DELETE CASCADE ON UPDATE CASCADE;



