<?php
session_start();
$user_id = $_SESSION['user_id'];
include('functions.php');
$pdo = connect_to_db();

$ajaxindex = $_POST['ajaxindex'];
$id=$_POST['id'];
$savetime = $_POST['savetime'];
$n = count($ajaxindex);
$keys = array_keys($ajaxindex);
foreach($ajaxindex as $keys=>$V){
    $newAjaxindex[$keys]=$V;
    $a=$newAjaxindex[$keys];
    $keys2= array_keys($a);
    foreach($a as $keys2=>$v){
        $aaa= $keys2;
        $a2 = $v;
        $keys4="";
        foreach ($a2 as $keys3 => $v3) {
            var_dump("keys;",$keys3,$v3);
            $keys4=$keys3;
            $level=intval($v3);

            $v2 = $v;
            $a3 = $a['data'];
            $a4 = $a3['text'];
            $a5=$a['type'];
            var_dump($aaa, "///", $a2, "kokokokoko", $a3, $a4,$V,$a5);
            // $sql = 'UPDATE noteindex SET notecontent=:jsondata, updated_at=now() WHERE noteid=:id';
            $sql = 'INSERT INTO noteindex (uniqueId,noteid,savetime, notecontent,noteindextype,levelnumber,notetext,user_id,created_at) VALUES (NULL,:noteid,:savetime,:notecontent,:noteindextype,:levelnumber,:notetext,:user_id,now())';
            //ON DUPLICATE KEY UPDATE savetime=:savetime,notecontent=:notecontent,noteindextype=:noteindextype,notetext=:notetext'

            // $sql ='MERGE INTO noteindex USING (SELECT $id AS id,$savetime AS time,$aaa AS notecontent,$a2 AS noteindex $a4 AS notetext $user_id AS user_id) AS newnoteindex ON(noteindex.noteid = newnoteindex.id)
            //         WHEN MATCHED THEN UPDATE SET savetime=:savetime,notecontent=:notecontent, noteindex=:noteindex notetext=:notetext
            //         WHEN NOT MATCHED THEN INSERT INTO noteindex (uniqueId,noteid,savetime, notecontent,noteindex,notetext,user_id,created_at) VALUES (NULL,:noteid,:savetime,:notecontent,:noteindex,:notetext,:user_id,now())';


            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':noteid', $id, PDO::PARAM_STR);
            $stmt->bindValue(':savetime', $savetime, PDO::PARAM_STR);
            $stmt->bindValue(':notecontent', $a5, PDO::PARAM_STR);
            $stmt->bindValue(':noteindextype', $keys4, PDO::PARAM_STR);
            $stmt->bindValue(':levelnumber', $level, PDO::PARAM_STR);
            $stmt->bindValue(':notetext', $a4, PDO::PARAM_STR);
            $stmt->bindValue(':user_id', $user_id, PDO::PARAM_STR);
            try {
                $status = $stmt->execute();
            } catch (PDOException $e) {
                echo json_encode(["sql error" => "{$e->getMessage()}"]);
                exit();
            }
        }

        
    }
}



exit();


?>
