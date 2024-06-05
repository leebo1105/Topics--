<?php
if (!isset($_SESSION)) {
    # 如果沒有設定 $_SESSION, 才啟動
    session_start();
}

require __DIR__ . '/config/pdo-connect.php';

$sql = "SELECT * FROM articles ORDER BY date DESC";
$row = $pdo->query($sql)->fetchAll();

// 從資料庫中獲取留言資料
$sql = "SELECT * FROM comments ORDER BY c_id DESC";
$comments = $pdo->query($sql)->fetchAll();

foreach ($comments as &$comment) {
    $comment['created_at'] = date('Y-m-d', strtotime($comment['created_at']));
}
?>
<?php include __DIR__ . './index-parts/index-html-head.php' ?>
<style>
    /* 初始状态为隐藏 */
    .fade-in-text {
        opacity: 0;
        transition: opacity 1.1s ease-in-out;
    }

    /* 显示状态 */
    .fade-in-text.visible {
        opacity: 1;
    }

    /* 逐字显示效果 */
    .typewriter {
        display: inline-block;
        overflow: hidden;
        /* 隐藏超出的内容 */
        border-right: .15em solid orange;
        /* 添加闪烁的竖线 */
        white-space: nowrap;
        /* 避免文字换行 */
        margin: 0 auto;
        /* 居中显示 */
        font-size: 1.5em;
        /* 设置字体大小 */
        animation: typing 3.5s steps(40, end);
    }

    @keyframes typing {
        from {
            width: 0
        }

        to {
            width: 100%
        }
    }

    /* 字体颜色变化效果 */
    .color-change {
        animation: color-change 5s infinite alternate;
    }

    @keyframes color-change {
        0% {
            color: red;
        }

        50% {
            color: blue;
        }

        100% {
            color: green;
        }
    }

    /* 最新消息 */
    .news {
        width: 900px;
        border-radius: 20px;
    }


    .news-list {
        transition: transform 0.3s ease;
    }

    .news-list:hover {
        box-shadow: 0 0 11px rgba(33, 33, 33, .3);
        transform: scale(1.08);
        background-color: white;
        padding: 10px;
    }

    /* 超連結 */
    a {
        color: inherit;
        text-decoration: inherit;
        cursor: inherit;
        cursor: pointer;
    }

    .message-board {
        background-color: #366e53;
        width: 800px;
        padding: 20px;
        border-radius: 20px;
        color: white;
        box-shadow: 10px 10px 20px black;
    }

    .score {
        display: inline-flex;
        flex-direction: row-reverse;
        font-size: 48px;
    }

    .score>label {
        user-select: none;
    }

    .score>label:after {
        content: '☆';
    }

    .score>label:hover {
        cursor: pointer;
    }

    .score>label:hover:after {
        content: '★';
        color: gold;
    }

    .score>label:hover~label:after {
        content: '★';
        color: gold;
    }

    .score>input {
        display: none;
    }

    .score>input:checked+label:after {
        content: '★';
        color: gold;
    }

    .score>input:checked~label:after {
        content: '★';
        color: gold;
    }

    .comment-board {
        font-size: 24px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        /* 內容水平置中 */
        align-items: center;
        /* 內容垂直置中 */
        text-align: center;
        /* 文字置中 */
        margin-bottom: 10px;
        /* 每條評論之間的間距 */

    }

    .comment-content {
        font-size: 24px;
        margin-bottom: 10px;
        /* 每條評論之間的間距 */
        background-color: white;
        color: black;
        border-radius: 10px;
        height: 200px;
        padding: 10px;

    }

    .comment-star {
        font-size: 36px;
        margin-bottom: 10px;
        /* 每條評論之間的間距 */
        display: flex;
        justify-content: space-evenly;
    }

    .comments {
        text-align: left;
        /* 讓文字靠左對齊 */
        margin-bottom: 20px;
        /* 每條評論之間的間距 */
        background-color: #366e53;
        border-radius: 20px;
        color: black;
        padding: 10px;
        padding: 20px;
        box-shadow: 10px 10px 20px black;
        width: 800px;
    }

    .comment-star>label {
        user-select: none;
        color: gold;
        /* 實心星星和空心星星的顏色 */
        font-size: 36px;
        /* 調整星星大小 */
        margin: 0 2px;
        /* 星星之間的間距 */
    }

    .comment-content>.content {
        margin-top: 10px;
    }

    .container>button {
        margin: 0 10px;
        /* 左右箭頭的間距 */
    }

    .message-section {
        background-image: url(mudanlow-小圖檔/DSC00576.jpg);
        background-size: 1920px 1080px;
    }

    .comment-section {
        background-image: url(mudanlow-小圖檔/DSC00583.jpg);
    }

    .news-section {
        background-image: url(mudanlow-小圖檔/DSC00567.jpg);
    }

    .comment-btn {
        width: 120px;
        border-radius: 30px;
        background-color: #366e53;
        color: white;
    }


    @media (max-width: 540px) {
        .comments {
            width: 100%;
            padding: 10px;
            font-size: 16px;
        }

        .comment-star {
            font-size: 16px;
        }

        .comment-content {
            font-size: 12px;
        }
        .news-list{
            font-size: 12px;
        }
    }

    @media (min-width: 541px) and (max-width: 720px) {
        .comments {
            width: 400px;
            padding: 15px;
            font-size: 18px;
        }

        .comment-star {
            font-size: 28px;
        }

        .comment-content {
            font-size: 18px;
        }
        .news-list{
            font-size: 18px;
        }
    }

    @media (min-width: 721px) and (max-width: 960px) {
        .comments {
            width:  600px;
            padding: 20px;
            font-size: 20px;
        }

        .comment-star {
            font-size: 32px;
        }

        .comment-content {
            font-size: 20px;
        }
    }

    @media (min-width: 961px) and (max-width: 1140px) {
        .comments {
            width: 800px;
            padding: 25px;
            font-size: 22px;
        }

        .comment-star {
            font-size: 36px;
        }

        .comment-content {
            font-size: 22px;
        }
    }
