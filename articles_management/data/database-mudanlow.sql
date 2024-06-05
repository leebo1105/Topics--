create database mudanlow;
use mudanlow;
-- drop database mudanlow;
create table member_profile( #主表, 會員基本資料/註冊, 欄位皆不可為空
id int auto_increment primary key, #會員id
member_name varchar(50) not null, #會員姓名
gender varchar(5) not null, #性別
email varchar(254) not null unique, #會員信箱,唯一
mobile varchar(15) not null unique, #會員手機,唯一
birthday date not null, #生日
create_date datetime not null #帳號建立日期, 不可為空
);

create table member_login( #會員登入
member_profile_id int,
account varchar(20) not null unique, #帳號, 不可為空
password varchar(30) not null, #密碼, 不可為空
hash varchar(255) not null, #用戶者密碼加密信息
foreign key (member_profile_id) references member_profile(id)
);

create table contact_book(	# 聯絡資料
member_profile_id int,
receive_name varchar(50) default null, #收件者姓名, 可為空
address varchar(255) default null, #收件者地址, 可為空
contact_mobile varchar(15) unique default null, #收件者手機, 可為空
foreign key (member_profile_id) references member_profile(id)
);

-- 插入会员基本资料
INSERT INTO member_profile (member_name, gender, email, mobile, birthday, create_date) VALUES
('张三', '男', 'zhangsan@example.com', '13812345678', '1990-05-15', '2024-05-01'),
('李四', '女', 'lisi@example.com', '13987654321', '1988-10-20', '2024-05-02'),
('王五', '男', 'wangwu@example.com', '13654321098', '1995-03-08', '2024-05-03'),
('赵六', '女', 'zhaoliu@example.com', '13765432109', '1992-08-25', '2024-05-04'),
('小明', '男', 'xiaoming@example.com', '13578901234', '1998-12-10', '2024-05-05');

-- 插入会员登录信息
INSERT INTO member_login (member_profile_id, account, password, hash) VALUES
(1, 'zhangsan', 'password123', 'hash_value_zhangsan'),
(2, 'lisi', 'password456', 'hash_value_lisi'),
(3, 'wangwu', 'password789', 'hash_value_wangwu'),
(4, 'zhaoliu', 'passwordabc', 'hash_value_zhaoliu'),
(5, 'xiaoming', 'passwordxyz', 'hash_value_xiaoming');

-- 插入聯絡資料
INSERT INTO contact_book (member_profile_id, receive_name, address, contact_mobile) VALUES
(1, '张三', '上海市浦东新区', '13812345678'),
(2, '李四', '北京市朝阳区', '13987654321'),
(3, '王五', '广州市天河区', '13654321098'),
(4, '赵六', '深圳市福田区', '13765432109'),
(5, '小明', NULL, NULL);


-- 以下為預約

CREATE TABLE reserve (  #預約
id INT PRIMARY KEY AUTO_INCREMENT,
member_id int, #預約的會員id
time DATETIME NOT NULL, #預約時間和日期
foreign key (member_id) references member_profile(id)
);

-- 以下為菜單

CREATE TABLE menu_items ( #菜單分類
    item_id INT PRIMARY KEY AUTO_INCREMENT,
    item_name varchar(50)
);

insert into menu_items(item_name)
values
('combo_meals'), -- 合菜
('products'), -- 單點
('drinks'), -- 飲品
('liquors'), -- 酒水
('desserts'), -- 甜點
('bento'), -- 便當
('vacuums') ; -- 真空包

#合菜

create table combo_meals(
item_id int, #分類編號
combo_meal_id int primary key auto_increment , -- 合菜編號
combo_meal_name varchar(80), -- 合菜名稱
combo_meal_price int , -- 合菜價錢
foreign key (item_id)
references menu_items (item_id)
 );

#甜點

create table desserts(
item_id int, #分類編號
dessert_id int primary key auto_increment,  -- 甜點編號
dessert_name varchar(80), -- 甜點名稱
dessert_price int, -- 甜點價錢
foreign key (item_id) 
references menu_items(item_id)
);

#飲料

create table drinks (
item_id int, #分類編號
drink_id int primary key auto_increment,  #飲料編號
drink_name varchar(80),  #飲料名稱
drink_price int,  #飲料價錢
foreign key (item_id) references menu_items(item_id)
);

#酒水

create table liquors(
item_id int, #分類編號
liquor_id int primary key , #酒編號
liquor_name varchar(80), #酒名
liquor_price int, #酒價錢
foreign key (item_id) references menu_items(item_id)
);

#單點

create table products(
item_id int, #分類編號
product_id int primary key auto_increment, -- 單點編號
product_name varchar(80) not null,  -- 單點名稱
product_price int,  -- 單點價錢
foreign key (item_id) references menu_items(item_id)
);

#便當

create table bentos(
item_id int, #分類編號
bento_id int primary key auto_increment , #便當編號
bento_name varchar(80), #便當價錢
bento_price int, #便當價錢
foreign key (item_id) references menu_items(item_id)
);

#真空包

create table vacuums(
item_id int, #分類編號
vacuum_id int primary key auto_increment, #真空包id
vacuum_name varchar(80) , #真空包名稱
vacuum_price int, #真空包價格
foreign key (item_id) references menu_items (item_id)
);

-- 以下為訂單

create table orderlist(
o_id int primary key, #訂單編號
member_id int, #會員id
product_id int, #產品id
product_time datetime, #訂單時間
product_quantity int, #訂單數量
foreign key (member_id) references member_profile(id),
foreign key (product_id) references vacuums(vacuum_id)
);

-- 以下是文章

create table key_words (
k_id int primary key, #關鍵字id
key_name varchar(10) #關鍵字
);

CREATE TABLE articles (
    a_id INT AUTO_INCREMENT PRIMARY KEY,
    date DATE,
    title VARCHAR(255),
    image VARCHAR(255),
    content TEXT,
    key_word_id int, #文章關鍵字
    foreign key (key_word_id) references key_words (k_id)
);

insert into key_words
value
(1,"所有文章"),
(2,"新菜消息"),
(3,"節慶活動"),
(4,"公休時間"),
(5,"貓咪認養");