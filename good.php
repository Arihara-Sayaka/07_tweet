<?php

require_once('config.php');
require_once('functions.php');

$id = $_GET['id'];

$dbh = connectDb();

$sql = "select * from tweets where id = :id";

$stmt = $dbh->prepare($sql);
$stmt->bindParam(":id", $id);
$stmt->execute();

$post = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  
  $good = $_GET['good'];

  if ($good == "1") {
    $good_value = 1;
  } else {
    $good_value = 0;
  }

  if (!$tweet) {
    header('Location: index.php');
    exit;
  }

//sql文で該当のデータを更新する
    if (empty($errors)) {
    $sql = "update tweets set good = :good where id = :id";
  
    $stmt = $dbh->prepare($sql_delete);
  
    $stmt->bindParam(":id", $id);
    $stmt->execute();
  
  header('Location: index.php');
    exit;
  
    }
  }

?>

