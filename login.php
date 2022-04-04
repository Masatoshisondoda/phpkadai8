<?php
session_start();
include('functions.php');
if($_SESSION['signupid']==1){
$useremail= $_SESSION['newemail'];
$password= $_SESSION['newpassword'];
}
else{
$useremail = $_POST['useremail'];
$password = $_POST['password'];
}
$pdo = connect_to_db();

// username，password，is_deletedの3項目全てを満たすデータを抽出する．
$sql = 'SELECT * FROM studyselflogin WHERE field2=:username AND field3=:password AND is_deleted=0';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':username', $useremail, PDO::PARAM_STR);
$stmt->bindValue(':password', $password, PDO::PARAM_STR);

try {
    $status = $stmt->execute();
} catch (PDOException $e) {
    echo json_encode(["sql error" => "{$e->getMessage()}"]);
    exit();
}

$val = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$val) {
    echo "<p>ログイン情報に誤りがあります</p>";
    echo "<a href=login.html>ログイン</a>";
    exit();
} else {
    $_SESSION = array();
    $_SESSION['user_id'] = $val['id'];
    $_SESSION['session_id'] = session_id();
    $_SESSION['username'] = $val['username'];
    header("Location:home/home.php");
    exit();
}