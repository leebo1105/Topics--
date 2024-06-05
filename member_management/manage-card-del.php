<?php
require __DIR__ . '/config/pdo-connect.php';
// GET 取ID值, 
$c_id = isset($_GET['c_id']) ? intval($_GET['c_id']) : 0;
// if 檢查不是空值
if (!empty($c_id)) { //不是空值, 開始執行
   

    // 刪除 member_card
    $sql = "DELETE FROM member_card WHERE c_id=?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$c_id]);


    
    $comeFrom = ' manage-list.php';
        if(! empty($_SERVER['HTTP_REFERER'])){
          $comeFrom = $_SERVER['HTTP_REFERER'];
        }
     // 成功刪除導向
     header('Location: '. $comeFrom);
      // exit;
} 