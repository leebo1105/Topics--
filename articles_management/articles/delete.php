<?php
require __DIR__ . '/config/pdo-connect.php';

$sid = isset($_GET['a_id']) ? intval($_GET['a_id']) : 0;

if(! empty($sid)) {
  # $sid 不是空的 (不是 0)
  $sql = "DELETE FROM articles WHERE a_id=$sid";
  $pdo->query($sql);
}

# $_SERVER['HTTP_REFERER'], 人從哪裡來

$comeFrom = 'newarticle.php'; # 預設值
if(! empty($_SERVER['HTTP_REFERER'])){
  $comeFrom = $_SERVER['HTTP_REFERER'];
}

header('Location: '. $comeFrom);