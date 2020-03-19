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


//SQLのdelete文を削除
if (empty($errors)) {
  $sql = "delete from tweets where id = :id";

  $stmt = $dbh->prepare($sql);

  $stmt->bindParam(":id", $id);
  $stmt->execute();

  header('Location: index.php');
  exit;

  }