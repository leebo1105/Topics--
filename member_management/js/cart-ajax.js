$(document).ready(function() {
    // 使用 AJAX 從 PHP 檔案獲取商品資料
    $.ajax({
        url: 'get_products.php',
        method: 'GET',
        dataType: 'json',
        success: function(response) {
            var productList = $('.productList');

            // 將商品資料動態生成商品卡片
            response.forEach(function(product) {
                var card = `
                    <div class="card mb-3">
                        <img src="${product.image}" class="card-img-top" alt="${product.name}" />
                        <div class="card-body">
                            <h5 class="card-title">${product.name}</h5>
                            <p class="card-text">
                            ${product.description}
                            價格: ${product.price}</p>
                            <button class="btn btn-primary addToCart">加入購物車</button>
                        </div>
                    </div>
                `;

                productList.append(card);
            });
        },
        error: function(xhr, status, error) {
            console.error('Error fetching products:', error);
        }
    });
});
