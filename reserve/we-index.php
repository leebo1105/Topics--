<?php
if(! isset($_SESSION)) {
  # 如果沒有設定 $_SESSION, 才啟動
  session_start();
}
?>
<?php include __DIR__ . '/we-head.php' ?>
<?php include __DIR__ . '/we-body.php' ?>
<div class="sidebar">
      <h2>牡丹樓管理系統</h2>
      <ul>
        <li>
          <a href="#"><i class="bi bi-people-fill"></i>會員管理</a>
        </li>
        <li>
          <a href="#"><i class="bi bi-calendar-check"></i>預約管理</a>
        </li>
        <li>
          <a href="#"><i class="bi bi-file-earmark"></i>文章管理</a>
        </li>
        <li>
          <a href="#"><i class="bi bi-egg-fried"></i>菜單管理</a>
        </li>
      </ul>
    </div>
<?php include __DIR__ . '/we-foot.php' ?>