<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="/" title="메인페이지">로고</a>

    <div class="collapse navbar-collapse">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="/list.php" title="게시판">게시판</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/form.php" title="글쓰기">글쓰기</a>
            </li>
        </ul>

        <ul class="navbar-nav">
            <?php if (isset($_SESSION['user'])) : ?>
                <a href="#" class="nav-link"><?= " ( " . $_SESSION['user']->level . " Level ) " . $_SESSION['user']->nickname ?> 님</a>
                <li class="nav-item">
                    <a class="nav-link" href="/logout.php">로그아웃</a>
                </li>
            <?php else : ?>
                <li class="nav-item">
                    <span class="nav-link date"></span>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/register.php" title="회원가입">회원가입</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/login.php" title="로그인">로그인</a>
                </li>
            <?php endif; ?>
        </ul>

    </div>
</nav>