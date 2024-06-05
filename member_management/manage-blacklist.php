<?php
require __DIR__ . '/config/pdo-connect.php';

// GET 取ID值, 
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// 如ID 不是空的
if (!empty($id)) {
    try {
        // 準備
        $sql_update = "UPDATE member_login SET status = 'blacklist', blacklist_date = NOW() WHERE member_profile_id = ?";
        $stmt = $pdo->prepare($sql_update);
        
        // 執行
        $stmt->execute([$id]);

        // 獲取原URL
        $comeFrom = ' manage-list.php';
        if (!empty($_SERVER['HTTP_REFERER'])) {
            $comeFrom = $_SERVER['HTTP_REFERER'];
        }

        // 成功修改回原畫面
        header('Location: '. $comeFrom);
        exit; 
    } catch (PDOException $e) {
        
        echo "更新會員時出錯: " . $e->getMessage();
    }
} else {
    // 如果沒ID,則提示
    echo "無效的會員ID";
}
?>
