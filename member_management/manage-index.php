<?php
# 啟動 session
if(! isset($_SESSION)) {
  # 如果沒有設定 $_SESSION, 才啟動
  session_start();
};
?>
<?php include __DIR__ . '../../../Topics/menu/part/html-head.php' ?>
<?php include __DIR__ . '../../../Topics/member_management/manage/manage-navbar.php' ?>
<!-- 主要內容區域 -->
<div class="container">
  <div class="title">
    <h2>歡迎來到餐廳後台管理系統</h2>
    <p>選擇左側功能以開始管理您的餐廳資料。</p>
  </div>
 </div>
<?php include __DIR__ . '/manage/manage-scripts.php' ?>
<?php include __DIR__ . '/manage/manage-html-foot.php' ?>