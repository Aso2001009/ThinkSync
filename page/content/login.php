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
    <title>ThinkSync -ログイン-</title>
    <link rel="stylesheet" type="text/css" href="../css/login.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script type="text/javascript" src="../script/login.js"></script>
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
        <h2>Sign in</h2>
            <?php if (isset($_SESSION['error_message'])) {
                echo '<p style="color: red;">' . $_SESSION['error_message'] . '</p>';
                unset($_SESSION['error_message']); // セッションからエラーメッセージを削除
            } ?>
        <form method="post" action="" class="regist">

            <label for="email" class="input-label">メールアドレス</label>
            <input type="email" name="email" id="email" placeholder="メールアドレスを入力">
        
            <label for="password">パスワード</label>
            <input type="password" name="password" id="password" placeholder="パスワードを入力">
            <div class="signup"><a href="signup.php">新規登録はこちら</a></div>
            <input type="submit" value="Login" class="reg">
        </form>
    </div>
</body>
</html>