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

// if (!$tweet) {
//   header('Location: index.php');
//   exit;
// }

if($_SERVER['REQUEST_METHOD'] === 'POST') {

  $tweet = $_POST['tweet'];

  $errors = [];
  if ($content == '') {
    $errors['content'] = 'ツイート内容を入力してください。';
  }

  if ($content === $post['content'] ){
    $errors['unchanged'] = '変更されていません';
  }

}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>編集</title>
</head>
<body>
  <h1>tweetの編集</h1>

  <a href="index.php">戻る</a>

  <form action="" method="post">
    <p>
      <label for="content">ツイート内容</label><br>
      <textarea name="content" valu="<?php echo h($tweets['content']); ?>" id="" cols="30" rows="5">いまどうしてる？</textarea>
    </p>
    <p>
      <input type="submit" value="編集する">
    </p>
  </form>
</body>
</html>