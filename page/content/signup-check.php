<?php 
  session_start(); 

  if($_SESSION['email']==NULL){
    header('Location: login.php');
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>ThinkSync</title>
    <link rel="stylesheet" type="text/css" href="../style/signup-check.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script type="text/javascript" src="../script/signup-check.js"></script>
  </head>
  <body>

  <div class="logo">
      <img src="../img/logo.png">
    </div>

    <div class="header">
      <img src="../img/header.png">
    </div>

    <div class="form-container">
        <h2>入力内容の確認</h2>
        <img src="../img/tejun2.png" class="tejun">
        <form method="post" action="signup-comp.php" class="regist">
            <label for="account_name">アカウント名:</label>
            <input type="text" name="account_name" id="account_name" value="<?php echo $_SESSION['account'] ?>" readonly="readonly">

            <label for="email">メールアドレス:</label>
            <input type="email" name="email" id="email" value="<?php echo $_SESSION['email'] ?>" readonly="readonly">
            <input type="email" name="confirm_email" id="confirm_email" value="<?php echo $_SESSION['confirm_email'] ?>" readonly="readonly">

            <input type="button" onclick="location.href='signup.php'" value="入力画面" class="back">
            <input type="submit" value="登録する" class="reg">
        </form>
    </div>
</body>
</html>
