<?php
if (!isset($_SESSION)) {
    # 如果沒有設定 $_SESSION, 才啟動
    session_start();
}
?>
<?php include __DIR__ . './index-parts/index-html-head.php' ?>

<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }

    main {
        flex-grow: 1;
        padding: 15px 5%;
    }

    .container {
        width: 85%;
        margin: 0 auto;
    }

    .titlePage {
        width: 90%;
        height: 400px;
        margin-top: 20%;
        border-radius: 0 0 0 40%;
        margin: auto;
        & img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 0 0 0 40%;
        }
    }

    .jumpdiv {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .jumpbutton {
        width: 350px;
        height: 50px;
        font-size: medium;
        border: 0;
        border-radius: 10px;
        background-color: rgba(176, 214, 229, 1);
    }

    a:hover,
    a:visited,
    a:link,
    a:active {
        text-decoration: none;
    }

    /* Breakpoints */
    @media (min-width: 1024px) {
        .container {
            width: 80%;
        }
    }

    @media (min-width: 1280px) {
        .container {
            width: 70%;
        }
    }

    @media (min-width: 1920px) {
        .container {
            width: 60%;
        }
    }

    /* 針對手機設計的CSS */

    @media (max-width: 375px) {
        nav ul {
            flex-direction: column;
            text-align: center;
        }

        nav li {
            margin-bottom: 0.5rem;
        }
    }

    /* 針對大屏幕設計的CSS */
    @media (min-width: 1920px) {
        body {
            font-size: 1.2rem;
        }

        main {
            padding: 3rem 0;
        }
    }
</style>

<body>
    <?php include __DIR__ . './index-parts/index-navbar.php' ?>
    <!-- 預約規則 -->
    <main>
        <div class="container">
            <div class="titlePage">
                <img src="./img/牡丹樓封面.jpg" class="img-fluid" alt="...">
            </div>
            <h2 class="mt-3 py-3">預約規定</h2>
            <p> 【訂位須知】<br>
                自2023年10月14日(六)起，為維護各位貴賓之訂位權益，預約採「訂位支付訂金」之方式，逾期未付將自動取消訂位，敬請見諒。<br>
                【訂位方式】<br>
                於每月1號上午11:00開放，可預約後2個月場次。[例：3/1起可預約5月場次，依此類推。]<br>
                【收費標準與須知】<br>
                一般訂位可預約2個月場次，每位收取訂金NT$500(含0-12歲兒童)。所支付之訂金可折抵當日消費，並於消費當日開立訂金之發票。訂位日為8日後（含第8日），訂金需於7日內支付完成，如未完成付款，訂位將會自動取消。訂位日為1至7日內（含第7日），訂金需於訂位日2日內支付完成，如未完成付款，訂位將會自動取消。[例：若於10/19預訂，需在10/20結束前完成付款。]<br>
                【退費須知】<br>
                如欲取消訂位，請於於用餐日48小時前取消訂位，訂金將全數退還，退款需14個工作天，若用餐日前48小時內取消，恕訂金不予退還（以上皆不含公告店休日）<br>
                【線上訂位需知】<br>
                1.當日需至現場櫃檯辦理報到，依序排隊入場，敬請見諒。<br>
                2.因桌次有限，訂位後將依現場狀況排桌入席，恕無法指定座位。<br>
                3.本餐廳最大座位數為6人桌，若訂位人數超過5人(含)需分桌。<br>
                4.訂位人數為1人時將依現場狀況安排個人座位或併桌。<br>
                5.如遇特殊節日(農曆春節、母親節...等)，將視訂位狀況收取訂金，餐廳將有專人致電與您聯繫訂金事宜。<br>
                6.開車前往用餐的貴賓還請注意預留充足時間。<br>
                【消費方式】<br>
                1.本餐廳需另加收10%服務費。自備酒水需酌收酒水服務費：葡萄酒每瓶500元，烈酒每瓶1,000元。<br>
                2.訂位保留10分鐘，逾時座位將取消不再另行通知。<br>
                3.餐廳禁帶外食，敬請配合。4.請勿攜帶寵物入內(導盲犬除外，需事先告知)，不便之處敬請見諒。如有未盡事宜，牡丹樓餐廳保留、修改、終止、變更內容細節之權利，且不另行通知。
                如有疑問，請撥打服務專線06-221-7509，如遇忙線請稍後再撥。</p>
            <div class="jumpdiv">
                <button class="jumpbutton">
                    <a href="預約輪播.php">前往預約系統</a>
                </button>
            </div>
        </div>
    </main>

    <?php include __DIR__ . './index-parts/index-scripts.php' ?>
    <?php include __DIR__ . './index-parts/index-html-foot.php' ?>