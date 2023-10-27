<?php session_start() ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>ThinkSync -新規登録-</title>
    <link rel="stylesheet" type="text/css" href="../css/signup-check.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script type="text/javascript" src="../script/signup-check.js"></script>
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
        <h2>check</h2>
        <img src="../img/tejun2.png" class="tejun">
        <form method="post" action="signup-comp.php" class="regist">
            <label for="account_name">アカウント名</label>
            <input type="text" name="account_name" id="account_name" value="<?php echo $_SESSION['account'] ?>" readonly="readonly">

            <label for="email">メールアドレス</label>
            <input type="email" name="email" id="email" value="<?php echo $_SESSION['email'] ?>" readonly="readonly">
            <input type="email" name="confirm_email" id="confirm_email" value="<?php echo $_SESSION['confirm_email'] ?>" readonly="readonly">

            <input type="button" onclick="location.href='signup.php'" value="入力画面" class="back">
            <input type="submit" value="登録する" class="reg">
        </form>
    </div>
</body>
</html>