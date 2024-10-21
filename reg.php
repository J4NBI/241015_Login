<?php 

require_once __DIR__ . '/inc/all.php';

$message = "";
if (isset($_GET['message'])) {
    $message = $_GET['message'];
    $vorname = $_GET['vorname'];
    $nachname = $_GET['nachname'];
    $email = $_GET['email'];
}

// IF MESSAGE SEND VALUES
if (isset($_GET['message'])) {
  render(__DIR__ . '/views/reg.view.php', [
    'message' => $message,
    'vorname' => $vorname,
    'nachname' => $nachname,
    'email' => $email
  ]);

} else {
  render(__DIR__ . '/views/reg.view.php', [
    // 'message' => $message
  ]);
}
