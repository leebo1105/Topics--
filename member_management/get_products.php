<?php
// 連接到 MySQL 資料庫
$servername = "127.0.0.1";
$username = "root";
$password = "P@ssw0rd";
$dbname = "mudanlow";

// 建立資料庫連線
$conn = new mysqli($servername, $username, $password, $dbname);

// 檢查連線是否成功
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 查詢資料庫中的商品資料
$sql = "SELECT * FROM products";
$result = $conn->query($sql);

$products = array();

// 將查詢結果轉換為 JSON 格式
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
}

// 釋放資料庫連線
$conn->close();

// 輸出 JSON 格式的商品資料
header('Content-Type: application/json');
echo json_encode($products);
?>
