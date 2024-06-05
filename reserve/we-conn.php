<?php
// 資料庫連線設定
require __DIR__ . '/we-settings.php';


// 設定 PDO 連線字串
$dsn = "mysql:host={$db_host};dbname={$db_name};port={$db_port};charset=utf8mb4";

// PDO 連線設定
$pdo_options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    // 建立 PDO 連線物件
    $pdo = new PDO($dsn, $db_user, $db_pass, $pdo_options);
    // 顯示連線成功訊息
    echo "連線成功";
} catch (PDOException $e) {
    // 連線失敗，顯示錯誤訊息並停止執行
    die("連線失敗: " . $e->getMessage());
}
?>
