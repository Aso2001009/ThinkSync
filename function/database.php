<?php

$pdo = new PDO(
    'mysql:host=localhost;dbname=thinksync;charset=utf8',
    'root',
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
 * パスワードのハッシュ化
 * @param string $pass
 * @return false|string|null
 */
function HashPass(string $pass){
    return password_hash($pass,PASSWORD_DEFAULT);
}

/** ハッシュ値と入力値の比較
 * @param $pass
 * @param $hash
 * @return bool
 */
function VerifyPass($pass,$hash){
    if (password_verify($pass,$hash)) {
        return true;
    }
    return false;
}

/**
 * アカウントの新規登録
 * @param string $name
 * @param string $mail
 * @param string $pass
 * @return false|string
 */
function InsertUser(string $name,string $mail,string $pass){
    global $pdo;
    if(SelectUserByMail($mail) !== false) return false;
    $sql = $pdo->prepare('INSERT INTO user VALUES(?,?,?,?)');
    $sql->bindValue($name,PDO::PARAM_STR);
    $sql->bindValue($mail,PDO::PARAM_STR);
    $sql->bindValue($pass,PDO::PARAM_STR);
    $sql->execute(array(null,$name,$mail,$pass));
    return $pdo->lastInsertId();
}

/**
 * アカウント名の変更
 * @param string $name
 * @param int $user_id
 * @return bool
 */
function UpdateUserName(string $name,int $user_id){
    global $pdo;
    $sql = $pdo->prepare('UPDATE user SET name = ? WHERE user_id = ?');
    $sql->bindValue($name,PDO::PARAM_STR);
    $sql->bindValue($user_id,PDO::PARAM_INT);
    $sql->execute(array($name,$user_id,));
    return true;
}

/**
 * アカウントのメールアドレスの変更
 * @param string $mail
 * @param int $user_id
 * @return bool
 */
function UpdateUserMail(string $mail,int $user_id){
    global $pdo;
    if (CheckUniqueMail($mail) === false) return false;
    $sql = $pdo->prepare('UPDATE user SET mail = ? WHERE user_id = ?');
    $sql->bindValue($mail,PDO::PARAM_STR);
    $sql->bindValue($user_id,PDO::PARAM_INT);
    $sql->execute(array($mail,$user_id,));
    return true;
}

/**
 * アカウントのパスワードの変更
 * @param string $pass
 * @param int $user_id
 * @return bool
 */
function UpdateUserPass(string $pass,int $user_id){
    global $pdo;
    $sql = $pdo->prepare('UPDATE user SET pass = ? WHERE user_id = ?');
    $sql->bindValue($pass,PDO::PARAM_STR);
    $sql->bindValue($user_id,PDO::PARAM_INT);
    $sql->execute(array($pass,$user_id,));
    return true;
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
