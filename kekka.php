<?php

if (
    !isset($_POST['field1']) || $_POST['field1'] == '' ||
    !isset($_POST['field2']) || $_POST['field2'] == '' ||
    !isset($_POST['field3']) || $_POST['field3'] == '' ||
    !isset($_POST['field4']) || $_POST['field4'] == '' 
) {
    exit('ParamError');
}

$field1=$_POST['field1'];
$field2 = $_POST['field2'];
$field3 = $_POST['field3'];
$field4 = $_POST['field4'];
$quiz1 = $_POST['quiz1'];
$quiz2 = $_POST['quiz2'];
$quiz3 = $_POST['quiz3'];
var_dump($_POST);
$quizresult=$quiz1+$quiz2+$quiz3;

if($quizresult<4){
    $identify="積極型";
}
else{
    $identify="保守型";
}


include('functions.php');
$pdo = connect_to_db();
// $dbn = 'mysql:dbname=studyself;charset=utf8mb4;port=3306;host=localhost';
// $user = 'root';
// $pwd = '';

// try {
//     $pdo = new PDO($dbn, $user, $pwd);
// } catch (PDOException $e) {
//     echo json_encode(["db error" => "{$e->getMessage()}"]);
//     exit();
// }

$sql = 'INSERT INTO studyselflogin (id, field1, field2,field3,field4,identify,is_deleted) VALUES (NULL,:field1, :field2,:field3,:field4,:identify,0)';

$stmt = $pdo->prepare($sql);

$stmt->bindValue(':field1', $field1, PDO::PARAM_STR);
$stmt->bindValue(':field2', $field2, PDO::PARAM_STR);
$stmt->bindValue(':field3', $field3, PDO::PARAM_STR);
$stmt->bindValue(':field4', $field4, PDO::PARAM_STR);
$stmt->bindValue(':identify', $identify, PDO::PARAM_STR);

try {
    $status = $stmt->execute();
} catch (PDOException $e) {
    echo json_encode(["sql error" => "{$e->getMessage()}"]);
    exit();
}

session_start();
$_SESSION['session_id'] = session_id();
$_SESSION['signupid'] =1;
$_SESSION['newemail']=$field2;
$_SESSION['newpassword']=$field3;
header('Location:login.php');
exit();

?>