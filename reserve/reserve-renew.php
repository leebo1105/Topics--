<?php
require_once __DIR__ . '/we-connect.php';

$message = ''; // 用於顯示操作结果的消息

// 處理刪除訂單請求
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    $ids = $_POST['reservation_ids']; // 取得要刪除的訂單ID數組

    if (!empty($ids)) {
        try {
            // 將 ID 陣列轉換成逗號分隔的字串，用於 SQL 的 IN 語句
            $idList = implode(',', array_map('intval', $ids));

            // 準備 SQL 刪除語句，刪除符合條件的訂單數據
            $deleteSql = "DELETE FROM reservation WHERE id IN ($idList)";
            $deleteStmt = $pdo->prepare($deleteSql);

            // 執行刪除操作
            if ($deleteStmt->execute()) {
                $message = '選定的訂單資料刪除成功';
            } else {
                $message = '訂單資料刪除失敗';
            }
        } catch (PDOException $e) {
            $message = '操作失敗:' . $e->getMessage();
        }
    } else {
        $message = '請勾選要刪除的訂單數據';
    }
}

// 查詢所有訂單數據
try {
    $sql = 'SELECT * FROM reservation';
    $stmt = $pdo->query($sql);

    // 取得查詢結果
    $reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $message = '查詢失敗:' . $e->getMessage();
}

// 處理編輯訂單請求
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit'])) {
    $id = $_POST['id'];
    $count = $_POST['count'];
    $guests = $_POST['guests'];
    $reservationDateTime = $_POST['reservationDateTime'];
    $timeSelect = $_POST['timeSelect'];
    $menuSelect = $_POST['menuSelect'];

    try {
        // 準備 SQL 更新語句，更新指定訂單的信息
        $updateSql = "UPDATE reservation SET count = ?, guests = ?, reservationDateTime = ?, timeSelect = ?, menuSelect = ? WHERE id = ?";
        $updateStmt = $pdo->prepare($updateSql);
        $updateStmt->execute([$count, $guests, $reservationDateTime, $timeSelect, $menuSelect, $id]);

        $message = '訂單資訊更新成功';
    } catch (PDOException $e) {
        $message = '訂單資訊更新失敗:' . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>訂單管理</title>
</head>

<body>
    <h1>訂單管理</h1>

    <?php if (!empty($message)) : ?>
        <p><?php echo $message; ?></p>
    <?php endif; ?>

    <form method="POST">
        <table border="1">
            <tr>
                <th></th>
                <th>選單ID</th>
                <th>幾人桌</th>
                <th>人數</th>
                <th>預約日期</th>
                <th>預約時間</th>
                <th>用餐方式</th>
                <th>操作</th>
            </tr>
            <?php foreach ($reservations as $reservation) : ?>
                <tr>
                    <td><input type="checkbox" name="reservation_ids[]" value="<?php echo $reservation['id']; ?>"></td>
                    <td><?php echo $reservation['id']; ?></td>
                    <td><?php echo htmlspecialchars($reservation['count']); ?></td>
                    <td><?php echo htmlspecialchars($reservation['guests']); ?></td>
                    <td><?php echo htmlspecialchars($reservation['reservationDateTime']); ?></td>
                    <td><?php echo htmlspecialchars($reservation['timeSelect']); ?></td>
                    <td><?php echo htmlspecialchars($reservation['menuSelect']); ?></td>
                    <td>
                        <!-- 編輯按鈕，觸發模態框 -->
                        <button type="button" onclick="editOrder(<?php echo $reservation['id']; ?>, '<?php echo $reservation['count']; ?>', '<?php echo $reservation['guests']; ?>', '<?php echo $reservation['reservationDateTime']; ?>', '<?php echo $reservation['timeSelect']; ?>', '<?php echo $reservation['menuSelect']; ?>')">編輯</button>
                    </td>

                </tr>
            <?php endforeach; ?>
        </table>
        <br>
        <button type="submit" name="delete">刪除勾選的訂單</button>
    </form>

    <div id="editModal" style="display: none;">
        <h2>編輯訂單</h2>
        <form method="POST" onsubmit="event.preventDefault(); updateOrder()">
            <input type="hidden" id="edit_id" name="edit_id">
            幾人桌: <input type="text" id="edit_count" name="count"><br>
            人數: <input type="text" id="edit_guests" name="guests"><br>
            預約日期: <input type="text" id="edit_reservationDateTime" name="reservationDateTime"><br>
            預約時間: <input type="text" id="edit_timeSelect" name="timeSelect"><br>
            用餐方式: <input type="text" id="edit_menuSelect" name="menuSelect"><br>
            <input type="submit" value="保存">
        </form>
    </div>
    <form method="post" action="we-receiver.php">
<input
                  type="text"
                  name="count"
                  placeholder="1桌"
                />
                <input type="text" id="guestNo" name="guests" placeholder="人數"/>
                <input
                  type="date"
                  name="reservationDateTime"
                />
    <select name="timeSelect">
        <option>請選擇時間</option>
        <option value="11:30">11:30</option>
        <option value="12:00">12:00</option>
        <option value="12:30">12:30</option>
        <option value="13:00">13:00</option>
        <option value="17:30">17:30</option>
        <option value="18:00">18:00</option>
        <option value="18:30">18:30</option>
        <option value="19:00">19:00</option>
        <option value="19:30">19:30</option>
        <option value="20:00">20:00</option>
    </select>
    <select name="menuSelect">
        <option >請選擇用餐方式(必選)</option>
        <option value="1" >現場單點</option>
        <option value="2" >合菜料理</option>
        <option value="3" >無菜單料理</option>
    </select>
    <button type="submit">新增</button>
</form>

    <script>
        // JavaScript 函數，用於顯示模態框並填入訂單訊息
        function editOrder(id, count, guests, reservationDateTime, timeSelect, menuSelect) {
            document.getElementById('edit_id').value = id;
            document.getElementById('edit_count').value = count;
            document.getElementById('edit_guests').value = guests;
            document.getElementById('edit_reservationDateTime').value = reservationDateTime;
            document.getElementById('edit_timeSelect').value = timeSelect;
            document.getElementById('edit_menuSelect').value = menuSelect;
            document.getElementById('editModal').style.display = 'block';
        }

        // JavaScript 函數，用於更新訂單訊息
        function updateOrder() {
            var form = document.querySelector('#editModal form');
            var formData = new FormData(form);

            fetch('update.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.text())
                .then(message => {
                    alert(message); // 顯示更新結果訊息
                    document.getElementById('editModal').style.display = 'none'; // 關閉模態框
                    window.location.reload(); // 重新整理頁面
                })
                .catch(error => {
                    console.error('更新訂單資訊失敗:', error);
                    alert('更新訂單資訊失敗');
                });
        }
        fetch("we-receiver.php", {
        method: "POST",
        body: formData,
      })
        .then((response) => {
          if (response.ok) {
            return response.json();
          } else {
            // 處理非 200 OK 的 HTTP 狀態碼
            return response.json().then((data) => {
              throw new Error(`${response.status} - ${data.message}`);
            });
          }
        })
        .then((data) => {
          // 處理成功的情況
          console.log(data.message);
        })
        .catch((error) => {
          console.error("AJAX 請求失敗:", error);
          alert(error.message);
        });
    </script>

</body>

</html>