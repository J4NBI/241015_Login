<?php

try {
    $pdo = new PDO('mysql:host=localhost;dbname=user_login', 'user_login', 'l7SJMtf8W/VQ3Ta/', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);

    return $pdo;
}
catch(PDOException $e) {
    echo 'Probleme mit der Datenbankverbindung...';
    die();
}

