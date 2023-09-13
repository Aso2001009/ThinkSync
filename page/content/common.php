<?php
session_start();
//ログアウト処理
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: top.php');
    exit;
}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ThinkSync</title>
    <link rel="stylesheet" href="../css/common.css">
</head>
<body>
    <!--画面左上アプリロゴ画像-->
    <img src="../img/logo.png" class="logo" width="250px" height="75px">

    <!--画面右上斜線-->
    <div class="line1"></div>
    <div class="line2"></div>
    <?php 
    // ログインしているならログアウトボタンを表示する
    if (!isset($_SESSION['user_id'])) {
        echo '<button class="login-button" onclick="location.href=\'login.php\'">ログイン/新規登録</button>';
    }else{
        echo '<button class="login-button" onclick="location.href=\'common.php?logout\'">ログアウト</button>';
    }
    ?>
    
    <div class="line3"></div>

    <div class="banner">
        <!--バナー-->
        <img src="../img/banner.png" class="banner-img" width="187.5px" height="600px">
        <div class="banner-line"></div>
        <div class="app-links">
            <a href="create_meeting.php">会議を作成</a>
            <a href="join_meeting.php">会議に参加</a>
            <a href="history.php">履歴</a>
        </div>
        <div class="line4"></div>
    </div>

    <!--画面下部(間に合わないのでいったん保留)-->
    <!--
    <button id="contact" onclick="location.href='contact.php'">お問い合わせ</button>
    <button id="" onclick="location.href='.php'">利用規約</button>
    <button id="Q&A" onclick="location.href='Q&A.php'">Q&A</button>
    -->

</body>
</html>