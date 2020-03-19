<?php

require_once('config.php');
require_once('functions.php');

$id = $_GET['id'];

$dbh = connectDb();

$sql = "select * from tweets where id = :id";
$stmt = $dbh->prepare($sql);
$stmt->bindParam(":id", $id, PDO::PARAM_INT);
$stmt->execute();

$tweet = $stmt->fetch(PDO::FETCH_ASSOC);

//存在しないid渡されたら index.php もどる
if(!$tweet) {
  header('Location: index.php');
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="style.css">
  <title>テストツイート</title>
</head>
<body>

<h1><?php echo h($tweet['content']); ?></h1>

<a href="index.php">戻る</a>

<ul>
  <li>
    [#<?php echo h($tweet['id']); ?>]
    <?php echo h($tweet['content']); ?><br>
    投稿日時: <?php echo h($tweet['created_at']); ?>
    <a href="edit.php?id=<?php echo h($tweet['id']); ?>">[編集]</a>
    <a href="delete.php?id=<?php echo h($tweet['id']); ?>">[削除]</a>
    <?php if ($tweet['good'] == 0 ) : ?>
      <a href="good.php?id=<?php echo h($tweet['id']) . "&good=1"; ?>" class="good-link"><?php echo '☆'; ?></a>
      <?php else :?>
      <a href="good.php?id=<?php echo h($tweet['id']) . "&good=0"; ?>" class="bad-link"><?php echo '★'; ?></a>
      <?php endif; ?>
    <hr>
  </li>
</ul>

</body>
</html>