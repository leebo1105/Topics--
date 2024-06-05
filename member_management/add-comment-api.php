<?php
require __DIR__ . '/config/pdo-connect.php';

header('Content-Type: application/json'); //定義json格式

$output = [
    'success' => false, # 是不是新增成功
    'bodyData' => $_POST, # 檢查用
    'pk' => 0,
];

// 檢查必要的POST數據是否存在
if (isset($_POST['value'], $_POST['content'])) {
    //表單的輸入
    $sql = "INSERT INTO `comments` ( `value`, `content` ) VALUES (?, ?)";

    $stmt = $pdo->prepare($sql); # 會先檢查 sql 語法

    // 執行SQL語句
    $stmt->execute([
        $_POST['value'],
        $_POST['content']
    ]);

    $output['success'] = !!$stmt->rowCount();
    $output['pk'] = $pdo->lastInsertId(); # 取得最新新增資料的 primary key (通常是流水號)

    $formattedDate = date('Y-m-d', strtotime($dateFromDatabase));
    $output['formattedDate'] = $formattedDate;
}

echo json_encode($output);
