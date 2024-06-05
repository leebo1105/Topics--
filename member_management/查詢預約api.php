<?php

if (!isset($_SESSION['admin'])) {
    die("未登入，請先登入會員系統");
}

$member_id = $_SESSION['admin']['id'];

// 建立資料庫連線
$mysqli = new mysqli("localhost", "root", "P@ssw0rd", "mudanlow");

// 檢查連線
if ($mysqli->connect_error) {
    die("連線失敗: " . $mysqli->connect_error);
}

// 準備 SQL 語句
$sql = "SELECT 
    r.id,
    r.table_type, 
    r.people, 
    r.date, 
    r.time, 
    r.dining_method,
    m.member_name,
    m.mobile
FROM reservation r
JOIN member_profile m ON r.member_profile_id = m.id
WHERE r.member_profile_id = ?
ORDER BY ABS(DATEDIFF(r.date, CURDATE())) ASC
LIMIT 3";

$stmt = $mysqli->prepare($sql);

if (!$stmt) {
    die("預備語句失敗: " . $mysqli->error);
}

// 綁定參數並執行語句
$stmt->bind_param("i", $member_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        ?>
        <div id="whiteSquare<?php echo $row['id']; ?>" class="white-square3 mx-2 mt-5 col-4" <?php echo empty($row['table_type']) ? 'style="display: none;"' : ''; ?>>
    <h4 class="text-center mt-3">確認您的預約資訊 <?php echo $row['id']; ?></h4>
    <div class="d-flex justify-content-between">
        <div class="lh-lg mx-3">
            會員姓名:<br>
            電話:<br>
            桌型:<br>
            人數:<br>
            日期:<br>
            時間:<br>
            用餐方式:
        </div>
        <div class="lh-lg mx-3">
            <span id="text1<?php echo $row['id']; ?>"><?php echo $row['member_name']; ?></span><br>
            <span id="text2<?php echo $row['id']; ?>"><?php echo $row['mobile']; ?></span><br>
            <span id="text3<?php echo $row['id']; ?>"><?php echo $row['table_type']; ?></span><br>
            <span id="text4<?php echo $row['id']; ?>"><?php echo $row['people']; ?></span><br>
            <span id="text5<?php echo $row['id']; ?>"><?php echo $row['date']; ?></span><br>
            <span id="text6<?php echo $row['id']; ?>"><?php echo $row['time']; ?></span><br>
            <span id="text7<?php echo $row['id']; ?>"><?php echo $row['dining_method']; ?></span>
        </div>
    </div>
    <div class="d-flex justify-content-between mb-3 ">
        <!-- 毛玻璃背景 -->
        <div id="overlay" class="overlay"></div>
        <div id="whiteSquare<?php echo $row['id']; ?>_confirm" class="white-square" style="display: none;">
            <h4 class="text-center mt-3">確認您要取消的預約資訊</h4>
            <div class="d-flex justify-content-between">
                <div class="lh-lg mx-3">
                    會員姓名:<br>
                    電話:<br>
                    桌型:<br>
                    人數:<br>
                    日期:<br>
                    時間:<br>
                    用餐方式:
                </div>
                <div class="lh-lg mx-3">
                    <span id="confirm_text1<?php echo $row['id']; ?>"></span><br>
                    <span id="confirm_text2<?php echo $row['id']; ?>"></span><br>
                    <span id="confirm_text3<?php echo $row['id']; ?>"></span><br>
                    <span id="confirm_text4<?php echo $row['id']; ?>"></span><br>
                    <span id="confirm_text5<?php echo $row['id']; ?>"></span><br>
                    <span id="confirm_text6<?php echo $row['id']; ?>"></span><br>
                    <span id="confirm_text7<?php echo $row['id']; ?>"></span>
                </div>
            </div>
            <div class="d-flex justify-content-between mb-3">
                <button type="button" id="confirmCancel<?php echo $row['id']; ?>" class="btn btn-secondary w-50 mx-2">確認取消</button>
                <button type="button" id="cancelCancel<?php echo $row['id']; ?>" class="btn  btn-danger w-50 mx-2">取消</button>
            </div>
        </div>
        <button type="button" id="hideButton<?php echo $row['id']; ?>" class="btn btn-primary hideButton w-75 mx-auto mx-2" onclick="showConfirmCancel(<?php echo $row['id']; ?>)">取消預約</button>
    </div>
</div>

        <script>
            function showConfirmCancel(id) {
    // 顯示確認取消預約的區塊
    var confirmDiv = document.getElementById("whiteSquare" + id + "_confirm");
    confirmDiv.style.display = "block";

    // 顯示毛玻璃遮罩和預約資訊區塊
    var overlay = document.getElementById("overlay");
    overlay.style.display = "block";

    // 填充確認取消預約的資訊
    document.getElementById("confirm_text1" + id).textContent = document.getElementById("text1" + id).textContent;
    document.getElementById("confirm_text2" + id).textContent = document.getElementById("text2" + id).textContent;
    document.getElementById("confirm_text3" + id).textContent = document.getElementById("text3" + id).textContent;
    document.getElementById("confirm_text4" + id).textContent = document.getElementById("text4" + id).textContent;
    document.getElementById("confirm_text5" + id).textContent = document.getElementById("text5" + id).textContent;
    document.getElementById("confirm_text6" + id).textContent = document.getElementById("text6" + id).textContent;
    document.getElementById("confirm_text7" + id).textContent = document.getElementById("text7" + id).textContent;

    // 添加確認取消和取消按鈕的點擊事件處理函數
    document.getElementById("confirmCancel" + id).addEventListener("click", function() {
        deleteReservation(id);
        overlay.style.display = "none";
    });
    document.getElementById("cancelCancel" + id).addEventListener("click", function() {
        hideConfirmCancel(id);
        overlay.style.display = "none";
    });
}

function hideConfirmCancel(id) {
    // 隱藏確認取消預約的區塊
    var confirmDiv = document.getElementById("whiteSquare" + id + "_confirm");
    confirmDiv.style.display = "none";
}

function deleteReservation(id) {
    // 在此處添加 AJAX 請求,將預約 ID 傳送到後端進行刪除
    // 我們假設有一個名為 deleteReservation.php 的後端檔案
    $.ajax({
        url: "deleteReservation.php",
        type: "POST",
        data: { id: id },
        success: function(response) {
            // 刪除成功後,隱藏相應的預約資訊區塊
            var reservationDiv = document.getElementById("whiteSquare" + id);
            reservationDiv.style.display = "none";
            hideConfirmCancel(id);
        },
        error: function() {
            alert("刪除預約時出現錯誤");
        }
    });
}

        </script>
        <?php
    }
} else {
    echo "尚未有預約資訊";
}

// 關閉連線
$stmt->close();
$mysqli->close();
?>
