<?php

//1.POSTでid,name,email,naiyouを取得
$id = $_POST["id"];
$name = $_POST["name"];
$url = $_POST["url"];
$comment = $_POST["comment"];


//2.DB接続
try{
    $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','');
}catch (PDOException $e){
    exit('データベースに接続できませんでした。'.$e->getMessage());
}


//3.UPDATE gs_an_table SET ....;で更新(bindValue)
$sql = 'UPDATE gs_bm_table SET name=:name, url=:url, comment=:comment WHERE id=:id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':url', $email, PDO::PARAM_STR);
$stmt->bindValue(':comment', $naiyou, PDO::PARAM_STR);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);        //更新したいidを渡す
$status = $stmt->execute();


//4.データ登録処理後
if($status==false){
    //SQL実行時にエラーがある場合（エラーオブジェクトを取得して表示）
    $error = $stmt->errorInfo();
    exit("QueryError:".$error[2]);

}else{
  //select.phpへリダイレクト
    header("Location: output_date.php");
    exit;
}

?>