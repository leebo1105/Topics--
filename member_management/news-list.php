<?php
if (!isset($_SESSION)) {
  # 如果沒有設定 $_SESSION, 才啟動
  session_start();
}

require __DIR__ . '/config/pdo-connect.php';

$sql = "SELECT * FROM articles ORDER BY date DESC";
$row = $pdo->query($sql)->fetchAll();

?>
<?php include __DIR__ . '/index-parts/index-html-head.php' ?>
<?php include __DIR__ . '/index-parts/index-navbar.php' ?>

<style>
  .SlideMediaBox {
    background-color: cornflowerblue;
    text-align: center;
  }

  /* 回上頁按鈕css */
  .back-btn {
    top: 100px;
    left: 100px;
    position: relative;
  }

  /* 關鍵字大標 */
  .hashtag {
    margin-top: 30px;
  }

  /* 內文css */
  .content {
    width: 700px;
    height: 150px;
    border-bottom: 1px solid black;
    margin-bottom: 20px;
    margin-top: 20px;
    padding-left: 5px;
    border-radius: 10px 10px 0 0;
    transition: transform 0.3s ease;
  }

  .content:hover {
    box-shadow: 0 0 11px rgba(33, 33, 33, .3);
    transform: scale(1.05);
  }


  /* 網頁縮放 */
  @media (max-width: 800px) {
    .content {
      width: 450px;
    }

    .back-btn {
      top: 100px;
      left: 20px;
    }
  }

  /* 超連結 */
  a {
    color: inherit;
    text-decoration: inherit;
    cursor: inherit;
    cursor: pointer;
    /* 頁碼css */
  }

  .pagination {
    display: flex;
    justify-content: center;
    list-style-type: none;
    padding: 0;
  }

  .pagination li {
    margin: 0 5px;
  }

  .pagination li a {
    display: block;
    padding: 5px 10px;
    text-decoration: none;
    border: 1px solid #ccc;
    border-radius: 3px;
    color: black;
    background-color: #fff;
  }

  .page-link:hover {
    background-color: #336e53;
    color: #fff;
  }


  .page-item.active .page-link {
    background-color: #458068;
    border-color: #458068;
    color: #fff;
    /* 將文本顏色設置為白色 */
  }

  .page-link {
    color: #458068;
  }

  /* 回頂部按鈕 */
  #scrollToTopBtn {
    display: none;
    /* 預設隱藏按鈕 */
    position: fixed;
    /* 固定在畫面右下角 */
    bottom: 20px;
    right: 20px;
    background-color: #fefef6;
    color: #366e53;
    border: none;
    border-radius: 5px;
    padding: 10px 20px;
    font-size: 16px;
    cursor: pointer;
    opacity: 0.5;
  }

  .keyword {
    cursor: pointer;
    text-shadow: 1px 1px gray;
    font-weight: 900;
  }

  .keyword-title {
    margin-top: 80px;
  }

  .fade-in {
    opacity: 0;
    transform: translateX(-40px);
    transition: opacity 0.6s ease-out, transform 0.6s ease-out;
  }

  .fade-in.show {
    opacity: 1;
    transform: translateX(0);
  }

  @media (max-width: 540px) {
    .content {
      width: 100%;
      font-size: 16px;
      text-wrap: nowrap;
    }

    .hashtag {
      flex-direction: column;
      margin: 0;
    }

    .hashtag .keyword {
      width: auto;
      /* 自动适应宽度 */
      flex: 1;
      /* 均分剩余空间 */
    }
  }

  @media (min-width: 541px) and (max-width: 720px) {
    .content {
      width: 500px;
      font-size: 18px;
    }
  }

  @media (min-width: 721px) and (max-width: 960px) {
    .content {
      width: 700px;
      font-size: 18px;
    }

  }

  @media (min-width: 961px) and (max-width: 1140px) {
    .content {
      width: 700px;
      font-size: 18px;
    }
  }
</style>

<!-- 關鍵字大標&回上頁按鈕 -->
<div class="container-fluid">
  <div class="position-relative">
    <button class="btn btn-success back-btn">
      <a href="./index-list.php">回上頁</a>
    </button>
    <div>
      <div class="row justify-content-center text-center keyword-title">
        <div class="col-4">
          <h1>關鍵字</h1>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- 關鍵字 -->
<div class="container-fluid">
  <div class="d-flex flex-wrap justify-content-center text-center hashtag text-nowrap ">
    <div class="col-lg-2 col-3 fs-4 keyword" data-value="1">#所有文件</a></div>
    <div class="col-lg-2 col-3 fs-4 keyword" data-value="2">#新菜消息</a></div>
    <div class="col-lg-2 col-3 fs-4 keyword" data-value="3">#節慶活動</a></div>
  </div>
  <div class="d-flex justify-content-center text-center hashtag text-nowrap ">
    <div class="col-lg-2 col-3 fs-4 keyword" data-value="4">#公休時間</a></div>
    <div class="col-lg-2 col-3 fs-4 keyword" data-value="5">#貓咪認養</a></div>
  </div>
