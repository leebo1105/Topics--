<?php
// 資料庫連線
require_once __DIR__ . '/we-connect.php';

// 定義變數儲存訊息
$message = '';

// 刪除操作
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    $ids = $_POST['reservation_ids']; // 獲取要刪除的預約ID數組 

    if (!empty($ids)) {
        try {
            // 使用 implode 函數將 ID 數組轉換成逗號分隔的字串符，用在 SQL 的 in 語句
            $idList = implode(',', array_map('intval', $ids)); // 防止 SQL 注入

            // 準備 SQL 刪除語句，刪除符合條件的預約數據
            $deleteSql = "DELETE FROM reservation WHERE id IN ($idList)";
            $deleteStmt = $pdo->prepare($deleteSql);

            // 執行刪除操作
            if ($deleteStmt->execute()) {
                $message = '選定的預約數據刪除成功';
            } else {
                $message = '預約數據刪除失敗';
            }
        } catch (PDOException $e) {
            // 處理異常
            $message = '操作失敗:' . $e->getMessage();
        }
    } else {
        $message = '請選擇要刪除的預約數據';
    }
}

// 查询操作
try {
    // 準備 SQL 查詢語句，查詢所有預約數據
    $sql = 'SELECT * FROM reservation';
    $stmt = $pdo->query($sql);

    // 獲取查詢結果
    $reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    // 處理異常
    $message = '查詢失敗:' . $e->getMessage();


}
?>
<?php
$message = ''; // 用於顯示操作结果的消息

// 處理編輯訂單請求
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit'])) {
    $id = $_POST['edit_id'];
    $count = $_POST['count'];
    $guests = $_POST['guests'];
    $reservationDateTime = $_POST['reservationDateTime'];
    $timeSelect = $_POST['timeSelect'];
    $menuSelect = $_POST['menuSelect'];

    try {
        // 更新訂單信息的 SQL 語句
        $updateSql = "UPDATE reservation SET count = ?, guests = ?, reservationDateTime = ?, timeSelect = ?, menuSelect = ? WHERE id = ?";
        $updateStmt = $pdo->prepare($updateSql);
        $updateStmt->execute([$count, $guests, $reservationDateTime, $timeSelect, $menuSelect, $id]);

        echo "訂單資訊更新成功";
    } catch (PDOException $e) {
        echo "訂單資訊更新失敗:" . $e->getMessage();
    }
}
?>

<!-- html -->
<?php include __DIR__ . '../../../Topics/menu/part/html-head.php' ?>
<?php include __DIR__ . '/../member_management/manage/manage-navbar.php' ?>
    <!-- html -->
    <div class="container">
    <div class="row justify-content-center pt-2"> 
        <div class="title mb-3">
            <h1>預約管理</h1>
        </div>
<hr>
        <div class="content">

            <?php if (!empty($message)): ?>
                <p><?php echo $message; ?></p>
            <?php endif; ?>
        
            <form method="POST">
                <table class="table-data">
                    <tr>
                        <th></th>
                        <th>選單ID</th>
                        <th>幾人桌</th>
                        <th>人數</th>
                        <th>預約日期</th>
                        <th>預約時間</th>
                        <th>用餐方式</th>
                        <th>更改資訊</th>
                        <th>新增預約</th>
                    </tr>
                    <?php foreach ($reservations as $reservation): ?>
                        <tr>
                            <td><input type="checkbox" name="reservation_ids[]" value="<?php echo $reservation['id']; ?>"></td>
                            <td><?php echo $reservation['id']; ?></td>
                            <td><?php echo htmlspecialchars($reservation['count']); ?></td>
                            <td><?php echo htmlspecialchars($reservation['guests']); ?></td>
                            <td><?php echo htmlspecialchars($reservation['reservationDateTime']); ?></td>
                            <td><?php echo htmlspecialchars($reservation['timeSelect']); ?></td>
                            <td><?php echo htmlspecialchars($reservation['menuSelect']); ?></td>
                            <td><a href="we-edit.php?id=<?php echo $reservation['id']; ?>" class="edit-btn">編輯</a></td>
                            <td><a href="we-add.php?id=<?php echo $reservation['id']; ?>" class="edit-btn">新增</a></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
                <br>
                <button type="submit" name="delete">刪除勾起來的訂單</button>
            </form>
        </div>
    </div>
</body>


</html>

