<?php
if (!isset($_SESSION)) {
    # 如果沒有設定 $_SESSION, 才啟動
    session_start();
}
?>
<?php include __DIR__ . './index-parts/index-html-head.php' ?>
<?php include __DIR__ . './index-parts/index-navbar.php' ?>
<style>
      /* 重置樣式 */
      * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
      }

      body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        display: flex;
        flex-direction: column;
        /* min-height: 100vh; */
      }

    
    .inquireDiv {
        height: 100svh;
        justify-content:center;
        margin: auto;
    }
    
    .white-square3 {
        height: 350px;
        border: 2px solid gray;
        border-radius: 10px;
        text-wrap:nowrap;
    }
    .overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    backdrop-filter: blur(10px);
    /* 毛玻璃效果 */
    z-index: 999;
    /* 確保覆蓋在白色方塊之上 */
    display: none;
    /* 默認隱藏 */
  }

  /* whiteSquare 白色正方形區塊 */
  .white-square {
    position: fixed;
    top: 50%;
    /* 垂直居中 */
    left: 50%;
    /* 水平居中 */
    width: 400px;
    height: 350px;
    border:3px solid gray;
    border-radius : 10px;
    background-color:#F2EA9D;
    /* 白色背景 */
    z-index: 1000;
    /* 確保覆蓋在 overlay 之上 */
    transform: translate(-50%, -50%);
    /* 將中心點設置為正方形中心 */
    display: none;
    /* 默認隱藏 */
    & .returnButton:hover {
      text-decoration: underline;
    }
  }
</style>
<body>
    <div class="wrapper">
        <div class="inquireDiv mb-3 mt-5 px-5 row">
            <?php include __DIR__ . '/查詢預約api.php' ?>
        </div>
    </div>

<?php include __DIR__ . './index-parts/index-scripts.php' ?>
<?php include __DIR__ . './index-parts/index-html-foot.php' ?>