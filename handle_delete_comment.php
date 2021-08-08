<?php
  session_start();
  require_once('conn.php');
  require_once('utils.php');
  if (empty($_GET['id'])) {
    header("Location: index.php?errCode=1");
    die('資料不全，請重新輸入');
  }

  $id = $_GET['id'];
  $username = $_SESSION['username'];

  $sql = "UPDATE yiluan_w10_comments SET is_deleted=1 where id=? and username=?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('is', $id, $username);
  $result = $stmt->execute();
  if (!$result) {
    die($conn->error);
  }
  echo "刪除成功<br>";
  header("Location: index.php");
?>
