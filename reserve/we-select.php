<?php
// 包含数据库连接文件
require_once __DIR__ . '/we-connect.php';

try {
    // 準備SQL查詢語句，查詢所有 reservation 數據
    $sql = 'SELECT * FROM reservation';

    // 準備查詢
    $stmt = $pdo->prepare($sql);

    // 執行查詢
    $stmt->execute();

    // 獲取所有數據，使用 PDO::FETCH_ASSOC 獲取關聯數組型式的結果
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // 判斷是否有查詢結果
    if ($results) {
        echo '<h2>Reservation 預約訂單資料</h2>';
        echo '<table border="1">';
        echo '<tr><th>會員ID</th><th>幾人桌</th><th>人數</th><th>預約日期</th><th>預約時間</th><th>用餐方式</th></tr>';

        // 循環輸出每條數據
        foreach ($results as $row) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($row['id']) . '</td>';
            echo '<td>' . htmlspecialchars($row['count']) . '</td>';
            echo '<td>' . htmlspecialchars($row['guests']) . '</td>';
            echo '<td>' . htmlspecialchars($row['reservationDateTime']) . '</td>';
            echo '<td>' . htmlspecialchars($row['timeSelect']) . '</td>';
            echo '<td>' . htmlspecialchars($row['menuSelect']) . '</td>';
            echo '</tr>';
        }

        echo '</table>';
    } else {
        echo "未找到任何紀錄";
    }
} catch (PDOException $e) {
    // 處理異常
    echo "查詢失敗:" . $e->getMessage();
}



/*這個腳本的主要步驟包括：

引入資料庫連線檔案 we-connect.php，確保資料庫連線可用。
使用 PDO 準備 SQL 查詢語句，這裡使用了有佔位符 :id 的查詢。
準備查詢之後，綁定佔位符 :id 的值為具體的 ID（例如 1）。
執行查詢，透過 execute() 方法執行準備好的 SQL 語句。
使用 fetch(PDO::FETCH_ASSOC) 取得單一結果，並列印輸出。
使用 fetchAll(PDO::FETCH_ASSOC) 取得多個結果，並列印輸出。
在實際應用中，需要根據實際需求修改 SQL 查詢語句、綁定參數的值和異常處理方式。 此外，為了安全起見，應該考慮使用預處理語句來防止 SQL 注入攻擊。*/
?>
