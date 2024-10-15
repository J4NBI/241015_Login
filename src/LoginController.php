<?php

require_once __DIR__ . '/../inc/all.php';


function createUser($post) {
  global $pdo;
  $vorname = $post['vorname'];
  $nachname = $post['nachname'];
  $email = $post['email'];
  $passwort = $post['passwort'];
  $passwort2 = $post['passwort2'];
  

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

      // CHECK OB PASSWORTEN ÜBEREINSTIMMEN
      if ($passwort !== $passwort2) {
        $message  = "Passwörter müssen gleich sein!";
        render(__DIR__ . '/../reg.php', [
          'message' => $message,
          'vorname' => $vorname,
          'nachname' => $nachname,
          'email' => $email
        ]);
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

    if (!$checkEmail) {
      
    } else {

       // PASSWORT HASH
       try {
        $stmt = $pdo->prepare('INSERT INTO users (`vorname`, `nachname`, `email`,`passwort`) VALUES (:vorname, :nachname, :email, :passwort)');
        $stmt->bindValue('vorname', $vorname);
        $stmt->bindValue('nachname', $nachname);
        $stmt->bindValue('email', $email);
        $stmt->bindValue('passwort', $passwort);
        $stmt->execute();


  
      } catch (PDOException $e) {
        error_log("Error: " . $e->getMessage());
        var_dump("Error: Unable to execute query. Please check the database connection and table existence.");
      }

    }
    
  } else {
    var_dump("ERROR");
  }

}
