<?php
session_start();
    //require_once 'common.php';
    require_once '../../function/database.php';
    if(!isset($_SESSION['user_id'])){
        header("Location: ./login.php");
    }

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if($_POST['mail'] == $_POST['check-mail']){
        $mail = $_POST['mail'];
        UpdateMail($_SESSION['user_id'],$mail);
        header("Location: ./mypage.php");
    }else{
        $err = "メールアドレスが一致しません";
    }
}
?>
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="css/edit-email.css">
        <title>マイページ</title>
    </head>
    <body>
        <h1 class="page-title">マイページ</h1>
        <h2>メールアドレスを変更</h2>
        <p>新しいメールアドレス</p>
        <form action="" method="post">
            <!--エラーメッセージ-->
            <p class="err"><?=$err?></p>
            <!--メールアドレス入力-->
            <input type="email" class="mail-input" name="mail" placeholder="メールアドレス">
            <input type="email" class="check-mail-input" name="check-mail" placeholder="確認用メールアドレス">
            <button type="button" onclick="location.href='./mypage.php'" class="cancel-button">キャンセル</button>
            <button type="submit" class="next-button">変更</button>
        </form>
    </body>
</html>