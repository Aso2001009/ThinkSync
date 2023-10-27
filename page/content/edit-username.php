<?php
session_start();
    require_once 'common.php';
    require_once '../../function/database.php';
    if(!isset($_SESSION['user_id'])){
        header("Location: ./login.php");
    }
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        //ユーザー名更新
        $name = $_POST['new_name'];
        UpdateName($_SESSION['user_id'],$name);
    }
    //ユーザー名の取得
    $name = SelectName($_SESSION['user_id']);
    if($name == null){
        $name = '未設定';
    }
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../css/edit-username.css">
    <title>ThinkSync -ユーザー名の変更-</title>
</head>
<body>
    <h2 class="sub">マイページ</h2>
    <div class="form-container">
        <h1 class="page-title">ユーザー名の変更</h1>
        <div class="box">
            <label for="email" class="input-label">現在のユーザー名</label>
            <label for="email" class="input-label"><?= $name ?></label>
            <form action="" method="POST">
                <label for="email" class="input-label">新しいユーザー名</label>
                <input type="text" class="name" name="new_name" required placeholder="ユーザー名">
                <!-- マイページへ遷移 -->
                <input type="button" onclick="location.href='./mypage.php'" value="キャンセル" class="back">
                <input type="submit" name="update_name" value="変更を保存" class="reg">
            </form>
        </div>
    </div>
</body>
</html>