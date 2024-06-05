<?php

// $db_host = '127.0.0.1';

// // 連到哪個資料庫
// $db_name = 'proj57';

// // 用途
// $db_user = 'root';

// $db_pass = 'P@ssw0rd';

// // 通訊埠
// $db_port = 3306;

// 導入API
require __DIR__. '/db-settings.php';
// 導入各值
$dsn = "mysql:host={$db_host};dbname={$db_name};port={$db_port};charset=utf8mb4";

$pdo_options = [
  PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
  PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];
// 資料庫連線的物件
// 建立變數 $pdo 
// 第一個放 $dsn 字串, 連線的用戶 , 用戶的密碼, 
$pdo = new PDO($dsn, $db_user, $db_pass, $pdo_options);
// 如要連第二個資料庫, 再建第二個 $pdo

# 啟動 session
if(! isset($_SESSION)) {
  # 如果沒有設定 $_SESSION, 才啟動
  session_start();
};
