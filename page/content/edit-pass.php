<?php
session_start();
    //require_once 'common.php';
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
        <link rel="stylesheet" href="../css/edit-pass.css">
        <title>マイページ</title>
    </head>
    <body>
        <h1 class="page-title">マイページ</h1>
        <div class="box">
            <form action="" method="post">
                <p>パスワードを変更</p>
                <p>現在のパスワード</p>
                <input type="password" class="old-pass" name="old-pass" placeholder="現在のパスワード">
                <p>新しいパスワード</p>
                <input type="password" class="new-pass" name="new-pass" placeholder="新規パスワード">
                <p>新しいパスワード（確認）</p>
                <input type="password" class="check-pass" name="check-pass" placeholder="確認用パスワード">
                <button type="button" onclick="location.href='./mypage.php'" class="cancel-button">キャンセル</button>
                <button type="submit" class="next-button">完了</button>
            </form>
        </div>
    </body>
</html>