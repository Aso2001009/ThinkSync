<?php
session_start();
    require_once 'common.php';
    require_once '../../function/database.php';
    if(!isset($_SESSION['user_id'])){
        header("Location: ./login.php");
    }
    //ユーザー名、メールアドレスの取得
    $name = SelectName($_SESSION['user_id']);
    $mail = SelectMail($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../css/mypage.css">
        <title>マイページ</title>
    </head>
    <body>
        <h1 class="page-title">マイページ</h1>
        <div class="box">
            <!--ユーザー名の表示、変更-->
            <div class="aco-box">
            <span class="mypage-text">ユーザー名</span>
            <span class="user-text"><?=$name?></span>
            <button type="button" onclick="location.href='./edit-username.php'" class="edit-button"><img src="../img/Page-transition.png" height=45px width=45px/></button>
            </div>
            <br>
            <!--メールアドレスの表示、変更-->
            <div class="aco-box">
            <span class="mypage-text">メールアドレス</span>
            <span class="user-text"><?=$mail?></span>
            <button type="button" onclick="location.href='./passcheck.php?cmd=A'" class="edit-button"><img src="../img/Page-transition.png" height=45px width=45px/></button>
            </div>
            <br>
            <!--パスワードの表示、変更-->
            <div class="aco-box">
            <span class="mypage-text">パスワード</span>
            <span class="user-text">********</span>
            <button type="button" onclick="location.href='./passcheck.php?cmd=B'" class="edit-button"><img src="../img/Page-transition.png" height=45px width=45px/></button>
            <div class="aco-box">
            <br>
            <!--アカウント削除ボタン-->
            <button type="button" onclick="location.href='./passcheck.php?cmd=C'" class="delete-button">アカウント削除</button>
        </div>
    </body>
</html>