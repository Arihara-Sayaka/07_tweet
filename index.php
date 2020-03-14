<?php

require_once('config.php');
require_once('functions.php');

$dbh = connectDb();

//レコードの取得( 全件)
$sql = "select * from tweets";
$stmt = $dbh->prepare($sql);
$stmt->execute();
$posts = $stmt->fetchall(PDO::FETCH_ASSOC);

if($_SERVER['REQUEST_METHOD'] === 'POST') {
  $tweet = $_POST['tweet'];

  $errors = [];
  if ($tweet == '') {
    $errors['tweet'] = 'ツイート内容を入力してください。';
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
  <title>ツイートアプリ</title>
</head>
<body>
  <h1>新規ツイート</h1>

  <?php if($errors) : ?>

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
      <label for="tweet">ツイート内容</label><br>
      <textarea name="tweet" id="" cols="30" rows="5">いまどうしてる？</textarea>
    </p>
    <p>
      <input type="submit" value="投稿する">
    </p>
  </form>

  <h2>Tweet一覧</h2>

  <?php if($tweets) : ?>
  <ul>
    <?php foreach($tweets as $tweet) :?>
    <li>
      <?php echo $POST['id'] ?>
      <a href="show.php?id=<?php echo h($tweet['id']); ?>"></a>
    </li>
    <?php endforeach; ?>
  </ul>
  <?php else : ?>
  <p>
    投稿されたtweetはありません
  </p>
  <?php endif; ?>

</body>
</html>