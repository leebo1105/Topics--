<?php
if (!isset($_SESSION)) {
  # 如果沒有設定 $_SESSION, 才啟動
  session_start();
}
// 連線到資料庫
require __DIR__ . '/config/pdo-connect.php';
$title = '登入';
$pageName = 'login';
?>
<?php include __DIR__ . './index-parts/index-html-head.php' ?>
<!-- 測試表單 -->

<?php include __DIR__ . './index-parts/index-navbar.php' ?>
<header class="masthead">
  <div class="container h-100 d-flex justify-content-center align-items-center">
    <div class="row justify-content-center">

      <!-- 登入表單 -->
      <form class="col-lg-12 col-sm-12" name="form1" method="post" onsubmit="sendData(event)">

        <!-- 會員帳號 -->
        <!-- POST 有設定的話,將[]內丟出來, 無設定的話, 丟出空字串 -->
        <div class="mb-3">
          <label for="account" class="form-label">帳號</label>
          <input type="text" class="form-control" id="account" name="account" />

          <!-- 記住帳號 -->
          <input class="form-check-input" type="checkbox" id="defaultCheck1" />
          <label class="form-check-label text-white" for="defaultCheck1">
            記住帳號
          </label>

        </div>
        </ㄑ>
        <!-- 會員密碼 -->

        <div class="mb-3">
          <label for="password" class="form-label">密碼</label>
          <input type="password" id="password" class="form-control" name="password" />

          <!-- 忘記密碼, 需再做一個分頁email驗證找回密碼 -->
          <div>
            <a href="#" class="">忘記密碼</a>
          </div>

        </div>


        <!-- 登入表單送出 -->

        <div class="col-3 mx-auto py-3 ">

          <button class="btn btn-primary" type="submit">登入</button>

        </div>

        <hr class="border border-1 mg-1">

        <!-- 第三方登入 -->
        <div class="row justify-content-center">

          <div class="col-1 d-flex justify-content-end">
            <a href="#"><i class="fa-brands fa-google"></i></a>
            <a href="#"><i class="fa-brands fa-line mx-3 fa-lg"></i></a>
          </div>
        </div>
      </form>
    </div>
  </div>
</header>


<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="myModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="myModal">會員登入</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="alert alert-danger" role="alert">
          帳號或密碼錯誤
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">繼續登入</button>
      </div>
    </div>
  </div>
</div>
<?php include __DIR__ . './index-parts/index-scripts.php' ?>


<script>
  const sendData = e => {
    e.preventDefault();
    const fd = new FormData(document.form1); // 建立一個只有資料的表單物件

    fetch('index-login-api.php', {
        method: 'POST',
        body: fd, // 預設的 Content-Type: multipart/form-data
      })
      .then(r => r.json())
      .then(data => {
        console.log(data);
        if (data.success) {
          // 如果登入成功，依據後端判斷給予URL
          if (data.redirect) {
            // 如果有重定向 ,將畫面跳轉 URL
            location.href = data.redirect;
          } else {
            // 否則跳至一般網頁
            location.href = 'index-list.php';
          }
        } else {
          // 登入失败，
          myModal.show();
        }
      }).catch(ex => {
        console.log(`fetch() 發生錯誤, 回傳的 JSON 格式是錯的`);
        console.log(ex);
      })

  }

  const myModal = new bootstrap.Modal('#myModal');
</script>
<?php include __DIR__ . './index-parts/index-html-foot.php' ?>