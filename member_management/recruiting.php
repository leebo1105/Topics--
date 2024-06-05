<?php include __DIR__ . '/index-parts/index-html-head.php' ?>
<?php include __DIR__ . '/index-parts/index-navbar.php' ?>

<style>
  .container-fluid {
    margin: 0;
    padding: 0;
    position: relative;
  }

  .picture {
    margin-top: 72px;
    height: 40rem;
    background-image: url(./mudanlow-小圖檔/DSC00567.jpg);
    background-position: 0px -380px;
    z-index: 1;
  }

  .overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    /* 使用 RGBA 設置遮罩顏色和透明度 */
    pointer-events: none;
    /* 讓遮罩不影響鼠標事件 */
    z-index: 2;
  }

  @media (min-width: 1200px) {
    .height {
      height: 25rem;
    }
  }

  .card {
    background-color: #336e56;
    border-radius: 10px;
    width: 400px;
    box-shadow: 10px 10px 10px black;
    z-index: 3;
  }

  .boxsize {
    width: 15rem;
    border: 5px solid goldenrod;
    border-radius: 10px;
  }

  .boxsiz2 {
    width: 25rem;
  }

  .button {
    width: 200px;
    border: 2px;
    text-decoration-line: none;
  }

  .hire {
    display: block;
    text-align: center;
    background-color: goldenrod;
    color: #fff;
  }

  .hire:hover {
    color: #2a483a;
  }
</style>

<main>
  <div class="container-fluid ">
    <div class="picture d-flex justify-content-center align-items-center">
      <div class="row justify-content-center align-items-center g-2 card">
        <div class="col">
          <h2 class="boxsize text-center m-auto mt-5 mb-5 text-light  p-3">
            人 &nbsp;才 &nbsp; 招 &nbsp; 募
          </h2>
        </div>
        <div class="boxsize2 fs-5 text-center text-light ">
          牡丹亭招募對於餐飲業有熱情的夥伴們<br />
          不分年齡一起加入這個大家庭!<br />
          共同創造歡樂用餐環境<br />
          快上104人力銀行投下您的履歷!
        </div>
        <a class="button fw-bolder fs-4 p-3 mt-5 mb-5 hire" href="https://www.104.com.tw/company/1a2x6bmrma?jobsource=analysis_jobsame_b">立即應徵</a>
      </div>
    </div>
    <div class="overlay"></div>
  </div>
</main>
<?php include __DIR__ . '/index-parts/index-scripts.php' ?>
<!-- 頁尾-->
<?php include __DIR__ . '/index-parts/index-html-foot.php' ?>