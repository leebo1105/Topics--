<?php
// 連接到 MySQL 資料庫
$servername = "127.0.0.1";
$username = "root";
$password = "P@ssw0rd";
$dbname = "proj57";

$conn = new mysqli($servername, $username, $password, $dbname);

// 檢查連接是否成功
if ($conn->connect_error) {
    die("連接失敗: " . $conn->connect_error);
}

// 建立資料庫連接
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// 執行查詢，獲取所有商品資料
$stmt = $conn->prepare("SELECT * FROM products");
$stmt->execute();

// 將查詢結果轉換為 JSON 格式
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($products);
?>