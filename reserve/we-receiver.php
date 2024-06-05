<?php
require_once __DIR__ . '/we-connect.php';

// 獲取表單提交的資料
$count = isset($_POST['count']) ? intval($_POST['count']) : 0; // 確保取得並轉換為整數
$guests = isset($_POST['guests']) ? intval($_POST['guests']) : 0;
$reservationDateTime = isset($_POST['reservationDateTime']) ? date('Y-m-d', strtotime($_POST['reservationDateTime'])) : null;
$timeSelect = isset($_POST['timeSelect']) ? $_POST['timeSelect'] : null;
$menuSelect = isset($_POST['menuSelect']) ? $_POST['menuSelect'] : null;

// 準備 SQL 語句
$sql = "INSERT INTO reservation (count, guests, reservationDateTime, timeSelect, menuSelect)
        VALUES (:count, :guests, :reservationDateTime, :timeSelect, :menuSelect)";

try {
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':count', $count, PDO::PARAM_INT);
    $stmt->bindParam(':guests', $guests, PDO::PARAM_INT);
    $stmt->bindParam(':reservationDateTime', $reservationDateTime, PDO::PARAM_STR);
    $stmt->bindParam(':timeSelect', $timeSelect, PDO::PARAM_STR);
    $stmt->bindParam(':menuSelect', $menuSelect, PDO::PARAM_INT);

    // 執行 SQL 語句
    $stmt->execute();

    // 回應 JSON 格式的成功訊息
    http_response_code(200);
    $output = array(
        'success' => true,
        'message' => '預約成功',
        header("Location:we-list copy.php")
    );
    echo json_encode($output);
} catch (PDOException $e) {
    // 回應 JSON 格式的錯誤訊息
    http_response_code(500);
    $output = array(
        'success' => false,
        'message' => '預約失敗: ' . $e->getMessage()
    );
    echo json_encode($output);
}
