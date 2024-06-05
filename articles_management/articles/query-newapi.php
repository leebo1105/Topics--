<?php
require __DIR__ . '/config/pdo-connect.php';

// 讀取 POST 資料
$input = file_get_contents('php://input');
$data = json_decode($input, true);

// 確認 JSON 解析是否成功
if ($data === null) {
    echo json_encode(["error" => "Invalid JSON data"]);
    exit;
}

// 檢查是否有選擇關鍵字
if (!isset($data['key_word_id'])) {
    echo json_encode(["error" => "Missing key_word_id"]);
    exit;
}

// 取得 POST 過來的資料
$key_word_id = $data['key_word_id'];

// 設置回傳的 header
header('Content-Type: application/json');

// 準備查詢
$sql = "SELECT * FROM articles JOIN key_words ON key_word_id = key_words.k_id WHERE 1"; // 基本查詢
$conditions = []; // 條件

// 如果關鍵字不是所有文章，加入關鍵字查詢條件
if ($key_word_id !== '1') {
    $sql .= " AND key_word_id = :key_word_id";
    $conditions[':key_word_id'] = $key_word_id;
}

// 如果日期存在且有效，加入日期查詢條件
if (!empty($data['date']) && strtotime($data['date']) !== false) {
    $date = $data['date'];
    $sql .= " AND date = :date";
    $conditions[':date'] = $date;
}

$sql .= " ORDER BY a_id DESC";

// 準備執行 SQL 查詢
$stmt = $pdo->prepare($sql);

// 綁定條件值
foreach ($conditions as $key => $value) {
    $stmt->bindValue($key, $value);
}

// 執行查詢
$stmt->execute();

// 取得結果
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

// 返回 JSON 格式的查詢結果
echo json_encode($result);
