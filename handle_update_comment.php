<?php
  session_start();
  require_once('conn.php');
  require_once('utils.php');
  if (empty($_POST['content'])) {
    header("Location: update_comment.php?errCode=1&id=".$_POST['id']);
    die('資料不全，請重新輸入');
  }
  $username = $_SESSION['username'];
  $id = $_POST['id'];
  $content = $_POST['content'];

  $sql = "UPDATE yiluan_w10_comments set content=? where id=? and username=?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('sis', $content, $id, $username);
  $result = $stmt->execute();
  if (!$result) {
    die($conn->error);
  }
  echo "新增成功<br>";
  header("Location: index.php");
?>
