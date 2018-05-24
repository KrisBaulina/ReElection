-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 24 2018 г., 18:31
-- Версия сервера: 5.6.37
-- Версия PHP: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `ReElection`
--

-- --------------------------------------------------------

--
-- Структура таблицы `Contract`
--

CREATE TABLE `Contract` (
  `idContract` int(11) NOT NULL,
  `Teacher` int(11) NOT NULL,
  `ConditionOfAttraction` int(11) NOT NULL,
  `ExpirationOfTheTerm` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `Contract`
--

INSERT INTO `Contract` (`idContract`, `Teacher`, `ConditionOfAttraction`, `ExpirationOfTheTerm`) VALUES
(1, 1, 1, '2017-06-30'),
(2, 3, 2, '2018-07-01'),
(3, 4, 1, '2018-06-30'),
(4, 8, 2, '2017-06-01'),
(5, 7, 1, '2018-07-12'),
(7, 36, 1, '2019-05-19');

-- --------------------------------------------------------

--
-- Структура таблицы `Contract_type`
--

CREATE TABLE `Contract_type` (
  `idContract_type` int(11) NOT NULL,
  `ContractTypeName` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `Contract_type`
--

INSERT INTO `Contract_type` (`idContract_type`, `ContractTypeName`) VALUES
(1, 'Штатный преподаватель'),
(2, 'Внешний совместитель'),
(3, 'Внутренний совместитель'),
(4, 'Договор ГПХ');

-- --------------------------------------------------------

--
-- Структура таблицы `Degree`
--

CREATE TABLE `Degree` (
  `idDegree` int(11) NOT NULL,
  `DegreeName` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `Degree`
--

INSERT INTO `Degree` (`idDegree`, `DegreeName`) VALUES
(1, 'Канд. техн. наук'),
(2, 'Канд. экон. наук'),
(3, 'Канд. физ.-мат. наук'),
(4, 'Д-р. техн. наук'),
(5, 'Д-р. экон. наук'),
(6, 'Д-р. физ.-мат. наук'),
(7, '-');

-- --------------------------------------------------------

--
-- Структура таблицы `Position`
--

CREATE TABLE `Position` (
  `idPosition` int(11) NOT NULL,
  `PositionName` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `Position`
--

INSERT INTO `Position` (`idPosition`, `PositionName`) VALUES
(1, 'Профессор'),
(2, 'Доцент'),
(3, 'Старший преподаватель'),
(4, 'Преподаватель СПО'),
(5, 'Ассистент');

-- --------------------------------------------------------

--
-- Структура таблицы `Rank`
--

CREATE TABLE `Rank` (
  `idRank` int(11) NOT NULL,
  `RankName` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `Rank`
--

INSERT INTO `Rank` (`idRank`, `RankName`) VALUES
(1, 'Доцент'),
(2, 'Профессор'),
(3, 'Старший научный сотрудник'),
(4, 'Академик'),
(5, '-');

-- --------------------------------------------------------

--
-- Структура таблицы `Teacher`
--

CREATE TABLE `Teacher` (
  `PersonnelNumber` int(11) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `FirstName` varchar(50) NOT NULL,
  `Patronymic` varchar(50) DEFAULT NULL,
  `Address` varchar(100) DEFAULT NULL,
  `Phone` varchar(45) DEFAULT NULL,
  `Rank` int(11) DEFAULT NULL,
  `Position` int(11) NOT NULL,
  `Degree` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `Teacher`
--

INSERT INTO `Teacher` (`PersonnelNumber`, `LastName`, `FirstName`, `Patronymic`, `Address`, `Phone`, `Rank`, `Position`, `Degree`) VALUES
(1, 'Свиридов', ' Олег ', 'Петрович', 'г. Новосибирск, ул. Фрунзе, дом 45, кв. 27', '89236521295', 1, 2, 3),
(2, 'Наумова ', 'Елена ', 'Геннадьевна', 'г. Новосибирск, ул. Каменская, дом 12, кв. 36', '89130269585', 2, 1, 1),
(3, 'Шипицына', 'Юлия ', 'Денисовна', 'г.Новосибирск, ул. Гоголя, дом 69, кв. 254', '89393004796', NULL, 3, NULL),
(4, 'Соколов ', 'Даниил ', 'Михаилович ', 'г.Новосибирск,ул. Степная, дом 27, кв. 20', NULL, NULL, 2, 1),
(5, 'Огородников', 'Петр', 'Федорович', 'г. Новосибирск, ул. Ленина, дом 25, кв. 263 ', '89629316451', 3, 1, 4),
(6, 'Гребнева', 'Елизавета', 'Николаевна', 'г. Новосибирск, ул. Бакинская, дом 36, кв. 1', '89050687412', 1, 2, 2),
(7, 'Журавлёв', 'Дмитрий', 'Викторович', 'г. Новосибирск, ул. Авиастроителей, дом 86, кв. 54', '89236501985', NULL, 4, 2),
(8, 'Егоров', 'Борис', 'Иванович', 'г. Новосибирск, ул. Железнодорожников, дом 25, кв. 74', '89511467020', 1, 2, 4),
(36, 'test', 'test', 'test', 'test', 'test', 1, 1, 1);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `Contract`
--
ALTER TABLE `Contract`
  ADD PRIMARY KEY (`idContract`),
  ADD KEY `Fk_Teacher_idx` (`Teacher`),
  ADD KEY `Fk_Attraction_idx` (`ConditionOfAttraction`);

--
-- Индексы таблицы `Contract_type`
--
ALTER TABLE `Contract_type`
  ADD PRIMARY KEY (`idContract_type`),
  ADD UNIQUE KEY `idCondition_of_attraction_UNIQUE` (`idContract_type`);

--
-- Индексы таблицы `Degree`
--
ALTER TABLE `Degree`
  ADD PRIMARY KEY (`idDegree`),
  ADD UNIQUE KEY `idAcademic_degree_UNIQUE` (`idDegree`);

--
-- Индексы таблицы `Position`
--
ALTER TABLE `Position`
  ADD PRIMARY KEY (`idPosition`),
  ADD UNIQUE KEY `idPost_UNIQUE` (`idPosition`);

--
-- Индексы таблицы `Rank`
--
ALTER TABLE `Rank`
  ADD PRIMARY KEY (`idRank`);

--
-- Индексы таблицы `Teacher`
--
ALTER TABLE `Teacher`
  ADD PRIMARY KEY (`PersonnelNumber`),
  ADD UNIQUE KEY `idTeaching_staff_UNIQUE` (`PersonnelNumber`),
  ADD KEY `Fk_Rank_idx` (`Rank`),
  ADD KEY `Fk_Post_idx` (`Position`),
  ADD KEY `Fk_Degree_idx` (`Degree`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `Contract`
--
ALTER TABLE `Contract`
  MODIFY `idContract` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT для таблицы `Contract_type`
--
ALTER TABLE `Contract_type`
  MODIFY `idContract_type` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблицы `Degree`
--
ALTER TABLE `Degree`
  MODIFY `idDegree` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT для таблицы `Position`
--
ALTER TABLE `Position`
  MODIFY `idPosition` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT для таблицы `Rank`
--
ALTER TABLE `Rank`
  MODIFY `idRank` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT для таблицы `Teacher`
--
ALTER TABLE `Teacher`
  MODIFY `PersonnelNumber` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `Contract`
--
ALTER TABLE `Contract`
  ADD CONSTRAINT `Fk_Attraction` FOREIGN KEY (`ConditionOfAttraction`) REFERENCES `Contract_type` (`idContract_type`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `Fk_Teacher` FOREIGN KEY (`Teacher`) REFERENCES `Teacher` (`PersonnelNumber`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `Teacher`
--
ALTER TABLE `Teacher`
  ADD CONSTRAINT `Fk_Degree` FOREIGN KEY (`Degree`) REFERENCES `Degree` (`idDegree`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `Fk_Position` FOREIGN KEY (`Position`) REFERENCES `Position` (`idPosition`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `Fk_Rank` FOREIGN KEY (`Rank`) REFERENCES `Rank` (`idRank`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
