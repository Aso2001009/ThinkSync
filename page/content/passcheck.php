<?php
session_start();
    require_once 'common.php';
    require_once '../../function/database.php';
    if(!isset($_SESSION['user_id'])){
        header("Location: ./login.php");
    }
    //遷移先を設定
    $cmd=$_GET['cmd'];
?>

<?php if ($_SERVER['REQUEST_METHOD'] == 'POST'):
    //パスワードのハッシュ値を取得
    $hash = SelectPass($_SESSION['user_id']);
?>
    <?php if(password_verify($_POST['pass'],$hash)):?>
        <?php if($_GET['cmd'] == 'A'):?>
            <!--メールアドレス編集画面へ遷移-->
            <script>location.href = 'edit-mail.php';</script>
        <?php elseif($_GET['cmd'] == 'B'):?>
            <!--パスワード編集画面へ遷移-->
            <script>location.href = 'edit-pass.php';</script>
        <?php elseif($_GET['cmd'] == 'C'):?>
            <!--ポップアップ表示-->
            <script src="../script/popup.js"></script>
            <script>
                window.onload = function() {
                    showConfirmation();
                }
            </script>
            <div class="modal-container">
                <div class="modal-box">
                    <label>アカウントを削除しますか？</label>
                    <p>アカウントが削除されます。</p>
                    <!--マイページ画面へ遷移-->
                    <button class="back" onclick="cancelAction()">キャンセル</button>
                    <!--アカウント削除画面へ遷移-->
                    <button class="next" onclick="confirmAction()">削除する</button>
                </div>
            </div>
        <?php else: $err = 'A';?>
        <?php endif?>
    <?php else: $err = 'B';?>
    <?php endif?>
<?php endif?>
<title>ThinkSync -パスワードの確認-</title>
<link rel="stylesheet" href="../css/passcheck.css">
<h2 class="sub">マイページ</h2>
<div class="form-container">
    <h1 class="page-title">パスワードの確認</h1>
    <div class="box">
        <form action="" method="post">
		    <label for="pass" class="input-label">パスワードを入力</label>
            <p class="guide-text">続けるにはパスワードを入力してください</p>
            <input type="password" class="pass" name="pass" placeholder="現在のパスワード">
            <input type="button" onclick="location.href='./mypage.php'" value="キャンセル" class="back"><!-- マイページへ遷移 -->
            <input type="submit"value="完了">
        </form>
    </div>
</div>