<?php 
  session_start();

    $pdo = new PDO('mysql:host=mysql214.phy.lolipop.lan;dbname=LAA1530414-thinksync;charset=utf8','LAA1530414','SD3TS');
    $userid = rand(1,1000);
    $sqlm = 'INSERT INTO users VALUES(?,?,?,?)';
    $sql = $pdo->prepare($sqlm);
    $sql->bindValue(1,$userid,PDO::PARAM_STR);
    $sql->bindValue(2,$_SESSION['account'],PDO::PARAM_STR);
    $sql->bindValue(3,$_SESSION['email'],PDO::PARAM_STR);
    $sql->bindValue(4,$_SESSION['password'],PDO::PARAM_STR);
    $sql->execute();

    $_SESSION['user_id'] = $userid;
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
        <h2>Compleate</h2>
        <img src="../img/tejun3.png" class="tejun">
        <form method="post" action="signup.php" class="regist">
          <div class="txt">

	    <h2>登録が完了しました</h2>

            <h2>3秒後にトップページへ遷移します</h2>
		<meta http-equiv="refresh" content=" 3; url=./create_meeting.php">
            </div>
        </form>
    </div>
</body>
</html>