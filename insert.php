<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
//1. POSTデータ取得
//[name,towho,agetowho,budget,kenshinplan,addplan,comment]
$name = $_POST["name"];
$towho = $_POST["towho"];
$agetowho = $_POST["agetowho"];
$budget = $_POST["budget"];
$kenshinplan = $_POST["kenshinplan"];
$addplan = $_POST["addplan"];
$comment = $_POST["comment"];

//2. DB接続します
try {
  //Password:MAMP='root',XAMPP=''
  $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('DB_CONECT:'.$e->getMessage());
}


//３．データ登録SQL作成
$sql = "INSERT INTO kenshin_gift(name, towho, agetowho, budget, kenshinplan, addplan, comment) VALUES(:name, :towho, :agetowho, :budget, :kenshinplan, :addplan, :comment)";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':name', $name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':towho', $towho, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':agetowho', $agetowho, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':budget', $budget, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':kenshinplan', $kenshinplan, PDO::PARAM_STR);
$stmt->bindValue(':addplan', $addplan, PDO::PARAM_STR);
$stmt->bindValue(':comment', $comment, PDO::PARAM_STR);
$status = $stmt->execute(); //true or false

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("SQL_ERROR:".$error[2]);
}else{
  //５．index.phpへリダイレクト
  header("Location: index.php");
  exit();

}
?>
