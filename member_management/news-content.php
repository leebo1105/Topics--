<?php
if (!isset($_SESSION)) {
  # 如果沒有設定 $_SESSION, 才啟動
  session_start();
}

require __DIR__ . '/config/pdo-connect.php';

$sql = "SELECT * FROM articles";
$row = $pdo->query($sql)->fetch();

if (isset($_GET['a_id'])) {
  $id = $_GET['a_id'];

  $stmt = $pdo->prepare("SELECT * FROM articles WHERE a_id = ?");
  $stmt->execute([$id]);

  if ($stmt->rowCount() > 0) {
    $articles = $stmt->fetch(PDO::FETCH_ASSOC);
  } else {
    echo "未找到新聞。";
    exit;
  }
} else {
  echo "未找到ID。";
  exit;
}

// 嘗試查找比當前 ID 小的最大 ID，即上一篇文章的 ID
$stmt = $pdo->prepare("SELECT MAX(a_id) AS previous_id FROM articles WHERE a_id < ?");
$stmt->execute([$id]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$previousId = $row['previous_id'];

// 嘗試查找比當前 ID 大的最小 ID，即下一篇文章的 ID
$stmt = $pdo->prepare("SELECT MIN(a_id) AS next_id FROM articles WHERE a_id > ?");
$stmt->execute([$id]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$nextId = $row['next_id'];

// 如果當前文章是第一篇文章，循環至最後一篇文章
if (!$previousId) {
  $stmt = $pdo->query("SELECT MAX(a_id) AS previous_id FROM articles");
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  $previousId = $row['previous_id'];
}

// 如果當前文章是最後一篇文章，循環至第一篇文章
if (!$nextId) {
  $stmt = $pdo->query("SELECT MIN(a_id) AS next_id FROM articles");
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  $nextId = $row['next_id'];
}



// 基本圖片儲存路徑（相對於網站的根目錄）
$imageBaseUrl = '/Topics/articles_management/uploads/';

// 將包含文件名的數組轉換成為字串
$photosArray = json_decode($articles['photos'], true); // 將字串轉換成數組
$photoFilename = $photosArray[0];


$imageUrl = $imageBaseUrl . $photoFilename;
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
  .keyword {
    margin-top: 5rem;
  }

  /* 內文css */
  .content {
    width: 1200px;
    height: 100vh;
    border: 1px solid #366e53;
    margin-bottom: 50px;
    margin-top: 50px;
    background-color: #366e53;
    border-radius: 20px;
  }

  .date {
    position: absolute;
    top: -35px;
    color: #999;
  }

  .article-title {
    position: absolute;
    top: 25px;
    left: 60px;
    flex-wrap: nowrap;
  }

  .news-photo {
    width: 720px;
    height: 405px;
    position: absolute;
    top: 30%;
    left: 50%;
    transform: translate(-50%, -50%);
  }

  .news-content {
    width: 90%;
    height: 300px;
    max-width: 800px;
    border-radius: 10px;
    position: absolute;
    top: 70%;
    left: 50%;
    transform: translate(-50%, -50%);
    font-size: 20px;
    padding: 10px;
    background-color: #fff;
    outline: 5px dashed black;
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
  }

  .page-btn {
    background: #999;
    color: #fff;
    height: 50px;
    width: 120px;
    border-radius: 20px;
    margin-bottom: 50px;
    border: 1px solid #666;
    font-size: 20px;
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
    opacity: 0.8;
  }

  .content-img {
    height: 300px;
    object-fit: contain;
  }


  /* 调整内容布局和样式 */
  @media (max-width: 800px) {
    .news-content {
      width: 90%;
      /* 改变内容宽度 */
      font-size: 16px;
      /* 调整字体大小 */
    }

    .article-title {
      top: 10px;
      /* 调整标题位置 */
      left: 10px;
    }

    .news-photo {
      width: 90%;
    }
  }

  @media (max-width: 540px) {
    .news-photo {
      width: 100%;
      /* 适应屏幕宽度 */
    }

    .news-content {
      width: 90%;
      /* 改变内容宽度 */
      font-size: 14px;
      /* 调整字体大小 */
    }

    .article-title {
      top: 10px;
      /* 调整标题位置 */
      left: 10px;
    }
  }

</style>

<!-- 關鍵字大標&回上頁按鈕 -->
<div class="container-fluid">
  <div class="position-relative">
    <button class="btn btn-success back-btn">
      <a href="./news-list.php">回上頁</a>
    </button>
    <div class="container-fluid d-flex justify-content-center">
      <div class="w-50 border-bottom border-dark keyword">
        <div class="row justify-content-center text-center">
          <div class="news-title">
            <h1>最新消息</h1>
          </div>
        </div>
        <div class="row justify-content-center text-center">
          <h4>The New's</h4>
        </div>
      </div>
    </div>
  </div>
</div>



<!-- 內文 -->
<div class="container-fluid d-flex justify-content-center align-items-center">
  <div class="container-fluid content position-relative">
    <div class="date">
      <h4><?= $articles['date'] ?></h4>
    </div>
    <div class="article-title">
      <h3 class="fw-bolder"><?= $articles['title'] ?></h3>
    </div>
    <div class="container text-center news-photo d-flex justify-content-center">
      <?php foreach ($photosArray as $photoFilename) : ?>
        <img class="img-fluid rounded content-img mr-2 mb-2" src="<?= htmlspecialchars($imageBaseUrl . $photoFilename) ?>" alt="">
      <?php endforeach; ?>
    </div>
    <div class="news-content"><?= $articles['content'] ?></div>
  </div>
</div>
<!-- 頁碼 -->
<div class="container-fluid d-flex justify-content-evenly">
  <button class="page-btn btn btn-success" onclick="location.href='news-content.php?a_id=<?= $previousId ?>'">上一頁</button>
  <button class="page-btn btn btn-success" onclick="location.href='news-content.php?a_id=<?= $nextId ?>'">下一頁</button>
</div>
<!-- 回頂部按鈕 -->
<div>
  <button id="scrollToTopBtn" onclick="scrollToTop()">回到頂部</button>
</div>
<!-- Footer-->
<?php include __DIR__ . '/index-parts/index-scripts.php' ?>
<script>
  const preBtn = document.querySelector("#preBtn")
  const nextBtn = document.querySelector("#nextBtn")
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
</script>
<?php include __DIR__ . '/index-parts/index-html-foot.php' ?>