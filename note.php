<?php
//URLベタ打ちアクセス禁止
session_start();
include('functions.php');
check_session_id();
//新規作成か否かチェック
$userId = $_SESSION['user_id'];
$stringUserId =  $userId;
$param1 = $_GET['param1'];
$param2 = $_GET['param2'];
$id = $_GET['id'];
$noteindex = $_GET['noteindex'];

// $sql = 'SELECT * FROM noteindex INNER JOIN (SELECT noteid FROM studyselfnote) AS result_table ON result_table.noteid = noteindex.noteid WHERE user_id=:user_id';
// SELECT * FROM noteindex INNER JOIN studyselfnote ON studyselfnote.noteid = noteindex.noteid;
// $stmt = $pdo->prepare($sql);
// $stmt->bindValue(':user_id', $userid, PDO::PARAM_STR);


if ($id == null) {
    if ($param1 == 1) {
        //note新規作成
        var_dump($user_id);
        $pdo = connect_to_db();
        $user_id = $param2;
        $sql = 'SELECT * FROM studyselfnote WHERE noteid=:id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $user_id, PDO::PARAM_INT);
        try {
            $status = $stmt->execute();
        } catch (PDOException $e) {
            echo json_encode(["sql error" => "{$e->getMessage()}"]);
            exit();
        }
        $record = $stmt->fetch(PDO::FETCH_ASSOC);
        $output = $param2;
    } else {
        var_dump("aa");
        $value = $param2;
        var_dump($stringUserId);
        $pdo = connect_to_db();
        $sql = 'SELECT * FROM noteindex INNER JOIN studyselfnote ON studyselfnote.user_id = noteindex.user_id WHERE studyselfnote.noteid=:id AND noteindex.user_id=:userid AND noteindex.noteid=:id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $value, PDO::PARAM_INT);
        $stmt->bindValue(':userid', $stringUserId, PDO::PARAM_INT);
        try {
            $status = $stmt->execute();
        } catch (PDOException $e) {
            echo json_encode(["sql error" => "{$e->getMessage()}"]);
            exit();
        }

        $record = $stmt->fetch(PDO::FETCH_ASSOC);
        $record2 = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $output = $param2;
    }
} else {
    //ホームにあるノート
    var_dump($id);
    $pdo = connect_to_db();
    $sql = 'SELECT * FROM noteindex INNER JOIN studyselfnote ON studyselfnote.user_id = noteindex.user_id WHERE studyselfnote.noteid=:id AND noteindex.user_id=:userid AND noteindex.noteid=:id';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->bindValue(':userid', $stringUserId, PDO::PARAM_INT);
    try {
        $status = $stmt->execute();
    } catch (PDOException $e) {
        echo json_encode(["sql error" => "{$e->getMessage()}"]);
        exit();
    }
    $record = $stmt->fetch(PDO::FETCH_ASSOC);
    $record2 = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $output = $id;
}

// // 配列を用意します。
// $ary = array('a' => "Taro", 'b' => "John", 'c' => "Nikita", 'd' => "Jiro", 'e' => "Saburo");
// // 配列をjson_encode関数でJSON形式に変換します。
// $json = json_encode($ary);

// $output2 = '"type": paragraph,"data": {"text": テスト１}';
$jsondata1 = json_encode($record2);
foreach ($record2 as $result) {
    $output2 .=
        array($result['notecontent'] => array($result['notetext']));
    // var_dump($result, "/////");
    // $output2 .= '{"type": "paragraph","data": {"text": "テスト１"}},';
};
$jsondata = json_encode($output2);
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="css/note.css" /> -->
    <title>studyself</title>
    <link rel="stylesheet" type="text/css" href="dist/semantic.min.css">
    <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
    <script src="dist/semantic.js"></script>
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css"> -->
    <!-- bulma.min.cssでh2が効かない -->
</head>

