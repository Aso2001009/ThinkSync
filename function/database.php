<?php

$pdo = new PDO(
    'mysql:host=mysql214.phy.lolipop.lan;dbname=LAA1530414-thinksync;charset=utf8',
    'LAA1530414',
    'SD3TS'
);
/**
 * room_idを生成
 * @return string
 */
function CreateRoomId(){
    $room_id = substr(str_shuffle('1234567890abcdefghijklmnopqrstuvwxyz'), 0, 5);
    if(CheckRoomId($room_id)){
        return $room_id;
    }else{
        CreateRoomId();
    }
}

/**
 * 重複するroom_idがないか確認
 * @param string $room_id
 * @return bool
 */
function CheckRoomId($room_id){
    global $pdo;
    $sql = $pdo->prepare('SELECT * FROM rooms WHERE room_id = :room_id');
    $sql->bindValue(':room_id',$room_id,PDO::PARAM_STR);
    $sql->execute();
    $result = $sql->fetch(PDO::FETCH_ASSOC);
    if($result == false){
        return true;
    }else{
        return false;
    }
}

/**
 * 会議作成
 * @param string $room_id
 * @param int $user_id
 * @param string $title
 * @return bool
 */
function CreateRoom($room_id,$user_id,$title){
    global $pdo;
    $sql = $pdo->prepare('INSERT INTO rooms(room_id,user_id,title,temp,start,end) VALUES(:room_id,:user_id,:title,NULL,:start,NULL)');
    $sql->bindValue(':room_id',$room_id,PDO::PARAM_STR);
    $sql->bindValue(':user_id',$user_id,PDO::PARAM_INT);
    $sql->bindValue(':title',$title,PDO::PARAM_STR);
    $sql->bindValue(':start',date('Y-m-d H:i:s'),PDO::PARAM_STR);
    $sql->execute();
}

/**
 * 重複するログがないか確認
 * @param string $room_id
 * @param int $user_id
 * @return bool
 */
function CheckLog($room_id,$user_id){
    global $pdo;
    $sql = $pdo->prepare('SELECT * FROM logs WHERE room_id = :room_id && user_id = :user_id');
    $sql->bindValue(':room_id',$room_id,PDO::PARAM_STR);
    $sql->bindValue(':user_id',$user_id,PDO::PARAM_INT);
    $sql->execute();
    $result = $sql->fetch(PDO::FETCH_ASSOC);
    if($result == false){
        return true;
    }else{
        return false;
    }
}

/**
 * ログ作成
 * @param string $room_id
 * @param int $user_id
 * @return bool
 */
function InsertLog($room_id,$user_id){
    if(CheckLog($room_id,$user_id)){
        global $pdo;
        $sql = $pdo->prepare('INSERT INTO logs(room_id,user_id) VALUES(:room_id,:user_id)');
        $sql->bindValue(':room_id',$room_id,PDO::PARAM_STR);
        $sql->bindValue(':user_id',$user_id,PDO::PARAM_INT);
        $sql->execute();
    }
}

function UpdateRoom($room_id){
    global $pdo;
    $sql = $pdo->prepare('UPDATE rooms SET end = :end WHERE room_id = :room_id');
    $sql->bindValue(':room_id',$room_id,PDO::PARAM_STR);
    $sql->bindValue(':end',date('Y-m-d H:i:s'),PDO::PARAM_STR);
    $sql->execute();
}
?>
