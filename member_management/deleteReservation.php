<?php
// 開始 session
if (!isset($_SESSION)) {
    session_start();
}

// 檢查是否已登入
if (!isset($_SESSION['admin'])) {
    die("未登入，請先登入會員系統");
}

// 連接資料庫
$mysqli = new mysqli("localhost", "root", "P@ssw0rd", "mudanlow");

// 檢查連線
if ($mysqli->connect_error) {
    die("連線失敗: " . $mysqli->connect_error);
}

// 獲取前端傳遞的預約 ID
$reservationId = $_POST['id'];

// 準備 SQL 語句
$sql = "DELETE FROM reservation WHERE id = ?";
$stmt = $mysqli->prepare($sql);

// 綁定參數並執行查詢
$stmt->bind_param("i", $reservationId);
if ($stmt->execute()) {
    // 刪除成功
    echo "success";
} else {
    // 刪除失敗
    echo "error";
}

// 關閉連線
$stmt->close();
$mysqli->close();
?>