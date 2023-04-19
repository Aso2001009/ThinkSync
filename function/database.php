<?php
$opt = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
             PDO::ATTR_ERRMODE => PDO::ERRMODE_EXEPTION,
             PDO::MYSQL_ATTR_MULTI_STATEMENTS => false,
             PDO::ATTR_EMULATE_PREPARES => false
            );

$pdo = new PDO(
    '',
    '',
    '',
    $opt
);

/**
 * データベースを終了する
 */
function endDB(){
    global $pdo;
    $pdo = null;
}
register_shutdown_function('endDB');
?>