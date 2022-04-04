<?php


?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/teach.css" />
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
                <div class='right floated column'> <a href="../logout.php">ログアウト</a></div>
            </div>
        </div>
    </header>
    <nav>
        <div class="big ui fluid four item menu">
            <a class="item" href="../home/home.php">ホーム</a>
            <a class="item" href="../notehome.php">ノート作成</a>
            <a class="item" href="../mondai/mondaihome.php">問題集</a>
            <a class="item" href="teachhome.php">教える</a>
        </div>
    </nav>

    <!-- 左の吹き出し -->
    <div class="balloon-color left">
        <figure class="icon-color"><img src='hamustar01.jpeg' alt="代替えテキスト">
            <figcaption class="name-color">ハム君</figcaption>
        </figure>
        <div class="chatting-color">
            <p class="text-color"></p>
        </div>
    </div>
    <!-- 右の吹き出し -->
    <div class="balloon-color right">
        <figure class="icon-color"><img src=hamustar01.jpeg alt="代替えテキスト">
            <figcaption class="name-color">ハム君</figcaption>
        </figure>
        <div class="chatting-color">
            <p id="usertext" class="text-color"></p>
        </div>
    </div>

    <form id="message_form">
        <input type="text" id="message" placeholder="ひとこと">
        <input type="button" value="送信" id="sendbtn">
    </form>
    <script src="http://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script>
        const sendbtn = document.getElementById('sendbtn');

        sendbtn.addEventListener('click', () => {
            const textvalue = document.getElementById('message');
            const messageValue = textvalue.value;
            console.log(messageValue);
            document.getElementById('usertext').innerHTML = messageValue;

            $.ajax({
                url: "chat_data_recieve.php", // 送信先のPHP
                type: "POST",
                dataType: "text",
                //必須ではなさそうだが、サーバ側との整合のために明示しておいた方がよいと書かれていたが、以下を指定すると、ajaxエラーになる。dataType: 'json', 
                data: {
                    message: messageValue,
                },

            }).done(function(data) {
                console.log(data);
            }).fail(function(XMLHttpRequest, textStatus, errorThrown) {
                console.log('error!!!');
                console.log("XMLHttpRequest : " + XMLHttpRequest.status);
                console.log("textStatus     : " + textStatus);
                console.log("errorThrown    : " + errorThrown.message);

            })

        })
    </script>
</body>

</html>