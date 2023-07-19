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
  }
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>ThinkSync</title>
    <link rel="stylesheet" type="text/css" href="../style/signup.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script type="text/javascript" src="../script/signup.js"></script>
  </head>
  <body>

    <div class="logo">
      <img src="../img/logo.png">
    </div>

    <div class="header">
      <img src="../img/header.png">
    </div>

    <div class="form-container">
        <h2>新規登録</h2>
        <img src="../img/tejun1.png" class="tejun">
        <form method="post" action="signup.php" class="regist">
            <label for="account_name">アカウント名:</label>
            <input type="text" name="account_name" id="account_name" required>

            <label for="email">メールアドレス:</label>
            <input type="email" name="email" id="email" required>
            <input type="email" name="confirm_email" id="confirm_email" required>
        
            <label for="password">パスワード:</label>
            <input type="password" name="password" id="password" required>
            <input type="password" name="confirm_password" id="confirm_password" required>

            <input type="submit" value="内容を確認" class="reg">
        </form>
    </div>
</body>
</html>

<?php 
if(!empty($_POST['confirm_password'])){
  reg();
}
?>
