<?php
// 启用会话
session_start();

// 检查会话中是否存在会员ID
if (isset($_SESSION['admin']['id'])) {
    // 获取会员ID
    $memberId = $_SESSION['admin']['id'];
    // echo "會員編號ID是：$memberId";
} else {
    header("Location: index-login.php");
    exit();
}
?>

<?php include __DIR__ . './index-parts/index-html-head.php' ?>
<style>
#checkoutItems{
    background-color: lightgray;
    opacity: 0.8;
    border-radius: 10px;
    padding: 10px;
}

</style>
<?php include __DIR__ . './index-parts/index-navbar.php' ?>
<header class="masthead">
            <div class="container px-4 px-lg-5 px-md-5 h-100">
<div id="checkoutItems" class="row">
    <h2>結帳頁面</h2>
    <tr>
        <th>
            
            <input type="hidden" name="id" value="<?= $memberId ?>" />
        </th>
    </tr>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>商品名稱</th>
                <th>單價</th>
                <th>數量</th>
                <th>小計</th>
            </tr>
        </thead>
        <tbody id="cartItemList">
            <!-- 這裡將動態插入購物車表格內容 -->
        </tbody>
    </table>
    <p>總計： <span id="totalPrice"></span></p>
    <div>
        <button type="button" class="btn btn-primary checkoutBtn">結帳</button>
    </div>
</div>
</div>
        </header>
<?php include __DIR__ . './index-parts/index-scripts.php' ?>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // 獲取 localStorage 中的購物車資訊
        var storedCart = localStorage.getItem("cart");

        // 解析購物車資訊，如果存在的話
        var cart = storedCart ? JSON.parse(storedCart) : {};

        // 更新結帳頁面或相關內容，例如展示購物車列表等
        updateCheckoutPage(cart);
    });

    function updateCheckoutPage(cart) {
        var cartItemList = document.getElementById("cartItemList");
        var totalPriceElement = document.getElementById("totalPrice");
        var totalPrice = 0;

        // 清空購物車表格內容
        cartItemList.innerHTML = "";

        // 動態生成購物車表格內容
        for (var productId in cart) {
            if (cart.hasOwnProperty(productId)) {
                var product = cart[productId];
                var itemRow = document.createElement("tr");

                // 商品名稱欄位
                var itemNameCell = document.createElement("td");
                itemNameCell.textContent = product.name;
                itemRow.appendChild(itemNameCell);

                // 單價欄位
                var itemPriceCell = document.createElement("td");
                itemPriceCell.textContent = "$" + product.price.toFixed(2);
                itemRow.appendChild(itemPriceCell);

                // 數量欄位
                var itemQuantityCell = document.createElement("td");
                itemQuantityCell.textContent = product.quantity;
                itemRow.appendChild(itemQuantityCell);

                // 小計欄位
                var itemTotalPriceCell = document.createElement("td");
                var itemTotalPrice = product.price * product.quantity;
                itemTotalPriceCell.textContent = "$" + itemTotalPrice.toFixed(2);
                itemRow.appendChild(itemTotalPriceCell);

                // 將整行添加到表格中
                cartItemList.appendChild(itemRow);

                // 計算總價格
                totalPrice += itemTotalPrice;
            }
        }

        // 更新總價格顯示
        totalPriceElement.textContent = "$" + totalPrice.toFixed(2);
    }

    // 監聽結帳按鈕點擊事件
    var checkoutBtn = document.querySelector(".checkoutBtn");
    checkoutBtn.addEventListener("click", function () {
        // 獲取購物車資訊
        var storedCart = localStorage.getItem("cart");
        var cart = storedCart ? JSON.parse(storedCart) : {};

        // 發送購物車資訊到後端
        fetch("save_cart.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({
                memberId: <?php echo json_encode($memberId) ?>, //輸出會員id
                cart: cart
            })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error("Network response was not ok");
            }
            return response.json();
        })
        .then(data => {
            alert("購物車資訊已成功儲存！");
            // 可以在此處執行重定向或其他操作
        })
        .catch(error => {
            alert("儲存購物車資訊時發生錯誤。");
            console.error("發生錯誤:", error);
        });
    });
</script>
<?php include __DIR__ . './index-parts/index-html-foot.php' ?>
