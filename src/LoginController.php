<?php

require_once __DIR__ . '/../inc/all.php';
require_once __DIR__ . '/../inc/db-connect.inc.php';


// LoginController checkEmail checkPasswort
class LoginController {
  private $pdo;
  
  public function __construct($pdo) {
    $this->pdo = $pdo;
  }

  //TEST PDO
  public function getPDO() {
    var_dump($this->pdo);
  }

  //CHECK EMAIL

  public function checkEmail(string $email) {
    global $pdo;
    try {
      $stmt = $pdo->prepare('SELECT * FROM users WHERE email LIKE :email');
      $stmt->bindValue('email', $email);
      $stmt->execute();
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
      if (!empty($result)) {
        
      // SEND EMAIL TRUE OR FALSE TO index.php  
        return true;
      } else {
        return false;
      }
      

    } catch (PDOException $e) {
      error_log("Error: " . $e->getMessage());
      var_dump("Error: Datenbank nicht erreichbar!");
    }

  }

  // CHECK PASSWORT

  public function checkPasswort ($email, $passwortH){
    global $pdo;
    try {
      $stmt = $pdo->prepare('SELECT passwort FROM users WHERE email = :email');
      $stmt->bindValue('email', $email);
      $stmt->execute();
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
      if (!empty($result)) {
        $passwortGet = $result[0]['passwort'];
        $passwortOk = password_verify($passwortH,$passwortGet);

        // SEND PASSWORT TRUE OR FALSE TO index.php
        if ($passwortOk === true){
          return true;
        } else {
          return false;
        }
      } 
      

    } catch (PDOException $e) {
      error_log("Error: " . $e->getMessage());
      var_dump("Error: Datenbank nicht erreichbar!");
    }
    
  }

  public function ensureSession(){
    if (session_status() === PHP_SESSION_NONE) {
      session_start();
    }

  }

};

