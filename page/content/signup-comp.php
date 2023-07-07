<?php 
    session_start();

    
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

    <div class="header">
      <img src="../style/logos/logo.png">
      <hr size="5%" color="black" noshade>
    </div>

    <div class="form-container">
        <h2>登録完了</h2>
        <img src="../style/logos/tejun3.png" class="tejun">
            <h2>3秒後にトップページへ遷移します
                    <meta http-equiv="refresh" content=" 3; url=./">      
    </div>
</body>
</html>
