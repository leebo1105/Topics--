<?php
require __DIR__ . '/config/pdo-connect.php';

$year = isset($_POST['year']) ? (int)$_POST['year'] : null;
$month = isset($_POST['month']) ? (int)$_POST['month'] : null;
$day = isset($_POST['day']) ? (int)$_POST['day'] : null;

// 進行資料庫查詢，這裡以示例直接輸出查詢條件
$query = "SELECT * FROM your_table WHERE ";

if ($year !== null) {
    $query .= "YEAR(date_column) = $year ";
}
if ($month !== null) {
    $query .= ($year !== null ? "AND " : "") . "MONTH(date_column) = $month ";
}
if ($day !== null) {
    $query .= ($year !== null || $month !== null ? "AND " : "") . "DAY(date_column) = $day ";
}

// 執行查詢並處理結果，這裡以示例直接輸出查詢條件
echo "資料庫查詢條件： $query";
?>