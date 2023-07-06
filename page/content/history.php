<?php
  session_start();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>ThinkSync</title>
    <link rel="stylesheet" type="text/css" href="../style/history.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script type="text/javascript" src="../script/top.js"></script>
  </head>;
  <body>
  <?php
  function connectDB(){
    $opt = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                 PDO::MYSQL_ATTR_MULTI_STATEMENTS => false,
                 PDO::ATTR_EMULATE_PREPARES => false);
  
    $db = new PDO("mysql:host=localhost;dbname=thinksync;charset=utf8",
                  "", "", $opt);
    return $db;
  }
  ?>

  <div class="top-main">

    <a class="page_title">会議履歴</a>

    <?php
    try{
      $db = connectDB();
      //logsテーブルとroomsテーブルを結合して、ログインユーザーの会議履歴を取得
      $sql = "SELECT * FROM logs JOIN rooms ON logs.room_id = rooms.room_id WHERE ueser_id = ? ";
      $ps = $db->prepare($sql);
	    $ps->bindValue(1, $userid, PDO::PARAM_INT);
	    $ps->execute();

      // 会議の参加履歴がある場合1件ずつ取り出して表示
      $counter = 0;
      echo '<div class="history_content_row">'; // 最初の行を追加
      while ($row = $ps->fetch()) {
        if ($counter > 0 && $counter % 3 === 0) {
          echo '</div>'; // 3列ごとに行を閉じる
          echo '<div class="row">'; // 新しい行を開始
        }

        echo '<div class="history_content">';
        echo '<div class="history_content_name"><a>' . $row['title'] . '</a></div>';
        echo '<div class="history_content_day"><a>' . $row['end'] . '</a></div>';
        echo '</div>';

        $counter++;
      }

      echo '</div>'; // 最後の行を閉じる

    }catch(PDOException $e){
      die("エラーメッセージ：{$e->getMessage()}");
    }
    
    ?>

    <div class="top-footer">
      <a href="***" class="top-histry">会議履歴を見る</a>
      <a href="***" class="top-question">お問い合わせ</a>
      <a href="***" class="top-qa">Q＆A</a>
      <a href="***" class="top-rule">利用規約</a>
    </div>
    
  </div>
  </body>
</html>