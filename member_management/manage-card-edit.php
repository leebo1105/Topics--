<?php
require __DIR__ . '/config/pdo-connect.php';
// 檢查是否收到了有效的會員 ID
$c_id = isset($_GET['c_id']) ? intval($_GET['c_id']) : 0;

if (empty($c_id)) {
  header('Location: manage-list.php');
  exit; // 結束 php 程式
  }
// 檢查是否收到了有效的訂單編號
$c_id = isset($_GET['c_id']) ? intval($_GET['c_id']) : 0;

$sql = sprintf(
  "SELECT 
      mc.c_id,
      cs.sid as cart_status_id,
      cs.status_name,
      cs.status_remark,
      mp.id,
      mp.member_name,
      mp.mobile,
      mc.productName,
      mc.price,
      mc.quantity,
      MAX(mc.card_date) as card_date,
      SUM(mc.totalPrice) as totalPrice, # 金額加總
      mp.email,
      cb.receive_name,
      cb.address,
      cb.contact_mobile
  FROM 
      member_profile mp
  JOIN 
      member_card mc ON mp.id = mc.member_profile_id
  JOIN 
      contact_book cb ON mp.id = cb.member_profile_id
  JOIN 
      cart_status cs ON mc.status_id = cs.sid
  WHERE
      mc.c_id = ?
  GROUP BY 
  mc.c_id, 
  cs.sid,
  cs.status_name,
  cs.status_remark, 
  mp.id, 
  mp.member_name, 
  mp.mobile, 
  mc.productName,
  mc.price, 
  mc.quantity,
  mp.email, 
  cb.receive_name, 
  cb.address, 
  cb.contact_mobile"
);

$stmt = $pdo->prepare($sql);
$stmt->execute([$c_id]);
$rows = $stmt->fetchAll();

$totalPrice = 0;
foreach ($rows as $r) {
  $totalPrice += $r['totalPrice'];
}
// 如果沒有找到相應的訂單資訊，你可能想要處理一些錯誤情況，比如重新導向到訂單列表頁面。

?>

<?php include __DIR__ . '../../../Topics/menu/part/html-head.php' ?>
<style>
  .form-text {
    color: red;
  }
  .table-data{
    background-color: #cccccc;
  }
</style>
<?php include __DIR__ . '../../../Topics/member_management/manage/manage-navbar.php' ?>
<!-- 主要內容區域 -->

