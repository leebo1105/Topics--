<?php
require __DIR__ . '/config/pdo-connect.php';

header('Content-Type: application/json'); //定義json格式

$output = [
  'success' => false, # 是不是新增成功
  'bodyData' => $_POST, # 檢查用
  'pk' => 0,
];

// // TODO: 要做欄位資料檢查

# preg_match() 使用 regular expression
# filter_var('bob@example.com', FILTER_VALIDATE_EMAIL) 檢查是不是 email 格式 
# mb_strlen() 回傳字串的長度, mb_ 表 multi-byte

//確認日期格式
$date = strtotime($_POST['date']);
if ($date === false) {
  $date = null;
} else {
  $date = date('Y-m-d', $date);
}

//表單的輸入
$sql = "INSERT INTO `articles` ( `date`, `title`, `content`, `key_word_id`, `photos` ) VALUES (?, ?, ?, ?, ?)";

$stmt = $pdo->prepare($sql); # 會先檢查 sql 語法

$stmt->execute([
  $date,
  $_POST['title'],
  $_POST['content'],
  $_POST['key_word_id'],
  $_POST['photos']
]);


$output['success'] = !!$stmt->rowCount();
$output['pk'] = $pdo->lastInsertId(); # 取得最新新增資料的 primary key (通常是流水號)


echo json_encode($output);