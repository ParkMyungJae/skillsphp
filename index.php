<?php require('db.php');?>

<!DOCTYPE html>
<html lang="ko">
<title>오늘의 게시판</title>
<?php require("head.php"); ?>

<body>
    <?php require("nav.php"); ?>

    <div class="container">
        <div class="row mt-4 d-flex justify-content-center">
            <div class="col-md-10 col-sm-12">
                <div class="jumbotron" style="background-image: url('./board.jpg'); background-size: 992px 430px; background-position: center center; background-repeat: no-repeat; color: white;">
                    <h1 class="display-4 pl-5">오늘의 게시판s</h1>
                    <p class="lead pl-5">양디고 게시판!! 아무말 대잔치~~ 노래위주 게시판!! `` 강촌사람들 리메이크 모음집 ``</p>
                    <hr class="my-4">
                    <div class="text-right pr-5">
                        <p>7080 Folk song♬</p>
                    </div>
                    <div class="text-right pr-5">
                        <a class="btn btn-outline-light mt-2" href="/list.php" role="button">게시판 보기</a>
                    </div>

                </div>
            </div>
        </div>
    </div>

</body>
</html>
<!-- 10.104.104.125:9090 -->