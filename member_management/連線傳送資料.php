<?php
// Start the session
if (!isset($_SESSION)) {
  session_start();
}

if (!isset($_SESSION['admin'])) {
    die("未登入，請先登入會員系統");
}

$member_id = $_SESSION['admin']['id'];

// 獲取 POST 數據
$table_type = isset($_POST['text6']) ? $_POST['text6'] : die("table_type 未設置");
$people = isset($_POST['text7']) ? $_POST['text7'] : die("people 未設置");
$date = isset($_POST['text8']) ? $_POST['text8'] : die("date 未設置");
$time = isset($_POST['text9']) ? $_POST['text9'] : die("time 未設置");
$dining_method = isset($_POST['text10']) ? $_POST['text10'] : die("dining_method 未設置");

// 顯示變數以便調試
echo "member_id: $member_id<br />";
echo "table_type: $table_type<br />";
echo "people: $people<br />";
echo "date: $date<br />";
echo "time: $time<br />";
echo "dining_method: $dining_method<br />";

try {
    // 建立資料庫連線
    $pdo = new PDO('mysql:host=localhost;dbname=mudanlow', 'root', 'P@ssw0rd');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "資料庫連線成功<br />";

    // 執行 SELECT 語句以確認數據
    $select_sql = "SELECT member_name, mobile FROM member_profile WHERE id = ?";
    $select_stmt = $pdo->prepare($select_sql);
    $select_stmt->execute([$member_id]);
    $member = $select_stmt->fetch(PDO::FETCH_ASSOC);

    if ($member) {
        echo "member_name: " . $member['member_name'] . "<br />";
        echo "mobile: " . $member['mobile'] . "<br />";
    } else {
        die("沒有找到相應的會員資料<br />");
    }

    // 準備 INSERT 語句
    $insert_sql = "INSERT INTO reservation (member_profile_id, table_type, people, date, time, dining_method, member_name, mobile)
                   VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $insert_stmt = $pdo->prepare($insert_sql);

    // 綁定參數並執行語句
    $insert_stmt->execute([$member_id, $table_type, $people, $date, $time, $dining_method, $member['member_name'], $member['mobile']]);

    if ($insert_stmt->rowCount() > 0) {
        echo "預約成功!";
    } else {
        echo "預約失敗，可能是因為查詢沒有返回任何行。";
    }

} catch (PDOException $e) {
    echo "錯誤: " . $e->getMessage();
}

// 關閉連線
$pdo = null;
?>
