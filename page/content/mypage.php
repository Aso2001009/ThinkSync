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
        <title>ThinkSync -マイページ-</title>
    </head>
<body>
    <h2 class="sub">マイページ</h2>
    <div class="box">
        <div class="user-info">
            <!-- ユーザー名の表示、変更 -->
            <div class="info-item">
                <span class="mypage-text">ユーザー名</span>
                <span class="user-text"><?=$name?></span>
                <div class="edit-button">
                    <a href="./edit-username.php">
                        <img src="../img/edit_btn_img1.png" alt="ボタン画像" height="45px" width="45px" />
                    </a>
                </div>
            </div>

            <!-- メールアドレスの表示、変更 -->
            <div class="info-item">
                <span class="mypage-text">メールアドレス</span>
                <span class="user-text"><?=$mail?></span>
                <div class="edit-button">
                    <a href="./passcheck.php?cmd=A">
                        <img src="../img/edit_btn_img1.png" alt="ボタン画像" height="45px" width="45px" />
                    </a>
                </div>
            </div>

            <!-- パスワードの表示、変更 -->
            <div class="info-item">
                <span class="mypage-text">パスワード</span>
                <span class="user-text">********</span>
                <div class="edit-button">
                    <a href="./passcheck.php?cmd=B">
                        <img src="../img/edit_btn_img1.png" alt="ボタン画像" height="45px" width="45px" />
                    </a>
                </div>
            </div>
        </div>

        <!-- アカウント削除ボタン -->
        <div class="delete-button-container">
            <button type="button" onclick="location.href='./passcheck.php?cmd=C'" class="delete-button">
                アカウント削除
            </button>
        </div>
    </div>
</body>