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
    <title>ThinkSync -会議に参加-</title>
</head>
<body>
    <h2 class="sub">会議に参加</h2>
    <div class="form-container">
        <h1 class="page-title">会議に参加する</h1>
	<p class="error_message"><?=$error_message?></p>
        <div class="box">
	<form action="" method="POST">
            <label for="meeting_title" class="input-label">ルームID</label>
            <input type="text" id="room_id" name="room_id" required>
            <input type="submit"value="会議にはいる">
            </form>
        </div>
    </div>
</body>
</html>