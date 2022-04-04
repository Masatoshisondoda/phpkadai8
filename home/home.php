<?php
session_start();
include('../functions.php');
check_session_id();
$userid = $_SESSION['user_id'];

// $pdo = connect_to_db();

// $sql = 'SELECT * FROM studyselfnote  INNER JOIN  (SELECT id  FROM studyselflogin) AS result_table ON  result_table.id = studyselfnote.user_id WHERE user_id=:user_id';

// $stmt = $pdo->prepare($sql);
// $stmt->bindValue(':user_id', $userid, PDO::PARAM_STR);
// try {
//     $status = $stmt->execute();
// } catch (PDOException $e) {
//     echo json_encode(["sql error" => "{$e->getMessage()}"]);
//     exit();
// }

// $result = $stmt->fetchAll(PDO::FETCH_ASSOC);


?>


<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/home.css" />
    <title>Studyself</title>
    <link rel="stylesheet" type="text/css" href="../dist/semantic.min.css">
    <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
    <script src="../dist/semantic.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
</head>

<body>
    <header class="topNavigation">
        <p>Studyself</p>
        <div class="ui grid">
            <div class="four column row">
                <div class='right floated column'> <a href="logout.php">ログアウト</a></div>
            </div>
        </div>
    </header>
    <nav>
        <div class="big ui fluid four item menu">
            <a class="item" href="home.php">ホーム</a>
            <a class="item" href="../notehome.php">ノート作成</a>
            <a class="item" href="../mondai/mondaihome.php">問題集</a>
            <a class="item" href="../teach/teachhome.php">教える</a>
        </div>
    </nav>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        
    </script>
</body>

</html>