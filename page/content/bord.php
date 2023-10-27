<?php
    session_start();
    require_once '../../function/database.php';
    
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if(isset($_POST['exit'])){
            UpdateRoom($_GET['room_id']);
            header('Location: history_detail.php?room_id='.$_GET['room_id']);
            exit();
        }
    }

    $room_title = GetRoomTitle($_GET['room_id']);
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
    <title>ThinkSync -<?=$room_title?>-</title>
    <script>
        window.onload = function() {
            mdclick();
            createTable(3, 3);
        }
    </script>
    <style>
        #whiteboard {
            border: 1px solid #000;
        }
    </style>
    <!DOCTYPE html>
    <script src="https://www.gstatic.com/firebasejs/7.14.2/firebase-app.js"></script><script src="https://www.gstatic.com/firebasejs/7.14.2/firebase-database.js"></script><script crossorigin src="https://unpkg.com/react@16/umd/react.development.js"></script><script crossorigin src="https://unpkg.com/react-dom@16/umd/react-dom.development.js"></script><script crossorigin src="https://cdnjs.cloudflare.com/ajax/libs/babel-standalone/6.26.0/babel.min.js"></script>
    <script type="text/babel" src="../script/memo.js"></script>
    <script src="../script/mandara.js"></script>
    
    <link rel="stylesheet" type="text/css" href="../css/bord.css">
</head>
<body>
    <!-- 画面上部-->
    <div class="top">
        <!-- 画面左上アプリロゴ画像-->
        <div class="logo">
            <img src="../img/logo.png" alt="アプリロゴ" width="200px" height="">
        </div>
        <div class="header-line"></div>
    </div>

    <!--画面左部-->
    <div class="left">
        <!--ドロップダウンメニューで図形のテンプレートを呼び出す-->
        <div class="dropdown" onclick="mdclick()">
            <label>テンプレート</label><br>
            <label>
                <input type="radio" name="dropdown" class="radio" id="mandara" checked/>マンダラート
            </label><br>
            <label>
                <input type="radio" name="dropdown" class="radio" id="swot" />SWOT分析
            </label>
        </div>

        <!--メモ-->
        <div class="memo">
            <label>メモ</label>
            <div class="memoArea" id="root" />
        </div>

        <!--参加者表示-->
        <div class="member">
            <label>参加者</label>
            <h2>作成途中...</h2>
        </div>
        <!--退出ボタン-->
        
        <!--退出ボタンを押したらトップページに戻る-->
        <form action="" method="post">
            <div class="exit">
                <button type="submit" class="button" name="exit">退出</button>            
            </div>
        </form>
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
        <div id="table-container">
            <br><br>
        </div>
        <div id="swot-container">
                <div class="swotstyle_row">
                    <div class="swotstyle">強み(Strength)</div>
                    <div class="swotstyle">弱み(Weakness)</div>
                </div>
                <div class="swotstyle_row">
                    <div class="swotstyle">機会(Opportunity)</div>
                    <div class="swotstyle">脅威(Threat)</div>
                </div>
            </div>
    </div>

    <script src="../script/bord.js"></script>
    <script src="../script/timer.js"></script>
</body>
</html>