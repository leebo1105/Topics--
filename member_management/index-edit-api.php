<?php
require __DIR__ . '/config/pdo-connect.php';


header('Content-Type: application/json');

$output = [
  'success' => false, # 資料有沒有編輯成功
  'bodyData' => $_POST, # 檢查用
  'code' => 0, # 追蹤功能編號
];


// TODO: 欄位資料檢查

$id = isset($_POST['id']) ? intval($_POST['id']) : 0;

if (empty($id)) {
$output['code'] = 400;
echo json_encode($output);
exit; 

}


/*  // 生日資料轉換, 生日非必填才需要
$birthday = strtotime($_POST['birthday']);
if($birthday===false) {
  $birthday = null;
} else {
  $birthday = date('Y-m-d', $birthday);
}
*/

// 新增到 member_profile 表
$sql_profile = "UPDATE `member_profile` SET 
`member_name`=?,
`gender`=?,
`email`=?,
`mobile`=?,
`birthday`=?
WHERE id=?";



$stmt_profile = $pdo->prepare($sql_profile);

$stmt_profile->execute([
  $_POST['member_name'],
  $_POST['gender'],
  $_POST['email'],
  $_POST['mobile'],
  $_POST['birthday'],
  $id  
]);
# 確認有沒有新增
$output['success_profile'] = !!$stmt_profile->rowCount();
// $output['success_profile'] = !! $stmt_profile->rowCount();

/*
$lastInsertId = $pdo->lastInsertId();

# 主表ID, 新增後, 賦予給 lastInsertId


/*
/*
// 先將密碼加密後, 賦予給 hash

$password = $_POST['password'];
$hashed_password = password_hash($password, PASSWORD_DEFAULT);
*/

// 新增到 member_login 表

$sql_login = "UPDATE `member_login` SET 
    `account`=?
    WHERE member_profile_id=?";

$stmt_login = $pdo->prepare($sql_login);

$stmt_login->execute([
    $_POST['account'],
    $id
]);


# 確認有沒有新增
$output['success_login'] = !!$stmt_login->rowCount();



// 新增到 contact_book 表
$sql_book = "UPDATE `contact_book` SET 
    `receive_name`=?,
    `address`=?,
    `contact_mobile`=?
    WHERE member_profile_id=?";

$stmt_book = $pdo->prepare($sql_book);

$stmt_book->execute([
    $_POST['receive_name'],
    $_POST['address'],
    $_POST['contact_mobile'],
    $id
]);


# 確認有沒有新增
$output['success_contact_book'] = !!$stmt_book->rowCount();


if ($output['success_profile'] || $output['success_login'] || $output['success_contact_book']) {
  $output['success'] = true;
}


// json 格式
echo json_encode($output);
