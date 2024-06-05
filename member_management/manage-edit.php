<?php
require __DIR__ . '/config/pdo-connect.php';

// 檢查是否收到了有效的會員 ID
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if (empty($id)) {
  header('Location: manage-list.php');
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
mp.create_date,
cb.receive_name,
cb.address,
cb.contact_mobile
FROM 
member_profile mp
JOIN 
member_login ml ON mp.id = ml.member_profile_id
JOIN 
contact_book cb ON mp.id = cb.member_profile_id
WHERE 
mp.id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);
$row = $stmt->fetch();

// 如果沒有這個編號的資料, 轉向回列表頁
if (empty($row)) {
  header('Location: manage-list.php');
  exit; // 結束 php 程式
}
?>

<?php include __DIR__ . '/manage/manage-html-head.php' ?>
<style>
  .form-text {
    color: red;
  }
</style>
<?php include __DIR__ . '/manage/manage-navbar.php' ?>
<!-- 主要內容區域 -->

<div class="container px-4 px-lg-5 px-md-5 h-100">
  <div class="row justify-content-center align-items-center">
    <div class="card-body p-4 p-md-5">
      <form name="form1" method="post" onsubmit="sendData(event)">
        <h2 class="mb-2 pb-1 pb-md-0 mb-md-5">會員資料編輯</h2>
        <div class=" mb-1 pb-1">
          會員編號:
          <input type="button" value="<?= $row['id'] ?>" readonly>
        </div>
        <input type="hidden" name="id" value="<?= $row['id'] ?>" />
        <input type="hidden" name="gender" value="<?= $row['gender'] ?>" />
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
              <input class="form-control" name="account" id="account" type="text" value="<?= $row['account'] ?>" />
            </div>
          </div>

          <!-- 性別欄位 -->
          <div class="col-md-6 mb-2">
            <label class="form-label" for="gender">性別</label>
            <input type="text" name="gender" class="form-control" id="gender" value="<?= $row['gender'] ?>" readonly />
          </div>
          <!-- 生日欄位 -->
          <div class="col-md-6 mb-2">
            <label for="birthday" class="form-label">生日</label>
            <input class="form-control" type="date" name="birthday" id="birthday" value="<?= $row['birthday'] ?>" readonly />
          </div>
          <!-- Email欄位 -->
          <div class="col-md-6 mb-1">
            <div data-mdb-input-init class="form-outline">
              <label for="email" class="form-label">Email</label>
              <input type="text" class="form-control" id="email" name="email" value="<?= $row['email'] ?>" />
            </div>
          </div>
          <!-- 會員電話號碼 -->
          <div class="col-md-6 mb-3">
            <label for="mobile" class="form-label">手機號碼</label>
            <input class="form-control" type="tel" name="mobile" id="mobile" maxlength="10" value="<?= $row['mobile'] ?>" />
          </div>
          <!-- 收件者姓名 -->
          <div class="col-6 mb-2">
            <label for="receive_name" class="form-label">收件者姓名</label>
            <input type="text" id="receive_name" name="receive_name" class="form-control" value="<?= $row['receive_name'] ?>" />
          </div>
          <!-- 收件人電話號碼 -->
          <div class="col-6 mb-2">
            <label for="contact_mobile" class="form-label">收件人電話號碼</label>
            <input type="text" id="contact_mobile" name="contact_mobile" class="form-control" value="<?= $row['contact_mobile'] ?>" />
          </div>
          <!-- 送貨地址 -->
          <div class="col-12">
            <label for="address" class="form-label">送貨地址</label>
            <input type="text" class="form-control" id="address" name="address" value="<?= $row['address'] ?>" />
          </div>
          <div class="col pt-3 d-flex justify-content-center">
            <button type="submit" class="btn btn-primary">修改</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="myModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="myModal">會員編輯資料</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="alert alert-success" role="alert">
          編輯成功
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">關閉</button>
        <a href="manage-list.php" class="btn btn-primary">返回會員管理</a>
      </div>
    </div>
  </div>
</div>
<?php include __DIR__ . '/manage/manage-scripts.php' ?>
<script>


  // 取個欄位值, 姓名, email, 帳號, 密碼, 手機, 生日
  const nameField = document.form1.member_name;
  const emailField = document.form1.email;
  const accountField = document.form1.account;
  const mobileField = document.form1.mobile;
  // const addressField = document.form1.address;
  // const receive_nameField = document.form1.receive_name;
  // const contact_mobileField = document.form1.contact_mobile;
  
  // const passwordField = document.form1.password;
  
  
  
  // email 通過
  function validateEmail(email) {
    var re =
      /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
  }
  // 驗證帳密格式
  function validateAccount(accountField) {
    // 只包含字母和数字，长度在6到12之间
    var re = /^[a-zA-Z0-9]{6,12}$/;
    return re.test(accountField);
  }



  const sendData = e => {
    e.preventDefault();


    let isPass = true; // 通過, 初始化 true 通過


    // TODO: 欄位資料檢查 ,每個欄位獨立檢察

    // 使用者 birthdayField 不能小於當前日期
   
    // 如果 姓名欄位 長度 小於 2 
    if (nameField.value.length < 2) {
  isPass = false;
  // 跳提示用戶
  nameField.style.border = '1px solid red';
  nameField.style.color = 'red';
  nameField.value = '請填寫正確的姓名';
  
  // 點擊消失
  nameField.onclick = function() {
    if (this.value === '請填寫正確的姓名') {
      this.value = '';
      this.style.color = ''; // 恢复默认字体颜色
    }
  };
}

    // 手機不通過
    if (mobileField.value.length < 9) {
      isPass = false;
      
      // 跳提示用戶
      mobileField.style.border = '1px solid red';
      mobileField.style.color = 'red';
      mobileField.value = '請填寫正確的手機';
  
  // 點擊消失
  mobileField.onclick = function() {
    if (this.value === '請填寫正確的手機') {
      this.value = '';
      this.style.color = ''; // 恢复默认字体颜色
    }
  };
    }

    // 加! 不通過
    if (!validateEmail(emailField.value)) {
      isPass = false;
      // 跳提示用戶
      emailField.style.border = '1px solid red';
      emailField.style.color = 'red';
      emailField.value = '請填寫正確的Email';
  
  // 點擊消失
  emailField.onclick = function() {
    if (this.value === '請填寫正確的Email') {
      this.value = '';
      this.style.color = ''; // 恢复默认字体颜色
    }
  };
    }

    // 帳密不通過
    if (!validateAccount(accountField.value)) {
      isPass = false;
      alert('請輸入帳號,包含字母數字,長度6~12之間');
    }


    // 如欄位都有通過檢查
    // 預設值 true, 只要有一欄錯誤 = false
    if (isPass) {
      // FormData 表單物件
      // FormData 沒有外觀的表單, 將有外觀的表單有效欄位,放到這個表單
      const fd = new FormData(document.form1)

      fetch('manage-edit-api.php', {
          method: 'POST',
          body: fd, // 預設 Content-Type: multipart/form-date
        })
        // 用json方式處理 ,呼叫 json
        .then(r => r.json())
        .then(data => {
          console.log(data);
          if(data.success){
            myModal.show();
          } else{
            console.log(`註冊失敗,請確認欄位輸入`);
          }
        }).catch(ex=>{
          console.log(`fetch() 發生錯誤, 回傳的 JSON 格式錯誤`);
          console.log(ex);

        })

    }

  }



  const myModal = new bootstrap.Modal('#myModal')
</script>


<?php include __DIR__ . '/manage/manage-html-foot.php' ?>