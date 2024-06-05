<?php
require __DIR__. '/config/pdo-connect.php';


header('Content-Type: application/json');

$output = [
  'success' => false, # 資料有沒有新增成功
  'bodyData' => $_POST, # 檢查用
  'error_message' =>'',
];


// TODO: 欄位資料檢查

/*  // 生日資料轉換, 生日必填才需要
$birthday = strtotime($_POST['birthday']);
if($birthday===false) {
  $birthday = null;
} else {
  $birthday = date('Y-m-d', $birthday);
}
*/
$sql_check_email = "SELECT COUNT(*) AS count FROM `member_profile` WHERE `email` = ?";
$sql_check_mobile = "SELECT COUNT(*) AS count FROM `member_profile` WHERE `mobile` = ?";
$sql_check_account = "SELECT COUNT(*) AS count FROM `member_login` WHERE `account` = ?";

$stmt_check_email = $pdo->prepare($sql_check_email);
$stmt_check_account = $pdo->prepare($sql_check_account);
$stmt_check_mobile = $pdo->prepare($sql_check_mobile);

$stmt_check_email->execute([$_POST['email']]);
$stmt_check_account->execute([$_POST['account']]);
$stmt_check_mobile->execute([$_POST['mobile']]);

$result_check_email = $stmt_check_email->fetch(PDO::FETCH_ASSOC);
$result_check_account = $stmt_check_account->fetch(PDO::FETCH_ASSOC);
$result_check_mobile = $stmt_check_mobile->fetch(PDO::FETCH_ASSOC);

$count_email = intval($result_check_email['count']);
$count_account = intval($result_check_account['count']);
$count_mobile = intval($result_check_mobile['count']);


if ($count_email > 0) {
  // error_message 存儲錯誤 
  $output['error_message'] = '註冊失敗,已有相同電子郵件。';
} else if ($count_mobile > 0) {
  $output['error_message'] = '註冊失敗,已有相同手機號碼。';
} else if ($count_account > 0) {
  $output['error_message'] = '註冊失敗,已有相同帳號。';
}

// 如果有错误消息，则输出并退出脚本执行
if (!empty($output['error_message'])) {
  echo json_encode($output);
  exit;
}

// 新增到 member_profile 表
$sql_profile = "INSERT INTO `member_profile`(`member_name`, `gender`, `email`, `mobile`, `birthday`, `create_date`) VALUES (?, ?, ?, ?, ?, NOW())";



$stmt_profile = $pdo->prepare($sql_profile);

$stmt_profile->execute([
  $_POST['member_name'],
  $_POST['gender'],
  $_POST['email'],
  $_POST['mobile'],
  $_POST['birthday']
]);
# 確認有沒有新增
$output['success_profile'] = !!$stmt_profile->rowCount();


# 主表ID, 新增後, 賦予給 lastInsertId
$lastInsertId = $pdo->lastInsertId();



// 先將密碼加密後, 賦予給 hash
$password = $_POST['password'];
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// 新增到 member_login 表
$sql_login = "INSERT INTO `member_login`(`account`, `password`, `member_profile_id`, `hash`,`blacklist_date`) VALUES (?, ?, ?, ?, NULL)";
$stmt_login = $pdo->prepare($sql_login);
$stmt_login->execute([
  $_POST['account'],
  $hashed_password, 
  $lastInsertId,
  $hashed_password # 密碼哈希值, 後續會員登錄驗證密碼用
]);
# 確認有沒有新增
$output['success_login'] = !!$stmt_login->rowCount();



// 新增到 contact_book 表
$sql_book = "INSERT INTO `contact_book`(`receive_name`, `address`, `contact_mobile`,`member_profile_id`) VALUES(?, ?, ?, ?)";
$stmt_book = $pdo->prepare($sql_book);
$stmt_book->execute([
  $_POST['receive_name'],
  $_POST['address'],
  $_POST['contact_mobile'],
  $lastInsertId,
]);

# 確認有沒有新增
$output['success_contact_book'] = !!$stmt_book->rowCount();

if ($output['success_profile'] || $output['success_login'] || $output['success_contact_book']) {
  $output['success'] = true;
}else {
  $output['success'] = false;
  
} 
// json 格式
echo json_encode($output);
