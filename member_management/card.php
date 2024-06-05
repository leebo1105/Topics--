<a?php
if(! isset($_SESSION)) {
  # 如果沒有設定 $_SESSION, 才啟動
  session_start();
}
?>
<?php include __DIR__ . './index-parts/index-html-head.php' ?>
<link rel="stylesheet" href="./css/card.css">
<style>
  header.masthea1 {
    position: relative;
    padding-top: 10rem;
    padding-bottom: calc(10rem - 4.5rem);
    background: url("./image/bg1.jpeg");
    background-position: center;
    background-repeat: no-repeat;
    background-attachment: scroll;
    background-size: cover;
    overflow: hidden; /* 隐藏超出范围的元素 */
  }
  .product {
    transition: all 0.5s ease; /* 添加过渡效果 */
  }
  .product:hover {
  background-color: #f0f0f0; /* 鼠标悬停时的背景颜色 */
  transform: scale(1.05); /* 鼠标悬停时的放大效果 */
}



</style>
<?php include __DIR__ . './index-parts/index-navbar.php' ?>
<header class="masthea1">
    <div class="container">
        <div class="row align-items-center justify-content-center text-center">
            <div class="col-lg-8 align-self-end">
                <h1 class="text-white font-weight-bold">牡丹樓</h1>
                <hr class="divider" />
            </div>
            <div class="col-lg-8 align-self-baseline">
                <p class="text-white-75 mb-5">以「家」為靈感，充滿家庭溫暖的美味佳餚，讓您感受到家的溫馨，享受賓至如歸的服務。</p>
            </div>
        </div>
    </div>
</header>

<div class="container">
  <div class="row product-list">
    <div class="col">
      <ul>
        <li><a href="#" onclick="filterProducts('all')">全部</a></li>
        <li><a href="#" onclick="filterProducts('meat')">葷類</a></li>
        <li><a href="#" onclick="filterProducts('seafood')">海鮮</a></li>
        <li><a href="#" onclick="filterProducts('vegetable')">蔬菜</a></li>
        <li><a href="#" onclick="filterProducts('sweet')">甜品</a></li>
      </ul>
    </div>
  </div>
</div>


<div class="col-md-3 col-sm-12   text-center">
  <h2>產品介紹</h2>
</div>
<hr>
<div class="container">
  <div class="row roww">
    <div class="col-md-3 col-sm-12 p-2 product" data-category="seafood">
    <a href="card-product1.php" class="link-dark text-muted">
      <div class="card img1">
        <div class="card-info">
          <h1>蝦菇奶油醬</h1>
        </div>
      </div>
      </a>
    </div>
    <div class="col-md-3 col-sm-12 p-2 product" data-category="seafood">
    <a href="card-product2.php" class="link-dark text-muted">
      <div class="card img2">
        <div class="card-info">
          <h1>波士頓龍蝦</h1>
        </div>
      </div>
      </a>
    </div>
    <div class="col-md-3 col-sm-12 p-2 product" data-category="seafood">
    <a href="card-product3.php" class="link-dark text-muted">
      <div class="card img3">
        <div class="card-info">
          <h1>蛤蜊燉湯</h1>
        </div>
      </div>
      </a>
    </div>
    <div class="col-md-3 col-sm-12 p-2 product" data-category="sweet">
    <a href="card-product4.php" class="link-dark text-muted">
      <div class="card img4">
        <div class="card-info">
          <h1>熱豆花</h1>
        </div>
      </div>
      </a>
    </div>
  </div>
</div>

<?php include __DIR__ . './index-parts/index-scripts.php' ?>
<script src="./js/card.js"></script>
<script>  
// function filterProducts(category) {
//     var products = document.getElementsByClassName('product'); // Assuming each product has a class 'product'
    
//     // 遍歷所有產品，根據分類來顯示或隱藏
//     for (var i = 0; i < products.length; i++) {
//       var product = products[i];
//       var productCategory = product.getAttribute('data-category'); // Assuming each product has a 'data-category' attribute
      
//       // 如果產品屬於點擊的分類，則顯示；否則隱藏
//       if (category === 'all' || productCategory === category) {
//         product.style.display = 'block';
//       } else {
//         product.style.display = 'none';
//       }
//     }} 

    

function filterProducts(category) {
    var products = document.getElementsByClassName('product'); // Assuming each product has a class 'product'
    var productList = document.querySelector('.roww'); // Assuming products are contained within a row element

    // 遍历所有产品，根据分类来显示或隐藏，并重置产品顺序
    for (var i = 0; i < products.length; i++) {
        var product = products[i];
        var productCategory = product.getAttribute('data-category'); // Assuming each product has a 'data-category' attribute

        if (category === 'all' || productCategory === category) {
            product.style.opacity = 1; /* 将透明度设置为 1，显示产品 */
            productList.prepend(product); // 将产品移到第一个位置
        } else {
            product.style.opacity = 0; /* 将透明度设置为 0，隐藏产品 */
        }
    }

    // 添加或移除 .collapsed 类
    var productListContainer = document.querySelector('.product-list');
    productListContainer.classList.toggle('collapsed', category !== 'all');
}

    </script>
<!-- 下面DIV勿刪除 -->
<div id="backToTop" class="back-to-top">
        <i class="fas fa-arrow-up"></i>
    </div>
<?php include __DIR__ . './index-parts/index-html-foot.php' ?>
