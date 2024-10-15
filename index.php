<?php

require_once __DIR__ . '/inc/all.php';
$message = "";

render(__DIR__ . '/views/login.view.php', [
  'message' => $message
]);