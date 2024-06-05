document.addEventListener('DOMContentLoaded', function() {
    var products = [
        { id: 1, name: "蝦菇奶油醬", price: 350 },
        { id: 2, name: "波士頓龍蝦", price: 680 },
        { id: 3, name: "蛤蜊燉湯", price: 250 },
        { id: 4, name: "熱豆花", price: 90 }
    ];

    var cart = JSON.parse(localStorage.getItem('cart')) || {}; // 从localStorage获取购物车数据
    var globalCartItemCount = 0; // 全局购物车计数器

    updateCartSidebar();

    // 监听点击购物车按钮事件，切换购物车侧边栏的显示和隐藏状态
    $('.cart').on('click', function(event) {
        event.stopPropagation(); // 阻止事件冒泡，防止触发 document 的 click 事件
        var cartSidebar = $('.cart-sidebar');
        if (cartSidebar.hasClass('show')) {
            cartSidebar.removeClass('show'); // 隐藏购物车侧边栏
        } else {
            cartSidebar.addClass('show'); // 显示购物车侧边栏
        }
    });

    $('.addToCart').on('click', function(event) {
        event.stopPropagation(); // 阻止事件冒泡
        var button = $(this);
        var productId = parseInt(button.attr('id'));

        // 更新购物车
        if (cart[productId]) {
            cart[productId].quantity += 1;
        } else {
            var product = products.find(item => item.id === productId);
            cart[productId] = {
                name: product.name,
                price: product.price,
                quantity: 1
            };
        }

        // 更新购物车图标中的商品数量
        globalCartItemCount++;
        $('.cart[data-cart-id="1"] .cart-item').text(globalCartItemCount).show();

        // 保存购物车数据到localStorage
        localStorage.setItem('cart', JSON.stringify(cart));

        // 添加摇晃效果
        var cartIcon = $('.cart[data-cart-id="1"]');
        cartIcon.addClass('shake');
        setTimeout(function() {
            cartIcon.removeClass('shake');
        }, 400);

        // 更新购物车侧栏内容
        updateCartSidebar();
    });

    function updateCartSidebar() {
        var cartItemList = $('#cartItemList');
        cartItemList.empty(); // 清空购物车列表

        var totalPrice = 0;
        var totalQuantity = 0; // 计算商品总数量

        // 从购物车对象中获取所有商品的键（即产品ID），以数组形式返回
        var productIds = Object.keys(cart);
        // 反转数组，使得新添加的商品在列表顶部显示
        productIds.reverse();

        productIds.forEach(function(productId) {
            var product = cart[productId];
            var itemHtml = `
            <li>
                <span>${product.name}</span>
                <span class="item-price">${product.price}</span>
                <br>
                <button class="increment custom-btn" data-product-id="${productId}"><i class="fas fa-plus"></i></button>
                <span class="quantity">${product.quantity}</span>
                <button class="decrement custom-btn" data-product-id="${productId}"><i class="fas fa-minus"></i></button>
                <button class="remove" data-product-id="${productId}"><i class="fas fa-trash-alt"></i></button>
            </li>
            `;
            cartItemList.append(itemHtml);

            // 计算每个商品的总价格并累加到总价格
            var itemTotalPrice = product.price * product.quantity;
            totalPrice += itemTotalPrice;

            // 累加商品数量
            totalQuantity += product.quantity;
        });

        // 更新购物车总价格显示
        $('#totalPrice').text(totalPrice.toFixed(2));

        // 更新购物车图标中显示的商品总数量
        $('.cart .cart-item').text(totalQuantity);
    }

    // 监听增减删除按钮的点击事件，阻止事件冒泡
    $('#cartItemList').on('click', '.increment', function(event) {
        event.stopPropagation(); // 阻止事件冒泡
        var productId = parseInt($(this).data('product-id'));
        cart[productId].quantity += 1;
        updateCartSidebar();
        localStorage.setItem('cart', JSON.stringify(cart));
    });

    $('#cartItemList').on('click', '.decrement', function(event) {
        event.stopPropagation(); // 阻止事件冒泡
        var productId = parseInt($(this).data('product-id'));
        if (cart[productId].quantity > 0) {
            cart[productId].quantity -= 1;
            if (cart[productId].quantity === 0) {
                delete cart[productId]; // 如果数量为0，从购物车中移除该商品
            }
            updateCartSidebar();
            localStorage.setItem('cart', JSON.stringify(cart));
        }
    });

    $('#cartItemList').on('click', '.remove', function(event) {
        event.stopPropagation(); // 阻止事件冒泡
        var productId = parseInt($(this).data('product-id'));
        delete cart[productId];
        updateCartSidebar();
        localStorage.setItem('cart', JSON.stringify(cart));
    });

    // 监听点击页面其他区域，隐藏购物车侧栏
    $(document).on('click', function(event) {
        var cartSidebar = $('.cart-sidebar');
        if (!$(event.target).closest('.cart').length && !$(event.target).closest('.cart-sidebar').length && cartSidebar.hasClass('show')) {
            cartSidebar.removeClass('show'); // 隐藏购物车侧边栏
        }
    });

    // 监听点击清空购物车按钮事件
    $('#clearCart').on('click', function() {
        // 清空购物车数据
        cart = {};
        // 更新购物车图标中的商品数量和全局购物车数量
        globalCartItemCount = 0;
        $('.cart[data-cart-id="1"] .cart-item').text(globalCartItemCount).hide();
        updateCartSidebar();
        // 清除localStorage中的购物车数据
        localStorage.removeItem('cart');
    });
});

