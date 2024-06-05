<?php
if (!isset($_SESSION)) {
  # 如果沒有設定 $_SESSION, 才啟動
  session_start();
}
$title = '會員註冊';
$pageName = 'ab_add';
?>
<?php include __DIR__ . './index-parts/index-html-head.php' ?>
<style>
  .form-text {
    color: red;
  }
</style>
<?php include __DIR__ . './index-parts/index-navbar.php' ?>
<style>
</style>
<header class="masthead">
  <div class="container px-4 px-lg-5 px-md-5 h-100">
    <div class="row justify-content-center align-items-center">
      <div class="col-12 col-lg-9 col-xl-7">
        <div class="text-white" style="border-radius: 15px">
          <div class="card-body p-4 p-md-5">
            <h3 class="mb-2 pb-1 pb-md-0 mb-md-5">會員資料</h3>

            <!-- form 表單欄位 -->

            <form name="form1" method="post" onsubmit="sendData(event)">
              <div class="row">

                <!-- 帳號欄位 -->
                <div class="col-md-6 mb-3">
                  <div data-mdb-input-init class="form-outline">

                    <label for="account" class="form-label">帳號</label>
                    <input class="form-control" name="account" id="account" type="text" />

                  </div>
                </div>

                <!-- 會員姓名欄位 -->
                <div class="col-md-6 mb-1 pb-1">
                  <div data-mdb-input-init class="form-outline">

                    <label for="member_name" class="form-label">會員姓名</label>
                    <input type="text" id="member_name" name="member_name" class="form-control" />

                  </div>

                </div>

              </div>
              <!-- 密碼欄位 -->
              <div class="row">
                <div class="col-md-6 mb-3 d-flex align-items-center">
                  <div data-mdb-input-init class="form-outline datepicker w-100">

                    <label class="form-label" for="account">密碼</label>
                    <input type="password" name="password" class="form-control" id="password" />

                  </div>
                </div>

                <!-- 性別欄位 -->
                <div class="col-md-6 mb-2">
                  <h6 class="mb-2 pb-1">性別:</h6>

                  <div class="form-check form-check-inline pt-2">
                    <label class="form-check-label" for="female">女生</label>

                    <input class="form-check-input" type="radio" name="gender" id="female" value="女" checked />
                  </div>

                  <div class="form-check form-check-inline pt-2">
                    <input class="form-check-input" type="radio" name="gender" id="male" value="男" />

                    <label class="form-check-label" for="male">男生</label>
                  </div>

                </div>

                <!-- Email欄位 -->
                <div class="col-md-6 mb-1 ">
                  <div data-mdb-input-init class="form-outline">

                    <label for="email" class="form-label"><span class="required"></span> Email</label>
                    <input type="text" class="form-control" id="email" name="email" />

                  </div>
                </div>

                <!-- 生日欄位 -->
                <div class="col-md-6 mb-2">

                  <label for="birthday" class="form-label">生日</label>
                  <input class="form-control" type="date" name="birthday" id="birthday" />

                </div>
                <!-- 會員電話號碼 -->
                <div class="col-md-6 mb-3">

                  <label for="mobile" class="form-label">手機號碼</label>
                  <input class="form-control" type="tel" name="mobile" id="mobile" maxlength="10" />

                </div>


                <!-- 購物資訊欄位 彈出按鈕-->
                <div class="col-md-6">
                  <label for="" class="form-label">(非必填)</label>
                  <br>
                  <a class="btn btn-primary" data-bs-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">
                    購物欄位資訊
                  </a>
                </div>

              </div>
              <!-- 購物資訊欄位-->

              <div class="row">
                <div class="col">
                  <div class="collapse multi-collapse" id="multiCollapseExample1">

                    <div class="row">
                      <div class="col-6 mb-2">

                        <label for="receive_name" class="form-label">收件者姓名</label>
                        <input type="text" id="receive_name" name="receive_name" class="form-control" />

                      </div>
                      <div class="col-6 mb-2">

                        <label for="contact_mobile" class="form-label">
                          收件人電話號碼
                        </label>
                        <input type="text" id="contact_mobile" name="contact_mobile" class="form-control" />


                      </div>
                    </div>
