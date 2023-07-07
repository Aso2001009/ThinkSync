<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="css/join_meeting.css">
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
            会議に参加
            <div class="form-container">
                <span>会議に参加する</span>
                <form action="meeting.php" method="post">
                    <label for="room_id">ルームID</label>
                    <input type="text" id="room_id" name="room_id" value="" required>
                    <br>
                    <button type="submit">会議にはいる</button>
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
