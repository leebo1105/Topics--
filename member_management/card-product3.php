<?php
session_start();
if (isset($_SESSION['admin']['id'])) {
    $memberId = $_SESSION['admin']['id'];
}
?>
<?php include __DIR__ . './card-parts/card-head.php'; ?>
<link rel="stylesheet" href="./css/card-product.css">
<style>
  .product-details {
    border-collapse: collapse;
    width: 100%;
  }

  .product-details td, .product-details th {
    border: 1px solid black;
    padding: 8px;
    text-align: left;
  }

  .product-details th {
    background-color: #f2f2f2;
  }
</style>
<?php include __DIR__ . './index-parts/index-navbar.php'; ?>

<div class="container p-4">
  <div class="row product-list">
    <ul>
      <li><a href="card-product1.php">蝦菇奶油醬</a></li>
      <li><a href="card-product2.php">波士頓龍蝦</a></li>
      <li><a href="card-product3.php">蛤蜊燉湯</a></li>
      <li><a href="card-product4.php">熱豆花</a></li>
    </ul>
  </div>
</div>

<input type="hidden" id="userId" value="<?= $memberId ?>">
<input type="hidden" id="orderInfo" value="YOUR_ORDER_INFO_JSON_STRING">

<div class="container p-4">
  <div class="row">
    <!-- 在大屏幕上，图像在左侧，文字在右侧 -->
    <div class="col-lg-6">
      <div class="product-detail">
        <div class="product-image">
          <img src="./image/菜3.jpg" class="img-fluid " alt="蛤蜊燉湯" />
        </div>
      </div>
    </div>
    <div class="col-lg-6">
      <div class="product-info">
        <h5>【牡丹樓】- 蛤蜊燉湯</h5>
        <hr>
        <h4>價格  $87</h4>
        <hr>
        <p>使用中火將全脂鮮奶油在大型煎鍋中融化，加入洋蔥，炒至軟化，約 5 分鐘。再加入蒜頭，炒 30 秒，直到香氣撲鼻。</p>
        
                      <!-- 購物車-------------------- -->
              <div class="mt-auto">
              <div class="cart">
                    <i class="fas fa-shopping-cart cart-icon"></i>
                    <span class="cart-item"></span> <!-- 顯示數字的元素 -->
                </div>
        
                <div class="page-wrapper mt-3">
                  <button class="btn  btn-warning btn-lg addToCart" id="3" data-member-id="<?= $memberId ?>" data-product-image="./image/菜1.jpg">加入購物車</button>
                  <button type="button" class="btn  btn-outline-dark btn-lg checkoutBtn1">前往結帳</button>
                </div>
              </div>
            </div>
          </div>
      </div>
    </div>
  </div>
</div>
  </div>
</div>

  <div class="conrainer">
  </div>
    <div class="cart-sidebar">
      <div class="cart-items">
        <ul id="cartItemList"></ul>
      </div>
      <div class="cart-total">
        <p>Total: <span id="totalPrice"></span></p>
        <button class="btn btn-primary checkoutBtn">前往結帳</button>
      </div>
    </div>
  </div>

<hr>
<div class="container">
  <div class="row">
    <div class="col-12 pt-2 pb-5">
    <h2>商品詳情</h2>
      <br>
      <h3>商品描述：</h3>
      <video width="100%"  controls>
  <source src="./video/mudanlow.mp4" type="video/mp4">
  Your browser does not support the video tag.
</video>
<hr>
      <table class="product-details">
  <tr>
    <th>【成份】</th>
    <td>新鮮蛤蜊、洋蔥、大蒜、鮮奶油、蔬菜高湯、鹽和黑胡椒</td>
  </tr>
  <tr>
    <th>【淨重】</th>
    <td>490克</td>
  </tr>
  <tr>
    <th>【保存期限】</th>
    <td>6個月，依產品包裝所示</td>
  </tr>
  <tr>
    <th>【保存方式】</th>
    <td>常溫陰涼處，開罐後盡快用畢（出貨如選擇低溫溫層，收到貨後請放置冷藏）</td>
  </tr>
  <tr>
    <th>【原產地】</th>
    <td>台灣</td>
  </tr>
  <tr>
    <th>【有效日期】</th>
    <td>依產品包裝所示</td>
  </tr>
  <tr>
    <th>【使用方式】</th>
    <td>開封後請儘速食用完畢。</td>
  </tr>
  <tr>
    <th>【投保1500萬產品責任險字號】</th>
    <td>南山產物保險股份有限公司 2236005709</td>
  </tr>
  <tr>
    <th>【食品業者登錄字號】</th>
    <td>A-182823453-00000-3</td>
  </tr>
</table>
<br>
      <img src="./image/菜3.jpg" class="img-fluid" alt="蛤蜊燉湯" />
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<?php include __DIR__ . './index-parts/index-scripts.php'; ?>
<script src="./js/card.js"></script>
<script>
      // 监听点击前往结账按钮事件
      $('.checkoutBtn, .checkoutBtn1').on('click', function() {
        // 导向至结账页面
        window.location.href = 'Checkout.php';
    });
</script>
<?php include __DIR__ . './index-parts/index-html-foot.php'; ?>
