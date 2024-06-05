<?php
session_start();

// 检查会话中是否存在会员ID
if (isset($_SESSION['admin']['id'])) {
    // 获取会员ID
    $memberId = $_SESSION['admin']['id'];
} else {
    // 沒id > 登陸介面
    json_encode(["success" => false]);
    exit; 
}

// 解析從前端發送的 JSON 資料
$cartData = json_decode(file_get_contents("php://input"), true);

// 建立資料庫連接
$conn = new mysqli("127.0.0.1", "root", "P@ssw0rd", "mudanlow");

// 檢查連接是否成功
if ($conn->connect_error) {
    die("資料庫連接失敗：" . $conn->connect_error);
}
// 在外部先取值
$cId = rand(100000, 999999); // 隨機值

// 準備插入購物車資訊的 SQL 語句
$insertValues = [];
foreach ($cartData['cart'] as $productId => $product) {
    $productName = $conn->real_escape_string($product['name']);
    $price = $product['price'];
    $quantity = $product['quantity'];
    $totalPrice = $price * $quantity;
    
    $insertValues[] = "('$memberId', $cId,'$productName', $price, $quantity, $totalPrice, CURRENT_TIMESTAMP)"; // CURRENT_TIMESTAMP 取當前時間
}

// 執行插入資料的 SQL 語句
if (!empty($insertValues)) {
    $sql = "INSERT INTO member_card (member_profile_id, c_id, productName, price, quantity, totalPrice, card_date) VALUES " . implode(", ", $insertValues);
    if ($conn->query($sql) === TRUE) {
        echo json_encode(["success" => true, "c_id" => $cId]);
    } else {
        echo json_encode(["success" => false, "error" => "插入購物車資訊時發生錯誤：" . $conn->error]);
    }
} else {
    echo json_encode(["success" => false, "error" => "沒有要插入的購物車資訊"]);
}

// 關閉資料庫連接
$conn->close();
?>