</style>
<?php include __DIR__ . './index-parts/index-navbar.php' ?>
<header class="masthead">
    <div class="container px-4 px-lg-5 h-100 p-5">
        <div class="row gx-4 gx-lg-5 h-100 align-items-center justify-content-center text-center">
            <div class="col-lg-8 align-self-end">
                <h1 class="text-white font-weight-bold">牡丹樓中菜</h1>
                <hr class="divider" />
            </div>
            <div class="col-lg-8 align-self-baseline">
                <p class="text-white-75 mb-5">以「家」為靈感，充滿家庭溫暖的美味佳餚，讓您感受到家的溫馨，享受賓至如歸的服務。</p>
                <a class="btn btn-primary btn-xl" href="#about">立即品嚐!</a>
            </div>
        </div>
    </div>
</header>



<!-- About-->
<section class="page-section bg-primary p-5 " id="about">
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-lg-8 text-center fade-in-text">
                <h2 class="text-white mt-0 ">起源/宗旨</h2>
                <hr class="divider divider-light " />
                <p class="text-white-75 mb-4">
                    2016年春天，一家名為「牡丹樓中式料理」的小店開始了它的故事。<br>
                    在店主邱小姐心中，家始終是最溫暖的地方，而食物是家的象徵。於是，他決定開設一家以家為靈感的中國傳統料理餐廳，希望能將家的溫馨帶給每一位客人。<br>
                    從開店至今，我們相信，每一位客人都是家人，應該被以真誠和溫暖來對待。無論是簡單的問候還是精心的服務，他都希望能讓顧客在牡丹樓感受到家的溫馨，便將「顧客至上」作為店家的宗旨。<br>
                    每一道餐點都蘊含著我們對家的深情，每一位客人都被真誠和溫暖所包圍。<br>
                    牡丹樓的故事將繼續延續下去，帶給更多人家的溫馨與美味。
                </p>
                <a class="btn btn-light btn-xl fade-in-text" href="#services">登入/註冊</a>
            </div>
        </div>
    </div>
