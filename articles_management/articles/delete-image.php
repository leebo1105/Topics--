<?php

require __DIR__ . '/config/pdo-connect.php';

header('Content-Type: application/json');

// 檢查是否收到 POST 請求
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 獲取前端發送的 JSON 資料
    $data = json_decode(file_get_contents("php://input"));

    // 檢查資料是否存在並且格式正確
    if (isset($data->a_id) && isset($data->filename)) { // 將原本的 $data->photos 修改為 $data->filename
        // 這裡可以進行進一步的資料驗證

        // 假設你要刪除的圖片檔案路徑存儲在資料庫的 `photos` 欄位中
        $a_id = $data->a_id;
        $filename = $data->filename; // 將原本的 $photos 修改為 $filename

        // 假設你的資料表名稱是 articles，且有一個欄位名稱叫做 photos
        // 這裡的 SQL 語句是更新指定 a_id 的文章的 photos 欄位為傳遞過來的 photos
        $sql = "UPDATE articles SET photos = :filename WHERE a_id = :a_id"; // 將原本的 :photos 修改為 :filename

        // 使用 PDO 來執行 SQL 語句
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':filename', $filename); // 將原本的 :photos 修改為 :filename
        $stmt->bindParam(':a_id', $a_id);

        // 執行 SQL 語句
        $success = $stmt->execute();

        // 返回 JSON 格式的回應
        header('Content-Type: application/json');
        echo json_encode(['success' => $success]);
    } else {
        // 如果沒有接收到必要的資料，返回錯誤訊息
        header("HTTP/1.1 400 Bad Request");
        echo json_encode(['error' => 'Missing parameters']);
    }
} else {
    // 如果不是 POST 請求，返回錯誤訊息
    header("HTTP/1.1 405 Method Not Allowed");
    echo json_encode(['error' => 'Method Not Allowed']);
}
