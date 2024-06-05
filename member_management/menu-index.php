<?php
if(! isset($_SESSION)) {
  # 如果沒有設定 $_SESSION, 才啟動
  session_start();
}
?>
<?php include __DIR__ . './index-parts/index-html-head.php' ?>
<!-- 這裡可以新增你們的CSS 或者引入css  -->
<!-- 我自己引入*1 -->

<link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"
    />
    <style>
      .returnMenu{
        color:rgba(20, 86, 55, 0.85);
        font-size: 1.2rem;
        font-weight: bolder;
        &:link{
          text-decoration: none;
        }
      }
             .swiper {
        position: relative;
        width: 100%;
        padding-top: 50px;
        padding-bottom: 50px;
        
        text-align: center;
      }

      .swiper-slide {
        &:link {
          text-decoration: none;
          color: rgba(20, 86, 55, 0.85);
        }
        &:visited {
          color: rgba(20, 86, 55, 0.85);
        }
        &:hover {
          color: rgba(160, 213, 174, 1);
          border:  3px solid rgb(169, 168, 168);
        }
        &:active {
          color: rgba(20, 86, 55, 0.85);
        }
        background-position: center;
        background-size: cover;
        width: 300px;
        height: 300px;
        font-size: 20px;
        font-weight: bolder;
      }

      .swiper-slide img {
        display: block;
        width: 100%;
      }
      .menuCardFont{
        font-size: 24px;
        font-weight: bolder;
        margin-top: 20px;
      }

        </style>

<?php include __DIR__ . './index-parts/index-navbar.php' ?>
<!-- ----此處引入頁面--- -->
<header class="masthead">
  <div class="container px-4 px-lg-5 h-100 ">
    <div class="row gx-4 gx-lg-5 h-100 align-items-center justify-content-center text-center">
      <div class="col-lg-8 align-self-end ">
        <h1 class="text-white font-weight-bold ">菜單導覽</h1>
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
    class="container mt-3">
  <a href="./menu-index.php" class="returnMenu"><i class="fa-solid fa-house"></i>菜單導覽</a>
  </div>
  

<!-- 效果cdn -->
<div class="swiper mySwiper">
        <div class="swiper-wrapper">
          <a href="menu-products.php" class="swiper-slide">
            <img src="./image/meunCard/meunCard-one.jpg" />
            <div class="menuCardFont">單點系列</div>
          </a>
          <a href="./menu-combo.php" class="swiper-slide">
            <img src="./image/meunCard/meunCard-combo.jpeg" />
            <div class="menuCardFont">合菜系列</div>
          </a>
          <a href="./menu-dessert.php" class="swiper-slide">
            <img src="./image/meunCard/menuCard-cake.jpg" />
            <div class="menuCardFont">甜點系列</div>
          </a>
          <a href="./menu-drinks.php" class="swiper-slide">
            <img src="./image/meunCard/meunCard-drinks.jpg" />
            <div class="menuCardFont">飲品系列</div>
          </a>
          <a href="./menu-liquors.php" class="swiper-slide">
            <img src="./image/meunCard/meunCard-18+.jpg" />
            <div class="menuCardFont">酒品系列</div>
          </a>
          <a href="./menu-bento.php" class="swiper-slide">
            <img src="./image/meunCard/meunCard-bento.jpg" />
            <div class="menuCardFont" >便當系列</div>
          </a>
        </div>
        <div class="swiper-pagination">
        </div>
      </div>  
 <!-- 這裡可以放JS-->
<!-- 效果cdn -->
<?php include __DIR__ . './index-parts/index-scripts.php' ?>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
        <script>
            var swiper = new Swiper(".mySwiper", {
              //對應最外層的class
              effect: "coverflow",
              grabCursor: true,
              centeredSlides: true,
              slidesPerView: "auto",
              coverflowEffect: {
                rotate: 50,
                stretch: 0,
                depth: 100,
                modifier: 1,
                slideShadows: true,
              },
              pagination: {
                el: ".swiper-pagination",
              },
            });
          </script>



<!-- 下面DIV勿刪除 -->
<div id="backToTop" class="back-to-top">
        <i class="fas fa-arrow-up"></i>
    </div>
    <?php include __DIR__ . './index-parts/index-html-foot.php' ?>