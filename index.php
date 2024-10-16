<?php

require_once __DIR__ . '/inc/all.php';
require_once __DIR__ . '/src/LoginController.php';

$message = "";

if (empty($_POST)) {
  $messageIndex = "";
  render(__DIR__ . '/views/login.view.php', [
    'messageIndex' => $messageIndex
  ]);

} else {
  if (empty($messageIndex)) {
    $messageIndex = "Email oder Passwort falsch!";
    render(__DIR__ . '/views/login.view.php', [
    'messageIndex' => $messageIndex
    ]);
  } else {
    render(__DIR__ . '/views/login.view.php', [
      'messageIndex' => $messageIndex
    ]);

  }
  
}


$loginController = new LoginController($pdo);

if (!empty($_POST['email'])){
  $email = $_POST['email'];
  $passwortH = $_POST['passwort'];
  
  $checkMailStatus = $loginController->checkEmail($email);
  if ($checkMailStatus == true) {
    $checkPasswortStatus = $loginController->checkPasswort($email,$passwortH);
  }
  
}
