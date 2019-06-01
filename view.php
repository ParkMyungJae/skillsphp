<?php
require("db.php");

$sql = "SELECT * FROM boards WHERE id = ?";

$q = $con->prepare($sql);

if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    echo "잘못된 접근입니다.";
    exit;
}

$q->execute([$id]);
$data = $q->fetch(PDO::FETCH_OBJ);

if (!$data) {
    echo "존재하지 않는 글입니다.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="ko">
<title>게시판 보기</title>

<?php require("head.php"); ?>

<body>
    <?php require("nav.php"); ?>

    <div class="container">
        <div class="row mt-5 d-flex justify-content-center mb-5">
            <div class="card py-4 mb-5 pb-5" style="width: 1200px; word-break:break-all; box-shadow: 1px -1px 1px 1px rgba(0,0,0,0.1); border-radius: 18px;">
                <div class="card-header p-4" style="margin-top: -24px; border-radius: 18px;">
                    <h1><?= $data->id ?> . <?= $data->title ?></h1>
                </div>
                <div class="card-body p-4">
                    <div class="card-text lead px-4">
                        <?php if ($data->img != null) : ?>
                            <img src="/<?= $data->img ?>" alt="첨부이미지"><br><br><br>
                        <?php endif; ?>
                        <?= nl2br(htmlentities($data->content)) ?>
                    </div>
                </div>

                <div class="text-right mr-5 mt-4">
                    <?php if(isset($_SESSION['user'])) : ?>
                        <?php if ($data->writer == $_SESSION['user']->email || $_SESSION['user']->email == "admin") : ?>
                        <a class="btn btn-outline-warning" href="/form.php?id=<?= $data->id ?>"> 수정하기</a>
                        <a class="btn btn-outline-danger" href="/delete.php?id=<?= $data->id ?>">삭제</a>
                        <?php endif; ?>
                    <?php endif; ?>
                    <a class="btn btn-outline-info" href="/list.php">목록 보기</a>
                </div>

            </div>
        </div>
    </div>
</body>

</html>