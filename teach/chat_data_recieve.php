<?php
session_start();
$user_id = $_SESSION['user_id'];
include('../functions.php');
$pdo = connect_to_db();
$message = $_POST['message'];
$keyword="aaa";
$category="a2";
var_dump($message);
$sql = 'INSERT INTO teachindex (chatId,text,created_at,keyword,category,user_id) VALUES (NULL,:text,now(),:keyword,:category,:user_id)';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':text', $message, PDO::PARAM_STR);
$stmt->bindValue(':keyword', $keyword, PDO::PARAM_STR);
$stmt->bindValue(':category', $category, PDO::PARAM_STR);
$stmt->bindValue(':user_id', $user_id, PDO::PARAM_STR);
try {
    $status = $stmt->execute();
} catch (PDOException $e) {
    echo json_encode(["sql error" => "{$e->getMessage()}"]);
    exit();
}
exit();
?>