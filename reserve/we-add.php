<?php include __DIR__ . '/../member_management/manage/manage-html-head.php' ?>
  <style>
    select {
      margin-block: 10px;
    }
    input {
      margin-block: 10px;
    }
  </style>
<?php include __DIR__ . '/../member_management/manage/manage-navbar.php' ?>

  <form method="post" action="we-receiver.php">
    幾人桌:
    <select name="count" id="count">
      <option value="12">12人桌</option>
      <option value="4">4人桌</option>
      <option value="2">2人桌</option>
    </select><br>
    <input type="text" id="guestNo" name="guests" placeholder="人數" /><br>
    <input type="date" name="reservationDateTime" value="<?php echo date('Y-m-d', strtotime($reservation['reservationDateTime'])); ?>" min="<?php echo date('Y-m-d'); ?>" /><br>
    <select name="timeSelect">
      <option>請選擇時間</option>
      <option value="11:30">11:30</option>
      <option value="12:00">12:00</option>
      <option value="12:30">12:30</option>
      <option value="13:00">13:00</option>
      <option value="17:30">17:30</option>
      <option value="18:00">18:00</option>
      <option value="18:30">18:30</option>
      <option value="19:00">19:00</option>
      <option value="19:30">19:30</option>
      <option value="20:00">20:00</option>
    </select><br>
    <select name="menuSelect">
      <option>請選擇用餐方式(必選)</option>
      <option value="1">現場單點</option>
      <option value="2">合菜料理</option>
      <option value="3">無菜單料理</option>
    </select><br>
    <button type="submit">新增</button>
  </form>
  <script>
    fetch("we-receiver.php", {
        method: "POST",
        body: formData,
      })
      .then((response) => {
        if (response.ok) {
          return response.json();
        } else {
          // 處理非 200 OK 的 HTTP 狀態碼
          return response.json().then((data) => {
            throw new Error(`${response.status} - ${data.message}`);
          });
        }
      })
      .then((data) => {
        // 處理成功的情況
        console.log(data.message);
      })
      .catch((error) => {
        console.error("AJAX 請求失敗:", error);
        alert(error.message);
      });
  </script>
</body>

</html>