<?php

require_once __DIR__ . '/inc/db-connect.inc.php';
require_once __DIR__ . '/inc/all.php';


$token = $_POST['token'];
$send = $_POST['send'];
// REPEAT PASSWORD NOT PASSWORD 

$password = $_POST['password'];
$password_confirmation = $_POST['password_confirmation'];


if ($password !== $password_confirmation) {
  
  $message  = "Passwörter nicht gleich!";
  header("location:reset-password.php?message=" . urlencode($message) .
        '&token=' . $token);
  exit;
}

// CHECK TOKEN
try {
  $stmt = $pdo->prepare('SELECT * FROM users WHERE reset_token_hash = :token');
  $stmt->bindValue('token', $token);
  $stmt->execute();
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

  if (empty($result)) {
    $message  = "Token expired!";
    header("location:reset-password.php?message=" . urlencode($message));
    exit;
  }
  if (strtotime($result[0]["reset_token_expires_at"]) <= time()) {
    $message  = "Token expired!";
    header("location:reset-password.php?message=" . urlencode($message));
    exit;
  }

  

  // PASWORD VALIDATION
  if ($password === $password_confirmation) {
    $passwortRegEx = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!"§$%&\/\\(\\)=?@*?&])[^\s]{8,}$/';
    $passwortTest = $_POST['password'];

    if (preg_match($passwortRegEx, $passwortTest)) {

      
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
      $message  = "Passwort muss 8 Zeichen haben Groß/Klein-Buchstabn sowie Zahlen und Sonderzeichen enthalten!";
      header("location:reset-password.php?message=" . urlencode($message));
      exit;
    }

  }
    
  
  
} catch (PDOException $e) {
  error_log("Error: " . $e->getMessage());
  var_dump("Error: Datenbank nicht erreichbar!");
}