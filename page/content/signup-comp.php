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
    <title>ThinkSync</title>
    <link rel="stylesheet" type="text/css" href="../css/signup-comp.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script type="text/javascript" src="../script/signup-comp.js"></script>
  </head>
  <body>

    <div class="header">
      <img src="../img/logo.png">
      <hr size="5%" color="black" noshade>
    </div>

    <div class="form-container">
        <h2>登録完了</h2>
        <img src="../img/tejun3.png" class="tejun">
            <h2>3秒後にトップページへ遷移します
            <meta http-equiv="refresh" content=" 3; url=./create_meeting.php">
    </div>
</body>
</html>
