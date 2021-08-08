<?php
  require_once('conn.php');
  session_start();
  if (empty($_POST['nickname']) || empty($_POST['username']) || empty($_POST['password'])) {
    header("Location: register.php?errCode=1");
    die('資料不全，請重新輸入');
  }
  // 可以用 sprintf 來避免用 . 連接字串，使其難以閱讀。
  $nickname = $_POST['nickname'];
  $username = $_POST['username'];
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

  $sql = "insert into yiluan_w10_users(nickname, username, password) values(?, ?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('sss', $nickname, $username, $password);
  $result = $stmt->execute();
  if (!$result) {
    $code = $conn->errno;
    if ($code === 1062) {
      header("Location: register.php?errCode=2");
    }
    // if (strpos($conn->error, "Duplicate entry") !== false) {
    //   header("Location: register.php?errCode=2");
    // }
    die($conn->error);
  }
  echo "新增成功<br>";
  $_SESSION['username'] = $username;
  header("Location: index.php");
?>
