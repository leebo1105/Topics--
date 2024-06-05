<?php
// 引入資料庫連線配置文件
require __DIR__ . '/config/pdo-connect.php';

// 設置響應的內容類型為 JSON
header('Content-Type: application/json');

// 從請求主體中獲取 POST 數據
$post_data = file_get_contents('php://input');

// 將 JSON 格式的 POST 數據解碼為 PHP 數組
$request = json_decode($post_data, true);

// 從請求數據中獲取訂單 ID 和狀態 ID，確保它們是整數
$cart_id = isset($request['c_id']) ? intval($request['c_id']) : 0;
$status_id = isset($request['status_id']) ? intval($request['status_id']) : 0;

// 檢查訂單 ID 和狀態 ID 是否有效（非零）
if ($cart_id && $status_id) {
    try {
        // 準備 SQL 更新語句，更新訂單狀態
        $update_sql = "UPDATE member_card SET status_id = ? WHERE c_id = ?";
        $stmt = $pdo->prepare($update_sql);

        // 執行更新操作，傳入狀態 ID 和訂單 ID 作為參數
        $stmt->execute([$status_id, $cart_id]);

        // 獲取受影響的行數
        $affected_rows = $stmt->rowCount();
        
        // 檢查是否有行受影響（即更新是否成功）
        if ($affected_rows > 0) {
            // 更新成功，準備成功響應
            $response = ['success' => true, 'message' => '訂單狀態已成功更新', 'c_id' => $cart_id, 'status_id' => $status_id];
        } else {
            // 沒有行受影響，準備失敗響應
            $response = ['success' => false, 'message' => '無法更新訂單狀態'];
        }
    } catch (PDOException $e) {
        // 捕獲資料庫異常，準備錯誤響應
        $response = ['success' => false, 'message' => '資料庫錯誤：' . $e->getMessage()];
    }
} else {
    // 如果訂單 ID 或狀態 ID 無效，準備錯誤響應
    $response = ['success' => false, 'message' => '無效的訂單編號或選擇的狀態', 'post_data' => $request];
}

// 輸出 JSON 格式的響應
echo json_encode($response);
?>
