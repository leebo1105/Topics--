<?php
require __DIR__ . '/config/pdo-connect.php';


header('Content-Type: application/json');

$output = [
  'success' => false, # 是否登入成功
  'bodyData' => $_POST, # 檢查用
  'code' => 0,  # 追蹤編號
];


# 兩個都要有值, 才做登入, 否則輸出 0
if (empty($_POST['account']) or empty($_POST['password'])) {
  echo json_encode($output);
  exit;
}

$sql = "SELECT mp.id, mp.*, ml.account, ml.password, ml.role, ml.status
        FROM member_profile mp
        JOIN member_login ml ON mp.id = ml.member_profile_id
        WHERE ml.account=? AND ml.status='active'";


$stmt = $pdo->prepare($sql); // 用 account 找用戶

$stmt->execute([$_POST['account']]);
$row = $stmt->fetch();

if (empty($row)) {
  # 帳號是錯的 , 給 code 編號400
  $output['code'] = 400;
  echo json_encode($output);
  exit;
}
#  row 變數內的 password
if (password_verify($_POST['password'], $row['password'])) {

  # 密碼是對的
  $output['code'] = 301;
  $output['success'] = true;
  # 對的話 資料掛在 output
  
  $_SESSION['admin'] = [
    // 找到 admin or user
    'id' => $row['id'],
    'role'  => $row['role'],
    'nickname' => $row['member_name'],
  ];
  $redirectUrl = ($_SESSION['admin']['role'] === 'admin') ? 'manage-index.php' : 'index-list.php';
  $output['redirect'] = $redirectUrl;
} else {
  $output['code'] = 300;
}




echo json_encode($output);
