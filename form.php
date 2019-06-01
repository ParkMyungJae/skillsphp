<?php
require("db.php");

if (!isset($_SESSION['user'])) {
    $_SESSION['nextPage'] = "form.php";
    msgAndGo("글을 작성하기 위해 로그인 해주세요.", "/login.php");
    exit;
}

$mod = 0; // 글 작성모드
if (isset($_GET['id'])) {
    //글 수정 모드
    $mod = $_GET['id'];
    $sql = "SELECT * FROM boards WHERE id = ?";
    $q = $con->prepare($sql);
    $q->execute([$_GET['id']]);
    $data = $q->fetch(PDO::FETCH_OBJ);

    if (!$data) {
        echo "존재하지 않는 글입니다.";
        exit;
    }

    if ($data->writer != $_SESSION['user']->email && $_SESSION['user']->email != "admin") {
        msgAndBack("권한이 없습니다.");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="ko">
<title>글쓰기/수정</title>

<?php require("head.php"); ?>

<body>
    <?php require("nav.php"); ?>

    <div class="row mt-5 d-flex justify-content-center mw-100">
        <div class="col-md-7 col-sm-12">
            <?php if ($mod == 0) : ?>
                <h1>글쓰기</h1>
            <?php else : ?>
                <h1>글 수정</h1>
            <?php endif ?>
            <div class="mt-3">
                <form class="mt-5" action="/process.php" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <input type="hidden" class="form-control" name="id" value="<?= $mod ?>">
                        제목 :
                        <input type="text" class="form-control" name="title" value="<?= $mod != 0 ? $data->title : "" ?>">
                    </div>
                    <?php
                    $writers = $_SESSION['user']->email;
                    ?>
                    <br>
                    <div class="form-group">
                        글쓴이 : <input type="text" class="form-control" name="writer" value="<?= $mod != 0 ? $data->writer : "$writers" ?>" readonly><br>
                    </div>
                    <div class="form-group">
                        내용 : <br>
                        <textarea name="content" class="form-control" cols="30" rows="15"><?= $mod != 0 ? $data->content : "" ?></textarea>
                    </div>

                    <!-- 글 작성/수정 페이지에서 작성페이지는 현재 파일경로와 파일 변경할 수 있게 표시.. -->
                    <!-- 글 작성/수정 페이지에서 수정페이지는 파일을 등록할 수 있게 등록만 표시. -->
                    <?php if (isset($data->img) != null) : ?>
                        <p>현재 파일 : <?= $data->img ?></p>
                        <p>변경 파일 : <input type="file" name="upload"> <br></p>
                    <?php else : ?>
                        <input type="file" name="upload"> <br></p>
                    <?php endif ?>

                    <br>
                    <div class="col-12 text-right mt-3 mb-5 ml-3">
                        <input type="submit" value="전송" class="btn btn-success">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>