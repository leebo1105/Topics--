<?php
// 連線到資料庫
require __DIR__ . '/config/pdo-connect.php';
$title = '會員管理';
$pageName = 'ab_list';

$t_sql = "SELECT COUNT(1) FROM member_profile";

$perPage = 10; # 每一頁最多有幾筆

# 取得用戶要看第幾頁, 預設 1 
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
if ($page < 1) {
    // 當用戶輸入分頁小於0, 自動跳轉到第 1 頁
    header('Location: ?page=1');
    exit;
}
# 取得資料總筆數
$totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0];
# 預設值
$totalPages = 0;
$rows = [];
# 如果有資料才取得分頁資料
if ($totalRows > 0) {
    # 總頁數, 無條件進位
    $totalPages = ceil($totalRows / $perPage);

    if ($page > $totalPages) {
        // 當用戶輸入分頁大於最大值, 自動跳轉到最後頁
        header('Location: ?page=' . $totalPages);
        exit;
    }

    # 取表單, 降冪
    $sql = sprintf(
        "SELECT DISTINCT
        mp.id, # 會員ID
        mp.member_name, # 會員名稱
        mp.gender, # 性別
        mp.email, # Email
        mp.mobile, # 手機號碼
        mp.birthday, # 生日
        ml.account, # 帳號
        ml.role, # 會員權限
        ml.status, # 會員狀態
        mp.create_date # 帳號建立日期
        FROM 
        member_profile mp
        JOIN 
        member_login ml ON mp.id = ml.member_profile_id
        WHERE
        ml.status = 'active'
        ORDER BY  mp.id DESC LIMIT %s, %s",
        ($page - 1) * $perPage, # (page-1) * 15
        $perPage
    );
    # 取變數rows, 取所有的資料
    $rows = $pdo->query($sql)->fetchAll();
}

?>

<?php include __DIR__ . '../../../Topics/menu/part/html-head.php' ?>
<!-- body 在這 -->
<style>
    /* 在這修改直接覆蓋 */
    .bg-secondary li {
        list-style-type: none;
    }

    .color-red {
        color: brown;
    }

    .color-black {
        color: black
    }
</style>
<?php include __DIR__ . '/manage/manage-navbar.php' ?>

<div class="container ">
    <div class="row justify-content-center pt-2"> 
    <div class="pt-1">
        <h1>會員管理.<a href="manage-list-blacklist.php"><i class="bi bi-people-fill"></i>黑名單</a></h1>
    </div>
    <hr>
    <div class="row ">
        <form class="col" name="form3" method="post" onsubmit="validateForm (event)">
            <div class="float-end ">
                <div class="col py-1 ">
                    <!-- <input type="text" name="keyword" id="member-inquire" placeholder="請輸入關鍵字" />
                    <button type="submit" class="btn btn-light">查詢</button> -->
                </div>
            </div>
        </form>
        
        <div class="row">
            <!-- <div class="pt-4 col-9">
                <span>已選取:</span>
                <button>全選</button>
            </div> -->
            <!-- Button trigger modal -->


            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable color-black">
                    <form class="modal-content" name="form2" method="post" onsubmit="sendData(event)">

                        <div class="modal-header col">
                            <label for="member_name" class="form-label">管理者姓名</label>
                            <input type="text" id="member_name" name="member_name" class="form-control" />

                        </div>
                        <div class="modal-body">

                            <label for="account" class="form-label">帳號</label>
                            <input class="form-control" name="account" id="account" type="text" />
                            <br>
                            <label class="form-label" for="account">密碼</label>
                            <input type="password" name="password" class="form-control" id="password" />
                            <br>
                            <!-- 生日欄位 -->
                            <div class="col-md-6 mb-2">

                                <label for="birthday" class="form-label">生日</label>
                                <input class="form-control" type="date" name="birthday" id="birthday" />

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

                            <div data-mdb-input-init class="form-outline">

                                <label for="email" class="form-label"><span class="required"></span> Email</label>
                                <input type="text" class="form-control" id="email" name="email" />
                                <div class="col-md-6 mb-3">

                                    <label for="mobile" class="form-label">手機號碼</label>
                                    <input class="form-control" type="tel" name="mobile" id="mobile" maxlength="10" />

                                </div>
                                <div class="modal-footer">

                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消

                                    </button>

                                    <button type="submit" class="btn btn-primary">新增

                                    </button>

                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>

            <!-- Modal -->

        </div>

    </div>
    <div class="content">
        <div class="col-11 d-flex justify-content-end">
            <div class="mt-2">
                <button type="button" class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    新增管理者
                </button>
            </div>
        </div>
            <table class="table-data col-12">
                <thead>
                    <tr>
                    <th class="color-black"><i class="fa-regular fa-pen-to-square"></i></i>
                        </th>
                        <th>會員ID</th>
                        <th>會員名稱</th>
                        <th>手機號碼</th>
                        <th>性別</th>
                        <th>Email</th>
                        <th>生日</th>
                        <th>帳號</th>
                        <th>role</th>
                        <th>帳號建立時間</th>
                        <th class="color-black"><i class="fa-solid fa-ban"></i></th>
                    </tr>
                </thead>
                <tbody>
                    <!-- 資料表陣列迴圈用 foreach -->
                    <?php foreach ($rows as $r) : ?>
                        <tr class="table-data">

                        <td>
                                <a href="manage-edit.php?id=<?= $r['id'] ?>">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                </a>
                            </td>
                            <td><?= $r['id'] ?></td>
                            <td><?= $r['member_name'] ?></td>
                            <td><?= $r['mobile'] ?></td>
                            <td><?= $r['gender'] ?></td>
                            <td><?= $r['email'] ?></td>
                            <td><?= $r['birthday'] ?></td>
                            <td><?= $r['account'] ?></td>
                            <td><?= $r['role'] ?></td>
                            <td><?= $r['create_date'] ?></td>
                            <td>
                                <!-- 呼叫 JS -->
                                <a href="manage-blacklist.php?id=<?= $r['id'] ?>"class="color-red">
                                <i class="fa-solid fa-ban"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>

            </table>
            <!-- 分頁按鈕 -->
            <nav aria-label="Page navigation example" class="pt-3 ">

                <ul class=" d-flex justify-content-center list-unstyled">

                    <li class="page-item px-1 <?= $page == 1 ? 'disabled' : '' ?>">
                        <a class="page-link" href="?page=1 ?>"><i class="fa-solid fa-angles-left"></i></a>
                    </li>

                    <li class="page-item px-2 <?= $page == 1 ? 'disabled' : '' ?>">
                        <a class="page-link" href="?page=<?= $page - 1 ?>"><i class="fa-solid fa-angle-left"></i></a>
                    </li>

                    <!-- for 顯示頁數 +-3 if 限制只顯示 <= i >= -->
                    <?php for ($i = $page - 3; $i <= $page + 3; $i++) :
                        if ($i >= 1 and $i <= $totalPages) :
                    ?>

                            <li class="page-item">
                                <!-- ?開頭表示同一個php, 只需要換參數 -->
                                <a class="page-link px-2 <?= $page == $i ? 'text-body' : '' ?>" href="?page=<?= $i ?>"><?= $i ?></a>
                            </li>
                    <?php endif;
                    endfor; ?>

                    <li class="page-item px-2 <?= $page == $totalPages ? 'disabled' : '' ?>">
                        <a class="page-link" href="?page=<?= $page + 1 ?>"><i class="fa-solid fa-angle-right"></i></a>
                    </li>

                    <li class="page-item px-1 <?= $page == $totalPages ? 'disabled' : '' ?>">
                        <a class="page-link" href="?page=<?= $totalPages ?>"><i class="fa-solid fa-angles-right"></i></a>
                    </li>

                </ul>
            </nav>
        </div>
    </div>


