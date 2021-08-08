<?php
  session_start();
  require_once('conn.php');
  require_once('utils.php');
  if (empty($_POST['nickname'])) {
    header("Location: index.php?errCode=1");
    die('資料不全，請重新輸入');
  }
  $username = $_SESSION['username'];

  $nickname = $_POST['nickname'];

  $sql = "update yiluan_w10_users set nickname=? where username=?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('ss', $nickname, $username);
  $result = $stmt->execute();
  if (!$result) {
    die($conn->error);
  }
  echo "新增成功<br>";
  header("Location: index.php");
?>
