<?php
session_start();
    require_once 'common.php';
    require_once '../../function/database.php';
    if(!isset($_SESSION['user_id'])){
        header("Location: ./login.php");
    }
    DeleteAccount($_SESSION['user_id']);
    session_destroy();
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../css/edit-delete.css">
    <title>ThinkSync -アカウント削除-</title>
</head>
<body>
    <div class="form-container">
        <label for="pass" class="input-label">アカウントが削除されました</label>
        <input type="button" onclick="location.href='./top.php'" Value="続ける" class="cancel-button"><!-- トップへ遷移 -->
    </div>
</body>
</html>