<?php
// 假設你已經建立了與資料庫的連接
require __DIR__ . '/config/pdo-connect.php';

header('Content-Type: application/json');

// 獲取要刪除圖片的資訊
$filename = $_POST['filename']; // 從前端接收的檔案名稱

// 從資料庫中獲取圖片的路徑
$sql = "SELECT photos FROM articles WHERE photos = :filename";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':filename', $filename);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if ($row) {
    // 從伺服器上刪除圖片檔案
    $path = $row['photos'];
    if (file_exists($path)) {
        unlink($path); // 刪除檔案
    }

    // 更新資料庫中的 photos 欄位
    // 更新資料庫中的 photos 欄位，從中移除指定的檔案名稱
    $sql = "UPDATE articles SET photos = REPLACE(photos, :filename, '') WHERE photos LIKE CONCAT('%', :filename, '%')";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':filename', $filename);
    $stmt->execute();

    // 返回成功的回應給前端
    echo json_encode(['success' => true]);
} else {
    // 找不到對應的資料，返回錯誤訊息給前端
    header("HTTP/1.1 404 Not Found");
    echo json_encode(['error' => 'Record not found']);
}
