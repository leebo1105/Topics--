<?php
require __DIR__ . '/config/pdo-connect.php';
$t_sql = "SELECT COUNT(1) FROM articles";

$perPage = 3; #每一頁最多有幾筆

#取得用戶要看第幾頁
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
if ($page < 1) {
    #頁碼小於1跳轉到第一頁
    header('Location: ?page=1');
    exit;
}

#取得資料總筆數
$totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0];
#預設值
$totalPages = 0;
$row = [];
if ($totalRows > 0) {
    #如果有資料才去取得分頁資料
    $totalPages = ceil($totalRows / $perPage); #無條件進位
    #頁碼大於總頁數時，留在最後一頁
    if ($page > $totalPages) {
        header('Location: ?page=' . $totalPages);
        exit;
    }

    $sql = sprintf(
        "SELECT * FROM articles JOIN key_words ON key_word_id = key_words.k_id ORDER BY a_id DESC LIMIT %s, %s",
        ($page - 1) * $perPage,
        $perPage
    );
    $row = $pdo->query($sql)->fetchAll();
}
//echo json_encode($row);

?>

<?php include __DIR__ . '../../../../Topics/menu/part/html-head.php' ?>
<?php include __DIR__ . '../../../../Topics/member_management/manage/manage-navbar.php' ?>
<!-- 主要內容區域 -->

