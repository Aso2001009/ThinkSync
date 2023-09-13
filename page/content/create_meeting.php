<?php
session_start();
require_once '../../function/database.php';

if(!isset($_SESSION['user_id'])){
    header("Location: ./login.php");
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $room_id = $_POST['room_id'];
    $user_id = $_SESSION['user_id'];
    $meeting_title = $_POST['meeting_title'];   

    CreateRoom($room_id,$user_id,$meeting_title);
    InsertLog($room_id,$_SESSION['user_id']);
    header('Location: bord.php?room_id='.$room_id);
    exit();
}else{
    $room_id = CreateRoomId();
}
?>
<?php require_once 'common.php' ?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="../css/create_meeting.css">
</head>
<body>
<p class="page_title">会議作成</p>
    <div class="container">
        <div class="main">
            <div class="form-container">
                <span>会議を作成する</span>
                <form action="" method="post">
                    <label for="meeting_title">会議タイトル</label>
                    <input type="text" id="meeting_title" name="meeting_title" required>
                    <br>
                    <label for="room_id">ルームID</label>
                    <input type="text" id="room_id" name="room_id" value="<?=$room_id?>">
                    <br>
                    <button type="submit">会議を始める</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
