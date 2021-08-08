<?php
  session_start();
  require_once("conn.php");
  require_once("utils.php");

  $username = NULL;
  $user = NULL;
  $id = $_GET['id'];
  if (!empty($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $user = getUserFromUsername($username);
  }
  
  $stmt = $conn->prepare(
    "SELECT * FROM yiluan_w10_comments WHERE id = ?"
  );
  $stmt->bind_param('i',$id);
  $result = $stmt->execute();

  if (!$result) {
    die('Error:' . $conn->error);
  }
  $result = $stmt->get_result();
  $row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="style.css">
  <title>留言板</title>
</head>
<body>
  <header class='warning'>
    <strong>注意！本站為練習用網站，因教學用途刻意忽略資安的實作，註冊時請勿使用任何真實的帳號或密碼。</strong>
  </header>
  <main class="board">
    <h1 class="board__title">編輯留言</h1>
    <?php
      if (!empty($_GET['errCode'])) {
        $code = $_GET['errCode'];
        $msg = 'Error';
        if ($code === '1') {
          $msg = '資料不全';
        }
        echo '<h2 class="error">' . $msg . '</h2>';
      }
    ?>
    
    <form class="board__new-comment-form" method="POST" action="handle_update_comment.php">
      <textarea name="content" id="" cols="30" rows="5"><?php echo $row['content'];  ?></textarea>
      <input type="hidden" name="id" value="<?php echo $row['id']?>">
      <input class="board__submit-btn" type="submit">
    </form>
    <div class="board__hr"></div>
    
  </main>
  <script>
    let btn = document.querySelector('.update-nickname')
    btn.addEventListener('click', function() {
      let form = document.querySelector('.board_nickname-form')
      form.classList.toggle('hidden')
    })
  </script>
</body>
</html>