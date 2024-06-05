document.addEventListener('DOMContentLoaded', function() {
    var products = [
        { id: 1, name: "蝦菇奶油醬", price: 350 },
        { id: 2, name: "波士頓龍蝦", price: 680 },
        { id: 3, name: "蛤蜊燉湯", price: 250 },
        { id: 4, name: "熱豆花", price: 90 }
    ];

    var cart = {}; // 購物車物件

    // 監聽加入購物車按鈕的點擊事件
    var addToCartButtons = document.querySelectorAll('.addToCart');
    addToCartButtons.forEach(function(button) {
        button.addEventListener('click', function(event) {
            event.stopPropagation(); // 阻止事件冒泡，避免影響購物車側欄的顯示/隱藏

            var productId = parseInt(this.id); // 獲取按鈕上的商品 ID

            // 將商品添加到購物車中
            if (cart[productId]) {
                cart[productId].quantity += 1;
            } else {
                cart[productId] = {
                    name: products.find(item => item.id === productId).name,
                    price: products.find(item => item.id === productId).price,
                    quantity: 1
                };
            }

            // 更新購物車內容
            updateCartSidebar();

            // 將購物車資訊存儲到 localStorage 中
            localStorage.setItem('cart', JSON.stringify(cart));
        });
    });

    // 更新購物車內容的函式
    function updateCartSidebar() {
        var cartItemList = document.getElementById('cartItemList');
        cartItemList.innerHTML = ''; // 清空購物車列表

        var totalPrice = 0;
        var totalQuantity = 0; // 計算商品總數量

        // 遍歷購物車內容，生成每個商品項目
        for (var productId in cart) {
            if (cart.hasOwnProperty(productId)) {
                var product = cart[productId];
                var itemHtml = `
                    <li>
                        <span>${product.name}</span>
                        <span class="item-price">${product.price}</span>
                        <button class="decrement" data-product-id="${productId}">-</button>
                        <span class="quantity">${product.quantity}</span>
                        <button class="increment" data-product-id="${productId}">+</button>
                        <button class="remove" data-product-id="${productId}">刪除</button>
                    </li>
                `;
                cartItemList.insertAdjacentHTML('beforeend', itemHtml);

                // 計算每個商品的總價格並累加到總價格
                var itemTotalPrice = product.price * product.quantity;
                totalPrice += itemTotalPrice;

                // 累加商品數量
                totalQuantity += product.quantity;
            }
        }

        // 更新總價格顯示
        document.getElementById('totalPrice').textContent = totalPrice.toFixed(2);

        // 更新購物車圖示中顯示的商品總數量
        var cartItem = document.querySelector('.cart .cart-item');
        cartItem.textContent = totalQuantity; // 更新購物車圖示中的商品數量
    }

    // 監聽增減刪除按鈕的點擊事件，阻止事件冒泡
    document.getElementById('cartItemList').addEventListener('click', function(event) {
        if (event.target.classList.contains('increment')) {
            var productId = parseInt(event.target.dataset.productId);
            cart[productId].quantity += 1;
            updateCartSidebar();
        }

        if (event.target.classList.contains('decrement')) {
            var productId = parseInt(event.target.dataset.productId);
            if (cart[productId].quantity > 0) {
                cart[productId].quantity -= 1;
                if (cart[productId].quantity === 0) {
                    delete cart[productId]; // 如果數量為0，從購物車中移除該商品
                }
                updateCartSidebar();
            }
        }

        if (event.target.classList.contains('remove')) {
            var productId = parseInt(event.target.dataset.productId);
            delete cart[productId];
            updateCartSidebar();
        }

        // 將更新後的購物車資訊存儲到 localStorage 中
        localStorage.setItem('cart', JSON.stringify(cart));

        // 阻止事件冒泡
        event.stopPropagation();
    });

    // 獲取 cart-sidebar 元素
    var cartSidebar = document.querySelector('.cart-sidebar');

    // 監聽點擊購物車圖標事件，顯示購物車側欄
    var cartIcon = document.querySelector('.cart');
    cartIcon.addEventListener('click', function(event) {
        event.stopPropagation(); // 阻止事件冒泡，防止觸發 document 的 click 事件
        cartSidebar.classList.add('show'); // 顯示購物車側欄
    });

    // 監聽點擊頁面其他區域，隱藏購物車側欄
    document.addEventListener('click', function(event) {
        if (!event.target.closest('.cart') && !event.target.closest('.cart-sidebar')) {
            cartSidebar.classList.remove('show'); // 隱藏購物車側欄
        }
    });

    // 監聽點擊前往結帳按鈕事件
    var checkoutBtn = document.querySelector('.checkoutBtn');
    checkoutBtn.addEventListener('click', function() {
        // 導向至結帳頁面
        window.location.href = 'Checkout.html';
    });
});
