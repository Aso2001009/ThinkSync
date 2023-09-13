<?php session_start() ?>
<?php 
function reg(){
    $pdo = new PDO('mysql:host=mysql214.phy.lolipop.lan;dbname=LAA1530414-thinksync;charset=utf8',
    'LAA1530414',
    'SD3TS');
    $sql = $pdo->prepare('SELECT * FROM users WHERE mail = :email');
    $sql->execute(array(':email' => $_POST['email']));
    $result = $sql->fetch(PDO::FETCH_ASSOC);
  if(password_verify($_POST['password'], $result['pass'])){
    //パスワードが一致したらセッションに保存して渡す
    $_SESSION['user_id'] = $result['user_id'];
    header('Location: create_meeting.php');
    exit();
  }else{
    //パスワードが一致しなかったときの処理
    $_SESSION['error_message'] = 'パスワードまたはメールアドレスが違います';
    header('Location: login.php');
    exit();
  }
}
?>
<?php 
if(!empty($_POST['password'])){
  reg();
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>ThinkSync</title>
    <link rel="stylesheet" type="text/css" href="../css/login.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script type="text/javascript" src="../script/login.js"></script>
  </head>
  <body>

    <div class="header">
      <img src="../img/logo.png">
      <hr size="5%" color="black" noshade>
    </div>

    <div class="form-container">
        <h2>ログイン</h2>
            <?php if (isset($_SESSION['error_message'])) {
                echo '<p style="color: red;">' . $_SESSION['error_message'] . '</p>';
                unset($_SESSION['error_message']); // セッションからエラーメッセージを削除
            } ?>
        <form method="post" action="" class="regist">

            <label for="email">メールアドレス:</label>
            <input type="email" name="email" id="email" required>
        
            <label for="password">パスワード:</label>
            <input type="password" name="password" id="password" required>
            <div class="signup"><a href="signup.php">新規登録はこちら</a></div>
            <input type="submit" value="ログイン" class="reg">
        </form>
    </div>
</body>
</html>


