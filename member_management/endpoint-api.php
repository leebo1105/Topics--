<?php

require __DIR__ . '/config/pdo-connect.php';

header('Content-Type: application/json');
$output = [
  'success' => false, # 資料有沒有新增成功
  'bodyData' => $_POST, # 檢查用

];

if (isset($_POST['keyword']) && !empty($_POST['keyword'])) {
  $keyword = $_POST['keyword'];
  // 使用关键字构建 SQL 查询
  $sql = "SELECT mp.id, mp.*, ml.account, ml.password, ml.role
          FROM member_profile mp
          JOIN member_login ml ON mp.id = ml.member_profile_id
          WHERE mp.member_name LIKE ? OR mp.email LIKE ? OR mp.mobile LIKE ?";
  // 执行 SQL 查询
  $stmt = $pdo->prepare($sql);
  $stmt->execute(["%$keyword%", "%$keyword%", "%$keyword%"]);
  // 获取查询结果
  $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
  // 返回查询结果
  echo json_encode($rows);
  exit;
} else {
  echo json_encode("Keyword is empty or not set");
  exit;
}