</div>
<!-- 內文 -->
<div class="container-fluid d-flex justify-content-center align-items-center">
  <ul class="list-unstyled" id="news-list">
    <?php
    $maxItems = 7; // 每頁顯示的最大項目數量
    $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1; // 當前頁面
    $totalItems = count($row); // 總條目數
    $totalPages = ceil($totalItems / $maxItems); // 總頁數
    $startIndex = ($currentPage - 1) * $maxItems; // 當前頁面顯示的第一個項目的索引

    // 顯示當前頁面項目
    for ($i = $startIndex; $i < $startIndex + $maxItems && $i < $totalItems; $i++) :
      $r = $row[$i];
    ?>
      <li>
        <div class="content fade-in">
          <div class="w-25 my-2 text-secondary"><?= $r['date'] ?></div>
          <div class="w-50 fw-bolder my-2"><?= $r['title'] ?></div>
          <div class="d-flex justify-content-between position-relative">
            <div class="inside-content w-75 py-4">
              <?= strlen($r['content']) > 50 ? substr($r['content'], 0, 50) . '...' : $r['content'] ?>
            </div>
            <div class="position-absolute end-0 bottom-0">
              <a href="./news-content.php?a_id=<?= $r['a_id'] ?>" class=""><i class="fa-solid fa-angles-right"></i></a>
            </div>
          </div>
        </div>
      </li>
    <?php endfor; ?>
  </ul>
</div>
<!-- 頁碼 -->
<nav aria-label="Page navigation">
  <ul class="pagination" id="pagination">
    <?php for ($page = 1; $page <= $totalPages; $page++) : ?>
      <li class="page-item <?= ($page == $currentPage) ? 'active' : '' ?>"><a class="page-link" href="?page=<?= $page ?>"><?= $page ?></a></li>
    <?php endfor; ?>
  </ul>
</nav>
<!-- 回頂部按鈕 -->
<div>
  <button id="scrollToTopBtn" onclick="scrollToTop()">回到頂部</button>
</div>
<?php include __DIR__ . '/index-parts/index-scripts.php' ?>
<script>
  // 回頂部script
  window.onscroll = function() {
    scrollFunction();
  };

  function scrollFunction() {
    var scrollToTopBtn = document.getElementById("scrollToTopBtn");
    if (
      document.body.scrollTop > 20 ||
      document.documentElement.scrollTop > 20
    ) {
      scrollToTopBtn.style.display = "block";
    } else {
      scrollToTopBtn.style.display = "none";
    }
  }

  // 滾動到頂部函數
  function scrollToTop() {
    document.body.scrollTop = 0; // For Safari
    document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
  }

  var totalPages;

  document.addEventListener("DOMContentLoaded", () => {
    const contents = document.querySelectorAll('.content');

    contents.forEach((content, index) => {
      setTimeout(() => {
        content.classList.add('show');
      }, index * 300); // 每個元素延遲 300ms
    });
  });


  document.querySelectorAll('.keyword').forEach(function(keywordElement) {
    keywordElement.addEventListener('click', function() {
      var keywordValue = this.getAttribute('data-value');

      fetch('keyword-api.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify({
            key_word_id: keywordValue
          }),
        })
        .then(response => {
          if (!response.ok) {
            throw new Error('網絡錯誤，狀態碼: ' + response.status);
          }
          return response.json();
        })
        .then(data => {
          var newsList = document.getElementById('news-list');
          newsList.innerHTML = '';

          var maxItems = 7;
          var startIndex = 0;

          for (var i = startIndex; i < startIndex + maxItems && i < data.length; i++) {
            var item = data[i];
            var listItem = document.createElement('li');
            listItem.innerHTML = `
              <div class="content">
                <div class="w-25 my-2">${item.date}</div>
                <div class="w-50 fw-bolder my-2">${item.title}</div>
                <div class="d-flex justify-content-between position-relative">
                  <div class="inside-content w-75 py-4">
                    ${item.content.length > 30 ? item.content.substring(0, 30) + '...' : item.content}
                  </div>
                  <div class="position-absolute end-0 bottom-0">
                    <a href="./news-content.php?a_id=${item.a_id}"><i class="fa-solid fa-angles-right"></i></a>
                  </div>
                </div>
              </div>
            `;
            newsList.appendChild(listItem);
          }

          var currentPage = <?php echo $currentPage; ?>;
          var totalPages = <?php echo $totalPages; ?>;

          // 重新生成頁碼
          var pagination = document.getElementById('pagination');
          pagination.innerHTML = '';

          // 更新 currentPage 和 totalPages
          var currentPage = 1;
          var totalPages = Math.ceil(data.length / maxItems);

          // 生成頁碼
          for (var page = 1; page <= totalPages; page++) {
            var li = document.createElement('li');
            li.className = 'page-item' + (page === currentPage ? ' active' : ''); // 添加 active 樣式
            var a = document.createElement('a');
            a.className = 'page-link';
            a.href = '?page=' + page;
            a.textContent = page;
            li.appendChild(a);
            pagination.appendChild(li);
          }
        })
        .catch(error => {
          console.error('發生錯誤:', error);
        });
    });
  });
</script>
<?php include __DIR__ . '/index-parts/index-html-foot.php' ?>