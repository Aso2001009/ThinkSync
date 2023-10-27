<?php
session_start();
    require_once 'common.php';
    require_once '../../function/database.php';
    if(!isset($_SESSION['user_id'])){
        header("Location: ./login.php");
    }

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if($_POST['mail'] == $_POST['check-mail']){
        $mail = $_POST['mail'];
        UpdateMail($_SESSION['user_id'],$mail);
    }else{
        $err = "メールアドレスが一致しません";
    }
}
?>
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../css/edit-mail.css">
        <title>ThinkSync -メールアドレスの変更-</title>
    </head>
    <body>
    <h2 class="sub">マイページ</h2>
    <div class="form-container">
        <h1 class="page-title">メールアドレスの変更</h1>
        <div class="box">
            <form action="" method="post">
                <!--エラーメッセージ-->
                <p class="err"><?=$err?></p>
                <!--メールアドレス入力-->
                <label for="mail" class="input-label">新しいメールアドレス</label>
		        <input type="email" class="new-mail" name="mail" placeholder="新しいメールアドレス">
		        <label for="mail" class="input-label">新しいメールアドレス(確認)</label>
                <input type="email" class="check-mail" name="check-mail" placeholder="新しいメールアドレス(確認)">
                <input type="button" onclick="location.href='./mypage.php'" value="キャンセル" class="back"><!-- マイページへ遷移 -->
                <input type="submit"value="完了">
            </form>
        </div>
    </div>
    </body>
</html>