<?php

require __DIR__ . '/config/pdo-connect.php';

header('Content-Type: application/json');

$output = [
  'success' => false, # 是不是編輯成功
  'bodyData' => $_POST, # 檢查用
  'code' => 0, # 追踪功能的編號
];


$sid = isset($_POST['a_id']) ? intval($_POST['a_id']) : 0;
if (empty($sid)) {
  # 沒有給 primary key
  $output['code'] = 400;
  echo json_encode($output);
  exit;
}

$date = strtotime($_POST['date']);
if ($date === false) {
  $date = null;
} else {
  $date = date('Y-m-d', $date);
}

$sql = "UPDATE `articles` SET 
`date`=?,
`title`=?,
`content`=?,
`key_word_id`=?,
`photos`=?
  WHERE a_id=?";

$stmt = $pdo->prepare($sql); # 會先檢查 sql 語法

$stmt->execute([
  $date,
  $_POST['title'],
  $_POST['content'],
  $_POST['key_word_id'],
  $_POST['photos'],
  $sid
]);

$output['success'] = !! $stmt->rowCount();

echo json_encode($output);