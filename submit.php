<?php

require_once __DIR__ . '/inc/all.php';
require_once __DIR__ . '/src/RegController.php';

$vorname = $_POST['vorname'];
$nachname = $_POST['nachname'];
$email = $_POST['email'];
$passwort = $_POST['passwort'];
$passwort2 = $_POST['passwort2'];

// PASSWORT REGEX
function passwordValid () {
  $passwortRegEx = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!"§$%&\/\\(\\)=?@*?&])[^\s]{8,}$/';
  $passwortTest = $_POST['passwort'];

  if (preg_match($passwortRegEx, $passwortTest)) {
    return true;
  } else {
      return false;
  }
}

// EMAIL REGEX
function emailValid() {
  $emailRegEx = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
  $emailTest = $_POST['email'];

  if (preg_match($emailRegEx, $emailTest)) {
    
    return true;
  } else {
    
    return false;
  }
}

// IF CHECKED 
$emailChecked = emailValid();
$passwortChecked = passwordValid();

if ($emailChecked && $passwortChecked) {
    createUser($_POST); // LoginController.php //
} else {
  $message  = "Email oder Passwort nicht korrekt. Passwort muss  mindestens 8 zeichen ein klein und ein Großbuchstabe, ein Zahl sowie Sonderzeichen enhalten.";
        render(__DIR__ . '/reg.php', [
          'message' => $message,
          'vorname' => $vorname,
          'nachname' => $nachname,
          'email' => $email
        ]);
}


// 