<!-- 
                    <div class="row">
                      <div class="col-12">
                        <div class="row g-3">
                          <div class="col">

                            <label for="" class="form-label">縣市</label>
                            <select class="form-select" name="" id="">
                              <option value="0">請選擇縣市</option>
                              <option value="1">台北市</option>
                              <option value="2">台中市</option>
                              <option value="3">台南市</option>
                            </select>

                          </div>
                          <div class="col">

                            <label for="" class="form-label">鄉鎮市區</label>
                            <select class="form-select" name="" id="">
                              <option value="0">請選擇鄉鎮市區</option>
                              <option value="1">台北市</option>
                              <option value="2">台中市</option>
                              <option value="3">台南市</option>
                            </select>

                          </div>
                          <div class="col">

                            <label for="" class="form-label">郵遞區號</label>
                            <input type="text" class="form-control" />

                          </div>
                        </div>
                      </div>
                    </div> -->

                    <div class="row">
                      <div class="col-12">

                        <label for="address" class="form-label">
                          送貨地址
                        </label>
                        <input type="text" class="form-control" id="address" name="address" />

                      </div>
                    </div>

                  </div>
                </div>
              </div>
              <!-- 購物資訊欄位 -->

              <!-- 隱私權按鈕, 打勾才可以註冊 -->
              <div class="form-check d-flex justify-content-start pt-2">

                <input class="form-check-input me-2" type="checkbox" id="agreementCheckbox" onchange="toggleRegisterButton()" />
                <label class="form-check-label" for="agreementCheckbox">我已閱讀並同意
                  <button type="button" class="btn btn-white text-primary p-0 text-decoration-underline" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    隱私權條款
                  </button>

                  <!-- Modal -->
                  <div class="modal fade text-black" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">
                            隱私權條款
                          </h5>
                        </div>
                        <div class="modal-body">
                          非常歡迎您光臨「牡丹樓官方網站」（以下簡稱本網站），為了讓您能夠安心使用本網站的各項服務與資訊，特此向您說明本網站的隱私權保護政策，以保障您的權益，請您詳閱下列內容：
                          一、隱私權保護政策的適用範圍
                          隱私權保護政策內容，包括本網站如何處理在您使用網站服務時收集到的個人識別資料。隱私權保護政策不適用於本網站以外的相關連結網站，也不適用於非本網站所委託或參與管理的人員。
                          二、個人資料的蒐集、處理及利用方式
                          當您造訪本網站或使用本網站所提供之功能服務時，我們將視該服務功能性質，請您提供必要的個人資料，並在該特定目的範圍內處理及利用您的個人資料；非經您書面同意，本網站不會將個人資料用於其他用途。
                          本網站在您使用服務信箱、問卷調查等互動性功能時，會保留您所提供的姓名、電子郵件地址、聯絡方式及使用時間等。
                          於一般瀏覽時，伺服器會自行記錄相關行徑，包括您使用連線設備的IP位址、使用時間、使用的瀏覽器、瀏覽及點選資料記錄等，做為我們增進網站服務的參考依據，此記錄為內部應用，決不對外公佈。
                          為提供精確的服務，我們會將收集的問卷調查內容進行統計與分析，分析結果之統計數據或說明文字呈現，除供內部研究外，我們會視需要公佈統計數據及說明文字，但不涉及特定個人之資料。
                          三、資料之保護
                          本網站主機均設有防火牆、防毒系統等相關的各項資訊安全設備及必要的安全防護措施，加以保護網站及您的個人資料採用嚴格的保護措施，只由經過授權的人員才能接觸您的個人資料，相關處理人員皆簽有保密合約，如有違反保密義務者，將會受到相關的法律處分。
                          如因業務需要有必要委託其他單位提供服務時，本網站亦會嚴格要求其遵守保密義務，並且採取必要檢查程序以確定其將確實遵守。
                          四、網站對外的相關連結
                          本網站的網頁提供其他網站的網路連結，您也可經由本網站所提供的連結，點選進入其他網站。但該連結網站不適用本網站的隱私權保護政策，您必須參考該連結網站中的隱私權保護政策。
                          五、與第三人共用個人資料之政策
                          本網站絕不會提供、交換、出租或出售任何您的個人資料給其他個人、團體、私人企業或公務機關，但有法律依據或合約義務者，不在此限。
                          前項但書之情形包括不限於： 經由您書面同意。
                          法律明文規定。
                          為免除您生命、身體、自由或財產上之危險。
                          與公務機關或學術研究機構合作，基於公共利益為統計或學術研究而有必要，且資料經過提供者處理或蒐集著依其揭露方式無從識別特定之當事人。
                          當您在網站的行為，違反服務條款或可能損害或妨礙網站與其他使用者權益或導致任何人遭受損害時，經網站管理單位研析揭露您的個人資料是為了辨識、聯絡或採取法律行動所必要者。
                          有利於您的權益。
                          本網站委託廠商協助蒐集、處理或利用您的個人資料時，將對委外廠商或個人善盡監督管理之責。
                          六、Cookie之使用
                          為了提供您最佳的服務，本網站會在您的電腦中放置並取用我們的Cookie，若您不願接受Cookie的寫入，您可在您使用的瀏覽器功能項中設定隱私權等級為高，即可拒絕Cookie的寫入，但可能會導至網站某些功能無法正常執行
                          。 七、隱私權保護政策之修正
                          本網站隱私權保護政策將因應需求隨時進行修正，修正後的條款將刊登於網站上。
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            取消
                          </button>
                          <button type="button" class="btn btn-primary" data-bs-dismiss="modal">
                            我已閱讀並同意
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- 隱私權按鈕, 打勾才可以註冊 -->

                </label>

              </div>

              <div class="col mt-1 d-flex justify-content-center">

                <button type="submit" id="registerButton" class="btn btn-primary" disabled>
                  註冊
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</header>

