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
member_profile_id int ,
account varchar(20) not null, #帳號, 不可為空
password varchar(255) not null, #密碼, 不可為空
hash varchar(255) not null, #用戶者密碼加密信息
role enum('user', 'admin')not null default 'user', #普通使用者與管理者, 用來登入區別後台or一般頁面
status enum('active', 'blacklist')not null default 'active', # 黑名單用
reason varchar(255), # 黑名單原因
blacklist_date datetime comment '黑名單日期',
foreign key (member_profile_id) references member_profile(id)
);

CREATE TABLE cart_status (
    sid int auto_increment primary key, # 狀態ID
    status_name varchar(50) not null, # 狀態名稱
    status_remark varchar(255) # 備註
);

INSERT INTO cart_status (status_name, status_remark) VALUES
('已送出訂單', '待店家確認'),
('店家以確認', '訂單處於待處理狀態'),
('取消訂單', '已取消'),
('完成訂單', '商品已送達');

create table member_card( #購物車
 member_profile_id int , #會員id
 status_id int default 1, # 購物車狀態ID
 c_id  int, #購物車ID,訂單編號
 productName varchar(255), #商品名稱
 price decimal(10,2), #商品價格
 quantity int(11), #數量
 totalPrice decimal(10,2), #總價
 card_date datetime not null, #帳單建立時間
 foreign key (member_profile_id) references member_profile(id),
 foreign key (status_id) references cart_status(sid)
 );
 


create table contact_book(	# 聯絡資料
member_profile_id int ,
receive_name varchar(50) default null, #收件者姓名, 可為空
address varchar(255) default null, #收件者地址, 可為空
contact_mobile varchar(15) default null, #收件者手機, 可為空
foreign key (member_profile_id) references member_profile(id)
);


-- 創建預約系統資料表 reservation
CREATE TABLE reservation (
	member_profile_id int ,
    id INT AUTO_INCREMENT PRIMARY KEY,
    table_type VARCHAR(50) NOT NULL,
    people VARCHAR(50) NOT NULL,
    date VARCHAR(50) NOT NULL,
    time VARCHAR(50) NOT NULL,
    dining_method VARCHAR(50) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    foreign key (member_profile_id) references member_profile(id)
);

-- 向 member_profile 表插入假数据
INSERT INTO member_profile (member_name, gender, email, mobile, birthday, create_date)
VALUES
    ('张三', '男', 'zhangan@example.com', '13812345678', '1990-05-15', '2024-05-01'),
('李四', '女', 'lii@example.com', '13987654321', '1988-10-20', '2024-05-02'),
('王五', '男', 'wanwu@example.com', '13654321098', '1995-03-08', '2024-05-03'),
('赵六', '女', 'zhaoliu@example.com', '13765432109', '1992-08-25', '2024-05-04'),
('小明', '男', 'xiaoing@example.com', '13578901234', '1998-12-10', '2024-05-05'),
('小红', '女', 'xiahng@example.com', '13658909234', '1997-11-20', '2024-05-06'),
('小刚', '男', 'xiagang@example.com', '12315151155', '1996-09-15', '2024-05-07'),
('小李', '女', 'xiaoliexample.com', '13578901236', '1994-07-05', '2024-05-08'),
('小华', '男', 'xiohua@example.com', '13578971237', '1993-04-25', '2024-05-09'),
('小明', '女', 'xiaoming2@example.com', '13578901238', '1991-02-15', '2024-05-10'),
('张四', '男', 'zhangsi@example.com', '13812345679', '1991-05-15', '2024-05-11'),
('李五', '女', 'liwu@example.com', '13987654322', '1989-10-20', '2024-05-12'),
('王六', '男', 'angliu@example.com', '13654321099', '1996-03-08', '2024-05-13'),
('赵七', '女', 'zhaoqi@example.com', '13765432110', '1993-08-25', '2024-05-14'),
('小八', '男', 'xaoba@example.com', '13578901235', '1999-12-10', '2024-05-15'),
('小九', '女', 'xiaojiu@example.com', '73578901236', '1992-07-10', '2024-05-16'),
('小十', '男', 'xiaohi@example.com', '13578901237', '1995-04-10', '2024-05-17'),
('小十一', '女', 'xiaoshier@example.com', '1357890238', '1994-02-10', '2024-05-18'),
('小十二', '男', 'aoshisan@example.com', '13578901239', '1997-11-10', '2024-05-19'),
('小十三', '女', 'aoshisi@example.com', '13578901240', '1998-09-10', '2024-05-20'),
('张十四', '男', 'zhanshisi@example.com', '1381235670', '1992-05-15', '2024-05-21'),
    ('李十五', '女', 'lishiwu@example.com', '13987654323', '1994-10-20', '2024-05-22'),
    ('王十六', '男', 'wangshiliu@example.com', '1365321090', '1998-03-08', '2024-05-23'),
    ('赵十七', '女', 'zaoshiqi@example.com', '13765432101', '1991-08-25', '2024-05-24'),
    ('小十八', '男', 'xiashba@example.com', '1378901241', '1996-12-10', '2024-05-25'),
    ('小十九', '女', 'xiashijiu@example.com', '1358901242', '1993-07-10', '2024-05-26'),
    ('小二十', '男', 'xiaohierling@example.com', '13578901243', '1995-04-10', '2024-05-27'),
    ('小二十一', '女', 'xiaoshieryi@example.com', '1357801244', '1997-02-10', '2024-05-28'),
    ('小二十二', '男', 'xaoshierer@example.com', '1357890245', '1999-11-10', '2024-05-29'),
    ('小二十三', '女', 'xiaoshersan@example.com', '1357901246', '2000-09-10', '2024-05-30');
   
