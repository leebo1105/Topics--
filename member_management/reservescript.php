<script>
  // 點擊外層表單切換中層座位表的顯示狀態
  $(".DateTimebutton").click(function(event) {
    event.stopPropagation(); // 阻止事件冒泡到其他元素

    // 切換中層座位表的顯示狀態
    if ($(".reservationDateTime").is(":visible")) {
      $(".reservationDateTime").hide();
      console.log("隱藏日歷");
    } else {
      $(".reservationDateTime").show();
      console.log("顯示日歷");
    }
  });

  // 點擊 .leftbutton 內的按鈕
  $(".leftbutton button").click(function(event) {
    event.stopPropagation(); // 阻止事件冒泡到其他元素

    // 判斷當前按鈕是否已經有 active 狀態
    if ($(this).hasClass("active")) {
      // 如果已經是 active，則移除 active 狀態
      $(this).removeClass("active");
      // 清空選擇的日期
      $("#selectedDate").text("選擇的日期");
    } else {
      // 如果不是 active，則移除所有按鈕的 active 狀態
      $(".leftbutton button").removeClass("active");
      // 添加當前按鈕的 active 狀態
      $(this).addClass("active");

      // 更新選擇的日期
      const selectedDate = $(this).text().trim();
      const today = new Date();
      let dateToSelect = today;

      if (selectedDate === "明天") {
        dateToSelect.setDate(today.getDate() + 1);
      }

      if (dateToSelect.getDay() === 1) {
        alert("很抱歉,星期一為公休日，都不對外開放預約。請選擇其他日期。");
        $(this).removeClass("active");
        $("#selectedDate").text("選擇的日期");
      } else {
        const isoDate = dateToSelect.toISOString().split('T')[0];
        $("#selectedDate").text(`選擇的日期: ${isoDate}`);
        $("#text3").text(`${isoDate}`);
        $("#text8").text(`${isoDate}`);
      }
    }
  });


  // 點擊外部區域隱藏中層座位表
  $(document).click(function() {
    $(".reservationDateTime").hide();
    console.log("隱藏日歷");
  });

  // 獲取當前時間的 ISO 字符串，格式為 YYYY-MM-DD
  function getCurrentDateISO() {
    const now = new Date();
    const year = now.getFullYear();
    const month = (now.getMonth() + 1).toString().padStart(2, "0"); // 月份從0開始需要加1
    const day = now.getDate().toString().padStart(2, "0");
    return `${year}-${month}-${day}`;
  }

  // 設定日歷中星期一公休日
  document.addEventListener("DOMContentLoaded", function() {
    const dateTimeInput = document.getElementById("reservationDateTime");

    if (dateTimeInput) {
      dateTimeInput.addEventListener("input", function() {
        const selectedDate = new Date(dateTimeInput.value);
        if (selectedDate.getDay() === 1) {
          // 1 表示星期一
          alert("很抱歉,星期一為公休日，都不對外開放預約。請選擇其他日期。");
          dateTimeInput.value = ""; // 清空 reservationDateTime 欄位的值
        } else {
          // 更新選擇的日期
          document.getElementById("selectedDate").textContent = `選擇的日期: ${dateTimeInput.value}`;
        }
      });
    } else {
      console.error("找不到 id 為 'reservationDateTime' 的元素");
    }
  });

  document.addEventListener("DOMContentLoaded", function() {
    const inputElement = document.getElementById("reservationDateTime");

    if (inputElement) {
      inputElement.min = getCurrentDateISO();
    }

    // 監聽 timeSelect 的變化
    const timeSelectElement = document.getElementById("timeSelect");
    timeSelectElement.addEventListener("change", function() {
      // 更新選擇的時間
      document.getElementById("selectedTime").textContent = `選擇的時間: ${timeSelectElement.value}`;
      document.getElementById("text4").textContent = `${timeSelectElement.value}`;
      document.getElementById("text9").textContent = `${timeSelectElement.value}`;
    });

    //監聽 selectedMethod 的變化
    const selectedMethodElement = document.getElementById("menuSelect");
    selectedMethodElement.addEventListener("change", function() {
      // 更新選擇的時間
      document.getElementById("selectedMethod").textContent = `選擇的用餐方式: ${selectedMethodElement.value}`;
      document.getElementById("text5").textContent = `${selectedMethodElement.value}`;
      document.getElementById("text10").textContent = `${selectedMethodElement.value}`;
    });
  });
  // 獲取 .number li 元素
  const numberLis = document.querySelectorAll(".number li");

  // 監聽 .number li 的點擊事件
  numberLis.forEach((li) => {
    li.addEventListener("click", (event) => {
      // 移除所有 li 的 active 類
      numberLis.forEach((item) => {
        item.classList.remove("active");
      });

      // 為當前點擊的 li 添加 active 類
      event.target.classList.add("active");

      // 更新 #peoplecount 、#text2 的值
      document.getElementById("peoplecount").textContent = event.target.textContent;
      document.getElementById("text2").textContent = `${event.target.textContent}人`;
      document.getElementById("text7").textContent = `${event.target.textContent}人`;
    });
  });

  // 獲取 .number li 元素
  const tableschairsLis = document.querySelectorAll(".tables-chairs li");

  // 監聽 .number li 的點擊事件
  tableschairsLis.forEach((li) => {
    li.addEventListener("click", (event) => {
      // 移除所有 li 的 active 類
      tableschairsLis.forEach((item) => {
        item.classList.remove("active");
      });

      // 為當前點擊的 li 添加 active 類
      event.target.classList.add("active");

      // 更新 #numbercount 、#text1 的值
      document.getElementById("numbercount").textContent = event.target.textContent;
      document.getElementById("text1").textContent = event.target.textContent;
      document.getElementById("text6").textContent = event.target.textContent;
    });
  });

  // 函數以檢查所有必填條件是否滿足，並相應地更新 confirmButton 的狀態
  function updateConfirmButtonState() {
    // 檢查 leftbutton button 是否有 active 狀態
    const leftButtonActive = $(".leftbutton button").hasClass("active");

    // 檢查 number li 是否有 active 狀態
    const numberLiActive = $(".number li").hasClass("active");

    // 檢查 tables-chairs li 是否有 active 狀態
    const tablesChairsLiActive = $(".tables-chairs li").hasClass("active");

    // 檢查 menuSelect 是否已選擇
    const menuSelectValue = $("#menuSelect").val();

    // 檢查 timeSelect 是否已選擇
    const timeSelectValue = $("#timeSelect").val();

    // 獲取 confirmButton 元素
    const confirmButton = $("#confirmButton");

    // 如果所有條件都滿足，則將 confirmButton 的樣式更改為 enabled
    if (leftButtonActive && numberLiActive && tablesChairsLiActive && menuSelectValue && timeSelectValue) {
      confirmButton.addClass("enabled");
      confirmButton.prop("disabled", false);
      confirmButton.text("送出預約");
    } else {
      // 如果有任何一個條件不滿足，則將 confirmButton 的樣式更改為 disabled
      confirmButton.prop("disabled", true);
    }
  }

  // 在各種事件處理程序中呼叫函數以更新 confirmButton 的狀態
  $(".leftbutton button, .number li, .tables-chairs li, #menuSelect, #timeSelect").on("click change", function() {
    updateConfirmButtonState();
  });

  // 初始時更新 confirmButton 的狀態
  updateConfirmButtonState();

  // 監聽 confirmButton 點擊事件
  $("#confirmButton").click(function() {
    // 顯示毛玻璃背景
    $("#overlay").fadeIn();
    // 顯示白色正方形區塊
    $("#whiteSquare").fadeIn();
  });

  // 監聽 submitButton 點擊事件
  $("#submitButton").click(function() {
    // 隱藏白色正方形區塊1
    $("#whiteSquare").fadeOut(function() {
      // 在 whiteSquare 隱藏後顯示 whiteSquare2
      $("#whiteSquare2").fadeIn();
      // 提取資料並發送到後台
      var text6 = $("#text6").text();
      var text7 = $("#text7").text();
      var text8 = $("#text8").text();
      var text9 = $("#text9").text();
      var text10 = $("#text10").text();

      $.ajax({
        type: "POST",
        url: "連線傳送資料.php",
        data: {
          text6: text6,
          text7: text7,
          text8: text8,
          text9: text9,
          text10: text10
        },
        success: function(response) {
          console.log("Data submitted successfully");
          console.log(response);
        },
        error: function(xhr, status, error) {
          console.error("Data submission failed");
          console.error(xhr.responseText);
        }
      });
    });
  });

  // 監聽 returnButton 點擊事件
  $("#returnButton").click(function() {
    // 隱藏毛玻璃背景和白色正方形區塊
    $("#overlay").fadeOut();
    $("#whiteSquare").fadeOut();
  });

  // // 監聽 returnHomeButton 點擊事件
  // $("#returnHomeButton").click(function() {
  //   // 隱藏毛玻璃背景和白色正方形區塊2
  //   $("#overlay").fadeOut();
  //   $("#whiteSquare2").fadeOut();
  // });
</script>