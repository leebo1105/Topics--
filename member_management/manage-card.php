<?php
require __DIR__ . '/config/pdo-connect.php';
$title = '訂單管理';
$pageName = 'ab_list';

$t_sql = "SELECT COUNT(1) FROM member_profile";

$perPage = 15;

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
if ($page < 1) {
    header('Location: ?page=1');
    exit;
}

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
        mc.card_date
    FROM 
        member_profile mp
    JOIN 
        member_card mc ON mp.id = mc.member_profile_id
    JOIN 
        cart_status cs ON mc.status_id = cs.sid
    ORDER BY mc.card_date DESC
    LIMIT %d, %d",
    ($page - 1) * $perPage,
    $perPage
);
$rows = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);

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
<?php include __DIR__ . '../../../Topics/menu/part/html-head.php' ?>
<!-- body 在這 -->
<style>
    /* 在這修改直接覆蓋 */
    .bg-secondary li {
        list-style-type: none;
    }

    .color-red {
        color: brown;
    }

    .color-black {
        color: black
    }
</style>
<?php include __DIR__ . '../../../Topics/member_management/manage/manage-navbar.php' ?>

<div class="container ">
    <div class="row justify-content-center pt-2">
        <div class="title mb-3">
            <h1>訂單管理</h1>
        </div>
        <hr>
        <div class="content">
            <div class="row ">

                <form class="col" name="form3" method="post" onsubmit="validateForm (event)">

                </form>
            </div>

            <div class="py-5">
                <table class="table-data col-12">
                    <thead>
                        <tr>
                            <th class="color-black"><i class="fa-regular fa-pen-to-square"></i></i>
                            </th>
                            <th>訂單編號</th>
                            <th>會員編號</th>
                            <th>Email</th>
                            <th>商品數量</th>
                            <th>總價</th>
                            <th>手機號碼</th>
                            <th>訂單建立日期</th>
                            <th>訂單狀態</th>
                            <th class="color-black"><i class="fa-solid fa-trash"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- 資料表陣列迴圈用 foreach -->
                        <?php
                        $previous_cid = null; //追蹤上一個c_id
                        foreach ($rows as $r) : ?>
                            <!-- 如果當前c_id 與上個不同 -->
                            <?php if ($r['c_id'] !== $previous_cid) : ?>
                                <tr class="table-data">
                                    <td>
                                        <a href="manage-card-edit.php?c_id=<?= $r['c_id'] ?>">
                                            <i class="fa-regular fa-pen-to-square"></i>
                                        </a>
                                    </td>
                                    <td><?= $r['c_id'] ?></td>
                                    <td><?= $r['member_profile_id'] ?></td>
                                    <td><?= $r['email'] ?></td>
                                    <!-- 直接從$totalQuantityBycid 中取出對應的商品數量 -->
                                    <td><?= $totalQuantityBycid[$r['c_id']] ?></td>
                                    <!-- 直接從$totalPriceBycid 中取出對應的價格 -->
                                    <td><?= $totalPriceBycid[$r['c_id']] ?></td>
                                    <td><?= $r['mobile'] ?></td>
                                    <td><?= $r['card_date'] ?></td>
                                    <td><?= $r['status_remark'] ?></td>
                                    <td>
                                        <!-- 呼叫 JS -->
                                        <a href="javascript: deleteOne(<?= $r['c_id'] ?>)">
                                            <i class="fa-solid fa-trash color-red"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endif; ?>
                            <?php $previous_cid = $r['c_id']; ?>
                        <?php endforeach ?>
                    </tbody>

                </table>

            </div>
            <!-- 分頁按鈕 -->
            <nav aria-label="Page navigation example " class="pt-3 ">

                <ul class="d-flex justify-content-center list-unstyled">

                    <li class="page-item px-1 <?= $page == 1 ? 'disabled' : '' ?>">
                        <a class="page-link" href="?page=1 ?>"><i class="fa-solid fa-angles-left"></i></a>
                    </li>

                    <li class="page-item px-2 <?= $page == 1 ? 'disabled' : '' ?>">
                        <a class="page-link" href="?page=<?= $page - 1 ?>"><i class="fa-solid fa-angle-left"></i></a>
                    </li>

                    <!-- for 顯示頁數 +-3 if 限制只顯示 <= i >= -->
                    <?php for ($i = $page - 3; $i <= $page + 3; $i++) :
                        if ($i >= 1 and $i <= $totalPages) :
                    ?>

                            <li class="page-item">
                                <!-- ?開頭表示同一個php, 只需要換參數 -->
                                <a class="page-link px-2 <?= $page == $i ? 'text-body' : '' ?>" href="?page=<?= $i ?>"><?= $i ?></a>
                            </li>
                    <?php endif;
                    endfor; ?>

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




    <?php include __DIR__ . '/manage/manage-scripts.php' ?>

    <script>
        const deleteOne = c_id => {
            if (confirm(`是否要刪除編號為 ${c_id} 的訂單`)) {

                location.href = `manage-card-del.php?c_id=${c_id}`
            }
        }
    </script>

    <?php include __DIR__ . '/manage/manage-html-foot.php' ?>