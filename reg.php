<?php 

require_once __DIR__ . '/inc/all.php';


if (isset($message)) {
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
