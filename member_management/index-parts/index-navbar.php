<?php
if (!isset($pageName)) $pageName = '';
?>
<style>
   /* 以下CSS為固定----麻煩有額外增加的CSS請至下新增---------------------------------------------------------*/
/* 添加在nav導覽列 */
.bg-custom {
    background-color: rgba(54, 110, 83, 1); 
    color: #ffffff;
}

.icon a {
    color: white; /* 設置圖標顏色為白色 */
    text-decoration: none; /* 去除連結下劃線 */
}

.icon a:hover {
    color: #cccccc; /* 設置懸停顏色，可以根據需要調整 */
}
/* navbar顏色 */
#mainNav {
  background-color: rgba(54, 110, 83, 1); 
    color: #ffffff;
    font-size: 23px;
        }

/* icon動畫特效 */
/* 定义摇晃动画 */
@keyframes shake {
    0% { transform: translateX(0); }
    25% { transform: translateX(-2px); } 
    50% { transform: translateX(2px); }
    75% { transform: translateX(-2px); }
    100% { transform: translateX(0); }
}


.shake {
    animation: shake 0.5s;
    animation-iteration-count: 1; 
}

#mainNav .navbar-nav .nav-link:hover {
    color: #ff6347 !important; /* 導覽列文字顏色*/
    animation: shake 0.28s;
    font-size: 67%;
}

/* 返回顶部图标样式 */
.back-to-top {
  position: fixed;
  bottom: 20px;
  right: 20px;
  width: 40px;
  height: 40px;
  background-color: #333;
  color: #fff;
  text-align: center;
  line-height: 40px;
  border-radius: 50%;
  cursor: pointer;
  display: none; /* 默认隐藏 */
  z-index: 1000; /* 确保在最前 */
  transition: background-color 0.3s, transform 0.3s;
}

.back-to-top:hover {
  background-color: #555;
  transform: scale(1.1);
}

/* 图标大小 */
.back-to-top i {
  font-size: 20px;
}
/* 額外導覽框 */
/* 額外導覽框 */
.dropdown-content {
    display: none;
    position: absolute;
    background-color: rgba(54, 110, 83, 1);
    color: white;
    padding: 10px;
    border-radius: 5px;
    top: 100%;
    left: 0;
    right: 0; /* 使寬度延展到最寬 */
    z-index: 1000;
    opacity: 0;
    max-height: 0;
    overflow: hidden;
    transition: opacity 0.5s ease-in-out, max-height 0.5s ease-in-out;
    text-align: center; /* 水平居中對齊 */
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center; /* 垂直居中對齊 */
}

.nav-item:hover .dropdown-content {
    display: block;
    opacity: 1;
    max-height: 300px; /* 根據內容調整 */
}

.dropdown-item {
    color: white;
    padding: 5px 10px;
    text-decoration: none;
}

.dropdown-item:hover {
    background-color: #ff6347;
    color: white;
}
.navbar-brand img {
    height: 40px; /* Adjust the height as needed */
    margin-right: 10px; /* Space between the image and the text/icon */
}

/* 首頁背景是header.masthead */
/* 以上CSS為固定----麻煩有額外增加的CSS請至下新增----------------------------------------------------------- */

</style>


<!-- Navigation-->
<nav class="navbar navbar-expand-lg fixed-top  py-3" id="mainNav">
    <div class="container px-4 px-lg-5">
    <a class="navbar-brand" href="index-list.php">
            <img src="./img/logo-gold.png" alt="牡丹樓logo" style="height: 26px;"> <!-- 引入图片 -->
            
        </a>

        <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ms-auto my-2 my-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="card.php"><i class="fas fa-shopping-cart"></i> 購物專區</a>
                    <div class="dropdown-content">購物專區的額外導覽內容</div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Checkout.php"><i class="fas fa-receipt"></i> 我的訂單</a>
                    <div class="dropdown-content">我的訂單的額外導覽內容</div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="menu-index.php"><i class="fas fa-utensils"></i> 菜單</a>
                    <div class="dropdown-content">菜單的額外導覽內容</div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about_us.php"><i class="fas fa-info-circle"></i> 關於我們</a>
                    <div class="dropdown-content">
                        <a class="dropdown-item" href="news-list.php">最新消息</a>
                        <a class="dropdown-item" href="recruiting.php">人才招募</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="預約系統.php"><i class="fas fa-calendar-check"></i> 立即預約</a>
                    <div class="dropdown-content">立即預約的額外導覽內容</div>
                </li>
                <?php if (isset($_SESSION['admin'])) : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="index-edit.php?id=<?= $_SESSION['admin']['id'] ?>">
                            <i class="fas fa-user"></i> <?= $_SESSION['admin']['nickname'] ?>
                        </a>
                        <div class="dropdown-content">管理員的額外導覽內容</div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index-logout.php"><i class="fas fa-sign-out-alt"></i> 登出</a>
                    </li>
                <?php else : ?>
                    <li class="nav-item">
                        <a class="nav-link <?= $pageName === 'register' ? 'active' : '' ?>" href="index-add.php">
                            <i class="fas fa-user-plus"></i> 註冊
                        </a>
                        <div class="dropdown-content">註冊的額外導覽內容</div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $pageName === 'login' ? 'active' : '' ?>" href="index-login.php">
                            <i class="fas fa-sign-in-alt"></i> 登入
                        </a>
                        <div class="dropdown-content">登入的額外導覽內容</div>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>



