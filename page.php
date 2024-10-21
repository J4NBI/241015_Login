<?php

require_once __DIR__ . '/inc/all.php';
require_once __DIR__ . '/src/AuthService.php';


// IF SESSION SHOW PAGE
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
$sessionUser = $_SESSION['userLogin'];

// ENSURE LOGIN AuthService
$authService = new AuthService($pdo);
$AuthServiceBool = $authService -> ensureLogin($sessionUser);

if ($AuthServiceBool) {

  render(__DIR__ . '/views/page.view.php', [
    // 'acces' => true
  ]);

} else {
  header('Location: ./index.php');
}