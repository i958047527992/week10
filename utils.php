<?php
  require_once('conn.php');
  
  function generateToken() {
    $s = '';
    for ($i = 1; $i <= 16; $i++) {
      $s .= chr(rand(65,90));
    }
    return $s;
  }

  function getUserFromUsername($username){
    global $conn;
    
    $sql = "SELECT * FROM yiluan_w10_users WHERE username=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $username);
    $result = $stmt->execute();
    if (!$result) {
      die('Error:' . $conn->error);
    }
    $result = $stmt->get_result();
    $row = $result -> fetch_assoc();
    return $row;

  }

  function escape($str) {
    return htmlspecialchars($str, ENT_QUOTES);
  }
?>
