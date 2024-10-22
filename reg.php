<?php 

require_once __DIR__ . '/inc/all.php';



// IF MESSAGE SEND VALUES
if (isset($_GET['message'])) {
  render(__DIR__ . '/views/reg.view.php', [
    'message' => $_GET['message'],
    'vorname' => $_GET['vorname'],
    'nachname' => $_GET['nachname'],
    'email' => $_GET['email']
  ]);

} else {
  render(__DIR__ . '/views/reg.view.php', [
    // 'message' => $message
  ]);
}
