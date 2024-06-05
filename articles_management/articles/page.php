<?
$t_sql = "SELECT COUNT(1) FROM address_book";

$perPage = 25; #每一頁最多有幾筆

#取得用戶要看第幾頁
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
if ($page < 1) {
  #頁碼小於1跳轉到第一頁
  header('Location: ?page=1');
  exit;
}

#取得資料總筆數
$totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0];
#預設值
$totalPages = 0;
$rows = [];
if ($totalRows > 0) {
  #如果有資料才去取得分頁資料
  $totalPages = ceil($totalRows / $perPage); #無條件進位
  #頁碼大於總頁數時，留在最後一頁
  if ($page > $totalPages) {
    header('Location: ?page=' . $totalPages);
    exit;
  }

  $sql = sprintf(
    "SELECT * FROM address_book ORDER BY sid DESC LIMIT %s, %s",
    ($page - 1) * $perPage,
    $perPage
  );
  $rows = $pdo->query($sql)->fetchAll();
}
?>

<div class="col">
          <nav aria-label="Page navigation example">
            <ul class="pagination">
              <li class="page-item <?= $page == 1 ? 'disabled' : '' ?>">
                <a class="page-link" href="?page=1">
                  <i class="fa-solid fa-angles-left"></i>
                </a>
              </li>
              <li class="page-item <?= $page == 1 ? 'disabled' : '' ?>">
                <a class="page-link" href="?page=<?= $page - 1 ?>">
                  <i class="fa-solid fa-angle-left"></i>
                </a>
              </li>
              <?php for ($i = $page - 5; $i <= $page + 5; $i++) :
                if ($i >= 1 and $i <= $totalPages) :
              ?>
                  <li class="page-item <?= $page == $i ? 'active' : '' ?>">
                    <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                  </li>
              <?php endif;
              endfor; ?>
              <li class="page-item <?= $page == $totalPages ? 'disabled' : '' ?>">
                <a class="page-link" href="?page=<?= $page + 1 ?>">
                  <i class="fa-solid fa-angle-right"></i>
                </a>
              </li>
              <li class="page-item <?= $page == $totalPages ? 'disabled' : '' ?>">
                <a class="page-link" href="?page=<?= $totalPages ?>">
                  <i class="fa-solid fa-angles-right"></i>
                </a>
              </li>
            </ul>
          </nav>
        </div>