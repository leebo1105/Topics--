<?php
if (!isset($_SESSION)) {
  # 如果沒有設定 $_SESSION, 才啟動
  session_start();
}
?>
<?php include __DIR__ . './index-parts/index-html-head.php' ?>

<style>
  /* 重置樣式 */
  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
  }

  body {
    font-family: Arial, sans-serif;
    /* margin: 0; */
    /* padding: 0; */
    /* display: flex; */
    /* flex-direction: column; */
    /* min-height: 100vh; */
  }

  main {
    margin-top: 10%;
    padding: 15px 5%;
  }

  /* 輪播圖樣式 */
  .carousel {
    width: 85%;
    height: 35%;
    overflow: hidden;
    border-radius: 10px;
    margin: auto;
  }

  /* .carousel-item {
    flex: 1 0 33.33%;
    height: 100%;

    & img {
      width: 100%;
      height: 100%;
      object-fit: fill;
    }
  } */

  /* 其他內容樣式 */
  .content {
    padding: 40px;
  }

  .content p {
    font-family: "Zhi Mang Xing", cursive;
    font-weight: 400;
    font-style: normal;
    font-size: 32px;
    line-height: 1.5;
  }

  .contourline {
    width: 20%;
    height: 20%;
    position: absolute;
    top: 100px;
    right: 100px;
    z-index: -5;
  }

  .contourline img {
    width: 400px;
    height: 450px;
    object-fit: cover;
  }

  .Ordering {
    /* width: 80%; */
    height: 250px;
    border-radius: 10px;
    background-color: rgba(91, 142, 125, 1);
    margin: auto;
    position: relative;
  }

  .onsite {
    background-color: rgba(231, 175, 47, 1);
    width: 60%;
    height: 50px;
    border-radius: 10px;
    position: absolute;
    left: 20%;
    bottom: 60%;
    text-decoration: none;
  }

  .advance {
    background-color: rgba(252, 250, 249, 1);
    width: 60%;
    height: 50px;
    border-radius: 10px;
    position: absolute;
    left: 20%;
    bottom: 30%;
    text-decoration: none;
  }

  a:hover,
  a:visited,
  a:link,
  a:active {
    text-decoration: none;
  }

  .content p {
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5); /* 設置文字陰影 */
      padding: 20px; /* 為段落添加一些內邊距 */
      background-color: #fff; /* 設置背景顏色 */
      display: inline-block; /* 使段落寬度適應內容 */
    }
    .carousel-item img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}
.contourline {
  margin-top: 15%; /* 或者您可以使用其他適當的值來調整下降的程度 */
}
</style>
</head>

<body>
  <?php include __DIR__ . './index-parts/index-navbar.php' ?>

  <main>
    <!-- 輪播圖 -->
    <div class="container ">
      <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
  <div class="carousel-item active">
    <img src="./mudanlow-小圖檔/DSC00626.jpg" class="d-block w-100 h-100 " style="max-height: 400px;" alt="...">
  </div>
  <div class="carousel-item">
    <img src="./mudanlow-小圖檔/DSC00604.jpg" class="d-block w-100 h-100" style="max-height: 400px;" alt="...">
  </div>
  <div class="carousel-item">
    <img src="./mudanlow-小圖檔/DSC00598.jpg" class="d-block w-100 h-100" style="max-height: 400px;" alt="...">
  </div>
</div>


        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    </div>
    <!-- 其他內容 -->
    <section class="container p-5">
          <img src="./img/Hello.png" alt="">
    </section>
    <div class="contourline">
    <img src="./img/等高線組合2.png" class="" alt="等高線圖">
    </div>
    <div class="container">
      <div class="Ordering ">
        <button class="onsite"><i class="bi bi-cart-plus-fill"></i><a href="預約查詢前台.php" class="link-dark">查詢我的預約</a></button>
        <button class="advance"><i class="bi bi-calendar2-date-fill"></i><a href="reserve.php" class="link-dark">提前預約</a></button>
      </div>
    </div>
  </main>

  <?php include __DIR__ . './index-parts/index-scripts.php' ?>
  <?php include __DIR__ . './index-parts/index-html-foot.php' ?>