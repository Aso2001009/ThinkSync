<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="style/create_meeting.css">
</head>
<body>
    <div class="top">
        <!-- 画面左上アプリロゴ画像-->
        <div class="logo">
            <img src="img/logo.png" alt="アプリロゴ">
        </div>
        <!-- 画面右上「ログイン/新規登録」-->
        <div class="login">
            <a href="login.php">ログイン/新規登録</a>
        </div>
    </div>

    <div class="container">
        <div class="banner">
            <div class="app-links">
                <a href="create_meeting.php">会議を作成</a>
                <a href="join_meeting.php">会議に参加</a>
                <a href="history.php">履歴</a>
            </div>
        </div>

        <div class="main">
            <!-- 四角で囲んだフォーム -->
            会議作成
            <div class="form-container">
                <span>会議を作成する</span>
                <form action="meeting.php" method="post">
                    <label for="meeting_title">会議タイトル</label>
                    <input type="text" id="meeting_title" name="meeting_title" required>
                    <br>
                    <label for="room_id">ルームID</label>
                    <input type="text" id="room_id" name="room_id" value="<?php
                        //ランダムな英数字を持つ5桁の文字列を生成
                        $room_id = substr(str_shuffle('1234567890abcdefghijklmnopqrstuvwxyz'), 0, 5);
                        echo $room_id;
                    ?>" required>
                    <br>
                    <button type="submit">会議を始める</button>
                </form>
            </div>
        </div>
    </div>

    <div class="bottom">
        <div class="bottom-links">
            <a href="contact.php">お問い合わせ</a>
            <a href="terms_of_service.php">利用規約</a>
            <a href="Q&A.php">Q&A</a>
        </div>
    </div>
</body>
</html>
