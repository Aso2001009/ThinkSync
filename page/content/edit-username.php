<?php
session_start();
    //require_once 'common.php';
    require_once '../../function/database.php';
    if(!isset($_SESSION['user_id'])){
        header("Location: ./login.php");
    }
    //ユーザー名の取得
    $name = SelectName($_SESSION['user_id']);
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        //ユーザー名更新
        $name = $_POST['name'];
        UpdateName($_SESSION['user_id'],$name);
        header('Location: mypage.php');
        exit();
    }
?>
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="css/edit-username.css">
        <title>マイページ</title>
    </head>
    <body>
        <h1 class="page-title">マイページ</h1>
        <div class="box">
        <p>ユーザー名を変更</p>
        <p>現在のユーザー名</p>
        <p><?=$name?></p>
        <form action="" method="POST">
            <p>新しいユーザー名</p>
            <input type="text" class="name" name="name" required placeholder="ユーザー名">
            <button type="button" onclick="location.href='./mypage.php'" class="cancel">キャンセル</button>
            <button type="submit" class="next-button">完了</button>
        </form>
        </div>
    </body>
</html>