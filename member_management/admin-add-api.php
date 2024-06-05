<?php
require __DIR__. '/config/pdo-connect.php';


header('Content-Type: application/json');

$output = [
  'success' => false, # 資料有沒有新增成功
  'bodyData' => $_POST, # 檢查用

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
$sql_login = "INSERT INTO `member_login`(`account`, `password`, `member_profile_id`, `hash`,`role`) VALUES (?, ?, ?, ?,'admin')";
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
$sql_book = "INSERT INTO `contact_book`(`receive_name`, `address`, `contact_mobile`,`member_profile_id`) VALUES('null', 'null', 'null', ?)";
$stmt_book = $pdo->prepare($sql_book);
$stmt_book->execute([
  $lastInsertId,
]);

# 確認有沒有新增
$output['success_contact_book'] = !!$stmt_book->rowCount();

if ($output['success_profile'] || $output['success_login'] ){
  $output['success'] = true;
}else {
  $output['success'] = false;
} 
// json 格式
echo json_encode($output);
