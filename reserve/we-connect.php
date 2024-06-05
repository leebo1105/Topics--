<?php
require __DIR__ . '/we-settings.php';

$dsn = "mysql:host={$db_host};dbname={$db_name};port={$db_port};charset=utf8mb4";

$pdo_options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO($dsn, $db_user, $db_pass, $pdo_options);
} catch (PDOException $e) {
    die("資料庫連線失敗: " . $e->getMessage());
}

// 啟動 session
if (!isset($_SESSION)) {
    session_start();
}
?>
