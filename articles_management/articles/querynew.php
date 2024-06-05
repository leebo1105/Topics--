<?php
require __DIR__ . '/config/pdo-connect.php';

// 資料輸入
$sql = "SELECT * FROM articles JOIN key_words ON key_word_id = key_words.k_id";
$row = $pdo->query($sql)->fetchAll();

//echo json_encode($row);

?>

<?php include __DIR__ . '/parts/head.php' ?>
<?php include __DIR__ . '/parts/navbar.php' ?>
<!-- 主要內容區域 -->
<div class="content">
    <h3>文章管理</h3>
    <div>
        <h5>文章列表:</h5>
    </div>
    <div class="member-field overflow-scroll ">
        <!-- 下拉式選單 -->
        <div class="dropdown d-flex my-2">
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


            <!-- 頁碼 -->
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
                        <td><?= $r['photos'] ?></td>
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
</div>
<?php include __DIR__ . '/parts/script.php' ?>
<script>
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
                            ?></td>
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