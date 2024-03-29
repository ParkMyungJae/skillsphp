<?php
require("db.php");

$page = isset($_GET['p']) ? $_GET['p'] : 1;

if (!is_numeric($page)) $page = 1;

$sql = "SELECT COUNT(*) AS cnt FROM boards";
$data = fetch($con, $sql);
$totalCnt = $data->cnt;
$ppn = 15; //페이지당 글의 수
$totalPage = ceil($totalCnt / $ppn);

$cpp = 6; // 챕터당 페이지수

$endPage = ceil($page / $cpp) * $cpp;
$startPage = $endPage - $cpp + 1;

$prev = true;
$next = true;

if ($endPage >= $totalPage) {
    $endPage = $totalPage;
    $next = false;
}

if ($startPage == 1) {
    $prev = false;
}

$sql = "SELECT * FROM boards ORDER BY id DESC LIMIT " . ($page - 1) * 15 . ", 15";
$list = fetchAll($con, $sql);

?>
<!DOCTYPE html>
<html lang="ko">
<title>게시판 리스트</title>
<?php require("head.php"); ?>

<body>
    <?php require("nav.php"); ?>

    <div class="row my-4 d-flex justify-content-center mw-100">
        <div class="col-10">
            <h1>게시판 리스트</h1>
        </div>
    </div>

    <div class="row d-flex justify-content-center mw-100">
        <div class="col-10">
            <table class="table table-striped table-hover table-bordered">
                <tr class="text-center">
                    <th>글번호</th>
                    <th width="60%">제목</th>
                    <th>글쓴이</th>
                    <th>작성일</th>
                </tr>

                <?php
                foreach ($list as $item) :
                    ?>
                    <tr class="text-center">
                        <td><?= $item->id ?></td>
                        <td>
                            <a href="/view.php?id=<?= $item->id ?>">
                                <?= $item->title ?>
                            </a>
                        </td>
                        <td><?= $item->writer ?></td>
                        <td><?= $item->wdate ?></td>
                    </tr>
                <?php
            endforeach;
            ?>

            </table>
        </div>
    </div>

    <div class="row d-flex justify-content-center mt-4 mw-100">
        <div class="col-10 text-right">
            <a class="btn btn-outline-success mb-5" href="/form.php">글쓰기</a>
        </div>
    </div>

    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
            <li class="page-item <?= $prev ? "" : "disabled" ?>">
                <a class="page-link" href="/list.php?p=<?= $startPage - 1 ?>" tabindex="-1">이전</a>
            </li>

            <?php for ($i = $startPage; $i <= $endPage; $i++) : ?>
                <li class="page-item <?= $i == $page ? "active" : "" ?>">
                    <a class="page-link" href="/list.php?p=<?= $i ?>">
                        <?= $i ?>
                    </a>
                </li>
            <?php endfor; ?>

            <li class="page-item <?= $next ? "" : "disabled" ?>">
                <a class="page-link" href="/list.php?p=<?= $endPage + 1 ?>">다음</a>
            </li>
        </ul>
    </nav>

</body>

</html>