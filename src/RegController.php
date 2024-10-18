<?php

require_once __DIR__ . '/../inc/all.php';


function createUser($post) {
  global $pdo;
  $vorname = $post['vorname'];
  $nachname = $post['nachname'];
  $email = $post['email'];
  $passwort = $post['passwort'];
  
  

  if (!empty($vorname) && !empty($nachname) && !empty($email) && !empty($passwort)) {

    // CHECK OB EMAIL SCHON VORHANEN
    function checkEmail ($email) {
      global $pdo;
  
      try {
        $stmt = $pdo->prepare('SELECT * FROM users WHERE email LIKE :email');
        $stmt->bindValue('email', $email);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (empty($result)) {
          return true;
        } else {
          return false;
        }
        
  
      } catch (PDOException $e) {
        error_log("Error: " . $e->getMessage());
        var_dump("Error: Datenbanknicht erreichbar!");
      }

    }


    $checkEmail = checkEmail($email);

    /// IF MAIL IS NOT IN LIST
    if ($checkEmail){

      // CHECK OB PASSWORT
      if (empty($passwort)) {
        $message  = "Bitte ein Passwort eingeben!";
        render(__DIR__ . '/../reg.php', [
          'message' => $message,
          'vorname' => $vorname,
          'nachname' => $nachname,
          'email' => $email
        ]);
      } else {
        
          // START
          // PASSWORT HASH
          $passwort = password_hash($passwort, PASSWORD_DEFAULT);
        try {
          $stmt = $pdo->prepare('INSERT INTO users (`vorname`, `nachname`, `email`,`passwort`) VALUES (:vorname, :nachname, :email, :passwort)');
          $stmt->bindValue('vorname', $vorname);
          $stmt->bindValue('nachname', $nachname);
          $stmt->bindValue('email', $email);
          $stmt->bindValue('passwort', $passwort);
          $stmt->execute();

          header("Location: index.php");

    
        } catch (PDOException $e) {
          error_log("Error: " . $e->getMessage());
          var_dump("Error: Unable to execute query. Please check the database connection and table existence.");
        }
      }
    } else {
      $message  = "Es gibt schon einen user mit dieser email!";
      render(__DIR__ . '/../reg.php', [
        'message' => $message,
        'vorname' => $vorname,
        'nachname' => $nachname,
        'email' => $email
      ]);
    }

  } else {
    var_dump("ERROR");
  }

}
