<?php

function connect_to_db()
{
    // $dbn = 'mysql:dbname=341939d00bb59b8c9bb09f2528d53d80;charset=utf8mb4;port=3306;host=mysql-2.mc.lolipop.lan';
    // $user = '341939d00bb59b8c9bb09f2528d53d80';
    // $pwd = '省略';

    // $dbn = 'mysql:dbname=studyself;charset=utf8mb4;port=3306;host=localhost';
    // $user = 'root';
    // $pwd = '';

    // $dbn = 'mysql:dbname=heroku_de88d325195688a;charset=utf8mb4;port=3306;host=us-cdbr-east-05.cleardb.net';
    // $user = 'b50a783b3a1781';
    // $pwd = 'faf17b7d';
    $dbn = 'mysql:dbname=heroku_ee43c706abf262b;charset=utf8mb4;port=3306;host=us-cdbr-east-05.cleardb.net';
    $user = 'b53f86c616385a';
    $pwd = '209333bc';
    // $dbn = 'mysql:dbname=studyself;charset=utf8mb4;port=3306;host=localhost';
    // $user = 'root';
    // $pwd = '';
    try {
        return new PDO($dbn, $user, $pwd);
    } catch (PDOException $e) {
        exit('dbError:' . $e->getMessage());
    }
}


function check_session_id()
{
    if (!isset($_SESSION["session_id"]) || $_SESSION["session_id"] != session_id()) {
        header('Location:login.html');
        exit();
    } else {
        session_regenerate_id(true);
        $_SESSION["session_id"] = session_id();
    }
}