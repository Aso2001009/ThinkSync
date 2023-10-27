<?php session_start() ?>
<?php 
function reg(){
  if(strcmp($_POST['password'],$_POST['confirm_password'])==0){
    //パスワードが一致したらセッションに保存して渡す
    $_SESSION['account']=$_POST['account_name'];
    $_SESSION['email']=$_POST['email'];
    $_SESSION['confirm_email']=$_POST['confirm_email'];
    $_SESSION['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
    header('Location: signup-check.php');
  }else{
    //パスワードが一致しなかったときの処理
    header('Location: signup.php');
    exit();
  }
}
?>
<?php 
if(!empty($_POST['confirm_password'])){
  reg();
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>ThinkSync -新規登録-</title>
    <link rel="stylesheet" type="text/css" href="../css/signup.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script type="text/javascript" src="../script/signup.js"></script>
  </head>
  <body>

    <a href="../content/top.php">
       <!--画面左上アプリロゴ画像-->
       <img src="../img/logo.png" class="logo" width="250px" height="75px">
    </a>
    <div class="line1"></div>
    <div class="line2"></div>
    <div class="line3"></div>

    <div class="form-container">
        <h2>Sign up</h2>
        <img src="../img/tejun1.png" class="tejun">
        <form method="post" action="signup.php" class="regist">
          <div class="txt">
            <label for="account_name">アカウント名</label>
            <input type="text" name="account_name" id="account_name" required placeholder="アカウント名を入力">

            <label for="email">メールアドレス</label>
            <input type="email" name="email" id="email" required placeholder="メールアドレスを入力">
            <input type="email" name="confirm_email" id="confirm_email" required placeholder="メールアドレスを入力(確認用)">
        
            <label for="password">パスワード</label>
            <input type="password" name="password" id="password" required placeholder="パスワードを入力">
            <input type="password" name="confirm_password" id="confirm_password" required placeholder="パスワードを入力(確認用)">

            <input type="submit" value="内容を確認" class="reg">
            </div>
        </form>
    </div>
</body>
</html>