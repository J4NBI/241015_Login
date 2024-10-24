<?php

require_once __DIR__ . '/inc/all.php';
require_once __DIR__ . '/src/RegController.php';

$vorname = $_POST['vorname'];
$nachname = $_POST['nachname'];
$email = $_POST['email'];
$passwort = $_POST['passwort'];


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

// CHECK EMAIL AND PASSWORT
$emailChecked = emailValid();
$passwortChecked = passwordValid();

if (!$emailChecked) {
  $message  = "Email nicht valide, bitte neu Email eingeben!";
    header("location:reg.php?message=" . urlencode($message). 
          "&vorname=" . urlencode($vorname) . 
          "&nachname=" . urlencode($nachname) . 
          "&email=" . urlencode($email));
    exit;
} else {

  if (!$passwortChecked) {
    $message  = "Passwort muss  mindestens 8 zeichen ein klein und ein Großbuchstabe, ein Zahl sowie Sonderzeichen enhalten.";
    header("location:reg.php?message=" . urlencode($message). 
          "&vorname=" . urlencode($vorname) . 
          "&nachname=" . urlencode($nachname) . 
          "&email=" . urlencode($email));
    exit;
    
} else {
  
  // IF EMAIL AND PASSWORT CREATE USER
  createUser($_POST); // RegisterController.php
}

}

