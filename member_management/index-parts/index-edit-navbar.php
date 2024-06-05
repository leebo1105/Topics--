
<ul class="nav nav-tabs">

  <li class="nav-item">

    <a class="nav-link" aria-current="page" href="index-edit.php?id=<?= $_SESSION['admin']['id'] ?>">會員資料</a>
  </li>

  <li class="nav-item">
    <a class="nav-link" aria-current="page" href="index-edit-manage.php?id=<?= $_SESSION['admin']['id'] ?>">會員資料編輯</a>
  </li>
  
    <li class="nav-item">
      <a class="nav-link " aria-current="page" href="index-cart-new.php?id=<?= $_SESSION['admin']['id'] ?>">我的訂單</a>
    </li>

  <li class="nav-item">
    <a class="nav-link " aria-current="page" href="index-cart-log.php?id=<?= $_SESSION['admin']['id'] ?>">歷史訂單</a>
  </li>

  <li class="nav-item">
    <a class="nav-link " aria-current="page" href="#<?= $_SESSION['admin']['id'] ?>">專屬優惠</a>
  </li>

</ul>

<script>
  document.addEventListener("DOMContentLoaded", function() {
    var navLinks = document.querySelectorAll(".nav-link");
    
    // 判断页面 URL 与链接 URL 是否匹配，并设置活动状态
    navLinks.forEach(function(link) {
      if (window.location.href.includes(link.getAttribute("href"))) {
        link.classList.add("active");
      }
    });

    navLinks.forEach(function(link) {
        link.addEventListener("click", function(event) {

            // 移除其他链接的活动类
            navLinks.forEach(function(otherLink) {
                otherLink.classList.remove("active");
            });

            // 将当前链接设置为活动状态
            this.classList.add("active");

            var url = this.getAttribute("href");

            // 使用 AJAX 加载页面内容
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    document.getElementById("content").innerHTML = xhr.responseText;
                }
            };
            xhr.open("GET", url, true);
            xhr.send();
        });
    });
  });
</script>