<body>

    <header>
        <dialog>
            <form method="post" action="notename_update.php" class=dialog>
                <p class=dialog_title>名前変更</p>
                <p class=dialog_notename> ノートの名前:</p>
                <input type=text name="notename" value="<?= $record['notename'] ?>">
                <div>
                    <input type="hidden" name="id" value="<?= $record['noteid'] ?>">
                </div>
                <button type="submit" class=dialog_note_create>名前変更</button>
            </form>
            <button id="dialogClose">☓</button>
        </dialog>

    </header>

    <div class="ui large menu ui fixed inverted menu">
        <a href=notehome.php class="item">
            <i class="big arrow alternate circle left icon"></i>
        </a>
        <a id="noteCreate" class="item">
            <?= $record['notename'] ?>
        </a>
        <div class="right menu">
            <div class="item">
                <div>
                    <input type="text" placeholder="Search">
                    <i class="search icon"></i>
                </div>
            </div>
            <div class="item">
                <div class="ui primary button" id="save">保存</div>
            </div>
        </div>
    </div>


    <div class=note style="margin:85px">
        <!-- <div class="paper">
            <div class="lines">
                <div class="text">
                    <div class="text" contenteditable spellcheck="false">だった-->
        <!-- <div class=editArea> -->
        <div id="editor"></div>
        <!-- </div>
                </div>
                <div class="holes hole-top"></div>
                <div class="holes hole-middle"></div>
                <div class="holes hole-bottom"></div>
            </div> -->
        <div id=editCan class=editCan></div>


    </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@editorjs/editorjs@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/header@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/list@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/checklist@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/quote@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/code@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/marker@latest"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="http://code.jquery.com/jquery-3.2.1.min.js"></script>

    <script>
        const showDialog = document.querySelector('dialog');
        const noteCreate = document.getElementById('noteCreate');
        const dialogClose = document.getElementById('dialogClose');
        noteCreate.addEventListener('click', () => {
            console.log("aaa");
            showDialog.showModal();
        }, false);
        dialogClose.addEventListener('click', function() {
            showDialog.close();
        }, false);

        // document.body.addEventListener('keydown',
        //         event => {
        //             if (event.key === 'Enter') {
        //                 let cnt = $(".ce-block").length;
        //                 console.log(cnt);
        //                 if (cnt%15==0) {
        //                     console.log("111");
        //                 }
        //             }

        //         });


        class MarkerTool {

            static get isInline() {
                return true;
            }

            get state() {
                return this._state;
            }

            set state(state) {
                this._state = state;

                this.button.classList.toggle(this.api.styles.inlineToolButtonActive, state);
            }

            constructor({
                api
            }) {
                this.api = api;
                this.button = null;
                this._state = false;

                this.tag = 'MARK';
                this.class = 'cdx-marker';
            }

            render() {
                this.button = document.createElement('button');
                this.button.type = 'button';
                this.button.innerHTML = '<svg width="20" height="18"><path d="M10.458 12.04l2.919 1.686-.781 1.417-.984-.03-.974 1.687H8.674l1.49-2.583-.508-.775.802-1.401zm.546-.952l3.624-6.327a1.597 1.597 0 0 1 2.182-.59 1.632 1.632 0 0 1 .615 2.201l-3.519 6.391-2.902-1.675zm-7.73 3.467h3.465a1.123 1.123 0 1 1 0 2.247H3.273a1.123 1.123 0 1 1 0-2.247z"/></svg>';
                this.button.classList.add(this.api.styles.inlineToolButton);

                return this.button;
            }

            surround(range) {
                if (this.state) {
                    this.unwrap(range);
                    return;
                }

                this.wrap(range);
            }

            wrap(range) {
                const selectedText = range.extractContents();
                const mark = document.createElement(this.tag);

                mark.classList.add(this.class);
                mark.appendChild(selectedText);
                range.insertNode(mark);

                this.api.selection.expandToTag(mark);
            }

            unwrap(range) {
                const mark = this.api.selection.findParentTag(this.tag, this.class);
                const text = range.extractContents();

                mark.remove();

                range.insertNode(text);
            }


            checkState() {
                const mark = this.api.selection.findParentTag(this.tag);

                this.state = !!mark;

                if (this.state) {
                    this.showActions(mark);
                } else {
                    this.hideActions();
                }
            }

            renderActions() {
                this.colorPicker = document.createElement('input');
                this.colorPicker.type = 'color';
                this.colorPicker.value = '#f5f1cc';
                this.colorPicker.hidden = true;

                return this.colorPicker;
            }

            showActions(mark) {
                const {
                    backgroundColor
                } = mark.style;
                this.colorPicker.value = backgroundColor ? this.convertToHex(backgroundColor) : '#f5f1cc';

                this.colorPicker.onchange = () => {
                    mark.style.backgroundColor = this.colorPicker.value;
                };
                this.colorPicker.hidden = false;
            }

            hideActions() {
                this.colorPicker.onchange = null;
                this.colorPicker.hidden = true;
            }

            convertToHex(color) {
                const rgb = color.match(/(\d+)/g);

                let hexr = parseInt(rgb[0]).toString(16);
                let hexg = parseInt(rgb[1]).toString(16);
                let hexb = parseInt(rgb[2]).toString(16);

                hexr = hexr.length === 1 ? '0' + hexr : hexr;
                hexg = hexg.length === 1 ? '0' + hexg : hexg;
                hexb = hexb.length === 1 ? '0' + hexb : hexb;

                return '#' + hexr + hexg + hexb;
            }
            static get sanitize() {
                return {
                    mark: {
                        class: 'cdx-marker'
                    }
                };
            }
        }
        const data = {
            0: Object,
            data: Object,
            level: 2,
            text: "見出し",
            type: "header"
        };
        console.log(data);
        let hogeArray = <?= json_encode($jsondata1) ?>;
        const savedata = JSON.parse(hogeArray);
        let savejson = "";
        let savejsonarray = "";
        try {
            JSON.parse(hogeArray);
            console.log(savedata);

        } catch (error) {
            //エラー時の処理
            console.log("aaaa")
        }