<div class="container">
<div class="row justify-content-center pt-2"> 
    <div class="title mb-3">
        <h1>文章管理</h1>
    </div>
    <hr>


        <div class="article-table">
        <!-- 下拉式選單 -->
        <div class="dropdown d-flex justify-content-between my-2">
            <div class="my-2">
                <form id="queryForm">
                    <button class="btn btn-secondary  dropdown-toggle" type="button" id="selectedValueButton" data-bs-toggle="dropdown" aria-expanded="false">
                        關鍵字搜尋
                    </button>
                    <ul class="dropdown-menu" id="key_word_id" aria-labelledby="selectedValueButton">
                        <li><a class="dropdown-item" href="#" data-value="1">所有文章</a></li>
                        <li><a class="dropdown-item" href="#" data-value="2">新菜消息</a></li>
                        <li><a class="dropdown-item" href="#" data-value="3">節慶活動</a></li>
                        <li><a class="dropdown-item" href="#" data-value="4">公休時間</a></li>
                        <li><a class="dropdown-item" href="#" data-value="5">貓咪認養</a></li>
                    </ul>
                    <button class="btn btn-secondary dropdown-toggle " type="button" id="dropdownYear" data-bs-toggle="dropdown" aria-expanded="false">
                        年
                    </button>
    
                    <ul class="dropdown-menu slide-date" aria-labelledby="dropdownYear" id="yearList">
                        <!-- 這裡用 JavaScript 動態生成年份 -->
                    </ul>
    
    
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMonth" data-bs-toggle="dropdown" aria-expanded="false">
                        月
                    </button>
                    <ul class="dropdown-menu slide-date" aria-labelledby="dropdownMonth" id="monthList">
                        <!-- 這裡用 JavaScript 動態生成月份 -->
                    </ul>
    
    
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownDay" data-bs-toggle="dropdown" aria-expanded="false">
                        日
                    </button>
                    <ul class="dropdown-menu slide-date" aria-labelledby="dropdownDay" id="dayList">
                        <!-- 這裡用 JavaScript 動態生成日期 -->
                    </ul>
                    <button class="btn btn-secondary" type="submit">查詢</button>
                </form>
                </div>
            <!-- 頁碼 -->
            <div class="mt-2">
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item <?= $page == 1 ? 'disabled' : '' ?>">
                            <a class="page-link" href="?page=1">
                                <i class="fa-solid fa-angles-left"></i>
                            </a>
                        </li>
                        <li class="page-item <?= $page == 1 ? 'disabled' : '' ?>">
                            <a class="page-link" href="?page=<?= $page - 1 ?>">
                                <i class="fa-solid fa-angle-left"></i>
                            </a>
                        </li>
                        <?php for ($i = $page - 5; $i <= $page + 5; $i++) :
                            if ($i >= 1 and $i <= $totalPages) :
                        ?>
                                <li class="page-item <?= $page == $i ? 'active' : '' ?>">
                                    <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                                </li>
                        <?php endif;
                        endfor; ?>
                        <li class="page-item <?= $page == $totalPages ? 'disabled' : '' ?>">
                            <a class="page-link" href="?page=<?= $page + 1 ?>">
                                <i class="fa-solid fa-angle-right"></i>
                            </a>
                        </li>
                        <li class="page-item <?= $page == $totalPages ? 'disabled' : '' ?>">
                            <a class="page-link" href="?page=<?= $totalPages ?>">
                                <i class="fa-solid fa-angles-right"></i>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <!-- 資料表格 -->
        <table class="table-data">
            <thead>
                <tr>
                    <th>文章編號</th>
                    <th>日期</th>
                    <th>標題</th>
                    <th>內文</th>
                    <th>圖片連結</th>
                    <th>關鍵字</th>
                    <th>修改</th>
                    <th>刪除</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($row as $r) : ?>
                    <tr>
                        <td><?= $r['a_id'] ?></td>
                        <td><?= $r['date'] ?></td>
                        <td><?= $r['title'] ?></td>
                        <td><?= htmlentities($r['content']) ?></td>
                        <td> <?php
                                // 判断是否有图片链接
                                if (!empty($r['photos'])) :
                                    // 将图片链接拆分为数组
                                    $photos = json_decode($r['photos'], true);
                                    foreach ($photos as $photo) :
                                ?>
                                    <!-- 使用超链接展示图片链接 -->
                                    <a href="../uploads/<?= $photo ?>" target="_blank"><?= $photo ?></a><br>
                            <?php
                                    endforeach;
                                else :
                                    // 没有图片链接时显示空白
                                    echo "";
                                endif;
                            ?>
                        </td>
                        <td><?= $r['key_name'] ?></td>
                        <td>
                            <a href="edit-js.php?a_id=<?= $r['a_id'] ?>">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                        </td>
                        <td>
                            <a href="javascript: deleteOne(<?= $r['a_id'] ?>)">
                                <i class="fa-solid fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
    <div class="article-content  d-flex">
        <div>
            <h5>新增文章:</h5>
        </div>
        <!-- 資料表單 -->
        <div class="article-form">
            <div class="container">
                <div class="row">
                    <div class="col-9">
                        <div class="card-body">
                            <form name="form1" onsubmit="sendData(event)">
                                <div class="mb-3 center-form">
                                    <td>
                                    <label for="date" class="form-label">日期:</label>
                                    <input type="date" class="form-control" id="date" name="date">
                                    <div class="form-text"></div>
                                    </td>
                                    
                                </div>
                                <div class="mb-3 center-form">
                                    <td>
                                        <label for="title" class="form-label">標題:</label>
                                        <input type="text" class="form-control" id="title" name="title">
                                    </div>
                                    </td>
                                <div class="mb-3 center-form">
                                    <td>
                                        <label for="content" class="form-label">內文:</label>
                                        <textarea class="form-control" id="content" name="content" rows="3"></textarea>
                                    </div>
                                    </td>
                                <div>
                                    <select class="form-select center-form" aria-label="Default select example" name="key_word_id" id="key_word_id">
                                        <option selected>關鍵字</option>
                                        <option value="2">新菜消息</option>
                                        <option value="3">節慶活動</option>
                                        <option value="4">公休時間</option>
                                        <option value="5">貓咪認養</option>
                                    </select>
                                </div>
                                <div class="mb-3 py-2 d-flex justify-content-between">
                                    <div class="mb-3 py-2 text-center">
                                        <button class="btn btn-secondary" type="button" onclick="photos1.click()">上傳圖片</button>
                                        <input type="hidden" name="photos" value="<?= empty($row['photos']) ? '[]' : htmlentities(json_encode($row['photos'])) ?>">
                                        <div class="row">
                                            <div class="d-flex" id="img_container">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="py-2 text-center">
                                        <button class="btn btn-secondary" type="submit">新增</button>
                                    </div>
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- 提示框 -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">資料新增結果</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-success" role="alert">
                    資料新增成功
                </div>
            </div>
            <div class="modal-footer">
                <a href="newarticle.php" class="btn btn-primary">完成</a>
            </div>
        </div>
    </div>
