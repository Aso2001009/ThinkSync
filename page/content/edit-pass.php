<?php
session_start();
    require_once 'common.php';
    require_once '../../function/database.php';
    if(!isset($_SESSION['user_id'])){
        header("Location: ./login.php");
    }

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    //パスワードのハッシュ値を取得
    $hash = SelectPass($_SESSION['user_id']);
    //現在のパスワードが一致しているか確認
    if(password_verify($_POST['old-pass'],$hash)){
        //新しいパスワードと確認用パスワードが一致しているか確認
        if($_POST['new-pass'] == $_POST['check-pass']){
            $new_pass = password_hash($_POST['new-pass'],PASSWORD_DEFAULT);
            UpdatePass($_SESSION['user_id'],$new_pass);
            header("Location: ./mypage.php");
        }else{
            $err = "パスワードが違うか、一致しません";
        }
    }else{
        $err = "パスワードが違うか、一致しません";
    }
}
?>
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="../css/edit-pass.css">
        <title>ThinkSync -パスワードの変更-</title>
    </head>
    <body>
    <h2 class="sub">マイページ</h2>
    <div class="form-container">
        <h1 class="page-title">パスワードの変更</h1>
        <div class="box">
            <form action="" method="post">
		        <label for="pass" class="input-label">現在のパスワード</label>
                <input type="password" class="old-pass" name="old-pass" placeholder="現在のパスワード">
		        <label for="pass" class="input-label">新しいパスワード</label>
		        <input type="password" class="new-pass" name="new-pass" placeholder="新しいパスワード">
		        <label for="pass" class="input-label">新しいパスワード(確認)</label>
                <input type="password" class="check-pass" name="check-pass" placeholder="新しいパスワード(確認)">
                <input type="button" onclick="location.href='./mypage.php'" value="キャンセル" class="back"><!-- マイページへ遷移 -->
                <input type="submit"value="完了">
            </form>
        </div>
    </div>
    </body>
</html>