if(savedata==!null){
        for (let i = 0; i < savedata.length; i++) {
            let a01 = savedata[i].notecontent
            let a02 = savedata[i].notetext
            let a03 = savedata[i].levelnumber
            savejson = {
                "type": savedata[i].notecontent,
                "data": {
                    text: savedata[i].notetext,
                    level: savedata[i].levelnumber
                }
            };
        }

        }

        const editor = new EditorJS({

            holder: 'editor',
            minHeight: 10,
            tools: {

                Marker: { //マーカーツールを読み込む。
                    class: MarkerTool,
                    shortcut: 'CMD+SHIFT+M',
                },
                header: Header,
                // list: List,
                // checklist: Checklist,
                // quote: Quote,
                // code: CodeTool

            },

            // data: {
            //     blocks: [
            //         savejson,
            //     ],
            // },
        });


        //保存
        const save = document.getElementById('save');
        save.addEventListener('click', () => {
            editor.save()
                .then((savedData) => {
                    console.log(savedData);
                    console.log(savedData.blocks.length);
                    const savetime = savedData.time;
                    const ajaxindex = savedData.blocks;
                    console.log(ajaxindex, savetime);
                    const id = <?= $output ?>;
                    console.log(id);

                    $.ajax({
                        url: "date_recieve.php", // 送信先のPHP
                        type: "POST", // GETで送る
                        dataType: "text",
                        //必須ではなさそうだが、サーバ側との整合のために明示しておいた方がよいと書かれていたが、以下を指定すると、ajaxエラーになる。dataType: 'json', 
                        data: {
                            ajaxindex: ajaxindex,
                            id: id,
                            savetime: savetime
                        },

                    }).done(function(data) {
                        console.log(data);
                    }).fail(function(XMLHttpRequest, textStatus, errorThrown) {
                        console.log('error!!!');
                        console.log("XMLHttpRequest : " + XMLHttpRequest.status);
                        console.log("textStatus     : " + textStatus);
                        console.log("errorThrown    : " + errorThrown.message);

                    })

                    //location.href="date_recieve.php"
                })


        });
    </script>
</body>

</html>