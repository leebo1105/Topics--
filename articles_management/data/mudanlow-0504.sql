-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2024-05-03 16:57:41
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
-- 資料庫： `mudanlow`
--

-- --------------------------------------------------------

--
-- 資料表結構 `articles`
--

CREATE TABLE `articles` (
  `a_id` int NOT NULL,
  `date` date DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` text,
  `key_word_id` int DEFAULT NULL,
  `photos` varchar(255) NOT NULL DEFAULT '[]'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- 傾印資料表的資料 `articles`
--

INSERT INTO `articles` (`a_id`, `date`, `title`, `content`, `key_word_id`, `photos`) VALUES
(74, '2024-05-08', 'aefeafsef', 'aesfasefasef', 4, '[\"6b52433fd1a33d418ee6768b9bf9e8a836e3b209.png\"]'),
(75, '2024-05-16', 'ersagreg', 'sergsergesr', 4, '[\"b57eea9fecb3bfe5084e071ebba7eaa90c1df7ff.png\"]'),
(76, '2024-05-16', 'sgargaerg', 'aergaergqaerg', 3, '[\"8a423ced029a16454a56d3339f1f6c4922c82d2d.jpg\"]'),
(77, '2024-05-16', 'asefasef', 'aefaefase', 3, '[\"6e9c200870d4a91f0de33a925c624b444e147252.png\"]'),
(78, '2024-05-15', 'awefawef', 'waefawefaw', 3, '[\"03e877b1a26e5c6cd956f684451abe0bfb7ea50b.png\"]'),
(79, '2024-05-07', 'aefawse', 'asefasef', 5, '[\"9355b263f5b80ee9b142a49e1a57a989694a3f90.png\"]'),
(80, '2024-05-16', 'aefasefsa', 'asefasfaes', 4, '[\"610aeafb93f4ce5a5fdcfcee16a7af1247556555.png\"]'),
(81, '2024-05-17', 'gjhrsths', 'hstrhsrths', 3, '[\"40b57365f72c3e0812502a5455abd41f58f51704.png\"]'),
(83, '2024-05-15', 'awefawefawef', 'aefaefaesfa', 5, '[\"f3b72cdb23adfe4a3f130ecfe68833a93e1d3d83.png\"]');

-- --------------------------------------------------------

--
-- 資料表結構 `bentos`
--

CREATE TABLE `bentos` (
  `item_id` int DEFAULT NULL,
  `bento_id` int NOT NULL,
  `bento_name` varchar(80) DEFAULT NULL,
  `bento_price` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `combo_meals`
--

CREATE TABLE `combo_meals` (
  `item_id` int DEFAULT NULL,
  `combo_meal_id` int NOT NULL,
  `combo_meal_name` varchar(80) DEFAULT NULL,
  `combo_meal_price` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `contact_book`
--

CREATE TABLE `contact_book` (
  `member_profile_id` int DEFAULT NULL,
  `receive_name` varchar(50) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `contact_mobile` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- 傾印資料表的資料 `contact_book`
--

INSERT INTO `contact_book` (`member_profile_id`, `receive_name`, `address`, `contact_mobile`) VALUES
(1, '张三', '上海市浦东新区', '13812345678'),
(2, '李四', '北京市朝阳区', '13987654321'),
(3, '王五', '广州市天河区', '13654321098'),
(4, '赵六', '深圳市福田区', '13765432109'),
(5, '小明', NULL, NULL);

-- --------------------------------------------------------

--
-- 資料表結構 `desserts`
--

CREATE TABLE `desserts` (
  `item_id` int DEFAULT NULL,
  `dessert_id` int NOT NULL,
  `dessert_name` varchar(80) DEFAULT NULL,
  `dessert_price` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `drinks`
--

CREATE TABLE `drinks` (
  `item_id` int DEFAULT NULL,
  `drink_id` int NOT NULL,
  `drink_name` varchar(80) DEFAULT NULL,
  `drink_price` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `key_words`
--

CREATE TABLE `key_words` (
  `k_id` int NOT NULL,
  `key_name` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- 傾印資料表的資料 `key_words`
--

INSERT INTO `key_words` (`k_id`, `key_name`) VALUES
(1, '所有文章'),
(2, '新菜消息'),
(3, '節慶活動'),
(4, '公休時間'),
(5, '貓咪認養');

-- --------------------------------------------------------

--
-- 資料表結構 `liquors`
--

CREATE TABLE `liquors` (
  `item_id` int DEFAULT NULL,
  `liquor_id` int NOT NULL,
  `liquor_name` varchar(80) DEFAULT NULL,
  `liquor_price` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `member_login`
--

CREATE TABLE `member_login` (
  `member_profile_id` int DEFAULT NULL,
  `account` varchar(20) NOT NULL,
  `password` varchar(30) NOT NULL,
  `hash` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- 傾印資料表的資料 `member_login`
--

INSERT INTO `member_login` (`member_profile_id`, `account`, `password`, `hash`) VALUES
(2, 'lisi', 'password456', 'hash_value_lisi'),
(3, 'wangwu', 'password789', 'hash_value_wangwu'),
(5, 'xiaoming', 'passwordxyz', 'hash_value_xiaoming'),
(1, 'zhangsan', 'password123', 'hash_value_zhangsan'),
(4, 'zhaoliu', 'passwordabc', 'hash_value_zhaoliu');

-- --------------------------------------------------------

--
-- 資料表結構 `member_profile`
--

CREATE TABLE `member_profile` (
  `id` int NOT NULL,
  `member_name` varchar(50) NOT NULL,
  `gender` varchar(5) NOT NULL,
  `email` varchar(254) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `birthday` date NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- 傾印資料表的資料 `member_profile`
--

INSERT INTO `member_profile` (`id`, `member_name`, `gender`, `email`, `mobile`, `birthday`, `create_date`) VALUES
(1, '张三', '男', 'zhangsan@example.com', '13812345678', '1990-05-15', '2024-05-01 00:00:00'),
(2, '李四', '女', 'lisi@example.com', '13987654321', '1988-10-20', '2024-05-02 00:00:00'),
(3, '王五', '男', 'wangwu@example.com', '13654321098', '1995-03-08', '2024-05-03 00:00:00'),
(4, '赵六', '女', 'zhaoliu@example.com', '13765432109', '1992-08-25', '2024-05-04 00:00:00'),
(5, '小明', '男', 'xiaoming@example.com', '13578901234', '1998-12-10', '2024-05-05 00:00:00');

-- --------------------------------------------------------

--
-- 資料表結構 `menu_items`
--

CREATE TABLE `menu_items` (
  `item_id` int NOT NULL,
  `item_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- 傾印資料表的資料 `menu_items`
--

INSERT INTO `menu_items` (`item_id`, `item_name`) VALUES
(1, 'combo_meals'),
(2, 'products'),
(3, 'drinks'),
(4, 'liquors'),
(5, 'desserts'),
(6, 'bento'),
(7, 'vacuums');

-- --------------------------------------------------------

--
-- 資料表結構 `orderlist`
--

CREATE TABLE `orderlist` (
  `o_id` int NOT NULL,
  `member_id` int DEFAULT NULL,
  `product_id` int DEFAULT NULL,
  `product_time` datetime DEFAULT NULL,
  `product_quantity` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `products`
--

CREATE TABLE `products` (
  `item_id` int DEFAULT NULL,
  `product_id` int NOT NULL,
  `product_name` varchar(80) NOT NULL,
  `product_price` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `reserve`
--

CREATE TABLE `reserve` (
  `id` int NOT NULL,
  `member_id` int DEFAULT NULL,
  `time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `vacuums`
--

CREATE TABLE `vacuums` (
  `item_id` int DEFAULT NULL,
  `vacuum_id` int NOT NULL,
  `vacuum_name` varchar(80) DEFAULT NULL,
  `vacuum_price` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`a_id`),
  ADD KEY `key_word_id` (`key_word_id`);

--
-- 資料表索引 `bentos`
--
ALTER TABLE `bentos`
  ADD PRIMARY KEY (`bento_id`),
  ADD KEY `item_id` (`item_id`);

--
-- 資料表索引 `combo_meals`
--
ALTER TABLE `combo_meals`
  ADD PRIMARY KEY (`combo_meal_id`),
  ADD KEY `item_id` (`item_id`);

--
-- 資料表索引 `contact_book`
--
ALTER TABLE `contact_book`
  ADD UNIQUE KEY `contact_mobile` (`contact_mobile`),
  ADD KEY `member_profile_id` (`member_profile_id`);

--
-- 資料表索引 `desserts`
--
ALTER TABLE `desserts`
  ADD PRIMARY KEY (`dessert_id`),
  ADD KEY `item_id` (`item_id`);

--
-- 資料表索引 `drinks`
--
ALTER TABLE `drinks`
  ADD PRIMARY KEY (`drink_id`),
  ADD KEY `item_id` (`item_id`);

--
-- 資料表索引 `key_words`
--
ALTER TABLE `key_words`
  ADD PRIMARY KEY (`k_id`);

--
-- 資料表索引 `liquors`
--
ALTER TABLE `liquors`
  ADD PRIMARY KEY (`liquor_id`),
  ADD KEY `item_id` (`item_id`);

--
-- 資料表索引 `member_login`
--
ALTER TABLE `member_login`
  ADD UNIQUE KEY `account` (`account`),
  ADD KEY `member_profile_id` (`member_profile_id`);

--
-- 資料表索引 `member_profile`
--
ALTER TABLE `member_profile`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `mobile` (`mobile`);

--
-- 資料表索引 `menu_items`
--
ALTER TABLE `menu_items`
  ADD PRIMARY KEY (`item_id`);

--
-- 資料表索引 `orderlist`
--
ALTER TABLE `orderlist`
  ADD PRIMARY KEY (`o_id`),
  ADD KEY `member_id` (`member_id`),
  ADD KEY `product_id` (`product_id`);

--
-- 資料表索引 `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `item_id` (`item_id`);

--
-- 資料表索引 `reserve`
--
ALTER TABLE `reserve`
  ADD PRIMARY KEY (`id`),
  ADD KEY `member_id` (`member_id`);

--
-- 資料表索引 `vacuums`
--
ALTER TABLE `vacuums`
  ADD PRIMARY KEY (`vacuum_id`),
  ADD KEY `item_id` (`item_id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `articles`
--
ALTER TABLE `articles`
  MODIFY `a_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `bentos`
--
ALTER TABLE `bentos`
  MODIFY `bento_id` int NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `combo_meals`
--
ALTER TABLE `combo_meals`
  MODIFY `combo_meal_id` int NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `desserts`
--
ALTER TABLE `desserts`
  MODIFY `dessert_id` int NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `drinks`
--
ALTER TABLE `drinks`
  MODIFY `drink_id` int NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `member_profile`
--
ALTER TABLE `member_profile`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `menu_items`
--
ALTER TABLE `menu_items`
  MODIFY `item_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `reserve`
--
ALTER TABLE `reserve`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `vacuums`
--
ALTER TABLE `vacuums`
  MODIFY `vacuum_id` int NOT NULL AUTO_INCREMENT;

--
-- 已傾印資料表的限制式
--

--
-- 資料表的限制式 `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `articles_ibfk_1` FOREIGN KEY (`key_word_id`) REFERENCES `key_words` (`k_id`);

--
-- 資料表的限制式 `bentos`
--
ALTER TABLE `bentos`
  ADD CONSTRAINT `bentos_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `menu_items` (`item_id`);

--
-- 資料表的限制式 `combo_meals`
--
ALTER TABLE `combo_meals`
  ADD CONSTRAINT `combo_meals_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `menu_items` (`item_id`);

--
-- 資料表的限制式 `contact_book`
--
ALTER TABLE `contact_book`
  ADD CONSTRAINT `contact_book_ibfk_1` FOREIGN KEY (`member_profile_id`) REFERENCES `member_profile` (`id`);

--
-- 資料表的限制式 `desserts`
--
ALTER TABLE `desserts`
  ADD CONSTRAINT `desserts_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `menu_items` (`item_id`);

--
-- 資料表的限制式 `drinks`
--
ALTER TABLE `drinks`
  ADD CONSTRAINT `drinks_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `menu_items` (`item_id`);

--
-- 資料表的限制式 `liquors`
--
ALTER TABLE `liquors`
  ADD CONSTRAINT `liquors_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `menu_items` (`item_id`);

--
-- 資料表的限制式 `member_login`
--
ALTER TABLE `member_login`
  ADD CONSTRAINT `member_login_ibfk_1` FOREIGN KEY (`member_profile_id`) REFERENCES `member_profile` (`id`);

--
-- 資料表的限制式 `orderlist`
--
ALTER TABLE `orderlist`
  ADD CONSTRAINT `orderlist_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `member_profile` (`id`),
  ADD CONSTRAINT `orderlist_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `vacuums` (`vacuum_id`);

--
-- 資料表的限制式 `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `menu_items` (`item_id`);

--
-- 資料表的限制式 `reserve`
--
ALTER TABLE `reserve`
  ADD CONSTRAINT `reserve_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `member_profile` (`id`);

--
-- 資料表的限制式 `vacuums`
--
ALTER TABLE `vacuums`
  ADD CONSTRAINT `vacuums_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `menu_items` (`item_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
