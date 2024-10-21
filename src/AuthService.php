<?php

require_once __DIR__ . '/../inc/all.php';



// Check if Session user in System
class AuthService {
  private $pdo;

  public function __construct($pdo) {
    $this->pdo = $pdo;
  }

  public function ensureLogin($sessionUser) {
    global $pdo;
    try {
      $stmt = $pdo->prepare('SELECT * FROM users WHERE email = :sessionUser');
      $stmt->bindValue('sessionUser', $sessionUser);
      $stmt->execute();
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
      if (!empty($result) && $_SESSION['userLogin'] === $sessionUser) {
        
        return true;
      } else {
        return false;
      }
      

    } catch (PDOException $e) {
      error_log("Error: " . $e->getMessage());
      var_dump("Error: Datenbank nicht erreichbar!");
    }
  }

}