</section>
<!-- Services-->
<section class="page-section" id="services">
    <div class="container px-4 px-lg-5 p-5">
        <h2 class="text-center mt-0">餐點預覽</h2>
        <hr class="divider" />
        <div class="SlideMediaBox">這邊是SlideMediaBox</div>
    </div>
</section>

<section class="container-fluid d-flex justify-content-center my-3 news-section ">
    <div class="news p-4 bg-light m-3">
        <div class="border-bottom border-dark">
            <h1 class="title">最新消息</h1>
        </div>
        <div class=" bg-light ">
            <ul class=" list-unstyled">
                <?php foreach (array_slice($row, 0, 5) as $r) : ?>
                    <li class="news-list">
                        <div class=" border-bottom border-dark row align-items-center py-3 list">
                            <div class="col-4">
                                <div class="text-secondary"><?= $r['date'] ?></div>
                                <div class="fw-bolder"><?= $r['title'] ?></div>
                            </div>
                            <div class="col-7"><?= strlen($r['content']) > 70 ? substr($r['content'], 0, 70) . '...' : $r['content'] ?></div>
                            <div class="col-1"><a href="./news-content.php?a_id=<?= $r['a_id'] ?> " title="arrows icons"><i class="fa-solid fa-chevron-right fa-xl" style="color: black;"></i></a></div>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="position-relative p-2">
            <nav class="buttons position-absolute bottom-0 end-0"><a class="more-btn" href="./news-list.php" data-button="more">MORE...</a></nav>
        </div>
    </div>
</section>


<!-- Portfolio-->
<div id="portfolio">
    <div class="container-fluid p-0">
        <div class="row g-0">
            <div class="col-lg-4 col-sm-6">
                <a class="portfolio-box" href="" title="Project Name">
                    <img class="img-fluid" src="assets/img/portfolio/thumbnails/1.jpg" alt="..." />
                    <div class="portfolio-box-caption">
                        <div class="project-category text-white-50">menu</div>
                        <div class="project-name">主打菜色名</div>
                    </div>
                </a>
            </div>
            <div class="col-lg-4 col-sm-6">
                <a class="portfolio-box" href="assets/img/portfolio/fullsize/2.jpg" title="Project Name">
                    <!-- 底圖更改為主色系 -->
                    <img class="img-fluid" src="assets/img/portfolio/thumbnails/2.jpg" alt="..." />
                    <div class="portfolio-box-caption">
                        <div class="project-category text-white-50">目前候位人數</div>
                        <div class="project-name">40</div>
                    </div>
                </a>
            </div>

            <div class="col-lg-4 col-sm-6">
                <a class="portfolio-box" href="人才招募網址" title="Project Name">
                    <!-- 這裡放看起來很人才的圖片 -->
                    <img class="img-fluid" src="assets/img/portfolio/thumbnails/4.jpg" alt="..." />
                    <div class="portfolio-box-caption">
                        <div class="project-category text-white-50">俊杰自拍照</div>
                        <div class="project-name"></div>
                    </div>
                </a>
            </div>

        </div>
    </div>
</div>
<!-- Call to action-->

<!-- Contact-->
<!-- Contact-->
<section class="container-fluid d-flex justify-content-center align-item-center py-5 message-section ">
    <div class="row gx-4 gx-lg-5 m-3 justify-content-center message-board flex-column align-items-center">
        <div class="col-lg-8 col-xl-6 text-center mb-3">
            <h2>寫下你想說的話吧~</h2>
        </div>
        <div class="col-lg-8 col-xl-6 text-center mb-3">
            <label for="">請給我們評分:</label>
            <form id="message" onsubmit="sendData(event)">
                <div class="score">
                    <input type="radio" name="value" id="score5" value="5" />
                    <label class="star" for="score5"></label>

                    <input type="radio" name="value" id="score4" value="4" />
                    <label class="star" for="score4"></label>

                    <input type="radio" name="value" id="score3" value="3" />
                    <label class="star" for="score3"></label>

                    <input type="radio" name="value" id="score2" value="2" />
                    <label class="star" for="score2"></label>

                    <input type="radio" name="value" id="score1" value="1" />
                    <label class="star" for="score1"></label>
                </div>
                <div class="mb-3">
                    <label class="form-label">輸入內容:</label>
                    <textarea class="form-control" id="textContent" name="content" rows="5"></textarea>
                </div>
                <button class="btn btn-light" type="submit">送出</button>
            </form>
        </div>
    </div>
