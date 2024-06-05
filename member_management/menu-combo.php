<?php
if(! isset($_SESSION)) {
  # 如果沒有設定 $_SESSION, 才啟動
  session_start();
}
require __DIR__ . './config/pdo-connect.php';

$sql = "SELECT * FROM combo_meal"; //拿哪一個資料表要換

$stmt = $pdo->query($sql); # 執行 sql 取得代理物件

$rows = $stmt->fetchAll();  # 透過代理物件, 提取剩下的資料

//echo json_encode($rows);

?>
<?php include __DIR__ . './index-parts/index-html-head.php' ?>
<!-- 這裡可以新增你們的CSS 或者引入css  -->
<style>
  .returnMenu{
        color:rgba(20, 86, 55, 0.85);
        font-size: 1.2rem;
        font-weight: bolder;
        &:link{
          text-decoration: none;
        }
      }
  .transition {
    transition: .6s;
  }

  .menuCard {
    overflow: hidden;
    position: relative;
  }

  
  .imageSize {
    width: 100%;
    padding: 2rem;
    /* background-color: aquamarine; */

  }

  .imageSize:hover {
    filter: blur(3px);
  }

  .menuCard h4{
    opacity: 1;
    position: absolute;
    bottom: 0;
    margin: 0;
    padding-block: 10px; /* 同時設定垂直方向 */
    width: 100%;
    text-align: center;
    transform: translateY(50px);
    transition: transform .4s, opacity .4s;
    color: aliceblue;
    
  }

  .menuCard:hover h4{
    opacity: 1;
    transform: translateY(-30px);
    
  }
</style>
<?php include __DIR__ . './index-parts/index-navbar.php' ?>
<!-- ----此處引入頁面--- -->
<header class="masthead">
  <div class="container px-4 px-lg-5 h-100 mb-3">
    <div class="row gx-4 gx-lg-5 h-100 align-items-center justify-content-center text-center">
      <div class="col-lg-8 align-self-end">
        <h1 class="text-white font-weight-bold">合菜介紹</h1>
        <hr class="divider" />
      </div>
      <div class="col-lg-8 align-self-baseline">
        <p class="text-white-75 mb-5">以「家」為靈感，充滿家庭溫暖的美味佳餚，讓您感受到家的溫馨，享受賓至如歸的服務。</p>
      </div>
    </div>
  </div>
</header>
<!-- 內容 -->
<main>
<div
    class="container breadcrumb mt-3">
  <!-- <a href="./menu-index.php" class="returnMenu"><i class="fa-solid fa-house"></i>回到菜單導覽</a> -->
  <nav aria-label="breadcrumb ">
  <ol class="breadcrumb ">
    <li class="breadcrumb-item"><a href="./menu-index.php" class="returnMenu"><i class="fa-solid fa-house"></i>回到菜單導覽</a></li>
    <li class="breadcrumb-item"><a href="./menu-products.php" class="returnMenu">單點</a></li>
    <li class="breadcrumb-item"><a href="./menu-combo.php" class="returnMenu">合菜</a></li>
    <li class="breadcrumb-item"><a href="./menu-dessert.php" class="returnMenu">甜點</a></li>
    <li class="breadcrumb-item"><a href="./menu-drinks.php" class="returnMenu">飲品</a></li>
    <li class="breadcrumb-item"><a href="./menu-liquors.php" class="returnMenu">酒品</a></li>
    <li class="breadcrumb-item"><a href="./menu-bento.php" class="returnMenu">便當</a></li>
  </ol>
</nav>
  </div>
  <!-- 料理名 -->
  <div class="container  mt-5 mb-5">
    <div class="row  align-items-center text-center g-2">
      <?php foreach ($rows as $r) : ?>
        <div class="col-6 col-sm-4 col-lg-4 menuCard">
          <img class="imageSize transition" src="/Topics/menu/upload/<?= htmlspecialchars(json_decode($r['image'])) ?>">
          <h4 class=" transition menuWorld "><?= $r['name'] ?></h4>
        </div>
      <?php endforeach ?>


    </div>
  </div>
</main>
<?php include __DIR__ . './index-parts/index-scripts.php' ?>
<script src="     "></script>   <!-- 這裡可以放JS-->


<!-- 下面DIV勿刪除 -->
<div id="backToTop" class="back-to-top">
        <i class="fas fa-arrow-up"></i>
    </div>
    <?php include __DIR__ . './index-parts/index-html-foot.php' ?>