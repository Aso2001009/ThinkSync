<?php

$pdo = new PDO(
    'mysql:host=localhost;dbname=;charset=utf8',
    '',
    ''
);

/**
 * 未使用のメールアドレスか調べる
 * @param string $mail
 * @return bool true:未使用
 */
function CheckUniqueMail(string $mail) {
    return SelectUserByMail($mail) === false;
}

/**
 * IDでアカウント削除
 * @param int $id
 */
function DeleteUserById(int $user_id){
    global $pdo;
    $sql = $pdo->prepare('DELETE FROM user WHERE user_id = :user_id');
    $sql->bindValue(':user_id',$user_id,PDO::PARAM_INT);
    $sql->execute();
}

/**
 * アカウントの全件取得
 * @return array
 */
function SelectUserAll(){
    global $pdo;
    $sql = $pdo->prepare('SELECT * FROM user');
    $sql->execute();
    return $sql->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * IDでアカウント情報取得
 * @param int $id
 * @return array
 */
function SelectUserById(int $user_id){
    global $pdo;
    $sql = $pdo->prepare('SELECT * FROM user WHERE user_id =:user_id');
    $sql->bindValue(':user_id',$user_id,PDO::PARAM_INT);
    $sql->execute();
    return $sql->fetch(PDO::FETCH_ASSOC);
}

/**
 * メールアドレスでアカウント取得
 * @param string $mail
 * @return array
 */
function SelectUserByMail(string $mail){
    global $pdo;
    $sql = $pdo->prepare('SELECT * FROM user WHERE mail =:mail');
    $sql->bindValue(':mail',$mail,PDO::PARAM_STR);
    $sql->execute();
    return $sql->fetch(PDO::FETCH_ASSOC);
}


/**
 * [[ここ違うかも]]
 * メールアドレスとパスワードでアカウント取得
 * @param string $mail
 * @param string $pass
 * @return array
 */
function SelectUserByMailAndPass(string $mail,string $pass){
    global  $pdo;
    $sql = $pdo->prepare('SELECT * FROM user WHERE mail =:mail && pass =:pass');
    $sql->bindValue('mail',$mail,PDO::PARAM_STR);
    $sql->bindValue('pass',$pass,PDO::PARAM_STR);
    $sql->execute();
    return $sql->fetch(PDO::FETCH_ASSOC);
}

?>