<div class="container px-4 px-lg-5 px-md-5 h-100">
  <div class="row justify-content-center align-items-center">
    <div class="card-body p-4 p-md-5">
    
      <form name="form1" method="post" onsubmit="sendData(event)">
        <h2 class="mb-2 pb-1 pb-md-0 mb-md-5">訂單資訊</h2>
        
        <div class=" mb-1 pb-1">
          訂單編號:
          <input type="button" value="<?= $rows[0]['c_id'] ?>" readonly>
        </div>
        <div class=" mb-1 pb-1">
          訂單建立日期:
          <input type="button" value="<?= $rows[0]['card_date'] ?>" readonly>
        </div>

        <div class="row">
          <!-- 會員姓名欄位 -->
          <div class="col-md-6 mb-1 pb-1">
            <div data-mdb-input-init class="form-outline">
              <label for="member_name" class="form-label">會員姓名</label>
              <input type="text" id="member_name" name="member_name" class="form-control" value="<?= $rows[0]['member_name'] ?>" />
            </div>
          </div>
          <!-- 帳號欄位 -->
          <div class="col-md-6 mb-3">
            <div data-mdb-input-init class="form-outline">
              <label for="account" class="form-label">會員編號</label>
              <input class="form-control" name="account" id="account" type="text" value="<?= $rows[0]['id'] ?>" />
            </div>
          </div>


          <!-- Email欄位 -->
          <div class="col-md-6 mb-1">
            <div data-mdb-input-init class="form-outline">
              <label for="email" class="form-label">Email</label>
              <input type="text" class="form-control" id="email" name="email" value="<?= $rows[0]['email'] ?>" />
            </div>
          </div>
          <!-- 會員電話號碼 -->
          <div class="col-md-6 mb-3">
            <label for="mobile" class="form-label">手機號碼</label>
            <input class="form-control" type="tel" name="mobile" id="mobile" maxlength="10" value="<?= $rows[0]['mobile'] ?>" />
          </div>
          <!-- 收件者姓名 -->
          <div class="col-6 mb-2">
            <label for="receive_name" class="form-label">收件者姓名</label>
            <input type="text" id="receive_name" name="receive_name" class="form-control" value="<?= $rows[0]['receive_name'] ?>" />
          </div>
          <!-- 收件人電話號碼 -->
          <div class="col-6 mb-2">
            <label for="contact_mobile" class="form-label">收件人電話號碼</label>
            <input type="text" id="contact_mobile" name="contact_mobile" class="form-control" value="<?= $rows[0]['contact_mobile'] ?>" />
          </div>
          <!-- 送貨地址 -->
          <div class="col-12">
            <label for="address" class="form-label">送貨地址</label>
            <input type="text" class="form-control" id="address" name="address" value="<?= $rows[0]['address'] ?>" />
          </div>

          <!-- 訂單明細 -->
          <table class="table-data col-12">
            <thead>

              <tr>
                <th>收件者姓名</th>
                <th>收件人電話號碼</th>
                <th>送貨地址</th>
                <th>Email</th>
                <th>商品</th>
                <th>數量</th>
                <th>商品價格</th>
              </tr>
            </thead>
            <tbody>
              <!-- 資料表陣列迴圈用 foreach -->
              <?php foreach ($rows as $r) : ?>
                <tr class="table-data">
                  <td><?= $r['receive_name'] ?></td>
                  <td><?= $r['contact_mobile'] ?></td>
                  <td><?= $r['address'] ?></td>
                  <td><?= $r['email'] ?></td>
                  <td><?= $r['productName'] ?></td>
                  <td><?= $r['quantity'] ?></td>
                  <td><?= $r['price'] ?></td>
                </tr>
              <?php endforeach ?>
            </tbody>
            <tfoot>
              <tr>
                <td colspan="6">總價格</td>
                <td><?= $totalPrice ?></td>
              </tr>
            </tfoot>
            
          </table>
        </div>
        <div class="py-2 mb-1 pb-1">
    訂單目前狀態:
    <input type="button" value="<?= $rows[0]['status_remark'] ?>" readonly>
    <button class="change-status-btn" data-cid="<?= $rows[0]['c_id'] ?>" data-sid="<?= $rows[0]['cart_status_id'] ?>">更改</button>
    <div class="status-select-container">
        <select id="status-select">
            <!-- 選項將由 JavaScript 動態添加 -->
        </select>
    </div>
</div>
      </form>
    </div>
  </div>
  
</div>

<?php include __DIR__ . '/manage/manage-scripts.php' ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // 獲取下拉選單元素
    const select = document.getElementById('status-select');
    
    // 定義狀態選項
    const statuses = [
        { id: 1, name: '已送出訂單, 待店家確認' },
        { id: 2, name: '店家以確認訂單,訂單處於待處理狀態' },
        { id: 3, name: '取消訂單,已取消' },
        { id: 4, name: '完成訂單,商品已送達' }
    ];
    
    // 動態添加選項
    statuses.forEach(status => {
        const option = document.createElement('option');
        option.value = status.id;
        option.textContent = status.name;
        select.appendChild(option);
    });
    
    // 獲取按鈕並設置點擊事件處理程序
    const buttons = document.querySelectorAll('.change-status-btn');
    buttons.forEach(button => {
        button.addEventListener('click', function() {
            const cid = this.dataset.cid; // 獲取訂單編號
            const sid = this.dataset.sid; // 獲取訂單狀態編號

            console.log(`訂單編號 ${cid} 狀態編號 ${sid}`);

            // 獲取所選狀態 ID
            const selectedSid = select.value;

            // 發送 AJAX 請求
            fetch('update_status.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    c_id: cid,
                    status_id: selectedSid
                })
            })
            .then(response => response.json())
            .then(data => {
                console.log(data);
                // 在此處根據後端返回的數據執行相應的操作，例如顯示成功消息或重新加載頁面等
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    });
});
</script>



<?php include __DIR__ . '/manage/manage-html-foot.php' ?>