<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="myModal">會員註冊</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="alert alert-success" role="alert">
          註冊成功
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">關閉</button>
        <a href="index-list.php" class="btn btn-primary">返回首頁</a>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="myModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="myModal2">註冊失敗</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <div id="error-message" class="alert alert-danger" role="alert"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">關閉</button>
        <a href="index-list.php" class="btn btn-primary">返回首頁</a>
      </div>
    </div>
  </div>
</div>

<?php include __DIR__ . './index-parts/index-scripts.php' ?>
<script>

  
  // ----隱私權條款按鈕----
  function toggleRegisterButton() {
    var agreementCheckbox = document.getElementById('agreementCheckbox');
    var registerButton = document.getElementById('registerButton');

    // 隱私權框被選中,才啟用註冊鍵
    if (agreementCheckbox.checked) {
      registerButton.disabled = false;
    } else {
      registerButton.disabled = true;
    }
  }
  // 取個欄位值, 姓名, email, 帳號, 密碼, 手機, 生日
  const nameField = document.form1.member_name;
  const emailField = document.form1.email;
  const accountField = document.form1.account;
  const passwordField = document.form1.password;
  const mobileField = document.form1.mobile;
  const birthdayField = document.form1.birthday;
  const today = new Date(); // 當天日期, 用於與生日做驗證 => 不能小於當天

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

  function validatePassword(passwordField) {
    // 包含至少一个小写字母、一个数字，长度在8到16之间
    var re = /^(?=.*[a-z])(?=.*\d)[a-zA-Z\d]{8,16}$/;
    return re.test(passwordField);
  }

  // 生日驗證
  function validateBirthday(birthdayField) {
    const selectedDate = new Date(birthdayField.value);

    const isValid = selectedDate <= today;

    return isValid;
  }

  const sendData = e => {
    e.preventDefault();


    let isPass = true; // 通過, 初始化 true 通過


    // TODO: 欄位資料檢查 ,每個欄位獨立檢察

    // 使用者 birthdayField 不能小於當前日期
    // 生日
    if (!validateBirthday(birthdayField)) {
      isPass = false;
      birthdayField.style.border = '1px solid red';
      birthdayField.style.color = 'red';
      alert('請填寫正確出生日');
    }
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

    if (!validatePassword(passwordField.value)) {
      isPass = false;
      alert('請輸入密碼,包含小寫字母與數字,長度6~12之間');
    }


    // 如欄位都有通過檢查
    // 預設值 true, 只要有一欄錯誤 = false
    if (isPass) {
      // FormData 表單物件
      // FormData 沒有外觀的表單, 將有外觀的表單有效欄位,放到這個表單
      const fd = new FormData(document.form1)

      fetch('index-add-api.php', {
    method: 'POST',
    body: fd,
  })
  .then(r => r.json())
  .then(data => {
    console.log(data);
    if(data.success){
      myModal.show();
    } else {
      if(data.error_message) {
        document.getElementById('error-message').innerText = data.error_message; // 在这里显示错误消息给用户
        myModal2.show();
      } else{
        myModal2.show();
      }
    }
  })
  .catch(ex => {
    console.log('fetch() error:', ex);
    myModal2.show();
  });
}

  }
  $('#myModal2').on('hidden.bs.modal', function (e) {
    // 當用戶按返回時,清除錯誤信號,讓用戶可以繼續編輯
    $('.alert.alert-danger', this).text('');
});

  const myModal = new bootstrap.Modal('#myModal')
  const myModal2 = new bootstrap.Modal('#myModal2')
</script>
<?php include __DIR__ . './index-parts/index-html-foot.php' ?>