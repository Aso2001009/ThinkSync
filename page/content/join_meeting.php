<?php
    session_start();
    require_once '../../function/database.php';
    if(!isset($_SESSION['user_id'])){
        header("Location: ./login.php");
    }
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $room_id = $_POST['room_id'];  
        if(!(CheckRoomId($room_id))){
            InsertLog($room_id,$_SESSION['user_id']);
            header('Location: bord.php?room_id='.$room_id);
            exit();
        }else{
            $error_message = 'ルームIDが間違っています';
        }
    }
?>
<?php require_once 'common.php' ?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="../css/join_meeting.css">
</head>
<body>
    <p class="page_title">会議に参加<p>
    <div class="main">
        <!-- 四角で囲んだフォーム -->
        <div class="form-container">
            <span>会議に参加する</span>
            <p class="error_message"><?=$error_message?></p>    
            <form action="" method="post">
                <label for="room_id">ルームID</label>
                <input type="text" id="room_id" name="room_id" value="" required>
                <br>
                <button type="submit">会議にはいる</button>
            </form>
        </div>
    </div>
</body>
</html>
