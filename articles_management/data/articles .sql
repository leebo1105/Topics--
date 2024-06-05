-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2024 年 05 月 01 日 19:18
-- 伺服器版本： 8.0.36
-- PHP 版本： 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `my_articles`
--

-- --------------------------------------------------------

--
-- 資料表結構 `articles`
--

CREATE TABLE `articles` (
  `a_id` int NOT NULL,
  `date` date DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `content` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- 傾印資料表的資料 `articles`
--

INSERT INTO `articles` (`a_id`, `date`, `title`, `image`, `content`) VALUES
(1, '2024-05-23', '14564', 'wad4a6w', 'awd614a654w'),
(2, '2024-05-22', 'aswdawd', '210a32w1', 'awdawda61'),
(3, '2024-05-14', '4536546', '456546', '456456/767'),
(4, '2024-05-14', '4536546', '456546', '456456/767'),
(5, '2024-05-22', '45345', '4564', '45646878'),
(6, '2024-05-23', '43753asdfs', 'asfawfawfawf', 'arhaerhaerh');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`a_id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `articles`
--
ALTER TABLE `articles`
  MODIFY `a_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
