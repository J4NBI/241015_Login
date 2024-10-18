<?php

require_once __DIR__ . '/inc/db-connect.inc.php';
require_once __DIR__ . '/inc/all.php';


$token = $_POST['token'];

try {
  $stmt = $pdo->prepare('SELECT * FROM users WHERE reset_token_hash = :token');
  $stmt->bindValue('token', $token);
  $stmt->execute();
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
  if (empty($result)) {
    die('token not Found');
  }
  if (strtotime($result[0]["reset_token_expires_at"]) <= time()) {
    die('token expired');
  }

  $password = $_POST['password'];
  $password_confirmation = $_POST['password_confirmation'];

  if ($password !== $password_confirmation) {
    die('Passwörter nicht gleich!');
  }
  if ($password === $password_confirmation) {
    $passwortRegEx = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!"§$%&\/\\(\\)=?@*?&])[^\s]{8,}$/';
    $passwortTest = $_POST['password'];

    if (preg_match($passwortRegEx, $passwortTest)) {
      // IF REGEX TRUE
      // var_dump($result[0]['ID']);
      // die();
      
      $password = password_hash($password, PASSWORD_DEFAULT);
      try {
        $stmt = $pdo->prepare('UPDATE users SET passwort = :password,
                              reset_token_hash = NULL,
                              reset_token_expires_at = NULL WHERE ID = :id');
        $stmt->bindValue('password', $password);
        $stmt->bindValue('id', $result[0]['ID']);
        $stmt->execute();

        header("Location: index.php");

  
      } catch (PDOException $e) {
        error_log("Error: " . $e->getMessage());
        var_dump("Error: Unable to execute query. Please check the database connection and table existence.");
      }

    } else {
      die('passwort muss...');
    }

  }
    
  
  
} catch (PDOException $e) {
  error_log("Error: " . $e->getMessage());
  var_dump("Error: Datenbank nicht erreichbar!");
}