</div>
<!-- 上傳檔案表格 -->
<form name="upload_form1" hidden>
    <input type="file" name="photos[]" multiple accept="image/*" />
</form>
<?php include __DIR__ . '/parts/script.php' ?>
<script>
    const sendData = e => {
        e.preventDefault(); //定義表單送出動作


        const fd = new FormData(document.form1); //從表單資料送出一個新的表單

        fetch('addnew-api.php', {
                method: 'POST', //用post
                body: fd,
            })
            .then(r => r.json()) //資料是json格式
            .then(data => {
                console.log(data); //console log 出新增資料
                //驗證對錯並顯示提示框
                if (data.success) {
                    myModal.show();
                } else {
                    console.log(`資料新增失敗`);
                }
            }).catch(ex => {
                console.log(`fetch() 發生錯誤, 回傳的 JSON 格式是錯的`);
                console.log(ex);
            })
    }

    const myModal = new bootstrap.Modal('#exampleModal'); //使用bootstrap的提示框

    //刪除表單資料
    const deleteOne = sid => {
        if (confirm(`是否要刪除編號為 ${sid} 的資料?`)) {
            location.href = `delete.php?a_id=${sid}`;
        }
    };

    // 上傳圖片
    const photos1 = document.upload_form1.elements[0];

    const ImgTpl = (filename) => `
      <div class="card">
          <img class="card-img" src="./../uploads/${filename}" alt="">
        </div>
        `;


    photos1.addEventListener("change", (event) => {
        const fd = new FormData(document.upload_form1);
        fetch("upload-multiple.php", {
                method: "post",
                body: fd
            }).then((r) => r.json())
            .then((result) => {
                // if(result.files && result.files.length){
                if (result.files?.length) {
                    console.log(result.files);
                    let str = "";
                    for (let f of result.files) {
                        str += ImgTpl(f);
                    }
                    img_container.innerHTML = str;
                    // 資料輸入，注意name.value不要打錯
                    document.form1.photos.value = JSON.stringify(result.files)
                }
            });
    });

    const yearList = document.getElementById('yearList');
    const monthList = document.getElementById('monthList');
    const dayList = document.getElementById('dayList');

    // 動態生成年份
    for (let year = 2020; year <= 2030; year++) {
        const li = document.createElement('li');
        const a = document.createElement('a');
        a.classList.add('dropdown-item');
        a.href = '#';
        a.textContent = year;
        a.dataset.value = year; // 設置自定義數據屬性
        li.appendChild(a);
        yearList.appendChild(li);
    }

    // 動態生成月份
    for (let month = 1; month <= 12; month++) {
        const li = document.createElement('li');
        const a = document.createElement('a');
        a.classList.add('dropdown-item');
        a.href = '#';
        a.textContent = month;
        a.dataset.value = month;
        li.appendChild(a);
        monthList.appendChild(li);
    }

    // 動態生成日期（這裡需要進一步根據不同的年份和月份來計算日期）
    for (let day = 1; day <= 31; day++) {
        const li = document.createElement('li');
        const a = document.createElement('a');
        a.classList.add('dropdown-item');
        a.href = '#';
        a.textContent = day;
        a.dataset.value = day;
        li.appendChild(a);
        dayList.appendChild(li);
    }

    // 獲取按鈕和下拉選單中的元素
    const yearItems = document.querySelectorAll('#yearList .dropdown-item');
    const monthItems = document.querySelectorAll('#monthList .dropdown-item');
    const dayItems = document.querySelectorAll('#dayList .dropdown-item');

    document.querySelectorAll('#key_word_id a').forEach(item => {
        item.addEventListener('click', event => {
            const selectedValue = event.target.textContent; // 獲取點擊的選項文字內容
            document.getElementById('selectedValueButton').textContent = selectedValue; // 將選項文字內容設置為按鈕的內容
        });
    });

    yearItems.forEach(item => {
        item.addEventListener('click', () => {
            const selectedValue = item.textContent;
            document.getElementById('dropdownYear').textContent = selectedValue;
        });
    });

    // 監聽月份下拉選單項目的點擊事件
    monthItems.forEach(item => {
        item.addEventListener('click', () => {
            const selectedValue = item.textContent;
            document.getElementById('dropdownMonth').textContent = selectedValue;
        });
    });

    // 監聽日期下拉選單項目的點擊事件
    dayItems.forEach(item => {
        item.addEventListener('click', () => {
            const selectedValue = item.textContent;
            document.getElementById('dropdownDay').textContent = selectedValue;
        });
    });

    document.querySelectorAll('#key_word_id .dropdown-item').forEach(item => {
        item.addEventListener('click', () => {
            const selectedValue = item.textContent; // 獲取選項的文字
            const selectedDataValue = item.dataset.value; // 獲取選項的數字值
            document.getElementById('selectedValueButton').textContent = selectedValue; // 將選項文字設置為按鈕的內容
            document.getElementById('selectedValueButton').dataset.value = selectedDataValue; // 儲存選項的數字值到按鈕上
        });
    });

    document.getElementById('queryForm').addEventListener('submit', event => {
        event.preventDefault(); // 阻止表單提交
        const key_word_id = document.getElementById('selectedValueButton').dataset.value.trim(); // 獲取按鈕上的數字值
        let year = document.getElementById('dropdownYear').textContent.trim();
        let month = document.getElementById('dropdownMonth').textContent.trim();
        let day = document.getElementById('dropdownDay').textContent.trim();

        // 合併年月日為 YY-mm-dd 格式
        const date = `${year}-${month.padStart(2, '0')}-${day.padStart(2, '0')}`;

        // 如果關鍵字是「所有文章」，則清空日期
        if (key_word_id === '1') {
            year = '';
            month = '';
            day = '';
        }

        // 檢查年月日是否都不為空
        if (year !== '' && month !== '' && day !== '') {
            // 發送查詢
            fetch('query-newapi.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        key_word_id,
                        date
                    })
                })
                .then(response => response.json())
                .then(data => {
                    // 在這裡處理後端返回的數據
                    if (data.error) {
                        console.error('Error:', data.error);
                        // 可以在前端進行一些錯誤處理，例如顯示錯誤消息給用戶
                    } else {
                        // 更新前端的表格內容
                        updateTable(data);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    // 可以在前端進行一些錯誤處理，例如顯示錯誤消息給用戶
                });
        } else {
            // 只包含關鍵字的查詢
            fetch('query-newapi.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        key_word_id
                    })
                })
                .then(response => response.json())
                .then(data => {
                    // 在這裡處理後端返回的數據
                    if (data.error) {
                        console.error('Error:', data.error);
                        // 可以在前端進行一些錯誤處理，例如顯示錯誤消息給用戶
                    } else {
                        // 更新前端的表格內容
                        updateTable(data);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    // 可以在前端進行一些錯誤處理，例如顯示錯誤消息給用戶
                });
        }
    });


    // 更新表格內容的函數
    function updateTable(data) {
        const tableBody = document.querySelector('.table-data tbody');
        tableBody.innerHTML = ''; // 清空原有的表格內容
        data.forEach(row => {
            const tr = document.createElement('tr');
            tr.innerHTML = `
            <td>${row['a_id']}</td>
            <td>${row['date']}</td>
            <td>${row['title']}</td>
            <td>${row['content']}</td>
            <td>${row['photos']}</td>
            <td>${row['key_name']}</td>
            <td>
                <a href="edit-js.php?a_id=${row['a_id']}">
                    <i class="fa-solid fa-pen-to-square"></i>
                </a>
            </td>
            <td>
                <a href="javascript: deleteOne(${row['a_id']})">
                    <i class="fa-solid fa-trash"></i>
                </a>
            </td>
        `;
            tableBody.appendChild(tr);
        });
    }

    // 監聽所有文章選項的點擊事件
    document.querySelector('#key_word_id a[data-value="1"]').addEventListener('click', () => {
        // 清空日期選擇
        document.getElementById('dropdownYear').textContent = '年';
        document.getElementById('dropdownMonth').textContent = '月';
        document.getElementById('dropdownDay').textContent = '日';
    });
</script>
<?php include __DIR__ . '/parts/footer.php' ?>