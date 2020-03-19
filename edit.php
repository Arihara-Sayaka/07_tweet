<?php

require_once('config.php');
require_once('functions.php');

$id = $_GET['id'];

$dbh = connectDb();

$sql = "select * from tweets where id = :id";

$stmt = $dbh->prepare($sql);
$stmt->bindParam(":id", $id);
$stmt->execute();

$tweet = $stmt->fetch(PDO::FETCH_ASSOC);

//存在しないidを渡された時 index.php に飛ばす
if (!$tweet) {
  header('Location: index.php');
  exit;
}

if($_SERVER['REQUEST_METHOD'] === 'POST') {

  $content = $_POST['content'];

  $errors = [];
  if ($content == '') {
    $errors['content'] = 'ツイート内容を入力してください。';
  }

  if ($content === $tweet['content'] ){
    $errors['content'] = '変更されていません';
  }

  if (empty($errors)) {
    $sql = "update tweets set content = :content, created_at = now() where id = :id";

    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(":content", $content);
    $stmt->bindParam(":id", $id, PDO::PARAM_INT);
    $stmt->execute();

    header('Location: index.php');
    exit;
  }
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="style.css">
  <title>編集</title>
</head>
<body>
  <h1>tweetの編集</h1>

  <a href="index.php">戻る</a>

  <?php if ($errors) :?>
    <ul class="error-list">
      <?php foreach ($errors as $error) : ?>
      <li>
        <?php echo h($error); ?>
      </li>
      <?php endforeach; ?>
    </ul>
  <?php endif; ?>

  <form action="" method="post">
    <p>
      <label for="content">ツイート内容</label><br>
      <textarea name="content" id="" cols="30" rows="5"><?php echo h($tweet['content']); ?></textarea>
    </p>
    <p>
      <input type="submit" value="編集する">
    </p>
  </form>
</body>
</html>