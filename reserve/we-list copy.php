<?php
require_once __DIR__ . '/we-connect.php';
//刪除
require_once __DIR__ . '/we-delete.php';
$message = ''; // 用於顯示操作结果的消息

// 處理編輯訂單請求
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit'])) {
    $id = $_POST['edit_id'];
    $count = $_POST['count'];
    $guests = $_POST['guests'];
    $reservationDateTime = $_POST['reservationDateTime'];
    $timeSelect = $_POST['timeSelect'];
    $menuSelect = $_POST['menuSelect'];

    try {
        // 更新訂單信息的 SQL 語句
        $updateSql = "UPDATE reservation SET count = ?, guests = ?, reservationDateTime = ?, timeSelect = ?, menuSelect = ? WHERE id = ?";
        $updateStmt = $pdo->prepare($updateSql);
        $updateStmt->execute([$count, $guests, $reservationDateTime, $timeSelect, $menuSelect, $id]);

        echo "訂單資訊更新成功";
    } catch (PDOException $e) {
        echo "訂單資訊更新失敗:" . $e->getMessage();
    }
}
?>
