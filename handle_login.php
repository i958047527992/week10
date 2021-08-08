<?php
  session_start();
  require_once('conn.php');
  require_once('utils.php');
  if (empty($_POST['username']) || empty($_POST['password'])) {
    header("Location: login.php?errCode=1");
    die('資料不全，請重新輸入');
  }
  // 可以用 sprintf 來避免用 . 連接字串，使其難以閱讀。
  $username = $_POST['username'];
  $password = $_POST['password'];

  $sql = "SELECT * FROM yiluan_w10_users WHERE username=?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('s', $username);
  $result = $stmt->execute();
  if (!$result) {
    die($conn->error);
  }

  $result = $stmt->get_result();
  // 沒查到使用者
  if ($result->num_rows === 0) {
    header("Location: login.php?errCode=2");
    exit();
  }

  // 查到使用者
  $row = $result->fetch_assoc();
  if (password_verify($password, $row['password'])) {
    // 登入成功
    $_SESSION['username'] = $username;
    header("Location: index.php");
  } else {
    header("Location: login.php?errCode=2");
    exit();
  }
?>
