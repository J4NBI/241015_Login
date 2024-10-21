<?php

require __DIR__ . '/inc/db-connect.inc.php';
require_once __DIR__ . '/inc/all.php';

// CHECK IF TOKEN GET
if (!empty($_GET['token']) && empty($_GET['send'])) {
  $token = $_GET['token'];
  $token_hash = hash('sha256', $token);
  
} else if (!empty($_GET['send'])) {
  $token_hash = $_GET['token'];

}else {
  $token = "";
}


// CHECK IF MESSAGE
$messageIndex = "";
if (isset($_GET['message'])) {
    $messageIndex = $_GET['message'];
}






// CHECK TOKEN
try {
  $stmt = $pdo->prepare('SELECT * FROM users WHERE reset_token_hash = :token_hash');
  $stmt->bindValue('token_hash', $token_hash);
  $stmt->execute();
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

  // IF NO TOKEN GO TO RESET PAGE
  
  if (empty($result)) {
    $message  = "Token not found! Page";
    header("location:passreset.php?message=" . urlencode($message));
    exit;
  }
  // IF TOKEN EXPIRED GOT TO RESET PAGE
  if (strtotime($result[0]["reset_token_expires_at"]) <= time()) {
    $message  = "Token expired!";
    header("location:passreset.php?message=" . urlencode($message));
    exit;
  }

  render(__DIR__ . '/views/newpass.view.php', [
    'token_hash' => $token_hash,
    'message' => $messageIndex
  ]);
  
  
} catch (PDOException $e) {
  error_log("Error: " . $e->getMessage());
  var_dump("Error: Datenbank nicht erreichbar!");
}
