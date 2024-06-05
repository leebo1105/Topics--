<?php
require __DIR__ . '/config/pdo-connect.php';

$sid = isset($_GET['a_id']) ? intval($_GET['a_id']) : 0;

if (empty($sid)) {
    header('Location: newarticle.php');
    exit; # 結束 php 程式, die()
}

$sql = "SELECT * FROM articles WHERE a_id=$sid";
$row = $pdo->query($sql)->fetch();

# 如果沒有這個編號的資料, 轉向回列表頁
if (empty($row)) {
    header('Location: newarticle.php');
    exit; # 結束 php 程式, die()
}
/*
header('Content-Type: application/json');
echo json_encode($row);
exit;
*/
$title = '編輯文章';

# 處理既有的照片, 原來的資料是 JSON
$row['photos'] = json_decode($row['photos'], true);

//echo json_encode($row['photos']);

?>
<?php include __DIR__ . '/parts/head.php' ?>
<?php include __DIR__ . '/parts/navbar.php' ?>

<style>
    .my-card {
        position: relative;
        display: inline-block;
        margin: 10px 0;
    }

    .cover-img {
        max-width: 200px;
        object-fit: contain;
        border-radius: 10px;
        border: 2px solid gray;
    }

    .image-remove {
        color: black;
        font-size: 25px;
        width: 25px;
        height: 25px;
        cursor: pointer;
        right: 1px;
        position: absolute;
    }
</style>
<div class="content">
    <h3>文章修改:</h3>
    <div class="articles-form">
        <div class="container">
            <div class="row">
                <div class="col-9">
                    <div class="card-body">
                        <h5 class="card-title">編輯資料</h5>
                        <form name="form1" onsubmit="sendData(event)">
                            <input type="hidden" name="a_id" value="<?= $row['a_id'] ?>">
                            <div class="mb-3">
                                <label for="name" class="form-label">文章編號:</label>
                                <input type="text" class="form-control" value="<?= $row['a_id'] ?>" disabled>
                            </div>
                            <div class="mb-3">
                                <label for="date" class="form-label">日期:</label>
                                <input type="date" class="form-control" id="date" name="date" value="<?= $row['date'] ?>">
                                <div class="form-text"></div>
                            </div>
                            <div class="mb-3">
                                <label for="title" class="form-label">標題:</label>
                                <input type="text" class="form-control" id="title" name="title" value="<?= $row['title'] ?>">
                            </div>
                            <div class="mb-3">
                                <label for="content" class="form-label">內文:</label>
                                <textarea class="form-control" id="content" name="content" rows="3"><?= $row['content'] ?></textarea>
                            </div>
                            <div>
                                <select class="form-select" aria-label="Default select example" name="key_word_id" id="key_word_id">
                                    <option value="2" <?= ($row['key_word_id'] == 2) ? 'selected' : ''; ?>>新菜消息</option>
                                    <option value="3" <?= ($row['key_word_id'] == 3) ? 'selected' : ''; ?>>節慶活動</option>
                                    <option value="4" <?= ($row['key_word_id'] == 4) ? 'selected' : ''; ?>>公休時間</option>
                                    <option value="5" <?= ($row['key_word_id'] == 5) ? 'selected' : ''; ?>>貓咪認養</option>
                                </select>
                            </div>

                            <div class="d-flex justify-content-between">
                                <div class="mb-3 py-2 ">
                                    <button class="btn btn-secondary" type="button" onclick="photosField.click()">上傳圖片</button>
                                    <input type="hidden" name="photos" value="<?= empty($row['photos']) ? '[]' : htmlentities(json_encode($row['photos'])) ?>">
                                    <div class="row">
                                        <div style="display: flex; flex-wrap: wrap;" id="photo_container">
                                            <?php /*
                      <?php foreach ($row['photos'] as $p) : ?>
                        <div class="my-card">
                        <img src="./../uploads/<?= $p ?>" alt="">
                        </div>
                        <?php endforeach; ?>
                        */ ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="py-2">
                                    <button type="submit" class="btn btn-secondary">修改</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">資料修改結果</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-success" role="alert">
                    資料修改成功
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">繼續修改</button>
                <a href="newarticle.php" class="btn btn-primary">到列表頁</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel2">資料修改結果</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger" role="alert">
                    資料沒有修改
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">繼續修改</button>
                <a href="newarticle.php" class="btn btn-primary">到列表頁</a>
            </div>
        </div>
    </div>
</div>

<!-- 上傳圖檔的表單 -->
<form name="upload_form1" hidden>
    <input type="file" name="photos[]" multiple accept="image/*" />
</form>

<?php include __DIR__ . '/parts/script.php' ?>
<script>
    const sendData = e => {
        e.preventDefault();

        const fd = new FormData(document.form1); // 建立一個只有資料的表單物件

        fetch('edit-api.php', {
                method: 'POST',
                body: fd, // 預設的 Content-Type: multipart/form-data
            })
            .then(r => r.json())
            .then(data => {
                console.log(data);
                if (data.success) {
                    myModal.show();
                } else {
                    myModal2.show();
                }
            }).catch(ex => {
                console.log(`fetch() 發生錯誤, 回傳的 JSON 格式是錯的`);
                console.log(ex);
            })
    }

    const myModal = new bootstrap.Modal('#exampleModal');
    const myModal2 = new bootstrap.Modal('#exampleModal2');

    const photoTpl = (filename, index) => `
    <div class="my-card">
      <img src="../uploads/${filename}" alt="" class="cover-img">
      <span class="image-remove" onclick="removeImage(<?php echo $row['a_id']; ?>, '${filename}')"><i class="fa-solid fa-circle-xmark"></i></span>
    </div>
    `
    const removeImage = (a_id, filename) => {
        if (confirm("確定要刪除這張圖片嗎？")) {
            // 執行刪除前端圖片的請求
            fetch('delete-image.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        a_id: a_id,
                        filename: filename
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // 成功刪除前端圖片
                        console.log('圖片從前端成功刪除');

                        // 執行刪除後端圖片的請求
                        fetch('delete-photos.php', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/x-www-form-urlencoded'
                                },
                                body: 'filename=' + encodeURIComponent(filename)
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    // 在這裡處理後續的操作，例如更新 UI
                                    console.log('圖片從資料庫成功刪除');

                                    // 更新 UI（例如重新加載頁面）
                                    window.location.reload();
                                } else {
                                    console.error('刪除後端圖片失敗');
                                }
                            })
                            .catch(error => {
                                console.error('刪除後端圖片時出現錯誤：', error);
                            });
                    } else {
                        console.error('刪除前端圖片失敗');
                    }
                })
                .catch(error => {
                    console.error('刪除前端圖片時出現錯誤：', error);
                });
        }
    };



    // php 把資料轉換成 JSON 變成 JS
    const row = <?= json_encode($row) ?>;
    let photos = row.photos;

    const genPhotos = () => {
        let str = '';
        for (let i = 0; i < photos.length; i++) {
            str += photoTpl(photos[i], i);
        }
        photo_container.innerHTML = str;
    };
    genPhotos();
    const photosField = document.upload_form1.elements[0];
    photosField.addEventListener("change", (event) => {
        const fd = new FormData(document.upload_form1);
        fetch("upload-multiple.php", {
                method: "POST",
                body: fd,
            })
            .then((r) => r.json())
            .then((result) => {

                if (result.files?.length) {
                    photos = [...photos, ...result.files];
                    document.form1.photos.value = JSON.stringify(photos);
                    genPhotos();
                }
            });
    });
</script>
<?php include __DIR__ . '/parts/footer.php' ?>