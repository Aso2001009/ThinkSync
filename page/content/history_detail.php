<?php
  session_start();
  require_once 'common.php';
  $room_id = $_GET['room_id'];
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>ThinkSync -履歴詳細-</title>
    <link rel="stylesheet" type="text/css" href="../css/history_detail.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script type="text/javascript" src="../script/history_detail.js"></script>
  </head>
  <body>
    <?php
      function connectDB(){
      $opt = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                 PDO::MYSQL_ATTR_MULTI_STATEMENTS => false,
                 PDO::ATTR_EMULATE_PREPARES => false);
  
      $db = new PDO(
          'mysql:host=mysql214.phy.lolipop.lan;dbname=LAA1530414-thinksync;charset=utf8',
          'LAA1530414',
          'SD3TS',
        $opt
        );

        return $db;
      }
    ?>
    <a class="page_title">履歴詳細</a>
    <div class="history_detail_content">
      <?php
        $db = connectDB();
        $sql = "SELECT r.title AS title, r.end AS end, GROUP_CONCAT(u.name) AS users, r.temp AS temp 
        FROM rooms r LEFT JOIN logs l ON r.room_id = l.room_id LEFT JOIN users u ON l.user_id = u.user_id 
        WHERE r.room_id = ? GROUP BY r.room_id, r.title, r.end, r.temp";
        $ps = $db->prepare($sql);
	      $ps->bindValue(1, $room_id, PDO::PARAM_STR);
	      $ps->execute();
        $row = $ps->fetch();

        echo '<div class="history_detail_content_head">';
        echo '<a class="element_title">' . $row['title'] . '</a><br>';
        echo '<a class="history_detail_content_head_date">' . $row['end'] . '</a>';
        echo '</div>';
        echo '<div class="history_detail_content_element">';
        echo '<a class="element_title">参加者</a><br>';
        //参加者を一人ずつ表示　4列で
        $users = explode(',', $row['users']);
        $counter = 0;
        foreach ($users as $user) {
          if ($counter > 0 && $counter % 4 === 0) {
            echo '<br>'; // 4列ごとに改行
          }
          echo '<a>' . $user . 'さん</a>';
          $counter++;
        }
        echo '</div>';
        echo '<div class="history_detail_content_element">';
        echo '<a class="element_title">' . $row['temp'] . '</a><br>';
        echo '</div>';
      ?>
    </div>
  </body>
</html>