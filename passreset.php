<?php

require_once __DIR__ . '/inc/all.php';

$message = "";
if (isset($_GET['message'])) {
    $message = $_GET['message'];
}

render(__DIR__ . '/views/passreset.view.php', [
  'message' => $message
]);