<?php /*
<pre><?php 
print_r([
    '$perPage' => $perPage,
    '$totalRows' => $totalRows,
    '$totalPages' => $totalPages,
    '$rows' => $rows,
]);

?></pre>
*/ ?>

<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="myModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header color-black">
                <h1 class="modal-title fs-5" id="myModal">管理員註冊</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-success" role="alert">
                    註冊成功
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">關閉</button>
                <a href="manage-list.php" class="btn btn-primary">返回首頁</a>
            </div>
        </div>
    </div>
</div>


<?php include __DIR__ . '/manage/manage-scripts.php' ?>

<script>
    // 搜尋欄
    const validateForm = e => {
        e.preventDefault();

        const keyword = document.getElementById('member-inquire').value;
        if (!keyword.trim()) {
            console.log('請輸入關鍵字');
            return;
        }
        const fd = new FormData(document.form3);
        fetch('endpoint-api.php', {
                method: 'POST',
                body: fd
            })
            .then(response => response.json())
            .then(data => {

                displaySearchResults(data);
            })
            .catch(error => {
                console.log('Error', error);
            });
    };
    const displaySearchResults = (data) => {

        const tableBody = document.querySelector('.table-data tbody');
        tableBody.innerHTML = '';

        if (data.length > 0) {
            // 搜尋結果
            const html = data.map(item => {
                return `
                <tr class="table-data">
                <td>
                <a href="manage-edit.php?id=${item.id}">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                </a>
                            </td>
                    <td>${item.id}</td>
                    <td>${item.member_name}</td>
                    <td>${item.mobile}</td>
                    <td>${item.gender}</td>
                    <td>${item.email}</td>
                    <td>${item.birthday}</td>
                    <td>${item.account}</td>
                    <td>${item.role}</td>
                    <td>${item.create_date}</td>
                    <td>
                        <a href="javascript: deleteOne(${item.id})">
                            <i class="fa-solid fa-trash color-red"></i>
                        </a>
                    </td>
                </tr>
            `;
            }).join('');

            // 将结果添加到页面中
            tableBody.innerHTML = html;
        } else {
            // 没有搜索结果时显示提示信息
            tableBody.innerHTML = '<tr><td colspan="10">笑死 找不到</td></tr>';
        }
    };



    // 取個欄位值, 姓名, email, 帳號, 密碼, 手機, 生日
    const nameField = document.form2.member_name;
    const emailField = document.form2.email;
    const accountField = document.form2.account;
    const passwordField = document.form2.password;
    const mobileField = document.form2.mobile;
    const birthdayField = document.form2.birthday;
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
            const fd = new FormData(document.form2)

            fetch('admin-add-api.php', {
                    method: 'POST',
                    body: fd, // 預設 Content-Type: multipart/form-date
                })
                // 用json方式處理 ,呼叫 json
                .then(r => r.json())
                .then(data => {
                    console.log(data);
                    if (data.success) {
                        myModal.show();
                    } else {
                        console.log(`註冊失敗,請確認欄位輸入`);
                    }
                }).catch(ex => {
                    console.log(`fetch() 發生錯誤, 回傳的 JSON 格式錯誤`);
                    console.log(ex);

                })

        }

    }
    const deleteOne = id => {
        if (confirm(`是否要刪除編號為 ${id} 的會員`)) {
            location.href = `manage-del.php?id=${id}`
        }
    }


    const myModal = new bootstrap.Modal('#myModal')
</script>

<?php include __DIR__ . '/manage/manage-html-foot.php' ?>