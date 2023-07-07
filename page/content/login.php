<?php session_start() ?>
<?php 
function reg(){
    //DBの名前は変えてください
    $pdo = new PDO("mysql:host=localhost;dbname=thinksync;charset=utf8",
    "root", "root");
    $sql = $pdo->prepare('SELECT * FROM users WHERE mail = :email');
    $sql->execute(array(':email' => $_POST['email']));
    $result = $sql->fetch(PDO::FETCH_ASSOC);
  if(password_verify($_POST['password'], $result['pass'])){
    //パスワードが一致したらセッションに保存して渡す
    $_SESSION['user_id'] = $result['user_id'];
    $_SESSION['name'] = $result['name'];
    $_SESSION['email']=$_POST['email'];
    header('Location: top.php');
  }else{
    //パスワードが一致しなかったときの処理
    $_SESSION['error_message'] = 'パスワードまたはメールアドレスが違います';
    header('Location: login.php');
  }
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>ThinkSync</title>
    <link rel="stylesheet" type="text/css" href="../style/login.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script type="text/javascript" src="../script/login.js"></script>
  </head>
  <body>

    <div class="header">
      <img src="../style/logos/logo.png">
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

<?php 
if(!empty($_POST['password'])){
  reg();
}
?>
