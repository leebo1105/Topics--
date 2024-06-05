<?php
require __DIR__ . '/config/pdo-connect.php';

// 检查是否收到了有效的会员 ID
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if (empty($id)) {
  header('Location: index-list.php');
  exit; // 结束 PHP 程序
}

$perPage = 15;
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
if ($page < 1) {
  header('Location: ?page=1');
  exit;
}

// 總行數
$t_sql = "SELECT COUNT(1) FROM member_profile";
$totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0];
$totalPages = ($totalRows > 0) ? ceil($totalRows / $perPage) : 0;

if ($page > $totalPages) {
  header('Location: ?page=' . $totalPages);
  exit;
}


$sql = sprintf(
  "SELECT 
        mc.c_id, 
        cs.sid as cart_status_id,
        cs.status_name,
        cs.status_remark,
        mp.id as member_profile_id, 
        mp.member_name, 
        mp.mobile, 
        mc.productName, 
        mc.price, 
        mc.quantity, 
        mc.totalPrice,
        mp.email,
        DATE(mc.card_date) as card_date,
        cb.receive_name,
        cb.address,
        cb.contact_mobile
    FROM 
        member_profile mp
    JOIN 
        member_card mc ON mp.id = mc.member_profile_id
    JOIN 
        contact_book cb ON mp.id = cb.member_profile_id
    JOIN 
        cart_status cs ON mc.status_id = cs.sid
    WHERE cs.sid >= 3
    ORDER BY mc.card_date DESC
    LIMIT %d, %d",
  ($page - 1) * $perPage,
  $perPage
);
$rows = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);


// 處理訂單資訊
$totalPriceBycid = [];
$totalQuantityBycid = [];
$ordersByCid = [];

foreach ($rows as $r) {
  $cid = $r['c_id'];
  if (!isset($totalPriceBycid[$cid])) {
    $totalPriceBycid[$cid] = 0;
    $totalQuantityBycid[$cid] = 0;
    $ordersByCid[$cid] = [];
  }
  $totalPriceBycid[$cid] += $r['totalPrice'];
  $totalQuantityBycid[$cid] += $r['quantity'];
  $ordersByCid[$cid][] = $r;
}
?>
<?php include __DIR__ . './index-parts/index-html-head.php' ?>
<style>

</style>
<?php include __DIR__ . './index-parts/index-navbar.php' ?>
<header class="masthead">
  <div class="container px-4 px-lg-5 px-md-5 h-100">
    <div class="row justify-content-center align-items-center">
      <div class="col-12 col-lg-9 col-xl-7 text-white" style="border-radius: 15px">
        <div class="card-body p-4 p-md-5">
          <form name="form1" method="post" onsubmit="sendData(event)">
            <!-- 導覽 -->
            <?php include __DIR__ . './index-parts/index-edit-navbar.php' ?>
            <h2 class="pt-2">歷史訂單</h2>
            <!--  cart_status_id= 3, 4 -->
            <div class="accordion" id="accordionOrders">
              <?php foreach ($ordersByCid as $cid => $orders) : ?>
                <div class="accordion-item">
                  <h2 class="accordion-header" id="heading<?= $cid ?>">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $cid ?>" aria-expanded="false" aria-controls="collapse<?= $cid ?>">
                      訂單編號: <?= $cid ?>| 日期: <?= $orders[0]['card_date'] ?>
                      | 狀態: <?= $orders[0]['status_name'] ?>
                    </button>
                  </h2>
                  <div id="collapse<?= $cid ?>" class="accordion-collapse collapse" aria-labelledby="heading<?= $cid ?>" data-bs-parent="#accordionOrders">
                    <div class="accordion-body">
                      <table class="table table-bordered text-center col-12">
                        <thead>
                          <tr>
                            <th>商品</th>
                            <th>商品價格</th>
                            <th>數量</th>

                          </tr>
                        </thead>
                        <tbody>
                          <?php foreach ($orders as $order) : ?>
                            <tr class="table-data">
                              <td><?= $order['productName'] ?></td>
                              <td><?= $order['price'] ?></td>
                              <td><?= $order['quantity'] ?></td>

                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                          <tr>
                            <td colspan="2">總金額</td>
                            <td><?= $totalPriceBycid[$cid] ?></td>
                          </tr>
                          
                        </tfoot>
                      </table>
                      <table class="table table-bordered text-center col-12">
                        <thead>
                          <tr>
                            <th>收件人</th>
                            <th>收件人電話</th>
                            <th>收件人地址</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr class="table-data">
                            <td><?= $orders[0]['receive_name'] ?></td>
                            <td><?= $orders[0]['contact_mobile'] ?></td>
                            <td><?= $orders[0]['address'] ?></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
          </form>
        </div>
      </div>
      <!-- 分頁 -->
      <nav aria-label="Page navigation example" class="pt-3">
        <ul class="d-flex justify-content-center list-unstyled">
          <li class="page-item px-1 <?= $page == 1 ? 'disabled' : '' ?>">
            <a class="page-link" href="?page=1"><i class="fa-solid fa-angles-left"></i></a>
          </li>
          <li class="page-item px-2 <?= $page == 1 ? 'disabled' : '' ?>">
            <a class="page-link" href="?page=<?= $page - 1 ?>"><i class="fa-solid fa-angle-left"></i></a>
          </li>
          <?php for ($i = $page - 3; $i <= $page + 3; $i++) : ?>
            <?php if ($i >= 1 && $i <= $totalPages) : ?>
              <li class="page-item">
                <a class="page-link px-2 <?= $page == $i ? 'text-body' : '' ?>" href="?page=<?= $i ?>"><?= $i ?></a>
              </li>
            <?php endif; ?>
          <?php endfor; ?>
          <li class="page-item px-2 <?= $page == $totalPages ? 'disabled' : '' ?>">
            <a class="page-link" href="?page=<?= $page + 1 ?>"><i class="fa-solid fa-angle-right"></i></a>
          </li>
          <li class="page-item px-1 <?= $page == $totalPages ? 'disabled' : '' ?>">
            <a class="page-link" href="?page=<?= $totalPages ?>"><i class="fa-solid fa-angles-right"></i></a>
          </li>
        </ul>
      </nav>
    </div>
  </div>
</header>

<?php include __DIR__ . './index-parts/index-scripts.php' ?>

<script>



</script>



<?php include __DIR__ . './index-parts/index-html-foot.php' ?>