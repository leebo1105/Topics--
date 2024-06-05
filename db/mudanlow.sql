-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2024-06-05 14:57:52
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
  `photos` varchar(255) DEFAULT NULL,
  `content` text,
  `key_word_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `bento`
--

CREATE TABLE `bento` (
  `item_id` int DEFAULT NULL,
  `id` int NOT NULL,
  `name` varchar(80) DEFAULT NULL,
  `price` int DEFAULT NULL,
  `image` varchar(1000) DEFAULT '[]'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `cart_status`
--

CREATE TABLE `cart_status` (
  `sid` int NOT NULL,
  `status_name` varchar(50) NOT NULL,
  `status_remark` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- 傾印資料表的資料 `cart_status`
--

INSERT INTO `cart_status` (`sid`, `status_name`, `status_remark`) VALUES
(1, '已送出訂單', '待店家確認'),
(2, '店家以確認', '訂單處於待處理狀態'),
(3, '取消訂單', '已取消'),
(4, '完成訂單', '商品已送達');

-- --------------------------------------------------------

--
-- 資料表結構 `combo_meal`
--

CREATE TABLE `combo_meal` (
  `item_id` int DEFAULT NULL,
  `id` int NOT NULL,
  `name` varchar(80) DEFAULT NULL,
  `price` int DEFAULT NULL,
  `image` varchar(1000) DEFAULT '[]'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `comments`
--

CREATE TABLE `comments` (
  `c_id` int NOT NULL,
  `value` int NOT NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `comments`
--

INSERT INTO `comments` (`c_id`, `value`, `content`, `created_at`) VALUES
(1, 5, 'asdfasdfasd', '2024-06-03 01:48:27'),
(2, 5, 'asdfasdf', '2024-06-03 01:48:39'),
(3, 3, 'asfadsfas', '2024-06-03 01:49:37'),
(4, 5, 'asfadsfasfhsghs', '2024-06-03 01:49:57'),
(5, 3, '1234', '2024-06-03 23:40:28'),
(11, 4, '12345', '2024-06-04 00:16:46'),
(12, 5, 'ajsdiofjasiofjaisofjoiasjdofijasoidfjaisdf\r\nasdfjasdjfiasdfiasdf\r\najsdofiajsdiofjasoidfjiaos', '2024-06-05 00:19:23');

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
(4, '赵六', '北京市朝阳区', '13765432109'),
(2, '李四', '广州市天河区', '13987654321'),
(5, '小明', '深圳市南山区', '13578901234'),
(3, '王五', '成都市武侯区', '13654321098'),
(6, '小红', '武汉市江汉区', '13678901234'),
(7, '小刚', '重庆市渝中区', '13578901235'),
(8, '小李', '西安市雁塔区', '13578901236'),
(9, '小华', '郑州市中原区', '13578901237'),
(10, '小明', '南京市鼓楼区', '13578901238'),
(11, '张四', '上海市浦东新区', '13812345679'),
(12, '李五', '广州市天河区', '13987654322'),
(13, '王六', '成都市武侯区', '13654321099'),
(14, '赵七', '北京市朝阳区', '13765432110'),
(15, '小八', '深圳市南山区', '13578901235'),
(16, '小九', '武汉市江汉区', '13578907236'),
(17, '小十', '重庆市渝中区', '13578901237'),
(18, '小十一', '西安市雁塔区', '13578901238'),
(19, '小十二', '郑州市中原区', '13578901239'),
(20, '小十三', '南京市鼓楼区', '13578901240'),
(21, '张十四', '上海市浦东新区', '13812345670'),
(22, '李十五', '广州市天河区', '13987654323'),
(23, '王十六', '成都市武侯区', '13654321090'),
(24, '赵十七', '北京市朝阳区', '13765432101'),
(25, '小十八', '深圳市南山区', '13578901241'),
(26, '小十九', '武汉市江汉区', '13578901242'),
(27, '小二十', '重庆市渝中区', '13578901243'),
(28, '小二十一', '西安市雁塔区', '13578901244'),
(29, '小二十二', '郑州市中原区', '13578901245'),
(30, '小二十三', '南京市鼓楼区', '13578901246');

-- --------------------------------------------------------

--
-- 資料表結構 `dessert`
--

CREATE TABLE `dessert` (
  `item_id` int DEFAULT NULL,
  `id` int NOT NULL,
  `name` varchar(80) DEFAULT NULL,
  `price` int DEFAULT NULL,
  `image` varchar(1000) DEFAULT '[]'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `drink`
--

CREATE TABLE `drink` (
  `item_id` int DEFAULT NULL,
  `id` int NOT NULL,
  `name` varchar(80) DEFAULT NULL,
  `price` int DEFAULT NULL,
  `image` varchar(1000) DEFAULT '[]'
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
-- 資料表結構 `liquor`
--

CREATE TABLE `liquor` (
  `item_id` int DEFAULT NULL,
  `id` int NOT NULL,
  `name` varchar(80) DEFAULT NULL,
  `price` int DEFAULT NULL,
  `image` varchar(1000) DEFAULT '[]'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `member_card`
--

CREATE TABLE `member_card` (
  `member_profile_id` int DEFAULT NULL,
  `status_id` int DEFAULT '1',
  `c_id` int DEFAULT NULL,
  `productName` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `totalPrice` decimal(10,2) DEFAULT NULL,
  `card_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `member_login`
