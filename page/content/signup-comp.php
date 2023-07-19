<?php 
    session_start();

    if($_SESSION['email']==NULL){
      header('Location: login.php');
    }

    
//DBの名前は変えてください
    $pdo = new PDO("mysql:host=localhost;dbname=thinksync;charset=utf8",
	   			  "root", "root");
    $userid = rand(1,1000);
        $sqlm = 'INSERT INTO users VALUES(?,?,?,?)';
        $sql = $pdo->prepare($sqlm);
        $sql->bindValue(1,$userid,PDO::PARAM_STR);
        $sql->bindValue(2,$_SESSION['account'],PDO::PARAM_STR);
        $sql->bindValue(3,$_SESSION['email'],PDO::PARAM_STR);
        $sql->bindValue(4,$_SESSION['password'],PDO::PARAM_STR);
        $sql->execute();

        $_SESSION['user_id'] = $userid;
        unset($_SESSION['account']);
        unset($_SESSION['email']);
        unset($_SESSION['password']);
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>ThinkSync</title>
    <link rel="stylesheet" type="text/css" href="../style/signup-comp.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script type="text/javascript" src="../script/signup-comp.js"></script>
  </head>
  <body>

  <div class="logo">
      <img src="../img/logo.png">
    </div>

    <div class="header">
      <img src="../img/header.png">
    </div>

    <div class="form-container">
        <h2>登録完了</h2>
        <img src="../img/tejun3.png" class="tejun">
            <h2>3秒後にトップページへ遷移します
                    <meta http-equiv="refresh" content=" 3; url=./">      
    </div>
</body>
</html>
