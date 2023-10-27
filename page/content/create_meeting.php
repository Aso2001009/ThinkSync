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
    <title>ThinkSync -会議を作成-</title>
    <link rel="stylesheet" type="text/css" href="../css/create_meeting.css">
</head>
<body>
    <h2 class="sub">会議作成</h2>
    <div class="form-container">
        <h1 class="page-title">会議を作成する</h1>
        <div class="box">
	<form action="" method="POST">
            <label for="meeting_title" class="input-label">会議タイトル</label>
            <input type="text" id="meeting_title" name="meeting_title" required>
                <label for="email" class="room-label">ルームID</label>
                <input type="text" class="room-label"  id="room_id" name="room_id" value="<?=$room_id?>" readonly>
                <input type="submit"value="会議を始める">
            </form>
        </div>
    </div>
</body>
</html>