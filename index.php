<?php

require_once __DIR__ . '/inc/all.php';
require_once __DIR__ . '/src/LoginController.php';

// CHECK IF MESSAGE
$messageIndex = "";
if (isset($_GET['message'])) {
    $messageIndex = $_GET['message'];
}



// SEITE OHNE MESSAGE
if (empty($_POST)) {
  render(__DIR__ . '/views/login.view.php', [
    'messageIndex' => $messageIndex
  ]);

// SEITE MIT MESSAGE WENN LOGIN FALSCH IST
} else {
  if (empty($messageIndex)) {
    // $messageIndex = "Email oder Passwort falsch!";
    render(__DIR__ . '/views/login.view.php', [
    'messageIndex' => $messageIndex
    ]);
  } else {
    render(__DIR__ . '/views/login.view.php', [
      'messageIndex' => $messageIndex
    ]);

  }
  
}


// IF POST check email and password

$loginController = new LoginController($pdo);

if (!empty($_POST['email'])){
  $email = $_POST['email'];
  $passwortH = $_POST['passwort'];
  
  $checkMailStatus = $loginController->checkEmail($email);
  // IF EMAIL CHECK PASSWORT
  if ($checkMailStatus == true) {
    $checkPasswortStatus = $loginController->checkPasswort($email,$passwortH);

    // IF PASSWORT - START SESSION GO TO PAGE
      if ($checkPasswortStatus == true) {
        // Check if Session
        $loginController->ensureSession();
        session_regenerate_id();
        $_SESSION['userLogin'] = $email;
        header ("location:page.php");

    // PASSWORT FALSCH SEND MESSAGE
      } else {
        $messageIndex = "Passwort Falsch!";
        header("location:index.php?message=" . urlencode($messageIndex));
        exit;
      }
    // IF NOT EMAIL SEND MESSAGE
  } else {
    $messageIndex = "Email nicht registriert!";
    header("location:index.php?message=" . urlencode($messageIndex));
    exit;
  }
  
}
