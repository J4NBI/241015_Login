<?php

require_once __DIR__ . '/inc/all.php';
require_once __DIR__ . '/src/LoginController.php';

$passwordHash = password_hash("top-secret", PASSWORD_DEFAULT); // ['cost' => 12] Passwort noch sicherer machen.langsamer


createUser($_POST);

