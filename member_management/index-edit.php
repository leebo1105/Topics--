<?php

require __DIR__ . '/config/pdo-connect.php';

// 檢查是否收到了有效的會員 ID
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if (empty($id)) {
  header('Location: index-list.php');
  exit; // 結束 php 程式
}

$sql = "SELECT 
mp.id,
mp.member_name,
mp.gender,
mp.email,
mp.mobile,
mp.birthday,
ml.account,
ml.role,
mp.create_date
FROM 
member_profile mp
JOIN 
member_login ml ON mp.id = ml.member_profile_id
WHERE 
mp.id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);
$row = $stmt->fetch();
// 查詢該會員購物車金額
$totalPriceQuery = "SELECT SUM(totalPrice) AS total_price FROM member_card WHERE member_profile_id = ?";
$totalPriceStmt = $pdo->prepare($totalPriceQuery);
$totalPriceStmt->execute([$id]);
// 從執行結果中獲取一行數據，並將其以關聯數組的形式存儲在 $totalPriceRow 變量中
$totalPriceRow = $totalPriceStmt->fetch(PDO::FETCH_ASSOC);

// 轉換為整數
$totalPrice = intval($totalPriceRow['total_price']);

// 如果沒有這個編號的資料, 轉向回列表頁
if (empty($row)) {
  header('Location: index-list.php');
  exit; // 結束 php 程式
}
?>
<?php include __DIR__ . './index-parts/index-html-head.php' ?>
<style>

</style>
<?php include __DIR__ . './index-parts/index-navbar.php' ?>
<header class="masthead">
  <div class="container px-4 px-lg-5 px-md-5 h-100">
    <div class="row justify-content-center align-items-center">
      <div class="col-12 col-lg-9 col-xl-7">
        <div class="text-white" style="border-radius: 15px">
          <div class="card-body p-4 p-md-5">
            <form name="form1" method="post" onsubmit="sendData(event)">
            <!-- 會員導覽列 -->
            <?php include __DIR__ . './index-parts/index-edit-navbar.php' ?>

            <!-- 累積金額 -->
            <?php include __DIR__ . './manage-level/manage-level.php' ?>

              <div class=" mb-1 pb-1 py-2">
                會員編號:
                <input type="button" value="<?= $row['id'] ?>" readonly>
                
              </div>

              <input type="hidden" name="birthday" value="<?= $row['birthday'] ?>" />

              <div class="row">
                <!-- 會員姓名欄位 -->
                <div class="col-md-6 mb-1 pb-1">
                  <div data-mdb-input-init class="form-outline">
                    <label for="member_name" class="form-label">會員姓名</label>
                    <input type="text" id="member_name" name="member_name" class="form-control" value="<?= $row['member_name'] ?>" />
                  </div>
                </div>
                <!-- 帳號欄位 -->
                <div class="col-md-6 mb-3">
                  <div data-mdb-input-init class="form-outline">
                    <label for="account" class="form-label">帳號</label>
                    <input class="form-control" name="account" id="account" type="text" value="<?= $row['account'] ?>" readonly />
                  </div>
                </div>

                <!-- Email欄位 -->
                <div class="col-md-6 mb-1">
                  <div data-mdb-input-init class="form-outline">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" class="form-control" id="email" name="email" value="<?= $row['email'] ?>" readonly />
                  </div>
                </div>
                <!-- 會員電話號碼 -->
                <div class="col-md-6 mb-3">
                  <label for="mobile" class="form-label">手機號碼</label>
                  <input class="form-control" type="tel" name="mobile" id="mobile" maxlength="10" value="<?= $row['mobile'] ?>" readonly />
                </div>

              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</header>

<?php include __DIR__ . './index-parts/index-scripts.php' ?>
<script>



</script>



<?php include __DIR__ . './index-parts/index-html-foot.php' ?>