--

CREATE TABLE `member_login` (
  `member_profile_id` int DEFAULT NULL,
  `account` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `hash` varchar(255) NOT NULL,
  `role` enum('user','admin') NOT NULL DEFAULT 'user',
  `status` enum('active','blacklist') NOT NULL DEFAULT 'active',
  `reason` varchar(255) DEFAULT NULL,
  `blacklist_date` datetime DEFAULT NULL COMMENT '黑名單日期'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- 傾印資料表的資料 `member_login`
--

INSERT INTO `member_login` (`member_profile_id`, `account`, `password`, `hash`, `role`, `status`, `reason`, `blacklist_date`) VALUES
(1, 'user1', 'admin', 'hashed_password', 'admin', 'active', NULL, NULL),
(2, 'user2', 'admin', 'hashed_password', 'admin', 'active', NULL, NULL),
(3, 'wangwu', 'password789', 'hashed_password', 'user', 'active', NULL, NULL),
(4, 'zhaoliu', 'password123', 'hashed_password', 'user', 'active', NULL, NULL),
(5, 'xiaoming', 'password456', 'hashed_password', 'user', 'active', NULL, NULL),
(6, 'xiaohong', 'password789', 'hashed_password', 'user', 'active', NULL, NULL),
(7, 'xiaogang', 'password123', 'hashed_password', 'user', 'active', NULL, NULL),
(8, 'xiaoli', 'password456', 'hashed_password', 'user', 'active', NULL, NULL),
(9, 'xiaohua', 'password789', 'hashed_password', 'user', 'active', NULL, NULL),
(10, 'xiaoming2', 'password123', 'hashed_password', 'user', 'active', NULL, NULL),
(11, 'zhangsi', 'password123', 'hashed_password', 'user', 'active', NULL, NULL),
(12, 'liwu', 'password456', 'hashed_password', 'user', 'active', NULL, NULL),
(13, 'wangliu', 'password789', 'hashed_password', 'user', 'active', NULL, NULL),
(14, 'zhaoqi', 'password123', 'hashed_password', 'user', 'active', NULL, NULL),
(15, 'xiaoba', 'password456', 'hashed_password', 'user', 'active', NULL, NULL),
(16, 'xiaojiu', 'password789', 'hashed_password', 'user', 'active', NULL, NULL),
(17, 'xiaoshi', 'password123', 'hashed_password', 'user', 'active', NULL, NULL),
(18, 'xiaoshier', 'password456', 'hashed_password', 'user', 'active', NULL, NULL),
(19, 'xiaoshisan', 'password789', 'hashed_password', 'user', 'active', NULL, NULL),
(20, 'xiaoshisi', 'password123', 'hashed_password', 'user', 'active', NULL, NULL),
(21, 'zhangshisi', 'password123', 'hashed_password', 'user', 'active', NULL, NULL),
(22, 'lishiwu', 'password456', 'hashed_password', 'user', 'active', NULL, NULL),
(23, 'wangshiliu', 'password789', 'hashed_password', 'user', 'active', NULL, NULL),
(24, 'zhaoshiqi', 'password123', 'hashed_password', 'user', 'active', NULL, NULL),
(25, 'xiaoshiba', 'password456', 'hashed_password', 'user', 'active', NULL, NULL),
(26, 'xiaoshijiu', 'password789', 'hashed_password', 'user', 'active', NULL, NULL),
(27, 'xiaoshierling', 'password123', 'hashed_password', 'user', 'active', NULL, NULL),
(28, 'xiaoshieryi', 'password456', 'hashed_password', 'user', 'active', NULL, NULL),
(29, 'xiaoshierer', 'password789', 'hashed_password', 'user', 'active', NULL, NULL),
(30, 'xiaoshiersan', 'password123', 'hashed_password', 'user', 'active', NULL, NULL);

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
(1, '张三', '男', 'zhangan@example.com', '13812345678', '1990-05-15', '2024-05-01 00:00:00'),
(2, '李四', '女', 'lii@example.com', '13987654321', '1988-10-20', '2024-05-02 00:00:00'),
(3, '王五', '男', 'wanwu@example.com', '13654321098', '1995-03-08', '2024-05-03 00:00:00'),
(4, '赵六', '女', 'zhaoliu@example.com', '13765432109', '1992-08-25', '2024-05-04 00:00:00'),
(5, '小明', '男', 'xiaoing@example.com', '13578901234', '1998-12-10', '2024-05-05 00:00:00'),
(6, '小红', '女', 'xiahng@example.com', '13658909234', '1997-11-20', '2024-05-06 00:00:00'),
(7, '小刚', '男', 'xiagang@example.com', '12315151155', '1996-09-15', '2024-05-07 00:00:00'),
(8, '小李', '女', 'xiaoliexample.com', '13578901236', '1994-07-05', '2024-05-08 00:00:00'),
(9, '小华', '男', 'xiohua@example.com', '13578971237', '1993-04-25', '2024-05-09 00:00:00'),
(10, '小明', '女', 'xiaoming2@example.com', '13578901238', '1991-02-15', '2024-05-10 00:00:00'),
(11, '张四', '男', 'zhangsi@example.com', '13812345679', '1991-05-15', '2024-05-11 00:00:00'),
(12, '李五', '女', 'liwu@example.com', '13987654322', '1989-10-20', '2024-05-12 00:00:00'),
(13, '王六', '男', 'angliu@example.com', '13654321099', '1996-03-08', '2024-05-13 00:00:00'),
(14, '赵七', '女', 'zhaoqi@example.com', '13765432110', '1993-08-25', '2024-05-14 00:00:00'),
(15, '小八', '男', 'xaoba@example.com', '13578901235', '1999-12-10', '2024-05-15 00:00:00'),
(16, '小九', '女', 'xiaojiu@example.com', '73578901236', '1992-07-10', '2024-05-16 00:00:00'),
(17, '小十', '男', 'xiaohi@example.com', '13578901237', '1995-04-10', '2024-05-17 00:00:00'),
(18, '小十一', '女', 'xiaoshier@example.com', '1357890238', '1994-02-10', '2024-05-18 00:00:00'),
(19, '小十二', '男', 'aoshisan@example.com', '13578901239', '1997-11-10', '2024-05-19 00:00:00'),
(20, '小十三', '女', 'aoshisi@example.com', '13578901240', '1998-09-10', '2024-05-20 00:00:00'),
(21, '张十四', '男', 'zhanshisi@example.com', '1381235670', '1992-05-15', '2024-05-21 00:00:00'),
(22, '李十五', '女', 'lishiwu@example.com', '13987654323', '1994-10-20', '2024-05-22 00:00:00'),
(23, '王十六', '男', 'wangshiliu@example.com', '1365321090', '1998-03-08', '2024-05-23 00:00:00'),
(24, '赵十七', '女', 'zaoshiqi@example.com', '13765432101', '1991-08-25', '2024-05-24 00:00:00'),
(25, '小十八', '男', 'xiashba@example.com', '1378901241', '1996-12-10', '2024-05-25 00:00:00'),
(26, '小十九', '女', 'xiashijiu@example.com', '1358901242', '1993-07-10', '2024-05-26 00:00:00'),
(27, '小二十', '男', 'xiaohierling@example.com', '13578901243', '1995-04-10', '2024-05-27 00:00:00'),
(28, '小二十一', '女', 'xiaoshieryi@example.com', '1357801244', '1997-02-10', '2024-05-28 00:00:00'),
(29, '小二十二', '男', 'xaoshierer@example.com', '1357890245', '1999-11-10', '2024-05-29 00:00:00'),
(30, '小二十三', '女', 'xiaoshersan@example.com', '1357901246', '2000-09-10', '2024-05-30 00:00:00');

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
(1, 'combo_meal'),
(2, 'product'),
(3, 'drink'),
(4, 'liquor'),
(5, 'dessert'),
(6, 'bento'),
(7, 'vacuum');

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
-- 資料表結構 `product`
--

CREATE TABLE `product` (
  `item_id` int DEFAULT NULL,
  `id` int NOT NULL,
  `name` varchar(80) NOT NULL,
  `price` int DEFAULT NULL,
  `image` varchar(1000) DEFAULT '[]'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `reservation`
--

CREATE TABLE `reservation` (
  `member_profile_id` int DEFAULT NULL,
  `id` int NOT NULL,
  `table_type` varchar(50) NOT NULL,
  `people` varchar(50) NOT NULL,
  `date` varchar(50) NOT NULL,
  `time` varchar(50) NOT NULL,
  `dining_method` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `vacuum`
--

CREATE TABLE `vacuum` (
  `item_id` int DEFAULT NULL,
  `id` int NOT NULL,
  `name` varchar(80) DEFAULT NULL,
  `price` int DEFAULT NULL,
  `image` varchar(1000) DEFAULT '[]'
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
-- 資料表索引 `bento`
--
ALTER TABLE `bento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_id` (`item_id`);

--
-- 資料表索引 `cart_status`
--
ALTER TABLE `cart_status`
  ADD PRIMARY KEY (`sid`);

--
-- 資料表索引 `combo_meal`
--
ALTER TABLE `combo_meal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_id` (`item_id`);

--
-- 資料表索引 `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`c_id`);

--
-- 資料表索引 `contact_book`
--
ALTER TABLE `contact_book`
  ADD KEY `member_profile_id` (`member_profile_id`);

--
-- 資料表索引 `dessert`
--
ALTER TABLE `dessert`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_id` (`item_id`);

--
-- 資料表索引 `drink`
--
ALTER TABLE `drink`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_id` (`item_id`);

--
-- 資料表索引 `key_words`
--
ALTER TABLE `key_words`
  ADD PRIMARY KEY (`k_id`);

--
-- 資料表索引 `liquor`
--
ALTER TABLE `liquor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_id` (`item_id`);

--
-- 資料表索引 `member_card`
--
ALTER TABLE `member_card`
  ADD KEY `member_profile_id` (`member_profile_id`),
  ADD KEY `status_id` (`status_id`);

--
-- 資料表索引 `member_login`
--
ALTER TABLE `member_login`
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
-- 資料表索引 `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_id` (`item_id`);

--
-- 資料表索引 `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `member_profile_id` (`member_profile_id`);

--
-- 資料表索引 `vacuum`
--
ALTER TABLE `vacuum`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_id` (`item_id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `articles`
--
ALTER TABLE `articles`
  MODIFY `a_id` int NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `bento`
--
ALTER TABLE `bento`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `cart_status`
--
ALTER TABLE `cart_status`
  MODIFY `sid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `combo_meal`
--
ALTER TABLE `combo_meal`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `comments`
--
ALTER TABLE `comments`
  MODIFY `c_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `dessert`
--
ALTER TABLE `dessert`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `drink`
--
ALTER TABLE `drink`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `liquor`
--
ALTER TABLE `liquor`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `member_profile`
--
ALTER TABLE `member_profile`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `menu_items`
--
ALTER TABLE `menu_items`
  MODIFY `item_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `product`
--
ALTER TABLE `product`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `vacuum`
--
ALTER TABLE `vacuum`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- 已傾印資料表的限制式
--

--
-- 資料表的限制式 `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `articles_ibfk_1` FOREIGN KEY (`key_word_id`) REFERENCES `key_words` (`k_id`);

--
-- 資料表的限制式 `bento`
--
ALTER TABLE `bento`
  ADD CONSTRAINT `bento_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `menu_items` (`item_id`);

--
-- 資料表的限制式 `combo_meal`
--
ALTER TABLE `combo_meal`
  ADD CONSTRAINT `combo_meal_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `menu_items` (`item_id`);

--
-- 資料表的限制式 `contact_book`
--
ALTER TABLE `contact_book`
  ADD CONSTRAINT `contact_book_ibfk_1` FOREIGN KEY (`member_profile_id`) REFERENCES `member_profile` (`id`);

--
-- 資料表的限制式 `dessert`
--
ALTER TABLE `dessert`
  ADD CONSTRAINT `dessert_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `menu_items` (`item_id`);

--
-- 資料表的限制式 `drink`
--
ALTER TABLE `drink`
  ADD CONSTRAINT `drink_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `menu_items` (`item_id`);

--
-- 資料表的限制式 `liquor`
--
ALTER TABLE `liquor`
  ADD CONSTRAINT `liquor_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `menu_items` (`item_id`);

--
-- 資料表的限制式 `member_card`
--
ALTER TABLE `member_card`
  ADD CONSTRAINT `member_card_ibfk_1` FOREIGN KEY (`member_profile_id`) REFERENCES `member_profile` (`id`),
  ADD CONSTRAINT `member_card_ibfk_2` FOREIGN KEY (`status_id`) REFERENCES `cart_status` (`sid`);

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
  ADD CONSTRAINT `orderlist_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `vacuum` (`id`);

--
-- 資料表的限制式 `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `menu_items` (`item_id`);

--
-- 資料表的限制式 `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`member_profile_id`) REFERENCES `member_profile` (`id`);

--
-- 資料表的限制式 `vacuum`
--
ALTER TABLE `vacuum`
  ADD CONSTRAINT `vacuum_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `menu_items` (`item_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