-- 向 member_login 表插入假数据
INSERT INTO member_login (member_profile_id, account, password, hash, role)
VALUES
    (1, 'user1', 'admin', 'hashed_password', 'admin'),
    (2, 'user2', 'admin', 'hashed_password', 'admin'),
    (3, 'wangwu', 'password789', 'hashed_password', 'user'),
    (4, 'zhaoliu', 'password123', 'hashed_password', 'user'),
    (5, 'xiaoming', 'password456', 'hashed_password', 'user'),
    (6, 'xiaohong', 'password789', 'hashed_password', 'user'),
    (7, 'xiaogang', 'password123', 'hashed_password', 'user'),
    (8, 'xiaoli', 'password456', 'hashed_password', 'user'),
    (9, 'xiaohua', 'password789', 'hashed_password', 'user'),
    (10, 'xiaoming2', 'password123', 'hashed_password', 'user'),
    (11, 'zhangsi', 'password123', 'hashed_password', 'user'),
    (12, 'liwu', 'password456', 'hashed_password', 'user'),
    (13, 'wangliu', 'password789', 'hashed_password', 'user'),
    (14, 'zhaoqi', 'password123', 'hashed_password', 'user'),
    (15, 'xiaoba', 'password456', 'hashed_password', 'user'),
    (16, 'xiaojiu', 'password789', 'hashed_password', 'user'),
    (17, 'xiaoshi', 'password123', 'hashed_password', 'user'),
    (18, 'xiaoshier', 'password456', 'hashed_password', 'user'),
    (19, 'xiaoshisan', 'password789', 'hashed_password', 'user'),
    (20, 'xiaoshisi', 'password123', 'hashed_password', 'user'),
    (21, 'zhangshisi', 'password123', 'hashed_password', 'user'),
    (22, 'lishiwu', 'password456', 'hashed_password', 'user'),
    (23, 'wangshiliu', 'password789', 'hashed_password', 'user'),
    (24, 'zhaoshiqi', 'password123', 'hashed_password', 'user'),
    (25, 'xiaoshiba', 'password456', 'hashed_password', 'user'),
    (26, 'xiaoshijiu', 'password789', 'hashed_password', 'user'),
    (27, 'xiaoshierling', 'password123', 'hashed_password', 'user'),
    (28, 'xiaoshieryi', 'password456', 'hashed_password', 'user'),
    (29, 'xiaoshierer', 'password789', 'hashed_password', 'user'),
    (30, 'xiaoshiersan', 'password123', 'hashed_password', 'user');

-- 向 contact_book 表插入假数据
INSERT INTO contact_book (member_profile_id, receive_name, address, contact_mobile)
VALUES
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

-- 以下為菜單

CREATE TABLE menu_items ( #菜單分類
    item_id INT PRIMARY KEY AUTO_INCREMENT,
    item_name varchar(50)
);

insert into menu_items(item_name)
values
('combo_meal'), -- 合菜
('product'), -- 單點
('drink'), -- 飲品
('liquor'), -- 酒水
('dessert'), -- 甜點
('bento'), -- 便當
('vacuum') ; -- 真空包

#合菜

create table combo_meal(
item_id int, #分類編號
id int primary key auto_increment , -- 合菜編號
name varchar(80), -- 合菜名稱
price int ,
image varchar(1000) default '[]',
foreign key (item_id)
references menu_items (item_id)
 );

#甜點

create table dessert(
item_id int, #分類編號
id int primary key auto_increment,  -- 甜點編號
name varchar(80), -- 甜點名稱
price int, -- 甜點價錢
image varchar(1000) default '[]',
foreign key (item_id) 
references menu_items(item_id)
);

#飲料

create table drink (
item_id int, #分類編號
id int primary key auto_increment,  #飲料編號
name varchar(80),  #飲料名稱
price int,  #飲料價錢
image varchar(1000) default '[]',
foreign key (item_id) references menu_items(item_id)
);

#酒水

create table liquor(
item_id int, #分類編號
id int primary key auto_increment , #酒編號
name varchar(80), #酒名
price int, #酒價錢
image varchar(1000) default '[]',
foreign key (item_id) references menu_items(item_id)
);

#單點

create table product(
item_id int, #分類編號
id int primary key auto_increment, -- 單點編號
name varchar(80) not null,  -- 單點名稱
price int,  -- 單點價錢
image varchar(1000) default '[]',
foreign key (item_id) references menu_items(item_id)
);

#便當

create table bento(
item_id int, #分類編號
id int primary key auto_increment , #便當編號
name varchar(80), #便當價錢
price int, #便當價錢
image varchar(1000) default '[]',
foreign key (item_id) references menu_items(item_id)
);

#真空包

create table vacuum(
item_id int, #分類編號
id int primary key auto_increment, #真空包id
name varchar(80) , #真空包名稱
price int, #真空包價格
image varchar(1000) default '[]',
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
foreign key (product_id) references vacuum(id)
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
    photos VARCHAR(255),
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

-- 創建預約系統資料表 reservation
CREATE TABLE IF NOT EXISTS reservation (
    id INT AUTO_INCREMENT PRIMARY KEY,
    count INT NOT NULL,
    guests VARCHAR(255) NOT NULL,
    reservationDateTime DATE NOT NULL,
    timeSelect TIME NOT NULL,
    menuSelect VARCHAR(255) NOT NULL
);

