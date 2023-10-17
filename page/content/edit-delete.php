<?php
session_start();
    //require_once 'common.php';
    require_once '../../function/database.php';
    if(!isset($_SESSION['user_id'])){
        header("Location: ./login.php");
    }
    DeleteAccount($_SESSION['user_id']);
    session_destroy();
?>

<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="css/edit-delete.css">
        <title>マイページ</title>
    </head>
    <body>
        <div class="box">
        <h2>アカウントが削除されました</h2>
        <button type="button" class="next-button" onclick="location.href='./top.php'">続ける</button>
        </div>
    </body>
</html>