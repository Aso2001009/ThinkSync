<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>ホワイトボード</title>
    <style>
        #whiteboard {
            border: 1px solid #000;
        }
    </style>
    <link rel="stylesheet" type="text/css" href="./css/bord.css">
</head>
<body>
    <!-- 画面上部-->
    <div class="top">
        <!-- 画面左上アプリロゴ画像-->
        <div class="logo">
            <img src="img/logo.png" alt="アプリロゴ">
        </div>
    </div>
    <!--画面左部-->
    <div class="left">
        <!--ドロップダウンメニューで図形のテンプレートを呼び出す-->
        <div class="dropdown">
            <label>テンプレート</label>
        </div>

        <!--メモ-->
        <div class="memo">
            <label>メモ</label>
        </div>

        <!--参加者表示-->
        <div class="member">
            <label>参加者</label>
        </div>
        <!--退出ボタン-->
        <div class="exit">
            <!--退出ボタンを押したらトップページに戻る-->
            <button type="button" onclick="location.href='top.php'">退出</button>

        </div>
        <!--タイマー 、自分で何分とか設定できる感じで-->
        <div class="timer">
            <div class="time" id="timer">
                <span id="minutes">TIME_00</span>:
                <span id="seconds">00</span>
            </div>
            <button id="settings-button"></button>
            

            <div id="settings-popup" style="display: none;">
                <form id="timer-form">
                    <label for="minutes-input">分:</label>
                    <input type="number" id="minutes-input" min="0" max="59" value="0">
                    <label for="seconds-input">秒:</label>
                    <input type="number" id="seconds-input" min="0" max="59" value="0">
                    <input type="submit" value="スタート">
                </form>
            </div>
        </div>
    </div>
    <!--ホワイトボード-->
    <div class="bord" style="position: relative;">
        <canvas id="whiteboard" height="580" width="1125"></canvas>
        <label for="eraser-checkbox" style="position: absolute; bottom: 10px; left: 10px;">
            <input type="checkbox" id="eraser-checkbox"> 消しゴムモード
        </label>
        <button id="clear-button" style="position: absolute; bottom: 10px; left: 100px;">全消去</button>
        <div style="position: absolute; bottom: 10px; left: 200px;">
            <input type="color" id="color-picker">
        </div>
    </div>
    <script src="./script/bord.js"></script>
    <script src="./script/timer.js"></script>
</body>
</html>