</section>
<section class="container-fluid d-flex justify-content-center align-item-center py-5 comment-section ">
    <div class="col-lg-8 col-xl-6 text-center mb-3 comment-board m-3 ">
        <div class="row align-items-center">
            <ul class="list-unstyled" id="comment-list">
                <!-- 迭代顯示留言 -->
                <?php foreach ($comments as $comment) : ?>
                    <li class="comments ">
                        <h2 class="text-center text-light">留言板</h2>
                        <!-- 顯示留言的內容和評分 -->
                        <div class="text-light">編號: <?= $comment['c_id'] ?></div>
                        <label class="text-light">評分:</label>
                        <div class="comment-star text-center">
                            <?php
                            $score = $comment['value'];
                            // 根據評分值決定哪些星星應該被選中
                            for ($i = 1; $i <= 5; $i++) {
                                $star = ($i <= $score) ? '★' : '☆';
                                echo '<label class="star">' . $star . '</label>';
                            }
                            ?>
                        </div>
                        <label class="text-light">內容:</label>
                        <div class="comment-content"><?= htmlspecialchars($comment['content']) ?></div>
                        <div class="text-light">留言時間: <?= $comment['created_at'] ?></div>
                    </li>
                <?php endforeach; ?>
                <div class="d-flex justify-content-between">
                    <div class="col-auto">
                        <button class="prev  comment-btn"><i class="bi bi-caret-left-fill"></i></button>
                    </div>
                    <div class="col-auto">
                        <button class="next comment-btn"><i class="bi bi-caret-right-fill"></i></button>
                    </div>
                </div>
            </ul>
        </div>
    </div>
</section>
<?php include __DIR__ . './index-parts/index-scripts.php' ?>
<script>
    const sendData = e => {
        e.preventDefault(); //定義表單送出動作


        const fd = new FormData(document.getElementById('message'));

        fetch('add-comment-api.php', {
                method: 'POST', //用post
                body: fd,
            })
            .then(r => r.json()) //資料是json格式
            .then(data => {
                console.log(data); //console log 出新增資料
                //驗證對錯並顯示提示框
                if (data.success) {
                    alert('成功送出！');
                } else {
                    console.log(`資料新增失敗`);
                }
            }).catch(ex => {
                console.log(`fetch() 發生錯誤, 回傳的 JSON 格式是錯的`);
                console.log(ex);
            })
        setTimeout(function() {
            window.location.reload(); // 重整頁面
        }, 1000);
    }


    document.addEventListener('DOMContentLoaded', function() {
        const commentList = document.getElementById('comment-list');
        const comments = commentList.querySelectorAll('.comments');
        let index = 0;

        // 隱藏除了第一條以外的留言
        for (let i = 1; i < comments.length; i++) {
            comments[i].style.display = 'none';
        }

        document.querySelector('.prev').addEventListener('click', function() {
            comments[index].style.display = 'none';
            index = (index === 0) ? comments.length - 1 : index - 1;
            comments[index].style.display = 'block';
        });

        document.querySelector('.next').addEventListener('click', function() {
            comments[index].style.display = 'none';
            index = (index === comments.length - 1) ? 0 : index + 1;
            comments[index].style.display = 'block';
        });
    });
</script>
<script src="./js/top.js"></script>
<div id="backToTop" class="back-to-top">
    <i class="fas fa-arrow-up"></i>
</div>
<?php include __DIR__ . './index-parts/index-html-foot.php' ?>