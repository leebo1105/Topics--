document.addEventListener('DOMContentLoaded', function() {
    
    // 選取需要動態更新的元素，例如圖片、商品名稱和商品價格
    var imageElement = document.querySelector('.rounded');
    var nameElement = document.querySelector('span:nth-child(2)'); // 假設這是商品名稱元素
    var priceElement = document.querySelector('span:nth-child(3)'); // 假設這是商品價格元素

    // 假設您從購物車或其他地方獲取了商品資訊，例如商品圖片、名稱和價格
    var productImageURL = 'path_to_your_product_image.jpg';
    var productName = 'Your Product Name';
    var productPrice = 'Your Product Price';

    // 更新錢錢換快樂畫面中的資訊
    imageElement.src = productImageURL;
    nameElement.textContent = productName;
    priceElement.textContent = productPrice;
});
