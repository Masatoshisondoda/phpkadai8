<?php
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/mondai.css" />
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
            <a class="item" href="#">ホーム</a>
            <a class="item" href="../notehome.php">ノート作成</a>
            <a class="item" href="mondaihome.php">問題集</a>
            <a class="item" href="../teach/teachhome.php">教える</a>
        </div>
    </nav>

    <div>
        <div class="ui left basic segment">
            <div id="noteCreate">
                <div class="huge ui teal labeled icon button">
                    <i class="add icon"></i>
                    new
                </div>
            </div>
        </div>
    </div>
    <h2 class="ui header"></h2>
    <div class='ui three column doubling stackable grid container'>
        <div class="four wide column">
            <div class="ui grid center aligned">
                <?= $output ?>
            </div>
        </div>
    </div>
    <?= $idnamearray ?>
    <dialog id=deleteDialog>

        <p id=deleteDialog></p>
    </dialog>
</body>

</html>