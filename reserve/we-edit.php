<?php
require_once __DIR__ . '/we-connect.php';

// 獲取要編輯的訂單 ID
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// 查詢要編輯的訂單資訊
$sql = "SELECT * FROM reservation WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$reservation = $stmt->fetch(PDO::FETCH_ASSOC);

// 處理表單提交
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $count = $_POST['count'];
    $guests = $_POST['guests'];
    $reservationDateTime = $_POST['reservationDateTime'];
    $timeSelect = $_POST['timeSelect'];
    $menuSelect = $_POST['menuSelect'];

    try {
        // 更新訂單資訊的 SQL 語句
        $updateSql = "UPDATE reservation SET count = ?, guests = ?, reservationDateTime = ?, timeSelect = ?, menuSelect = ? WHERE id = ?";
        $updateStmt = $pdo->prepare($updateSql);
        $updateStmt->execute([$count, $guests, $reservationDateTime, $timeSelect, $menuSelect, $id]);

        // 重定向回主頁面
        header("Location: we-list copy.php");
        exit;
    } catch (PDOException $e) {
        $error = "訂單資訊更新失敗:" . $e->getMessage();
    }
}
?>
  <?php include __DIR__ . '/../member_management/manage/manage-html-head.php' ?>
<?php include __DIR__ . '/../member_management/manage/manage-navbar.php' ?>
    <h1>編輯訂單</h1>

    <?php if (isset($error)) : ?>
        <p><?php echo $error; ?></p>
    <?php endif; ?>

    <form method="POST">
        幾人桌: <select name="count" id="count">
            <option value="12" <?php echo ($reservation['count'] == '12') ? 'selected' : ''; ?>>12人桌</option>
            <option value="4" <?php echo ($reservation['count'] == '4') ? 'selected' : ''; ?>>4人桌</option>
            <option value="2" <?php echo ($reservation['count'] == '2') ? 'selected' : ''; ?>>2人桌</option>
        </select><br>
        人數: <input type="text" name="guests" value="<?php echo $reservation['guests']; ?>"><br>
        預約日期時間: <input type="date" name="reservationDateTime" value="<?php echo date('Y-m-d', strtotime($reservation['reservationDateTime'])); ?>" min="<?php echo date('Y-m-d'); ?>" required><br>
        預約時間:
        <select name="timeSelect">
            <option selected disabled>請選擇時間</option>
            <option value="11:30" <?php echo ($reservation['timeSelect'] == '11:30') ? 'selected' : ''; ?>>11:30</option>
            <option value="12:00" <?php echo ($reservation['timeSelect'] == '12:00') ? 'selected' : ''; ?>>12:00</option>
            <option value="12:30" <?php echo ($reservation['timeSelect'] == '12:30') ? 'selected' : ''; ?>>12:30</option>
            <option value="13:00" <?php echo ($reservation['timeSelect'] == '13:00') ? 'selected' : ''; ?>>13:00</option>
            <option value="17:30" <?php echo ($reservation['timeSelect'] == '17:30') ? 'selected' : ''; ?>>17:30</option>
            <option value="18:00" <?php echo ($reservation['timeSelect'] == '18:00') ? 'selected' : ''; ?>>18:00</option>
            <option value="18:30" <?php echo ($reservation['timeSelect'] == '18:30') ? 'selected' : ''; ?>>18:30</option>
            <option value="19:00" <?php echo ($reservation['timeSelect'] == '19:00') ? 'selected' : ''; ?>>19:00</option>
            <option value="19:30" <?php echo ($reservation['timeSelect'] == '19:30') ? 'selected' : ''; ?>>19:30</option>
            <option value="20:00" <?php echo ($reservation['timeSelect'] == '20:00') ? 'selected' : ''; ?>>20:00</option>
        </select><br>
        用餐方式:
        <select name="menuSelect">
            <option value="現場單點" <?php echo ($reservation['menuSelect'] == "現場單點") ? 'selected' : ''; ?>>現場單點</option>
            <option value="合菜料理" <?php echo ($reservation['menuSelect'] == "合菜料理") ? 'selected' : ''; ?>>合菜料理</option>
            <option value="無菜單料理" <?php echo ($reservation['menuSelect'] == "無菜單料理") ? 'selected' : ''; ?>>無菜單料理</option>
        </select><br>
        <button type="submit">保存</button>
    </form>
</body>

</html>