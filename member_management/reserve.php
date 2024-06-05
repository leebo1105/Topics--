<?php
if (!isset($_SESSION)) {
  # 如果沒有設定 $_SESSION, 才啟動
  session_start();
}
?>
<?php include __DIR__ . './index-parts/index-html-head.php' ?>
<style>
  
  /* overlay 毛玻璃效果背景 */
  .overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    backdrop-filter: blur(3px);
    /* 毛玻璃效果 */
    z-index: 999;
    /* 確保覆蓋在白色方塊之上 */
    display: none;
    /* 默認隱藏 */
  }

  /* whiteSquare 白色正方形區塊 */
  .white-square {
    position: fixed;
    top: 50%;
    /* 垂直居中 */
    left: 50%;
    /* 水平居中 */
    width: 250px;
    height: 300px;
    border-radius: 10px;
    background-color: white;
    /* 白色背景 */
    z-index: 1000;
    /* 確保覆蓋在 overlay 之上 */
    transform: translate(-50%, -50%);
    /* 將中心點設置為正方形中心 */
    display: none;
    /* 默認隱藏 */
    & .returnButton:hover {
      text-decoration: underline;
    }
  }
  .inquireDiv {
    
    width: 500px;
    height: 300px;
    border-radius: 10px;
    background-color: white;
    /* 白色背景 */
  }

  .inquirePhoto {
    max-width: 250px;
    height: 300px;
    object-fit:cover;
  }
  .white-square3 {
    width: 250px;
    height: 300px;
    border-radius: 10px;
    background-color: white;
    /* 白色背景 */
  }
  .reservationphoto {
    display: flex;
    justify-content: center;
    margin-top: 80px;
    /* 增加 margin-top 來避免與 navbar 重疊 */
  }

  .tablesouter {
    width: 80%;
    margin: auto;
  }

  .tablesdiv {
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .tables-chairs {
    display: flex;
    flex-wrap: wrap;
    padding: 0;
    list-style: none;

    & li {
      width: 80px;
      height: 80px;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 5px;
      border-radius: 50%;
      border: 4px solid black;
    }

    & li:hover {
      border: 4px solid rgba(231, 175, 47, 1);
      transition: 0.3s;
      cursor: pointer;
    }

    & li.active {
      border: 4px solid rgba(231, 175, 47, 1);
    }
  }

  .numberouter {
    width: 80%;
    margin: auto;
  }

  .numberdiv {
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .number {
    display: flex;
    flex-wrap: wrap;
    padding: 0;
    list-style: none;

    & li {
      width: 80px;
      height: 80px;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 5px;
      border-radius: 50%;
      border: 4px solid black;
    }

    & li:hover {
      border: 4px solid rgba(231, 175, 47, 1);
      transition: 0.3s;
      cursor: pointer;
    }

    & li.active {
      border: 4px solid rgba(231, 175, 47, 1);
    }
  }

  .central {
    width: 80%;
    height: auto;
    display: flex;
    justify-content: space-evenly;
    margin: auto;
  }

  .leftbutton {
    width: 30%;
    height: auto;
  }

  .leftbutton button {
    cursor: pointer;
  }

  .leftbutton button.active {
    background-color: rgba(231, 175, 47, 1);
    color: #fff;
  }

  .rightselect {
    width: 30%;
    height: auto;
  }

  .reservetextarea {
    width: 80%;
    height: auto;
    margin: auto;
  }

  .confirmButtondiv {
    display: flex;
    justify-content: center;

    & button {
      background: linear-gradient(to right, rgba(0, 0, 0, 0.5), rgba(231, 175, 47, 1));
      color: rgba(231, 175, 47, 1);
    }

    & button.enabled {
      background: rgba(231, 175, 47, 1);
      color: #fff;
      cursor: pointer;
    }
  }

  .reservationDateTime {
    display: none;
  }

  .linearbg {
    width: 100vw;
    height: 100vh;
    background-color: rgba(0, 0, 0, 0.5);
  }
</style>
<?php include __DIR__ . './index-parts/index-navbar.php' ?>
<div class="container">
  <!-- 毛玻璃背景 -->
  <div id="overlay" class="overlay"></div>
  <!-- 白色正方形區塊1 -->
  <div id="whiteSquare" class="white-square">
    <h4 class="text-center mt-3">確認您的預約資訊</h4>
    <div class="d-flex justify-content-between">
      <div class="lh-lg mx-3">
        桌型:<br>
        人數:<br>
        日期:<br>
        時間:<br>
        用餐方式:
      </div>
      <div class="lh-lg mx-3">
        <span id="text1">0人桌</span><br>
        <span id="text2">0人</span><br>
        <span id="text3">日期</span><br>
        <span id="text4">時間</span><br>
        <span id="text5">用餐方式</span>
      </div>
    </div>
    <div class="d-flex flex-column mb-3">
      <button type="submit" id="submitButton" class="btn btn-warning w-50 mx-auto">確認送出</button>
      <button type="button" id="returnButton" class="btn returnButton" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">上一頁</button>
    </div>
  </div>
  <!-- 白色正方形區塊2 -->
  <div id="whiteSquare2" class="white-square">
    <h4 class="text-center mt-3">預約成功</h4>
    <div class="d-flex justify-content-between">
      <div class="lh-lg mx-3">
        桌型:<br>
        人數:<br>
        日期:<br>
        時間:<br>
        用餐方式:
      </div>
      <div class="lh-lg mx-3">
        <span id="text6">0人桌</span><br>
        <span id="text7">0人</span><br>
        <span id="text8">日期</span><br>
        <span id="text9">時間</span><br>
        <span id="text10">用餐方式</span>
      </div>
    </div>
    <div class="d-flex flex-column mb-3">
      <button type="button" id="returnHomeButton" class="btn btn-warning w-50 mx-auto mt-3"><a href="/Topics/member_management/%E9%A0%90%E7%B4%84%E6%9F%A5%E8%A9%A2%E5%89%8D%E5%8F%B0.php">返回首頁</a></button>
    </div>
  </div>
  <section class="mb-4">
    <div class="reservationphoto ">
      <img src="./img/2.png" class="img-fluid" alt="...">
    </div>
  </section>
  <main>
    <!-- flex 平均分散在容器中 加入下border -->
    <!-- <div class="d-flex justify-content-evenly mb-3 border-bottom ">
    <div class="p-2">預約</div>
    <div class="p-2">menu</div>
    <div class="p-2">review</div>
    <div class="p-2">detail</div>
  </div> -->
    <div class="numberouter">
      <div>
        <i class="bi bi-person-fill">預約人數:</i>
        <span id="peoplecount">0</span>人
      </div>
    </div>
    <div class="numberdiv">
      <!-- 更改為圓形 取消預設樣式 flex-->
      <!-- 左箭頭 -->
      <i class="bi bi-chevron-left"></i>
      <ul class="number">
        <li numberId="1">1</li>
        <li numberId="2">2</li>
        <li numberId="3">3</li>
        <li numberId="4">4</li>
        <li numberId="5">5</li>
        <li numberId="6">6</li>
        <li numberId="7">7</li>
        <li numberId="8">8</li>
        <li numberId="9">9</li>
        <li numberId="10">10</li>
        <li numberId="11">11</li>
        <li numberId="12">12</li>
      </ul>
      <!-- 右箭頭 -->
      <i class="bi bi-chevron-right"></i>
    </div>
    <!-- 加入上下border flex between -->
    <div class="d-flex justify-content-around border-bottom border-top mb-3">
      <div class="p-2" id="selectedDate">選擇的日期</div>
      <div class="p-2" id="selectedMethod">選擇的用餐方式</div>
      <div class="p-2" id="selectedTime">選擇的時間</div>
    </div>
    <div class="central">
      <div class="d-flex flex-column mb-3 leftbutton">
        <button type="button" class="btn btn-light  p-3 mb-3">今天</button>
        <button type="button" class="btn btn-light  p-3 mb-3">明天</button>
        <button type="button" class="btn btn-light DateTimebutton p-3 mb-3">選擇預約日期：<i class="bi bi-calendar-date-fill"></i></button>
        <!-- 按選取日期才浮現選擇器 -->
        <form action="">
          <label for="reservationDateTime"></label>
          <input type="date" id="reservationDateTime" class="reservationDateTime" name="reservationDateTime" required />
        </form>
      </div>
      <div class="d-flex flex-column mb-3 mt-3 rightselect">
        <div>
          <form method="post" action="連線傳送資料.php">
            <select id="menuSelect" name="menuSelect" class="form-select  mt-4 mb-3 " aria-label="Default select example required">
              <option selected disabled>請選擇用餐方式(必選)</option>
              <option value="現場單點" required>現場單點</option>
              <option value="合菜料理" required>合菜料理</option>
              <option value="無菜單料理" required>無菜單料理</option>
            </select>
          </form>
        </div>
        <!-- 上下箭頭排列為上跟下 -->
        <!-- <i class="bi bi-chevron-up"></i>
        <i class="bi bi-chevron-down"></i> -->
        <div>
          <form method="post" action="連線傳送資料.php">
            <select id="timeSelect" name="timeSelect" class=" form-select  mb-3 mt-3" aria-label="Large select example" required>
              <option selected disabled>請選擇時間(必選)</option>
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
            </select>
          </form>
        </div>
      </div>
    </div>
    <div class="tablesouter">
      <div>
        <i class="bi bi-house-door">桌型:</i>
        <span id="numbercount">0人桌</span>
      </div>
    </div>
    <div class="tablesdiv">
      <!-- 更改為圓形 取消預設樣式 flex-->
      <!-- 左箭頭 -->
      <i class="bi bi-chevron-left"></i>
      <ul class="tables-chairs">
        <li tableId="1">12人桌</li>
        <li tableId="2">4人桌</li>
        <li tableId="3">4人桌</li>
        <li tableId="4">4人桌</li>
        <li tableId="5">4人桌</li>
        <li tableId="6">4人桌</li>
        <li tableId="7">4人桌</li>
        <li tableId="8">2人桌</li>
        <li tableId="9">2人桌</li>
      </ul>
      <!-- 右箭頭 -->
      <i class="bi bi-chevron-right"></i>
    </div>
    <div class="reservetextarea">
      <span>
        <i class="bi bi-pencil-square">備註:</i>
      </span>
      <div class="form-floating py-2 ">
        <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
        <label for="floatingTextarea2">留下任何你想說的~</label>
      </div>
      <!-- 加入按鈕外框線 -->
      <div class="confirmButtondiv">
        <button type="button" id="confirmButton" class="btn btn-warning shadow mb-3 mt-3 px-5 ">尚未填寫完成</button>
      </div>
    </div>
  </main>
</div>

<?php include __DIR__ . './index-parts/index-scripts.php' ?>
<?php include __DIR__ . '/reservescript.php' ?>
<?php include __DIR__ . './index-parts/index-html-foot.php' ?>