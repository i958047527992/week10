<?php
  session_start();
  require_once('conn.php');
  require_once('utils.php');
  if (empty($_POST['content'])) {
    header("Location: index.php?errCode=1");
    die('資料不全，請重新輸入');
  }

  $username = $_SESSION['username'];
  $content = $_POST['content'];
  // 可以用 sprintf 來避免用 . 連接字串，使其難以閱讀。
  $sql = "insert into yiluan_w10_comments(username, content) values(?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('ss', $username, $content);
  $result = $stmt->execute();
  if (!$result) {
    die($conn->error);
  }
  echo "新增成功<br>";
  header("Location: index.php");
?>
