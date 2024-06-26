<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <title><?= isset($title) ? "{$title} | 牡丹樓 " : '' ?></title>
  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet" />
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      display: flex;
      height: 100vh;
      /* 設置 body 高度為視窗高度的 100% */
    }
    .element {
  background-color: transparent; /* 将元素的背景色设置为透明 */
}
    .sidebar {
      width: 150px;
      background-color: #333;
      padding-left: 10px;
      color: #fff;
      height: 100vh;
      /* 讓側欄高度佔滿 body 的高度 */
      overflow-y: auto;
      /* 若內容超出側欄高度，提供滾動條 */
    }

    .sidebar h2 {
      font-size: 20px;
      margin-bottom: 10px;
    }

    .sidebar ul {
      list-style-type: none;
      padding: 0;
    }

    .sidebar li {
      margin-bottom: 10px;
    }

    .sidebar a {
      text-decoration: none;
      color: #fff;
      font-size: 18px;
    }

    .content h3 {
      margin-bottom: 0;
    }

    .sidebar li i {
      margin-right: 10px;
      /* 調整圖標與文字之間的間距 */
    }

    .member-field {
      background-color: #fff;
      width: 80%;
      height: 50px;
      padding: 10px;
      margin: auto;
      margin-top: 10px;
      margin-bottom: 5px;
      border-radius: 10px;
    }

    .member-field button {
      margin-right: 10px;
    }

    .member-field button:hover {
      margin-right: 10px;
      background-color: lightblue;
      cursor: pointer;
    }

    .member-field p {
      margin-block: 0;
    }

    table,
    th,
    td {
      border: 1px solid black;
      /* 设置表格、表头和单元格的边框样式 */
    }

    .member-table {
        background-color: #fff;
        width: 80%;
        height: 100%;
        /* padding: 10px; */
        border-radius: 10px;
        margin: auto;
        margin-top: 10px;
        overflow: hidden;
    }

    .table-data {
        margin-top: 5px;
        text-align: center;
      }

    .table-data tr:hover {
      background-color: rgb(129, 117, 117);
    }

    .table-data th,
    .table-data td {
        padding: 5px;
    }
  </style>
</head>

<body class="bg-secondary text-white">