<?php
session_start();

if(isset($_SESSION["admin"])) {
    unset($_SESSION["admin"]);
    header('Location: manage-index.php');
} elseif(isset($_SESSION["user"])) {
    unset($_SESSION["user"]);
    header('Location: index-list.php');
} else {
    // 如果没有任何用户在会话中，您可以重定向到默认页面或执行其他操作
    header('Location: default-page.php');
}
