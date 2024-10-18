<?php

require __DIR__ . '/inc/db-connect.inc.php';
require_once __DIR__ . '/inc/all.php';

$token = $_GET['token'];

$token_hash = hash('sha256', $token);


try {
  $stmt = $pdo->prepare('SELECT * FROM users WHERE reset_token_hash = :token_hash');
  $stmt->bindValue('token_hash', $token_hash);
  $stmt->execute();
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
  if (empty($result)) {
    die('token not Found');
  }
  if (strtotime($result[0]["reset_token_expires_at"]) <= time()) {
    die('token expired');
  }
  render(__DIR__ . '/views/newPass.view.php', [
    'token_hash' => $token_hash
  ]);
  
  
} catch (PDOException $e) {
  error_log("Error: " . $e->getMessage());
  var_dump("Error: Datenbank nicht erreichbar!");
}
