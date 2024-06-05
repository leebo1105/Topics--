<?php
require __DIR__ . '/config/pdo-connect.php';
// GET 取ID值, 
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
// if 檢查不是空值
if (!empty($id)) { //不是空值, 開始執行
    // 刪除相關的附表 member_login 
    $sql = "DELETE FROM member_login WHERE member_profile_id=?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);

    // 刪除相關的附表 contact_book 
    $sql = "DELETE FROM contact_book WHERE member_profile_id=?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);

    // 刪除主表 member_profile 
    $sql = "DELETE FROM member_profile WHERE id=?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);


    
    $comeFrom = ' manage-list.php';
        if(! empty($_SERVER['HTTP_REFERER'])){
          $comeFrom = $_SERVER['HTTP_REFERER'];
        }
     // 成功刪除導向
     header('Location: '. $comeFrom);
     // exit;
} 