<?php
// 入力項目のチェック

if (
!isset($_POST['notename']) || $_POST['notename'] == '' 
) {
exit('paramError');
}

$notename = $_POST['notename'];
$id = $_POST['id'];

// DB接続
include("functions.php");
$pdo = connect_to_db();

// SQL実行
$sql = 'UPDATE studyselfnote SET notename=:notename, updated_at=now() WHERE noteid=:id';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':notename', $notename, PDO::PARAM_STR);
$stmt->bindValue(':id', $id, PDO::PARAM_STR);

try {
$status = $stmt->execute();
} catch (PDOException $e) {
echo json_encode(["sql error" => "{$e->getMessage()}"]);
exit();
}
header("Location:note.php?param1=2&param2={$id}");
exit();
?>