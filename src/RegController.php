<?php

require_once __DIR__ . '/../inc/all.php';


// GET POST DATA
function createUser($post) {
  global $pdo;
  $vorname = $post['vorname'];
  $nachname = $post['nachname'];
  $email = $post['email'];
  $passwort = $post['passwort'];
  
  

  // IF POSTs NOT EMPTY
  if (!empty($vorname) && !empty($nachname) && !empty($email) && !empty($passwort)) {

    // CHECK OB EMAIL SCHON VORHANDEN
    function checkEmail ($email,$vorname,$nachname) {
      global $pdo;
  
      try {
        $stmt = $pdo->prepare('SELECT * FROM users WHERE email LIKE :email');
        $stmt->bindValue('email', $email);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (empty($result)) {
          return true;
        } else {
          $message = "Email schon registriert!";
          header("location:reg.php?message=" . urlencode($message). 
                "&vorname=" . urlencode($vorname) . 
                "&nachname=" . urlencode($nachname) . 
                "&email=" . urlencode($email));
          exit;
        }
        
  
      } catch (PDOException $e) {
        error_log("Error: " . $e->getMessage());
        var_dump("Error: Datenbanknicht erreichbar!");
      }

    }


    $checkEmail = checkEmail($email,$vorname,$nachname);

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
        
          // START INSERT ENTRY
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

    // IF NOT CHECKMAIL
    } else {
      $message  = "Es gibt schon einen user mit dieser email!";
      render(__DIR__ . '/../reg.php', [
        'message' => $message,
        'vorname' => $vorname,
        'nachname' => $nachname,
        'email' => $email
      ]);
    }

   // IF POSTs empty
  } else {
    echo ("Bitte Felder ausfüllen!");
  }

}
